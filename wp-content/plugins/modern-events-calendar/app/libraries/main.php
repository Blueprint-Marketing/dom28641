<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * Webnus MEC main class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_main extends MEC_base
{
    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
    }
    
    /**
     * Returns the archive URL of events for provided skin
     * @author Webnus <info@webnus.biz>
     * @param string $skin
     * @return string
     */
    public function archive_URL($skin)
    {
        return $this->URL('site').$this->get_main_slug().'/'.$skin.'/';
    }
    
    /**
     * Returns full current URL of WordPress
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_full_url()
	{
		// get $_SERVER
		$server = $this->getRequest()->get('SERVER');
		
        // Check protocol
		$page_url = 'http';
		if(isset($server['HTTPS']) and $server['HTTPS'] == 'on') $page_url .= 's';
		
        // Get domain
        $site_domain = (isset($server['HTTP_HOST']) and trim($server['HTTP_HOST']) != '') ? $server['HTTP_HOST'] : $server['SERVER_NAME'];
        
		$page_url .= '://';
		$page_url .= $site_domain.$server['REQUEST_URI'];
		
        // Return full URL
		return $page_url;
	}
    
    /**
     * Get domain of a certain URL
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @return string
     */
    public function get_domain($url = NULL)
	{
        // Get current URL
        if(is_null($url)) $url = $this->get_full_url();
        
		$url = str_replace('http://', '', $url);
		$url = str_replace('https://', '', $url);
		$url = str_replace('ftp://', '', $url);
		$url = str_replace('svn://', '', $url);
        $url = str_replace('www.', '', $url);
		
		$ex = explode('/', $url);
		$ex2 = explode('?', $ex[0]);
		
		return $ex2[0];
	}
    
    /**
     * Remove query string from the URL
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param string $url
     * @return string
     */
    public function remove_qs_var($key, $url = '')
	{
		if(trim($url) == '') $url = $this->get_full_url();
		
		$url = preg_replace('/(.*)(\?|&)'.$key.'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
		$url = substr($url, 0, -1);
        
		return $url;
	}
    
    /**
     * Add query string to the URL
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param string $value
     * @param string $url
     * @return string
     */
	public function add_qs_var($key, $value, $url = '')
	{
		if(trim($url) == '') $url = $this->get_full_url();
		
		$url = preg_replace('/(.*)(\?|&)'.$key.'=[^&]+?(&)(.*)/i', '$1$2$4', $url.'&');
		$url = substr($url, 0, -1);
		
		if(strpos($url, '?') === false)
			return $url.'?'.$key.'='.$value;
		else
			return $url.'&'.$key.'='.$value;
	}
    
    /**
     * Add multiple query strings to the URL
     * @author Webnus <info@webnus.biz>
     * @param array $vars
     * @param string $url
     * @return string
     */
    public function add_qs_vars($vars, $url = '')
	{
		if(trim($url) == '') $url = $this->get_full_url();
		
		foreach($vars as $key=>$value) $url = $this->add_qs_var($key, $value, $url);
        return $url;
	}
    
    /**
     * Returns WordPress authors
     * @author Webnus <info@webnus.biz>
     * @param array $args
     * @return array
     */
    public function get_authors($args = array())
	{
		return get_users($args);
	}
    
    /**
     * Returns full URL of an asset
     * @author Webnus <info@webnus.biz>
     * @param string $asset
     * @return string
     */
	public function asset($asset)
	{
		return $this->URL('MEC').'assets/'.$asset;
	}
    
    /**
     * Returns URL of WordPress items such as site, admin, plugins, MEC plugin etc.
     * @author Webnus <info@webnus.biz>
     * @param string $type
     * @return string
     */
	public function URL($type = 'site')
	{
		// Make it lowercase
		$type = strtolower($type);
		
        // Frontend
		if(in_array($type, array('frontend','site'))) $url = site_url().'/';
        // Backend
		elseif(in_array($type, array('backend','admin'))) $url = admin_url();
        // WordPress Content directory URL
		elseif($type == 'content') $url = content_url().'/';
        // WordPress plugins directory URL
		elseif($type == 'plugin') $url = plugins_url().'/';
        // WordPress include directory URL
		elseif($type == 'include') $url = includes_url();
        // Webnus MEC plugin URL
		elseif($type == 'mec')
		{
            // If plugin installed regularly on plugins directory
			if(!defined('MEC_IN_THEME')) $url = plugins_url().'/'._MEC_DIRNAME_.'/';
            // If plugin embeded into one theme
			else $url = get_template_directory_uri().'/plugins/'._MEC_DIRNAME_.'/';
		}
		
		return $url;
	}
    
    /**
     * Returns plugin absolute path
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_plugin_path()
    {
        return _MEC_ABSPATH_;
    }
    
    /**
     * Returns a WordPress option
     * @author Webnus <info@webnus.biz>
     * @param string $option
     * @param mixed $default
     * @return mixed
     */
    public function get_option($option, $default = NULL)
    {
        return get_option($option, $default);
    }
    
    /**
     * Returns WordPress categories based on arguments
     * @author Webnus <info@webnus.biz>
     * @param array $args
     * @return array
     */
    public function get_categories($args = array())
    {
        return get_categories($args);
    }
    
    /**
     * Returns WordPress tags based on arguments
     * @author Webnus <info@webnus.biz>
     * @param array $args
     * @return array
     */
    public function get_tags($args = array())
    {
        return get_tags($args);
    }
    
    /**
     * Convert location string to latitude and longitude
     * @author Webnus <info@webnus.biz>
     * @param string $address
     * @return array
     */
    public function get_lat_lng($address)
	{
		$address = urlencode($address);
        
        // MEC Settings
        $settings = $this->get_settings();
        
		$url1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address.((isset($settings['google_maps_api_key']) and trim($settings['google_maps_api_key']) != '') ? '?key='.$settings['google_maps_api_key'] : '');
		$url2 = 'http://www.datasciencetoolkit.org/maps/api/geocode/json?sensor=false&address='.$address;

		/** getting lat and lng using first url **/
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url1);
		curl_setopt($ch, CURLOPT_HEADER, 0); /** Change this to a 1 to return headers **/
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		
		$data = curl_exec($ch);
		$data = json_decode($data, true);
		
		$location_point = isset($data['results'][0]) ? $data['results'][0]['geometry']['location'] : NULL;
		
		if((isset($location_point['lat']) and $location_point['lat']) and (isset($location_point['lng']) and $location_point['lng']))
		{
			curl_close($ch);
			return array($location_point['lat'], $location_point['lng']);
		}

		/** getting lat and lng using second url **/
		curl_setopt($ch, CURLOPT_URL, $url2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);

		$data = curl_exec($ch);
		$data = json_decode($data, true);

		$location_point = isset($data['results'][0]) ? $data['results'][0]['geometry']['location'] : NULL;

		if((isset($location_point['lat']) and $location_point['lat']) and (isset($location_point['lng']) and $location_point['lng']))
		{
			curl_close($ch);
			return array($location_point['lat'], $location_point['lng']);
		}

		return array(0, 0);
	}
    
    /**
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_default_label_color()
    {
        return apply_filters('mec_default_label_color', '#fefefe');
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @param int $post_id
     * @return string
     */
    public function get_post_content($post_id)
    {
        $post = get_post($post_id);
        return str_replace(']]>', ']]&gt;', apply_filters('the_content', $post->post_content));
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @param int $post_id
     * @return array
     */
    public function get_post_meta($post_id)
    {
        $raw_data = get_post_meta($post_id, '', true);
        
        $data = array();
        foreach($raw_data as $key=>$val) $data[$key] = isset($val[0]) ? (!is_serialized($val[0]) ? $val[0] : unserialize($val[0])) : NULL;
        
        return $data;
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_skins()
    {
        $skins = array
        (
            'list'=>__('List View', 'mec'),
            'grid'=>__('Grid View', 'mec'),
            'agenda'=>__('Agenda View', 'mec'),
            'full_calendar'=>__('Full Calendar', 'mec'),
            'yearly_view'=>__('Yearly View', 'mec'),
            'monthly_view'=>__('Calendar/Monthly View', 'mec'),
            'daily_view'=>__('Daily View', 'mec'),
            'weekly_view'=>__('Weekly View', 'mec'),
            'timetable'=>__('Timetable View', 'mec'),
            'masonry'=>__('Masonry View', 'mec'),
            'map'=>__('Map View', 'mec'),
            'cover'=>__('Cover View', 'mec'),
            'countdown'=>__('Countdown View', 'mec'),
            'available_spot'=>__('Available Spot', 'mec'),
            'carousel'=>__('Carousel View', 'mec'),
            'slider'=>__('Slider View', 'mec')
        );

        return apply_filters('mec_calendar_skins', $skins);
    }
    
    /**
     * Returns weekday labels
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_weekday_labels()
    {
        $week_start = $this->get_first_day_of_week();
        
        /**
         * Please don't change it to translate-able strings
         */
        $raw = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        
        $labels = array_slice($raw, $week_start);
        $rest = array_slice($raw, 0, $week_start);
        
        foreach($rest as $label) array_push($labels, $label);
        
        return apply_filters('mec_weekday_labels', $labels);
    }
    
    /**
     * Returns abbr weekday labels
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_weekday_abbr_labels()
    {
        $week_start = $this->get_first_day_of_week();
        $raw = array(
            $this->m('weekdays_su', __('SU', 'mec')),
            $this->m('weekdays_mo', __('MO', 'mec')),
            $this->m('weekdays_tu', __('TU', 'mec')),
            $this->m('weekdays_we', __('WE', 'mec')),
            $this->m('weekdays_th', __('TH', 'mec')),
            $this->m('weekdays_fr', __('FR', 'mec')),
            $this->m('weekdays_sa', __('SA', 'mec'))
        );
        
        $labels = array_slice($raw, $week_start);
        $rest = array_slice($raw, 0, $week_start);
        
        foreach($rest as $label) array_push($labels, $label);
        
        return apply_filters('mec_weekday_abbr_labels', $labels);
    }
    
    /**
     * Returns translatable weekday labels
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_weekday_i18n_labels()
    {
        $week_start = $this->get_first_day_of_week();
        $raw = array(array(7, __('Sunday', 'mec')), array(1, __('Monday', 'mec')), array(2, __('Tuesday', 'mec')), array(3, __('Wednesday', 'mec')), array(4, __('Thursday', 'mec')), array(5, __('Friday', 'mec')), array(6, __('Saturday', 'mec')));
        
        $labels = array_slice($raw, $week_start);
        $rest = array_slice($raw, 0, $week_start);
        
        foreach($rest as $label) array_push($labels, $label);
        
        return apply_filters('mec_weekday_i18n_labels', $labels);
    }
    
    /**
     * Flush WordPress rewrite rules
     * @author Webnus <info@webnus.biz>
     */
    public function flush_rewrite_rules()
    {
        // Register Events Post Type
        $MEC_events = MEC::getInstance('app.features.events', 'MEC_feature_events');
        $MEC_events->register_post_type();
        
        flush_rewrite_rules();
    }
    
    /**
     * Get single slug of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_single_slug()
    {
        $settings = $this->get_settings();
        $slug = (isset($settings['single_slug']) and trim($settings['single_slug']) != '') ? $settings['single_slug'] : 'event';
        
        return $slug;
    }
    
    /**
     * Returns main slug of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_main_slug()
    {
        $settings = $this->get_settings();
        $slug = (isset($settings['slug']) and trim($settings['slug']) != '') ? $settings['slug'] : 'events';
        
        return strtolower($slug);
    }
    
    /**
     * Returns category slug of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_category_slug()
    {
        $settings = $this->get_settings();
        $slug = (isset($settings['category_slug']) and trim($settings['category_slug']) != '') ? $settings['category_slug'] : 'mec-category';
        
        return strtolower($slug);
    }
    
    /**
     * Get archive page title
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_archive_title()
    {
        $settings = $this->get_settings();
        $archive_title = (isset($settings['archive_title']) and trim($settings['archive_title']) != '') ? $settings['archive_title'] : 'Events';
        
        return apply_filters('mec_archive_title', $archive_title);
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_archive_thumbnail()
    {
        return apply_filters('mec_archive_thumbnail', '');
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_single_thumbnail()
    {
        return apply_filters('mec_single_thumbnail', '');
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_main_post_type()
    {
        return apply_filters('mec_post_type_name', 'mec-events');
    }
    
    /**
     * Returns main options of MEC
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_options()
    {
        return get_option('mec_options', array());
    }
    
    /**
     * Returns MEC settings
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_settings()
    {
        $options = $this->get_options();
        return (isset($options['settings']) ? $options['settings'] : array());
    }
    
    /**
     * Returns registration form fields
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_reg_fields($event_id = NULL)
    {
        $options = $this->get_options();
        $reg_fields = isset($options['reg_fields']) ? $options['reg_fields'] : array();

        // Event Booking Fields
        if($event_id)
        {
            $global_inheritance = get_post_meta($event_id, 'mec_reg_fields_global_inheritance', true);
            if(trim($global_inheritance) == '') $global_inheritance = 1;

            if(!$global_inheritance)
            {
                $event_reg_fields = get_post_meta($event_id, 'mec_reg_fields', true);
                if(is_array($event_reg_fields)) $reg_fields = $event_reg_fields;
            }
        }

        return $reg_fields;
    }
    
    /**
     * Returns Messages Options
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_messages_options()
    {
        $options = $this->get_options();
        return (isset($options['messages']) ? $options['messages'] : array());
    }
    
    /**
     * Returns gateways options
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_gateways_options()
    {
        $options = $this->get_options();
        return (isset($options['gateways']) ? $options['gateways'] : array());
    }
    /**
     * Returns notifications settings of MEC
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_notifications()
    {
        $options = $this->get_options();
        return (isset($options['notifications']) ? $options['notifications'] : array());
    }
    
    /**
     * Returns Import/Export options of MEC
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_ix_options()
    {
        $options = $this->get_options();
        return (isset($options['ix']) ? $options['ix'] : array());
    }
    
    /**
     * Returns style settings of MEC
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_styles()
    {
        $options = $this->get_options();
        return (isset($options['styles']) ? $options['styles'] : array());
    }
    
    /**
     * Returns styling option of MEC
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_styling()
    {
        $options = $this->get_options();
        return (isset($options['styling']) ? $options['styling'] : array());
    }
    
    /**
     * Prints custom styles in the page header
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function include_styles()
    {
        $styles = $this->get_styles();
        
        // Print custom styles
        if(isset($styles['CSS']) and trim($styles['CSS']) != '')
        {
            $CSS = strip_tags($styles['CSS']);
            echo '<style type="text/css">'.stripslashes($CSS).'</style>';
        }
    }
    
    /**
     * Saves MEC settings
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function save_options()
    {
        // MEC Request library
        $request = $this->getRequest();
        
        $wpnonce = $request->getVar('_wpnonce', NULL);
        
        // Check if our nonce is set.
        if(!trim($wpnonce)) $this->response(array('success'=>0, 'code'=>'NONCE_MISSING'));
        
        // Verify that the nonce is valid.
        if(!wp_verify_nonce($wpnonce, 'mec_options_form')) $this->response(array('success'=>0, 'code'=>'NONCE_IS_INVALID'));
        
        // Get mec options
        $mec = $request->getVar('mec', array());
        
        $filtered = array();
        foreach($mec as $key=>$value) $filtered[$key] = (is_array($value) ? $value : array());
        
        // Get current MEC options
        $current = get_option('mec_options', array());
        if(is_string($current) and trim($current) == '') $current = array();
        
        // Validation for Slugs
        if(isset($filtered['settings']) and isset($filtered['settings']['slug'])) $filtered['settings']['slug'] = strtolower(str_replace(' ', '-', $filtered['settings']['slug']));
        if(isset($filtered['category_slug']) and isset($filtered['settings']['category_slug'])) $filtered['settings']['category_slug'] = strtolower(str_replace(' ', '-', $filtered['settings']['category_slug']));
        
        // Merge new options with previous options
        $final = array_merge($current, $filtered);

        // Save final options
        update_option('mec_options', $final);
        
        // Refresh WordPress rewrite rules
        $this->flush_rewrite_rules();
        
        // Print the response
        $this->response(array('success'=>1));
    }
    
    /**
     * Saves MEC Notifications
     * @author Webnus <info@webnus.biz>
     */
    public function save_notifications()
    {
        // MEC Request library
        $request = $this->getRequest();

        // Get mec options
        $mec = $request->getVar('mec', 'POST');
        $notifications = isset($mec['notifications']) ? $mec['notifications'] : array();

        // Get current MEC notifications
        $current = $this->get_notifications();
        if(is_string($current) and trim($current) == '') $current = array();

        // Merge new options with previous options
        $final_notifications = array();
        $final_notifications['notifications'] = array_merge($current, $notifications);

        // Get current MEC options
        $options = get_option('mec_options', array());
        if(is_string($options) and trim($options) == '') $options = array();

        // Merge new options with previous options
        $final = array_merge($options, $final_notifications);

        // Save final options
        update_option('mec_options', $final);

        // Print the response
        $this->response(array('success'=>1));
    }
    
    /**
     * Saves MEC Import/Export options
     * @author Webnus <info@webnus.biz>
     */
    public function save_ix_options($ix_options = array())
    {
        // Get current MEC ix options
        $current = $this->get_ix_options();
        if(is_string($current) and trim($current) == '') $current = array();

        // Merge new options with previous options
        $final_ix = array();
        $final_ix['ix'] = array_merge($current, $ix_options);

        // Get current MEC options
        $options = get_option('mec_options', array());
        if(is_string($options) and trim($options) == '') $options = array();

        // Merge new options with previous options
        $final = array_merge($options, $final_ix);
        
        // Save final options
        update_option('mec_options', $final);

        return true;
    }
    
    /**
     * Get first day of week from WordPress
     * @author Webnus <info@webnus.biz>
     * @return int
     */
    public function get_first_day_of_week()
    {
        return get_option('start_of_week', 1);
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @param array $response
     * @return void
     */
    public function response($response)
    {
        echo json_encode($response);
        exit;
    }
    
    /**
     * Check if a date passed or not
     * @author Webnus <info@webnus.biz>
     * @param mixed $end
     * @param mixed $now
     * @return int
     */
    public function is_past($end, $now)
    {
        if(!is_numeric($end)) $end = strtotime($end);
        if(!is_numeric($now)) $now = strtotime($now);
        
        // Never End
        if($end <= 0) return 0;
        
        return (int) ($now > $end);
    }
    
    /**
     * @author Webnus <info@webnus.biz>
     * @param int $id
     * @return string
     */
    public function get_weekday_name_by_day_id($id)
    {
        // These names will be used in PHP functions so they mustn't translate
        $days = array(1=>'Monday', 2=>'Tuesday', 3=>'Wednesday', 4=>'Thursday', 5=>'Friday', 6=>'Saturday', 7=>'Sunday');
        return $days[$id];
    }
    
    /**
     * Spilts 2 dates to weeks
     * @author Webnus <info@webnus.biz>
     * @param DateTime|String $start
     * @param DateTime|String $end
     * @param int $first_day_of_week
     * @return array
     */
    public function split_to_weeks($start, $end, $first_day_of_week = NULL)
    {
        if(is_null($first_day_of_week)) $first_day_of_week = $this->get_first_day_of_week();
        
        $end_day_of_week = ($first_day_of_week-1 >= 0) ? $first_day_of_week-1 : 6;
        
        $start_time = strtotime($start);
        $end_time = strtotime($end);
        
        $start = new DateTime(date('Y-m-d', $start_time));
        $end = new DateTime(date('Y-m-d 23:59', $end_time));
        
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($start, $interval, $end);
        
        $weekday = 0;
        $weekNumber = 1;
        $weeks = array();
        foreach($dateRange as $date)
        {
            // Fix the PHP notice
            if(!isset($weeks[$weekNumber])) $weeks[$weekNumber] = array();
            
            // It's first week and the week is not started from first weekday
            if($weekNumber == 1 and $weekday == 0 and $date->format('w') != $first_day_of_week)
            {
                $remained_days = $date->format('w');
                
                if($first_day_of_week == 0) $remained_days = $date->format('w'); // Sunday
                elseif($first_day_of_week == 1) // Monday
                {
                    if($remained_days != 0) $remained_days = $remained_days - 1;
                    else $remained_days = 6;
                }
                elseif($first_day_of_week == 6) // Saturday
                {
                    if($remained_days != 6) $remained_days = $remained_days + 1;
                    else $remained_days = 0;
                }
                elseif($first_day_of_week == 5) // Friday
                {
                    if($remained_days < 4) $remained_days = $remained_days + 2;
                    elseif($remained_days == 5) $remained_days = 0;
                    elseif($remained_days == 6) $remained_days = 1;
                }
                
                $interval = new DateInterval('P'.$remained_days.'D');
                $interval->invert = 1;
                $date->add($interval);
                
                for($i = $remained_days; $i > 0; $i--)
                {
                    $weeks[$weekNumber][] = $date->format('Y-m-d');
                    $date->add(new DateInterval('P1D'));
                }
            }
            
            $weeks[$weekNumber][] = $date->format('Y-m-d');
            $weekday++;
            
            if($date->format('w') == $end_day_of_week)
            {
                $weekNumber++;
                $weekday = 0;
            }
        }
        
        // Month is finished but week is not finished
        if($weekday > 0 and $weekday < 7)
        {
            $remained_days = (6 - $weekday);
            for($i = 0; $i <= $remained_days; $i++)
            {
                $date->add(new DateInterval('P1D'));
                $weeks[$weekNumber][] = $date->format('Y-m-d');
            }
        }
        
        return $weeks;
    }
    
    /**
     * Returns MEC colors
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_available_colors()
    {
        $colors = get_option('mec_colors', $this->get_default_colors());
        return apply_filters('mec_available_colors', $colors);
    }
    
    /**
     * Returns MEC default colors
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_default_colors()
    {
        return apply_filters('mec_default_colors', array('fdd700','00a0d2','e14d43','dd823b','a3b745'));
    }
    
    /**
     * Add a new color to MEC available colors
     * @author Webnus <info@webnus.biz>
     * @param string $color
     */
    public function add_to_available_colors($color)
    {
        $colors = $this->get_available_colors();
        $colors[] = $color;
        
        $colors = array_unique($colors);
        update_option('mec_colors', $colors);
    }
    
    /**
     * Returns available googlemap styles
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_googlemap_styles()
    {
        $styles = array(
            array('key'=>'light-dream.json', 'name'=>'Light Dream'),
            array('key'=>'intown-map.json', 'name'=>'inTown Map'),
            array('key'=>'midnight.json', 'name'=>'Midnight'),
            array('key'=>'pale-down.json', 'name'=>'Pale Down'),
            array('key'=>'blue-essence.json', 'name'=>'Blue Essence'),
            array('key'=>'blue-water.json', 'name'=>'Blue Water'),
            array('key'=>'apple-maps-esque.json', 'name'=>'Apple Maps Esque'),
            array('key'=>'CDO.json', 'name'=>'CDO'),
            array('key'=>'shades-of-grey.json', 'name'=>'Shades of Grey'),
            array('key'=>'subtle-grayscale.json', 'name'=>'Subtle Grayscale'),
            array('key'=>'ultra-light.json', 'name'=>'Ultra Light'),
            array('key'=>'facebook.json', 'name'=>'Facebook'),
        );
        
        return apply_filters('mec_googlemap_styles', $styles);
    }
    
    /**
     * Filters provided google map styles
     * @author Webnus <info@webnus.biz>
     * @param string $style
     * @return string
     */
    public function get_googlemap_style($style)
    {
        return apply_filters('mec_get_googlemap_style', $style);
    }
    
    /**
     * Fetchs googlemap styles from file
     * @author Webnus <info@webnus.biz>
     * @param string $style
     * @return string
     */
    public function fetch_googlemap_style($style)
    {
        $path = $this->get_plugin_path().'app'.DS.'modules'.DS.'googlemap'.DS.'styles'.DS.$style;
        
        // MEC file library
        $file = $this->getFile();
        
        if($file->exists($path)) return trim($file->read($path));
        else return '';
    }
    
    /**
     * Get marker infowindow for showing on the map
     * @author Webnus <info@webnus.biz>
     * @param object $event
     * @return string
     */
    public function get_marker_infowindow($marker)
    {
        $count = count($marker['event_ids']);
        
        $content = '
        <div class="mec-marker-infowindow-wp">
            <div class="mec-marker-infowindow-count">'.$count.'</div>
            <div class="mec-marker-infowindow-content">
                <span>'.($count > 1 ? __('Events at this location', 'mec') : __('Event at this location', 'mec')).'</span>
                <span>'.(trim($marker['address']) ? $marker['address'] : $marker['name']).'</span>
            </div>
        </div>';
        
        return apply_filters('mec_get_marker_infowindow', $content);
    }
    
    /**
     * Get marker Lightbox for showing on the map
     * @author Webnus <info@webnus.biz>
     * @param object $event
     * @return string
     */
    public function get_marker_lightbox($event, $date_format = 'M d Y')
    {
    	$infowindow_thumb = trim($event->data->thumbnails['thumbnail']) ? '<div class="mec-event-image">'.$event->data->thumbnails['thumbnail'].'</div>' : '';

        $content = '
		<div class="mec-wrap">
			<div class="mec-map-lightbox-wp mec-event-list-classic">
				<article class="mec-event-article mec-clear">
					'.$infowindow_thumb.'
					<a data-event-id="'.$event->data->ID.'" href="'.$this->get_event_date_permalink($event->data->permalink, $event->date['start']['date']).'"><div class="mec-event-date mec-color"><i class="mec-sl-calendar"></i> '.$this->date_label($event->date['start'], $event->date['end'], $date_format).'</div></a>
					<h4 class="mec-event-title"><a data-event-id="'.$event->data->ID.'" class="mec-color-hover" href="'.$this->get_event_date_permalink($event->data->permalink, $event->date['start']['date']).'">'.$event->data->title.'</a></h4>
				</article>
			</div>
		</div>';
        
        return apply_filters('mec_get_marker_lightbox', $content);
    }

    /**
     * Returns available social networks
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_social_networks()
    {
        $social_networks = array(
            'facebook'=>array('id'=>'facebook', 'name'=>__('Facebook', 'mec'), 'function'=>array($this, 'sn_facebook')),
            'gplus'=>array('id'=>'gplus', 'name'=>__('Google+', 'mec'), 'function'=>array($this, 'sn_gplus')),
            'twitter'=>array('id'=>'twitter', 'name'=>__('Twitter', 'mec'), 'function'=>array($this, 'sn_twitter')),
            'linkedin'=>array('id'=>'linkedin', 'name'=>__('Linkedin', 'mec'), 'function'=>array($this, 'sn_linkedin')),
            'email'=>array('id'=>'email', 'name'=>__('Email', 'mec'), 'function'=>array($this, 'sn_email')),
        );
        
        return apply_filters('mec_social_networks', $social_networks);
    }
    
    /**
     * Do facebook link for social networks
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param object $event
     * @return string
     */
    public function sn_facebook($url, $event)
    {
        return '<li class="mec-event-social-icon"><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u='.esc_attr($url).'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600\'); return false;" title="'.__('Share on Facebook', 'mec').'"><i class="mec-fa-facebook"></i></a></li>';
    }
    
    /**
     * Do Google+ link for social networks
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param object $event
     * @return string
     */
    public function sn_gplus($url, $event)
    {
        return '<li class="mec-event-social-icon"><a class="google" href="https://plus.google.com/share?url='.esc_attr($url).'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500\'); return false;" title="'.__('Google Plus', 'mec').'"><i class="mec-fa-google-plus"></i></a></li>';
    }
    
    /**
     * Do twitter link for social networks
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param object $event
     * @return string
     */
    public function sn_twitter($url, $event)
    {
        return '<li class="mec-event-social-icon"><a class="twitter" href="https://twitter.com/share?url='.esc_attr($url).'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500\'); return false;" target="_blank" title="'.__('Tweet', 'mec').'"><i class="mec-fa-twitter"></i></a></li>';
    }
    
    /**
     * Do linkedin link for social networks
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param object $event
     * @return string
     */
    public function sn_linkedin($url, $event)
    {
        return '<li class="mec-event-social-icon"><a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url='.esc_attr($url).'" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500\'); return false;" target="_blank" title="'.__('Linkedin', 'mec').'"><i class="mec-fa-linkedin"></i></a></li>';
    }
    
    /**
     * Do email link for social networks
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param object $event
     * @return string
     */
    public function sn_email($url, $event)
    {
        return '<li class="mec-event-social-icon"><a class="email" href="mailto:yourfriend?subject='.urlencode($event->data->title).'&body='.urlencode($url).'" title="'.__('Email', 'mec').'"><i class="mec-fa-envelope"></i></a></li>';
    }
    
    /**
     * Get available skins for archive page
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_archive_skins()
    {
        $archive_skins = array(
            array('skin'=>'full_calendar', 'name'=>__('Full Calendar', 'mec')),
            array('skin'=>'yearly_view', 'name'=>__('Yearly View', 'mec')),
            array('skin'=>'monthly_view', 'name'=>__('Calendar/Monthly View', 'mec')),
            array('skin'=>'weekly_view', 'name'=>__('Weekly View', 'mec')),
            array('skin'=>'daily_view', 'name'=>__('Daily View', 'mec')),
            array('skin'=>'timetable', 'name'=>__('Timetable View', 'mec')),
            array('skin'=>'masonry', 'name'=>__('Masonry View', 'mec')),
            array('skin'=>'list', 'name'=>__('List View', 'mec')),
            array('skin'=>'grid', 'name'=>__('Grid View', 'mec')),
            array('skin'=>'agenda', 'name'=>__('Agenda View', 'mec')),
            array('skin'=>'map', 'name'=>__('Map View', 'mec')),
        );
        
        return apply_filters('mec_archive_skins', $archive_skins);
    }
    
    /**
     * Get events posts
     * @author Webnus <info@webnus.biz>
     * @param int $limit
     * @return array list of posts
     */
    public function get_events($limit = -1)
    {
        return get_posts(array('post_type'=>$this->get_main_post_type(), 'posts_per_page'=>$limit, 'post_status'=>'publish'));
    }
    
    /**
     * Get method of showing for multiple days events
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_multiple_days_method()
    {
        $settings = $this->get_settings();
        
        $method = isset($settings['multiple_day_show_method']) ? $settings['multiple_day_show_method'] : 'first_day_listgrid';
        return apply_filters('mec_multiple_days_method', $method);
    }
    
    /**
     * Get method of showing/hiding events based on event time
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_hide_time_method()
    {
        $settings = $this->get_settings();
        
        $method = isset($settings['hide_time_method']) ? $settings['hide_time_method'] : 'start';
        return apply_filters('mec_hide_time_method', $method);
    }
    
    /**
     * Get hour format of MEC
     * @author Webnus <info@webnus.biz>
     * @return int|string
     */
    public function get_hour_format()
    {
        $settings = $this->get_settings();
        
        $format = isset($settings['time_format']) ? $settings['time_format'] : 12;
        return apply_filters('mec_hour_format', $format);
    }
    
    /**
     * Get formatted hour based on configurations
     * @author Webnus <info@webnus.biz>
     * @param int $hour
     * @param int $minutes
     * @param string $ampm
     * @return string
     */
    public function get_formatted_hour($hour, $minutes, $ampm)
    {
        // Hour Format of MEC (12/24)
        $hour_format = $this->get_hour_format();
        
        $formatted = '';
        if($hour_format == '12')
        {
            $formatted = sprintf("%02d", $hour).':'.sprintf("%02d", $minutes).' '.__($ampm, 'mec');
        }
        elseif($hour_format == '24')
        {
            if(strtoupper($ampm) == 'PM' and $hour != 12) $hour += 12;
            if(strtoupper($ampm) == 'AM' and $hour == 12) $hour += 12;
            
            $formatted = sprintf("%02d", $hour).':'.sprintf("%02d", $minutes);
        }
        
        return $formatted;
    }
    
    /**
     * Renders a module such as links or googlemap
     * @author Webnus <info@webnus.biz>
     * @param string $module
     * @param array $params
     * @return string
     */
    public function module($module, $params = array())
    {
        // Get module path
        $path = MEC::import('app.modules.'.$module, true, true);
        
        // MEC libraries
        $render = $this->getRender();
        $factory = $this->getFactory();
        
        // Extract Module Params
        extract($params);
        
        ob_start();
        include $path;
        return $output = ob_get_clean();
    }
    
    /**
     * Returns MEC currencies
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_currencies()
    {
        $currencies = array(
            '$'=>'USD',
            '€'=>'EUR',
            '£'=>'GBP',
            'CHF'=>'CHF',
            'CAD'=>'CAD',
            'AUD'=>'AUD',
            'JPY'=>'JPY',
            'SEK'=>'SEK',
            'GEL'=>'GEL',
            'AFN'=>'AFN',
            'ALL'=>'ALL',
            'DZD'=>'DZD',
            'AOA'=>'AOA',
            'ARS'=>'ARS',
            'AMD'=>'AMD',
            'AWG'=>'AWG',
            'AZN'=>'AZN',
            'BSD'=>'BSD',
            'BHD'=>'BHD',
            'BBD'=>'BBD',
            'BYR'=>'BYR',
            'BZD'=>'BZD',
            'BMD'=>'BMD',
            'BTN'=>'BTN',
            'BOB'=>'BOB',
            'BAM'=>'BAM',
            'BWP'=>'BWP',
            'BRL'=>'BRL',
            'BND'=>'BND',
            'BGN'=>'BGN',
            'BIF'=>'BIF',
            'KHR'=>'KHR',
            'CVE'=>'CVE',
            'KYD'=>'KYD',
            'XAF'=>'XAF',
            'CLP'=>'CLP',
            'COP'=>'COP',
            'KMF'=>'KMF',
            'CDF'=>'CDF',
            'NZD'=>'NZD',
            'CRC'=>'CRC',
            'HRK'=>'HRK',
            'CUC'=>'CUC',
            'CUP'=>'CUP',
            'CZK'=>'CZK',
            'DKK'=>'DKK',
            'DJF'=>'DJF',
            'DOP'=>'DOP',
            'XCD'=>'XCD',
            'EGP'=>'EGP',
            'ERN'=>'ERN',
            'EEK'=>'EEK',
            'ETB'=>'ETB',
            'FKP'=>'FKP',
            'DKK'=>'DKK',
            'FJD'=>'FJD',
            'GMD'=>'GMD',
            'GEL'=>'GEL',
            'GHS'=>'GHS',
            'GIP'=>'GIP',
            'GTQ'=>'GTQ',
            'GNF'=>'GNF',
            'GYD'=>'GYD',
            'HTG'=>'HTG',
            'HNL'=>'HNL',
            'HKD'=>'HKD',
            'HUF'=>'HUF',
            'ISK'=>'ISK',
            'INR'=>'INR',
            'IDR'=>'IDR',
            'IRR'=>'IRR',
            'IQD'=>'IQD',
            'ILS'=>'ILS',
            'JMD'=>'JMD',
            'JOD'=>'JOD',
            'KZT'=>'KZT',
            'KES'=>'KES',
            'AUD'=>'AUD',
            'KWD'=>'KWD',
            'KGS'=>'KGS',
            'LAK'=>'LAK',
            'LVL'=>'LVL',
            'LBP'=>'LBP',
            'LSL'=>'LSL',
            'LRD'=>'LRD',
            'LYD'=>'LYD',
            'LTL'=>'LTL',
            'MOP'=>'MOP',
            'MKD'=>'MKD',
            'MGA'=>'MGA',
            'MWK'=>'MWK',
            'MYR'=>'MYR',
            'MVR'=>'MVR',
            'MRO'=>'MRO',
            'MUR'=>'MUR',
            'MXN'=>'MXN',
            'MDL'=>'MDL',
            'MNT'=>'MNT',
            'MAD'=>'MAD',
            'MZN'=>'MZN',
            'MMK'=>'MMK',
            'NAD'=>'NAD',
            'NPR'=>'NPR',
            'ANG'=>'ANG',
            'TWD'=>'TWD',
            'NZD'=>'NZD',
            'NIO'=>'NIO',
            'NGN'=>'NGN',
            'KPW'=>'KPW',
            'NOK'=>'NOK',
            'OMR'=>'OMR',
            'PKR'=>'PKR',
            'PAB'=>'PAB',
            'PGK'=>'PGK',
            'PYG'=>'PYG',
            'PEN'=>'PEN',
            'PHP'=>'PHP',
            'PLN'=>'PLN',
            'QAR'=>'QAR',
            'CNY'=>'CNY',
            'RON'=>'RON',
            'RUB'=>'RUB',
            'RWF'=>'RWF',
            'SHP'=>'SHP',
            'SVC'=>'SVC',
            'WST'=>'WST',
            'SAR'=>'SAR',
            'RSD'=>'RSD',
            'SCR'=>'SCR',
            'SLL'=>'SLL',
            'SGD'=>'SGD',
            'SBD'=>'SBD',
            'SOS'=>'SOS',
            'ZAR'=>'ZAR',
            'KRW'=>'KRW',
            'LKR'=>'LKR',
            'SDG'=>'SDG',
            'SRD'=>'SRD',
            'SZL'=>'SZL',
            'SYP'=>'SYP',
            'STD'=>'STD',
            'TJS'=>'TJS',
            'TZS'=>'TZS',
            'THB'=>'THB',
            'TOP'=>'TOP',
            'PRB'=>'PRB',
            'TTD'=>'TTD',
            'TND'=>'TND',
            'TRY'=>'TRY',
            'TMT'=>'TMT',
            'TVD'=>'TVD',
            'UGX'=>'UGX',
            'UAH'=>'UAH',
            'AED'=>'AED',
            'UYU'=>'UYU',
            'UZS'=>'UZS',
            'VUV'=>'VUV',
            'VEF'=>'VEF',
            'VND'=>'VND',
            'XOF'=>'XOF',
            'YER'=>'YER',
            'ZMK'=>'ZMK',
            'ZWL'=>'ZWL',
            'CNY'=>'CNY',
        );
        
        return apply_filters('mec_currencies', $currencies);
    }
    
    /**
     * Returns MEC version
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_version()
    {
        return _MEC_VERSION_;
    }
    
    /**
     * Set endpoint vars to true
     * @author Webnus <info@webnus.biz>
     * @param array $vars
     * @return boolean
     */
    public function filter_request($vars)
    {
        if(isset($vars['gateway-cancel'])) $vars['gateway-cancel'] = true;
        if(isset($vars['gateway-return'])) $vars['gateway-return'] = true;
        if(isset($vars['gateway-notify'])) $vars['gateway-notify'] = true;
        
        return $vars;
    }
    
    /**
     * Do the jobs after endpoints and show related output
     * @author Webnus <info@webnus.biz>
     * @return boolean
     */
    public function do_endpoints()
    {
        if(get_query_var('verify'))
        {
            $key = sanitize_text_field(get_query_var('verify'));
            
            $db = $this->getDB();
            $book_id = $db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_key`='mec_verification_key' AND `meta_value`='$key'", 'loadResult');
            
            if(!$book_id) return false;
            
            $book = $this->getBook();
            if($book->verify($book_id)) echo '<p class="mec-success">'.__('Your booking successfully verified.', 'mec').'</p>';
            else echo '<p class="mec-error">'.__('Your booking cannot verify!', 'mec').'</p>';
        }
        elseif(get_query_var('cancel'))
        {
            $key = sanitize_text_field(get_query_var('cancel'));
            
            $db = $this->getDB();
            $book_id = $db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_key`='mec_cancellation_key' AND `meta_value`='$key'", 'loadResult');
            
            if(!$book_id) return false;
            
            $book = $this->getBook();
            if($book->cancel($book_id)) echo '<p class="mec-success">'.__('Your booking successfully canceled.', 'mec').'</p>';
            else echo '<p class="mec-error">'.__('Your booking cannot be canceled.', 'mec').'</p>';
        }
        elseif(get_query_var('gateway-cancel'))
        {
            echo '<p class="mec-success">'.__('You canceled the payment successfully.', 'mec').'</p>';
        }
        elseif(get_query_var('gateway-return'))
        {
            echo '<p class="mec-success">'.__('You returned from payment gateway successfully.', 'mec').'</p>';
        }
        elseif(get_query_var('gateway-notify'))
        {
            // TODO
        }
    }

    public function booking_invoice()
    {
        // Booking Invoice
        if(isset($_GET['method']) and $_GET['method'] == 'mec-invoice')
        {
            $transaction_id = sanitize_text_field($_GET['id']);
            $wpnonce = sanitize_text_field($_GET['_wpnonce']);

            if(!wp_verify_nonce($wpnonce, 'mec_invoice_download'))
            {
                wp_die(__('Security nonce is not valid.', 'mec'), __('Invoice download stopped!', 'mec'), array('back_link'=>true));
                exit;
            }

            // Libraries
            $book = $this->getBook();
            $render = $this->getRender();

            $transaction = $book->get_transaction($transaction_id);
            $event_id = isset($transaction['event_id']) ? $transaction['event_id'] : 0;

            if(!$event_id)
            {
                wp_die(__('Cannot find the booking!', 'mec'), __('Booking is invalid.', 'mec'), array('back_link'=>true));
                exit;
            }

            $event = $render->data($event_id);

            $location_id = isset($event->meta['mec_location_id']) ? $event->meta['mec_location_id'] : 0;
            $location = isset($event->locations[$location_id]) ? (trim($event->locations[$location_id]['address']) ? $event->locations[$location_id]['address'] : $event->locations[$location_id]['name']) : '';

            $dates = isset($transaction['date']) ? explode(':', $transaction['date']) : array(date('Y-m-d'), date('Y-m-d'));

            // Include the tFPDF Class
            if(!class_exists('tFPDF')) require_once _MEC_ABSPATH_.'app'.DS.'api'.DS.'TFPDF'.DS.'tfpdf.php';

            $pdf = new tFPDF();
            $pdf->AddPage();

            // Add a Unicode font (uses UTF-8)
            $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
            $pdf->AddFont('DejaVuBold', '', 'DejaVuSansCondensed-Bold.ttf', true);

            $pdf->SetTitle(sprintf(__('%s Invoice', 'mec'), $transaction_id));
            $pdf->SetAuthor(get_bloginfo('name'), true);

            // Event Information
            $pdf->SetFont('DejaVuBold', '', 18);
            $pdf->Write(25, get_the_title($event->ID));
            $pdf->Ln();

            $pdf->SetFont('DejaVuBold', '', 12);
            $pdf->Write(6, __('Location', 'mec').': ');
            $pdf->SetFont('DejaVu', '', 12);
            $pdf->Write(6, $location);
            $pdf->Ln();

            $pdf->SetFont('DejaVuBold', '', 12);
            $pdf->Write(6, __('Date', 'mec').': ');
            $pdf->SetFont('DejaVu', '', 12);
            $pdf->Write(6, $dates[0].' '.(isset($event->time['start']) ? $event->time['start'] : '').' - '.(($dates[0] != $dates[1]) ? $dates[1].' ' : '').(isset($event->time['end']) ? $event->time['end'] : ''));
            $pdf->Ln();

            $pdf->SetFont('DejaVuBold', '', 12);
            $pdf->Write(6, __('Transaction ID', 'mec').': ');
            $pdf->SetFont('DejaVu', '', 12);
            $pdf->Write(6, $transaction_id);
            $pdf->Ln();

            // Attendees
            if(isset($transaction['tickets']) and is_array($transaction['tickets']) and count($transaction['tickets']))
            {
                $pdf->SetFont('DejaVuBold', '', 16);
                $pdf->Write(20, __('Attendees', 'mec'));
                $pdf->Ln();

                $pdf->SetFont('DejaVuBold', '', 12);
                $pdf->Cell(50, 10, __('Name', 'mec'), 1, 0);
                $pdf->Cell(90, 10, __('Email', 'mec'), 1, 0);
                $pdf->Cell(50, 10, __('Ticket', 'mec'), 1, 0);
                $pdf->Ln();

                $pdf->SetFont('DejaVu', '', 12);
                foreach($transaction['tickets'] as $attendee)
                {
                    $pdf->Cell(50, 7, $attendee['name'], 1, 0);
                    $pdf->Cell(90, 7, $attendee['email'], 1, 0);
                    $pdf->Cell(50, 7, ((isset($event->tickets[$attendee['id']]) ? $event->tickets[$attendee['id']]['name'] : '').' '.(isset($event->tickets[$attendee['id']]) ? $event->tickets[$attendee['id']]['price_label'] : '')), 1, 0);
                    $pdf->Ln();
                }
            }

            // Billing Information
            if(isset($transaction['price_details']) and isset($transaction['price_details']['details']) and is_array($transaction['price_details']['details']) and count($transaction['price_details']['details']))
            {
                $pdf->SetFont('DejaVuBold', '', 16);
                $pdf->Write(20, __('Billing', 'mec'));
                $pdf->Ln();

                $pdf->SetFont('DejaVu', '', 12);
                foreach($transaction['price_details']['details'] as $price_row)
                {
                    $pdf->Write(6, $price_row['description']." - ".$this->render_price($price_row['amount']));
                    $pdf->Ln();
                }

                $pdf->SetFont('DejaVuBold', '', 12);
                $pdf->Write(10, __('Total', 'mec').': ');
                $pdf->Write(10, $this->render_price($transaction['price']));
                $pdf->Ln();
            }

            $image = $this->module('qrcode.invoice', array('event'=>$event));
            if(trim($image))
            {
                // QR Code
                $pdf->SetX(-50);
                $pdf->Image($image);
                $pdf->Ln();
            }

            $pdf->Output();
            exit;
        }
    }
    
    /**
     * Generates ical output
     * @author Webnus <info@webnus.biz>
     */
    public function ical()
    {
        // ical export
        if(isset($_GET['method']) and $_GET['method'] == 'ical')
        {
            $id = sanitize_text_field($_GET['id']);
            $wpnonce = sanitize_text_field($_GET['_wpnonce']);
            
            if(!wp_verify_nonce($wpnonce, 'mec_ical_export'))
            {
                wp_die(__('Security nonce is not valid.', 'mec'), __('iCal export stopped!', 'mec'), array('back_link'=>true));
                exit;
            }
            
            $occurrence = isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : '';

            $events = $this->ical_single($id, $occurrence);
            $ical_calendar = $this->ical_calendar($events);
            
            header('Content-type: application/force-download; charset=utf-8'); 
            header('Content-Disposition: attachment; filename="mec-event-'.$id.'.ics"');
            
            echo $ical_calendar;
            exit;
        }
    }

    /**
     * Returns the iCal URL of event
     * @author Webnus <info@webnus.biz>
     * @param $event_id
     * @param string $occurrence
     * @return string
     */
    public function ical_URL($event_id, $occurrence = '')
    {
        $url = $this->URL('site');
        $url = $this->add_qs_var('method', 'ical', $url);
        $url = $this->add_qs_var('id', $event_id, $url);
        
        // Add Occurrence Date if passed
        if(trim($occurrence)) $url = $this->add_qs_var('occurrence', $occurrence, $url);
        
        return wp_nonce_url($url, 'mec_ical_export');
    }
    
    /**
     * Returns iCal export for one event
     * @author Webnus <info@webnus.biz>
     * @param int $event_id
     * @param string $occurrence
     * @return string
     */
    public function ical_single($event_id, $occurrence = '')
    {
        // MEC Render Library
        $render = $this->getRender();
        
        $event = $render->data($event_id);
        $dates = $render->dates($event_id, $event, 2, $occurrence);
        
        $location = isset($event->locations[$event->meta['mec_location_id']]) ? $event->locations[$event->meta['mec_location_id']]['address'] : '';
        
        $occurrence_end_date = trim($occurrence) ? $this->get_end_date_by_occurrence($event_id, (isset($dates[0]['start']['date']) ? $dates[0]['start']['date'] : $occurrence)) : '';
        $start_time = strtotime((trim($occurrence) ? $occurrence : $dates[0]['start']['date']).' '.sprintf("%02d", $dates[0]['start']['hour']).':'.sprintf("%02d", $dates[0]['start']['minutes']).' '.$dates[0]['start']['ampm']);
        $end_time = strtotime((trim($occurrence_end_date) ? $occurrence_end_date : $dates[0]['end']['date']).' '.sprintf("%02d", $dates[0]['end']['hour']).':'.sprintf("%02d", $dates[0]['end']['minutes']).' '.$dates[0]['end']['ampm']);
        
        $gmt_offset_seconds = $this->get_gmt_offset_seconds();
        
        $stamp = strtotime($event->post->post_date);
        $modified = strtotime($event->post->post_modified);

        $ical  = "BEGIN:VEVENT".PHP_EOL;
        $ical .= "UID:MEC-".md5($event_id)."@".$this->get_domain().PHP_EOL;
        $ical .= "DTSTART:".gmdate('Ymd\\THi00\\Z', ($start_time - $gmt_offset_seconds)).PHP_EOL;
        $ical .= "DTEND:".gmdate('Ymd\\THi00\\Z', ($end_time - $gmt_offset_seconds)).PHP_EOL;
        $ical .= "DTSTAMP:".gmdate('Ymd\\THi00\\Z', ($stamp - $gmt_offset_seconds)).PHP_EOL;
        $ical .= "CREATED:".date('Ymd', $stamp).PHP_EOL;
        $ical .= "LAST-MODIFIED:".date('Ymd', $modified).PHP_EOL;
        $ical .= "SUMMARY:".html_entity_decode($event->title, ENT_NOQUOTES, 'UTF-8').PHP_EOL;
        $ical .= "DESCRIPTION:".html_entity_decode(trim(strip_tags($event->content)), ENT_NOQUOTES, 'UTF-8').PHP_EOL;
        $ical .= "URL:".$event->permalink.PHP_EOL;
        
        // Location
        if(trim($location) != '') $ical .= "LOCATION:".$location.PHP_EOL;
        
        // Featured Image
        if(trim($event->featured_image['full']) != '')
        {
            $ex = explode('/', $event->featured_image['full']);
            $filename = end($ex);
            $ical .= "ATTACH;FMTTYPE=".$this->get_mime_content_type($filename).":".$event->featured_image['full'].PHP_EOL;
        }
        
        $ical .= "END:VEVENT".PHP_EOL;
        
        return $ical;
    }
    
    /**
     * Returns iCal export for some events
     * @author Webnus <info@webnus.biz>
     * @param string $events
     * @return string
     */
    public function ical_calendar($events)
    {
        $ical  = "BEGIN:VCALENDAR".PHP_EOL;
        $ical .= "VERSION:2.0".PHP_EOL;
        $ical .= "METHOD:PUBLISH".PHP_EOL;
        $ical .= "CALSCALE:GREGORIAN".PHP_EOL;
        $ical .= "PRODID:-//WordPress - MECv".$this->get_version()."//EN".PHP_EOL;
        $ical .= "X-WR-CALNAME:WordPress".PHP_EOL;
        $ical .= "X-ORIGINAL-URL:".$this->URL('site').PHP_EOL;
        $ical .= $events;
        $ical .= "END:VCALENDAR";
        
        return $ical;
    }
    
    /**
     * Get mime type of a file
     * @author Webnus <info@webnus.biz>
     * @param string $filename
     * @return string
     */
    public function get_mime_content_type($filename)
    {
        $mime_types = array
        (
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
        
        $ex = explode('.', $filename);
        $ext = strtolower(array_pop($ex));
        if(array_key_exists($ext, $mime_types))
        {
            return $mime_types[$ext];
        }
        elseif(function_exists('finfo_open'))
        {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            
            return $mimetype;
        }
        else
        {
            return 'application/octet-stream';
        }
    }
    
    /**
     * Returns book post type slug
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_book_post_type()
    {
        return apply_filters('mec_book_post_type_name', 'mec-books');
    }
    
    /**
     * Show text field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_text($key, $values = array())
    {
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Text', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="text" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show email field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_email($key, $values = array())
    {
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Email', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="email" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show tel field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_tel($key, $values = array())
    {
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Tel', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="tel" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show textarea field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_textarea($key, $values = array())
    {
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Textarea', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="textarea" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show paragraph field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_p($key, $values = array())
    {
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Paragraph', 'mec').'</span>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="p" />
                <textarea name="mec[reg_fields]['.$key.'][content]">'.(isset($values['content']) ? htmlentities($values['content']) : '').'</textarea>
                <p class="description">'.__('HTML and shortcode are allowed.').'</p>
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show checkbox field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_checkbox($key, $values = array())
    {
        $i = 0;
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Checkboxes', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="checkbox" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
                <ul id="mec_reg_fields_'.$key.'_options_container" class="mec_reg_fields_options_container">';
        
        if(isset($values['options']) and is_array($values['options']) and count($values['options']))
        {
            foreach($values['options'] as $option_key=>$option)
            {
                $i = max($i, $option_key);
                $field .= $this->field_option($key, $option_key, $values);
            }
        }
        
        $field .= '</ul>
                <button type="button" class="mec-reg-field-add-option" data-field-id="'.$key.'">'.__('Option', 'mec').'</button>
                <input type="hidden" id="mec_new_reg_field_option_key_'.$key.'" value="'.($i+1).'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show radio field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_radio($key, $values = array())
    {
        $i = 0;
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Radio Buttons', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="radio" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
                <ul id="mec_reg_fields_'.$key.'_options_container" class="mec_reg_fields_options_container">';
        
        if(isset($values['options']) and is_array($values['options']) and count($values['options']))
        {
            foreach($values['options'] as $option_key=>$option)
            {
                $i = max($i, $option_key);
                $field .= $this->field_option($key, $option_key, $values);
            }
        }
        
        $field .= '</ul>
                <button type="button" class="mec-reg-field-add-option" data-field-id="'.$key.'">'.__('Option', 'mec').'</button>
                <input type="hidden" id="mec_new_reg_field_option_key_'.$key.'" value="'.($i+1).'" />
            </div>
        </li>';
        
        return $field;
    }
    
    /**
     * Show select field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_select($key, $values = array())
    {
        $i = 0;
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Dropdown', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((isset($values['mandatory']) and $values['mandatory']) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="select" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : '').'" />
                <ul id="mec_reg_fields_'.$key.'_options_container" class="mec_reg_fields_options_container">';
        
        if(isset($values['options']) and is_array($values['options']) and count($values['options']))
        {
            foreach($values['options'] as $option_key=>$option)
            {
                $i = max($i, $option_key);
                $field .= $this->field_option($key, $option_key, $values);
            }
        }
        
        $field .= '</ul>
                <button type="button" class="mec-reg-field-add-option" data-field-id="'.$key.'">'.__('Option', 'mec').'</button>
                <input type="hidden" id="mec_new_reg_field_option_key_'.$key.'" value="'.($i+1).'" />
            </div>
        </li>';
        
        return $field;
    }

    /**
     * Show agreement field options in booking form
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_agreement($key, $values = array())
    {
        // WordPress Pages
        $pages = get_pages();

        $i = 0;
        $field = '<li id="mec_reg_fields_'.$key.'">
            <span class="mec_reg_field_sort">'.__('Sort', 'mec').'</span>
            <span class="mec_reg_field_type">'.__('Agreement', 'mec').'</span>
            <p class="mec_reg_field_options">
                <label for="mec_reg_fields_'.$key.'_mandatory">
                    <input type="hidden" name="mec[reg_fields]['.$key.'][mandatory]" value="0" />
                    <input type="checkbox" name="mec[reg_fields]['.$key.'][mandatory]" value="1" id="mec_reg_fields_'.$key.'_mandatory" '.((!isset($values['mandatory']) or (isset($values['mandatory']) and $values['mandatory'])) ? 'checked="checked"' : '').' />
                    '.__('Required Field', 'mec').'
                </label>
            </p>
            <span onclick="mec_reg_fields_remove('.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <div>
                <input type="hidden" name="mec[reg_fields]['.$key.'][type]" value="agreement" />
                <input type="text" name="mec[reg_fields]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this field', 'mec').'" value="'.(isset($values['label']) ? $values['label'] : 'I agree with %s').'" /><p class="description">'.__('Instead of %s, the page title with a link will be show.', 'mec').'</p>
                <div>
                    <label for="mec_reg_fields_'.$key.'_page">'.__('Agreement Page', 'mec').'</label>
                    <select id="mec_reg_fields_'.$key.'_page" name="mec[reg_fields]['.$key.'][page]">';

                    $page_options = '';
                    foreach($pages as $page) $page_options .= '<option '.((isset($values['page']) and $values['page'] == $page->ID) ? 'selected="selected"' : '').' value="'.$page->ID.'">'.$page->post_title.'</option>';

                    $field .= $page_options.'</select>
                </div>

                <input type="hidden" id="mec_new_reg_field_option_key_'.$key.'" value="'.($i+1).'" />
            </div>
        </li>';

        return $field;
    }
    
    /**
     * Show option tag parameters in booking form for select, checkbox and radio tags
     * @author Webnus <info@webnus.biz>
     * @param string $key
     * @param array $values
     * @return string
     */
    public function field_option($field_key, $key, $values = array())
    {
        $field = '<li id="mec_reg_fields_option_'.$field_key.'_'.$key.'">
            <span class="mec_reg_field_option_sort">'.__('Sort', 'mec').'</span>
            <span onclick="mec_reg_fields_option_remove('.$field_key.','.$key.');" class="mec_reg_field_remove">'.__('Remove', 'mec').'</span>
            <input type="text" name="mec[reg_fields]['.$field_key.'][options]['.$key.'][label]" placeholder="'.esc_attr__('Insert a label for this option', 'mec').'" value="'.((isset($values['options']) and isset($values['options'][$key])) ? $values['options'][$key]['label'] : '').'" />
        </li>';
        
        return $field;
    }
    
    /**
     * Render raw price and return its output
     * @author Webnus <info@webnus.biz>
     * @param int $price
     * @return string
     */
    public function render_price($price)
    {
        // return Free if price is 0
        if($price == '0') return __('Free', 'mec');
        
        $thousand_separator = $this->get_thousand_separator();
        $decimal_separator = $this->get_decimal_separator();
        
        $currency = $this->get_currency_sign();
        $currency_sign_position = $this->get_currency_sign_position();
        
        // Force to double
        if(is_string($price)) $price = (double) $price;
        
        $rendered = number_format($price, ($decimal_separator === false ? 0 : 2), ($decimal_separator === false ? '' : $decimal_separator), $thousand_separator);
        
        if($currency_sign_position == 'after') $rendered = $rendered.$currency;
        else $rendered = $currency.$rendered;
        
        return $rendered;
    }
    
    /**
     * Returns thousand separator
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_thousand_separator()
    {
        $settings = $this->get_settings();
        return apply_filters('mec_thousand_separator', (isset($settings['thousand_separator']) ? $settings['thousand_separator'] : ','));
    }
    
    /**
     * Returns decimal separator
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_decimal_separator()
    {
        $settings = $this->get_settings();
        return apply_filters('mec_decimal_separator', ((isset($settings['decimal_separator_status']) and $settings['decimal_separator_status'] == 0) ? false : (isset($settings['decimal_separator']) ? $settings['decimal_separator'] : '.')));
    }
    
    /**
     * Returns currency of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_currency()
    {
        $settings = $this->get_settings();
        return apply_filters('mec_currency', (isset($settings['currency']) ? $settings['currency'] : ''));
    }
    
    /**
     * Returns currency sign of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_currency_sign()
    {
        $settings = $this->get_settings();
        
        // Get Currency Symptom
        $currency = isset($settings['currency']) ? $settings['currency'] : '';
        if(isset($settings['currency_symptom']) and trim($settings['currency_symptom'])) $currency = $settings['currency_symptom'];
        
        return apply_filters('mec_currency_sign', $currency);
    }
    
    /**
     * Returns currency code of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_currency_code()
    {
        $currency = $this->get_currency();
        $currencies = $this->get_currencies();
        
        return isset($currencies[$currency]) ? $currencies[$currency] : 'USD';
    }
    
    /**
     * Returns currency sign position of MEC
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_currency_sign_position()
    {
        $settings = $this->get_settings();
        return apply_filters('mec_currency_sign_position', (isset($settings['currency_sign']) ? $settings['currency_sign'] : ''));
    }
    
    /**
     * Returns MEC Payment Gateways
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_gateways()
    {
        return apply_filters('mec_gateways', array());
    }
    
    /**
     * Check to see if user exists by its username
     * @author Webnus <info@webnus.biz>
     * @param string $username
     * @return boolean
     */
    public function username_exists($username)
    {
        /** first validation **/
        if(!trim($username)) return true;
        
        return username_exists($username);
    }
    
    /**
     * Check to see if user exists by its email
     * @author Webnus <info@webnus.biz>
     * @param string $email
     * @return boolean
     */
    public function email_exists($email)
    {
        /** first validation **/
        if(!trim($email)) return true;
        
        return email_exists($email);
    }
    
    /**
     * Register a user in WordPress
     * @author Webnus <info@webnus.biz>
     * @param string $username
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function register_user($username, $email, $password = NULL)
    {
        /** first validation **/
        if(!trim($username) or !trim($email)) return false;
        
        return wp_create_user($username, $password, $email);
    }
    
    /**
     * Convert a formatted date into standard format
     * @author Webnus <info@webnus.biz>
     * @param string $date
     * @return string
     */
    public function to_standard_date($date)
    {
        return date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    }
    
    /**
     * Render the date
     * @author Webnus <info@webnus.biz>
     * @param string $date
     * @return string
     */
    public function render_date($date)
    {
        return $date;
    }

    /**
     * Generate output of MEC Dashboard
     * @author Webnus <info@webnus.biz>
     */
    public function dashboard()
    {
        // Import dashboard page of MEC
        $path = $this->import('app.features.mec.dashboard', true, true);
        
        // Create mec_events table if it's removed for any reason
        $this->create_mec_tables();
            
        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }
    
    /**
     * Redirect on plugin activation
     * @author Webnus <info@webnus.biz>
     */
    public function mec_redirect_after_activate()
    {
        // No need to redirect
        if(!get_option('mec_activation_redirect', false)) return true;
        
        // Delete the option to don't do it always
        delete_option('mec_activation_redirect');
            
        // Redirect to MEC Dashboard
        wp_redirect(admin_url('/admin.php?page=mec-intro'));
        exit;
    }
    
    /**
     * Check if we can show booking module or not
     * @author Webnus <info@webnus.biz>
     * @param object $event
     * @return boolean
     */
    public function can_show_booking_module($event)
    {
        // MEC Settings
        $settings = $this->get_settings();

        // Booking on single page is disabled
        if(!isset($settings['booking_status']) or (isset($settings['booking_status']) and !$settings['booking_status'])) return false;
        
        $tickets = isset($event->data->tickets) ? $event->data->tickets : array();
        $dates = isset($event->dates) ? $event->dates : array();
        $next_date = isset($dates[0]) ? $dates[0] : (isset($event->date) ? $event->date : array());
        
        // No Dates or no Tickets
        if(!count($dates) or !count($tickets)) return false;
        
        // The event is Expired/Passed
        if(!isset($next_date['start']) or (isset($next_date['start']) and $this->is_past($next_date['start']['date'], date('Y-m-d')))) return false;
        
        // MEC payment gateways
        $gateways = $this->get_gateways();
        $is_gateway_enabled = false;
        
        foreach($gateways as $gateway)
        {
            if($gateway->enabled())
            {
                $is_gateway_enabled = true;
                break;
            }
        }
        
        // No Payment gateway is enabled
        if(!$is_gateway_enabled) return false;
        
        return true;
    }
    
    /**
     * Check if we can show countdown module or not
     * @author Webnus <info@webnus.biz>
     * @param object $event
     * @return boolean
     */
    public function can_show_countdown_module($event)
    {
        // MEC Settings
        $settings = $this->get_settings();

        // Countdown on single page is disabled
        if(!isset($settings['countdown_status']) or (isset($settings['countdown_status']) and !$settings['countdown_status'])) return false;

        $date = $event->date;

        $start_date = (isset($date['start']) and isset($date['start']['date'])) ? $date['start']['date'] : date('Y-m-d');

        // The event is Expired/Passed
        if($this->is_past($start_date, date('Y-m-d'))) return;
        
        return true;
    }
    
    /**
     * Get default timezone of WordPress
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_timezone()
    {
        $timezone_string = get_option('timezone_string');
        $gmt_offset = get_option('gmt_offset');
        
        if(trim($timezone_string) == '' and trim($gmt_offset))
        {
            $seconds = $gmt_offset*3600;
            $timezone_string = timezone_name_from_abbr('', $seconds, 1);
        }
        elseif(trim($timezone_string) == '' and trim($gmt_offset) == '0')
        {
            $timezone_string = 'UTC';
        }
        
        return $timezone_string;
    }
    
    /**
     * Get GMT offset based on hours:minutes
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_gmt_offset()
    {
        $gmt_offset = get_option('gmt_offset');
        
        $minutes = $gmt_offset*60;
        $hour_minutes = sprintf("%02d", ($minutes%60));
        
        // Convert the hour into two digits format
        $h = ($minutes-$hour_minutes)/60;
        $hours = sprintf("%02d", abs($h));
        
        // Add - sign to the first of hour if it's negative
        if($h < 0) $hours = '-'.$hours;
        
        return (substr($hours, 0, 1) == '-' ? '' : '+').$hours.':'.$hour_minutes;
    }
    
    /**
     * Get GMT offset based on seconds
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_gmt_offset_seconds()
    {
        $gmt_offset = get_option('gmt_offset');
        $seconds = $gmt_offset*3600;
        
        return (substr($gmt_offset, 0, 1) == '-' ? '' : '+').$seconds;
    }
    
    /**
     * Get status of Google recaptcha
     * @author Webnus <info@webnus.biz>
     * @return boolean
     */
    public function get_recaptcha_status($section = '')
    {
        // MEC Settings
        $settings = $this->get_settings();
        
        $status = false;
        
        // Check if the feature is enabled
        if(isset($settings['google_recaptcha_status']) and $settings['google_recaptcha_status']) $status = true;
        
        // Check if the feature is enabled for certain section
        if($status and trim($section) and (!isset($settings['google_recaptcha_'.$section]) or (isset($settings['google_recaptcha_'.$section]) and !$settings['google_recaptcha_'.$section]))) $status = false;
        
        // Check if site key and secret key is not empty
        if($status and (!isset($settings['google_recaptcha_sitekey']) or (isset($settings['google_recaptcha_sitekey']) and trim($settings['google_recaptcha_sitekey']) == ''))) $status = false;
        if($status and (!isset($settings['google_recaptcha_secretkey']) or (isset($settings['google_recaptcha_secretkey']) and trim($settings['google_recaptcha_secretkey']) == ''))) $status = false;
        
        return $status;
    }
    
    /**
     * Get re-captcha verification from Google servers
     * @author Webnus <info@webnus.biz>
     * @param string $remote_ip
     * @param string $response
     * @return boolean
     */
    public function get_recaptcha_response($response, $remote_ip = NULL)
    {
        // get the IP
        if(is_null($remote_ip)) $remote_ip = (isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '');
        
        // MEC Settings
        $settings = $this->get_settings();
        
        $data = array('secret'=>(isset($settings['google_recaptcha_secretkey']) ? $settings['google_recaptcha_secretkey'] : ''), 'remoteip'=>$remote_ip, 'v'=>'php_1.0', 'response'=>$response);
                
        $req = "";
        foreach($data as $key=>$value) $req .= $key.'='.urlencode(stripslashes($value)).'&';
        
        // Validate the re-captcha
        $getResponse = $this->get_web_page("https://www.google.com/recaptcha/api/siteverify?".trim($req, '& '));
        
        $answers = json_decode($getResponse, true);
        
        if(isset($answers['success']) and trim($answers['success'])) return true;
        else return false;
    }
    
    /**
     * Get current language of WordPress
     * @author Webnus <info@webnus.biz>
     * @return string
     */
    public function get_current_language()
    {
        return apply_filters('plugin_locale', get_locale(), 'mec');
    }
    
    /**
     * Write to a log file
     * @author Webnus <info@webnus.biz>
     * @param string $log_msg
     * @param string $path
     */
    public function debug_log($log_msg, $path = '')
	{
		if(trim($path) == '') $path = _MEC_ABSPATH_. 'log.txt';
        
		$fh = fopen($path, 'a');
        fwrite($fh, $log_msg);
	}
    
    /**
     * Filter Skin parameters to add taxonomy, etc filters that come from WordPress Query
     * This used for taxonomy archive pages etc that are handled by WordPress itself
     * @author Webnus <info@webnus.biz>
     * @param array $atts
     * @return array
     */
    public function add_search_filters($atts = array())
    {
        // Taxonomy Archive Page
        if(is_tax())
        {
            $query = get_queried_object();
            $term_id = $query->term_id;
            
            if(!isset($atts['category'])) $atts['category'] = '';
            
            $atts['category'] = trim(trim($atts['category'], ', ').','.$term_id, ', ');
        }
        
        return $atts;
    }
    
    /**
     * Return date_diff
     * @author Webnus <info@webnus.biz>
     * @param string $start_date
     * @param string $end_date
     * @return object
     */
    public function date_diff($start_date, $end_date)
    {
        if(version_compare(PHP_VERSION, '5.3.0', '>=')) return date_diff(date_create($start_date), date_create($end_date));
        else
        {
            $start = new DateTime($start_date);
            $end = new DateTime($end_date);
            $days = round(($end->format('U') - $start->format('U')) / (60*60*24));
            
            $interval = new stdClass();
            $interval->days = abs($days);
            $interval->invert = ($days >= 0 ? 0 : 1);
            
            return $interval;
        }
    }
    
    /**
     * Convert a certain time into seconds (Hours should be in 24 hours format)
     * @author Webnus <info@webnus.biz>
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @return int
     */
    public function time_to_seconds($hours, $minutes = 0, $seconds = 0)
    {
        return (($hours * 3600) + ($minutes * 60) + $seconds);
    }
    
    /**
     * Convert a 12 hour format hour to a 24 format hour
     * @author Webnus <info@webnus.biz>
     * @param int $hour
     * @param string $ampm
     * @return int
     */
    public function to_24hours($hour, $ampm = 'PM')
    {
        $ampm = strtoupper($ampm);
        
        if($ampm == 'AM' and $hour < 12) return $hour;
        elseif($ampm == 'AM' and $hour == 12) return 24;
        elseif($ampm == 'PM' and $hour < 12) return $hour+12;
        elseif($ampm == 'PM' and $hour == 12) return 12;
        elseif($ampm == 'PM' and $hour > 12) return $hour;
    }
    
    /**
     * Get rendered events based on a certain criteria
     * @author Webnus <info@webnus.biz>
     * @param array $args
     * @return \stdClass
     */
    public function get_rendered_events($args = array())
    {
        $events = array();
        $sorted = array();

        // Parse the args
        $args = wp_parse_args($args, array(
                'post_type'=>$this->get_main_post_type(),
                'posts_per_page'=>'-1',
                'post_status'=>'publish'
            )
        );
        
        // The Query
        $query = new WP_Query($args);

        if($query->have_posts())
        {
            // MEC Render Library
            $render = $this->getRender();
            
            // The Loop
            while($query->have_posts())
            {
                $query->the_post();

                $event_id = get_the_ID();
                $rendered = $render->data($event_id);

                $data = new stdClass();
                $data->ID = $event_id;
                $data->data = $rendered;
                $data->dates = $render->dates($event_id, $rendered, 6);
                $data->date = isset($data->dates[0]) ? $data->dates[0] : array();

                // Caclculate event start time
                $event_start_time = strtotime($data->date['start']['date']) + $rendered->meta['mec_start_day_seconds'];

                // Add the event into the to be sorted array
                if(!isset($sorted[$event_start_time])) $sorted[$event_start_time] = array();
                $sorted[$event_start_time][] = $data;
            }

            ksort($sorted, SORT_NUMERIC);
        }

        // Add sorted events to the results
        foreach($sorted as $sorted_events)
        {
            if(!is_array($sorted_events)) continue;
            foreach($sorted_events as $sorted_event) $events[$sorted_event->ID] = $sorted_event;
        }

        // Restore original Post Data
        wp_reset_postdata();
        
        return $events;
    }
    
    /**
     * Duplicate an event
     * @author Webnus <info@webnus.biz>
     * @param int $post_id
     * @return boolean|int
     */
    public function duplicate($post_id)
    {
        // MEC DB Library
        $db = $this->getDB();
        
        $post = get_post($post_id);
        
        // Post is not exists
        if(!$post) return false;
        
        //new post data array
        $args = array
        (
            'comment_status'=>$post->comment_status,
            'ping_status'=>$post->ping_status,
            'post_author'=>$post->post_author,
            'post_content'=>$post->post_content,
            'post_excerpt'=>$post->post_excerpt,
            'post_name'=>$post->post_name,
            'post_parent'=>$post->post_parent,
            'post_password'=>$post->post_password,
            'post_status'=>'draft',
            'post_title'=>sprintf(__('Copy of %s', 'mec'), $post->post_title),
            'post_type'=>$post->post_type,
            'to_ping'=>$post->to_ping,
            'menu_order'=>$post->menu_order
        );
        
        // insert the new post
        $new_post_id = wp_insert_post($args);
        
        // get all current post terms ad set them to the new post draft
        $taxonomies = get_object_taxonomies($post->post_type);
        foreach($taxonomies as $taxonomy)
        {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields'=>'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
        
        // duplicate all post meta
        $post_metas = $db->select("SELECT `meta_key`, `meta_value` FROM `#__postmeta` WHERE `post_id`='$post_id'", 'loadObjectList');
        if(count($post_metas) != 0)
        {
            $sql_query = "INSERT INTO `#__postmeta` (post_id, meta_key, meta_value) ";
            
            foreach($post_metas as $meta_info)
            {
                $meta_key = $meta_info->meta_key;
                $meta_value = addslashes($meta_info->meta_value);
                
                $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            
            $sql_query .= implode(" UNION ALL ", $sql_query_sel);
            $db->q($sql_query);
        }
        
        // Duplicate MEC record
        $mec_data = $db->select("SELECT * FROM `#__mec_events` WHERE `post_id`='$post_id'", 'loadAssoc');
        
        $q1 = "";
        $q2 = "";
        foreach($mec_data as $key=>$value)
        {
            if(in_array($key, array('id', 'post_id'))) continue;
            
            $q1 .= "`$key`,";
            $q2 .= "'$value',";
        }
        
        $db->q("INSERT INTO `#__mec_events` (`post_id`,".trim($q1, ', ').") VALUES ('$new_post_id',".trim($q2, ', ').")");
        
        return $new_post_id;
    }
    
    /**
     * Returns start/end date label
     * @author Webnus <info@webnus.biz>
     * @param array $start
     * @param array $end
     * @param string $format
     * @param string $separator
     * @return string
     */
    public function date_label($start, $end, $format, $separator = ' - ')
    {
        $start_timestamp = strtotime($start['date']);
        $end_timestamp = strtotime($end['date']);
        
        if($start_timestamp >= $end_timestamp) return date_i18n($format, $start_timestamp);
        elseif($start_timestamp < $end_timestamp)
        {
            $start_date = date_i18n($format, $start_timestamp);
            $end_date = date_i18n($format, $end_timestamp);

            if($start_date == $end_date) return $start_date;
            else return date_i18n($format, $start_timestamp).'<span class="mec-end-date-label">'.$separator.date_i18n($format, $end_timestamp).'</span>';
        }
    }
    
    /**
     * Returns end date of an event based on start date
     * @author Webnus <info@webnus.biz>
     * @param string $date
     * @param array $event
     * @return string
     */
    public function get_end_date($date, $event = array())
    {
        $start_date = isset($event->meta['mec_date']['start']) ? $event->meta['mec_date']['start'] : array();
        $end_date = isset($event->meta['mec_date']['end']) ? $event->meta['mec_date']['end'] : array();
        
        $event_period = $this->date_diff($start_date['date'], $end_date['date']);
        $event_period_days = $event_period ? $event_period->days : 0;
        
        $finish_date = array('date'=>$event->mec->end, 'hour'=>$event->meta['mec_date']['end']['hour'], 'minutes'=>$event->meta['mec_date']['end']['minutes'], 'ampm'=>$event->meta['mec_date']['end']['ampm']);
        
        // Event Passed
        $past = $this->is_past($finish_date['date'], $date);
        
        // Normal event
        if(isset($event->mec->repeat) and $event->mec->repeat == '0')
        {
            return isset($end_date['date']) ? $end_date['date'] : $date;
        }
        // Past Event
        elseif($past)
        {
            return isset($end_date['date']) ? $end_date['date'] : $date;
        }
        elseif(!$past)
        {
            /**
             * Multiple Day Event
             * Check to see if today is between start day and end day.
             * For example start day is 5 and end day is 15 but we're in 9th so only 6 days remained till ending the event not 10 days.
             */
            if($event_period_days)
            {
                $start_day = date('j', strtotime($start_date['date']));
                $day = date('j', strtotime($date));
                
                $passed_days = 0;
                if($day >= $start_day) $passed_days = $day - $start_day;
                else $passed_days = ($day+date('t', strtotime($start_date['date']))) - $start_day;
                
                $event_period_days = $event_period_days - $passed_days;
            }
            
            return date('Y-m-d', strtotime('+'.$event_period_days.' Days', strtotime($date)));
        }
    }
    
    /**
     * Get Archive Status of MEC
     * @author Webnus <info@webnus.biz>
     * @return int
     */
    public function get_archive_status()
    {
        $settings = $this->get_settings();
        
        $status = isset($settings['archive_status']) ? $settings['archive_status'] : '1';
        return apply_filters('mec_archive_status', $status);
    }
    
    /**
     * Check to see if a table exists or not
     * @author Webnus <info@webnus.biz>
     * @param string $table
     * @return boolean
     */
    public function table_exists($table = 'mec_events')
    {
        // MEC DB library
        $db = $this->getDB();
        
        return $db->q("SHOW TABLES LIKE '#__$table'");
    }
    
    /**
     * Create MEC Tables
     * @author Webnus <info@webnus.biz>
     * @return boolean
     */
    public function create_mec_tables()
    {
        // MEC Events table already exists
        if($this->table_exists()) return true;
        
        // MEC File library
        $file = $this->getFile();
        
        // MEC DB library
        $db = $this->getDB();
        
        // Run Queries
        $query_file = _MEC_ABSPATH_. 'assets' .DS. 'sql' .DS. 'tables.sql';
		if($file->exists($query_file))
		{
			$queries = $file->read($query_file);
            $sqls = explode(';', $queries);
			
            foreach($sqls as $sql)
            {
                $sql = trim($sql, '; ');
                if(trim($sql) == '') continue;
                
                $sql .= ';';
                
                try
                {
                    $db->q($sql);
                }
                catch (Exception $e){}
            }
		}
    }
    
    /**
     * Return HTML email type
     * @author Webnus <info@webnus.biz>
     * @param string $content_type
     * @return string
     */
    public function html_email_type($content_type)
    {
        return 'text/html';
    }
    
    public function get_next_upcoming_event()
    {
        MEC::import('app.skins.list', true);
        
        // Get list skin
        $list = new MEC_skin_list();
        
        // Attributes
        $atts = array(
            'show_past_events'=>0,
            'start_date_type'=>'today',
            'limit'=>1,
        );
        
        // Initialize the skin
        $list->initialize($atts);
        
        // Fetch the events
        $list->fetch();
        
        $events = $list->events;
        $key = key($events);
        
        return (isset($events[$key][0]) ? $events[$key][0] : array());
    }
    
    /**
     * Return a web page
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param array $post
     * @param boolean|string $authentication
     * @return string
     */
    public function get_web_page($url, $post = '', $authentication = false)
	{
		$result = false;

		// Doing the curl
		if(function_exists('curl_version'))
		{
			$ch = curl_init($url);

			if(is_resource($ch) === true)
			{
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_AUTOREFERER, true);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
				curl_setopt($ch, CURLOPT_TIMEOUT, 120);

                @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

				if($post)
				{
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, (is_array($post) === true) ? http_build_query($post, '', '&') : $post);
				}

                /** login needed **/
                if($authentication)
                {
                    curl_setopt($ch, CURLOPT_USERPWD, $authentication);
                }

				$result = curl_exec($ch);
				curl_close($ch);
			}
		}

		// Doing FGC
		if($result == false)
		{
			if($post != '')
			{
				$http['method'] = 'POST';
				$http['header'] = 'Content-Type: application/x-www-form-urlencoded';
				$http['content'] = (is_array($post) === true) ? http_build_query($post, '', '&') : $post;
			}

			$result = @file_get_contents($url, false, stream_context_create(array('http'=>$http)));
		}

		return $result;
	}
    
    public function save_events($events = array())
    {
        $ids = array();
        
        foreach($events as $event) $ids[] = $this->save_event($event, (isset($event['ID']) ? $event['ID'] : NULL));
        return $ids;
    }
    
    public function save_event($event = array(), $post_id = NULL)
    {
        $post = array('post_title'=>$event['title'], 'post_content'=>(isset($event['content']) ? $event['content'] : ''), 'post_type'=>$this->get_main_post_type(), 'post_status'=>(isset($event['status']) ? $event['status'] : 'publish'));
        
        // Update previously inserted post
        if(!is_null($post_id)) $post['ID'] = $post_id;
        
        $post_id = wp_insert_post($post);

        update_post_meta($post_id, 'mec_location_id', (isset($event['location_id']) ? $event['location_id'] : 1));
        update_post_meta($post_id, 'mec_dont_show_map', 0);
        update_post_meta($post_id, 'mec_organizer_id', (isset($event['organizer_id']) ? $event['organizer_id'] : 1));
        
        $start_time_hour = (isset($event['start_time_hour']) ? $event['start_time_hour'] : 8);
        $start_time_minutes = (isset($event['start_time_minutes']) ? $event['start_time_minutes'] : 0);
        $start_time_ampm = (isset($event['start_time_ampm']) ? $event['start_time_ampm'] : 'AM');
        
        $end_time_hour = (isset($event['end_time_hour']) ? $event['end_time_hour'] : 6);
        $end_time_minutes = (isset($event['end_time_minutes']) ? $event['end_time_minutes'] : 0);
        $end_time_ampm = (isset($event['end_time_ampm']) ? $event['end_time_ampm'] : 'PM');
        
        $allday = (isset($event['allday']) ? $event['allday'] : 0);
        $time_comment = (isset($event['time_comment']) ? $event['time_comment'] : '');
        
        $day_start_seconds = $this->time_to_seconds($this->to_24hours($start_time_hour, $start_time_ampm), $start_time_minutes);
        $day_end_seconds = $this->time_to_seconds($this->to_24hours($end_time_hour, $end_time_ampm), $end_time_minutes);
        
        update_post_meta($post_id, 'mec_start_date', $event['start']);
        update_post_meta($post_id, 'mec_start_time_hour', $start_time_hour);
        update_post_meta($post_id, 'mec_start_time_minutes', $start_time_minutes);
        update_post_meta($post_id, 'mec_start_time_ampm', $start_time_ampm);
        update_post_meta($post_id, 'mec_start_day_seconds', $day_start_seconds);

        update_post_meta($post_id, 'mec_end_date', $event['end']);
        update_post_meta($post_id, 'mec_end_time_hour', $end_time_hour);
        update_post_meta($post_id, 'mec_end_time_minutes', $end_time_minutes);
        update_post_meta($post_id, 'mec_end_time_ampm', $end_time_ampm);
        update_post_meta($post_id, 'mec_end_day_seconds', $day_end_seconds);

        update_post_meta($post_id, 'mec_repeat_status', $event['repeat_status']);
        update_post_meta($post_id, 'mec_repeat_type', $event['repeat_type']);
        update_post_meta($post_id, 'mec_repeat_interval', $event['interval']);

        update_post_meta($post_id, 'mec_certain_weekdays', explode(',', trim((isset($event['weekdays']) ? $event['weekdays'] : ''), ', ')));
        
        $date = array
        (
            'start'=>array('date'=>$event['start'], 'hour'=>$start_time_hour, 'minutes'=>$start_time_minutes, 'ampm'=>$start_time_ampm),
            'end'=>array('date'=>$event['end'], 'hour'=>$end_time_hour, 'minutes'=>$end_time_minutes, 'ampm'=>$end_time_ampm),
            'repeat'=>((isset($event['date']) and isset($event['date']['repeat']) and is_array($event['date']['repeat'])) ? $event['date']['repeat'] : array()),
            'allday'=>$allday,
            'hide_time'=>0,
            'hide_end_time'=>((isset($event['date']) and isset($event['date']['hide_end_time'])) ? $event['date']['hide_end_time'] : 0),
            'comment'=>$time_comment,
        );

        update_post_meta($post_id, 'mec_date', $date);

        // Creating $mec array for inserting in mec_events table
        $mec = array('post_id'=>$post_id, 'start'=>$event['start'], 'repeat'=>$event['repeat_status'], 'rinterval'=>$event['interval'], 'time_start'=>$day_start_seconds, 'time_end'=>$day_end_seconds);

        // Add parameters to the $mec
        $mec['end'] = isset($event['finish']) ? $event['finish'] : '0000-00-00';
        $mec['year'] = isset($event['year']) ? $event['year'] : NULL;
        $mec['month'] = isset($event['month']) ? $event['month'] : NULL;
        $mec['day'] = isset($event['day']) ? $event['day'] : NULL;
        $mec['week'] = isset($event['week']) ? $event['week'] : NULL;
        $mec['weekday'] = isset($event['weekday']) ? $event['weekday'] : NULL;
        $mec['weekdays'] = isset($event['weekdays']) ? $event['weekdays'] : NULL;
        $mec['days'] = isset($event['days']) ? $event['days'] : '';
        
        // MEC DB Library
        $db = $this->getDB();
        
        // Update MEC Events Table
        $mec_event_id = $db->select("SELECT `id` FROM `#__mec_events` WHERE `post_id`='$post_id'", 'loadResult');
        
        if(!$mec_event_id)
        {
            $q1 = "";
            $q2 = "";

            foreach($mec as $key=>$value)
            {
                $q1 .= "`$key`,";

                if(is_null($value)) $q2 .= "NULL,";
                else $q2 .= "'$value',";
            }

            $db->q("INSERT INTO `#__mec_events` (".trim($q1, ', ').") VALUES (".trim($q2, ', ').")", 'INSERT');
        }
        else
        {
            $q = "";
            
            foreach($mec as $key=>$value)
            {
                if(is_null($value)) $q .= "`$key`=NULL,";
                else $q .= "`$key`='$value',";
            }
            
            $db->q("UPDATE `#__mec_events` SET ".trim($q, ', ')." WHERE `id`='$mec_event_id'");
        }

        if(isset($event['meta']) and is_array($event['meta'])) foreach($event['meta'] as $key=>$value) update_post_meta($post_id, $key, $value);
        
        return $post_id;
    }
    
    public function save_category($category = array())
    {
        $name = isset($category['name']) ? $category['name'] : '';
        if(!trim($name)) return false;
        
        $term = get_term_by('name', $name, 'mec_category');
        
        // Term already exists
        if(is_object($term) and isset($term->term_id)) return $term->term_id;
        
        $term = wp_insert_term($name, 'mec_category');
        
        // An error ocurred
        if(is_wp_error($term)) return false;
        
        $category_id = $term['term_id'];
        if(!$category_id) return false;
        
        return $category_id;
    }
    
    public function save_organizer($organizer = array())
    {
        $name = isset($organizer['name']) ? $organizer['name'] : '';
        if(!trim($name)) return false;
        
        $term = get_term_by('name', $name, 'mec_organizer');
        
        // Term already exists
        if(is_object($term) and isset($term->term_id)) return $term->term_id;
        
        $term = wp_insert_term($name, 'mec_organizer');
        
        // An error ocurred
        if(is_wp_error($term)) return false;
        
        $organizer_id = $term['term_id'];
        if(!$organizer_id) return false;
            
        $tel = (isset($organizer['tel']) and trim($organizer['tel'])) ? $organizer['tel'] : '';
        $email = (isset($organizer['email']) and trim($organizer['email'])) ? $organizer['email'] : '';
        $url = (isset($organizer['url']) and trim($organizer['url'])) ? $organizer['url'] : '';
        
        update_term_meta($organizer_id, 'tel', $tel);
        update_term_meta($organizer_id, 'email', $email);
        update_term_meta($organizer_id, 'url', $url);
        
        return $organizer_id;
    }

    public function save_location($location = array())
    {
        $name = isset($location['name']) ? $location['name'] : '';
        if(!trim($name)) return false;

        $term = get_term_by('name', $name, 'mec_location');

        // Term already exists
        if(is_object($term) and isset($term->term_id)) return $term->term_id;

        $term = wp_insert_term($name, 'mec_location');

        // An error ocurred
        if(is_wp_error($term)) return false;

        $location_id = $term['term_id'];
        if(!$location_id) return false;

        $latitude = (isset($location['latitude']) and trim($location['latitude'])) ? $location['latitude'] : 0;
        $longitude = (isset($location['longitude']) and trim($location['longitude'])) ? $location['longitude'] : 0;
        $address = isset($location['address']) ? $location['address'] : '';

        if(!trim($latitude) or !trim($longitude))
        {
            $geo_point = $this->get_lat_lng($address);

            $latitude = $geo_point[0];
            $longitude = $geo_point[1];
        }

        update_term_meta($location_id, 'address', $address);
        update_term_meta($location_id, 'latitude', $latitude);
        update_term_meta($location_id, 'longitude', $longitude);

        return $location_id;
    }
    
    /**
     * Returns data export array for one event
     * @author Webnus <info@webnus.biz>
     * @param int $event_id
     * @return string
     */
    public function export_single($event_id)
    {
        // MEC Render Library
        $render = $this->getRender();
        
        return $render->data($event_id);
    }
    
    /**
     * Converts array to XML string
     * @author Webnus <info@webnus.biz>
     * @param array $data
     * @return string
     */
    public function xml_convert($data)
    {
        $main_node = array_keys($data);
        
        // Creating SimpleXMLElement object
        $xml = new SimpleXMLElement('<?xml version="1.0"?><'.$main_node[0].'></'.$main_node[0].'>');
        
        // Convert array to xml
        $this->array_to_xml($data[$main_node[0]], $xml);
        
        // Return XML String
        return $xml->asXML();
    }
    
    public function array_to_xml($data, &$xml)
    {
        foreach($data as $key=>$value)
        {
            if(is_numeric($key)) $key = 'item';

            if(is_array($value))
            {
                $subnode = $xml->addChild($key);
                $this->array_to_xml($value, $subnode);
            }
            elseif(is_object($value))
            {
                $subnode = $xml->addChild($key);
                $this->array_to_xml($value, $subnode);
            }
            else
            {
                $xml->addChild($key, htmlspecialchars($value));
            }
        }
    }
    
    /**
     * Returns Weekdays Day Numbers
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_weekdays()
    {
        $weekdays = array(1,2,3,4,5);
        
        // Get weekdays from options
        $settings = $this->get_settings();
        if(isset($settings['weekdays']) and is_array($settings['weekdays']) and count($settings['weekdays'])) $weekdays = $settings['weekdays'];
        
        return apply_filters('mec_weekday_numbers', $weekdays);
    }
    
    /**
     * Returns Weekends Day Numbers
     * @author Webnus <info@webnus.biz>
     * @return array
     */
    public function get_weekends()
    {
        $weekends = array(6,7);
        
        // Get weekdays from options
        $settings = $this->get_settings();
        if(isset($settings['weekends']) and is_array($settings['weekends']) and count($settings['weekends'])) $weekends = $settings['weekends'];
        
        return apply_filters('mec_weekend_numbers', $weekends);
    }
    
    /**
     * Returns Event link with Occurrence Date
     * @author Webnus <info@webnus.biz>
     * @param string $url
     * @param string $date
     * @return string
     */
    public function get_event_date_permalink($url, $date = NULL, $force = false)
    {
        if(is_null($date)) return $url;
        
        // Get MEC Options
        $settings = $this->get_settings();
        
        // Single Page Date method is set to next date
        if(!$force and (!isset($settings['single_date_method']) or (isset($settings['single_date_method']) and $settings['single_date_method'] == 'next'))) return $url;
        
        return $this->add_qs_var('occurrence', $date, $url);
    }
    
    /**
     * Register MEC Activity Action Type in BuddeyPress
     * @return void
     */
    public function bp_register_activity_actions()
    {
        bp_activity_set_action(
            'mec',
            'booked_event',
            __('Booked an event.', 'mec')
        );
    }
    
    /**
     * Add a new activity to BuddyPress when a user book an event
     * @param int $book_id
     * @return boolean|int
     */
    public function bp_add_activity($book_id)
    {
        // Get MEC Options
        $settings = $this->get_settings();
        
        // BuddyPress integration is disabled
        if(!isset($settings['bp_status']) or (isset($settings['bp_status']) and !$settings['bp_status'])) return false;
        
        // BuddyPress add activity is disabled
        if(!isset($settings['bp_add_activity']) or (isset($settings['bp_add_activity']) and !$settings['bp_add_activity'])) return false;
        
        // BuddyPress is not installed or activated
        if(!function_exists('bp_activity_add')) return false;
        
        $verification = get_post_meta($book_id, 'mec_verified', true);
        $confirmation = get_post_meta($book_id, 'mec_confirmed', true);
        
        // Booking is not verified or confirmed
        if($verification != 1 or $confirmation != 1) return false;
        
        $event_id = get_post_meta($book_id, 'mec_event_id', true);
        $booker_id = get_post_field('post_author', $book_id);
        
        $event_title = get_the_title($event_id);
        $event_link = get_the_permalink($event_id);
        
        $profile_link = bp_core_get_userlink($booker_id);
        $bp_activity_id = get_post_meta($book_id, 'mec_bp_activity_id', true);
        
        $activity_id = bp_activity_add(array
        (
            'id'=>$bp_activity_id,
            'action'=>sprintf(__('%s booked %s event.', 'mec'), $profile_link, '<a href="'.$event_link.'">'.$event_title.'</a>'),
            'component'=>'mec',
            'type'=>'booked_event',
            'primary_link'=>$event_link,
            'user_id'=>$booker_id,
            'item_id'=>$book_id,
            'secondary_item_id'=>$event_id,
        ));
        
        // Set Activity ID
        update_post_meta($book_id, 'mec_bp_activity_id', $activity_id);
        
        return $activity_id;
    }
    
    /**
     * Add booker information to mailchim list
     * @param int $book_id
     * @return boolean}int
     */
    public function mailchimp_add_subscriber($book_id)
    {
        // Get MEC Options
        $settings = $this->get_settings();
        
        // Mailchim integration is disabled
        if(!isset($settings['mchimp_status']) or (isset($settings['mchimp_status']) and !$settings['mchimp_status'])) return false;
        
        $api_key = isset($settings['mchimp_api_key']) ? $settings['mchimp_api_key'] : '';
        $list_id = isset($settings['mchimp_list_id']) ? $settings['mchimp_list_id'] : '';
        
        // Mailchim credentials are required
        if(!trim($api_key) or !trim($list_id)) return false;
        
        $booker_id = get_post_field('post_author', $book_id);
        $booker = get_userdata($booker_id);
        
        $data_center = substr($api_key, strpos($api_key, '-') + 1);
        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/';
        
        $subscription_status = isset($settings['mchimp_subscription_status']) ? $settings['mchimp_subscription_status'] : 'subscribed';
        $json = json_encode(array
        (
            'email_address'=>$booker->user_email,
            'status'=>$subscription_status,
            'merge_fields'=>array
            (
                'FNAME'=>$booker->first_name,
                'LNAME'=>$booker->last_name
            )
        ));

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return $http_code;
    }
    
    /**
     * Returns Booking of a certain event at certain date
     * @param int $event_id
     * @param string $date
     * @return array
     */
    public function get_bookings($event_id, $date, $limit = '-1')
    {
        $time = strtotime($date);
        
        $q = new WP_Query();
        return $q->query(array
        (
            'post_type'=>$this->get_book_post_type(),
            'posts_per_page'=>$limit,
            'post_status'=>array('future', 'publish'),
            'meta_query'=>array
            (
                array(
                    'key'=>'mec_event_id',
                    'value'=>$event_id,
                ),
                array(
                    'key'=>'mec_confirmed',
                    'value'=>1,
                ),
                array(
                    'key'=>'mec_verified',
                    'value'=>1,
                ),
            ),
            'year'=>date('Y', $time),
            'monthnum'=>date('n', $time),
            'day'=>date('j', $time),
        ));
    }
    
    /**
     * Check whether to show event note or not
     * @param string $status
     * @return boolean
     */
    public function is_note_visible($status)
    {
        // MEC Settings
        $settings = $this->get_settings();
        
        // FES Note is not enabled
        if(!isset($settings['fes_note']) or (isset($settings['fes_note']) and !$settings['fes_note'])) return false;
        
        // Return visibility status by post status and visibility method
        return (isset($settings['fes_note_visibility']) ? ($settings['fes_note_visibility'] == 'always' ? true : $status != 'publish') : true);
    }
    
    /**
     * Get Next event based on datetime of current event
     * @param array $atts
     * @return array
     */
    public function get_next_event($atts = array())
    {
        MEC::import('app.skins.list', true);
        
        // Get list skin
        $list = new MEC_skin_list();
        
        // Initialize the skin
        $list->initialize($atts);
        
        // Fetch the events
        $list->fetch();
        
        $events = $list->events;
        $key = key($events);
        
        return (isset($events[$key][0]) ? $events[$key][0] : array());
    }
    
    /**
     * For getting event end date based on occurrence date
     * @param int $event_id
     * @param string $occurrence
     * @return string
     */
    public function get_end_date_by_occurrence($event_id, $occurrence)
    {
        $event_date = get_post_meta($event_id, 'mec_date', true);
        
        $start_date = isset($event_date['start']) ? $event_date['start'] : array();
        $end_date = isset($event_date['end']) ? $event_date['end'] : array();
        
        $event_period = $this->date_diff($start_date['date'], $end_date['date']);
        $event_period_days = $event_period ? $event_period->days : 0;
        
        // Single Day Event
        if(!$event_period_days) return $occurrence;
        
        return date('Y-m-d', strtotime('+'.$event_period_days.' days', strtotime($occurrence)));
    }
    
    /**
     * Add MEC Event CPT to Tags Archive Page
     * @param object $query
     */
    public function add_events_to_tags_archive($query)
    {
        if($query->is_tag() and $query->is_main_query())
        {
            $pt = $this->get_main_post_type();
            $query->set('post_type', array('post', $pt));
        }
    }
    
    /**
     * Get Post ID by meta value and meta key
     * @param string $meta_key
     * @param string $meta_value
     * @return string
     */
    public function get_post_id_by_meta($meta_key, $meta_value)
    {
        $db = $this->getDB();
        return $db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$meta_value' AND `meta_key`='$meta_key'", 'loadResult');
    }
    
    /**
     * Set Featured Image for a Post
     * @param string $image_url
     * @param int $post_id
     * @return bool|int
     */
    public function set_featured_image($image_url, $post_id)
    {
        if(!$attach_id = $this->get_attach_id($image_url))
        {
            $upload_dir = wp_upload_dir();
            $filename = basename($image_url);

            if(wp_mkdir_p($upload_dir['path'])) $file = $upload_dir['path'].'/'.$filename;
            else $file = $upload_dir['basedir'].'/'.$filename;

            if(!file_exists($file))
            {
                $image_data = $this->get_web_page($image_url);
                file_put_contents($file, $image_data);
            }

            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type'=>$wp_filetype['type'],
                'post_title'=>sanitize_file_name($filename),
                'post_content'=>'',
                'post_status'=>'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $file, $post_id);
            require_once ABSPATH.'wp-admin/includes/image.php';

            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);
        }
        
        return set_post_thumbnail($post_id, $attach_id);
    }
    
    /**
     * Get Attachment ID by Image URL
     * @param string $image_url
     * @return int
     */
    public function get_attach_id($image_url)
    {
        $db = $this->getDB();
        return $db->select("SELECT `ID` FROM `#__posts` WHERE `guid`='$image_url'", 'loadResult');
    }
    
    /**
     * Get Image Type by Buffer. Used in Facebook Importer
     * @param string $buffer
     * @return string
     */
    public function get_image_type_by_buffer($buffer)
    {
        $types = array('jpeg'=>"\xFF\xD8\xFF", 'gif'=>'GIF', 'png'=>"\x89\x50\x4e\x47\x0d\x0a", 'bmp'=>'BM', 'psd'=>'8BPS', 'swf'=>'FWS');
        $found = 'other';

        foreach($types as $type=>$header)
        {
            if(strpos($buffer, $header) === 0)
            {
                $found = $type;
                break;
            }
        }
        
        return $found;
    }
    
    /**
     * Load Google Maps assets
     */
    public function load_map_assets()
    {
        // MEC Settings
        $settings = $this->get_settings();
        
        // Include Google Maps Javascript API
        $gm_include = apply_filters('mec_gm_include', true);
        if($gm_include) wp_enqueue_script('googlemap', '//maps.googleapis.com/maps/api/js?libraries=places'.((isset($settings['google_maps_api_key']) and trim($settings['google_maps_api_key']) != '') ? '&key='.$settings['google_maps_api_key'] : ''));
        
        // Google Maps Rich Marker
        wp_enqueue_script('mec-richmarker-script', $this->asset('packages/richmarker/richmarker.min.js'));
    }
    
    /**
     * Load Owl Carousel assets
     */
    public function load_owl_assets()
    {
        // Include MEC frontend CSS files
        wp_enqueue_style('mec-owl-carousel-style', $this->asset('packages/owl-carousel/owl.carousel.min.css'));
        wp_enqueue_style('mec-owl-carousel-theme-style', $this->asset('packages/owl-carousel/owl.theme.min.css'));
    }

    /**
     * Load Isotope assets
     */
    public function load_isotope_assets()
    {
        // Isotope JS file
        wp_enqueue_script('mec-isotope-script', $this->asset('js/isotope.pkgd.min.js'));
    }
    
    function get_client_ip()
    {
        $ipaddress = '';
        
        if(isset($_SERVER['HTTP_CLIENT_IP'])) $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        elseif(isset($_SERVER['HTTP_X_FORWARDED'])) $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])) $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        elseif(isset($_SERVER['HTTP_FORWARDED'])) $ipaddress = $_SERVER['HTTP_FORWARDED'];
        elseif(isset($_SERVER['REMOTE_ADDR'])) $ipaddress = $_SERVER['REMOTE_ADDR'];
        else $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function get_timezone_by_ip()
    {
        // Client IP
        $ip = $this->get_client_ip();
        
        // First Provider
        $JSON = $this->get_web_page('http://ip-api.com/json/'.$ip);
        $data = json_decode($JSON, true);
        
        // Second Provider
        if(!trim($JSON) or (is_array($data) and !isset($data['timezone'])))
        {
            $JSON = $this->get_web_page('https://ipapi.co/'.$ip.'/json/');
            $data = json_decode($JSON, true);
        }

        // Second provide returns X instead of false in case of error!
        return (isset($data['timezone']) and strtolower($data['timezone']) != 'x') ? $data['timezone'] : false;
    }
    
    public function is_ajax()
    {
        return (defined('DOING_AJAX') && DOING_AJAX);
    }
    
    public function load_sed_assets()
    {
        // Load Map assets
        $this->load_map_assets();
        
        // Include FlipCount library
        wp_enqueue_script('mec-flipcount-script', $this->asset('js/flipcount.js'));
    }
    
    public function is_sold($event, $date)
    {
        $tickets = isset($event->data->tickets) ? $event->data->tickets : array();
        
        // No Tickets
        if(!count($tickets)) return false;
        
        $bookings = $this->get_bookings($event->data->ID, $date);
        
        // No Bookings
        if(!count($bookings)) return false;
        
        $available_spots = '0';
        foreach($tickets as $ticket)
        {
            if((isset($ticket['unlimited']) and $ticket['unlimited']) or !trim($ticket['limit']))
            {
                $available_spots = '-1';
                break;
            }
            
            $available_spots += $ticket['limit'];
        }
        
        // There are unlimitted spots
        if($available_spots == '-1') return false;
        
        // Bookings are higher than available spots so event is sold
        if(count($bookings) >= $available_spots) return true;
        
        return false;
    }
    
    public function get_date_periods($date_start, $date_end, $type = 'daily')
    {
        $periods = array();
        
        $time_start = strtotime($date_start);
        $time_end = strtotime($date_end);
        
        if($type == 'daily')
        {
            while($time_start < $time_end)
            {
                $periods[] = array('start'=>date("Y-m-d H:i:s", $time_start), 'end'=>date("Y-m-d H:i:s", ($time_start+86399)), 'label'=>date("Y-m-d", $time_start));
                $time_start += 86400;
            }
        }
        // @todo
        elseif($type == 'weekly')
        {
        }
        elseif($type == 'monthly')
        {
            $start_year = date('Y', $time_start);
            $start_month = date('m', $time_start);
            $start_id = (int) $start_year.$start_month;
            
            $end_year = date('Y', $time_end);
            $end_month = date('m', $time_end);
            $end_id = (int) $end_year.$end_month;
            
            while($start_id <= $end_id)
            {
                $periods[] = array('start'=>$start_year."-".$start_month."-01 00:00:00", 'end'=>$start_year."-".$start_month."-".date('t', strtotime($start_year."-".$start_month."-01 00:00:00"))." 23:59:59", 'label'=>date('Y F', strtotime($start_year."-".$start_month."-01 00:00:00")));
                
                if($start_month == '12')
                {
                    $start_month = '01';
                    $start_year++;
                }
                else
                {
                    $start_month = (int) $start_month+1;
                    if(strlen($start_month) == 1) $start_month = '0'.$start_month;
                }
                
                $start_id = (int) $start_year.$start_month;
            }
        }
        elseif($type == 'yearly')
        {
            $start_year = date('Y', $time_start);
            $end_year = date('Y', $time_end);
            
            while($start_year <= $end_year)
            {
                $periods[] = array('start'=>$start_year."-01-01 00:00:00", 'end'=>$start_year."-12-31 23:59:59", 'label'=>$start_year);
                $start_year++;
            }
        }

        return $periods;
    }
    
    public function get_messages()
    {
        $messages = array(
            'taxonomies'=>array(
                'category'=>array('name'=>__('Taxonomies', 'mec')),
                'messages'=>array(
                    'taxonomy_categories'=>array('label'=>__('Category Plural Label', 'mec'), 'default'=>__('Categories', 'mec')),
                    'taxonomy_category'=>array('label'=>__('Category Singular Label', 'mec'), 'default'=>__('Category', 'mec')),
                    'taxonomy_labels'=>array('label'=>__('Label Plural Label', 'mec'), 'default'=>__('Labels', 'mec')),
                    'taxonomy_label'=>array('label'=>__('Label Singular Label', 'mec'), 'default'=>__('label', 'mec')),
                    'taxonomy_locations'=>array('label'=>__('Location Plural Label', 'mec'), 'default'=>__('Locations', 'mec')),
                    'taxonomy_location'=>array('label'=>__('Location Singular Label', 'mec'), 'default'=>__('Location', 'mec')),
                    'taxonomy_organizers'=>array('label'=>__('Organizer Plural Label', 'mec'), 'default'=>__('Organizers', 'mec')),
                    'taxonomy_organizer'=>array('label'=>__('Organizer Singular Label', 'mec'), 'default'=>__('Organizer', 'mec')),
                )
            ),
            'weekdays'=>array(
                'category'=>array('name'=>__('Weekdays', 'mec')),
                'messages'=>array(
                    'weekdays_su'=>array('label'=>__('Sunday abbreviation', 'mec'), 'default'=>__('SU', 'mec')),
                    'weekdays_mo'=>array('label'=>__('Monday abbreviation', 'mec'), 'default'=>__('MO', 'mec')),
                    'weekdays_tu'=>array('label'=>__('Tuesday abbreviation', 'mec'), 'default'=>__('TU', 'mec')),
                    'weekdays_we'=>array('label'=>__('Wednesday abbreviation', 'mec'), 'default'=>__('WE', 'mec')),
                    'weekdays_th'=>array('label'=>__('Thursday abbreviation', 'mec'), 'default'=>__('TH', 'mec')),
                    'weekdays_fr'=>array('label'=>__('Friday abbreviation', 'mec'), 'default'=>__('FR', 'mec')),
                    'weekdays_sa'=>array('label'=>__('Saturday abbreviation', 'mec'), 'default'=>__('SA', 'mec')),
                )
            ),
            'others'=>array(
                'category'=>array('name'=>__('Others', 'mec')),
                'messages'=>array(
                    'book_success_message'=>array('label'=>__('Booking Success Message', 'mec'), 'default'=>__('Thanks for your booking. Your tickets booked, booking verification might be needed, please check your email.', 'mec')),
                    'register_button'=>array('label'=>__('Register Button', 'mec'), 'default'=>__('REGISTER', 'mec')),
                    'view_detail'=>array('label'=>__('View Detail Button', 'mec'), 'default'=>__('View Detail', 'mec')),
                    'event_detail'=>array('label'=>__('Event Detail Button', 'mec'), 'default'=>__('Event Detail', 'mec')),
                    'read_more_link'=>array('label'=>__('Event Link', 'mec'), 'default'=>__('Event Link', 'mec')),
                    'more_info_link'=>array('label'=>__('More Info Link', 'mec'), 'default'=>__('More Info', 'mec')),
                    'event_cost'=>array('label'=>__('Event Cost', 'mec'), 'default'=>__('Event Cost', 'mec')),
                    'cost'=>array('label'=>__('Cost', 'mec'), 'default'=>__('Cost', 'mec')),
                    'ticket'=>array('label'=>__('Ticket (Singular)', 'mec'), 'default'=>__('Ticket', 'mec')),
                    'tickets'=>array('label'=>__('Tickets (Plural)', 'mec'), 'default'=>__('Tickets', 'mec')),
                    'other_organizers'=>array('label'=>__('Other Organizers', 'mec'), 'default'=>__('Other Organizers', 'mec')),
                )
            ),
        );

        return apply_filters('mec_messages', $messages);
    }
    
    /**
     * For showing dynamic messages based on their default value and the inserted value in backend (if any)
     * @param $message_key string
     * @param $default string
     * @return string
     */
    public function m($message_key, $default)
    {
        $message_values = $this->get_messages_options();
        
        // Message is not set from backend
        if(!isset($message_values[$message_key]) or (isset($message_values[$message_key]) and !trim($message_values[$message_key]))) return $default;
        
        // Return the dynamic message inserted in backend
        return $message_values[$message_key];
    }

    /**
     * Get Weather from the data provider
     * @param $lat
     * @param $lng
     * @param $datetime
     * @return bool|array
     */
    public function get_weather($lat, $lng, $datetime)
    {
        // MEC Settings
        $settings = $this->get_settings();

        // API KEY is required!
        if(!isset($settings['weather_module_api_key']) or (isset($settings['weather_module_api_key']) and !trim($settings['weather_module_api_key']))) return false;

        $locale = substr(get_locale(), 0, 2);

        // Dark Sky Provider
        $JSON = $this->get_web_page('https://api.darksky.net/forecast/'.$settings['weather_module_api_key'].'/'.$lat.','.$lng.','.strtotime($datetime).'?exclude=minutely,hourly,daily,alerts,flags&units=ca&lang='.$locale);
        $data = json_decode($JSON, true);

        return (isset($data['currently']) ? $data['currently'] : false);
    }

    /**
     * Get Integrated plugins to import events
     * @return array
     */
    public function get_integrated_plugins_for_import()
    {
        return array(
            'eventon' => __('EventON', 'mec'),
            'the-events-calendar' => __('The Events Calendar', 'mec'),
            'weekly-class' => __('Events Schedule WP Plugin', 'mec'),
        );
    }
}