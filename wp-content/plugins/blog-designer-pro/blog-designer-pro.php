<?php
/**
  Plugin Name: Blog Designer PRO
  Plugin URI: https://www.solwininfotech.com/product/wordpress-plugins/blog-designer-pro/
  Description: Blog Designer PRO is a step ahead wordpress plugin that allows you to modify blog page, single page and archive page layouts and design.
  Author: Solwin Infotech
  Author URI: https://www.solwininfotech.com/
  Copyright: Solwin Infotech
  Version: 2.2
  Requires at least: 4.0
  Tested up to: 4.9.6
  License: GPLv2 or later
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('BLOGDESIGNERPRO_TEXTDOMAIN', 'blog-designer-pro');
define('BLOGDESIGNERPRO_DIR', plugin_dir_path(__FILE__));
define('BLOGDESIGNERPRO_URL', plugins_url() . '/blog-designer-pro');

add_action('admin_init', 'bdp_create_sample_layout');
add_action('admin_init', 'bdp_create_layout_using_blog_designer');
add_action('admin_init', 'bdp_detail_ignore');
add_action('current_screen', 'bdp_footer');
require_once 'admin/admin.php';
require_once 'admin/functions.php';
require_once 'admin/ajax-actions.php';
require_once 'admin/bdp_support.php';
require_once 'admin/blog_designer_pro_widget.php';
require_once 'admin/recent_post_widget.php';
require_once 'css/single/single_page_dynamic_style.php';
$bdp_admin_page = false;
if (isset($_GET['page']) && ($_GET['page'] == 'add_shortcode' || $_GET['page'] == 'single_post' || $_GET['page'] == 'layouts' || $_GET['page'] == 'bdp_add_archive_layout' || $_GET['page'] == 'bdp_google_fonts' || $_GET['page'] == 'bdp_export' || $_GET['page'] == 'bdp_getting_started')) {
    $bdp_admin_page = true;
}


if($bdp_admin_page) {
    add_action('admin_notices', 'bdp_admin_notice');
}
$blog_designer_setting = get_option("wp_blog_designer_settings");
$create_layout_from_blog_designer_notice = get_option('bdp_admin_notice_create_layout_from_blog_designer_dismiss', false);
if ($create_layout_from_blog_designer_notice == false && $blog_designer_setting != '') {
    if($bdp_admin_page) {
        add_action('admin_notices', 'bdp_create_layout_from_blog_designer_notice');
    }
} else {
    $sample_layout_notice = get_option('bdp_admin_notice_pro_layouts_dismiss', false);
    if ($sample_layout_notice == false) {
        if($bdp_admin_page) {
            add_action('admin_notices', 'bdp_sample_layout_notice');
        }
    }
}

$bdp_change_text_domain_notice = get_option('bdp_change_text_domain_notice', 0);
if($bdp_change_text_domain_notice != 1) {
    if ($bdp_admin_page) {
        add_action('admin_notices', 'bdp_change_text_domain_notice');
    }
}

/**
 * Main Blog Designer PRO Front Function Class.
 *
 * @class   BdpFrontFunction
 * @version 1.0.0
 */
Class BdpFrontFunction {

    static $template_name = array();
    static $shortcode_id = array();
    static $template_stylesheet_added = 0;
    static $template_dynamic_stylesheet_added = 0;
    static $archive_dynamic_stylesheet_added = 0;

    public function __construct() {
        global $wpdb, $bdp_db_version;
        $wp_version = get_bloginfo('version');
        $bdp_db_version = '2.1';

        register_activation_hook(__FILE__, array(&$this, 'bdp_plugin_active'));
        add_action('plugins_loaded', array(&$this, 'bdp_load_language_files'));
        add_action('plugins_loaded', array(&$this, 'bdp_update_database_structure'));
        add_action('plugins_loaded', array(&$this, 'bdp_latest_news_solwin_feed'));
        add_action('plugins_loaded', array(&$this, 'bdp_most_viewed_posts'));
        add_action('upgrader_process_complete', array(&$this, 'bdp_plugin_update_complete'));

        if (function_exists('add_avartan_dashboard_widgets')) {
            remove_action('wp_dashboard_setup', 'add_avartan_dashboard_widgets');
        }

        add_action('wp_head', array(&$this, 'bdp_ajaxurl'), 5);
        add_action('init', array(&$this, 'bdp_front_stylesheet'), 20);
        add_action('init', array(&$this, 'bdp_front_script'), 2);
        add_action('init', array(&$this, 'wp_blog_designer_pro_redirection'), 1);

        /* style for shortcode added from admin side content */
        add_action('wp_enqueue_scripts', array(&$this, 'bdp_add_template_style'), 10);
        add_action('wp_head', array(&$this, 'bdp_template_dynamic_css'), 20);
        add_action('wp_head', array(&$this, 'bdp_archive_dynamic_css'), 20);

        /* style for shortcode added in php code */
        add_action('wp_footer', array(&$this, 'bdp_add_template_style'), 10);
        add_action('wp_footer', array(&$this, 'bdp_template_dynamic_css'), 20);
        add_action('wp_footer', array(&$this, 'bdp_email_share'), 30);
        add_action('pre_get_posts', array(&$this, 'bdp_change_author_date_pagination'));

        add_action('wp_ajax_nopriv_get_loadmore_blog', array(&$this, 'bdp_loadmore_blog'), 12);
        add_action('wp_ajax_get_loadmore_blog', array(&$this, 'bdp_loadmore_blog'), 12);

        add_action('wp_ajax_nopriv_get_load_onscroll_blog', array(&$this, 'bdp_load_onscroll_blog'), 12);
        add_action('wp_ajax_get_load_onscroll_blog', array(&$this, 'bdp_load_onscroll_blog'), 12);

        add_action('wp_ajax_nopriv_filter_change', array(&$this, 'filter_change'), 12);
        add_action('wp_ajax_filter_change', array(&$this, 'filter_change'), 12);

        add_action('wp_ajax_nopriv_get_bdp_process_posts_like', array(&$this, 'bdp_process_posts_like'), 15);
        add_action('wp_ajax_get_bdp_process_posts_like', array(&$this, 'bdp_process_posts_like'), 15);

        add_action('wp_ajax_nopriv_get_post_type_post_list', array(&$this, 'get_post_type_post_list'), 16);
        add_action('wp_ajax_get_post_type_post_list', array(&$this, 'get_post_type_post_list'), 16);

        add_action('wp_ajax_nopriv_bdp_layouts_notice_dismissible', array(&$this, 'bdp_layouts_notice_dismissible'), 20);
        add_action('wp_ajax_bdp_layouts_notice_dismissible', array(&$this, 'bdp_layouts_notice_dismissible'), 20);

        add_action('wp_ajax_nopriv_bdp_email_share_form', array(&$this, 'bdp_email_share_form'), 40);
        add_action('wp_ajax_bdp_email_share_form', array(&$this, 'bdp_email_share_form'), 40);

        add_filter('single_template', array(&$this, 'bdp_custom_single_template'), 10, 10);
        add_filter('template_include', array(&$this, 'bdp_get_custom_archive_template'), 99);

        add_image_size('news-thumb', 300, 300, true);
        add_image_size('related-post-thumb', 640, 300, true);
        add_image_size('invert-grid-thumb', 640, 320, true);
        add_image_size('deport-thumb', 640, 520, true);
        add_image_size('deport-thumbnail', 640, 640, true);
        add_image_size('brit_co_img', 580, 255, true);
        add_image_size('easy_timeline_img', 500, 300, true);
        add_image_size('cover_thumb', 320, 480, true);

        add_shortcode('wp_blog_designer', array(&$this, 'bdp_shortcode_function'), 10);
        add_action('vc_before_init', array(&$this, 'bdp_add_vc_support'));

        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'bdp_plugin_action_links'));
        add_filter('plugin_row_meta', array(&$this, 'bdp_plugin_row_meta'), 10, 2);
    }

    /**
     * Show action links on the plugin screen.
     */
    function bdp_plugin_action_links($links) {
        $action_links = array(
            'settings' => '<a href="' . admin_url("admin.php?page=layouts") . '" title="' . esc_attr(__('View Blog Designer Settings', BLOGDESIGNERPRO_TEXTDOMAIN)) . '">' . __('Layouts', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>'
        );
        $links = array_merge($action_links, $links);
        $links['documents'] = '<a target="_blank" href="' . esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#quick_guide') . '">' . __('Documentation', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
        return $links;
    }

    /**
     * Show row meta on the plugin screen.
     */
    function bdp_plugin_row_meta($links, $file) {
        if ($file == plugin_basename(__FILE__)) {
            $row_meta = array(
                'support' => '<a href="' . esc_url('http://support.solwininfotech.com/') . '" title="' . __('Visit Premium Customer Support Forum', BLOGDESIGNERPRO_TEXTDOMAIN) . '" target="_blank">' . __('Premium Support', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>'
            );
            return array_merge($links, $row_meta);
        }
        return (array) $links;
    }

    /*
     * Add support to visual composer plugin
     */

    public function bdp_add_vc_support() {
        global $wpdb;
        $bdp_table_name = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $bdp_bdids = $wpdb->get_results("SELECT bdid,shortcode_name FROM $bdp_table_name");
        $bdp_bdipd_array = array("Select Layout Id");
        if (!empty($bdp_bdids) && is_array($bdp_bdids)) {
            foreach ($bdp_bdids as $bdp_bdid) {
                $bdp_bdipd_array[$bdp_bdid->shortcode_name] = $bdp_bdid->bdid;
            }
        }
        vc_map(
                array(
                    "name" => esc_html__("Blog Designer", BLOGDESIGNERPRO_TEXTDOMAIN),
                    "base" => "wp_blog_designer",
                    "class" => "blog_designer_pro_section",
                    "category" => esc_html__('Content'),
                    "icon" => 'blog_designer_icon',
                    'admin_enqueue_css' => array(BLOGDESIGNERPRO_URL . '/admin/css/vc_style.css'),
                    "description" => __("Custom Blog Layouts", BLOGDESIGNERPRO_TEXTDOMAIN),
                    "params" => array(
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__("Select Blog Designer Layout Id", BLOGDESIGNERPRO_TEXTDOMAIN),
                            "param_name" => "id",
                            'value' => $bdp_bdipd_array,
                            'admin_label' => true,
                        )
                    )
                )
        );
    }

    /**
     *
     * @return Loads plugin textdomain
     */
    public function bdp_load_language_files() {
        load_plugin_textdomain(BLOGDESIGNERPRO_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Change db structure
     */
    function bdp_update_database_structure() {
        global $bdp_db_version;
        if (get_option('bdp_db_version') != $bdp_db_version) {
            bdp_add_single_db_structure();
        }
    }

    function bdp_latest_news_solwin_feed() {

        // Register the new dashboard widget with the 'wp_dashboard_setup' action
        add_action('wp_dashboard_setup', 'solwin_latest_news_with_product_details');
        if (!function_exists('solwin_latest_news_with_product_details')) {

            function solwin_latest_news_with_product_details() {
                add_screen_option('layout_columns', array('max' => 3, 'default' => 2));
                add_meta_box('bdp_dashboard_widget', __('News From Solwin Infotech', BLOGDESIGNERPRO_TEXTDOMAIN), 'bdp_dashboard_widget_news', 'dashboard', 'normal', 'high');
            }

        }
        if (!function_exists('bdp_dashboard_widget_news')) {

            function bdp_dashboard_widget_news() {
                echo '<div class="rss-widget">'
                . '<div class="solwin-news"><p><strong>' . __('Solwin Infotech News', BLOGDESIGNERPRO_TEXTDOMAIN) . '</strong></p>';
                wp_widget_rss_output(
                        array(
                            'url' => esc_url('https://www.solwininfotech.com/feed/'),
                            'title' => __('News From Solwin Infotech', BLOGDESIGNERPRO_TEXTDOMAIN),
                            'items' => 5,
                            'show_summary' => 0,
                            'show_author' => 0,
                            'show_date' => 1
                        )
                );
                echo '</div>';
                $title = $link = $thumbnail = "";
                //get Latest product detail from xml file

                $file = esc_url('https://www.solwininfotech.com/documents/assets/latest_product.xml');
                define('LATEST_PRODUCT_FILE', $file);
                echo '<div class="display-product">'
                . '<div class="product-detail"><p><strong>' . __('Latest Product', BLOGDESIGNERPRO_TEXTDOMAIN) . '</strong></p>';
                $response = wp_remote_post(LATEST_PRODUCT_FILE, array('sslverify' => false));
                if (is_wp_error($response)) {
                    $error_message = $response->get_error_message();
                    echo "<p>" . __('Something went wrong', BLOGDESIGNERPRO_TEXTDOMAIN) . " : $error_message" . "</p>";
                } else {
                    $body = wp_remote_retrieve_body($response);
                    $xml = simplexml_load_string($body);
                    $title = $xml->item->name;
                    $thumbnail = $xml->item->img;
                    $link = $xml->item->link;

                    $allProducttext = $xml->item->viewalltext;
                    $allProductlink = $xml->item->viewalllink;
                    $moretext = $xml->item->moretext;
                    $needsupporttext = $xml->item->needsupporttext;
                    $needsupportlink = $xml->item->needsupportlink;
                    $customservicetext = $xml->item->customservicetext;
                    $customservicelink = $xml->item->customservicelink;
                    $joinproductclubtext = $xml->item->joinproductclubtext;
                    $joinproductclublink = $xml->item->joinproductclublink;


                    echo '<div class="product-name"><a href="' . $link . '" target="_blank">'
                    . '<img alt="' . $title . '" src="' . $thumbnail . '"> </a>'
                    . '<a href="' . $link . '" target="_blank">' . $title . '</a>'
                    . '<p><a href="' . $allProductlink . '" target="_blank" class="button button-default">' . $allProducttext . ' &RightArrow;</a></p>'
                    . '<hr>'
                    . '<p><strong>' . $moretext . '</strong></p>'
                    . '<ul>'
                    . '<li><a href="' . $needsupportlink . '" target="_blank">' . $needsupporttext . '</a></li>'
                    . '<li><a href="' . $customservicelink . '" target="_blank">' . $customservicetext . '</a></li>'
                    . '<li><a href="' . $joinproductclublink . '" target="_blank">' . $joinproductclubtext . '</a></li>'
                    . '</ul>'
                    . '</div>';
                }
                echo '</div></div><div class="clear"></div>'
                . '</div>';
            }

        }
    }

    /* Most Views Post widget in dashbord */

    function bdp_most_viewed_posts() {
        add_action('wp_dashboard_setup', 'bdp_most_viewed_posts_details');

        if (!function_exists('bdp_most_viewed_posts_details')) {

            function bdp_most_viewed_posts_details() {
                add_screen_option('layout_columns', array('max' => 3, 'default' => 2));
                add_meta_box('bdp_dashboard_widget', __('Most Viewed Posts', BLOGDESIGNERPRO_TEXTDOMAIN), 'bdp_dashboard_widget_most_veiwed_post', 'dashboard', 'side', 'high');
            }

        }

        if (!function_exists('bdp_dashboard_widget_most_veiwed_post')) {

            function bdp_dashboard_widget_most_veiwed_post() {
                $args = array(
                    'post_type' => 'any',
                    'ignore_sticky_posts' => 0,
                    'orderby' => 'meta_value_num',
                    'meta_key' => '_bdp_post_views_count',
                    'posts_per_page' => '10',
                );

                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    echo '<ul class="bdp-most-viewed-posts-list">';
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        $count = get_post_meta(get_the_ID(), '_bdp_post_views_count', true);
                        echo '<li>';
                        echo '<span class="bdp-post-view-count"> ' . $count . ' ' . __('hits', BLOGDESIGNERPRO_TEXTDOMAIN) . ' </span>';
                        echo '<div class="bdp-post-view-title"> <a href="' . get_edit_post_link() . '" target="_blank">' . get_the_title() . ' </a></div>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }

                wp_reset_query();
            }

        }
    }

    /* After Plugin Update */
    function bdp_plugin_update_complete() {
        update_option('bdp_template_outdated', 0);
    }

    /*
     * Set ajaxurl
     */

    function bdp_ajaxurl() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
        <?php
    }

    /**
     * @return include plugin dynamic css
     */
    function bdp_front_stylesheet() {

        if (!is_admin()) {
            $fontawesomeiconURL = plugins_url('css/font-awesome.min.css', __FILE__);
            $bdp_gallery_sliderURL = plugins_url('css/flexslider.css', __FILE__);
            $fontawesomeicon = dirname(__FILE__) . '/css/font-awesome.min.css';
            $bdp_gallery_slider = dirname(__FILE__) . '/css/flexslider.css';
            if (file_exists($fontawesomeicon)) {
                wp_register_style('bdp-fontawesome-stylesheets', $fontawesomeiconURL);
            }
            if (file_exists($bdp_gallery_slider)) {
                wp_register_style('bdp-galleryslider-stylesheets', $bdp_gallery_sliderURL);
            }

            wp_register_style('bdp-recent-widget-css', plugins_url('css/recent_widget.css', __FILE__));
            wp_enqueue_style('bdp-recent-widget-css');
            if (is_rtl()) {
                wp_register_style('bdp-recent-widget-rtl-css', plugins_url('css/recent_widget_rtl.css', __FILE__));
                wp_enqueue_style('bdp-recent-widget-rtl-css');
            }
            //Register Blog & Archive Layouts css files
            wp_register_style('bdp-classical-template-css', plugins_url('css/layouts/classical.css', __FILE__));
            wp_register_style('bdp-nicy-template-css', plugins_url('css/layouts/nicy.css', __FILE__));
            wp_register_style('bdp-lightbreeze-template-css', plugins_url('css/layouts/lightbreeze.css', __FILE__));
            wp_register_style('bdp-sharpen-template-css', plugins_url('css/layouts/sharpen.css', __FILE__));
            wp_register_style('bdp-spektrum-template-css', plugins_url('css/layouts/spektrum.css', __FILE__));
            wp_register_style('bdp-hub-template-css', plugins_url('css/layouts/hub.css', __FILE__));
            wp_register_style('bdp-evolution-template-css', plugins_url('css/layouts/evolution.css', __FILE__));
            wp_register_style('bdp-offer_blog-template-css', plugins_url('css/layouts/offer_blog.css', __FILE__));
            wp_register_style('bdp-news-template-css', plugins_url('css/layouts/news.css', __FILE__));
            wp_register_style('bdp-winter-template-css', plugins_url('css/layouts/winter.css', __FILE__));
            wp_register_style('bdp-region-template-css', plugins_url('css/layouts/region.css', __FILE__));
            wp_register_style('bdp-roctangle-template-css', plugins_url('css/layouts/roctangle.css', __FILE__));
            wp_register_style('bdp-glossary-template-css', plugins_url('css/layouts/glossary.css', __FILE__));
            wp_register_style('bdp-deport-template-css', plugins_url('css/layouts/deport.css', __FILE__));
            wp_register_style('bdp-navia-template-css', plugins_url('css/layouts/navia.css', __FILE__));
            wp_register_style('bdp-boxy-template-css', plugins_url('css/layouts/boxy.css', __FILE__));
            wp_register_style('bdp-boxy-clean-template-css', plugins_url('css/layouts/boxy-clean.css', __FILE__));
            wp_register_style('bdp-invert-grid-template-css', plugins_url('css/layouts/invert-grid.css', __FILE__));
            wp_register_style('bdp-brit_co-template-css', plugins_url('css/layouts/brit_co.css', __FILE__));
            wp_register_style('bdp-media-grid-template-css', plugins_url('css/layouts/media-grid.css', __FILE__));
            wp_register_style('bdp-timeline-template-css', plugins_url('css/layouts/timeline.css', __FILE__));
            wp_register_style('bdp-cool_horizontal-template-css', plugins_url('css/layouts/cool_horizontal.css', __FILE__));
            wp_register_style('bdp-overlay_horizontal-template-css', plugins_url('css/layouts/overlay_horizontal.css', __FILE__));
            wp_register_style('bdp-easy_timeline-template-css', plugins_url('css/layouts/easy_timeline.css', __FILE__));
            wp_register_style('bdp-story-template-css', plugins_url('css/layouts/story.css', __FILE__));
            wp_register_style('bdp-logbook-css', plugins_url('css/logbook.css', __FILE__));
            wp_register_style('bdp-basic-tools', plugins_url('admin/css/basic-tools-min.css', __FILE__));
            wp_register_style('bdp-front-css', plugins_url('css/front.css', __FILE__));
            wp_register_style('bdp-front-rtl-css', plugins_url('css/front-rtl.css', __FILE__));
            wp_register_style('bdp-explore-template-css', plugins_url('css/layouts/explore.css', __FILE__));
            wp_register_style('bdp-hoverbic-template-css', plugins_url('css/layouts/hoverbic.css', __FILE__));
            wp_register_style('bdp-my_diary-template-css', plugins_url('css/layouts/my_diary.css', __FILE__));
            wp_register_style('bdp-elina-template-css', plugins_url('css/layouts/elina.css', __FILE__));
            wp_register_style('bdp-masonry_timeline-template-css', plugins_url('css/layouts/masonry_timeline.css', __FILE__));
            wp_register_style('bdp-crayon_slider-template-css', plugins_url('css/layouts/crayon_slider.css', __FILE__));
            wp_register_style('bdp-sallet_slider-template-css', plugins_url('css/layouts/sallet_slider.css', __FILE__));
            wp_register_style('bdp-sunshiny_slider-template-css', plugins_url('css/layouts/sunshiny_slider.css', __FILE__));
            wp_register_style('bdp-pretty-template-css', plugins_url('css/layouts/pretty.css', __FILE__));
            wp_register_style('bdp-tagly-template-css', plugins_url('css/layouts/tagly.css', __FILE__));
            wp_register_style('bdp-brite-template-css', plugins_url('css/layouts/brite.css', __FILE__));
            wp_register_style('bdp-chapter-template-css', plugins_url('css/layouts/chapter.css', __FILE__));
            wp_register_style('bdp-glamour-template-css', plugins_url('css/layouts/glamour.css', __FILE__));
            wp_register_style('bdp-fairy-template-css', plugins_url('css/layouts/fairy.css', __FILE__));
            wp_register_style('bdp-famous-template-css', plugins_url('css/layouts/famous.css', __FILE__));
            wp_register_style('bdp-cover-template-css', plugins_url('css/layouts/cover.css', __FILE__));
            wp_register_style('bdp-steps-template-css', plugins_url('css/layouts/steps.css', __FILE__));
            wp_register_style('bdp-clicky-template-css', plugins_url('css/layouts/clicky.css', __FILE__));
            wp_register_style('bdp-minimal-template-css', plugins_url('css/layouts/minimal.css', __FILE__));
            wp_register_style('bdp-miracle-template-css', plugins_url('css/layouts/miracle.css', __FILE__));

            //Register Single Layouts css files
            wp_register_style('bdp-single-boxy-clean-template-css', plugins_url('css/single/boxy-clean.css', __FILE__));
            wp_register_style('bdp-single-boxy-template-css', plugins_url('css/single/boxy.css', __FILE__));
            wp_register_style('bdp-single-winter-template-css', plugins_url('css/single/winter.css', __FILE__));
            wp_register_style('bdp-single-classical-template-css', plugins_url('css/single/classical.css', __FILE__));
            wp_register_style('bdp-single-nicy-template-css', plugins_url('css/single/nicy.css', __FILE__));
            wp_register_style('bdp-single-sharpen-template-css', plugins_url('css/single/sharpen.css', __FILE__));
            wp_register_style('bdp-single-hub-template-css', plugins_url('css/single/hub.css', __FILE__));
            wp_register_style('bdp-single-lightbreeze-template-css', plugins_url('css/single/lightbreeze.css', __FILE__));
            wp_register_style('bdp-single-spektrum-template-css', plugins_url('css/single/spektrum.css', __FILE__));
            wp_register_style('bdp-single-evolution-template-css', plugins_url('css/single/evolution.css', __FILE__));
            wp_register_style('bdp-single-news-template-css', plugins_url('css/single/news.css', __FILE__));
            wp_register_style('bdp-single-media-grid-template-css', plugins_url('css/single/media-grid.css', __FILE__));
            wp_register_style('bdp-single-deport-template-css', plugins_url('css/single/deport.css', __FILE__));
            wp_register_style('bdp-single-navia-template-css', plugins_url('css/single/navia.css', __FILE__));
            wp_register_style('bdp-single-region-template-css', plugins_url('css/single/region.css', __FILE__));
            wp_register_style('bdp-single-roctangle-template-css', plugins_url('css/single/roctangle.css', __FILE__));
            wp_register_style('bdp-single-brit_co-template-css', plugins_url('css/single/brit_co.css', __FILE__));
            wp_register_style('bdp-single-glossary-template-css', plugins_url('css/single/glossary.css', __FILE__));
            wp_register_style('bdp-single-offer_blog-template-css', plugins_url('css/single/offer_blog.css', __FILE__));
            wp_register_style('bdp-single-timeline-template-css', plugins_url('css/single/timeline.css', __FILE__));
            wp_register_style('bdp-single-invert-grid-template-css', plugins_url('css/single/invert-grid.css', __FILE__));
            wp_register_style('bdp-single-story-template-css', plugins_url('css/single/story.css', __FILE__));
            wp_register_style('bdp-single-easy_timeline-template-css', plugins_url('css/single/easy_timeline.css', __FILE__));
            wp_register_style('bdp-single-cool_horizontal-template-css', plugins_url('css/single/cool_horizontal.css', __FILE__));
            wp_register_style('bdp-single-overlay_horizontal-template-css', plugins_url('css/single/overlay_horizontal.css', __FILE__));
            wp_register_style('bdp-single-explore-template-css', plugins_url('css/single/explore.css', __FILE__));
            wp_register_style('bdp-single-hoverbic-template-css', plugins_url('css/single/hoverbic.css', __FILE__));
            wp_register_style('bdp-single-my_diary-template-css', plugins_url('css/single/my_diary.css', __FILE__));
            wp_register_style('bdp-single-elina-template-css', plugins_url('css/single/elina.css', __FILE__));
            wp_register_style('bdp-single-masonry_timeline-template-css', plugins_url('css/single/masonry_timeline.css', __FILE__));
            wp_register_style('bdp-single-tagly-template-css', plugins_url('css/single/tagly.css', __FILE__));
            wp_register_style('bdp-single-brite-template-css', plugins_url('css/single/brite.css', __FILE__));
            wp_register_style('bdp-single-chapter-template-css', plugins_url('css/single/chapter.css', __FILE__));
            wp_register_style('bdp-single-pretty-template-css', plugins_url('css/single/pretty.css', __FILE__));
	    wp_register_style('bdp-single-minimal-template-css', plugins_url('css/single/minimal.css', __FILE__));
	    wp_register_style('bdp-single-glamour-template-css', plugins_url('css/single/glamour.css', __FILE__));
	    wp_register_style('bdp-single-famous-template-css', plugins_url('css/single/famous.css', __FILE__));
	    wp_register_style('bdp-single-fairy-template-css', plugins_url('css/single/fairy.css', __FILE__));
	    wp_register_style('bdp-single-clicky-template-css', plugins_url('css/single/clicky.css', __FILE__));
	    wp_register_style('bdp-single-cover-template-css', plugins_url('css/single/cover.css', __FILE__));
	    wp_register_style('bdp-single-steps-template-css', plugins_url('css/single/steps.css', __FILE__));
	    wp_register_style('bdp-single-miracle-template-css', plugins_url('css/single/miracle.css', __FILE__));

            wp_register_style('choosen-handle-css', plugins_url('admin/css/chosen.min.css', __FILE__));

            wp_register_style('single-style-css', plugins_url('css/single/single_style.css', __FILE__));
            wp_register_style('single-rtl-style-css', plugins_url('css/single/single_rtl_style.css', __FILE__));
        }
    }

    /**
     * @return Enqueue front side required js
     */
    function bdp_front_script() {
        if (!wp_script_is('jquery', 'enqueued')) {
            wp_enqueue_script('jquery');
        }
        wp_localize_script(
                'script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php'), 'like' => __('Like', BLOGDESIGNERPRO_TEXTDOMAIN),
            'unlike' => __('Unlike', BLOGDESIGNERPRO_TEXTDOMAIN),
            'is_rtl' => (is_rtl()) ? 1 : 0
                )
        );

        if (!is_admin()) {
            wp_enqueue_script('jquery-masonry', array('jquery'));

            wp_register_script('bdp-galleryimage-script', plugins_url('js/jquery.flexslider-min.js', __FILE__));
            wp_register_script('bdp-mousewheel-script', plugins_url('js/jquery.mousewheel.js', __FILE__));
            wp_register_script('bdp-logbook-script', plugins_url('js/logbook.js', __FILE__));
            wp_register_script('bdp-easing-script', plugins_url('js/jquery.easing.js', __FILE__));

            wp_register_script('choosen-handle-script', plugins_url('admin/js/chosen.jquery.js', __FILE__), array('jquery', 'jquery-masonry'));
            $ajaxURL = plugins_url('js/ajax.js', __FILE__);
            wp_register_script('bdp-ajax-script', $ajaxURL);
            wp_localize_script(
                    'bdp-ajax-script', 'ajax_object', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'like' => __('Like', BLOGDESIGNERPRO_TEXTDOMAIN),
                'unlike' => __('Unlike', BLOGDESIGNERPRO_TEXTDOMAIN),
                'is_rtl' => (is_rtl()) ? 1 : 0,
                    )
            );
            $socialShareURL = plugins_url('js/SocialShare.js', __FILE__);
            wp_register_script('bdp-socialShare-script', $socialShareURL);
        }
    }

    /**
     * @return enqueue style
     */
    function bdp_add_template_style() {
        global $post, $wpdb;
        $bdp_themes = self::$template_name;
        $template_stylesheet_added = self::$template_stylesheet_added;
        $archive_list = bdp_get_archive_list();
        if ($template_stylesheet_added == 0) {
            if (is_array($bdp_themes) && count($bdp_themes) > 0) {
                foreach ($bdp_themes as $bdp_theme) {
                    self::$template_stylesheet_added = 1;

                    $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                    if ($bdp_template_name_changed == 1) {
                        if ($bdp_theme == 'classical') {
                            $bdp_theme = 'nicy';
                        } elseif ($bdp_theme == 'lightbreeze') {
                            $bdp_theme = 'sharpen';
                        } elseif ($bdp_theme == 'spektrum') {
                            $bdp_theme = 'hub';
                        }
                    } else {
                        update_option('bdp_template_name_changed', 0);
                    }
                    $style_name = 'bdp-' . $bdp_theme . '-template-css';
                    wp_enqueue_style($style_name);
                    wp_enqueue_style('bdp-basic-tools');
                    wp_enqueue_style('bdp-front-css');
                    if (is_rtl()) {
                        wp_enqueue_style('bdp-front-rtl-css');
                    }
                    if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                        wp_enqueue_style('bdp-fontawesome-stylesheets');
                    }
                    if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                        wp_enqueue_script('bdp-ajax-script');
                    }
                    if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                        wp_enqueue_style('bdp-galleryslider-stylesheets');
                    }
                    if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                        wp_enqueue_script('bdp-galleryimage-script');
                    }
                    if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                        wp_enqueue_script('bdp-mousewheel-script');
                        wp_enqueue_script('bdp-logbook-script');
                        wp_enqueue_script('bdp-easing-script');
                        wp_enqueue_style('bdp-logbook-css');

                        add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                    }
                    if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                        add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                    }
                }
            } elseif (is_archive()) {
                self::$template_stylesheet_added = 1;
                if (is_date() && in_array('date_template', $archive_list)) {
                    $date = bdp_get_date_template_settings();
                    $all_setting = $date->settings;
                    if (is_serialized($all_setting)) {
                        $bdp_settings = unserialize($all_setting);
                    }
                    $bdp_theme = apply_filters('bdp_filter_template', $bdp_settings['template_name']);
                    $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                    if ($bdp_template_name_changed == 1) {
                        if ($bdp_theme == 'classical') {
                            $bdp_theme = 'nicy';
                        } elseif ($bdp_theme == 'lightbreeze') {
                            $bdp_theme = 'sharpen';
                        } elseif ($bdp_theme == 'spektrum') {
                            $bdp_theme = 'hub';
                        }
                    } else {
                        update_option('bdp_template_name_changed', 0);
                    }
                    $style_name = 'bdp-' . $bdp_theme . '-template-css';
                    wp_enqueue_style($style_name);
                    wp_enqueue_style('bdp-basic-tools');
                    wp_enqueue_style('bdp-front-css');
                    if (is_rtl()) {
                        wp_enqueue_style('bdp-front-rtl-css');
                    }
                    if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                        wp_enqueue_style('bdp-fontawesome-stylesheets');
                    }
                    if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                        wp_enqueue_script('bdp-ajax-script');
                    }
                    if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                        wp_enqueue_style('bdp-galleryslider-stylesheets');
                    }
                    if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                        wp_enqueue_script('bdp-galleryimage-script');
                    }
                    if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                        wp_enqueue_script('bdp-mousewheel-script');
                        wp_enqueue_script('bdp-logbook-script');
                        wp_enqueue_script('bdp-easing-script');
                        wp_enqueue_style('bdp-logbook-css');
                        add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                    }
                    if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                        add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                    }
                } elseif (is_author() && in_array('author_template', $archive_list)) {
                    $author_id = get_query_var('author');
                    $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
                    $archive_id = $bdp_author_data['id'];
                    $bdp_settings = $bdp_author_data['bdp_settings'];
                    if ($bdp_settings) {
                        $bdp_theme = apply_filters('bdp_filter_template', $bdp_settings['template_name']);
                        $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                        if ($bdp_template_name_changed == 1) {
                            if ($bdp_theme == 'classical') {
                                $bdp_theme = 'nicy';
                            } elseif ($bdp_theme == 'lightbreeze') {
                                $bdp_theme = 'sharpen';
                            } elseif ($bdp_theme == 'spektrum') {
                                $bdp_theme = 'hub';
                            }
                        } else {
                            update_option('bdp_template_name_changed', 0);
                        }
                        $style_name = 'bdp-' . $bdp_theme . '-template-css';
                        wp_enqueue_style($style_name);
                        wp_enqueue_style('bdp-basic-tools');
                        wp_enqueue_style('bdp-front-css');
                        if (is_rtl()) {
                            wp_enqueue_style('bdp-front-rtl-css');
                        }
                        if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                            wp_enqueue_style('bdp-fontawesome-stylesheets');
                        }
                        if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-ajax-script');
                        }
                        if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                            wp_enqueue_style('bdp-galleryslider-stylesheets');
                        }
                        if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-galleryimage-script');
                        }
                        if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                            wp_enqueue_script('bdp-mousewheel-script');
                            wp_enqueue_script('bdp-logbook-script');
                            wp_enqueue_script('bdp-easing-script');
                            wp_enqueue_style('bdp-logbook-css');
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                        if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                    }
                } elseif (is_category() && in_array('category_template', $archive_list)) {
                    $categories = get_category(get_query_var('cat'));
                    $category_id = $categories->cat_ID;
                    $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
                    $archive_id = $bdp_category_data['id'];
                    $bdp_settings = $bdp_category_data['bdp_settings'];
                    if ($bdp_settings) {
                        $bdp_theme = $bdp_settings['template_name'];
                        $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                        if ($bdp_template_name_changed == 1) {
                            if ($bdp_theme == 'classical') {
                                $bdp_theme = 'nicy';
                            } elseif ($bdp_theme == 'lightbreeze') {
                                $bdp_theme = 'sharpen';
                            } elseif ($bdp_theme == 'spektrum') {
                                $bdp_theme = 'hub';
                            }
                        } else {
                            update_option('bdp_template_name_changed', 0);
                        }
                        $style_name = 'bdp-' . $bdp_theme . '-template-css';
                        wp_enqueue_style($style_name);
                        wp_enqueue_style('bdp-basic-tools');
                        wp_enqueue_style('bdp-front-css');
                        if (is_rtl()) {
                            wp_enqueue_style('bdp-front-rtl-css');
                        }
                        if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                            wp_enqueue_style('bdp-fontawesome-stylesheets');
                        }
                        if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-ajax-script');
                        }
                        if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                            wp_enqueue_style('bdp-galleryslider-stylesheets');
                        }
                        if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-galleryimage-script');
                        }
                        if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                            wp_enqueue_script('bdp-mousewheel-script');
                            wp_enqueue_script('bdp-logbook-script');
                            wp_enqueue_script('bdp-easing-script');
                            wp_enqueue_style('bdp-logbook-css');
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                        if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                    }
                } elseif (is_tag() && in_array('tag_template', $archive_list)) {
                    $tag_id = get_query_var('tag_id');
                    $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
                    $archive_id = $bdp_tag_data['id'];
                    $bdp_settings = $bdp_tag_data['bdp_settings'];
                    if ($bdp_settings) {
                        $bdp_theme = $bdp_settings['template_name'];
                        $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                        if ($bdp_template_name_changed == 1) {
                            if ($bdp_theme == 'classical') {
                                $bdp_theme = 'nicy';
                            } elseif ($bdp_theme == 'lightbreeze') {
                                $bdp_theme = 'sharpen';
                            } elseif ($bdp_theme == 'spektrum') {
                                $bdp_theme = 'hub';
                            }
                        } else {
                            update_option('bdp_template_name_changed', 0);
                        }
                        $style_name = 'bdp-' . $bdp_theme . '-template-css';
                        wp_enqueue_style($style_name);
                        wp_enqueue_style('bdp-basic-tools');
                        wp_enqueue_style('bdp-front-css');
                        if (is_rtl()) {
                            wp_enqueue_style('bdp-front-rtl-css');
                        }
                        if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                            wp_enqueue_style('bdp-fontawesome-stylesheets');
                        }
                        if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-ajax-script');
                        }
                        if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                            wp_enqueue_style('bdp-galleryslider-stylesheets');
                        }
                        if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-galleryimage-script');
                        }
                        if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                            wp_enqueue_script('bdp-mousewheel-script');
                            wp_enqueue_script('bdp-logbook-script');
                            wp_enqueue_script('bdp-easing-script');
                            wp_enqueue_style('bdp-logbook-css');
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                        if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                            add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                        }
                    }
                }
            } elseif (is_search() && in_array('search_template', $archive_list)) {
                $search_settings = bdp_get_search_template_settings();
                $allsettings = $search_settings->settings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                }
                $bdp_theme = apply_filters('bdp_filter_template', $bdp_settings['template_name']);
                $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                if ($bdp_template_name_changed == 1) {
                    if ($bdp_theme == 'classical') {
                        $bdp_theme = 'nicy';
                    } elseif ($bdp_theme == 'lightbreeze') {
                        $bdp_theme = 'sharpen';
                    } elseif ($bdp_theme == 'spektrum') {
                        $bdp_theme = 'hub';
                    }
                } else {
                    update_option('bdp_template_name_changed', 0);
                }
                $style_name = 'bdp-' . $bdp_theme . '-template-css';
                wp_enqueue_style($style_name);
                wp_enqueue_style('bdp-basic-tools');
                wp_enqueue_style('bdp-front-css');
                if (is_rtl()) {
                    wp_enqueue_style('bdp-front-rtl-css');
                }
                if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                    wp_enqueue_style('bdp-fontawesome-stylesheets');
                }
                if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                    wp_enqueue_script('bdp-ajax-script');
                }
                if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                    wp_enqueue_style('bdp-galleryslider-stylesheets');
                }
                if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                    wp_enqueue_script('bdp-galleryimage-script');
                }
                if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                    wp_enqueue_script('bdp-mousewheel-script');
                    wp_enqueue_script('bdp-logbook-script');
                    wp_enqueue_script('bdp-easing-script');
                    wp_enqueue_style('bdp-logbook-css');
                    add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                }
                if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                    add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                }
            } elseif (isset($post->post_content) && has_shortcode($post->post_content, 'wp_blog_designer')) {
                $pattern = get_shortcode_regex();
                if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches)) {
                    foreach ($matches[3] as $block) {
                        $attr = shortcode_parse_atts($block);
                        if (isset($attr['id'])) {
                            $shortcode_id = $attr['id'];
                            if ($shortcode_id != '') {
                                self::$template_stylesheet_added = 1;
                                $bdp_settings = bdp_get_shortcode_settings($shortcode_id);

                                $bdp_theme = $bdp_settings['template_name'];
                                $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                                if ($bdp_template_name_changed == 1) {
                                    if ($bdp_theme == 'classical') {
                                        $bdp_theme = 'nicy';
                                    } elseif ($bdp_theme == 'lightbreeze') {
                                        $bdp_theme = 'sharpen';
                                    } elseif ($bdp_theme == 'spektrum') {
                                        $bdp_theme = 'hub';
                                    }
                                } else {
                                    update_option('bdp_template_name_changed', 0);
                                }
                                $style_name = 'bdp-' . $bdp_theme . '-template-css';
                                wp_enqueue_style($style_name);
                                if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                                    wp_enqueue_style('bdp-fontawesome-stylesheets');
                                }
                                if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                                    wp_enqueue_script('bdp-ajax-script');
                                }
                                if (!wp_style_is('bdp-galleryslider-stylesheets')) {
                                    wp_enqueue_style('bdp-galleryslider-stylesheets');
                                }
                                if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                                    wp_enqueue_script('bdp-galleryimage-script');
                                }
                                if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                                    wp_enqueue_script('bdp-mousewheel-script');
                                    wp_enqueue_script('bdp-logbook-script');
                                    wp_enqueue_script('bdp-easing-script');
                                    wp_enqueue_style('bdp-logbook-css');
                                    add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                                }
                                if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
                                    add_action('wp_footer', array(&$this, 'bdp_template_dynamic_script'), 30);
                                }
                            }
                        }
                    }
                }
                wp_enqueue_style('bdp-basic-tools');
                wp_enqueue_style('bdp-front-css');
                if (is_rtl()) {
                    wp_enqueue_style('bdp-front-rtl-css');
                }
            } elseif (is_single()) {
                self::$template_stylesheet_added = 1;
                $post_id = $post->ID;
                $cat_ids = wp_get_post_categories($post_id);
                $tag_ids = wp_get_post_tags($post_id);
                $bdp_settings = bdp_get_single_template_settings($cat_ids, $tag_ids);
                $bdp_settings = unserialize($bdp_settings);
                $bdp_theme = apply_filters('bdp_filter_template', $bdp_settings['template_name']);
                $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                if ($bdp_template_name_changed == 1) {
                    if ($bdp_theme == 'classical') {
                        $bdp_theme = 'nicy';
                    } elseif ($bdp_theme == 'lightbreeze') {
                        $bdp_theme = 'sharpen';
                    } elseif ($bdp_theme == 'spektrum') {
                        $bdp_theme = 'hub';
                    }
                } else {
                    update_option('bdp_template_name_changed', 0);
                }

                $style_name = 'bdp-single-' . $bdp_theme . '-template-css';
                if (!wp_style_is('bdp-fontawesome-stylesheets')) {
                    wp_enqueue_style('bdp-fontawesome-stylesheets');
                }
                if (!wp_script_is('bdp-ajax-script', $list = 'enqueued')) {
                    wp_enqueue_script('bdp-ajax-script');
                }
                wp_enqueue_style($style_name);
                wp_enqueue_style('single-style-css');
                if (is_rtl()) {
                    wp_enqueue_style('single-rtl-style-css');
                }
            }
        }
        $current_id = 0;
        if (is_single()) {
            $current_page = 'single';
        } else if (is_archive()) {
            if (is_date()) {
                $current_page = 'date';
            } else if (is_author()) {
                $current_page = 'author';
            } else if (is_tag()) {
                $current_id = get_query_var('tag_id');
                $current_page = 'tag';
            } else if (is_category()) {
                $categories = get_category(get_query_var('cat'));
                $current_id = $categories->cat_ID;
                $current_page = 'category';
            } else {
                $current_page = 'archive';
            }
        } else if (is_search()) {
            $current_page = 'search';
        } else {
            $current_page = 'shortcode';
        }
        wp_localize_script(
                'bdp-ajax-script', 'page_object', array(
            'current_page' => $current_page,
            'current_id' => $current_id
                )
        );
    }

    /**
     * @return dynamic style
     */
    function bdp_template_dynamic_css() {
        global $post, $wpdb;
        $template_dynamic_stylesheet_added = self::$template_dynamic_stylesheet_added;
        if ($template_dynamic_stylesheet_added == 0) {
            if (isset($post->post_content) && has_shortcode($post->post_content, 'wp_blog_designer')) {
                $shortcode_id = '';
                $pattern = bdp_shortcode_regex();
                if (preg_match_all('/' . $pattern . '/s', $post->post_content, $matches)) {
                    foreach ($matches[3] as $block) {
                        $attr = shortcode_parse_atts($block);
                        if (isset($attr['id'])) {
                            $shortcode_id = $attr['id'];
                        }
                        if ($shortcode_id != '') {
                            self::$template_dynamic_stylesheet_added = 1;
                            $bdp_settings = bdp_get_shortcode_settings($shortcode_id);
                            $bdp_theme = $bdp_settings['template_name'];
                            $template_titlefontface = (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') ? $bdp_settings['template_titlefontface'] : "";
                            $load_goog_font_blog = array();
                            if (isset($bdp_settings['template_titlefontface_font_type']) && $bdp_settings['template_titlefontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $template_titlefontface;
                            }
                            $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                            $background = (isset($bdp_settings['template_bgcolor']) && $bdp_settings['template_bgcolor'] != '') ? $bdp_settings['template_bgcolor'] : "";
                            $template_bghovercolor = (isset($bdp_settings['template_bghovercolor']) && $bdp_settings['template_bghovercolor'] != '') ? $bdp_settings['template_bghovercolor'] : "";
                            $displaydate_backcolor = (isset($bdp_settings['displaydate_backcolor']) && $bdp_settings['displaydate_backcolor'] != '') ? $bdp_settings['displaydate_backcolor'] : "";
                            $templatecolor = (isset($bdp_settings['template_color']) && $bdp_settings['template_color'] != '') ? $bdp_settings['template_color'] : "inherit";
                            $color = (isset($bdp_settings['template_ftcolor']) && $bdp_settings['template_ftcolor'] != '') ? $bdp_settings['template_ftcolor'] : "inherit";
                            $grid_hoverback_color = (isset($bdp_settings['grid_hoverback_color']) && $bdp_settings['grid_hoverback_color'] != '') ? $bdp_settings['grid_hoverback_color'] : "";
                            $linkhovercolor = (isset($bdp_settings['template_fthovercolor']) && $bdp_settings['template_fthovercolor'] != '') ? $bdp_settings['template_fthovercolor'] : "";
                            $loader_color = (isset($bdp_settings['loader_color']) && $bdp_settings['loader_color'] != '') ? $bdp_settings['loader_color'] : "inherit";
                            $loadmore_button_color = (isset($bdp_settings['loadmore_button_color']) && $bdp_settings['loadmore_button_color'] != '') ? $bdp_settings['loadmore_button_color'] : "#ffffff";
                            $loadmore_button_bg_color = (isset($bdp_settings['loadmore_button_bg_color']) && $bdp_settings['loadmore_button_bg_color'] != '') ? $bdp_settings['loadmore_button_bg_color'] : "#444444";
                            $titlecolor = (isset($bdp_settings['template_titlecolor']) && $bdp_settings['template_titlecolor'] != '') ? $bdp_settings['template_titlecolor'] : "";
                            $titlehovercolor = (isset($bdp_settings['template_titlehovercolor']) && $bdp_settings['template_titlehovercolor'] != '') ? $bdp_settings['template_titlehovercolor'] : "";
                            $contentcolor = (isset($bdp_settings['template_contentcolor']) && $bdp_settings['template_contentcolor'] != '') ? $bdp_settings['template_contentcolor'] : "";
                            $readmorecolor = (isset($bdp_settings['template_readmorecolor']) && $bdp_settings['template_readmorecolor'] != '') ? $bdp_settings['template_readmorecolor'] : "";
                            $readmorebackcolor = (isset($bdp_settings['template_readmorebackcolor']) && $bdp_settings['template_readmorebackcolor'] != '') ? $bdp_settings['template_readmorebackcolor'] : "";
                            $readmorehoverbackcolor = (isset($bdp_settings['template_readmore_hover_backcolor']) && $bdp_settings['template_readmore_hover_backcolor'] != '') ? $bdp_settings['template_readmore_hover_backcolor'] : "";
                            $alterbackground = (isset($bdp_settings['template_alterbgcolor']) && $bdp_settings['template_alterbgcolor'] != '') ? $bdp_settings['template_alterbgcolor'] : "";
                            $titlebackcolor = (isset($bdp_settings['template_titlebackcolor']) && $bdp_settings['template_titlebackcolor'] != '') ? $bdp_settings['template_titlebackcolor'] : "";
                            $social_icon_style = (isset($bdp_settings['social_icon_style']) && $bdp_settings['social_icon_style'] != '') ? $bdp_settings['social_icon_style'] : 0;
                            $social_style = (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] != '') ? $bdp_settings['social_style'] : '';
                            $template_alternativebackground = (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] != '') ? $bdp_settings['template_alternativebackground'] : 0;
                            $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != '') ? $bdp_settings['firstletter_fontsize'] : '';
                            $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : "inherit";
                            if (isset($bdp_settings['firstletter_font_family_font_type']) && $bdp_settings['firstletter_font_family_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $firstletter_font_family;
                            }
                            $firstletter_contentcolor = (isset($bdp_settings['firstletter_contentcolor']) && $bdp_settings['firstletter_contentcolor'] != '') ? $bdp_settings['firstletter_contentcolor'] : "";
                            $firstletter_big = (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] != '') ? $bdp_settings['firstletter_big'] : "";
                            $template_titlefontsize = (isset($bdp_settings['template_titlefontsize']) && $bdp_settings['template_titlefontsize'] != '') ? $bdp_settings['template_titlefontsize'] : "";
                            $content_fontsize = (isset($bdp_settings['content_fontsize']) && $bdp_settings['content_fontsize'] != '') ? $bdp_settings['content_fontsize'] : "inherit";
                            $content_font_family = (isset($bdp_settings['content_font_family']) && $bdp_settings['content_font_family'] != '') ? $bdp_settings['content_font_family'] : '';
                            if (isset($bdp_settings['content_font_family_font_type']) && $bdp_settings['content_font_family_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $content_font_family;
                            }
                            $grid_col_space = (isset($bdp_settings['grid_col_space']) && $bdp_settings['grid_col_space'] != '') ? $bdp_settings['grid_col_space'] : 10;
                            $template_alternative_color = (isset($bdp_settings['template_alternative_color']) && $bdp_settings['template_alternative_color'] != '') ? $bdp_settings['template_alternative_color'] : "";
                            $story_startup_background = (isset($bdp_settings['story_startup_background']) && $bdp_settings['story_startup_background'] != '') ? $bdp_settings['story_startup_background'] : "";
                            $story_startup_text_color = (isset($bdp_settings['story_startup_text_color']) && $bdp_settings['story_startup_text_color'] != '') ? $bdp_settings['story_startup_text_color'] : "";
                            $story_ending_background = (isset($bdp_settings['story_ending_background']) && $bdp_settings['story_ending_background'] != '') ? $bdp_settings['story_ending_background'] : "";
                            $story_ending_text_color = (isset($bdp_settings['story_ending_text_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_ending_text_color'] : "";

                            $story_startup_border_color = (isset($bdp_settings['story_startup_border_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_startup_border_color'] : "";

                            /**
                             * Post Title Font style Setting
                             */
                            $template_title_font_weight = isset($bdp_settings['template_title_font_weight']) ? $bdp_settings['template_title_font_weight'] : '';
                            $template_title_font_line_height = isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '';
                            $template_title_font_italic = isset($bdp_settings['template_title_font_italic']) ? $bdp_settings['template_title_font_italic'] : '';
                            $template_title_font_text_transform = isset($bdp_settings['template_title_font_text_transform']) ? $bdp_settings['template_title_font_text_transform'] : 'none';
                            $template_title_font_text_decoration = isset($bdp_settings['template_title_font_text_decoration']) ? $bdp_settings['template_title_font_text_decoration'] : 'none';
                            $template_title_font_letter_spacing = isset($bdp_settings['template_title_font_letter_spacing']) ? $bdp_settings['template_title_font_letter_spacing'] : '0';

                            /**
                             * Content Font style Setting
                             */
                            $content_font_weight = isset($bdp_settings['content_font_weight']) ? $bdp_settings['content_font_weight'] : '';
                            $content_font_line_height = isset($bdp_settings['content_font_line_height']) ? $bdp_settings['content_font_line_height'] : '';
                            $content_font_italic = isset($bdp_settings['content_font_italic']) ? $bdp_settings['content_font_italic'] : '';
                            $content_font_text_transform = isset($bdp_settings['content_font_text_transform']) ? $bdp_settings['content_font_text_transform'] : 'none';
                            $content_font_text_decoration = isset($bdp_settings['content_font_text_decoration']) ? $bdp_settings['content_font_text_decoration'] : 'none';
                            $content_font_letter_spacing = isset($bdp_settings['content_font_letter_spacing']) ? $bdp_settings['content_font_letter_spacing'] : '0';

                            $author_bgcolor = (isset($bdp_settings['author_bgcolor']) && $bdp_settings['author_bgcolor'] != '') ? $bdp_settings['author_bgcolor'] : "";
                            /**
                             * Author Title Setting
                             */
                            $author_titlecolor = (isset($bdp_settings['author_titlecolor']) && $bdp_settings['author_titlecolor'] != '') ? $bdp_settings['author_titlecolor'] : "";
                            $authorTitleSize = (isset($bdp_settings['author_title_fontsize']) && $bdp_settings['author_title_fontsize'] != '') ? $bdp_settings['author_title_fontsize'] : "";
                            $authorTitleFace = (isset($bdp_settings['author_title_fontface']) && $bdp_settings['author_title_fontface'] != '') ? $bdp_settings['author_title_fontface'] : "inherit";
                            if (isset($bdp_settings['author_title_fontface_font_type']) && $bdp_settings['author_title_fontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $authorTitleFace;
                            }
                            $author_title_font_weight = isset($bdp_settings['author_title_font_weight']) ? $bdp_settings['author_title_font_weight'] : '';
                            $author_title_font_line_height = isset($bdp_settings['author_title_font_line_height']) ? $bdp_settings['author_title_font_line_height'] : '';
                            $auhtor_title_font_italic = isset($bdp_settings['auhtor_title_font_italic']) ? $bdp_settings['auhtor_title_font_italic'] : 0;
                            $author_title_font_text_transform = isset($bdp_settings['author_title_font_text_transform']) ? $bdp_settings['author_title_font_text_transform'] : 'none';
                            $author_title_font_text_decoration = isset($bdp_settings['author_title_font_text_decoration']) ? $bdp_settings['author_title_font_text_decoration'] : 'none';
                            $author_title_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letter_spacing']) ? $bdp_settings['auhtor_title_font_letter_spacing'] : '0';


                            /**
                             * Author Content Font style Setting
                             */
                            $author_content_color = (isset($bdp_settings['author_content_color']) && $bdp_settings['author_content_color'] != '') ? $bdp_settings['author_content_color'] : "";
                            $author_content_fontsize = (isset($bdp_settings['author_content_fontsize']) && $bdp_settings['author_content_fontsize'] != '') ? $bdp_settings['author_content_fontsize'] : "";
                            $author_content_fontface = (isset($bdp_settings['author_content_fontface']) && $bdp_settings['author_content_fontface'] != '') ? $bdp_settings['author_content_fontface'] : "";
                            if (isset($bdp_settings['author_content_fontface_font_type']) && $bdp_settings['author_content_fontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $author_content_fontface;
                            }
                            $author_content_font_weight = isset($bdp_settings['author_content_font_weight']) ? $bdp_settings['author_content_font_weight'] : '';
                            $author_content_font_line_height = isset($bdp_settings['author_content_font_line_height']) ? $bdp_settings['author_content_font_line_height'] : '';
                            $auhtor_content_font_italic = isset($bdp_settings['auhtor_content_font_italic']) ? $bdp_settings['auhtor_content_font_italic'] : 0;
                            $author_content_font_text_transform = isset($bdp_settings['author_content_font_text_transform']) ? $bdp_settings['author_content_font_text_transform'] : 'none';
                            $author_content_font_text_decoration = isset($bdp_settings['author_content_font_text_decoration']) ? $bdp_settings['author_content_font_text_decoration'] : 'none';
                            $auhtor_content_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letterauhtor_content_font_letter_spacing_spacing']) ? $bdp_settings['auhtor_content_font_letter_spacing'] : '0';


                            /**
                             *  Custom Read More Setting
                             */
                            $beforeloop_Readmoretext = isset($bdp_settings['beforeloop_Readmoretext']) ? $bdp_settings['beforeloop_Readmoretext'] : '';
                            $beforeloop_readmorecolor = isset($bdp_settings['beforeloop_readmorecolor']) ? $bdp_settings['beforeloop_readmorecolor'] : '';
                            $beforeloop_readmorebackcolor = isset($bdp_settings['beforeloop_readmorebackcolor']) ? $bdp_settings['beforeloop_readmorebackcolor'] : '';
                            $beforeloop_readmorehovercolor = isset($bdp_settings['beforeloop_readmorehovercolor']) ? $bdp_settings['beforeloop_readmorehovercolor'] : '';
                            $beforeloop_readmorehoverbackcolor = isset($bdp_settings['beforeloop_readmorehoverbackcolor']) ? $bdp_settings['beforeloop_readmorehoverbackcolor'] : '';
                            $beforeloop_titlefontface = (isset($bdp_settings['beforeloop_titlefontface']) && $bdp_settings['beforeloop_titlefontface'] != '') ? $bdp_settings['beforeloop_titlefontface'] : '';
                            if (isset($bdp_settings['beforeloop_titlefontface_font_type']) && $bdp_settings['beforeloop_titlefontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $beforeloop_titlefontface;
                            }
                            $beforeloop_titlefontsize = (isset($bdp_settings['beforeloop_titlefontsize']) && $bdp_settings['beforeloop_titlefontsize'] != '') ? $bdp_settings['beforeloop_titlefontsize'] : "inherit";
                            $beforeloop_title_font_weight = isset($bdp_settings['beforeloop_title_font_weight']) ? $bdp_settings['beforeloop_title_font_weight'] : '';
                            $beforeloop_title_font_line_height = isset($bdp_settings['beforeloop_title_font_line_height']) ? $bdp_settings['beforeloop_title_font_line_height'] : '';
                            $beforeloop_title_font_italic = isset($bdp_settings['beforeloop_title_font_italic']) ? $bdp_settings['beforeloop_title_font_italic'] : '';
                            $beforeloop_title_font_text_transform = isset($bdp_settings['beforeloop_title_font_text_transform']) ? $bdp_settings['beforeloop_title_font_text_transform'] : 'none';
                            $beforeloop_title_font_text_decoration = isset($bdp_settings['beforeloop_title_font_text_decoration']) ? $bdp_settings['beforeloop_title_font_text_decoration'] : 'none';
                            $beforeloop_title_font_letter_spacing = isset($bdp_settings['beforeloop_title_font_letter_spacing']) ? $bdp_settings['beforeloop_title_font_letter_spacing'] : '0';

                            /**
                             * Slider Image height
                             */
                            $slider_image_height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : '';

                            include 'css/layout_dynamic_style.php';
                            if (get_option('bdp_custom_google_fonts') != '') {
                                $sidebar = explode(',', get_option('bdp_custom_google_fonts'));
                                foreach ($sidebar as $key => $value) {
                                    $whatIWant = substr($value, strpos($value, "=") + 1);
                                    $load_goog_font_blog[] = $whatIWant;
                                }
                            }
                            if (!empty($load_goog_font_blog)) {
                                $loadFontArr = array_values(array_unique($load_goog_font_blog));
                                foreach ($loadFontArr as $font_family) {
                                    if ($font_family != '') {
                                        $setBase = (is_ssl()) ? "https://" : "http://";
                                        $font_href = $setBase . 'fonts.googleapis.com/css?family=' . $font_family;
                                        wp_enqueue_style('bdp-google-fonts-' . $font_family, $font_href, false);
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $bdp_shortcode_ids = self::$shortcode_id;
                $bdp_themes = self::$template_name;
                if (is_array($bdp_shortcode_ids) && count($bdp_shortcode_ids) > 0) {
                    $shortcode_index = 0;
                    foreach ($bdp_shortcode_ids as $bdp_shortcode_id) {
                        if ($bdp_shortcode_id != '') {
                            $bdp_theme = $bdp_themes[$shortcode_index];
                            self::$template_dynamic_stylesheet_added = 1;
                            $shortcode_id = $bdp_shortcode_id;
                            $bdp_settings = bdp_get_shortcode_settings($bdp_shortcode_id);
                            $template_titlefontface = (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') ? $bdp_settings['template_titlefontface'] : "";
                            $load_goog_font_blog = array();
                            if (isset($bdp_settings['template_titlefontface_font_type']) && $bdp_settings['template_titlefontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $template_titlefontface;
                            }
                            $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                            $background = (isset($bdp_settings['template_bgcolor']) && $bdp_settings['template_bgcolor'] != '') ? $bdp_settings['template_bgcolor'] : "";
                            $template_bghovercolor = (isset($bdp_settings['template_bghovercolor']) && $bdp_settings['template_bghovercolor'] != '') ? $bdp_settings['template_bghovercolor'] : "";
                            $templatecolor = (isset($bdp_settings['template_color']) && $bdp_settings['template_color'] != '') ? $bdp_settings['template_color'] : "";
                            $displaydate_backcolor = (isset($bdp_settings['displaydate_backcolor']) && $bdp_settings['displaydate_backcolor'] != '') ? $bdp_settings['displaydate_backcolor'] : "";
                            $color = (isset($bdp_settings['template_ftcolor']) && $bdp_settings['template_ftcolor'] != '') ? $bdp_settings['template_ftcolor'] : "";
                            $grid_hoverback_color = (isset($bdp_settings['grid_hoverback_color']) && $bdp_settings['grid_hoverback_color'] != '') ? $bdp_settings['grid_hoverback_color'] : "";
                            $linkhovercolor = (isset($bdp_settings['template_fthovercolor']) && $bdp_settings['template_fthovercolor'] != '') ? $bdp_settings['template_fthovercolor'] : "";
                            $loader_color = (isset($bdp_settings['loader_color']) && $bdp_settings['loader_color'] != '') ? $bdp_settings['loader_color'] : "inherit";
                            $loadmore_button_color = (isset($bdp_settings['loadmore_button_color']) && $bdp_settings['loadmore_button_color'] != '') ? $bdp_settings['loadmore_button_color'] : "#ffffff";
                            $loadmore_button_bg_color = (isset($bdp_settings['loadmore_button_bg_color']) && $bdp_settings['loadmore_button_bg_color'] != '') ? $bdp_settings['loadmore_button_bg_color'] : "#444444";
                            $titlecolor = (isset($bdp_settings['template_titlecolor']) && $bdp_settings['template_titlecolor'] != '') ? $bdp_settings['template_titlecolor'] : "";
                            $titlehovercolor = (isset($bdp_settings['template_titlehovercolor']) && $bdp_settings['template_titlehovercolor'] != '') ? $bdp_settings['template_titlehovercolor'] : "";
                            $contentcolor = (isset($bdp_settings['template_contentcolor']) && $bdp_settings['template_contentcolor'] != '') ? $bdp_settings['template_contentcolor'] : "";
                            $readmorecolor = (isset($bdp_settings['template_readmorecolor']) && $bdp_settings['template_readmorecolor'] != '') ? $bdp_settings['template_readmorecolor'] : "";
                            $readmorebackcolor = (isset($bdp_settings['template_readmorebackcolor']) && $bdp_settings['template_readmorebackcolor'] != '') ? $bdp_settings['template_readmorebackcolor'] : "";
                            $readmorehoverbackcolor = (isset($bdp_settings['template_readmore_hover_backcolor']) && $bdp_settings['template_readmore_hover_backcolor'] != '') ? $bdp_settings['template_readmore_hover_backcolor'] : "";
                            $alterbackground = (isset($bdp_settings['template_alterbgcolor']) && $bdp_settings['template_alterbgcolor'] != '') ? $bdp_settings['template_alterbgcolor'] : "";
                            $titlebackcolor = (isset($bdp_settings['template_titlebackcolor']) && $bdp_settings['template_titlebackcolor'] != '') ? $bdp_settings['template_titlebackcolor'] : "";
                            $social_icon_style = (isset($bdp_settings['social_icon_style']) && $bdp_settings['social_icon_style'] != '') ? $bdp_settings['social_icon_style'] : 0;
                            $social_style = (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] != '') ? $bdp_settings['social_style'] : '';
                            $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != '') ? $bdp_settings['firstletter_fontsize'] : "inherit";
                            $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : "inherit";
                            if (isset($bdp_settings['firstletter_font_family_font_type']) && $bdp_settings['firstletter_font_family_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $firstletter_font_family;
                            }
                            $firstletter_contentcolor = (isset($bdp_settings['firstletter_contentcolor']) && $bdp_settings['firstletter_contentcolor'] != '') ? $bdp_settings['firstletter_contentcolor'] : "inherit";
                            $firstletter_big = (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] != '') ? $bdp_settings['firstletter_big'] : "";
                            $template_alternativebackground = (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] != '') ? $bdp_settings['template_alternativebackground'] : 0;
                            $template_titlefontsize = (isset($bdp_settings['template_titlefontsize']) && $bdp_settings['template_titlefontsize'] != '') ? $bdp_settings['template_titlefontsize'] : "inherit";
                            $content_font_family = (isset($bdp_settings['content_font_family']) && $bdp_settings['content_font_family'] != '') ? $bdp_settings['content_font_family'] : '';
                            if (isset($bdp_settings['content_font_family_font_type']) && $bdp_settings['content_font_family_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $content_font_family;
                            }
                            $template_alternative_color = (isset($bdp_settings['template_alternative_color']) && $bdp_settings['template_alternative_color'] != '') ? $bdp_settings['template_alternative_color'] : "inherit";
                            $grid_col_space = (isset($bdp_settings['grid_col_space']) && $bdp_settings['grid_col_space'] != '') ? $bdp_settings['grid_col_space'] : 10;
                            $content_fontsize = (isset($bdp_settings['content_fontsize']) && $bdp_settings['content_fontsize'] != '') ? $bdp_settings['content_fontsize'] : "inherit";
                            $story_startup_background = (isset($bdp_settings['story_startup_background']) && $bdp_settings['story_startup_background'] != '') ? $bdp_settings['story_startup_background'] : "";
                            $story_startup_text_color = (isset($bdp_settings['story_startup_text_color']) && $bdp_settings['story_startup_text_color'] != '') ? $bdp_settings['story_startup_text_color'] : "";
                            $story_ending_background = (isset($bdp_settings['story_ending_background']) && $bdp_settings['story_ending_background'] != '') ? $bdp_settings['story_ending_background'] : "";
                            $story_ending_text_color = (isset($bdp_settings['story_ending_text_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_ending_text_color'] : "";
                            $story_startup_border_color = (isset($bdp_settings['story_startup_border_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_startup_border_color'] : "";

                            /**
                             * Font style Setting
                             */
                            $template_title_font_weight = isset($bdp_settings['template_title_font_weight']) ? $bdp_settings['template_title_font_weight'] : '';
                            $template_title_font_line_height = isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '';
                            $template_title_font_italic = isset($bdp_settings['template_title_font_italic']) ? $bdp_settings['template_title_font_italic'] : '';
                            $template_title_font_text_transform = isset($bdp_settings['template_title_font_text_transform']) ? $bdp_settings['template_title_font_text_transform'] : 'none';
                            $template_title_font_text_decoration = isset($bdp_settings['template_title_font_text_decoration']) ? $bdp_settings['template_title_font_text_decoration'] : 'none';
                            $template_title_font_letter_spacing = isset($bdp_settings['template_title_font_letter_spacing']) ? $bdp_settings['template_title_font_letter_spacing'] : '0';

                            /**
                             * Content Font style Setting
                             */
                            $content_font_weight = isset($bdp_settings['content_font_weight']) ? $bdp_settings['content_font_weight'] : '';
                            $content_font_line_height = isset($bdp_settings['content_font_line_height']) ? $bdp_settings['content_font_line_height'] : '';
                            $content_font_italic = isset($bdp_settings['content_font_italic']) ? $bdp_settings['content_font_italic'] : '';
                            $content_font_text_transform = isset($bdp_settings['content_font_text_transform']) ? $bdp_settings['content_font_text_transform'] : 'none';
                            $content_font_text_decoration = isset($bdp_settings['content_font_text_decoration']) ? $bdp_settings['content_font_text_decoration'] : 'none';
                            $content_font_letter_spacing = isset($bdp_settings['content_font_letter_spacing']) ? $bdp_settings['content_font_letter_spacing'] : '0';

                            $author_bgcolor = (isset($bdp_settings['author_bgcolor']) && $bdp_settings['author_bgcolor'] != '') ? $bdp_settings['author_bgcolor'] : "inherit";
                            /**
                             * Author Title Setting
                             */
                            $author_titlecolor = (isset($bdp_settings['author_titlecolor']) && $bdp_settings['author_titlecolor'] != '') ? $bdp_settings['author_titlecolor'] : "inherit";
                            $authorTitleSize = (isset($bdp_settings['author_title_fontsize']) && $bdp_settings['author_title_fontsize'] != '') ? $bdp_settings['author_title_fontsize'] : "inherit";
                            $authorTitleFace = (isset($bdp_settings['author_title_fontface']) && $bdp_settings['author_title_fontface'] != '') ? $bdp_settings['author_title_fontface'] : "inherit";
                            if (isset($bdp_settings['author_title_fontface_font_type']) && $bdp_settings['author_title_fontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $authorTitleFace;
                            }
                            $author_title_font_weight = isset($bdp_settings['author_title_font_weight']) ? $bdp_settings['author_title_font_weight'] : '';
                            $author_title_font_line_height = isset($bdp_settings['author_title_font_line_height']) ? $bdp_settings['author_title_font_line_height'] : '';
                            $auhtor_title_font_italic = isset($bdp_settings['auhtor_title_font_italic']) ? $bdp_settings['auhtor_title_font_italic'] : 0;
                            $author_title_font_text_transform = isset($bdp_settings['author_title_font_text_transform']) ? $bdp_settings['author_title_font_text_transform'] : 'none';
                            $author_title_font_text_decoration = isset($bdp_settings['author_title_font_text_decoration']) ? $bdp_settings['author_title_font_text_decoration'] : 'none';
                            $author_title_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letter_spacing']) ? $bdp_settings['auhtor_title_font_letter_spacing'] : '0';


                            /**
                             * Author Content Font style Setting
                             */
                            $author_content_color = (isset($bdp_settings['author_content_color']) && $bdp_settings['author_content_color'] != '') ? $bdp_settings['author_content_color'] : "inherit";
                            $author_content_fontsize = (isset($bdp_settings['author_content_fontsize']) && $bdp_settings['author_content_fontsize'] != '') ? $bdp_settings['author_content_fontsize'] : "inherit";
                            $author_content_fontface = (isset($bdp_settings['author_content_fontface']) && $bdp_settings['author_content_fontface'] != '') ? $bdp_settings['author_content_fontface'] : "";
                            if (isset($bdp_settings['author_content_fontface_font_type']) && $bdp_settings['author_content_fontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $author_content_fontface;
                            }
                            $author_content_font_weight = isset($bdp_settings['author_content_font_weight']) ? $bdp_settings['author_content_font_weight'] : '';
                            $author_content_font_line_height = isset($bdp_settings['author_content_font_line_height']) ? $bdp_settings['author_content_font_line_height'] : '';
                            $auhtor_content_font_italic = isset($bdp_settings['auhtor_content_font_italic']) ? $bdp_settings['auhtor_content_font_italic'] : 0;
                            $author_content_font_text_transform = isset($bdp_settings['author_content_font_text_transform']) ? $bdp_settings['author_content_font_text_transform'] : 'none';
                            $author_content_font_text_decoration = isset($bdp_settings['author_content_font_text_decoration']) ? $bdp_settings['author_content_font_text_decoration'] : 'none';
                            $auhtor_content_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letterauhtor_content_font_letter_spacing_spacing']) ? $bdp_settings['auhtor_content_font_letter_spacing'] : '0';

                            /**
                             *  Custom Read More Setting
                             */
                            $beforeloop_Readmoretext = isset($bdp_settings['beforeloop_Readmoretext']) ? $bdp_settings['beforeloop_Readmoretext'] : '';
                            $beforeloop_readmorecolor = isset($bdp_settings['beforeloop_readmorecolor']) ? $bdp_settings['beforeloop_readmorecolor'] : '';
                            $beforeloop_readmorebackcolor = isset($bdp_settings['beforeloop_readmorebackcolor']) ? $bdp_settings['beforeloop_readmorebackcolor'] : '';
                            $beforeloop_readmorehovercolor = isset($bdp_settings['beforeloop_readmorehovercolor']) ? $bdp_settings['beforeloop_readmorehovercolor'] : '';
                            $beforeloop_readmorehoverbackcolor = isset($bdp_settings['beforeloop_readmorehoverbackcolor']) ? $bdp_settings['beforeloop_readmorehoverbackcolor'] : '';
                            $beforeloop_titlefontface = (isset($bdp_settings['beforeloop_titlefontface']) && $bdp_settings['beforeloop_titlefontface'] != '') ? $bdp_settings['beforeloop_titlefontface'] : '';
                            if (isset($bdp_settings['beforeloop_titlefontface_font_type']) && $bdp_settings['beforeloop_titlefontface_font_type'] == 'Google Fonts') {
                                $load_goog_font_blog[] = $beforeloop_titlefontface;
                            }
                            $beforeloop_titlefontsize = (isset($bdp_settings['beforeloop_titlefontsize']) && $bdp_settings['beforeloop_titlefontsize'] != '') ? $bdp_settings['beforeloop_titlefontsize'] : "inherit";
                            $beforeloop_title_font_weight = isset($bdp_settings['beforeloop_title_font_weight']) ? $bdp_settings['beforeloop_title_font_weight'] : '';
                            $beforeloop_title_font_line_height = isset($bdp_settings['beforeloop_title_font_line_height']) ? $bdp_settings['beforeloop_title_font_line_height'] : '';
                            $beforeloop_title_font_italic = isset($bdp_settings['beforeloop_title_font_italic']) ? $bdp_settings['beforeloop_title_font_italic'] : '';
                            $beforeloop_title_font_text_transform = isset($bdp_settings['beforeloop_title_font_text_transform']) ? $bdp_settings['beforeloop_title_font_text_transform'] : 'none';
                            $beforeloop_title_font_text_decoration = isset($bdp_settings['beforeloop_title_font_text_decoration']) ? $bdp_settings['beforeloop_title_font_text_decoration'] : 'none';
                            $beforeloop_title_font_letter_spacing = isset($bdp_settings['beforeloop_title_font_letter_spacing']) ? $bdp_settings['beforeloop_title_font_letter_spacing'] : '0';

                            /**
                             * Slider Image height
                             */
                            $slider_image_height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : '';

                            include 'css/layout_dynamic_style.php';
                            if (get_option('bdp_custom_google_fonts') != '') {
                                $sidebar = explode(',', get_option('bdp_custom_google_fonts'));
                                foreach ($sidebar as $key => $value) {
                                    $whatIWant = substr($value, strpos($value, "=") + 1);
                                    $load_goog_font_blog[] = $whatIWant;
                                }
                            }
                            if (!empty($load_goog_font_blog)) {
                                $loadFontArr = array_values(array_unique($load_goog_font_blog));
                                foreach ($loadFontArr as $font_family) {
                                    if ($font_family != '') {
                                        $setBase = (is_ssl()) ? "https://" : "http://";
                                        $font_href = $setBase . 'fonts.googleapis.com/css?family=' . $font_family;
                                        wp_enqueue_style('bdp-google-fonts-' . $font_family, $font_href, false);
                                        ?>
                                        <?php
                                    }
                                }
                            }
                            $shortcode_index++;
                        }
                    }
                }
            }
        }
    }

    /**
     * @return dynamic style for archive
     */
    function bdp_archive_dynamic_css() {
        global $post, $wpdb;
        $archive_dynamic_stylesheet_added = self::$archive_dynamic_stylesheet_added;
        if ($archive_dynamic_stylesheet_added == 0) {

            self::$archive_dynamic_stylesheet_added = 1;
            $archive_list = bdp_get_archive_list();
            $archive_id = '';
            $bdp_settings = array();
            if (is_date() && in_array('date_template', $archive_list)) {
                $date_settings = bdp_get_date_template_settings();
                $array = array_keys($archive_list, 'date_template');
                $archive_id = $array[0];
                $allsettings = $date_settings->settings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                }
            } else if (is_author() && in_array('author_template', $archive_list)) {
                $author_id = get_query_var('author');
                $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
                $archive_id = $bdp_author_data['id'];
                $bdp_settings = $bdp_author_data['bdp_settings'];
            } else if (is_category() && in_array('category_template', $archive_list)) {
                $categories = get_category(get_query_var('cat'));
                $category_id = $categories->cat_ID;
                $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
                $archive_id = $bdp_category_data['id'];
                $bdp_settings = $bdp_category_data['bdp_settings'];
            } else if (is_tag() && in_array('tag_template', $archive_list)) {
                $tag_id = get_query_var('tag_id');
                $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
                $archive_id = $bdp_tag_data['id'];
                $bdp_settings = $bdp_tag_data['bdp_settings'];
            } else if (is_search() && in_array('search_template', $archive_list)) {
                $search_settings = bdp_get_search_template_settings();
                $array = array_keys($archive_list, 'search_template');
                $archive_id = $array[0];
                $allsettings = $search_settings->settings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                }
            }
            $shortcode_id = $archive_id;
            if ($bdp_settings) {
                $bdp_theme = isset($bdp_settings['template_name']) ? $bdp_settings['template_name'] : '';
                $bdp_theme = apply_filters('bdp_filter_template', $bdp_theme);
                $template_titlefontface = (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') ? $bdp_settings['template_titlefontface'] : "";
                $load_goog_font_blog = array();
                if (isset($bdp_settings['template_titlefontface_font_type']) && $bdp_settings['template_titlefontface_font_type'] == 'Google Fonts') {
                    $load_goog_font_blog[] = $template_titlefontface;
                }
                $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                $background = (isset($bdp_settings['template_bgcolor']) && $bdp_settings['template_bgcolor'] != '') ? $bdp_settings['template_bgcolor'] : "";
                $templatecolor = (isset($bdp_settings['template_color']) && $bdp_settings['template_color'] != '') ? $bdp_settings['template_color'] : "#000";
                $displaydate_backcolor = (isset($bdp_settings['displaydate_backcolor']) && $bdp_settings['displaydate_backcolor'] != '') ? $bdp_settings['displaydate_backcolor'] : "#414a54";
                $template_bghovercolor = (isset($bdp_settings['template_bghovercolor']) && $bdp_settings['template_bghovercolor'] != '') ? $bdp_settings['template_bghovercolor'] : "#eeeeee";
                $color = (isset($bdp_settings['template_ftcolor']) && $bdp_settings['template_ftcolor'] != '') ? $bdp_settings['template_ftcolor'] : "#000";
                $linkhovercolor = (isset($bdp_settings['template_fthovercolor']) && $bdp_settings['template_fthovercolor'] != '') ? $bdp_settings['template_fthovercolor'] : "#000";
                $loader_color = (isset($bdp_settings['loader_color']) && $bdp_settings['loader_color'] != '') ? $bdp_settings['loader_color'] : "inherit";
                $loadmore_button_color = (isset($bdp_settings['loadmore_button_color']) && $bdp_settings['loadmore_button_color'] != '') ? $bdp_settings['loadmore_button_color'] : "#ffffff";
                $loadmore_button_bg_color = (isset($bdp_settings['loadmore_button_bg_color']) && $bdp_settings['loadmore_button_bg_color'] != '') ? $bdp_settings['loadmore_button_bg_color'] : "#444444";
                $titlecolor = (isset($bdp_settings['template_titlecolor']) && $bdp_settings['template_titlecolor'] != '') ? $bdp_settings['template_titlecolor'] : "#000";
                $titlehovercolor = (isset($bdp_settings['template_titlehovercolor']) && $bdp_settings['template_titlehovercolor'] != '') ? $bdp_settings['template_titlehovercolor'] : "#000";
                $contentcolor = (isset($bdp_settings['template_contentcolor']) && $bdp_settings['template_contentcolor'] != '') ? $bdp_settings['template_contentcolor'] : "#000";
                $readmorecolor = (isset($bdp_settings['template_readmorecolor']) && $bdp_settings['template_readmorecolor'] != '') ? $bdp_settings['template_readmorecolor'] : "#fff";
                $readmorebackcolor = (isset($bdp_settings['template_readmorebackcolor']) && $bdp_settings['template_readmorebackcolor'] != '') ? $bdp_settings['template_readmorebackcolor'] : "#000";
                $readmorehoverbackcolor = (isset($bdp_settings['template_readmore_hover_backcolor']) && $bdp_settings['template_readmore_hover_backcolor'] != '') ? $bdp_settings['template_readmore_hover_backcolor'] : "";
                $alterbackground = (isset($bdp_settings['template_alterbgcolor']) && $bdp_settings['template_alterbgcolor'] != '') ? $bdp_settings['template_alterbgcolor'] : "";
                $titlebackcolor = (isset($bdp_settings['template_titlebackcolor']) && $bdp_settings['template_titlebackcolor'] != '') ? $bdp_settings['template_titlebackcolor'] : "";
                $social_icon_style = (isset($bdp_settings['social_icon_style']) && $bdp_settings['social_icon_style'] != '') ? $bdp_settings['social_icon_style'] : 0;
                $social_style = (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] != '') ? $bdp_settings['social_style'] : '';
                $template_alternativebackground = (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] != '') ? $bdp_settings['template_alternativebackground'] : 0;
                $template_alternative_color = (isset($bdp_settings['template_alternative_color']) && $bdp_settings['template_alternative_color'] != '') ? $bdp_settings['template_alternative_color'] : "#000";
                $template_titlefontsize = (isset($bdp_settings['template_titlefontsize']) && $bdp_settings['template_titlefontsize'] != '') ? $bdp_settings['template_titlefontsize'] : 30;
                $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != '') ? $bdp_settings['firstletter_fontsize'] : 30;
                $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : "inherit";
                if (isset($bdp_settings['firstletter_font_family_font_type']) && $bdp_settings['firstletter_font_family_font_type'] == 'Google Fonts') {
                    $load_goog_font_blog[] = $firstletter_font_family;
                }
                $firstletter_contentcolor = (isset($bdp_settings['firstletter_contentcolor']) && $bdp_settings['firstletter_contentcolor'] != '') ? $bdp_settings['firstletter_contentcolor'] : "#000000";
                $firstletter_big = (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] != '') ? $bdp_settings['firstletter_big'] : "";
                $content_font_family = (isset($bdp_settings['content_font_family']) && $bdp_settings['content_font_family'] != '') ? $bdp_settings['content_font_family'] : '';
                if (isset($bdp_settings['content_font_family_font_type']) && $bdp_settings['content_font_family_font_type'] == 'Google Fonts') {
                    $load_goog_font_blog[] = $content_font_family;
                }
                $content_fontsize = (isset($bdp_settings['content_fontsize']) && $bdp_settings['content_fontsize'] != '') ? $bdp_settings['content_fontsize'] : 16;
                $grid_col_space = (isset($bdp_settings['grid_col_space']) && $bdp_settings['grid_col_space'] != '') ? $bdp_settings['grid_col_space'] : 10;
                $story_startup_background = (isset($bdp_settings['story_startup_background']) && $bdp_settings['story_startup_background'] != '') ? $bdp_settings['story_startup_background'] : "";
                $story_startup_text_color = (isset($bdp_settings['story_startup_text_color']) && $bdp_settings['story_startup_text_color'] != '') ? $bdp_settings['story_startup_text_color'] : "";
                $story_ending_background = (isset($bdp_settings['story_ending_background']) && $bdp_settings['story_ending_background'] != '') ? $bdp_settings['story_ending_background'] : "";
                $story_ending_text_color = (isset($bdp_settings['story_ending_text_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_ending_text_color'] : "";
                $story_startup_border_color = (isset($bdp_settings['story_startup_border_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_startup_border_color'] : "";

                /**
                 * Font style Setting
                 */
                $template_title_font_weight = isset($bdp_settings['template_title_font_weight']) ? $bdp_settings['template_title_font_weight'] : '';
                $template_title_font_line_height = isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '';
                $template_title_font_italic = isset($bdp_settings['template_title_font_italic']) ? $bdp_settings['template_title_font_italic'] : 0;
                $template_title_font_text_transform = isset($bdp_settings['template_title_font_text_transform']) ? $bdp_settings['template_title_font_text_transform'] : 'none';
                $template_title_font_text_decoration = isset($bdp_settings['template_title_font_text_decoration']) ? $bdp_settings['template_title_font_text_decoration'] : 'none';
                $template_title_font_letter_spacing = isset($bdp_settings['template_title_font_letter_spacing']) ? $bdp_settings['template_title_font_letter_spacing'] : '0';

                /**
                 * Content Font style Setting
                 */
                $content_font_weight = isset($bdp_settings['content_font_weight']) ? $bdp_settings['content_font_weight'] : '';
                $content_font_line_height = isset($bdp_settings['content_font_line_height']) ? $bdp_settings['content_font_line_height'] : '';
                $content_font_italic = isset($bdp_settings['content_font_italic']) ? $bdp_settings['content_font_italic'] : 0;
                $content_font_text_transform = isset($bdp_settings['content_font_text_transform']) ? $bdp_settings['content_font_text_transform'] : 'none';
                $content_font_text_decoration = isset($bdp_settings['content_font_text_decoration']) ? $bdp_settings['content_font_text_decoration'] : 'none';
                $content_font_letter_spacing = isset($bdp_settings['content_font_letter_spacing']) ? $bdp_settings['content_font_letter_spacing'] : 0;

                $author_bgcolor = (isset($bdp_settings['author_bgcolor']) && $bdp_settings['author_bgcolor'] != '') ? $bdp_settings['author_bgcolor'] : "inherit";
                /**
                 * Author Title Setting
                 */
                $author_titlecolor = (isset($bdp_settings['author_titlecolor']) && $bdp_settings['author_titlecolor'] != '') ? $bdp_settings['author_titlecolor'] : "inherit";
                $authorTitleSize = (isset($bdp_settings['author_title_fontsize']) && $bdp_settings['author_title_fontsize'] != '') ? $bdp_settings['author_title_fontsize'] : 16;
                $authorTitleFace = (isset($bdp_settings['author_title_fontface']) && $bdp_settings['author_title_fontface'] != '') ? $bdp_settings['author_title_fontface'] : "inherit";
                if (isset($bdp_settings['author_title_fontface_font_type']) && $bdp_settings['author_title_fontface_font_type'] == 'Google Fonts') {
                    $load_goog_font_blog[] = $authorTitleFace;
                }
                $author_title_font_weight = isset($bdp_settings['author_title_font_weight']) ? $bdp_settings['author_title_font_weight'] : '';
                $author_title_font_line_height = isset($bdp_settings['author_title_font_line_height']) ? $bdp_settings['author_title_font_line_height'] : '';
                $auhtor_title_font_italic = isset($bdp_settings['auhtor_title_font_italic']) ? $bdp_settings['auhtor_title_font_italic'] : 0;
                $author_title_font_text_transform = isset($bdp_settings['author_title_font_text_transform']) ? $bdp_settings['author_title_font_text_transform'] : 'none';
                $author_title_font_text_decoration = isset($bdp_settings['author_title_font_text_decoration']) ? $bdp_settings['author_title_font_text_decoration'] : 'none';
                $author_title_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letter_spacing']) ? $bdp_settings['auhtor_title_font_letter_spacing'] : '0';


                /**
                 * Author Content Font style Setting
                 */
                $author_content_color = (isset($bdp_settings['author_content_color']) && $bdp_settings['author_content_color'] != '') ? $bdp_settings['author_content_color'] : "";
                $author_content_fontsize = (isset($bdp_settings['author_content_fontsize']) && $bdp_settings['author_content_fontsize'] != '') ? $bdp_settings['author_content_fontsize'] : 16;
                $author_content_fontface = (isset($bdp_settings['author_content_fontface']) && $bdp_settings['author_content_fontface'] != '') ? $bdp_settings['author_content_fontface'] : "";
                if (isset($bdp_settings['author_content_fontface_font_type']) && $bdp_settings['author_content_fontface_font_type'] == 'Google Fonts') {
                    $load_goog_font_blog[] = $author_content_fontface;
                }
                $author_content_font_weight = isset($bdp_settings['author_content_font_weight']) ? $bdp_settings['author_content_font_weight'] : '';
                $author_content_font_line_height = isset($bdp_settings['author_content_font_line_height']) ? $bdp_settings['author_content_font_line_height'] : '';
                $auhtor_content_font_italic = isset($bdp_settings['auhtor_content_font_italic']) ? $bdp_settings['auhtor_content_font_italic'] : 0;
                $author_content_font_text_transform = isset($bdp_settings['author_content_font_text_transform']) ? $bdp_settings['author_content_font_text_transform'] : 'none';
                $author_content_font_text_decoration = isset($bdp_settings['author_content_font_text_decoration']) ? $bdp_settings['author_content_font_text_decoration'] : 'none';
                $auhtor_content_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letterauhtor_content_font_letter_spacing_spacing']) ? $bdp_settings['auhtor_content_font_letter_spacing'] : '0';

                $grid_hoverback_color = (isset($bdp_settings['grid_hoverback_color']) && $bdp_settings['grid_hoverback_color'] != '') ? $bdp_settings['grid_hoverback_color'] : "";

                $beforeloop_Readmoretext = '';

                /**
                 * Slider Image height
                 */
                $slider_image_height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : '';

                include_once 'css/layout_dynamic_style.php';

                if (get_option('bdp_custom_google_fonts') != '') {
                    $sidebar = explode(',', get_option('bdp_custom_google_fonts'));
                    foreach ($sidebar as $key => $value) {
                        $whatIWant = substr($value, strpos($value, "=") + 1);
                        $load_goog_font_blog[] = $whatIWant;
                    }
                }
                if (!empty($load_goog_font_blog)) {
                    $loadFontArr = array_values(array_unique($load_goog_font_blog));
                    foreach ($loadFontArr as $font_family) {
                        if ($font_family != '') {
                            $setBase = (is_ssl()) ? "https://" : "http://";
                            $font_href = $setBase . 'fonts.googleapis.com/css?family=' . $font_family;
                            wp_enqueue_style('bdp-google-fonts-' . $font_family, $font_href, false);
                        }
                    }
                }
            }
        }
    }

    function bdp_email_share() {
        ?>
        <div id="bdp_email_share" class="bdp_email_share" style="display: none;">
            <div class="bdp-close"><i class="fas fa-times"></i></div>
            <div class="bdp_email_form">
                <form method="post" id="frmEmailShare">
                    <input type="hidden" value="" name="txtShortcodeId" id="txtShortcodeId" />
                    <input type="hidden" value="" name="txtPostId" id="txtPostId" />
                    <input type="hidden" name="action" value="bdp_email_share_form" />
                    <div>
                        <label for="txtToEmail"><?php _e('Send to Email Address', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                        <input id="txtToEmail" name="txtToEmail" type="text">
                    </div>
                    <div>
                        <label for="txtYourName"><?php _e('Your Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                        <input id="txtYourName" name="txtYourName" type="text">
                    </div>
                    <div>
                        <label for="txtYourEmail"><?php _e('Your Email Address', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                        <input id="txtYourEmail" name="txtYourEmail" type="email">
                    </div>
                    <div>
                        <input class="bdp-mail_submit_button" type="submit" name="sbtEmailShare" value="<?php _e('Send Email', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        <div class="bdp-close_button">Close</div>
                    </div>
                </form>
            </div>
            <div class="bdp_email_sucess">

            </div>
        </div>
        <?php
    }

    function bdp_template_dynamic_script() {
        $archive_list = bdp_get_archive_list();
        if (is_archive()) {
            self::$template_stylesheet_added = 1;
            if (is_date() && in_array('date_template', $archive_list)) {
                $date = bdp_get_date_template_settings();
                $all_setting = $date->settings;
                if (is_serialized($all_setting)) {
                    $bdp_settings = unserialize($all_setting);
                }
            } elseif (is_author() && in_array('author_template', $archive_list)) {
                $author_id = get_query_var('author');
                $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
                $archive_id = $bdp_author_data['id'];
                $bdp_settings = $bdp_author_data['bdp_settings'];
            } elseif (is_category() && in_array('category_template', $archive_list)) {
                $categories = get_category(get_query_var('cat'));
                $category_id = $categories->cat_ID;
                $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
                $archive_id = $bdp_category_data['id'];
                $bdp_settings = $bdp_category_data['bdp_settings'];
            } elseif (is_tag() && in_array('tag_template', $archive_list)) {
                $tag_id = get_query_var('tag_id');
                $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
                $archive_id = $bdp_tag_data['id'];
                $bdp_settings = $bdp_tag_data['bdp_settings'];
            }
        } elseif (is_search() && in_array('search_template', $archive_list)) {
            $search_settings = bdp_get_search_template_settings();
            $allsettings = $search_settings->settings;
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
        } else {
            $bdp_themes = self::$template_name;
            $shortcode_ids = self::$shortcode_id;
            if (is_array($shortcode_ids) && count($shortcode_ids) > 0) {
                $dyn_script = 0;
                foreach ($shortcode_ids as $shortcode_id) {
                    $bdp_theme = $bdp_themes[$dyn_script];
                    $bdp_settings = bdp_get_shortcode_settings($shortcode_id);

                    if ($bdp_settings['template_name'] == 'crayon_slider' || $bdp_settings['template_name'] == 'sunshiny_slider' || $bdp_settings['template_name'] == 'sallet_slider') {

                        if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-galleryimage-script');
                        }
                        $template_slider_scroll = isset($bdp_settings['template_slider_scroll']) ? $bdp_settings['template_slider_scroll'] : 1;
                        $display_slider_navigation = isset($bdp_settings['display_slider_navigation']) ? $bdp_settings['display_slider_navigation'] : 1;
                        $display_slider_controls = isset($bdp_settings['display_slider_controls']) ? $bdp_settings['display_slider_controls'] : 1;
                        $slider_autoplay = isset($bdp_settings['slider_autoplay']) ? $bdp_settings['slider_autoplay'] : 1;
                        $slider_autoplay_intervals = isset($bdp_settings['slider_autoplay_intervals']) ? $bdp_settings['slider_autoplay_intervals'] : 7000;
                        $slider_speed = isset($bdp_settings['slider_speed']) ? $bdp_settings['slider_speed'] : 600;
                        $template_slider_effect = isset($bdp_settings['template_slider_effect']) ? $bdp_settings['template_slider_effect'] : 'slide';
                        if(is_rtl()) {
                            $template_slider_effect = 'fade';
                        }
                        $slider_column = 1;
                        if ($bdp_settings['template_slider_effect'] == 'slide') {
                            $slider_column = isset($bdp_settings['template_slider_columns']) ? $bdp_settings['template_slider_columns'] : 1;
                            $slider_column_ipad = isset($bdp_settings['template_slider_columns_ipad']) ? $bdp_settings['template_slider_columns_ipad'] : 1;
                            $slider_column_tablet = isset($bdp_settings['template_slider_columns_tablet']) ? $bdp_settings['template_slider_columns_tablet'] : 1;
                            $slider_column_mobile = isset($bdp_settings['template_slider_columns_mobile']) ? $bdp_settings['template_slider_columns_mobile'] : 1;
                        } else {
                            $slider_column = $slider_column_ipad = $slider_column_tablet = $slider_column_mobile = 1;
                        }
                        $slider_arrow = isset($bdp_settings['arrow_style_hidden']) ? $bdp_settings['arrow_style_hidden'] : 'arrow1';
                        if ($slider_arrow == '') {
                            $prev = "<i class='fas fa-chevron-left'></i>";
                            $next = "<i class='fas fa-chevron-right'></i>";
                        } else {
                            $prev = "<div class='" . $slider_arrow . "'></div>";
                            $next = "<div class='" . $slider_arrow . "'></div>";
                        }
                        ?>
                        <script type="text/javascript" id="flexslider_script">
                                    jQuery(document).ready(function () {

                            var $maxItems = 1;
                                    if (jQuery(window).width() > 980) {
                            $maxItems = <?php echo $slider_column; ?>;
                            } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
                            $maxItems = <?php echo $slider_column_ipad; ?>;
                            } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
                            $maxItems = <?php echo $slider_column_tablet; ?>;
                            } else if (jQuery(window).width() <= 480) {
                            $maxItems = <?php echo $slider_column_mobile; ?>;
                            }

                            jQuery('.slider_template').flexslider({
                                    move: <?php echo $template_slider_scroll; ?>,
                                    animation: '<?php echo $template_slider_effect; ?>',
                                    itemWidth: 10,
                                    itemMargin: 15,
                                    minItems: 1,
                                    maxItems: $maxItems,
                                    <?php echo ($display_slider_controls == 1) ? "directionNav: true," : "directionNav: false,"; ?>
                                    <?php echo ($display_slider_navigation == 1) ? "controlNav: true," : "controlNav: false,"; ?>
                                    <?php echo ($slider_autoplay == 1) ? "slideshow: true," : "slideshow: false,"; ?>
                                    <?php echo ($slider_autoplay == 1) ? "slideshowSpeed: $slider_autoplay_intervals," : ''; ?>
                                    <?php echo ($slider_speed) ? "animationSpeed: $slider_speed," : ''; ?>
                                    prevText: "<?php echo $prev; ?>",
                                    nextText: "<?php echo $next; ?>",
                                    rtl: <?php
                                    if (is_rtl()) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                            });
                            });</script>
                        <?php
                    }

                    if ($bdp_settings['template_name'] == 'cool_horizontal' || $bdp_settings['template_name'] == 'overlay_horizontal') {
                        ?>
                        <script class="logbook_script">
                                    (function ($) {
                                    $(".logbook").logbook({
                                    levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                            showYears: 10,
                                            del: 130,
                                            vertical: false,
                                            isPostLink: false,
                                            isYears: false,
                                            triggerWidth: 800,
                                            itemMargin: <?php echo (isset($bdp_settings['template_post_margin'])) ? $bdp_settings['template_post_margin'] : 20; ?>,
                                            customSize: {
                                            "sheet": {"itemWidth": <?php echo (isset($bdp_settings['item_width']) ? $bdp_settings['item_width'] : 400); ?>, "itemHeight": "<?php echo (isset($bdp_settings['item_height']) ? $bdp_settings['item_height'] : 570) ?>", "margin": "<?php echo (isset($bdp_settings['template_post_margin']) && $bdp_settings['template_post_margin']) ? $bdp_settings['template_post_margin'] : 20; ?>"},
                                                    "active": {"itemWidth": <?php echo (isset($bdp_settings['item_width']) ? $bdp_settings['item_width'] : 400); ?>, "itemHeight": "<?php echo (isset($bdp_settings['item_height']) ? $bdp_settings['item_height'] : 570) ?>", "imageHeight": "150"}
                                            },
                                            id: 10,
                                            easing: "<?php echo $bdp_settings['template_easing'] ?>",
                                            enableSwipe: true,
                                            startFrom: '<?php echo (isset($bdp_settings['timeline_start_from'])) ? $bdp_settings['timeline_start_from'] : 'last'; ?>',
                                            enableYears: true,
                                            class: {
                                            readMore: '.lb-read-more',
                                            },
                                            hideLogbook: <?php echo ($bdp_settings['display_timeline_bar'] == 1) ? 'true' : 'false'; ?>,
                                            hideArrows: false,
                                            closeItemOnTransition: false,
                                            autoplay: <?php echo ($bdp_settings['enable_autoslide'] == 1) ? 'true' : 'false'; ?>,
                                            scrollSpeed: <?php echo isset($bdp_settings['scroll_speed']) ? $bdp_settings['scroll_speed'] : 1000; ?>,
                                    });
                                    })(jQuery);</script>
                        <?php
                    }
                    $dyn_script++;
                }
            }
        }
        if ($bdp_settings['template_name'] == 'cool_horizontal' || $bdp_settings['template_name'] == 'overlay_horizontal') {

            ?>
            <script class="logbook_script">
                        (function ($) {
                        $(".logbook").logbook({
                        levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                showYears: 10,
                                del: 130,
                                vertical: false,
                                isPostLink: false,
                                isYears: false,
                                triggerWidth: 800,
                                itemMargin: <?php echo (isset($bdp_settings['template_post_margin'])) ? $bdp_settings['template_post_margin'] : 20; ?>,
                                customSize: {
                                "sheet": {"itemWidth": <?php echo (isset($bdp_settings['item_width']) ? $bdp_settings['item_width'] : 400); ?>, "itemHeight": "<?php echo (isset($bdp_settings['item_height']) ? $bdp_settings['item_height'] : 570) ?>", "margin": "<?php echo (isset($bdp_settings['template_post_margin']) && $bdp_settings['template_post_margin']) ? $bdp_settings['template_post_margin'] : 20; ?>"},
                                        "active": {"itemWidth": <?php echo (isset($bdp_settings['item_width']) ? $bdp_settings['item_width'] : 400); ?>, "itemHeight": "<?php echo (isset($bdp_settings['item_height']) ? $bdp_settings['item_height'] : 570) ?>", "imageHeight": "150"}
                                },
                                id: 10,
                                easing: "<?php echo $bdp_settings['template_easing'] ?>",
                                enableSwipe: true,
                                startFrom: '<?php echo (isset($bdp_settings['timeline_start_from'])) ? $bdp_settings['timeline_start_from'] : 'last'; ?>',
                                enableYears: true,
                                class: {
                                readMore: '.lb-read-more',
                                },
                                hideLogbook: <?php echo ($bdp_settings['display_timeline_bar'] == 1) ? 'true' : 'false'; ?>,
                                hideArrows: false,
                                closeItemOnTransition: false,
                                autoplay: <?php echo ($bdp_settings['enable_autoslide'] == 1) ? 'true' : 'false'; ?>,
                                scrollSpeed: <?php echo isset($bdp_settings['scroll_speed']) ? $bdp_settings['scroll_speed'] : 1000; ?>,
                        });
                        })(jQuery);</script>
            <?php
        }
        if ($bdp_settings['template_name'] == 'crayon_slider' || $bdp_settings['template_name'] == 'sunshiny_slider' || $bdp_settings['template_name'] == 'sallet_slider') {

            if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                wp_enqueue_script('bdp-galleryimage-script');
            }
            $template_slider_scroll = isset($bdp_settings['template_slider_scroll']) ? $bdp_settings['template_slider_scroll'] : 1;
            $display_slider_navigation = isset($bdp_settings['display_slider_navigation']) ? $bdp_settings['display_slider_navigation'] : 1;
            $display_slider_controls = isset($bdp_settings['display_slider_controls']) ? $bdp_settings['display_slider_controls'] : 1;
            $slider_autoplay = isset($bdp_settings['slider_autoplay']) ? $bdp_settings['slider_autoplay'] : 1;
            $slider_autoplay_intervals = isset($bdp_settings['slider_autoplay_intervals']) ? $bdp_settings['slider_autoplay_intervals'] : 7000;
            $slider_speed = isset($bdp_settings['slider_speed']) ? $bdp_settings['slider_speed'] : 600;
            $template_slider_effect = isset($bdp_settings['template_slider_effect']) ? $bdp_settings['template_slider_effect'] : 'slide';
            if(is_rtl()) {
                $template_slider_effect = 'fade';
            }
            $slider_column = 1;
            if ($bdp_settings['template_slider_effect'] == 'slide') {
                $slider_column = isset($bdp_settings['template_slider_columns']) ? $bdp_settings['template_slider_columns'] : 1;
                $slider_column_ipad = isset($bdp_settings['template_slider_columns_ipad']) ? $bdp_settings['template_slider_columns_ipad'] : 1;
                $slider_column_tablet = isset($bdp_settings['template_slider_columns_tablet']) ? $bdp_settings['template_slider_columns_tablet'] : 1;
                $slider_column_mobile = isset($bdp_settings['template_slider_columns_mobile']) ? $bdp_settings['template_slider_columns_mobile'] : 1;
            } else {
                $slider_column = $slider_column_ipad = $slider_column_tablet = $slider_column_mobile = 1;
            }
            $slider_arrow = isset($bdp_settings['arrow_style_hidden']) ? $bdp_settings['arrow_style_hidden'] : 'arrow1';
            if ($slider_arrow == '') {
                $prev = "<i class='fas fa-chevron-left'></i>";
                $next = "<i class='fas fa-chevron-right'></i>";
            } else {
                $prev = "<div class='" . $slider_arrow . "'></div>";
                $next = "<div class='" . $slider_arrow . "'></div>";
            }
            ?>
            <script type="text/javascript" id="flexslider_script">
                        jQuery(document).ready(function () {

                var $maxItems = 1;
                        if (jQuery(window).width() > 980) {
                $maxItems = <?php echo $slider_column; ?>;
                } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
                $maxItems = <?php echo $slider_column_ipad; ?>;
                } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
                $maxItems = <?php echo $slider_column_tablet; ?>;
                } else if (jQuery(window).width() <= 480) {
                $maxItems = <?php echo $slider_column_mobile; ?>;
                }

                jQuery('.slider_template').flexslider({
                            move: <?php echo $template_slider_scroll; ?>,
                            animation: '<?php echo $template_slider_effect; ?>',
                            itemWidth: 10,
                            itemMargin: 15,
                            minItems: 1,
                            maxItems: $maxItems,
                            <?php echo ($display_slider_controls == 1) ? "directionNav: true," : "directionNav: false,"; ?>
                            <?php echo ($display_slider_navigation == 1) ? "controlNav: true," : "controlNav: false,"; ?>
                            <?php echo ($slider_autoplay == 1) ? "slideshow: true," : "slideshow: false,"; ?>
                            <?php echo ($slider_autoplay == 1) ? "slideshowSpeed: $slider_autoplay_intervals," : ''; ?>
                            <?php echo ($slider_speed) ? "animationSpeed: $slider_speed," : ''; ?>
                            prevText: "<?php echo $prev; ?>",
                            nextText: "<?php echo $next; ?>",
                            rtl: <?php
                            if (is_rtl()) {
                                echo 1;
                            } else {
                                echo 0;
                            }
                            ?>
                    });
                });
            </script>
            <?php
        }
    }

    /**
     * add shortcode
     */
    function bdp_shortcode_function($atts) {
        global $wpdb;
        if (!isset($atts['id']) || empty($atts['id'])) {
            return '<b style="color:#ff0000">' . __('Error', BLOGDESIGNERPRO_TEXTDOMAIN) . ' : </b>' . __('Blog Designer shortcode not found. Please cross check your Layout selection id.', BLOGDESIGNERPRO_TEXTDOMAIN) . '';
        }
        $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $atts['id'];
        $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
        if (!$settings_val) {
            return '[wp_blog_designer] ' . __('Invalid shortcode', BLOGDESIGNERPRO_TEXTDOMAIN) . '';
        }
        $allsettings = $settings_val[0]['bdsettings'];

        if (is_serialized($allsettings)) {
            $bdp_settings = unserialize($allsettings);
        }
        if (!isset($bdp_settings['template_name']) || empty($bdp_settings['template_name'])) {
            return '[wp_blog_designer] ' . __('Invalid shortcode', BLOGDESIGNERPRO_TEXTDOMAIN) . '';
        }
        self::$template_name[] = $bdp_settings['template_name'];
        self::$shortcode_id[] = $atts['id'];
        return bdp_layout_view_portion($atts['id'], $bdp_settings);
    }

    /**
     *  @param string $single_template
     *  @return int custom template
     */
    function bdp_custom_single_template($single_template) {
        global $post;
        $post_type = $post->post_type;
        $post_id = $post->ID;
        $cat_ids = wp_get_post_categories($post_id);
        $tag_ids = wp_get_post_tags($post_id);
        $single_data = bdp_get_single_template_settings($cat_ids, $tag_ids);
        //$single_data = get_option('bdp_single_template');
        if (!$single_data) {
            return $single_template;
        }
        if ($single_data && is_serialized($single_data)) {
            $single_data_setting = unserialize($single_data);
        }
        if (!isset($single_data_setting['template_name']) || (isset($single_data_setting['template_name']) && $single_data_setting['template_name'] == '')) {
            return $single_template;
        }
        if (isset($single_data_setting['override_single']) && $single_data_setting['override_single'] == 1) {
            if ($post_type == 'post') {
                $single_template = get_stylesheet_directory() . '/bdp_templates/single/single.php';
                if (!file_exists($single_template)) {
                    $single_template = BLOGDESIGNERPRO_DIR . 'bdp_templates/single/single.php';
                }
            }
        }
        return $single_template;
    }

    /**
     *
     * @global object $wpdb
     * @global object $wpdb
     * @param type $template
     * @return Archive template
     */
    function bdp_get_custom_archive_template($template) {
        $archive_list = bdp_get_archive_list();
        if (is_search() && in_array('search_template', $archive_list)) {
            $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
            if (!file_exists($template)) {
                $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
            }
            $template = apply_filters('bdp_archive_template', $template);
        } else {
            if (is_archive()) {
                if ((is_date() && in_array('date_template', $archive_list))) {
                    $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                    if (!file_exists($template)) {
                        $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                    }
                } elseif (is_author() && in_array('author_template', $archive_list)) {
                    $author_id = get_query_var('author');
                    foreach ($archive_list as $archive) {
                        global $wpdb;
                        $author_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template" AND find_in_set("' . $author_id . '",sub_categories) <> 0');
                        if (!empty($author_template)) {
                            $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                            if (!file_exists($template)) {
                                $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                            }
                        } else {
                            $author_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template" AND sub_categories = ""');
                            if (!empty($author_template)) {
                               $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                                if (!file_exists($template)) {
                                    $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                                }
                            }
                        }
                    }
                } elseif (is_category() && in_array('category_template', $archive_list)) {
                    $categories = get_category(get_query_var('cat'));
                    $category_id = $categories->cat_ID;
                    foreach ($archive_list as $archive) {
                        if ($archive == 'category_template') {
                            global $wpdb;
                            $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "category_template" AND find_in_set("' . $category_id . '",sub_categories) <> 0');
                            if (!empty($category_template)) {
                                $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                                if (!file_exists($template)) {
                                    $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                                }
                            } else {
                                $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "category_template" AND sub_categories = ""');
                                if (!empty($category_template)) {
                                    $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                                }
                                if (!file_exists($template)) {
                                    $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                                }
                            }
                        }
                    }
                } elseif (is_tag() && in_array('tag_template', $archive_list)) {
                    $tag_id = get_query_var('tag_id');
                    foreach ($archive_list as $archive) {
                        if ($archive == 'tag_template') {
                            global $wpdb;
                            $tag_templates = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "tag_template" AND find_in_set("' . $tag_id . '",sub_categories) <> 0');
                            if ($tag_templates) {
                                $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                                if (!file_exists($template)) {
                                    $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                                }
                            } else {
                                $tag_templates = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "tag_template" AND sub_categories = ""');
                                if ($tag_templates) {
                                    $template = get_stylesheet_directory() . '/bdp_templates/archive/archive.php';
                                    if (!file_exists($template)) {
                                        $template = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/archive.php';
                                    }
                                }
                            }
                        }
                    }
                }
                $template = apply_filters('bdp_archive_template', $template);
            }
        }
        return $template;
    }

    /*
     * To get posts when load more pagination is on
     */

    function bdp_loadmore_blog() {
        global $wpdb;
        ob_start();
        $layout = $_POST['blog_layout'];

        if($layout == 'blog_layout') {
            $blog_shortcode_id = $_POST['blog_shortcode_id'];
            $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
            $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $blog_shortcode_id;
            $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
            $allsettings = $settings_val[0]['bdsettings'];
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
            $post_type = $bdp_settings['custom_post_type'];

            $unique_design_option = isset($bdp_settings['unique_design_option']) ? $bdp_settings['unique_design_option'] : '';
            $posts_per_page = $bdp_settings['posts_per_page'];
            $blog_unique_design = 0;
            if (isset($bdp_settings['blog_unique_design']) && $bdp_settings['blog_unique_design'] != "") {
                $blog_unique_design = $bdp_settings['blog_unique_design'];
            }
            $paged = ( (int) $_POST['paged'] ) + 1;
            $offset = ($paged - 1) * $posts_per_page;
            $bdp_theme = $_POST['blog_template'];
            $tags = $cats = $author = "";
            $order = 'DESC';
            $orderby = 'date';
            if (isset($bdp_settings['template_category'])) {
                $cat = $bdp_settings['template_category'];
            }

            if (isset($bdp_settings['template_tags'])) {
                $tag = $bdp_settings['template_tags'];
            }

            if (isset($bdp_settings['template_authors'])) {
                $author = $bdp_settings['template_authors'];
            }

            if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                $orderby = $bdp_settings['bdp_blog_order_by'];
            }

            if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                $order = $bdp_settings['bdp_blog_order'];
            }

            if (empty($cat)) {
                $cat = '';
            }

            if (empty($tag)) {
                $tag = '';
            }

            if (isset($bdp_settings['exclude_category_list'])) {
                $exlude_category = 'category__not_in';
            } else {
                $exlude_category = 'category__in';
            }

            if (isset($bdp_settings['exclude_tag_list'])) {
                $exlude_tag = 'tag__not_in';
            } else {
                $exlude_tag = 'tag__in';
            }

            if (isset($bdp_settings['exclude_author_list'])) {
                $exlude_author = 'author__not_in';
            } else {
                $exlude_author = 'author__in';
            }

            /**
             * Time Period
             */
            $date_query = array();
            $post_status = array();
            if (isset($bdp_settings['blog_time_period'])) {
                $blog_time_period = $bdp_settings['blog_time_period'];
                if ($blog_time_period == 'today') {
                    $today = getdate();
                    $date_query = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                            'day' => $today['mday'],
                        ),
                    );
                }
                if ($blog_time_period == 'tomorrow') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * DAY_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                            'day' => $twodayslater['mday'],
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'this_week') {
                    $week = date('W');
                    $year = date('Y');
                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $week,
                        ),
                    );
                }
                if ($blog_time_period == 'last_week') {
                    $thisweek = date('W');
                    if ($thisweek != 1) :
                        $lastweek = $thisweek - 1;
                    else :
                        $lastweek = 52;
                    endif;

                    $year = date('Y');
                    if ($lastweek != 52) :
                        $year = date('Y');
                    else:
                        $year = date('Y') - 1;
                    endif;

                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                }
                if ($blog_time_period == 'next_week') {
                    $thisweek = date('W');
                    if ($thisweek != 52) :
                        $lastweek = $thisweek + 1;
                    else :
                        $lastweek = 1;
                    endif;

                    $year = date('Y');
                    if ($lastweek != 52) :
                        $year = date('Y');
                    else:
                        $year = date('Y') + 1;
                    endif;
                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'this_month') {
                    $today = getdate();
                    $date_query = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'last_month') {
                    $twodayslater = getdate(current_time('timestamp') - 1 * MONTH_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'next_month') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * MONTH_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'last_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $last_n_days = $bdp_settings['bdp_time_period_day'] . ' days ago';
                        $date_query = array(
                            array(
                                'after' => $last_n_days,
                                'inclusive' => true,
                            ),
                        );
                    }
                }
                if ($blog_time_period == 'next_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $next_n_days = '+' . $bdp_settings['bdp_time_period_day'] . ' days';
                        $date_query = array(
                            array(
                                'before' => date('Y-m-d', strtotime($next_n_days)),
                                'inclusive' => true,
                            )
                        );
                        $post_status = array('future');
                    }
                }
                if ($blog_time_period == 'between_two_date') {
                    $between_two_date_from = isset($bdp_settings['between_two_date_from']) ? $bdp_settings['between_two_date_from'] : '';
                    $between_two_date_to = isset($bdp_settings['between_two_date_to']) ? $bdp_settings['between_two_date_to'] : '';
                    $from_format = array();
                    $after = array();
                    if ($between_two_date_from) {
                        $unixtime = strtotime($between_two_date_from);
                        $from_time = date("m-d-Y", $unixtime);
                        if ($from_time) {
                            $from_format = explode('-', $from_time);
                            $after = array(
                                'year' => isset($from_format[2]) ? $from_format[2] : '',
                                'month' => isset($from_format[0]) ? $from_format[0] : '',
                                'day' => isset($from_format[1]) ? $from_format[1] : '',
                            );
                        }
                    }
                    $to_format = array();
                    $before = array();
                    if ($between_two_date_to) {
                        $unixtime = strtotime($between_two_date_to);
                        $to_time = date("m-d-Y", $unixtime);
                        if ($to_time) {
                            $to_format = explode('-', $to_time);
                            $before = array(
                                'year' => isset($to_format[2]) ? $to_format[2] : '',
                                'month' => isset($to_format[0]) ? $to_format[0] : '',
                                'day' => isset($to_format[1]) ? $to_format[1] : '',
                            );
                        }
                    }
                    $date_query = array(
                        array(
                            'after' => $after,
                            'before' => $before,
                            'inclusive' => true,
                        ),
                    );
                }
            } else {
                $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';
            }

            if ($post_type == 'post') {
                if ($orderby == 'meta_value_num') {
                    $more_posts = get_posts(
                            array(
                                $exlude_category => $cat,
                                $exlude_tag => $tag,
                                $exlude_author => $author,
                                'offset' => $offset,
                                'post_type' => $post_type,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby . ' date',
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'NOT EXISTS'
                                    ),
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'EXISTS'
                                    ),
                                ),
                                'date_query' => $date_query,
                                'post_status' => $post_status
                            )
                    );
                } else {
                    $more_posts = get_posts(
                            array(
                                $exlude_category => $cat,
                                $exlude_tag => $tag,
                                $exlude_author => $author,
                                'offset' => $offset,
                                'post_type' => $post_type,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby,
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                'date_query' => $date_query,
                                'post_status' => $post_status
                            )
                    );
                }
            } else {
                $taxo = get_object_taxonomies($post_type);
                $tax_query = array('relation' => 'OR');
                foreach ($taxo as $taxonom) {
                    if (isset($bdp_settings[$taxonom . "_terms"])) {
                        if (isset($bdp_settings[$taxonom . "_terms"]) && !empty($bdp_settings[$taxonom . "_terms"])) {
                            $terms[$taxonom] = $bdp_settings[$taxonom . "_terms"];
                        }
                        $tax_query[] = array(
                            'taxonomy' => $taxonom,
                            'field' => 'name',
                            'terms' => $terms[$taxonom],
                        );
                    }
                }
                if ($orderby == 'meta_value_num') {
                    $more_posts = get_posts(
                            array(
                                'post_type' => $post_type,
                                'tax_query' => $tax_query,
                                'offset' => $offset,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby . ' date',
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                $exlude_author => $author,
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'NOT EXISTS'
                                    ),
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'EXISTS'
                                    ),
                                ),
                                'date_query' => $date_query,
                                'post_status' => $post_status
                            )
                    );
                } else {
                    $more_posts = get_posts(
                            array(
                                'post_type' => $post_type,
                                'tax_query' => $tax_query,
                                'offset' => $offset,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby,
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                $exlude_author => $author,
                                'date_query' => $date_query,
                                'post_status' => $post_status
                            )
                    );
                }
            }
            $sticky_posts = get_option('sticky_posts');
            $sticky_count = count($sticky_posts);
            $alter_class = '';
            $alter = $offset + 1;
            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $alter = $alter + $sticky_count;
            }
            $prev_year = isset($_POST['timeline_previous_year']) ? $_POST['timeline_previous_year'] : '';
            $prev_year1 = null;
            $prev_month = isset($_POST['timeline_previous_month']) ? $_POST['timeline_previous_month'] : '';
            $count_sticky = 0;
            if ($more_posts) {
                global $post;
                foreach ($more_posts as $post) : setup_postdata($post);
                    if ($bdp_theme) {
                        if (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] == 1) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'timeline') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = 'odd_class';
                            }
                            if ($orderby == 'date' || $orderby == 'modified') {
                                if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                    $this_year = get_the_date('Y');
                                    if ($prev_year != $this_year) {
                                        $prev_year = $this_year;
                                        if ($alter_class == 'even_class') {
                                            $alter_class = 'odd_class';
                                            $alter++;
                                        }
                                        echo '<div class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></div></span>';
                                    }
                                } else if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_month') {
                                    $this_year = get_the_date('Y');
                                    $this_month = get_the_time('M');
                                    $prev_year = $this_year;
                                    if ($prev_month != $this_month) {
                                        $prev_month = $this_month;
                                        if ($alter_class == 'even_class') {
                                            $alter_class = 'odd_class';
                                            $alter++;
                                        }
                                        echo '<div class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></div>';
                                    }
                                }
                            }
                        }
                        if ($bdp_theme == 'story') {
                            if ($orderby == 'date' || $orderby == 'modified') {
                                $this_year = get_the_date('Y');
                                if ($prev_year1 != $this_year) {
                                    $prev_year1 = $this_year;
                                    $prev_year = 0;
                                } elseif ($prev_year1 == $this_year) {
                                    $prev_year = 1;
                                }
                            } else {
                                $prev_year = get_the_date('Y');
                            }
                        }
                        if ($bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'story' || $bdp_theme == 'fairy'|| $bdp_theme == 'clicky') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                            $alter_class = $alter;
                        }
                        if ($blog_unique_design == 1) {
                            if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'clicky') {
                                $alter_class = $alter;
                                // are we on page one?
                                if ($unique_design_option == 'first_post') {
                                    if (1 == $paged) {
                                        if ($alter == 1) {
                                            $prev_year = 0;
                                        } else {
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                } elseif ($unique_design_option == 'featured_posts') {
                                    if (1 == $paged) {
                                        if (in_array(get_the_ID(), $sticky_posts)) {
                                            $count_sticky = count($sticky_posts);
                                            $prev_year = 0;
                                        } else {
                                            $count_sticky = count($sticky_posts);
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                            }
                        }
                        bdp_get_blog_loadmore_template('blog/' . $bdp_theme . '.php', $bdp_settings, $alter_class, $prev_year, $paged, $count_sticky);
                        $alter ++;
                    }
                endforeach;
                if ($alter % 2 != 1 && ( $bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' )) {
                    echo "</div>";
                }
            }
        } elseif($layout == 'archive_layout') {
            global $wp_query;
            $bdp_theme = '';
            $bdp_settings = array();
            $blog_shortcode_id = $_POST['blog_shortcode_id'];
            $tableName = $wpdb->prefix . 'bdp_archives';
            $get_settings_query = "SELECT * FROM $tableName WHERE id=" . $blog_shortcode_id;
            $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
            $allsettings = $settings_val[0]['settings'];
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }

            $bdp_theme = $_POST['blog_template'];
            $posts_per_page = $bdp_settings['posts_per_page'];

            $orderby = 'date';
            $order = 'DESC';
            if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                $orderby = $bdp_settings['bdp_blog_order_by'];
            if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                $order = $bdp_settings['bdp_blog_order'];
            $paged = ( (int) $_POST['paged'] ) + 1;
            $offset = ($paged - 1) * $posts_per_page;
            $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';
            $post_author = isset($bdp_settings['template_author']) ? $bdp_settings['template_author'] : array();
            if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
                $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
            } else {
                $firstpost_unique_design = 0;
            }

            if ($bdp_settings['custom_archive_type'] == 'category_template') {
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                if(isset($_POST['term_id'])) {
                    $cat = $_POST['term_id'];
                } else {
                    $cat = '';
                }
                echo $cat;

                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                    'cat' => $cat
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            } elseif ($bdp_settings['custom_archive_type'] == 'tag_template') {
                if(isset($_POST['term_id'])) {
                    $tag = $_POST['term_id'];
                } else {
                    $tag = '';
                }
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                    'tag_id' => $tag
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            } else {
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            }

            if($bdp_settings['custom_archive_type'] == 'date_template') {
                $arg_posts['date_query'] = $wp_query->query;
            }

            if ($bdp_settings['custom_archive_type'] == 'author_template') {
                if(!empty($post_author)) {
                    $arg_posts['author__in'] = $post_author;
                }
            }

            if($bdp_settings['custom_archive_type'] == 'search_template') {
                $arg_posts['s'] = $_POST['search_string'];
            }

            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $arg_posts['ignore_sticky_posts'] = 0;
            } else {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            if (($orderby == 'date' || $orderby == 'modified') && isset($bdp_settings['template_name']) && ( $bdp_settings['template_name'] == 'story' || $bdp_settings['template_name'] == 'timeline' )) {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            if (isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'explore' || $bdp_settings['template_name'] == 'hoverbic')) {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            $more_posts = get_posts($arg_posts);

            $alter_class = '';
            $prev_year = '';
            $alter = $offset + 1;
            $alter_val = null;

            if ($more_posts) {
                global $post;
                foreach ($more_posts as $post) :setup_postdata($post);
                    if ($bdp_theme) {
                        if (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] == 1) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'story' || $bdp_theme == 'fairy' || $bdp_theme == 'clicky') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'timeline') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = 'odd_class';
                            }
                        }
                        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                            $alter_class = $alter;
                        }
                        if ($bdp_theme) {
                            if ($bdp_theme == 'timeline') {
                                if ($orderby == 'date' || $orderby == 'modified') {
                                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                        $this_year = get_the_date('Y');
                                        if ($prev_year != $this_year) {
                                            $prev_year = $this_year;
                                            echo '<p class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></span></p>';
                                        }
                                    } else if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_month') {
                                        $prev_month = "";
                                        $this_year = get_the_date('Y');
                                        $this_month = get_the_time('M');
                                        $prev_year = $this_year;
                                        if ($prev_month != $this_month) {
                                            $prev_month = $this_month;
                                            echo '<p class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></p>';
                                        }
                                    }
                                }
                            }
                            if ($bdp_theme == 'story') {
                                if ($orderby == 'date' || $orderby == 'modified') {
                                    $this_year = get_the_date('Y');
                                    if ($prev_year1 != $this_year) {
                                        $prev_year1 = $this_year;
                                        $prev_year = 0;
                                    } elseif ($prev_year1 == $this_year) {
                                        $prev_year = 1;
                                    }
                                } else {
                                    $prev_year = get_the_date('Y');
                                }
                            }

                            if ($bdp_theme == 'media-grid') {
                                $alter_val = $alter;
                            }
                            if ($firstpost_unique_design == 1) {
                                if ($bdp_theme == 'invert-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia') {
                                    $alter_val = $alter;
                                    if (1 == $paged) {
                                        if ($alter == 1) {
                                            $prev_year = 0;
                                        } else {
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                                if ($bdp_theme == 'media-grid') {
                                    $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                                    $alter_val = $alter;
                                    if (1 == $paged) {
                                        if ($column_setting >= 2 && $alter <= 2) {
                                            $prev_year = 0;
                                        } else {
                                            if ($alter == 1) {
                                                $prev_year = 0;
                                            } else {
                                                $prev_year = 1;
                                            }
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                            }
                        }
                        bdp_get_template('archive/' . $bdp_theme . '.php');
                        do_action('bd_archive_design_format_function', $bdp_settings, $alter_class, $prev_year, $alter_val, $paged);
                        $alter ++;
                    }
                endforeach;
            }
        }
        $data = ob_get_clean();
        echo $data;
        die();
    }

    function filter_change() {
        global $wpdb;
        ob_start();

        $blog_shortcode_id = $_POST['blog_shortcode_id'];
        $filter_data = $_POST['filter_cat'];
        $filter_tagdata = $_POST['filter_tag'];
        $filter_date = $_POST['filer_date'];
        $bdp_theme = $_POST['blog_template'];


        $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $blog_shortcode_id;
        $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
        $allsettings = $settings_val[0]['bdsettings'];
        if (is_serialized($allsettings)) {
            $bdp_settings = unserialize($allsettings);
        }
        $post_per_page = $bdp_settings['posts_per_page'];

        if ($bdp_settings['custom_post_type'] == 'post') {
            $bdp_settings['template_category'] = $filter_data;
            $bdp_settings['template_tags'] = $filter_tagdata;
        } else {
            $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type']);
            foreach ($taxonomy_names as $taxonomy) {
                if (isset($taxonomy)) {
                    if (isset($bdp_settings['filter_' . $taxonomy]) && $bdp_settings['filter_' . $taxonomy] == 1) {
                        if (!empty($_POST["filter_$taxonomy"])) {
                            $bdp_settings[$taxonomy . '_terms'] = array();
                            $bdp_settings[$taxonomy . '_terms'] = $_POST["filter_$taxonomy"];
                        }
                    }
                    $bdp_settings['relation'] = array('relation' => 'AND');
                }
            }
        }
        $bdp_settings['posts_per_page'] = -1;
        if (!isset($_POST['filter_cat'])) {
            $bdp_settings['posts_per_page'] = $post_per_page;
        }
        $bdp_settings['paged'] = $_POST['blog_page_number'];
        $posts = bdp_get_wp_query($bdp_settings);
        $date = array();
        if (!empty($filter_date)) {
            $date_query = array();
            $date_query['relation'] = 'OR';
            foreach ($filter_date as $fdate) {
                $date = explode('-', $fdate);
                $date_query[] = array(
                    'year' => $date[0],
                    'month' => $date[1]
                );
            }
            $posts['date_query'] = $date_query;
        }
        global $wp_query;
        $temp_query = $wp_query;
        $loop = new WP_Query($posts);
        $wp_query = $loop;

        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'news' || $bdp_theme == 'brit_co' || $bdp_theme == 'boxy') {
            if ($loop->have_posts()) {
                while (have_posts()) : the_post();
                    echo bdp_get_blog_template('blog/' . $bdp_theme . '.php', $bdp_settings);
                endwhile;
            }
        } elseif ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
            echo '<div class="my_logbook">';
            if ($loop->have_posts()) {
                while (have_posts()) : the_post();
                    echo bdp_get_blog_template('blog/' . $bdp_theme . '.php', $bdp_settings);
                endwhile;
            }
            echo '</div>';
        }

        wp_reset_query();
        $wp_query = null;
        $wp_query = $temp_query;
        $data = ob_get_clean();
        echo $data;
        die();
    }

    /*
     * To get posts when load more pagination is on
     */

    function bdp_load_onscroll_blog() {
        global $wpdb;
        ob_start();
        $layout = $_POST['blog_layout'];
        if($layout == 'blog_layout') {
            $blog_shortcode_id = $_POST['blog_shortcode_id'];
            $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
            $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $blog_shortcode_id;
            $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
            $count_sticky = 0;
            $allsettings = $settings_val[0]['bdsettings'];
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
            $post_type = $bdp_settings['custom_post_type'];

            $posts_per_page = $_POST['posts_per_page'];
            $paged = ( (int) $_POST['paged'] ) + 1;
            $offset = ($paged - 1) * $posts_per_page;
            $bdp_theme = $_POST['blog_template'];
            $tags = $cats = $author = "";
            $order = 'DESC';
            $orderby = 'date';
            if (isset($bdp_settings['template_category'])) {
                $cat = $bdp_settings['template_category'];
            }

            if (isset($bdp_settings['template_tags'])) {
                $tag = $bdp_settings['template_tags'];
            }

            if (isset($bdp_settings['template_authors'])) {
                $author = $bdp_settings['template_authors'];
            }

            if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                $orderby = $bdp_settings['bdp_blog_order_by'];
            }

            if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                $order = $bdp_settings['bdp_blog_order'];
            }

            if (empty($cat)) {
                $cat = '';
            }

            if (empty($tag)) {
                $tag = '';
            }

            if (isset($bdp_settings['exclude_category_list'])) {
                $exlude_category = 'category__not_in';
            } else {
                $exlude_category = 'category__in';
            }

            if (isset($bdp_settings['exclude_tag_list'])) {
                $exlude_tag = 'tag__not_in';
            } else {
                $exlude_tag = 'tag__in';
            }

            if (isset($bdp_settings['exclude_author_list'])) {
                $exlude_author = 'author__not_in';
            } else {
                $exlude_author = 'author__in';
            }

            /**
             * Time Period
             */
            $date_query = array();
            $post_status = array();
            if (isset($bdp_settings['blog_time_period'])) {
                $blog_time_period = $bdp_settings['blog_time_period'];
                if ($blog_time_period == 'today') {
                    $today = getdate();
                    $date_query = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                            'day' => $today['mday'],
                        ),
                    );
                }
                if ($blog_time_period == 'tomorrow') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * DAY_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                            'day' => $twodayslater['mday'],
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'this_week') {
                    $week = date('W');
                    $year = date('Y');
                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $week,
                        ),
                    );
                }
                if ($blog_time_period == 'last_week') {
                    $thisweek = date('W');
                    if ($thisweek != 1) :
                        $lastweek = $thisweek - 1;
                    else :
                        $lastweek = 52;
                    endif;

                    $year = date('Y');
                    if ($lastweek != 52) :
                        $year = date('Y');
                    else:
                        $year = date('Y') - 1;
                    endif;

                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                }
                if ($blog_time_period == 'next_week') {
                    $thisweek = date('W');
                    if ($thisweek != 52) :
                        $lastweek = $thisweek + 1;
                    else :
                        $lastweek = 1;
                    endif;

                    $year = date('Y');
                    if ($lastweek != 52) :
                        $year = date('Y');
                    else:
                        $year = date('Y') + 1;
                    endif;
                    $date_query = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'this_month') {
                    $today = getdate();
                    $date_query = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'last_month') {
                    $twodayslater = getdate(current_time('timestamp') - 1 * MONTH_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'next_month') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * MONTH_IN_SECONDS);
                    $date_query = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                    $post_status = array('future');
                }
                if ($blog_time_period == 'last_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $last_n_days = $bdp_settings['bdp_time_period_day'] . ' days ago';
                        $date_query = array(
                            array(
                                'after' => $last_n_days,
                                'inclusive' => true,
                            ),
                        );
                    }
                }
                if ($blog_time_period == 'next_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $next_n_days = '+' . $bdp_settings['bdp_time_period_day'] . ' days';
                        $date_query = array(
                            array(
                                'before' => date('Y-m-d', strtotime($next_n_days)),
                                'inclusive' => true,
                            )
                        );
                        $post_status = array('future');
                    }
                }
                if ($blog_time_period == 'between_two_date') {
                    $between_two_date_from = isset($bdp_settings['between_two_date_from']) ? $bdp_settings['between_two_date_from'] : '';
                    $between_two_date_to = isset($bdp_settings['between_two_date_to']) ? $bdp_settings['between_two_date_to'] : '';
                    $from_format = array();
                    $after = array();
                    if ($between_two_date_from) {
                        $unixtime = strtotime($between_two_date_from);
                        $from_time = date("m-d-Y", $unixtime);
                        if ($from_time) {
                            $from_format = explode('-', $from_time);
                            $after = array(
                                'year' => isset($from_format[2]) ? $from_format[2] : '',
                                'month' => isset($from_format[0]) ? $from_format[0] : '',
                                'day' => isset($from_format[1]) ? $from_format[1] : '',
                            );
                        }
                    }
                    $to_format = array();
                    $before = array();
                    if ($between_two_date_to) {
                        $unixtime = strtotime($between_two_date_to);
                        $to_time = date("m-d-Y", $unixtime);
                        if ($to_time) {
                            $to_format = explode('-', $to_time);
                            $before = array(
                                'year' => isset($to_format[2]) ? $to_format[2] : '',
                                'month' => isset($to_format[0]) ? $to_format[0] : '',
                                'day' => isset($to_format[1]) ? $to_format[1] : '',
                            );
                        }
                    }
                    $date_query = array(
                        array(
                            'after' => $after,
                            'before' => $before,
                            'inclusive' => true,
                        ),
                    );
                }
            }

            if ($post_type == 'post') {
                if ($orderby == 'meta_value_num') {
                    $more_posts = get_posts(
                            array(
                                $exlude_category => $cat,
                                $exlude_tag => $tag,
                                $exlude_author => $author,
                                'offset' => $offset,
                                'post_type' => $post_type,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby . ' date',
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'NOT EXISTS'
                                    ),
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'EXISTS'
                                    ),
                                ),
                                'date_query' => $date_query,
                                'post_status' => $post_status,
                                'suppress_filters' => false
                            )
                    );
                } else {
                    $more_posts = get_posts(
                            array(
                                $exlude_category => $cat,
                                $exlude_tag => $tag,
                                $exlude_author => $author,
                                'offset' => $offset,
                                'post_type' => $post_type,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby,
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                'date_query' => $date_query,
                                'post_status' => $post_status,
                                'suppress_filters' => false
                            )
                    );
                }
            } else {
                $taxo = get_object_taxonomies($post_type);
                $tax_query = array('relation' => 'OR');
                foreach ($taxo as $taxonom) {
                    if (isset($bdp_settings[$taxonom . "_terms"])) {
                        if (isset($bdp_settings[$taxonom . "_terms"]) && !empty($bdp_settings[$taxonom . "_terms"])) {
                            $terms[$taxonom] = $bdp_settings[$taxonom . "_terms"];
                        }
                        $tax_query[] = array(
                            'taxonomy' => $taxonom,
                            'field' => 'name',
                            'terms' => $terms[$taxonom],
                        );
                    }
                }
                if ($orderby == 'meta_value_num') {
                    $more_posts = get_posts(
                            array(
                                'post_type' => $post_type,
                                'tax_query' => $tax_query,
                                'offset' => $offset,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby . ' date',
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                $exlude_author => $author,
                                'meta_query' => array(
                                    'relation' => 'OR',
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'NOT EXISTS'
                                    ),
                                    array(
                                        'key' => '_post_like_count',
                                        'compare' => 'EXISTS'
                                    ),
                                ),
                                'date_query' => $date_query,
                                'post_status' => $post_status,
                                'suppress_filters' => false
                            )
                    );
                } else {
                    $more_posts = get_posts(
                            array(
                                'post_type' => $post_type,
                                'tax_query' => $tax_query,
                                'offset' => $offset,
                                'posts_per_page' => $posts_per_page,
                                'paged' => $paged,
                                'orderby' => $orderby,
                                'order' => $order,
                                'post__not_in' => get_option('sticky_posts'),
                                $exlude_author => $author,
                                'date_query' => $date_query,
                                'post_status' => $post_status,
                                'suppress_filters' => false
                            )
                    );
                }
            }
            $alter_class = '';
            $sticky_posts = get_option('sticky_posts');
            $sticky_count = count($sticky_posts);
            $alter_class = '';
            $alter = $offset + 1;
            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $alter = $alter + $sticky_count;
            }
            $prev_year = isset($_POST['timeline_previous_year']) ? $_POST['timeline_previous_year'] : '';
            $prev_year1 = null;
            $prev_month = isset($_POST['timeline_previous_month']) ? $_POST['timeline_previous_month'] : '';
            $inc_time = 1;
            if ($more_posts) {
                global $post;
                $blog_unique_design = 0;
                if (isset($bdp_settings['blog_unique_design']) && $bdp_settings['blog_unique_design'] != "") {
                    $blog_unique_design = $bdp_settings['blog_unique_design'];
                }

                foreach ($more_posts as $post) : setup_postdata($post);
                    if ($bdp_theme) {
                        if (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] == 1) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'timeline') {
                            if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                if ($alter % 2 != 0 && $inc_time == 1) {
                                    $alter++;
                                    $inc_time++;
                                }
                            }

                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = 'odd_class';
                            }
                            if ($orderby == 'date' || $orderby == 'modified') {
                                if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                    $this_year = get_the_date('Y');
                                    if ($prev_year != $this_year) {
                                        $prev_year = $this_year;
                                        if ($alter_class == 'even_class') {
                                            $alter_class = 'odd_class';
                                            $alter++;
                                        }
                                        echo '<div class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></div></span>';
                                    }
                                } else if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_month') {
                                    $this_year = get_the_date('Y');
                                    $this_month = get_the_time('M');
                                    $prev_year = $this_year;
                                    if ($prev_month != $this_month) {
                                        $prev_month = $this_month;
                                        if ($alter_class == 'even_class') {
                                            $alter_class = 'odd_class';
                                            $alter++;
                                        }
                                        echo '<div class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></div>';
                                    }
                                }
                            }
                        }
                        if ($bdp_theme == 'story') {
                            if ($orderby == 'date' || $orderby == 'modified') {
                                $this_year = get_the_date('Y');
                                if ($prev_year1 != $this_year) {
                                    $prev_year1 = $this_year;
                                    $prev_year = 0;
                                } elseif ($prev_year1 == $this_year) {
                                    $prev_year = 1;
                                }
                            } else {
                                $prev_year = get_the_date('Y');
                            }
                        }
                        if ($bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'story' || $bdp_theme == 'fairy'|| $bdp_theme == 'clicky') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                            $alter_class = $alter;
                        }
                        if ($blog_unique_design == 1) {
                            if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia') {
                                $alter_class = $alter;
                                // are we on page one?
                                if ($unique_design_option == 'first_post') {
                                    if (1 == $paged) {
                                        if ($alter == 1) {
                                            $prev_year = 0;
                                        } else {
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                } elseif ($unique_design_option == 'featured_posts') {
                                    if (1 == $paged) {
                                        if (in_array(get_the_ID(), $sticky_posts)) {
                                            $count_sticky = count($sticky_posts);
                                            $prev_year = 0;
                                        } else {
                                            $count_sticky = count($sticky_posts);
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                            }
                        }
                        bdp_get_blog_loadmore_template('blog/' . $bdp_theme . '.php', $bdp_settings, $alter_class, $prev_year, $paged, $count_sticky);
                        $alter ++;
                    }
                endforeach;
                if ($alter % 2 != 1 && ( $bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' )) {
                    echo "</div>";
                }
            }
        } elseif($layout == 'archive_layout') {
            global $wp_query;
            $bdp_theme = '';
            $bdp_settings = array();
            $blog_shortcode_id = $_POST['blog_shortcode_id'];
            $tableName = $wpdb->prefix . 'bdp_archives';
            $get_settings_query = "SELECT * FROM $tableName WHERE id=" . $blog_shortcode_id;
            $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
            $allsettings = $settings_val[0]['settings'];
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
            if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
                $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
            } else {
                $firstpost_unique_design = 0;
            }

            $bdp_theme = $_POST['blog_template'];
            $posts_per_page = $bdp_settings['posts_per_page'];

            $orderby = 'date';
            $order = 'DESC';
            if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                $orderby = $bdp_settings['bdp_blog_order_by'];
            if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                $order = $bdp_settings['bdp_blog_order'];
            $paged = ( (int) $_POST['paged'] ) + 1;
            $offset = ($paged - 1) * $posts_per_page;
            $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';
            $post_author = isset($bdp_settings['template_author']) ? $bdp_settings['template_author'] : array();

            if ($bdp_settings['custom_archive_type'] == 'category_template') {
                if(isset($_POST['term_id'])) {
                    $cat = $_POST['term_id'];
                } else {
                    $cat = '';
                }
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                    'cat' => $cat
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            } elseif ($bdp_settings['custom_archive_type'] == 'tag_template') {
                if(isset($_POST['term_id'])) {
                    $tag = $_POST['term_id'];
                } else {
                    $tag = '';
                }
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                    'tag_id' => $tag
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            } else {
                if ($orderby == 'meta_value_num') {
                    $orderby_str = $orderby . ' date';
                } else {
                    $orderby_str = $orderby;
                }
                $arg_posts = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $orderby_str,
                    'order' => $order,
                    'paged' => $paged,
                    'offset' => $offset,
                    'post_status' => $post_status,
                );
                if ($orderby == 'meta_value_num') {
                    $arg_posts['meta_query'] = array(
                        'relation' => 'OR',
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'NOT EXISTS'
                        ),
                        array(
                            'key' => '_post_like_count',
                            'compare' => 'EXISTS'
                        ),
                    );
                }
            }

            if($bdp_settings['custom_archive_type'] == 'date_template') {
                $arg_posts['date_query'] = $wp_query->query;
            }

            if ($bdp_settings['custom_archive_type'] == 'author_template') {
                if(!empty($post_author)) {
                    $arg_posts['author__in'] = $post_author;
                }
            }

            if($bdp_settings['custom_archive_type'] == 'search_template') {
                $arg_posts['s'] = $_POST['search_string'];
            }            

            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $arg_posts['ignore_sticky_posts'] = 0;
            } else {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            if (($orderby == 'date' || $orderby == 'modified') && isset($bdp_settings['template_name']) && ( $bdp_settings['template_name'] == 'story' || $bdp_settings['template_name'] == 'timeline' )) {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            if (isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'explore' || $bdp_settings['template_name'] == 'hoverbic')) {
                $arg_posts['ignore_sticky_posts'] = 1;
            }
            $more_posts = get_posts($arg_posts);

            $alter_class = '';
            $prev_year = '';
            $alter = $offset + 1;
            $alter_val = null;

            if ($more_posts) {
                global $post;
                foreach ($more_posts as $post) :setup_postdata($post);
                    if ($bdp_theme) {
                        if (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] == 1) {
                            if ($alter % 2 == 0) {
                                $alter_class = ' alternative-back';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'story' || $bdp_theme == 'fairy' || $bdp_theme == 'clicky') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = '';
                            }
                        }
                        if ($bdp_theme == 'timeline') {
                            if ($alter % 2 == 0) {
                                $alter_class = 'even_class';
                            } else {
                                $alter_class = 'odd_class';
                            }
                        }
                        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                            $alter_class = $alter;
                        }
                        if ($bdp_theme) {
                            if ($bdp_theme == 'timeline') {
                                if ($orderby == 'date' || $orderby == 'modified') {
                                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                        $this_year = get_the_date('Y');
                                        if ($prev_year != $this_year) {
                                            $prev_year = $this_year;
                                            echo '<p class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></span></p>';
                                        }
                                    } else if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_month') {
                                        $prev_month = "";
                                        $this_year = get_the_date('Y');
                                        $this_month = get_the_time('M');
                                        $prev_year = $this_year;
                                        if ($prev_month != $this_month) {
                                            $prev_month = $this_month;
                                            echo '<p class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></p>';
                                        }
                                    }
                                }
                            }
                            if ($bdp_theme == 'story') {
                                if ($orderby == 'date' || $orderby == 'modified') {
                                    $this_year = get_the_date('Y');
                                    if ($prev_year1 != $this_year) {
                                        $prev_year1 = $this_year;
                                        $prev_year = 0;
                                    } elseif ($prev_year1 == $this_year) {
                                        $prev_year = 1;
                                    }
                                } else {
                                    $prev_year = get_the_date('Y');
                                }
                            }

                            if ($bdp_theme == 'media-grid') {
                                $alter_val = $alter;
                            }
                            if ($firstpost_unique_design == 1) {
                                if ($bdp_theme == 'invert-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia') {
                                    $alter_val = $alter;
                                    if (1 == $paged) {
                                        if ($alter == 1) {
                                            $prev_year = 0;
                                        } else {
                                            $prev_year = 1;
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                                if ($bdp_theme == 'media-grid') {
                                    $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                                    $alter_val = $alter;
                                    if (1 == $paged) {
                                        if ($column_setting >= 2 && $alter <= 2) {
                                            $prev_year = 0;
                                        } else {
                                            if ($alter == 1) {
                                                $prev_year = 0;
                                            } else {
                                                $prev_year = 1;
                                            }
                                        }
                                    } else {
                                        $prev_year = 1;
                                    }
                                }
                            }
                        }
                        bdp_get_template('archive/' . $bdp_theme . '.php');
                        do_action('bd_archive_design_format_function', $bdp_settings, $alter_class, $prev_year, $alter_val, $paged);
                        $alter ++;
                    }
                endforeach;
            }
        }


        $data = ob_get_clean();
        echo $data;
        die();
    }


    /**
     *
     * @param type $query
     */
    function bdp_change_author_date_pagination($query) {

        if ($query->is_main_query() && !is_admin()) {
            $archive_list = bdp_get_archive_list();
            if (is_date() && in_array('date_template', $archive_list)) {
                if (is_date()) {
                    $da_settings = bdp_get_date_template_settings();
                }
                $allsettings = $da_settings->settings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                    $posts_per_page = $bdp_settings['posts_per_page'];
                    $orderby = isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '' ? $bdp_settings['bdp_blog_order_by'] : 'date';
                    $order = 'DESC';
                    if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                        $order = isset($bdp_settings['bdp_blog_order']) ? $bdp_settings['bdp_blog_order'] : 'DESC';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $query->set('posts_per_page', $posts_per_page);
                    $query->set('orderby', $orderby_str);
                    $query->set('order', $order);
                    if ($orderby == 'meta_value_num') {
                        $query->set(
                                'meta_query', array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                                )
                        );
                    }
                }
            } elseif (is_author() && in_array('author_template', $archive_list)) {
                global $wp_query;
                $author_detail = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
                $author_id = isset($author_detail->ID) ? $author_detail->ID : 1;

                $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
                $archive_id = $bdp_author_data['id'];
                $bdp_settings = $bdp_author_data['bdp_settings'];
                if ($bdp_settings) {
                    $posts_per_page = $bdp_settings['posts_per_page'];
                    $orderby = isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '' ? $bdp_settings['bdp_blog_order_by'] : 'date';
                    $order = 'DESC';
                    if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                        $order = isset($bdp_settings['bdp_blog_order']) ? $bdp_settings['bdp_blog_order'] : 'DESC';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $query->set('posts_per_page', $posts_per_page);
                    $query->set('orderby', $orderby_str);
                    $query->set('order', $order);
                    if ($orderby == 'meta_value_num') {
                        $query->set(
                                'meta_query', array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                                )
                        );
                    }
                }
            } elseif (is_category() && in_array('category_template', $archive_list)) {
                $categoryObj = get_category_by_slug($query->query['category_name']);
                $category_id = $categoryObj->term_id;
                $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
                $archive_id = $bdp_category_data['id'];
                $bdp_settings = $bdp_category_data['bdp_settings'];
                if ($bdp_settings) {
                    $posts_per_page = $bdp_settings['posts_per_page'];
                    $orderby = isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '' ? $bdp_settings['bdp_blog_order_by'] : 'date';
                    $order = 'DESC';
                    if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                        $order = isset($bdp_settings['bdp_blog_order']) ? $bdp_settings['bdp_blog_order'] : 'DESC';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $query->set('posts_per_page', $posts_per_page);
                    $query->set('orderby', $orderby_str);
                    $query->set('order', $order);
                    if ($orderby == 'meta_value_num') {
                        $query->set(
                                'meta_query', array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                                )
                        );
                    }
                }
            } elseif (is_tag() && in_array('tag_template', $archive_list)) {
                $tagObj = get_term_by('slug', $query->query['tag'], 'post_tag');
                $tag_id = $tagObj->term_id;
                $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
                $archive_id = $bdp_tag_data['id'];
                $bdp_settings = $bdp_tag_data['bdp_settings'];
                if ($bdp_settings) {
                    $posts_per_page = $bdp_settings['posts_per_page'];
                    $orderby = isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '' ? $bdp_settings['bdp_blog_order_by'] : 'date';
                    $order = 'DESC';
                    if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                        $order = isset($bdp_settings['bdp_blog_order']) ? $bdp_settings['bdp_blog_order'] : 'DESC';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $query->set('posts_per_page', $posts_per_page);
                    $query->set('orderby', $orderby_str);
                    $query->set('order', $order);
                    if ($orderby == 'meta_value_num') {
                        $query->set(
                                'meta_query', array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                                )
                        );
                    }
                }
            } elseif (is_search() && in_array('search_template', $archive_list)) {
                $da_settings = bdp_get_search_template_settings();
                $allsettings = $da_settings->settings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                    $posts_per_page = $bdp_settings['posts_per_page'];
                    $orderby = isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '' ? $bdp_settings['bdp_blog_order_by'] : 'date';
                    $order = 'DESC';
                    if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '') {
                        $order = isset($bdp_settings['bdp_blog_order']) ? $bdp_settings['bdp_blog_order'] : 'DESC';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $query->set('posts_per_page', $posts_per_page);
                    $query->set('orderby', $orderby_str);
                    $query->set('order', $order);
                    if ($orderby == 'meta_value_num') {
                        $query->set(
                                'meta_query', array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                                )
                        );
                    }
                }
            }
            remove_action('pre_get_posts', 'be_change_event_posts_per_page');
        }
    }

    /**
     * Create table 'blog_designer_pro_shortcodes' when plugin activated
     *
     * @global object $wpdb
     */
    public function bdp_plugin_active() {

        //Deactive lite version plugin when pro is actived
        if (is_plugin_active('blog-designer/blog-designer.php')) {
            deactivate_plugins('/blog-designer/blog-designer.php');
        }

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        global $wpdb, $bdp_db_version;

        // Creare Table
        $table_name = $wpdb->prefix . "blog_designer_pro_shortcodes";
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }

        $sql = "CREATE TABLE $table_name (
            bdid int(9) NOT NULL AUTO_INCREMENT,
            shortcode_name tinytext NOT NULL,
            bdsettings text NOT NULL,
            UNIQUE KEY bdid (bdid)
        ) $charset_collate;";
        //reference to upgrade.php file
        dbDelta($sql);

        wp_reset_query();
        $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
        if ($bdp_template_name_changed == 1) {
            $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');
            $count_archive = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives');
            $count_single = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_single_layouts');
            if ($count_layout > 0 || $count_archive > 0 || $count_single > 0) {
                update_option('bdp_template_name_changed', 1);
            } else {
                update_option('bdp_template_name_changed', 0);
            }
        }
        add_option('bdp_plugin_do_activation_redirect', true);
    }

    public function wp_blog_designer_pro_redirection() {
        if (get_option('bdp_plugin_do_activation_redirect', false)) {
            delete_option('bdp_plugin_do_activation_redirect');
            if (!isset($_GET['activate-multi'])) {
                exit( wp_redirect( admin_url( 'admin.php?page=bdp_getting_started' ) ) );
            }
        }
    }

    /**
     * Create Shortcode table
     */
    public static function bdp_create_shortcodes_table() {
        global $wpdb;

        // Creare Table
        $table_name = $wpdb->prefix . "blog_designer_pro_shortcodes";
        $charset_collate = '';
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }

        $sql = "CREATE TABLE $table_name (
            bdid int(9) NOT NULL AUTO_INCREMENT,
            shortcode_name tinytext NOT NULL,
            bdsettings text NOT NULL,
            UNIQUE KEY bdid (bdid)
        ) $charset_collate;";
        //reference to upgrade.php file
        dbDelta($sql);
    }

    /**
     * Create archive table
     */
    public static function bdp_Setarchive_Table() {
        global $wpdb;
        $archive_table = $wpdb->prefix . "bdp_archives";
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }

        $archive_sql = "CREATE TABLE $archive_table (
            id int(9) NOT NULL AUTO_INCREMENT,
            archive_name tinytext NOT NULL,
            archive_template tinytext NOT NULL,
            sub_categories text NOT NULL,
            settings text NOT NULL,
            UNIQUE KEY ID (ID)
            ) $charset_collate;";

        //reference to upgrade.php file
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($archive_sql);
    }

    /**
     * Create single table
     */
    public static function bdp_Setsingle_Table() {
        global $wpdb;
        $single_table = $wpdb->prefix . "bdp_single_layouts";
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }

        $single_sql = "CREATE TABLE $single_table (
            id int(9) NOT NULL AUTO_INCREMENT,
            single_name tinytext NOT NULL,
            single_template tinytext NOT NULL,
            sub_categories text NOT NULL,
            single_post_id text NOT NULL,
            settings text NOT NULL,
            UNIQUE KEY ID (ID)
        ) $charset_collate;";

        //reference to upgrade.php file
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($single_sql);
    }

    /**
     * Processes like/unlike
     */
    function bdp_process_posts_like() {
        // Security
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : 0;
        if (!wp_verify_nonce($nonce, 'bdp-simple-likes-nonce')) {
            exit(__('Not permitted', BLOGDESIGNERPRO_TEXTDOMAIN));
        }

        // Base variables
        $post_id = ( isset($_POST['post_id']) && is_numeric($_POST['post_id']) ) ? $_POST['post_id'] : '';
        $response = array();
        $post_users = null;
        $like_count = 0;
        // Get plugin options
        if ($post_id != '') {
            $count = get_post_meta($post_id, "_post_like_count", true); // like count
            $count = ( isset($count) && is_numeric($count) ) ? $count : 0;
            if (!bdp_already_liked($post_id)) { // Like the post
                if (is_user_logged_in()) { // user is logged in
                    $user_id = get_current_user_id();
                    $post_users = bdp_post_user_likes($user_id, $post_id);

                    // Update User & Post
                    $user_like_count = get_user_option("_user_like_count", $user_id);
                    $user_like_count = ( isset($user_like_count) && is_numeric($user_like_count) ) ? $user_like_count : 0;
                    update_user_option($user_id, "_user_like_count", ++$user_like_count);
                    if (!empty($post_users)) {
                        update_post_meta($post_id, "like_users", $post_users);
                    } else {
                        update_post_meta($post_id, "like_users", $user_id);
                    }
                } else { // user is anonymous
                    $user_ip = bdp_get_ip();
                    $post_users = bdp_post_ip_likes($user_ip, $post_id);
                    // Update Post
                    if ($post_users) {
                        update_post_meta($post_id, "like_ipaddresses", $post_users);
                    }
                }
                $like_count = ++$count;
                $response['status'] = "liked";
                $response['icon'] = bdp_get_liked_icon();
            } else { // Unlike the post
                if (is_user_logged_in()) { // user is logged in
                    $user_id = get_current_user_id();
                    $post_users = bdp_post_user_likes($user_id, $post_id);
                    // Update User
                    $user_like_count = get_user_option("_user_like_count", $user_id);
                    $user_like_count = ( isset($user_like_count) && is_numeric($user_like_count) ) ? $user_like_count : 0;
                    if ($user_like_count > 0) {
                        update_user_option($user_id, '_user_like_count', --$user_like_count);
                    }
                    // Update Post
                    if (!empty($post_users)) {
                        $uid_key = array_search($user_id, $post_users);
                        unset($post_users[$uid_key]);
                        update_post_meta($post_id, "like_users", $post_users);
                    } else {
                        update_post_meta($post_id, "like_users", $user_id);
                    }
                } else { // user is anonymous
                    $user_ip = bdp_get_ip();
                    $post_users = bdp_post_ip_likes($user_ip, $post_id);
                    // Update Post
                    if ($post_users) {
                        $uip_key = array_search($user_ip, $post_users);
                        unset($post_users[$uip_key]);
                        update_post_meta($post_id, "like_ipaddresses", $post_users);
                    }
                }
                $like_count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
                $response['status'] = "unliked";
                $response['icon'] = bdp_get_unliked_icon();
            }
            update_post_meta($post_id, "_post_like_count", $like_count);
            update_post_meta($post_id, "_post_like_modified", date('Y-m-d H:i:s'));
            $response['count'] = bdp_get_like_count($like_count);
            wp_send_json($response);
        }
        exit();
    }

    function get_post_type_post_list() {
        ob_start();
        if (isset($_POST['posttype']) && !empty($_POST['posttype'])) {
            $posttype = $_POST['posttype'];
        } else {
            $posttype = 'post';
        }
        ?> <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-textarea"><span class="bdp-tooltips"><?php _e('Select post to start timeline layout with some specific post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span> <?php
        query_posts('showposts=-1&post_status=publish&post_type=' . $posttype);
        if (have_posts()) {
            echo '<select name="timeline_start_from" id="timeline_start_from">';
            while (have_posts()) {
                the_post();
                ?> <option value="<?php echo get_the_date('d/m/Y'); ?>"><?php echo get_the_title(); ?></option> <?php
            } echo '</select>';
        } else {
            echo '<p>';
            _e('No posts found.', BLOGDESIGNERPRO_TEXTDOMAIN);
            echo '</p>';
        }
        $data = ob_get_clean();
        echo $data;
        die();
    }

    function bdp_layouts_notice_dismissible() {
        global $current_user;
        $user_id = $current_user->ID;
        update_user_meta($user_id, 'bdp_notice_ignore', 1);
    }

    function bdp_email_share_form() {
        wp_reset_postdata();
        global $wpdb, $post;
        $cur_page = $_POST['cur_page'];
        if ($cur_page == 'date' || $cur_page == 'author' || $cur_page == 'category' || $cur_page == 'tag') {
                $archive_list = bdp_get_archive_list();
            if ($cur_page == 'date' && in_array('date_template', $archive_list)) {
                $date = bdp_get_date_template_settings();
                $all_setting = $date->settings;
                if (is_serialized($all_setting)) {
                    $bdp_settings = unserialize($all_setting);
                }
            } elseif ($cur_page == 'author' && in_array('author_template', $archive_list)) {
                $author_id = $_POST['cur_id'];
                $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
                $archive_id = $bdp_author_data['id'];
                $bdp_settings = $bdp_author_data['bdp_settings'];
            } elseif ($cur_page == 'category' && in_array('category_template', $archive_list)) {
                $category_id = $_POST['cur_id'];
                $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
                $archive_id = $bdp_category_data['id'];
                $bdp_settings = $bdp_category_data['bdp_settings'];
            } elseif ($cur_page == 'tag' && in_array('tag_template', $archive_list)) {
                $tag_id = $_POST['cur_id'];
                $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
                $archive_id = $bdp_tag_data['id'];
                $bdp_settings = $bdp_tag_data['bdp_settings'];
            }
        } elseif ($cur_page == 'search' && in_array('search_template', $archive_list)) {
            $search_settings = bdp_get_search_template_settings();
            $allsettings = $search_settings->settings;
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
        } else if ($cur_page == 'single') {
            $post_id = $post->ID;
            $cat_ids = wp_get_post_categories($post_id);
            $tag_ids = wp_get_post_tags($post_id);
            $bdp_settings = bdp_get_single_template_settings($cat_ids, $tag_ids);
            $bdp_settings = unserialize($bdp_settings);
        } else {
            $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
            $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $_POST['txtShortcodeId'];
            $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
            if ($settings_val) {
                $bdp_settings = $settings_val[0]['bdsettings'];
            }
            if (is_serialized($bdp_settings)) {
                $bdp_settings = unserialize($bdp_settings);
            }
        }
        $post = get_post($_POST['txtPostId'], 'OBJECT');
        setup_postdata($post);
        $mail_subject = (isset($bdp_settings['mail_subject']) && $bdp_settings['mail_subject'] != '') ? $bdp_settings['mail_subject'] : '[post_title]';
        $mail_subject = str_replace('[post_title]', get_the_title(), $mail_subject);
        if (isset($bdp_settings['mail_content']) && $bdp_settings['mail_content'] != '') {
            $contents = $bdp_settings['mail_content'];
        } else {
            $contents = __("My Dear friends", BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/><br/>' . __('I read one good blog link and I would like to share that same link for you. That might useful for you', BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/><br/>[post_link]<br/><br/>' . __("Best Regards", BLOGDESIGNERPRO_TEXTDOMAIN) . ',<br/>' . __("Blog Designer", BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        $contents = apply_filters('the_content', $contents);
        $content = str_replace('[post_link]', get_the_permalink(), $contents);
        $content = str_replace('[sender_name]', $_POST['txtYourName'], $content);
        $content = str_replace('[sender_email]', $_POST['txtYourEmail'], $content);
        $content = str_replace('[post_thumbnail]', '<br/><img src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" /> <br/><br/>', $content);
        $content = html_entity_decode($content);
        $bdp_to = $_POST['txtToEmail'];
        $bdp_name = $_POST['txtYourName'];
        $bdp_reply_to = $_POST['txtYourEmail'];
        $bdp_from = get_option('admin_email');
        $headers = "MIME-Version: 1.0;\r\n";
        $headers .= "From: $bdp_name <$bdp_from>\r\n";
        $headers .= "reply-to: $bdp_name <$bdp_reply_to>\r\n";
        $headers .= "Content-Type: text/html; charset: utf-8;\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
        $body = '';
        ob_start();
        ?>
        <div>
        <?php echo $content; ?>
        </div>
        <?php
        $body = ob_get_clean();
        $mail_sent = wp_mail($bdp_to, $mail_subject, $body, $headers);
        if ($mail_sent) {
            echo 'sent';
        } else {
            echo 'not_sent';
        }
        wp_reset_postdata();
        exit();
    }

}

new BdpFrontFunction();
add_action('admin_init', 'bdp_activate_au');

if (!function_exists('bdp_activate_au')) {

    function bdp_activate_au() {
        include_once 'admin/assets/wp_autoupdate.php';
        new bdp_wp_auto_update();
    }

}

/**
 *
 * @global type $wpdb
 * @global type $bdp_db_version
 * Create new table for archive templates
 */
if (!function_exists('bdp_add_archive_db_structure')) {

    function bdp_add_archive_db_structure() {
        global $wpdb, $bdp_db_version;
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $installed_version = get_option('bdp_db_version');
        $archive_table = $wpdb->prefix . "bdp_archives";
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }
        //Create archive table
        if ($installed_version != $bdp_db_version) {
            $archive_sql = "CREATE TABLE $archive_table (
                id int(9) NOT NULL AUTO_INCREMENT,
                archive_name tinytext NOT NULL,
                archive_template tinytext NOT NULL,
                sub_categories text NOT NULL,
                settings text NOT NULL,
                UNIQUE KEY ID (ID)
            ) $charset_collate;";
            dbDelta($archive_sql);
            update_option("bdp_db_version", $bdp_db_version);
        }
    }

}

/**
 *
 * @global type $wpdb
 * @global type $bdp_db_version
 * Create new table for single post templates
 */
if (!function_exists('bdp_add_single_db_structure')) {

    function bdp_add_single_db_structure() {
        global $wpdb, $bdp_db_version;
        include_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $installed_version = get_option('bdp_db_version');
        $single_table = $wpdb->prefix . "bdp_single_layouts";
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE $wpdb->collate";
        }
        //Create archive table
        if ($installed_version != $bdp_db_version) {
            $single_sql = "CREATE TABLE $single_table (
                id int(9) NOT NULL AUTO_INCREMENT,
                single_name tinytext NOT NULL,
                single_template tinytext NOT NULL,
                sub_categories text NOT NULL,
                single_post_id text NOT NULL,
                settings text NOT NULL,
                UNIQUE KEY ID (ID)
            ) $charset_collate;";
            dbDelta($single_sql);
            update_option("bdp_db_version", $bdp_db_version);
        }
    }

}

/**
 * @parma $image_url
 * @parma $width
 * @parma $height
 * @parma $corp
 * Resize Images
 */
if (!function_exists('bdp_resize')) {

    function bdp_resize($img_url = null, $width, $height, $crop = false, $thumbnail_id = 0) {
        // this is an attachment, so we have the ID
        if ($img_url) {
            $file_path = parse_url($img_url);
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
            // Look for Multisite Path
            if (is_multisite()) {
                $file_path = get_attached_file($thumbnail_id, false);
            }
            if (!file_exists($file_path)) {
                return;
            }
            $orig_size = getimagesize($file_path);
            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }
        $file_info = pathinfo($file_path);
        // check if file exists
        $base_file = $file_info['dirname'] . '/' . $file_info['filename'] . '.' . $file_info['extension'];

        if (!file_exists($base_file)) {
            return;
        }
        $extension = '.' . $file_info['extension'];
        // the image path without the extension
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];
        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;
        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ($image_src[1] > $width) {
            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if (file_exists($cropped_img_path)) {
                $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);
                $bdp_images = array(
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );
                return $bdp_images;
            }
            // $crop = false or no height set
            if ($crop == false OR ! $height) {
                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
                $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;
                // checking if the file already exists
                if (file_exists($resized_img_path)) {
                    $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);
                    $bdp_images = array(
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );
                    return $bdp_images;
                }
            }
            // check if image width is smaller than set width
            $img_size = getimagesize($file_path);
            if ($img_size[0] <= $width) {
                $width = $img_size[0];
            }
            // Check if GD Library installed
            if (!function_exists('imagecreatetruecolor')) {
                echo __('GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library', BLOGDESIGNERPRO_TEXTDOMAIN);
                return;
            }
            // no cache files - let's finally resize it
            $image = wp_get_image_editor($file_path);

            if (!is_wp_error($image)) {
                $new_file_name = $file_info['filename'] . "-" . $width . "x" . $height . '.' . $file_info['extension'];
                $image->resize($width, $height, $crop);
                $image->save($file_info['dirname'] . '/' . $new_file_name);
            }
            $new_img_path = $file_info['dirname'] . '/' . $new_file_name;
            $new_img_size = getimagesize($new_img_path);
            $new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);
            // resized output
            $bdp_images = array(
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );
            return $bdp_images;
        }
        // default output - without resizing
        $bdp_images = array(
            'url' => $image_src[0],
            'width' => $width,
            'height' => $height
        );
        return $bdp_images;
    }

}
/**
 * @parma $color
 * @parma $opacity
 * Give rgba() color
 */
if (!function_exists('bdp_hex2rgba')) {

    function bdp_hex2rgba($color, $opacity = false) {
        $default = 'rgb(0,0,0)';
        //Return default if no color provided
        if (empty($color)) {
            return $default;
        }
        //Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }
        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1) {
                $opacity = 1.0;
            }
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }
        //Return rgb(a) color string
        return $output;
    }

}

/**
 * Utility to test if the post is already liked
 */
if (!function_exists('bdp_already_liked')) {

    function bdp_already_liked($post_id) {
        $post_users = null;
        $user_id = null;
        if (is_user_logged_in()) { // user is logged in
            $user_id = get_current_user_id();
            $post_meta_users = get_post_meta($post_id, "like_users");
            if (count($post_meta_users) != 0) {
                $post_users = $post_meta_users[0];
            }
        } else { // user is anonymous
            $user_id = bdp_get_ip();
            $post_meta_users = get_post_meta($post_id, "like_ipaddresses");
            if (count($post_meta_users) != 0) { // meta exists, set up values
                $post_users = $post_meta_users[0];
            }
        }
        if (is_array($post_users) && in_array($user_id, $post_users)) {
            return true;
        } else {
            return false;
        }
    }

}

// bdp_already_liked()

/**
 * Output the like button
 */
if (!function_exists('bdp_get_simple_likes_button')) {

    function bdp_get_simple_likes_button($post_id) {
        $output = '';
        $nonce = wp_create_nonce('bdp-simple-likes-nonce'); // Security
        $post_id_class = esc_attr(' bdp-button-' . $post_id);
        $comment_class = esc_attr('');
        $like_count = get_post_meta($post_id, "_post_like_count", true);
        $like_count = ( isset($like_count) && is_numeric($like_count) ) ? $like_count : 0;
        $count = bdp_get_like_count($like_count);
        $icon_empty = bdp_get_unliked_icon();
        $icon_full = bdp_get_liked_icon();
        // Loader
        $loader = '<span id="bdp-loader"></span>';
        // Liked/Unliked Variables
        if (bdp_already_liked($post_id)) {
            $class = esc_attr(' liked');
            $title = __('Unlike', 'blogdesigner');
            $icon = $icon_full;
        } else {
            $class = '';
            $title = __('Like', 'blogdesigner');
            $icon = $icon_empty;
        }
        $output = '<span class="bdp-wrapper-like"><a href="javascript:void(0)" class="bdp-like-button' . $post_id_class . $class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '</span>';
        return $output;
    }

}

/**
 * Utility retrieves count plus count options,
 * returns appropriate format based on options
 */
if (!function_exists('bdp_get_like_count')) {

    function bdp_get_like_count($like_count) {
        $like_text = __('Like', BLOGDESIGNERPRO_TEXTDOMAIN);
        if (is_numeric($like_count) && $like_count > 0) {
            $number = bdp_format_count($like_count);
        } else {
            $number = $like_text;
        }
        $count = '<span class="bdp-count">' . $number . '</span>';
        return $count;
    }

}

/**
 * Utility function to format the button count,
 * appending "K" if one thousand or greater,
 * "M" if one million or greater,
 * and "B" if one billion or greater (unlikely).
 * $precision = how many decimal points to display (1.25K)
 */
function bdp_format_count($number) {
    $precision = 2;
    if ($number >= 1000 && $number < 1000000) {
        $formatted = number_format($number / 1000, $precision) . 'K';
    } else if ($number >= 1000000 && $number < 1000000000) {
        $formatted = number_format($number / 1000000, $precision) . 'M';
    } else if ($number >= 1000000000) {
        $formatted = number_format($number / 1000000000, $precision) . 'B';
    } else {
        $formatted = $number; // Number is less than 1000
    }
    $formatted = str_replace('.00', '', $formatted);
    return $formatted;
}

// bdp_format_count()

/**
 * Utility returns the button icon for "like" action
 */
if (!function_exists('bdp_get_liked_icon')) {

    function bdp_get_liked_icon() {
        $icon = '<i class="fas fa-heart"></i>';
        return $icon;
    }

}

/**
 * Utility returns the button icon for "unlike" action
 */
if (!function_exists('bdp_get_unliked_icon')) {

    function bdp_get_unliked_icon() {
        $icon = '<i class="far fa-heart"></i>';
        return $icon;
    }

}

/**
 * Utility to retrieve IP address
 */
if (!function_exists('bdp_get_ip')) {

    function bdp_get_ip() {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = ( isset($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }
        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ( $ip === false ) ? '0.0.0.0' : $ip;
        return $ip;
    }

}

/**
 * Processes shortcode to manually add the button to posts
 */
add_shortcode('likebtn_shortcode', 'bdp_likebtn_shortcode');

if (!function_exists('bdp_likebtn_shortcode')) {

    function bdp_likebtn_shortcode() {
        return bdp_get_simple_likes_button(get_the_ID(), 0);
    }

}

/**
 * Utility retrieves post meta user likes (user id array),
 * then adds new user id to retrieved array
 */
if (!function_exists('bdp_post_user_likes')) {

    function bdp_post_user_likes($user_id, $post_id) {
        $post_users = '';
        $post_meta_users = get_post_meta($post_id, "like_users");
        if (count($post_meta_users) != 0) {
            $post_users = $post_meta_users[0];
        }
        if (!is_array($post_users)) {
            $post_users = array();
        }
        if (!in_array($user_id, $post_users)) {
            $post_users['user-' . $user_id] = $user_id;
        }
        return $post_users;
    }

}

/**
 * Utility retrieves post meta ip likes (ip array),
 * then adds new ip to retrieved array
 */
if (!function_exists('bdp_post_ip_likes')) {

    function bdp_post_ip_likes($user_ip, $post_id) {
        $post_users = '';
        $post_meta_users = get_post_meta($post_id, "like_ipaddresses");
        // Retrieve post information
        if (count($post_meta_users) != 0) {
            $post_users = $post_meta_users[0];
        }
        if (!is_array($post_users)) {
            $post_users = array();
        }
        if (!in_array($user_ip, $post_users)) {
            $post_users['ip-' . $user_ip] = $user_ip;
        }
        return $post_users;
    }

}

/**
 * get Blog Designer Shortode
 */
if (!function_exists('bdp_shortcode_regex')) {

    function bdp_shortcode_regex() {

        // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
        // Also, see shortcode_unautop() and shortcode.js.
        return
                '\\['                   // Opening bracket
                . '(\\[?)'              // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
                . "(wp_blog_designer)"  // 2: Shortcode name
                . '(?![\\w-])'          // Not followed by word character or hyphen
                . '('                   // 3: Unroll the loop: Inside the opening shortcode tag
                . '[^\\]\\/]*'          // Not a closing bracket or forward slash
                . '(?:'
                . '\\/(?!\\])'          // A forward slash not followed by a closing bracket
                . '[^\\]\\/]*'          // Not a closing bracket or forward slash
                . ')*?'
                . ')'
                . '(?:'
                . '(\\/)'               // 4: Self closing tag ...
                . '\\]'                 // ... and closing bracket
                . '|'
                . '\\]'                 // Closing bracket
                . '(?:'
                . '('                   // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
                . '[^\\[]*+'            // Not an opening bracket
                . '(?:'
                . '\\[(?!\\/\\2\\])'    // An opening bracket not followed by the closing shortcode tag
                . '[^\\[]*+'            // Not an opening bracket
                . ')*+'
                . ')'
                . '\\[\\/\\2\\]'        // Closing shortcode tag
                . ')?'
                . ')'
                . '(\\]?)';             // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }

}