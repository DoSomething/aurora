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
function sanitizePhoneNumber($number, $countryName = 'US'){
	$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
	try {
		$formattedNumber = $phoneUtil->parse($number, $countryName);
		return $phoneUtil->format($formattedNumber, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
	}catch (\libphonenumber\NumberParseException $e) {
    Log::error($e);
		return $number;
	}
}
