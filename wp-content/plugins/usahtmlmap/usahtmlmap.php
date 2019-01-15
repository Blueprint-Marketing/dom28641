<?php
/*
Plugin Name: Interactive Map of the USA for WP
Plugin URI: http://www.fla-shop.com
Description: High-quality map plugin of the USA for WordPress. The map depicts states and features color, font, landing page and popup customization
Text Domain: usa-html5-map
Domain Path: /languages
Version: 2.7.8
Author: Fla-shop.com
Author URI: http://www.fla-shop.com
License:
*/

add_action('plugins_loaded', 'usa_html5map_plugin_load_domain' );
function usa_html5map_plugin_load_domain() {
    load_plugin_textdomain( 'usa-html5-map', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
if (isset($_REQUEST['action']) && $_REQUEST['action']=='usa-html5-map-export') { usa_html5map_plugin_export(); }

add_action('admin_menu', 'usa_html5map_plugin_menu');


function usa_html5map_plugin_menu() {

    add_menu_page(__('USA Map Settings', 'usa-html5-map'), __('USA Map Settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-options', 'usa_html5map_plugin_options' );

    add_submenu_page('usa-html5-map-options', __('Detailed settings', 'usa-html5-map'), __('Detailed settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-states', 'usa_html5map_plugin_states');
    add_submenu_page('usa-html5-map-options', __('Points settings', 'usa-html5-map'), __('Points settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-points', 'usa_html5map_plugin_points');
    add_submenu_page('usa-html5-map-options', __('Map Preview', 'usa-html5-map'), __('Map Preview', 'usa-html5-map'), 'manage_options', 'usa-html5-map-view', 'usa_html5map_plugin_view');

    add_submenu_page('usa-html5-map-options', __('Maps', 'usa-html5-map'), __('Maps', 'usa-html5-map'), 'manage_options', 'usa-html5-map-maps', 'usa_html5map_plugin_maps');
}

function usa_html5map_plugin_nav_tabs($page, $map_id)
{
?>
<h2 class="nav-tab-wrapper">
    <a href="?page=usa-html5-map-options&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'options' ? 'nav-tab-active' : '' ?>"><?php _e('General settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-states&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'states' ? 'nav-tab-active' : '' ?>"><?php _e('Detailed settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-points&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'points' ? 'nav-tab-active' : '' ?>"><?php _e('Points settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-view&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'view' ? 'nav-tab-active' : '' ?>"><?php _e('Preview', 'usa-html5-map') ?></a>
</h2>
<?php
}

function usa_html5map_plugin_messages($successes, $errors) {
    if ($successes and is_array($successes)) {
        echo "<div class=\"updated\"><ul>";
        foreach ($successes as $s) {
            echo "<li>" . (is_array($s) ? "<strong>$s[0]</strong>$s[1]" : $s) . "</li>";
        }
        echo "</ul></div>";
    }

    if ($errors and is_array($errors)) {
        echo "<div class=\"error\"><ul>";
        foreach ($errors as $s) {
            echo "<li>" . (is_array($s) ? "<strong>$s[0]</strong>$s[1]" : $s) . "</li>";
        }
        echo "</ul></div>";
    }
}

function usa_html5map_plugin_options() {
    include('editmainconfig.php');
}

function usa_html5map_plugin_states() {
    include('editstatesconfig.php');
}

function usa_html5map_plugin_points() {
    include('editpointsconfig.php');
}
function usa_html5map_plugin_maps() {
    include('mapslist.php');
}

function usa_html5map_plugin_view() {

    $options = get_site_option('usahtml5map_options');
    $option_keys = is_array($options) ? array_keys($options) : array();
    $map_id  = (isset($_REQUEST['map_id'])) ? intval($_REQUEST['map_id']) : array_shift($option_keys) ;

?>
<div class="wrap">
    <div style="clear: both"></div>

    <h2><?php _e('Map Preview', 'usa-html5-map') ?></h2>

    <script type="text/javascript">
        jQuery(function(){
            jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

            jQuery('select[name=map_id]').change(function() {
                location.href='admin.php?page=usa-html5-map-view&map_id='+jQuery(this).val();
            });

        });
    </script>
    <br />
    <form method="POST" class="usa-html5-map main">
    <span class="title"><?php echo __('Select a map:', 'usa-html5-map'); ?> </span>
    <select name="map_id" style="width: 185px;">
        <?php foreach($options as $id => $map_data) { ?>
            <option value="<?php echo $id; ?>" <?php echo ($id==$map_id)?'selected':'';?>><?php echo $map_data['name']; ?></option>
        <?php } ?>
    </select>
    <span class="tipsy-q" original-title="<?php esc_attr_e('The map', 'usa-html5-map'); ?>">[?]</span>
    <a href="admin.php?page=usa-html5-map-maps" class="page-title-action"><?php
    _e('Maps list', 'usa-html5-map') ?></a>
    <br /><br />
    </form>
    <style type="text/css">
        .usaHtml5MapBold {font-weight: bold}
    </style>
<?php
    usa_html5map_plugin_nav_tabs('view', $map_id);

    echo '<p>'.sprintf(__('Use shortcode %s for install this map', 'usa-html5-map'), '<span class="usaHtml5MapBold">[usahtml5map id="'.$map_id.'"]</span>').'</p>';

    echo do_shortcode('<div style="width: 99%">[usahtml5map id="'.$map_id.'"]</div>');
    echo "</div>";
}

add_action('admin_init','usa_html5map_plugin_scripts');

function usa_html5map_plugin_scripts(){
    if ( is_admin() ){

        wp_register_style('jquery-tipsy', plugins_url('/static/css/tipsy.css', __FILE__));
        wp_enqueue_style('jquery-tipsy');
        wp_register_style('usa-html5-map-adm', plugins_url('/static/css/mapadm.css', __FILE__));
        wp_enqueue_style('usa-html5-map-adm');
        wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
        wp_enqueue_style('usa-html5-map-style');
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_script('farbtastic');
        wp_enqueue_script('tiny_mce');
        wp_register_script('jquery-tipsy', plugins_url('/static/js/jquery.tipsy.js', __FILE__));
        wp_enqueue_script('jquery-tipsy');

    }
    else {

        wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
        wp_enqueue_style('usa-html5-map-style');
        wp_register_script('raphael', plugins_url('/static/js/raphael.min.js', __FILE__));
        wp_enqueue_script('raphael');
        wp_register_script('usa-html5-map-js', plugins_url('/static/js/map.js', __FILE__));
        wp_enqueue_script('usa-html5-map-js');
        wp_enqueue_script('jquery');

    }
}

add_action('wp_enqueue_scripts', 'usa_html5map_plugin_scripts_method');

function usa_html5map_plugin_scripts_method() {
    wp_enqueue_script('jquery');
    wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
    wp_enqueue_style('usa-html5-map-style');
}


add_shortcode( 'usahtml5map', 'usa_html5map_plugin_content' );

function usa_html5map_plugin_content($atts, $content) {
    static $firstRun = true;
    $dir               = plugins_url('/static/', __FILE__);
    $siteURL           = get_site_url();
    $options           = get_site_option('usahtml5map_options');
    $option_keys       = is_array($options) ? array_keys($options) : array();

    if (isset($atts['id'])) {
        $map_id  = intval($atts['id']);
        $options = $options[$map_id];
    } else {
        $map_id  = array_shift($option_keys);
        $options = array_shift($options);
    }
    $prfx              = "_$map_id";
    $isResponsive      = $options['isResponsive'];
    $stateInfoArea     = $options['statesInfoArea'];
    $respInfo          = $isResponsive ? ' htmlMapResponsive' : '';
    $popupNameColor    = $options['popupNameColor'];
    $popupNameFontSize = $options['popupNameFontSize'].'px';

    $style             = (!empty($options['maxWidth']) && $isResponsive) ? 'max-width:'.intval($options['maxWidth']).'px' : '';
    
    static $count = 0;
    
    wp_register_script('raphaeljs', "{$dir}js/raphael.min.js", array(), '2.1.4');
    wp_register_script('usa-html5-map-mapjs', "{$dir}js/map.js", array('raphaeljs'));
    wp_register_script('usa-html5-map-map_cfg_'.$map_id, "{$siteURL}/index.php?usahtml5map_js_data=true&map_id=$map_id&r=".rand(11111,99999), array('raphaeljs', 'usa-html5-map-mapjs'));
    wp_enqueue_script('usa-html5-map-map_cfg_'.$map_id);

    $comment_css = '';
    if ( ! empty($options['popupCommentColor'])) {
        $comment_css .= "\t\t\t\tcolor: $options[popupCommentColor];\n";
    }
    if ( ! empty($options['popupCommentFontSize'])) {
        $comment_css .= "\t\t\t\tfont-size: $options[popupCommentFontSize]px;\n";
    }

    $mapInit = "
        <!-- start Fla-shop.com HTML5 Map -->";
    $mapInit .= "
        <div class='usaHtml5Map$stateInfoArea$respInfo' style='$style'>
        <div id='usa-html5-map-map-container_{$count}' class='usaHtml5MapContainer'></div>
            <style>
                #usa-html5-map-map-container_{$count} .fm-tooltip-name {
                    color: $popupNameColor;
                    font-size: $popupNameFontSize;
                }
                #usa-html5-map-map-container_{$count} .fm-tooltip-comment {
                    $comment_css
                }
            </style>
            <script>
            jQuery(function(){
                var usahtml5map_map_{$count} = new FlaShopUSAMap(usahtml5map_map_cfg_{$map_id});
                usahtml5map_map_{$count}.draw('usa-html5-map-map-container_{$count}');
            });
            </script>
            <div id='usa-html5-map-state-info{$prfx}' class='usaHtml5MapStateInfo'>".
            (empty($options['defaultAddInfo']) ? '' : apply_filters('the_content',$options['defaultAddInfo']))
            ."</div>
            </div>
            <div style='clear: both'></div>
            <!-- end HTML5 Map -->
    ";
    
    $count++;

    return $mapInit;
}


$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'usa_html5map_plugin_settings_link' );

function usa_html5map_plugin_settings_link($links) {
    $settings_link = '<a href="admin.php?page=usa-html5-map-options">'.__('Settings', 'usa-html5-map').'</a>';
    array_push($links, $settings_link);
    return $links;
}


add_action( 'parse_request', 'usa_html5map_plugin_wp_request' );

function usa_html5map_plugin_wp_request( $wp ) {
    $req_start = microtime(TRUE);
    if (isset($_REQUEST['usahtml5map_js_data']) or
        isset($_REQUEST['usahtml5map_get_state_info']) or
        isset($_REQUEST['usahtml5map_get_group_info'])) {
        $map_id  = intval($_REQUEST['map_id']);
        $options = get_site_option('usahtml5map_options');
        $options = $options[$map_id];
        if ($options)
            $options['map_data'] = str_replace('\\\\n','\\n',$options['map_data']);
    }


    if( isset($_GET['usahtml5map_js_data']) ) {

        header( 'Content-Type: application/javascript' );
        if ( ! $options) {
        ?>
        var	map_cfg = {
            map_data: {}
        };
        <?php
        exit;
        }
        $data = json_decode($options['map_data'], true);
        $protected_shortnames = array('st7', 'st8', 'st9', 'st12', 'st21', 'st22', 'st30', 'st31', 'st40', 'st46');
        $siteURL           = get_site_url();
        foreach ($data as $sid => &$d)
        {
            if (isset($d['comment']) AND $d['comment'] AND preg_match('/\[([\w-_]+)([^\]]*)?\](?:(.+?)?\[\/\1\])?/', $d['comment']))
                $d['comment'] = do_shortcode($d['comment']);
            if (isset($d['_hide_name'])) {
                unset($d['_hide_name']);
                $d['name'] = '';
            }
            if (isset($options['hideSN']) AND ! in_array($sid, $protected_shortnames))
                $d['shortname'] = '';
        }
        unset($d);
        $options['map_data'] = json_encode($data);
        $grps = array();
        $points_def = array(
            'pointColor'            => "#FFC480",
            'pointColorOver'        => "#DC8135",
            'pointNameColor'        => "#000",
            'pointNameColorOver'    => "#222",
            'pointNameStrokeColor'  => "#FFFFFF",
            'pointNameStrokeColorOver'  => "#FFFFFF",
            'pointBorderColor'      => "#ffffff",
            'pointBorderColorOver'  => "#eeeeee",
        );
        foreach ($points_def as $k => $v) {
            if (!isset($options[$k]))
                $options[$k] = $v;
        }
       ?>

        var	usahtml5map_map_cfg_<?php echo $map_id ?> = {

        <?php  if(!$options['isResponsive']) { ?>
        mapWidth		: <?php echo $options['mapWidth']; ?>,
        mapHeight		: <?php echo $options['mapHeight']; ?>,
        <?php }     else { ?>
            mapWidth		: 0,
            <?php } ?>
        zoomEnable              : <?php echo (isset($options['zoomEnable']) AND $options['zoomEnable']) ? 'true' : 'false'; ?>,
        zoomEnableControls      : <?php echo (isset($options['zoomEnableControls']) AND $options['zoomEnableControls']) ? 'true' : 'false'; ?>,
        zoomIgnoreMouseScroll   : <?php echo (isset($options['zoomIgnoreMouseScroll']) AND $options['zoomIgnoreMouseScroll']) ? 'true' : 'false'; ?>,
        zoomMax   : <?php echo (isset($options['zoomMax']) AND $options['zoomMax']) ? $options['zoomMax'] : 2; ?>,
        zoomStep   : <?php echo (isset($options['zoomStep']) AND $options['zoomStep']) ? $options['zoomStep'] : 0.2; ?>,
        pointColor            : "<?php echo $options['pointColor']?>",
        pointColorOver        : "<?php echo $options['pointColorOver']?>",
        pointNameColor        : "<?php echo $options['pointNameColor']?>",
        pointNameColorOver    : "<?php echo $options['pointNameColorOver']?>",
        pointNameStrokeColor        : "<?php echo $options['pointNameStrokeColor']?>",
        pointNameStrokeColorOver    : "<?php echo $options['pointNameStrokeColorOver']?>",
        pointNameFontSize     : "12px",
        pointNameFontWeight   : "bold",
        pointNameStroke       : true,

        pointBorderWidth      : 0.5,
        pointBorderColor      : "<?php echo $options['pointBorderColor']?>",
        pointBorderColorOver  : "<?php echo $options['pointBorderColorOver']?>",
        shadowAllow             : <?php echo (isset($options['shadowAllow']) AND $options['shadowAllow']) ? 'true' : 'false'; ?>,
        shadowWidth		: <?php echo $options['shadowWidth']; ?>,
        shadowOpacity		: <?php echo $options['shadowOpacity']; ?>,
        shadowColor		: "<?php echo $options['shadowColor']; ?>",
        shadowX			: <?php echo $options['shadowX']; ?>,
        shadowY			: <?php echo $options['shadowY']; ?>,

        iPhoneLink		: <?php echo $options['iPhoneLink']; ?>,

        isNewWindow		: <?php echo $options['isNewWindow']; ?>,

        borderColor		: "<?php echo $options['borderColor']; ?>",
        borderColorOver		: "<?php echo $options['borderColorOver']; ?>",

        nameColor		: "<?php echo $options['nameColor']; ?>",
        popupNameColor		: "<?php echo $options['popupNameColor']; ?>",
        nameFontSize		: "<?php echo $options['nameFontSize'].'px'; ?>",
        popupNameFontSize	: "<?php echo $options['popupNameFontSize'].'px'; ?>",
        nameFontWeight		: "<?php echo $options['nameFontWeight']; ?>",

        overDelay		: <?php echo $options['overDelay']; ?>,
        nameStroke		: <?php echo $options['nameStroke']?'true':'false'; ?>,
        nameStrokeColor		: "<?php echo $options['nameStrokeColor']; ?>",
        map_data        : <?php echo $options['map_data']; ?>
        ,points         : <?php echo (isset($options['points']) AND $options['points']) ? json_encode($options['points']) : '{}'; ?>
        };

        if (typeof usahtml5map_set_state_text == "undefined") {
            var usahtml5map_set_state_text = function(state, grp) {
                usahtml5map_set_state_text_<?php echo $map_id ?>(state, grp);
            }
        }

        function usahtml5map_set_state_text_<?php echo $map_id ?>(state, grp) {
            jQuery('#usa-html5-map-state-info_<?php echo $map_id ?>').html('<?php _e('Loading...', 'usa-html5-map') ?>');
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo $siteURL ?>/index.php?usahtml5map_get_'+(grp ? 'group' : 'state')+'_info='+state+'&map_id=<?php echo $map_id ?>',
                success: function(data, textStatus, jqXHR){
                    jQuery('#usa-html5-map-state-info_<?php echo $map_id ?>').html(data);
                },
                dataType: 'text'
            });
        }

        <?php
        echo '// Generated in '.(microtime(TRUE)-$req_start).' secs.';
        exit;
    }

    if(isset($_GET['usahtml5map_get_state_info'])) {
        $stateId = $_GET['usahtml5map_get_state_info'];

        $info = $options['state_info'][$stateId];
        $info = nl2br($info);
        echo apply_filters('the_content',$info);

        exit;
    }

}


function usa_html5map_plugin_map_defaults($name='New map') {

    $initialStatesPath = dirname(__FILE__).'/static/settings_tpl.json';

    $defaults = array(
                        'name'              => $name,
                        'map_data'          => file_get_contents($initialStatesPath),
                        'mapWidth'          =>530,
                        'mapHeight'         =>410,
                        'maxWidth'          =>980,
                        'shadowAllow'       => true,
                        'zoomEnable'            => false,
                        'zoomEnableControls'    => true,
                        'zoomIgnoreMouseScroll' => false,
                        'zoomMax'               => 2,
                        'zoomStep'              => 0.2,
                        'pointColor'            => "#FFC480",
                        'pointColorOver'        => "#DC8135",
                        'pointNameColor'        => "#000",
                        'pointNameColorOver'    => "#222",
                        'pointNameFontSize'     => "12px",
                        'pointNameFontWeight'   => "bold",
                        'pointNameStroke'       => true,
                        'pointNameStrokeColor'  => "#FFFFFF",
                        'pointNameStrokeColorOver'  => "#FFFFFF",

                        'pointBorderWidth'      => 0.5,
                        'pointBorderColor'      => "#ffffff",
                        'pointBorderColorOver'  => "#eeeeee",
                        'shadowWidth'       => 1.5,
                        'shadowOpacity'     => 0.2,
                        'shadowColor'       => "black",
                        'shadowX'           => 0,
                        'shadowY'           => 0,
                        'iPhoneLink'        => "true",
                        'isNewWindow'       => "false",
                        'borderColor'       => "#ffffff",
                        'borderColorOver'   => "#ffffff",
                        'nameColor'         => "#ffffff",
                        'popupNameColor'    => "#000000",
                        'nameFontSize'      => "10",
                        'popupNameFontSize' => "20",
                        'nameFontWeight'    => "bold",
                        'overDelay'         => 300,
                        'statesInfoArea'    => "bottom",
                        'isResponsive'      => "1",
                        'nameStroke'        => true,
                        'nameStrokeColor'   => "#000000",
                    );
    $arr = json_decode($defaults['map_data'], true);
    foreach ($arr as $i) {
        $defaults['state_info'][$i['id']] = '';
    }

    return $defaults;
}

function usa_html5map_plugin_group_defaults($name) {
    return array(
        'group_name' => $name,
        '_popup_over' => false,
        '_act_over' => false,
        '_clr_over' => false,
        '_ignore_group' => false,
        'name' => $name,
        'comment' => '',
        'info' => '',
        'image' => '',
        'link' => '',
        'color_map' => '#ffffff',
        'color_map_over' => '#ffffff'
    );
}


function usa_html5map_plugin_sort_states_by_name($a, $b) {
    return strcmp($a['name'], $b['name']);
}

register_activation_hook( __FILE__, 'usa_html5map_plugin_activation' );

function usa_html5map_plugin_activation() {

    $options = array(0 => usa_html5map_plugin_map_defaults());

    add_site_option('usahtml5map_options', $options);

}

register_deactivation_hook( __FILE__, 'usa_html5map_plugin_deactivation' );

function usa_html5map_plugin_deactivation() {

}

register_uninstall_hook( __FILE__, 'usa_html5map_plugin_uninstall' );

function usa_html5map_plugin_uninstall() {
    delete_site_option('usahtml5map_options');
}

add_filter('widget_text', 'do_shortcode');


function usa_html5map_plugin_export() {
    $maps    = explode(',',$_REQUEST['maps']);
    $options = get_site_option('usahtml5map_options');

    foreach($options as $map_id => $option) {
        if (!in_array($map_id,$maps)) {
            unset($options[$map_id]);
        }
    }

    if (count($options)>0) {
        $options = json_encode($options);

        header($_SERVER["SERVER_PROTOCOL"] . ' 200 OK');
        header('Content-Type: text/json');
        header('Content-Length: ' . (strlen($options)));
        header('Connection: close');
        header('Content-Disposition: attachment; filename="maps.json";');
        echo $options;

        exit();
    }

}

function usa_html5map_plugin_import() {
    $errors = array();
    if(is_uploaded_file($_FILES['import_file']["tmp_name"])) {

        $hwnd = fopen($_FILES['import_file']["tmp_name"],'r');
        $data = fread($hwnd,filesize($_FILES['import_file']["tmp_name"]));
        fclose($hwnd);

        $data    = json_decode($data, true);

        if ($data) {
            $def_settings = file_get_contents(dirname(__FILE__).'/static/settings_tpl.json');
            $def_settings = json_decode($def_settings, true);
            $states_count = count($def_settings);

            $options = get_site_option('usahtml5map_options');

            foreach($data as $map_id => $map_data) {

                if (isset($map_data['map_data']) and $map_data['map_data']) {

                    $data = json_decode($map_data['map_data'], true);
                    $cur_count = $data ? count($data) : 0;
                    $c = $options ? max(array_keys($options))+1 : 0;
                    if ($cur_count != $states_count) {
                        $errors[] = sprintf(__('Failed to import "%s", looks like it is a wrong map. Got %d states when expected states count was: %d', 'usa-html5-map'), $map_data['name'], $cur_count, $states_count);
                        continue;
                    }
                    $map_data['map_data'] = preg_replace("/javascript:[\w_]+_set_state_text[^\(]*\(/", "javascript:usahtml5map_set_state_text_$c(", $map_data['map_data']);
                    $options[]              = $map_data;
                } else {
                   $errors[] = sprintf(__('Section "%s" skipped cause it has no "map_data" block.'), $map_id);
                }

            }
            update_site_option('usahtml5map_options',$options);
        } else {
            $errors[] = __('Failed to parse uploaded file. Is it JSON?', 'usa-html5-map');
        }

        unlink($_FILES['import_file']["tmp_name"]);

    } else {
        $errors[] = __('File uploading error!', 'usa-html5-map');
    }
    foreach ($errors as $error) {
         echo '<div class="error">'.$error."</div>\n";
    }
}
