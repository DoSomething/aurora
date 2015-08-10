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
 * @param String message status
 * @return String to modify html class
 */
function message_state_class($status)
{
	if ($status == "sent") {
		echo 'is-sent';
	} elseif ($status == "failed_permanently"){
		echo 'is-failed';
	} else{
		echo 'is-received';
	}
}


/**
 * Modify phone number given into the the origin country format
 * https://github.com/giggsey/libphonenumber-for-php
 *
 * @param String number
 * @param String country name(set to US by default)
 * @return String of formatted phone number
 */
function sanitize_phone_number($number, $countryName = 'US')
{
	$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
	try {
		$formattedNumber = $phoneUtil->parse($number, $countryName);
		return $phoneUtil->format($formattedNumber, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
	}catch (\libphonenumber\NumberParseException $e) {
    Log::error($e);
		return $number;
	}
}


/**
 * When duplicate users occur, this function is called to add a class to html
 * markup
 *
 * @param Array duplite users
 * @param Array most recent user
 * @return String to modify html class
 */
function add_class_to_first_result($arr, $ele)
{
	if ($ele == reset($arr)){
		return "first-result";
	}
}


/**
 * To modify tickets container css background color
 * by checking given string
 *
 * @param String message status
 * @return String to modify html class
 */
function ticket_state_class($status)
{
	if ($status == "closed") {
		echo 'is-closed';
	} elseif ($status == "open"){
		echo 'is-open';
	} else{
		echo 'is-pending';
	}
}
