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

/**
 * Create a script tag to set a global variable.
 *
 * @param $json
 * @param string $store
 * @return HtmlString
 */
function scriptify($json = [], $store = 'STATE')
{
    return new HtmlString('<script type="text/javascript">window.'.$store.' = '.json_encode($json).'</script>');
}

/**
 * Print user-friendly name from an ISO country code.
 *
 * @param  string $code
 * @return string
 */
function country_name($code)
{
    $isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
    $country = $isoCodes->getCountries()->getByAlpha2($code);

    return $country ? $country->getName() : 'Unknown';
}

/**
 * Create a "revealer" toggle for sensitive fields.
 */
function revealer(...$fields)
{
    $query = request()->query('include');
    $currentIncludes = $query ? explode(',', $query) : [];

    $isActive = count(array_intersect($currentIncludes, $fields)) > 0;
    $newFields = $isActive ? array_diff($currentIncludes, $fields) : array_merge($currentIncludes, $fields);

    return new HtmlString('<a href="'.e(request()->url().'?include='.implode(',', $newFields)).'" class="reveal '.($isActive ? 'is-active' : '').'" data-turbolinks-action="replace" data-turbolinks-scroll="false"><span>reveal</span></a>');
}
