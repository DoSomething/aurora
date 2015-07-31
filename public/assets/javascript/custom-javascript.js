function auto_open_modal()
{
		$(document).ready(function () {
		window.DSModal.open($("#signin-modal"));
		});
}

function add_class_to_first_result()
{
	$(document).ready(function () {
		$('.results').first().addClass('first-result').prepend('<h3>This appears to be the most recent user!</h3>')
	});
}
//
function ajax_edit_merge_form()
{
	$(document).ready(function(){
		$('.merge').click(function(){
			var keep = $(this).val();
			var delete_ids = [];
			$("[type=radio]").each(function(index, radio){
				if(radio.checked != true){
					delete_ids.push(radio.value);
				}
			});
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
	});
}

function ajax_confirm_and_delete()
{
	$(document).ready(function(){
	  $('form').submit(function(e){
	    var delete_ids = [];
	    $("[type=radio]").each(function(index, radio){
	      if(radio.checked != true){
	        delete_ids.push(radio.value);
	      }
	    });
	    var choice = confirm('CAUTION! This will delete other users that were not specified. Are you sure you want to proceed?');
	    if (choice === true) {
	      $.ajax({
	        url: '/merge',
	        method: 'POST',
	        data: {
	          delete: delete_ids
	        }
	      })
	      return true;
	    }
	    return false;
	  });
	})
}

function markField(tag)
{
	return '$(`input[name=${tag}]`).addClass("has-error")';
}
