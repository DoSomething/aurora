function auto_open_modal()
{
	$(document).ready(function () {
		window.DSModal.open($("#signin-modal"));
	});
}

function get_delete_ids()
{
	var delete_ids = [];
	$("[type=radio]").each(function(index, radio){
	  if(radio.checked != true){
	    delete_ids.push(radio.value);
	  }
	});
	return delete_ids;
}

function ajax_edit_merge_form()
{
	$('.js-keep').click(function(){
		var keep = $(this).val();
		var delete_ids = get_delete_ids();
		$.ajax({
			url: '/merge',
			method: 'GET',
			data: {
				keep: keep,
				delete: delete_ids
			}
		}).done(function(view){
			$('#merge-form').html(view);
			$('html, body').animate({
				scrollTop: $('#merge-form').offset().top
			}, 800);
		});
	});
}

function confirm_submit(message, func)
{
  $('form').submit(function(){
		var choice = confirm(message);
		if (choice == true) {
			func();
			return true;
		}
		return false;
	});
}

function ajax_delete_unmerged_users(){
	$.ajax({
    url: '/merge',
    method: 'POST',
    data: {
      delete: get_delete_ids()
    }
  });
}










