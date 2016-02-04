<?php

namespace Aurora\Auth;

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
        $northstar = app('\Aurora\Services\Northstar');
        $user = $northstar->getUser('email', $credentials['email']);

        if (! $user) {
            return null;
        }

        // If a matching user is found, find or create local Aurora user.
        return $this->createModel()->firstOrCreate([
            'northstar_id' => $user->id,
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
        $northstar = app('\Aurora\Services\Northstar');
        $user = $northstar->verify($credentials);

        return ! is_null($user);
    }
}
