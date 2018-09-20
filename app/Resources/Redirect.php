<?php

namespace Aurora\Resources;

use Carbon\Carbon;
use DoSomething\Gateway\Common\ApiResponse;

class Redirect extends ApiResponse
{
    /**
     * Create a new redirect from the given API response.
     * @param $attributes
     */
    public function __construct($attributes)
    {
        if ($attributes instanceof self) {
            $attributes = $attributes->attributes;
        }

        parent::__construct($attributes);
    }

    /**
     * Create a new redirect from the corresponding Fastly
     * dictionary items (redirect & status key/value pairs).
     * @param $attributes
     */
    public static function fromItems($redirect, $type)
    {
        return new static([
            'id' => self::encodeId($redirect),
            'path' => $redirect['item_key'],
            'target' => $redirect['item_value'],
            'status' => $type['item_value'],
            'updated_at' => array_get($redirect, 'updated_at', Carbon::now()), // not returned from updates.
            'created_at' => array_get($redirect, 'updated_at', Carbon::now()), // not returned from updates.
        ]);
    }

    /**
     * Encode the redirect key to be URL-safe.
     *
     * @param string $redirect
     * @return string
     */
    public static function encodeId($redirect)
    {
        // In order to use these in URLs (like /redirects/:id), we need to
        // make them URL-safe. We first base64-encode the path, and then
        // replace any slashes with underscores.
        return str_replace('/', '_', base64_encode($redirect['item_key']));
    }

    /**
     * Decode the ID into a Fastly item key.
     *
     * @param string $redirect
     * @return string
     */
    public static function decodeId($id)
    {
        return urlencode(base64_decode(str_replace('_', '/', $id)));
    }
}
