<?php

namespace Aurora\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;

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
        $response = $this->client->get($path, [
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
        $response = $this->client->post($path, [
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
        $response = $this->client->post($path, [
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
        $response = $this->client->delete($path);

        return $this->responseSuccessful($response);
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
