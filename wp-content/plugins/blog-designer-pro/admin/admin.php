<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

define(BLOGDESIGNERPRO_TEXTDOMAIN, 'wp_blog_designer_pro');
define(BLOGDESIGNERPRO_DIR, plugin_dir_path(__FILE__));
define(BLOGDESIGNERPRO_URL, plugins_url() . '/blog-designer-pro');

/*
 * Class for admin side functionality
 */

Class BdpAdminFunction {

    public $bdp_errors;
    public $bdp_settings;
    public $bdp_table_name;
    public $archive_table;
    public $bdp_success;

    public function __construct() {
        global $wpdb, $bdp_table_name, $archive_table, $bdp_errors, $import_success, $font_success, $template_base, $pagenow, $bdp_current_version, $bdp_old_version;
        $bdp_admin_page = false;
        if (isset($_GET['page']) && ($_GET['page'] == 'add_shortcode' || $_GET['page'] == 'single_post' || $_GET['page'] == 'layouts' || $_GET['page'] == 'bdp_add_archive_layout' || $_GET['page'] == 'bdp_google_fonts' || $_GET['page'] == 'bdp_export' || $_GET['page'] == 'bdp_getting_started')) {
            $bdp_admin_page = true;
        }

        // actions for admin side
        add_action('admin_menu', array(&$this, 'bdp_add_menu'));
        add_action('admin_init', array(&$this, 'bdp_default_settings_function'), 1);
        add_action('admin_init', array(&$this, 'bdp_outdated_templates_notices'), 2);
        add_action('admin_init', array(&$this, 'bdp_table_status'), 3);
        add_action('admin_init', array(&$this, 'bdp_save_admin_template'), 4);
        add_action('admin_init', array(&$this, 'bdp_save_admin_archive_template'), 5);
        add_action('admin_init', array(&$this, 'bdp_delete_admin_template'), 6);
        add_action('admin_init', array(&$this, 'bdp_multiple_delete_admin_template'), 7);
        add_action('admin_init', array(&$this, 'bdp_admin_stylesheet_js'), 9);
        add_action('admin_init', array(&$this, 'bdp_duplicate_layout'), 10);
        add_action('admin_init', array(&$this, 'bdp_upload_import_file'), 11);
        add_action('admin_init', array(&$this, 'bdp_delete_archive_template'), 12);
        add_action('admin_init', array(&$this, 'bdp_multiple_delete_admin_archive_template'), 13);

        add_action('admin_enqueue_scripts', array(&$this, 'bdp_admin_scripts'), 3);
        add_action('admin_enqueue_scripts', array(&$this, 'bdp_admin_front_scripts'), 4);
        add_action('admin_footer', array(&$this, 'bdp_admin_footer'), 2);
        add_action('admin_head', array(&$this, 'bdp_admin_notice_dismiss'), 15);
        add_action('wp_ajax_custom_post_taxonomy', 'bdp_custom_post_taxonomy');
        add_action('wp_ajax_get_custom_taxonomy_terms', 'bdp_get_custom_taxonomy_terms');        
        add_action('wp_ajax_custom_post_taxonomy_display_settings', 'bdp_custom_post_taxonomy_display_settings');
        add_action('wp_ajax_bdp_get_posts_single_template', 'bdp_get_posts_single_template');
        add_action('wp_ajax_get_unique_posts_list', 'bdp_get_unique_posts_list');
        add_action('wp_ajax_bdp_preview_request', 'bdp_preview_request');
        add_action('wp_ajax_bdp_archive_preview_request', 'bdp_archive_preview_request');
        add_action('wp_ajax_bdp_closed_bdpboxes', 'bdp_closed_bdpboxes');
        add_action('wp_ajax_bdp_admin_notice_pro_layouts_dismiss', 'bdp_admin_notice_pro_layouts_dismiss');
        add_action('wp_ajax_bdp_create_layout_from_blog_designer_dismiss', 'bdp_create_layout_from_blog_designer_dismiss');
        add_action('wp_ajax_nopriv_bdp_blog_template_search_result', 'bdp_blog_template_search_result');
        add_action('wp_ajax_bdp_blog_template_search_result', 'bdp_blog_template_search_result');
        add_action('wp_ajax_nopriv_bdp_single_blog_template_search_result', 'bdp_single_blog_template_search_result');
        add_action('wp_ajax_bdp_single_blog_template_search_result', 'bdp_single_blog_template_search_result');
        add_action('wp_ajax_bdp_notice_change_textdomain_dismiss', 'bdp_notice_change_textdomain_dismiss');
        add_action('wp_ajax_bdp_notice_template_outdated_dismiss', 'bdp_notice_template_outdated_dismiss');

        add_action('admin_head', array(&$this, 'bdp_plugin_path_js'), 10);
        add_filter('get_avatar', array(&$this, 'bdp_replace_content'));

        if (isset($pagenow) && $pagenow == 'plugins.php') {
            add_action('admin_notices', array(&$this, 'bdp_insert_plugin_row'));
        }

        add_action('admin_notices', array(&$this, 'bdp_single_template_run_the_updater'));
        $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
        if ($bdp_template_name_changed == 1 && $bdp_admin_page) {
            $count_layout = $count_archive = $count_single = 0;
            if($wpdb->get_var("SHOW TABLES LIKE ' . $wpdb->prefix . 'blog_designer_pro_shortcodes") == $wpdb->prefix . 'blog_designer_pro_shortcodes' &&
                $wpdb->get_var("SHOW TABLES LIKE ' . $wpdb->prefix . 'bdp_archives") == $wpdb->prefix . 'bdp_archives' &&
                    $wpdb->get_var("SHOW TABLES LIKE ' . $wpdb->prefix . 'bdp_single_layouts") == $wpdb->prefix . 'bdp_single_layouts') {

                $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');
                $count_archive = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives');
                $count_single = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_single_layouts');
            }
            if ($count_layout > 0 || $count_archive > 0 || $count_single > 0) {
                add_action('admin_notices', array(&$this, 'bdp_template_name_changed_updater'));
            } else {
                update_option('bdp_template_name_changed', 0);
            }
        }

        $bdp_multi_author_selection = get_option('bdp_multi_author_selection', 1);
        if ($bdp_multi_author_selection == 1) {
            $count_author_template = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template"');
            if ($count_author_template <= 0) {
                update_option('bdp_multi_author_selection', 0);
            }
        }

        // filter for admin side
        add_filter('media_buttons_context', array(&$this, 'bdp_insert_button'));
        if (isset($_GET['page']) && ($_GET['page'] == 'layouts' || $_GET['page'] == 'archive_layouts')) {
            add_filter('set-screen-option', array(&$this, 'bdp_set_screen_option'), 10, 3);
        }
        if (isset($_GET['page']) && $_GET['page'] == 'single_layouts') {
            add_filter('set-screen-option', array(&$this, 'bdp_set_screen_option_single'), 10, 3);
        }

        $bdp_table_name = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $archive_table = $wpdb->prefix . 'bdp_archives';
    }

    /**
     * Set style path, home page path and plugin path for js use
     */
    function bdp_plugin_path_js() {
        ?>
        <script type="text/javascript">
            var plugin_path = '<?php echo BLOGDESIGNERPRO_URL; ?>';
            var style_path = '<?php echo bloginfo('stylesheet_url'); ?>';
            var home_path = '<?php echo get_home_url(); ?>';
        </script>
        <?php
    }

    /**
     * Run the updater for single post template
     */
    public function bdp_single_template_run_the_updater() {
        if (get_option('bdp_single_template')) {
            ?>
            <div class="updated">
                <p>
                    <strong>
                        <?php _e('Blog Designer PRO Data Update', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </strong> &#8211; <?php _e('We need to update your single post design data according to the latest version.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                </p>
                <p class="submit">
                    <a href="<?php echo esc_url(add_query_arg('do_update_bdp_single_template', 'do', $_SERVER['REQUEST_URI'])); ?>" class="bdp-update-now button-primary">
                        <?php _e('Run the updater', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </a>
                </p>
            </div>
            <script type="text/javascript">
                jQuery('.bdp-update-now').click('click', function () {
                    return window.confirm('<?php echo esc_js(__('It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', BLOGDESIGNERPRO_TEXTDOMAIN)); ?>');
                });
            </script>
            <?php
        }
    }

    /**
     * insert rows after plugin
     */
    public function bdp_insert_plugin_row() {
        $plugins = get_plugins();
        foreach ($plugins as $plugin_id => $plugin) {
            $slug = dirname($plugin_id);
            if (empty($slug))
                continue;
            if ($slug !== 'blog-designer-pro')
                continue;

            //check version, latest updates and if registered or not
            $validated = get_option('revslider-valid', 'false');
            $bdp_wp_auto_update = new bdp_wp_auto_update();
            $bdp_latestv = $bdp_wp_auto_update->getRemote_version();
            $bdp_checkversion = $bdp_wp_auto_update->getRemote_license();
            if ($bdp_checkversion != 'correct') { //activate for updates and support
                add_action("after_plugin_row_" . $plugin_id, array(&$this, 'bdp_purchase_notice'), 10, 3);
            }

            if (version_compare($bdp_latestv, $plugin['Version'], '>') && $bdp_checkversion != 'correct') {
                add_action("after_plugin_row_" . $plugin_id, array(&$this, 'bdp_update_notice'), 10, 3);
            }
        }
    }

    public function bdp_purchase_notice() {
        $wp_list_table = _get_list_table('WP_Plugins_List_Table');
        ?>
        <tr class="plugin-update-tr">
            <td colspan="<?php echo $wp_list_table->get_column_count(); ?>" class="plugin-update colspanchange">
                <div class="update-message">
                    <?php echo __('Hola! Would you like to receive automatic updates and unlock premium support? Please', BLOGDESIGNERPRO_TEXTDOMAIN) .' <a href="' . admin_url('admin.php?page=bdp_getting_started&tab=register_product') . '">' . __('activate', BLOGDESIGNERPRO_TEXTDOMAIN) .'</a> '. __('your copy of', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __('Blog Designer Pro', BLOGDESIGNERPRO_TEXTDOMAIN) .'</b>'; ?>
                </div>
            </td>
        </tr>
        <?php
    }

    public function bdp_update_notice() {
        $wp_list_table = _get_list_table('WP_Plugins_List_Table');
        $bdp_wp_auto_update = new bdp_wp_auto_update();
        $bdp_latestv = $bdp_wp_auto_update->getRemote_version();
        ?>
        <tr class="plugin-update-tr">
            <td colspan="<?php echo $wp_list_table->get_column_count(); ?>" class="plugin-update colspanchange">
                <div class="update-message">
                    <p><?php _e('A new version ' . $bdp_latestv . ' of Blog Designer Pro is available.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                </div>
            </td>
        </tr>
        <?php
    }

    /**
     * add menu at admin panel
     * @global string $bdp_screen_option_page
     * @global string $bdp_screen_option_archive_page
     */
    public function bdp_add_menu() {
        global $bdp_screen_option_page, $bdp_screen_option_archive_page, $bdp_single_screen;
        $manage_blog_designs = $this->bdp_manage_blog_design_pro();
        $bdp_screen_option_page = add_menu_page(__('Blog Designer', BLOGDESIGNERPRO_TEXTDOMAIN), __('Blog Designer', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'layouts', array($this, 'display_shortcode_list'), BLOGDESIGNERPRO_URL . '/images/blog-designer-pro.png');
        add_action("load-$bdp_screen_option_page", array($this, 'bdp_screen_options'));
        add_submenu_page('layouts', __('Blog Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), __('Blog Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'layouts', array($this, 'display_shortcode_list'));
        add_submenu_page('layouts', __('Blog Layout Settings', BLOGDESIGNERPRO_TEXTDOMAIN), __('Add Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'add_shortcode', array($this, 'display_shortcode_edit_list'));
        $bdp_screen_option_archive_page = add_submenu_page('layouts', __('Archive Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), __('Archive Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'archive_layouts', array($this, 'display_archive_list'));
        add_action("load-$bdp_screen_option_archive_page", array($this, 'bdp_screen_options_archive'));
        add_submenu_page('layouts', __('Archive Settings', BLOGDESIGNERPRO_TEXTDOMAIN), __('Add Archive Layout', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'bdp_add_archive_layout', array($this, 'display_archive_edit_list'));
        $bdp_single_screen = add_submenu_page('layouts', __('Single Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), __('Single Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'single_layouts', array($this, 'display_single_list'));
        add_action("load-$bdp_single_screen", array($this, 'bdp_screen_options_single'));
        add_submenu_page('layouts', __('Single Post Settings', BLOGDESIGNERPRO_TEXTDOMAIN), __('Add Single Layout', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'single_post', array($this, 'display_post_edit_list'));
        add_submenu_page('layouts', __('Import Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), __('Import Layouts', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'bdp_export', array($this, 'bdp_import_blog_layouts'));
        add_submenu_page('layouts', __('Getting Started', BLOGDESIGNERPRO_TEXTDOMAIN), __('Getting Started', BLOGDESIGNERPRO_TEXTDOMAIN), $manage_blog_designs, 'bdp_getting_started', array($this, 'bdp_getting_started_page'));
    }

    /**
     * Include admin shortcode list page
     */
    public static function display_shortcode_list() {
        include_once( 'assets/admin_shortcode_list.php' );
    }

    /**
     * Include admin shortcode list page
     */
    public static function display_single_list() {
        include_once( 'assets/admin_single_list.php' );
    }

    /**
     * Include admin archive list page
     */
    public static function display_archive_list() {
        include_once( 'assets/admin_archive_list.php' );
    }

    /**
     * Include admin edit form
     */
    public static function display_shortcode_edit_list() {
        include_once( 'assets/admin_edit_form.php' );
    }

    /**
     * Include single post edit form
     */
    public static function display_post_edit_list() {
        include_once( 'assets/admin_single_edit_form.php' );
    }

    /**
     * Include archive layout edit form
     */
    public static function display_archive_edit_list() {
        include_once( 'assets/admin_archive_edit_form.php' );
    }

    /**
     * Include Import data form
     */
    public static function bdp_import_blog_layouts() {
        include_once( 'assets/admin_import_form.php' );
    }

    /**
     * Include bdp getting started page
     */
    public static function bdp_getting_started_page() {
        include_once( 'assets/bdp_getting_started.php' );
    }

    /**
     *
     * Enqueue admin panel required css and js
     */
    public function bdp_admin_stylesheet_js() {
        if (isset($_GET['page']) && ( $_GET['page'] == 'layouts' || $_GET['page'] == 'archive_layouts' || $_GET['page'] == 'add_shortcode' || $_GET['page'] == 'single_post' || $_GET['page'] == 'bdp_add_archive_layout' || $_GET['page'] == 'bdp_google_fonts' || $_GET['page'] == 'bdp_export' || $_GET['page'] == 'single_layouts' || $_GET['page'] == 'bdp_getting_started' || $_GET['page'] == 'designer_welcome_page')) {
            $adminstylesheetURL = plugins_url('css/admin.css', __FILE__);
            $adminstylesheet = dirname(__FILE__) . '/css/admin.css';
            $adminrtlstylesheetURL = plugins_url('css/admin-rtl.css', __FILE__);
            if (file_exists($adminstylesheet)) {
                wp_register_style('bdp-admin-stylesheets', $adminstylesheetURL);
                wp_enqueue_style('bdp-admin-stylesheets');
            }
            if (is_rtl()) {
                wp_register_style('bdp-admin-rtl-stylesheets', $adminrtlstylesheetURL);
                wp_enqueue_style('bdp-admin-rtl-stylesheets');
            }
            wp_enqueue_script('jquery');
            wp_register_style('bdp-admin-arsto', BLOGDESIGNERPRO_URL . '/admin/css/aristo.css');
            wp_enqueue_style('bdp-admin-arsto');
            wp_register_style('bdp-basic-tools-min', BLOGDESIGNERPRO_URL . '/admin/css/basic-tools-min.css'); //Code by tushar
            wp_enqueue_style('bdp-basic-tools-min');
        }
    }

    /**
     *
     * Set default value
     * @global array $bdp_settings
     */
    public function bdp_default_settings_function() {
        global $bdp_settings, $wpdb;
        if (empty($bdp_settings)) {
            $bdp_settings = array(
                'pagination_type' => 'paged',
                'display_category' => '0',
                'display_tag' => '0',
                'display_author' => '0',
                'display_author_data' => '0',
                'display_author_biography' => '0',
                'display_date' => '0',
                'display_story_year' => '1',
                'display_postlike' => '0',
                'display_thumbnail' => '0',
                'display_comment_count' => '0',
                'display_comment' => '0',
                'display_navigation' => '0',
                'template_name' => 'classical',
                'template_alternativebackground' => '0',
                'rss_use_excerpt' => '1',
                'social_share' => '1',
                'social_style' => '1',
                'social_icon_style' => '1',
                'social_icon_size' => '1',
                'facebook_link' => '1',
                'twitter_link' => '1',
                'google_link' => '1',
                'linkedin_link' => '1',
                'email_link' => '1',
                'whatsapp_link' => '1',
                'pinterest_link' => '1',
                'facebook_link_with_count' => '0',
                'linkedin_link_with_count' => '0',
                'pinterest_link_with_count' => '0',
                'social_count_position' => 'bottom',
                'template_bgcolor' => '#ffffff',
                'template_color' => '#000',
                'template_alterbgcolor' => '#ffffff',
                'template_ftcolor' => '#2376ad',
                'template_fthovercolor' => '#2b2b2b',
                'grid_hoverback_color' => '#000000',
                'template_titlecolor' => '#222222',
                'template_titlehovercolor' => '#666666',
                'template_titlebackcolor' => '',
                'template_titlefontsize' => '30',
                'template_titlefontface' => '',
                'template_contentfontface' => '',
                'related_post_by' => 'category',
                'bdp_related_post_order_by' => 'date',
                'bdp_related_post_order' => 'DESC',
                'txtExcerptlength' => '50',
                'content_fontsize' => '14',
                'unique_design_option' => '',
                'firstletter_fontsize' => '20',
                'firstletter_contentcolor' => '#000000',
                'template_contentcolor' => '#7b95a6',
                'template_content_hovercolor' => '#ed4b1f',
                'txtReadmoretext' => 'Read More',
                'template_readmorecolor' => '#2376ad',
                'template_readmorebackcolor' => '#dcdee0',
                'template_columns' => '2',
                'template_grid_skin' => 'default',
                'template_grid_height' => '300',
                'bdp_blog_order_by' => '',
                'bdp_blog_order' => 'DESC',
                'related_post_title' => __('Related Posts', BLOGDESIGNERPRO_TEXTDOMAIN),
                'date_color_of_readmore' => '0',
                'template_easing' => 'easeOutSine',
                'display_timeline_bar' => '0',
                'item_width' => '400',
                'item_height' => '570',
                'display_arrows' => '1',
                'enable_autoslide' => '0',
                'scroll_speed' => '1000',
                'easy_timeline_effect' => 'flip-effect',
                'display_feature_image' => '0',
                'thumbnail_skin' => '0',
            );
            $bdp_settings = apply_filters('bdp_change_default_settings', $bdp_settings);
        }

        /**
         * Run the updater code
         */
        if (isset($_GET['do_update_bdp_single_template']) && $_GET['do_update_bdp_single_template'] == 'do' && get_option('bdp_single_template')) {
            $old_single_data = get_option('bdp_single_template');
            $all_single_template = bdp_get_all_single_template_settings();
            if (!$all_single_template) {
                global $wpdb;
                $table_name = $wpdb->prefix . "bdp_single_layouts";
                $bdp_settings = apply_filters('bdp_single_template_settings', $old_single_data);
                $insert = $wpdb->insert(
                        $table_name, array('single_name' => __('All Post Settings', BLOGDESIGNERPRO_TEXTDOMAIN), 'single_template' => 'all', 'sub_categories' => '', 'single_post_id' => '', 'settings' => $bdp_settings), array('%s', '%s', '%s', '%s')
                );
                if ($insert === FALSE) {
                    wp_die(__('Error in run the updater.', BLOGDESIGNERPRO_TEXTDOMAIN));
                } else {
                    $message = 'single_added_msg';
                    $shortcode_ID = $wpdb->insert_id;
                }
                delete_option('bdp_single_template');
                $send = admin_url('admin.php?page=single_post&action=edit&id=' . $shortcode_ID);
                $send = add_query_arg('message', $message, $send);
                do_action('bdp_add_single_layout', $shortcode_ID);
                wp_redirect($send);
                exit();
            } else {
                delete_option('bdp_single_template');
            }
        }

        /**
         * Run the updater code for change template name
         */
        if (isset($_GET['do_update_bdp_template_name_changed']) && $_GET['do_update_bdp_template_name_changed'] == 'do') {

            $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
            if($bdp_template_name_changed == 1) {
                $table_name = $wpdb->prefix . 'blog_designer_pro_shortcodes';
                $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $table_name);
                if ($count_layout > 0) {
                    $getQry = 'SELECT * FROM ' . $table_name;
                    $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
                    foreach ($get_allsettings as $get_allsetting) {
                        $bdp_settings = unserialize($get_allsetting['bdsettings']);
                        if ($bdp_settings['template_name'] == 'classical') {
                            $bdp_settings['template_name'] = 'nicy';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('bdsettings' => $get_allsetting['bdsettings']), array('bdid' => $get_allsetting['bdid']));
                        }
                        if ($bdp_settings['template_name'] == 'lightbreeze') {
                            $bdp_settings['template_name'] = 'sharpen';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('bdsettings' => $get_allsetting['bdsettings']), array('bdid' => $get_allsetting['bdid']));
                        }
                        if ($bdp_settings['template_name'] == 'spektrum') {
                            $bdp_settings['template_name'] = 'hub';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('bdsettings' => $get_allsetting['bdsettings']), array('bdid' => $get_allsetting['bdid']));
                        }
                    }
                }

                wp_reset_query();
                $table_name = $wpdb->prefix . 'bdp_archives';
                $count_archive = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $table_name);
                if ($count_archive > 0) {
                    $getQry = 'SELECT * FROM ' . $table_name;
                    $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
                    foreach ($get_allsettings as $get_allsetting) {
                        $bdp_settings = unserialize($get_allsetting['settings']);
                        if ($bdp_settings['template_name'] == 'classical') {
                            $bdp_settings['template_name'] = 'nicy';
                            $get_allsetting['settings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                        if ($bdp_settings['template_name'] == 'lightbreeze') {
                            $bdp_settings['template_name'] = 'sharpen';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                        if ($bdp_settings['template_name'] == 'spektrum') {
                            $bdp_settings['template_name'] = 'hub';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                    }
                }

                wp_reset_query();
                $table_name = $wpdb->prefix . 'bdp_single_layouts';
                $count_single = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $table_name);
                if ($count_single > 0) {
                    $getQry = 'SELECT * FROM ' . $table_name;
                    $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
                    foreach ($get_allsettings as $get_allsetting) {
                        $bdp_settings = unserialize($get_allsetting['settings']);
                        if ($bdp_settings['template_name'] == 'classical') {
                            $bdp_settings['template_name'] = 'nicy';
                            $get_allsetting['settings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                        if ($bdp_settings['template_name'] == 'lightbreeze') {
                            $bdp_settings['template_name'] = 'sharpen';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                        if ($bdp_settings['template_name'] == 'spektrum') {
                            $bdp_settings['template_name'] = 'hub';
                            $get_allsetting['bdsettings'] = serialize($bdp_settings);
                            $wpdb->update($table_name, array('settings' => $get_allsetting['settings']), array('id' => $get_allsetting['id']));
                        }
                    }
                }

                update_option('bdp_template_name_changed', 0);
            }
            update_option('bdp_template_name_changed', 0);
            $send = admin_url('admin.php?page=layouts');
            $send = add_query_arg('message', $message, $send);
            wp_redirect($send);
            exit();
        }

    }

    /**
     *
     * Display Notice
     *
     */
    public function bdp_outdated_templates_notices() {
        $bdp_pages = array('layouts', 'add_shortcode', 'archive_layouts', 'bdp_add_archive_layout', 'single_layouts' , 'single_post');
        $bdp_template_outdated = get_option('bdp_template_outdated', 0);
        $bdp_override_template_dir = '';

        if(isset($_GET['page']) && in_array($_GET['page'], $bdp_pages) && $bdp_template_outdated != 1) {
            $bdp_outdated = true;

            if($_GET['page'] == 'layouts' || $_GET['page'] == 'add_shortcode') {
                $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/blog/';
                $bdp_override_template_dir = get_template_directory() . '/bdp_templates/blog/';
                if(!is_dir($bdp_override_template_dir)) {
                    $bdp_outdated = false;
                }
            }
            if($_GET['page'] == 'archive_layouts' || $_GET['page'] == 'bdp_add_archive_layout') {
                $bdp_archive_template = get_template_directory() . '/bdp_templates/archive/archive.php';
                if (file_exists($bdp_archive_template)) {
                    $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/';
                    $bdp_override_template_dir = get_template_directory() . '/bdp_templates/archive/';
                } else {
                    $bdp_outdated = true;
                }
            }
            if($_GET['page'] == 'single_layouts' || $_GET['page'] == 'single_post') {
                $bdp_single_template = get_template_directory() . '/bdp_templates/single/single.php';
                if (file_exists($bdp_single_template)) {
                    $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/single/';
                    $bdp_override_template_dir = get_template_directory() . '/bdp_templates/single/';
                } else {
                    $bdp_outdated = true;
                }
            }

            if(is_dir($bdp_override_template_dir)) {
                $bdp_override_templates_layouts = scandir($bdp_override_template_dir);
                foreach ($bdp_override_templates_layouts as $key => $value) {
                    if($value != '.' && $value != '..' ) {
                        $bdp_core_template = $bdp_core_template_dir . $value;
                        if(!file_exists($bdp_core_template)) {
                            $bdp_outdated = false;
                            continue;
                        }
                        $core_version = bdp_check_file_version($bdp_core_template_dir. $value);
                        $bdp_override_template = $bdp_override_template_dir . $value;
                        $template_version = bdp_check_file_version($bdp_override_template);

                        if($core_version > $template_version) {
                            $bdp_outdated = true;
                            break;
                        } else {
                            $bdp_outdated = false;
                        }
                    }
                }
            }
            if($bdp_outdated){
                //add_action('admin_notices', 'bdp_template_outdated_notice');
            }
        }
    }

    /**
     *
     * Create table if table not found when plugin is active
     * @global object $wpdb
     */
    public function bdp_table_status() {
        global $wpdb;
        if (is_plugin_active('blog-designer-pro/blog-designer-pro.php')) {
            $BdpFront = new BdpFrontFunction();
            $bdpro_shortcode = $wpdb->prefix . 'blog_designer_pro_shortcodes';
            if ($wpdb->get_var("SHOW TABLES LIKE '$bdpro_shortcode'") != $bdpro_shortcode) {
                $BdpFront->bdp_create_shortcodes_table();
            }
            $archive_table = $wpdb->prefix . "bdp_archives";
            if ($wpdb->get_var("SHOW TABLES LIKE '$archive_table'") != $archive_table) {
                $BdpFront->bdp_Setarchive_Table();
            }
            /**
             * Single Post Layouts
             */
            $single_table = $wpdb->prefix . "bdp_single_layouts";
            if ($wpdb->get_var("SHOW TABLES LIKE '$single_table'") != $single_table) {
                $BdpFront->bdp_Setsingle_Table();
            }
        }
    }

    /**
     * enqueue script and style
     * @param object $hook_suffix
     */
    public function bdp_admin_front_scripts($hook_suffix) {
        if (isset($_GET['page']) && ( $_GET['page'] == 'add_shortcode' || $_GET['page'] == 'bdp_add_archive_layout' || $_GET['page'] == 'single_post')) {
            $fontawesomeiconURL = BLOGDESIGNERPRO_URL . '/css/font-awesome.min.css';
            wp_register_script('bdp-admin-front-social', BLOGDESIGNERPRO_URL . '/js/SocialShare.js');
            wp_enqueue_script('bdp-admin-front-social');
            wp_register_style('bdp-admin-fontawesome-stylesheets', $fontawesomeiconURL);
            wp_enqueue_style('bdp-admin-fontawesome-stylesheets');
        }
    }

    /**
     * Enqueue Admin scripts and style
     * @global object $hook_suffix
     */
    public function bdp_admin_scripts($hook_suffix) {

        wp_enqueue_style('bdp_support_css', plugins_url('css/bdp_support.css', __FILE__));

        if (isset($_GET['page']) && $_GET['page'] == 'bdp_getting_started') {
            wp_enqueue_script('bdp-clipboard', plugins_url('js/clipboard.js', __FILE__), array('jquery'), false, true);
        }

        if (isset($_GET['page']) && ($_GET['page'] == 'add_shortcode' || $_GET['page'] == 'single_post' || $_GET['page'] == 'layouts' || $_GET['page'] == 'bdp_add_archive_layout' || $_GET['page'] == 'bdp_google_fonts' || $_GET['page'] == 'bdp_export' || $_GET['page'] == 'bdp_getting_started' || $_GET['page'] == 'designer_welcome_page')) {
            wp_enqueue_style('wp-color-picker');
            if (function_exists('wp_enqueue_media'))
                wp_enqueue_media();
            if (isset($_GET['page']) && ($_GET['page'] == 'add_shortcode')) {
                wp_enqueue_script('jquery-ui-datepicker');
            }

            wp_enqueue_script('my-script-handle', plugins_url('js/admin_script.js', __FILE__), array('wp-color-picker', 'jquery-ui-core', 'jquery-ui-dialog'), false, true);
            wp_localize_script('my-script-handle', 'bdpro_js', array(
                'nothing_found' => __("Oops, nothing found!", BLOGDESIGNERPRO_TEXTDOMAIN),
                'choose_archive' => __("Choose template for archive page", BLOGDESIGNERPRO_TEXTDOMAIN),
                'default_style_template' => __("Apply default style of this selected template", BLOGDESIGNERPRO_TEXTDOMAIN),
                'set_archive_template' => __("Set Archive Template", BLOGDESIGNERPRO_TEXTDOMAIN),
                'no_template_exist' => __("No template exist for selection", BLOGDESIGNERPRO_TEXTDOMAIN),
                'close' => __("Close", BLOGDESIGNERPRO_TEXTDOMAIN),
                'choose_blog_template' => __("Choose the blog template you love", BLOGDESIGNERPRO_TEXTDOMAIN),
                'set_blog_template' => __("Set Blog Template", BLOGDESIGNERPRO_TEXTDOMAIN),
                'select_arrow' => __("Select Arrow", BLOGDESIGNERPRO_TEXTDOMAIN),
                'choose_single_post_template' => __("Choose the template you love for your single post", BLOGDESIGNERPRO_TEXTDOMAIN),
                'set_single_template' => __("Set Single Post Template", BLOGDESIGNERPRO_TEXTDOMAIN),
                'reset_data' => __("Do you want to reset data?", BLOGDESIGNERPRO_TEXTDOMAIN),
                'archive_template_preview' => __("Your archive template preview", BLOGDESIGNERPRO_TEXTDOMAIN),
                'template_preview' => __("Your template preview", BLOGDESIGNERPRO_TEXTDOMAIN),
                'enter_font_url' => __("Please enter font URL", BLOGDESIGNERPRO_TEXTDOMAIN),
                'please_enter_font_url' => __("Please enter a valid font URL", BLOGDESIGNERPRO_TEXTDOMAIN),
                'remove' => __("Remove", BLOGDESIGNERPRO_TEXTDOMAIN),
                'remove_font' => __("Remove Font", BLOGDESIGNERPRO_TEXTDOMAIN),
                'font_added' => __("Font added successfully.", BLOGDESIGNERPRO_TEXTDOMAIN),
                'font_not_added' => __("Font not added successfully.", BLOGDESIGNERPRO_TEXTDOMAIN),
                'delete_google_font' => __("Are you sure want to delete google font?", BLOGDESIGNERPRO_TEXTDOMAIN),
                'font_deleted' => __("Font deleted successfully.", BLOGDESIGNERPRO_TEXTDOMAIN),
                'font_not_deleted' => __("Font not deleted successfully.", BLOGDESIGNERPRO_TEXTDOMAIN),
                'readmore' => __("Read More", BLOGDESIGNERPRO_TEXTDOMAIN),
                'info' => __("info.", BLOGDESIGNERPRO_TEXTDOMAIN),
                'information' => __("information", BLOGDESIGNERPRO_TEXTDOMAIN),
                'about' => __("About", BLOGDESIGNERPRO_TEXTDOMAIN),
                'learn_more' => __("Learn More", BLOGDESIGNERPRO_TEXTDOMAIN),
                'view_more' => __("View More", BLOGDESIGNERPRO_TEXTDOMAIN),
                'info_about' => __("Information about", BLOGDESIGNERPRO_TEXTDOMAIN),
                'continue_reading' => __("Continue Reading", BLOGDESIGNERPRO_TEXTDOMAIN),
                'view_article' => __("View Article", BLOGDESIGNERPRO_TEXTDOMAIN),
                'keep_reading' => __("Keep Reading", BLOGDESIGNERPRO_TEXTDOMAIN),
                'related_posts' => __("Related Posts", BLOGDESIGNERPRO_TEXTDOMAIN),
                'share_posts' => __("Share This Post", BLOGDESIGNERPRO_TEXTDOMAIN),
                'show_more_posts' => __("Show More Posts", BLOGDESIGNERPRO_TEXTDOMAIN),
                'share_it' => __("Share It Now", BLOGDESIGNERPRO_TEXTDOMAIN),
                'you_also_like' => __("You may also like", BLOGDESIGNERPRO_TEXTDOMAIN),
                'more_stories' => __("More Stories", BLOGDESIGNERPRO_TEXTDOMAIN),
                'share' => __("Share it", BLOGDESIGNERPRO_TEXTDOMAIN),
                'chk_related_post' => __("Check Related Posts", BLOGDESIGNERPRO_TEXTDOMAIN),
                'more_post' => __("More Posts", BLOGDESIGNERPRO_TEXTDOMAIN),
                'chk_more_related_post' => __("Check more related posts", BLOGDESIGNERPRO_TEXTDOMAIN),
                'share_now' => __("Share Now", BLOGDESIGNERPRO_TEXTDOMAIN),
                'change_html' => __("Image Height", BLOGDESIGNERPRO_TEXTDOMAIN),
                'the_author' => __("The Author", BLOGDESIGNERPRO_TEXTDOMAIN),
                'read_more_hover' => __("Read More Link Hover Color", BLOGDESIGNERPRO_TEXTDOMAIN),
                'bdp_font_base' => (is_ssl()) ? "https://" : "http://",
                'startup_text' => __("STARTUP", BLOGDESIGNERPRO_TEXTDOMAIN),
                'is_rtl' => (is_rtl()) ? 1 : 0,
                'bdp_template_name_changed' => get_option('bdp_template_name_changed', 1),
                'copied' => __("Copied", BLOGDESIGNERPRO_TEXTDOMAIN),
                'copy_for_support' => __("Copy for Support", BLOGDESIGNERPRO_TEXTDOMAIN),
                    )
            );
            wp_enqueue_script('choosen-script-handle', plugins_url('js/chosen.jquery.js', __FILE__));
            wp_enqueue_style('choosen-style-handle', plugins_url('css/chosen.min.css', __FILE__));

            wp_enqueue_script('jquery-ui-dialog');
            $screen = get_current_screen();
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/blog-designer-pro/blog-designer-pro.php', $markup = true, $translate = true);
            $current_version = $plugin_data['Version'];
            $old_version = get_option('bdp_version');
            if ($old_version != $current_version) {
                update_option('bdp_version', $current_version);
            }
        }
        if ('index.php' == $hook_suffix) {
            $adminstylesheetURL = plugins_url('css/admin.css', __FILE__);
            $adminstylesheet = dirname(__FILE__) . '/css/admin.css';
            if (file_exists($adminstylesheet)) {
                wp_register_style('bdp-admin-stylesheets', $adminstylesheetURL);
                wp_enqueue_style('bdp-admin-stylesheets');
            }
        }
    }

    /**
     * Clone blog template
     */
    public function bdp_duplicate_layout() {
        if (( isset($_GET['layout']) && $_GET['layout'] != '' ) && ( isset($_GET['action']) && 'duplicate_post_in_edit' == $_GET['action'] )) {
            $user = wp_get_current_user();
            $closed = array('bdpgeneral');
            $closed = array_filter($closed);
            update_user_option($user->ID, 'bdpclosedbdpboxes_add_shortcode', $closed, true);

            $layout_setting = bdp_get_shortcode_settings($_GET['layout']);
            if ($layout_setting) {
                $layout_setting['blog_page_display'] = 0;
                $shortcode_name = $layout_setting['unique_shortcode_name'] . ' ' . __('Copy', BLOGDESIGNERPRO_TEXTDOMAIN);

                $shortcode_ID = bdp_insert_layout($shortcode_name, $layout_setting);
                if ($shortcode_ID > 0) {
                    $message = 'shortcode_duplicate_msg';
                } else {
                    wp_die(__('Error in Adding shortcode.', BLOGDESIGNERPRO_TEXTDOMAIN));
                }
                do_action('bdp_duplicate_layout_settings', $shortcode_ID);
                $send = admin_url('admin.php?page=add_shortcode&action=edit&id=' . $shortcode_ID);
                $send = add_query_arg('message', $message, $send);
                wp_redirect($send);
                exit();
            } else {
                wp_die(__('No layout to duplicate has been supplied!', BLOGDESIGNERPRO_TEXTDOMAIN));
            }
        }

        if (( isset($_GET['layout']) && $_GET['layout'] != '' ) && ( isset($_GET['action']) && 'duplicate_single_post_in_edit' == $_GET['action'] )) {

            $user = wp_get_current_user();
            $closed = array('bdpsinglegeneral');
            $closed = array_filter($closed);
            update_user_option($user->ID, 'bdpclosedbdpboxes_single_post', $closed, true);

            global $wpdb;
            $single_id = $_GET['layout'];
            $single_table = $wpdb->prefix . 'bdp_single_layouts';

            $getQry = "SELECT * FROM $single_table WHERE ID = $single_id";
            $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
            if (!isset($get_allsettings[0]['settings'])) {
                echo '<div class="updated notice">';
                wp_die(__('You attempted to edit an item that doesn’t exist. Perhaps it was deleted?', BLOGDESIGNERPRO_TEXTDOMAIN));
                echo '</div>';
            } else {
                $allsettings = $get_allsettings[0]['settings'];
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                    $custom_single_type = $get_allsettings[0]['single_template'];
                    $single_template_name = $get_allsettings[0]['single_name'] . ' ' . __('Copy', BLOGDESIGNERPRO_TEXTDOMAIN);
                }
                $bdp_settings['bdp_single_type'] = '';
                $bdp_settings['single_layout_name'] = array();
                $bdp_settings['template_tags'] = array();
                $bdp_settings['template_posts'] = array();
                $single_layout_setting = $wpdb->insert(
                        $single_table, array('single_name' => $single_template_name, 'single_template' => sanitize_text_field($bdp_settings['template_name']), 'sub_categories' => '', 'single_post_id' => '', 'settings' => serialize($bdp_settings)), array('%s', '%s', '%s', '%s')
                );
                if ($single_layout_setting === FALSE) {
                    $shortcode_ID = 0;
                } else {
                    $shortcode_ID = $wpdb->insert_id;
                }
                $message = 'shortcode_duplicate_msg';
                if ($shortcode_ID > 0) {
                    $message = 'shortcode_duplicate_msg';
                    do_action('bdp_duplicate_single_layout_settings', $shortcode_ID);
                } else {
                    wp_die(__('Error in Adding shortcode.', BLOGDESIGNERPRO_TEXTDOMAIN));
                }
                $send = admin_url('admin.php?page=single_post&action=edit&id=' . $shortcode_ID);
                $send = add_query_arg('message', $message, $send);
                wp_redirect($send);
                exit();
            }
        }
    }

    /**
     * save template at admin side
     * @global object $wpdb
     * @global array $bdp_settings
     * @global string $bdp_table_name
     * @global WP_Error $bdp_errors
     * @global string $bdp_success
     */
    public function bdp_save_admin_template() {
        global $wpdb, $bdp_settings, $bdp_table_name, $bdp_errors, $bdp_success;
        if (isset($_GET['page']) && $_GET['page'] == 'layouts') {
            $user = wp_get_current_user();
            $closed = array('bdpgeneral');
            $closed = array_filter($closed);
            update_user_option($user->ID, 'bdpclosedbdpboxes_add_shortcode', $closed, true);
        }
        if (isset($_GET['page']) && $_GET['page'] == 'single_layouts') {
            $user = wp_get_current_user();
            $closed = array('bdpsinglegeneral');
            $closed = array_filter($closed);
            update_user_option($user->ID, 'bdpclosedbdpboxes_single_post', $closed, true);
        }
        if (isset($_GET['page']) && $_GET['page'] == 'archive_layouts') {
            $user = wp_get_current_user();
            $closed = array('bdpgeneral');
            $closed = array_filter($closed);
            update_user_option($user->ID, 'bdpclosedbdpboxes_bdp_add_archive_layout', $closed, true);
        }
        if (isset($_GET['page']) && $_GET['page'] == 'add_shortcode') {
            if (!isset($_GET['action']) || $_GET['action'] == '') {
                $user = wp_get_current_user();
                $closed = array('bdpgeneral');
                $closed = array_filter($closed);
                update_user_option($user->ID, 'bdpclosedbdpboxes_add_shortcode', $closed, true);
            }
            if (isset($_POST['savedata']) || ( isset($_POST['resetdata']) && $_POST['resetdata'] != '' )) {
                $bdp_settings = $_POST;
                $templates = array();
                if (isset($_POST['bdp-submit-nonce']) && wp_verify_nonce($_POST['bdp-submit-nonce'], 'bdp-shortcode-form-submit')) {
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $shortcode_ID = $_GET['id'];
                        } else {
                            $shortcode_ID = '';
                        }
                        $bdp_settings = apply_filters('bdp_update_blog_layout_settings', $bdp_settings);
                        $save = $wpdb->update(
                                $bdp_table_name, array('shortcode_name' => sanitize_text_field($_POST['unique_shortcode_name']), 'bdsettings' => serialize($bdp_settings)), array('bdid' => $shortcode_ID), array('%s', '%s'), array('%d')
                        );
                        if ($save === FALSE) {
                            $bdp_errors = new WP_Error('save_error', __('Error in updating shortcode.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            $templates['ID'] = $_POST['blog_page_display'];
                            $templates['post_content'] = '[wp_blog_designer id="' . $shortcode_ID . '"]';
                            wp_update_post($templates);
                            if (isset($_POST['resetdata']) && $_POST['resetdata'] != '') {
                                $bdp_success = __('Layout reset successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                do_action('bdp_reset_shortcode', $shortcode_ID);
                            } else {
                                $bdp_success = __('Layout updated successfully. ', BLOGDESIGNERPRO_TEXTDOMAIN);
                                do_action('bdp_update_shortcode', $shortcode_ID);
                            }
                            if (isset($_POST['blog_page_display']) && $_POST['blog_page_display'] > 0) {
                                $bdp_success .= ' <a href="' . get_the_permalink($_POST['blog_page_display']) . '" target="_blank">' . __('View Layout', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
                            }
                        }
                    } else {
                        $bdp_settings = apply_filters('bdp_add_blog_layout_settings', $bdp_settings);
                        $shortcode_ID = bdp_insert_layout(sanitize_text_field($_POST['unique_shortcode_name']), $bdp_settings);
                        if ($shortcode_ID > 0) {
                            $message = 'shortcode_added_msg';
                        } else {
                            wp_die(__('Error in Adding shortcode.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        }
                        $templates['ID'] = $_POST['blog_page_display'];
                        $templates['post_content'] = '[wp_blog_designer id="' . $shortcode_ID . '"]';
                        wp_update_post($templates);
                        $send = admin_url('admin.php?page=add_shortcode&action=edit&id=' . $shortcode_ID);
                        $send = add_query_arg('message', $message, $send);
                        do_action('bdp_add_shortcode', $shortcode_ID);
                        wp_redirect($send);
                        exit();
                    }
                } else {
                    wp_redirect('?page=layouts');
                }
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == 'single_post') {
            if (!isset($_GET['action']) || $_GET['action'] == '') {
                $user = wp_get_current_user();
                $closed = array('bdpsinglegeneral');
                $closed = array_filter($closed);
                update_user_option($user->ID, 'bdpclosedbdpboxes_single_post', $closed, true);
            }
            if (isset($_POST['savedata']) || ( isset($_POST['resetdata']) && $_POST['resetdata'] != '' )) {
                $bdp_settings = $_POST;
                $post_ids = isset($_POST['template_posts']) ? implode(',', $_POST['template_posts']) : '';
                $single_table = $wpdb->prefix . "bdp_single_layouts";
                if (isset($_POST['bdp-submit-nonce']) && wp_verify_nonce($_POST['bdp-submit-nonce'], 'bdp-shortcode-form-submit')) {
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $shortcode_ID = $_GET['id'];
                        } else {
                            $shortcode_ID = '';
                        }
                        if (isset($_POST['bdp_single_type']) && $_POST['bdp_single_type'] == 'category') {
                            $categories = isset($_POST['template_category']) ? implode(',', $_POST['template_category']) : '';
                        } else if (isset($_POST['bdp_single_type']) && $_POST['bdp_single_type'] == 'tag') {
                            $categories = isset($_POST['template_tags']) ? implode(',', $_POST['template_tags']) : '';
                        } else {
                            $categories = '';
                        }
                        $bdp_settings = apply_filters('bdp_update_single_layout_settings', $bdp_settings);
                        $save = $wpdb->update(
                                $single_table, array('single_name' => sanitize_text_field($_POST['single_layout_name']), 'single_template' => sanitize_text_field($_POST['bdp_single_type']), 'sub_categories' => $categories, 'single_post_id' => $post_ids, 'settings' => serialize($bdp_settings)), array('ID' => $shortcode_ID), array('%s', '%s', '%s', '%s', '%s'), array('%d')
                        );
                        if ($save === FALSE) {
                            $bdp_errors = new WP_Error('save_error', __('Error in updating single page settings.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            if (isset($_POST['resetdata']) && $_POST['resetdata'] != '') {
                                $bdp_success = __('Single layout reset successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                do_action('bdp_reset_single_page', $shortcode_ID);
                            } else {
                                $bdp_success = __('Single layout updated successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                do_action('bdp_update_single_page', $shortcode_ID);
                            }
                        }
                    } else {
                        if (isset($_POST['bdp_single_type']) && $_POST['bdp_single_type'] == 'category') {
                            $categories = isset($_POST['template_category']) ? implode(',', $_POST['template_category']) : '';
                        } else if (isset($_POST['bdp_single_type']) && $_POST['bdp_single_type'] == 'tag') {
                            $categories = isset($_POST['template_tags']) ? implode(',', $_POST['template_tags']) : '';
                        } else {
                            $categories = '';
                        }
                        $bdp_settings = apply_filters('bdp_single_template_settings', $bdp_settings);
                        $insert = $wpdb->insert(
                                $single_table, array('single_name' => sanitize_text_field($_POST['single_layout_name']), 'single_template' => sanitize_text_field($_POST['bdp_single_type']), 'sub_categories' => $categories, 'single_post_id' => $post_ids, 'settings' => serialize($bdp_settings)), array('%s', '%s', '%s', '%s')
                        );
                        if ($insert === FALSE) {
                            wp_die(__('Error in creating single post layout.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            $message = 'single_added_msg';
                            $shortcode_ID = $wpdb->insert_id;
                        }
                        $send = admin_url('admin.php?page=single_post&action=edit&id=' . $shortcode_ID);
                        $send = add_query_arg('message', $message, $send);
                        do_action('bdp_add_single_layout', $shortcode_ID);
                        wp_redirect($send);
                        exit();
                    }
                }
            }
        }
        if (isset($_GET['page']) && $_GET['page'] == 'bdp_getting_started') {
            if (isset($_POST['savedata'])) {
                $bdp_settings = $_POST;
                if (isset($_POST['bdp-singlefile-submit-nonce']) && wp_verify_nonce($_POST['bdp-singlefile-submit-nonce'], 'bdp-singlefile-form-submit')) {
                    $template = 'bdp_templates/single/single.php';
                    $bdp_settings = apply_filters('bdp_update_single_file_settings', $bdp_settings);
                    $save = update_option('bdp_single_file_template', serialize($bdp_settings));
                    bdp_singlefile_save_template($_POST['singlefile_html'], $template);
                    $bdp_success = __('Single flie updated successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                    do_action('bdp_update_single_file');
                }
            }
        }
    }

    /**
     * Save Archive Template at admin side
     * @global object $wpdb
     * @global WP_Error $bdp_errors
     * @global string $bdp_success
     */
    function bdp_save_admin_archive_template() {
        global $wpdb, $bdp_errors, $bdp_success;
        $archive_table = $wpdb->prefix . "bdp_archives";
        if (isset($_GET['page']) && $_GET['page'] == 'bdp_add_archive_layout') {
            $bdp_settings = $_POST;
            if (!isset($_GET['action']) || $_GET['action'] == '') {
                $user = wp_get_current_user();
                $closed = array('bdpgeneral');
                $closed = array_filter($closed);
                update_user_option($user->ID, 'bdpclosedbdpboxes_bdp_add_archive_layout', $closed, true);
            }
            if (isset($_POST['savedata']) || ( isset($_POST['resetdata']) && $_POST['resetdata'] != '' )) {
                $templates = array();
                if (isset($_POST['bdp-archive-nonce']) && wp_verify_nonce($_POST['bdp-archive-nonce'], 'bdp-archive-page-submit')) {
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $shortcode_ID = $_GET['id'];
                        } else {
                            $shortcode_ID = '';
                        }
                        if (isset($_POST['custom_archive_type']) && $_POST['custom_archive_type'] == 'category_template') {
                            $categories = isset($_POST['template_category']) ? implode(',', $_POST['template_category']) : '';
                        } elseif (isset($_POST['custom_archive_type']) && $_POST['custom_archive_type'] == 'tag_template') {
                            $categories = isset($_POST['template_tags']) ? implode(',', $_POST['template_tags']) : '';
                        } elseif (isset($_POST['custom_archive_type']) && $_POST['custom_archive_type'] == 'author_template') {
                            $categories = isset($_POST['template_author']) ? implode(',', $_POST['template_author']) : '';
                        } else {
                            $categories = '';
                        }
                        $bdp_settings = apply_filters('bdp_update_archive_layout_settings', $bdp_settings);
                        $save = $wpdb->update(
                                $archive_table, array('archive_name' => sanitize_text_field($_POST['archive_name']), 'archive_template' => sanitize_text_field($_POST['custom_archive_type']), 'sub_categories' => $categories, 'settings' => serialize($bdp_settings)), array('ID' => $shortcode_ID), array('%s', '%s', '%s', '%s'), array('%d')
                        );
                        if ($save === FALSE) {
                            $bdp_errors = new WP_Error('save_error', __('Error in updating archive settings.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            if (isset($_POST['resetdata']) && $_POST['resetdata'] != '') {
                                do_action('bdp_reset_archive_page', $shortcode_ID);
                                $bdp_success = __('Archive reset successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else {
                                do_action('bdp_update_archive_page', $shortcode_ID);
                                $bdp_success = __('Archive updated successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                            update_option('bdp_multi_author_selection', 0);
                        }
                    } else {
                        if ($_POST['custom_archive_type'] == 'category_template') {
                            $categories = isset($_POST['template_category']) ? implode(',', $_POST['template_category']) : '';
                        } else if ($_POST['custom_archive_type'] == 'tag_template') {
                            $categories = isset($_POST['template_tags']) ? implode(',', $_POST['template_tags']) : '';
                        } elseif (isset($_POST['custom_archive_type']) && $_POST['custom_archive_type'] == 'author_template') {
                            $categories = isset($_POST['template_author']) ? implode(',', $_POST['template_author']) : '';
                        } else {
                            $categories = '';
                        }
                        $bdp_settings = apply_filters('bdp_add_archive_layout_settings', $bdp_settings);
                        $insert = $wpdb->insert(
                                $archive_table, array('archive_name' => sanitize_text_field($_POST['archive_name']), 'archive_template' => sanitize_text_field($_POST['custom_archive_type']), 'sub_categories' => $categories, 'settings' => serialize($bdp_settings)), array('%s', '%s', '%s', '%s')
                        );
                        if ($insert === FALSE) {
                            wp_die(__('Error in creating archive layout.', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            $message = 'archive_added_msg';
                            $shortcode_ID = $wpdb->insert_id;
                            update_option('bdp_multi_author_selection', 0);
                        }
                        $send = admin_url('admin.php?page=bdp_add_archive_layout&action=edit&id=' . $shortcode_ID);
                        $send = add_query_arg('message', $message, $send);
                        do_action('bdp_add_archive_layout', $shortcode_ID);
                        wp_redirect($send);
                        exit();
                    }
                } else {
                    wp_redirect('?page=layouts');
                }
            }
        }
    }

    /**
     * capability to admin menu
     * @return capability
     */
    private function bdp_manage_blog_design_pro() {
        $manage_options_cap = apply_filters('bdp_manage_blog_designs_capability', 'manage_options');
        return $manage_options_cap;
    }

    /**
     * Delete shortcode
     * @global object $wpdb
     * @global string $bdp_table_name
     */
    public function bdp_delete_admin_template() {
        global $wpdb, $bdp_table_name;
        if (isset($_GET['page']) && $_GET['page'] == 'layouts' && isset($_GET['action']) && $_GET['action'] == 'delete' && wp_verify_nonce($_GET['_wpnonce'])) {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $shortcode_ID = $_GET['id'];
            } else {
                $shortcode_ID = '';
            }
            $bdp_table_name = $wpdb->prefix . 'blog_designer_pro_shortcodes';
            /*
             * Delete Shortcode settings from database
             */
            do_action('bdp_delete_shortcode', $shortcode_ID);
            $bdp_is_delete = $wpdb->delete(
                    $bdp_table_name, array('bdid' => $shortcode_ID)
            );
        }
        /**
         * Delete single template
         */
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && wp_verify_nonce($_GET['_wpnonce']) && isset($_GET['page']) && $_GET['page'] == 'single_layouts') {
            $single_table = $wpdb->prefix . "bdp_single_layouts";
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $shortcode_ID = $_GET['id'];
            } else {
                $shortcode_ID = '';
            }
            do_action('bdp_delete_single_layout', $shortcode_ID);
            $bdp_single_delete = $wpdb->delete(
                    $single_table, array('id' => $shortcode_ID)
            );
        }
    }

    /**
     * Delete archive template
     * @global object $wpdb
     * @global string $archive_table
     */
    public function bdp_delete_archive_template() {
        global $wpdb, $archive_table;
        if (isset($_GET['page']) && $_GET['page'] == 'archive_layouts' && isset($_GET['action']) && $_GET['action'] == 'delete' && wp_verify_nonce($_GET['_wpnonce'])) {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $archive_ID = $_GET['id'];
            } else {
                $archive_ID = '';
            }
            /*
             * Delete archive template settings from database
             */
            do_action('bdp_delete_archive', $archive_ID);
            $bdp_is_delete = $wpdb->delete(
                    $archive_table, array('id' => $archive_ID)
            );
        }
    }

    /**
     * Multiple Deletion of shortcode
     * @global object $wpdb
     * @global string $bdp_table_name
     */
    public function bdp_multiple_delete_admin_template() {
        global $wpdb, $bdp_table_name;
        if (isset($_POST['take_action']) && $_GET['page'] == 'layouts') {
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'delete_pr') || (isset($_POST['bdp-action-top2']) && esc_html($_POST['bdp-action-top2']) == 'delete_pr')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all'])) {
                    $shortcodes = $_POST['chk_remove_all'];

                    if (isset($_GET['page'])) {
                        foreach ($shortcodes as $shortcode) {
                            do_action('bdp_delete_shortcode', $shortcode);
                            $wpdb->delete($bdp_table_name, array('bdid' => $shortcode));
                        }
                    }
                }
            }
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'bdp_export') || (isset($_POST['bdp-action-top2']) && esc_html($_POST['bdp-action-top2']) == 'bdp_export')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all']) && isset($_GET['page']) && $_GET['page'] == 'layouts') {
                    $bdp_table = $wpdb->prefix . "blog_designer_pro_shortcodes";
                    $export_layout = array();
                    $shortcodes = $_POST['chk_remove_all'];
                    foreach ($shortcodes as $shortcode) {
                        $get_data = $wpdb->get_row("SELECT * FROM $bdp_table WHERE bdid = $shortcode", ARRAY_A);
                        do_action('bdp_export_blog_layout_settings', $shortcode);
                        if (!empty($get_data)) {
                            $bdsettings = unserialize($get_data['bdsettings']);
                            $bdsettings['blog_page_display'] = "0";
                            $get_data['bdsettings'] = serialize($bdsettings);
                            $export_layout[] = $get_data;
                        }
                    }
                    if (count($export_layout) > 0) {
                        $output = base64_encode(serialize($export_layout));
                        $this->save_as_txt_file("bdp_layouts.txt", $output);
                    }
                }
            }
        }

        /**
         * Multiple Delete and export single layouts
         */
        $single_table = $wpdb->prefix . "bdp_single_layouts";
        if (isset($_POST['take_action']) && isset($_GET['page']) && $_GET['page'] == 'single_layouts') {
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'delete_pr') || (isset($_POST['bdp-action-top2']) && esc_html($_POST['bdp-action-top2']) == 'delete_pr')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all'])) {
                    $shortcodes = $_POST['chk_remove_all'];
                    foreach ($shortcodes as $shortcode) {
                        do_action('bdp_delete_single_layout', $shortcode);
                        $wpdb->delete($single_table, array('id' => $shortcode));
                    }
                }
            }
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'bdp_export') || (isset($_POST['bdp-action-top2']) && esc_html($_POST['bdp-action-top2']) == 'bdp_export')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all']) && isset($_GET['page']) && $_GET['page'] == 'single_layouts') {
                    $export_layout = array();
                    $shortcodes = $_POST['chk_remove_all'];
                    foreach ($shortcodes as $shortcode) {
                        $get_data = $wpdb->get_row("SELECT * FROM $single_table WHERE id = $shortcode", ARRAY_A);
                        if (!empty($get_data)) {
                            $export_layout[] = $get_data;
                            do_action('bdp_export_single_layout_settings', $shortcode);
                        }
                    }
                    if (count($export_layout) > 0) {
                        $output = base64_encode(serialize($export_layout));
                        $this->save_as_txt_file("bdp_single_layouts.txt", $output);
                    }
                }
            }
        }
    }

    /**
     * Multiple Deletion of archive template
     * @global object $wpdb
     * @global string $archive_table
     */
    public function bdp_multiple_delete_admin_archive_template() {
        global $wpdb, $archive_table;
        if (isset($_POST['take_action']) && $_GET['page'] == 'archive_layouts') {
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'delete_pr') || (isset($_POST['bdp-archive-action']) && esc_html($_POST['bdp-archive-action']) == 'delete_pr')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all'])) {
                    $archives = $_POST['chk_remove_all'];
                    foreach ($archives as $archive) {
                        do_action('bdp_delete_archive', $archive);
                        $wpdb->delete($archive_table, array('id' => $archive));
                    }
                }
            }
            if ((isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'bdp_export') || (isset($_POST['bdp-archive-action']) && esc_html($_POST['bdp-archive-action']) == 'bdp_export')) {
                if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all']) && isset($_GET['page']) && $_GET['page'] == 'archive_layouts') {
                    $export_layout = array();
                    $archives = $_POST['chk_remove_all'];
                    foreach ($archives as $archive) {
                        $get_data = $wpdb->get_row("SELECT * FROM $archive_table WHERE id = $archive", ARRAY_A);
                        do_action('bdp_export_archive_layout_settings', $archive);
                        if (!empty($get_data)) {
                            $export_layout[] = $get_data;
                        }
                    }
                    if (count($export_layout) > 0) {
                        $output = base64_encode(serialize($export_layout));
                        $this->save_as_txt_file("bdp_archive_layouts.txt", $output);
                    }
                }
            }
        }
    }

    /**
     *
     * @param type $file_name
     * @param type file content
     * @return file with content
     */
    public function save_as_txt_file($file_name, $output) {
        header("Content-type: application/text", true, 200);
        header("Content-Disposition: attachment; filename=$file_name");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $output;
        exit;
    }

    /**
     * add shortcode in page
     * @global type $pagenow
     * @global object $wpdb
     */
    function bdp_admin_footer() {
        global $pagenow;
        // Only run in post/page creation and edit screens
        if (in_array($pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php'))) {
            global $wpdb;
            //Get the slider information
            $shortcodes = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes ORDER BY bdid DESC');
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    jQuery('#insertBlogdesignerShortcode').on('click', function () {
                        var id = jQuery('#blogdesigner-select option:selected').val();
                        window.send_to_editor('[wp_blog_designer id="' + id + '"]');
                        tb_remove();
                    });
                });
            </script>

            <div id="choose-blogdesigner-shortcode" style="display: none;">
                <div class="wrap">
                    <?php
                    if (count($shortcodes)) {
                        echo "<h3 style='margin-bottom: 20px;'>" . __("Insert Blog Designer Shortcode", BLOGDESIGNERPRO_TEXTDOMAIN) . "</h3>";
                        echo "<select id='blogdesigner-select'>";
                        echo "<option disabled=disabled>" . __("Choose shortcode", BLOGDESIGNERPRO_TEXTDOMAIN) . "</option>";
                        foreach ($shortcodes as $shortcode) {
                            if ($shortcode->shortcode_name != '') {
                                $shortcode_name = $shortcode->shortcode_name;
                            } else {
                                $shortcode_name = __('no title', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                            echo "<option value='{$shortcode->bdid}'>" . $shortcode_name . "</option>";
                        }
                        echo "</select>";
                        echo "<button class='button primary' id='insertBlogdesignerShortcode'>" . __("Insert Shortcode", BLOGDESIGNERPRO_TEXTDOMAIN) . "</button>";
                    } else {
                        _e("No shortcodes found", BLOGDESIGNERPRO_TEXTDOMAIN);
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }

    /**
     * add add shortcode button
     * @param html $context
     * @global string $pagenow
     * @return String Button above visual text editor
     */
    function bdp_insert_button($context) {

        global $pagenow;

        if (in_array($pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php'))) {
            $context .= '<a href="#TB_inline?&inlineId=choose-blogdesigner-shortcode" class="thickbox button" title="' .
                    __("Select blog designer shortcode", BLOGDESIGNERPRO_TEXTDOMAIN) .
                    '"><span class="wp-media-buttons-icon" style="background: url(' . BLOGDESIGNERPRO_URL .
                    '/images/blog-designer-pro.png); background-repeat: no-repeat; background-position: left bottom;background-size:90% auto;"></span> ' .
                    __("Add Blog Designer Shortcode", BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
        }

        return $context;
    }

    /**
     * add per page option in screen option in single post templates list
     * @global string $bdp_screen_option_page
     */
    public function bdp_screen_options() {

        global $bdp_screen_option_page;
        $screen = get_current_screen();

        // get out of here if we are not on our settings page
        if (!is_object($screen) || $screen->id != $bdp_screen_option_page)
            return;

        $args = array(
            'label' => __('Number of items per page:', BLOGDESIGNERPRO_TEXTDOMAIN),
            'default' => 10,
            'option' => 'bdp_per_page'
        );
        add_screen_option('per_page', $args);
    }

    /**
     *
     * add per page option in screen option in archive list
     * @global string $bdp_screen_option_page
     */
    public function bdp_screen_options_archive() {

        global $bdp_screen_option_archive_page;
        $screen = get_current_screen();

        // get out of here if we are not on our settings page
        if (!is_object($screen) || $screen->id != $bdp_screen_option_archive_page)
            return;

        $args = array(
            'label' => __('Number of items per page:', BLOGDESIGNERPRO_TEXTDOMAIN),
            'default' => 10,
            'option' => 'bdp_per_page'
        );
        add_screen_option('per_page', $args);
    }

    /**
     *
     * add per page option in screen option in archive list
     * @global string $bdp_screen_option_page
     */
    public function bdp_screen_options_single() {

        global $bdp_single_screen;
        $screen = get_current_screen();

        // get out of here if we are not on our settings page
        if (!is_object($screen) || $screen->id != $bdp_single_screen)
            return;

        $args = array(
            'label' => __('Number of items per page:', BLOGDESIGNERPRO_TEXTDOMAIN),
            'default' => 10,
            'option' => 'bdp_per_page_single'
        );
        add_screen_option('per_page', $args);
    }

    /**
     *
     * @param type $status
     * @param type $option
     * @param type $value
     * @return type
     */
    function bdp_set_screen_option($status, $option, $value) {
        if ('bdp_per_page' == $option)
            return $value;
    }

    /**
     *
     * @param type $status
     * @param type $option
     * @param type $value
     * @return type
     */
    function bdp_set_screen_option_single($status, $option, $value) {
        if ('bdp_per_page_single' == $option)
            return $value;
    }

    function bdp_admin_notice_dismiss() {
        ?>
        <script id="bdp_admin_notice_dismiss" type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('.bdp-admin-notice-pro-layouts').on('click', function () {
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: {
                            action: 'bdp_layouts_notice_dismissible',
                        }
                    });
                });
            });
        </script>
        <?php
    }

    /**
     * import layouts
     * @global string $import_success
     * @global object $wpdb
     */
    public function bdp_upload_import_file() {
        if (!empty($_POST) && !empty($_FILES['bdp_import']) && check_admin_referer('bdp_import', 'bdp_import_nonce')) { // check_admin_referer prints fail page and dies
            global $import_success, $wpdb, $import_error;
            // Uploaded file
            $uploaded_file = $_FILES['bdp_import'];
            if (isset($_POST['layout_import_types']) && $_POST['layout_import_types'] == '') {
                $import_error = __('You must have to select import type', BLOGDESIGNERPRO_TEXTDOMAIN);
                return;
            }

            // Check file type
            $mimes = array(
                'txt' => 'text/plain',
            );
            $bdp_filetype = wp_check_filetype($uploaded_file['name'], $mimes);
            if ('txt' != $bdp_filetype['ext'] && !wp_match_mime_types('txt', $bdp_filetype['type'])) {
                $import_error = __('You must upload a .txt file generated by this plugin.', BLOGDESIGNERPRO_TEXTDOMAIN);
                return;
            }

            //Upload file and check uploading error
            $file_data = wp_handle_upload($uploaded_file, array('test_type' => FALSE, 'test_form' => FALSE));
            if (isset($file_data['error'])) {
                $import_error = $file_data['error'];
                return;
            }

            //Check file exists or not
            if (!file_exists($file_data['file'])) {
                $import_error = __('Import file could not be found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
                return;
            }

            $content = $this->import_layouts($file_data['file']);
            if ($content) {
                if (isset($_POST['layout_import_types']) && $_POST['layout_import_types'] == 'blog_layouts') {
                    $table_name = $wpdb->prefix . "blog_designer_pro_shortcodes";
                    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                        foreach ($content as $single_content) {
                            $shortcode_name = isset($single_content['shortcode_name']) ? $single_content['shortcode_name'] : '';
                            $bdsettings = isset($single_content['bdsettings']) ? $single_content['bdsettings'] : '';
                            $blog_layout_id = $wpdb->insert(
                                    $table_name, array(
                                'shortcode_name' => $shortcode_name,
                                'bdsettings' => $bdsettings,
                                    )
                            );
                            do_action('bdp_import_blog_layout_settings', $shortcode_name);
                        }
                        $import_success = __('Blog Layout imported successfully', BLOGDESIGNERPRO_TEXTDOMAIN);
                    } else {
                        $import_error = __('Table not found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
                        return;
                    }
                }
                if (isset($_POST['layout_import_types']) && $_POST['layout_import_types'] == 'archive_layouts') {
                    $table_name = $wpdb->prefix . "bdp_archives";
                    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

                        foreach ($content as $single_content) {
                            $archive_name = isset($single_content['archive_name']) ? $single_content['archive_name'] : '';
                            $archive_template = isset($single_content['archive_template']) ? $single_content['archive_template'] : '';
                            $sub_categories = isset($single_content['sub_categories']) ? $single_content['sub_categories'] : '';
                            $bdp_settings = isset($single_content['settings']) ? $single_content['settings'] : '';

                            if ($archive_template == 'search_template' || $archive_template == 'date_template') {
                                $where = "WHERE archive_template = '" . $archive_template . "'";
                                $archives_count = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives ' . $where);
                                $archive_table = $wpdb->prefix . 'bdp_archives';

                                if ($archives_count > 0) {
                                    $wpdb->update(
                                            $archive_table, array(
                                        'archive_name' => $archive_name,
                                        'sub_categories' => $sub_categories,
                                        'settings' => $bdp_settings,
                                            ), array('archive_template' => $archive_template,)
                                    );
                                } else {
                                    $wpdb->insert(
                                            $table_name, array(
                                        'archive_name' => $archive_name,
                                        'archive_template' => $archive_template,
                                        'sub_categories' => $sub_categories,
                                        'settings' => $bdp_settings,
                                            )
                                    );
                                }
                            } else {
                                $where = "WHERE sub_categories = '" . $sub_categories . "'";
                                $archives_count = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives ' . $where);
                                if ($archives_count > 0) {
                                    $archive_table = $wpdb->prefix . 'bdp_archives';
                                    $wpdb->update(
                                            $archive_table, array(
                                        'archive_name' => $archive_name,
                                        'archive_template' => $archive_template,
                                        'settings' => $bdp_settings,
                                            ), array('sub_categories' => $sub_categories,)
                                    );
                                } else {
                                    $wpdb->insert(
                                            $table_name, array(
                                        'archive_name' => $archive_name,
                                        'archive_template' => $archive_template,
                                        'sub_categories' => $sub_categories,
                                        'settings' => $bdp_settings,
                                            )
                                    );
                                }
                            }
                        }
                        do_action('bdp_import_archive_layout_settings', $archive_name);
                        $import_success = __('Archive Layout imported successfully', BLOGDESIGNERPRO_TEXTDOMAIN);
                    } else {
                        $import_error = __('Table not found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
                        return;
                    }
                }
                /**
                 * Import Single post layouts
                 */
                if (isset($_POST['layout_import_types']) && $_POST['layout_import_types'] == 'single_layouts') {
                    $table_name = $wpdb->prefix . "bdp_single_layouts";
                    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

                        foreach ($content as $single_content) {
                            $single_name = isset($single_content['single_name']) ? $single_content['single_name'] : '';
                            $single_template = isset($single_content['single_template']) ? $single_content['single_template'] : '';
                            $sub_categories = isset($single_content['sub_categories']) ? $single_content['sub_categories'] : '';
                            $single_post_id = isset($single_content['single_post_id']) ? $single_content['single_post_id'] : '';
                            $bdp_settings = isset($single_content['settings']) ? $single_content['settings'] : '';
                            do_action('bdp_import_single_layout_settings', $single_name);

                            if ($single_template == 'all') {
                                $where = "WHERE single_template = '" . $single_template . "'";
                                $single_count = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_single_layouts ' . $where);
                                $single_table = $wpdb->prefix . 'bdp_single_layouts';

                                if ($single_count > 0) {
                                    $wpdb->update(
                                            $single_table, array(
                                        'single_name' => $single_name,
                                        'sub_categories' => $sub_categories,
                                        'single_post_id' => $single_post_id,
                                        'settings' => $bdp_settings,
                                            ), array('single_template' => $single_template,)
                                    );
                                } else {
                                    $wpdb->insert(
                                            $table_name, array(
                                        'single_name' => $single_name,
                                        'single_template' => $single_template,
                                        'sub_categories' => $sub_categories,
                                        'single_post_id' => $single_post_id,
                                        'settings' => $bdp_settings,
                                            )
                                    );
                                }
                            } else {
                                $where = "WHERE single_post_id = '" . $single_post_id . "'";
                                $single_count = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_single_layouts ' . $where);
                                if ($single_count > 0) {
                                    $single_table = $wpdb->prefix . 'bdp_single_layouts';
                                    $wpdb->update(
                                            $single_table, array(
                                        'single_name' => $single_name,
                                        'single_template' => $single_template,
                                        'sub_categories' => $sub_categories,
                                        'single_post_id' => $single_post_id,
                                        'settings' => $bdp_settings,
                                            ), array('single_post_id' => $single_post_id)
                                    );
                                } else {
                                    $wpdb->insert(
                                            $table_name, array(
                                        'single_name' => $single_name,
                                        'single_template' => $single_template,
                                        'sub_categories' => $sub_categories,
                                        'single_post_id' => $single_post_id,
                                        'settings' => $bdp_settings,
                                            )
                                    );
                                }
                            }
                        }
                        $import_success = __('Single Layout imported successfully', BLOGDESIGNERPRO_TEXTDOMAIN);
                    } else {
                        $import_error = __('Table not found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
                        return;
                    }
                }
            }
        }
    }

    /**
     * import layouts
     * @return unserialized content
     */
    public function import_layouts($file) {
        global $import_error;
        if (file_exists($file)) {
            $file_content = $this->bdp_file_contents($file);
            //if ($file_content) {
            if ($file_content) {
                $unserialized_content = unserialize(base64_decode($file_content));
                if ($unserialized_content) {
                    return $unserialized_content;
                }
            } else {
                $import_error = __('Import file is empty. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
                return;
            }
        } else {
            $import_error = __('Import file could not be found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN);
            return;
        }
    }

    /**
     *
     * @param string $path
     * @return string $bdp_content
     */
    public function bdp_file_contents($path) {
        $bdp_content = '';
        if (function_exists('realpath'))
            $filepath = realpath($path);
        if (!$filepath || !@is_file($filepath))
            return '';

        if (ini_get('allow_url_fopen')) {
            $bdp_file_method = 'fopen';
        } else {
            $bdp_file_method = 'file_get_contents';
        }
        if ($bdp_file_method == 'fopen') {
            $bdp_handle = fopen($filepath, 'rb');

            if ($bdp_handle !== false) {
                while (!feof($bdp_handle)) {
                    $bdp_content .= fread($bdp_handle, 8192);
                }
                fclose($bdp_handle);
            }
            return $bdp_content;
        } else {
            return file_get_contents($filepath);
        }
    }

    /**
     * replace alt and title tag
     * @param html $text
     * @return html $text
     */
    public function bdp_replace_content($text) {
        $alt = get_the_author_meta('display_name');
        $text = str_replace('alt=\'\'', 'alt=\'' . $alt . '\' title=\'' . $alt . '\'', $text);
        return $text;
    }

    /**
     * replace alt and title tag
     * @param html $text
     * @return html $text
     */
    public function bdp_template_name_changed_updater() {
        ?>
        <div class="updated">
            <p>
                <strong>
                    <?php _e('Blog Designer PRO Data Update', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                </strong> &#8211; <?php _e('We need to update your layouts design data according to the latest version.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            </p>
            <p class="submit">
                <a href="<?php echo esc_url(add_query_arg('do_update_bdp_template_name_changed', 'do', $_SERVER['REQUEST_URI'])); ?>" class="bdp-template-chnage-now button-primary">
                    <?php _e('Run the updater', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                </a>
            </p>
        </div>
        <script type="text/javascript">
            jQuery('.bdp-template-chnage-now').click('click', function () {
                return window.confirm('<?php echo esc_js(__('It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', BLOGDESIGNERPRO_TEXTDOMAIN)); ?>');
            });
        </script>
        <?php
    }

}

new BdpAdminFunction();

/**
 * Funtion to display color preset
 */
function bdp_admin_color_preset($display_color) {
    $color_value = explode(',', $display_color);
    $fcolor = $color_value[0];
    $scolor = $color_value[1];
    $tcolor = $color_value[2];
    $fourthcolor = $color_value[3];
    ?>
    <div class="color-palette">
        <span style="background-color:<?php echo $fcolor; ?>"></span>
        <span style="background-color:<?php echo $scolor; ?>"></span>
        <span style="background-color:<?php echo $tcolor; ?>"></span>
        <span style="background-color:<?php echo $fourthcolor; ?>"></span>
    </div>
    <?php
}