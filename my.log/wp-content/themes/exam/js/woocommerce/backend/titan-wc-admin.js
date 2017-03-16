jQuery(document).ready(function( $ ) {
	// auto checked review checked box
	if(jQuery('.reviews #comment_status').length){
	    jQuery('.reviews #comment_status').prop('checked', true);
	}
	// checked if sale input field has value
//	if(jQuery("input[name*='save']").length) {
//	
//		jQuery("input[name*='save']").click(function(){
//			
//			if(jQuery("input[name*='_sale_price']").length){
//				if(jQuery("input[name*='_sale_price']").val()!="") {
//					change_sale_cat_checked(true);
//				} else {
//					change_sale_cat_checked(false);	
//				}
//			} else if(jQuery("input[name*='_sale_price']").length){
//				jQuery.each( jQuery("input[name*='variable_sale_price']"), function( i, val ) {
//					if(jQuery(this).val()!="") {
//						change_sale_cat_checked(true);
//					} else {
//						change_sale_cat_checked(false);	
//					}
//				});
//				
//			}
//		});
//	}
});
// checked the sale category if sale fiedl has value
function change_sale_cat_checked(is_checked) {
	jQuery.each( jQuery('ul#product_catchecklist li'), function( i, val ) {
		 if(jQuery.trim(jQuery(this).find('label').text().toLowerCase())=="sale" || jQuery.trim(jQuery(this).find('label').text().toLowerCase())=="specials" ){
			 if(is_checked) {
				 jQuery(this).find('input').attr('checked','checked');
			 } else {
				 jQuery(this).find('input').removeAttr('checked');
			 }
				 
		 }
	});
}

