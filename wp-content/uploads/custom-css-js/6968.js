<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/*window.onload = function() {
	setTimeout(function() {
      jQuery('input[type="checkbox"]').change(function(){
          console.log("asasas");
       });
	}, 3000);
};*/
jQuery(window).load(function(){
   setTimeout(function() {
      jQuery(".input-checkbox").change(function(){
          if (jQuery('.input-checkbox:checked').length != jQuery('.input-checkbox').length) {
              jQuery('.place-order .button').removeAttr('id');
              jQuery('.place-order .button').css('margin-top','20px');
          }else{
              jQuery('.place-order .button').attr('id','place_order');
          }
      });
   }, 2000);
});</script>
<!-- end Simple Custom CSS and JS -->
