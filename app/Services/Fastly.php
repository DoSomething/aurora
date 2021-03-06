<?php

namespace Aurora\Services;

use Aurora\Resources\Redirect;
use Aurora\Resources\RedirectCollection;
use DoSomething\Gateway\AuthorizesWithApiKey;
use DoSomething\Gateway\Common\RestApiClient;

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

        $basePath = $config['url'] . '/service/' . $config['service_id'] . '/';
        parent::__construct($basePath, $overrides);
    }

    /**
     * Get all redirects.
     *
     * @return RedirectCollection
     */
    public function getAllRedirects()
    {
        $redirects = $this->get('dictionary/' . $this->redirects . '/items');

        $redirects = array_map(function ($redirect) {
            return Redirect::fromItems($redirect);
        }, $redirects);

        return new RedirectCollection(['data' => $redirects]);
    }

    /**
     * Get a redirect by key.
     *
     * @return Redirect
     */
    public function getRedirect($id)
    {
        $key = Redirect::decodeId($id);

        $redirect = $this->get(
            'dictionary/' . $this->redirects . '/item/' . $key,
        );

        return Redirect::fromItems($redirect);
    }

    /**
     * Create a redirect.
     *
     * @return Redirect
     */
    public function createRedirect($path, $target)
    {
        // Ensure path begins with a slash & is lower-case.
        $path = $path[0] === '/' ? $path : '/' . $path;
        $path = strtolower($path);

        // Create or update a record in the redirects dictionary.
        $redirect = $this->put(
            'dictionary/' . $this->redirects . '/item/' . urlencode($path),
            [
                'item_value' => $target,
            ],
        );

        return Redirect::fromItems($redirect);
    }

    /**
     * Update a redirect.
     *
     * @return Redirect
     */
    public function updateRedirect($path, $target)
    {
        // Update the corresponding record in the redirects dictionary.
        $redirect = $this->patch(
            'dictionary/' . $this->redirects . '/item/' . urlencode($path),
            [
                'item_value' => $target,
            ],
        );

        return Redirect::fromItems($redirect);
    }

    /**
     * Delete a redirect.
     *
     * @return bool
     */
    public function deleteRedirect($id)
    {
        $key = Redirect::decodeId($id);

        // Delete the corresponding record in the redirects dictionary.
        return $this->delete(
            'dictionary/' . $this->redirects . '/item/' . $key,
        );
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
