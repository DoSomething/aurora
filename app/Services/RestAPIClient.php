<?php

namespace Aurora\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RestAPIClient
{
    protected $client;

    /**
     * RestAPIClient constructor.
     *
     * @param $base_url - Base URL for this API, e.g. https://api.dosomething.org/v1/
     * @param array $additional_headers - Additional headers that should be sent with every request
     */
    public function __construct($base_url, $additional_headers = [])
    {
        $standard_headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $client = new Client([
            'base_url' => $base_url,
            'defaults' => [
                'headers' => array_merge($standard_headers, $additional_headers),
            ],
        ]);

        $this->client = $client;
    }

    /**
     * Send a GET request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @param array $query - Key-value array of query string values
     * @return array
     */
    public function get($path, $query = [])
    {
        $response = $this->send('GET', $path, [
            'query' => $query,
        ]);

        return $response->json();
    }

    /**
     * Send a POST request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @param array $body
     * @return array
     */
    public function post($path, $body = [])
    {
        $response = $this->send('POST', $path, [
            'body' => json_encode($body),
        ]);

        return $response->json();
    }

    /**
     * Send a PUT request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @param array $body
     * @return array
     */
    public function put($path, $body = [])
    {
        $response = $this->send('PUT', $path, [
            'body' => json_encode($body),
        ]);

        return $response->json();
    }

    /**
     * Send a DELETE request to the given URL.
     *
     * @param string $path - URL to make request to (relative to base URL)
     * @return bool
     */
    public function delete($path)
    {
        $response = $this->send('DELETE', $path);

        return $this->responseSuccessful($response);
    }

    /**
     * @param $method
     * @param $path
     * @param array $options
     * @return Response|void
     */
    public function send($method, $path, $options = [])
    {
        try {
            return $this->client->send($this->client->createRequest($method, $path, $options));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
            // If it's a validation error, loop through the error response and present as
            // a standard Laravel validation error, so the user can fix their mistakes!
            if ($e->getCode() === 422) {
                $fields = json_decode($e->getResponse()->getBody()->getContents())->errors;
                $messages = new MessageBag;

                foreach ($fields as $attribute => $errors) {
                    foreach ($errors as $error) {
                        $messages->add($attribute, $error);
                    }
                }

                throw new ValidationException($messages);
            }

            throw new HttpException(500, 'Northstar returned an error for that request.');
        }
    }

    /**
     * @param $method
     * @param $path
     * @param array $options
     * @return Response|void
     */
    public function raw($method, $path, $options)
    {
        return $this->client->send($this->client->createRequest($method, $path, $options));
    }

    /**
     * Determine if the response was successful or not.
     *
     * @param $response
     * @return bool
     */
    public function responseSuccessful(Response $response)
    {
        return isset($response->json()['success']);
    }
}
