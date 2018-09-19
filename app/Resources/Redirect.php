<?php

namespace Aurora\Resources;

use DoSomething\Gateway\Common\ApiResponse;

class Redirect extends ApiResponse
{
    /**
     * Create a new redirect from the given API response.
     * @param $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
}

