<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet      
// =============================================================================

// add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );



// Additional Functions
// =============================================================================

   
   
        
add_action('wp_ajax_nopriv_send_email_call', 'send_email_call');
	add_action('wp_ajax_send_email_call', 'send_email_call');
	
	function send_email_call(){
// if(isset($_POST['send_email_call'])){
			
		     
			global $wpdb;
	$user = wp_get_current_user();
	$user_id = $user->ID;			
	$result1 = $wpdb->get_results (
	            "
	            SELECT activity_id,activity_started,activity_completed,user_id
	            FROM  wp_learndash_user_activity 
	            WHERE user_id =  {$user_id}
	            AND activity_type = 'quiz' 
	            "
	            );

	$array = '';

	foreach ($result1 as $value){
    $array = $array.",{$value->activity_id}";
	}

	
	$array = substr($array, 1);

	
	$result = $wpdb->get_results (
	            "
	            SELECT * 
	            FROM  wp_learndash_user_activity_meta 
	            WHERE activity_id  IN ({$array}) 
	            AND activity_meta_key IN ('points','total_points' ,'started' , 'completed', 'percentage', 'course' ,'quiz')
	           
	            "
	            );

	
	$array1 = json_decode(json_encode($result), True);
	$length1 = count($array1);

	
	$oldid = "";
	for ($x = 0; $x < $length1; $x++) {
		$newid = $array1[$x]['activity_id'];
		if($newid != $oldid){
			$oldid = $newid;
			$newarrid[] = array($oldid);
		}
	}
	for ($x = 0; $x < sizeof($newarrid); $x++) {
		$points = "";
		$total_points = "";
		$started = "";
		$completed = "";
		$percentage = "";
		$course = "";
		$quiz = "";
		for ($y = 0; $y < $length1; $y++) {
			$actid = $array1[$y]['activity_id'];
			
			if ($actid == $newarrid[$x][0]) {
				if($array1[$y]['activity_meta_key'] == 'points'){
					$points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'total_points'){
					$total_points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'started'){
					$started = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'completed'){
					$completed = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'percentage'){
					$percentage = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'course'){
					$course = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'quiz'){
					$quiz = $array1[$y]['activity_meta_value'];
				}
			}
		}
		$newarr_email[] = array($points,$total_points,$percentage,$started,$completed,$quiz,$course);
	}
	$newarr_email = json_encode($newarr_email);
	
	
	
	?>

	<input class="show" type="text" value="">
	<?php
	 
	  
			die();
	}
   
   
function x_boot() {

  // Define Path / URL Constants
  // ---------------------------

  define( 'X_TEMPLATE_PATH', get_template_directory() );
  define( 'X_TEMPLATE_URL', get_template_directory_uri() );


  // Set Paths
  // ---------

  $load_path = X_TEMPLATE_PATH . '/framework/load';
  $func_path = X_TEMPLATE_PATH . '/framework/functions';
  $glob_path = X_TEMPLATE_PATH . '/framework/functions/global';
  $admn_path = X_TEMPLATE_PATH . '/framework/functions/global/admin';
  $lgcy_path = X_TEMPLATE_PATH . '/framework/legacy';
  $eque_path = X_TEMPLATE_PATH . '/framework/functions/global/enqueue';
  $plgn_path = X_TEMPLATE_PATH . '/framework/functions/global/plugins';
  $globalquantity;

  // Preboot
  // -------

  $x_boot_files = glob( "$load_path/*.php" );

  sort( $x_boot_files );

  foreach ( $x_boot_files as $filename ) {
    $file = basename( $filename, '.php' );
    if ( file_exists( $filename ) && apply_filters( "x_pre_boot_$file", '__return_true' ) ) {
      require_once( $filename );
    }
  }


  // Set Asset Revision Constant (For Cache Busting)
  // -----------------------------------------------

  define( 'X_ASSET_REV', X_VERSION );


  // Require Files
  // -------------

  $require_files = apply_filters( 'x_boot_files', array(

    $glob_path . '/debug.php',
    $glob_path . '/conditionals.php',
    $glob_path . '/helpers.php',
    $glob_path . '/stack-data.php',
    $glob_path . '/tco-setup.php',

    $admn_path . '/thumbnails/setup.php',
    $admn_path . '/setup.php',
    $admn_path . '/meta/setup.php',
    $admn_path . '/sidebars.php',
    $admn_path . '/widgets.php',
    $admn_path . '/custom-post-types.php',
    $admn_path . '/cs-options/setup.php',
    $admn_path . '/customizer/setup.php',
    $admn_path . '/addons/setup.php',

    $lgcy_path . '/setup.php',

    $eque_path . '/styles.php',
    $eque_path . '/scripts.php',

    $glob_path . '/class-view-routing.php',
    $glob_path . '/class-action-defer.php',
    $glob_path . '/meta.php',
    $glob_path . '/featured.php',
    $glob_path . '/pagination.php',
    $glob_path . '/breadcrumbs.php',
    $glob_path . '/classes.php',	
    $glob_path . '/portfolio.php',
    $glob_path . '/social.php',
    $glob_path . '/content.php',
    $glob_path . '/remove.php',

    $func_path . '/integrity.php',
    $func_path . '/renew.php',
    $func_path . '/icon.php',
    $func_path . '/ethos.php',

    $plgn_path . '/setup.php'

  ));

  foreach ( $require_files as $filename ) {
    if ( file_exists( $filename ) ) {
      require_once( $filename );
    }
  }

}

x_boot();


/* start */






/**
 * Enqueue scripts and styles.
 */

function sparkling_scripts() {

  // Add Bootstrap default CSS
  wp_enqueue_style( 'sparkling-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );

  // Add Font Awesome stylesheet
  wp_enqueue_style( 'sparkling-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css' );

  // Add Google Fonts
  wp_register_style( 'sparkling-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700|Roboto+Slab:400,300,700');

  wp_enqueue_style( 'sparkling-fonts' );

  // Add slider CSS only if is front page ans slider is enabled
 /*   if( ( is_home() || is_front_page() ) && of_get_option('sparkling_slider_checkbox') == 1 ) {
    wp_enqueue_style( 'flexslider-css', get_template_directory_uri().'/inc/css/flexslider.css' );
  }  */

  // Add main theme stylesheet
  wp_enqueue_style( 'sparkling-style', get_stylesheet_uri() );

  // Add Modernizr for better HTML5 and CSS3 support
  wp_enqueue_script('sparkling-modernizr', get_template_directory_uri().'/inc/js/modernizr.min.js', array('jquery') );

  // Add Bootstrap default JS
  wp_enqueue_script('sparkling-bootstrapjs', get_template_directory_uri().'/inc/js/bootstrap.min.js', array('jquery') );

/*   if( ( is_home() || is_front_page() ) && of_get_option('sparkling_slider_checkbox') == 1 ) {
    // Add slider JS only if is front page ans slider is enabled
    wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/inc/js/flexslider.min.js', array('jquery'), '20140222', true );
    // Flexslider customization
    wp_enqueue_script( 'flexslider-customization', get_template_directory_uri() . '/inc/js/flexslider-custom.js', array('jquery', 'flexslider-js'), '20140716', true );
  } */

  // Main theme related functions
  wp_enqueue_script( 'sparkling-functions', get_template_directory_uri() . '/inc/js/functions.min.js', array('jquery') );

  // This one is for accessibility
  wp_enqueue_script( 'sparkling-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20140222', true );

  // Treaded comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
  if($post->ID == 181){
	  // jQuery Slim.Min
	  wp_enqueue_script('sparkling-slim-min', 'https://code.jquery.com/jquery-3.1.1.slim.min.js', array('jquery') );
	}
  // jQuery custom-js
  wp_enqueue_script('sparkling-imgtoblob', get_template_directory_uri() . '/inc/js/img2blob.js', array('jquery') );
  
  // jQuery custom-js
  wp_enqueue_script('sparkling-custom-js', get_template_directory_uri() . '/inc/js/custom-js.js', array(), '20140222', true );
  
  // Style style-custom
  wp_enqueue_style( 'sparkling-custom-css', get_template_directory_uri().'/inc/style-custom.css' );
  
}
add_action( 'wp_enqueue_scripts', 'sparkling_scripts' );




/* end */

// Add scripts to wp_head()
function child_theme_head_script() { ?>
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <script>
jQuery(document).ready(function(){
   jQuery("img#Image_pop").attr("onclick", "document.getElementById('id01').style.display='block'");
});
</script>
<link href="https://fonts.googleapis.com/css?family=Lato|Oswald" rel="stylesheet">

<script>
	jQuery( document ).ready(function() {
		jQuery("input[name='endQuizSummary']").click(function() {
		  jQuery("div#audEx").css("display","none");
		});
	});
</script>
<script>
	jQuery( document ).ready(function() {
		jQuery("input[value='Start Exam']").click(function() {
		  jQuery("div#audEx").css("display","block");  
		});
	});
</script>
<script>
jQuery(document).ready(function() {
 jQuery("div.learndash input,div.learndash li").click(function() {
   var exam_length = jQuery(".wpProQuiz_reviewQuestion ol").children('li').length;;
   var complete_lenght= jQuery(".wpProQuiz_reviewQuestionSolved").length

    if (complete_lenght >= (exam_length-1)) {
   jQuery('input[value="Exam-summary"]').removeAttr("disabled");
   jQuery('input[value="Exam-summary"]').show();
     }
    else{
   jQuery('input[value="Exam-summary"]').attr("disabled", "disabled");
  jQuery('input[value="Exam-summary"]').hide();  
     }
 });
}); 
 </script>
<script>
jQuery(document).ready(function(){
        jQuery("<a href='https://foodhandlersolutions.com/courses/food-handler-certificate-program/' class='str_btn'>Start the Exam</a>").insertAfter("section.woocommerce-customer-details address");
});
</script>
<script>
jQuery(document).ready(function(){
        jQuery("<a href='https://foodhandlersolutions.com/courses/food-handler-certificate-program/' class='my_btn2' style='width: 150px; outline: none;'>My Profile</a>").insertAfter("p#learndash_already_taken");
});
</script>
<script>
jQuery(document).ready(function(){
	jQuery( "#learndash_already_taken" ).parent().find("#audEx:first-child").css( "display", "none" );
});


jQuery(window).load(function(){
   function show_popup(){
     jQuery("input.qty").removeAttr("title");
   };
   window.setTimeout( show_popup, 3000 ); // 5 seconds
})


</script>

<script>
 function GetURLParameter(elem) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == elem)
            {
                return decodeURIComponent(sParameterName[1]);
            }
        }
    }

       //  var url_param_userID = GetURLParameter('user');
		 
</script>

<script>
jQuery(document).ready(function(){ 
	jQuery('.page-id-202 .learndash-course-certificate a').attr('href','');
	jQuery('.page-id-202 .learndash-course-certificate a').addClass("first");
	jQuery('a.first').click(function(){
		jQuery("div.certificate_icon").click();
	})
}); 

jQuery( document ).ready(function() {
  	jQuery(".profile_edit_profile a").attr("href", "https://foodhandlersolutions.com/edit-profile/");
}); 
 
 
</script>

<script>
jQuery( document ).ready(function() {
	jQuery(".page-id-2845 input[name=first_name]").prop('disabled', true);
	jQuery(".page-id-2845 input[name=last_name]").prop('disabled', true);
}); 
</script>

<script>
jQuery(document).ready(function(){ 
	jQuery('.postid-178 a.btn-blue').attr('href','');

	jQuery('.postid-178 a.btn-blue').addClass("first");
	jQuery('a.first').click(function(){
		jQuery("div.certificate_icon").click();
	})
});
</script>

<?php }
add_action( 'wp_head', 'child_theme_head_script' );
add_action( 'wp_footer', 'child_theme_footer_script' );
function child_theme_footer_script(){
	
	?>
	 <script>
 function printDiv() {
    var divToPrint = document.getElementById('DivIdToPrint');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
 newWin.document.write("<html><body onload='window.print();'><link rel='stylesheet' href='https://foodhandlersolutions.com/wp-content/themes/x/print.css' type='text/css' media='print' />" + divToPrint.innerHTML + "</body></html>");
    newWin.document.close();
    setTimeout(function() {
        newWin.close()
    }, 1000)
}
</script>

<?php
	
}
/* START MI SHORTCODE */

function RME_exp_date( $atts, $content = null ) {
	//$dateString = $atts['rmedatetime'];
	$dateString = do_shortcode( '[datetoday]');
	$dt = new DateTime($dateString);
	$dt->modify('+3 years');
	ob_start();
	return $dt->format('F j, Y');
}
add_shortcode( 'RME_exp_date', 'RME_exp_date' );
function displayTodaysDate( $atts ){
 
return date(get_option('date_format'));
 
}
 
 

 
add_shortcode( 'datetoday', 'displayTodaysDate');

/* END MI SHORTCODE */   


 function info_certi_shortcode( $atts, $content = null ) {
	$data = null;
	  if($_GET['user'] && $atts['info'] == "name")
	 {
		  $user_info = get_userdata($_GET['user']);
		  $username = $user_info->user_login;
		  $first_name = $user_info->first_name;
		  $last_name = $user_info->last_name;
		 $data = $first_name . " " . $last_name;
	 }
	  if(!$_GET['user'] && $atts['info'] == "name")
	  {
		  $current_user_id = get_current_user_id();
		   $user_info = get_userdata($current_user_id);
		  $username = $user_info->user_login;
		  $first_name = $user_info->first_name;
		  $last_name = $user_info->last_name;
		 $data = $first_name . " " . $last_name;
	  }
	 if($_GET['time'] && $atts['info'] == "issue_date")
	 {
		  $exam_date = $_GET['time'];
		  
		 $data = date('F j, Y', $exam_date);
	 }
	 if($_GET['time'] && $atts['info'] == "exp_date")
	 {
		  $exam_date = $_GET['time'];
		  
		 $data = date('F j, Y',strtotime("+3 year",$exam_date));;
		
	 }
	 if($_GET['user'] && $atts['info'] == "cert_num")
	 {
		
		 $data = $_GET['user'];
		
	 }
	 if(!$_GET['user'] && $atts['info'] == "cert_num")
	 {
		 $current_user_id = get_current_user_id();
		 
		 $data = $current_user_id;
		
	 }
	return  $data;
}
add_shortcode( 'info_exam_cert', 'info_certi_shortcode' );


function img2blob() {
 
wp_register_script('my_amazing_script',"https://foodhandlersolutions.com/wp-content/themes/x/inc/js/img2blob.js", array('jquery'),'1.1', true);
 
wp_enqueue_script('my_amazing_script');
}
  
add_action( 'wp_enqueue_scripts', 'img2blob' ); 





function wp_when_logged_in() {
    if ( is_user_logged_in() ) {
		?>
		  <style>
			h2.ld-entry-title.entry-title{
			 display: block !important;
			}
		  </style>
	   <?php		
        
    } else {
		?>
		  <style>
			h2.ld-entry-title.entry-title{
			 display: none !important;
			}
		  </style>
	   <?php
    }
}

add_action('in_admin_footer','custom_admin_headder_script');
function custom_admin_headder_script(){
	echo '<script>
	jQuery("div#quiz_progress_details p a").each(function(){ 
           var oldUrl = jQuery(this).attr("href"); // Get current url
            var newUrl = oldUrl.replace("cert-nonce", "certnonce");
			
			jQuery(this).attr("href", newUrl);
        });
</script>';
}
add_action( 'loop_start', 'wp_when_logged_in' );

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
wp_redirect( 'https://foodhandlersolutions.com/log-in/');
exit();
}


// hide coupon field on cart page
function hide_coupon_field_on_cart( $enabled ) {
	if ( is_cart() ) {
		$enabled = false;
	}
	return $enabled;
}

//////////////////////

// Restrict if user exceed to 100

/* add_action('wp_head','get_cart_sample');
function get_cart_sample()
{
	if(is_cart()){
   foreach ( WC()->cart->get_cart() as $cart_item ) {
	   $item_name = $cart_item['data']->get_title();
	   $quantity = $cart_item['quantity'];
	   $price = $cart_item['data']->get_price();
	   if($quantity >= 101)
	   {
		    add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );
			add_filter( 'woocommerce_order_item_visible', 'bbloomer_hide_hidden_product_from_order', 10, 2 );
			remove_action( 'woocommerce_proceed_to_checkout',
			'woocommerce_button_proceed_to_checkout', 20);
			?>
			<script>
			
			jQuery( document ).ready(function() {
				jQuery(".cart-collaterals").append("<div id='contact-us'><p id='title-cart'>Please contact our customer service support team for purchases which exceed 100 in quantity</p><br><a href='https://foodhandlersolutions.com/contact-us/'>Customer Service</a></div>");
			});
			</script>
			<?php
	   }
	   else{
		   ?>
		   <script>
		   jQuery( document ).ready(function() {
		    if($quantity <= 100) {
				document.getElementById('contact-us').style.display = 'none';
			} else {
			  alert('none');
			}
			});
			</script>
			<?php
		   
	   }
   }
   
 }
}*/

// Woocommerce Generate coupon


// define the woocommerce_thankyou callback 
function action_woocommerce_thankyou( $order_get_id ) { 
    // make action magic happen here... 
	
		$order = wc_get_order( $order_get_id );  
		
		$order_id = $order->id;
		$item_quantity_total = 0;
		// Iterating through each "line" items in the order
		foreach ($order->get_items() as $item_id => $item_data) {
			
			$order_date  = $order->order_date;
			$email = $order->billing_email;
			$first_name = $order->billing_first_name;
			$last_name = $order->billing_last_name;
			$city = $order->billing_city;
			$state = $order->billing_state;
			$zip = $order->billing_postcode;
			$country = $order->billing_country;
			$phone = $order->billing_phone;
			$address =$order->billing_address_1;

			// Get an instance of corresponding the WC_Product object
			$product = $item_data->get_product();
			$product_name = $product->get_name(); // Get the product name
			$id = $product->get_id();
			$item_quantity = $item_data->get_quantity(); // Get the item quantity

			$item_total = $item_data->get_total(); // Get the item line total

			// Displaying this data (to check)
			//echo 'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 );
			$item_quantity_total = $item_quantity + $item_quantity_total;
			
		} 

//




//update user access to courses

		$user = wp_get_current_user();
		$user_id = $user->ID;



		$date = new DateTime();
		$timestamp = $date->getTimestamp();



		// echo 'string'.$id;


		
		if($id == 6187  ){
		
			$updated = update_user_meta( $user_id, 'course_6212_access_from', $timestamp );

		}

		elseif ($id == 6186 || $id == 8588) {
			$updated = update_user_meta( $user_id, 'course_6219_access_from', $timestamp );

		}


		elseif ($id == 6185 || $id == 8579 || $id == 8589) {
			// echo 'string6185 <br>'.$id;
			$updated = update_user_meta( $user_id, 'course_5960_access_from', $timestamp );

			
		}


		elseif($id !== 10559){
			$updated = update_user_meta( $user_id, 'course_178_access_from', $timestamp );
		}

		
	
	
	
	
		if($id == 6185 || $id == 6186 || $id == 6187 || $id == 8579 || $id == 8588 || $id == 8589  ){


						// echo "string" . $order_date;

						$gs_body = '{"majorDimension":"ROWS", "values":[["FHS03CA001","C","","","","","","","'.$first_name.'","","'.$last_name.'","'
						.$address.'","","'.$city.'","'.$state.'","'.$zip.'","'.$country.'","","","'.$phone.'","","'.$email.'","'.$order_date.'"]]}';

						$data = '{"properties": {"title":"'.$first_name.' '.$last_name.'"}}';
						$gs_body1 = '{"majorDimension":"ROWS", "values":[["Client Code","ExamType (always C)","Exam (70 or 75)","EligibilityStartDate (leave blank)","EligibilityEndDate (leave blank)","Site(leave blank)","CandidateID(If using candidate ID also enter this number in the SSN field.)","SSN DO NOT USE (If using SSN leave CandidateID field blank.)","FirstName (required),MiddleName(optional)","LastName (required)","Address1 (required no PO Box Add business name)","Address2","City","State","Zip","Country","Maiden","DOB","Phone 1","Phone 2","Email(required)"],["FHS03CA001","C","","","","","","","'.$first_name.'","","'.$last_name.'","'
						.$address.'","","'.$city.'","'.$state.'","'.$zip.'","'.$country.'","","","'.$phone.'","","'.$email.'","'.$order_date.'"]]}';
								

						echo "<script>

						

						var gs_sid = '1lWFpGDy3ijqnYRwAM11jigTkiVPWo_3zdNheHz3xaD0'; // Enter your Google Sheet ID here
				        var gs_clid = '475896005853-8vg8rsmn7h1s4dl4a0ruj62ls8ajvveb.apps.googleusercontent.com'; // Enter your API Client ID here
				        var gs_clis = 'IIGmDk0DZ1-ieP_66XsQY4JM'; // Enter your API Client Secret here
				        var gs_rtok = '1/t9J42w5NXjFhoNFkalZg45FPDhrI3UtQ57R4Y4hX8RQ'; // Enter your OAuth Refresh Token here
						var gs_atok = false;
						var gs_url = 'https://sheets.googleapis.com/v4/spreadsheets/'+gs_sid+'/values/A1:append?includeValuesInResponse=false&insertDataOption=INSERT_ROWS&responseDateTimeRenderOption=SERIAL_NUMBER&responseValueRenderOption=FORMATTED_VALUE&valueInputOption=USER_ENTERED';
						var gs_body = '".$gs_body."';   
						var data = '".$data."'; 
						var api_key = 'AIzaSyBRHMwEeRDIEZs6IO7w6BmmjgTAb22iO8g';

						console.log(gs_body);   
						// HTTP Request Token Refresh
						var xhr = new XMLHttpRequest();
						xhr.open('POST', 'https://www.googleapis.com/oauth2/v4/token?client_id='+gs_clid+'&client_secret='+gs_clis+'&refresh_token='+gs_rtok+'&grant_type=refresh_token');
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
						xhr.onload = function() {            
						var response = JSON.parse(xhr.responseText);
						var gs_atok = response.access_token;            
						// HTTP Request Append Data

						if(gs_atok) {
						var xxhr = new XMLHttpRequest();
						xxhr.open('POST', gs_url);
						xxhr.setRequestHeader('Content-length', gs_body.length);
						xxhr.setRequestHeader('Content-type', 'application/json');
						xxhr.setRequestHeader('Authorization', 'OAuth ' + gs_atok );
						xxhr.onload = function() {
						if(xxhr.status == 200) {
						// Success
						console.log(xxhr.responseText);
						localStorage.setItem('is_spreadsheet_send','yes');
						} else {
						// Fail
						console.log(xxhr.responseText);
						}
						};
						xxhr.send(gs_body);
						}

					
 	
					
						if(gs_atok) {
						
						var xxhr = new XMLHttpRequest();
						xxhr.open('POST', 'https://sheets.googleapis.com/v4/spreadsheets?key='+api_key);
						xxhr.setRequestHeader('Content-length', gs_body.length);
						xxhr.setRequestHeader('Content-type', 'application/json');
						xxhr.setRequestHeader('Authorization', 'OAuth ' + gs_atok );
						xxhr.onload = function() {
						
						if(xxhr.status == 200) {
						// Success
						console.log(JSON.parse(	xxhr.responseText));

							gs_body = '".$gs_body1."';  
						
							xxhr.open('POST', 'https://sheets.googleapis.com/v4/spreadsheets/'+JSON.parse(xxhr.responseText).spreadsheetId+'/values/A1:append?includeValuesInResponse=false&insertDataOption=INSERT_ROWS&responseDateTimeRenderOption=SERIAL_NUMBER&responseValueRenderOption=FORMATTED_VALUE&valueInputOption=USER_ENTERED');
							xxhr.setRequestHeader('Content-length', gs_body.length);
							xxhr.setRequestHeader('Content-type', 'application/json');
							xxhr.setRequestHeader('Authorization', 'OAuth ' + gs_atok );
							xxhr.onload = function() {
							if(xxhr.status == 200) {
							// Success
							console.log(xxhr.responseText);
							
							} else {
							// Fail
							console.log(xxhr.responseText);
							}
							};
							xxhr.send(gs_body);

						
						} else {
						// Fail
						console.log(JSON.parse(xxhr.responseText));
						}
						};
						xxhr.send(data);
						}



			

						};
						xhr.send(); 

				
						</script> ";		



			$email_body = "<p></p>
			   <div style='background-color: #d7e9fc;padding: 20px;width: 425px;display: block;margin: auto;'><h2 style='text-align:center; border:1px dashed #00ABA8;background-color:#d7e9fc;margin:5px;padding:10px  5px  5px 5px;width:375px;display: block;text-align: center;margin: auto; width: 375px;padding: 15px '>User Information</h2>
			   <table style='width:100%'>
		       <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Client Code :</p></td><td><p style='margin: 0px 16px;'>FHS03CA001</p></td></tr>
			    <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Exam Type :</p></td><td><p style='margin: 0px 16px;'>C</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>First Name :</p></td><td><p style='margin: 0px 16px;'>".$first_name."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Last Name :</p></td><td><p style='margin: 0px 16px;'>" .$last_name. "</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Address :</p></td><td><p style='margin: 0px 16px;'>" .$address. "</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>City:</p></td><td><p style='margin: 0px 16px;'>".$city. "</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>State:</p></td><td><p style='margin: 0px 16px;'>".$state."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Zip:</p></td><td><p style='margin: 0px 16px;'>".$zip."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Country:</p></td><td><p style='margin: 0px 16px;'>".$country."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Phone:</p></td><td><p style='margin: 0px 16px;'>".$phone."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Email:</p></td><td><p  style='margin: 0px 16px;'>".$email."</p></td></tr>
			   <tr><td style='width: 35%;'><p style='font-weight: 600; margin: 0px 16px;'>Time Purchase:</p></td><td><p style='margin: 0px 16px;'>".$order_date. "</p></td></tr>
			   
			   </table></div>
			   		 ";
			   
			   $admin_url = 'https://docs.google.com/spreadsheets/d/1lWFpGDy3ijqnYRwAM11jigTkiVPWo_3zdNheHz3xaD0/edit#gid=0';	

			 
			   $address = str_replace('#', '', $address);
			   $user_url = 'https://foodhandlersolutions.com/download-csv?fname='.$first_name.'&lname='.$last_name.'&address='.$address.'&city='.$city.'&state='.$state.'&zip='.$zip.'&country='.$country.'&phone='.$phone.'&email='.$email.'&date='.$order_date;


			   send_email_woocommerce_style("sales@foodhandlersolutions.com","Manager Certificate Exam",'CBT Bulk Registration Form', $email_body , $admin_url); 
			   send_email_woocommerce_style("harry.klein@prometric.com","Manager Certificate Exam",'CBT Bulk Registration Form', $email_body , $admin_url); 
			   // send_email_woocommerce_style("test1emailtest1@gmail.com","Manager Certificate Exam",'FHS Manager Course Registration', $email_body , $user_url); 

			   // send_email_woocommerce_style("test1emailtest1@gmail.com","Manager Certificate Exam",'CBT Bulk Registration Form', $email_body , $admin_url); 
			   send_email_woocommerce_style("examorders@prometric.com","Manager Certificate Exam",'FHS Manager Course Registration', $email_body , $user_url); 
			}   

	
	

	if($id !== 8579 && $id !== 8588 && $id !== 8589 && $id !== 10559){	

		
		    if( $item_quantity_total >= 2){

			   $coupon_code = generate_coupons15($item_quantity_total , $_GET['key']);	
				
				  	update_field( 'coupon_code', $coupon_code, $order_id );    
			   
					?>
					<script>

						window.onload = function() {
							
							var str = "<?php echo $coupon_code; ?>"; // "A string here"
							jQuery(".woocommerce-order-details").append("<div id='contact-us'><p id='title-cart'>This Coupon Code was also sent to the email you indicate please check</p><br> <div class='coupon_code'><p class='gen_coupon'>"+ str +"</p></div> </div>");
						};
					</script>
					<?php
				$new_item_quantity_total = $item_quantity_total - 1;
			   if($coupon_code){
			   send_email_woocommerce_style($email,"Food Handler Solutions: Congratulations! You've received a coupon",'Here is your coupon code for: '.$new_item_quantity_total, "<p>To redeem your discount use the following coupon during checkout: </p>
			   <div style='background-color: #d7e9fc;padding: 20px;width: 425px;display: block;margin: auto;'><h2 style='text-align:center; border:1px dashed #00ABA8;background-color:#d7e9fc;margin:5px;padding:10px  5px  5px 5px;width:375px;display: block;text-align: center;margin: auto; width: 375px;padding: 15px '>".$coupon_code."</h2> </div><a href='https://foodhandlersolutions.com/shop/' style='color:#557da1;font-weight:normal;text-decoration:underline; text-align: center;display: block;margin-top: 25px;' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=https://foodhandlersolutions.com/shop/&amp;source=gmail&amp;ust=1519202632690000&amp;usg=AFQjCNHDD1ia7ipWlIfEK77-cxzZYyd_4w'>Visit Store</a> " , '');
			   
			   }
			   
			    
			 
		   }
		   
    }
    if($id == 10559){	

		
		    if( $item_quantity_total >= 1){

			   $coupon_code = generate_coupons15others($item_quantity_total , $_GET['key']);	
				
				  	update_field( 'coupon_code', $coupon_code, $order_id );    
			   
					?>
					<script>

						window.onload = function() {
							
							var str = "<?php echo $coupon_code; ?>"; // "A string here"
							jQuery(".woocommerce-order-details").append("<div id='contact-us'><p id='title-cart'>This Coupon Code was also sent to the email you indicate please check</p><br> <div class='coupon_code'><p class='gen_coupon'>"+ str +"</p></div> </div>");
						};
					</script>
					<?php
				$new_item_quantity_total = $item_quantity_total;
			   if($coupon_code){
			   send_email_woocommerce_style($email,"Food Handler Solutions: Congratulations! You've received a coupon",'Here is your coupon code for: '.$new_item_quantity_total, "<p>To redeem your discount use the following coupon during checkout: </p>
			   <div style='background-color: #d7e9fc;padding: 20px;width: 425px;display: block;margin: auto;'><h2 style='text-align:center; border:1px dashed #00ABA8;background-color:#d7e9fc;margin:5px;padding:10px  5px  5px 5px;width:375px;display: block;text-align: center;margin: auto; width: 375px;padding: 15px '>".$coupon_code."</h2> </div><a href='https://foodhandlersolutions.com/shop/' style='color:#557da1;font-weight:normal;text-decoration:underline; text-align: center;display: block;margin-top: 25px;' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=https://foodhandlersolutions.com/shop/&amp;source=gmail&amp;ust=1519202632690000&amp;usg=AFQjCNHDD1ia7ipWlIfEK77-cxzZYyd_4w'>Visit Store</a> " , '');
			   
			   }
			   
			    
			 
		   }
		   
    }
		
		   
}; 
         
// add the action 
add_action( 'woocommerce_thankyou', 'action_woocommerce_thankyou', 10, 1 ); 

/* add_action('woo','get_sample');
function get_sample(){
		if(is_wc_endpoint_url( 'order-received' )){
			
		## For WooCommerce 3+ ##
		$order_id = $_GET['key'];
		// Getting an instance of the WC_Order object from a defined ORDER ID
		$order = wc_get_order( $order_id ); 

		// Iterating through each "line" items in the order
		foreach ($order->get_items() as $item_id => $item_data) {

			// Get an instance of corresponding the WC_Product object
			$product = $item_data->get_product();
			$product_name = $product->get_name(); // Get the product name

			$item_quantity = $item_data->get_quantity(); // Get the item quantity

			$item_total = $item_data->get_total(); // Get the item line total

			// Displaying this data (to check)
			echo 'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 );
		}
		
		
			echo  $GLOBALS['globalquantity'];
			 if( $GLOBALS['globalquantity'] >= 20){
			   
					
			   $coupon_code = generate_coupons15($GLOBALS['globalquantity']);
			   send_email_woocommerce_style('rmednalan@gmail.com',"Food Handler Solutions: Congratulations! You've received a coupon",'Here is you coupon code for : '.$quantity, "<p>To redeem your discount use the following coupon during checkout: </p>
			   <div style='background-color: #d7e9fc;padding: 10px;width: 265px;display: block;margin: auto;'><h2 style='text-align:center; border:1px dashed #00ABA8;background-color:#d7e9fc;margin:5px;padding:10px  5px  5px 5px;width:200px;display: block;text-align: center;margin: auto; width: 230px;padding: 15px '>".$coupon_code."</h2> </div><a href='https://foodhandlersolutions.com/shop/' style='color:#557da1;font-weight:normal;text-decoration:underline; text-align: center;display: block;margin-top: 25px;' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=https://foodhandlersolutions.com/shop/&amp;source=gmail&amp;ust=1519202632690000&amp;usg=AFQjCNHDD1ia7ipWlIfEK77-cxzZYyd_4w'>Visit Store</a> ");
			   if($coupon_code)
			   {
				   
				   	?>
					<script>
					
					
						window.onload = function() {
							
							var str = "<?php echo $coupon_code; ?>"; // "A string here"
							jQuery("#place_order").click(function(){
								
							});
							
 
						};
					
				
					</script>
					<?php
			   }
		   }
			
		}
} */

add_action('wp_head','get_checkout_sample');
function get_checkout_sample(){
		
		if(is_checkout()){
		   
		   foreach ( WC()->cart->get_cart() as $cart_item ) {
			   $item_name = $cart_item['data']->get_title();
			   $quantity = $cart_item['quantity'];
			   $price = $cart_item['data']->get_price();
			   $get_quantity =  $quantity;
			   $GLOBALS['globalquantity'] = $quantity;
		       
			  //echo  $GLOBALS['globalquantity'];
			  return $quantity;
		   	
		}
		
	}

	
}

function generate_coupons15($quantity , $order_get_id) {
	//$coupon_code = substr( "abcdefghijklmnopqrstuvwxyz123456789", mt_rand(0, 50) , 1) .substr( md5( time() ), 1); // Code
	$coupon_code = $order_get_id; // Code
	$coupon_code = substr( $coupon_code, 0,30); // create 10 letters coupon
	$coupon_code ="fhs-special".$quantity."".$coupon_code;
	$amount = '100'; // Amount
	$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product
	
	$check_coupon = check_coupon_valid($coupon_code);
	
	
	if($check_coupon)
	{
		$coupon = array(
			'post_title' => $coupon_code,
			'post_content' => '',
			'post_excerpt' => '',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_type'     => 'shop_coupon'
			); 

			$new_coupon_id = wp_insert_post( $coupon );

			// Add meta

			// echo gettype($quantity);
			$new_quantity = $quantity - 1;
			update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
			update_post_meta( $new_coupon_id, 'coupon_amount', $amount ); 
			update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
			update_post_meta( $new_coupon_id, 'product_ids', '' );
			update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
			update_post_meta( $new_coupon_id, 'usage_limit',(string)$new_quantity );
			update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' ); 
			update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );
			update_post_meta( $new_coupon_id, 'expiry_date', '' );
			update_post_meta( $new_coupon_id, 'apply_before_tax', 'no' );
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );     
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'product_categories', '11' );       
			update_post_meta( $new_coupon_id, 'exclude_product_categories', '' );       
			update_post_meta( $new_coupon_id, 'minimum_amount', '' );       
			update_post_meta( $new_coupon_id, 'customer_email', '' );       

			return $coupon_code;
		
	}
	

return null;
}
function generate_coupons15others($quantity , $order_get_id) {
	//$coupon_code = substr( "abcdefghijklmnopqrstuvwxyz123456789", mt_rand(0, 50) , 1) .substr( md5( time() ), 1); // Code
	$coupon_code = $order_get_id; // Code
	$coupon_code = substr( $coupon_code, 0,30); // create 10 letters coupon
	$coupon_code ="fhs-special".$quantity."".$coupon_code;
	$amount = '100'; // Amount
	$discount_type = 'percent'; // Type: fixed_cart, percent, fixed_product, percent_product
	
	$check_coupon = check_coupon_valid($coupon_code);
	
	
	if($check_coupon)
	{
		$coupon = array(
			'post_title' => $coupon_code,
			'post_content' => '',
			'post_excerpt' => '',
			'post_status' => 'publish',
			'post_author' => 1,
			'post_type'     => 'shop_coupon'
			); 

			$new_coupon_id = wp_insert_post( $coupon );

			// Add meta

			// echo gettype($quantity);
			$new_quantity = $quantity;
			update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
			update_post_meta( $new_coupon_id, 'coupon_amount', $amount ); 
			update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
			update_post_meta( $new_coupon_id, 'product_ids', '' );
			update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
			update_post_meta( $new_coupon_id, 'usage_limit',(string)$new_quantity );
			update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '1' ); 
			update_post_meta( $new_coupon_id, 'usage_limit_per_user', '1' );
			update_post_meta( $new_coupon_id, 'expiry_date', '' );
			update_post_meta( $new_coupon_id, 'apply_before_tax', 'no' );
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );     
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'product_categories', '11' );       
			update_post_meta( $new_coupon_id, 'exclude_product_categories', '' );       
			update_post_meta( $new_coupon_id, 'minimum_amount', '' );       
			update_post_meta( $new_coupon_id, 'customer_email', '' );       

			return $coupon_code;
		
	}
	

return null;
}

function check_coupon_valid($code)
{
	$coupon = new WC_Coupon($code);
$coupon_post = get_post($coupon->id);
$coupon_data = array(
    'id' => $coupon->id,
    'code' => $coupon->code,
    'type' => $coupon->type,
    'created_at' => $coupon_post->post_date_gmt,
    'updated_at' => $coupon_post->post_modified_gmt,
    'amount' => wc_format_decimal($coupon->coupon_amount, 2),
    'individual_use' => ( 'yes' === $coupon->individual_use ),
    'product_ids' => array_map('absint', (array) $coupon->product_ids),
    'exclude_product_ids' => array_map('absint', (array) $coupon->exclude_product_ids),
    'usage_limit' => (!empty($coupon->usage_limit) ) ? $coupon->usage_limit : null,
    'usage_count' => (int) $coupon->usage_count,
    'expiry_date' => (!empty($coupon->expiry_date) ) ? date('Y-m-d', $coupon->expiry_date) : null,
    'enable_free_shipping' => $coupon->enable_free_shipping(),
    'product_category_ids' => array_map('absint', (array) $coupon->product_categories),
    'exclude_product_category_ids' => array_map('absint', (array) $coupon->exclude_product_categories),
    'exclude_sale_items' => $coupon->exclude_sale_items(),
    'minimum_amount' => wc_format_decimal($coupon->minimum_amount, 2),
    'maximum_amount' => wc_format_decimal($coupon->maximum_amount, 2),
    'customer_emails' => $coupon->customer_email,
    'description' => $coupon_post->post_excerpt,
);

$usage_left = $coupon_data['usage_limit'] - $coupon_data['usage_count'];

if ($usage_left > 0) {
	return false;
} 
else {
    return true;
}
	
}
	define("HTML_EMAIL_HEADERS", array('Content-Type: text/html; charset=UTF-8' , 'From: Food Handler Solutions <west@FoodHandlerSolutions.com>',
									'', ''));
	
		// define("HTML_EMAIL_HEADERS", array('Content-Type: text/html; charset=UTF-8'));
		// @email - Email address of the reciever
		// @subject - Subject of the email
		// @heading - Heading to place inside of the woocommerce template
		// @message - Body content (can be HTML)
		// function send_email_woocommerce_style($email, $subject, $heading, $message) {
		//   // Get woocommerce mailer from instance
		//   $mailer = WC()->mailer();
		//   // Wrap message using woocommerce html email template
		//   $wrapped_message = $mailer->wrap_message($heading, $message);
		//   // Create new WC_Email instance
		//   $wc_email = new WC_Email;
		//   // Style the wrapped message with woocommerce inline styles
		//   $html_message = $wc_email->style_inline($wrapped_message);
		//   // Send the email using wordpress mail function
		//   wp_mail( $email, $subject, $html_message, HTML_EMAIL_HEADERS );
		// }
	
	function send_email_woocommerce_style($email, $subject, $heading, $message ,$url ) {
  // Get woocommerce mailer from instance
  
// $headers[] = 'Content-Type: text/html; charset=UTF-8';
// $headers[] = 'From: Wishio Team ' . "\r\n";

// wp_mail( 'rmednalan@gmail.com', 'asdasda', 'hello', $headers);

  				
 

  if(!empty($url)){
  $message = $message."<p style ='margin-top:20px !important'>This user is also added in Manager Examiners List<a href='".$url."'> Please Click here to view. </a><a href='https://foodhandlersolutions.com/shop/' style='color:#557da1;font-weight:normal;text-decoration:underline; text-align: center;display: block;margin-top: 25px;' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=https://foodhandlersolutions.com/shop/&amp;source=gmail&amp;ust=1519202632690000&amp;usg=AFQjCNHDD1ia7ipWlIfEK77-cxzZYyd_4w'>Visit Store</a>"; 
	}
	

  $mailer = WC()->mailer();
  // Wrap message using woocommerce html email template
  $wrapped_message = $mailer->wrap_message($heading, $message);
  // Create new WC_Email instance
  $wc_email = new WC_Email;
  // Style the wrapped message with woocommerce inline styles
  $html_message = $wc_email->style_inline($wrapped_message);
  // Send the email using wordpress mail function
  wp_mail( $email, $subject, $html_message, HTML_EMAIL_HEADERS);
}

/* $order = wc_get_order( $order_id ); 

// Iterating through each "line" items in the order
foreach ($order->get_items() as $item_id => $item_data) {

    // Get an instance of corresponding the WC_Product object
    $product = $item_data->get_product();
    $product_name = $product->get_name(); // Get the product name

    $item_quantity = $item_data->get_quantity(); // Get the item quantity

    $item_total = $item_data->get_total(); // Get the item line total

    // Displaying this data (to check)
    echo 'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 );
} */



//////////////////


add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
	
}

 add_action( 'woocommerce_after_cart_totals', 'add_content_after_addtocart_button_func', 10, 1 );
 add_action( 'woocommerce_after_checkout_billing_form', 'add_content_after_addtocart_button_func', 10, 1 );

function add_content_after_addtocart_button_func() {

 global $woocommerce;
    $items = $woocommerce->cart->get_cart();

		$line_total = 0;

   


        // Echo content.
        echo '<div style="display:none;"><div class="half"><div class="tab"> <input id="tab-one" type="checkbox" name="tabs"> <label for="tab-one">Click Here To View Group Discounts</label> <div class="tab-content"><table class="discount_table shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-name"></th>
				<th class="product-name">Product</th>
				<th class="product-price">Total</th>
				<th class="product-price">Total Discount</th> 
			</tr>
		</thead>
		<tbody>';
	
		foreach($items as $item => $values) 
		{ 
				echo "<tr>";
					$line_total = $values['line_total' ];
					$_product =  wc_get_product( $values['data']->get_id() );
					$getProductDetail = wc_get_product( $values['product_id'] );
					echo "<td>".$getProductDetail->get_image()."</td>"; 
					echo "<td>"."<b>".$_product->get_title() .'</b>'."</td>"  ;
					$price = get_post_meta($values['product_id'] , '_price', true);
					echo "<td>".get_woocommerce_currency_symbol().$line_total."<br>"."</td>"  ;
					echo "<td>".get_woocommerce_currency_symbol().(($values['quantity'] * $price ) - $line_total) ."<br>"."</td>"  ;
				echo "</tr>";
		}
		 
	
		echo    '</tbody></table></div></div></div></div>';
	
	echo "<script>
	var ajax_noloop = 0;
	jQuery( document ).ready(function() {
		
		jQuery( '.quantity input' ).on('input change', function() {
		  ajax_noloop = 0;
		
		});
		
		jQuery( '.woocommerce-cart-form').after(jQuery( '.half' ));
		
	});
	
	jQuery( document ).ajaxComplete(function() { 
	
		jQuery( '.quantity input' ).on('input change', function() {
		  ajax_noloop = 0;

		});
		if(ajax_noloop == 0){
			jQuery.ajax({
					url : ajaxurl,
					data: {
						'action': 'example_ajax_request'
					},
					type : 'post',
					success : function( response ) {
						jQuery('.discount_table tbody tr').remove(); 
						 jQuery('.discount_table tbody').html( response );
						
						 ajax_noloop = 1;
					}
			});
		}
	} );
		
		</script> ";

} 
/* 
function update_discount(){
	$table_row = "";
	global $woocommerce;
    $items = $woocommerce->cart->get_cart();
	$line_total = 0;
	
	foreach($items as $item => $values) 
		{ 
				$table_row .= "<tr>";
					$line_total = $values['line_total' ];
					$_product =  wc_get_product( $values['data']->get_id() );
					$getProductDetail = wc_get_product( $values['product_id'] );
					$table_row .= "<td>".$getProductDetail->get_image()."</td>"; 
					$table_row .= "<td>"."<b>".$_product->get_title() .'</b>'."</td>"  ;
					$price = get_post_meta($values['product_id'] , '_price', true);
					$table_row .= "<td>".get_woocommerce_currency_symbol().$line_total."<br>"."</td>"  ;
					$table_row .= "<td>".get_woocommerce_currency_symbol().(($values['quantity'] * $price ) - $line_total) ."<br>"."</td>"  ;
				$table_row .= "</tr>";
		}
	return $table_row;
}
 */

function example_ajax_request() {
 
    // The $_REQUEST contains all the data sent via ajax
   $table_row = "";
	global $woocommerce;
    $items = $woocommerce->cart->get_cart();
	$line_total = 0;
	
	foreach($items as $item => $values) 
		{ 
				$table_row .= "<tr>";
					$line_total = $values['line_total' ];
					$_product =  wc_get_product( $values['data']->get_id() );
					$getProductDetail = wc_get_product( $values['product_id'] );
					$table_row .= "<td>".$getProductDetail->get_image()."</td>"; 
					$table_row .= "<td>"."<b>".$_product->get_title() .'</b>'."</td>"  ;
					$price = get_post_meta($values['product_id'] , '_price', true);
					$table_row .= "<td>".get_woocommerce_currency_symbol().$line_total."<br>"."</td>"  ;
					$table_row .= "<td>".get_woocommerce_currency_symbol().(($values['quantity'] * $price ) - $line_total) ."<br>"."</td>"  ;
				$table_row .= "</tr>";
		}
		
	echo $table_row;	
die();
}
 
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );

function example_ajax_enqueue() {

	// The wp_localize_script allows us to output the ajax_url path for our script to use.
	wp_localize_script(
		'example-ajax-script',
		'example_ajax_obj',
		array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
	);
}
add_action( 'wp_enqueue_scripts', 'example_ajax_enqueue' );


function your_function() {
    if( function_exists('WC') ){
        WC()->cart->empty_cart();
    }
}
add_action('wp_logout', 'your_function');


// Add a second password field to the checkout page in WC 3.x.
add_filter( 'woocommerce_checkout_fields', 'wc_add_confirm_password_checkout', 10, 1 );
function wc_add_confirm_password_checkout( $checkout_fields ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {
        $checkout_fields['account']['account_password2'] = array(
                'type'              => 'password',
                'label'             => __( 'Confirm password', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Confirm Password', 'placeholder', 'woocommerce' )
        );
		$checkout_fields['billing']['billing_email2'] = array(
                'type'              => 'email',
                'label'             => __( 'Confirm email', 'woocommerce' ),
                'required'          => true,
                'placeholder'       => _x( 'Confirm Email', 'placeholder', 'woocommerce' )
        );
    }

    return $checkout_fields;
}

// Check the password and confirm password fields match before allow checkout to proceed.
add_action( 'woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2 );
function wc_check_confirm_password_matches_checkout( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_password2'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' );
        }
		 if ( strcmp( $posted['billing_email'], $posted['billing_email2'] ) !== 0 ) {
            wc_add_notice( __( 'Email do not match.', 'woocommerce' ), 'error' ); 
        }
    }
}  

add_action( 'woocommerce_order_details_after_order_table', 'custom_order_details_after_order_table', 10, 1 );
function custom_order_details_after_order_table( $order ) {

	global $wpdb;
 	$user_info = wp_get_current_user();

    $email = $user_info->user_email;

	$getcoupon = $wpdb->get_results ("
				SELECT meta_value 
				FROM wp_postmeta 
				WHERE meta_key = 'coupon_code'
				AND post_id = {$order->id}
				");

	$getcoupon = json_decode(json_encode($getcoupon), True);
	$getcouponstr = $getcoupon[0]['meta_value'];

	$getlimit = $wpdb->get_results ("
				SELECT post_id, meta_value 
				FROM wp_posts 
				RIGHT JOIN wp_postmeta 
				ON wp_posts . ID = wp_postmeta . post_id 
				WHERE post_title = '{$getcouponstr}' 
				AND meta_key = 'usage_limit'
				");

	$ids = '';
	foreach ($getlimit as $value) {
		$ids = $ids.",{$value->post_id}";
	}

	$ids = substr($ids, 1);

	$getused = $wpdb->get_results ("
				SELECT post_id,post_title, meta_key, meta_value 
				FROM wp_posts 
				RIGHT JOIN wp_postmeta 
				ON wp_posts . ID = wp_postmeta . post_id 
				WHERE post_id = {$ids}
				AND meta_key = 'usage_count'
				");

	$getlimit = json_decode(json_encode($getlimit), True);
	$getused = json_decode(json_encode($getused), True);
	$used = '';
	if($getused[0]['meta_value'] == "" || $getused[0]['meta_value'] == 0){
		$used = 0;
	}else{
		$used = $getused[0]['meta_value'];
	}

	$remaining = $getlimit[0]['meta_value']-$used;

	$value = get_field( 'coupon_code', $order->id);
	// echo "<pre>";
	// print_r($getlimit);
	// print_r($getcoupon);
	// echo "</pre>";
	// echo "<script>console.log('{$getcoupon}');</script>";
	if($getcoupon != array()){
		echo '<p class="checkout-coupon">Your Coupon code: <b>' .$value.'</b>
			<span> ('.$remaining.' remaining)</span></p>'; 
	}


}
  

//start code

function edit_course_list() {

	global $wpdb;
	global $post; 
	$postid = $post->ID;

	// 	

	$user = wp_get_current_user();
	$user_id = $user->ID;

	// echo 'string'.$postid;

	if($postid == '178'){

		

				?>	
		<script>
		var certificates = [];		

		window.addEventListener('load', function(event) {
	

		for(var i = 0 ; i <data.length; i++){ 
			if(data[i][2] >= 75){
				certificates.push(data[i]);
			} 
		}	

		console.log(certificates);
		for(var i = 1 ; i < jQuery('.certificates_list tr').length; i++){ 
		jQuery('.certificates_list tr')[i].getElementsByTagName("a")[0].href = 'https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz='+certificates[i-1][5]+'&time='+certificates[i-1][4];

	  var timestamp = certificates[i-1][4];
      var d = new Date(timestamp * 1000);
      var year = d.getFullYear();
      var month = d.getMonth();
      var day = d.getDate();
      var validity = new Date(year + 3, month, day);
      var get_validity = validity.toDateString();
      console.log(i);

     jQuery('.certificates_list tr')[i].getElementsByTagName("th").valid.innerHTML = get_validity;
		}

				
		});
		</script>
		<?php

		
	
	}
	if ($postid == '3859'){
		$couponsother1 = '';
		$couponsother2 = '';
		$couponsother1 .= "<div id='couponsother' class='login-modal'>";
		$couponsother1 .= 	"<div class='login-modal-content'>";
		$couponsother1 .= 		"<span class='close'>&times;</span>";
		$couponsother1 .= 		"<h2 class='login-modal-title'>Group Purchase</h2><hr>";
		$couponsother1 .= 		"<p style='text-indent: 50px;'>You can buy Food Handler Program Coupons for your staff. But you will not gain an access for the program.</p>";
		$couponsother2 .= 	"</div>";
		$couponsother2 .= "</div>";
		$couponsotherbtn = "<a class='btn btn-success' style='margin:20px auto 0px auto;display:block;width:130px;text-align:center;background: #2a7fff; border-color: #2a7fff;' href='https://foodhandlersolutions.com/checkout-before/?productID=10559'>Proceed</a>";


		?><script type="text/javascript">
			window.addEventListener('load', function(event) {
				// jQuery('.sfh-legend2')[0].innerHTML += "<?php echo $couponsother1.$couponsotherbtn.$couponsother2;?>";
				jQuery("<?php echo $couponsother1.$couponsotherbtn.$couponsother2;?>").insertAfter('.sfh-legend2');
				jQuery('<a class="btn btn-success" style="position: absolute; display: table; background: #2a7fff; border-color: #2a7fff; top: 0; left: 0; bottom: 0;" id="couponorderbtn" href="javascript:void(0)">Group Purchase</a>').insertAfter('.sfh-step-group2');
				var modal = document.getElementById('couponsother');
				var btn = document.getElementById("couponorderbtn");
				var span = document.getElementsByClassName("close")[0];
				btn.onclick = function() {
				    modal.style.display = "block";
				}
				span.onclick = function() {
				    modal.style.display = "none";
				}
				window.onclick = function(event) {
				    if (event.target == modal) {
				        modal.style.display = "none";
				    }
				}
			});
		</script><?php
	}
	if ($postid == '202' && is_user_logged_in()){

		global $wpdb;
		$user = wp_get_current_user();
		$user_id = $user->ID;

		$getorder = $wpdb->get_results ("
				SELECT ID FROM wp_posts 
				JOIN wp_postmeta 
				ON wp_posts . ID = wp_postmeta . post_id 
				WHERE post_type = 'shop_order' 
				AND meta_key = '_customer_user' 
				AND meta_value = {$user_id} 
				ORDER BY meta_id DESC
				");

		$getorderid = '';
		foreach ($getorder as $value) {
			$getorderid = $getorderid.",{$value->ID}";
		}

		$getorderid = substr($getorderid, 1);

		$getprodid = $wpdb->get_results ("
				SELECT meta_value 
				FROM wp_woocommerce_order_items 
				JOIN wp_woocommerce_order_itemmeta 
				ON wp_woocommerce_order_items . order_item_id = wp_woocommerce_order_itemmeta . order_item_id 
				WHERE meta_key = '_product_id'
				AND meta_value = 10559 
				AND order_id IN ({$getorderid})
				");

		$getorder = $wpdb->get_results ("
				SELECT order_id 
				FROM wp_woocommerce_order_items 
				JOIN wp_woocommerce_order_itemmeta 
				ON wp_woocommerce_order_items . order_item_id = wp_woocommerce_order_itemmeta . order_item_id 
				WHERE meta_key = '_product_id'
				AND meta_value = 10559 
				AND order_id IN ({$getorderid})
				ORDER BY order_id DESC
				");

		$getorder2 = '';
		foreach ($getorder as $value) {
			$getorder2 = $getorder2.",{$value->order_id}";
		}

		$getorder2 = substr($getorder2, 1);

		$getorder = json_decode(json_encode($getorder), True);
		// $getorder = $getorder[0]['order_id'];
		
		$getprodid = json_decode(json_encode($getprodid), True);
		$getprodid = $getprodid[0]['meta_value'];
		
		$getcoupon = $wpdb->get_results ("
					SELECT meta_value 
					FROM wp_postmeta 
					WHERE meta_key = 'coupon_code'
					AND post_id IN ({$getorder2})
					");

		// $getcoupon = json_decode(json_encode($getcoupon), True);
		// $getcouponstr = $getcoupon[0]['meta_value'];

		$getlimit = $wpdb->get_results ("
					SELECT post_id, meta_value 
					FROM wp_posts 
					RIGHT JOIN wp_postmeta 
					ON wp_posts . ID = wp_postmeta . post_id 
					WHERE post_title IN 
						(SELECT meta_value 
						FROM wp_postmeta 
						WHERE meta_key = 'coupon_code'
						AND post_id IN ({$getorder2})) 
					AND meta_key = 'usage_limit'
					ORDER BY post_id DESC
					");

		$ids = '';
		foreach ($getlimit as $value) {
			$ids = $ids.",{$value->post_id}";
		}

		$ids = substr($ids, 1);
		$getused = $wpdb->get_results ("
					SELECT post_id,post_title, meta_key, meta_value 
					FROM wp_posts 
					RIGHT JOIN wp_postmeta 
					ON wp_posts . ID = wp_postmeta . post_id 
					WHERE post_id IN ({$ids})
					AND meta_key = 'usage_count'
					ORDER BY post_id DESC
					");

		$getlimit = json_decode(json_encode($getlimit), True);
		$getused = json_decode(json_encode($getused), True);

		$couponhtml = "<div class='coupon_others'><div class='coupon_head'><p class='coupon_title'>Food Handler Program Coupon</p></div><div class='coupon_cont'>";
		for( $i = 0; $i < sizeof($getorder); $i++ ){
			$error = 0;
			$used = '';
			if($getused == array()){
				$used = 0;
			}else{
				for( $j = 0; $j < sizeof($getused); $j++ ){
					// echo "<script>console.log('".$getlimit[$i]['post_id'].":".$getused[$j]['post_id']."');</script>";
					if($getlimit[$i]['post_id'] != $getused[$j]['post_id']){
						$error++;
					}else{
						$used = $getused[$j]['meta_value'];
					}
				}
				if($error == sizeof($getused)){
					$used = 0;
				}

				$remaining = $getlimit[$i]['meta_value']-$used;

				$value = get_field( 'coupon_code', $getorder[$i]['order_id']);
				if($remaining != 0){
					$couponhtml .= "<p>Coupon Name: <span>".$value."</span></p><p>Remaining use: <span>".$remaining."</span></p><br>";
				}
			}
			
		}
		$couponhtml .= "<small>Note: <span>This coupon can only be used on the food handler program.</span></small></div></div>";
		if($getprodid == 10559){
			?>
			<style type="text/css">
				.coupon_others{
					font-family: 'Lato', sans-serif;
					border: 1px solid #ddd;
				    color: #333333;
				    margin-bottom: 20px;
				}
				.coupon_head{
				    background-color: #f3f3f3;
				    padding: 5px 15px;
				}
				.coupon_cont{
				    padding: 15px;
				}
				.coupon_cont p{
					color: #828282;
				}
				.coupon_cont p span{
					color: #333333;
				}
				.coupon_cont small{
					font-style: italic;
					color: #828282;
				}
			</style>
			<script type="text/javascript">
				window.addEventListener('load', function(event) {
					jQuery('.ld-course-list-items.row')[0].innerHTML += "<?php echo $couponhtml; ?>";
				});
			</script>
			<?php
		}

		$first_level =  get_user_meta( $user_id, 'course_6212_access_from' );
		$sec_level =  get_user_meta( $user_id, 'course_6219_access_from' );
		$top_level = get_user_meta( $user_id, 'course_5960_access_from' );
		// echo '<pre>';
		// print_r($top_level);
		// echo '</pre>';
		$p1 = 79;
		$p1 = 119;
		$p1 = 120;
		$modal1 = '';
		$modal2 = '';
		$modal1 .= "<div id='myModal' class='login-modal'>";
		$modal1 .= 	"<div class='login-modal-content'>";
		$modal1 .= 		"<span class='close'>&times;</span>";
		$modal1 .= 		"<h2 class='login-modal-title'>Upgrade your account</h2>";
		$modal2 .= 	"</div>";
		$modal2 .= "</div>";

		$button1 = "<div class='btn-cont'><p>Exam & Study Guide</p><a href='https://foodhandlersolutions.com/checkout-before/?productID=8588'><button class='btn1-login'>Add $40.00</button></a></div><div class='btn-cont'><p>Exam, Online Course, Video Training and Practice Exam</p><a href='https://foodhandlersolutions.com/checkout-before/?productID=8589'><button class='btn2-login'>Add $41.00</button></a></div>";
		$button2 = "<div class='btn-cont'><p>Exam, Online Course, Video Training and Practice Exam</p><a href='https://foodhandlersolutions.com/checkout-before/?productID=8579'><button class='btn2-login'>Add $1.00</button></a></div>";
		if(!empty($first_level) || !empty($sec_level) || !empty($top_level)){
			?>
			<script type="text/javascript">
				window.addEventListener('load', function(event) {
					jQuery('.ld-course-list-items .entry-title a')[3].href = 'https://foodhandlersolutions.com/exam-scheduling-contact-information/';
					jQuery('.ld-course-list-items .entry-title a:eq( 3 )').addClass('display-inline');
					jQuery('.ld-course-list-items .entry-title a:eq( 3 )').text('Exam Scheduling Information');
					});
			</script>
			<?php
		}
		if(!empty($first_level) || !empty($sec_level)){
			if(empty($top_level)){
				if(empty($sec_level)){
					?>
					<script type="text/javascript">
						window.addEventListener('load', function(event) {
							jQuery('.entry-content')[0].innerHTML += "<?php echo $modal1.$button1.$modal2;?><div class='upgradelogin'><p>There is still time to upgrade your purchase and get training as well.</p><button id='seclevel' class=''>Click Here To Upgrade Your Account</button>";
							// Get the modal
							var modal = document.getElementById('myModal');
							// Get the button that opens the modal
							var btn = document.getElementById("seclevel");
							// Get the <span> element that closes the modal
							var span = document.getElementsByClassName("close")[0];
							// When the user clicks on the button, open the modal 
							btn.onclick = function() {
							    modal.style.display = "block";
							}
							// When the user clicks on <span> (x), close the modal
							span.onclick = function() {
							    modal.style.display = "none";
							}
							// When the user clicks anywhere outside of the modal, close it
							window.onclick = function(event) {
							    if (event.target == modal) {
							        modal.style.display = "none";
							    }
							}
						});
					</script>
					<?php
				}
				else{
					?>
					<script type="text/javascript">
						window.addEventListener('load', function(event) {
							jQuery('.entry-content')[0].innerHTML += "<?php echo $modal1.$button2.$modal2;?><div class='upgradelogin'><p>There is still time to upgrade your purchase and get training as well.</p><button id='toplevel' class=''>Click Here To Upgrade Your Account</button>";
							// Get the modal
							var modal = document.getElementById('myModal');
							// Get the button that opens the modal
							var btn = document.getElementById("toplevel");
							// Get the <span> element that closes the modal
							var span = document.getElementsByClassName("close")[0];
							// When the user clicks on the button, open the modal 
							btn.onclick = function() {
							    modal.style.display = "block";
							}
							// When the user clicks on <span> (x), close the modal
							span.onclick = function() {
							    modal.style.display = "none";
							}
							// When the user clicks anywhere outside of the modal, close it
							window.onclick = function(event) {
							    if (event.target == modal) {
							        modal.style.display = "none";
							    }
							}
						});
					</script>
					<?php
				}
			}
		}
	}
	if ($postid == '155'){
		?>
		<script type="text/javascript">
			window.addEventListener('load', function(event) {
				var start = 0;
				if(jQuery('.cart_item .product-name a').attr('data-product_id') == 10559){
				    jQuery('.woocommerce-form-coupon-toggle').remove();
				    jQuery('#cert_first_name_field').hide();
				    jQuery('#cert_last_name_field').hide();
					jQuery('#billing_first_name').keyup(function(){
						var val = jQuery('#billing_first_name').val();
						jQuery('#cert_first_name').val(val);
					});
					jQuery('#billing_last_name').keyup(function(){
						var val = jQuery('#billing_last_name').val();
						jQuery('#cert_last_name').val(val);
					});
					start = 1;
				}
				// console.log(start);
				setInterval(function(){
					if(start == 1){
						jQuery('.woocommerce-customer-details a.str_btn').hide();
						jQuery('table.woocommerce-table.woocommerce-table--custom-fields.shop_table.custom-fields').hide();
					}
				}, 500);
			});
		</script>
		<?php
	}

	if ($postid == '155' && is_user_logged_in()){
		global $wpdb;

	    $user_info = wp_get_current_user();

	    $fname = $user_info->user_firstname;
	    $lname = $user_info->user_lastname;
	    $email = $user_info->user_email;

		?>
		<script type="text/javascript">
			window.addEventListener('load', function(event) {
				jQuery('input[name="cert_first_name"]').val('<?php echo $fname;?>');
				jQuery('input[name="cert_last_name"]').val('<?php echo $lname;?>');
				setInterval(function(){
					jQuery('input[name="billing_first_name"]').attr('readonly','readonly');
					jQuery('input[name="billing_last_name"]').attr('readonly','readonly');
					jQuery('input[name="billing_email"]').attr('readonly','readonly');
					jQuery('input[name="cert_first_name"]').attr('readonly','readonly');
					jQuery('input[name="cert_last_name"]').attr('readonly','readonly');
					jQuery('input[name="billing_email2"]').attr('readonly','readonly');
				}, 500);
			});
		</script>
		<?php
	}


	//if ($postid == 6077){
		echo '<div class="container_modal"></div>';
		//echo '<div align="center" id="preload"><div class="loader"></div></div>';
		$button1 = "<input type='submit' id='zipbtn' value='Okay'>";
		$zip1 = '';
		$zip2 = '';
		$zip1 .= "<div id='zipmodal' class='login-modal'>";
		$zip1 .= 	"<div class='login-modal-content'>";
		$zip1 .= 		"<span class='close' id='close'>&times;</span>";
		$zip1 .= 		"<h2 class='login-modal-title'>Enter ZIP Code</h2>";
		$zip1 .= 		"<input type='number' name='zip' id='zip' placeholder='Enter your ZIP code' required>";
		$zip2 .= 	"<div style='clear:both;'></div>";
		$zip2 .= 	"</div>";
		$zip2 .= "</div>";
		$confirm1 = '';
		$confirm2 = '';
		$confirm1 .= "<div id='confModal' class='login-modal'>";
		$confirm1 .= 	"<div class='login-modal-content'>";
		$confirm1 .= 		"<span class='close' id='close2'>&times;</span>";
		$confirm1 .= 		"<h3 class='login-modal-title conf'></h3>";
		$confirm1 .= 		"<div class='modal-btn-cont'>";
		$confirm2 .= 	"</div>";
		$confirm2 .= 	"</div>";
		$confirm2 .= "</div>";
		$conf_button1 = "<button id='modal-yes' class='modal-button-green'>Yes! I want to do well on the exam</button>";
		$conf_button2 = "<button id='modal-no' class='modal-button-red'>No, I don’t need to study for the exam</button>";

		?>
			<script type="text/javascript">
				var zip_href = '';
				var wwidth = window.innerWidth;
				window.addEventListener('load', function(event) {
					jQuery('.container_modal')[0].innerHTML += "<div id='path_click' style='display:none;'></div>";
					jQuery('.container_modal')[0].innerHTML += "<?php echo $zip1.$button1.$zip2;?>";
					jQuery('.container_modal')[0].innerHTML += "<?php echo $confirm1.$conf_button1.$conf_button2.$confirm2;?>";
					jQuery('.eapps-pricing-table-column-button').removeAttr('href');
					//jQuery('.eapps-pricing-table-column-button').css({'opacity':'.5','-khtml-opacity':'.5'});
					setInterval(function(){
						if(jQuery('#path_click').html()=="click okay"){
					setTimeout(function(){
						// alert('buttons okay');
						jQuery('.eapps-pricing-table-column-button').attr('href','javascript:void(0)');
						jQuery('.eapps-pricing-table-column-button').css({'opacity':'1','-khtml-opacity':'1'});

						//jQuery('.eapps-pricing-table-column-button').removeAttr('href');
						// if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { 
						// 		
						// }else{
							// console.log('Chrome');
							if(wwidth < 760){
								// alert(wwidth);
								jQuery('.eapps-pricing-table-column-button:eq(0)').on({ 'touchstart' : function(){
									// console.log('1');
									jQuery('#confModal').removeClass('modal-hide');
									jQuery('#confModal').addClass('modal-show');
									jQuery('h3.conf').html('Are you sure you do not want to upgrade your purchase for only $40.00?');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6187';

								}});
								jQuery('.eapps-pricing-table-column-button:eq(1)').on({ 'touchstart' : function(){
									// console.log('2');
									jQuery('#confModal').removeClass('modal-hide');
									jQuery('#confModal').addClass('modal-show');
									jQuery('h3.conf').html('Are you sure you do not want to upgrade your purchase for only $1.00?');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6186';
								}});
								jQuery('.eapps-pricing-table-column-button:eq(2)').on({ 'touchstart' : function(){
									// console.log('3');
									jQuery('#zipmodal').removeClass('modal-hide');
									jQuery('#zipmodal').addClass('modal-show');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6185';
								}});
								// jQuery('#close').click(function(){
								// 	console.log('close');
								// 	jQuery('#zipmodal').css('display','none');
								// });
								var modal = document.getElementById('zipmodal');
								var modal2 = document.getElementById('confModal');
								var span = document.getElementsByClassName("close")[0];
								// span.onclick = function() {
								//     modal.style.display = "none";
								// }
								jQuery(window).on({ 'touchstart' : function(event){
								    if (event.target == modal || event.target == modal2) {
									jQuery('#confModal').removeClass('modal-show');
									jQuery('#confModal').addClass('modal-hide');
									jQuery('#zipmodal').removeClass('modal-show');
									jQuery('#zipmodal').addClass('modal-hide');
			    						// jQuery('.login-modal-content')[0].innerHTML = "<h2 class='login-modal-title'>Enter ZIP Code</h2><span class='close' id='close'>&times;</span><input type='number' name='zip' id='zip' placeholder='Enter your ZIP code' required><?php echo $button1;?><div style='clear:both;'></div>";
								    }
								}});

								jQuery('span#close, span#close2').on({ 'touchstart' : function(){
									jQuery('#confModal').removeClass('modal-show');
									jQuery('#confModal').addClass('modal-hide');
									jQuery('#zipmodal').removeClass('modal-show');
									jQuery('#zipmodal').addClass('modal-hide');
								}});
								jQuery('#zipbtn').on({ 'touchstart' : function(){
									var zip = jQuery('input#zip').val();
									if(zip != ""){
										jQuery('#preload').removeClass('modal-hide');
										jQuery('#preload').addClass('modal-show');
										jQuery('#zipmodal').removeClass('modal-show');
										jQuery('#zipmodal').addClass('modal-hide');
										// console.log("value:"+zip);
										get_testing_centers(zip);
									}else{
										jQuery('input#zip').css('border','1px solid red');
									}
								}});
								jQuery('#modal-yes').on({ 'touchstart' : function(){
									// console.log('yes');
									jQuery('#confModal').removeClass('modal-show');
									jQuery('#confModal').addClass('modal-hide');
								}});
								jQuery('#modal-no').on({ 'touchstart' : function(){
									// console.log('no');
									jQuery('#confModal').removeClass('modal-show');
									jQuery('#confModal').addClass('modal-hide');
									jQuery('#zipmodal').removeClass('modal-hide');
									jQuery('#zipmodal').addClass('modal-show');
									// console.log('show okay');
								}});
							}else{
								// console.log(wwidth);
								jQuery('.eapps-pricing-table-column-button:eq(0)').click(function(){
									// alert();
									jQuery('#confModal').css('display','block');
									jQuery('h3.conf').html('Are you sure you do not want to upgrade your purchase for only $40.00?');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6187';

								});
								jQuery('.eapps-pricing-table-column-button:eq(1)').click(function(){
									jQuery('#confModal').css('display','block');
									jQuery('h3.conf').html('Are you sure you do not want to upgrade your purchase for only $1.00?');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6186';
								});
								jQuery('.eapps-pricing-table-column-button:eq(2)').click(function(){
									jQuery('#zipmodal').css('display','block');
									zip_href = 'https://foodhandlersolutions.com/checkout-before/?productID=6185';
								});// jQuery('#close').click(function(){
								// 	console.log('close');
								// 	jQuery('#zipmodal').css('display','none');
								// });
								var modal = document.getElementById('zipmodal');
								var modal2 = document.getElementById('confModal');
								var span = document.getElementsByClassName("close")[0];
								// span.onclick = function() {
								//     modal.style.display = "none";
								// }
								window.onclick = function(event) {
								    if (event.target == modal || event.target == modal2) {
								        modal.style.display = "none";
								        modal2.style.display = "none";
			    						// jQuery('.login-modal-content')[0].innerHTML = "<h2 class='login-modal-title'>Enter ZIP Code</h2><span class='close' id='close'>&times;</span><input type='number' name='zip' id='zip' placeholder='Enter your ZIP code' required><?php echo $button1;?><div style='clear:both;'></div>";
								    }
								}

								jQuery('span#close, span#close2').click(function(){
									jQuery('#confModal').css('display','none');
									jQuery('#zipmodal').css('display','none');
								});
								jQuery('#zipbtn').click(function(){
									var zip = jQuery('input#zip').val();
									if(zip != ""){
										jQuery('#preload')[0].style.display = 'block';
									    modal.style.display = "none";
										var zip = jQuery('input#zip').val();
										// console.log("value:"+zip);
										get_testing_centers(zip);
									}else{
										jQuery('input#zip').css('border','1px solid red');
									}
								});
								jQuery('#modal-yes').click(function(){
									jQuery('#confModal').css('display','none');
								});
								jQuery('#modal-no').click(function(){
									jQuery('#confModal').css('display','none');
									jQuery('#zipmodal').css('display','block');
								});
							}
						// }
					}, 3000);
						}
					}, 1000);
				});
			</script>
		<?php
//}

	if ($postid == '202' || $postid == '178' || '181') {


		
	$result1 = $wpdb->get_results (
	            "
	            SELECT activity_id,activity_started,activity_completed,user_id
	            FROM  wp_learndash_user_activity 
	            WHERE user_id =  {$user_id}
	            AND activity_type = 'quiz' 
	            "
	            );

	$array = '';

	foreach ($result1 as $value){
    $array = $array.",{$value->activity_id}";
	}

	
	$array = substr($array, 1);

	// echo '<pre>';


	// 	print_r($result1);
	// 	echo $array;
	// echo '</pre>'; 


	$result = $wpdb->get_results (
	            "
	            SELECT * 
	            FROM  wp_learndash_user_activity_meta 
	            WHERE activity_id  IN ({$array}) 
	            AND activity_meta_key IN ('points','total_points' ,'started' , 'completed', 'percentage', 'course' ,'quiz')
	           
	            "
	            );

	
	$array1 = json_decode(json_encode($result), True);
	$length1 = count($array1);

	
	$oldid = "";
	for ($x = 0; $x < $length1; $x++) {
		$newid = $array1[$x]['activity_id'];
		if($newid != $oldid){
			$oldid = $newid;
			$newarrid[] = array($oldid);
		}
	}
	for ($x = 0; $x < sizeof($newarrid); $x++) {
		$points = "";
		$total_points = "";
		$started = "";
		$completed = "";
		$percentage = "";
		$course = "";
		$quiz = "";
		for ($y = 0; $y < $length1; $y++) {
			$actid = $array1[$y]['activity_id'];
			// echo "<script>console.log('".$actid." - ".$newarrid[$x]."');</script>";
			if ($actid == $newarrid[$x][0]) {
				if($array1[$y]['activity_meta_key'] == 'points'){
					$points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'total_points'){
					$total_points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'started'){
					$started = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'completed'){
					$completed = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'percentage'){
					$percentage = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'course'){
					$course = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'quiz'){
					$quiz = $array1[$y]['activity_meta_value'];
				}
			}
		}
		$newarr[] = array($points,$total_points,$percentage,$started,$completed,$quiz,$course);
	}
// 	for ($x = 0; $x < $length1; $x++) {

// 		$newarr[] = array($array1[$x]['activity_meta_value'],$array1[$x+1]['activity_meta_value'] , $array1[$x+2]['activity_meta_value'] , $array1[$x+3]['activity_meta_value'] , $array1[$x+4]['activity_meta_value'], $array1[$x+5]['activity_meta_value'],$array1[$x+6]['activity_meta_value']);
  		
//   			$x = $x + 6;	
  		
// 	} 

// if($postid == '6077'){
// 	echo "<pre>";
// 	print_r($mynewarr);
// 	echo "</pre>";
// }
	// echo '<pre>';


	// print_r($array1); // display data
	// print_r($newarr);
	$newarr = json_encode($newarr);
	// echo json_encode($newarr);

	// echo '</pre>'; 


	/*---- get course ----*/


		
	$c_result1 = $wpdb->get_results (
	            "
	            SELECT activity_id,activity_started,activity_completed,user_id
	            FROM  wp_learndash_user_activity 
	            WHERE user_id =  {$user_id}
	            AND activity_type = 'course'
	            AND course_id = '178' 
	            "
	            );

	$c_array = '';

	foreach ($c_result1 as $value){
   		$c_array = $c_array.",{$value->activity_id}";
	}

	
	$c_array = substr($c_array, 1);


	$c_result = $wpdb->get_results (
	            "
	            SELECT * 
	            FROM  wp_learndash_user_activity_meta 
	            WHERE activity_id  IN ({$c_array}) 
	            AND activity_meta_key IN ('steps_total','steps_completed')
	           
	            "
	            );

	
	$c_array1 = json_decode(json_encode($c_result), True);
	$c_length1 = count($c_array1);
	$c_newarr[] = array($c_array1[0]['activity_meta_value'],$c_array1[1]['activity_meta_value']);
	// if($postid == '6077'){
	// 	echo "<pre>";
	// 	print_r($c_newarr);
	// 	echo "</pre>";
	// }
	
	}
	$c_total = $c_newarr[0][0];
	$c_complete = $c_newarr[0][1];
	$c_percent = floor(($c_complete/$c_total)*100);

	$length = count($result1);

	$html =  '<div class="learndash_profile_heading course_overview_heading">Course Progress Overview</div><div><dd class="course_progress" title="'.$c_complete.' out of '.$c_total.' steps completed"><div class="course_progress_blue" style="width: '.$c_percent.'%;"></div></dd><div class="right">'.$c_percent.'% Complete</div></div><div class="learndash_profile_quizzes clear_both"><div class="learndash_profile_quiz_heading"><div class="quiz_title">Exams</div><div class="certificate">Certificate</div><div class="scores">Score</div><div class="statistics">Statistics</div><div class="quiz_date">Date</div></div></div>';
	$html1 = '<div class="failed"><div class="quiz_title"><span class="failed_icon"></span><a href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1004/">Food Handler Exam 1004</a></div><div  class="certificate cert_index">-</div><div class="scores">17.5%</div><div class="statistics"></div><div class="quiz_date">May 14, 2018 5:44 pm</div></div>';

	$quiz_title1 = '<span class="failed_icon"></span><a href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1004/">Food Handler Exam 1004</a>';

	$quiz_title2 = '<span class="failed_icon"></span><a href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1003/">Food Handler Exam 1003</a>';


	$quiz_title3 = '<span class="failed_icon"></span><a href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1002/">Food Handler Exam 1002</a>';

	$quiz_title4 = '<span class="failed_icon"></span><a href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1001/">Food Handler Exam 1001</a>';

	$certificatefunc = "https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz=602&time=1510200226";
	$certificate = '<div id ="idnum" ><div class="certificate_icon"></div></div>';
	$certicon = '<a href="" class="first" style="outline: none;"><div class="certificate_icon_large"></div></a>';

if($postid == '6921'){

	global $wpdb;


    $user_info = wp_get_current_user();

    $fname = $user_info->user_firstname;
    $lname = $user_info->user_lastname;
    $email = $user_info->user_email;

	$get_postid = $wpdb->get_results (
	            "
	          	SELECT post_id FROM wp_postmeta 
	          	WHERE meta_value = '{$email}'
	          	ORDER BY post_id DESC
	           
	            "
	            );
	$get_postid = json_decode(json_encode($get_postid), True);
	$pid = $get_postid[0]['post_id'];
	
	$cert_fname = "";
 	$cert_lname = "";
 	$cert_fname = get_post_meta( $pid, 'cert_first_name', true );
	$cert_lname = get_post_meta( $pid, 'cert_last_name', true );
	$index = 0;
	$index1 = 0;
	if($cert_fname != "" || $cert_lname != ""){
		$cert_full = $cert_fname." ".$cert_lname;
	}else{
		$cert_full = do_shortcode( "[usermeta field='first_name'] [usermeta field='last_name']" );
	}

	$current_user = wp_get_current_user();
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"> </script>';
	?>
	<script>


	var a = <?php  echo $newarr; ?> ;
	var timestamp;
	
	for (var i = 0 ; i < a.length; i++) {
			
		if(a[i][3] >= 75){

			timestamp = a[i][3]
		}
	}

	
	var date_started = new Date(timestamp*1000);
	var c = new Date(date_started.toLocaleDateString());
	var months =  ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

	var started = ''+months[c.getUTCMonth()]+' '+c.getDate() +', ' +c.getFullYear();
	var expiry_date =  ''+months[c.getUTCMonth()]+' '+c.getDate()+', '+(c.getFullYear()+3);





	
	console.log(a);	


	var canvas , ctx;

   function doCanvas() {
       / draw something /
   var img = document.getElementsByClassName('sample2')[0];    
   ctx.beginPath();
   ctx.rect(0, 0, 380, 230);
   ctx.fillStyle = "white";
   ctx.fill();
   ctx.drawImage(img, 0, 0, 380, 230); 

   }

   /**
    * This is the function that will take care of image extracting and
    * setting proper filename for the download.
    * IMPORTANT: Call it from within a onclick event.
   */
   function downloadCanvas(link, canvasId, filename) {
       link.href = document.getElementById(canvasId).toDataURL();
       link.download = filename;
   }

   /**
    * The event handler for the link's onclick event. We give THIS as a
    * parameter (=the link element), ID of the canvas and a filename.
   */

   function nowSave(){
    doCanvas();
       var namefile = prompt("insert name of file to save in png");
       if(namefile === "") {
           alert("You must enter name of file")
       } else {    
       downloadCanvas(document.getElementById("download"), 'canvas', namefile + ".png");
       }
   }
   function savePDF(){
      try {
       doCanvas();
      canvas.getContext('2d');
      var imgData = canvas.toDataURL("image/jpeg", 1.0);
         var pdf = new jsPDF('l', 'mm', [100.054, 60.85]);
         pdf.addImage(imgData, 'JPEG', 0, 0);
         var namefile = '<?php echo $current_user->user_firstname; ?>'+'<?php echo $current_user->user_lastname; ?>'
          pdf.save(namefile + ".pdf");
      } catch(e) {
       alert("Error description: " + e.message);
      }
      
    }


window.addEventListener('load', function(event) {

jQuery(".sample2").img2blob({
            watermark: "<?php echo $cert_full; ?>",
            fontStyle: "Roboto",
            fontSize: '18',
            fontColor: '#0b1ce8',
            fontX: 200,
            fontY: 91
        }, {
            watermark: 'F<?php echo do_shortcode("[usermeta field='ID']"); ?>',
            fontStyle: "Verdana",
            fontSize: '9',
            fontColor: '#6B6B6B',
            fontX: 205,
            fontY: 192
        }, {
            watermark: ''+started,
            fontStyle: "Verdana",
            fontSize: '9',
            fontColor: '#6B6B6B',
            fontX: 170,
            fontY: 202
        }, {
             watermark: ''+expiry_date,
            fontStyle: "Verdana",
            fontSize: '9',
            fontColor: '#6B6B6B',
            fontX: 190,
            fontY: 212
        });


     canvas = document.getElementById('canvas');
        ctx = canvas.getContext('2d');

});



	</script>		


	<?php

}

if ($postid == '181' ) {

	global $wpdb;


    $user_info = wp_get_current_user();

    $fname = $user_info->user_firstname;
    $lname = $user_info->user_lastname;
    $email = $user_info->user_email;
      
	$get_postid = $wpdb->get_results (
	            "
	          	SELECT post_id FROM wp_postmeta 
	          	WHERE meta_value = '{$email}'
	          	ORDER BY post_id DESC
	           
	            "
	            );
	$get_postid = json_decode(json_encode($get_postid), True);
	$pid = $get_postid[0]['post_id'];
	
	$cert_fname = "";
 	$cert_lname = "";
 	$cert_fname = get_post_meta( $pid, 'cert_first_name', true );
	$cert_lname = get_post_meta( $pid, 'cert_last_name', true );
	$index = 0;
	$index1 = 0;
	if($cert_fname != "" || $cert_lname != ""){
		$cert_full = $cert_fname." ".$cert_lname;
	}else{
		$cert_full = do_shortcode( "[usermeta field='first_name'] [usermeta field='last_name']" );
	}

	$current_user = wp_get_current_user();

	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"> </script>';	
	echo "<script>

		var a ='".$newarr."';
		var timestamp = 0;
		var isCert = false;

		
		console.log(a);

		if(a == 'null'){

			window.location = 'https://foodhandlersolutions.com/404';
		}	


		else{


		data = JSON.parse(a);
		console.log(a);


		for(var i = 0; i<data.length;i++){

			console.log(parseInt(data[i][2]) >= 75);
			

			if(parseInt(data[i][2]) >= 75 || data[i][2] == 'null'){
						isCert = true;
			}

		}

		if(isCert == false){
			
			window.location = 'https://foodhandlersolutions.com/404';
		}
		}




		</script> ";

	?>	

<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>


		<script>
            
			var canvas , ctx;
			
			function doCanvas() {
			    /* draw something */
			var img = document.getElementsByClassName('sample2')[0];    
			ctx.beginPath();
			ctx.rect(0, 0, 1088, 750);
			ctx.fillStyle = "white";
			ctx.fill();
			ctx.drawImage(img, 0, 0 , 1088 , 750);	

			}

			/**
			 * This is the function that will take care of image extracting and
			 * setting proper filename for the download.
			 * IMPORTANT: Call it from within a onclick event.
			*/
			function downloadCanvas(link, canvasId, filename) {
			    link.href = document.getElementById(canvasId).toDataURL();
			    link.download = filename;
				
			}

			/** 
			 * The event handler for the link's onclick event. We give THIS as a
			 * parameter (=the link element), ID of the canvas and a filename.
			*/

			function nowSave(){
				doCanvas();
			    var namefile = prompt("insert name of file to save in png");
			    if(namefile === "") {
			        alert("You must enter name of file")
			    } else {    
			    downloadCanvas(document.getElementById("download"), 'canvas', namefile + ".png");
			    }
			}
			function savePDF(){
					 try {
					 	doCanvas();
						canvas.getContext('2d');
						var imgData = canvas.toDataURL("image/jpeg", 1.0);
					    var pdf = new jsPDF('l', 'mm', [297, 210]);
					    pdf.addImage(imgData, 'JPEG', 5, 5);
					    var namefile = '<?php echo $current_user->user_firstname; ?>'+'<?php echo $current_user->user_lastname; ?>'
 					    pdf.save(namefile + ".pdf");
					 } catch(e) {
						 alert("Error description: " + e.message);
					 }
					 
				}

			console.log('<?php echo $cert_full; ?>');
			window.addEventListener('load', function(event) {
		jQuery(".sample2").img2blob({
            watermark: "<?php echo $cert_full; ?>",
            fontStyle: "Roboto",
            fontSize: '45',
            fontColor: '#0b1ce8',
            fontX: 600,
            fontY: 453
        }, {
            watermark: 'F<?php echo do_shortcode("[usermeta field='ID']"); ?>',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
            fontX: 530,
            fontY: 810
        }, {
            watermark: '<?php echo do_shortcode("[info_exam_cert info='exp_date']");?> ',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
			 fontX: 495,
            fontY: 863
           
        }, {
            watermark: '<?php echo do_shortcode("[info_exam_cert info='issue_date']")?>',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
            fontX: 450,
            fontY: 837
        });
  
		setInterval(function(){ 
		
			if(  jQuery('.sample2')[0].src !== '' ){

				 jQuery('#preload')[0].style.display='none';
			}



		}, 1000);	
      

				 canvas = document.getElementById('canvas');
    			 ctx = canvas.getContext('2d');
					

			/**
			 * Demonstrates how to download a canvas an image with a single
			 * direct click on a link.
			 */
		
			// document.getElementById('download').addEventListener('click', nowSave, false);
			document.getElementById('downloadpdf').addEventListener('click', savePDF, false);
			/**
			 * Draw something to canvas
			 */
	

			});	

		</script>

		<style >
						
			#preload{
				width: 100%;
			    height: 100%;
			    background-color: white;
			}

			.loader {

			  border: 10px solid #f3f3f3;
			  border-radius: 50%;
			  border-top: 10px solid hsl(213,81%,30%);
			  width: 5em;
			  height: 5em;
			  -webkit-animation: spin 2s linear infinite; /* Safari */
			  animation: spin 2s linear infinite;]
			 
			}

			/* Safari */
			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

		</style>

	<?php
	

}







if ($postid == '1509' ) {
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"> </script>';	
	echo "<script>

		var a ='".$newarr."';
		var timestamp = 0;
		var isCert = false;

		
		console.log(a);

		if(a == 'null'){

			window.location = 'https://foodhandlersolutions.com/404';
		}	


		else{


		data = JSON.parse(a);
		console.log(a);


		for(var i = 0; i<data.length;i++){

			console.log(parseInt(data[i][2]) >= 75);
			

			if(parseInt(data[i][2]) >= 75 || data[i][2] == 'null'){
						isCert = true;
			}

		}

		if(isCert == false){
			
			window.location = 'https://foodhandlersolutions.com/404';
		}
		}




		</script> ";

	?>	

<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>


		<script>
			window.addEventListener('load', function(event) {
		jQuery(".sample2").img2blob({
            watermark: "<?php echo do_shortcode("[info_exam_cert info='name']"); ?>",
            fontStyle: "Roboto",
            fontSize: '45',
            fontColor: '#0b1ce8',
            fontX: 600,
            fontY: 453
        }, {
            watermark: 'F<?php echo do_shortcode("[info_exam_cert info='cert_num']"); ?>',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
            fontX: 530,
            fontY: 810
        }, {
            watermark: '<?php echo do_shortcode("[info_exam_cert info='exp_date']");?> ',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
			 fontX: 495,
            fontY: 863
           
        }, {
            watermark: '<?php echo do_shortcode("[info_exam_cert info='issue_date']")?>',
            fontStyle: "Verdana",
            fontSize: '18',
            fontColor: '#6B6B6B',
            fontX: 450,
            fontY: 837
        });
			});	

		</script>

		<style >
						
			#preload{
				width: 100%;
			    height: 100%;
			    background-color: white;
			}

			.loader {

			  border: 10px solid #f3f3f3;
			  border-radius: 50%;
			  border-top: 10px solid hsl(213,81%,30%);
			  width: 5em;
			  height: 5em;
			  -webkit-animation: spin 2s linear infinite; /* Safari */
			  animation: spin 2s linear infinite;]
			 
			}

			/* Safari */
			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

		</style>

	<?php
	

}

//if ($postid == 6077) {
	
	// echo 'stringsss'.$postid;



	global $wpdb;

	$result = $wpdb->get_results (
	            "
	          	SELECT ID FROM wp_users ORDER BY ID ASC
	           
	            "
	            );
	$users = '';

	$ids = '';

	foreach ($result as $value){
    $ids = $ids.",{$value->ID}";
	}
	// echo '<pre>';
	// echo   $ids;
	// print_r($result);
	// echo '<pre>';
	?>
	<script type="text/javascript">
		
		var centers1 = [];

		function get_testing_centers(zip){

		jQuery.get('https://dev-fhs.tk/wp-json/application/v1/testing/'+zip , 
			function(res){
				var wwidth = window.innerWidth;
				if (wwidth < 760) { 
					jQuery('#preload').removeClass('modal-show');
					jQuery('#preload').addClass('modal-hide');
					jQuery('#zipmodal').removeClass('modal-hide');
					jQuery('#zipmodal').addClass('modal-show');
				}else{
					jQuery('#preload')[0].style.display = 'none';
					jQuery('#zipmodal').css('display','block');
				}
				let centers = JSON.parse(res);
				centers1 = centers;
				centers1.sort((a, b) => a.Distance !== b.Distance ? a.Distance < b.Distance ? -1 : 1 : 0);
				let htmlcenters = '';
				console.log(centers); 
				var ctr = 0;
  				htmlcenters += '<div class="result_main_title"><h1>CHOOSE YOUR EXAM LOCATION</h1></div><hr style="margin-bottom:0;border-top: 1px solid #c7c7c7;">';
			    jQuery.each(centers1, function( index, value ) {
      				ctr++;
      				if(ctr<=50){
	      				htmlcenters += '<a href="'+zip_href+'"><div class="result_cont"><div class="result_title"><p>Testing Center ' + value.SiteCode + ' - ' + value.Distance + ' Miles</p></div>';
	      				htmlcenters += '<div class="result_text"><p>' + value.Address1 +' '+ value.Address2 + ', ' + value.City +', '+ value.StateProvince + '</p></div><hr></div></a>';
      				}
   	 			});


    			jQuery('.login-modal-content')[0].innerHTML = htmlcenters ;
			
			});

		}
	</script>

	<?php


$ub_state = 0;
$states_arr = [789,668,656,690,647,664,800,806,811,791,785,670,649,766,820,686,678,769,692,795,808,804,818,684,787,688,660,676,651,813,816,666,793,781,672,771,680,636,773,797,783,674,779,682,2943,802,777,633,775,694,662];
foreach ($states_arr as $state){
	if($postid == $state){
		$ub_state = $postid;
	}
}
if($postid == $ub_state || $postid == 155 || $postid == 6077){



	?>
		<script type="text/javascript">
			window.addEventListener('load', function(event) {
				jQuery('.ub-emb-container').remove();
			});
		</script>
	<?php
}
?>
<script type="text/javascript">
	// var localStorage = window.localStorage;
	// localStorage.setItem('refresher',"allowed");
	var time = 600;
		// console.log(refresher);
	if(localStorage.getItem('refresher') == null){
		localStorage.setItem("refresher",60);
	}
	var refresher = localStorage.getItem('refresher');
	if(refresher == 60){
		if(localStorage.getItem('main') < 0 || localStorage.getItem('main') == null){
			localStorage.setItem("main",time);
		}
		localStorage.setItem("refresher", 0);
	}
	// console.log('main'+localStorage.getItem('main'));
	
</script>
<?php
if($postid == $ub_state){
	$countdown1 = '';
	$countdown2 = '';
	$countdown1 .= '<div class="countdown_timer"><div id="timer1" class="timer">';
	$countdown2 .= '</div>';
	$countdown3 = '';
	$countdown4 = '';
	$countdown3 .= '<div id="timer2" class="timer">';
	$countdown4 .= '</div>';
	$countdown4 .= '<div class="countdown_badge">Now Only <b>$8.97!</b></div></div>';
	?>
		<script type="text/javascript">
			window.addEventListener('load', function(event) {
				jQuery('.sub-text-head')[0].innerHTML += '<?php echo $countdown1;?>00<?php echo $countdown2;?><span class="colon_counter">:</span><?php echo $countdown3;?>00<?php echo $countdown4;?>';
				var inSec = 0;
				var inMin = 0;
				var count_refresh = localStorage.getItem('refresher');
				setInterval(function(){
					var main_counter = localStorage.getItem('main');
					var getMin = Math.floor(main_counter/60);
					var getSec = main_counter - (getMin * 60);
						// console.log(getSec);
						// console.log(getMin);
					if(main_counter  >= 0){
						if(getSec < 10){
							jQuery('#timer2')[0].innerHTML = '0'+getSec;
						}else{
							jQuery('#timer2')[0].innerHTML = getSec;
						}
						if(getMin < 10){
							jQuery('#timer1')[0].innerHTML = '0'+getMin;
						}else{
							jQuery('#timer1')[0].innerHTML = getMin;
						}
						main_counter --;
						localStorage.setItem("main",main_counter);
					}
					if(main_counter < 0){
						jQuery('.btn.btn-success').removeAttr('href');
						jQuery('.btn.btn-success').css({'cursor':'not-allowed','opacity':'.5'});
						if(count_refresh < 60){
							localStorage.setItem("refresher", count_refresh);
							count_refresh ++;
						}else{
							localStorage.setItem("refresher", count_refresh);
						}
						// console.log("remaining: "+(60 - count_refresh));
					}
				},1000);
			});
		</script>
	<?php
}
if($postid == 5960){
	$practice = '';
	$practice .= '<div id="learndash_lessons" class="learndash_quizzes">';
	$practice .= '<div id="lesson_heading">';
	$practice .= '<span>Exams</span>';
	$practice .= '<span class="right">Status</span>';
	$practice .= '</div>';
	$practice .= '<div id="quiz_list" class="“quiz_list”">';
	$practice .= '<div id="post-7311" class="is_not_sample">';
	$practice .= '<div class="list-count">1</div>';
	$practice .= '<h4>';
	$practice .= '<a class="notcompleted" href="https://foodhandlersolutions.com/courses/manager-certification-course/exams/manager-practise-exam/">Manager Practise Exam</a>';
	$practice .= '</h4>';
	$practice .= '</div>';
	$practice .= '</div>';
	$practice .= '</div>';

	?>
	<script type="text/javascript">
		window.addEventListener('load', function(event) {
			jQuery('#learndash_course_content')[0].innerHTML += '<?php echo $practice; ?>';
			jQuery('#learndash_quizzes').css('display','none');
		});
	</script>
	<?php

}
if($postid == 7311){
	?>
	<script type="text/javascript">
		window.addEventListener('load', function(event) {
			jQuery('.wpProQuiz_content h2').css('display','none');
		});
	</script>
	<?php
}
if($postid == 6077){

	// global $wpdb;	

	// 	// $result = $wpdb->get_results ( 
	// 	// "SELECT PostalCode FROM testing_centers");

	// 	// $zip = '';
	// 	// foreach ($result as $value) {
		
	// 	// 	$length = strlen((string)$value->PostalCode);
		
	// 	// 	if ($length == 4) {
	// 	// 		$zip = $zip.',0'.$value->PostalCode;
	// 	// 	}
	// 	// 	elseif ($length == 5) {
	// 	// 		$zip = $zip.','.$value->PostalCode;
	// 	// 	}
	// 	// 	elseif ($length == 3) {
	// 	// 		$zip = $zip.',00'.$value->PostalCode;
	// 	// 	}
	// 	// 	elseif ($length == 2) {
	// 	// 		$zip = $zip.',000'.$value->PostalCode;
	// 	// 	}
	// 	// 	elseif ($length == 1) {
	// 	// 		$zip = $zip.',0000'.$value->PostalCode;
	// 	// 	}

	// 	// 	else{
	// 	// 	$zip = $zip;
	// 	// 	}
	// 	// }

	// 		// $data =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|90230|01606|45241|95134|78741|98043|19106|30080|27616|22046|07410|10119|28217|06033|29210|75251|00968|95628|80111|48108|27407|23320|70001|20006|55431|94066|94502|33166|30328|85015|60148|79424|78504|75701|92807|15146|77036|21046|12601|84123|55812|84042|21286|97401|97230|97267|99208|98901|98424|77040|79925|79109|76710|78413|79605|78232|79762|77062|75201|85364|85701|85338|92630|95403|95929|93010|92122|91730|91765|95219|93301|96003|93458|90247|32256|33401|34236|33004|32308|32117|32605|33609|65804|63146|64086|65101|73112|74501|73501|73801|37922|37421|37040|37217|40222|40208|40509|41042|80501|71111');

	// 		$data =httpGet('https://www.zipcodeapi.com/rest/fPuRU6kMeSHglJg5oLK6VxT0kkShz5RudmzyawyqTmVgJ6GKS10QSQTf8ZvDGinN/radius.json/90230/500/miles?minimal');
	// 		// sleep(7);

	// 		// sleep(7);
	// 		// $arr1 =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|71302|70609|00000|44333|43085|44130|44907|44446|44060|66614|67226|28801|28403|27834|19428|21224|15237|18104|17112|16509|17601|18411|47802|47714|47905|46545|46835|46250|87402|88203|87505|87113|83642|29615|89123|89502|49546|48912|48154|48226|49855|49724|48098|06473|06851|01089|36609|36107|36305|36849|35806|99518|72903|71854|30597|61820|31406|30345|31210|31707|31602|96813|60178|60015|61614|60435|62526|62901|60602|52722|52233|51054|50266|04106|45324|21804|20814|20785|39232|39437|59102|59601|68154|69361|68516|69101|02864|03801|08021');
						

	// 		$arr = json_decode(stripslashes($data));
	// 		$arr = json_decode(json_encode($arr), True);
	// 		// $arr1 = json_decode(stripslashes($arr1));
	// 		// $arr1 = json_decode(json_encode($arr1), True);
 // 			$totalarr = count($arr['zip_codes']);
	
	// 		$zip = '';
 // 			foreach ($arr['zip_codes'] as $value) {
		
	// 		$length = strlen((string)$value);
		
	// 		if ($length == 4) {
	// 			$zip = $zip.',0'.$value;
	// 		}
	// 		elseif ($length == 5) {
	// 			$zip = $zip.','.$value;
	// 		}
	// 		elseif ($length == 3) {
	// 			$zip = $zip.',00'.$value;
	// 		}
	// 		elseif ($length == 2) {
	// 			$zip = $zip.',000'.$value;
	// 		}
	// 		elseif ($length == 1) {
	// 			$zip = $zip.',0000'.$value;
	// 		}

	// 		else{
	// 		$zip = $zip;
	// 		}
	// 	}	

	// 	$zip = substr($zip, 1);

	// 	$centers = $wpdb->get_results ( 
	// 	"SELECT *  FROM testing_centers WHERE PostalCode IN ({$zip})");




	// 	echo '<pre>';

	// 	print_r($centers);	
	// 	// print_r($zip);
	// 	// print_r($arr); 
	// 	print_r($totalarr); 
	// 	echo '</pre>';



	?>
	<!-- <style type="text/css"> 
	#eapps-pricing-table-1{
		display: none;
	}

	</style> -->

	<style>
			
			#preload{

				position: fixed;
			    top: 60%;
			    left: 50%;
			    display: none;
			    
			    padding: .8em 1.2em;
			    color: white;
			    
			    z-index: 1;
			    padding-top: 150px;
			    width: 100%;
			    height: 100%;
			    overflow: auto;
			    background-color: rgb(0,0,0);
			    background-color: rgba(0,0,0,0.4);

			    -webkit-transform: translate(-50%, -50%);
			    -moz-transform: translate(-50%, -50%);
			    -ms-transform: translate(-50%, -50%);
			    -o-transform: translate(-50%, -50%);
			    transform: translate(-50%, -50%);
			}

			.loader {
			  border: 10px solid #f3f3f3;
			  border-radius: 50%;
			  border-top: 10px solid hsl(213,81%,30%);
			  width: 5em;
			  height: 5em;
			  -webkit-animation: spin 2s linear infinite; /* Safari */
			  animation: spin 2s linear infinite;
			 
			}

			/* Safari */
			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

		</style>
	 <script type="text/javascript">

	 	// var array = <?php echo $data; ?> ;
	 	// console.log(array.zip_codes);
	var wwidth = window.innerWidth;
	 window.addEventListener('load', function(event) {
 		jQuery('#eapps-pricing-table-1')[0].style.display ="none";
		// if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)  { 
		//    alert('safari');
		// }
		// alert();
		// if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1)  { 
	   	if(wwidth<760){
	   		// alert(wwidth);
		   	// console.log('safari1');
			jQuery('path').on({ 'touchstart' : function(){
				// alert();
				jQuery('#path_click').html('click okay');
				jQuery(".state-content").html( jQuery("span#tipus div#State-AL"));
				jQuery("div#State-AL").css("display", "block");
			 	jQuery('#eapps-pricing-table-1').css("display", "block");

					jQuery('html, body').animate({
					    scrollTop: jQuery("#eapps-pricing-table-1").offset().top
					  }, 1000);
				

			}});

			jQuery('#mapbase text').on({ 'touchstart' : function(){

				jQuery('#path_click').html('click okay');
				jQuery(".state-content").html( jQuery("span#tipus div#State-AL"));
				jQuery("div#State-AL").css("display", "block");
			  	jQuery('#eapps-pricing-table-1').css("display", "block");
								
				  	jQuery('html, body').animate({
					    scrollTop: jQuery("#eapps-pricing-table-1").offset().top
				  	}, 1000);

			}});
		}else{
			// console.log('Chrome1');
			jQuery('path').click(function() {

				jQuery('#path_click').html('click okay');
				jQuery(".state-content").html( jQuery("span#tipus div#State-AL"));
				jQuery("div#State-AL").css("display", "block");
			 	jQuery('#eapps-pricing-table-1').css("display", "block");

					jQuery('html, body').animate({
					    scrollTop: jQuery("#eapps-pricing-table-1").offset().top
					  }, 1000);
				

			});

			jQuery('#mapbase text').click(function() {

				jQuery('#path_click').html('click okay');
				jQuery(".state-content").html( jQuery("span#tipus div#State-AL"));
				jQuery("div#State-AL").css("display", "block");
			  	jQuery('#eapps-pricing-table-1').css("display", "block");
								
				  	jQuery('html, body').animate({
					    scrollTop: jQuery("#eapps-pricing-table-1").offset().top
				  	}, 1000);

			});
		}
	 });

	 </script>

	<?php

}

if($postid  == "5960" ){
	?>	

		<style type="text/css">
			#learndash_course_content{
				margin-top : 2%;
			}
		</style>
		<script type="text/javascript">
			
			window.addEventListener('load', function(event) {

				jQuery('.learndash_content').append("<a style='background-color: #0088aa;color: white;padding: 10px;border-radius: 7px;' href='https://foodhandlersolutions.com/log-in'>MY PROFILE</a>");

			})


		</script>

	<?php
}
	 




if ($postid == '202' || $postid == '178') {


	echo "<script>
       
		var a ='".$newarr."';
		var timestamp = 0;
			

		data = JSON.parse(a);
		console.log(data);



window.addEventListener('load', function(event) {

		
		jQuery('#course-".$user_id."-6212 .list_arrow ').css('background','none');
		
		jQuery('#course-".$user_id."-6212 .list_arrow ').removeAttr('onclick');



	
		

		if(jQuery('#course-".$user_id."-6212  .learndash-course-link a').length !== 0){

			jQuery('#course-".$user_id."-6212  .learndash-course-link a')[0].href = 'https://foodhandlersolutions.com/exam-scheduling-contact-information/';
		}

		if(data.length !== 0){

			jQuery('#course-".$user_id."-178 .flip')[0].innerHTML = '';
			jQuery('#course-".$user_id."-178 .flip')[0].innerHTML = '".$html."';

		}
		var ctr = 0;
		for(var i = 0; i<".$length.";i++){  
			// console.log(i+':'+data[i][3]+'--'+data[i][4]);
				timestamp = data[i][4];
				var pubDate = new Date(timestamp*1000);
				
		
			if(data[i][3] != '' && data[i][4] != ''){
				
				jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes')[0].innerHTML += '".$html1."';

				jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .scores')[ctr+1].innerHTML = data[i][2]+'%';
				jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_date')[ctr+1].innerHTML = pubDate.toLocaleString();
							
			
				// console.log(data[i][2]);
				if(data[i][5] == 1418){
					jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_title')[ctr+1].innerHTML = '".$quiz_title1."';
				}

				else if(data[i][5] == 1416){
					jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_title')[ctr+1].innerHTML = '".$quiz_title2."';
				}

				else if(data[i][5] == 601){
					jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_title')[ctr+1].innerHTML = '".$quiz_title3."';
				}
				else if(data[i][5] == 600){
					jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_title')[ctr+1].innerHTML = '".$quiz_title4."';	
				}
				ctr++;
			}
		}
		var ctr = 0;
		var hold = [];
		for(var i = 0; i<".$length.";i++){
			if(data[i][3] != '' && data[i][4] != ''){
				if(parseInt(data[i][2])>74){

					console.log(data[i][2]);

					hold[ctr] = i;
					jQuery('#course-".$user_id."-178 .flip .learndash_profile_quizzes .quiz_title span')[ctr].className = 'passed_icon';
					document.getElementsByClassName('certificate')[ctr+1].innerHTML = '".$certificate."';
				
				}
				ctr++;
			}
		
		}
		var j = ".$length."-1;
		if(data[j][3] != '' && data[j][4] != ''){
			if(parseInt(data[j][2])>74){
				console.log('last');
				jQuery('#course-".$user_id."-178 .learndash-course-certificate').html('".$certicon."');
				jQuery('#course-".$user_id."-178 .learndash-course-status a').removeClass('notcompleted').addClass('completed');
			}
		}else{
			if(parseInt(data[j-1][2])>74){
				console.log('2nd');
				jQuery('#course-".$user_id."-178 .learndash-course-certificate').html('".$certicon."');
				jQuery('#course-".$user_id."-178 .learndash-course-status a').removeClass('notcompleted').addClass('completed');
			}
		}

		// console.log(hold);
		

	jQuery('.cert_index').click(function() {
      
 		var index = jQuery('.cert_index').index(this);

	   
     		if(jQuery('.cert_index')[index].innerHTML !== '-'){	
	
        		var winindex = hold[index];
	        	
			var win = window.open('https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz='+data[winindex][5]+'&time='+data[winindex][4], '_blank');
	  	
 		win.focus();
	  		
	   }
   	 	
	});
	});
</script>";
  }
	
	


if ($postid == '1416' || $postid == '1418' ) {  
	$user_info = wp_get_current_user();
	$email = $user_info->user_email;  
?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<div id="show" style="display: none;"></div>

<?php
	echo " 
	<script>
	
		var a = '".$newarr."';  
		var isCert = false; 
		console.log(a); 
		window.addEventListener('load', function(event) {
			
		jQuery('[name=startQuiz]').click(function(){
		
				// setTimeout(function(){
			// jQuery('#show').load('https://foodhandlersolutions.com/wp-admin/admin-ajax.php?action=send_email_call');
				// },5000);
				data = JSON.parse(a);
				console.log(a);
				for(var i = 0; i<data.length;i++){
				console.log(parseInt(data[i][2]) >= 75);

				if(parseInt(data[i][2]) >= 75 || data[i][2] == 'null' ){
					var url = 'https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz='+data[i][5]+'&time='+data[i][4];
			
					if(url != null){
							jQuery.ajax({
									type: 'POST',
									data: {'send_url':'true','url': url},
									success: function(data) {
								}
						  });
					}";
			
			if(isset($_REQUEST["send_url"])){
				$url  = $_REQUEST["url"];
				send_email_woocommerce_style($email,"Food Handler Solutions" ,"Certificate", "Click this link"." ".$url." "."to download your certificate" );
			}
				  echo"
				
				 isCert = true;
					}
				  }
			   });
			});

</script> ";

}
		
	
	


if ($postid == '7587') {

		$a = '\n';
		$quote = '"';

		echo "<script>


	
  

window.addEventListener('load', function(event) {
 

		for(var i = 0; i<document.getElementsByClassName('datarow').length;i++){  

document.getElementsByClassName('datarow')[i].innerHTML = tabledata[i];
}
    document.getElementById('download').href = blobURL;
    document.getElementById('download').download = filename;


  });





var url_string = location.href;
var url = new URL(url_string);

 window.URL = window.URL || window.webkiURL;
				
				var fname = url.searchParams.get('fname');
				var lname = url.searchParams.get('lname');
				var address = url.searchParams.get('address');
				var city = url.searchParams.get('city');	
				var state = url.searchParams.get('state');
				var zip = url.searchParams.get('zip');
				var country = url.searchParams.get('country');
				var phone = url.searchParams.get('phone').toString();
				var email = url.searchParams.get('email');
				var date = url.searchParams.get('date');
				var newline = '".$a."';

				var tabledata= [];
				tabledata = ['FHS03CA001','C','','','','','','',fname,'',lname,address,'',city,state,zip,country,'','',phone,'',email];

				var csv = 'Client Code,ExamType (always C),Exam (70 or 75),EligibilityStartDate (leave blank),EligibilityEndDate (leave blank),Site(leave blank),CandidateID(If using candidate ID also enter this number in the SSN field.),SSN DO NOT USE (If using SSN leave CandidateID field blank.),FirstName (required),MiddleName(optional),LastName (required),Address1 (required no PO Box Add business name),Address2,City,State,Zip,Country,Maiden,DOB,Phone 1,Phone 2,Email(required),'+newline+'FHS03CA001,C, , , , , , ,'+fname+', ,'+lname+','+address+', ,'+city+','+state+','+zip+','+country+', , ,'+phone+', ,'+email; 


    var blob = new Blob([csv]);
    var blobURL = window.URL.createObjectURL(blob);
    var quote = '".$quote."';
    var id = 'download';
    var filename = fname+lname+'.csv';
    console.log(blobURL);

			</script>";

	}

}

add_action( 'wp_enqueue_scripts', 'edit_course_list' );		



//add admin menu page

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Coupon Reports', 'Coupon Reports', 'manage_options', 'coupon/coupon-admin-page.php', 'myplguin_admin_page', 'dashicons-tickets', 6  );
    add_submenu_page('coupon/coupon-admin-page.php', 'All Coupons', 'All Coupons', 'manage_options', 'coupon/all-coupon-page.php', 'all_coupon_page' );
}


function myplguin_admin_page(){

	global $wpdb;

	$result = $wpdb->get_results (
	            "
	          	SELECT * FROM wp_woocommerce_order_items
	          	 WHERE order_item_type = 'coupon'
	          	 ORDER BY order_item_id DESC
	           
	            "
	            );

	$ids = '';

	foreach ($result as $value){
    $ids = $ids.",{$value->order_id}";
	}


	$ids = substr($ids, 1);



	$result = json_decode(json_encode($result), True);



	$result1 = $wpdb->get_results (
	            "
	          	SELECT * FROM wp_posts 
	          	WHERE ID IN ({$ids})
	          	ORDER BY post_modified DESC
	           
	            "
	            );



	$result2 = $wpdb->get_results (
	            "
	          	SELECT * FROM wp_postmeta 
	          	WHERE post_id IN ({$ids})
	          	AND meta_key IN ('_customer_user' , '_billing_first_name', '_billing_last_name')
	          	ORDER BY post_id DESC
	           
	            "
	            );

	$index = 0;
	$index1 = 0;

	foreach ($result1 as $value){
    
    $result[$index1]['date'] = $value->post_modified;
	$result[$index1]['user_id'] = $result2[$index]->meta_value;
	$result[$index1]['first_name'] = $result2[$index+1]->meta_value;
	$result[$index1]['last_name'] = $result2[$index+2]->meta_value;


	$index1++;
    $index+=3;
	}



// 	echo '<pre>';


// echo $ids;

// 	print_r($result);


// 	echo '</pre>';





	?>
	<div class="wrap">
		<div id="icon-users" class="icon32"></div>
		<h2>Coupon Reports</h2>

		<p class="search-box">
	<label class="screen-reader-text" for="post-search-input">Search</label>
	<input type="search" id="myInput" name="s" value="" placeholder="Search" onkeyup="myFunction()">
	<input type="submit" id="search-submit" class="button" value="Search"></p>
		
		 <table class="widefat fixed" cellspacing="0" id="myTable">
    <thead>
    <tr>

         	
         	<th id="columnname" class="manage-column column-columnname" scope="col">User ID</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">Customer</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">Order #</th> 
            <th id="columnname" class="manage-column column-columnname" scope="col">Date</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">Coupon</th>
    </tr>
    </thead>

    <tfoot>
    </tfoot>

    <tbody>

   <?php foreach ($result as $value) { ?> 	
        <tr class="alternate">
            <td class="column-columnname"><?php echo $value['user_id']; ?></td>
            <td class="column-columnname"><?php echo $value['first_name']." ".$value['last_name'];?></td>
            <td class="column-columnname"><?php echo $value['order_id']; ?></td>
            <td class="column-columnname"><?php echo $value['date']; ?></td>
            <td class="column-columnname"><?php echo $value['order_item_name']; ?></td>
        </tr>

   <?php } ?>
       
    </tbody>
</table>

	</div>


	<?php


?>

<script>


function myFunction() {
  var input, filter, table, tr, td, i , word;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    td4 = tr[i].getElementsByTagName("td")[4];
    console.log(td);
     console.log(td1);

    if (td || td1 || td2 || td3 || td4) {
    	word = td.innerHTML.toUpperCase() +td1.innerHTML.toUpperCase()+td2.innerHTML.toUpperCase()+td3.innerHTML.toUpperCase()+td4.innerHTML.toUpperCase();
    	console.log(word);

      if (word.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>
<?php



}

function all_coupon_page(){

	global $wpdb;

	$result = $wpdb->get_results (
	            "
	          	SELECT * FROM wp_woocommerce_order_items
	          	 WHERE order_item_type = 'coupon'
	          	 ORDER BY order_item_name ASC
	           
	            "
	            );

	$coupon = '';
	foreach ($result as $value){
    	$coupon = $coupon.",{$value->order_item_name}";	
	}

	$result = json_decode(json_encode($result), True);

	$coupon_result = $wpdb->get_results ("
				SELECT post_id,post_title, meta_key, meta_value 
				FROM wp_posts 
				RIGHT JOIN wp_postmeta 
				ON wp_posts . ID = wp_postmeta . post_id 
				WHERE post_type = 'shop_coupon' 
				AND meta_key = 'usage_limit' 
				ORDER BY post_id ASC
				");

	$ids = '';
	foreach ($coupon_result as $value) {
		$ids = $ids.",{$value->post_id}";
	}
	$ids = substr($ids, 1);

	$coupon_result2 = $wpdb->get_results ("
				SELECT post_id,post_title, meta_key, meta_value 
				FROM wp_posts 
				RIGHT JOIN wp_postmeta 
				ON wp_posts . ID = wp_postmeta . post_id 
				WHERE post_id IN ({$ids})
				AND meta_key = 'usage_count'
				ORDER BY post_id ASC
				");

	$coupon_result = json_decode(json_encode($coupon_result), True);
	$coupon_result2 = json_decode(json_encode($coupon_result2), True);

	$coupons[] = array();
	$ctr1 = 0;
	$ctr2 = 0;

	// echo $ids;
	// echo '<pre>';
	// print_r($coupon_result2);
	// echo '</pre>';

	foreach ($coupon_result as $value) {
		$coupons[$ctr1]['id'] = $coupon_result[$ctr1]['post_id'];
		$coupons[$ctr1]['name'] = $coupon_result[$ctr1]['post_title'];
		if($coupon_result[$ctr1]['post_id'] == $coupon_result2[$ctr2]['post_id']){
			$coupons[$ctr1]['use'] = $coupon_result2[$ctr2]['meta_value'];
			$ctr2++;
		}else{
			$coupons[$ctr1]['use'] = '0';
		}
		if($coupon_result[$ctr1]['meta_value'] == 0){
			$coupons[$ctr1]['limit'] = 'No limit';
			$coupons[$ctr1]['remaining'] = '-';
		}else{
			$coupons[$ctr1]['limit'] = $coupon_result[$ctr1]['meta_value'];
			$coupons[$ctr1]['remaining'] = $coupons[$ctr1]['limit']-$coupons[$ctr1]['use'];
		}
		// echo "<script>console.log('".$coupons[$ctr1]['remaining']."')</script>";

		$ctr1++;
	}

	// echo '<pre>';
	// echo $ids;
	// print_r($coupons);
	// echo '</pre>';

	// $couponname = '';
	// $ctr1 = -1;
	// for ($x = 0; $x < sizeof($result); $x++) {

	// 	if($couponname != $result[$x]['order_item_name']){
	// 		$ctr2 = 0;
	// 		$couponname = $result[$x]['order_item_name'];
	// 		$ctr1++;
	// 		$coupons[$ctr1]['name'] = $couponname;
 //    	}
 //    	$ctr2++;
	// 	$coupons[$ctr1]['use'] = $ctr2;
	// }


	// echo '<pre>';
	// print_r($coupons);
	// echo '</pre>';




	?>
	<div class="wrap">
		<div id="icon-users" class="icon32"></div>
		<h2>All Coupons</h2>

		<p class="search-box">
	<label class="screen-reader-text" for="post-search-input">Search</label>
	<input type="search" id="myInput" name="s" value="" placeholder="Search" onkeyup="myFunction()">
	<input type="submit" id="search-submit" class="button" value="Search"></p>
		
		 <table class="widefat fixed" cellspacing="0" id="myTable">
    <thead>
    <tr>

         	
         	<th id="columnname" class="manage-column column-columnname" scope="col">Coupon Name</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">Usage Count</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">Usage Limit</th> 
            <th id="columnname" class="manage-column column-columnname" scope="col">Remaining</th> 
    </tr>
    </thead>

    <tfoot>
    </tfoot>

    <tbody>

   <?php foreach ($coupons as $value) { ?> 	
        <tr class="alternate">
            <td class="column-columnname"><?php echo $value['name']; ?></td>
            <td class="column-columnname"><?php echo $value['use']; ?></td>
            <td class="column-columnname"><?php echo $value['limit']; ?></td>
            <td class="column-columnname"><?php echo $value['remaining']; ?></td>
        </tr>

   <?php } ?>
       
    </tbody>
</table>

	</div>


	<?php


?>

<script>


function myFunction() {
  var input, filter, table, tr, td, i , word;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[3];
    console.log(td);
     console.log(td1);

    if (td || td1 || td2 ) {
    	word = td.innerHTML.toUpperCase() +td1.innerHTML.toUpperCase()+td2.innerHTML.toUpperCase()+td3.innerHTML.toUpperCase();
    	console.log(word);

      if (word.indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>
<?php



}


//redirect if not login on page https://foodhandlersolutions.com/exam-scheduling-contact-information/

function my_page_template_redirect()
{
    if( is_page( 6311 ) && ! is_user_logged_in() )
    {
        wp_redirect( home_url( '/404/' ) );
        die;
    }
}
add_action( 'template_redirect', 'my_page_template_redirect' );


		function httpGet($url)
{
    $ch = curl_init();  

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}


add_action('wp_ajax_get_testing_center' , function() {  

	$zip_code = $_REQUEST['zip_code'];

	global $wpdb;	

		// $result = $wpdb->get_results ( 
		// "SELECT PostalCode FROM testing_centers");

		// $zip = '';
		// foreach ($result as $value) {
		
		// 	$length = strlen((string)$value->PostalCode);
		
		// 	if ($length == 4) {
		// 		$zip = $zip.',0'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 5) {
		// 		$zip = $zip.','.$value->PostalCode;
		// 	}
		// 	elseif ($length == 3) {
		// 		$zip = $zip.',00'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 2) {
		// 		$zip = $zip.',000'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 1) {
		// 		$zip = $zip.',0000'.$value->PostalCode;
		// 	}

		// 	else{
		// 	$zip = $zip;
		// 	}
		// }

			// $data =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|90230|01606|45241|95134|78741|98043|19106|30080|27616|22046|07410|10119|28217|06033|29210|75251|00968|95628|80111|48108|27407|23320|70001|20006|55431|94066|94502|33166|30328|85015|60148|79424|78504|75701|92807|15146|77036|21046|12601|84123|55812|84042|21286|97401|97230|97267|99208|98901|98424|77040|79925|79109|76710|78413|79605|78232|79762|77062|75201|85364|85701|85338|92630|95403|95929|93010|92122|91730|91765|95219|93301|96003|93458|90247|32256|33401|34236|33004|32308|32117|32605|33609|65804|63146|64086|65101|73112|74501|73501|73801|37922|37421|37040|37217|40222|40208|40509|41042|80501|71111');

			$data =httpGet('https://www.zipcodeapi.com/rest/nfAk3jRnx5W1yWaDamg12K4crQlvInjxIcSjO9axFop8saXq7ErfrvSxRPDpKUZa/radius.json/'.$zip_code.'/500/miles?minimal');
			// sleep(7);

			// sleep(7);
			// $arr1 =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|71302|70609|00000|44333|43085|44130|44907|44446|44060|66614|67226|28801|28403|27834|19428|21224|15237|18104|17112|16509|17601|18411|47802|47714|47905|46545|46835|46250|87402|88203|87505|87113|83642|29615|89123|89502|49546|48912|48154|48226|49855|49724|48098|06473|06851|01089|36609|36107|36305|36849|35806|99518|72903|71854|30597|61820|31406|30345|31210|31707|31602|96813|60178|60015|61614|60435|62526|62901|60602|52722|52233|51054|50266|04106|45324|21804|20814|20785|39232|39437|59102|59601|68154|69361|68516|69101|02864|03801|08021');
						

			$arr = json_decode(stripslashes($data));
			$arr = json_decode(json_encode($arr), True);
			// $arr1 = json_decode(stripslashes($arr1));
			// $arr1 = json_decode(json_encode($arr1), True);
 			$totalarr = count($arr['zip_codes']);
	
			$zip = '';
 			foreach ($arr['zip_codes'] as $value) {
		
			$length = strlen((string)$value);
		
			if ($length == 4) {
				$zip = $zip.',0'.$value;
			}
			elseif ($length == 5) {
				$zip = $zip.','.$value;
			}
			elseif ($length == 3) {
				$zip = $zip.',00'.$value;
			}
			elseif ($length == 2) {
				$zip = $zip.',000'.$value;
			}
			elseif ($length == 1) {
				$zip = $zip.',0000'.$value;
			}

			else{
			$zip = $zip;
			}
		}	

		$zip = substr($zip, 1);

		$centers = $wpdb->get_results ( 
		"SELECT *  FROM testing_centers WHERE PostalCode IN ({$zip})");



			echo json_encode($centers);


	


});

add_action( 'rest_api_init', 'get_testing_centers_api');
 
function get_testing_centers_api(){
    register_rest_route( 'application/v1', 'testing/(?P<zip>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_testing_centers',
         'args' => array(
          'zip' => array(
            'validate_callback' => function($param,$request,$key){
                return is_numeric($param);
            }
          ),
         ),
         
    ));
}

function get_testing_centers(WP_REST_Request $request ){

$zip_code = $request->get_param( 'zip' );  
$zip_length = strlen((string)$zip_code);
if($zip_length == 4){
	$zip_code ='0'.$zip_code;
}
elseif($zip_length == 3){
	$zip_code ='00'.$zip_code;
}
elseif($zip_length == 2){
	$zip_code ='000'.$zip_code;
}

elseif($zip_length == 1){
	$zip_code ='0000'.$zip_code;
}


global $wpdb;	

		// $result = $wpdb->get_results ( 
		// "SELECT PostalCode FROM testing_centers");

		// $zip = '';
		// foreach ($result as $value) {
		
		// 	$length = strlen((string)$value->PostalCode);
		
		// 	if ($length == 4) {
		// 		$zip = $zip.',0'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 5) {
		// 		$zip = $zip.','.$value->PostalCode;
		// 	}
		// 	elseif ($length == 3) {
		// 		$zip = $zip.',00'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 2) {
		// 		$zip = $zip.',000'.$value->PostalCode;
		// 	}
		// 	elseif ($length == 1) {
		// 		$zip = $zip.',0000'.$value->PostalCode;
		// 	}

		// 	else{
		// 	$zip = $zip;
		// 	}
		// }

			// $data =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|90230|01606|45241|95134|78741|98043|19106|30080|27616|22046|07410|10119|28217|06033|29210|75251|00968|95628|80111|48108|27407|23320|70001|20006|55431|94066|94502|33166|30328|85015|60148|79424|78504|75701|92807|15146|77036|21046|12601|84123|55812|84042|21286|97401|97230|97267|99208|98901|98424|77040|79925|79109|76710|78413|79605|78232|79762|77062|75201|85364|85701|85338|92630|95403|95929|93010|92122|91730|91765|95219|93301|96003|93458|90247|32256|33401|34236|33004|32308|32117|32605|33609|65804|63146|64086|65101|73112|74501|73501|73801|37922|37421|37040|37217|40222|40208|40509|41042|80501|71111');

			$data =httpGet('https://www.zipcodeapi.com/rest/nfAk3jRnx5W1yWaDamg12K4crQlvInjxIcSjO9axFop8saXq7ErfrvSxRPDpKUZa/radius.json/'.$zip_code.'/500/miles');
			// sleep(7);

			// sleep(7);
			// $arr1 =httpGet('http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=90230&destinations=|71302|70609|00000|44333|43085|44130|44907|44446|44060|66614|67226|28801|28403|27834|19428|21224|15237|18104|17112|16509|17601|18411|47802|47714|47905|46545|46835|46250|87402|88203|87505|87113|83642|29615|89123|89502|49546|48912|48154|48226|49855|49724|48098|06473|06851|01089|36609|36107|36305|36849|35806|99518|72903|71854|30597|61820|31406|30345|31210|31707|31602|96813|60178|60015|61614|60435|62526|62901|60602|52722|52233|51054|50266|04106|45324|21804|20814|20785|39232|39437|59102|59601|68154|69361|68516|69101|02864|03801|08021');
						

			$arr = json_decode(stripslashes($data));
			$arr = json_decode(json_encode($arr), True);
			// $arr1 = json_decode(stripslashes($arr1));
			// $arr1 = json_decode(json_encode($arr1), True);
 			$totalarr = count($arr['zip_codes']);
	
			$zip = '';
 			foreach ($arr['zip_codes'] as $value) {
		
			$length = strlen((string)$value['zip_code']);
		
			if ($length == 4) {
				$zip = $zip.',0'.$value['zip_code'];
				$zip_codes['zip_code'][] =  '0'.$value['zip_code'];
				$zip_codes['distance'][] =  $value['distance'];
			}
			elseif ($length == 5) {
				$zip = $zip.','.$value['zip_code'];
				$zip_codes['zip_code'][] =  ''.$value['zip_code'];
				$zip_codes['distance'][] =  $value['distance'];
			}
			elseif ($length == 3) {
				$zip = $zip.',00'.$value['zip_code'];
				$zip_codes['zip_code'][] =  '00'.$value['zip_code'];
				$zip_codes['distance'][] =  $value['distance'];
			}
			elseif ($length == 2) {
				$zip = $zip.',000'.$value['zip_code'];
				$zip_codes['zip_code'][] =  '000'.$value['zip_code'];
				$zip_codes['distance'][] =  $value['distance'];
			}
			elseif ($length == 1) {
				$zip = $zip.',0000'.$value['zip_code'];
				$zip_codes['zip_code'][] =  '0000'.$value['zip_code'];
				$zip_codes['distance'][] =  $value['distance'];
			}

			else{
			$zip = $value['zip_code'];
			$zip_codes['zip_code'][] =  ''.$value['zip_code'];
			$zip_codes['distance'][] =  $value['distance'];
			}
		}	

		$zip = substr($zip, 1);
		$zip_codes_total = count($arr['zip_codes']);

		$centers = $wpdb->get_results ( 
		"SELECT *  FROM testing_centers WHERE PostalCode IN ({$zip})");

		foreach ($centers as $value) {
			# code...
			// echo $value->PostalCode.' ';
			$centers_zip_codes[] = $value->PostalCode;

		}

		$centers_total = count($centers);
		$number = 0;

		for ($i=0; $i < $zip_codes_total ; $i++) { 
		
			# code...
			// $index = array_search($centers[$i]->PostalCode, $zip_codes['zip_code']);

			$index = array_search( $arr['zip_codes'][$i]['zip_code'], $centers_zip_codes);

			// echo "[{$i}]".$index ." ";	
			if( $index ){

		
			$centers[$index]->Distance =  $arr['zip_codes'][$i]['distance'];
			$number ++;	
					
			}
		}

			// print_r( $centers_zip_codes );
	return json_encode($centers);
	
}




add_action( 'edit_user_profile', 'edit_user_function' );

function edit_user_function(){
	
	global $wpdb;
		$customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $_GET['user_id'] , 
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_order_statuses() ),  //'post_status' => array('wc-completed', 'wc-processing'),
			) );
 
				?>
				<style>
				table#table_order td {
							border-top: 1px solid #ddd;
						}
				table#table_order 	 tr td {
							padding: 10px 0px;
						}
				</style>
		
		<script>
		
		window.addEventListener('load', function(event) {
			var table_order = document.getElementById("table_order");
				jQuery("div#learndash_delete_user_data").prepend([table_order]);
		});
		</script>
				<?php
		 echo'
		 <table width="50%" id="table_order">
			<thead>
				<tr style="font-size:16px; font-weight: 800;">
					 <td>Order</td>
					 <td>Date</td>
					 <td>Status</td>
					 <td>Total</td>
				</tr>
			</thead>
		 <tbody>';
		foreach($customer_orders as $key => $value){
			  $order = wc_get_order($value->ID);
			  $order_data = $order->get_data();
			  $order_items = $order->get_items();
			  $order_id = $value->ID;
			  $order_status = $order_data['status'];
			  $order_total = $order_data['total'];
			  $order_date_created = $order_data['date_created']->date('F-j-Y');
			foreach ($order_items as $items_key => $items_value) {  
				$qty = $items_value['quantity']; 
			 /* echo "<pre>";
				print_r($order_data);
				echo "</pre>"; */ 
			echo"<tr style='font-size:15px; font-weight: 500;'>
			     	 <td style='color: #ff551d;'>".'#'.$order_id."</td>
					 <td>".$order_date_created ."</td>
					 <td style='text-transform: capitalize;'>".$order_status."</td>
					 <td>".'$'.$order_total." "."for"." ".$qty." "."item"."</td>
				
				</tr>
			";
			}
		}
			echo"</tbody>
		</table>";
		
	
	
	$user_id = $_GET['user_id'];
	
	$result1 = $wpdb->get_results (
	            "
	            SELECT activity_id,activity_started,activity_completed,user_id
	            FROM  wp_learndash_user_activity 
	            WHERE user_id =  {$user_id}
	            AND activity_type = 'quiz' 
	            "
	            );

	$array = '';

	foreach ($result1 as $value){
    	$array = $array.",{$value->activity_id}";
	}

	
	$array = substr($array, 1);


	$result = $wpdb->get_results (
	            "
	            SELECT * 
	            FROM  wp_learndash_user_activity_meta 
	            WHERE activity_id  IN ({$array}) 
	            AND activity_meta_key IN ('points','total_points' ,'started' , 'completed', 'percentage', 'course' ,'quiz')
	           
	            "
	            );

	
	$array1 = json_decode(json_encode($result), True);
	$length1 = count($array1);

	
	$oldid = "";
	for ($x = 0; $x < $length1; $x++) {
		$newid = $array1[$x]['activity_id'];
		if($newid != $oldid){
			$oldid = $newid;
			$newarrid[] = array($oldid);
		}
	}
	for ($x = 0; $x < sizeof($newarrid); $x++) {
		$points = "";
		$total_points = "";
		$started = "";
		$completed = "";
		$percentage = "";
		$course = "";
		$quiz = "";
		for ($y = 0; $y < $length1; $y++) {
			$actid = $array1[$y]['activity_id'];
			// echo "<script>console.log('".$actid." - ".$newarrid[$x]."');</script>";
			if ($actid == $newarrid[$x][0]) {
				if($array1[$y]['activity_meta_key'] == 'points'){
					$points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'total_points'){
					$total_points = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'started'){
					$started = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'completed'){
					$completed = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'percentage'){
					$percentage = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'course'){
					$course = $array1[$y]['activity_meta_value'];
				}
				if($array1[$y]['activity_meta_key'] == 'quiz'){
					$quiz = $array1[$y]['activity_meta_value'];
				}
			}
		}
		$newarr[] = array($points,$total_points,$percentage,$started,$completed,$quiz,$course);
	}

	$newarr = json_encode($newarr);
	$length = count($result1);

	$exam_1004 = '<p><strong><a class="exam_url" href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1004/">Food Handler Exam 1004</a></strong> - <span class="percent" style="color:green">75%</span> - <a class="cert_url" href="https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz=1418&amp;user=3752&amp;certnonce=30379b69d8&amp;time=1531874109" target="_blank">Certificate</a> <a href="https://foodhandlersolutions.com/wp-admin/post.php?post=1418&amp;action=edit&amp;course_id=178">(edit)</a> <a class="remove-quiz remove_url" data-quiz-user-id="3752" href="#" title="remove this exam item">(remove)</a><br><span class="afterbr">Score 30  out of  40  question(s) . Points:  30/40 on  July 17, 2018 5:35 pm</span></p>';
	$exam_1003 = '<p><strong><a class="exam_url" href="https://foodhandlersolutions.com/courses/food-handler-certificate-program/exams/food-handler-exam-1003/">Food Handler Exam 1003</a></strong> - <span class="percent" style="color:green">75%</span> - <a class="cert_url" href="https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz=1418&amp;user=3752&amp;certnonce=30379b69d8&amp;time=1531874109" target="_blank">Certificate</a> <a href="https://foodhandlersolutions.com/wp-admin/post.php?post=1416&amp;action=edit&amp;course_id=178">(edit)</a> <a class="remove-quiz remove_url" data-quiz-user-id="3752" href="#" title="remove this exam item">(remove)</a><br><span class="afterbr">Score 30  out of  40  question(s) . Points:  30/40 on  July 17, 2018 5:35 pm</span></p>';

	echo "<script>

		var a ='".$newarr."';
		var timestamp = 0;
			

		data = JSON.parse(a);
		window.addEventListener('load', function(event) {

		var months =  ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var ctr = 0;
			for(var i = ".$length."-3; i=>0;i--){   
			
				timestamp = data[i][4] - 54000;
				var pubDate = new Date(timestamp*1000);
				var mo = months[pubDate.getMonth()];
				var da = pubDate.getDate();
				var ye = pubDate.getFullYear();
				var ho = pubDate.getHours();
				var mi = pubDate.getMinutes();
				var ampm = ho >= 12 ? 'pm' : 'am';
			  	ho = ho % 12;
			  	ho = ho ? ho : 12;
			  	mi = mi < 10 ? '0'+mi : mi;

				if(data[i][3] != '' && data[i][4] != ''){
					

					if(data[i][5] == 1418){

						jQuery('.ld-quiz-progress-content-container').append('".$exam_1004."');
						jQuery('.cert_url')[ctr].href = 'https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz=1418&user=".$user_id."&time='+data[i][4];
						jQuery('.percent')[ctr].innerHTML = data[i][2]+'%';
						jQuery('.remove_url')[ctr].setAttribute('data-quiz-user-id', '".$user_id."');
						if(data[i][2]<75){
							jQuery('.percent')[ctr].style.color = 'red';
							jQuery('.cert_url')[ctr].style.display = 'none';
						}
						jQuery('.afterbr')[ctr].innerHTML = 'Score '+data[i][0]+'  out of  '+data[i][1]+'  question(s) . Points:  '+data[i][0]+'/'+data[i][1]+' on  '+mo+' '+da+', '+ye+' '+ho+':'+mi+' '+ampm;
					}
					else if(data[i][5] == 1416){

						jQuery('.ld-quiz-progress-content-container').append('".$exam_1003."');
						jQuery('.cert_url')[ctr].href = 'https://foodhandlersolutions.com/certificates/food-handler-certificate/?quiz=1416&user=".$user_id."&time='+data[i][4];
						jQuery('.remove_url')[ctr].setAttribute('data-quiz-user-id', '".$user_id."');
						if(data[i][2]<75){
							jQuery('.percent')[ctr].style.color = 'red';
							jQuery('.cert_url')[ctr].style.display = 'none';
						}
						jQuery('.percent')[ctr].innerHTML = data[i][2]+'%';
						jQuery('.afterbr')[ctr].innerHTML = 'Score '+data[i][0]+'  out of  '+data[i][1]+'  question(s) . Points:  '+data[i][0]+'/'+data[i][1]+' on  '+mo+' '+da+', '+ye+' '+ho+':'+mi+' '+ampm;
					}
					else if(data[i][5] == 601){
					}
					else if(data[i][5] == 600){
					}
					ctr++;
				}
			}
		});
		</script>";

}  
   
// Function to change email address

function wpb_sender_email( $original_email_address ) {
    return 'support@foodhandlersolutions.com';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Food Handler Solutions';
}

// Hooking up our functions to WordPress filters 
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );