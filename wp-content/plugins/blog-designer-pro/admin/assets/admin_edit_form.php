<?php
/**
 * Add/Edit Blog Layout setting page
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $wp_version, $wpdb, $bdp_errors, $bdp_success, $bdp_settings;

$shortcode_name = '';
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $shortcode_id = '';
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $shortcode_id = $_GET['id'];
    }
    $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
    $getQry = "SELECT * FROM $tableName WHERE bdid = $shortcode_id";
    $get_allsettings = $wpdb->get_results($getQry, ARRAY_A);
    if (!isset($get_allsettings[0]['bdsettings'])) {
        echo '<div class="updated notice">';
        wp_die(__('You attempted to edit an item that doesn’t exist. Perhaps it was deleted?', BLOGDESIGNERPRO_TEXTDOMAIN));
        echo '</div>';
    }
    $allsettings = $get_allsettings[0]['bdsettings'];
    $shortcode_name = $get_allsettings[0]['shortcode_name'];
    if (is_serialized($allsettings)) {
        $bdp_settings = unserialize($allsettings);
    }
    $msg = '&msg=updated';
} else {
    $msg = '&msg=added';
}
if (isset($_GET['page']) && $_GET['page'] == 'archive_template') {
    $allsettings = get_option('archive_template');
    if ($allsettings && is_serialized($allsettings)) {
        $bdp_settings = unserialize($allsettings);
    }
    $msg = '&msg=updated';
}
if(isset($_GET['create']) && $_GET['create'] =='sample') {
    $bdp_success = __('We have created a sample blog layout with "classical" blog template.', BLOGDESIGNERPRO_TEXTDOMAIN);
    $bdp_success .= ' <a href="' . get_the_permalink($bdp_settings['blog_page_display']) . '" target="_blank">' . __('View blog page', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
}

$tempate_list = bdp_blog_template_list();
$loaders = array(
        'circularG' => '<div class="bdp-circularG-wrapper"><div class="bdp-circularG bdp-circularG_1"></div><div class="bdp-circularG bdp-circularG_2"></div><div class="bdp-circularG bdp-circularG_3"></div><div class="bdp-circularG bdp-circularG_4"></div><div class="bdp-circularG bdp-circularG_5"></div><div class="bdp-circularG bdp-circularG_6"></div><div class="bdp-circularG bdp-circularG_7"></div><div class="bdp-circularG bdp-circularG_8"></div></div>',
        'floatingCirclesG' => '<div class="bdp-floatingCirclesG"><div class="bdp-f_circleG bdp-frotateG_01"></div><div class="bdp-f_circleG bdp-frotateG_02"></div><div class="bdp-f_circleG bdp-frotateG_03"></div><div class="bdp-f_circleG bdp-frotateG_04"></div><div class="bdp-f_circleG bdp-frotateG_05"></div><div class="bdp-f_circleG bdp-frotateG_06"></div><div class="bdp-frotateG_07 bdp-f_circleG"></div><div class="bdp-frotateG_08 bdp-f_circleG"></div></div>',
        'spinloader' => '<div class="bdp-spinloader"></div>',
        'doublecircle' => '<div class="bdp-doublec-container"><ul class="bdp-doublec-flex-container"><li><span class="bdp-doublec-loading"></span></li></ul></div>',
        'wBall' => '<div class="bdp-windows8"><div class="bdp-wBall bdp-wBall_1"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_2"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_3"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_4"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall_5 bdp-wBall"><div class="bdp-wInnerBall"></div></div></div>',
        'cssanim' => '<div class="bdp-cssload-aim"></div>',
        'thecube' => '<div class="bdp-cssload-thecube"><div class="bdp-cssload-cube bdp-cssload-c1"></div><div class="bdp-cssload-cube bdp-cssload-c2"></div><div class="bdp-cssload-cube bdp-cssload-c4"></div><div class="bdp-cssload-cube bdp-cssload-c3"></div></div>',
        'ballloader' => '<div class="bdp-ballloader"><div class="bdp-loader-inner bdp-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
        'squareloader' => '<div class="bdp-squareloader"><div class="bdp-square"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div></div>',
        'loadFacebookG' => '<div class="bdp-loadFacebookG"><div class="bdp-blockG_1 bdp-facebook_blockG"></div><div class="bdp-blockG_2 bdp-facebook_blockG"></div><div class="bdp-facebook_blockG bdp-blockG_3"></div></div>',
        'floatBarsG' => '<div class="bdp-floatBarsG-wrapper"><div class="bdp-floatBarsG_1 bdp-floatBarsG"></div><div class="bdp-floatBarsG_2 bdp-floatBarsG"></div><div class="bdp-floatBarsG_3 bdp-floatBarsG"></div><div class="bdp-floatBarsG_4 bdp-floatBarsG"></div><div class="bdp-floatBarsG_5 bdp-floatBarsG"></div><div class="bdp-floatBarsG_6 bdp-floatBarsG"></div><div class="bdp-floatBarsG_7 bdp-floatBarsG"></div><div class="bdp-floatBarsG_8 bdp-floatBarsG"></div></div>',
        'movingBallG' => '<div class="bdp-movingBallG-wrapper"><div class="bdp-movingBallLineG"></div><div class="bdp-movingBallG_1 bdp-movingBallG"></div></div>',
        'ballsWaveG' => '<div class="bdp-ballsWaveG-wrapper"><div class="bdp-ballsWaveG_1 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_2 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_3 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_4 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_5 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_6 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_7 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_8 bdp-ballsWaveG"></div></div>',
        'fountainG' => '<div class="fountainG-wrapper"><div class="bdp-fountainG_1 bdp-fountainG"></div><div class="bdp-fountainG_2 bdp-fountainG"></div><div class="bdp-fountainG_3 bdp-fountainG"></div><div class="bdp-fountainG_4 bdp-fountainG"></div><div class="bdp-fountainG_5 bdp-fountainG"></div><div class="bdp-fountainG_6 bdp-fountainG"></div><div class="bdp-fountainG_7 bdp-fountainG"></div><div class="bdp-fountainG_8 bdp-fountainG"></div></div>',
        'audio_wave' => '<div class="bdp-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
        'warningGradientBarLineG' => '<div class="bdp-warningGradientOuterBarG"><div class="bdp-warningGradientFrontBarG bdp-warningGradientAnimationG"><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div></div></div>',
        'floatingBarsG' => '<div class="bdp-floatingBarsG"><div class="bdp-rotateG_01 bdp-blockG"></div><div class="bdp-rotateG_02 bdp-blockG"></div><div class="bdp-rotateG_03 bdp-blockG"></div><div class="bdp-rotateG_04 bdp-blockG"></div><div class="bdp-rotateG_05 bdp-blockG"></div><div class="bdp-rotateG_06 bdp-blockG"></div><div class="bdp-rotateG_07 bdp-blockG"></div><div class="bdp-rotateG_08 bdp-blockG"></div></div>',
        'rotatecircle' => '<div class="bdp-cssload-loader"><div class="bdp-cssload-inner bdp-cssload-one"></div><div class="bdp-cssload-inner bdp-cssload-two"></div><div class="bdp-cssload-inner bdp-cssload-three"></div></div>',
        'overlay-loader' => '<div class="bdp-overlay-loader"><div class="bdp-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
        'circlewave' => '<div class="bdp-circlewave"></div>',
        'cssload-ball' => '<div class="bdp-cssload-ball"></div>',
        'cssheart' => '<div class="bdp-cssload-main"><div class="bdp-cssload-heart"><span class="bdp-cssload-heartL"></span><span class="bdp-cssload-heartR"></span><span class="bdp-cssload-square"></span></div><div class="bdp-cssload-shadow"></div></div>',
        'spinload' => '<div class="bdp-spinload-loading"><i></i><i></i><i></i></div>',
        'bigball' => '<div class="bdp-bigball-container"><div class="bdp-bigball-loading"><i></i><i></i><i></i></div></div>',
        'bubblec' => '<div class="bdp-bubble-container"><div class="bdp-bubble-loading"><i></i><i></i></div></div>',
        'csball' => '<div class="bdp-csball-container"><div class="bdp-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
        'ccball' => '<div class="bdp-ccball-container"><div class="bdp-ccball-loading"><i></i><i></i></div></div>',
        'circulardot' => '<div class="bdp-cssload-wrap"><div class="bdp-circulardot-container"><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span></div></div>',
    );
?>
<div class="wrap">
    <h1>
        <?php
        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            _e('Edit Layout', BLOGDESIGNERPRO_TEXTDOMAIN);
        } else {
            _e('Add New Layout', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        ?>
        <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) { ?>
            <a class="page-title-action" href="?page=add_shortcode">
                <?php _e('Create New Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            </a>
        <?php } ?>
    </h1>
    <?php if (isset($_GET['message']) && $_GET['message'] == 'shortcode_added_msg') { ?>
        <div class="updated notice">
            <p>
                <?php
                _e('Layout added successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                if (isset($bdp_settings['blog_page_display']) && $bdp_settings['blog_page_display'] > 0) {
                    echo ' <a href="' . get_the_permalink($bdp_settings['blog_page_display']) . '" target="_blank">' . __('View Layout', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
                }
                ?>

            </p>
        </div>
        <?php
    }
    if (isset($_GET['message']) && $_GET['message'] == 'shortcode_duplicate_msg') {
        ?>
        <div class="updated notice">
            <p><?php _e('Layout duplicated successfully.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
        </div>
        <?php
    }
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


    if ($bdp_settings['template_name'] == 'cool_horizontal' || $bdp_settings['template_name'] == 'overlay_horizontal') {
        $bdp_settings['pagination_type'] = 'no_pagination';
    }

    if ($bdp_settings['template_name'] == 'brite') {
        $winter_category_txt = __('Choose Tags Background Color', BLOGDESIGNERPRO_TEXTDOMAIN);
        ;
    } else {
        $winter_category_txt = __('Choose Category Background Color', BLOGDESIGNERPRO_TEXTDOMAIN);
    }
    ?>
    <div class="splash-screen"></div>
    <form method="post" id="edit_layout_form" action="" class="bd-form-class bdp-edit-layout">
        <?php
        wp_nonce_field('bdp-shortcode-form-submit', 'bdp-submit-nonce');
        $page = '';
        if (isset($_GET['page']) && $_GET['page'] != '') {
            $page = $_GET['page'];
            ?>
            <input type="hidden" name="originalpage" class="bdporiginalpage" value="<?php echo $page; ?>"><?php }
        ?>
        <div id="poststuff">
            <div class="postbox-container bd-settings-wrappers bd_poststuff">
                <div class="bdp-preview-box" id="bdp-preview-box"></div>
                <div class="bd-header-wrapper">
                    <div class="bd-logo-wrapper pull-left">
                        <h3><?php _e('Blog designer settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                    </div>
                    <div class="pull-right">
                        <a id="bdp-btn-show-submit" title="<?php _e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="show_preview button submit_fixed button-primary">
                            <span><i class="fas fa-check"></i>&nbsp;&nbsp;<?php _e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </a>
                        <a id="bdp-btn-show-preview" title="<?php _e('Show Preview', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="button show_preview button-hero" href="#">
                            <span><i class="fas fa-eye"></i>&nbsp;&nbsp;<?php _e('Preview', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </a>
                        <input type="submit" style="display:none;" class="button-primary bloglyout_savebtn button" name="savedata" value="<?php esc_attr_e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                    </div>
                </div>
                <div class="bd-menu-setting">
                    <?php
                    $bdpgeneral_class = $dbptimeline_class = $bdpstandard_class = $bdptitle_class = $bdpcontent_class = $bdpmedia_class = $bdpslider_class = $bdpfilter_class = $bdpcustomreadmore_class = $bdpsocial_class = '';
                    $bdpgeneral_class_show = $dbptimeline_class_show = $bdpstandard_class_show = $bdptitle_class_show = $bdpcontent_class_show = $bdpmedia_class_show = $bdpslider_class_show = $bdpfilter_class_show = $bdpcustomreadmore_class_show = $bdpsocial_class_show = '';
                    if (bdp_postbox_classes('bdpgeneral', $page)) {
                        $bdpgeneral_class = 'class="bd-active-tab"';
                        $bdpgeneral_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpstandard', $page)) {
                        $bdpstandard_class = 'class="bd-active-tab"';
                        $bdpstandard_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdptitle', $page)) {
                        $bdptitle_class = 'class="bd-active-tab"';
                        $bdptitle_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpcontent', $page)) {
                        $bdpcontent_class = 'class="bd-active-tab"';
                        $bdpcontent_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpmedia', $page)) {
                        $bdpmedia_class = 'class="bd-active-tab"';
                        $bdpmedia_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('dbptimeline', $page)) {
                        $dbptimeline_class = 'class="bd-active-tab"';
                        $dbptimeline_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpslider', $page)) {
                        $bdpslider_class = 'class="bd-active-tab"';
                        $bdpslider_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpfilter', $page)) {
                        $bdpfilter_class = 'class="bd-active-tab"';
                        $bdpfilter_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpcustomreadmore', $page)) {
                        $bdpcustomreadmore_class = 'class="bd-active-tab"';
                        $bdpcustomreadmore_class_show = 'style="display: block;"';
                    } elseif (bdp_postbox_classes('bdpsocial', $page)) {
                        $bdpsocial_class = 'class="bd-active-tab"';
                        $bdpsocial_class_show = 'style="display: block;"';
                    } else {
                        $bdpgeneral_class = 'class="bd-active-tab"';
                        $bdpgeneral_class_show = 'style="display: block;"';
                    }
                    ?>
                    <ul class="bd-setting-handle">
                        <li data-show="bdpgeneral" <?php echo $bdpgeneral_class; ?>>
                            <i class="fas fa-cog"></i>
                            <span><?php _e('General Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpstandard" <?php echo $bdpstandard_class; ?>>
                            <i class="fas fa-gavel"></i>
                            <span><?php _e('Standard Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdptitle" <?php echo $bdptitle_class; ?>>
                            <i class="fas fa-text-width"></i>
                            <span><?php _e('Post Title Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpcontent" <?php echo $bdpcontent_class; ?>>
                            <i class="far fa-file-alt"></i>
                            <span><?php _e('Post Content Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpmedia" <?php echo $bdpmedia_class; ?>>
                            <i class="far fa-image"></i>
                            <span><?php _e('Media Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="dbptimeline" <?php echo $dbptimeline_class; ?>>
                            <i class="far fa-clock"></i>
                            <span><?php _e('Horizontal Timeline Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpslider" <?php echo $bdpslider_class; ?>>
                            <i class="fas fa-sliders-h"></i>
                            <span><?php _e('Slider Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpfilter" <?php echo $bdpfilter_class; ?>>
                            <i class="fas fa-filter"></i>
                            <span><?php _e('Filter Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpcustomreadmore" <?php echo $bdpcustomreadmore_class; ?>>
                            <i class="fas fa-plus"></i>
                            <span><?php _e('Custom Read More Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                        <li data-show="bdpsocial" <?php echo $bdpsocial_class; ?>>
                            <i class="fas fa-share-alt"></i>
                            <span><?php _e('Social Share Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        </li>
                    </ul>
                </div>
                <div id="bdpgeneral" class="postbox postbox-with-fw-options" <?php echo $bdpgeneral_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <h3 class="bdp-table-title"><?php _e('Select Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-left">
                                    <p class="bdp-margin-bottom-50"><?php _e('Select your favorite layout from 45 powerful blog layouts.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                    <p class="bdp-margin-bottom-30"><b><?php _e('Current Template:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b> &nbsp;&nbsp;
                                        <span class="bdp-template-name">
                                        <?php
                                        if (isset($bdp_settings['template_name'])) {
                                            echo $tempate_list[$bdp_settings['template_name']]['template_name'];
                                        } else {
                                            _e('Classical Template', BLOGDESIGNERPRO_TEXTDOMAIN);
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
                                               if (isset($bdp_settings['template_name'])) {
                                                   echo $bdp_settings['template_name'];
                                               }
                                               ?>" name="template_name">

                                    </div>
                                    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) { ?>
                                        <input type="submit" class="bdp-reset-data" name="resetdata" value="<?php esc_attr_e('Reset Layout Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" /><?php
                                    }
                                    ?>
                                </div>
                                <div class="bdp-right">
                                    <div class="select_button_upper_div">
                                        <div class="bdp_selected_template_image">
                                            <div <?php
                                            if (isset($bdp_settings['template_name']) && empty($bdp_settings['template_name'])) {
                                                echo ' class="bdp_no_template_found"';
                                            }
                                            ?>>
                                                    <?php
                                                    if (isset($bdp_settings['template_name']) && !empty($bdp_settings['template_name'])) {
                                                        $image_name = $bdp_settings['template_name'] . '.jpg';
                                                        ?>
                                                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/layouts/' . $image_name; ?>" alt="<?php
                                                    if (isset($bdp_settings['template_name'])) {
                                                        echo $tempate_list[$bdp_settings['template_name']]['template_name'];
                                                    }
                                                    ?>" title="<?php
                                                         if (isset($bdp_settings['template_name'])) {
                                                             echo $tempate_list[$bdp_settings['template_name']]['template_name'];
                                                         }
                                                         ?>" />
                                                    <label id="template_select_name"><?php
                                                        if (isset($bdp_settings['template_name'])) {
                                                            echo $tempate_list[$bdp_settings['template_name']]['template_name'];
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

                                    <div class="bdp-setting-description bdp-content-settings-info">
                                        <b class="note"><?php _e("Caution", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b> &nbsp;
                                        <?php _e('This template is not providing post content settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
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
                                    $color_template = isset($bdp_settings['template_name']) ? $bdp_settings['template_name'] : 'classical';
                                    $bdp_color_preset = isset($bdp_settings['bdp_color_preset']) ? $bdp_settings['bdp_color_preset'] : $color_template . '_default';
                                    $template_color_preset = array(
                                        'boxy' => array(
                                            'boxy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#239190,template_fthovercolor:#ffffff,template_titlecolor:#239190,template_titlehovercolor:#333333,template_titlebackcolor:#ffffff,template_contentcolor:#555555,template_readmorecolor:#ffffff,template_readmorebackcolor:#239190',
                                                'display_value' => '#239190,#ffffff,#239190,#555555'
                                            ),
                                            'boxy_persian-red' => array(
                                                'preset_name' => __('Persian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#dd3333,template_fthovercolor:#ffffff,template_titlecolor:#484848,template_titlehovercolor:#dd3333,template_titlebackcolor:#ffffff,template_contentcolor:#7b7b7b,template_readmorecolor:#ffffff,template_readmorebackcolor:#535353',
                                                'display_value' => '#dd3333,#ffffff,#dd3333,#484848'
                                            ),
                                            'boxy_mariner' => array(
                                                'preset_name' => __('Mariner', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EAEDF6,template_ftcolor:#465BAC,template_fthovercolor:#ffffff,template_titlecolor:#465BAC,template_titlehovercolor:#484848,template_titlebackcolor:#eaedf6,template_contentcolor:#7b7b7b,template_readmorecolor:#465BAC,template_readmorebackcolor:#EAEDF6',
                                                'display_value' => '#465BAC,#EAEDF6,#465BAC,#484848'
                                            ),
                                            'boxy_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FFEAF1,template_ftcolor:#FA336C,template_fthovercolor:#ffffff,template_titlecolor:#FA336C,template_titlehovercolor:#484848,template_titlebackcolor:#FFEAF1,template_contentcolor:#7b7b7b,template_readmorecolor:#FA336C,template_readmorebackcolor:#FFEAF1',
                                                'display_value' => '#FA336C,#FFEAF1,#FA336C,#484848'
                                            ),
                                            'boxy_flamenco' => array(
                                                'preset_name' => __('Flamenco', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FFF3ED,template_ftcolor:#683C6F,template_fthovercolor:#ffffff,template_titlecolor:#683C6F,template_titlehovercolor:#484848,template_titlebackcolor:#FFF3ED,template_contentcolor:#7b7b7b,template_readmorecolor:#683C6F,template_readmorebackcolor:#FFF3ED',
                                                'display_value' => '#683C6F,#FFF3ED,#683C6F,#484848'
                                            ),
                                            'boxy_finch' => array(
                                                'preset_name' => __('Finch', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EFF0EB,template_ftcolor:#75815B,template_fthovercolor:#ffffff,template_titlecolor:#75815B,template_titlehovercolor:#484848,template_titlebackcolor:#EFF0EB,template_contentcolor:#7b7b7b,template_readmorecolor:#75815B,template_readmorebackcolor:#EFF0EB',
                                                'display_value' => '#75815B,#EFF0EB,#75815B,#484848'
                                            )
                                        ),
                                        'boxy-clean' => array(
                                            'boxy-clean_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#15506F,template_bgcolor:#ffffff,template_bghovercolor:#DFEDF1,template_ftcolor:#15506F,template_fthovercolor:#555555,template_titlecolor:#15506F,template_titlehovercolor:#DFEDF1,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#15506F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#15506F,beforeloop_readmorehovercolor:#15506F,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#15506F,#DFEDF1,#555555,#999999'
                                            ),
                                            'boxy-clean_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_bghovercolor:#EDE1E7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#7D194F,#974772,#555555,#999999'
                                            ),
                                            'boxy-clean_roof_terracotta' => array(
                                                'preset_name' => __('Roof Terracotta', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#B06F6D,template_bgcolor:#ffffff,template_bghovercolor:#F1E7E7,template_ftcolor:#555555,template_fthovercolor:#B06F6D,template_titlecolor:#9C4B48,template_titlehovercolor:#B06F6D,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#B06F6D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#B06F6D,beforeloop_readmorehovercolor:#B06F6D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#9C4B48,#B06F6D,#555555,#999999'
                                            ),
                                            'boxy-clean_lemon-ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#CEBF59,template_bgcolor:#ffffff,template_bghovercolor:#F0EEE4,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#CEBF59,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                            'boxy-clean_finch' => array(
                                                'preset_name' => __('Finch', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#93A564,template_bgcolor:#ffffff,template_bghovercolor:#EDEDE9,template_ftcolor:#555555,template_fthovercolor:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#788F3D,#93A564,#555555,#999999'
                                            ),
                                            'boxy-clean_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#6D4657,template_bgcolor:#ffffff,template_bghovercolor:#E7E1E3,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D4657,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#49182D,#6D4657,#555555,#999999'
                                            )
                                        ),
                                        'brit_co' => array(
                                            'brit_co_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#222222,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#222222,#3E91AD,#555555,#999999'
                                            ),
                                            'brit_co_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#F18547,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#999999'
                                            ),
                                            'brit_co_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'brit_co_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#A39D5A,template_titlecolor:#8C8431,template_titlehovercolor:#A39D5A,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C8431,#A39D5A,#555555,#999999'
                                            ),
                                            'brit_co_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#999999'
                                            ),
                                            'brit_co_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#AE742A,#BE9055,#555555,#999999'
                                            ),
                                        ),
                                        'brite' => array(
                                            'brite_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff;template_ftcolor:#555555,template_fthovercolor:#0e83cd,winter_category_color:#0e83cd,template_titlecolor:#222222,template_titlehovercolor:#0e83cd,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#0e83cd,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0e83cd,beforeloop_readmorehovercolor:#0e83cd,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0e83cd,#222222,#555555,#545454'
                                            ),
                                            'brite_mountain_meadow' => array(
                                                'preset_name' => __('Mountain Meadow', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff;template_ftcolor:#545454,template_fthovercolor:#5dbabc,winter_category_color:#21be85,template_titlecolor:#222222,template_titlehovercolor:#21be85,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#21be85,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#21be85,beforeloop_readmorehovercolor:#21be85,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#21be85,#5dbabc,#222222,#545454'
                                            ),
                                            'brite_brandy_punch' => array(
                                                'preset_name' => __('Brandy Punch', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff;template_ftcolor:#545454,template_fthovercolor:#c27938,winter_category_color:#c27938,template_titlecolor:#c27938,template_titlehovercolor:#222222,template_contentcolor:#545454,template_readmorecolor:#ffffff,template_readmorebackcolor:#c27938,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#c27938,beforeloop_readmorehovercolor:#c27938,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#c27938,#222222,#555555,#545454'
                                            ),
                                        ),
                                        'chapter' => array(
                                            'chapter_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#e9181d,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e9181d,beforeloop_readmorehovercolor:#e9181d,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#e9181d,#000000,#ffffff,#ffffff'
                                            ),
                                            'chapter_curious_blue' => array(
                                                'preset_name' => __('Curious Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#257fb4,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#e1edf5,template_titlehovercolor:#ffffff,template_contentcolor:#e1edf5,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#257fb4,beforeloop_readmorehovercolor:#257fb4,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#257fb4,#000000,#e1edf5,#ffffff'
                                            ),
                                            'chapter_buddha_gold' => array(
                                                'preset_name' => __('Buddha Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#c4a618,template_bgcolor:#342b06,template_ftcolor:#f7f3e1,template_fthovercolor:#f7f3e1,template_titlecolor:#f0e7c3,template_titlehovercolor:#f7f3e1,template_contentcolor:#f7f3e1,template_readmorecolor:#f7f3e1,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#c4a618,beforeloop_readmorehovercolor:#c4a618,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#c4a618,#342b06,#f0e7c3,#f7f3e1'
                                            ),
                                            'chapter_sea_green' => array(
                                                'preset_name' => __('Sea Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#1ba3ab,template_bgcolor:#051b1d,template_ftcolor:#e1f3f4,template_fthovercolor:#e1f3f4,template_titlecolor:#c3e7e9,template_titlehovercolor:#e1f3f4,template_contentcolor:#e1f3f4,template_readmorecolor:#e1f3f4,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#1ba3ab,beforeloop_readmorehovercolor:#1ba3ab,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#1ba3ab,#051b1d,#c3e7e9,#e1f3f4'
                                            ),
                                            'chapter_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#0E663C,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0E663C,beforeloop_readmorehovercolor:#0E663C,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E663C,#000000,#ffffff,#ffffff'
                                            ),
                                            'chapter_madras' => array(
                                                'preset_name' => __('Madras', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#493917,template_bgcolor:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ffffff,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#000000,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#493917,beforeloop_readmorehovercolor:#493917,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#493917,#000000,#ffffff,#ffffff'
                                            ),
                                        ),
                                        'cover' => array(
                                            'cover_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#f2f2f2,template_bgcolor:#f9f9f9,template_ftcolor:#fb6262,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#fb6262,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#fb6262,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#fb6262',
                                                'display_value' => '#f2f2f2,#fb6262,#333333,#666666'
                                            ),
                                            'cover_dodger_blue' => array(
                                                'preset_name' => __('Dodger Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E2F1FC,template_bgcolor:#f9f9f9,template_ftcolor:#2A97EA,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#2A97EA,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#2A97EA,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#2A97EA',
                                                'display_value' => '#E2F1FC,#2A97EA,#333333,#666666'
                                            ),
                                            'cover_west_side' => array(
                                                'preset_name' => __('West Side', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#fcf2e9,template_bgcolor:#f9f9f9,template_ftcolor:#EA7D2A,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#EA7D2A,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#EA7D2A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#EA7D2A',
                                                'display_value' => '#fcf2e9,#EA7D2A,#333333,#666666'
                                            ),
                                            'cover_salem' => array(
                                                'preset_name' => __('Salem', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#e8f3ed,template_bgcolor:#f9f9f9,template_ftcolor:#198c4b,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#198c4b,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#198c4b,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#198c4b',
                                                'display_value' => '#e8f3ed,#198c4b,#333333,#666666'
                                            ),
                                            'cover_flame_red' => array(
                                                'preset_name' => __('Flame Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#f3e8e8,template_bgcolor:#f9f9f9,template_ftcolor:#8c1920,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#8c1920,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#8c1920,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8c1920',
                                                'display_value' => '#f3e8e8,#8c1920,#333333,#666666'
                                            ),
                                            'cover_mulled_wine' => array(
                                                'preset_name' => __('Mulled Wine', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#f3e8e8,template_bgcolor:#f9f9f9,template_ftcolor:#544c6a,template_fthovercolor:#666666,template_titlecolor:#333333,template_titlehovercolor:#544c6a,template_titlebackcolor:,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#666666,template_readmore_hover_backcolor:#544c6a,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#666666,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#544c6a',
                                                'display_value' => '#ededf0,#544c6a,#333333,#666666'
                                            ),
                                        ),
                                        'classical' => array(
                                            'classical_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#2a97ea,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2a97ea,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#2a97ea,beforeloop_readmorecolor:#2a97ea,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#2a97ea',
                                                'display_value' => '#2a97ea,#222222,#555555,#999999'
                                            ),
                                            'classical_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E91AD,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E91AD',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'classical_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E8563,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E8563,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E8563',
                                                'display_value' => '#0E663C,#3E8563,#555555,#999999'
                                            ),
                                            'classical_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#6D4657,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#6D4657,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#6D4657',
                                                'display_value' => '#49182D,#6D4657,#555555,#999999'
                                            ),
                                            'classical_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#CEBF59,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#CEBF59,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#CEBF59',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                            'classical_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#F4ECE2,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F4ECE2,template_contentcolor:#999999,template_readmorecolor:#BE9055,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#BE9055,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#BE9055',
                                                'display_value' => '#AE742A,#BE9055,#555555,#999999'
                                            ),
                                        ),
                                        'clicky' => array(
                                            'clicky_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#adadad,template_fthovercolor:#444444,template_titlecolor:#5b7090,template_titlehovercolor:#000000,template_titlebackcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#5b7090,template_readmorebackcolor:#ffffff,template_readmore_hover_backcolor:#e7e7e7,beforeloop_readmorecolor:#5b7090,beforeloop_readmorebackcolor:#ffffff,beforeloop_readmorehovercolor:#5b7090,beforeloop_readmorehoverbackcolor:#e7e7e7',
                                                'display_value' => '#ffffff,#5b7090,#444444,#000000'
                                            ),
                                            'clicky_limeade' => array(
                                                'preset_name' => __('Limeade', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E9F1E2,template_ftcolor:#AECA91,template_fthovercolor:#324E15,template_titlecolor:#629928,template_titlehovercolor:#20320E,template_titlebackcolor:#E9F1E2,template_contentcolor:#324E15,template_readmorecolor:#629928,template_readmorebackcolor:#E9F1E2,template_readmore_hover_backcolor:#AECA91,beforeloop_readmorecolor:#629928,beforeloop_readmorebackcolor:#E9F1E2,beforeloop_readmorehovercolor:#629928,beforeloop_readmorehoverbackcolor:#AECA91',
                                                'display_value' => '#E9F1E2,#629928,#324E15,#20320E'
                                            ),
                                            'clicky_violet' => array(
                                                'preset_name' => __('Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F1E5FD,template_ftcolor:#CA9CFD,template_fthovercolor:#4E1F81,template_titlecolor:#983DFB,template_titlehovercolor:#321452,template_titlebackcolor:#F1E5FD,template_contentcolor:#4E1F81,template_readmorecolor:#983DFB,template_readmorebackcolor:#F1E5FD,template_readmore_hover_backcolor:#CA9CFD,beforeloop_readmorecolor:#983DFB,beforeloop_readmorebackcolor:#F1E5FD,beforeloop_readmorehovercolor:#983DFB,beforeloop_readmorehoverbackcolor:#CA9CFD',
                                                'display_value' => '#F1E5FD,#983DFB,#4E1F81,#321452'
                                            ),
                                            'clicky_punga' => array(
                                                'preset_name' => __('Punga', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E7E7E4,template_ftcolor:#A6A195,template_fthovercolor:#2A2518,template_titlecolor:#51492F,template_titlehovercolor:#1B180F,template_titlebackcolor:#E7E7E4,template_contentcolor:#2A2518,template_readmorecolor:#51492F,template_readmorebackcolor:#E7E7E4,template_readmore_hover_backcolor:#A6A195,beforeloop_readmorecolor:#51492F,beforeloop_readmorebackcolor:#E7E7E4,beforeloop_readmorehovercolor:#51492F,beforeloop_readmorehoverbackcolor:#A6A195',
                                                'display_value' => '#E7E7E4,#51492F,#2A2518,#1B180F'
                                            ),
                                            'clicky_radical' => array(
                                                'preset_name' => __('Radical', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDE7E9,template_ftcolor:#F9A1A9,template_fthovercolor:#7C242C,template_titlecolor:#F34656,template_titlehovercolor:#4F171C,template_titlebackcolor:#FDE7E9,template_contentcolor:#7C242C,template_readmorecolor:#F34656,template_readmorebackcolor:#FDE7E9,template_readmore_hover_backcolor:#F9A1A9,beforeloop_readmorecolor:#F34656,beforeloop_readmorebackcolor:#FDE7E9,beforeloop_readmorehovercolor:#F34656,beforeloop_readmorehoverbackcolor:#F9A1A9',
                                                'display_value' => '#FDE7E9,#F34656,#7C242C,#4F171C'
                                            ),
                                            'clicky_goldenrod' => array(
                                                'preset_name' => __('Goldenrod', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F4EDDD,template_ftcolor:#D7BD81,template_fthovercolor:#5B4204,template_titlecolor:#B28007,template_titlehovercolor:#3A2A02,template_titlebackcolor:#F4EDDD,template_contentcolor:#5B4204,template_readmorecolor:#B28007,template_readmorebackcolor:#F4EDDD,template_readmore_hover_backcolor:#D7BD81,beforeloop_readmorecolor:#B28007,beforeloop_readmorebackcolor:#F4EDDD,beforeloop_readmorehovercolor:#B28007,beforeloop_readmorehoverbackcolor:#D7BD81',
                                                'display_value' => '#F4EDDD,#B28007,#5B4204,#3A2A02'
                                            ),
                                        ),
                                        'cool_horizontal' => array(
                                            'cool_horizontal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#555555,template_fthovercolor:#F16C20,template_titlecolor:#F16C20,template_titlehovercolor:#333333,template_readmorecolor:#F16C20,template_readmorebackcolor:#ffffff,template_contentcolor:#999999,beforeloop_readmorecolor:#F16C20,beforeloop_readmorebackcolor:#555555,beforeloop_readmorehovercolor:#F16C20,beforeloop_readmorehoverbackcolor:#555555',
                                                'display_value' => '#F16C20,#333333,#555555,#999999'
                                            ),
                                            'cool_horizontal_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#e21130,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999',
                                                'display_value' => '#e21130,#333333,#666666,#444444'
                                            ),
                                            'cool_horizontal_blue' => array(
                                                'preset_name' => __('Chetwode Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#6C71C3,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999',
                                                'display_value' => '#6C71C3,#333333,#666666,#444444'
                                            ),
                                            'cool_horizontal_java' => array(
                                                'preset_name' => __('Java', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#29A198,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999',
                                                'display_value' => '#29A198,#333333,#666666,#444444'
                                            ),
                                            'cool_horizontal_curious_blue' => array(
                                                'preset_name' => __('Curious Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#268BD3,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999',
                                                'display_value' => '#268BD3,#333333,#666666,#444444'
                                            ),
                                            'cool_horizontal_olive' => array(
                                                'preset_name' => __('Olive', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#666666,template_fthovercolor:#333333,template_titlecolor:#869901,template_titlehovercolor:#666666,template_readmorecolor:#444444,template_readmorebackcolor:#ffffff,template_contentcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#444444,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#999999',
                                                'display_value' => '#869901,#333333,#666666,#444444'
                                            ),
                                        ),
                                        'crayon_slider' => array(
                                            'crayon_slider_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#F5C034,template_fthovercolor:#ffffff,winter_category_color:#F5C034,template_titlecolor:#ffffff,template_titlehovercolor:#F5C034,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#F5C034,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#F5C034,beforeloop_readmorehovercolor:#F5C034,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#F5C034,#ffffff'
                                            ),
                                            'crayon_slider_cerise' => array(
                                                'preset_name' => __('Cerise', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ff00ae,winter_category_color:#ff00ae,template_titlecolor:#ffffff,template_titlehovercolor:#ff00ae,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#ff00ae,template_readmorebackcolor:#00809D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ff00ae,beforeloop_readmorehovercolor:#ff00ae,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#ff00ae,#ffffff'
                                            ),
                                            'crayon_slider_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#FA336C,winter_category_color:#FA336C,template_titlecolor:#ffffff,template_titlehovercolor:#FA336C,,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#FA336C,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FA336C,beforeloop_readmorehovercolor:#FA336C,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#FA336C,#ffffff'
                                            ),
                                            'crayon_slider_eminence' => array(
                                                'preset_name' => __('Eminence', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#683C6F,winter_category_color:#683C6F,template_titlecolor:#ffffff,template_titlehovercolor:#683C6F,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#683C6F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#683C6F,beforeloop_readmorehovercolor:#683C6F,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#683C6F,#ffffff'
                                            ),
                                            'crayon_slider_persian_red' => array(
                                                'preset_name' => __('Persian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#DC3330,winter_category_color:#DC3330,template_titlecolor:#ffffff,template_titlehovercolor:#DC3330,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#DC3330,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#DC3330,beforeloop_readmorehovercolor:#DC3330,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#DC3330,#ffffff'
                                            ),
                                            'crayon_slider_fun-green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#0E663C,winter_category_color:#0E663C,template_titlecolor:#ffffff,template_titlehovercolor:#0E663C,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#0E663C,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0E663C,beforeloop_readmorehovercolor:#0E663C,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#000000,#ffffff,#0E663C,#ffffff'
                                            )
                                        ),
                                        'deport' => array(
                                            'deport_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#92A660,template_fthovercolor:#555555,deport_dashcolor:#92A660,template_titlecolor:#222222,template_titlehovercolor:#92A660,template_readmorecolor:#ffffff,template_readmorebackcolor:#92A660,template_contentcolor:#777777,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#92A660,beforeloop_readmorehovercolor:#92A660,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#92A660,#222222,#555555,#777777'
                                            ),
                                            'deport_catalina_blue' => array(
                                                'preset_name' => __('Catalina Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#495F85,deport_dashcolor:#495F85,template_titlecolor:#1B3766,template_titlehovercolor:#495F85,template_readmorecolor:#ffffff,template_readmorebackcolor:#495F85,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#495F85,beforeloop_readmorehovercolor:#495F85,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#1B3766,#495F85,#555555,#999999'
                                            ),
                                            'deport_fun-green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#3E8563,template_fthovercolor:#999999,deport_dashcolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E663C,#3E8563,#555555,#999999'
                                            ),
                                            'deport_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#ED4961,deport_dashcolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#999999'
                                            ),
                                            'deport_mckenzie' => array(
                                                'preset_name' => __('McKenzie', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#A2855B,deport_dashcolor:#A2855B,template_titlecolor:#8B6632,template_titlehovercolor:#A2855B,template_readmorecolor:#ffffff,template_readmorebackcolor:#A2855B,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A2855B,beforeloop_readmorehovercolor:#A2855B,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8B6632,#A2855B,#555555,#999999'
                                            ),
                                            'deport_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#999999,template_fthovercolor:#6D4657,deport_dashcolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D4657,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#49182D,#6D4657,#555555,#999999'
                                            )
                                        ),
                                        'easy_timeline' => array(
                                            'easy_timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#C58A3C,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#C58A3C,template_readmorecolor:#C58A3C,template_readmorebackcolor:#ffffff,template_contentcolor:#555555',
                                                'display_value' => '#ffffff,#C58A3C,#222222,#555555'
                                            ),
                                            'easy_timeline_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E21130,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#E21130,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff',
                                                'display_value' => '#E21130,#ffffff,#f1f1f1,#E21130'
                                            ),
                                            'easy_timeline_flamenco' => array(
                                                'preset_name' => __('Flamenco', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E18942,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#E18942,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff',
                                                'display_value' => '#E18942,#ffffff,#f1f1f1,#E18942'
                                            ),
                                            'easy_timeline_jagger' => array(
                                                'preset_name' => __('Jagger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3D3242,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#3D3242,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff',
                                                'display_value' => '#3D3242,#ffffff,#f1f1f1,#3D3242'
                                            ),
                                            'easy_timeline_camelot' => array(
                                                'preset_name' => __('Camelot', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#7A3E48,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#7A3E48,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff',
                                                'display_value' => '#7A3E48,#ffffff,#f1f1f1,#7A3E48'
                                            ),
                                            'easy_timeline_sundance' => array(
                                                'preset_name' => __('Sundance', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#C59F4A,template_ftcolor:#ffffff,template_fthovercolor:#f1f1f1,template_titlecolor:#ffffff,template_titlehovercolor:#f1f1f1,template_readmorecolor:#C59F4A,template_readmorebackcolor:#ffffff,template_contentcolor:#ffffff',
                                                'display_value' => '#C59F4A,#ffffff,#f1f1f1,#C59F4A'
                                            ),
                                        ),
                                        'elina' => array(
                                            'elina_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#3E91AD,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#3E91AD,template_readmorecolor:#3E91AD,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#3E91AD,#222222,#555555,#666666'
                                            ),
                                            'elina_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDEEF1,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,template_titlehovercolor:#E84159,template_readmorecolor:#E84159,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E84159,beforeloop_readmorehovercolor:#E84159,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E21130,#E84159,#555555,#666666'
                                            ),
                                            'elina_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_readmorecolor:#67704E,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#666666'
                                            ),
                                            'elina_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_readmorecolor:#BE9055,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#AE742A,#BE9055,#555555,#666666'
                                            ),
                                            'elina_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F3F0F1,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_readmorecolor:#6D4657,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D4657,beforeloop_readmorehovercolor:#6D4657,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#49182D,#6D4657,#555555,#666666'
                                            ),
                                            'elina_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#1B3766,template_titlehovercolor:#A381BB,template_readmorecolor:#A381BB,template_readmorebackcolor:#666666,template_contentcolor:#666666,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#1B3766,#A381BB,#555555,#666666'
                                            ),
                                        ),
                                        'evolution' => array(
                                            'evolution_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_alterbgcolor:#ffffff,template_ftcolor:#2E6480,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2E6480,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#2E6480,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2E6480,beforeloop_readmorehovercolor:#2E6480,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#2E6480,#222222,#555555,#333333'
                                            ),
                                            'evolution_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EDE1E7,template_alterbgcolor:#E1EDE7,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#7D194F,#974772,#555555,#333333'
                                            ),
                                            'evolution_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E5E7E1,template_alterbgcolor:#E3E1E7,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#333333'
                                            ),
                                            'evolution_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_alterbgcolor:#E1FCF8,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#EA1A3A,#EE4861,#555555,#333333'
                                            ),
                                            'evolution_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0E2,template_alterbgcolor:#E2EDFA,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#333333'
                                            ),
                                            'evolution_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0E9F4,template_alterbgcolor:#EDF4E9,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,template_contentcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#333333'
                                            ),
                                        ),
                                        'explore' => array(
                                            'explore_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#000000,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#e0e0e0,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#000000,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'explore_mariner' => array(
                                                'preset_name' => __('Mariner', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC',
                                                'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'explore_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#FA336C,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#FA336C,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#FA336C',
                                                'display_value' => '#FA336C,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'explore_finch' => array(
                                                'preset_name' => __('Finch', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#75815B,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#75815B,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#75815B',
                                                'display_value' => '#75815B,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'explore_vivid_gamboge' => array(
                                                'preset_name' => __('Vivid Gamboge', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#f99900,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#f99900,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f999000',
                                                'display_value' => '#f99900,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'explore_moderate-orange' => array(
                                                'preset_name' => __('Moderate Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#8B6632,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#8B6632,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8B6632',
                                                'display_value' => '#8B6632,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                        ),
                                        'famous' => array(
                                            'famous_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#f42887,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#f42887,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f42887,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f42887',
                                                'display_value' => '#ffffff,#f42887,#333333,#777777'
                                            ),
                                            'famous_vivid_gamboge' => array(
                                                'preset_name' => __('Vivid Gamboge', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#fef4e5,template_ftcolor:#f99900,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#f99900,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f99900,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f99900',
                                                'display_value' => '#fef4e5,#f99900,#333333,#777777'
                                            ),
                                            'famous_jagger' => array(
                                                'preset_name' => __('Jagger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#3d3242,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3d3242,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3d3242,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#3d3242',
                                                'display_value' => '#ebeaec,#3d3242,#333333,#777777'
                                            ),
                                            'famous_timber_green' => array(
                                                'preset_name' => __('Timber Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#374232,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#374232,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#374232,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#374232',
                                                'display_value' => '#ebecea,#374232,#333333,#777777'
                                            ),
                                            'famous_barossa' => array(
                                                'preset_name' => __('Barossa', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ebeaec,template_ftcolor:#423237,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#423237,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#423237,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#423237',
                                                'display_value' => '#eceaeb,#423237,#333333,#777777'
                                            ),
                                            'famous_blumine' => array(
                                                'preset_name' => __('Blumine', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#e9eeef,template_ftcolor:#2a5b66,template_fthovercolor:#333333,template_titlecolor:#777777,template_titlehovercolor:#333333,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#2a5b66,template_readmore_hover_backcolor:#333333,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2a5b66,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#2a5b66',
                                                'display_value' => '#e9eeef,#2a5b66,#333333,#777777'
                                            ),
                                        ),
                                        'fairy' => array(
                                            'fairy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#f7f7f7,template_bgcolor:#ffffff,template_ftcolor:#333333,template_fthovercolor:#888888,template_titlecolor:#ffffff,template_titlehovercolor:#e5d3d3,template_titlebackcolor:,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#333333,template_readmore_hover_backcolor:#888888,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#333333,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#888888',
                                                'display_value' => '#f7f7f7,#888888,#333333,#000000'
                                            ),
                                            'fairy_tangerine' => array(
                                                'preset_name' => __('Tangerine', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#f8df9f,template_bgcolor:#fdf7e7,template_ftcolor:#171101,template_fthovercolor:#473505,template_titlecolor:#fdf7e7,template_titlehovercolor:#f8df9f,template_titlebackcolor:,template_contentcolor:#171101,template_readmorecolor:#fdf7e7,template_readmorebackcolor:#171101,template_readmore_hover_backcolor:#efb828,beforeloop_readmorecolor:#fdf7e7,beforeloop_readmorebackcolor:#171101,beforeloop_readmorehovercolor:#fdf7e7,beforeloop_readmorehoverbackcolor:#efb828',
                                                'display_value' => '#f8df9f,#efb828,#473505,#171101'
                                            ),
                                            'fairy_prussian' => array(
                                                'preset_name' => __('Prussian', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#99a8ba,template_bgcolor:#e5e9ed,template_ftcolor:#000308,template_fthovercolor:#000b19,template_titlecolor:#e5e9ed,template_titlehovercolor:#99a8ba,template_titlebackcolor:,template_contentcolor:#000308,template_readmorecolor:#e5e9ed,template_readmorebackcolor:#000308,template_readmore_hover_backcolor:#193b65,beforeloop_readmorecolor:#e5e9ed,beforeloop_readmorebackcolor:#000308,beforeloop_readmorehovercolor:#e5e9ed,beforeloop_readmorehoverbackcolor:#193b65',
                                                'display_value' => '#99a8ba,#193b65,#000b19,#000308'
                                            ),
                                        ),
                                        'glamour' => array(
                                            'glamour_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#f5c034,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#f5c034,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#f5c034,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#f5c034,#333333,#2d2d2d,#000000'
                                            ),
                                            'glamour_aqua' => array(
                                                'preset_name' => __('Aqua', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#00FFE9,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#00FFE9,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#00FFE9,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#00FFE9,#333333,#2d2d2d,#000000'
                                            ),
                                            'glamour_harlequin' => array(
                                                'preset_name' => __('Harlequin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#43FF00,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#43FF00,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#43FF00,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#43FF00,#333333,#2d2d2d,#000000'
                                            ),
                                            'glamour_red' => array(
                                                'preset_name' => __('Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#FF0000,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#FF0000,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#FF0000,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#FF0000,#333333,#2d2d2d,#000000'
                                            ),
                                            'glamour_spring_green' => array(
                                                'preset_name' => __('Spring Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#00FF80,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#00FF80,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#00FF80,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#00FF80,#333333,#2d2d2d,#000000'
                                            ),
                                            'glamour_pale_turquoise' => array(
                                                'preset_name' => __('Pale Turquoise', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#ACFEFF,template_fthovercolor:#ffffff,template_titlecolor:#ffffff,template_titlehovercolor:#ACFEFF,template_titlebackcolor:,template_contentcolor:#ffffff,template_readmorecolor:#ACFEFF,template_readmorebackcolor:#2d2d2d,template_readmore_hover_backcolor:#000000,beforeloop_readmorecolor:#2d2d2d,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#2d2d2d,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#ACFEFF,#333333,#2d2d2d,#000000'
                                            ),
                                        ),
                                        'glossary' => array(
                                            'glossary_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#E84159,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#E84159,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#E84159,template_readmorecolor:#ffffff,template_readmorebackcolor:#E84159,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E84159,beforeloop_readmorehovercolor:#E84159,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E84159,#222222,#555555,#999999'
                                            ),
                                            'glossary_madras' => array(
                                                'preset_name' => __('Madras', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D6145,template_titlecolor:#493917,template_titlehovercolor:#6D6145,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#6D6145,template_readmorecolor:#ffffff,template_readmorebackcolor:#6D6145,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#6D6145,beforeloop_readmorehovercolor:#6D6145,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#493917,#6D6145,#555555,#999999'
                                            ),
                                            'glossary_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_content_hovercolor:#974772,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#7D194F,#974772,#555555,#999999'
                                            ),
                                            'glossary_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#6D6145,template_titlebackcolor:#E5E7E1,template_contentcolor:#999999,template_content_hovercolor:#67704E,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'glossary_peru_tan' => array(
                                                'preset_name' => __('Peru Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EDE5E1,template_ftcolor:#555555,template_fthovercolor:#916748,template_titlecolor:#75411A,template_titlehovercolor:#916748,template_titlebackcolor:#EDE5E1,template_contentcolor:#999999,template_content_hovercolor:#916748,template_readmorecolor:#ffffff,template_readmorebackcolor:#916748,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#916748,beforeloop_readmorehovercolor:#916748,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#75411A,#916748,#555555,#999999'
                                            ),
                                            'glossary_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#999999,template_content_hovercolor:#E5A452,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#999999'
                                            ),
                                        ),
                                        'hoverbic' => array(
                                            'hoverbic_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#000000,template_ftcolor:#ff9600,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ff9600,beforeloop_readmorecolor:#e0e0e0,beforeloop_readmorebackcolor:#000000,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#000000',
                                                'display_value' => '#000000,#ff9600,#ffffff,#e0e0e0'
                                            ),
                                            'hoverbic_mariner' => array(
                                                'preset_name' => __('Mariner', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#465BAC,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#465BAC,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#465BAC',
                                                'display_value' => '#465BAC,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'hoverbic_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#FA336C,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#FA336C,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#FA336C',
                                                'display_value' => '#FA336C,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'hoverbic_finch' => array(
                                                'preset_name' => __('Finch', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#75815B,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#75815B,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#75815B',
                                                'display_value' => '#75815B,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'hoverbic_vivid_gamboge' => array(
                                                'preset_name' => __('Vivid Gamboge', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#f99900,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#f99900,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#f999000',
                                                'display_value' => '#f99900,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                            'hoverbic_moderate-orange' => array(
                                                'preset_name' => __('Moderate Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'grid_hoverback_color:#8B6632,template_ftcolor:#e0e0e0,template_fthovercolor:#ffffff,template_titlecolor:#e0e0e0,template_titlehovercolor:#ffffff,beforeloop_readmorecolor:#8B6632,beforeloop_readmorebackcolor:#e0e0e0,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#8B6632',
                                                'display_value' => '#8B6632,#e0e0e0,#ffffff,#e0e0e0'
                                            ),
                                        ),
                                        'hub' => array(
                                            'hub_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#495F85,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#495F85,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#495F85,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#495F85,beforeloop_readmorehovercolor:#495F85,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#495F85,#222222,#555555,#333333'
                                            ),
                                            'hub_torea_bay' => array(
                                                'preset_name' => __('Torea Bay', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'hub_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#EA1A3A,#EE4861,#555555,#333333'
                                            ),
                                            'hub_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#333333'
                                            ),
                                            'hub_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#333333'
                                            ),
                                            'hub_wild_yonder' => array(
                                                'preset_name' => __('Wild Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ECF0F7,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ECF0F7,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#333333'
                                            ),
                                        ),
                                        'invert-grid' => array(
                                            'invert-grid_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#CC0001,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#CC0001,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#CC0001,#2b2b2b,#CC0001,#4c3e37'
                                            ),
                                            'invert-grid_tawny' => array(
                                                'preset_name' => __('Tawny', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#d35400,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#d35400,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#d35400,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#d35400,beforeloop_readmorehovercolor:#d35400,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#d35400,#2b2b2b,#d35400,#4c3e37'
                                            ),
                                            'invert-grid_pacific_blue' => array(
                                                'preset_name' => __('Pacific Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0099CB,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#0099CB,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0099CB,#2b2b2b,#0099CB,#4c3e37'
                                            ),
                                            'invert-grid_pacific_dark_orchid' => array(
                                                'preset_name' => __('Dark Orchid', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#9A33CC,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#9A33CC,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#9A33CC,#2b2b2b,#9A33CC,#4c3e37'
                                            ),
                                            'invert-grid_pacific_dark_orange' => array(
                                                'preset_name' => __('Dark Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#FF8A00,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#FF8A00,#2b2b2b,#FF8A00,#4c3e37'
                                            ),
                                            'invert-grid_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#414C22,template_fthovercolor:#2b2b2b,template_titlecolor:#2b2b2b,template_titlehovercolor:#414C22,template_titlebackcolor:#ffffff,template_contentcolor:#4c3e37,template_readmorecolor:#ffffff,template_readmorebackcolor:#414C22,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#414C22,beforeloop_readmorehovercolor:#414C22,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#2b2b2b,#414C22,#4c3e37'
                                            ),
                                        ),
                                        'lightbreeze' => array(
                                            'lightbreeze_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#1eafa6,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#1eafa6,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#1eafa6,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#1eafa6,beforeloop_readmorehovercolor:#1eafa6,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#1eafa6,#222222,#555555,#999999'
                                            ),
                                            'lightbreeze_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'lightbreeze_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#B51F76,#C44C91,#555555,#999999'
                                            ),
                                        ),
                                        'masonry_timeline' => array(
                                            'masonry_timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#A39D5A,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#A39D5A,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#A39D5A,#222222,#555555,#666666'
                                            ),
                                            'masonry_timeline_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#E84159,template_titlecolor:#E21130,template_titlehovercolor:#E84159,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#E21130,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E21130,beforeloop_readmorehovercolor:#E21130,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E21130,#E84159,#555555,#666666'
                                            ),
                                            'masonry_timeline_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#666666'
                                            ),
                                            'masonry_timeline_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#EEF6F8,template_titlecolor:#0E7699,template_titlehovercolor:#EEF6F8,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#EEF6F8,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EEF6F8,beforeloop_readmorehovercolor:#EEF6F8,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#666666'
                                            ),
                                            'masonry_timeline_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF7F1,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#666666'
                                            ),
                                            'masonry_timeline_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0F6,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_contentcolor:#666666,template_readmorecolor:#666666,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#B51F76,#C44C91,#555555,#666666'
                                            ),
                                        ),
                                        'media-grid' => array(
                                            'media-grid_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#A49538,template_fthovercolor:#2b2b2b,template_titlecolor:#000000,template_titlehovercolor:#A49538,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#A49538,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A49538,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#A49538,#ffffff,#000000,#7b6b79'
                                            ),
                                            'media-grid_salt-box' => array(
                                                'preset_name' => __('Salt Box', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#60505e,template_fthovercolor:#333333,template_titlecolor:#60505e,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#60505e,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#60505e,beforeloop_readmorehovercolor:#60505e,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#60505e,#ffffff,#2b2b2b,#7b6b79'
                                            ),
                                            'media-grid_pacific_blue' => array(
                                                'preset_name' => __('Pacific Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#0099CB,template_fthovercolor:#2b2b2b,template_titlecolor:#0099CB,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0099CB,#ffffff,#2b2b2b,#7b6b79'
                                            ),
                                            'media-grid_pacific_dark_orchid' => array(
                                                'preset_name' => __('Dark Orchid', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#9A33CC,template_fthovercolor:#2b2b2b,template_titlecolor:#9A33CC,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#9A33CC,#ffffff,#2b2b2b,#7b6b79'
                                            ),
                                            'media-grid_pacific_dark_orange' => array(
                                                'preset_name' => __('Dark Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#FF8A00,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#FF8A00,#ffffff,#2b2b2b,#7b6b79'
                                            ),
                                            'media-grid_pacific_venetian_red' => array(
                                                'preset_name' => __('Venetian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_ftcolor:#CC0001,template_fthovercolor:#2b2b2b,template_titlecolor:#CC0001,template_titlehovercolor:#2b2b2b,template_contentcolor:#7b6b79,template_readmorecolor:#dddddd,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#CC0001,#ffffff,#2b2b2b,#7b6b79'
                                            ),
                                        ),
                                        'minimal' => array(
                                            'minimal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#444444,template_fthovercolor:#2b2b2b,template_titlecolor:#444444,template_titlehovercolor:#e84c89,template_contentcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#ffffff,template_readmorebackcolor:#e84c89,template_readmore_hover_backcolor:#444444,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e84c89,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#444444',
                                                'display_value' => '#ffffff,#e84c89,#2b2b2b,#444444'
                                            ),
                                            'minimal_cyan' => array(
                                                'preset_name' => __('Cyan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DDEEF1,template_ftcolor:#00363B,template_fthovercolor:#002226,template_titlecolor:#00363B,template_titlehovercolor:#008491,template_contentcolor:#DDEEF1,template_contentcolor:#00363B,template_readmorecolor:#DDEEF1,template_readmorebackcolor:#008491,template_readmore_hover_backcolor:#00363B,beforeloop_readmorecolor:#DDEEF1,beforeloop_readmorebackcolor:#008491,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#00363B',
                                                'display_value' => '#DDEEF1,#008491,#002226,#00363B'
                                            ),
                                            'minimal_purple_heart' => array(
                                                'preset_name' => __('Purple Heart', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E9E4F6,template_ftcolor:#26164E,template_fthovercolor:#180E32,template_titlecolor:#26164E,template_titlehovercolor:#5C37BF,template_contentcolor:#E9E4F6,template_contentcolor:#26164E,template_readmorecolor:#E9E4F6,template_readmorebackcolor:#5C37BF,template_readmore_hover_backcolor:#26164E,beforeloop_readmorecolor:#E9E4F6,beforeloop_readmorebackcolor:#5C37BF,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#26164E',
                                                'display_value' => '#E9E4F6,#5C37BF,#180E32,#26164E'
                                            ),
                                            'minimal_go_ben' => array(
                                                'preset_name' => __('Go Ben', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EDECE7,template_ftcolor:#3E3B25,template_fthovercolor:#282618,template_titlecolor:#3E3B25,template_titlehovercolor:#787449,template_contentcolor:#EDECE7,template_contentcolor:#3E3B25,template_readmorecolor:#EDECE7,template_readmorebackcolor:#787449,template_readmore_hover_backcolor:#3E3B25,beforeloop_readmorecolor:#EDECE7,beforeloop_readmorebackcolor:#787449,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#3E3B25',
                                                'display_value' => '#EDECE7,#787449,#282618,#3E3B25'
                                            ),
                                            'minimal_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EAE1E7,template_ftcolor:#35122A,template_fthovercolor:#220B1B,template_titlecolor:#35122A,template_titlehovercolor:#662451,template_contentcolor:#EAE1E7,template_contentcolor:#35122A,template_readmorecolor:#EAE1E7,template_readmorebackcolor:#662451,template_readmore_hover_backcolor:#35122A,beforeloop_readmorecolor:#EAE1E7,beforeloop_readmorebackcolor:#662451,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#35122A',
                                                'display_value' => '#EAE1E7,#662451,#220B1B,#35122A'
                                            ),
                                            'minimal_royal_blue' => array(
                                                'preset_name' => __('Royal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E4EAF9,template_ftcolor:#1B326A,template_fthovercolor:#122044,template_titlecolor:#1B326A,template_titlehovercolor:#3463D0,template_contentcolor:#E4EAF9,template_contentcolor:#1B326A,template_readmorecolor:#E4EAF9,template_readmorebackcolor:#3463D0,template_readmore_hover_backcolor:#1B326A,beforeloop_readmorecolor:#E4EAF9,beforeloop_readmorebackcolor:#3463D0,beforeloop_readmorehovercolor:#A49538,beforeloop_readmorehoverbackcolor:#1B326A',
                                                'display_value' => '#E4EAF9,#3463D0,#122044,#1B326A'
                                            ),
                                        ),
                                        'miracle' => array(
                                            'miracle_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#62bf7c,template_fthovercolor:#686868,template_titlecolor:#353535,template_titlehovercolor:#62bf7c,template_titlebackcolor:#ffffff,template_contentcolor:#252525,template_readmorecolor:#ffffff,template_readmorebackcolor:#62bf7c,template_readmore_hover_backcolor:#686868,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#62bf7c,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#686868',
                                                'display_value' => '#ffffff,#62bf7c,#353535,#252525'
                                            ),
                                            'miracle_lochmara' => array(
                                                'preset_name' => __('Lochmara', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F7FAFC,template_ftcolor:#227CAD,template_fthovercolor:#0E3246,template_titlecolor:#051117,template_titlehovercolor:#227CAD,template_titlebackcolor:#F7FAFC,template_contentcolor:#09202D,template_readmorecolor:#F7FAFC,template_readmorebackcolor:#227CAD,template_readmore_hover_backcolor:#0E3246,beforeloop_readmorecolor:#F7FAFC,beforeloop_readmorebackcolor:#227CAD,beforeloop_readmorehovercolor:#F7FAFC,beforeloop_readmorehoverbackcolor:#0E3246',
                                                'display_value' => '#F7FAFC,#227CAD,#051117,#09202D'
                                            ),
                                            'miracle_burgundy' => array(
                                                'preset_name' => __('Burgundy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF6F7,template_ftcolor:#6C0124,template_fthovercolor:#2C010E,template_titlecolor:#0E0105,template_titlehovercolor:#6C0124,template_titlebackcolor:#FAF6F7,template_contentcolor:#1C0109,template_readmorecolor:#FAF6F7,template_readmorebackcolor:#6C0124,template_readmore_hover_backcolor:#2C010E,beforeloop_readmorecolor:#FAF6F7,beforeloop_readmorebackcolor:#6C0124,beforeloop_readmorehovercolor:#FAF6F7,beforeloop_readmorehoverbackcolor:#2C010E',
                                                'display_value' => '#FAF6F7,#6C0124,#0E0105,#1C0109'
                                            ),
                                            'miracle_hillary' => array(
                                                'preset_name' => __('Hillary', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCFBFA,template_ftcolor:#A49E77,template_fthovercolor:#434131,template_titlecolor:#161610,template_titlehovercolor:#A49E77,template_titlebackcolor:#FCFBFA,template_contentcolor:#2B2A1F,template_readmorecolor:#FCFBFA,template_readmorebackcolor:#A49E77,template_readmore_hover_backcolor:#434131,beforeloop_readmorecolor:#FCFBFA,beforeloop_readmorebackcolor:#A49E77,beforeloop_readmorehovercolor:#FCFBFA,beforeloop_readmorehoverbackcolor:#434131',
                                                'display_value' => '#FCFBFA,#A49E77,#161610,#2B2A1F'
                                            ),
                                            'miracle_amaranth' => array(
                                                'preset_name' => __('Amaranth', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FDF9FA,template_ftcolor:#DE364A,template_fthovercolor:#491218,template_titlecolor:#1E070A,template_titlehovercolor:#DE364A,template_titlebackcolor:#FDF9FA,template_contentcolor:#2E0B0F,template_readmorecolor:#FDF9FA,template_readmorebackcolor:#DE364A,template_readmore_hover_backcolor:#491218,beforeloop_readmorecolor:#FDF9FA,beforeloop_readmorebackcolor:#DE364A,beforeloop_readmorehovercolor:#FDF9FA,beforeloop_readmorehoverbackcolor:#491218',
                                                'display_value' => '#FDF9FA,#DE364A,#1E070A,#2E0B0F'
                                            ),
                                            'miracle_manatee' => array(
                                                'preset_name' => __('Manatee', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCFCFD,template_ftcolor:#9699A7,template_fthovercolor:#3E3E45,template_titlecolor:#151516,template_titlehovercolor:#9699A7,template_titlebackcolor:#FCFCFD,template_contentcolor:#28282C,template_readmorecolor:#FCFCFD,template_readmorebackcolor:#9699A7,template_readmore_hover_backcolor:#3E3E45,beforeloop_readmorecolor:#FCFCFD,beforeloop_readmorebackcolor:#9699A7,beforeloop_readmorehovercolor:#FCFCFD,beforeloop_readmorehoverbackcolor:#3E3E45',
                                                'display_value' => '#FCFCFD,#9699A7,#151516,#28282C'
                                            ),
                                        ),
                                        'my_diary' => array(
                                            'my_diary_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#128775,template_fthovercolor:#000000,template_titlecolor:#128775,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#128775,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#128775,beforeloop_readmorehovercolor:#128775,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#128775,#313131,#ffffff,#333333'
                                            ),
                                            'my_diary_crimson' => array(
                                                'preset_name' => __('Crimson', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#000000,template_ftcolor:#e21130,template_fthovercolor:#000000,template_titlecolor:#e21130,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#e21130,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#e21130,beforeloop_readmorehovercolor:#e21130,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#e21130,#000000,#ffffff,#333333'
                                            ),
                                            'my_diary_eastern_blue' => array(
                                                'preset_name' => __('Eastern Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#DAEBFF,template_ftcolor:#00809D,template_fthovercolor:#000000,template_titlecolor:#00809D,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#00809D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#00809D,#DAEBFF,#ffffff,#000000'
                                            ),
                                            'my_diary_eastern_mint_tulip' => array(
                                                'preset_name' => __('Mint Tulip', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#E18942,template_fthovercolor:#000000,template_titlecolor:#E18942,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E18942,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E18942,beforeloop_readmorehovercolor:#E18942,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E18942,#313131,#ffffff,#333333'
                                            ),
                                            'my_diary_camelot' => array(
                                                'preset_name' => __('Camelot', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#7A3E48,template_fthovercolor:#000000,template_titlecolor:#7A3E48,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#7A3E48,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#7A3E48,#313131,#ffffff,#333333'
                                            ),
                                            'my_diary_sundance' => array(
                                                'preset_name' => __('Sundance', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#313131,template_ftcolor:#C59F4A,template_fthovercolor:#000000,template_titlecolor:#C59F4A,template_titlehovercolor:#000000,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#C59F4A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#00809D,beforeloop_readmorehovercolor:#00809D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#C59F4A,#313131,#ffffff,#333333'
                                            ),
                                        ),
                                        'navia' => array(
                                            'navia_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#D65D88,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#D65D88,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#D65D88,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#D65D88,beforeloop_readmorehovercolor:#D65D88,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#D65D88,#222222,#555555,#999999'
                                            ),
                                            'navia_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#AE742A,#BE9055,#555555,#999999'
                                            ),
                                            'navia_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E663C,#3E8563,#555555,#999999'
                                            ),
                                            'navia_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#999999'
                                            ),
                                            'navia_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#999999'
                                            ),
                                            'navia_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FCE1E4,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#999999'
                                            ),
                                        ),
                                        'news' => array(
                                            'news_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#AF583D,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#AF583D,template_titlebackcolor:#ffffff,template_contentcolor:#444444,template_readmorecolor:#AF583D,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#AF583D,beforeloop_readmorehovercolor:#AF583D,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#AF583D,#222222,#555555,#444444'
                                            ),
                                            'news_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F8F3ED,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F8F3ED,template_contentcolor:#444444,template_readmorecolor:#683C6F,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#AE742A,#BE9055,#555555,#444444'
                                            ),
                                            'news_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#EEF6F8,template_contentcolor:#444444,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#444444'
                                            ),
                                            'news_rich-gold' => array(
                                                'preset_name' => __('Rich Gold', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F9F4F0,template_ftcolor:#555555,template_fthovercolor:#BA7850,template_titlecolor:#A95624,template_titlehovercolor:#BA7850,template_titlebackcolor:#F9F4F0,template_contentcolor:#444444,template_readmorecolor:#BA7850,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#BA7850,beforeloop_readmorehovercolor:#BA7850,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#A95624,#BA7850,#555555,#444444'
                                            ),
                                            'news_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#F1F3F0,template_contentcolor:#444444,template_readmorecolor:#67704E,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#414C22,#67704E,#555555,#444444'
                                            ),
                                            'news_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,template_titlehovercolor:#435F7F,template_titlebackcolor:#EEF1F4,template_contentcolor:#444444,template_readmorecolor:#435F7F,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#435F7F,beforeloop_readmorehovercolor:#435F7F,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#14375F,#435F7F,#555555,#444444'
                                            ),
                                        ),
                                        'offer_blog' => array(
                                            'offer_blog_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#BE6A67,template_fthovercolor:#555555,template_titlecolor:#333333,template_titlehovercolor:#BE6A67,template_titlebackcolor:#ffffff,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE6A67,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE6A67,beforeloop_readmorehovercolor:#BE6A67,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#BE6A67,#333333,#555555,#666666'
                                            ),
                                            'offer_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F1F3F0,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#F1F3F0,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#666666'
                                            ),
                                            'offer_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F9F5F1,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#AE742A,#BE9055,#555555,#666666'
                                            ),
                                            'offer_regal_blue' => array(
                                                'preset_name' => __('Regal Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEF1F4,template_ftcolor:#555555,template_fthovercolor:#435F7F,template_titlecolor:#14375F,template_titlehovercolor:#435F7F,template_titlebackcolor:#EEF1F4,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#435F7F,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#435F7F,beforeloop_readmorehovercolor:#435F7F,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#14375F,#435F7F,#555555,#666666'
                                            ),
                                            'offer_shiraz' => array(
                                                'preset_name' => __('Shiraz', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#EEE2E4,template_ftcolor:#555555,template_fthovercolor:#9E555D,template_titlecolor:#862A35,template_titlehovercolor:#9E555D,template_titlebackcolor:#EEE2E4,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#9E555D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9E555D,beforeloop_readmorehovercolor:#9E555D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#862A35,#9E555D,#555555,#666666'
                                            ),
                                            'offer_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F3F5FA,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F3F5FA,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#666666'
                                            ),
                                        ),
                                        'overlay_horizontal' => array(
                                            'overlay_horizontal_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#dd5555,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#ffffff,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#dd5555,#ffffff,#aaaaaa,#ffffff'
                                            ),
                                            'overlay_horizontal_persian_red' => array(
                                                'preset_name' => __('Persian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#DC3330,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#DC3330,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DC3330,#ffffff,#aaaaaa,#ffffff'
                                            ),
                                            'overlay_horizontal_dark_goldenrod' => array(
                                                'preset_name' => __('Dark Goldenrod', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#B48900,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#B48900,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#B48900,#ffffff,#aaaaaa,#ffffff'
                                            ),
                                            'overlay_horizontal_deep_cerise' => array(
                                                'preset_name' => __('Deep Cerise', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#D23582,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#D23582,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#D23582,#ffffff,#aaaaaa,#ffffff'
                                            ),
                                            'overlay_horizontal_rust' => array(
                                                'preset_name' => __('Rust', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#CA4B16,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#CA4B16,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#CA4B16,#ffffff,#aaaaaa,#ffffff,'
                                            ),
                                            'overlay_horizontal_blue' => array(
                                                'preset_name' => __('Chetwode Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#6C71C3,template_ftcolor:#ffffff,template_fthovercolor:#aaaaaa,template_titlecolor:#6C71C3,template_titlehovercolor:#aaaaaa,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#aaaaaa,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#999999,beforeloop_readmorehovercolor:#999999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6C71C3,#ffffff,#aaaaaa,#ffffff'
                                            ),
                                        ),
                                        'nicy' => array(
                                            'nicy_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#ED4961,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ED4961,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#ED4961',
                                                'display_value' => '#ED4961,#222222,#555555,#999999'
                                            ),
                                            'nicy_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E91AD,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E91AD,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E91AD',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'nicy_fun_green' => array(
                                                'preset_name' => __('Fun Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#3E8563,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#3E8563,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#3E8563',
                                                'display_value' => '#0E663C,#3E8563,#555555,#999999'
                                            ),
                                            'nicy_blackberry' => array(
                                                'preset_name' => __('Blackberry', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#6D4657,template_titlecolor:#49182D,template_titlehovercolor:#6D4657,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#6D4657,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#6D4657,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#6D4657',
                                                'display_value' => '#49182D,#6D4657,#555555,#999999'
                                            ),
                                            'nicy_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#CEBF59,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#CEBF59,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#CEBF59',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                            'nicy_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#F4ECE2,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F4ECE2,template_contentcolor:#999999,template_readmorecolor:#BE9055,template_readmorebackcolor:#f1f1f1,beforeloop_readmorecolor:#BE9055,beforeloop_readmorebackcolor:#f1f1f1,beforeloop_readmorehovercolor:#f1f1f1,beforeloop_readmorehoverbackcolor:#BE9055',
                                                'display_value' => '#AE742A,#BE9055,#555555,#999999'
                                            ),
                                        ),
                                        'region' => array(
                                            'region_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#AC619B,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#AC619B,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#AC619B,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#AC619B,beforeloop_readmorehovercolor:#AC619B,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#AC619B,#222222,#555555,#333333'
                                            ),
                                            'region_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F5E1ED,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#F5E1ED,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#B51F76,#C44C91,#555555,#333333'
                                            ),
                                            'region_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#333333'
                                            ),
                                            'region_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F7F4E4,template_ftcolor:#55555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#F7F4E4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#CEBF59,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#333333'
                                            ),
                                            'region_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#E5E7E1,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#414C22,#67704E,#555555,#333333'
                                            ),
                                            'region_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#333333'
                                            ),
                                        ),
                                        'roctangle' => array(
                                            'roctangle_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#f18293,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#f18293,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#f18293,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444',
                                                'display_value' => '#f18293,#222222,#444444,#666666'
                                            ),
                                            'roctangle_sky_blue' => array(
                                                'preset_name' => __('Sky Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#92E2FD,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#92E2FD,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#92E2FD,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444',
                                                'display_value' => '#92E2FD,#222222,#444444,#666666'
                                            ),
                                            'roctangle_lite_green' => array(
                                                'preset_name' => __('Lite Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_color:#0ef58d,template_ftcolor:#666666,template_fthovercolor:#444444,template_titlecolor:#222222,template_titlehovercolor:#0ef58d,template_readmorecolor:#222222,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0ef58d,beforeloop_readmorehovercolor:#ffffff,beforeloop_readmorehoverbackcolor:#222222,template_contentcolor:#444444',
                                                'display_value' => '#0ef58d,#222222,#444444,#666666'
                                            ),
                                        ),
                                        'sharpen' => array(
                                            'sharpen_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#2E6480,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2E6480,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#2E6480,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#2E6480,beforeloop_readmorehovercolor:#2E6480,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#2E6480,#222222,#555555,#999999'
                                            ),
                                            'sharpen_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#67704E,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#414C22,#67704E,#555555,#999999'
                                            ),
                                            'sharpen_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#f1f1f1,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#f1f1f1,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#f1f1f1',
                                                'display_value' => '#B51F76,#C44C91,#555555,#999999'
                                            ),
                                        ),
                                        'spektrum' => array(
                                            'spektrum_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#2d7fc1,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#2d7fc1,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#2d7fc1,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#2d7fc1,beforeloop_readmorehovercolor:#2d7fc1,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#2d7fc1,#222222,#555555,#333333'
                                            ),
                                            'spektrum_torea_bay' => array(
                                                'preset_name' => __('Torea Bay', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_contentcolor:#999999,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'spektrum_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FCE1E4,template_ftcolor:#555555,template_fthovercolor:#EE4861,template_titlecolor:#EA1A3A,template_titlehovercolor:#EE4861,template_titlebackcolor:#FCE1E4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#EE4861,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#EE4861,beforeloop_readmorehovercolor:#EE4861,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#EA1A3A,#EE4861,#555555,#333333'
                                            ),
                                            'spektrum_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#FAF0E2,template_ftcolor:#555555,template_fthovercolor:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_titlebackcolor:#FAF0E2,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#333333'
                                            ),
                                            'spektrum_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#F0E9F4,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#A381BB,template_titlebackcolor:#F0E9F4,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A381BB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A381BB,beforeloop_readmorehovercolor:#A381BB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#333333'
                                            ),
                                            'spektrum_wild_yonder' => array(
                                                'preset_name' => __('Wild Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_bgcolor:#ECF0F7,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#ECF0F7,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#333333'
                                            ),
                                        ),
                                        'steps' => array(
                                            'steps_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#d1d1d1,template_bgcolor:#ffffff,template_ftcolor:#b7b7b7,template_fthovercolor:#2a2727,template_titlecolor:#2a2727,template_titlehovercolor:#e21130,template_titlebackcolor:#ffffff,template_contentcolor:#504d4d,template_readmorecolor:#e21130,beforeloop_readmorecolor:#e21130,beforeloop_readmorebackcolor:#ffffff,beforeloop_readmorehovercolor:#504d4d,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#d1d1d1,#b7b7b7,#2a2727,#e21130'
                                            ),
                                            'steps_tan' => array(
                                                'preset_name' => __('Tan', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#E7DDC5,template_bgcolor:#F9F6F0,template_ftcolor:#D9CAA5,template_fthovercolor:#6A6149,template_titlecolor:#6A6149,template_titlehovercolor:#CFBD8F,template_titlebackcolor:#F9F6F0,template_contentcolor:#6A6149,template_readmorecolor:#CFBD8F,beforeloop_readmorecolor:#CFBD8F,beforeloop_readmorebackcolor:#F9F6F0,beforeloop_readmorehovercolor:#6A6149,beforeloop_readmorehoverbackcolor:#F9F6F0',
                                                'display_value' => '#E7DDC5,#D9CAA5,#6A6149,#CFBD8F'
                                            ),
                                            'steps_nordic' => array(
                                                'preset_name' => __('Nordic', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#849697,template_bgcolor:#DFE4E4,template_ftcolor:#3F5B5D,template_fthovercolor:#081A1B,template_titlecolor:#081A1B,template_titlehovercolor:#0F3235,template_titlebackcolor:#DFE4E4,template_contentcolor:#081A1B,template_readmorecolor:#0F3235,beforeloop_readmorecolor:#0F3235,beforeloop_readmorebackcolor:#DFE4E4,beforeloop_readmorehovercolor:#081A1B,beforeloop_readmorehoverbackcolor:#DFE4E4',
                                                'display_value' => '#849697,#3F5B5D,#081A1B,#0F3235'
                                            ),
                                        ),
                                        'story' => array(
                                            'story_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#0c555e,template_alternative_color:#ff6861,story_startup_border_color:#ffffff,story_startup_background:#71a405,story_startup_text_color:#ffffff,story_ending_background:#71a405,story_ending_text_color:#ffffff,template_ftcolor:#0c555e,template_fthovercolor:#2b2b2b,template_titlecolor:#333333,template_titlehovercolor:#ade175,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#333333',
                                                'display_value' => '#0c555e,#ff6861,#0c555e,#333333'
                                            ),
                                            'story_goldenrod' => array(
                                                'preset_name' => __('Goldenrod', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#b48900,template_alternative_color:#d23582,story_startup_border_color:#e21130,story_startup_background:#e21130,story_startup_text_color:#ffffff,story_ending_background:#e21130,story_ending_text_color:#ffffff,template_ftcolor:#e21130,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,template_titlehovercolor:#e21130,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#e21130',
                                                'display_value' => '#b48900,#d23582,#e21130,#333333'
                                            ),
                                            'story_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#fa336c,template_alternative_color:#f18547,story_startup_border_color:#75815b,story_startup_background:#75815b,story_startup_text_color:#ffffff,story_ending_background:#75815b,story_ending_text_color:#ffffff,template_ftcolor:#75815b,template_fthovercolor:#2b2b2b,template_titlecolor:#707070,template_titlehovercolor:#75815b,template_contentcolor:#666666,template_readmorecolor:#d6d6d6,template_readmorebackcolor:#75815b',
                                                'display_value' => '#fa336c,#f18547,#75815b,#333333'
                                            )
                                        ),
                                        'timeline' => array(
                                            'timeline_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#414a54,template_color:#E0254D,template_bgcolor:#ffffff,template_ftcolor:#E0254D,template_fthovercolor:#444444,template_titlecolor:#E0254D,template_titlehovercolor:#444444,template_titlebackcolor:#ffffff,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E0254D,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E0254D,beforeloop_readmorehovercolor:#E0254D,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E0254D,#414a54,#ffffff,#333333'
                                            ),
                                            'timeline_pink' => array(
                                                'preset_name' => __('Dark Sea Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#9AB999,template_color:#9AB999,template_bgcolor:#F6F8F5,template_ftcolor:#9AB999,template_fthovercolor:#444444,template_titlecolor:#9AB999,template_titlehovercolor:#444444,template_titlebackcolor:#F6F8F5,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#9AB999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9AB999,beforeloop_readmorehovercolor:#9AB999,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#9AB999,#F6F8F5,#9AB999,#333333'
                                            ),
                                            'timeline_pacific_blue' => array(
                                                'preset_name' => __('Pacific Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#0099CB,template_color:#0099CB,template_bgcolor:#E6F5FA,template_ftcolor:#0099CB,template_fthovercolor:#444444,template_titlecolor:#0099CB,template_titlehovercolor:#444444,template_titlebackcolor:#E6F5FA,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#0099CB,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#0099CB,beforeloop_readmorehovercolor:#0099CB,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0099CB,#E6F5FA,#0099CB,#333333'
                                            ),
                                            'timeline_dark_orchid' => array(
                                                'preset_name' => __('Dark Orchid', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#9A33CC,template_color:#9A33CC,template_bgcolor:#F5EAFA,template_ftcolor:#9A33CC,template_fthovercolor:#444444,template_titlecolor:#9A33CC,template_titlehovercolor:#444444,template_titlebackcolor:#F5EAFA,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#9A33CC,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#9A33CC,beforeloop_readmorehovercolor:#9A33CC,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#9A33CC,#F5EAFA,#9A33CC,#333333'
                                            ),
                                            'timeline_dark_orange' => array(
                                                'preset_name' => __('Dark Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#FF8A00,template_color:#FF8A00,template_bgcolor:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#444444,template_titlecolor:#FF8A00,template_titlehovercolor:#444444,template_titlebackcolor:#FFF3E5,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#FF8A00,beforeloop_readmorehovercolor:#FF8A00,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#FF8A00,#FFF3E5,#FF8A00,#333333'
                                            ),
                                            'timeline_venetian_red' => array(
                                                'preset_name' => __('Venetian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'displaydate_backcolor:#CC0001,template_color:#CC0001,template_bgcolor:#FAE4E6,template_ftcolor:#CC0001,template_fthovercolor:#444444,template_titlecolor:#CC0001,template_titlehovercolor:#444444,template_titlebackcolor:#FAE4E6,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CC0001,beforeloop_readmorehovercolor:#CC0001,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#CC0001,#FAE4E6,#CC0001,#333333'
                                            ),
                                        ),
                                        'winter' => array(
                                            'winter_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#E7492F,template_bgcolor:#ffffff,template_ftcolor:#E7492F,template_fthovercolor:#555555,template_titlecolor:#222222,template_titlehovercolor:#ED4961,template_titlebackcolor:#ffffff,template_contentcolor:#666666,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E7492F,#222222,#555555,#666666'
                                            ),
                                            'winter_toddy' => array(
                                                'preset_name' => __('Toddy', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#BE9055,template_bgcolor:#F9F5F1,template_ftcolor:#555555,template_fthovercolor:#BE9055,template_titlecolor:#AE742A,template_titlehovercolor:#BE9055,template_titlebackcolor:#F9F5F1,template_contentcolor:#666666,template_readmorecolor:#F9F5F1,template_readmorebackcolor:#BE9055,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#BE9055,beforeloop_readmorehovercolor:#BE9055,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#AE742A,#BE9055,#555555,#666666'
                                            ),
                                            'winter_bronzetone' => array(
                                                'preset_name' => __('Bronzetone', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#67704E,template_bgcolor:#E5E7E1,template_ftcolor:#555555,template_fthovercolor:#67704E,template_titlecolor:#414C22,template_titlehovercolor:#E5E7E1,template_titlebackcolor:#E5E7E1,template_contentcolor:#666666,template_readmorecolor:#E5E7E1,template_readmorebackcolor:#67704E,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#67704E,beforeloop_readmorehovercolor:#67704E,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#414C22,#67704E,#555555,#666666'
                                            ),
                                            'winter_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#3E91AD,template_bgcolor:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#EEF6F8,template_contentcolor:#666666,template_readmorecolor:#EEF6F8,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#666666'
                                            ),
                                            'winter_ce_soir' => array(
                                                'preset_name' => __('Ce Soir', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#A381BB,template_bgcolor:#F7F4F9,template_ftcolor:#555555,template_fthovercolor:#A381BB,template_titlecolor:#8C62AA,template_titlehovercolor:#3E91AD,template_titlebackcolor:#F7F4F9,template_contentcolor:#666666,template_readmorecolor:#F7F4F9,template_readmorebackcolor:#8C62AA,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8C62AA,beforeloop_readmorehovercolor:#8C62AA,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C62AA,#A381BB,#555555,#666666'
                                            ),
                                            'winter_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#8BA3CE,template_bgcolor:#F5F7FB,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F5F7FB,template_contentcolor:#666666,template_readmorecolor:#F5F7FB,template_readmorebackcolor:#8BA3CE,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#666666'
                                            )
                                        ),
                                        'sallet_slider' => array(
                                            'sallet_slider_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E8563,winter_category_color:#3E8563,template_titlecolor:#0E663C,template_titlehovercolor:#3E8563,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E8563,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E8563,beforeloop_readmorehovercolor:#3E8563,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E663C,#3E8563,#555555,#333333'
                                            ),
                                            'sallet_slider_red_violet' => array(
                                                'preset_name' => __('Red Violet', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#FBF3F8,template_ftcolor:#555555,template_fthovercolor:#C44C91,winter_category_color:#C44C91,template_titlecolor:#B51F76,template_titlehovercolor:#C44C91,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#C44C91,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C44C91,beforeloop_readmorehovercolor:#C44C91,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#B51F76,#C44C91,#555555,#333333'
                                            ),
                                            'sallet_slider_lemon_ginger' => array(
                                                'preset_name' => __('Lemon Ginger', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#F7F6F1,template_ftcolor:#555555,template_fthovercolor:#A39D5A,winter_category_color:#A39D5A,template_titlecolor:#8C8431,template_titlehovercolor:#A39D5A,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#A39D5A,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#A39D5A,beforeloop_readmorehovercolor:#A39D5A,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#8C8431,#A39D5A,#555555,#333333'
                                            ),
                                            'sallet_slider_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#EEF6F8,template_ftcolor:#555555,template_fthovercolor:#3E91AD,winter_category_color:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#333333'
                                            ),
                                            'sallet_slider_buttercup' => array(
                                                'preset_name' => __('Buttercup', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#FDF7F1,template_ftcolor:#555555,template_fthovercolor:#E5A452,winter_category_color:#E5A452,template_titlecolor:#DF8D27,template_titlehovercolor:#E5A452,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#E5A452,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#E5A452,beforeloop_readmorehovercolor:#E5A452,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#DF8D27,#E5A452,#555555,#333333'
                                            ),
                                            'sallet_slider_wasabi' => array(
                                                'preset_name' => __('Wasabi', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#F6F7F1,template_ftcolor:#555555,template_fthovercolor:#93A564,winter_category_color:#93A564,template_titlecolor:#788F3D,template_titlehovercolor:#93A564,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#93A564,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#93A564,beforeloop_readmorehovercolor:#93A564,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#788F3D,#93A564,#555555,#333333'
                                            ),
                                        ),
                                        'sunshiny_slider' => array(
                                            'sunshiny_slider_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#000000,template_ftcolor:#ffffff,template_fthovercolor:#ff00ae,winter_category_color:#ff00ae,template_titlecolor:#ffffff,template_titlehovercolor:#ff00ae,template_contentcolor:#333333,template_readmorecolor:#ffffff,template_readmorebackcolor:#ff00ae',
                                                'display_value' => '#ffffff,#ff00ae,#ffffff,#333333'
                                            ),
                                            'sunshiny_slider_radical_red' => array(
                                                'preset_name' => __('Radical Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#330a12,template_ftcolor:#ffeaee,template_fthovercolor:#ff355e,winter_category_color:#ff355e,template_titlecolor:#ffd6de,template_titlehovercolor:#FA336C,template_contentcolor:#ffeaee,template_readmorecolor:#ffffff,template_readmorebackcolor:#FA336C',
                                                'display_value' => '#330a12,#ff355e,#ffd6de,#ffeaee'
                                            ),
                                            'sunshiny_slider_eminence' => array(
                                                'preset_name' => __('Eminence', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#2b1334,template_ftcolor:#e1d5e6,template_fthovercolor:#2b1334,winter_category_color:#6c3082,template_titlecolor:#e1d5e6,template_titlehovercolor:#2b1334,template_contentcolor:#f0eaf2,template_readmorecolor:#ffffff,template_readmorebackcolor:#683C6F',
                                                'display_value' => '#2b1334,#6c3082,#e1d5e6,#f0eaf2'
                                            ),
                                            'sunshiny_slider_dark_orange' => array(
                                                'preset_name' => __('Dark Orange', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#FF8A00,template_color:#FFF3E5,template_ftcolor:#FF8A00,template_fthovercolor:#2b2b2b,template_titlecolor:#FF8A00,template_titlehovercolor:#2b2b2b,template_contentcolor:#2b2b2b,template_readmorecolor:#ffffff,template_readmorebackcolor:#FF8A00',
                                                'display_value' => '#FF8A00,#FFF3E5,#ffffff,#2b2b2b'
                                            ),
                                            'sunshiny_slider_persian_red' => array(
                                                'preset_name' => __('Persian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3d0f0f,template_ftcolor:#ffffff,template_fthovercolor:#3d0f0f,winter_category_color:#cc3333,template_titlecolor:#f4d6d6,template_titlehovercolor:#3d0f0f,template_contentcolor:#f9eaea,template_readmorecolor:#ffffff,template_readmorebackcolor:#DC3330',
                                                'display_value' => '#3d0f0f,#cc3333,#f4d6d6,#f9eaea'
                                            ),
                                            'sunshiny_slider_venetian_red' => array(
                                                'preset_name' => __('Venetian Red', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'winter_category_color:#CC0001,template_color:#FAE4E6,template_ftcolor:#ffffff,template_fthovercolor:#2b2b2b,template_titlecolor:#ffffff,template_titlehovercolor:#2b2b2b,template_contentcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#CC0001',
                                                'display_value' => '#FAE4E6,#CC0001,#ffffff,#2b2b2b'
                                            ),
                                        ),
                                        'pretty' => array(
                                            'pretty_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ff93a3,template_bgcolor:#ffffff,template_ftcolor:#b7b7b7,template_fthovercolor:#859f88,template_titlecolor:#859f88,template_titlehovercolor:#ff93a3,template_titlebackcolor:#ffffff,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#859f88,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#859f88,beforeloop_readmorehovercolor:#859f88,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#ff93a3,#ffffff,#484848,#859f88'
                                            ),
                                            'pretty_sky_blue' => array(
                                                'preset_name' => __('Sky Blue', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#00809D,template_bgcolor:#DAEBFF,template_ftcolor:#888888,template_fthovercolor:#00809D,template_titlecolor:#00809D,template_titlehovercolor:#888888,template_titlebackcolor:#DAEBFF,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#00809D,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#DAEBFF,beforeloop_readmorehovercolor:#DAEBFF,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#00809D,#DAEBFF,#484848,#888888'
                                            ),
                                            'pretty_lite_green' => array(
                                                'preset_name' => __('Lite Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#0ef58d,template_bgcolor:#C3F3DD,template_ftcolor:#888888,template_fthovercolor:#E21130,template_titlecolor:#e21130,template_titlehovercolor:#0ef58d,template_titlebackcolor:#C3F3DD,template_readmorecolor:#f7fbfc,template_readmorebackcolor:#E21130,template_contentcolor:#484848,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#C3F3DD,beforeloop_readmorehovercolor:#C3F3DD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0ef58d,#C3F3DD,#484848,#E21130'
                                            )
                                        ),
                                        'tagly' => array(
                                            'tagly_default' => array(
                                                'preset_name' => __('Default', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#b79a5e,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#b79a5e,template_titlecolor:#333333,template_titlehovercolor:#b79a5e,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#b79a5e,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#b79a5e,beforeloop_readmorehovercolor:#b79a5e,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#b79a5e,#333333,#555555,#999999'
                                            ),
                                            'tagly_earls_green' => array(
                                                'preset_name' => __('Earls Green', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#CEBF59,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#CEBF59,template_titlecolor:#C2AF2F,template_titlehovercolor:#CEBF59,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#CEBF59,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#CEBF59,beforeloop_readmorehovercolor:#CEBF59,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#C2AF2F,#CEBF59,#555555,#999999'
                                            ),
                                            'tagly_cerulean' => array(
                                                'preset_name' => __('Cerulean', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#3E91AD,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#3E91AD,template_titlecolor:#0E7699,template_titlehovercolor:#3E91AD,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#3E91AD,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#3E91AD,beforeloop_readmorehovercolor:#3E91AD,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#0E7699,#3E91AD,#555555,#999999'
                                            ),
                                            'tagly_pompadour' => array(
                                                'preset_name' => __('Pompadour', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#974772,template_bgcolor:#ffffff,template_ftcolor:#555555,template_fthovercolor:#974772,template_titlecolor:#7D194F,template_titlehovercolor:#974772,template_titlebackcolor:#ffffff,template_readmorecolor:#ffffff,template_readmorebackcolor:#974772,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#974772,beforeloop_readmorehovercolor:#974772,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#7D194F,#974772,#555555,#999999'
                                            ),
                                            'tagly_alizarin' => array(
                                                'preset_name' => __('Alizarin', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#ED4961,template_bgcolor:#FDF0F1,template_ftcolor:#555555,template_fthovercolor:#ED4961,template_titlecolor:#E81B3A,template_titlehovercolor:#ED4961,template_titlebackcolor:#FDF0F1,template_readmorecolor:#ffffff,template_readmorebackcolor:#ED4961,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#ED4961,beforeloop_readmorehovercolor:#ED4961,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#E81B3A,#ED4961,#555555,#999999'
                                            ),
                                            'tagly_yonder' => array(
                                                'preset_name' => __('Yonder', BLOGDESIGNERPRO_TEXTDOMAIN),
                                                'preset_value' => 'template_color:#8BA3CE,template_bgcolor:#F5F7FB,template_ftcolor:#555555,template_fthovercolor:#8BA3CE,template_titlecolor:#6E8CC2,template_titlehovercolor:#8BA3CE,template_titlebackcolor:#F5F7FB,template_readmorecolor:#ffffff,template_readmorebackcolor:#8BA3CE,template_contentcolor:#999999,beforeloop_readmorecolor:#ffffff,beforeloop_readmorebackcolor:#8BA3CE,beforeloop_readmorehovercolor:#8BA3CE,beforeloop_readmorehoverbackcolor:#ffffff',
                                                'display_value' => '#6E8CC2,#8BA3CE,#555555,#999999'
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
                                                    <?php
                                                    bdp_admin_color_preset($value['display_value']);
                                                    ?>
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
                                        <?php _e('Layout Name',BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter blog layout name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="unique_shortcode_name" id="unique_shortcode_name" value="<?php echo $shortcode_name; ?>" placeholder="<?php esc_attr_e('Enter layout name', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                </div>
                            </li>

                            <li class="display-layout_type">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Timeline Layout ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select timeline Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $bdp_timeline_layout = '';
                                    if (isset($bdp_settings['bdp_timeline_layout'])) {
                                        $bdp_timeline_layout = $bdp_settings['bdp_timeline_layout'];
                                    }
                                    ?>
                                    <select id="bdp_timeline_layout" name="bdp_timeline_layout">
                                        <option value="" <?php echo selected('', $bdp_timeline_layout); ?>><?php _e('Default Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="left_side" <?php echo selected('left_side', $bdp_timeline_layout); ?>><?php _e('Left Side', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="right_side" <?php echo selected('right_side', $bdp_timeline_layout); ?>><?php _e('Right Side', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="center" <?php echo selected('center', $bdp_timeline_layout); ?>><?php _e('Center', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post type', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Post type for blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <select name="custom_post_type" id="custom_post_type" >
                                        <?php
                                        if (!isset($bdp_settings['custom_post_type']) || empty($bdp_settings['custom_post_type'])) {
                                            $bdp_settings['custom_post_type'] = "post";
                                        }
                                        $args = array('public' => true, '_builtin' => false);
                                        $post_types = get_post_types($args, 'objects');
                                        ?>
                                        <option value="post" <?php
                                        if ($bdp_settings['custom_post_type'] == 'post') {
                                            echo "selected=selected";
                                        }
                                        ?>><?php _e('Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <?php
                                        if ($post_types) {
                                            foreach ($post_types as $post_type) {
                                                if ($post_type != 'product') {
                                                    ?>
                                                    <option value="<?php echo $post_type->name; ?>" <?php
                                                    if ($bdp_settings['custom_post_type'] == $post_type->name) {
                                                        echo "selected=selected";
                                                    }
                                                    ?>>
                                                        <?php echo $post_type->label; ?></option><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </li>

                            <li class="bdp-caution">
                                <div class="bdp-setting-description">
                                        <b class="note"><?php _e("Caution", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b> &nbsp;
                                        <?php
                                        _e('You are about to select the page for your layout. This will overwrite all the content on the page that you will select. Changes once lost connot be recovered. Please be cautious.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        ?>
                                </div>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Page for Blog', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select page for display blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (!isset($bdp_settings['blog_page_display']))
                                        $bdp_settings['blog_page_display'] = "";
                                    echo wp_dropdown_pages(
                                            array(
                                                'name' => 'blog_page_display',
                                                'echo' => 0,
                                                'show_option_none' => '--  ' . __('Select Page', BLOGDESIGNERPRO_TEXTDOMAIN) . '  --',
                                                'option_none_value' => '0',
                                                'selected' => $bdp_settings['blog_page_display'],
                                                'depth' => -1
                                    ));
                                    ?>
                                </div>
                            </li>

                            <li class="bdp_posts_per_page">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Number of Posts to Display', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select number of posts to display on page', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (!isset($bdp_settings['posts_per_page'])) {
                                        $bdp_settings['posts_per_page'] = get_option('posts_per_page');
                                    }
                                    ?>
                                    <input name="posts_per_page" type="number" step="1" min="1" id="posts_per_page"
                                           value="<?php echo $bdp_settings['posts_per_page']; ?>" class="" onkeypress="return isNumberKey(event)" />
                                </div>
                            </li>

                            <li class="bdp-display-settings">
                                <h3 class="bdp-table-title"><?php _e('Display Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>

                                <div class="bdp-typography-wrapper bdp-button-settings">
                                    <?php
                                    $custom_posttype = $bdp_settings['custom_post_type'];
                                    if($custom_posttype != 'post') {
                                        $taxonomy_names = get_object_taxonomies($custom_posttype, 'objects');
                                        $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                                        if (!empty($taxonomy_names)) {
                                            foreach ($taxonomy_names as $taxonomy_name) {
                                                if (!empty($taxonomy_name)) {
                                                    ?>
                                                    <div class="bdp-typography-cover display-custom-taxonomy">
                                                        <div class="bdp-typography-label">
                                                            <span class="bd-key-title">
                                                                <?php echo $taxonomy_name->label; ?>
                                                            </span>
                                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php echo __('Enable/Disable', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label .' '. __('in blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                                        </div>
                                                        <div class="bdp-typography-content">
                                                            <?php
                                                            $_name = 'display_taxonomy_'. $taxonomy_name->name;
                                                            $display_custom_tax = isset($bdp_settings[$_name]) ? $bdp_settings[$_name] : 0;
                                                            ?>
                                                            <fieldset class="bdp-social-options bdp-display_tax buttonset">
                                                                <input id="<?php echo $_name.'_1'; ?>" name="<?php echo $_name; ?>" type="radio" value="1" <?php echo checked(1, $display_custom_tax); ?>/>
                                                                <label for="<?php echo $_name.'_1'; ?>"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                                <input id="<?php echo $_name.'_0'; ?>" name="<?php echo $_name; ?>" type="radio" value="0" <?php echo checked(0, $display_custom_tax); ?> />
                                                                <label for="<?php echo $_name.'_0'; ?>"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                            </fieldset>
                                                            </label><label class="disable_link">
                                                                <input id="disable_link_taxonomy_<?php echo $taxonomy_name->name; ?>" name="disable_link_taxonomy_<?php echo $taxonomy_name->name; ?>" type="checkbox" value="1" <?php
                                                                if (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy_name->name])) {
                                                                    checked(1, $bdp_settings['disable_link_taxonomy_' . $taxonomy_name->name]);
                                                                }
                                                                ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                    } else {
                                        ?>
                                        <div class="bdp-typography-cover display-custom-taxonomy">
                                            <div class="bdp-typography-label">
                                                <span class="bd-key-title">
                                                    <?php _e('Post Category', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                                </span>
                                                <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post category on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                            </div>
                                            <div class="bdp-typography-content">
                                                <?php $display_category = isset($bdp_settings['display_category']) ? $bdp_settings['display_category'] : 0; ?>
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
                                                    ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                                </label>
                                                <label class="filter_data">
                                                    <input id="filter_cat" name="filter_category" type="checkbox" value="1" <?php
                                                    if (isset($bdp_settings['filter_category'])) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> /> <?php _e('Display Filter for Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="bdp-typography-cover display-custom-taxonomy">
                                            <div class="bdp-typography-label">
                                                <span class="bd-key-title">
                                                    <?php _e('Post Tag', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                                </span>
                                                <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post tag on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                            </div>
                                            <div class="bdp-typography-content">
                                                <?php $display_tag = isset($bdp_settings['display_tag']) ? $bdp_settings['display_tag'] : 1;?>
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
                                                    ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                                </label>
                                                <label class="filter_data">
                                                    <input id="filter_tag" name="filter_tags" type="checkbox" value="1" <?php
                                                    if (isset($bdp_settings['filter_tags'])) {
                                                        echo 'checked="checked"';
                                                    }
                                                    ?> /> <?php _e('Display Filter for Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bd-key-title">
                                                <?php _e('Post Author', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="display_author_1" name="display_author" type="radio" value="1"  <?php checked(1, $bdp_settings['display_author']); ?> />
                                                <label for="display_author_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_author_0" name="display_author" type="radio" value="0" <?php checked(0, $bdp_settings['display_author']); ?> />
                                                <label for="display_author_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_author" name="disable_link_author" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_author'])) {
                                                    checked(1, $bdp_settings['disable_link_author']);
                                                }
                                                ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bd-key-title">
                                                <?php _e('Post Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post publish date on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-display_date buttonset buttonset-hide ui-buttonset" data-hide="1">
                                                <input id="display_date_1" name="display_date" type="radio" value="1" <?php checked(1, $bdp_settings['display_date']); ?> />
                                                <label for="display_date_1" <?php checked(1, $bdp_settings['display_date']); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_date_0" name="display_date" type="radio" value="0" <?php checked(0, $bdp_settings['display_date']); ?> />
                                                <label for="display_date_0" <?php checked(0, $bdp_settings['display_date']); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_date" name="disable_link_date" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_date'])) {
                                                    checked(1, $bdp_settings['disable_link_date']);
                                                }
                                                ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                            <label class="filter_data">
                                                <input id="filter_date" name="filter_date" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['filter_date'])) {
                                                    checked(1, $bdp_settings['filter_date']);
                                                }
                                                ?> /> <?php _e('Display Filter for Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover display_comment">
                                        <div class="bdp-typography-label">
                                            <span class="bd-key-title">
                                                <?php _e('Post Comment Count', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post comment on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_comment_count = isset($bdp_settings['display_comment_count']) ? $bdp_settings['display_comment_count'] : '1';?>
                                            <fieldset class="bdp-social-options bdp-display_comment_count buttonset buttonset-hide ui-buttonset" data-hide="1">
                                                <input id="display_comment_count_1" name="display_comment_count" type="radio" value="1" <?php checked(1, $display_comment_count); ?> />
                                                <label for="display_comment_count_1" <?php checked(1, $display_comment_count); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_comment_count_0" name="display_comment_count" type="radio" value="0" <?php checked(0, $display_comment_count); ?> />
                                                <label for="display_comment_count_0" <?php checked(0, $display_comment_count); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                            <label class="disable_link">
                                                <input id="disable_link_comment" name="disable_link_comment" type="checkbox" value="1" <?php
                                                if (isset($bdp_settings['disable_link_comment'])) {
                                                    checked(1, $bdp_settings['disable_link_comment']);
                                                }
                                                ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover display-postlike">
                                        <div class="bdp-typography-label">
                                            <span class="bd-key-title">
                                                <?php _e('Post Like', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post like on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
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

                                    <div class="bdp-typography-cover display_year">
                                        <div class="bdp-typography-label">
                                            <span class="bd-key-title">
                                                <?php _e('Post Published Year', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post published year on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $display_story_year = isset($bdp_settings['display_story_year']) ? $bdp_settings['display_story_year'] : '1'; ?>
                                            <fieldset class="bdp-social-options bdp-display_year buttonset buttonset-hide ui-buttonset" data-hide="1">
                                                <input id="display_story_year_1" name="display_story_year" type="radio" value="1" <?php checked(1, $display_story_year); ?> />
                                                <label for="display_story_year_1" <?php checked(1, $display_story_year); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="display_story_year_0" name="display_story_year" type="radio" value="0" <?php checked(0, $display_story_year); ?> />
                                                <label for="display_story_year_0" <?php checked(0, $display_story_year); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom CSS', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-textarea"><span class="bdp-tooltips"><?php _e('Write a "Custom CSS" to add your additional design for blog page', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <textarea placeholder=".class_name{ color:#ffffff }" name="custom_css" id="custom_css"><?php if (isset($bdp_settings['custom_css'])) echo stripslashes($bdp_settings['custom_css']); ?></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="dbptimeline" class="postbox postbox-with-fw-options" <?php echo $dbptimeline_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Timeline Bar ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable timeline bar on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_timeline_bar = isset($bdp_settings['display_timeline_bar']) ? $bdp_settings['display_timeline_bar'] : ''; ?>
                                    <fieldset class="bdp-social-options bdp-display_timeline_bar buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="display_timeline_bar_0" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="0" <?php checked(0, $display_timeline_bar); ?> />
                                        <label for="display_timeline_bar_0" <?php checked(0, $display_timeline_bar); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_timeline_bar_1" name="display_timeline_bar" class="display_timeline_bar" type="radio" value="1" <?php checked(1, $display_timeline_bar); ?> />
                                        <label for="display_timeline_bar_1" <?php checked(1, $display_timeline_bar); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Active Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right active_post_list">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post to start timeline layout with some specific post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $timeline_start_from = (isset($bdp_settings['timeline_start_from']) && $bdp_settings['timeline_start_from'] != '') ? $bdp_settings['timeline_start_from'] : '';
                                    $post_type_hori = isset($bdp_settings['custom_post_type']) ? $bdp_settings['custom_post_type'] : 'post';
                                    query_posts('showposts=-1&post_status=publish&post_type=' . $post_type_hori);
                                    if (have_posts()) {
                                        echo '<select name="timeline_start_from" id="timeline_start_from">';
                                        while (have_posts()) {
                                            the_post();
                                            ?>
                                            <option value="<?php echo get_the_date('d/m/Y'); ?>" <?php echo ($timeline_start_from == get_the_date('d/m/Y') ) ? 'selected="selected"' : '' ?>><?php echo get_the_title(); ?></option>
                                            <?php
                                        } echo '</select>';
                                    } else {
                                        echo '<p>';
                                        _e('No posts found.');
                                        echo '</p>';
                                    }
                                    ?>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Posts Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select the transition effect for blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_easing = isset($bdp_settings['template_easing']) ? $bdp_settings['template_easing'] : 'easeInQuad'; ?>
                                    <select name="template_easing" id="template_easing">
                                        <option value="easeInQuad" <?php echo $template_easing == 'easeInQuad' ? 'selected="selected"' : '' ?>><?php _e('easeInQuad', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutQuad" <?php echo $template_easing == 'easeOutQuad' ? 'selected="selected"' : '' ?>><?php _e('easeOutQuad', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutQuad" <?php echo $template_easing == 'easeInOutQuad' ? 'selected="selected"' : '' ?>><?php _e('easeInOutQuad', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInCubic" <?php echo $template_easing == 'easeInCubic' ? 'selected="selected"' : '' ?>><?php _e('easeInCubic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutCubic" <?php echo $template_easing == 'easeInCubic' ? 'selected="selected"' : '' ?>><?php _e('easeInCubic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutCubic" <?php echo $template_easing == 'easeInOutCubic' ? 'selected="selected"' : '' ?>><?php _e('easeInOutCubic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInQuart" <?php echo $template_easing == 'easeInQuart' ? 'selected="selected"' : '' ?>><?php _e('easeInQuart', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutQuart" <?php echo $template_easing == 'easeOutQuart' ? 'selected="selected"' : '' ?>><?php _e('easeOutQuart', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutQuart" <?php echo $template_easing == 'easeInOutQuart' ? 'selected="selected"' : '' ?>><?php _e('easeInOutQuart', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInQuint" <?php echo $template_easing == 'easeInQuint' ? 'selected="selected"' : '' ?>><?php _e('easeInQuint', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutQuint" <?php echo $template_easing == 'easeOutQuint' ? 'selected="selected"' : '' ?>><?php _e('easeOutQuint', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutQuint" <?php echo $template_easing == 'easeInOutQuint' ? 'selected="selected"' : '' ?>><?php _e('easeInOutQuint', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInSine" <?php echo $template_easing == 'easeInSine' ? 'selected="selected"' : '' ?>><?php _e('easeInSine', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutSine" <?php echo $template_easing == 'easeOutSine' ? 'selected="selected"' : '' ?>><?php _e('easeOutSine', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutSine" <?php echo $template_easing == 'easeInOutSine' ? 'selected="selected"' : '' ?>><?php _e('easeInOutSine', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInExpo" <?php echo $template_easing == 'easeInExpo' ? 'selected="selected"' : '' ?>><?php _e('easeInExpo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutExpo" <?php echo $template_easing == 'easeOutExpo' ? 'selected="selected"' : '' ?>><?php _e('easeOutExpo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutExpo" <?php echo $template_easing == 'easeInOutExpo' ? 'selected="selected"' : '' ?>><?php _e('easeInOutExpo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInCirc" <?php echo $template_easing == 'easeInCirc' ? 'selected="selected"' : '' ?>><?php _e('easeInCirc', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutCirc" <?php echo $template_easing == 'easeOutCirc' ? 'selected="selected"' : '' ?>><?php _e('easeOutCirc', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutCirc" <?php echo $template_easing == 'easeInOutCirc' ? 'selected="selected"' : '' ?>><?php _e('easeInOutCirc', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutCirc" <?php echo $template_easing == 'easeOutCirc' ? 'selected="selected"' : '' ?>><?php _e('easeOutCirc', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutCirc" <?php echo $template_easing == 'easeInOutCirc' ? 'selected="selected"' : '' ?>><?php _e('easeInOutCirc', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInElastic" <?php echo $template_easing == 'easeInElastic' ? 'selected="selected"' : '' ?>><?php _e('easeInElastic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutElastic" <?php echo $template_easing == 'easeOutElastic' ? 'selected="selected"' : '' ?>><?php _e('easeOutElastic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutElastic" <?php echo $template_easing == 'easeInOutElastic' ? 'selected="selected"' : '' ?>><?php _e('easeInOutElastic', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInBack" <?php echo $template_easing == 'easeInBack' ? 'selected="selected"' : '' ?>><?php _e('easeInBack', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutBack" <?php echo $template_easing == 'easeOutBack' ? 'selected="selected"' : '' ?>><?php _e('easeOutBack', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutBack" <?php echo $template_easing == 'easeInOutBack' ? 'selected="selected"' : '' ?>><?php _e('easeInOutBack', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInBounce" <?php echo $template_easing == 'easeInBounce' ? 'selected="selected"' : '' ?>><?php _e('easeInBounce', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeOutBounce" <?php echo $template_easing == 'easeOutBounce' ? 'selected="selected"' : '' ?>><?php _e('easeOutBounce', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="easeInOutBounce" <?php echo $template_easing == 'easeInOutBounce' ? 'selected="selected"' : '' ?>><?php _e('easeInOutBounce', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Width (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select the width of the post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="number" name="item_width" id="item_width" min="100" max="1100" step="1" onblur="if (this.value <= 100)
                                            (this.value = 100)" value="<?php echo (isset($bdp_settings['item_width']) ? $bdp_settings['item_width'] : 400) ?>">
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Item Height (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select the height of the post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="number" name="item_height" id="item_height" min="100" max="1100" step="1" onblur="if (this.value <= 100)
                                            (this.value = 100)" value="<?php echo (isset($bdp_settings['item_height']) ? $bdp_settings['item_height'] : 570) ?>">
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Margin between Blog Post (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select the margin for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_post_margin = (isset($bdp_settings['template_post_margin']) && $bdp_settings['template_post_margin'] != "") ? $bdp_settings['template_post_margin'] : 20; ?>
                                    <div class="grid_col_space range_slider_fontsize" id="template_template_post_marginInput" data-value="<?php echo $template_post_margin; ?>" ></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="template_post_margin" id="template_post_margin" value="<?php echo $template_post_margin; ?>" /></div>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Enable Autoslide', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable autoslide', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $enable_autoslide = ((isset($bdp_settings['enable_autoslide']) && $bdp_settings['enable_autoslide'] != "")) ? $bdp_settings['enable_autoslide'] : 1; ?>
                                    <fieldset class="bdp-social-options bdp-enable_autoslide buttonset buttonset-hide ui-buttonset" data-hide="1">
                                        <input id="enable_autoslide_1" name="enable_autoslide" class="enable_autoslide" type="radio" value="1" <?php checked(1, $enable_autoslide); ?> />
                                        <label for="enable_autoslide_1" <?php checked(1, $enable_autoslide); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="enable_autoslide_0" name="enable_autoslide" class="enable_autoslide" type="radio" value="0" <?php checked(0, $enable_autoslide); ?> />
                                        <label for="enable_autoslide_0" <?php checked(0, $enable_autoslide); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="scroll_speed_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Scrolling Speed', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select the slide speed', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="number" name="scroll_speed" id="scroll_speed" min="500" step="100" onblur="if (this.value <= 500)
                                            (this.value = 500)" value="<?php echo (isset($bdp_settings['scroll_speed']) ? $bdp_settings['scroll_speed'] : 1000) ?>">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="bdpstandard" class="postbox postbox-with-fw-options" <?php echo $bdpstandard_class_show; ?>>
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

                            <li class="column_setting_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Set Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Desktop - Above', BLOGDESIGNERPRO_TEXTDOMAIN) . ' 980px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $template_name = (isset($bdp_settings['template_name']) && $bdp_settings['template_name'] != '') ? $bdp_settings['template_name'] : '';
                                    $column = ($template_name == 'chapter') ? 3 : 2;
                                    $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : $column;
                                    ?>
                                    <select id="column_setting" name="column_setting">
                                        <option value="1" <?php echo ($column_setting == 1) ? 'selected="selected"' : ''; ?> > <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="2" <?php echo ($column_setting == 2) ? 'selected="selected"' : ''; ?>> <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="3" <?php echo ($column_setting == 3) ? 'selected="selected"' : ''; ?>> <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="4" <?php echo ($column_setting == 4) ? 'selected="selected"' : ''; ?>> <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                    </select>
                                </div>
                            </li>

                            <li class="column_setting_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Set Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('iPad', BLOGDESIGNERPRO_TEXTDOMAIN) . ' - 720px - 980px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $template_name = (isset($bdp_settings['template_name']) && $bdp_settings['template_name'] != '') ? $bdp_settings['template_name'] : '';
                                    $column = ($template_name == 'chapter') ? 3 : 2;
                                    $column_setting = (isset($bdp_settings['column_setting_ipad']) && $bdp_settings['column_setting_ipad'] != '') ? $bdp_settings['column_setting_ipad'] : $column;
                                    ?>
                                    <select id="column_setting_ipad" name="column_setting_ipad">
                                        <option value="1" <?php echo ($column_setting == 1) ? 'selected="selected"' : ''; ?> > <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="2" <?php echo ($column_setting == 2) ? 'selected="selected"' : ''; ?>> <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="3" <?php echo ($column_setting == 3) ? 'selected="selected"' : ''; ?>> <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="4" <?php echo ($column_setting == 4) ? 'selected="selected"' : ''; ?>> <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                    </select>
                                </div>
                            </li>

                            <li class="column_setting_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Set Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Tablet', BLOGDESIGNERPRO_TEXTDOMAIN) . ' - 480px - 720px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $template_name = (isset($bdp_settings['template_name']) && $bdp_settings['template_name'] != '') ? $bdp_settings['template_name'] : '';
                                    $column = ($template_name == 'chapter') ? 2 : 1;
                                    $column_setting = (isset($bdp_settings['column_setting_tablet']) && $bdp_settings['column_setting_tablet'] != '') ? $bdp_settings['column_setting_tablet'] : $column;
                                    ?>
                                    <select id="column_setting_tablet" name="column_setting_tablet">
                                        <option value="1" <?php echo ($column_setting == 1) ? 'selected="selected"' : ''; ?> > <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="2" <?php echo ($column_setting == 2) ? 'selected="selected"' : ''; ?>> <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="3" <?php echo ($column_setting == 3) ? 'selected="selected"' : ''; ?>> <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="4" <?php echo ($column_setting == 4) ? 'selected="selected"' : ''; ?>> <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                    </select>
                                </div>
                            </li>

                            <li class="column_setting_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Set Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Mobile - Smaller Than', BLOGDESIGNERPRO_TEXTDOMAIN) . ' 480px </i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php  $column_setting = (isset($bdp_settings['column_setting_mobile']) && $bdp_settings['column_setting_mobile'] != '') ? $bdp_settings['column_setting_mobile'] : 1; ?>
                                    <select id="column_setting_mobile" name="column_setting_mobile">
                                        <option value="1" <?php echo ($column_setting == 1) ? 'selected="selected"' : ''; ?> > <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="2" <?php echo ($column_setting == 2) ? 'selected="selected"' : ''; ?>> <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="3" <?php echo ($column_setting == 3) ? 'selected="selected"' : ''; ?>> <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                        <option value="4" <?php echo ($column_setting == 4) ? 'selected="selected"' : ''; ?>> <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </option>
                                    </select>
                                </div>
                            </li>

                            <li class="blog_unique_design_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Unique Design', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable unique design for specific post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <label>
                                        <input id="blog_unique_design" name="blog_unique_design" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['blog_unique_design'])) {
                                            checked(1, $bdp_settings['blog_unique_design']);
                                        }
                                        ?> />
                                    </label>
                                </div>
                            </li>

                            <li class="blog-unique-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Unique Design for first post or Featured posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Unique Design for first post or Featured posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["unique_design_option"] = isset($bdp_settings["unique_design_option"]) ? $bdp_settings["unique_design_option"] : 'first_post'; ?>
                                    <select name="unique_design_option" id="unique_design_option">
                                        <option value="first_post" <?php if ($bdp_settings["unique_design_option"] == 'first_post') { ?> selected="selected"<?php } ?>>
                                            <?php _e('First Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="featured_posts" <?php if ($bdp_settings["unique_design_option"] == 'featured_posts') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Featured Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b>
                                        <?php _e('If you selected featured post option, then unique design apply on sticky post.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>

                            <li class="blog-columns-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo _e('Blog Grid Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Desktop - Above', BLOGDESIGNERPRO_TEXTDOMAIN) . ' 980px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_columns"] = isset($bdp_settings["template_columns"]) ? $bdp_settings["template_columns"] : 2; ?>
                                    <select name="template_columns" id="template_columns">
                                        <option value="1" <?php if ($bdp_settings["template_columns"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_columns"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_columns"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_columns"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="blog-columns-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo _e('Blog Grid Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('iPad', BLOGDESIGNERPRO_TEXTDOMAIN) . ' - 720px - 980px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php  $bdp_settings["template_columns_ipad"] = isset($bdp_settings["template_columns_ipad"]) ? $bdp_settings["template_columns_ipad"] : 1; ?>
                                    <select name="template_columns_ipad" id="template_columns_ipad">
                                        <option value="1" <?php if ($bdp_settings["template_columns_ipad"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_columns_ipad"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_columns_ipad"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_columns_ipad"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="blog-columns-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo _e('Blog Grid Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Tablet', BLOGDESIGNERPRO_TEXTDOMAIN) . ' - 480px - 720px</i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_columns_tablet"] = isset($bdp_settings["template_columns_tablet"]) ? $bdp_settings["template_columns_tablet"] : 1 ?>
                                    <select name="template_columns_tablet" id="template_columns_tablet">
                                        <option value="1" <?php if ($bdp_settings["template_columns_tablet"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_columns_tablet"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_columns_tablet"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_columns_tablet"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="blog-columns-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo _e('Blog Grid Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>' . __('Mobile - Smaller Than', BLOGDESIGNERPRO_TEXTDOMAIN) . ' 480px </i>)'; ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_columns_mobile"] = isset($bdp_settings["template_columns_mobile"]) ? $bdp_settings["template_columns_mobile"] : 1; ?>
                                    <select name="template_columns_mobile" id="template_columns_mobile">
                                        <option value="1" <?php if ($bdp_settings["template_columns_mobile"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_columns_mobile"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_columns_mobile"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_columns_mobile"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="hoverbic-hoverbackcolor-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Posts hover Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post hover background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="grid_hoverback_color" id="grid_hoverback_color" value="<?php echo isset($bdp_settings["grid_hoverback_color"]) ? $bdp_settings["grid_hoverback_color"] : '#000000'; ?>"/>
                                </div>
                            </li>

                            <li class="blog-templatecolor-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Posts Template Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post template color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_color" id="template_color" value="<?php echo isset($bdp_settings["template_color"]) ? $bdp_settings["template_color"] : '#000000'; ?>"/>
                                </div>
                            </li>

                            <li class="template_alternative_color">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Posts Alternative Template Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select blog post alternate template color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_alternative_color" id="template_alternative_color" value="<?php echo isset($bdp_settings["template_alternative_color"]) ? $bdp_settings["template_alternative_color"] : '#c34376'; ?>"/>
                                </div>
                            </li>

                            <li class="story-startup-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Border Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story border color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_startup_border_color" id="story_startup_border_color" value="<?php echo isset($bdp_settings["story_startup_border_color"]) ? $bdp_settings["story_startup_border_color"] : '#ffffff'; ?>"/>
                                </div>
                            </li>

                            <li class="blog-template-tr bdp-back-color-blog">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Background Color for Blog Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_bgcolor" id="template_bgcolor" value="<?php echo $bdp_settings["template_bgcolor"]; ?>"/>
                                </div>
                            </li>

                            <li class="blog_background_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Post Feature Image set as Background Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable feature image as post background image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <label>
                                        <input id="blog_background_image" name="blog_background_image" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['blog_background_image'])) {
                                            checked(1, $bdp_settings['blog_background_image']);
                                        }
                                        ?> />
                                    </label>
                                </div>
                            </li>

                            <li class="blog_background_image_tr blog_background_image_style_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Post Background Image Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post background image style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $blog_background_image_style = isset($bdp_settings['blog_background_image_style']) ? $bdp_settings['blog_background_image_style'] : 1; ?>
                                    <fieldset class="bdp-blog_background_image_style buttonset buttonset-hide green" data-hide='1'>
                                        <input id="blog_background_image_style_0" name="blog_background_image_style" type="radio" value="0" <?php checked(0, $blog_background_image_style); ?> />
                                        <label id="bdp-options-button" for="blog_background_image_style_0" <?php checked(0, $blog_background_image_style); ?>><?php _e('Normal', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="blog_background_image_style_1" name="blog_background_image_style" type="radio" value="1" <?php checked(1, $blog_background_image_style); ?> />
                                        <label id="bdp-options-button" for="blog_background_image_style_1" <?php checked(1, $blog_background_image_style); ?>><?php _e('Parallax', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="bdp-back-hover-color-blog">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Background Hover Color for Blog Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post hover background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_bghovercolor" id="template_bghovercolor" value="<?php echo isset($bdp_settings["template_bghovercolor"]) ? $bdp_settings["template_bghovercolor"] : '#eeeeee'; ?>"/>
                                </div>
                            </li>

                            <li class="blog-template-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Alternative Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable alternative background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_alternativebackground = isset($bdp_settings['template_alternativebackground']) ? $bdp_settings['template_alternativebackground'] : 0; ?>
                                    <fieldset class="bdp-social-options bdp-alternative_color buttonset buttonset-hide" data-hide='1'>
                                        <input id="template_alternativebackground_1" type="radio" value="1" name="template_alternativebackground" <?php checked(1, $template_alternativebackground); ?> />
                                        <label for="template_alternativebackground_1" <?php checked(1, $template_alternativebackground); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="template_alternativebackground_0" type="radio" value="0" name="template_alternativebackground" <?php checked(0, $template_alternativebackground); ?> />
                                        <label for="template_alternativebackground_0" <?php checked(0, $template_alternativebackground); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="alternative-color-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Alternative Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select alternative background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_alterbgcolor" id="template_alterbgcolor" value="<?php echo $bdp_settings["template_alterbgcolor"]; ?>"/>
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
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story startup color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_startup_text_color" id="story_startup_text_color"
                                        value="<?php echo isset($bdp_settings["story_startup_text_color"]) ? $bdp_settings["story_startup_text_color"] : '#333'; ?>"
                                        data-default-color="<?php echo isset($bdp_settings["story_startup_text_color"]) ? $bdp_settings["story_startup_text_color"] : '#333'; ?>"/>
                                </div>
                            </li>

                            <li class="story-ending-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Ending Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story ending text', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_ending_text" id="story_ending_text" value="<?php echo isset($bdp_settings["story_ending_text"]) ? $bdp_settings["story_ending_text"] : __('Ending', BLOGDESIGNERPRO_TEXTDOMAIN); ?>"/>
                                </div>
                            </li>

                            <li class="story-ending-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Ending Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter story ending link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_ending_link" id="story_ending_link" value="<?php echo isset($bdp_settings["story_ending_link"]) ? $bdp_settings["story_ending_link"] : ''; ?>"/>
                                </div>
                            </li>

                            <li class="story-ending-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Ending Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story ending background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_ending_background" id="story_ending_background"
                                        value="<?php echo isset($bdp_settings["story_ending_background"]) ? $bdp_settings["story_ending_background"] : '#ade175'; ?>"
                                        data-default-color="<?php echo isset($bdp_settings["story_ending_background"]) ? $bdp_settings["story_ending_background"] : '#ade175'; ?>"/>
                                </div>
                            </li>

                            <li class="story-ending-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Ending Text Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story ending text color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="story_ending_text_color" id="story_ending_text_color"
                                        value="<?php echo isset($bdp_settings["story_ending_text_color"]) ? $bdp_settings["story_ending_text_color"] : '#333'; ?>"
                                        data-default-color="<?php echo isset($bdp_settings["story_ending_text_color"]) ? $bdp_settings["story_ending_text_color"] : '#333'; ?>"/>
                                </div>
                            </li>

                            <li class="story-ending-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Story Post Loop Alignment', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select story post loop alignment', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $post_loop_alignment = isset($bdp_settings["post_loop_alignment"]) ? $bdp_settings["post_loop_alignment"] : 'default'; ?>
                                    <select name="post_loop_alignment" id="story_loop_alignment">
                                        <option value="default" <?php echo selected('default', $post_loop_alignment); ?>>
                                            <?php _e('Default', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="left" <?php echo selected('left', $post_loop_alignment); ?>>
                                            <?php _e('Left', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="right" <?php echo selected('right', $post_loop_alignment); ?>>
                                            <?php _e('Right', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
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
                                        value="<?php echo $bdp_settings["template_ftcolor"]; ?>"
                                        data-default-color="<?php echo $bdp_settings["template_ftcolor"]; ?>"/>
                                </div>
                            </li>

                            <li class="link-hover-color-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Link Hover Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select link hover color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $fthover = isset($bdp_settings["template_fthovercolor"]) ? $bdp_settings["template_fthovercolor"] : ''; ?>
                                    <input type="text" name="template_fthovercolor" id="template_fthovercolor"
                                        value="<?php echo $fthover; ?>"
                                        data-default-color="<?php echo $fthover; ?>"/>
                                </div>
                            </li>

                            <li class="archive_pagination_type">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Pagination Type', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select pagination type', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <select name="pagination_type" id="pagination_type">
                                        <option value="no_pagination" <?php echo selected('no_pagination', $bdp_settings['pagination_type']); ?>>
                                            <?php _e('No Pagination', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="paged" <?php echo selected('paged', $bdp_settings['pagination_type']); ?>>
                                            <?php _e('Paged', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="load_more_btn" <?php echo selected('load_more_btn', $bdp_settings['pagination_type']); ?>>
                                            <?php _e('Load More Button', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="load_onscroll_btn" <?php echo selected('load_onscroll_btn', $bdp_settings['pagination_type']); ?>>
                                            <?php _e('Load On Page Scroll', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="archive_pagination_template">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Pagination Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select pagination template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $pagination_template = isset($bdp_settings['pagination_template']) ? $bdp_settings['pagination_template'] : 'template-1'; ?>
                                    <select name="pagination_template" id="pagination_template">
                                        <option value="template-1" <?php echo selected('template-1', $pagination_template); ?>>
                                            <?php _e('Template 1', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-2" <?php echo selected('template-2', $pagination_template); ?>>
                                            <?php _e('Template 2', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-3" <?php echo selected('template-3', $pagination_template); ?>>
                                            <?php _e('Template 3', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-4" <?php echo selected('template-4', $pagination_template); ?>>
                                            <?php _e('Template 4', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-5" <?php echo selected('template-5', $pagination_template); ?>>
                                            <?php _e('Template 5', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-6" <?php echo selected('template-6', $pagination_template); ?>>
                                            <?php _e('Template 6', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                    <div class="bdp-setting-description bdp-setting-pagination">
                                        <img class="pagination_template_images"src="<?php echo BLOGDESIGNERPRO_URL . '/images/pagination/'.$pagination_template.'.png'; ?>">
                                    </div>
                                </div>
                            </li>

                            <li class="loadmore_btn_option archive_loadmore_btn_template">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Button Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select load more button template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $load_more_button_template = isset($bdp_settings['load_more_button_template']) ? $bdp_settings['load_more_button_template'] : 'template-1'; ?>
                                    <select name="load_more_button_template" id="load_more_button_template">
                                        <option value="template-1" <?php echo selected('template-1', $load_more_button_template); ?>>
                                            <?php _e('Template 1', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-2" <?php echo selected('template-2', $load_more_button_template); ?>>
                                            <?php _e('Template 2', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="template-3" <?php echo selected('template-3', $load_more_button_template); ?>>
                                            <?php _e('Template 3', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                    <div class="bdp-setting-description button-loadmore">
                                        <img class="load_more_button_template_images"src="<?php echo BLOGDESIGNERPRO_URL . '/images/buttons/'.$load_more_button_template.'.png'; ?>">
                                    </div>
                                </div>
                            </li>

                            <li class="loadmore_btn_option">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Load More Button Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter load more button text', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loadmore_button_text = (isset($bdp_settings['loadmore_button_text']) && $bdp_settings['loadmore_button_text'] != '') ? $bdp_settings['loadmore_button_text'] : __('Load More', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    <input type="text" name="loadmore_button_text" id="loadmore_button_text" value="<?php echo $loadmore_button_text; ?>" placeholder="<?php esc_attr_e('Enter load more button text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                </div>
                            </li>

                            <li class="loadmore_btn_option">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Load More Text Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select load more text color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loadmore_button_color = (isset($bdp_settings["loadmore_button_color"]) && $bdp_settings["loadmore_button_color"] != '') ? $bdp_settings["loadmore_button_color"] : '#ffffff'; ?>
                                    <input type="text" name="loadmore_button_color" id="loadmore_button_color" value="<?php echo $loadmore_button_color; ?>"/>
                                </div>
                            </li>

                            <li class="loadmore_btn_option">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Load More Text Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select lead more text background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loadmore_button_bg_color = (isset($bdp_settings["loadmore_button_bg_color"]) && $bdp_settings["loadmore_button_bg_color"] != '') ? $bdp_settings["loadmore_button_bg_color"] : '#444444'; ?>
                                    <input type="text" name="loadmore_button_bg_color" id="loadmore_button_bg_color" value="<?php echo $loadmore_button_bg_color; ?>"/>
                                </div>
                            </li>

                            <li class="archive_loader_template">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Loader Type', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Loader type', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loader_type = isset($bdp_settings['loader_type']) ? $bdp_settings['loader_type'] : 0; ?>
                                    <select name="loader_type" id="pagination_template">
                                        <option value="0" <?php echo selected('0', $loader_type); ?>>
                                            <?php _e('Select Default Loader', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="1" <?php echo selected('1', $loader_type); ?>>
                                            <?php _e('Upload New Loader Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="archive_loader_template default_loader">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Loader Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select loader', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loader_style_hidden = isset($bdp_settings['loader_style_hidden']) ? $bdp_settings['loader_style_hidden'] : 'circularG'?>
                                    <div class="select_button_upper_div ">
                                        <div class="bdp_select_template_button_div">
                                            <input type="button" class="button bdp_select_loader" value="<?php esc_attr_e('Select Loader Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                            <input style="visibility: hidden;" type="hidden" id="loader_style_hidden" class="loader_style_hidden" name="loader_style_hidden" value="<?php echo $loader_style_hidden;?>" />

                                        </div>
                                        <div class="bdp_selected_loader_image">
                                            <div class='bdp-dialog-loader-style' >
                                                <span class="bdp_loader_image_holder loader_hidden" >
                                                    <?php echo $loaders[$loader_style_hidden]; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="archive_loader_template upload_loader">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Loader Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select loader', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="select_button_upper_div ">
                                        <div class="bdp_select_template_button_div">
                                            <?php $loader_image_src = (isset($bdp_settings['bdp_loader_image_src']) && $bdp_settings['bdp_loader_image_src'] != '') ? $bdp_settings['bdp_loader_image_src'] : BLOGDESIGNERPRO_URL . '/images/loading.gif'; ?>
                                            <?php if ($loader_image_src != '') { ?>
                                                <input class="button bdp-remove_upload_image_button" type="button" value="<?php esc_attr_e('Remove Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                            <?php } else { ?>
                                                <input class="button bdp-loader_upload_image_button " type="button" value="<?php esc_attr_e('Upload Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                            <?php } ?>
                                            <input type="hidden" value="<?php echo isset($bdp_settings['bdp_loader_image_id']) ? $bdp_settings['bdp_loader_image_id'] : ''; ?>" name="bdp_loader_image_id" id="bdp_loader_image_id">
                                            <input type="hidden" value="<?php echo $loader_image_src; ?>" name="bdp_loader_image_src" id="bdp_loader_image_src">
                                        </div>
                                        <div class="bdp_selected_loader_image">
                                            <span class="bdp_loader_image_holder">
                                                <?php
                                                if ($loader_image_src != '') {
                                                    echo '<img src="' . $loader_image_src . '"/>';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="archive_loader_template default_loader">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Loader Icon Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select Loader Icon Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $loader_color = isset($bdp_settings["loader_color"]) ? $bdp_settings["loader_color"] : ''; ?>
                                    <input type="text" name="loader_color" id="loader_color"
                                           value="<?php echo $loader_color; ?>"
                                           data-default-color="<?php echo $loader_color; ?>"/>
                                </div>
                            </li>

                            <li class="deport-dash-div" style="display: none;">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Choose Dash Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select dash color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="deport_dashcolor" id="deport_dashcolor"
                                        value="<?php if (isset($bdp_settings["deport_dashcolor"])) echo $bdp_settings["deport_dashcolor"]; ?>"
                                        data-default-color="<?php if (isset($bdp_settings["deport_dashcolor"])) echo $bdp_settings["deport_dashcolor"]; ?>"/>
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

                            <li class="lightbreeze-image-corner" style="display: none;">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Image Corner Selection', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select image corner shape', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $image_corner_selection = isset($bdp_settings['image_corner_selection']) ? $bdp_settings['image_corner_selection'] : 0; ?>
                                    <fieldset class="bdp-social-size buttonset buttonset-hide green" data-hide='1'>
                                        <input id="image_corner_selection_0" name="image_corner_selection" type="radio" value="0" <?php checked(0, $image_corner_selection); ?> />
                                        <label id="bdp-options-button" for="image_corner_selection_0" <?php checked(0, $image_corner_selection); ?>><?php _e('Triangle', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="image_corner_selection_1" name="image_corner_selection" type="radio" value="1" <?php checked(1, $image_corner_selection); ?> />
                                        <label id="bdp-options-button" for="image_corner_selection_1" <?php checked(1, $image_corner_selection); ?>><?php _e('Square', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="image_corner_selection_2" name="image_corner_selection" type="radio" value="2" <?php checked(2, $image_corner_selection); ?> />
                                        <label id="bdp-options-button" for="image_corner_selection_2" <?php checked(2, $image_corner_selection); ?>><?php _e('Round', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="bdptitle" class="postbox postbox-with-fw-options" <?php echo $bdptitle_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight bdp-display-typography">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Title Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e(' Select post title link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : '1'; ?>
                                    <fieldset class="buttonset buttonset-hide" data-hide='1'>
                                        <input id="bdp_post_title_link_1" name="bdp_post_title_link" type="radio" value="1" <?php checked(1, $bdp_post_title_link); ?> />
                                        <label id="bdp-options-button" for="bdp_post_title_link_1" <?php checked(1, $bdp_post_title_link); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="bdp_post_title_link_0" name="bdp_post_title_link" type="radio" value="0" <?php checked(0, $bdp_post_title_link); ?> />
                                        <label id="bdp-options-button" for="bdp_post_title_link_0" <?php checked(0, $bdp_post_title_link); ?>><?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="bdp-gray">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Title Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e(' Select post title color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_titlecolor" id="template_titlecolor" value="<?php echo $bdp_settings["template_titlecolor"]; ?>"/>
                                </div>
                            </li>
                            <li class="title-link-hover-color-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Title Link Hover Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post title link hover color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_titlehovercolor" id="template_titlehovercolor" value="<?php
                                    if (isset($bdp_settings["template_titlehovercolor"])) {
                                        echo $bdp_settings["template_titlehovercolor"];
                                    } else {
                                        echo '#444';
                                    }
                                    ?>"/>
                                </div>
                            </li>
                            <li class="titlebackcolor_tr bdp-gray">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Title Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post title background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_titlebackcolor" id="template_titlebackcolor" value="<?php echo $bdp_settings["template_titlebackcolor"]; ?>"/>
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
                                            <?php
                                            if (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') {
                                                $template_titlefontface = $bdp_settings['template_titlefontface'];
                                            } else {
                                                $template_titlefontface = '';
                                            }
                                            $font_family = bdp_default_recognized_font_faces();
                                            ?>
                                            <div class="typo-field">
                                                <input type="hidden" id="template_titlefontface_font_type" name="template_titlefontface_font_type" value="<?php echo isset($bdp_settings['template_titlefontface_font_type']) ? $bdp_settings['template_titlefontface_font_type'] : '' ?>">
                                                <div class='select-cover'>
                                                    <select name="template_titlefontface" id="template_titlefontface">
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
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                            <?php _e('Font Size (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            if (isset($bdp_settings['template_titlefontsize']) && $bdp_settings['template_titlefontsize'] != "") {
                                                $template_titlefontsize = $bdp_settings['template_titlefontsize'];
                                            } else {
                                                $template_titlefontsize = 14;
                                            }
                                            ?>
                                            <div class="grid_col_space range_slider_fontsize" id="template_postTitlefontsizeInput" data-value="<?php echo $template_titlefontsize; ?>"></div>
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
                                                <input type="number" name="template_title_font_line_height" id="template_title_font_line_height" step="0.1" min="0" value="<?php echo isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '1.5'; ?>" onkeypress="return isNumberKey(event)" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                            <?php _e('Italic Font Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable Italic font style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
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
                                            <?php _e('Text Decoration', BLOGDESIGNERPRO_TEXTDOMAIN);?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text decoration style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>

                                        <div class="bdp-typography-content">
                                            <div class="select-cover">
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
                <div id="bdpcontent" class="postbox postbox-with-fw-options bdp-content-setting1" <?php echo $bdpcontent_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight bdp-display-typography">
                            <li class="feed_excert">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('For each Article in a Feed, Show ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('To display full text for each post, select full text option, otherwise select the summary option.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <fieldset class="bdp-rss_use_excerpt buttonset buttonset-hide green" data-hide='1'>
                                        <input id="rss_use_excerpt_0" name="rss_use_excerpt" type="radio" value="0" <?php checked(0, $bdp_settings['rss_use_excerpt']); ?> />
                                        <label id="bdp-options-button" for="rss_use_excerpt_0" <?php checked(0, $bdp_settings['rss_use_excerpt']); ?>><?php _e('Full Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="rss_use_excerpt_1" name="rss_use_excerpt" type="radio" value="1" <?php checked(1, $bdp_settings['rss_use_excerpt']); ?> />
                                        <label id="bdp-options-button" for="rss_use_excerpt_1" <?php checked(1, $bdp_settings['rss_use_excerpt']); ?>><?php _e('Summary', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="post_content_from">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Show Content From', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('To display text from post content or from post excerpt', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_post_content_from = isset($bdp_settings['template_post_content_from']) ? $bdp_settings['template_post_content_from'] : 'from_content'; ?>
                                    <select name="template_post_content_from" id="template_post_content_from">
                                        <option value="from_content" <?php selected($template_post_content_from, 'from_content'); ?> ><?php _e('Post Content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="from_excerpt" <?php selected($template_post_content_from, 'from_excerpt'); ?>><?php _e('Post Excerpt', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b>
                                        <?php _e('If Post Excerpt is empty then Content will get automatically from Post Content.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>

                            <li class="display_html_tags_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display HTML tags with Summary', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show HTML tags with summary', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_html_tags = (isset($bdp_settings['display_html_tags'])) ? $bdp_settings['display_html_tags'] : 0; ?>
                                    <fieldset class="buttonset display_html_tags">
                                        <input id="display_html_tags_1" name="display_html_tags" type="radio" value="1" <?php checked(1, $display_html_tags); ?> />
                                        <label for="display_html_tags_1" <?php checked(1, $display_html_tags); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_html_tags_0" name="display_html_tags" type="radio" value="0" <?php checked(0, $display_html_tags); ?> />
                                        <label for="display_html_tags_0" <?php checked(0, $display_html_tags); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="content-firstletter-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('First letter as Dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable first letter as Dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $firstletter_big = (isset($bdp_settings['firstletter_big'])) ? $bdp_settings['firstletter_big'] : 0; ?>
                                    <fieldset class="buttonset firstletter_big">
                                        <input id="firstletter_big_1" name="firstletter_big" type="radio" value="1" <?php checked(1, $firstletter_big); ?> />
                                        <label for="firstletter_big_1" <?php checked(1, $firstletter_big); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="firstletter_big_0" name="firstletter_big" type="radio" value="0" <?php checked(0, $firstletter_big); ?> />
                                        <label for="firstletter_big_0" <?php checked(0, $firstletter_big); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="firstletter-setting bdp-dropcap-settings">
                                <h3 class="bdp-table-title"><?php _e('Dropcap Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-typography-wrapper bdp-typography-wrapper1">
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Dropcap Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font family for dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : ''; ?>
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
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Dropcap Font Size (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size for dropcap', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != "") ? $bdp_settings['firstletter_fontsize'] : 35; ?>
                                                <div class="grid_col_space range_slider_fontsize" id="firstletter_fontsize_slider" ></div>
                                                <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="firstletter_fontsize" id="firstletter_fontsize" value="<?php echo $firstletter_fontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Dropcap Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select dropcap color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            if (isset($bdp_settings["firstletter_contentcolor"])) {
                                                $firstletter_contentcolor = $bdp_settings["firstletter_contentcolor"];
                                            } else {
                                                $firstletter_contentcolor = '#000000';
                                            }
                                            ?>
                                            <input type="text" name="firstletter_contentcolor" id="firstletter_contentcolor" value="<?php echo $firstletter_contentcolor; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="excerpt_length">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Enter post content length (words)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter post content length in number of words', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="number" id="txtExcerptlength" name="txtExcerptlength" step="1" min="0" value="<?php echo $bdp_settings['txtExcerptlength']; ?>" placeholder="<?php esc_attr_e('Enter content length', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" onkeypress="return isNumberKey(event)">
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b> &nbsp;
                                        <?php _e('Post Content Length option will not work if you have selected "Post Excerpt" from above SHOW CONTENT FROM setting.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        ?>
                                    </div>
                                </div>
                            </li>

                            <li class="advance_contents_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Advance Post Contents', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable Advance Blog Contents', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $advance_contents = (isset($bdp_settings['advance_contents'])) ? $bdp_settings['advance_contents'] : 0; ?>
                                    <fieldset class="buttonset advance_contents">
                                        <input id="advance_contents_1" name="advance_contents" type="radio" value="1" <?php checked(1, $advance_contents); ?> />
                                        <label for="advance_contents_1" <?php checked(1, $advance_contents); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="advance_contents_0" name="advance_contents" type="radio" value="0" <?php checked(0, $advance_contents); ?> />
                                        <label for="advance_contents_0" <?php checked(0, $advance_contents); ?>><?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="advance_contents_tr advance_contents_settings">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Stopage From', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Display content stoppage from', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $contents_stopage_from = isset($bdp_settings['contents_stopage_from']) ? $bdp_settings['contents_stopage_from'] : 'paragraph'; ?>
                                    <select name="contents_stopage_from" id="contents_stopage_from">
                                        <option value="paragraph" <?php selected($contents_stopage_from, 'paragraph'); ?> ><?php _e('Last Paragraph', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="character" <?php selected($contents_stopage_from, 'character'); ?>><?php _e('Characters', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b> &nbsp;
                                        <?php _e('If "Display HTML tags with Summary" is Enable then Stopage From Characters option is disable.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </div>
                                </div>
                            </li>

                            <li class="advance_contents_tr advance_contents_settings advance_contents_settings_character">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Stopage Characters', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select display content stoppage characters', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $contents_stopage_character = isset($bdp_settings['contents_stopage_character']) ? $bdp_settings['contents_stopage_character'] : array('.'); ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose stoppage characters', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="contents_stopage_character[]" id="contents_stopage_character">
                                        <option value="." <?php echo (in_array('.', $contents_stopage_character)) ? 'selected="selected"' : ''; ?>> . </option>
                                        <option value="?" <?php echo (in_array('?', $contents_stopage_character)) ? 'selected="selected"' : ''; ?>> ? </option>
                                        <option value="," <?php echo (in_array(',', $contents_stopage_character)) ? 'selected="selected"' : ''; ?>> , </option>
                                        <option value=";" <?php echo (in_array(';', $contents_stopage_character)) ? 'selected="selected"' : ''; ?>> ; </option>
                                        <option value=":" <?php echo (in_array(':', $contents_stopage_character)) ? 'selected="selected"' : ''; ?>> : </option>
                                    </select>
                                </div>
                            </li>

                            <li class="contentcolor_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Content Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select post content color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_contentcolor" id="template_contentcolor" value="<?php echo $bdp_settings["template_contentcolor"]; ?>"/>
                                </div>
                            </li>

                            <li class="post_content_hover">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Content Section Hover Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post content hover background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_content_hovercolor" id="template_content_hovercolor" value="<?php echo $bdp_settings["template_content_hovercolor"]; ?>"/>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Read More Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable to show read more post link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : '1'; ?>
                                    <fieldset class="bdp-social-options bdp-read_more_link buttonset buttonset-hide ui-buttonset">
                                        <input id="read_more_link_1" name="read_more_link" type="radio" value="1" <?php checked(1, $read_more_link); ?> />
                                        <label for="read_more_link_1" <?php checked(1, $read_more_link); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="read_more_link_0" name="read_more_link" type="radio" value="0" <?php checked(0, $read_more_link); ?> />
                                        <label for="read_more_link_0" <?php checked(0, $read_more_link); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="read_more_text read_more_wrap">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Read More Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter read more text label', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="txtReadmoretext" id="txtReadmoretext" value="<?php echo $bdp_settings['txtReadmoretext']; ?>" placeholder="Enter read more text">
                                </div>
                            </li>

                            <li class="read_more_wrap">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Read More Link ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select read more link type.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $post_link_type = isset($bdp_settings['post_link_type']) ? $bdp_settings['post_link_type'] : '0'; ?>
                                    <fieldset class="bdp-post_link_type buttonset buttonset-hide green" data-hide='1'>
                                        <input id="post_link_type_0" name="post_link_type" type="radio" value="0" <?php checked(0, $post_link_type); ?> />
                                        <label id="bdp-options-button" for="post_link_type_0" <?php checked(0, $post_link_type); ?>><?php _e('Post Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="post_link_type_1" name="post_link_type" type="radio" value="1" <?php checked(1, $post_link_type); ?> />
                                        <label id="bdp-options-button" for="post_link_type_1" <?php checked(1, $post_link_type); ?>><?php _e('Custom Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="read_more_wrap custom_link_url">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Link URL ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter custom link url.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $custom_link_url = isset($bdp_settings["custom_link_url"]) ? $bdp_settings["custom_link_url"] : ''; ?>
                                        <input type="text" name="custom_link_url" id="custom_link_url" value="<?php echo $custom_link_url; ?>" placeholder="<?php echo __('eg. ', BLOGDESIGNERPRO_TEXTDOMAIN) .get_site_url();?>" />
                                </div>
                            </li>

                            <li class="read_more_wrap read_more_text_color">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Read More Text Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select Read more text color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_readmorecolor" id="template_readmorecolor" value="<?php echo $bdp_settings["template_readmorecolor"]; ?>"/>
                                </div>
                            </li>

                            <li class="read_more_wrap read_more_text_background">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php
                                        $template_name = (isset($bdp_settings['template_name']) && $bdp_settings['template_name'] != '') ? $bdp_settings['template_name'] : '';
                                        $lbl_txt = ($template_name == 'overlay_horizontal' || $template_name == 'elina') ? __('Read More Text Color on Hover', BLOGDESIGNERPRO_TEXTDOMAIN)  : __('Read More Text Background Color', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo $lbl_txt;
                                        ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select Read more text background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_readmorebackcolor" id="template_readmorebackcolor" value="<?php echo $bdp_settings["template_readmorebackcolor"]; ?>"/>
                                </div>
                            </li>

                            <li class="read_more_wrap read_more_text_hover_background">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Read More Text Hover Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select Read more text hover background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="template_readmore_hover_backcolor" id="template_readmore_hover_backcolor" value="<?php echo (isset($bdp_settings["template_readmore_hover_backcolor"]) && $bdp_settings["template_readmore_hover_backcolor"] != '') ? $bdp_settings["template_readmore_hover_backcolor"] : ''; ?>"/>
                                </div>
                            </li>

                            <li class="sprecrum_date_color">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Use Readmore Color Selection on Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Use Readmore Color Selection on Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <label>
                                        <input id="date_color_of_readmore" name="date_color_of_readmore" type="checkbox" value="1" <?php
                                        if (isset($bdp_settings['date_color_of_readmore'])) {
                                            checked(1, $bdp_settings['date_color_of_readmore']);
                                        }
                                        ?> />
                                    </label>
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
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post content font family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            if (isset($bdp_settings['content_font_family']) && $bdp_settings['content_font_family'] != '') {
                                                $content_font_family = $bdp_settings['content_font_family'];
                                            } else {
                                                $content_font_family = '';
                                            }
                                            ?>
                                            <div class="typo-field">
                                                <input type="hidden" id="content_font_family_font_type" name="content_font_family_font_type" value="<?php echo isset($bdp_settings['content_font_family_font_type']) ? $bdp_settings['content_font_family_font_type'] : '' ?>">
                                                <div class="select-cover">
                                                    <select name="content_font_family" id="content_font_family">
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

                                                            if ($content_font_family != '' && (str_replace('"', '', $content_font_family) == str_replace('"', '', $value['label']))) {
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
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select font size for post content', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="grid_col_space range_slider_fontsize" id="content_fontsize_slider" data-value="<?php echo $bdp_settings['content_fontsize']; ?>"></div>
                                            <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="content_fontsize" id="content_fontsize" value="<?php echo $bdp_settings['content_fontsize']; ?>" onkeypress="return isNumberKey(event)" /></div>
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
                                            <?php $content_font_weight = isset($bdp_settings['content_font_weight']) ? $bdp_settings['content_font_weight'] : 'normal'; ?>
                                            <div class="select-cover">
                                                <select name="content_font_weight" id="content_font_weight">
                                                    <option value="100" <?php selected($content_font_weight, 100); ?>>100</option>
                                                    <option value="200" <?php selected($content_font_weight, 200); ?>>200</option>
                                                    <option value="300" <?php selected($content_font_weight, 300); ?>>300</option>
                                                    <option value="400" <?php selected($content_font_weight, 400); ?>>400</option>
                                                    <option value="500" <?php selected($content_font_weight, 500); ?>>500</option>
                                                    <option value="600" <?php selected($content_font_weight, 600); ?>>600</option>
                                                    <option value="700" <?php selected($content_font_weight, 700); ?>>700</option>
                                                    <option value="800" <?php selected($content_font_weight, 800); ?>>800</option>
                                                    <option value="900" <?php selected($content_font_weight, 900); ?>>900</option>
                                                    <option value="bold" <?php selected($content_font_weight, 'bold'); ?> ><?php _e('Bold', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option value="normal" <?php selected($content_font_weight, 'normal'); ?>><?php _e('Normal', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
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
                                                <input type="number" name="content_font_line_height" id="content_font_line_height" step="0.1" min="0" value="<?php echo isset($bdp_settings['content_font_line_height']) ? $bdp_settings['content_font_line_height'] : '1.5'; ?>" onkeypress="return isNumberKey(event)">
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
                                            <?php $content_font_italic = isset($bdp_settings['content_font_italic']) ? $bdp_settings['content_font_italic'] : '0';?>
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="content_font_italic_1" name="content_font_italic" type="radio" value="1"  <?php checked(1, $content_font_italic); ?> />
                                                <label for="content_font_italic_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="content_font_italic_0" name="content_font_italic" type="radio" value="0" <?php checked(0, $content_font_italic); ?> />
                                                <label for="content_font_italic_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
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
                                            <?php $content_font_text_transform = isset($bdp_settings['content_font_text_transform']) ? $bdp_settings['content_font_text_transform'] : 'none'; ?>
                                                <div class="select-cover">
                                                    <select name="content_font_text_transform" id="content_font_text_transform">
                                                        <option <?php selected($content_font_text_transform, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                        <option <?php selected($content_font_text_transform, 'capitalize'); ?> value="capitalize"><?php _e('Capitalize', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                        <option <?php selected($content_font_text_transform, 'uppercase'); ?> value="uppercase"><?php _e('Uppercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                        <option <?php selected($content_font_text_transform, 'lowercase'); ?> value="lowercase"><?php _e('Lowercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                        <option <?php selected($content_font_text_transform, 'full-width'); ?> value="full-width"><?php _e('Full Width', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                            <?php _e('Text Decoration', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select text decoration style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $content_font_text_decoration = isset($bdp_settings['content_font_text_decoration']) ? $bdp_settings['content_font_text_decoration'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="content_font_text_decoration" id="content_font_text_decoration">
                                                    <option <?php selected($content_font_text_decoration, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($content_font_text_decoration, 'underline'); ?> value="underline"><?php _e('Underline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($content_font_text_decoration, 'overline'); ?> value="overline"><?php _e('Overline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($content_font_text_decoration, 'line-through'); ?> value="line-through"><?php _e('Line Through', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
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
                                                <input type="number" name="content_font_letter_spacing" id="content_font_letter_spacing" step="1" min="0" value="<?php echo isset($bdp_settings['content_font_letter_spacing']) ? $bdp_settings['content_font_letter_spacing'] : '0'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="bdpmedia" class="postbox postbox-with-fw-options" <?php echo $bdpmedia_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li class="display_feature_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Post Feature Image ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show/Hide post feature image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_feature_image = isset($bdp_settings['display_feature_image']) ? $bdp_settings['display_feature_image'] : '1'; ?>
                                    <fieldset class="bdp-social-options bdp-display_feature_image buttonset">
                                        <input id="display_feature_image_1" name="display_feature_image" type="radio" value="1" <?php echo checked(1, $display_feature_image); ?> />
                                        <label for="display_feature_image_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_feature_image_0" name="display_feature_image" type="radio" value="0" <?php echo checked(0, $display_feature_image); ?> />
                                        <label for="display_feature_image_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="easy_timeline_effect_tr display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Posts Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select transition effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $easy_timeline_effect = isset($bdp_settings['easy_timeline_effect']) ? $bdp_settings['easy_timeline_effect'] : 'default-effect'; ?>
                                    <select name="easy_timeline_effect" id="easy_timeline_effect">
                                        <option value="default-effect" <?php echo ($easy_timeline_effect == 'default-effect') ? 'selected="selected"' : ''; ?>><?php _e('Default', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="slide-down-up-effect" <?php echo ($easy_timeline_effect == 'slide-down-up-effect') ? 'selected="selected"' : ''; ?>><?php _e('Slide Down Up', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="slide-up-down-effect" <?php echo ($easy_timeline_effect == 'slide-up-down-effect') ? 'selected="selected"' : ''; ?>><?php _e('Slide Up Down', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="slide-right-left-effect" <?php echo ($easy_timeline_effect == 'slide-right-left-effect') ? 'selected="selected"' : ''; ?>><?php _e('Slide Right Left', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="slide-left-right-effect" <?php echo ($easy_timeline_effect == 'slide-left-right-effect') ? 'selected="selected"' : ''; ?>><?php _e('Slide Left Right', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="flip-effect" <?php echo ($easy_timeline_effect == 'flip-effect') ? 'selected="selected"' : ''; ?>><?php _e('Flip Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="transformation-effect" <?php echo ($easy_timeline_effect == 'transformation-effect') ? 'selected="selected"' : ''; ?>><?php _e('Transformation Eeffect', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li class="thumbnail_skin_tr display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Thumbnail Skin', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post thumbnail shape', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $thumbnail_skin = (isset($bdp_settings['thumbnail_skin'])) ? $bdp_settings['thumbnail_skin'] : 1; ?>
                                    <fieldset class="bdp-thumbnail_skin buttonset buttonset-hide green" data-hide='1'>
                                        <input id="thumbnail_skin_0" name="thumbnail_skin" type="radio" value="0" <?php checked(0, $thumbnail_skin); ?> />
                                        <label id="bdp-options-button" for="thumbnail_skin_0" <?php checked(0, $thumbnail_skin); ?>><?php _e('Square', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="thumbnail_skin_1" name="thumbnail_skin" type="radio" value="1" <?php checked(1, $thumbnail_skin); ?> />
                                        <label id="bdp-options-button" for="thumbnail_skin_1" <?php checked(1, $thumbnail_skin); ?>><?php _e('Circle', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="blog-grid-height-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Grid Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select height of the post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $blog_grid_height = (isset($bdp_settings['blog_grid_height'])) ? $bdp_settings['blog_grid_height'] : 1; ?>
                                    <fieldset class="buttonset blog_grid_height green">
                                        <input id="blog_grid_height_0" name="blog_grid_height" type="radio" value="0" <?php checked(0, $blog_grid_height); ?> />
                                        <label id="bdp-options-button" for="blog_grid_height_0" <?php checked(0, $blog_grid_height); ?>><?php _e('Full', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="blog_grid_height_1" name="blog_grid_height" type="radio" value="1" <?php checked(1, $blog_grid_height); ?> />
                                        <label id="bdp-options-button" for="blog_grid_height_1" <?php checked(1, $blog_grid_height); ?>><?php _e('Fixed', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="blog-post-grid-height-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e(' Blog Post Grid Height ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter Blog Post Grid Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_grid_height"] = (isset($bdp_settings["template_grid_height"])) ? $bdp_settings["template_grid_height"] : 300; ?>
                                    <input type="number" name="template_grid_height" id="template_grid_height" value="<?php echo $bdp_settings["template_grid_height"]; ?>"/>
                                </div>
                            </li>

                            <li class="blog-gridskin-tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Grid Skin', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Grid skin from available options', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_grid_skin"] = (isset($bdp_settings["template_grid_skin"]) && $bdp_settings["template_grid_skin"] != '') ? $bdp_settings["template_grid_skin"] : 'default'; ?>
                                    <select name="template_grid_skin" id="template_grid_skin">
                                        <option value="default" <?php if ($bdp_settings["template_grid_skin"] == 'default') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Default Skin', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="repeat" <?php if ($bdp_settings["template_grid_skin"] == 'repeat') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Repeat Skin', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option class="only_explore" value="reverse" <?php if ($bdp_settings["template_grid_skin"] == 'reverse') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Reverse Skin', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="gridcol_space_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Grid column space (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Set spacing between posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $grid_col_space = (isset($bdp_settings['grid_col_space']) && $bdp_settings['grid_col_space'] != "") ? $bdp_settings['grid_col_space'] : 10; ?>
                                        <div class="grid_col_space" id="grid_col_spaceInputId" ></div>
                                        <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="grid_col_space" id="grid_col_spaceOutputId" value="<?php echo $grid_col_space; ?>" /></div>
                                </div>
                            </li>

                            <li class="display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Image Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable post image link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_post_image_link = isset($bdp_settings['bdp_post_image_link']) ? $bdp_settings['bdp_post_image_link'] : '1'; ?>
                                    <fieldset class="buttonset buttonset-hide" data-hide='1'>
                                        <input id="bdp_post_image_link_1" name="bdp_post_image_link" type="radio" value="1" <?php checked(1, $bdp_post_image_link); ?> />
                                        <label id="bdp-options-button" for="bdp_post_image_link_1" <?php checked(1, $bdp_post_image_link); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="bdp_post_image_link_0" name="bdp_post_image_link" type="radio" value="0" <?php checked(0, $bdp_post_image_link); ?> />
                                        <label id="bdp-options-button" for="bdp_post_image_link_0" <?php checked(0, $bdp_post_image_link); ?>><?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="bdp-image-hover-effect display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Image Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable image hover effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_image_hover_effect = isset($bdp_settings['bdp_image_hover_effect']) ? $bdp_settings['bdp_image_hover_effect'] : '0'; ?>
                                    <fieldset class="buttonset buttonset-hide" data-hide='1'>
                                        <input id="bdp_image_hover_effect_1" name="bdp_image_hover_effect" type="radio" value="1" <?php checked(1, $bdp_image_hover_effect); ?> />
                                        <label id="bdp-options-button" for="bdp_image_hover_effect_1" <?php checked(1, $bdp_image_hover_effect); ?>><?php _e('Enable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="bdp_image_hover_effect_0" name="bdp_image_hover_effect" type="radio" value="0" <?php checked(0, $bdp_image_hover_effect); ?> />
                                        <label id="bdp-options-button" for="bdp_image_hover_effect_0" <?php checked(0, $bdp_image_hover_effect); ?>><?php _e('Disable', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="bdp-image-hover-effect-tr bdp-image-hover-effect display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Image Hover Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select image hover effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_image_hover_effect_type = isset($bdp_settings['bdp_image_hover_effect_type']) ? $bdp_settings['bdp_image_hover_effect_type'] : 'zoom_in'; ?>
                                    <select name="bdp_image_hover_effect_type" id="bdp_image_hover_effect_type">
                                        <option value="blur" <?php echo ($bdp_image_hover_effect_type == 'blur') ? 'selected="selected"' : ''; ?>><?php _e('Blur', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="flashing" <?php echo ($bdp_image_hover_effect_type == 'flashing') ? 'selected="selected"' : ''; ?>><?php _e('Flashing', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="gray_scale" <?php echo ($bdp_image_hover_effect_type == 'gray_scale') ? 'selected="selected"' : ''; ?>><?php _e('Gray Scale', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="opacity" <?php echo ($bdp_image_hover_effect_type == 'opacity') ? 'selected="selected"' : ''; ?>><?php _e('Opacity', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="sepia" <?php echo ($bdp_image_hover_effect_type == 'sepia') ? 'selected="selected"' : ''; ?>><?php _e('Sepia', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="slide" <?php echo ($bdp_image_hover_effect_type == 'slide') ? 'selected="selected"' : ''; ?>><?php _e('Slide', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="shine" <?php echo ($bdp_image_hover_effect_type == 'shine') ? 'selected="selected"' : ''; ?>><?php _e('Shine', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="shine_circle" <?php echo ($bdp_image_hover_effect_type == 'shine_circle') ? 'selected="selected"' : ''; ?>><?php _e('Shine Circle', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="zoom_in" <?php echo ($bdp_image_hover_effect_type == 'zoom_in') ? 'selected="selected"' : ''; ?>><?php _e('Zoom In', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="zoom_out" <?php echo ($bdp_image_hover_effect_type == 'zoom_out') ? 'selected="selected"' : ''; ?>><?php _e('Zoom Out', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li class="display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Default Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Post Default Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <span class="bdp_default_image_holder">
                                        <?php
                                        if (isset($bdp_settings['bdp_default_image_src']) && $bdp_settings['bdp_default_image_src'] != '') {
                                            echo '<img src="' . $bdp_settings['bdp_default_image_src'] . '"/>';
                                        }
                                        ?>
                                    </span>
                                    <?php if (isset($bdp_settings['bdp_default_image_src']) && $bdp_settings['bdp_default_image_src'] != '') { ?>
                                        <input id="bdp-image-action-button" class="button bdp-remove_image_button" type="button" value="<?php esc_attr_e('Remove Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <?php } else { ?>
                                        <input class="button bdp-upload_image_button" type="button" value="<?php esc_attr_e('Upload Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <?php } ?>
                                    <input type="hidden" value="<?php echo isset($bdp_settings['bdp_default_image_id']) ? $bdp_settings['bdp_default_image_id'] : ''; ?>" name="bdp_default_image_id" id="bdp_default_image_id">
                                    <input type="hidden" value="<?php echo isset($bdp_settings['bdp_default_image_src']) ? $bdp_settings['bdp_default_image_src'] : ''; ?>" name="bdp_default_image_src" id="bdp_default_image_src">
                                </div>
                            </li>

                            <li class="bdp_media_size_tr display_image_tr">
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

                            <li class="bdp_media_custom_size_tr display_image_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Add Cutom Size', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Enter custom size for post media', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div class="bdp_media_custom_size_tbl">
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Width', BLOGDESIGNERPRO_TEXTDOMAIN); ?><?php _e(' (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" min="1" name="media_custom_width" class="media_custom_width" id="media_custom_width" value="<?php echo (isset($bdp_settings['media_custom_width']) && $bdp_settings['media_custom_width'] != '' ) ? $bdp_settings['media_custom_width'] : ''; ?>" /></p>
                                        <p> <span class="bdp_custom_media_size_title"><?php _e('Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?><?php _e(' (px)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span> <input type="number" min="1" name="media_custom_height" class="media_custom_height" id="media_custom_height" value="<?php echo (isset($bdp_settings['media_custom_height']) && $bdp_settings['media_custom_height'] != '' ) ? $bdp_settings['media_custom_height'] : ''; ?>"/> </p>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>


                <div id="bdpslider" class="postbox postbox-with-fw-options" <?php echo $bdpslider_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Effect', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select effect for slider layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_slider_effect"] = (isset($bdp_settings["template_slider_effect"])) ? $bdp_settings["template_slider_effect"] : ''; ?>
                                    <select name="template_slider_effect" id="template_slider_effect">
                                        <option value="slide" <?php if ($bdp_settings["template_slider_effect"] == 'slide') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Slide', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="fade" <?php if ($bdp_settings["template_slider_effect"] == 'fade') { ?> selected="selected"<?php } ?>>
                                            <?php _e('Fade', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="slider_columns_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>'. __('Desktop - Above', BLOGDESIGNERPRO_TEXTDOMAIN) .' 980px</i>)';?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for slider', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_slider_columns"] = (isset($bdp_settings["template_slider_columns"])) ? $bdp_settings["template_slider_columns"] : 2; ?>
                                    <select name="template_slider_columns" id="template_slider_columns">
                                        <option value="1" <?php if ($bdp_settings["template_slider_columns"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_slider_columns"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_slider_columns"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_slider_columns"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="5" <?php if ($bdp_settings["template_slider_columns"] == '5') { ?> selected="selected"<?php } ?>>
                                            <?php _e('5 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="6" <?php if ($bdp_settings["template_slider_columns"] == '6') { ?> selected="selected"<?php } ?>>
                                            <?php _e('6 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="slider_columns_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>'. __('iPad', BLOGDESIGNERPRO_TEXTDOMAIN) .' - 720px - 980px</i>)';?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for slider', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_slider_columns_ipad"] = (isset($bdp_settings["template_slider_columns_ipad"])) ? $bdp_settings["template_slider_columns_ipad"] : 2; ?>
                                    <select name="template_slider_columns_ipad" id="template_slider_columns_ipad">
                                        <option value="1" <?php if ($bdp_settings["template_slider_columns_ipad"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_slider_columns_ipad"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_slider_columns_ipad"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_slider_columns_ipad"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="5" <?php if ($bdp_settings["template_slider_columns_ipad"] == '5') { ?> selected="selected"<?php } ?>>
                                            <?php _e('5 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="6" <?php if ($bdp_settings["template_slider_columns_ipad"] == '6') { ?> selected="selected"<?php } ?>>
                                            <?php _e('6 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="slider_columns_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>'. __('Tablet', BLOGDESIGNERPRO_TEXTDOMAIN) .' - 480px - 720px</i>)';?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for slider', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $bdp_settings["template_slider_columns_tablet"] = (isset($bdp_settings["template_slider_columns_tablet"])) ? $bdp_settings["template_slider_columns_tablet"] : 2; ?>
                                    <select name="template_slider_columns_tablet" id="template_slider_columns_tablet">
                                        <option value="1" <?php if ($bdp_settings["template_slider_columns_tablet"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_slider_columns_tablet"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_slider_columns_tablet"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_slider_columns_tablet"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="5" <?php if ($bdp_settings["template_slider_columns_tablet"] == '5') { ?> selected="selected"<?php } ?>>
                                            <?php _e('5 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="6" <?php if ($bdp_settings["template_slider_columns_tablet"] == '6') { ?> selected="selected"<?php } ?>>
                                            <?php _e('6 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="slider_columns_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        <?php echo '<br />(<i>'. __('Mobile - Smaller Than', BLOGDESIGNERPRO_TEXTDOMAIN) .' 480px </i>)';?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select column for slider', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>

                                    <?php $bdp_settings["template_slider_columns_mobile"] = (isset($bdp_settings["template_slider_columns_mobile"])) ? $bdp_settings["template_slider_columns_mobile"] : 1; ?>
                                    <select name="template_slider_columns_mobile" id="template_slider_columns_mobile">
                                        <option value="1" <?php if ($bdp_settings["template_slider_columns_mobile"] == '1') { ?> selected="selected"<?php } ?>>
                                            <?php _e('1 Column', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="2" <?php if ($bdp_settings["template_slider_columns_mobile"] == '2') { ?> selected="selected"<?php } ?>>
                                            <?php _e('2 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="3" <?php if ($bdp_settings["template_slider_columns_mobile"] == '3') { ?> selected="selected"<?php } ?>>
                                            <?php _e('3 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="4" <?php if ($bdp_settings["template_slider_columns_mobile"] == '4') { ?> selected="selected"<?php } ?>>
                                            <?php _e('4 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="5" <?php if ($bdp_settings["template_slider_columns_mobile"] == '5') { ?> selected="selected"<?php } ?>>
                                            <?php _e('5 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="6" <?php if ($bdp_settings["template_slider_columns_mobile"] == '6') { ?> selected="selected"<?php } ?>>
                                            <?php _e('6 Columns', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>

                            <li class="slider_scroll_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                            <?php _e('Slide to Scroll', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select number of slide to scroll', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $template_slider_scroll = isset($bdp_settings['template_slider_scroll']) ? $bdp_settings['template_slider_scroll'] : '1'; ?>
                                    <select name="template_slider_scroll" id="template_slider_scroll">
                                        <option value="1" <?php if ($template_slider_scroll == '1') { ?> selected="selected"<?php } ?>>1</option>
                                        <option value="2" <?php if ($template_slider_scroll == '2') { ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if ($template_slider_scroll == '3') { ?> selected="selected"<?php } ?>>3</option>
                                    </select>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Slider Navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable slider navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_slider_navigation = isset($bdp_settings['display_slider_navigation']) ? $bdp_settings['display_slider_navigation'] : '1'; ?>
                                    <fieldset class="bdp-social-options bdp-display_slider_navigation buttonset buttonset-hide ui-buttonset">
                                        <input id="display_slider_navigation_1" name="display_slider_navigation" type="radio" value="1" <?php checked(1, $display_slider_navigation); ?> />
                                        <label for="display_slider_navigation_1" <?php checked(1, $display_slider_navigation); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_slider_navigation_0" name="display_slider_navigation" type="radio" value="0" <?php checked(0, $display_slider_navigation); ?> />
                                        <label for="display_slider_navigation_0" <?php checked(0, $display_slider_navigation); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="select_slider_navigation_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Navigation Icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Slider navigation icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $slider_navigation = isset($bdp_settings['navigation_style_hidden']) ? $bdp_settings['navigation_style_hidden'] : 'navigation3'; ?>
                                    <div class="select_button_upper_div ">
                                        <div class="bdp_select_template_button_div">
                                            <input type="button" class="button bdp_select_navigation" value="<?php esc_attr_e('Select Navigation', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                            <input style="visibility: hidden;" type="hidden" id="navigation_style_hidden" class="navigation_style_hidden" name="navigation_style_hidden" value="<?php echo $slider_navigation;?>" />
                                        </div>
                                        <div class="bdp_selected_navigation_image">
                                            <div class="bdp-dialog-navigation-style slider_controls" >
                                                <div class="bdp_navigation_image_holder navigation_hidden" >
                                                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/images/navigation/'.$slider_navigation.'.png'; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Slider Controls', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable slider control', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $display_slider_controls = isset($bdp_settings['display_slider_controls']) ? $bdp_settings['display_slider_controls'] : '1'; ?>
                                    <fieldset class="bdp-social-options bdp-display_slider_controls buttonset buttonset-hide ui-buttonset">
                                        <input id="display_slider_controls_1" name="display_slider_controls" type="radio" value="1" <?php checked(1, $display_slider_controls); ?> />
                                        <label for="display_slider_controls_1" <?php checked(1, $display_slider_controls); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_slider_controls_0" name="display_slider_controls" type="radio" value="0" <?php checked(0, $display_slider_controls); ?> />
                                        <label for="display_slider_controls_0" <?php checked(0, $display_slider_controls); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="select_slider_controls_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Slider Arrow', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select slider arrow icon', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $slider_arrow = isset($bdp_settings['arrow_style_hidden']) ? $bdp_settings['arrow_style_hidden'] : 'arrow1'; ?>
                                    <div class="select_button_upper_div ">
                                        <div class="bdp_select_template_button_div">
                                            <input type="button" class="button bdp_select_arrow" value="<?php esc_attr_e('Select Arrow', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                            <input style="visibility: hidden;" type="hidden" id="arrow_style_hidden" class="arrow_style_hidden" name="arrow_style_hidden" value="<?php echo $slider_arrow;?>" />
                                        </div>
                                        <div class="bdp_selected_arrow_image">
                                            <div class="bdp-dialog-arrow-style slider_controls" >
                                                <div class="bdp_arrow_image_holder arrow_hidden" >
                                                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/images/arrow/'.$slider_arrow.'.png'; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Autoplay', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable slider autoplay', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $slider_autoplay = isset($bdp_settings['slider_autoplay']) ? $bdp_settings['slider_autoplay'] : '1'; ?>
                                    <fieldset class="bdp-social-options bdp-slider_autoplay buttonset buttonset-hide ui-buttonset">
                                        <input id="slider_autoplay_1" name="slider_autoplay" type="radio" value="1" <?php checked(1, $slider_autoplay); ?> />
                                        <label for="slider_autoplay_1" <?php checked(1, $slider_autoplay); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="slider_autoplay_0" name="slider_autoplay" type="radio" value="0" <?php checked(0, $slider_autoplay); ?> />
                                        <label for="slider_autoplay_0" <?php checked(0, $slider_autoplay); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li class="slider_autoplay_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Enter slider autoplay intervals (ms)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable slider autoplay', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $slider_autoplay_intervals = isset($bdp_settings['slider_autoplay_intervals']) ? $bdp_settings['slider_autoplay_intervals'] : '1'; ?>
                                    <input type="number" id="slider_autoplay_intervals" name="slider_autoplay_intervals" step="1" min="0" value="<?php echo isset($bdp_settings['slider_autoplay_intervals']) ? $bdp_settings['slider_autoplay_intervals'] : '3000'; ?>" placeholder="<?php esc_attr_e('Enter slider intervals', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" onkeypress="return isNumberKey(event)">
                                </div>
                            </li>

                            <li class="slider_autoplay_tr">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Slider Speed (ms)', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter slider speed', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $slider_speed = isset($bdp_settings['slider_speed']) ? $bdp_settings['slider_speed'] : '300'; ?>
                                    <input type="number" id="slider_speed" name="slider_speed" step="1" min="0" value="<?php echo isset($bdp_settings['slider_speed']) ? $bdp_settings['slider_speed'] : '300'; ?>" placeholder="<?php esc_attr_e('Enter slider intervals', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" onkeypress="return isNumberKey(event)">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="bdpfilter" class="postbox postbox-with-fw-options" <?php echo $bdpfilter_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Posts within Time Period', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select time period of blog posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $blog_time_period = 'all';
                                    if (isset($bdp_settings['blog_time_period'])) {
                                        $blog_time_period = $bdp_settings['blog_time_period'];
                                    }
                                    ?>
                                    <select id="blog_time_period" name="blog_time_period">
                                        <option value="all" <?php echo selected('all', $blog_time_period); ?>><?php _e('All Dates', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="today" <?php echo selected('today', $blog_time_period); ?>><?php _e('Today', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="tomorrow" <?php echo selected('tomorrow', $blog_time_period); ?>><?php _e('Tomorrow', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="this_week" <?php echo selected('this_week', $blog_time_period); ?>><?php _e('This Week', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="last_week" <?php echo selected('last_week', $blog_time_period); ?>><?php _e('Last Week', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="next_week" <?php echo selected('next_week', $blog_time_period); ?>><?php _e('Next Week', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="this_month" <?php echo selected('this_month', $blog_time_period); ?>><?php _e('This Month', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="last_month" <?php echo selected('last_month', $blog_time_period); ?>><?php _e('Last Month', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="next_month" <?php echo selected('next_month', $blog_time_period); ?>><?php _e('Next Month', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="between_two_date" <?php echo selected('between_two_date', $blog_time_period); ?>><?php _e('Between Two Dates', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="last_n_days" <?php echo selected('last_n_days', $blog_time_period); ?>><?php _e('Last N Days', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="next_n_days" <?php echo selected('next_n_days', $blog_time_period); ?>><?php _e('Next N Days', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li class="bdp_between_two_date">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select date for blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <div>
                                        <div style="width:10%;display: inline-block;padding: 24px 27px 21px 0;"><?php _e('From', BLOGDESIGNERPRO_TEXTDOMAIN); ?></div>
                                        <div style="width:50%;display: inline-block;padding: 24px 27px 21px 0;">
                                            <input type="text" onkeypress="return isNumberKey(event)" name="between_two_date_from" id="between_two_date_from" value="<?php echo (isset($bdp_settings['between_two_date_from']) ) ? $bdp_settings['between_two_date_from'] : ''; ?>" />
                                        </div>
                                    </div>
                                    <div>
                                        <div style="width:10%;display: inline-block;padding: 24px 27px 21px 0;"><?php _e('To', BLOGDESIGNERPRO_TEXTDOMAIN); ?></div>
                                        <div style="width:50%;display: inline-block;padding: 24px 27px 21px 0;">
                                            <input type="text" onkeypress="return isNumberKey(event)" name="between_two_date_to" id="between_two_date_to" value="<?php echo (isset($bdp_settings['between_two_date_to']) ) ? $bdp_settings['between_two_date_to'] : ''; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="bdp_time_period_days">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Number of Days', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select number of days', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    if (isset($bdp_settings['bdp_time_period_day'])) {
                                        $bdp_time_period_day = $bdp_settings['bdp_time_period_day'];
                                    } else {
                                        $bdp_time_period_day = 15;
                                    }
                                    ?>
                                    <div class="grid_col_space range_slider_days" id="bdp_time_period_dayInput" data-value="<?php echo $bdp_time_period_day; ?>"></div>
                                    <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value_day" name="bdp_time_period_day" id="bdp_time_period_day" value="<?php echo $bdp_time_period_day; ?>" onkeypress="return isNumberKey(event)" /></div>
                                </div>
                            </li>
                            <li class="orderby_date_display">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Display Year Or Months Wise', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Display Post Year Or Months Wise', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>

                                    <?php
                                    if (isset($bdp_settings['timeline_display_option'])) {
                                        $timeline_display_option = $bdp_settings['timeline_display_option'];
                                    } else {
                                        $timeline_display_option = '';
                                    }
                                    ?>
                                    <select name="timeline_display_option" id="timeline_display_option">
                                        <option value="" <?php echo selected('', $timeline_display_option); ?>>
                                            <?php _e('Select Option', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="display_year" <?php echo selected('display_year', $timeline_display_option); ?>>
                                            <?php _e('Display Years', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                        <option value="display_month" <?php echo selected('display_month', $timeline_display_option); ?>>
                                            <?php _e('Display Months', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </option>
                                    </select>
                                </div>
                            </li>
                            <li class="displayorder_backcolor">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Year Or Month Display BackGround Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select Background color of year and month option', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="displaydate_backcolor" id="displaydate_backcolor" value="<?php echo isset($bdp_settings["displaydate_backcolor"]) ? $bdp_settings["displaydate_backcolor"] : '#414a54'; ?>"/>
                                </div>
                            </li>
                            <li class="date_from_tr">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select display post date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $dsiplay_date_from = isset($bdp_settings['dsiplay_date_from']) ? $bdp_settings['dsiplay_date_from'] : 'publish';
                                    ?>

                                    <select name="dsiplay_date_from" id="dsiplay_date_from">
                                        <option value="publish"  <?php echo selected('publish', $dsiplay_date_from); ?>><?php _e('Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN) ?></option>
                                        <option value="modify"  <?php echo selected('modify', $dsiplay_date_from); ?>><?php _e('Last Modify Date', BLOGDESIGNERPRO_TEXTDOMAIN) ?></option>
                                    </select>
                                </div>
                            </li>
                            <li class="post_date_format_tr">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Date Format', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post published format', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $post_date_format = isset($bdp_settings['post_date_format']) ? $bdp_settings['post_date_format'] : 'default'; ?>

                                    <select name="post_date_format" id="post_date_format">
                                        <option value="default"  <?php echo selected('default', $post_date_format); ?>><?php _e('Default', BLOGDESIGNERPRO_TEXTDOMAIN) ?></option>
                                        <option value="F j, Y g:i a"  <?php echo selected('F j, Y g:i a', $post_date_format); ?>><?php echo get_the_time('F j, Y g:i a'); ?></option>
                                        <option value="F j, Y"  <?php echo selected('F j, Y', $post_date_format); ?>><?php echo get_the_time('F j, Y'); ?></option>
                                        <option value="F, Y"  <?php echo selected('F, Y', $post_date_format); ?>><?php echo get_the_time('F, Y'); ?></option>
                                        <option value="j F  Y"  <?php echo selected('j F  Y', $post_date_format); ?>><?php echo get_the_time('j F  Y'); ?></option>
                                        <option value="g:i a"  <?php echo selected('g:i a', $post_date_format); ?>><?php echo get_the_time('g:i a'); ?></option>
                                        <option value="g:i:s a"  <?php echo selected('g:i:s a', $post_date_format); ?>><?php echo get_the_time('g:i:s a'); ?></option>
                                        <option value="l, F jS, Y"  <?php echo selected('l, F jS, Y', $post_date_format); ?>><?php echo get_the_time('l, F jS, Y'); ?></option>
                                        <option value="M j, Y @ G:i"  <?php echo selected('M j, Y @ G:i', $post_date_format); ?>><?php echo get_the_time('M j, Y @ G:i'); ?></option>
                                        <option value="Y/m/d g:i:s A"  <?php echo selected('Y/m/d g:i:s A', $post_date_format); ?>><?php echo get_the_time('Y/m/d g:i:s A'); ?></option>
                                        <option value="Y/m/d"  <?php echo selected('Y/m/d', $post_date_format); ?>><?php echo get_the_time('Y/m/d'); ?></option>
                                        <option value="d.m.Y"  <?php echo selected('d.m.Y', $post_date_format); ?>><?php echo get_the_time('d.m.Y'); ?></option>
                                        <option value="d-m-Y"  <?php echo selected('d-m-Y', $post_date_format); ?>><?php echo get_the_time('d-m-Y'); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li>

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Blog Order by', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select order for blog', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $orderby = '';
                                    if (isset($bdp_settings['bdp_blog_order_by'])) {
                                        $orderby = $bdp_settings['bdp_blog_order_by'];
                                    }
                                    ?>
                                    <select id="bdp_blog_order_by" name="bdp_blog_order_by">
                                        <option value="" <?php echo selected('', $orderby); ?>><?php _e('Default Sorting', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="rand" <?php echo selected('rand', $orderby); ?>><?php _e('Random', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="ID" <?php echo selected('ID', $orderby); ?>><?php _e('Post ID', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="author" <?php echo selected('author', $orderby); ?>><?php _e('Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="title" <?php echo selected('title', $orderby); ?>><?php _e('Post Title', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="name" <?php echo selected('name', $orderby); ?>><?php _e('Post Slug', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="date" <?php echo selected('date', $orderby); ?>><?php _e('Publish Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="modified" <?php echo selected('modified', $orderby); ?>><?php _e('Modified Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="meta_value_num" <?php echo selected('meta_value_num', $orderby); ?>><?php _e('Post Likes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                    <div class="blg_order">
                                        <?php
                                        $order = 'DESC';
                                        if (isset($bdp_settings['bdp_blog_order'])) {
                                            $order = $bdp_settings['bdp_blog_order'];
                                        }
                                        ?>
                                        <fieldset class="buttonset green" data-hide='1'>
                                            <input id="bdp_blog_order_asc" name="bdp_blog_order" type="radio" value="ASC" <?php checked('ASC', $order); ?> />
                                            <label id="bdp-options-button" for="bdp_blog_order_asc"><?php _e('Ascending', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            <input id="bdp_blog_order_desc" name="bdp_blog_order" type="radio" value="DESC" <?php checked('DESC', $order); ?> />
                                            <label id="bdp-options-button" for="bdp_blog_order_desc"><?php _e('Descending', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        </fieldset>
                                    </div>
                                </div>
                            </li>
                            <li>

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Post Status', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select post status blog', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $post_status = isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish'; ?>
                                    <select id="bdp_post_status" name="bdp_post_status">
                                        <option value="publish" <?php echo selected('publish', $post_status); ?>><?php _e('Publish', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="pending" <?php echo selected('pending', $post_status); ?>><?php _e('Pending', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="draft" <?php echo selected('draft', $post_status); ?>><?php _e('Draft', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="auto-draft" <?php echo selected('auto-draft', $post_status); ?>><?php _e('Auto Draft', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="future" <?php echo selected('future', $post_status); ?>><?php _e('Future', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="private" <?php echo selected('private', $post_status); ?>><?php _e('Private', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="inherit" <?php echo selected('inherit', $post_status); ?>><?php _e('Inherit', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                        <option value="trash" <?php echo selected('trash', $post_status); ?>><?php _e('Trash', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                    </select>
                                </div>
                            </li>

                            <li class="post-category">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php _e('Filter post via category', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $categories = get_categories(array('child_of' => '', 'hide_empty' => 1)); ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose Post Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_category[]" id="template_category"><?php foreach ($categories as $categoryObj): ?>
                                            <option value="<?php echo $categoryObj->term_id; ?>" <?php
                                            if (@in_array($categoryObj->term_id, $bdp_settings['template_category'])) {
                                                echo 'selected="selected"';
                                            }
                                            ?>><?php echo $categoryObj->name; ?></option><?php endforeach; ?>
                                    </select>
                                    <div class="exclude_category_list_div">
                                        <label>
                                            <input id="exclude_category_list" name="exclude_category_list" type="checkbox" value="1" <?php
                                            if (isset($bdp_settings['exclude_category_list'])) {
                                                checked(1, $bdp_settings['exclude_category_list']);
                                            }
                                            ?> /> <?php _e('Exclude Selected Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li class="post-tag">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php _e('Filter post via tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $tags = get_tags(); ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose Post Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_tags[]" id="template_tags">
                                        <?php foreach ($tags as $tag) : ?>
                                            <option value="<?php echo $tag->term_id; ?>" <?php
                                            if (@in_array($tag->term_id, $bdp_settings['template_tags'])) {
                                                echo 'selected="selected"';
                                            }
                                            ?>><?php echo $tag->name; ?></option>
                                                <?php endforeach; ?>
                                    </select>
                                    <div class="exclude_tag_list_div">
                                        <label>
                                            <input id="exclude_tag_list" name="exclude_tag_list" type="checkbox" value="1" <?php
                                            if (isset($bdp_settings['exclude_tag_list'])) {
                                                checked(1, $bdp_settings['exclude_tag_list']);
                                            }
                                            ?> /> <?php _e('Exclude Selected Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <?php
                            $custom_posttype = $bdp_settings['custom_post_type'];
                            if($custom_posttype != 'post') {
                                $taxonomy_names = get_object_taxonomies($custom_posttype, 'objects');
                                $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                                if (!empty($taxonomy_names)) {
                                    foreach ($taxonomy_names as $taxonomy_name) {
                                        $terms = get_terms($taxonomy_name->name, array('hide_empty' => false));
                                        if (!empty($terms)) {
                                            ?>
                                            <li class="bdp-post-terms">
                                              <div class="bdp-left">
                                                  <span class="bdp-key-title">
                                                      <?php echo __('Select', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label; ?>
                                                  </span>
                                              </div>
                                              <div class="bdp-right">
                                                  <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php echo __('Filter post via', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label; ?></span></span>
                                                  <select data-placeholder="Choose <?php echo $taxonomy_name->label; ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo $taxonomy_name->name; ?>_terms[]" id="terms_<?php echo $taxonomy_name->name; ?>">
                                                    <?php foreach ($terms as $term) { ?>
                                                            <option <?php
                                                                if (isset($bdp_settings[$taxonomy_name->name . "_terms"])) {
                                                                    for ($i = 0; $i < sizeof($bdp_settings[$taxonomy_name->name . "_terms"]); $i++) {
                                                                        if ($term->name == $bdp_settings[$taxonomy_name->name . "_terms"][$i]) {
                                                                            echo "selected=selected";
                                                                        }
                                                                    }
                                                                }
                                                                ?> value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
                                                    <?php } ?>
                                                    </select>
                                                    <div class="exclude_tag_list_div">
                                                        <label>
                                                            <input id="exclude_<?php echo $taxonomy_name->name; ?>_list" name="exclude_<?php echo $taxonomy_name->name; ?>_list" type="checkbox" value="1" <?php
                                                                if (isset($bdp_settings['exclude_' . $taxonomy_name->name . '_list'])) {
                                                                    checked(1, $bdp_settings['exclude_' . $taxonomy_name->name . '_list']);
                                                                }
                                                                ?>/> <?php echo __('Exclude Selected ', BLOGDESIGNERPRO_TEXTDOMAIN) . $taxonomy_name->label; ?>
                                                        </label>
                                                    </div>
                                              </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>


                            <li class="bdp-post-authors-list">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Select Post Authors', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php _e('Filter post via authors', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php $blogusers = get_users('orderby=nicename&order=asc'); ?>
                                    <select data-placeholder="<?php esc_attr_e('Choose Post authors', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_authors[]" id="template_authors">
                                        <?php foreach ($blogusers as $user) : ?>
                                            <option value="<?php echo $user->ID; ?>" <?php
                                            if (@in_array($user->ID, $bdp_settings['template_authors'])) {
                                                echo 'selected="selected"';
                                            }
                                            ?>><?php echo esc_html($user->display_name); ?></option>
                                                <?php endforeach; ?>
                                    </select>
                                    <div class="exclude_tag_list_div">
                                        <label>
                                            <input id="exclude_author_list" name="exclude_author_list" type="checkbox" value="1" <?php
                                            if (isset($bdp_settings['exclude_author_list'])) {
                                                checked(1, $bdp_settings['exclude_author_list']);
                                            }
                                            ?> /> <?php _e('Exclude Selected Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="advance_filter_settings">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Advance Filter?', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable advance filter option', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $advance_filter = 0;
                                    if (isset($bdp_settings['advance_filter'])) {
                                        $advance_filter = $bdp_settings['advance_filter'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-options buttonset">
                                        <input id="advance_filter_1" name="advance_filter" type="radio" value="1" <?php echo checked(1, $advance_filter); ?> />
                                        <label for="advance_filter_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="advance_filter_0" name="advance_filter" type="radio" value="0" <?php echo checked(0, $advance_filter); ?> />
                                        <label for="advance_filter_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="advance_filter_option">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo __('Filter between', BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/>' . __('Post Categories and Post Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable advance filter option', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $tax_filter_with = 0;
                                    if (isset($bdp_settings['tax_filter_with'])) {
                                        $tax_filter_with = $bdp_settings['tax_filter_with'];
                                    }
                                    ?>
                                    <fieldset class="buttonset green">
                                        <input id="tax_filter_with_0" name="tax_filter_with" type="radio" value="0" <?php echo checked(0, $tax_filter_with); ?> />
                                        <label id="bdp-options-button" for="tax_filter_with_0"><?php _e('Categories OR Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="tax_filter_with_1" name="tax_filter_with" type="radio" value="1" <?php echo checked(1, $tax_filter_with); ?> />
                                        <label id="bdp-options-button" for="tax_filter_with_1"><?php _e('Categories AND Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li class="advance_filter_option">

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php echo __('Filter Author Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable advance filter option', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $author_filter_with = 0;
                                    if (isset($bdp_settings['author_filter_with'])) {
                                        $author_filter_with = $bdp_settings['author_filter_with'];
                                    }
                                    ?>
                                    <fieldset class="buttonset green">
                                        <input id="author_filter_with_0" name="author_filter_with" type="radio" value="0" <?php echo checked(0, $author_filter_with); ?> />
                                        <label id="bdp-options-button" for="author_filter_with_0"><?php _e('OR Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="author_filter_with_1" name="author_filter_with" type="radio" value="1" <?php echo checked(1, $author_filter_with); ?> />
                                        <label id="bdp-options-button" for="author_filter_with_1"><?php _e('AND Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>

                            <li>

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Show Sticky Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show Sticky Post', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $display_sticky = 0;
                                    if (isset($bdp_settings['display_sticky'])) {
                                        $display_sticky = $bdp_settings['display_sticky'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-options bdp-display_sticky buttonset">
                                        <input id="display_sticky_1" name="display_sticky" type="radio" value="1" <?php echo checked(1, $display_sticky); ?> />
                                        <label for="display_sticky_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_sticky_0" name="display_sticky" type="radio" value="0" <?php echo checked(0, $display_sticky); ?> />
                                        <label for="display_sticky_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>

                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b>
                                        <?php
                                        _e('Sticky Post not count in the number of post to be displayed in blog layout page.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        ?>
                                    </div>
                                </div>
                            </li>

                            <li>

                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Label for featured posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter text for sticky post label', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="label_featured_post" id="label_featured_post" value="<?php echo (isset($bdp_settings['label_featured_post']) ? $bdp_settings['label_featured_post'] : '' ); ?>" placeholder="<?php esc_attr_e('Enter Label Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <div class="bdp-setting-description bdp-note">
                                        <b class="note"><?php _e("Note", BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</b>
                                        <?php
                                        _e('Leave blank for disable label.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        ?>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div id="bdpcustomreadmore" class="postbox postbox-with-fw-options" <?php echo $bdpcustomreadmore_class_show; ?>>
                    <div class="inside">
                        <ul class="bdp-settings bdp-lineheight">
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Display Custom Read More Button', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable custom read more button', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $display_customread_more = '1';
                                    if (isset($bdp_settings['display_customread_more'])) {
                                        $display_customread_more = $bdp_settings['display_customread_more'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-style buttonset buttonset-hide green" data-hide='1'>
                                        <input id="display_customread_more_0" name="display_customread_more" type="radio" value="0" <?php checked(0, $display_customread_more); ?> />
                                        <label id="bdp-options-button" for="display_customread_more_0" <?php checked(0, $display_customread_more); ?>><?php _e('Before Loop', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="display_customread_more_1" name="display_customread_more" type="radio" value="1" <?php checked(1, $display_customread_more); ?> />
                                        <label id="bdp-options-button" for="display_customread_more_1" <?php checked(1, $display_customread_more); ?>><?php _e('After Loop', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter custom read more text', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_Readmoretext" id="beforeloop_Readmoretext" value="<?php echo isset($bdp_settings['beforeloop_Readmoretext']) ? $bdp_settings['beforeloop_Readmoretext'] : ''; ?>" placeholder="Enter read more text">
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enter custom read more link', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_Readmoretextlink" id="beforeloop_Readmoretextlink" value="<?php echo isset($bdp_settings['beforeloop_Readmoretextlink']) ? $bdp_settings['beforeloop_Readmoretextlink'] : ''; ?>" placeholder="Enter read more text link">
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Open Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Open link in same tab or in new tab', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <?php
                                    $open_customlink = '1';
                                    if (isset($bdp_settings['open_customlink'])) {
                                        $open_customlink = $bdp_settings['open_customlink'];
                                    }
                                    ?>
                                    <fieldset class="bdp-social-style buttonset buttonset-hide green" data-hide='1'>
                                        <input id="open_customlink_0" name="open_customlink" type="radio" value="0" <?php checked(0, $open_customlink); ?> />
                                        <label id="bdp-options-button" for="open_customlink_0" <?php checked(0, $open_customlink); ?>><?php _e('New Tab', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="open_customlink_1" name="open_customlink" type="radio" value="1" <?php checked(1, $open_customlink); ?> />
                                        <label id="bdp-options-button" for="open_customlink_1" <?php checked(1, $open_customlink); ?>><?php _e('Same Tab', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                    </fieldset>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select custom read more text color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_readmorecolor" id="beforeloop_readmorecolor" value="<?php echo isset($bdp_settings["beforeloop_readmorecolor"]) ? $bdp_settings["beforeloop_readmorecolor"] : '#ffffff'; ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select custom read more text background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_readmorebackcolor" id="beforeloop_readmorebackcolor" value="<?php echo isset($bdp_settings["beforeloop_readmorebackcolor"]) ? $bdp_settings["beforeloop_readmorebackcolor"] : '#333333'; ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text Hover Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select custom read more text hover color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_readmorehovercolor" id="beforeloop_readmorehovercolor" value="<?php
                                    if (isset($bdp_settings["beforeloop_readmorehovercolor"])) {
                                        echo $bdp_settings["beforeloop_readmorehovercolor"];
                                    } else {
                                        echo '#333333';
                                    }
                                    ?>"/>
                                </div>
                            </li>
                            <li>
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Custom Read More Text Hover Background Color', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right">
                                    <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-color"><span class="bdp-tooltips"><?php _e('Select custom read more text hover background color', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                    <input type="text" name="beforeloop_readmorehoverbackcolor" id="beforeloop_readmorehoverbackcolor" value="<?php
                                    if (isset($bdp_settings["beforeloop_readmorehoverbackcolor"])) {
                                        echo $bdp_settings["beforeloop_readmorehoverbackcolor"];
                                    } else {
                                        echo '#f1f1f1';
                                    }
                                    ?>"/>
                                </div>
                            </li>

                            <li class="bdp-display-settings">
                                <h3 class="bdp-table-title"><?php _e('Typography Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-typography-wrapper bdp-typography-wrapper1">
                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Font Family', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select custom read text font family', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            if (isset($bdp_settings['beforeloop_titlefontface']) && $bdp_settings['beforeloop_titlefontface'] != '') {
                                                $beforeloop_titlefontface = $bdp_settings['beforeloop_titlefontface'];
                                            } else {
                                                $beforeloop_titlefontface = '';
                                            }
                                            ?>
                                            <div class="typo-field">
                                                <input type="hidden" id="beforeloop_titlefontface_font_type" name="beforeloop_titlefontface_font_type" value="<?php echo isset($bdp_settings['beforeloop_titlefontface_font_type']) ? $bdp_settings['beforeloop_titlefontface_font_type'] : '' ?>">
                                                <div class="select-cover">
                                                    <select name="beforeloop_titlefontface" id="beforeloop_titlefontface">
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

                                                            if ($beforeloop_titlefontface != '' && (str_replace('"', '', $beforeloop_titlefontface) == str_replace('"', '', $value['label']))) {
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
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select custom read more text font size', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php
                                            if (isset($bdp_settings['beforeloop_titlefontsize']) && $bdp_settings['beforeloop_titlefontsize'] != "") {
                                                $beforeloop_titlefontsize = $bdp_settings['beforeloop_titlefontsize'];
                                            } else {
                                                $beforeloop_titlefontsize = 14;
                                            }
                                            ?>
                                            <div class="grid_col_space range_slider_fontsize" id="beforeloop_titlefontsizeInput" ></div>
                                            <div class="slide_val"><span></span><input class="grid_col_space_val range-slider__value" name="beforeloop_titlefontsize" id="beforeloop_titlefontsize" value="<?php echo $beforeloop_titlefontsize; ?>" onkeypress="return isNumberKey(event)" /></div>
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
                                            <?php $beforeloop_title_font_weight = isset($bdp_settings['beforeloop_title_font_weight']) ? $bdp_settings['beforeloop_title_font_weight'] : 'normal'; ?>
                                            <div class="select-cover">
                                                <select name="beforeloop_title_font_weight" id="beforeloop_title_font_weight">
                                                    <option value="100" <?php selected($beforeloop_title_font_weight, 100); ?>>100</option>
                                                    <option value="200" <?php selected($beforeloop_title_font_weight, 200); ?>>200</option>
                                                    <option value="300" <?php selected($beforeloop_title_font_weight, 300); ?>>300</option>
                                                    <option value="400" <?php selected($beforeloop_title_font_weight, 400); ?>>400</option>
                                                    <option value="500" <?php selected($beforeloop_title_font_weight, 500); ?>>500</option>
                                                    <option value="600" <?php selected($beforeloop_title_font_weight, 600); ?>>600</option>
                                                    <option value="700" <?php selected($beforeloop_title_font_weight, 700); ?>>700</option>
                                                    <option value="800" <?php selected($beforeloop_title_font_weight, 800); ?>>800</option>
                                                    <option value="900" <?php selected($beforeloop_title_font_weight, 900); ?>>900</option>
                                                    <option value="bold" <?php selected($beforeloop_title_font_weight, 'bold'); ?> ><?php _e('Bold', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option value="normal" <?php selected($beforeloop_title_font_weight, 'normal'); ?>><?php _e('Normal', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Line Height', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select line height', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <div class="input-type-number">
                                                <input type="number" name="beforeloop_title_font_line_height" id="beforeloop_title_font_line_height" step="0.1" min="0" value="<?php echo isset($bdp_settings['beforeloop_title_font_line_height']) ? $bdp_settings['beforeloop_title_font_line_height'] : '1.5'; ?>" onkeypress="return isNumberKey(event)" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bdp-typography-cover">
                                        <div class="bdp-typography-label">
                                            <span class="bdp-key-title">
                                                <?php _e('Italic Font Style', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                            </span>
                                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable italic font style', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span><?php $beforeloop_title_font_italic = isset($bdp_settings['beforeloop_title_font_italic']) ? $bdp_settings['beforeloop_title_font_italic'] : '0';?>
                                        </div>
                                        <div class="bdp-typography-content">
                                            <fieldset class="bdp-social-options bdp-display_author buttonset">
                                                <input id="beforeloop_title_font_italic_1" name="beforeloop_title_font_italic" type="radio" value="1"  <?php checked(1, $beforeloop_title_font_italic); ?> />
                                                <label for="beforeloop_title_font_italic_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="beforeloop_title_font_italic_0" name="beforeloop_title_font_italic" type="radio" value="0" <?php checked(0, $beforeloop_title_font_italic); ?> />
                                                <label for="beforeloop_title_font_italic_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
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
                                            <?php $beforeloop_title_font_text_transform = isset($bdp_settings['beforeloop_title_font_text_transform']) ? $bdp_settings['beforeloop_title_font_text_transform'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="beforeloop_title_font_text_transform" id="beforeloop_title_font_text_transform">
                                                    <option <?php selected($beforeloop_title_font_text_transform, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_transform, 'capitalize'); ?> value="capitalize"><?php _e('Capitalize', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_transform, 'uppercase'); ?> value="uppercase"><?php _e('Uppercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_transform, 'lowercase'); ?> value="lowercase"><?php _e('Lowercase', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_transform, 'full-width'); ?> value="full-width"><?php _e('Full Width', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
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
                                            <?php $beforeloop_title_font_text_decoration = isset($bdp_settings['beforeloop_title_font_text_decoration']) ? $bdp_settings['beforeloop_title_font_text_decoration'] : 'none'; ?>
                                            <div class="select-cover">
                                                <select name="beforeloop_title_font_text_decoration" id="beforeloop_title_font_text_decoration">
                                                    <option <?php selected($beforeloop_title_font_text_decoration, 'none'); ?> value="none"><?php _e('None', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_decoration, 'underline'); ?> value="underline"><?php _e('Underline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_decoration, 'overline'); ?> value="overline"><?php _e('Overline', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                                                    <option <?php selected($beforeloop_title_font_text_decoration, 'line-through'); ?> value="line-through"><?php _e('Line Through', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
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
                                                <input type="number" name="beforeloop_title_font_letter_spacing" id="beforeloop_title_font_letter_spacing" step="1" min="0" value="<?php echo isset($bdp_settings['beforeloop_title_font_letter_spacing']) ? $bdp_settings['beforeloop_title_font_letter_spacing'] : '0'; ?>" onkeypress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
                <div id="bdpsocial" class="postbox postbox-with-fw-options" <?php echo $bdpsocial_class_show; ?>>
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
                                    <?php
                                    $social_share = isset($bdp_settings['social_share']) ? $bdp_settings['social_share'] : 1;
                                    ?>
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
                                        <input id="social_icon_size_2" name="social_icon_size" type="radio" value="2" <?php checked(2, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_2" <?php checked(2, $social_icon_size); ?>><?php _e('Extra Small', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_icon_size_1" name="social_icon_size" type="radio" value="1" <?php checked(1, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_1" <?php checked(1, $social_icon_size); ?>><?php _e('Small', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                        <input id="social_icon_size_0" name="social_icon_size" type="radio" value="0" <?php checked(0, $social_icon_size); ?> />
                                        <label id="bdp-options-button" for="social_icon_size_0" <?php checked(0, $social_icon_size); ?>><?php _e('Large', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
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
                                <h3 class="bdp-table-title"><?php _e('Social Share Links Settings', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                                <div class="bdp-typography-wrapper">

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
                                            <?php
                                            $pinterest_link = isset($bdp_settings['pinterest_link']) ? $bdp_settings['pinterest_link'] : 1;
                                            ?>
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
                                                <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Enable/Disable pinterest share button on feature image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                                            </span>

                                        </div>
                                        <div class="bdp-typography-content">
                                            <?php $pinterest_image_share = isset($bdp_settings['pinterest_image_share']) ? $bdp_settings['pinterest_image_share'] : 1; ?>
                                            <fieldset class="bdp-social-options bdp-linkedin_link buttonset buttonset-hide" data-hide='1'>
                                                <input id="pinterest_image_share_1" name="pinterest_image_share" type="radio" value="1" <?php checked(1, $pinterest_image_share); ?> />
                                                <label for="pinterest_image_share_1" <?php checked(1, $pinterest_image_share); ?>><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="pinterest_image_share_0" name="pinterest_image_share" type="radio" value="0" <?php checked(0, $pinterest_image_share); ?> />
                                                <label for="pinterest_image_share_0" <?php checked(0, $pinterest_image_share); ?>><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                            </fieldset>
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
                                                <label id="bdp-opts-button" for="email_link_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                                <input id="email_link_0" class="bdp-opts-button" name="email_link" type="radio" value="0" <?php checked(0, $email_link); ?> />
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
                                        <p> [post_title] => <?php _e('Post Title', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </p>
                                        <p> [post_link] => <?php _e('Post Link', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </p>
                                        <p> [post_thumbnail] => <?php _e('Post Featured Image', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </p>
                                        <p> [sender_name] => <?php _e('Mail Sender Name', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </p>
                                        <p> [sender_email] => <?php _e('Mail Sender Email Address', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </p>
                                    </div>
                                </div>
                            </li>

                            <li class ="social_share_options">
                                <div class="bdp-left">
                                    <span class="bdp-key-title">
                                        <?php _e('Social Share Count Position', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </span>
                                </div>
                                <div class="bdp-right"><span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Select social share count position', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="popupdiv" class="bdp-template-popupdiv" style="display: none;">
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
            <li>
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

            <div class="bdp-blog-template-search-cover">
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
                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
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
    <div id="popuploaderdiv" class="bdp-loader-popupdiv bdp-wrapper" style="display: none;">
        <div class="bdp-loader-style-box">
            <?php
            $total_bullets = count($loaders);
            if ($total_bullets > 0) {
                foreach ($loaders as $key => $loader_html) { ?>
                    <div class="bdp-dialog-loader-style <?php echo $key; ?>">
                        <input type="hidden" class="bdp-loader-style-hidden" value="<?php echo $key; ?>" />
                        <div class="bdp-loader-style-html">
                            <?php echo $loader_html; ?>
                        </div>
                    </div>
                <?php
                }
            } ?>
        </div>
    </div>
    <div id="popupnavifationdiv" class="bdp-navigation-popupdiv bdp-wrapper" style="display: none;">
        <div class="bdp-navigation-style-box">
            <?php
            for($i = 1; $i <= 9; $i++) {
                ?>
                <div class="bdp-navigation-cover navigation<?php echo $i; ?>">
                    <input type="hidden" class="bdp-navigation-style-hidden" value="navigation<?php echo $i; ?>" />
                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/images/navigation/navigation'.$i.'.png'; ?>">
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div id="popuparrowdiv" class="bdp-arrow-popupdiv bdp-wrapper" style="display: none;">
        <div class="bdp-arrow-style-box">
            <?php
            for($i = 1; $i <= 6; $i++) {
                ?>
                <div class="bdp-arrow-cover arrow<?php echo $i; ?>">
                    <input type="hidden" class="bdp-arrow-style-hidden" value="arrow<?php echo $i; ?>" />
                    <img src="<?php echo BLOGDESIGNERPRO_URL . '/images/arrow/arrow'.$i.'.png'; ?>">
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
