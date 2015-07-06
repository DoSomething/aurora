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