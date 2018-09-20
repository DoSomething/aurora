<?php

namespace Aurora\Resources;

use DoSomething\Gateway\Common\ApiCollection;

class RedirectCollection extends ApiCollection
{
    public function __construct($response)
    {
        parent::__construct($response, Redirect::class);
    }
}
