<?php
/*
  Plugin Name:        Google Customer Reviews for WooCommerce
  Description:        Integrates Google Merchant Center's Google Customer Reviews survey opt-in and badge into your WooCommerce store.
  Author:             eCreations
  Author URI:         https://www.ecreations.net
  License:            GPLv3
  License URI:        http://www.gnu.org/licenses/quick-guide-gplv3.html
  Text Domain:        ecr-google-customer-reviews
  Version:            2.6.12
  Requires at least:  3.0.0
  Tested up to:       5.0.2
  WC requires at least: 3.0
  WC tested up to:    3.5.3
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'init', 'ecr_woocheck' );
function ecr_woocheck () {
  if (class_exists( 'WooCommerce' )) {
    if( get_option( 'ecr_merch_id' ) ) {
      add_action('woocommerce_thankyou', 'ecr_gcr_scripts');
      if( !get_option('disable_gcr_view_order') ) {
        add_action('woocommerce_view_order', 'ecr_gcr_scripts');
      }
    }else{
      add_action( 'admin_notices', 'ecr_gcr_missing_key_notice' );
    }
  }else{
    add_action( 'admin_notices', 'ecr_gcr_missing_wc_notice' );
  }
}


// Admin Error Messages

function ecr_gcr_missing_wc_notice() {
  ?>
  <div class="error notice">
      <p><?php _e( 'You need to install and activate WooCommerce in order to use Google Customer Reviews for WooCommerce!', 'ecr-google-customer-reviews' ); ?></p>
  </div>
  <?php
}

function ecr_gcr_missing_key_notice() {
  ?>
  <div class="update-nag notice">
      <p><?php _e( 'Please <a href="options-general.php?page=ecr_gcr">enter your Google Merchant ID</a> in order to use Google Customer Reviews for WooCommerce!', 'ecr-google-customer-reviews' ); ?></p>
  </div>
  <?php
}

// Admin Settings Menu

add_action( 'admin_menu', 'ecr_gcr_menu' );
function ecr_gcr_menu(){
  add_options_page( 'Google Customer Reviews for WooCommerce',
                'Google Customer Reviews', 
                'manage_options', 
                'ecr_gcr', 
                'ecr_gcr_page' );
  add_action( 'admin_init', 'update_ecr_gcr' );
}

// Register Settings

function update_ecr_gcr() {
  register_setting( 'ecr_gcr_settings', 'ecr_merch_id' );
  register_setting( 'ecr_gcr_settings', 'ecr_gcr_lang' );
  register_setting( 'ecr_gcr_settings', 'ecr_delivery_days' );
  register_setting( 'ecr_gcr_settings', 'ecr_optin_style' );
  register_setting( 'ecr_gcr_settings', 'disable_gcr_view_order' );
  register_setting( 'ecr_gcr_settings', 'ecr_badge_enable' );
  register_setting( 'ecr_gcr_settings', 'ecr_badge_isshop' );
  register_setting( 'ecr_gcr_settings', 'ecr_badge_style' );
  register_setting( 'ecr_gcr_settings', 'ecr_gtin_field' );
  register_setting( 'ecr_gcr_settings', 'ecr_display_gtin_meta' );
  
}

// Admin Settings Page

function ecr_gcr_page(){
?>
<div class="wrap">
  <h1>Google Customer Reviews for WooCommerce</h1>
  <p>Paste your Google Merchant ID below and click "Save Changes" in order to enable the Google Customer Reviews Integration.</p>
  <form method="post" action="options.php">
    <?php settings_fields( 'ecr_gcr_settings' ); ?>
    <?php do_settings_sections( 'ecr_gcr_settings' ); ?>
    <h2>Merchant Settings</h2>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Google Merchant ID:</th>
      <td><input type="text" name="ecr_merch_id" value="<?php echo get_option( 'ecr_merch_id' ); ?>" data-lpignore="true" />
      <p class="description"><a href="https://merchants.google.com" target="_blank">Click here to get your Google Merchant ID &raquo;</a><br/>Also, make sure you have <a href="https://merchants.google.com/mc/programs" target="_blank">enabled the Customer Reviews program</a> inside your Google Merchant account.</p></td>
      </tr>
      <tr valign="top">
      <th scope="row">Language:</th>
      <td>
      <select name="ecr_gcr_lang" value="<?php $lang = get_option( 'ecr_gcr_lang' ); echo $lang; ?>">
      <?php
      $languages = array(
        '' => 'Auto-detect',
        'af' => 'Afrikaans',
        'ar-AE' => 'Arabic (United Arab Emirates)',
        'cs' => 'Czech',
        'da' => 'Danish',
        'de' => 'German',
        'en_AU' => 'English (Australia)',
        'en_GB' => 'English (United Kingdom)',
        'en_US' => 'English (United States)',
        'es' => 'Spanish',
        'es-419' => 'Spanish (Latin America)',
        'fil' => 'Filipino',
        'fr' => 'French',
        'ga' => 'Irish',
        'id' => 'Indonesian',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'ms' => 'Malay',
        'nl' => 'Dutch',
        'no' => 'Norwegian',
        'pl' => 'Polish',
        'pt_BR' => 'Portuguese (Brazil)',
        'pt_PT' => 'Portuguese (Portugal)',
        'ru' => 'Russian',
        'sv' => 'Swedish',
        'tr' => 'Turkish',
        'zh-CN' => 'Chinese (China)',
        'zh-TW' => 'Chinese (Taiwan)'
      );
      foreach($languages as $code => $label) {
        echo '<option value="'.$code.'" ';
        if($lang==$code)echo 'selected';
        echo '>'.$label.'</option>';
      }
      ?>
      </select>
      </td>
      </tr>
    </table>
    <hr />
    <h2>Survey Opt-in Popup Settings</h2>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Popup Position:</th>
      <td><select name="ecr_optin_style" value="<?php $style = get_option( 'ecr_optin_style' ); echo $style; ?>">
        <option value="CENTER_DIALOG" <?php if($style=='CENTER_DIALOG')echo 'selected';?>>Center</option>
        <option value="TOP_LEFT_DIALOG" <?php if($style=='TOP_LEFT_DIALOG')echo 'selected';?>>Top Left</option>
        <option value="TOP_RIGHT_DIALOG" <?php if($style=='TOP_RIGHT_DIALOG')echo 'selected';?>>Top Right</option>
        <option value="BOTTOM_LEFT_DIALOG" <?php if($style=='BOTTOM_LEFT_DIALOG')echo 'selected';?>>Bottom Left</option>
        <option value="BOTTOM_RIGHT_DIALOG" <?php if($style=='BOTTOM_RIGHT_DIALOG')echo 'selected';?>>Bottom Right</option>
        <option value="BOTTOM_TRAY" <?php if($style=='BOTTOM_TRAY')echo 'selected';?>>Bottom Tray</option>
      </select></td>
      </tr>
      <tr valign="top">
      <th scope="row">Disable Popup in My Account > View Order:</th>
      <td><input type="checkbox" name="disable_gcr_view_order" value="true" <?php if(get_option('disable_gcr_view_order')=='true')echo 'checked'; ?>/>
      <p class="description">The survey popup will show on the "Thank you" page after placing an order.  But, if you also want the popup to show when the user views their order in the "My Account" section, then leave this unchecked.</p></td>
      </tr>
      <tr valign="top">
      <th scope="row">Estimated Delivery (Days):</th>
      <td><input type="number" name="ecr_delivery_days" value="<?php echo get_option( 'ecr_delivery_days' ); ?>"/>
      <p class="description">Google wants to know about how many days it will take for the customer to receive the product.  They will add a few more days on top of that to make sure the customer has had time to use the product, and then they will send the review survey to the customer.</p></td>
      </tr>
    </table>
    <hr />
    <h2>Product Review Settings (<em>Optional</em>)</h2>
    <p>These settings are optional.  If you sell products that have a GTIN like UPC, EAN, or ISBN, then this allows you to collect product reviews in addition to your seller reviews.  Without GTINs, you will still collect seller reviews.</p>
    <table class="form-table">
      </tr>
      <tr valign="top">
        <th scope="row">GTIN Field:<p class="description">(Global Trade Item Number)</p></th>
        <?php 
        function generate_product_meta_keys(){
          global $wpdb;
          $query = "
            SELECT DISTINCT($wpdb->postmeta.meta_key), $wpdb->postmeta.meta_value 
            FROM $wpdb->posts 
            LEFT JOIN $wpdb->postmeta 
            ON $wpdb->posts.ID = $wpdb->postmeta.post_id 
            WHERE ($wpdb->posts.post_type = 'product' 
            OR $wpdb->posts.post_type = 'product_variation') 
            AND $wpdb->postmeta.meta_key != '' 
            AND $wpdb->postmeta.meta_key NOT LIKE '_oembed_%' 
            GROUP BY $wpdb->postmeta.meta_key 
            ORDER BY $wpdb->posts.post_type, $wpdb->postmeta.meta_key
          ";
          $meta_keys = $wpdb->get_results($query);
          //set_transient('product_meta_keys', $meta_keys, 60*60*24); # create 1 Day Expiration
          return $meta_keys;
        }
        function get_product_meta_keys(){
          //$cache = get_transient('product_meta_keys');
          //$meta_keys = $cache ? $cache : generate_product_meta_keys();
          // Uncomment the below line to bypass the transient cache
          $meta_keys = generate_product_meta_keys();
          return $meta_keys;
        }
        $meta_keys = get_product_meta_keys();
        $gtin_field = get_ecr_gtin_field();
        ?>
        <td>
        <?php //print_r($meta_keys); ?>
        <select name="ecr_gtin_field" value="<?php echo $gtin_field; ?>">
          <option value="_gtin" <?php if($gtin_field == '_gtin') echo 'selected';?>>- DEFAULT (_gtin) -</option>
          <option value="NO_GTIN" <?php if($gtin_field == 'NO_GTIN') echo 'selected';?>>- NONE -</option>
          <?php
          if(!empty($meta_keys) && is_array($meta_keys)) {
            foreach($meta_keys as $r) { 
              echo '<option value="'.$r->meta_key.'" '.(($gtin_field==$r->meta_key) ? 'selected' : '').'>'.$r->meta_key.' ('. ( function_exists('mb_strimwidth') ? mb_strimwidth(sanitize_text_field($r->meta_value), 0, 20, "...") : substr(sanitize_text_field($r->meta_value), 0, 20) ) .')</option>';
            }
          }
          ?>
        </select>
        <p class="description">This is only needed if you want to collect product reviews. With this set to "- NONE -", the survey popup will still collect merchant reviews.</p><p class="description">Default is '_gtin'.  However, if you have another plugin that manages the GTIN field for your products, choose that field from the dropdown.</p></td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <h4>How to add GTINs to products to enable Product Reviews?</h4>
        </th>
        <td>
          <p class="description">Edit each product in WooCommerce.  In the "Product data" panel, click on the "Inventory" tab.  You should see a new field labeled "GTIN".  Enter your UPC, EAN, or ISBN for the product and click "Update".</p>
        </td>
      </tr>
      <tr valign="top">
      <th scope="row">Display GTIN in Product Meta on the Front-end:</th>
      <td><input type="checkbox" name="ecr_display_gtin_meta" value="true" <?php if(get_option('ecr_display_gtin_meta')=='true')echo 'checked'; ?>/>
      <p class="description">If checked, the GTIN will show on the product single page along with the list of categories and tags.</p></td>
      </tr>
    </table>
    <hr />
    <h2>Rating Badge Settings</h2>
    <table class="form-table">
      <tr valign="top">
      <th scope="row">Enable Rating Badge:</th>
      <td><input type="checkbox" name="ecr_badge_enable" value="true" <?php if(get_option('ecr_badge_enable')=='true')echo 'checked'; ?>/>
      <p class="description">You can keep the badge disabled until you're ready to show it.  Generally, Google requires at least 150 reviews during the past year before seller ratings appear on the Google Customer Reviews Badge.</p></td>
      </tr>
      <tr valign="top">
      <th scope="row">Only Show Badge in Shop:</th>
      <td><input type="checkbox" name="ecr_badge_isshop" value="true" <?php if(get_option('ecr_badge_isshop')=='true')echo 'checked'; ?>/>
      <p class="description">If checked, the badge will only display if is_woocommerce() is true.</p></td>
      </tr>
      <tr valign="top">
      <th scope="row">Rating Badge Position:</th>
      <td><select name="ecr_badge_style" value="<?php $style = get_option( 'ecr_badge_style' ); echo $style; ?>">
        <option value="none" <?php if($style=='none')echo 'selected';?>>None</option>
        <option value="BOTTOM_LEFT" <?php if($style=='BOTTOM_LEFT')echo 'selected';?>>Bottom Left</option>
        <option value="BOTTOM_RIGHT" <?php if($style=='BOTTOM_RIGHT')echo 'selected';?>>Bottom Right</option>
      </select></td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
<?php
}

function ecr_gcr_scripts($order_id) {
  global $woo_order_id;
  $woo_order_id = $order_id;
  add_action( 'wp_footer', 'ecr_gcr_scripts_footer', 999, 1 );
}
  
function ecr_gcr_scripts_footer() {
  global $woo_order_id;
  $order = new WC_Order( $woo_order_id );
  $items = $order->get_items();
  $gtins = [];
  $gtin_field = get_ecr_gtin_field();
  if($gtin_field && $gtin_field != 'NO_GTIN') {
    foreach($items as $item) {
      $product_id = version_compare( WC_VERSION, '3.0', '<' ) ? $item['product_id'] : $item->get_product_id();
      $variation_id = version_compare( WC_VERSION, '3.0', '<' ) ? $item['variation_id'] : $item->get_variation_id();
        // Check if product has variation.
        if ($variation_id) { 
          $item_id = $item['variation_id'];
        } else {
          $item_id = $item['product_id'];
        }
      $gtin = get_ecr_gtin_value( $item_id, false );
      //echo '<!--'.$item_id.':'.$gtin.'-->';
      if($gtin) {
        if(is_array($gtin)) $gtin = array_shift($gtin);
        $gtins[] = ['gtin' => sanitize_text_field($gtin)];
      }
    }
  }
  ?><!-- BEGIN GCR Opt-in Module Code -->
<script src="https://apis.google.com/js/platform.js?onload=renderOptIn"
  async defer>
</script>

<script>
  window.renderOptIn = function() { 
    window.gapi.load('surveyoptin', function() {
      window.gapi.surveyoptin.render({
        "merchant_id": <?php echo get_option('ecr_merch_id'); ?>,
        "order_id": "<?php echo $order->get_id(); ?>",
        "email": "<?php echo is_callable( array( $order, 'get_billing_email' ) ) ? $order->get_billing_email() : $order->billing_email; ?>",
        "delivery_country": "<?php echo is_callable( array( $order, 'get_billing_country' ) ) ? $order->get_billing_country() : $order->billing_country; ?>",
        "estimated_delivery_date": "<?php $order_date = is_callable( array( $order, 'get_date_created' ) ) ? $order->get_date_created() : $order->order_date;
        echo date('Y-m-d', strtotime($order_date.' + '. apply_filters('gcr_delivery_days', (int)get_option('ecr_delivery_days'), $order ).' days') ); ?>",
        "opt_in_style": "<?php echo get_option( 'ecr_optin_style' ); ?>",
        <?php if($gtins) { echo '"products": ' . json_encode($gtins); } ?> 
      });
    });
  }
</script>
<!-- END GCR Opt-in Module Code -->

<!-- BEGIN GCR Language Code -->
<script>
  window.___gcfg = {
    lang: '<?php echo get_option( 'ecr_gcr_lang' ); ?>'
  };
</script>
<!-- END GCR Language Code -->
<?php 
}

add_action( 'wp_footer', 'gcr_badge' );
function gcr_badge() {
  $show_badge = apply_filters('ecr_show_gcr_badge', true);
  if(get_option('ecr_badge_enable') && $show_badge){
    if(get_option('ecr_badge_isshop') && !is_woocommerce()){
      //do nothing
    }elseif($show_badge){
      $style = get_option('ecr_badge_style');
      if($style != 'none') {
      ?>
    <!-- BEGIN GCR Badge Code -->
    <script src="https://apis.google.com/js/platform.js?onload=renderBadge"
      async defer>
    </script>

    <script>
      window.renderBadge = function() {
        var ratingBadgeContainer = document.createElement("div");
        document.body.appendChild(ratingBadgeContainer);
        window.gapi.load('ratingbadge', function() {
          window.gapi.ratingbadge.render(
            ratingBadgeContainer, {
              "merchant_id": <?php echo get_option('ecr_merch_id'); ?>,
              "position": "<?php echo $style; ?>"
            });
        });
      }
    </script>
    <!-- END GCR Badge Code -->

    <!-- BEGIN GCR Language Code -->
    <script>
      window.___gcfg = {
        lang: '<?php echo get_option( 'ecr_gcr_lang' ); ?>'
      };
    </script>
    <!-- END GCR Language Code -->
    <?php
      }
    }
  }
}

/** 
 * Adding Custom GTIN Meta Field
 * Save meta data to DB
 */
// add GTIN input field
remove_action('woocommerce_product_options_inventory_product_data', 'woocom_simple_product_gtin_field', 10);
add_action('woocommerce_product_options_inventory_product_data','ecr_gcr_product_gtin_field');
function ecr_gcr_product_gtin_field(){
  global $woocommerce, $post;
  $gtin_field = get_ecr_gtin_field();
  if(in_array($gtin_field, ['NO_GTIN', '_sku'])) return;
  $product = new WC_Product(get_the_ID());
  echo '<div id="gtin_attr" class="options_group">';
  //add GTIN field for simple product
  woocommerce_wp_text_input( 
    array(	
      'id' => $gtin_field,
      'label' => 'GTIN',
      'desc_tip' => 'true',
      'description' => 'Enter the Global Trade Item Number (UPC,EAN,ISBN)')
  );
  echo '</div>';
}
// save simple product GTIN
add_action('woocommerce_process_product_meta','ecr_gcr_product_gtin_save');
function ecr_gcr_product_gtin_save($post_id){
  $gtin_field = get_ecr_gtin_field();
  if($gtin_field == 'NO_GTIN') return;
  $gtin_post = $_POST[$gtin_field];
  // save the gtin
  if(isset($gtin_post)){
    update_post_meta($post_id, $gtin_field, esc_attr($gtin_post));
  }
  // remove if GTIN meta is empty
  $gtin_data = get_post_meta($post_id, $gtin_field, true);
  if (empty($gtin_data)){
    delete_post_meta($post_id, $gtin_field, '');
  }
}

// Add Variation Custom fields

//Display Fields in admin on product edit screen for variations
add_action( 'woocommerce_product_after_variable_attributes', 'ecr_gcr_woo_variable_fields', 10, 3 );
function ecr_gcr_woo_variable_fields( $loop, $variation_data, $variation ) {
  $gtin_field = get_ecr_gtin_field();
  if($gtin_field == 'NO_GTIN') return;
  $product = new WC_Product(get_the_ID());
  echo '<div class="variation-custom-fields">';
      // Text Field
      woocommerce_wp_text_input(
        array(
          'id' => $gtin_field.'_variation['.$loop.']',
          'label' => 'GTIN',
          'desc_tip' => 'true',
          'description' => 'Enter the Global Trade Item Number (UPC,EAN,ISBN)',
          'value' => get_ecr_gtin_value($variation->ID)
        )
      );
  echo "</div>"; 
}

//Save variation fields values
add_action( 'woocommerce_save_product_variation', 'ecr_gcr_save_variation_fields', 10, 2 );
function ecr_gcr_save_variation_fields( $variation_id, $i) {
    $gtin_field = get_ecr_gtin_field();
    if($gtin_field == 'NO_GTIN') return;
    // Check for variation gtin array
    if(!is_array($_POST[$gtin_field.'_variation'])) return;
    $gtin_post = stripslashes( $_POST[$gtin_field.'_variation'][$i] );
    // save the gtin
    if(isset($gtin_post)){
      update_post_meta( $variation_id, $gtin_field, esc_attr( $gtin_post ) );
    }
    // remove if GTIN meta is empty
    $gtin_data = get_post_meta($variation_id, $gtin_field, true);
    if (empty($gtin_data)){
      delete_post_meta($variation_id, $gtin_field, '');
    }
}

//Display GTIN in the product meta on the front-end
add_action( 'woocommerce_product_meta_end', 'ecr_gcr_display_gtin_meta' );
function ecr_gcr_display_gtin_meta() {
  global $post;
  $display = get_option( 'ecr_display_gtin_meta' );
  if( $display ) {
    $gtin_field = get_ecr_gtin_field();
    if($gtin_field == 'NO_GTIN') return;
    $gtin = get_post_meta( $post->ID, $gtin_field, true );
    if( $gtin && !is_array($gtin) ) {
      echo '<span class="ecr-gtin">' . esc_html__( 'GTIN: ', 'ecr-google-customer-reviews' ) . '<span>' . $gtin . '</span></span>';
    }
  }
}

function get_ecr_gtin_field() {
  $gtin_field = get_option( 'ecr_gtin_field' );
  if(!$gtin_field) $gtin_field = '_gtin';
  return $gtin_field;
}

// Function to migrate old meta keys to new meta keys
function get_ecr_gtin_value( $post_id, $single = true ) {
  $gtin_field = get_option( 'ecr_gtin_field' );
  $post_type = get_post_type( $post_id );
  $gtin_value = '';
  if($post_type == 'product' || $post_type == 'product_variation') {
    $gtin_value = get_post_meta($post_id, $gtin_field, $single);
    if(empty($gtin_value) && $post_type == 'product_variation') {
      $gtin_value = get_post_meta($post_id, $gtin_field.'_variation', $single);
      // Copy the _gtin_variation to _gtin
      update_post_meta( $post_id, $gtin_field, $gtin_value );
    }
  }
  return $gtin_value;
}

// Hook into get_post_meta to fallback to _gtin_variation if _gtin is empty
add_filter( 'get_post_metadata', 'gtin_variation_postmeta_fallback', 10, 4 );
function gtin_variation_postmeta_fallback($metadata, $object_id, $meta_key, $single){
  // Here is the catch, add additional controls if needed (post_type, etc)
  $meta_needed = get_ecr_gtin_field();
  if(isset($meta_key) && $meta_needed == $meta_key) {
      remove_filter( 'get_post_metadata', 'gtin_variation_postmeta_fallback', 10 );
      $current_meta = get_post_meta( $object_id, $meta_needed, true );
      // Do what you need to with the meta value - translate, append, etc
      if(empty($current_meta)) {
        $current_meta = get_post_meta( $object_id, $meta_needed .'_variation', true );
        // Copy the _gtin_variation to _gtin
        update_post_meta( $object_id, $meta_needed, $current_meta );
      }
      add_filter('get_post_metadata', 'gtin_variation_postmeta_fallback', 10, 4);
      return $current_meta;
  }
  // Return original if the check does not pass
  return $metadata;
}

// Testing shortcode for checking post meta for products and variations [gcr_products_gtins]
add_shortcode( 'gcr_products_gtins', 'gcr_products_gtins' );
function gcr_products_gtins( $atts ){
  $q = new WP_Query(array(
    'post_type' => ['product', 'product_variation'],
    'posts_per_page' => '-1',
  ));
  ob_start();
  if($q->have_posts()) {
    while($q->have_posts()) : $q->the_post();
      the_title();
      echo ' :: '. get_post_meta(get_the_ID(), '_gtin', true);
      echo '<br>';
    endwhile;
    wp_reset_postdata();
  }
  return ob_get_clean();
}
