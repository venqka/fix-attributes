
jQuery(document).ready(function(){

	// console.log(fa_ajax.ajax_url);
	jQuery('#fa-trigger').click(function(){
		
		jQuery.ajax({
        	url: fa_ajax.ajax_url,
        	type: 'POST',
        	data: {
				action: 'fix_attributes'
	        },
	        success : function(op) {
	        	console.log(op);
	        	jQuery('.response').html(op.data);
	        },
	        error : function(error) {
				console.log(error);
			}
		});		
	
	});
	
});