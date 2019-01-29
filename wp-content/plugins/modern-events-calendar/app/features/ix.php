<?php
/** no direct access **/
defined('_MECEXEC_') or die();

/**
 * Webnus MEC Import / Export class. Requires PHP >= 5.3 otherwise it don't activate
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_ix extends MEC_base
{
    public $factory;
    public $main;
    public $db;
    public $action;
    public $ix;
    public $response;

    /**
     * Facebook App Access Token
     * @var string
     */
    private $fb_access_token = '1819770188280256|GyNKicqC8aT4Z7GVz_PptY-7kQQ';
    
    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        // Import MEC Factory
        $this->factory = $this->getFactory();
        
        // Import MEC Main
        $this->main = $this->getMain();
        
        // Import MEC DB
        $this->db = $this->getDB();
    }
    
    /**
     * Initialize IX feature
     * @author Webnus <info@webnus.biz>
     */
    public function init()
    {
        // Disable Import / Export Feature if autoload feature is not exists
        if(!function_exists('spl_autoload_register')) return;
        
        $this->factory->action('admin_menu', array($this, 'menus'), 20);
        
        // Import APIs
        $this->factory->action('init', array($this, 'include_google_api'));
        $this->factory->action('init', array($this, 'include_facebook_api'));
        
        // MEC IX Action
        $mec_ix_action = isset($_GET['mec-ix-action']) ? $_GET['mec-ix-action'] : '';
        
        // Export All Events
        if($mec_ix_action == 'export-events') $this->factory->action('init', array($this, 'export_all_events_do'), 9999);
        elseif($mec_ix_action == 'google-calendar-export-get-token') $this->factory->action('init', array($this, 'g_calendar_export_get_token'), 9999);
        
        // AJAX Actions
        $this->factory->action('wp_ajax_mec_ix_add_to_g_calendar', array($this, 'g_calendar_export_do'));
        $this->factory->action('wp_ajax_mec_ix_g_calendar_authenticate', array($this, 'g_calendar_export_authenticate'));
    }
    
    /**
     * Import Google API libraries
     * @author Webnus <info@webnus.biz>
     */
    public function include_google_api()
    {
        if(class_exists('Google_Client')) return;
        
        MEC::import('app.api.Google.autoload', false);
    }
    
    /**
     * Import Facebook API libraries
     * @author Webnus <info@webnus.biz>
     */
    public function include_facebook_api()
    {
    }
    
    /**
     * Add the IX menu
     * @author Webnus <info@webnus.biz>
     */
    public function menus()
    {
        add_submenu_page('mec-intro', __('MEC - Import / Export', 'mec'), __('Import / Export', 'mec'), 'manage_options', 'MEC-ix', array($this, 'ix'));
    }
    
    /**
     * Show content of Import Import / Export Menu
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix()
    {
        $tab = isset($_GET['tab']) ? $_GET['tab'] : '';
        
        if($tab == 'MEC-export') $this->ix_export();
        elseif($tab == 'MEC-sync') $this->ix_sync();
        elseif($tab == 'MEC-g-calendar-export') $this->ix_g_calendar_export();
        elseif($tab == 'MEC-f-calendar-import') $this->ix_f_calendar_import();
        elseif($tab == 'MEC-import') $this->ix_import();
        else $this->ix_g_calendar_import();
    }
    
    /**
     * Show content of export tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_export()
    {
        $path = MEC::import('app.features.ix.export', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }
    
    /**
     * Show content of export tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_sync()
    {
        // Current Action
        $this->action = isset($_POST['mec-ix-action']) ? $_POST['mec-ix-action'] : '';
        $this->ix = isset($_POST['ix']) ? $_POST['ix'] : array();
        
        if($this->action == 'save-sync-options')
        {
            // Save options
            $this->main->save_ix_options(array('sync_g_import'=>$this->ix['sync_g_import'], 'sync_g_export'=>$this->ix['sync_g_export'], 'sync_f_import'=>$this->ix['sync_f_import']));
        }
        
        $path = MEC::import('app.features.ix.sync', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }

    /**
     * Show content of import tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_import()
    {
        // Current Action
        $this->action = isset($_POST['mec-ix-action']) ? $_POST['mec-ix-action'] : '';
        $this->ix = isset($_POST['ix']) ? $_POST['ix'] : array();

        $this->response = array();
        if($this->action == 'thirdparty-import-start') $this->response = $this->thirdparty_import_start();
        elseif($this->action == 'thirdparty-import-do') $this->response = $this->thirdparty_import_do();

        $path = MEC::import('app.features.ix.import', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }

    public function thirdparty_import_start()
    {
        $third_party = isset($this->ix['third-party']) ? $this->ix['third-party'] : NULL;

        if($third_party == 'eventon' and class_exists('EventON')) $post_type = 'ajde_events';
        elseif($third_party == 'the-events-calendar' and class_exists('Tribe__Events__Main')) $post_type = 'tribe_events';
        elseif($third_party == 'weekly-class' and class_exists('WeeklyClass')) $post_type = 'class';
        else return array('success'=>0, 'message'=>__("Third Party plugin is not installed and activated!", 'mec'));

        $events = get_posts(array(
            'posts_per_page' => -1,
            'post_type' => $post_type,
        ));

        return array(
            'success' => 1,
            'data' => array(
                'count' => count($events),
                'events' => $events
            )
        );
    }

    public function thirdparty_import_do()
    {
        $third_party = isset($this->ix['third-party']) ? $this->ix['third-party'] : '';

        if($third_party == 'eventon') return $this->thirdparty_eventon_import_do();
        elseif($third_party == 'the-events-calendar') return $this->thirdparty_tec_import_do();
        elseif($third_party == 'weekly-class') return $this->thirdparty_weekly_class_import_do();

        return array('success'=>0, 'message'=>__('Third Party plugin is invalid!', 'mec'));
    }

    public function thirdparty_eventon_import_do()
    {
        $IDs = isset($_POST['tp-events']) ? $_POST['tp-events'] : array();
        $count = 0;

        foreach($IDs as $ID)
        {
            $post = get_post($ID);
            $metas = $this->main->get_post_meta($ID);

            // Event Title and Content
            $title = $post->post_title;
            $description = $post->post_content;
            $third_party_id = $ID;

            // Event location
            $locations = wp_get_post_terms($ID, 'event_location');
            $location_id = 1;

            // Import Event Locations into MEC locations
            if(isset($this->ix['import_locations']) and $this->ix['import_locations'] and isset($locations[0]))
            {
                $l_metas = evo_get_term_meta('event_location', $locations[0]->term_id);
                $location_id = $this->main->save_location(array
                (
                    'name'=>trim($locations[0]->name),
                    'address'=>(isset($l_metas['location_address']) ? $l_metas['location_address'] : ''),
                    'latitude'=>(isset($l_metas['location_lat']) ? $l_metas['location_lat'] : 0),
                    'longitude'=>(isset($l_metas['location_lon']) ? $l_metas['location_lon'] : 0),
                ));
            }

            // Event Organizer
            $organizers = wp_get_post_terms($ID, 'event_organizer');
            $organizer_id = 1;

            // Import Event Organizer into MEC organizers
            if(isset($this->ix['import_organizers']) and $this->ix['import_organizers'] and isset($organizers[0]))
            {
                $o_metas = evo_get_term_meta('event_organizer', $organizers[0]->term_id);
                $organizer_id = $this->main->save_organizer(array
                (
                    'name'=>trim($organizers[0]->name),
                    'tel'=>(isset($o_metas['evcal_org_contact']) ? $o_metas['evcal_org_contact'] : ''),
                    'url'=>(isset($o_metas['evcal_org_exlink']) ? $o_metas['evcal_org_exlink'] : ''),
                ));
            }

            // Event Categories
            $categories = wp_get_post_terms($ID, 'event_type');
            $category_ids = array();

            // Import Event Categories into MEC categories
            if(isset($this->ix['import_categories']) and $this->ix['import_categories'] and count($categories))
            {
                foreach($categories as $category)
                {
                    $category_id = $this->main->save_category(array
                    (
                        'name'=>trim($category->name),
                    ));

                    if($category_id) $category_ids[] = $category_id;
                }
            }

            // Event Start Date and Time
            $date_start = new DateTime(date('Y-m-d g:i', $metas['evcal_srow']));
            if(isset($metas['evo_event_timezone']) and trim($metas['evo_event_timezone'])) $date_start->setTimezone(new DateTimeZone($metas['evo_event_timezone']));

            $start_date = $date_start->format('Y-m-d');
            $start_hour = $date_start->format('g');
            $start_minutes = $date_start->format('i');
            $start_ampm = $date_start->format('A');

            // Event End Date and Time
            $date_end = new DateTime(date('Y-m-d g:i', $metas['evcal_erow']));
            if(isset($metas['evo_event_timezone']) and trim($metas['evo_event_timezone'])) $date_end->setTimezone(new DateTimeZone($metas['evo_event_timezone']));

            $end_date = $date_end->format('Y-m-d');
            $end_hour = $date_end->format('g');
            $end_minutes = $date_end->format('i');
            $end_ampm = $date_end->format('A');

            // Event Time Options
            $hide_end_time = (isset($metas['evo_hide_endtime']) and $metas['evo_hide_endtime'] == 'yes') ? 1 : 0;
            $allday = (isset($metas['evcal_allday']) and trim($metas['evcal_allday']) == 'yes') ? $metas['evcal_allday'] : 0;

            // Recurring Event
            if(isset($metas['evcal_repeat']) and $metas['evcal_repeat'] == 'yes')
            {
                $repeat_status = 1;
                $interval = NULL;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;
                $days = NULL;
                $finish = NULL;

                $occurrences = (isset($metas['repeat_intervals']) and is_array($metas['repeat_intervals'])) ? $metas['repeat_intervals'] : array();
                if(count($occurrences))
                {
                    $t = $occurrences[(count($occurrences) -1)][1];
                    $finish = date('Y-m-d', $t);
                }

                $freq = (isset($metas['evcal_rep_freq']) and trim($metas['evcal_rep_freq'])) ? $metas['evcal_rep_freq'] : 'daily';

                if($freq == 'daily')
                {
                    $repeat_type = 'daily';
                    $interval = isset($metas['evcal_rep_gap']) ? $metas['evcal_rep_gap'] : 1;
                }
                elseif($freq == 'weekly')
                {
                    $repeat_type = 'weekly';
                    $interval = isset($metas['evcal_rep_gap']) ? $metas['evcal_rep_gap']*7 : 7;
                }
                elseif($freq == 'monthly')
                {
                    $repeat_type = 'monthly';

                    $year = '*';
                    $month = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_days[] = date('d', strtotime($s));
                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                elseif($freq == 'yearly')
                {
                    $repeat_type = 'yearly';

                    $year = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_months = array();
                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_months[] = date('m', strtotime($s));
                        $_days[] = date('d', strtotime($s));

                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $month = ','.implode(',', array_unique($_months)).',';
                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                elseif($freq == 'custom')
                {
                    $repeat_type = 'custom_days';
                    $occurrencies = (isset($metas['repeat_intervals']) and is_array($metas['repeat_intervals'])) ? $metas['repeat_intervals'] : array();

                    $days = '';
                    $x = 1;
                    foreach($occurrencies as $occurrency)
                    {
                        if($x == 1)
                        {
                            $finish = date('Y-m-d', $occurrency[0]);

                            $x++;
                            continue;
                        }

                        $days .= date('Y-m-d', $occurrency[0]).',';
                        $x++;
                    }

                    $days = trim($days, ', ');
                }
                else $repeat_type = '';

                // Custom Week Days
                if($repeat_type == 'weekly' and isset($metas['evo_rep_WKwk']) and is_array($metas['evo_rep_WKwk']) and count($metas['evo_rep_WKwk']) > 1)
                {
                    $week_day_mapping = array('d1'=>1, 'd2'=>2, 'd3'=>3, 'd4'=>4, 'd5'=>5, 'd6'=>6, 'd0'=>7);

                    $weekdays = '';
                    foreach($metas['evo_rep_WKwk'] as $week_day) $weekdays .= $week_day_mapping['d'.$week_day].',';

                    $weekdays = ','.trim($weekdays, ', ').',';
                    $interval = NULL;

                    $repeat_type = 'certain_weekdays';
                }
            }
            // Single Event
            else
            {
                $repeat_status = 0;
                $repeat_type = '';
                $interval = NULL;
                $finish = $end_date;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;
                $days = NULL;
            }

            $args = array
            (
                'title'=>$title,
                'content'=>$description,
                'location_id'=>$location_id,
                'organizer_id'=>$organizer_id,
                'date'=>array
                (
                    'start'=>array(
                        'date'=>$start_date,
                        'hour'=>$start_hour,
                        'minutes'=>$start_minutes,
                        'ampm'=>$start_ampm,
                    ),
                    'end'=>array(
                        'date'=>$end_date,
                        'hour'=>$end_hour,
                        'minutes'=>$end_minutes,
                        'ampm'=>$end_ampm,
                    ),
                    'repeat'=>array(
                        'end'=>'date',
                        'end_at_date'=>$finish,
                        'end_at_occurrences'=>10,
                    ),
                    'allday'=>$allday,
                    'comment'=>'',
                    'hide_time'=>0,
                    'hide_end_time'=>$hide_end_time,
                ),
                'start'=>$start_date,
                'start_time_hour'=>$start_hour,
                'start_time_minutes'=>$start_minutes,
                'start_time_ampm'=>$start_ampm,
                'end'=>$end_date,
                'end_time_hour'=>$end_hour,
                'end_time_minutes'=>$end_minutes,
                'end_time_ampm'=>$end_ampm,
                'repeat_status'=>$repeat_status,
                'repeat_type'=>$repeat_type,
                'interval'=>$interval,
                'finish'=>$finish,
                'year'=>$year,
                'month'=>$month,
                'day'=>$day,
                'week'=>$week,
                'weekday'=>$weekday,
                'weekdays'=>$weekdays,
                'days'=>$days,
                'meta'=>array
                (
                    'mec_source'=>'eventon',
                    'mec_eventon_id'=>$third_party_id,
                    'mec_allday'=>$allday,
                    'hide_end_time'=>$hide_end_time,
                    'mec_repeat_end'=>'date',
                    'mec_repeat_end_at_occurrences'=>9,
                    'mec_repeat_end_at_date'=>$finish,
                    'mec_in_days'=>$days,
                )
            );

            $post_id = $this->db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$third_party_id' AND `meta_key`='mec_eventon_id'", 'loadResult');

            // Insert the event into MEC
            $post_id = $this->main->save_event($args, $post_id);

            // Set location to the post
            if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

            // Set organizer to the post
            if($organizer_id) wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');

            // Set categories to the post
            if(count($category_ids)) foreach($category_ids as $category_id) wp_set_object_terms($post_id, (int) $category_id, 'mec_category', true);

            // Set Features Image
            if(isset($this->ix['import_featured_image']) and $this->ix['import_featured_image'] and $thumbnail_id = get_post_thumbnail_id($ID))
            {
                set_post_thumbnail($post_id, $thumbnail_id);
            }

            $count++;
        }

        return array('success'=>1, 'data'=>$count);
    }

    public function thirdparty_tec_import_do()
    {
        $IDs = isset($_POST['tp-events']) ? $_POST['tp-events'] : array();

        $count = 0;
        foreach($IDs as $ID)
        {
            $post = get_post($ID);
            $metas = $this->main->get_post_meta($ID);

            // Event Title and Content
            $title = $post->post_title;
            $description = $post->post_content;
            $third_party_id = $ID;

            // Event location
            $location = get_post($metas['_EventVenueID']);
            $location_id = 1;

            // Import Event Locations into MEC locations
            if(isset($this->ix['import_locations']) and $this->ix['import_locations'] and isset($location->ID))
            {
                $l_metas = $this->main->get_post_meta($location->ID);
                $location_id = $this->main->save_location(array
                (
                    'name'=>trim($location->post_title),
                    'address'=>(isset($l_metas['_VenueAddress']) ? $l_metas['_VenueAddress'] : ''),
                    'latitude'=>0,
                    'longitude'=>0,
                ));
            }

            // Event Organizer
            $organizer = get_post($metas['_EventOrganizerID']);
            $organizer_id = 1;

            // Import Event Organizer into MEC organizers
            if(isset($this->ix['import_organizers']) and $this->ix['import_organizers'] and isset($organizer->ID))
            {
                $o_metas = $this->main->get_post_meta($organizer->ID);
                $organizer_id = $this->main->save_organizer(array
                (
                    'name'=>trim($organizer->post_title),
                    'tel'=>(isset($o_metas['_OrganizerPhone']) ? $o_metas['_OrganizerPhone'] : ''),
                    'email'=>(isset($o_metas['_OrganizerEmail']) ? $o_metas['_OrganizerEmail'] : ''),
                    'url'=>(isset($o_metas['_OrganizerWebsite']) ? $o_metas['_OrganizerWebsite'] : ''),
                ));
            }

            // Event Categories
            $categories = wp_get_post_terms($ID, 'tribe_events_cat');
            $category_ids = array();

            // Import Event Categories into MEC categories
            if(isset($this->ix['import_categories']) and $this->ix['import_categories'] and count($categories))
            {
                foreach($categories as $category)
                {
                    $category_id = $this->main->save_category(array
                    (
                        'name'=>trim($category->name),
                    ));

                    if($category_id) $category_ids[] = $category_id;
                }
            }

            // Event Start Date and Time
            $date_start = new DateTime(date('Y-m-d g:i', strtotime($metas['_EventStartDate'])));

            $start_date = $date_start->format('Y-m-d');
            $start_hour = $date_start->format('g');
            $start_minutes = $date_start->format('i');
            $start_ampm = $date_start->format('A');

            // Event End Date and Time
            $date_end = new DateTime(date('Y-m-d g:i', strtotime($metas['_EventEndDate'])));

            $end_date = $date_end->format('Y-m-d');
            $end_hour = $date_end->format('g');
            $end_minutes = $date_end->format('i');
            $end_ampm = $date_end->format('A');

            // Event Time Options
            $hide_end_time = 0;
            $allday = (isset($metas['_EventAllDay']) and trim($metas['_EventAllDay']) == 'yes') ? 1 : 0;

            // Single Event
            $repeat_status = 0;
            $repeat_type = '';
            $interval = NULL;
            $finish = $end_date;
            $year = NULL;
            $month = NULL;
            $day = NULL;
            $week = NULL;
            $weekday = NULL;
            $weekdays = NULL;
            $days = NULL;

            $args = array
            (
                'title'=>$title,
                'content'=>$description,
                'location_id'=>$location_id,
                'organizer_id'=>$organizer_id,
                'date'=>array
                (
                    'start'=>array(
                        'date'=>$start_date,
                        'hour'=>$start_hour,
                        'minutes'=>$start_minutes,
                        'ampm'=>$start_ampm,
                    ),
                    'end'=>array(
                        'date'=>$end_date,
                        'hour'=>$end_hour,
                        'minutes'=>$end_minutes,
                        'ampm'=>$end_ampm,
                    ),
                    'repeat'=>array(
                        'end'=>'date',
                        'end_at_date'=>$finish,
                        'end_at_occurrences'=>10,
                    ),
                    'allday'=>$allday,
                    'comment'=>'',
                    'hide_time'=>0,
                    'hide_end_time'=>$hide_end_time,
                ),
                'start'=>$start_date,
                'start_time_hour'=>$start_hour,
                'start_time_minutes'=>$start_minutes,
                'start_time_ampm'=>$start_ampm,
                'end'=>$end_date,
                'end_time_hour'=>$end_hour,
                'end_time_minutes'=>$end_minutes,
                'end_time_ampm'=>$end_ampm,
                'repeat_status'=>$repeat_status,
                'repeat_type'=>$repeat_type,
                'interval'=>$interval,
                'finish'=>$finish,
                'year'=>$year,
                'month'=>$month,
                'day'=>$day,
                'week'=>$week,
                'weekday'=>$weekday,
                'weekdays'=>$weekdays,
                'days'=>$days,
                'meta'=>array
                (
                    'mec_source'=>'the-events-calendar',
                    'mec_tec_id'=>$third_party_id,
                    'mec_allday'=>$allday,
                    'hide_end_time'=>$hide_end_time,
                    'mec_repeat_end'=>'date',
                    'mec_repeat_end_at_occurrences'=>9,
                    'mec_repeat_end_at_date'=>$finish,
                    'mec_in_days'=>$days,
                )
            );

            $post_id = $this->db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$third_party_id' AND `meta_key`='mec_tec_id'", 'loadResult');

            // Insert the event into MEC
            $post_id = $this->main->save_event($args, $post_id);

            // Set location to the post
            if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

            // Set organizer to the post
            if($organizer_id) wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');

            // Set categories to the post
            if(count($category_ids)) foreach($category_ids as $category_id) wp_set_object_terms($post_id, (int) $category_id, 'mec_category', true);

            // Set Features Image
            if(isset($this->ix['import_featured_image']) and $this->ix['import_featured_image'] and $thumbnail_id = get_post_thumbnail_id($ID))
            {
                set_post_thumbnail($post_id, $thumbnail_id);
            }

            $count++;
        }

        return array('success'=>1, 'data'=>$count);
    }

    public function thirdparty_weekly_class_import_do()
    {
        $IDs = isset($_POST['tp-events']) ? $_POST['tp-events'] : array();
        $count = 0;

        foreach($IDs as $ID)
        {
            $post = get_post($ID);
            $metas = $this->main->get_post_meta($ID);

            // Event Title and Content
            $title = $post->post_title;
            $description = $post->post_content;
            $third_party_id = $ID;

            // Event location
            $locations = wp_get_post_terms($ID, 'wcs-room');
            $location_id = 1;

            // Import Event Locations into MEC locations
            if(isset($this->ix['import_locations']) and $this->ix['import_locations'] and isset($locations[0]))
            {
                $location_id = $this->main->save_location(array
                (
                    'name'=>trim($locations[0]->name),
                    'address'=>'',
                    'latitude'=>'',
                    'longitude'=>'',
                ));
            }

            // Event Organizer
            $organizers = wp_get_post_terms($ID, 'wcs-instructor');
            $organizer_id = 1;

            // Import Event Organizer into MEC organizers
            if(isset($this->ix['import_organizers']) and $this->ix['import_organizers'] and isset($organizers[0]))
            {
                $organizer_id = $this->main->save_organizer(array
                (
                    'name'=>trim($organizers[0]->name),
                    'tel'=>'',
                    'url'=>'',
                ));
            }

            // Event Categories
            $categories = wp_get_post_terms($ID, 'wcs-type');
            $category_ids = array();

            // Import Event Categories into MEC categories
            if(isset($this->ix['import_categories']) and $this->ix['import_categories'] and count($categories))
            {
                foreach($categories as $category)
                {
                    $category_id = $this->main->save_category(array
                    (
                        'name'=>trim($category->name),
                    ));

                    if($category_id) $category_ids[] = $category_id;
                }
            }

            // Event Start Date and Time
            $date_start = new DateTime(date('Y-m-d g:i', $metas['_wcs_timestamp']));

            $start_date = $date_start->format('Y-m-d');
            $start_hour = $date_start->format('g');
            $start_minutes = $date_start->format('i');
            $start_ampm = $date_start->format('A');

            // Event End Date and Time
            $date_end = new DateTime(date('Y-m-d g:i', ($metas['_wcs_timestamp']+($metas['_wcs_duration']*60))));

            $end_date = $date_end->format('Y-m-d');
            $end_hour = $date_end->format('g');
            $end_minutes = $date_end->format('i');
            $end_ampm = $date_end->format('A');

            // Event Time Options
            $hide_end_time = 0;
            $allday = 0;

            // Recurring Event
            if(isset($metas['_wcs_interval']) and $metas['_wcs_interval'])
            {
                $repeat_status = 1;
                $interval = NULL;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;
                $days = NULL;
                $finish = (isset($metas['_wcs_repeat_until']) and trim($metas['_wcs_repeat_until'])) ? date('Y-m-d', strtotime($metas['_wcs_repeat_until'])) : NULL;

                $freq = (isset($metas['_wcs_interval']) and trim($metas['_wcs_interval'])) ? $metas['_wcs_interval'] : 2;

                if($freq == 2) // Daily
                {
                    $repeat_type = 'daily';
                    $interval = 1;
                }
                elseif($freq == 1 or $freq == 3) // Weekly or Every Two Weeks
                {
                    $repeat_type = 'weekly';
                    $interval = $freq == 3 ? 14 : 7;
                }
                elseif($freq == 4) // Monthly
                {
                    $repeat_type = 'monthly';

                    $year = '*';
                    $month = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_days[] = date('d', strtotime($s));
                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                elseif($freq == 5) // Yearly
                {
                    $repeat_type = 'yearly';

                    $year = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_months = array();
                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_months[] = date('m', strtotime($s));
                        $_days[] = date('d', strtotime($s));

                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $month = ','.implode(',', array_unique($_months)).',';
                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                else $repeat_type = '';

                // Custom Week Days
                if($repeat_type == 'daily' and isset($metas['_wcs_repeat_days']) and is_array($metas['_wcs_repeat_days']) and count($metas['_wcs_repeat_days']) > 1 and count($metas['_wcs_repeat_days']) < 7)
                {
                    $week_day_mapping = array('d1'=>1, 'd2'=>2, 'd3'=>3, 'd4'=>4, 'd5'=>5, 'd6'=>6, 'd0'=>7);

                    $weekdays = '';
                    foreach($metas['_wcs_repeat_days'] as $week_day) $weekdays .= $week_day_mapping['d'.$week_day].',';

                    $weekdays = ','.trim($weekdays, ', ').',';
                    $interval = NULL;

                    $repeat_type = 'certain_weekdays';
                }
            }
            // Single Event
            else
            {
                $repeat_status = 0;
                $repeat_type = '';
                $interval = NULL;
                $finish = $end_date;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;
                $days = NULL;
            }

            $args = array
            (
                'title'=>$title,
                'content'=>$description,
                'location_id'=>$location_id,
                'organizer_id'=>$organizer_id,
                'date'=>array
                (
                    'start'=>array(
                        'date'=>$start_date,
                        'hour'=>$start_hour,
                        'minutes'=>$start_minutes,
                        'ampm'=>$start_ampm,
                    ),
                    'end'=>array(
                        'date'=>$end_date,
                        'hour'=>$end_hour,
                        'minutes'=>$end_minutes,
                        'ampm'=>$end_ampm,
                    ),
                    'repeat'=>array(
                        'end'=>'date',
                        'end_at_date'=>$finish,
                        'end_at_occurrences'=>10,
                    ),
                    'allday'=>$allday,
                    'comment'=>'',
                    'hide_time'=>0,
                    'hide_end_time'=>$hide_end_time,
                ),
                'start'=>$start_date,
                'start_time_hour'=>$start_hour,
                'start_time_minutes'=>$start_minutes,
                'start_time_ampm'=>$start_ampm,
                'end'=>$end_date,
                'end_time_hour'=>$end_hour,
                'end_time_minutes'=>$end_minutes,
                'end_time_ampm'=>$end_ampm,
                'repeat_status'=>$repeat_status,
                'repeat_type'=>$repeat_type,
                'interval'=>$interval,
                'finish'=>$finish,
                'year'=>$year,
                'month'=>$month,
                'day'=>$day,
                'week'=>$week,
                'weekday'=>$weekday,
                'weekdays'=>$weekdays,
                'days'=>$days,
                'meta'=>array
                (
                    'mec_source'=>'eventon',
                    'mec_weekly_class_id'=>$third_party_id,
                    'mec_allday'=>$allday,
                    'hide_end_time'=>$hide_end_time,
                    'mec_repeat_end'=>($finish ? 'date' : 'never'),
                    'mec_repeat_end_at_occurrences'=>9,
                    'mec_repeat_end_at_date'=>$finish,
                    'mec_in_days'=>$days,
                )
            );

            $post_id = $this->db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$third_party_id' AND `meta_key`='mec_weekly_class_id'", 'loadResult');

            // Insert the event into MEC
            $post_id = $this->main->save_event($args, $post_id);

            // Set location to the post
            if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

            // Set organizer to the post
            if($organizer_id) wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');

            // Set categories to the post
            if(count($category_ids)) foreach($category_ids as $category_id) wp_set_object_terms($post_id, (int) $category_id, 'mec_category', true);

            // Set Features Image
            if(isset($this->ix['import_featured_image']) and $this->ix['import_featured_image'] and $thumbnail_id = get_post_thumbnail_id($ID))
            {
                set_post_thumbnail($post_id, $thumbnail_id);
            }

            $count++;
        }

        return array('success'=>1, 'data'=>$count);
    }

    /**
     * Show content of export tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_g_calendar_export()
    {
        // Current Action
        $this->action = isset($_POST['mec-ix-action']) ? $_POST['mec-ix-action'] : (isset($_GET['mec-ix-action']) ? $_GET['mec-ix-action'] : '');
        
        $path = MEC::import('app.features.ix.export_g_calendar', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }
    
    /**
     * Show content of import tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_g_calendar_import()
    {
        // Current Action
        $this->action = isset($_POST['mec-ix-action']) ? $_POST['mec-ix-action'] : '';
        $this->ix = isset($_POST['ix']) ? $_POST['ix'] : array();
        
        $this->response = array();
        if($this->action == 'google-calendar-import-start') $this->response = $this->g_calendar_import_start();
        elseif($this->action == 'google-calendar-import-do') $this->response = $this->g_calendar_import_do();
        
        $path = MEC::import('app.features.ix.import_g_calendar', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }
    
    public function g_calendar_import_start()
    {
        $api_key = isset($this->ix['google_import_api_key']) ? $this->ix['google_import_api_key'] : NULL;
        $calendar_id = isset($this->ix['google_import_calendar_id']) ? $this->ix['google_import_calendar_id'] : NULL;
        $start_date = isset($this->ix['google_import_start_date']) ? $this->ix['google_import_start_date'] : 'Today';
        $end_date = (isset($this->ix['google_import_end_date']) and trim($this->ix['google_import_end_date'])) ? $this->ix['google_import_end_date'] : 'Tomorrow';

        if(!trim($api_key) or !trim($calendar_id)) return array('success'=>0, 'error'=>__('Both of API key and Calendar ID are required!', 'mec'));
        
        // Save options
        $this->main->save_ix_options(array('google_import_api_key'=>$api_key, 'google_import_calendar_id'=>$calendar_id));
        
        // GMT Offset
        $gmt_offset = $this->main->get_gmt_offset();
        
        $client = new Google_Client();
        $client->setApplicationName('Modern Events Calendar');
        $client->setAccessType('online');
        $client->setScopes(array('https://www.googleapis.com/auth/calendar.readonly'));
        $client->setDeveloperKey($api_key);

        $service = new Google_Service_Calendar($client);
        $data = array();
        
        try
        {
            $args = array();
            $args['timeMin'] = date('Y-m-d\TH:i:s', strtotime($start_date)).$gmt_offset;
            $args['timeMax'] = date('Y-m-d\TH:i:s', strtotime($end_date)).$gmt_offset;
            $args['maxResults'] = 500;
            
            $response = $service->events->listEvents($calendar_id, $args);
            
            $data['id'] = $calendar_id;
            $data['title'] = $response->getSummary();
            $data['timezone'] = $response->getTimeZone();
            $data['events'] = array();
            
            foreach($response->getItems() as $event)
            {
                $title = $event->getSummary();
                if(trim($title) == '') continue;
                
                $data['events'][] = array('id'=>$event->id, 'title'=>$title, 'start'=>$event->getStart(), 'end'=>$event->getEnd());
            }
            
            $data['count'] = count($data['events']);
        }
        catch(Exception $e)
        {
            $error = $e->getMessage();
            return array('success'=>0, 'error'=>$error);
        }
        
        return array('success'=>1, 'data'=>$data);
    }
    
    public function g_calendar_import_do()
    {
        $g_events = isset($_POST['g-events']) ? $_POST['g-events'] : array();
        if(!count($g_events)) return array('success'=>0, 'error'=>__('Please select some events to import!', 'mec'));
        
        $api_key = isset($this->ix['google_import_api_key']) ? $this->ix['google_import_api_key'] : NULL;
        $calendar_id = isset($this->ix['google_import_calendar_id']) ? $this->ix['google_import_calendar_id'] : NULL;
        
        if(!trim($api_key) or !trim($calendar_id)) return array('success'=>0, 'error'=>__('Both of API key and Calendar ID are required!', 'mec'));

        // Timezone
        $timezone = $this->main->get_timezone();

        $client = new Google_Client();
        $client->setApplicationName('Modern Events Calendar');
        $client->setAccessType('online');
        $client->setScopes(array('https://www.googleapis.com/auth/calendar.readonly'));
        $client->setDeveloperKey($api_key);

        $service = new Google_Service_Calendar($client);
        $post_ids = array();
        
        foreach($g_events as $g_event)
        {
            try
            {
                $event = $service->events->get($calendar_id, $g_event);
            }
            catch(Exception $e)
            {
                continue;
            }

            // Event Title and Content
            $title = $event->getSummary();
            $description = $event->getDescription();
            $gcal_ical_uid = $event->getICalUID();
            $gcal_id = $event->getId();

            // Event location
            $location = $event->getLocation();
            $location_id = 1;

            // Import Event Locations into MEC locations
            if(isset($this->ix['import_locations']) and $this->ix['import_locations'] and trim($location))
            {
                $location_ex = explode(',', $location);
                $location_id = $this->main->save_location(array
                (
                    'name'=>trim($location_ex[0]),
                    'address'=>$location
                ));
            }

            // Event Organizer
            $organizer = $event->getOrganizer();
            $organizer_id = 1;

            // Import Event Organizer into MEC organizers
            if(isset($this->ix['import_organizers']) and $this->ix['import_organizers'])
            {
                $organizer_id = $this->main->save_organizer(array
                (
                    'name'=>$organizer->getDisplayName(),
                    'email'=>$organizer->getEmail()
                ));
            }

            // Event Start Date and Time
            $start = $event->getStart();

            $g_start_date = $start->getDate();
            $g_start_datetime = $start->getDateTime();

            $date_start = new DateTime((trim($g_start_datetime) ? $g_start_datetime : $g_start_date));
            $date_start->setTimezone(new DateTimeZone($timezone));

            $start_date = $date_start->format('Y-m-d');
            $start_hour = 8;
            $start_minutes = '00';
            $start_ampm = 'AM';

            if(trim($g_start_datetime))
            {
                $start_hour = $date_start->format('g');
                $start_minutes = $date_start->format('i');
                $start_ampm = $date_start->format('A');
            }

            // Event End Date and Time
            $end = $event->getEnd();

            $g_end_date = $end->getDate();
            $g_end_datetime = $end->getDateTime();

            $date_end = new DateTime((trim($g_end_datetime) ? $g_end_datetime : $g_end_date));
            $date_end->setTimezone(new DateTimeZone($timezone));

            $end_date = $date_end->format('Y-m-d');
            $end_hour = 6;
            $end_minutes = '00';
            $end_ampm = 'PM';

            if(trim($g_end_datetime))
            {
                $end_hour = $date_end->format('g');
                $end_minutes = $date_end->format('i');
                $end_ampm = $date_end->format('A');
            }

            // Event Time Options
            $allday = 0;

            // Both Start and Date times are empty so it's all day event
            if(!trim($g_end_datetime) and !trim($g_start_datetime))
            {
                $allday = 1;

                $start_hour = 0;
                $start_minutes = 0;
                $start_ampm = 'AM';

                $end_hour = 11;
                $end_minutes = 55;
                $end_ampm = 'PM';
            }

            // Recurring Event
            if($event->getRecurrence())
            {
                $repeat_status = 1;
                $r_rules = $event->getRecurrence();
                
                $i = 0;
                
                do
                {
                    $g_recurrence_rule = $r_rules[$i];
                    $main_rule_ex = explode(':', $g_recurrence_rule);
                    $rules = explode(';', $main_rule_ex[1]);
                    
                    $i++;
                } while($main_rule_ex[0] != 'RRULE' and isset($r_rules[$i]));
                
                $rule = array();
                foreach($rules as $rule_row)
                {
                    $ex = explode('=', $rule_row);
                    $key = strtolower($ex[0]);
                    $value = ($key == 'until' ? $ex[1] : strtolower($ex[1]));

                    $rule[$key] = $value;
                }
                
                $interval = NULL;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;

                if($rule['freq'] == 'daily')
                {
                    $repeat_type = 'daily';
                    $interval = isset($rule['interval']) ? $rule['interval'] : 1;
                }
                elseif($rule['freq'] == 'weekly')
                {
                    $repeat_type = 'weekly';
                    $interval = isset($rule['interval']) ? $rule['interval']*7 : 7;
                }
                elseif($rule['freq'] == 'monthly')
                {
                    $repeat_type = 'monthly';

                    $year = '*';
                    $month = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_days[] = date('d', strtotime($s));
                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                elseif($rule['freq'] == 'yearly')
                {
                    $repeat_type = 'yearly';

                    $year = '*';

                    $s = $start_date;
                    $e = $end_date;

                    $_months = array();
                    $_days = array();
                    while(strtotime($s) <= strtotime($e))
                    {
                        $_months[] = date('m', strtotime($s));
                        $_days[] = date('d', strtotime($s));

                        $s = date('Y-m-d', strtotime('+1 Day', strtotime($s)));
                    }

                    $month = ','.implode(',', array_unique($_months)).',';
                    $day = ','.implode(',', array_unique($_days)).',';

                    $week = '*';
                    $weekday = '*';
                }
                else $repeat_type = '';

                // Custom Week Days
                if($repeat_type == 'weekly' and isset($rule['byday']) and count(explode(',', $rule['byday'])) > 1)
                {
                    $g_week_days = explode(',', $rule['byday']);
                    $week_day_mapping = array('mo'=>1, 'tu'=>2, 'we'=>3, 'th'=>4, 'fr'=>5, 'sa'=>6, 'su'=>7);

                    $weekdays = '';
                    foreach($g_week_days as $g_week_day) $weekdays .= $week_day_mapping[$g_week_day].',';

                    $weekdays = ','.trim($weekdays, ', ').',';
                    $interval = NULL;
                    
                    $repeat_type = 'certain_weekdays';
                }
                
                $finish = isset($rule['until']) ? date('Y-m-d', strtotime($rule['until'])) : NULL;
            }
            // Single Event
            else
            {
                // It's a one day single event but google sends 2020-12-12 as end date if start date is 2020-12-11
                if(trim($g_end_datetime) == '' and date('Y-m-d', strtotime('-1 day', strtotime($end_date))) == $start_date)
                {
                    $end_date = $start_date;
                }
                // It's all day event so we should reduce one day from the end date! Google provides 2020-12-12 while the event ends at 2020-12-11
                elseif($allday)
                {
                    $diff = $this->main->date_diff($start_date, $end_date);
                    if(($diff ? $diff->days : 0) > 1)
                    {
                        $date_end->sub(new DateInterval('P1D'));
                        $end_date = $date_end->format('Y-m-d');
                    }
                }
            
                $repeat_status = 0;
                $g_recurrence_rule = '';
                $repeat_type = '';
                $interval = NULL;
                $finish = $end_date;
                $year = NULL;
                $month = NULL;
                $day = NULL;
                $week = NULL;
                $weekday = NULL;
                $weekdays = NULL;
            }

            $args = array
            (
                'title'=>$title,
                'content'=>$description,
                'location_id'=>$location_id,
                'organizer_id'=>$organizer_id,
                'date'=>array
                (
                    'start'=>array(
                        'date'=>$start_date,
                        'hour'=>$start_hour,
                        'minutes'=>$start_minutes,
                        'ampm'=>$start_ampm,
                    ),
                    'end'=>array(
                        'date'=>$end_date,
                        'hour'=>$end_hour,
                        'minutes'=>$end_minutes,
                        'ampm'=>$end_ampm,
                    ),
                    'repeat'=>array(),
                    'allday'=>$allday,
                    'comment'=>'',
                    'hide_time'=>0,
                    'hide_end_time'=>0,
                ),
                'start'=>$start_date,
                'start_time_hour'=>$start_hour,
                'start_time_minutes'=>$start_minutes,
                'start_time_ampm'=>$start_ampm,
                'end'=>$end_date,
                'end_time_hour'=>$end_hour,
                'end_time_minutes'=>$end_minutes,
                'end_time_ampm'=>$end_ampm,
                'repeat_status'=>$repeat_status,
                'repeat_type'=>$repeat_type,
                'interval'=>$interval,
                'finish'=>$finish,
                'year'=>$year,
                'month'=>$month,
                'day'=>$day,
                'week'=>$week,
                'weekday'=>$weekday,
                'weekdays'=>$weekdays,
                'meta'=>array
                (
                    'mec_source'=>'google-calendar',
                    'mec_gcal_ical_uid'=>$gcal_ical_uid,
                    'mec_gcal_id'=>$gcal_id,
                    'mec_gcal_calendar_id'=>$calendar_id,
                    'mec_g_recurrence_rule'=>$g_recurrence_rule,
                    'mec_allday'=>$allday
                )
            );
            
            $post_id = $this->db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$gcal_id' AND `meta_key`='mec_gcal_id'", 'loadResult');
            
            // Insert the event into MEC
            $post_id = $this->main->save_event($args, $post_id);
            $post_ids[] = $post_id;
            
            // Set location to the post
            if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');
            
            // Set organizer to the post
            if($organizer_id) wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');
        }
        
        return array('success'=>1, 'data'=>$post_ids);
    }
    
    public function export_all_events_do()
    {
        $format = isset($_GET['format']) ? $_GET['format'] : 'csv';
        $events = $this->main->get_events('-1');
        
        // MEC Render Library
        $render = $this->getRender();
        
        switch($format)
        {
            case 'ical':
                
                $output = '';
                
                foreach($events as $event)
                {
                    $output .= $this->main->ical_single($event->ID);
                }
                
                $ical_calendar = $this->main->ical_calendar($output);

                header('Content-type: application/force-download; charset=utf-8'); 
                header('Content-Disposition: attachment; filename="mec-events-'.date('YmdTHi').'.ics"');

                echo $ical_calendar;
                exit;
                
                break;
            case 'csv':
                
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename=bookings-'.md5(time().mt_rand(100, 999)).'.csv');
                
                $columns = array(__('ID', 'mec'), __('Title', 'mec'), __('Start Date', 'mec'), __('Start Time', 'mec'), __('End Date', 'mec'), __('End Time', 'mec'), __('Link', 'mec'), __('Location', 'mec'), __('Organizer', 'mec'), __('Organizer Tel', 'mec'), __('Organizer Email', 'mec'), $this->main->m('event_cost', __('Event Cost', 'mec')));
                
                $output = fopen('php://output', 'w');
                fputcsv($output, $columns);
                
                foreach($events as $event)
                {
                    $data = $render->data($event->ID);
                    
                    $dates = $render->dates($event->ID, $data);
                    $date = $dates[0];
                    
                    $location = isset($data->locations[$data->meta['mec_location_id']]) ? $data->locations[$data->meta['mec_location_id']] : array();
                    $organizer = isset($data->organizers[$data->meta['mec_organizer_id']]) ? $data->organizers[$data->meta['mec_organizer_id']] : array();
                    
                    $event = array(
                        $event->ID,
                        $data->title,
                        $date['start']['date'],
                        $data->time['start'],
                        $date['end']['date'],
                        $data->time['end'],
                        $data->permalink,
                        (isset($location['address']) ? $location['address'] : (isset($location['name']) ? $location['name'] : '')),
                        (isset($organizer['name']) ? $organizer['name'] : ''),
                        (isset($organizer['tel']) ? $organizer['tel'] : ''),
                        (isset($organizer['email']) ? $organizer['email'] : ''),
                        (is_numeric($data->meta['mec_cost']) ? $this->main->render_price($data->meta['mec_cost']) : $data->meta['mec_cost'])
                    );
                    
                    fputcsv($output, $event);
                }
                
                exit;

                break;
            case 'ms-excel':
                
                header('Content-Type: application/vnd.ms-excel; charset=utf-8');
                header('Content-Disposition: attachment; filename=bookings-'.md5(time().mt_rand(100, 999)).'.csv');
                
                $columns = array(__('ID', 'mec'), __('Title', 'mec'), __('Start Date', 'mec'), __('Start Time', 'mec'), __('End Date', 'mec'), __('End Time', 'mec'), __('Link', 'mec'), __('Location', 'mec'), __('Organizer', 'mec'), __('Organizer Tel', 'mec'), __('Organizer Email', 'mec'), $this->main->m('event_cost', __('Event Cost', 'mec')));
                
                $output = fopen('php://output', 'w');
                fwrite($output, "sep=\t".PHP_EOL);
                fputcsv($output, $columns, "\t");
                
                foreach($events as $event)
                {
                    $data = $render->data($event->ID);
                    
                    $dates = $render->dates($event->ID, $data);
                    $date = $dates[0];
                    
                    $location = isset($data->locations[$data->meta['mec_location_id']]) ? $data->locations[$data->meta['mec_location_id']] : array();
                    $organizer = isset($data->organizers[$data->meta['mec_organizer_id']]) ? $data->organizers[$data->meta['mec_organizer_id']] : array();
                    
                    $event = array(
                        $event->ID,
                        $data->title,
                        $date['start']['date'],
                        $data->time['start'],
                        $date['end']['date'],
                        $data->time['end'],
                        $data->permalink,
                        (isset($location['address']) ? $location['address'] : (isset($location['name']) ? $location['name'] : '')),
                        (isset($organizer['name']) ? $organizer['name'] : ''),
                        (isset($organizer['tel']) ? $organizer['tel'] : ''),
                        (isset($organizer['email']) ? $organizer['email'] : ''),
                        (is_numeric($data->meta['mec_cost']) ? $this->main->render_price($data->meta['mec_cost']) : $data->meta['mec_cost'])
                    );
                    
                    fputcsv($output, $event, "\t");
                }
                
                exit;

                break;
            case 'xml':
                
                $output = array();
                foreach($events as $event)
                {
                    $output[] = $this->main->export_single($event->ID);
                }
                
                $xml_feed = $this->main->xml_convert(array('events'=>$output));

                header('Content-type: application/force-download; charset=utf-8'); 
                header('Content-Disposition: attachment; filename="mec-events-'.date('YmdTHi').'.xml"');

                echo $xml_feed;
                exit;

                break;
            case 'json':
                
                $output = array();
                foreach($events as $event)
                {
                    $output[] = $this->main->export_single($event->ID);
                }

                header('Content-type: application/force-download; charset=utf-8'); 
                header('Content-Disposition: attachment; filename="mec-events-'.date('YmdTHi').'.json"');

                echo json_encode($output);
                exit;

                break;
        }
    }
    
    public function g_calendar_export_authenticate()
    {
        $ix = isset($_POST['ix']) ? $_POST['ix'] : array();
        
        $client_id = isset($ix['google_export_client_id']) ? $ix['google_export_client_id'] : NULL;
        $client_secret = isset($ix['google_export_client_secret']) ? $ix['google_export_client_secret'] : NULL;
        $calendar_id = isset($ix['google_export_calendar_id']) ? $ix['google_export_calendar_id'] : NULL;
        $auth_url = '';

        if(!trim($client_id) or !trim($client_secret) or !trim($calendar_id)) $this->main->response(array('success'=>0, 'message'=>__('All of Client ID, Client Secret and Calendar ID are required!', 'mec')));
        
        // Save options
        $this->main->save_ix_options(array('google_export_client_id'=>$client_id, 'google_export_client_secret'=>$client_secret, 'google_export_calendar_id'=>$calendar_id));
        
        try
        {
            $client = new Google_Client();
            $client->setApplicationName(get_bloginfo('name'));
            $client->setAccessType('offline');
            $client->setApprovalPrompt('force');
            $client->setScopes(array('https://www.googleapis.com/auth/calendar'));
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($this->main->add_qs_vars(array('mec-ix-action'=>'google-calendar-export-get-token'), $this->main->URL('backend').'admin.php?page=MEC-ix&tab=MEC-g-calendar-export'));

            $auth_url = filter_var($client->createAuthUrl(), FILTER_SANITIZE_URL);
        }
        catch(Exception $ex)
        {
            $this->main->response(array('success'=>0, 'message'=>$ex->getMessage()));
        }
        
        $this->main->response(array('success'=>1, 'message'=>sprintf(__('All seems good! Please click %s for authenticating your app.', 'mec'), '<a href="'.$auth_url.'">here</a>')));
    }
    
    public function g_calendar_export_get_token()
    {
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        
        $ix = $this->main->get_ix_options();
        $client_id = isset($ix['google_export_client_id']) ? $ix['google_export_client_id'] : NULL;
        $client_secret = isset($ix['google_export_client_secret']) ? $ix['google_export_client_secret'] : NULL;
        
        try
        {
            $client = new Google_Client();
            $client->setApplicationName(get_bloginfo('name'));
            $client->setAccessType('offline');
            $client->setApprovalPrompt('force');
            $client->setScopes(array('https://www.googleapis.com/auth/calendar'));
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($this->main->add_qs_vars(array('mec-ix-action'=>'google-calendar-export-get-token'), $this->main->URL('backend').'admin.php?page=MEC-ix&tab=MEC-g-calendar-export'));
            
            $authentication = $client->authenticate($code);
        	$token = $client->getAccessToken();
            
            $auth = json_decode($authentication, true);
            $refresh_token = $auth['refresh_token'];
            
            // Save options
            $this->main->save_ix_options(array('google_export_token'=>$token, 'google_export_refresh_token'=>$refresh_token));
            
            $url = $this->main->remove_qs_var('code', $this->main->remove_qs_var('mec-ix-action'));
            header('location: '.$url);
            exit;
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
            exit;
        }
    }
    
    public function g_calendar_export_do()
    {
        $mec_event_ids = isset($_POST['mec-events']) ? $_POST['mec-events'] : array();
        
        $ix = $this->main->get_ix_options();
        
        $client_id = isset($ix['google_export_client_id']) ? $ix['google_export_client_id'] : NULL;
        $client_secret = isset($ix['google_export_client_secret']) ? $ix['google_export_client_secret'] : NULL;
        $token = isset($ix['google_export_token']) ? $ix['google_export_token'] : NULL;
        $refresh_token = isset($ix['google_export_refresh_token']) ? $ix['google_export_refresh_token'] : NULL;
        $calendar_id = isset($ix['google_export_calendar_id']) ? $ix['google_export_calendar_id'] : NULL;
        
        if(!trim($client_id) or !trim($client_secret) or !trim($calendar_id)) $this->main->response(array('success'=>0, 'message'=>__('All of Client App, Client Secret and Calendar ID are required!', 'mec')));
        
        $client = new Google_Client();
        $client->setApplicationName('Modern Events Calendar');
        $client->setAccessType('offline');
        $client->setScopes(array('https://www.googleapis.com/auth/calendar'));
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($this->main->add_qs_vars(array('mec-ix-action'=>'google-calendar-export-get-token'), $this->main->URL('backend').'admin.php?page=MEC-ix&tab=MEC-g-calendar-export'));
        $client->setAccessToken($token);
        $client->refreshToken($refresh_token);
        
        $service = new Google_Service_Calendar($client);
        
        // MEC Render Library
        $render = $this->getRender();
        
        // Timezone Options
        $timezone = $this->main->get_timezone();
        $gmt_offset = $this->main->get_gmt_offset();
        
        $g_events_not_inserted = array();
        $g_events_inserted = array();
        $g_events_updated = array();
        
        foreach($mec_event_ids as $mec_event_id)
        {
            $data = $render->data($mec_event_id);
            
            $dates = $render->dates($mec_event_id, $data);
            $date = isset($dates[0]) ? $dates[0] : array();
            
            $location = isset($data->locations[$data->meta['mec_location_id']]) ? $data->locations[$data->meta['mec_location_id']] : array();
            $organizer = isset($data->organizers[$data->meta['mec_organizer_id']]) ? $data->organizers[$data->meta['mec_organizer_id']] : array();
            
            $recurrence = array();
            if(isset($data->mec->repeat) and $data->mec->repeat)
            {
                $finish = ($data->mec->end != '0000-00-00' ? date('Ymd\THis\Z', strtotime($data->mec->end.' '.$data->time['end'])) : '');
                $freq = '';
                $interval = '1';
                $byday = '';
                $wkst = '';
                
                $repeat_type = $data->meta['mec_repeat_type'];
                $week_day_mapping = array('1'=>'MO', '2'=>'TU', '3'=>'WE', '4'=>'TH', '5'=>'FR', '6'=>'SA', '7'=>'SU');
                
                if($repeat_type == 'daily')
                {
                    $freq = 'DAILY';
                    $interval = $data->mec->rinterval;
                }
                elseif($repeat_type == 'weekly')
                {
                    $freq = 'WEEKLY';
                    $interval = ($data->mec->rinterval/7);
                }
                elseif($repeat_type == 'monthly') $freq = 'MONTHLY';
                elseif($repeat_type == 'yearly') $freq = 'YEARLY';
                elseif($repeat_type == 'weekday')
                {
                    $mec_weekdays = explode(',', trim($data->mec->weekdays, ','));
                    foreach($mec_weekdays as $mec_weekday) $byday .= $week_day_mapping[$mec_weekday].',';
                    
                    $byday = trim($byday, ', ');
                    $freq = 'WEEKLY';
                }
                elseif($repeat_type == 'weekend')
                {
                    $mec_weekdays = explode(',', trim($data->mec->weekdays, ','));
                    foreach($mec_weekdays as $mec_weekday) $byday .= $week_day_mapping[$mec_weekday].',';
                    
                    $byday = trim($byday, ', ');
                    $freq = 'WEEKLY';
                }
                elseif($repeat_type == 'certain_weekdays')
                {
                    $mec_weekdays = explode(',', trim($data->mec->weekdays, ','));
                    foreach($mec_weekdays as $mec_weekday) $byday .= $week_day_mapping[$mec_weekday].',';
                    
                    $byday = trim($byday, ', ');
                    $freq = 'WEEKLY';
                }
                elseif($repeat_type == 'custom_days')
                {
                    $freq = '';
                    $mec_days = explode(',', trim($data->mec->days, ','));
                    
                    $days = '';
                    foreach($mec_days as $mec_day) $days .= date('Ymd', strtotime($mec_day)).',';
                    
                    // Add RDATE
                    $recurrence[] = trim('RDATE;VALUE=DATE:'.trim($days, ', '), '; ');
                }
                
                $rrule = 'RRULE:FREQ='.$freq.';'
                        .($interval > 1 ? 'INTERVAL='.$interval.';' : '')
                        .(($finish != '0000-00-00' and $finish != '') ? 'UNTIL='.$finish.';' : '')
                        .($wkst != '' ? 'WKST='.$wkst.';' : '')
                        .($byday != '' ? 'BYDAY='.$byday.';' : '');
                
                // Add RRULE
                if(trim($freq)) $recurrence[] = trim($rrule, '; ');
                
                if(trim($data->mec->not_in_days))
                {
                    $mec_not_in_days = explode(',', trim($data->mec->not_in_days, ','));
                    
                    $not_in_days = '';
                    foreach($mec_not_in_days as $mec_not_in_day) $not_in_days .= date('Ymd\THis', strtotime($mec_not_in_day.' '.$data->time['start'])).',';
                    
                    // Add EXDATE
                    $recurrence[] = trim('EXDATE;TZID='.$timezone.':'.trim($not_in_days, ', '), '; ');
                }
            }
            
            $event = new Google_Service_Calendar_Event(array
            (
                'summary'=>$data->title,
                'location'=>(isset($location['address']) ? $location['address'] : (isset($location['name']) ? $location['name'] : '')),
                'description'=>strip_tags(strip_shortcodes($data->content)),
                'start'=>array(
                    'dateTime'=>date('Y-m-d\TH:i:s', strtotime($date['start']['date'].' '.$data->time['start'])).$gmt_offset,
                    'timeZone'=>$timezone,
                ),
                'end'=>array(
                    'dateTime'=>date('Y-m-d\TH:i:s', strtotime($date['end']['date'].' '.$data->time['end'])).$gmt_offset,
                    'timeZone'=>$timezone,
                ),
                'recurrence'=>$recurrence,
                'attendees'=>array(),
                'reminders'=>array(),
            ));
            
            $iCalUID = 'mec-ical-'.$data->ID;
            
            $mec_iCalUID = get_post_meta($data->ID, 'mec_gcal_ical_uid', true);
            $mec_calendar_id = get_post_meta($data->ID, 'mec_gcal_calendar_id', true);
            
            /**
             * Event is imported from same google calendar
             * and now it's exporting to its calendar again
             * so we're trying to update existing one by setting event iCal ID
             */
            if($mec_calendar_id == $calendar_id and trim($mec_iCalUID)) $iCalUID = $mec_iCalUID;
            
            $event->setICalUID($iCalUID);
            
            // Set the organizer if exists
            if(isset($organizer['name']))
            {
                $g_organizer = new Google_Service_Calendar_EventOrganizer();
                $g_organizer->setDisplayName($organizer['name']);
                $g_organizer->setEmail($organizer['email']);

                $event->setOrganizer($g_organizer);
            }
            
            try
            {
                $g_event = $service->events->insert($calendar_id, $event);
                
                // Set Google Calendar ID to MEC databse for updating it in the future instead of adding it twice
                update_post_meta($data->ID, 'mec_gcal_ical_uid', $g_event->getICalUID());
                update_post_meta($data->ID, 'mec_gcal_id', $g_event->getId());
                
                $g_events_inserted[] = array('title'=>$data->title, 'message'=>$g_event->htmlLink);
            }
            catch(Exception $ex)
            {
                // Event already existed
                if($ex->getCode() == 409)
                {
                    try
                    {
                        $g_event_id = get_post_meta($data->ID, 'mec_gcal_id', true);
                        $g_event = $service->events->get($calendar_id, $g_event_id);
                        foreach($event as $k=>$v) $g_event->$k = $v;

                        $g_updated_event = $service->events->update($calendar_id, $g_event->getId(), $g_event);
                        $g_events_updated[] = array('title'=>$data->title, 'message'=>$g_updated_event->htmlLink);
                    }
                    catch(Exception $ex)
                    {
                        $g_events_not_inserted[] = array('title'=>$data->title, 'message'=>$ex->getMessage());
                    }
                }
                else $g_events_not_inserted[] = array('title'=>$data->title, 'message'=>$ex->getMessage());
            }
        }
        
        $results = '<ul>';
        foreach($g_events_not_inserted as $g_event_not_inserted) $results .= '<li><strong>'.$g_event_not_inserted['title'].'</strong>: '.$g_event_not_inserted['message'].'</li>';
        $results .= '<ul>';
        
        $message = (count($g_events_inserted) ? sprintf(__('%s events added to Google Calendar successfully.', 'mec'), '<strong>'.count($g_events_inserted).'</strong>') : '');
        $message .= (count($g_events_updated) ? ' '.sprintf(__('%s previously added events get updated.', 'mec'), '<strong>'.count($g_events_updated).'</strong>') : '');
        $message .= (count($g_events_not_inserted) ? ' '.sprintf(__('%s events failed to add for following reasons: %s', 'mec'), '<strong>'.count($g_events_not_inserted).'</strong>', $results) : '');
        
        $this->main->response(array('success'=>((count($g_events_inserted) or count($g_events_updated)) ? 1 : 0), 'message'=>trim($message)));
    }
    
    /**
     * Show content of Facebook Import tab
     * @author Webnus <info@webnus.biz>
     * @return void
     */
    public function ix_f_calendar_import()
    {
        // Current Action
        $this->action = isset($_POST['mec-ix-action']) ? $_POST['mec-ix-action'] : '';
        $this->ix = isset($_POST['ix']) ? $_POST['ix'] : array();
        
        $this->response = array();
        if($this->action == 'facebook-calendar-import-start') $this->response = $this->f_calendar_import_start();
        elseif($this->action == 'facebook-calendar-import-do') $this->response = $this->f_calendar_import_do();
        
        $path = MEC::import('app.features.ix.import_f_calendar', true, true);

        ob_start();
        include $path;
        echo $output = ob_get_clean();
    }
    
    public function f_calendar_import_start()
    {
        $fb_page_link = isset($this->ix['facebook_import_page_link']) ? $this->ix['facebook_import_page_link'] : NULL;
        if(!trim($fb_page_link)) return array('success'=>0, 'message'=>__("Please insert your facebook page's link.", 'mec'));
        
        // Save options
        $this->main->save_ix_options(array('facebook_import_page_link'=>$fb_page_link));
        
        $fb_page = $this->f_calendar_import_get_page($fb_page_link);
        
        $fb_page_id = isset($fb_page['id']) ? $fb_page['id'] : 0;
        if(!$fb_page_id) return array('success'=>0, 'message'=>__("We couldn't recognize your Facebook page. Please check it and provide us a valid facebook page link.", 'mec'));
        
        $events = array();
        $next_page = 'https://graph.facebook.com/v2.8/'.$fb_page_id.'/events/?access_token='.$this->fb_access_token;
        
        do
        {
            $events_result = $this->main->get_web_page($next_page);
            $fb_events = json_decode($events_result, true);
            
            // Exit the loop if no event found
            if(!isset($fb_events['data'])) break;
            
            foreach($fb_events['data'] as $fb_event)
            {
                $events[] = array('id'=>$fb_event['id'], 'name'=>$fb_event['name']);
            }
            
            $next_page = isset($fb_events['paging']['next']) ? $fb_events['paging']['next'] : NULL;
        }
        while($next_page);
        
        if(!count($events)) return array('success'=>0, 'message'=>__("No events found!", 'mec'));
        else return array('success'=>1, 'message'=>'', 'data'=>array('events'=>$events, 'count'=>count($events), 'name'=>$fb_page['name']));
    }
    
    public function f_calendar_import_do()
    {
        $f_events = isset($_POST['f-events']) ? $_POST['f-events'] : array();
        if(!count($f_events)) return array('success'=>0, 'message'=>__('Please select some events to import!', 'mec'));
        
        $fb_page_link = isset($this->ix['facebook_import_page_link']) ? $this->ix['facebook_import_page_link'] : NULL;
        if(!trim($fb_page_link)) return array('success'=>0, 'message'=>__("Please insert your facebook page's link.", 'mec'));
        
        $fb_page = $this->f_calendar_import_get_page($fb_page_link);
        
        $fb_page_id = isset($fb_page['id']) ? $fb_page['id'] : 0;
        if(!$fb_page_id) return array('success'=>0, 'message'=>__("We couldn't recognize your Facebook page. Please check it and provide us a valid facebook page link.", 'mec'));

        // Timezone
        $timezone = $this->main->get_timezone();

        // MEC File
        $file = $this->getFile();
        $wp_upload_dir = wp_upload_dir();
        
        $post_ids = array();
        foreach($f_events as $f_event_id)
        {
            $events_result = $this->main->get_web_page('https://graph.facebook.com/v2.8/'.$f_event_id.'?access_token='.$this->fb_access_token);
            $event = json_decode($events_result, true);
            
            // Event organizer
            $organizer_id = 1;
            
            // Event location
            $location = isset($event['place']) ? $event['place'] : array();
            $location_id = 1;

            // Import Event Locations into MEC locations
            if(isset($this->ix['import_locations']) and $this->ix['import_locations'] and count($location))
            {
                $location_name = $location['name'];
                $location_address = trim($location_name.' '.(isset($location['location']['city']) ? $location['location']['city'] : '').' '.(isset($location['location']['state']) ? $location['location']['state'] : '').' '.(isset($location['location']['country']) ? $location['location']['country'] : '').' '.(isset($location['location']['zip']) ? $location['location']['zip'] : ''), '');
                $location_id = $this->main->save_location(array
                (
                    'name'=>trim($location_name),
                    'address'=>$location_address,
                    'latitude'=>$location['location']['latitude'],
                    'longitude'=>$location['location']['longitude'],
                ));
            }
            
            // Event Title and Content
            $title = $event['name'];
            $description = isset($event['description']) ? $event['description'] : '';

            $date_start = new DateTime($event['start_time']);
            $date_start->setTimezone(new DateTimeZone($timezone));

            $start_date = $date_start->format('Y-m-d');
            $start_hour = $date_start->format('g');
            $start_minutes = $date_start->format('i');
            $start_ampm = $date_start->format('A');
            
            $end_timestamp = isset($event['end_time']) ? strtotime($event['end_time']) : 0;
            if($end_timestamp)
            {
                $date_end = new DateTime($event['end_time']);
                $date_end->setTimezone(new DateTimeZone($timezone));
            }

            $end_date = $end_timestamp ? $date_end->format('Y-m-d') : $start_date;
            $end_hour = $end_timestamp ? $date_end->format('g') : 8;
            $end_minutes = $end_timestamp ? $date_end->format('i') : '00';
            $end_ampm = $end_timestamp ? $date_end->format('A') : 'PM';

            // Event Time Options
            $allday = 0;
            
            $args = array
            (
                'title'=>$title,
                'content'=>$description,
                'location_id'=>$location_id,
                'organizer_id'=>$organizer_id,
                'date'=>array
                (
                    'start'=>array(
                        'date'=>$start_date,
                        'hour'=>$start_hour,
                        'minutes'=>$start_minutes,
                        'ampm'=>$start_ampm,
                    ),
                    'end'=>array(
                        'date'=>$end_date,
                        'hour'=>$end_hour,
                        'minutes'=>$end_minutes,
                        'ampm'=>$end_ampm,
                    ),
                    'repeat'=>array(),
                    'allday'=>$allday,
                    'comment'=>'',
                    'hide_time'=>0,
                    'hide_end_time'=>0,
                ),
                'start'=>$start_date,
                'start_time_hour'=>$start_hour,
                'start_time_minutes'=>$start_minutes,
                'start_time_ampm'=>$start_ampm,
                'end'=>$end_date,
                'end_time_hour'=>$end_hour,
                'end_time_minutes'=>$end_minutes,
                'end_time_ampm'=>$end_ampm,
                'repeat_status'=>0,
                'repeat_type'=>'',
                'interval'=>NULL,
                'finish'=>$end_date,
                'year'=>NULL,
                'month'=>NULL,
                'day'=>NULL,
                'week'=>NULL,
                'weekday'=>NULL,
                'weekdays'=>NULL,
                'meta'=>array
                (
                    'mec_source'=>'facebook-calendar',
                    'mec_facebook_page_id'=>$fb_page_id,
                    'mec_facebook_event_id'=>$f_event_id,
                    'mec_allday'=>$allday
                )
            );
            
            $post_id = $this->db->select("SELECT `post_id` FROM `#__postmeta` WHERE `meta_value`='$f_event_id' AND `meta_key`='mec_facebook_event_id'", 'loadResult');
            
            // Insert the event into MEC
            $post_id = $this->main->save_event($args, $post_id);
            $post_ids[] = $post_id;
            
            // Set location to the post
            if($location_id) wp_set_object_terms($post_id, (int) $location_id, 'mec_location');

            // Set the Featured Image
            $photos_results = $this->main->get_web_page('https://graph.facebook.com/v2.8/'.$f_event_id.'/photos?access_token='.$this->fb_access_token);
            $photos = json_decode($photos_results, true);
            
            if(!has_post_thumbnail($post_id) and isset($photos['data']) and is_array($photos['data']) and count($photos['data']))
            {
                $photo = $this->main->get_web_page('https://graph.facebook.com/'.$photos['data'][0]['id'].'/picture?type=normal');
                $file_name = md5($post_id).'.'.$this->main->get_image_type_by_buffer($photo);
                
                $path = rtrim($wp_upload_dir['path'], DS.' ').DS.$file_name;
                $url = rtrim($wp_upload_dir['url'], '/ ').'/'.$file_name;
                
                $file->write($path, $photo);
                $this->main->set_featured_image($url, $post_id);
            }
        }
        
        return array('success'=>1, 'data'=>$post_ids);
    }
    
    public function f_calendar_import_get_page($link)
    {
        $fb_page_result = $this->main->get_web_page('https://graph.facebook.com/v2.8/?access_token='.$this->fb_access_token.'&id='.$link);
        return json_decode($fb_page_result, true);
    }
}