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

function find_diff_tags($array, $delete_user, $keep_user)
{
  foreach($delete_user as $k => $v){
    if(empty($keep_user[$k]) && !in_array($k, $array)){
      array_push($array, $k);
    }elseif(!empty($keep_user[$k])&& $keep_user[$k] != $delete_user[$k]){
      array_push($array, $k);
    }
  }
  foreach($keep_user as $k => $v){
    if(empty($delete_user[$k]) && !in_array($k, $array)){
      array_push($array, $k);
    }elseif(!empty($delete_user[$k]) && $keep_user[$k] != $delete_user[$k]){
      array_push($array, $k);
    }
  }
  return $array;
}
