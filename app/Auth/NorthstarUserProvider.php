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
            'northstar_id' => $response->id,
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

        return ! is_null($northstar->verify($credentials));
    }
}
