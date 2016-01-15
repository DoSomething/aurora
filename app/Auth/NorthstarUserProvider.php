<?php

namespace Aurora\Auth;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Auth\EloquentUserProvider;

class NorthstarUserProvider extends EloquentUserProvider implements UserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // Get the Northstar user
        $northstar = new \Aurora\Services\Northstar;
        $response = $northstar->getUser('email', $credentials['email']);

        // If a matching user is found, find or create local Aurora user.
        return $this->createModel()->firstOrCreate([
            '_id' => $response['_id'],
        ]);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $northstar = new \Aurora\Services\Northstar;
        try {
            $northstar->login($credentials);
            return true;
        } catch(ClientException $e) {
            // If an exception is returned, we couldn't log in...
        }

        return false;
    }

}
