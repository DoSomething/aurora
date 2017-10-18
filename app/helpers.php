<?php

use Illuminate\Support\HtmlString;

/**
 * Turn the given array of strings into a CSV.
 *
 * @param string[] $array
 * @return string
 */
function array_to_csv(array $array)
{
    return implode(', ', $array);
}

/**
 * Turn the given CSV string into an array.
 *
 * @param string $string
 * @return array
 */
function csv_to_array($string)
{
    return array_map('trim', explode(',', $string));
}

/**
 * Format a string of Markdown into HTML.
 *
 * @param $source
 * @return string
 */
function markdown($source)
{
    $parsedown = Parsedown::instance();
    $markup = $parsedown->setMarkupEscaped(true)->text($source);

    return new HtmlString($markup);
}

/**
 * Get an item from the cache, or store the default value.
 *
 * @param  string  $key
 * @param  \DateTime|float|int  $minutes
 * @param  \Closure  $callback
 * @return mixed
 */
function remember($key, $minutes, Closure $callback)
{
    return app('cache')->remember($key, $minutes, $callback);
}
