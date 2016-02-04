<?php

namespace Aurora\Services;

use Aurora\APIResponseCollection;
use Aurora\NorthstarKey;
use Aurora\NorthstarUser;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Northstar extends RestAPIClient
{
    /**
     * Northstar constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $base_url = $config['url'].'/'.$config['version'].'/';
        $api_key = $config['api_key'];

        parent::__construct($base_url, ['X-DS-REST-API-Key' => $api_key]);
    }

    /**
     * Send a POST request to verify the user's credentials.
     *
     * @param array $credentials
     *   ex: ['email' => '...', 'password' => '...']
     *       ['mobile' => '...', 'password' => '...']
     * @return NorthstarUser|null
     */
    public function verify($credentials)
    {
        try {
            $response = $this->raw('POST', 'auth/verify', [
                'body' => json_encode($credentials),
            ]);

            return new NorthstarUser($response->json()['data']);
        } catch (ClientException $e) {
            $code = $e->getCode();
            if($code === 401 || $code === 422) {
                // If 401 Unauthorized or 422 Unprocessable Entity, then
                // these are invalid credentials.
                return null;
            }

            // Otherwise, something unexpected went wrong.
            throw new HttpException(500, 'Northstar returned an error for that request.');
        }
    }

    /**
     * Send a GET request to return all users matching a given
     * query from Northstar.
     *
     * @param array $inputs - Filter, search, or pagination queries
     * @return APIResponseCollection
     */
    public function getAllUsers($inputs = [])
    {
        $response = $this->get('users', $inputs);

        return new APIResponseCollection($response, NorthstarUser::class);
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
        $response = $this->get('users/'.$type.'/'.$id);

        return new NorthstarUser($response['data']);
    }

    /**
     * Send a PUT request to update a user in Northstar.
     *
     * @param string $id - Northstar User ID
     * @param array $input - Fields to update in profile
     * @return mixed
     */
    public function updateUser($id, $input)
    {
        $response = $this->put('users/_id/'.$id, $input);

        return new NorthstarUser($response['data']);
    }

    /**
     * Send a DELETE request to delete a user from Northstar.
     *
     * @param $id - Northstar user ID
     * @return bool - Whether user was successfully deleted
     */
    public function deleteUser($id)
    {
        $success = $this->delete('users/_id/'.$id);

        return $success;
    }

    /**
     * Send a GET request to return all Northstar keys.
     *
     * @return array - keys
     */
    public function getAllApiKeys()
    {
        $response = $this->get('keys');

        return new APIResponseCollection($response, NorthstarKey::class);
    }

    /**
     * Send a POST request to create a new API key.
     *
     * @param array $input - key values
     * @return NorthstarKey
     */
    public function createNewApiKey($input)
    {
        $response = $this->post('keys', $input);

        return new NorthstarKey($response['data']);
    }

    /**
     * Send a GET request to get the specified key.
     *
     * @param string $api_key - API key
     * @return NorthstarKey
     */
    public function getApiKey($api_key)
    {
        $response = $this->get('keys/'.$api_key);

        return new NorthstarKey($response['data']);
    }

    /**
     * Send a POST request to generate new keys to northstar
     *
     * @param string $api_key - API key
     * @param array $input - key values
     * @return NorthstarKey
     */
    public function updateApiKey($api_key, $input)
    {
        $response = $this->put('keys/'.$api_key, $input);

        return new NorthstarKey($response['data']);
    }

    /**
     * Send a DELETE request to delete an API key from Northstar.
     *
     * @param string $api_key - API key
     * @return bool - Whether user was successfully deleted
     */
    public function deleteApiKey($api_key)
    {
        return $this->delete('keys/'.$api_key);
    }

    /**
     * Get the available scopes for API keys & their descriptions.
     *
     * @return array - key/value array of scopes & descriptions
     */
    public function scopes()
    {
        return $this->get('scopes');
    }
}
