<?php
/**
 * Add/Edit Single Layout setting page
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $wp_version, $wpdb, $bdp_errors, $bdp_success, $bdp_settings;
if (isset($_GET['page']) && $_GET['page'] == 'single_post') {
    $page = $_GET['page'];
    $bdp_settings = array();
    $custom_single_type = '';
    $single_template_name = '';
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $single_id = $_GET['id'];
        $tableName = $wpdb->prefix . 'bdp_single_layouts';
        $getQry = "SELECT * FROM $tableName WHERE ID = $single_id";
        $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
        if (!isset($get_allsettings[0]['settings'])) {
            echo '<div class="updated notice">';
            wp_die(__('You attempted to edit an item that doesn’t exist. Perhaps it was deleted?', BLOGDESIGNERPRO_TEXTDOMAIN));
            echo '</div>';
        }
        $allsettings = $get_allsettings[0]['settings'];
        if (is_serialized($allsettings)) {
            $bdp_settings = unserialize($allsettings);
            $custom_single_type = $get_allsettings[0]['single_template'];
            $single_template_name = $get_allsettings[0]['single_name'];
        }
    }
}
$font_family = bdp_default_recognized_font_faces();
$template_name = isset($bdp_settings['template_name']) ? $bdp_settings['template_name'] : 'classical';

$tempate_list = bdp_single_blog_template_list();

if ($template_name == 'brite' || $template_name == 'minimal'|| $template_name == 'clicky') {
    $winter_category_txt = __('Choose Tags Background Color', BLOGDESIGNERPRO_TEXTDOMAIN);
} else {
    $winter_category_txt = __('Choose Category Background Color', BLOGDESIGNERPRO_TEXTDOMAIN);
}
?>
<div class="wrap">
    <h1>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            _e('Edit Single Post Design', BLOGDESIGNERPRO_TEXTDOMAIN);
        } else {
            _e('Add Single Post Layout', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            ?>
            <a class="page-title-action" href="?page=single_post">
                <?php _e('Create New Single Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            </a>
            <?php
        }
        if (isset($_GET['message']) && $_GET['message'] == 'shortcode_duplicate_msg') {
            ?>
            <div class="updated notice">
                <p><?php _e('Layout duplicated successfully. Please Select Post Categories or Tags and Select Posts for this layout.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
            </div>
            <?php
        }
        ?>
    </h1>
    <?php
    if (isset($bdp_errors)) {
        if (is_wp_error($bdp_errors)) {
            ?>
            <div class="error notice">
                <p><?php echo $bdp_errors->get_error_message(); ?></p>
            </div>
            <?php
        }
    }
    if (isset($bdp_success)) {
        ?>
        <div class="updated notice">
            <p><?php echo $bdp_success; ?></p>
        </div>
        <?php
    }
    if (isset($_GET['message']) && $_GET['message'] == 'single_added_msg') {
        ?>
        <div class="updated notice">
            <p><?php _e('Single layout added successfully.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
        </div>
        <?php
    }
    ?>
    <form method="post" id="single-layout-form" onsubmit="setFormSubmitting()" action="" class="bd-form-class single-layout">
        <?php
        wp_nonce_field('bdp-shortcode-form-submit', 'bdp-submit-nonce');
        $page = '';
        if (isset($_GET['page']) && $_GET['page'] != '') {
            $page = $_GET['page'];
            ?>
            <input type="hidden" name="originalpage" class="bdporiginalpage" value="<?php echo $page; ?>">
        <?php } ?>
        <div id="poststuff">
            <div class="postbox-container bd-settings-wrappers bd_poststuff">
                <div class="bd-header-wrapper">
                    <div class="bd-logo-wrapper pull-left">
                        <h3><?php _e('Blog designer settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                    </div>
                    <div class="pull-right">
                        <a id="bdp-btn-single" title="<?php _e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="show_single_save button submit_fixed button-primary">
                            <span><i class="fas fa-check"></i>&nbsp;&nbsp;<?php _e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </a>
                        <input type="submit" style="display:none;" class="button-primary bdp_single_save_btn" name="savedata" value="<?php esc_attr_e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                    </div>
                </div>
                <div class="bd-menu-setting">
                    <?php
                    $bdpgeneral_class = $bdpmedia_class = $bdpstandard_class = $bdptitle_class = $bdpauthor_class = $bdpcontent_class = $bdprelatd_class = $bdpsinglepostnavigation_class = $bdpsocial_class = '';
                    $bdpgeneral_class_show = $bdpmedia_class_show = $bdpstandard_class_show = $bdptitle_class_show = $bdpauthor_class_show = $bdpcontent_class_show = $bdprelated_class_show = $bdpsinglepostnavigation_class_show = $bdpsocial_class_show = '';
                    if (bdp_postbox_classes('bdpsinglegeneral', $page)) {
                        $bdpgeneral_class = 'class="bd-active-tab"';
                        $bdpgeneral_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglestandard', $page)) {
                        $bdpstandard_class = 'class="bd-active-tab"';
                        $bdpstandard_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsingletitle', $page)) {
                        $bdptitle_class = 'class="bd-active-tab"';
                        $bdptitle_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglepostauthor', $page)) {
                        $bdpauthor_class = 'class="bd-active-tab"';
                        $bdpauthor_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsingleconent', $page)) {
                        $bdpcontent_class = 'class="bd-active-tab"';
                        $bdpcontent_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglemedia', $page)) {
                        $bdpmedia_class = 'class="bd-active-tab"';
                        $bdpmedia_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglerelated', $page)) {
                        $bdprelatd_class = 'class="bd-active-tab"';
                        $bdprelated_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglepostnavigation', $page)) {
                        $bdpsinglepostnavigation_class = 'class="bd-active-tab"';
                        $bdpsinglepostnavigation_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsinglesocial', $page)) {
                        $bdpsocial_class = 'class="bd-active-tab"';
                        $bdpsocial_class_show = 'style="display: block;"';
                    } else {
                        $bdpgeneral_class = 'class="bd-active-tab"';
                        $bdpgeneral_class_show = 'style="display: block;"';
                    }
                    ?>
                    <ul class="bd-setting-handle">
                        <li data-show="bdpsinglegeneral" <?php echo $bdpgeneral_class; ?>>
                            <i class="fas fa-cog"></i>
                            <span><?php _e('General Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglestandard" <?php echo $bdpstandard_class; ?>>
                            <i class="fas fa-gavel"></i>
                            <span><?php _e('Standard Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsingletitle" <?php echo $bdptitle_class; ?>>
                            <i class="fas fa-text-width"></i>
                            <span><?php _e('Title Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsingleconent" <?php echo $bdpcontent_class; ?>>
                            <i class="far fa-file-alt"></i>
                            <span><?php _e('Content Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglemedia" <?php echo $bdpmedia_class; ?>>
                            <i class="far fa-image"></i>
                            <span><?php _e('Media Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglepostnavigation" <?php echo $bdpsinglepostnavigation_class; ?>>
                            <i class="fas fa-exchange-alt"></i>
                            <span><?php _e('Post Navigation (Next/Previous) Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglepostauthor" <?php echo $bdpauthor_class; ?>>
                            <i class="fas fa-user"></i>
                            <span><?php _e('Author Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglerelated" <?php echo $bdprelatd_class; ?>>
                            <i class="fas fa-th-large"></i>
                            <span><?php _e('Related Post Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsinglesocial" <?php echo $bdpsocial_class; ?>>
                            <i class="fas fa-share-alt"></i>
                            <span><?php _e('Social Share Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                    </ul>
                </div>
                <div id="bdpsinglegeneral" class="postbox postbox-with-fw-options"<?php echo $bdpgeneral_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <h3 class="bdp-table-title"><?php _e('Select Single Post Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-left">
                                    <p class="bdp-margin-bottom-50"><?php _e('Select your favorite layout from 40+ powerful single post layouts.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                    <p class="bdp-margin-bottom-30"><b><?php _e('Current Template:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b> &nbsp;&nbsp;
                                        <span class="bdp-template-name">
                                        <?php
                                        if (isset($tempate_list[$template_name]['template_name'])) {
                                            echo $tempate_list[$template_name]['template_name'];
                                        } else {
                                            echo __('Classical Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        }
                                        ?></span>
                                    </p>
                                    <div class="bdp_select_template_button_div">
                                        <input type="button" class="bdp_select_template" value="<?php esc_attr_e('Select Other Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                        <input type="hidden" class="bdp_template_name <?php
                                        if (isset($_GET['page']) && $_GET['page'] == 'add_shortcode' && !isset($_GET['action'])) {
                                            echo 'bdp-create-shortcode';
                                        }
                                        ?>" value="<?php
                                               if ($template_name) {
                                                   echo $template_name;
                                               }
                                               ?>" name="template_name">
                                    </div>
                                    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) { ?>
                                        <input type="submit" class="bdp-reset-data" name="resetdata" value="<?php esc_attr_e('Reset Layout Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" /><?php
                                    } ?>
                                </div>
                                <div class="bdp-right">
                                    <div class="select_button_upper_div">
                                        <div class="bdp_selected_template_image">
                                            <div <?php
                                            $template_name = isset($bdp_settings['template_name']) ? $bdp_settings['template_name'] : 'classical';
                                            if ($template_name == '') {
                                                echo ' class="bdp_no_template_found"';
                                            }
                                            ?>>
                                                    <?php
                                                    if ($template_name != '') {
                                                        $image_name = $template_name . '.jpg';
                                                        ?>
                                                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/single/' . $image_name; ?>" alt="<?php
                                                    if (isset($bdp_settings['template_name'])) {
                                                        echo $tempate_list[$bdp_settings['template_name']]['template_name'];
                                                    }
                                                    ?>" title="<?php
                                                         if (isset($bdp_settings['template_name'])) {
                                                             echo $tempate_list[$bdp_settings['template_name']]['template_name'];
                                                         }
                                                         ?>" />
                                                    <label id="template_select_name"><?php
                                                        if (isset($tempate_list[$template_name]['template_name'])) {
                                                            echo $tempate_list[$template_name]['template_name'];
                                                        } else {
                                                            echo __('Classical Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                                                        }
                                                        ?>
                                                    </label>
                                                    <?php
                                                } else {
                                                    _e('No template exist for selection', BLOGDESIGNERPRO_TEXTDOMAIN);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Template Color Preset', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right bdp-preset-position">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select color preset', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $bdp_color_preset = isset($bdp_settings['bdp_color_preset']) ? $bdp_settings['bdp_color_preset'] : $template_name . '_default';
                                    $template_color_preset = array(
                                        'boxy' => array(
                                            'boxy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E84159,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#E21130,#E84159,#555555,#999999'
                                            ),
                                            'boxy_mckenzie' => array(
                                                'preset_name' => __('McKenzie', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#A2855B,template_ftcolor:#555555,template_fthovercolor:#A2855B,template_titlecolor:#8B6632,related_title_color:#8B6632,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#8B6632,#A2855B,#555555,#999999'
                                            ),
                                            'boxy_black_pearl' => array(
                                                'preset_name' => __('Black Pearl', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#44545D,template_ftcolor:#555555,template_fthovercolor:#44545D,template_titlecolor:#152934,related_title_color:#152934,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#152934,#44545D,#555555,#999999'
                                            ),
                                            'boxy_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E8563,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#0E663C,#3E8563,#555555,#999999'
                                            ),
                                            'boxy_peru_tan' => array(
                                                'preset_name' => __('Peru Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#916748,template_ftcolor:#555555,template_fthovercolor:#916748,template_titlecolor:#75411A,related_title_color:#75411A,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#75411A,#916748,#555555,#999999'
                                            ),
                                            'boxy_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#6D4657,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,related_title_color:#49182D,template_contentcolor:#999999,firstletter_contentcolor:#999999,',
                                                'display_value' => '#49182D,#6D4657,#555555,#999999'
                                            ),
                                        ),
                                        'boxy-clean' => array(
                                            'boxy-clean_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#3E91AD,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#888888'
                                            ),
                                            'boxy-clean_mandalay' => array(
                                                'preset_name' => __('Mandalay', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#C18F55,template_ftcolor:#555555,template_fthovercolor:#C18F55,template_titlecolor:#B1732A,related_title_color:#B1732A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#B1732A,#C18F55,#555555,#888888'
                                            ),
                                            'boxy-clean_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#ED4961,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#888888'
                                            ),
                                            'boxy-clean_mckenzie' => array(
                                                'preset_name' => __('McKenzie', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#A2855B,template_ftcolor:#555555,template_fthovercolor:#A2855B,template_titlecolor:#8B6632,related_title_color:#8B6632,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#8B6632,#A2855B,#555555,#888888'
                                            ),
                                            'boxy-clean_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#6D4657,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,related_title_color:#49182D,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#49182D,#6D4657,#555555,#888888'
                                            ),
                                            'boxy-clean_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#435F7F,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#14375F,#435F7F,#555555,#888888'
                                            ),
                                        ),
                                        'brit_co' => array(
                                            'brit_co_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#666666'
                                            ),
                                            'brit_co_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,related_title_color:#7D194F,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#7D194F,#974772,#555555,#666666'
                                            ),
                                            'brit_co_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#414C22,#67704E,#555555,#666666'
                                            ),
                                            'brit_co_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF6F1,template_ftcolor:#555555,template_fthovercolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#E4802A,#E99955,#555555,#666666'
                                            ),
                                            'brit_co_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#14375F,#435F7F,#555555,#666666'
                                            ),
                                            'brit_co_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF4F1,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#0E663C,#3E8563,#555555,#666666'
                                            ),
                                        ),
                                        'brite' => array(
                                            'brite_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#3E91AD,winter_category_color:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'brite_mandalay' => array(
                                                'preset_name' => __('Mandalay', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#C18F55,winter_category_color:#C18F55,template_titlecolor:#B1732A,related_title_color:#B1732A,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#B1732A,#C18F55,#555555,#999999'
                                            ),
                                            'brite_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,winter_category_color:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'brite_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#C44C91,winter_category_color:#C44C91,template_titlecolor:#B51F76,related_title_color:#B51F76,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#B51F76,#C44C91,#555555,#999999'
                                            ),
                                            'brite_peru_tan' => array(
                                                'preset_name' => __('Peru Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#916748,winter_category_color:#916748,template_titlecolor:#75411A,related_title_color:#75411A,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#75411A,#916748,#555555,#999999'
                                            ),
                                            'brite_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#CEBF59,winter_category_color:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                        ),
                                        'chapter' => array(
                                            'chapter_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E21130,#E84159,#555555,#888888'
                                            ),
                                            'chapter_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#888888'
                                            ),
                                            'chapter_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#888888'
                                            ),
                                            'chapter_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#414C22,#67704E,#555555,#888888'
                                            ),
                                            'chapter_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,related_title_color:#8C62AA,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#888888'
                                            ),
                                            'chapter_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#888888'
                                            ),
                                        ),
                                        'classical' => array(
                                            'classical_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#3E91AD,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#777777'
                                            ),
                                            'classical_rich_gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#BA7850,template_ftcolor:#BA7850,template_fthovercolor:#555555,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#A95624,#BA7850,#555555,#777777'
                                            ),
                                            'classical_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#67704E,template_ftcolor:#67704E,template_fthovercolor:#555555,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#414C22,#67704E,#555555,#777777'
                                            ),
                                            'classical_terracotta' => array(
                                                'preset_name' => __('Terracotta', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#B06F6D,template_ftcolor:#B06F6D,template_fthovercolor:#555555,template_titlecolor:#9C4B48,related_title_color:#9C4B48,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#9C4B48,#B06F6D,#555555,#777777'
                                            ),
                                            'classical_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF7F1,template_color:#E5A452,template_ftcolor:#E5A452,template_fthovercolor:#555555,template_titlecolor:#DF8D27,related_title_color:#DF8D27,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#777777'
                                            ),
                                            'classical_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F6F7F1,template_color:#93A564,template_ftcolor:#93A564,template_fthovercolor:#555555,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#788F3D,#93A564,#555555,#777777'
                                            )
                                        ),
                                        'cool_horizontal' => array(
                                            'cool_horizontal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#e21130,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#e21130,related_title_color:#e21130,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#e21130,#666666,#e21130,#444444'
                                            ),
                                            'cool_horizontal_pink' => array(
                                                'preset_name' => __('Pink', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#D33683,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#D33683,related_title_color:#D33683,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#D33683,#666666,#D33683,#444444'
                                            ),
                                            'cool_horizontal_blue' => array(
                                                'preset_name' => __('Chetwode Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#6C71C3,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#6C71C3,related_title_color:#6C71C3,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#6C71C3,#666666,#6C71C3,#444444'
                                            ),
                                            'cool_horizontal_java' => array(
                                                'preset_name' => __('Java', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#29A198,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#29A198,related_title_color:#29A198,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#29A198,#666666,#29A198,#444444'
                                            ),
                                            'cool_horizontal_curious_blue' => array(
                                                'preset_name' => __('Curious Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#268BD3,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#268BD3,related_title_color:#268BD3,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#268BD3,#666666,#268BD3,#444444'
                                            ),
                                            'cool_horizontal_olive' => array(
                                                'preset_name' => __('Olive', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#869901,template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#869901,related_title_color:#869901,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#869901,#666666,#869901,#444444'
                                            ),
                                        ),
                                        'deport' => array(
                                            'deport_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E91AD,template_ftcolor:#555555,template_fthovercolor:#3E91AD,deport_dashcolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#888888'
                                            ),
                                            'deport_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E99955,template_ftcolor:#555555,template_fthovercolor:#E99955,deport_dashcolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E4802A,#E99955,#555555,#888888'
                                            ),
                                            'deport_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#CEBF59,template_ftcolor:#555555,template_fthovercolor:#CEBF59,deport_dashcolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#888888'
                                            ),
                                            'deport_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ED4961,template_ftcolor:#555555,template_fthovercolor:#ED4961,deport_dashcolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#888888'
                                            ),
                                            'deport_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#A381BB,template_ftcolor:#555555,template_fthovercolor:#A381BB,deport_dashcolor:#A381BB,template_titlecolor:#8C62AA,related_title_color:#8C62AA,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#888888'
                                            ),
                                            'deport_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#8BA3CE,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,deport_dashcolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#888888'
                                            ),
                                        ),
                                        'easy_timeline' => array(
                                            'easy_timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#E21130,template_fthovercolor:#444444,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#E21130,#999999,#444444,#666666'
                                            ),
                                            'easy_timeline_dim_gray' => array(
                                                'preset_name' => __('Dim Gray', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#666666,template_fthovercolor:#f1f1f1,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#666666,#999999,#444444,#444444'
                                            ),
                                            'easy_timeline_flamenco' => array(
                                                'preset_name' => __('Flamenco', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#E18942,template_fthovercolor:#999999,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#E18942,#999999,#444444,#666666'
                                            ),
                                            'easy_timeline_jagger' => array(
                                                'preset_name' => __('Jagger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#3D3242,template_fthovercolor:#999999,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#3D3242,#999999,#444444,#666666'
                                            ),
                                            'easy_timeline_camelot' => array(
                                                'preset_name' => __('Camelot', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#7A3E48,template_fthovercolor:#999999,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#7A3E48,#999999,#444444,#666666'
                                            ),
                                            'easy_timeline_sundance' => array(
                                                'preset_name' => __('Sundance', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#bfbfbf,template_ftcolor:#C59F4A,template_fthovercolor:#999999,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#C59F4A,#999999,#444444,#666666'
                                            ),
                                        ),
                                        'elina' => array(
                                            'elina_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#E84159,template_fthovercolor:#333333,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E21130,#E84159,#333333,#555555'
                                            ),
                                            'elina_madras' => array(
                                                'preset_name' => __('Madras', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#6D6145,template_titlecolor:#493917,related_title_color:#493917,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#493917,#6D6145,#333333,#555555'
                                            ),
                                            'elina_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#3E91AD,#333333,#555555'
                                            ),
                                            'elina_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#414C22,#67704E,#333333,#555555'
                                            ),
                                            'elina_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF7F1,template_ftcolor:#333333,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,related_title_color:#DF8D27,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#DF8D27,#E5A452,#333333,#555555'
                                            ),
                                            'elina_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF7F1,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            ),
                                        ),
                                        'evolution' => array(
                                            'evolution_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#3E91AD,#333333,#555555'
                                            ),
                                            'evolution_rich_gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F4E9E1,template_ftcolor:#333333,template_fthovercolor:#BA7850,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#A95624,#BA7850,#333333,#555555'
                                            ),
                                            'evolution_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#333333,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E81B3A,#ED4961,#333333,#555555'
                                            ),
                                            'evolution_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FBEDE2,template_ftcolor:#333333,template_fthovercolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E4802A,#E99955,#333333,#555555'
                                            ),
                                            'evolution_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DFEAE5,template_ftcolor:#333333,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E663C,#3E8563,#333333,#555555'
                                            ),
                                            'evolution_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ECF0F7,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            ),
                                        ),
                                        'explore' => array(
                                            'explore_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#44545D,template_titlecolor:#152934,related_title_color:#152934,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#152934,#44545D,#333333,#555555'
                                            ),
                                            'explore_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#A39D5A,template_titlecolor:#8C8431,related_title_color:#8C8431,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8C8431,#A39D5A,#333333,#555555'
                                            ),
                                            'explore_rich_gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#BA7850,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#A95624,#BA7850,#333333,#555555'
                                            ),
                                            'explore_catalina_blue' => array(
                                                'preset_name' => __('Catalina Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0F1F4,template_ftcolor:#333333,template_fthovercolor:#495F85,template_titlecolor:#1B3766,related_title_color:#1B3766,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#1B3766,#495F85,#333333,#555555'
                                            ),
                                            'explore_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0F6,template_ftcolor:#333333,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,related_title_color:#B51F76,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#B51F76,#C44C91,#333333,#555555'
                                            ),
                                            'explore_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F3F0F1,template_ftcolor:#333333,template_fthovercolor:#6D4657,template_titlecolor:#49182D,related_title_color:#49182D,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#49182D,#6D4657,#333333,#555555'
                                            ),
                                        ),
                                        'glossary' => array(
                                            'glossary_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#ea4335,template_fthovercolor:#555555,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#ea4335,#222222,#555555,#888888'
                                            ),
                                            'glossary_madras' => array(
                                                'preset_name' => __('Madras', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#6D6145,template_titlecolor:#493917,related_title_color:#493917,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#493917,#6D6145,#555555,#888888'
                                            ),
                                            'glossary_catalina_blue' => array(
                                                'preset_name' => __('Catalina Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#495F85,template_titlecolor:#1B3766,related_title_color:#1B3766,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#1B3766,#495F85,#555555,#888888'
                                            ),
                                            'glossary_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,related_title_color:#7D194F,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#7D194F,#974772,#555555,#888888'
                                            ),
                                            'glossary_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#414C22,#67704E,#555555,#888888'
                                            ),
                                            'glossary_peru-tan' => array(
                                                'preset_name' => __('Peru Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#916748,template_titlecolor:#75411A,related_title_color:#75411A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#75411A,#916748,#555555,#888888'
                                            ),
                                        ),
                                        'hub' => array(
                                            'hub_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0E7699,template_fthovercolor:#555555,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#222222,#555555,#888888'
                                            ),
                                            'hub_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E21130,#E84159,#555555,#888888'
                                            ),
                                            'hub_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#414C22,#67704E,#555555,#888888'
                                            ),
                                            'hub_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E4802A,#E99955,#555555,#888888'
                                            ),
                                            'hub_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#788F3D,#93A564,#555555,#888888'
                                            ),
                                            'hub_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#888888'
                                            ),
                                        ),
                                        'invert-grid' => array(
                                            'invert-grid_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#47c2dc,template_ftcolor:#d35400,template_fthovercolor:#555555,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#47c2dc,#d35400,#333333,#555555'
                                            ),
                                            'invert-grid_mckenzie' => array(
                                                'preset_name' => __('McKenzie', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#8B6632,template_ftcolor:#A2855B,template_fthovercolor:#333333,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8B6632,#A2855B,#333333,#555555'
                                            ),
                                            'invert-grid_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E8563,template_ftcolor:#333333,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E663C,#3E8563,#333333,#555555'
                                            ),
                                            'invert-grid_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#6D4657,template_ftcolor:#333333,template_fthovercolor:#6D4657,template_titlecolor:#49182D,related_title_color:#49182D,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#49182D,#6D4657,#333333,#555555'
                                            ),
                                            'invert-grid_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E5A452,template_ftcolor:#333333,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,related_title_color:#DF8D27,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#DF8D27,#E5A452,#333333,#555555'
                                            ),
                                            'invert-grid_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ED4961,template_ftcolor:#333333,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E81B3A,#ED4961,#333333,#555555'
                                            )
                                        ),
                                        'lightbreeze' => array(
                                            'lightbreeze_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#f5ab35,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#f5ab35,#ffffff,#4c4c4c,#808080'
                                            ),
                                            'lightbreeze_pink' => array(
                                                'preset_name' => __('Pink', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FEF5F8,template_ftcolor:#e21130,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#e21130,#FEF5F8,#4c4c4c,#808080'
                                            ),
                                            'lightbreeze_solitude' => array(
                                                'preset_name' => __('Solitude', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#FF8A00,#FFF3E5,#4c4c4c,#808080'
                                            ),
                                        ),
                                        'masonry_timeline' => array(
                                            'masonry_timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#E21130,template_fthovercolor:#333333,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E21130,#222222,#333333,#555555'
                                            ),
                                            'masonry_timeline_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#8C8431,template_fthovercolor:#333333,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8C8431,#222222,#333333,#555555'
                                            ),
                                            'masonry_timeline_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#3E91AD,#333333,#555555'
                                            ),
                                            'masonry_timeline_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            ),
                                            'masonry_timeline_peru_tan' => array(
                                                'preset_name' => __('Peru Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#916748,template_titlecolor:#75411A,related_title_color:#75411A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#75411A,#916748,#333333,#555555'
                                            ),
                                            'masonry_timeline_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E663C,#3E8563,#333333,#555555'
                                            ),
                                        ),
                                        'media-grid' => array(
                                            'media-grid_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E91AD,template_ftcolor:#3E91AD,template_fthovercolor:#333333,template_titlecolor:#333333,related_title_color:#0E7699,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#3E91AD,#333333,#555555'
                                            ),
                                            'media-grid_rich_gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#BA7850,template_ftcolor:#333333,template_fthovercolor:#BA7850,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#A95624,#BA7850,#333333,#555555'
                                            ),
                                            'media-grid_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#974772,template_ftcolor:#333333,template_fthovercolor:#974772,template_titlecolor:#7D194F,related_title_color:#7D194F,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#7D194F,#974772,#333333,#555555'
                                            ),
                                            'media-grid_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#67704E,template_ftcolor:#333333,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#414C22,#67704E,#333333,#555555'
                                            ),
                                            'media-grid_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#A381BB,template_ftcolor:#333333,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,related_title_color:#8C62AA,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8C62AA,#A381BB,#333333,#555555'
                                            ),
                                            'media-grid_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#8BA3CE,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            )
                                        ),
                                        'my_diary' => array(
                                            'my_diary_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E21130,#E84159,#333333,#555555'
                                            ),
                                            'my_diary_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#A39D5A,template_titlecolor:#8C8431,related_title_color:#8C8431,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8C8431,#A39D5A,#333333,#555555'
                                            ),
                                            'my_diary_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#3E91AD,#333333,#555555'
                                            ),
                                            'my_diary_mandalay' => array(
                                                'preset_name' => __('Mandalay', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#BA7850,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#A95624,#BA7850,#333333,#555555'
                                            ),
                                            'my_diary_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#333333,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#14375F,#435F7F,#333333,#555555'
                                            ),
                                            'my_diary_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F5F7FB,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            ),
                                        ),
                                        'navia' => array(
                                            'navia_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0E7699,template_fthovercolor:#555555,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#0E7699,#222222,#555555,#999999'
                                            ),
                                            'navia_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,related_title_color:#AE742A,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#AE742A,#BE9055,#555555,#999999'
                                            ),
                                            'navia_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'navia_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#14375F,#435F7F,#555555,#999999'
                                            ),
                                            'navia_claret' => array(
                                                'preset_name' => __('Claret', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#93425D,template_titlecolor:#781335,related_title_color:#781335,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#781335,#93425D,#555555,#999999'
                                            ),
                                            'navia_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                        ),
                                        'news' => array(
                                            'news_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#A95624,template_fthovercolor:#555555,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#A95624,#222222,#555555,#999999'
                                            ),
                                            'news_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'news_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,related_title_color:#7D194F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#7D194F,#974772,#555555,#999999'
                                            ),
                                            'news_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#999999'
                                            ),
                                            'news_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#788F3D,#93A564,#555555,#999999'
                                            ),
                                            'news_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                        ),
                                        'nicy' => array(
                                            'nicy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#3E91AD,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#777777'
                                            ),
                                            'nicy_rich_gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#BA7850,template_ftcolor:#BA7850,template_fthovercolor:#555555,template_titlecolor:#A95624,related_title_color:#A95624,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#A95624,#BA7850,#555555,#777777'
                                            ),
                                            'nicy_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#67704E,template_ftcolor:#67704E,template_fthovercolor:#555555,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#414C22,#67704E,#555555,#777777'
                                            ),
                                            'nicy_terracotta' => array(
                                                'preset_name' => __('Terracotta', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#B06F6D,template_ftcolor:#B06F6D,template_fthovercolor:#555555,template_titlecolor:#9C4B48,related_title_color:#9C4B48,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#9C4B48,#B06F6D,#555555,#777777'
                                            ),
                                            'nicy_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF7F1,template_color:#E5A452,template_ftcolor:#E5A452,template_fthovercolor:#555555,template_titlecolor:#DF8D27,related_title_color:#DF8D27,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#777777'
                                            ),
                                            'nicy_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F6F7F1,template_color:#93A564,template_ftcolor:#93A564,template_fthovercolor:#555555,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#777777,firstletter_contentcolor:#777777',
                                                'display_value' => '#788F3D,#93A564,#555555,#777777'
                                            )
                                        ),
                                        'offer_blog' => array(
                                            'offer_blog_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#0E7699,template_fthovercolor:#333333,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#222222,#333333,#555555'
                                            ),
                                            'offer_blog_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#C2AF2F,#CEBF59,#333333,#555555'
                                            ),
                                            'offer_blog_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#974772,template_titlecolor:#7D194F,related_title_color:#7D194F,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#7D194F,#974772,#333333,#555555'
                                            ),
                                            'offer_blog_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#414C22,#67704E,#333333,#555555'
                                            ),
                                            'offer_blog_west-side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF6F1,template_ftcolor:#333333,template_fthovercolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E4802A,#E99955,#333333,#555555'
                                            ),
                                            'offer_blog_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F5F7FB,template_ftcolor:#333333,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#6E8CC2,#8BA3CE,#333333,#555555'
                                            ),
                                        ),
                                        'overlay_horizontal' => array(
                                            'overlay_horizontal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#e2112f,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,related_title_color:#ffffff,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#000000,#e2112f,#ffffff,#333333'
                                            ),
                                            'overlay_horizontal_persian_red' => array(
                                                'preset_name' => __('Persian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#CC3333,template_ftcolor:#33cccc,template_fthovercolor:#ffffff,template_titlecolor:#3333cc,related_title_color:#ffffff,template_contentcolor:#ffffff,firstletter_contentcolor:#ffffff',
                                                'display_value' => '#CC3333,#33cccc,#3333cc,#ffffff'
                                            ),
                                            'overlay_horizontal_dark_goldenrod' => array(
                                                'preset_name' => __('Dark Goldenrod', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#b8860b,template_ftcolor:#0bb886,template_fthovercolor:#94b80b,template_titlecolor:#0b3db8,related_title_color:#0b3db8,template_contentcolor:#b8300b,firstletter_contentcolor:#b8300b',
                                                'display_value' => '#b8860b,#0bb886,#0b3db8,#b8300b'
                                            ),
                                            'overlay_horizontal_deep_cerise' => array(
                                                'preset_name' => __('Deep Cerise', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#da3287,template_ftcolor:#87da32,template_fthovercolor:#3287da,template_titlecolor:#3287da,related_title_color:#3287da,template_contentcolor:#32da85,firstletter_contentcolor:#32da85',
                                                'display_value' => '#da3287,#87da32,#3287da,#32da85'
                                            ),
                                            'overlay_horizontal_rust' => array(
                                                'preset_name' => __('Rust', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#a55d35,template_ftcolor:#35a55d,template_fthovercolor:#5d35a5,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#ffffff,firstletter_contentcolor:#ffffff',
                                                'display_value' => '#a55d35,#35a55d,#333333,#ffffff'
                                            ),
                                            'overlay_horizontal_blue' => array(
                                                'preset_name' => __('Chetwode Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#666fb4,template_ftcolor:#6fb466,template_fthovercolor:#ffffff,template_titlecolor:#b4ab66,related_title_color:#b4ab66,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#666fb4,#6fb466,#b4ab66,#333333'
                                            ),
                                        ),
                                        'pretty' => array(
                                            'pretty_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#ff93a3,template_ftcolor:#999999,template_fthovercolor:#859f88,template_titlecolor:#859f88,related_title_color:#859f88,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#ff93a3,#859f88,#555555,#999999'
                                            ),
                                            'pretty_sky_blue' => array(
                                                'preset_name' => __('Sky Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#DAEBFF,template_ftcolor:#888888,template_fthovercolor:#00809D,template_titlecolor:#00809D,related_title_color:#00809D,template_contentcolor:#484848,firstletter_contentcolor:#484848',
                                                'display_value' => '#DAEBFF,#00809D,#484848,#888888'
                                            ),
                                            'pretty_lite_green' => array(
                                                'preset_name' => __('Lite Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#C3F3DD,template_ftcolor:#888888,template_fthovercolor:#0ef58d,template_titlecolor:#0ef58d,related_title_color:#0ef58d,template_contentcolor:#484848,firstletter_contentcolor:#484848',
                                                'display_value' => '#C3F3DD,#0ef58d,#484848,#888888'
                                            ),
                                        ),
                                        'region' => array(
                                            'region_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0E7699,template_fthovercolor:#333333,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E7699,#222222,#333333,#555555'
                                            ),
                                            'region_regal-blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#333333,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#14375F,#435F7F,#333333,#555555'
                                            ),
                                            'region_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#333333,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,related_title_color:#E81B3A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#E81B3A,#ED4961,#333333,#555555'
                                            ),
                                            'region_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#333333,template_fthovercolor:#A39D5A,template_titlecolor:#8C8431,related_title_color:#8C8431,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#8C8431,#A39D5A,#333333,#555555'
                                            ),
                                            'region_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#333333,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,related_title_color:#0E663C,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#0E663C,#3E8563,#333333,#555555'
                                            ),
                                            'region_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#333333,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,related_title_color:#AE742A,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#AE742A,#BE9055,#333333,#555555'
                                            ),
                                        ),
                                        'roctangle' => array(
                                            'roctangle_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#f18293,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#f18293,#222222,#444444,#666666'
                                            ),
                                            'roctangle_sky_blue' => array(
                                                'preset_name' => __('Sky Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#92E2FD,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#92E2FD,#222222,#444444,#666666'
                                            ),
                                            'roctangle_lite_green' => array(
                                                'preset_name' => __('Lite Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#0ef58d,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#0ef58d,#222222,#444444,#666666'
                                            ),
                                        ),
                                        'sharpen' => array(
                                            'sharpen_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#f5ab35,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#f5ab35,#ffffff,#4c4c4c,#808080'
                                            ),
                                            'sharpen_pink' => array(
                                                'preset_name' => __('Pink', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FEF5F8,template_ftcolor:#e21130,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#e21130,#FEF5F8,#4c4c4c,#808080'
                                            ),
                                            'sharpen_solitude' => array(
                                                'preset_name' => __('Solitude', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#4c4c4c,template_titlecolor:#4c4c4c,related_title_color:#4c4c4c,template_contentcolor:#808080,firstletter_contentcolor:#808080',
                                                'display_value' => '#FF8A00,#FFF3E5,#4c4c4c,#808080'
                                            ),
                                        ),
                                        'spektrum' => array(
                                            'spektrum_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0E7699,template_fthovercolor:#555555,template_titlecolor:#222222,related_title_color:#222222,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#222222,#555555,#888888'
                                            ),
                                            'spektrum_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E21130,#E84159,#555555,#888888'
                                            ),
                                            'spektrum_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,related_title_color:#414C22,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#414C22,#67704E,#555555,#888888'
                                            ),
                                            'spektrum_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#E99955,template_titlecolor:#E4802A,related_title_color:#E4802A,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E4802A,#E99955,#555555,#888888'
                                            ),
                                            'spektrum_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#788F3D,#93A564,#555555,#888888'
                                            ),
                                            'spektrum_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#888888'
                                            ),
                                        ),
                                        'story' => array(
                                            'story_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#4458c9,template_color:#b00dd8,template_alternative_color:#b00dd8,story_startup_border_color:#ffffff,story_startup_background:#85e71c,story_startup_text_color:#333333,story_ending_background:#ade175,story_ending_text_color:#333333,template_ftcolor:#4458c9,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,related_title_color:#707070,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#4458c9,#b00dd8,#85e71c,#333333'
                                            ),
                                            'story_goldenrod' => array(
                                                'preset_name' => __('Goldenrod', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#daa520,template_color:#2055da,template_alternative_color:#d23582,story_startup_border_color:#da4820,story_startup_background:#da4820,story_startup_text_color:#ffffff,story_ending_background:#da4820,story_ending_text_color:#ffffff,template_ftcolor:#da4820,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,related_title_color:#707070,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#daa520,#2055da,#da4820,#333333'
                                            ),
                                            'story_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ff355e,template_color:#355eff,template_alternative_color:#f18547,story_startup_border_color:#5d8a99,story_startup_background:#5d8a99,story_startup_text_color:#ffffff,story_ending_background:#5d8a99,story_ending_text_color:#ffffff,template_ftcolor:#5d8a99,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,related_title_color:#707070,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#ff355e,#355eff,#5d8a99,#333333'
                                            )
                                        ),
                                        'tagly' => array(
                                            'tagly_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#d4c6a8,template_ftcolor:#b79a5e,template_fthovercolor:#d4c6a8,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#b79a5e,#d4c6a8,#333333,#555555'
                                            ),
                                            'tagly_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E84159,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,related_title_color:#E21130,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#E21130,#E84159,#555555,#888888'
                                            ),
                                            'tagly_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E91AD,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,related_title_color:#0E7699,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#888888'
                                            ),
                                            'tagly_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#93A564,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#788F3D,#93A564,#555555,#888888'
                                            ),
                                            'tagly_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#A381BB,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,related_title_color:#8C62AA,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#888888'
                                            ),
                                            'tagly_earls-green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#CEBF59,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,related_title_color:#C2AF2F,template_contentcolor:#888888,firstletter_contentcolor:#888888',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#888888'
                                            ),
                                        ),
                                        'timeline' => array(
                                            'timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#0099CB,template_color:#0099CB,template_ftcolor:#0099CB,template_fthovercolor:#333333,template_titlecolor:#0099CB,related_title_color:#222222,template_titlebackcolor:#E6F5FA,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#0099CB,#005B79,#222222,#333333'
                                            ),
                                            'timeline_venetian_red' => array(
                                                'preset_name' => __('Venetian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#414a54,template_color:#CC0001,template_ftcolor:#f15f74,template_fthovercolor:#444444,template_titlecolor:#f15f74,related_title_color:#f15f74,template_titlebackcolor:#ffffff,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#CC0001,#444444,#f15f74,#333333'
                                            ),
                                            'timeline_pink' => array(
                                                'preset_name' => __('Dark Sea Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#f15f74,template_color:#8FBC8F,template_ftcolor:#f15f74,template_fthovercolor:#444444,template_titlecolor:#475E47,related_title_color:#475E47,template_titlebackcolor:#F6F8F5,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#8FBC8F,#475E47,#f15f74,#333333'
                                            ),
                                            'timeline_dark_orchid' => array(
                                                'preset_name' => __('Dark Orchid', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#9A33CC,template_color:#9A33CC,template_ftcolor:#CC9932,template_fthovercolor:#444444,template_titlecolor:#5B1E7A,related_title_color:#5B1E7A,template_titlebackcolor:#F5EAFA,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#9A33CC,#5B1E7A,#CC9932,#333333'
                                            ),
                                            'timeline_dark_orange' => array(
                                                'preset_name' => __('Dark Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#FF8A00,template_color:#FF8A00,template_ftcolor:#0073FF,template_fthovercolor:#444444,template_titlecolor:#7F4600,related_title_color:#7F4600,template_titlebackcolor:#FFF3E5,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#FF8A00,#7F4600,#0073FF,#333333'
                                            ),
                                            'timeline_venetian_red' => array(
                                                'preset_name' => __('Venetian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#CC0001,template_color:#C80815,template_ftcolor:#08C8BB,template_fthovercolor:#444444,template_titlecolor:#78040C,related_title_color:#78040C,template_titlebackcolor:#FAE4E6,template_contentcolor:#333333,firstletter_contentcolor:#333333',
                                                'display_value' => '#C80815,#78040C,#08C8BB,#333333'
                                            ),
                                        ),
                                        'winter' => array(
                                            'winter_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#e7492f,template_ftcolor:#37aece,template_fthovercolor:#444444,template_titlecolor:#444444,related_title_color:#444444,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#e7492f,#37aece,#444444,#555555'
                                            ),
                                            'winter_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#93A564,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,related_title_color:#788F3D,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#788F3D,#93A564,#555555,#999999'
                                            ),
                                            'winter_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#8BA3CE,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,related_title_color:#6E8CC2,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#999999'
                                            ),
                                            'winter_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#435F7F,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,related_title_color:#14375F,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#14375F,#435F7F,#555555,#999999'
                                            ),
                                            'winter_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#E5A452,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,related_title_color:#DF8D27,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#999999'
                                            ),
                                            'winter_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#EE4861,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,related_title_color:#EA1A3A,template_contentcolor:#999999,firstletter_contentcolor:#999999',
                                                'display_value' => '#EA1A3A,#EE4861,#555555,#999999'
                                            ),
                                        ),
                                        'minimal' => array(
                                            'minimal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#444444,template_fthovercolor:#e84c89,winter_category_color:#e84c89,template_titlecolor:#000000,related_title_color:#000000,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#ffffff,#e84c89,#444444,#000000'
                                            ),
                                            'minimal_caribbean' => array(
                                                'preset_name' => __('Caribbean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DFFBF0,template_ftcolor:#065B39,template_fthovercolor:#0EE08B,winter_category_color:#0EE08B,template_titlecolor:#043A25,related_title_color:#043A25,template_contentcolor:#065B39,firstletter_contentcolor:#065B39',
                                                'display_value' => '#DFFBF0,#0EE08B,#065B39,#043A25'
                                            ),
                                            'minimal_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DFE8ED,template_ftcolor:#062230,template_fthovercolor:#0E5476,winter_category_color:#0E5476,template_titlecolor:#04161E,related_title_color:#04161E,template_contentcolor:#062230,firstletter_contentcolor:#062230',
                                                'display_value' => '#DFE8ED,#0E5476,#062230,#04161E'
                                            ),
                                            'minimal_purple' => array(
                                                'preset_name' => __('Purple', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEE9FA,template_ftcolor:#352859,template_fthovercolor:#8261DA,winter_category_color:#8261DA,template_titlecolor:#221A39,related_title_color:#221A39,template_contentcolor:#352859,firstletter_contentcolor:#352859',
                                                'display_value' => '#EEE9FA,#8261DA,#352859,#221A39'
                                            ),
                                            'minimal_harvest' => array(
                                                'preset_name' => __('Harvest', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCF5EC,template_ftcolor:#5E4A2E,template_fthovercolor:#E6B571,winter_category_color:#E6B571,template_titlecolor:#3C2F1E,related_title_color:#3C2F1E,template_contentcolor:#5E4A2E,firstletter_contentcolor:#5E4A2E',
                                                'display_value' => '#FCF5EC,#E6B571,#5E4A2E,#3C2F1E'
                                            ),
                                            'minimal_scarlet' => array(
                                                'preset_name' => __('Scarlet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDE4E1,template_ftcolor:#62130A,template_fthovercolor:#F02F18,winter_category_color:#F02F18,template_titlecolor:#3E0C06,related_title_color:#3E0C06,template_contentcolor:#62130A,firstletter_contentcolor:#62130A',
                                                'display_value' => '#FDE4E1,#F02F18,#62130A,#3E0C06'
                                            ),
                                        ),
                                        'glamour' => array(
                                            'glamour_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#444444,template_fthovercolor:#f5c034,template_titlecolor:#000000,related_title_color:#000000,template_contentcolor:#444444,firstletter_contentcolor:#444444',
                                                'display_value' => '#ffffff,#f5c034,#444444,#000000'
                                            ),
                                            'glamour_aqua' => array(
                                                'preset_name' => __('Aqua', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DDFFFC,template_ftcolor:#003531,template_fthovercolor:#00FFE9,template_titlecolor:#00221F,related_title_color:#00221F,template_contentcolor:#003531,firstletter_contentcolor:#003531',
                                                'display_value' => '#DDFFFC,#00FFE9,#003531,#00221F'
                                            ),
                                            'glamour_jade' => array(
                                                'preset_name' => __('Jade', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DDF6ED,template_ftcolor:#00261A,template_fthovercolor:#00B97B,template_titlecolor:#001811,related_title_color:#001811,template_contentcolor:#00261A,firstletter_contentcolor:#00261A',
                                                'display_value' => '#DDF6ED,#00B97B,#00261A,#001811'
                                            ),
                                            'glamour_malibu' => array(
                                                'preset_name' => __('Malibu', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E9F6FC,template_ftcolor:#152831,template_fthovercolor:#60C1E8,template_titlecolor:#0E1A1F,related_title_color:#0E1A1F,template_contentcolor:#152831,firstletter_contentcolor:#152831',
                                                'display_value' => '#E9F6FC,#60C1E8,#152831,#0E1A1F'
                                            ),
                                            'glamour_bourbon' => array(
                                                'preset_name' => __('Bourbon', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F4ECE7,template_ftcolor:#2D1E13,template_fthovercolor:#AD6F49,template_titlecolor:#170F0A,related_title_color:#170F0A,template_contentcolor:#2D1E13,firstletter_contentcolor:#2D1E13',
                                                'display_value' => '#F4ECE7,#AD6F49,#2D1E13,#170F0A'
                                            ),
                                            'glamour_raven' => array(
                                                'preset_name' => __('Raven', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EAECED,template_ftcolor:#222528,template_fthovercolor:#696F7A,template_titlecolor:#0E0F11,related_title_color:#0E0F11,template_contentcolor:#222528,firstletter_contentcolor:#222528',
                                                'display_value' => '#EAECED,#696F7A,#222528,#0E0F11'
                                            ),
                                        ),
                                        'famous' => array(
                                            'famous_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#f20075,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#f20075,#a5a5a5,#555555,#333333'
                                            ),
                                            'famous_vivid_gamboge' => array(
                                                'preset_name' => __('Vivid Gamboge', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#F99900,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#F99900,#a5a5a5,#555555,#333333'
                                            ),
                                            'famous_timber_green' => array(
                                                'preset_name' => __('Timber Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#3D3242,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#3D3242,#a5a5a5,#555555,#333333'
                                            ),
                                            'famous_jagger' => array(
                                                'preset_name' => __('Jagger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#374232,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#374232,#a5a5a5,#555555,#333333'
                                            ),
                                            'famous_barossa' => array(
                                                'preset_name' => __('Barossa', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#423237,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#423237,#a5a5a5,#555555,#333333'
                                            ),
                                            'famous_blumine' => array(
                                                'preset_name' => __('Blumine', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#a5a5a5,template_fthovercolor:#2A5B66,template_titlecolor:#333333,related_title_color:#333333,template_contentcolor:#555555,firstletter_contentcolor:#555555',
                                                'display_value' => '#2A5B66,#a5a5a5,#555555,#333333'
                                            ),
                                        ),
                                        'fairy' => array(
                                            'fairy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#b6b6b6,template_fthovercolor:#0089bb,template_titlecolor:#000000,related_title_color:#000000,template_contentcolor:#5b5b5b,firstletter_contentcolor:#5b5b5b',
                                                'display_value' => '#ffffff ,#0089bb,#5b5b5b,#000000'
                                            ),
                                            'fairy_gorse' => array(
                                                'preset_name' => __('Gorse', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDFBE2,template_ftcolor:#7E7415,template_fthovercolor:#F7E229,template_titlecolor:#221E06,related_title_color:#221E06,template_contentcolor:#342F09,firstletter_contentcolor:#342F09',
                                                'display_value' => '#FDFBE2 ,#F7E229,#342F09,#221E06'
                                            ),
                                            'fairy_scampi' => array(
                                                'preset_name' => __('Scampi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ECECF0,template_ftcolor:#393848,template_fthovercolor:#6F6E8D,template_titlecolor:#0F0E13,related_title_color:#0F0E13,template_contentcolor:#18171E,firstletter_contentcolor:#18171E',
                                                'display_value' => '#ECECF0 ,#6F6E8D,#18171E,#0F0E13'
                                            ),
                                            'fairy_crusoe' => array(
                                                'preset_name' => __('Crusoe', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DFEAE1,template_ftcolor:#083511,template_fthovercolor:#0F6620,template_titlecolor:#020E05,related_title_color:#020E05,template_contentcolor:#041B09,firstletter_contentcolor:#041B09',
                                                'display_value' => '#DFEAE1 ,#0F6620,#041B09,#020E05'
                                            ),
                                            'fairy_seagull' => array(
                                                'preset_name' => __('Seagull', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EDF4F8,template_ftcolor:#3E5866,template_fthovercolor:#7BADC8,template_titlecolor:#11171B,related_title_color:#11171B,template_contentcolor:#202D35,firstletter_contentcolor:#202D35',
                                                'display_value' => '#EDF4F8 ,#7BADC8,#202D35,#11171B'
                                            ),
                                            'fairy_persimmon' => array(
                                                'preset_name' => __('Persimmon', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAE8DD,template_ftcolor:#722A05,template_fthovercolor:#722A05,template_titlecolor:#1E0B02,related_title_color:#1E0B02,template_contentcolor:#2E1202,firstletter_contentcolor:#2E1202',
                                                'display_value' => '#FAE8DD ,#DF5309,#2E1202,#1E0B02'
                                            ),
                                        ),
                                        'clicky' => array(
                                            'clicky_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#a7a7a7,template_fthovercolor:#586f8c,winter_category_color:#586f8c,template_titlecolor:#586f8c,related_title_color:#586f8c,template_contentcolor:#686868,firstletter_contentcolor:#686868',
                                                'display_value' => '#ffffff ,#a7a7a7,#686868,#586f8c'
                                            ),
                                            'clicky_portage' => array(
                                                'preset_name' => __('Portage', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#C1C5ED,template_fthovercolor:#2A2B3C,winter_category_color:#2A2B3C,template_titlecolor:#2A2B3C,related_title_color:#2A2B3C,template_contentcolor:#9DA5E4,firstletter_contentcolor:#9DA5E4',
                                                'display_value' => '#ffffff ,#C1C5ED,#9DA5E4,#2A2B3C'
                                            ),
                                            'clicky_emerald' => array(
                                                'preset_name' => __('Emerald', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E4FCEA,template_ftcolor:#229541,template_fthovercolor:#0B3116,winter_category_color:#0B3116,template_titlecolor:#0B3116,related_title_color:#0B3116,template_contentcolor:#165F2A,firstletter_contentcolor:#165F2A',
                                                'display_value' => '#E4FCEA ,#229541,#165F2A,#0B3116'
                                            ),
                                        ),
                                        'cover' => array(
                                            'cover_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#b6b6b6,template_fthovercolor:#ff6063,template_titlecolor:#272727,related_title_color:#272727,template_contentcolor:#696969,firstletter_contentcolor:#696969',
                                                'display_value' => '#ffffff ,#b6b6b6,#696969,#272727'
                                            ),
                                            'cover_rust' => array(
                                                'preset_name' => __('Rust', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCF6F5,template_ftcolor:#D1856D,template_fthovercolor:#B6401A,template_titlecolor:#301107,related_title_color:#301107,template_contentcolor:#4B1A0B,firstletter_contentcolor:#4B1A0B',
                                                'display_value' => '#FCF6F5 ,#D1856D,#4B1A0B,#301107'
                                            ),
                                            'cover_mulberry' => array(
                                                'preset_name' => __('Mulberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCF6FA,template_ftcolor:#DD92C7,template_fthovercolor:#CA55A7,template_titlecolor:#35162C,related_title_color:#35162C,template_contentcolor:#532245,firstletter_contentcolor:#532245',
                                                'display_value' => '#FCF6FA ,#DD92C7,#532245,#35162C'
                                            ),
                                            'cover_green' => array(
                                                'preset_name' => __('Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ECF2E9,template_ftcolor:#4E8835,template_fthovercolor:#226A03,template_titlecolor:#0B2202,related_title_color:#0B2202,template_contentcolor:#123602,firstletter_contentcolor:#123602',
                                                'display_value' => '#ECF2E9 ,#4E8835,#123602,#0B2202'
                                            ),
                                            'cover_curious' => array(
                                                'preset_name' => __('Curious', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F4F9FD,template_ftcolor:#81BCE0,template_fthovercolor:#3996CE,template_titlecolor:#0F2836,related_title_color:#0F2836,template_contentcolor:#183E55,firstletter_contentcolor:#183E55',
                                                'display_value' => '#F4F9FD ,#81BCE0,#183E55,#0F2836'
                                            ),
                                            'cover_highball' => array(
                                                'preset_name' => __('Highball', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAFAF7,template_ftcolor:#969547,template_fthovercolor:#605F2E,template_titlecolor:#282713,related_title_color:#282713,template_contentcolor:#3E3D1E,firstletter_contentcolor:#3E3D1E',
                                                'display_value' => '#FAFAF7 ,#969547,#3E3D1E,#282713'
                                            ),
                                        ),
                                        'steps' => array(
                                            'steps_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#cbcbcb,template_ftcolor:#b7b7b7,template_fthovercolor:#f8c04e,template_titlecolor:#363636,related_title_color:#363636,template_contentcolor:#666666,firstletter_contentcolor:#666666',
                                                'display_value' => '#ffffff ,#cbcbcb,#f8c04e,#363636'
                                            ),
                                            'steps_russett' => array(
                                                'preset_name' => __('Russett', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F8F6F6,template_color:#DDD7D4,template_ftcolor:#AE9D96,template_fthovercolor:#81675B,template_titlecolor:#221B18,related_title_color:#221B18,template_contentcolor:#42352E,firstletter_contentcolor:#42352E',
                                                'display_value' => '#F8F6F6 ,#DDD7D4,#81675B,#221B18'
                                            ),
                                            'steps_neon_blue' => array(
                                                'preset_name' => __('Neon Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F9F8FD,template_color:#D9D7FD,template_ftcolor:#8B84F7,template_fthovercolor:#4A3EF2,template_titlecolor:#0F0E32,related_title_color:#0F0E32,template_contentcolor:#1E1A63,firstletter_contentcolor:#42352E',
                                                'display_value' => '#F9F8FD ,#D9D7FD,#4A3EF2,#0F0E32'
                                            ),
                                        ),
                                        'miracle' => array(
                                            'miracle_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#62bf7c,template_fthovercolor:#686868,template_titlecolor:#353535,related_title_color:#353535,template_contentcolor:#252525,firstletter_contentcolor:#252525',
                                                'display_value' => '#ffffff ,#62bf7c,#353535,#252525'
                                            ),
                                            'miracle_lochmara' => array(
                                                'preset_name' => __('Lochmara', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F7FAFC,template_ftcolor:#227CAD,template_fthovercolor:#227CAD,template_titlecolor:#051117,related_title_color:#051117,template_contentcolor:#09202D,firstletter_contentcolor:#09202D',
                                                'display_value' => '#F7FAFC ,#227CAD,#051117,#09202D'
                                            ),
                                            'miracle_burgundy' => array(
                                                'preset_name' => __('Burgundy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF6F7,template_ftcolor:#6C0124,template_fthovercolor:#2C010E,template_titlecolor:#0E0105,related_title_color:#0E0105,template_contentcolor:#1C0109,firstletter_contentcolor:#1C0109',
                                                'display_value' => '#FAF6F7 ,#6C0124,#0E0105,#1C0109'
                                            ),
                                            'miracle_hillary' => array(
                                                'preset_name' => __('Hillary', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCFBFA,template_ftcolor:#A49E77,template_fthovercolor:#434131,template_titlecolor:#161610,related_title_color:#161610,template_contentcolor:#2B2A1F,firstletter_contentcolor:#2B2A1F',
                                                'display_value' => '#FCFBFA ,#A49E77,#161610,#2B2A1F'
                                            ),
                                            'miracle_amaranth' => array(
                                                'preset_name' => __('Amaranth', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF9FA,template_ftcolor:#DE364A,template_fthovercolor:#491218,template_titlecolor:#1E070A,related_title_color:#1E070A,template_contentcolor:#2E0B0F,firstletter_contentcolor:#2E0B0F',
                                                'display_value' => '#FDF9FA ,#DE364A,#1E070A,#2E0B0F'
                                            ),
                                            'miracle_manatee' => array(
                                                'preset_name' => __('Manatee', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCFCFD,template_ftcolor:#9699A7,template_fthovercolor:#3E3E45,template_titlecolor:#151516,related_title_color:#151516,template_contentcolor:#28282C,firstletter_contentcolor:#28282C',
                                                'display_value' => '#FCFCFD ,#9699A7,#151516,#28282C'
                                            ),
                                        ),

                                    );
                                    foreach ($template_color_preset as $key => $single_template) {
                                        ?>
                                        <div class="controls_preset <?php echo $key; ?>" style="display:none;">
                                            <?php foreach ($single_template as $name => $value) { ?>
                                                <div class="color-option preset<?php
                                                if ($bdp_color_preset == $name) {
                                                    echo ' color_preset_selected';
                                                }
                                                ?>" data-value="<?php echo $value['preset_value']; ?>">
                                                    <label>
                                                        <input class="of-radio-color" type="radio" name="bdp_color_preset" value="<?php echo $name; ?>" <?php checked($bdp_color_preset, $name); ?>>
                                                        <?php echo $value['preset_name']; ?>
                                                    </label>
                                                    <?php bdp_admin_color_preset($value['display_value']); ?>
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Single Layout Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter single layout name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="single_layout_name" id="single_layout_name" value="<?php echo $single_template_name; ?>" placeholder="<?php esc_attr_e('Enter single layout name', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Override Single Post Design', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e("Apply plugin's single post layout design to single post", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <label>
                                        <input id="override_single" name="override_single" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['override_single'])) {
                                            checked(1, $bdp_settings['override_single']);
                                        }
                                        ?> />
                                    </label>
                                </div>
                            </li>

                            <li class="override-single-design-li">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Single Post Override Type', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e("Select Single Post Override Type", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $bdp_single_type = '';
                                    if (isset($bdp_settings['bdp_single_type'])) {
                                        $bdp_single_type = $bdp_settings['bdp_single_type'];
                                    }
                                    if ($custom_single_type == 'all') {
                                        $all_setting = '';
                                    } else {
                                        $all_setting = bdp_get_all_single_template_settings();
                                    }
                                    ?>
                                    <select id="bdp_single_type" name="bdp_single_type">
                                        <option value="all" <?php
                                        if ($all_setting) {
                                            echo "disabled='disabled'";
                                        }
                                        ?> <?php echo selected('all', $bdp_single_type); ?>><?php _e('All Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="category" <?php echo selected('category', $bdp_single_type); ?>><?php _e('Category Wise', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="tag" <?php echo selected('tag', $bdp_single_type); ?>><?php _e('Tag Wise', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e('Note:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b>
                                        <?php _e('If you select category/tag post override type, you must have to select category/tag type to show post.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>

                            <li class="override-single-design-li single_category_list_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php _e("Select Post Categories", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>

                                    <?php
                                    $template_category = isset($bdp_settings['template_category']) ? $bdp_settings['template_category'] : array();
                                    $categories = get_categories(array('child_of' => '', 'hide_empty' => 1));
                                    $db_categories = $wpdb->get_results('SELECT sub_categories FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category"');
                                    $db_category_list = array();
                                    if ($db_categories) {
                                        foreach ($db_categories as $db_category) {
                                            $sub_list = $db_category->sub_categories;
                                            if ($sub_list) {
                                                $db_category_ids = explode(',', $sub_list);
                                                foreach ($db_category_ids as $db_category_id) {
                                                    $db_category_list[] = $db_category_id;
                                                }
                                            }
                                        }
                                    }
                                    $final_cat = array_diff($db_category_list, $template_category);
                                    ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose Post Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_category[]" id="template_category"><?php foreach ($categories as $categoryObj): ?>
                                            <option value="<?php echo $categoryObj->term_id; ?>" <?php
                                            if (@in_array($categoryObj->term_id, $template_category)) {
                                                echo 'selected="selected"';
                                            }
                                            if (in_array($categoryObj->term_id, $final_cat)) {
                                                echo 'disabled="disabled"';
                                            }
                                            ?>><?php echo $categoryObj->name; ?></option><?php endforeach; ?>
                                    </select>
                                </div>
                            </li>

                            <li class="override-single-design-li single_tag_list_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php _e("Select Post Tags", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $template_tags = isset($bdp_settings['template_tags']) ? $bdp_settings['template_tags'] : array();
                                    $tags = get_tags();
                                    $db_tags = $wpdb->get_results('SELECT sub_categories FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag"');
                                    $db_tag_list = array();
                                    if ($db_tags) {
                                        foreach ($db_tags as $db_tag) {
                                            $sub_list = $db_tag->sub_categories;
                                            if ($sub_list) {
                                                $db_tag_ids = explode(',', $sub_list);
                                                foreach ($db_tag_ids as $db_tag_id) {
                                                    $db_tag_list[] = $db_tag_id;
                                                }
                                            }
                                        }
                                    }
                                    $final_tag = array_diff($db_tag_list, $template_tags);
                                    ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose Post Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_tags[]" id="template_tags">
                                        <?php foreach ($tags as $tag) : ?>
                                            <option value="<?php echo $tag->term_id; ?>" <?php
                                            if (@in_array($tag->term_id, $template_tags)) {
                                                echo 'selected="selected"';
                                            }
                                            if (in_array($tag->term_id, $final_tag)) {
                                                echo 'disabled="disabled"';
                                            }
                                            ?>><?php echo $tag->name; ?></option>
                                                <?php endforeach; ?>
                                    </select>
                                </div>
                            </li>

                            <li class="override-single-design-li single_all_post_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e("Select post from available posts for single post layout", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $template_posts = isset($bdp_settings['template_posts']) ? $bdp_settings['template_posts'] : array();
                                    $db_posts = $wpdb->get_results('SELECT single_post_id FROM ' . $wpdb->prefix . 'bdp_single_layouts');
                                    $db_posts_list = array();
                                    if ($db_posts) {
                                        foreach ($db_posts as $db_post) {
                                            $sub_list = $db_post->single_post_id;
                                            if ($sub_list) {
                                                $db_post_ids = explode(',', $sub_list);
                                                foreach ($db_post_ids as $db_post_id) {
                                                    $db_posts_list[] = $db_post_id;
                                                }
                                            }
                                        }
                                    }
                                    $final_posts = array_diff($db_posts_list, $template_posts);
                                    if ($bdp_single_type == 'tag') {
                                        $tag_ids = isset($bdp_settings['template_tags']) ? $bdp_settings['template_tags'] : array();
                                        $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc', 'tag__in' => $tag_ids);
                                    } else if ($bdp_single_type == 'category') {
                                        $cat_ids = isset($bdp_settings['template_category']) ? $bdp_settings['template_category'] : array();
                                        $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc', 'category__in' => $cat_ids);
                                    } else {
                                        $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc');
                                    }
                                    $allposts = get_posts($args);
                                    if ($allposts) {
                                        ?>
                                        <select data-placeholder="<?php esc_attr_e('Choose Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_posts[]" id="template_posts">
                                            <?php
                                            foreach ($allposts as $single_post) : setup_postdata($single_post);
                                                ?>
                                                <option value="<?php echo $single_post->ID; ?>"
                                                <?php
                                                if (@in_array($single_post->ID, $bdp_settings['template_posts'])) {
                                                    echo 'selected="selected"';
                                                }
                                                if (in_array($single_post->ID, $final_posts)) {
                                                    echo 'disabled="disabled"';
                                                }
                                                ?>><?php echo $single_post->post_title; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            wp_reset_postdata();
                                            ?>
                                        </select>
                                        <div class="bdp-setting-description bdp-note">
                                            <b class="note"><?php _e('Note:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b>
                                            <?php _e('Default All Posts Selected', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </div>
                                        <?php
                                    } else {
                                        _e('No posts found', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    }
                                    ?>
                                </div>
                            </li>

                            <li class="override-single-design-li bdp-display-settings">
                                <h3 class="bdp-table-title"><?php _e('Display Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>

                                <div class="bdp-typography-wrapper bdp-button-settings ">
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_title = isset($bdp_settings['display_title']) ? $bdp_settings['display_title'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_title buttonset">
                                                <input id="display_title_1" name="display_title" type="radio" value="1" <?php echo checked(1, $display_title); ?> />
                                                <label for="display_title_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_title_0" name="display_title" type="radio" value="0" <?php echo checked(0, $display_title); ?> />
                                                <label for="display_title_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post category', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_category = isset($bdp_settings['display_category']) ? $bdp_settings['display_category'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="display_category_1" name="display_category" type="radio" value="1" <?php echo checked(1, $display_category); ?> />
                                                <label for="display_category_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_category_0" name="display_category" type="radio" value="0" <?php echo checked(0, $display_category); ?> />
                                                <label for="display_category_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_category" name="disable_link_category" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_category'])) {
                                                    checked(1, $bdp_settings['disable_link_category']);
                                                }
                                                ?> /> <?php _e('Disable Link for Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_tag = isset($bdp_settings['display_tag']) ? $bdp_settings['display_tag'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="display_tag_1" name="display_tag" type="radio" value="1" <?php checked(1, $display_tag); ?> />
                                                <label for="display_tag_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_tag_0" name="display_tag" type="radio" value="0" <?php checked(0, $display_tag); ?> />
                                                <label for="display_tag_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_tag" name="disable_link_tag" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_tag'])) {
                                                    checked(1, $bdp_settings['disable_link_tag']);
                                                }
                                                ?> /> <?php _e('Disable Link for Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_author = isset($bdp_settings['display_author']) ? $bdp_settings['display_author'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="display_author_1" name="display_author" type="radio" value="1"  <?php checked(1, $display_author); ?> />
                                                <label for="display_author_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_author_0" name="display_author" type="radio" value="0" <?php checked(0, $display_author); ?> />
                                                <label for="display_author_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_author" name="disable_link_author" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_author'])) {
                                                    checked(1, $bdp_settings['disable_link_author']);
                                                }
                                                ?> />
                                                       <?php _e('Disable Link for Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_date = isset($bdp_settings['display_date']) ? $bdp_settings['display_date'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_date buttonset buttonset-hide ui-buttonset" data-hide="1">
                                                <input id="display_date_1" name="display_date" type="radio" value="1" <?php checked(1, $display_date); ?> />
                                                <label for="display_date_1" <?php checked(1, $display_date); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_date_0" name="display_date" type="radio" value="0" <?php checked(0, $display_date); ?> />
                                                <label for="display_date_0" <?php checked(0, $display_date); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_date" name="disable_link_date" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_date'])) {
                                                    checked(1, $bdp_settings['disable_link_date']);
                                                }
                                                ?> />
                                                <?php _e('Disable Link for Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Comments', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post comments', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_comment = isset($bdp_settings['display_comment']) ? $bdp_settings['display_comment'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-display_comment buttonset buttonset-hide ui-buttonset" data-hide="1">
                                                <input id="display_comment_1" name="display_comment" type="radio" value="1" <?php checked(1, $display_comment); ?> />
                                                <label for="display_comment_1" <?php checked(1, $display_comment); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_comment_0" name="display_comment" type="radio" value="0" <?php checked(0, $display_comment); ?> />
                                                <label for="display_comment_0" <?php checked(0, $display_comment); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_comment" name="disable_link_comment" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_comment'])) {
                                                    checked(1, $bdp_settings['disable_link_comment']);
                                                }
                                                ?> />
                                                <?php _e('Disable Link for Comments Form', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover display-postlike">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Like', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post like', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_postlike = isset($bdp_settings['display_postlike']) ? $bdp_settings['display_postlike'] : '0'; ?>
                                            <fieldset class="buttonset">
                                                <input id="display_postlike_1" name="display_postlike" type="radio" value="1" <?php echo checked(1, $display_postlike); ?> />
                                                <label for="display_postlike_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_postlike_0" name="display_postlike" type="radio" value="0" <?php echo checked(0, $display_postlike); ?> />
                                                <label for="display_postlike_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover bdp_single_post_published_year">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Post Published Year', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post published year', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $display_single_story_year = 1;
                                            if (isset($bdp_settings['display_single_story_year']) && $bdp_settings['display_single_story_year'] != '') {
                                                $display_single_story_year = $bdp_settings['display_single_story_year'];
                                            }
                                            ?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="display_single_story_year_0" name="display_single_story_year" type="radio" value="0" <?php checked(0, $display_single_story_year); ?> />
                                                <label for="display_single_story_year_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_single_story_year_1" name="display_single_story_year" type="radio" value="1"  <?php checked(1, $display_single_story_year); ?> />
                                                <label for="display_single_story_year_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                </div>
                            </li>

                             <li class="override-single-design-li bdp-display-settings bdp-display-date-settings">
                                <h3 class="bdp-table-title"><?php _e('Display Date Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>

                                <div class="bdp-typography-wrapper bdp-button-settings">
                                    <div class="bdp-typography-cover post_date_from_tr">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select display post date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $dsiplay_date_from = isset($bdp_settings['dsiplay_date_from']) ? $bdp_settings['dsiplay_date_from'] : 'publish'; ?>
                                            <select name="dsiplay_date_from" id="dsiplay_date_from">
                                                <option value="publish"  <?php echo selected('publish', $dsiplay_date_from); ?>><?php _e( 'Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN ); ?></option>
                                                <option value="modify"  <?php echo selected('modify', $dsiplay_date_from); ?>><?php _e( 'Last Modify Date', BLOGDESIGNERPRO_TEXTDOMAIN ); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover post_date_format_tr">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Date Format', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post published format', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $post_date_format = isset($bdp_settings['post_date_format']) ? $bdp_settings['post_date_format'] : 'default'; ?>
                                            <select name="post_date_format" id="post_date_format">
                                                <option value="default"  <?php echo selected('default', $post_date_format); ?>><?php _e( 'Default', BLOGDESIGNERPRO_TEXTDOMAIN ); ?></option>
                                                <option value="F j, Y g:i a"  <?php echo selected('F j, Y g:i a', $post_date_format); ?>><?php echo get_the_time('F j, Y g:i a', true); ?></option>
                                                <option value="F j, Y"  <?php echo selected('F j, Y', $post_date_format); ?>><?php echo get_the_time('F j, Y', true); ?></option>
                                                <option value="F, Y"  <?php echo selected('F, Y', $post_date_format); ?>><?php echo get_the_time('F, Y', true); ?></option>
                                                <option value="j F  Y"  <?php echo selected('j F  Y', $post_date_format); ?>><?php echo get_the_time('j F  Y', true); ?></option>
                                                <option value="g:i a"  <?php echo selected('g:i a' , $post_date_format); ?>><?php echo get_the_time('g:i a', true); ?></option>
                                                <option value="g:i:s a"  <?php echo selected('g:i:s a', $post_date_format); ?>><?php echo get_the_time('g:i:s a', true); ?></option>
                                                <option value="l, F jS, Y"  <?php echo selected('l, F jS, Y', $post_date_format); ?>><?php echo get_the_time('l, F jS, Y', true); ?></option>
                                                <option value="M j, Y @ G:i"  <?php echo selected('M j, Y @ G:i', $post_date_format); ?>><?php echo get_the_time('M j, Y @ G:i', true); ?></option>
                                                <option value="Y/m/d g:i:s A"  <?php echo selected('Y/m/d g:i:s A', $post_date_format); ?>><?php echo get_the_time('Y/m/d g:i:s A', true); ?></option>
                                                <option value="Y/m/d"  <?php echo selected('Y/m/d' , $post_date_format); ?>><?php echo get_the_time('Y/m/d', true); ?></option>
                                                <option value="d.m.Y"  <?php echo selected('d.m.Y', $post_date_format); ?>><?php echo get_the_time('d.m.Y', true); ?></option>
                                                <option value="d-m-Y"  <?php echo selected('d-m-Y', $post_date_format); ?>><?php echo get_the_time('d-m-Y', true); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                             </li>

                             <li class="override-single-design-li">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Views', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-textarea"><span class="bdp-tooltips"><?php _e('Enable/Disable post views', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $display_post_views = 0;
                                    if (isset($bdp_settings['display_post_views'])) {
                                        $display_post_views = $bdp_settings['display_post_views'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-size buttonset buttonset-hide green" data-hide='1'>
                                        <input id="display_post_views_1" name="display_post_views" type="radio" value="1" <?php checked(1, $display_post_views); ?> />
                                        <label id="bdp-options-button" for="display_post_views_1" <?php checked(1, $display_post_views); ?>><?php _e("Show Today's View", BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_post_views_2" name="display_post_views" type="radio" value="2" <?php checked(2, $display_post_views); ?> />
                                        <label id="bdp-options-button" for="display_post_views_2" <?php checked(2, $display_post_views); ?>><?php _e('Show All Views', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_post_views_0" name="display_post_views" type="radio" value="0" <?php checked(0, $display_post_views); ?> />
                                        <label id="bdp-options-button" for="display_post_views_0" <?php checked(0, $display_post_views); ?>><?php _e('Hide', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="override-single-design-li">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom CSS', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-righ">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-textarea"><span class="bdp-tooltips"><?php _e('Write a "Custom CSS" to add your additional design for single blog page', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <textarea placeholder=".class_name{ color:#ffffff }" name="custom_css" id="custom_css"><?php if (isset($bdp_settings['custom_css'])) echo stripslashes($bdp_settings['custom_css']); ?></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglestandard" class="postbox postbox-with-fw-options" <?php echo $bdpstandard_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Main Container Class Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter main container class name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $main_container_class = (isset($bdp_settings['main_container_class']) && $bdp_settings['main_container_class'] != '') ? $bdp_settings['main_container_class'] : ''; ?>
                                    <input type="text" name="main_container_class" id="main_container_class" value="<?php echo $main_container_class; ?>" placeholder="<?php esc_attr_e('Enter main container class name', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                </div>
                            </li>
                            <li class="single-background-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Background Color for Single Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select single post background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_bgcolor" id="template_bgcolor" value="<?php echo isset($bdp_settings["template_bgcolor"]) ? $bdp_settings["template_bgcolor"] : '#fff'; ?>"/>
                                </div>
                            </li>
                            <li class="blog-templatecolor-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Single Post Template Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select single post template color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_color" id="template_color" value="<?php echo isset($bdp_settings["template_color"]) ? $bdp_settings["template_color"] : '#000'; ?>"/>
                                </div>
                            </li>
                            <li class="story-startup-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Startup Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter story startup text', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_startup_text" id="story_startup_text" value="<?php echo isset($bdp_settings["story_startup_text"]) ? $bdp_settings["story_startup_text"] : __('STARTUP', BLOGDESIGNERPRO_TEXTDOMAIN); ?>"/>
                                </div>
                            </li>
                            <li class="story-startup-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Startup Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story startup background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_startup_background" id="story_startup_background"
                                           value="<?php echo isset($bdp_settings["story_startup_background"]) ? $bdp_settings["story_startup_background"] : '#ade175'; ?>"
                                           data-default-color="<?php echo isset($bdp_settings["story_startup_background"]) ? $bdp_settings["story_startup_background"] : '#ade175'; ?>"/>
                                </div>
                            </li>
                            <li class="story-startup-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Startup Text Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story startup text color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_startup_text_color" id="story_startup_text_color"
                                           value="<?php echo isset($bdp_settings["story_startup_text_color"]) ? $bdp_settings["story_startup_text_color"] : '#333'; ?>"
                                           data-default-color="<?php echo isset($bdp_settings["story_startup_text_color"]) ? $bdp_settings["story_startup_text_color"] : '#333'; ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Link Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select link color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_ftcolor" id="template_ftcolor"
                                           value="<?php echo isset($bdp_settings["template_ftcolor"]) ? $bdp_settings["template_ftcolor"] : ''; ?>"
                                           data-default-color="<?php echo isset($bdp_settings["template_ftcolor"]) ? $bdp_settings["template_ftcolor"] : ''; ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Link Hover Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select link hover color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_fthovercolor" id="template_fthovercolor"
                                           value="<?php if (isset($bdp_settings["template_fthovercolor"])) echo $bdp_settings["template_fthovercolor"]; ?>"
                                           data-default-color="<?php if (isset($bdp_settings["template_fthovercolor"])) echo $bdp_settings["template_fthovercolor"]; ?>"/>
                                </div>
                            </li>
                            <li class="winter-category-back-color" style="display: none;">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo $winter_category_txt; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php echo $winter_category_txt; ?></span></span>
                                    <input type="text" name="winter_category_color" id="winter_category_color"
                                           value="<?php if (isset($bdp_settings["winter_category_color"])) echo $bdp_settings["winter_category_color"]; ?>"
                                           data-default-color="<?php if (isset($bdp_settings["winter_category_color"])) echo $bdp_settings["winter_category_color"]; ?>"/>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsingletitle" class="postbox postbox-with-fw-options" <?php echo $bdptitle_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Title Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post title color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_titlecolor" id="template_titlecolor" value="<?php echo isset($bdp_settings["template_titlecolor"]) ? $bdp_settings["template_titlecolor"] : ''; ?>"/>
                                </div>
                            </li>
                            <li>
                                <h3 class="bdp-table-title"><?php _e('Typography Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-typography-wrapper bdp-typography-wrapper1">
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <input type="hidden" name="template_titlefontface_font_type" id="template_titlefontface_font_type" value="<?php echo isset($bdp_settings['template_titlefontface_font_type']) ? $bdp_settings['template_titlefontface_font_type'] : 'Serif Fonts'; ?>">
                                            <div class="select-cover">
                                                <select name="template_titlefontface" id="template_titlefontface">
                                                    <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <?php
                                                    $template_titlefontface = (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') ? $bdp_settings['template_titlefontface'] : '';
                                                    $old_version = '';
                                                    $cnt = 0;
                                                    foreach ($font_family as $key => $value) {
                                                        if ($value['version'] != $old_version) {
                                                            if ($cnt > 0) {
                                                                echo '</optgroup>';
                                                            }
                                                            echo '<optgroup label="' . $value['version'] . '">';
                                                            $old_version = $value['version'];
                                                        }
                                                        echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                        if ($template_titlefontface != '' && (str_replace('"', '', $template_titlefontface) == str_replace('"', '', $value['label']))) {
                                                            echo ' selected';
                                                        }
                                                        echo ">" . $value['label'] . "</option>";
                                                        $cnt++;
                                                    }
                                                    if ($cnt == count($font_family)) {
                                                        echo '</optgroup>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Size (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_titlefontsize = (isset($bdp_settings['template_titlefontsize'])) ? $bdp_settings['template_titlefontsize'] : 16; ?>
                                            <div class="grid_col_space range_slider_fontsize" id="template_titlefontsizeInput" ></div>
                                            <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_titlefontsize" id="template_titlefontsize" value="<?php echo $template_titlefontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Weight', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font weight', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_title_font_weight = isset($bdp_settings['template_title_font_weight']) ? $bdp_settings['template_title_font_weight'] : 'normal'; ?>
                                            <div class="select-cover">
                                                <select name="template_title_font_weight" id="template_title_font_weight">
                                                    <option value="100" <?php selected($template_title_font_weight, 100); ?>>100</option>
                                                    <option value="200" <?php selected($template_title_font_weight, 200); ?>>200</option>
                                                    <option value="300" <?php selected($template_title_font_weight, 300); ?>>300</option>
                                                    <option value="400" <?php selected($template_title_font_weight, 400); ?>>400</option>
                                                    <option value="500" <?php selected($template_title_font_weight, 500); ?>>500</option>
                                                    <option value="600" <?php selected($template_title_font_weight, 600); ?>>600</option>
                                                    <option value="700" <?php selected($template_title_font_weight, 700); ?>>700</option>
                                                    <option value="800" <?php selected($template_title_font_weight, 800); ?>>800</option>
                                                    <option value="900" <?php selected($template_title_font_weight, 900); ?>>900</option>
                                                    <option value="bold" <?php selected($template_title_font_weight, 'bold'); ?> ><?php _e('Bold', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option value="normal" <?php selected($template_title_font_weight, 'normal'); ?>><?php _e('Normal', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Line Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter line height', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="input-type-number">
                                                <input type="number" name="template_title_font_line_height" id="template_title_font_line_height" step="0.1" min="0" value="<?php echo isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '1.5'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Italic Font Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable italic font style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_title_font_italic = isset($bdp_settings['template_title_font_italic']) ? $bdp_settings['template_title_font_italic'] : '0';?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="template_title_font_italic_1" name="template_title_font_italic" type="radio" value="1"  <?php checked(1, $template_title_font_italic); ?> />
                                                <label for="template_title_font_italic_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="template_title_font_italic_0" name="template_title_font_italic" type="radio" value="0" <?php checked(0, $template_title_font_italic); ?> />
                                                <label for="template_title_font_italic_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Text Transform', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text transform style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_title_font_text_transform = isset($bdp_settings['template_title_font_text_transform']) ? $bdp_settings['template_title_font_text_transform'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="template_title_font_text_transform" id="template_title_font_text_transform">
                                                    <option <?php selected($template_title_font_text_transform, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_transform, 'capitalize'); ?> value="capitalize"><?php _e('Capitalize', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_transform, 'uppercase'); ?> value="uppercase"><?php _e('Uppercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_transform, 'lowercase'); ?> value="lowercase"><?php _e('Lowercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_transform, 'full-width'); ?> value="full-width"><?php _e('Full Width', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Text Decoration', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text decoration', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_title_font_text_decoration = isset($bdp_settings['template_title_font_text_decoration']) ? $bdp_settings['template_title_font_text_decoration'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="template_title_font_text_decoration" id="template_title_font_text_decoration">
                                                    <option <?php selected($template_title_font_text_decoration, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_decoration, 'underline'); ?> value="underline"><?php _e('Underline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_decoration, 'overline'); ?> value="overline"><?php _e('Overline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_title_font_text_decoration, 'line-through'); ?> value="line-through"><?php _e('Line Through', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Letter Spacing (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter letter spacing', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="input-type-number">
                                                <input type="number" name="template_title_font_letter_spacing" id="template_title_font_letter_spacing" step="1" min="0" value="<?php echo isset($bdp_settings['template_title_font_letter_spacing']) ? $bdp_settings['template_title_font_letter_spacing'] : '0'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsingleconent" class="postbox postbox-with-fw-options bdp-content-setting1" <?php echo $bdpcontent_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li class="content-firstletter-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('First letter of post content as Dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>

                                </div>
                                <div class="bdp-right">
                                <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable first letter of post content as Dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $firstletter_big = (isset($bdp_settings['firstletter_big'])) ? $bdp_settings['firstletter_big'] : 0; ?>
                                    <fieldset class="buttonset firstletter_big">
                                        <input id="firstletter_big_1" name="firstletter_big" type="radio" value="1" <?php checked(1, $firstletter_big); ?> />
                                        <label for="firstletter_big_1" <?php checked(1, $firstletter_big); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="firstletter_big_0" name="firstletter_big" type="radio" value="0" <?php checked(0, $firstletter_big); ?> />
                                        <label for="firstletter_big_0" <?php checked(0, $firstletter_big); ?>><?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="firstletter-setting">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('First letter of Post Content Font Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter font size for first letter of post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != "") ? $bdp_settings['firstletter_fontsize'] : '35;' ?>
                                    <div class="grid_col_space range_slider_fontsize" id="firstletter_fontsize_slider"></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="firstletter_fontsize" id="firstletter_fontsize" value="<?php echo $firstletter_fontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                </div>
                            </li>
                            <li class="firstletter-setting">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('First letter of Post Content Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font family for first letter of post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : '' ?>
                                    <div class="typo-field">
                                        <input type="hidden" id="firstletter_font_family_font_type" name="firstletter_font_family_font_type" value="<?php echo isset($bdp_settings['firstletter_font_family_font_type']) ? $bdp_settings['firstletter_font_family_font_type'] : '' ?>">
                                        <select name="firstletter_font_family" id="firstletter_font_family">
                                            <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <?php
                                            $old_version = '';
                                            $cnt = 0;
                                            foreach ($font_family as $key => $value) {
                                                if ($value['version'] != $old_version) {
                                                    if ($cnt > 0) {
                                                        echo '</optgroup>';
                                                    }
                                                    echo '<optgroup label="' . $value['version'] . '">';
                                                    $old_version = $value['version'];
                                                }
                                                echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                if ($firstletter_font_family != '' && (str_replace('"', '', $firstletter_font_family) == str_replace('"', '', $value['label']))) {
                                                    echo ' selected';
                                                }
                                                echo ">" . $value['label'] . "</option>";
                                                $cnt++;
                                            }
                                            if ($cnt == count($font_family)) {
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="firstletter-setting">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('First letter of Post Content Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select color for sirst letter of post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $firstletter_contentcolor = (isset($bdp_settings["firstletter_contentcolor"])) ? $bdp_settings["firstletter_contentcolor"] : ''; ?>
                                    <input type="text" name="firstletter_contentcolor" id="firstletter_contentcolor" value="<?php echo $firstletter_contentcolor; ?>"/>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Content Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select color of post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_contentcolor" id="template_contentcolor" value="<?php echo isset($bdp_settings["template_contentcolor"]) ? $bdp_settings["template_contentcolor"] : ''; ?>"/>
                                </div>
                            </li>
                            <li>
                                <h3 class="bdp-table-title"><?php _e('Typography Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-typography-wrapper bdp-typography-wrapper1">
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font family for post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $template_contentfontface = '';
                                            if (isset($bdp_settings['template_contentfontface'])) {
                                                $template_contentfontface = $bdp_settings['template_contentfontface'];
                                            }
                                            ?>
                                            <div class="typo-field">
                                                <input type="hidden" name="template_contentfontface_font_type" id="template_contentfontface_font_type" value="<?php echo isset($bdp_settings['template_contentfontface_font_type']) ? $bdp_settings['template_contentfontface_font_type'] : 'Serif Fonts'; ?>">
                                                <div class="select-cover">
                                                    <select name="template_contentfontface" id="template_contentfontface">
                                                        <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                        <?php
                                                        $old_version = '';
                                                        $cnt = 0;
                                                        foreach ($font_family as $key => $value) {
                                                            if ($value['version'] != $old_version) {
                                                                if ($cnt > 0) {
                                                                    echo '</optgroup>';
                                                                }
                                                                echo '<optgroup label="' . $value['version'] . '">';
                                                                $old_version = $value['version'];
                                                            }
                                                            echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                            if ($template_contentfontface != '' && (str_replace('"', '', $template_contentfontface) == str_replace('"', '', $value['label']))) {
                                                                echo ' selected';
                                                            }
                                                            echo ">" . $value['label'] . "</option>";
                                                            $cnt++;
                                                        }
                                                        if ($cnt == count($font_family)) {
                                                            echo '</optgroup>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Size (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size of post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $content_fontsize = (isset($bdp_settings["content_fontsize"])) ? $bdp_settings["content_fontsize"] : 15; ?>
                                            <div class="grid_col_space range_slider_fontsize" id="content_fontsize_slider" data-value="<?php echo $content_fontsize; ?>" ></div>
                                            <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="content_fontsize" id="content_fontsize" value="<?php echo $content_fontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Weight', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font weight', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_content_font_weight = isset($bdp_settings['template_content_font_weight']) ? $bdp_settings['template_content_font_weight'] : 'normal'; ?>
                                            <div class="select-cover">
                                                <select name="template_content_font_weight" id="template_content_font_weight">
                                                    <option value="100" <?php selected($template_content_font_weight, 100); ?>>100</option>
                                                    <option value="200" <?php selected($template_content_font_weight, 200); ?>>200</option>
                                                    <option value="300" <?php selected($template_content_font_weight, 300); ?>>300</option>
                                                    <option value="400" <?php selected($template_content_font_weight, 400); ?>>400</option>
                                                    <option value="500" <?php selected($template_content_font_weight, 500); ?>>500</option>
                                                    <option value="600" <?php selected($template_content_font_weight, 600); ?>>600</option>
                                                    <option value="700" <?php selected($template_content_font_weight, 700); ?>>700</option>
                                                    <option value="800" <?php selected($template_content_font_weight, 800); ?>>800</option>
                                                    <option value="900" <?php selected($template_content_font_weight, 900); ?>>900</option>
                                                    <option value="bold" <?php selected($template_content_font_weight, 'bold'); ?> ><?php _e('Bold', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option value="normal" <?php selected($template_content_font_weight, 'normal'); ?>><?php _e('Normal', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Line Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter line height', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="input-type-number">
                                                <input type="number" name="template_content_font_line_height" id="template_content_font_line_height" step="0.1" min="0" value="<?php echo isset($bdp_settings['template_content_font_line_height']) ? $bdp_settings['template_content_font_line_height'] : '1.5'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Italic Font Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable italic font style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_content_font_italic = isset($bdp_settings['template_content_font_italic']) ? $bdp_settings['template_content_font_italic'] : '0';?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="template_content_font_italic_1" name="template_content_font_italic" type="radio" value="1"  <?php checked(1, $template_content_font_italic); ?> />
                                                <label for="template_content_font_italic_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="template_content_font_italic_0" name="template_content_font_italic" type="radio" value="0" <?php checked(0, $template_content_font_italic); ?> />
                                                <label for="template_content_font_italic_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Text Transform', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text transform', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_content_font_text_transform = isset($bdp_settings['template_content_font_text_transform']) ? $bdp_settings['template_content_font_text_transform'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="template_content_font_text_transform" id="template_content_font_text_transform">
                                                    <option <?php selected($template_content_font_text_transform, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_transform, 'capitalize'); ?> value="capitalize"><?php _e('Capitalize', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_transform, 'uppercase'); ?> value="uppercase"><?php _e('Uppercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_transform, 'lowercase'); ?> value="lowercase"><?php _e('Lowercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_transform, 'full-width'); ?> value="full-width"><?php _e('Full Width', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Text Decoration', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text decoration option', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $template_content_font_text_decoration = isset($bdp_settings['template_content_font_text_decoration']) ? $bdp_settings['template_content_font_text_decoration'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="template_content_font_text_decoration" id="template_content_font_text_decoration">
                                                    <option <?php selected($template_content_font_text_decoration, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_decoration, 'underline'); ?> value="underline"><?php _e('Underline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_decoration, 'overline'); ?> value="overline"><?php _e('Overline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($template_content_font_text_decoration, 'line-through'); ?> value="line-through"><?php _e('Line Through', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Letter Spacing (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter letter spacing', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="input-type-number">
                                                <input type="number" name="template_content_font_letter_spacing" id="template_content_font_letter_spacing" step="1" min="0" value="<?php echo isset($bdp_settings['template_content_font_letter_spacing']) ? $bdp_settings['template_content_font_letter_spacing'] : '0'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglemedia" class="postbox postbox-with-fw-options bdp-content-setting1" <?php echo $bdpmedia_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li class="bdp_single_custom_media_selection">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Featured Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post thumbnail', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_thumbnail = isset($bdp_settings['display_thumbnail']) ? $bdp_settings['display_thumbnail'] : 1; ?>
                                    <fieldset class="bdp-social-options bdp-display_comment buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_thumbnail_1" name="display_thumbnail" type="radio" value="1" <?php checked(1, $display_thumbnail); ?> />
                                        <label for="display_thumbnail_1" <?php checked(1, $display_thumbnail); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_thumbnail_0" name="display_thumbnail" type="radio" value="0" <?php checked(0, $display_thumbnail); ?> />
                                        <label for="display_thumbnail_0" <?php checked(0, $display_thumbnail); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="bdp_single_custom_media_selection bdp_media_size_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Media Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select size of post media', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <select id="bdp_media_size" name="bdp_media_size">
                                        <option value="full" <?php echo (isset($bdp_settings['bdp_media_size']) && $bdp_settings['bdp_media_size'] == 'full') ? 'selected="selected"' : '' ?> ><?php _e('Original Resolution', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <?php
                                        global $_wp_additional_image_sizes;
                                        $thumb_sizes = array();
                                        $image_size = get_intermediate_image_sizes();
                                        foreach ($image_size as $s) {
                                            $thumb_sizes [$s] = array(0, 0);
                                            if (in_array($s, array('thumbnail', 'medium', 'large'))) {
                                                ?>
                                                <option value="<?php echo $s; ?>" <?php echo (isset($bdp_settings['bdp_media_size']) && $bdp_settings['bdp_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo $s . ' (' . get_option($s . '_size_w') . 'x' . get_option($s . '_size_h') . ')'; ?> </option>
                                                <?php
                                            } else {
                                                if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s])) {
                                                    ?>
                                                    <option value="<?php echo $s; ?>" <?php echo (isset($bdp_settings['bdp_media_size']) && $bdp_settings['bdp_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo $s . ' (' . $_wp_additional_image_sizes[$s]['width'] . 'x' . $_wp_additional_image_sizes[$s]['height'] . ')'; ?> </option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <option value="custom" <?php echo (isset($bdp_settings['bdp_media_size']) && $bdp_settings['bdp_media_size'] == 'custom') ? 'selected="selected"' : '' ?>><?php _e('Custom Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>
                            <li class="bdp_media_custom_size_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Add Cutom Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Enter custom size for post media', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="bdp_media_custom_size_tbl">
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Width (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" min="1" name="media_custom_width" class="media_custom_width" id="media_custom_width" value="<?php echo (isset($bdp_settings['media_custom_width']) && $bdp_settings['media_custom_width'] != '' ) ? $bdp_settings['media_custom_width'] : ''; ?>" /> </p>
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Height (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" min="1" name="media_custom_height" class="media_custom_height" id="media_custom_height" value="<?php echo (isset($bdp_settings['media_custom_height']) && $bdp_settings['media_custom_height'] != '' ) ? $bdp_settings['media_custom_height'] : ''; ?>"/></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglepostnavigation" class="postbox postbox-with-fw-options bdp-post-navigation-setting" <?php echo $bdpsinglepostnavigation_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Next/Previous Navigation ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_navigation = isset($bdp_settings['display_navigation']) ? $bdp_settings['display_navigation'] : 0; ?>
                                    <fieldset class="bdp-social-options bdp-display_comment buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_navigation_1" name="display_navigation" type="radio" value="1" <?php checked(1, $display_navigation); ?> />
                                        <label for="display_navigation_1" <?php checked(1, $display_navigation); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_navigation_0" name="display_navigation" type="radio" value="0" <?php checked(0, $display_navigation); ?> />
                                        <label for="display_navigation_0" <?php checked(0, $display_navigation); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="post-navigation-blocks">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Apply Filter on Post Navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Apply Filter on Post Navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_post_navigation_filter = isset($bdp_settings['bdp_post_navigation_filter']) ? $bdp_settings['bdp_post_navigation_filter'] : ''; ?>
                                    <select name="bdp_post_navigation_filter" id="bdp_post_navigation_filter">
                                        <option value=""><?php _e('Default', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option <?php selected($bdp_post_navigation_filter, 'category'); ?> value="category"><?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option <?php selected($bdp_post_navigation_filter, 'post_tag'); ?> value="post_tag"><?php _e('Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>
                            <li class="post-navigation-blocks">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_pn_title = (isset($bdp_settings['display_pn_title'])) ? $bdp_settings['display_pn_title'] : 1; ?>
                                    <fieldset class="buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_pn_title_1" name="display_pn_title" type="radio" value="1" <?php checked(1, $display_pn_title); ?> />
                                        <label for="display_pn_title_1" <?php checked(1, $display_pn_title); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_pn_title_0" name="display_pn_title" type="radio" value="0" <?php checked(0, $display_pn_title); ?> />
                                        <label for="display_pn_title_0" <?php checked(0, $display_pn_title); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e('Note:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b>
                                        <?php _e('Show post title when option is "Yes" otherwise it will display "Previous Post" and "Next Post".', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>
                            <li class="post-navigation-blocks">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Feature Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post feature image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_pn_image = (isset($bdp_settings['display_pn_image'])) ? $bdp_settings['display_pn_image'] : 1; ?>
                                    <fieldset class="buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_pn_image_1" name="display_pn_image" type="radio" value="1" <?php checked(1, $display_pn_image); ?> />
                                        <label for="display_pn_image_1" <?php checked(1, $display_pn_image); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_pn_image_0" name="display_pn_image" type="radio" value="0" <?php checked(0, $display_pn_image); ?> />
                                        <label for="display_pn_image_0" <?php checked(0, $display_pn_image); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="post-navigation-blocks">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_pn_date = (isset($bdp_settings['display_pn_date'])) ? $bdp_settings['display_pn_date'] : 1 ?>
                                    <fieldset class="buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_pn_date_1" name="display_pn_date" type="radio" value="1" <?php checked(1, $display_pn_date); ?> />
                                        <label for="display_pn_date_1" <?php checked(1, $display_pn_date); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_pn_date_0" name="display_pn_date" type="radio" value="0" <?php checked(0, $display_pn_date); ?> />
                                        <label for="display_pn_date_0" <?php checked(0, $display_pn_date); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglepostauthor" class="postbox postbox-with-fw-options bdp-post-navigation-setting" <?php echo $bdpauthor_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Author Data', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable author data', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings['display_author_data'])) {
                                        $display_author_data = $bdp_settings['display_author_data'];
                                    } else {
                                        $display_author_data = 1;
                                    }
                                    ?>
                                    <fieldset class="bdp-social-options bdp-display_author_data buttonset">
                                        <input id="display_author_data_1" name="display_author_data" type="radio" value="1"  <?php checked(1, $display_author_data); ?> />
                                        <label for="display_author_data_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_author_data_0" name="display_author_data" type="radio" value="0" <?php checked(0, $display_author_data); ?> />
                                        <label for="display_author_data_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="display_author_biography_div">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Author Biography', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable author biography', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings['display_author_biography'])) {
                                        $display_author_biography = $bdp_settings['display_author_biography'];
                                    } else {
                                        $display_author_biography = 1;
                                    }
                                    ?>
                                    <fieldset class="bdp-social-options bdp-display_author buttonset">
                                        <input id="display_author_biography_1" name="display_author_biography" type="radio" value="1"  <?php checked(1, $display_author_biography); ?> />
                                        <label for="display_author_biography_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_author_biography_0" name="display_author_biography" type="radio" value="0" <?php checked(0, $display_author_biography); ?> />
                                        <label for="display_author_biography_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="display_author_biography_div">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Author Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter lable for author title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" id="txtAuthorTitle" name="txtAuthorTitle" value="<?php echo isset($bdp_settings['txtAuthorTitle']) ? $bdp_settings['txtAuthorTitle'] : __('About', BLOGDESIGNERPRO_TEXTDOMAIN) . ' [author]'; ?>" placeholder="<?php _e('About', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo ' [author]'; ?>">

                                    <label class="disable_link bdp-link-disable">
                                        <input id="disable_link_author_div" name="disable_link_author_div" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['disable_link_author_div'])) {
                                            checked(1, $bdp_settings['disable_link_author_div']);
                                        }
                                        ?> />
                                        <?php _e('Disable Link for Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </label>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e('Note', BLOGDESIGNERPRO_TEXTDOMAIN); ?>: </b>
                                        <?php
                                        _e('Use', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo ' [author] ';
                                        _e('to display author name with link dynamically.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        ?>
                                    </div>
                                </div>
                            </li>
                            <li class="display_author_biography_div">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Author Title Font Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size for author title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings["author_title_fontsize"])) {
                                        $author_title_fontsize = $bdp_settings["author_title_fontsize"];
                                    } else {
                                        $author_title_fontsize = 16;
                                    }
                                    ?>
                                    <div class="grid_col_space range_slider_fontsize" id="author_title_fontsize_slider"></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="author_title_fontsize" id="author_title_fontsize" value="<?php echo $author_title_fontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                </div>
                            </li>
                            <li class="display_author_biography_div">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Author Title Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select author title font family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="typo-field">
                                        <input type="hidden" name="author_title_fontface_font_type" id="author_title_fontface_font_type" value="<?php echo isset($bdp_settings['author_title_fontface_font_type']) ? $bdp_settings['author_title_fontface_font_type'] : 'Serif Fonts'; ?>">
                                        <?php
                                        $author_title_fontface = '';
                                        if (isset($bdp_settings['author_title_fontface'])) {
                                            $author_title_fontface = $bdp_settings['author_title_fontface'];
                                        }
                                        ?>
                                        <select name="author_title_fontface" id="author_title_fontface">
                                            <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <?php
                                            $old_version = '';
                                            $cnt = 0;
                                            foreach ($font_family as $key => $value) {
                                                if ($value['version'] != $old_version) {
                                                    if ($cnt > 0) {
                                                        echo '</optgroup>';
                                                    }
                                                    echo '<optgroup label="' . $value['version'] . '">';
                                                    $old_version = $value['version'];
                                                }
                                                echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                if ($author_title_fontface != '' && (str_replace('"', '', $author_title_fontface) == str_replace('"', '', $value['label']))) {
                                                    echo ' selected';
                                                }
                                                echo ">" . $value['label'] . "</option>";
                                                $cnt++;
                                            }
                                            if ($cnt == count($font_family)) {
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglerelated" class="postbox postbox-with-fw-options bdp-content-setting1" <?php echo $bdprelated_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Related Post On Single Page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable related post on single page', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <label>
                                        <input id="display_related_post" name="display_related_post" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['display_related_post'])) {
                                            checked(1, $bdp_settings['display_related_post']);
                                        }
                                        ?> />
                                    </label>
                                </div>
                            </li>


                            <li class="bdp_single_custom_media_selection_related_post">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Media Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select size of related post media', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <select id="bdp_related_post_media_size" name="bdp_related_post_media_size">
                                        <option value="full" <?php echo (isset($bdp_settings['bdp_related_post_media_size']) && $bdp_settings['bdp_related_post_media_size'] == 'full') ? 'selected="selected"' : '' ?> ><?php _e('Original Resolution', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <?php
                                        global $_wp_additional_image_sizes;
                                        $thumb_sizes = array();
                                        $image_size = get_intermediate_image_sizes();
                                        foreach ($image_size as $s) {
                                            $thumb_sizes [$s] = array(0, 0);
                                            if (in_array($s, array('thumbnail', 'medium', 'large'))) {
                                                ?>
                                                <option value="<?php echo $s; ?>" <?php echo (isset($bdp_settings['bdp_related_post_media_size']) && $bdp_settings['bdp_related_post_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo $s . ' (' . get_option($s . '_size_w') . 'x' . get_option($s . '_size_h') . ')'; ?> </option>
                                                <?php
                                            } else {
                                                if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s])) {
                                                    ?>
                                                    <option value="<?php echo $s; ?>" <?php echo (isset($bdp_settings['bdp_related_post_media_size']) && $bdp_settings['bdp_related_post_media_size'] == $s ) ? 'selected="selected"' : ''; ?>> <?php echo $s . ' (' . $_wp_additional_image_sizes[$s]['width'] . 'x' . $_wp_additional_image_sizes[$s]['height'] . ')'; ?> </option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <option value="custom" <?php echo (isset($bdp_settings['bdp_related_post_media_size']) && $bdp_settings['bdp_related_post_media_size'] == 'custom') ? 'selected="selected"' : '' ?>><?php _e('Custom Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li class="bdp_related_post_media_custom_size_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Add Cutom Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter custom size for post media', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="bdp_media_custom_size_tbl">
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Width (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" onkeypress="return isNumberKey(event)" min="0" name="related_post_media_custom_width" class="media_custom_width" id="related_post_media_custom_width" value="<?php echo (isset($bdp_settings['related_post_media_custom_width']) && $bdp_settings['related_post_media_custom_width'] != '' ) ? $bdp_settings['related_post_media_custom_width'] : ''; ?>" /></p>
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Height (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" onkeypress="return isNumberKey(event)" min="0" name="related_post_media_custom_height" class="media_custom_height" id="related_post_media_custom_height" value="<?php echo (isset($bdp_settings['related_post_media_custom_height']) && $bdp_settings['related_post_media_custom_height'] != '' ) ? $bdp_settings['related_post_media_custom_height'] : ''; ?>"/></p>
                                    </div>
                                </div>
                            </li>


                            <li class="related_post_text">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Related Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter related post title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="related_post_title" id="related_post_title" value="<?php
                                    if (isset($bdp_settings['related_post_title'])) {
                                        echo $bdp_settings['related_post_title'];
                                    }
                                    ?>" placeholder="<?php _e('Enter Related Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Related Post Title Font Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select related post title font size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings["related_title_fontsize"])) {
                                        $related_title_fontsize = $bdp_settings["related_title_fontsize"];
                                    } else {
                                        $related_title_fontsize = 25;
                                    }
                                    ?>
                                    <div class="grid_col_space range_slider_fontsize" id="related_post_fontsize" data-value="<?php echo $related_title_fontsize; ?>" ></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="related_title_fontsize" id="related_title_fontsize" value="<?php echo $related_title_fontsize; ?>" onkeypress="return isNumberKey(event)" /></div><?php _e('px', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Related Post Title Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select related post title font family ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="typo-field">
                                        <input type="hidden" name="related_title_fontface_font_type" id="related_title_fontface_font_type" value="<?php echo isset($bdp_settings['related_title_fontface_font_type']) ? $bdp_settings['related_title_fontface_font_type'] : 'Serif Fonts'; ?>">
                                        <?php
                                        if (isset($bdp_settings['related_title_fontface'])) {
                                            $related_title_fontface = $bdp_settings['related_title_fontface'];
                                        } else {
                                            $related_title_fontface = 'Georgia, serif';
                                        }
                                        ?>
                                        <select name="related_title_fontface" id="related_title_fontface">
                                            <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <?php
                                            $old_version = '';
                                            $cnt = 0;
                                            foreach ($font_family as $key => $value) {
                                                if ($value['version'] != $old_version) {
                                                    if ($cnt > 0) {
                                                        echo '</optgroup>';
                                                    }
                                                    echo '<optgroup label="' . $value['version'] . '">';
                                                    $old_version = $value['version'];
                                                }
                                                echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                if ($related_title_fontface != '' && (str_replace('"', '', $related_title_fontface) == str_replace('"', '', $value['label']))) {
                                                    echo ' selected';
                                                }
                                                echo ">" . $value['label'] . "</option>";
                                                $cnt++;
                                            }
                                            if ($cnt == count($font_family)) {
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Related Post Title Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select related post title color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="related_title_color" id="related_title_color" value="<?php echo isset($bdp_settings["related_title_color"]) ? $bdp_settings["related_title_color"] : '#333333'; ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Show Related Posts By', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Display related post by category or tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $related_post_by = isset($bdp_settings["related_post_by"]) ? $bdp_settings["related_post_by"] : '';
                                    ?>
                                    <select name="related_post_by" id="related_post_by">
                                        <option selected="" value="category" <?php if ($related_post_by == 'category') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="tag" <?php if ($related_post_by == 'tag') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Related Posts Order By', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select sorting order of related post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $related_orderby = '';
                                    if (isset($bdp_settings['bdp_related_post_order_by'])) {
                                        $related_orderby = $bdp_settings['bdp_related_post_order_by'];
                                    }
                                    ?>
                                    <select id="bdp_related_post_order_by" name="bdp_related_post_order_by">
                                        <option value="" <?php echo selected('', $related_orderby); ?>><?php _e('Default Sorting', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="rand" <?php echo selected('rand', $related_orderby); ?>><?php _e('Random', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="ID" <?php echo selected('ID', $related_orderby); ?>><?php _e('Post ID', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="author" <?php echo selected('author', $related_orderby); ?>><?php _e('Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="title" <?php echo selected('title', $related_orderby); ?>><?php _e('Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="name" <?php echo selected('name', $related_orderby); ?>><?php _e('Post Slug', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="date" <?php echo selected('date', $related_orderby); ?>><?php _e('Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="modified" <?php echo selected('modified', $related_orderby); ?>><?php _e('Modified Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="meta_value_num" <?php echo selected('meta_value_num', $related_orderby); ?>><?php _e('Post Likes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <?php ?>
                                    <div class="blg_order">
                                        <?php
                                        $related_post_order = 'DESC';
                                        if (isset($bdp_settings['bdp_related_post_order'])) {
                                            $related_post_order = $bdp_settings['bdp_related_post_order'];
                                        }
                                        ?>
                                        <fieldset class="buttonset green" data-hide='1'>
                                            <input id="bdp_related_post_asc" name="bdp_related_post_order" type="radio" value="ASC" <?php checked('ASC', $related_post_order); ?> />
                                            <label id="bdp-options-button" for="bdp_related_post_asc"><?php _e('Ascending', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            <input id="bdp_related_post_desc" name="bdp_related_post_order" type="radio" value="DESC" <?php checked('DESC', $related_post_order); ?> />
                                            <label id="bdp-options-button" for="bdp_related_post_desc"><?php _e('Descending', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        </fieldset>
                                    </div>
                                    <?php ?>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Number Of Related Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select number of related posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings["related_post_number"])) {
                                        $bdp_settings["related_post_number"] = $bdp_settings["related_post_number"];
                                    } else {
                                        $bdp_settings["related_post_number"] = 3;
                                    }
                                    ?>
                                    <select name="related_post_number" id="related_post_number">
                                        <option selected="" value="2" <?php if ($bdp_settings["related_post_number"] == '2') { ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if ($bdp_settings["related_post_number"] == '3') { ?> selected="selected"<?php } ?>>3</option>
                                        <option value="4" <?php if ($bdp_settings["related_post_number"] == '4') { ?> selected="selected"<?php } ?>>4</option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Show Content From', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Display content from post content or excerpt', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_post_content_from = isset($bdp_settings['related_post_content_from']) ? $bdp_settings['related_post_content_from'] : 'from_content'; ?>
                                    <select name="related_post_content_from" id="related_post_content_from">
                                        <option value="from_content" <?php selected($template_post_content_from, 'from_content'); ?> ><?php _e('Post Content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="from_excerpt" <?php selected($template_post_content_from, 'from_excerpt'); ?>><?php _e('Post Excerpt', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b> &nbsp;
                                        <?php _e('If  Post Excerpt is empty then Content will get automatically from Post Content.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Content Length (words)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter post content length', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input class="bdp-content-lenth" type="number" id="related_post_content_length" name="related_post_content_length" step="1" min="0" value="<?php echo isset($bdp_settings['related_post_content_length']) ? $bdp_settings['related_post_content_length'] : ''; ?>" placeholder="<?php _e('Enter Content length', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" onkeypress="return isNumberKey(event)">
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e('Note', BLOGDESIGNERPRO_TEXTDOMAIN); ?>: </b>
                                        <?php _e('Leave it blank if you want to hide content in related post.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdpsinglesocial" class="postbox postbox-with-fw-options" <?php echo $bdpsocial_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable social share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $social_share = isset($bdp_settings['social_share']) ? $bdp_settings['social_share'] : 1; ?>
                                    <fieldset class="bdp-social-options buttonset buttonset-hide" data-hide='1'>
                                        <input id="social_share_1" name="social_share" type="radio" value="1" <?php checked(1, $social_share); ?> />
                                        <label id="" for="social_share_1" <?php checked(1, $social_share); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_share_0" name="social_share" type="radio" value="0" <?php checked(0, $social_share); ?> />
                                        <label id="" for="social_share_0" <?php checked(0, $social_share); ?>> <?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select social share style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $social_style = '1';
                                    if (isset($bdp_settings['social_style'])) {
                                        $social_style = $bdp_settings['social_style'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-style buttonset buttonset-hide green" data-hide='1'>
                                        <input id="social_style_0" name="social_style" type="radio" value="0" <?php checked(0, $social_style); ?> />
                                        <label id="bdp-options-button" for="social_style_0" <?php checked(0, $social_style); ?>><?php _e('Default', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_style_1" name="social_style" type="radio" value="1" <?php checked(1, $social_style); ?> />
                                        <label id="bdp-options-button" for="social_style_1" <?php checked(1, $social_style); ?>><?php _e('Custom', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class ="social_share_options shape_social_icon">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Shape of Social Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select shape of social icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $social_icon_style = isset($bdp_settings['social_icon_style']) ? $bdp_settings['social_icon_style'] : 1;
                                    ?>
                                    <fieldset class="bdp-social-shape buttonset buttonset-hide green" data-hide='1'>
                                        <input id="social_icon_style_0" name="social_icon_style" type="radio" value="0" nhp-opts-button-hide-below <?php checked(0, $social_icon_style); ?> />
                                        <label id="bdp-options-button" for="social_icon_style_0" <?php checked(0, $social_icon_style); ?>><?php _e('Circle', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_icon_style_1" name="social_icon_style" type="radio" value="1" nhp-opts-button-hide-below <?php checked(1, $social_icon_style); ?> />
                                        <label id="bdp-options-button" for="social_icon_style_1" <?php checked(1, $social_icon_style); ?>><?php _e('Square', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class ="social_share_options size_social_icon">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Size of Social Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select size of social icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $social_icon_size = isset($bdp_settings['social_icon_size']) ? $bdp_settings['social_icon_size'] : '0';
                                    ?>
                                    <fieldset class="bdp-social-size buttonset buttonset-hide green bdp-social-icon-size" data-hide='1'>
                                        <input id="social_icon_size_1" name="social_icon_size" type="radio" value="1" <?php checked(1, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_1" <?php checked(1, $social_icon_size); ?>><?php _e('Small', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_icon_size_0" name="social_icon_size" type="radio" value="0" <?php checked(0, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_0" <?php checked(0, $social_icon_size); ?>><?php _e('Large', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_icon_size_2" name="social_icon_size" type="radio" value="2" <?php checked(2, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_2" <?php checked(2, $social_icon_size); ?>><?php _e('Extra Small', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class ="social_share_options default_icon_layouts">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Available Icon Themes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-social"><span class="bdp-tooltips"><?php _e('Select icon theme from available icon theme', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $default_icon_theme = 1;
                                    if (isset($bdp_settings['default_icon_theme'])) {
                                        $default_icon_theme = $bdp_settings['default_icon_theme'];
                                    }
                                    ?>
                                    <div class="social-share-theme">
                                        <?php
                                        for ($i = 1; $i <= 10; $i++) {
                                            ?>
                                            <div class="social-cover social_share_theme_<?php echo $i; ?>">
                                                <label><input type="radio" id="default_icon_theme_<?php echo $i; ?>" value="<?php echo $i; ?>" name="default_icon_theme" <?php checked($i, $default_icon_theme); ?> />
                                                    <span class="bdp-social-icons facebook-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons gmail-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons twitter-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons linkdin-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons pin-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons whatsup-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons telegram-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons pocket-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons mail-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons reddit-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons digg-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons tumblr-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons skype-icon bdp_theme_wrapper"></span>
                                                    <span class="bdp-social-icons wordpress-icon bdp_theme_wrapper"></span>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </li>

                            <li class ="social_share_options bdp-display-settings bdp-social-share-options">
                                <h3 class="bdp-table-title">Social Share Links Settings</h3>
                                <div class="bdp-typography-wrapper bdp-social-share-link">

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Facebook Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable facebook share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $facebook_link = isset($bdp_settings['facebook_link']) ? $bdp_settings['facebook_link'] : 1;
                                            ?>
                                            <fieldset class="bdp-social-options bdp-facebook_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="facebook_link_1" name="facebook_link" type="radio" value="1" <?php checked(1, $facebook_link); ?> />
                                                <label id=""for="facebook_link_1" <?php checked(1, $facebook_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="facebook_link_0" name="facebook_link" type="radio" value="0" <?php checked(0, $facebook_link); ?> />
                                                <label id="" for="facebook_link_0" <?php checked(0, $facebook_link); ?>> <?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="social_link_with_count">
                                                <input id="facebook_link_with_count" name="facebook_link_with_count" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['facebook_link_with_count'])) {
                                                    checked(1, $bdp_settings['facebook_link_with_count']);
                                                }
                                                ?> />
                                                       <?php _e('Hide Facebook Share Count', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Twitter Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable twitter share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $twitter_link = isset($bdp_settings['twitter_link']) ? $bdp_settings['twitter_link'] : 1;
                                            ?>
                                            <fieldset class="bdp-social-options bdp-twitter_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="twitter_link_1" name="twitter_link" type="radio" value="1" <?php checked(1, $twitter_link); ?> />
                                                <label for="twitter_link_1" <?php checked(1, $twitter_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="twitter_link_0" name="twitter_link" type="radio" value="0" <?php checked(0, $twitter_link); ?> />
                                                <label for="twitter_link_0" <?php checked(0, $twitter_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Google+ Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable Google+ share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $google_link = isset($bdp_settings['google_link']) ? $bdp_settings['google_link'] : 1;
                                            ?>
                                            <fieldset class="bdp-social-options bdp-google_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="google_link_1" name="google_link" type="radio" value="1" <?php checked(1, $google_link); ?> />
                                                <label for="google_link_1" <?php checked(1, $google_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="google_link_0" name="google_link" type="radio" value="0" <?php checked(0, $google_link); ?> />
                                                <label for="google_link_0" <?php checked(0, $google_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Linkedin Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable linkedin share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            $linkedin_link = isset($bdp_settings['linkedin_link']) ? $bdp_settings['linkedin_link'] : 1;
                                            ?>
                                            <fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="linkedin_link_1" name="linkedin_link" type="radio" value="1" <?php checked(1, $linkedin_link); ?> />
                                                <label for="linkedin_link_1" <?php checked(1, $linkedin_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="linkedin_link_0" name="linkedin_link" type="radio" value="0" <?php checked(0, $linkedin_link); ?> />
                                                <label for="linkedin_link_0" <?php checked(0, $linkedin_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="social_link_with_count">
                                                <input id="linkedin_link_with_count" name="linkedin_link_with_count" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['linkedin_link_with_count'])) {
                                                    checked(1, $bdp_settings['linkedin_link_with_count']);
                                                }
                                                ?> />
                                                       <?php _e('Hide Linkedin Share Count', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Pinterest Share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable pinterest share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $pinterest_link = isset($bdp_settings['pinterest_link']) ? $bdp_settings['pinterest_link'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="pinterest_link_1" name="pinterest_link" type="radio" value="1" <?php checked(1, $pinterest_link); ?> />
                                                <label for="pinterest_link_1" <?php checked(1, $pinterest_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="pinterest_link_0" name="pinterest_link" type="radio" value="0" <?php checked(0, $pinterest_link); ?> />
                                                <label for="pinterest_link_0" <?php checked(0, $pinterest_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="social_link_with_count">
                                                <input id="pinterest_link_with_count" name="pinterest_link_with_count" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['pinterest_link_with_count'])) {
                                                    checked(1, $bdp_settings['pinterest_link_with_count']);
                                                }
                                                ?> />
                                                       <?php _e('Hide Pinterest Share Count', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Show Pinterest on Featured Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable pinterest share button on feature image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <label>
                                                <?php $pinterest_image_share = isset($bdp_settings['pinterest_image_share']) ? $bdp_settings['pinterest_image_share'] : 1; ?>
                                                <fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
                                                    <input id="pinterest_image_share_1" name="pinterest_image_share" type="radio" value="1" <?php checked(1, $pinterest_image_share); ?> />
                                                    <label for="pinterest_image_share_1" <?php checked(1, $pinterest_image_share); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                    <input id="pinterest_image_share_0" name="pinterest_image_share" type="radio" value="0" <?php checked(0, $pinterest_image_share); ?> />
                                                    <label for="pinterest_image_share_0" <?php checked(0, $pinterest_image_share); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                </fieldset>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Skype Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable skype share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $skype_link = isset($bdp_settings['skype_link']) ? $bdp_settings['skype_link'] : '0'; ?>
                                            <fieldset class="bdp-social-options bdp-twitter_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="skype_link_1" name="skype_link" type="radio" value="1" <?php checked(1, $skype_link); ?> />
                                                <label for="skype_link_1" <?php checked(1, $skype_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="skype_link_0" name="skype_link" type="radio" value="0" <?php checked(0, $skype_link); ?> />
                                                <label for="skype_link_0" <?php checked(0, $skype_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Pocket Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable pocket share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $pocket_link = isset($bdp_settings['pocket_link']) ? $bdp_settings['pocket_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-pocket_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="pocket_link_1" name="pocket_link" type="radio" value="1" <?php checked(1, $pocket_link); ?> />
                                                <label for="pocket_link_1" <?php checked(1, $pocket_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="pocket_link_0" name="pocket_link" type="radio" value="0" <?php checked(0, $pocket_link); ?> />
                                                <label for="pocket_link_0" <?php checked(0, $pocket_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Telegram Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable telegram share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $telegram_link = isset($bdp_settings['telegram_link']) ? $bdp_settings['telegram_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-telegram_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="telegram_link_1" name="telegram_link" type="radio" value="1" <?php checked(1, $telegram_link); ?> />
                                                <label for="telegram_link_1" <?php checked(1, $telegram_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="telegram_link_0" name="telegram_link" type="radio" value="0" <?php checked(0, $telegram_link); ?> />
                                                <label for="telegram_link_0" <?php checked(0, $telegram_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Reddit Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable reddit share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $reddit_link = isset($bdp_settings['reddit_link']) ? $bdp_settings['reddit_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-reddit_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="reddit_link_1" name="reddit_link" type="radio" value="1" <?php checked(1, $reddit_link); ?> />
                                                <label for="reddit_link_1" <?php checked(1, $reddit_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="reddit_link_0" name="reddit_link" type="radio" value="0" <?php checked(0, $reddit_link); ?> />
                                                <label for="reddit_link_0" <?php checked(0, $reddit_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Digg Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable digg share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $digg_link = isset($bdp_settings['digg_link']) ? $bdp_settings['digg_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-reddit_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="digg_link_1" name="digg_link" type="radio" value="1" <?php checked(1, $digg_link); ?> />
                                                <label for="digg_link_1" <?php checked(1, $digg_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="digg_link_0" name="digg_link" type="radio" value="0" <?php checked(0, $digg_link); ?> />
                                                <label for="digg_link_0" <?php checked(0, $digg_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Tumblr Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable tumblr share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $tumblr_link = isset($bdp_settings['tumblr_link']) ? $bdp_settings['tumblr_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-tumblr_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="tumblr_link_1" name="tumblr_link" type="radio" value="1" <?php checked(1, $tumblr_link); ?> />
                                                <label for="tumblr_link_1" <?php checked(1, $tumblr_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="tumblr_link_0" name="tumblr_link" type="radio" value="0" <?php checked(0, $tumblr_link); ?> />
                                                <label for="tumblr_link_0" <?php checked(0, $tumblr_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('WordPress Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable wordpress share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <?php $wordpress_link = isset($bdp_settings['wordpress_link']) ? $bdp_settings['wordpress_link'] : '0'; ?>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-wordpress_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="wordpress_link_1" name="wordpress_link" type="radio" value="1" <?php checked(1, $wordpress_link); ?> />
                                                <label for="wordpress_link_1" <?php checked(1, $wordpress_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="wordpress_link_0" name="wordpress_link" type="radio" value="0" <?php checked(0, $wordpress_link); ?> />
                                                <label for="wordpress_link_0" <?php checked(0, $wordpress_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Share via Mail', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable mail share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $email_link = isset($bdp_settings['email_link']) ? $bdp_settings['email_link'] : 0; ?>
                                            <fieldset class="bdp-social-options bdp-linkedin_link buttonset">
                                                <input id="email_link_1" class="bdp-opts-button" name="email_link" type="radio" value="1" <?php checked(1, $email_link); ?> />
                                                <label id="bdp-opts-button" for="email_link_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="email_link_0" class="bdp-opts-button" name="email_link" type="radio" value="0" <?php checked(0, $email_link); ?> />
                                                <label id="bdp-opts-button" for="email_link_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('WhatsApp Share Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable whatsapp share link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $whatsapp_link = isset($bdp_settings['whatsapp_link']) ? $bdp_settings['whatsapp_link'] : '0'; ?>
                                            <fieldset class="bdp-social-options bdp-whatsapp_link buttonset">
                                                <input id="whatsapp_link_1" class="bdp-opts-button" name="whatsapp_link" type="radio" value="1" <?php checked(1, $whatsapp_link); ?> />
                                                <label id="bdp-opts-button" for="whatsapp_link_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="whatsapp_link_0" class="bdp-opts-button" name="whatsapp_link" type="radio" value="0" <?php checked(0, $whatsapp_link); ?> />
                                                <label id="bdp-opts-button" for="whatsapp_link_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li class ="social_share_options mail_share_content">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Mail Share Content', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Mail share Content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $mail_subject = (isset($bdp_settings['mail_subject']) && $bdp_settings['mail_subject'] != '') ? $bdp_settings['mail_subject'] : '[post_title]' ?>
                                    <input type="text" name="mail_subject" id="mail_subject" value="<?php echo $mail_subject; ?>" placeholder="<?php esc_attr_e('Enter Mail Subject', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">

                                    <?php
                                    $settings = array(
                                        'wpautop' => true,
                                        'media_buttons' => true,
                                        'textarea_name' => 'mail_content',
                                        'textarea_rows' => 10,
                                        'tabindex' => '',
                                        'editor_css' => '',
                                        'editor_class' => '',
                                        'teeny' => false,
                                        'dfw' => false,
                                        'tinymce' => true,
                                        'quicktags' => true
                                    );
                                    if (isset($bdp_settings['mail_content']) && $bdp_settings['mail_content'] != '') {
                                        $contents = $bdp_settings['mail_content'];
                                    } else {
                                        $contents = __("My Dear friends", BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/><br/>' . __('I read one good blog link and I would like to share that same link for you. That might useful for you', BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/><br/>[post_link]<br/><br/>' . __("Best Regards", BLOGDESIGNERPRO_TEXTDOMAIN) . ',<br/>' . __("Blog Designer", BLOGDESIGNERPRO_TEXTDOMAIN);
                                    }

                                    wp_editor(html_entity_decode($contents), 'mail_content', $settings);
                                    ?>
                                    <div class="div-pre">
                                        <p> [post_title] => <?php _e('Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                        <p> [post_link] => <?php _e('Post Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                        <p> [post_thumbnail] => <?php _e('Post Featured Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                        <p> [sender_name] => <?php _e('Mail Sender Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                        <p> [sender_email] => <?php _e('Mail Sender Email Address', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                    </div>
                                </div>
                            </li>

                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Count Position', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select social share count position', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $social_count_position = 'bottom';
                                    if (isset($bdp_settings['social_count_position'])) {
                                        $social_count_position = $bdp_settings['social_count_position'];
                                    }
                                    ?>
                                    <div class="typo-field">
                                        <select name="social_count_position" id="social_sharecount">
                                            <option value="bottom" <?php echo selected('bottom', $social_count_position); ?>><?php _e('Bottom', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <option value="right" <?php echo selected('right', $social_count_position); ?>><?php _e('Right', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <option value="top" <?php echo selected('top', $social_count_position); ?>><?php _e('Top', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right social-share-section">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter text for share post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $txtSocialIcon = isset($bdp_settings['txtSocialIcon']) ? sanitize_text_field($bdp_settings['txtSocialIcon']) : 'fas fa-share';
                                    $txtSocialText = isset($bdp_settings['txtSocialText']) ? sanitize_text_field($bdp_settings['txtSocialText']) : __('Share This Post', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    ?>
                                    <input class="icon" type="text" id="txtSocialIcon" name="txtSocialIcon" value="<?php echo $txtSocialIcon; ?>" placeholder="<?php echo _e('Enter font awesome class', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <input class="text" type="text" id="txtSocialText" name="txtSocialText" value="<?php echo $txtSocialText; ?>" placeholder="<?php _e('Enter text for share post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e('Note:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b>
                                        <?php echo __('To find font awesome class,', BLOGDESIGNERPRO_TEXTDOMAIN) .' <a href="https://fontawesome.com/icons" target="_blank">'. __('click here.', BLOGDESIGNERPRO_TEXTDOMAIN) .'</a>'; ?>
                                    </div>
                                    <div id="dialogbox" class="dialogbox single_layout" title="<?php _e('Select Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" style="display:none">
                                        <div class="icon_div"> </div>
                                    </div>
                            </li>
                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Text Font', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select social share text font family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="typo-field">
                                        <input type="hidden" name="txtSocialTextFont_font_type" id="txtSocialTextFont_font_type" value="<?php echo isset($bdp_settings['txtSocialTextFont_font_type']) ? $bdp_settings['txtSocialTextFont_font_type'] : 'Serif Fonts'; ?>">
                                        <select name="txtSocialTextFont" id="txtSocialTextFont">
                                            <option value=""><?php _e('Select Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                            <?php
                                            $txtSocialTextFont = '';
                                            if (isset($bdp_settings['txtSocialTextFont'])) {
                                                $txtSocialTextFont = $bdp_settings['txtSocialTextFont'];
                                            }
                                            $old_version = '';
                                            $cnt = 0;
                                            foreach ($font_family as $key => $value) {
                                                if ($value['version'] != $old_version) {
                                                    if ($cnt > 0) {
                                                        echo '</optgroup>';
                                                    }
                                                    echo '<optgroup label="' . $value['version'] . '">';
                                                    $old_version = $value['version'];
                                                }
                                                echo "<option value='" . str_replace('"', '', $value['label']) . "'";

                                                if ($txtSocialTextFont != '' && (str_replace('"', '', $txtSocialTextFont) == str_replace('"', '', $value['label']))) {
                                                    echo ' selected';
                                                }
                                                echo ">" . $value['label'] . "</option>";
                                                $cnt++;
                                            }
                                            if ($cnt == count($font_family)) {
                                                echo '</optgroup>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Text Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                        <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select social share text font size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings["txtSocialTextSize"])) {
                                        $txtSocialTextSize = $bdp_settings["txtSocialTextSize"];
                                    } else {
                                        $txtSocialTextSize = 25;
                                    }
                                    ?>
                                    <div class="grid_col_space range_slider_fontsize" id="social_share_fontsize" data-value="<?php echo $txtSocialTextSize; ?>"></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="txtSocialTextSize" id="txtSocialTextSize" value="<?php echo $txtSocialTextSize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="popupdiv-single" class="bdp-template-popupdiv" style="display: none;">
        <?php
        foreach ($tempate_list as $key => $value) {
            $classes = explode(' ', $value['class']);
            foreach ($classes as $class)
                $all_class[] = $class;
        }
        $count = array_count_values($all_class);
        ?>
        <ul class="bdp_template_tab">
            <li class="current_tab">
                <a href="#all"><?php _e('All', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="">
                <a href="#full-width"><?php echo __('Full Width', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['full-width'] .')'; ?></a>
            </li>
            <li>
                <a href="#grid"><?php echo __('Grid', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['grid'] .')'; ?></a>
            </li>
            <li>
                <a href="#masonry"><?php echo __('Masonry', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['masonry'] .')'; ?></a>
            </li>
            <li>
                <a href="#magazine"><?php echo __('Magazine', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['magazine'] .')'; ?></a>
            </li>
            <li>
                <a href="#timeline"><?php echo __('Timeline', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['timeline'] .')'; ?></a>
            </li>
            <li>
                <a href="#slider"><?php echo __('Slider', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ('. $count['slider'] .')'; ?></a>
            </li>

            <div class="bdp-single-blog-template-search-cover">
                <input type="text" class="bdp-template-search" id="bdp-template-search" placeholder="<?php _e('Search Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                <span class="bdp-template-search-clear"></span>
            </div>
        </ul>
        <?php
        echo '<div class="bdp-blog-template-cover">';
        foreach ($tempate_list as $key => $value) {
            ?>
            <div class="template-thumbnail <?php echo $value['class']; ?>" <?php echo (isset($value['data']) && $value['data'] != '') ? 'data-value="'.$value['data'].'"' : ''?>>
                <div class="template-thumbnail-inner">
                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/single/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                    <div class="hover_overlay">
                        <div class="popup-template-name">
                            <div class="popup-select"><a href="#"><?php _e('Select Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                            <div class="popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                        </div>
                    </div>
                </div>
                <span class="bdp-span-template-name"><?php echo $value['template_name']; ?></span>
            </div>
            <?php
        }
        echo '</div>';
        echo '<h3 class="no-template" style="display: none;">' . __('No template found. Please try again', BLOGDESIGNERPRO_TEXTDOMAIN) . '</h3>';
        ?>
    </div>
</div>
