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

function sanitizePhoneNumber($number){
	$number = preg_replace('/[^0-9]/', '', $number);
	$number = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $number);
	return $number;
}
