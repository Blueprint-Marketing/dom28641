<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Theme functions for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Define Path / URL Constants
//   02. Set Paths
//   03. Preboot
//   04. Set Asset Revision Constant
//   05. Require Files
// =============================================================================

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
	return  $data;
}
add_shortcode( 'info_exam_cert', 'info_certi_shortcode' );


function img2blob() {
 
wp_register_script('my_amazing_script',"https://foodhandlersolutions.com/wp-content/themes/sparkling/inc/js/img2blob.js", array('jquery'),'1.1', true);
 
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
wp_redirect( 'https://foodhandlersolutions.com/log-in-food-handler-card/');
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

add_action('wp_head','get_cart_sample');
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
}

// Woocommerce Generate coupon


// define the woocommerce_thankyou callback 
function action_woocommerce_thankyou( $order_get_id ) { 
    // make action magic happen here... 
	
		$order = wc_get_order( $order_get_id );  
		$item_quantity_total = 0;
		// Iterating through each "line" items in the order
		foreach ($order->get_items() as $item_id => $item_data) {

			// Get an instance of corresponding the WC_Product object
			$product = $item_data->get_product();
			$product_name = $product->get_name(); // Get the product name

			$item_quantity = $item_data->get_quantity(); // Get the item quantity

			$item_total = $item_data->get_total(); // Get the item line total

			// Displaying this data (to check)
			//echo 'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 );
			$item_quantity_total = $item_quantity + $item_quantity_total;
		}
		
		echo $item_quantity_total ." sample quantity";
		
		
		    if( $item_quantity_total >= 20){
			   
					
			   $coupon_code = generate_coupons15($item_quantity_total , $_GET['key']);
			   
			   if($coupon_code){
				   
			

			   send_email_woocommerce_style('rmednalan@gmail.com',"Food Handler Solutions: Congratulations! You've received a coupon",'Here is you coupon code for : '.$item_quantity_total, "<p>To redeem your discount use the following coupon during checkout: </p>
			   <div style='background-color: #d7e9fc;padding: 10px;width: 265px;display: block;margin: auto;'><h2 style='text-align:center; border:1px dashed #00ABA8;background-color:#d7e9fc;margin:5px;padding:10px  5px  5px 5px;width:200px;display: block;text-align: center;margin: auto; width: 230px;padding: 15px '>".$coupon_code."</h2> </div><a href='https://foodhandlersolutions.com/shop/' style='color:#557da1;font-weight:normal;text-decoration:underline; text-align: center;display: block;margin-top: 25px;' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=https://foodhandlersolutions.com/shop/&amp;source=gmail&amp;ust=1519202632690000&amp;usg=AFQjCNHDD1ia7ipWlIfEK77-cxzZYyd_4w'>Visit Store</a> ");
			   
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
			update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
			update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
			update_post_meta( $new_coupon_id, 'individual_use', 'yes' );
			update_post_meta( $new_coupon_id, 'product_ids', '' );
			update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
			update_post_meta( $new_coupon_id, 'usage_limit',(string)$quantity );
			update_post_meta( $new_coupon_id, 'expiry_date', '' );
			update_post_meta( $new_coupon_id, 'apply_before_tax', 'no' );
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );     
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );      
			update_post_meta( $new_coupon_id, 'product_categories', '' );       
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

	
		define("HTML_EMAIL_HEADERS", array('Content-Type: text/html; charset=UTF-8'));
		// @email - Email address of the reciever
		// @subject - Subject of the email
		// @heading - Heading to place inside of the woocommerce template
		// @message - Body content (can be HTML)
		function send_email_woocommerce_style($email, $subject, $heading, $message) {
		  // Get woocommerce mailer from instance
		  $mailer = WC()->mailer();
		  // Wrap message using woocommerce html email template
		  $wrapped_message = $mailer->wrap_message($heading, $message);
		  // Create new WC_Email instance
		  $wc_email = new WC_Email;
		  // Style the wrapped message with woocommerce inline styles
		  $html_message = $wc_email->style_inline($wrapped_message);
		  // Send the email using wordpress mail function
		  wp_mail( $email, $subject, $html_message, HTML_EMAIL_HEADERS );
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

