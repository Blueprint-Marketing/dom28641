<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(window).load(function(){
   setTimeout(function() {
    jQuery(".input-checkbox").change(function(){
          console.log(jQuery('.input-checkbox:checked').length);
          if (jQuery('.input-checkbox:checked').length != jQuery('.input-checkbox').length) {
             jQuery('.place-order .button').removeAttr('id');
          }
      });
    }, 2000);
});</script>
<!-- end Simple Custom CSS and JS -->
