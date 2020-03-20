
jQuery(document).ready(function(){
	
	jQuery(".destaque_check").click ( function (e) {
		
		e.preventDefault();
		
		var data = {
			action: 'destaque_action',
			post_id: jQuery(this).find(".post_id").val()
		}
		
		jQuery.post(ajaxurl, data, function(response) {			
			if (response.status == "ok") {				
				if ( response.acao == "removido" ) {
					jQuery('.destaque_check input[value="' + response.id + '"]').parent().removeClass("destaque_home");
				} else {
					jQuery('.destaque_check input[value="' + response.id + '"]').parent().addClass("destaque_home");
				}				 
			}			
		}, 'json');
		
	});
	
});
