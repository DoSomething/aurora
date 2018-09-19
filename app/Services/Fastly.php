<?php

namespace Aurora\Services;

use Aurora\Resources\Redirect;
use Aurora\Resources\RedirectCollection;
use DoSomething\Gateway\Common\RestApiClient;
use DoSomething\Gateway\AuthorizesWithApiKey;

class Fastly extends RestApiClient
{
    use AuthorizesWithApiKey;

    /**
     * Create a new API client.
     *
     * @param array $config
     * @param array $overrides
     */
    public function __construct($config = [], $overrides = [])
    {
        // Set fields for `AuthorizesWithBasicAuth` trait.
        $this->apiKeyHeader = 'Fastly-Key';
        $this->apiKey = $config['api_key'];

        $this->redirects = $config['redirects_table'];
        $this->types = $config['types_table'];

        $basePath = $config['url'].'/service/'.$config['service_id'].'/';
        parent::__construct($basePath, $overrides);
    }

    /**
     * Get all redirects.
     *
     * @return array
     */
    public function getAllRedirects()
    {
        $redirects = $this->get('dictionary/'.$this->redirects.'/items');
        $types = $this->get('dictionary/'.$this->types.'/items');
        $idedTypes = collect($types)->keyBy('item_key');

        $redirects = array_map(function($redirect) use ($idedTypes) {
            return $this->parseRedirect($redirect, $idedTypes[$redirect['item_key']]);
        }, $redirects);

        return new RedirectCollection(['data' => $redirects]);
    }

    /**
     * Get a redirect by key.
     *
     * @return array
     */
    public function getRedirect($id)
    {
        $key = $this->decodeId($id);

        $target = $this->get('dictionary/'.$this->redirects.'/item/'.$key);
        $type = $this->get('dictionary/'.$this->types.'/item/'.$key);

        return new Redirect($this->parseRedirect($target, $type));
    }

    /**
     * Create a redirect.
     *
     * @return array
     */
    public function createRedirect($path, $target, $status)
    {
        $key = $this->decodeId($id);

        // Create a record in the redirects dictionary.
        $this->post('dictionary/'.$this->redirects.'/item', [
            'item_key' => $path,
            'item_value' => $target,
        ]);

        // Create a record in the statuses dictionary.
        $this->post('dictionary/'.$this->types.'/item', [
            'item_key' => $path,
            'item_value' => $status,
        ]);
    }

    /**
     * Update a redirect.
     *
     * @return array
     */
    public function updateRedirect($id, $path, $status)
    {
        $key = $this->decodeId($id);

        // Update the corresponding record in the redirects & statuses dictionaries.
        $this->patch('dictionary/'.$this->redirects.'/item/'.$key, ['item_value' => $path]);
        $this->patch('dictionary/'.$this->types.'/item/'.$key, ['item_value' => $status]);
    }

    /**
     * Delete a redirect.
     *
     * @return array
     */
    public function deleteRedirect($id)
    {
        $key = $this->decodeId($id);

        // Delete the corresponding record in the redirects & statuses dictionaries.
        $deletedRedirect = $this->delete('dictionary/'.$this->redirects.'/item/'.$key);
        $deletedType = $this->delete('dictionary/'.$this->types.'/item/'.$key);

        return $deletedRedirect && $deletedType;
    }

    /**
     * Encode the redirect key to be URL-safe.
     *
     * @param string $redirect
     */
    protected function encodeId($redirect) {
        return str_replace('/', '_', base64_encode($redirect['item_key']));
    }

    /**
     * Decode the ID into a Fastly item key.
     *
     * @param string $redirect
     */
    protected function decodeId($id) {
        return urlencode(base64_decode(str_replace('_', '/', $id)));
    }

    /**
     * Parse the redirect & type dictionary items.
     */
    protected function parseRedirect($redirect, $type) {
        return [
            'id' => $this->encodeId($redirect),
            'path' => $redirect['item_key'],
            'target' => $redirect['item_value'],
            'status' => $type['item_value'],
            'updated_at' => $redirect['updated_at'],
            'created_at' => $redirect['created_at'],
        ];
    }

    /**
     * Send a POST request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @param array $payload - Body of the POST request
     * @param bool $withAuthorization - Should this request be authorized?
     * @return array
     */
    public function post($path, $payload = [], $withAuthorization = true)
    {
        $options = [
            'form_params' => $payload,
        ];

        return $this->send('POST', $path, $options, $withAuthorization);
    }

    /**
     * Send a PATCH request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @param array $payload - Body of the PUT request
     * @param bool $withAuthorization - Should this request be authorized?
     * @return array
     */
    public function patch($path, $payload = [], $withAuthorization = true)
    {
        $options = [
            'form_params' => $payload,
        ];

        return $this->send('PATCH', $path, $options, $withAuthorization);
    }

    /**
     * Determine if the response was successful or not.
     *
     * @param mixed $json
     * @return bool
     */
    public function responseSuccessful($json)
    {
        return $json['status'] === 'ok';
    }
}
