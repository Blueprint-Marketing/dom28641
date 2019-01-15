<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("div.learndash-course-certificate a").removeAttr("target").removeAttr("href");
  jQuery("div.learndash-course-certificate a").click(function() {
      jQuery("div.certificate a div").click();
   });
});

</script>
<!-- end Simple Custom CSS and JS -->
