<?php

namespace Aurora\Services;

use Aurora\APIResponseCollection;
use Aurora\NorthstarUser;
use GuzzleHttp\Client;

class Northstar
{
    protected $client;

    public function __construct()
    {
        $base_url = config('services.northstar.url');
        $version = config('services.northstar.version');

        $client = new Client([
            'base_url' => [$base_url.'/{version}/', ['version' => $version]],
            'defaults' => [
                'headers' => [
                    'X-DS-Application-Id' => config('services.northstar.app_id'),
                    'X-DS-REST-API-Key' => config('services.northstar.api_key'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ],
        ]);

        $this->client = $client;
    }

    /**
     * Send a POST request to login the user.
     *
     * @param array - input
     */
    public function login($input)
    {
        $response = $this->client->post('login', [
            'body' => json_encode($input),
        ]);

        return $response->json()['data'];
    }

    /**
     * Send a GET request to return all users with given query
     * from northstar database
     *
     * @return APIResponseCollection
     */
    public function getAllUsers($inputs)
    {
        $response = $this->client->get('users', [
            'query' => $inputs,
        ]);

        return new APIResponseCollection($response->json());
    }

    /**
     * Send a GET request to return a user with that id.
     *
     * @param string $type - '_id', 'email', 'mobile'
     * @param string $id - ID, email, id, phone
     * @return NorthstarUser
     */
    public function getUser($type, $id)
    {
        $response = $this->client->get('users'.'/'.$type.'/'.$id);
        $data = $response->json()['data'];

        return new NorthstarUser($data);
    }

    /**
     * Send a PUT request to update a user
     *
     * @param mixed ID, mixed input
     */
    public function updateUser($id, $input)
    {
        $response = $this->client->put('users'.'/_id/'.$id, [
            'body' => json_encode($input),
        ]);
    }

    /**
     * Send a GET request to return all northstar keys
     *
     * @return JSON keys
     */
    public function getAllApiKeys()
    {
        $response = $this->client->get('keys');

        return $response->json()['data'];
    }

    public function getApiKey($api_key)
    {
        $response = $this->client->get('keys/'.$api_key);

        return $response->json()['data'];
    }

    public function deleteApiKey($api_key)
    {
        $response = $this->client->delete('keys/'.$api_key);
        $data = $response->json();

        return isset($data['success']) ? true : false;
    }

    /**
     * Send a POST request to generate new keys to northstar
     *
     * @param string input
     * @return JSON file
     */
    public function createNewApiKey($input)
    {
        $response = $this->client->post('keys', [
            'body' => json_encode($input),
        ]);

        return $response->json();
    }

    /**
     * Send a POST request to generate new keys to northstar
     *
     * @param string input
     * @return JSON file
     */
    public function updateApiKey($api_key, $input)
    {
        $response = $this->client->put('keys/'.$api_key, [
            'body' => json_encode($input),
        ]);

        return $response->json();
    }

    /**
     * Send a GET request to return all users matching $type
     *
     * @todo need to make a parameter for Northstar API's retreive user query to sort by most recent user
     * @param mixed ID, email, id, phone
     * @return user objects
     */
    public function getUsers($type, $id)
    {
        $response = $this->client->get('users'.'/'.$type.'/'.$id);
        $northstar_users = $response->json()['data'];
        // sort users by "updated_at" attribute
        uasort($northstar_users, function ($a, $b) {
            if ($a['updated_at'] == $b['updated_at']) {
                return 0;
            }

            return ($a['updated_at'] > $b['updated_at']) ? -1 : 1;
        });

        return $northstar_users;
    }

    /**
     * Send a DELETE request to delete an user from northstar database
     *
     * @param mixed ID
     */
    public function deleteUser($id)
    {
        $response = $this->client->delete('users/'.$id);
    }

    public function scopes()
    {
        return $this->client->get('scopes')->json();
    }
}
