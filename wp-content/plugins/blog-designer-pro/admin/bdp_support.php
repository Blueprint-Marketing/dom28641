<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

//$plugin_lists = get_plugins();
//echo '<pre>'; print_r($plugin_lists); exit;

/* * ********************************************* */
/*                                                 */
/*              Beaver Builder Lite                */
/*                                                 */
/* * ********************************************* */
if (is_plugin_active('beaver-builder-lite-version/fl-builder.php')) {

    if (!function_exists('add_bdp_widget')) {

        function add_bdp_widget() {
            ?>
            <div id="fl-builder-blocks-bdp-widget" class="fl-builder-blocks-section">
                <span class="fl-builder-blocks-section-title">
                    <?php _e('Blog Designer', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                    <i class="fas fa-chevron-down"></i>
                </span>
                <div class="fl-builder-blocks-section-content fl-builder-modules">
                    <span class="fl-builder-block fl-builder-block-module" data-widget="BDP_Widget_BlogDesignerPro" data-type="widget">
                        <span class="fl-builder-block-title"><?php _e('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN) ?></span>
                    </span>
                </div>
            </div>
            <?php
        }

    }
    add_action('fl_builder_ui_panel_after_modules', 'add_bdp_widget');
}


/* * ********************************************* */
/*                                                 */
/*          Page Builder by SiteOrigin             */
/*                                                 */
/* * ********************************************* */
if (is_plugin_active('siteorigin-panels/siteorigin-panels.php')) {

    function siteorigin_panels_add_widgets_dialog_tabs_fun($tabs) {
        $tabs['blog_designer'] = array(
            'title' => __('Blog Designer', 'siteorigin-panels'),
            'filter' => array(
                'groups' => array('blog_designer')
            )
        );
        return $tabs;
    }

    add_filter('siteorigin_panels_widget_dialog_tabs', 'siteorigin_panels_add_widgets_dialog_tabs_fun', 20);

    function siteorigin_panels_add_recommended_widgets_fun($widgets) {
        foreach ($widgets as $widget_id => &$widget) {
            if (strpos($widget_id, 'BDP_Widget_') === 0 || strpos($widget_id, 'blog_designer_pro_widget') !== FALSE) {
                $widget['groups'][] = 'blog_designer';
                $widget['icon'] = 'bdp_icon';
            }
        }
        return $widgets;
    }

    add_filter('siteorigin_panels_widgets', 'siteorigin_panels_add_recommended_widgets_fun');
}

if (is_plugin_active('siteorigin-panels/siteorigin-panels.php')) {
    add_action('admin_enqueue_scripts', 'bdp_suuport_script');

    function bdp_suuport_script() {
        wp_enqueue_style('bdp_support_css', plugins_url('blog-designer-pro/admin/css/bdp_support.css'));
    }

}


/* * ********************************************* */
/*                                                 */
/*                Fusion Builder                   */
/*                                                 */
/* * ********************************************* */
if (is_plugin_active('fusion-builder/fusion-builder.php')) {
    if (!function_exists('fusion_element_bdp')) {

        function fusion_element_bdp() {
            global $wpdb;
            $shortcodes = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes ');
            $bdp_layouts = array();
            if ($shortcodes) {
                foreach ($shortcodes as $shortcode) {
                    $bdp_layouts[$shortcode->shortcode_name] = $shortcode->bdid;
                }
            }
            fusion_builder_map(array(
                'name' => esc_attr__('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN),
                'shortcode' => 'wp_blog_designer',
                'icon' => 'bdp_icon',
                'params' => array(
                    array(
                        'type' => 'select',
                        'heading' => esc_attr__('Select Layout', BLOGDESIGNERPRO_TEXTDOMAIN),
                        'param_name' => 'id',
                        'default' => '',
                        'value' => $bdp_layouts
                    ),
                ),
                    )
            );
        }

    }
    add_action('fusion_builder_before_init', 'fusion_element_bdp');
}



/* * ********************************************* */
/*                                                 */
/*             Fusion Page Builder                 */
/*                                                 */
/* * ********************************************* */

if (is_plugin_active('fusion/fusion-core.php')) {

    add_action('init', 'fsn_init_bdp', 12);

    if (!function_exists('fsn_init_bdp')) {

        function fsn_init_bdp() {
            if (function_exists('fsn_map')) {
                global $wpdb;
                $shortcodes = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes ');
                $bdp_layouts = array();
                if ($shortcodes) {
                    foreach ($shortcodes as $shortcode) {
                        $bdp_layouts[$shortcode->bdid] = $shortcode->shortcode_name;
                    }
                }
                fsn_map(array(
                    'name' => __('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN),
                    'shortcode_tag' => 'fsn_blog_designer_pro',
                    'description' => __('Blog Designer is a step ahead wordpress plugin that allows you to modify blog page, single page and archive page layouts and design.', BLOGDESIGNERPRO_TEXTDOMAIN),
                    'icon' => 'fsn_blog',
                    'params' => array(
                        array(
                            'type' => 'select',
                            'param_name' => 'id',
                            'label' => __('Select Blog Designer Layout', BLOGDESIGNERPRO_TEXTDOMAIN),
                            'options' => $bdp_layouts,
                        )
                    )
                ));
            }
        }

    }

    add_shortcode('fsn_blog_designer_pro', 'fsn_blog_designer_pro_shortcode');

    if (!function_exists('fsn_blog_designer_pro_shortcode')) {

        function fsn_blog_designer_pro_shortcode($atts, $content) {

            ob_start();
            ?>
            <div class="fsn-bdp <?php echo fsn_style_params_class($atts); ?>">
                <?php echo do_shortcode('[wp_blog_designer id="' . $atts['id'] . '"]'); ?>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

    }
}
