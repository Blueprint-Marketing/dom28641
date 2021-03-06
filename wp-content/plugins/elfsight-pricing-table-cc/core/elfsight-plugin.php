<?php

if (!defined('ABSPATH')) exit;


require_once(plugin_dir_path(__FILE__) . '/includes/update.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widgets-api.php');
require_once(plugin_dir_path(__FILE__) . '/includes/admin.php');
require_once(plugin_dir_path(__FILE__) . '/includes/widget.php');
require_once(plugin_dir_path(__FILE__) . '/includes/vc-element.php');

if (!class_exists('ElfsightPlugin')) {
    class ElfsightPlugin {
        private $name;
        private $slug;
        private $version;
        private $textDomain;
        private $editorSettings;
        private $scriptUrl;

        private $pluginFile;
        private $pluginSlug;

        private $updateUrl;

        private $purchaseCode;

        private $update;
        private $widgetsApi;
        private $admin;
        private $widget;
        private $vcElement;

        private $isShortcodePresent;

        public function __construct($config) {
            $this->name = $config['name'];
            $this->slug = $config['slug'];
            $this->version = $config['version'];
            $this->textDomain = $config['text_domain'];
            $this->editorSettings = $config['editor_settings'];
            $this->scriptUrl = $config['script_url'];

            $this->pluginFile = $config['plugin_file'];
            $this->pluginSlug = $config['plugin_slug'];

            $this->updateUrl = $config['update_url'];

            $this->purchaseCode = get_option($this->getOptionName('purchase_code'), '');

            $this->update = new ElfsightPluginUpdate($this->updateUrl, $this->version, $this->pluginSlug, $this->purchaseCode);
            $this->widgetsApi = new ElfsightWidgetsApi($this->slug, $this->pluginFile, $this->textDomain);
            $this->admin = new ElfsightPluginAdmin($config, $this->widgetsApi);
            $this->widget = new ElfsightWidget($config, $this->widgetsApi);
            $this->vcElement = new ElfsightVCElement($config, $this->widgetsApi);

            add_action('wp_footer', array($this, 'printAssets'));
            add_shortcode(str_replace('-', '_', $this->slug), array($this, 'addShortcode'));
            add_action('plugin_action_links_' . $this->pluginSlug, array($this, 'addPluginActionLinks'));
            add_action('widgets_init', array($this, 'registerWidget'));
        }

        public function printAssets() {
            $force_script_add = get_option($this->getOptionName('force_script_add'));

            $uploads_dir_params = wp_upload_dir();
            $uploads_dir = $uploads_dir_params['basedir'] . '/' . $this->slug;
            $uploads_url = $uploads_dir_params['baseurl'] . '/' . $this->slug;

            wp_register_script($this->slug, $this->scriptUrl, array(), $this->version);
            wp_register_script($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.js', array(), $this->version);
    
            wp_register_style($this->slug . '-custom', $uploads_url . '/' . $this->slug . '-custom.css', array(), $this->version);        

            if ($this->isShortcodePresent || $force_script_add === 'on') {
                $custom_css_path = $uploads_dir . '/' . $this->slug . '-custom.css';
                $custom_js_path = $uploads_dir . '/' . $this->slug . '-custom.js';

                wp_print_scripts($this->slug);

                if (is_readable($custom_js_path) && filesize($custom_js_path) > 0) {
                    wp_print_scripts($this->slug . '-custom');
                }

                if (is_readable($custom_css_path) && filesize($custom_css_path) > 0) {
                    wp_print_styles($this->slug . '-custom');
                }
            }
        }

        public function recursiveDefaults($properties, $defaults){
            foreach($properties as $property) {
                if ($property['type'] == 'subgroup') {
                    $defaults = $this->recursiveDefaults($property['subgroup']['properties'], $defaults);
                } else {
                    $defaults[$property['id']] = !empty($property['defaultValue']) ? $property['defaultValue'] : null;
                }
            }

            return $defaults;
        }

        public function addShortcode($atts) {
            $this->isShortcodePresent = true;

            $defaults = array();

            $defaults = $this->recursiveDefaults($this->editorSettings['properties'], $defaults);
            
            if (!empty($atts['id'])) {
                $widget_options = $this->getWidgetOptions($atts['id']);

                $atts = array_combine(
                    array_merge(array_keys($widget_options), array_keys($atts)),
                    array_merge(array_values($widget_options), array_values($atts))
                );

                unset($atts['id']);
            }

            $options = shortcode_atts($defaults, $atts, str_replace('-', '_', $this->slug));
            $optionsString = rawurlencode(json_encode($options));

            $result = '<div data-' . $this->slug . '-options="' . $optionsString . '"></div>';

            return $result;
        }

        function registerWidget() {
            if (!empty($this->widget)) {
                register_widget($this->widget);
            }
        }

        public function addPluginActionLinks($links) {
            $links[] = '<a href="' . esc_url(admin_url('admin.php?page=' . $this->slug)) . '">Settings</a>';
            $links[] = '<a href="http://codecanyon.net/user/elfsight/portfolio?ref=Elfsight" target="_blank">More plugins by Elfsight</a>';

            return $links;
        }

        private function getWidgetOptions($id) {
            global $wpdb;

            $id = intval($id);

            $widgets_table_name = $this->widgetsApi->getTableName();
            $select_sql = '
                SELECT options FROM `' . esc_sql($widgets_table_name) . '`
                WHERE `id` = "' . esc_sql($id) . '" and `active` = "1"
            ';

            $item = $wpdb->get_row($select_sql, ARRAY_A);
            $options = !empty($item['options']) ? json_decode($item['options'], true) : array();

            return $options;
        }

        private function getOptionName($name) {
            return str_replace('-', '_', $this->slug) . '_' . $name;
        }
    }
}

?>