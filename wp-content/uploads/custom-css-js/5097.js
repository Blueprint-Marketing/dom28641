<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery(".label-wrapp div:nth-child(2)").click(function(){
     jQuery('html, body').animate({
       scrollTop: jQuery("#usa-html5-map-map-container_0").offset().top
     }, 1500);
    });
});

jQuery(document).ready(function(){
  jQuery('#usa-html5-map-map-container_0').click(function(){
    jQuery(this).data('clicked', true);
    jQuery(".label-wrapp div:nth-child(3) span.tooltiptext").remove();
    jQuery(".label-wrapp div:nth-child(4) span.tooltiptext").text("Please click Register");
    jQuery(".label-wrapp div:nth-child(3) p.red-round").css("background-color","#0088aa");
	jQuery(".label-wrapp div:nth-child(3) p.red-round").css("border","7px solid #00bdd0");
  });

  jQuery(".label-wrapp div:nth-child(3),.label-wrapp div:nth-child(4)").click(function(){
      if(jQuery('#usa-html5-map-map-container_0').data('clicked')) {
           jQuery('html, body').animate({
             scrollTop: jQuery("#usa-html5-map-state-info_1").offset().top
           }, 1500);
      } else {

      }
  });
});

</script>
<!-- end Simple Custom CSS and JS -->
