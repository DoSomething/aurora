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