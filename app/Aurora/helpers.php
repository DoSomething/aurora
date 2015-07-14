<?php
// Global helper functions.
function autoOpenModal(){
	return
	'<script>
	$(document).ready(function () {
	window.DSModal.open($("#signin-modal"));
	});
	</script>';
}

//https://github.com/giggsey/libphonenumber-for-php
function sanitizePhoneNumber($number, $countryName){
	if(!$countryName){
		$countryName = "US";
		//checking if country code is found, if not will just be US as default
	}
	$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
	try {
		$number = $phoneUtil->parse($number, $countryName);
		return $phoneUtil->format($number, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
	}catch (\libphonenumber\NumberParseException $e) {
    Log::error($e);
		return $number;
	}
}
