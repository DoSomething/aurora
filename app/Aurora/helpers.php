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
function sanitizePhoneNumber($number){
	$phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
	try {
		$number = $phoneUtil->parse($number, "US");
		return $phoneUtil->format($number, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
	}catch (\libphonenumber\NumberParseException $e) {
    Log::error($e);
		return $number;
	}
}
