<?php

namespace Aurora\Resources;

use JsonSerializable;
use DoSomething\Gateway\Common\ApiCollection;

class RedirectCollection extends ApiCollection implements JsonSerializable
{
    public function __construct($response)
    {
        parent::__construct($response, Redirect::class);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
