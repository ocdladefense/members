define([], function(){

	
	var handler = function(fn){
	
		return function(){
			var $id, $content;

			$id = $(this).prop('id');
			$('.form-section-label').removeClass('form-section-label-active');
			$('.form-section-label').addClass('form-section-label-inactive');
			$('#'+$id).parent().removeClass('form-section-label-inactive');
			$('#'+$id).parent().addClass('form-section-label-active');
			if("donate-online" == $id) {
				window.location.reload();
			}
			console.log($id);
			// donate-page-container
			$content = fn($id);
			$('#donate-page-container').html($content);
	
			return false;
		};
	};
	


	return {
		setupHandler: handler 
	};

	
});