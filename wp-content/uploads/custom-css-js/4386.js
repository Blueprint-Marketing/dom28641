<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery( document ).ajaxComplete(function( event, request, settings ) {
  jQuery(".input-text.qty.text").change(function(){
		var qunntity = jQuery(this).val() ;
		
		if(qunntity >= 19){
  			jQuery(".half").show();
 		 }
		 if(qunntity <= 19){
  			jQuery(".half").hide();
 		 }
	});
});

</script>
<!-- end Simple Custom CSS and JS -->
