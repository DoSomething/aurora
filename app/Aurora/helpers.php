<?php
// Global helper functions.
function autoOpenModal(){
echo
'<script>
$(document).ready(function () {
window.DSModal.open($("#signin-modal"));
});
</script>';
}

function keySantizer($key){
$key = str_replace("_"," ", $key);
$key = preg_replace('/^\s/',"", $key);
$key = ucfirst(preg_replace('/addr /',"", $key));
return $key;
}
