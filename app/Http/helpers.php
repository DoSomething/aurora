<?php

// Global helper functions.

/**
 * Format time from given into US eastern time zone (ET)
 *
 * @param Date in Coordinated Universal Time(UTC) time format
 * @return Date in ET format
 */
function time_formatter($date)
{
    $date = date_create($date);

    $date->setTimeZone(new DateTimeZone('America/New_York'));

    return date_format($date, 'Y-m-d h:ia');
}

/**
 * To modify message backlogs container css background color
 * by checking given string
 *
 * @param string message status
 * @return string to modify html class
 */
function message_state_class($status)
{
    if ($status == 'sent') {
        echo 'is-sent';
    } elseif ($status == 'failed_permanently') {
        echo 'is-failed';
    } else {
        echo 'is-received';
    }
}

/**
 * Modify phone number given into the the origin country format
 * https://github.com/giggsey/libphonenumber-for-php
 *
 * @param string number
 * @param string country name(set to US by default)
 * @return string of formatted phone number
 */
function sanitize_phone_number($number, $countryName = 'US')
{
    $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    try {
        $formattedNumber = $phoneUtil->parse($number, $countryName);

        return $phoneUtil->format($formattedNumber, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
    } catch (\libphonenumber\NumberParseException $e) {
        Log::error($e);

        return $number;
    }
}

/**
 * When duplicate users occur, this function is called to add a class to html
 * markup
 *
 * @param array duplite users
 * @param array most recent user
 * @return string to modify html class
 */
function add_class_to_first_result($arr, $ele)
{
    if ($ele == reset($arr)) {
        return 'first-result';
    }
}

/**
 * To modify tickets container css background color
 * by checking given string
 *
 * @param string message status
 * @return string to modify html class
 */
function ticket_state_class($status)
{
    if ($status == 'closed') {
        echo 'is-closed';
    } elseif ($status == 'open') {
        echo 'is-open';
    } else {
        echo 'is-pending';
    }
}

/**
 * To Check input type and return an array
 * of user attribute possibility
 *
 * @param string search input
 * @return array k=>v
 */
function param_builder($input)
{
    $query = [];
    $name = explode(' ', $input);
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        $query['email'] = $input;
    } elseif (strlen((string) intval($input)) >= 10) {
        $query['mobile'] = $input;
    } elseif (strlen((string) intval($input)) !== 1 && strlen((string) intval($input)) <= 8) {
        $query['drupal_id'] = $input;
    } elseif (ctype_alpha($input)) {
        $query['first_name'] = $input;
    } elseif (count($name) === 2) {
        $query['first_name'] = $name[0];
        $query['last_name'] = $name[1];
    }

    return $query;
}

function check_if_email_or_mobile($query)
{
    if (key($query) == 'email' || key($query) == 'mobile') {
        return true;
    } else {
        return false;
    }
}

function duplicate_user_check($array)
{
    foreach ($array as $element) {
        if ($element['email'] == next($array)['email']) {
            return true;
        } elseif ($element['mobile'] == next($array)['mobile']) {
            return true;
        }
    }
}
// ended up not needing this function but going to leave it incase we do someday
function calculate_age_from_birthdate($birthdate)
{
    $birthdate = preg_replace('/\s.+/', '', $birthdate);
    $from = new DateTime($birthdate);
    $to = new DateTime('today');

    return $from->diff($to)->y;
}
