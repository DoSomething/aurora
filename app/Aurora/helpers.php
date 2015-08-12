<?php
// Global helper functions.

function time_formatter($date)
{
  $date = date_create($date);

  $date->setTimeZone(new DateTimeZone('America/New_York'));

  return date_format($date, 'Y-m-d h:ia');
}

function message_state_class($message)
{
	if ($message == "sent") {
		echo 'is-sent';
	} elseif ($message == "failed_permanently"){
		echo 'is-failed';
	} else{
		echo 'is-received';
	}
}

//https://github.com/giggsey/libphonenumber-for-php
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

function add_class_to_first_result($arr, $ele)
{
	if ($ele == reset($arr)){
		return "first-result";
	}
}

function ticket_state_class($message)
{
	if ($message == "closed") {
		echo 'is-closed';
	} elseif ($message == "open"){
		echo 'is-open';
	} else{
		echo 'is-pending';
	}
}

function type_detection($input)
{
  $query = [];
  $name = explode(' ', $input);
  if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
    $query['email'] = $input;
  } elseif (strlen((string)intval($input)) >= 10) { //filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    $query['mobile'] = $input;
  } else if (strlen((string)intval($input)) !== 1 && strlen((string)intval($input)) <= 10) {
    $query['drupal_id'] = $input;
  } else if (ctype_alpha($input)) {
    $query['first_name'] = $input;
  } else if (count($name) === 2) {
    $query['first_name'] = $name[0];
    $query['last_name'] = $name[1];
  }
  return $query;
}
