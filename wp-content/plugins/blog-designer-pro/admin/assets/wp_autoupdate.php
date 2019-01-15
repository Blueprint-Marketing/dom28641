<?php

class bdp_wp_auto_update {

    /**
     * The plugin current version
     * @var string
     */
    public $current_version;

    /**
     * The plugin remote update path
     * @var string
     */
    public $update_path;

    /**
     * Plugin Slug (plugin_directory/plugin_file.php)
     * @var string
     */
    public $plugin_slug;

    /**
     * Plugin name (plugin_file)
     * @var string
     */
    public $slug;

    /**
     * Initialize a new instance of the WordPress Auto-Update class
     * @param string $current_version
     * @param string $update_path
     * @param string $plugin_slug
     */
    function __construct() {
        $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/blog-designer-pro/blog-designer-pro.php', $markup = true, $translate = true);
        // Set the class public variables
        $this->current_version = $plugin_data['Version'];
        $this->update_path = 'https://www.solwininfotech.com/sollicweb/blog_designer_pro_check_purchase_code_tf.php';
        $this->plugin_slug = 'blog-designer-pro/blog-designer-pro.php';
        list ($t1, $t2) = explode('/', $this->plugin_slug);
        $this->slug = str_replace('.php', '', $t2);
        // define the alternative API for updating checking
        add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_update'));
        // Define the alternative response for information checking
        add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
    }

    function update_license($username, $purchase_code) {
        $return = $this->getRemote_license($username, $purchase_code);
        if ($return == 'correct') {
            update_option('bdp_username', $username);
            update_option('bdp_purchase_code', $purchase_code);
        }
        return $return;
    }

    /**
     * Add our self-hosted autoupdate plugin to the filter transient
     *
     * @param $transient
     * @return object $transient
     */
    public function check_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }
        if ($this->getRemote_license() == 'correct') {
            // Get the remote version
            $remote_version = $this->getRemote_version();

            // If a newer version is available, add the update
            if (version_compare($this->current_version, $remote_version, '<')) {
                $obj = new stdClass();
                $obj->slug = $this->slug;
                $obj->new_version = $remote_version;
                $obj->url = $this->update_path;
                $obj->package = $this->update_path;
                $transient->response[$this->plugin_slug] = $obj;
            }
        }
        return $transient;
    }

    /**
     * Add our self-hosted description to the filter
     *
     * @param boolean $false
     * @param array $action
     * @param object $arg
     * @return bool|object
     */
    public function check_info($false, $action, $arg) {
        if ($this->getRemote_license() == 'correct') {
            if(isset($arg->slug)) {
                if ($arg->slug === $this->slug) {
                    $information = $this->getRemote_information();
                    return $information;
                }
            }
        }
        return false;
    }

    /**
     * Return the remote version
     * @return string $remote_version
     */
    public function getRemote_version() {
        $request = wp_remote_post($this->update_path, array('body' => array('action' => 'version', 'product' => $this->slug)));
        if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
            return $request['body'];
        }
        return false;
    }

    /**
     * Return the changelog
     * @return string $changelog
     */
    public function getRemote_changelog() {
        $request = wp_remote_post($this->update_path, array('body' => array('action' => 'changelog', 'product' => $this->slug)));
        if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
            return $request['body'];
        }
        return false;
    }

    /**
     * Get information about the remote version
     * @return bool|object
     */
    public function getRemote_information() {
        $request = wp_remote_post($this->update_path, array('body' => array('action' => 'info', 'product' => $this->slug)));
        if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
            return unserialize($request['body']);
        }
        return false;
    }

    /**
     * Return the status of the plugin licensing
     * @return boolean $remote_license
     */
    public function getRemote_license($username = '', $purchase_code = '') {
        if ($username == '') {
            $username = get_option('bdp_username');
        }
        if ($purchase_code == '') {
            $purchase_code = get_option('bdp_purchase_code');
        }
        $site_url = get_site_url();
        $request = wp_remote_post($this->update_path, array('body' => array('action' => 'license', 'plugin_name' => $this->slug, 'site_url' => $site_url, 'username' => $username, 'purchase_code' => $purchase_code)));
        if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
            return $request['body'];
        }
        return false;
    }

    public function deregister_site($username, $purchase_code) {
        $site_url = get_site_url();
        $request = wp_remote_post($this->update_path, array('body' => array('action' => 'unregister', 'plugin_name' => $this->slug, 'site_url' => $site_url, 'username' => $username, 'purchase_code' => $purchase_code)));
        if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
            $return = $request['body'];
            if ($return == 'success') {
                delete_option('bdp_username');
                delete_option('bdp_purchase_code');
            }
        }
        return $return;
    }

}
