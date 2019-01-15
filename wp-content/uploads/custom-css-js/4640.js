<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function(){

  if (top.location.pathname === '/courses/food-handler-certificate-program/')
  {
      jQuery("table.certificates_list tbody tr th:nth-child(3)").attr("id","valid");
      jQuery("table.certificates_list tbody tr th:nth-child(3)").css("display", "block");

      var href = jQuery(".certificate a").attr('href');

      function parseQueryString( queryString ) {
          var params = {}, queries, temp, i, l;
          // Split into key/value pairs
          queries = queryString.split("&");
          // Convert the array of strings into an object
          for ( i = 0, l = queries.length; i < l; i++ ) {
              temp = queries[i].split('=');
              params[temp[0]] = temp[1];
          }
          return params;
      };
      var querystring = parseQueryString(href);
      var stamp = parseInt(querystring.time);
      var timestamp = stamp;
      var d = new Date(timestamp * 1000);
      var year = d.getFullYear();
      var month = d.getMonth();
      var day = d.getDate();
      var validity = new Date(year + 3, month, day);
      var get_validity = validity.toDateString();

      document.getElementById('valid').innerHTML = get_validity;
  }
});
</script>
<!-- end Simple Custom CSS and JS -->
