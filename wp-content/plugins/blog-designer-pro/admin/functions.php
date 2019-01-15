<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Initialise an array of all recognized font faces.
 * @return array $default
 */
if (!function_exists('bdp_default_recognized_font_faces')) {

    function bdp_default_recognized_font_faces() {
        $default = array(
            //Serif Fonts
            array('type' => 'websafe', 'version' => __('Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => 'Georgia, serif'),
            array('type' => 'websafe', 'version' => __('Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Palatino Linotype", "Book Antiqua", Palatino, serif'),
            array('type' => 'websafe', 'version' => __('Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Times New Roman", Times, serif'),
            //Sans-Serif Fonts
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => 'Arial, Helvetica, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Arial Black", Gadget, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Comic Sans MS", cursive, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => 'Impact, Charcoal, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => 'Tahoma, Geneva, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Trebuchet MS", Helvetica, sans-serif'),
            array('type' => 'websafe', 'version' => __('Sans-Serif Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => 'Verdana, Geneva, sans-serif'),
            //Monospace Fonts
            array('type' => 'websafe', 'version' => __('Monospace Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Courier New", Courier, monospace'),
            array('type' => 'websafe', 'version' => __('Monospace Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => '"Lucida Console", Monaco, monospace')
        );

        include_once 'assets/google_fonts_collection.php';

        foreach ($googlefontsArr as $f => $val) {
            $default[] = array('type' => 'googlefont', 'version' => __('Google Fonts', BLOGDESIGNERPRO_TEXTDOMAIN), 'label' => $f, 'variants' => $val['variants'], 'subsets' => $val['subsets']);
        }
        return $default;
    }

}

/*
 *  Add social share icons
 */
if (!function_exists('bdp_get_social_icons')) {

    function bdp_get_social_icons($bdp_settings) {
        $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
        if($social_share) {
            if (($bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                    ($bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                    (isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) || ( $bdp_settings['pinterest_link'] == 1) ||
                    ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                    ( isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) ||
                    ( isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) ||
                    ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                    ( isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) ||
                    ( isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) ||
                    ( isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) ||
                    ( isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) ||
                    ( $bdp_settings['whatsapp_link'] == 1)) {

                if (!wp_script_is('bdp-socialShare-script', $list = 'enqueued')) {
                    wp_enqueue_script('bdp-socialShare-script');
                }
                $social_theme = ' default_social_style_1 ';
                if (isset($bdp_settings['default_icon_theme']) && isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                    $social_theme = ' default_social_style_' . $bdp_settings['default_icon_theme'] . ' ';
                }
                $social_style = (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) ? 'bdp-social-style-defult' : 'bdp-social-style-custom';
                ?>
                <div class="social-component<?php echo $social_theme.' '.$social_style; ?><?php echo ' bdp_social_count_' . get_the_ID(); ?><?php
                if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 0) {
                    if (isset($bdp_settings['social_icon_size']) && $bdp_settings['social_icon_size'] == 0) {
                        echo ' large';
                    } elseif (isset($bdp_settings['social_icon_size']) && $bdp_settings['social_icon_size'] == 2) {
                        echo ' extra_small';
                    }
                }

                if (isset($bdp_settings['social_count_position'])) {
                    echo ' ';
                    echo $bdp_settings['social_count_position'];
                }
                ?>">
                         <?php
                    if ($bdp_settings['facebook_link'] == 1) {

                            if (isset($bdp_settings['facebook_link_with_count']) && $bdp_settings['facebook_link_with_count'] == 1) {
                                if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                                    <div class="social-share">
                                        <a data-share="facebook" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo get_the_permalink(); ?>" class="bdp-facebook-share social-share-default bdp-social-share"></a>
                                    </div>
                                <?php } else { ?>
                                    <div class="social-share">
                                        <a data-share="facebook" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo get_the_permalink(); ?>" class="bdp-facebook-share facebook-share social-share-custom bdp-social-share">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="social-share">
                                    <?php
                                    if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                                        if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                            ?>
                                            <div class="count c_facebook facebook-count">0</div><?php } ?>
                                        <a data-share="facebook" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo get_the_permalink(); ?>" class="bdp-facebook-share social-share-default bdp-social-share"></a>
                                        <?php
                                    } else {
                                        if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                            ?>
                                            <div class="count c_facebook facebook-count">0</div><?php }
                                        ?>
                                        <a data-share="facebook" data-href="https://www.facebook.com/sharer/sharer.php" data-url="<?php echo get_the_permalink(); ?>" class="bdp-facebook-share facebook-share social-share-custom bdp-social-share">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <?php
                                    }
                                    if ((isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'bottom') || (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'right')) {
                                        ?>
                                        <div class="count c_facebook facebook-count">0</div><?php } ?>
                                </div>
                            <?php
                            }
                    }

                    if ($bdp_settings['google_link'] == 1) {
                        ?>
                        <div class="social-share">
                            <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                                <a data-share="google" data-href="https://plus.google.com/share" data-url="<?php echo get_the_permalink();?>" class="bdp-google-share social-share-default bdp-social-share"></a>

                            <?php } else { ?>
                                <a data-share="google" data-href="https://plus.google.com/share" data-url="<?php echo get_the_permalink();?>" class="bdp-google-share social-share-custom bdp-social-share">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            <?php } ?>
                        </div>
                        <?php
                    }

                    if ($bdp_settings['twitter_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                             <a data-share="twitter" data-href="https://twitter.com/share" data-text="<?php echo get_the_title(); ?>" data-url="<?php echo get_the_permalink(); ?>" class="bdp-twitter-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="twitter" data-href="https://twitter.com/share" data-text="<?php echo get_the_title(); ?>" data-url="<?php echo get_the_permalink(); ?>" class="bdp-twitter-share social-share-custom bdp-social-share">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if ($bdp_settings['linkedin_link'] == 1) {
                        if (isset($bdp_settings['linkedin_link_with_count']) && $bdp_settings['linkedin_link_with_count'] == 1) {
                            ?>
                            <div class="social-share">
                                <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                                    <a data-share="linkedin" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo get_the_permalink(); ?>" class="bdp-linkedin-share social-share-default bdp-social-share"></a>
                                <?php } else { ?>
                                    <a data-share="linkedin" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo get_the_permalink(); ?>" class="bdp-linkedin-share social-share-custom bdp-social-share">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } else {
                            ?>

                            <div class="social-share">
                                <?php
                                if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                                    if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                        ?>
                                        <div class="count c_linkedin linkedin-count">0</div> <?php }
                                    ?>
                                    <a data-share="linkedin" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo get_the_permalink(); ?>" class="bdp-linkedin-share social-share-default bdp-social-share">
                                    </a>
                                    <?php
                                } else {
                                    if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                        ?>
                                        <div class="count c_linkedin linkedin-count">0</div> <?php }
                                    ?>
                                    <a data-share="linkedin" data-href="https://www.linkedin.com/shareArticle" data-url="<?php echo get_the_permalink(); ?>" class="bdp-linkedin-share social-share-custom bdp-social-share">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <?php
                                }
                                if ((isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'bottom') || (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'right')) {
                                    ?>
                                    <div class="count c_linkedin linkedin-count">0</div><?php } ?>
                            </div>
                            <?php
                        }
                    }

                    if ($bdp_settings['pinterest_link'] == 1) {
                        $pinterestimage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        if (isset($bdp_settings['pinterest_link_with_count']) && $bdp_settings['pinterest_link_with_count'] == 1) {
                            ?>
                            <div class="social-share">
                                <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                                    <a data-share="pinterest" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo get_the_permalink(); ?>" data-mdia="<?php echo $pinterestimage[0]; ?>" data-description="<?php echo get_the_title(); ?>" class="bdp-pinterest-share social-share-default bdp-social-share">
                                    </a>
                                <?php } else { ?>
                                    <a data-share="pinterest" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo get_the_permalink(); ?>" data-mdia="<?php echo $pinterestimage[0]; ?>" data-description="<?php echo get_the_title(); ?>" class="bdp-pinterest-share social-share-custom bdp-social-share">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                <?php } ?>

                            </div>
                        <?php } else {
                            ?>
                            <div class="social-share">
                                <?php
                                if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                                    if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                        ?>
                                        <div class="count c_pinterest pinterest-count">0</div> <?php }
                                    ?>
                                    <a data-share="pinterest" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo get_the_permalink(); ?>" data-mdia="<?php echo $pinterestimage[0]; ?>" data-description="<?php echo get_the_title(); ?>" class="bdp-pinterest-share social-share-default bdp-social-share"></a>
                                    <?php
                                } else {
                                    if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
                                        ?>
                                        <div class="count c_pinterest pinterest-count">0</div> <?php }
                                    ?>

                                    <a data-share="pinterest" data-href="https://pinterest.com/pin/create/button/" data-url="<?php echo get_the_permalink(); ?>" data-mdia="<?php echo $pinterestimage[0]; ?>" data-description="<?php echo get_the_title(); ?>" class="bdp-pinterest-share social-share-custom bdp-social-share">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                    <?php
                                }
                                if ((isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'bottom') || (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'right')) {
                                    ?>
                                    <div class="count c_pinterest pinterest-count">0</div><?php } ?>
                            </div>
                            <?php
                        }
                    }
                    if (isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                            <a data-share="skype" data-href="https://web.skype.com/share" data-url="<?php echo get_the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" class="bdp-skype-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="skype" data-href="https://web.skype.com/share" data-url="<?php echo get_the_permalink(); ?>" data-text="<?php echo get_the_title(); ?>" class="bdp-telegram-share social-share-custom bdp-social-share">
                                <i class="fab fa-skype"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="telegram" data-href="https://telegram.me/share/url" data-url="<?php echo urldecode(get_the_permalink()); ?>" data-text="<?php echo get_the_title(); ?>" class="bdp-telegram-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="telegram" data-href="https://telegram.me/share/url" data-url="<?php echo urldecode(get_the_permalink()); ?>" data-text="<?php echo get_the_title(); ?>" class="bdp-telegram-share social-share-custom bdp-social-share">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="pocket" data-href="https://getpocket.com/save" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-pocket-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="pocket" data-href="https://getpocket.com/save" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-pocket-share social-share-custom bdp-social-share">
                                <i class="fab fa-get-pocket"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="reddit" data-href="http://www.reddit.com/submit" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-reddit-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="reddit" data-href="http://www.reddit.com/submit" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-reddit-share social-share-custom bdp-social-share">
                                <i class="fab fa-reddit-alien"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="digg" data-href="http://digg.com/submit" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-digg-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="digg" data-href="http://digg.com/submit" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-digg-share social-share-custom bdp-social-share">
                                <i class="fab fa-digg"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="tumblr" data-href="http://tumblr.com/widgets/share/tool" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-tumblr-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="tumblr" data-href="http://tumblr.com/widgets/share/tool" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" class="bdp-tumblr-share social-share-custom bdp-social-share">
                                <i class="fab fa-tumblr"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) {
                        echo '<div class="social-share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a data-share="wordpress" data-href="http://wordpress.com/press-this.php" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-image="<?php echo get_the_post_thumbnail_url(); ?>" class="bdp-wordpress-share social-share-default bdp-social-share"></a>
                        <?php } else { ?>
                            <a data-share="wordpress" data-href="http://wordpress.com/press-this.php" data-url="<?php echo get_the_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-image="<?php echo get_the_post_thumbnail_url(); ?>" class="bdp-wordpress-share social-share-custom bdp-social-share">
                                <i class="fab fa-wordpress"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) {
                        $shortcode_id = BdpFrontFunction::$shortcode_id;
                        if (is_array($shortcode_id) && !empty($shortcode_id)) {
                            $shortcode_id = $shortcode_id[0];
                        }

                        echo '<div class="social-share">';
                        ?>
                        <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                            <a data-shortcode-id="<?php echo (!empty($shortcode_id)) ? $shortcode_id : ''; ?>" data-id="<?php echo get_the_ID(); ?>" href="javascript:void(0)" class="bdp-email-share social-share-default bdp-social-share">
                            </a>
                        <?php } else { ?>
                            <a data-shortcode-id="<?php echo (!empty($shortcode_id)) ? $shortcode_id : ''; ?>" data-id="<?php echo get_the_ID(); ?>" href="javascript:void(0)" class="bdp-email-share social-share-custom bdp-social-share">
                                <i class="far fa-envelope-open"></i>
                            </a>
                        <?php }
                        echo '</div>';
                    }

                    if (isset($bdp_settings['whatsapp_link']) && $bdp_settings['whatsapp_link'] == 1) {
                        echo '<div class="social-share whatsapp_share">';
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo 'whatsapp://send?text=' . get_the_title() . ' ' . get_the_permalink() . '&url=' . urlencode(get_the_permalink()); ?>" target="_blank" class="bdp-whatsapp-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo 'whatsapp://send?text=' . get_the_title() . ' ' . get_the_permalink() . '&url=' . urlencode(get_the_permalink()); ?>" data-action="share/whatsapp/share" target="_blank" class="bdp-whatsapp-share social-share-custom">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <?php
                        }
                        echo '</div>';
                    }

                    if ((!isset($bdp_settings['pinterest_link_with_count']) ) ||
                            (!isset($bdp_settings['linkedin_link_with_count']) ) ||
                            (!isset($bdp_settings['facebook_link_with_count']))
                    ) {
                        if (get_the_title() != '') {
                            ?>
                            <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery('.<?php echo 'bdp_social_count_' . get_the_ID(); ?> .count').ShareCounter({
                                        url: '<?php echo get_the_permalink(); ?>'
                                    });
                                });
                            </script>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
        }
    }

}

/**
 * @param int $id
 * @param string $page
 * @return array $classes
 */
if (!function_exists('bdp_postbox_classes')) {

    function bdp_postbox_classes($id, $page) {
        if ($closed = get_user_option('bdpclosedbdpboxes_' . $page)) {
            if (!is_array($closed)) {
                $classes = array('');
            } else {
                $classes = in_array($id, $closed) ? array('closed') : array('');
            }
        } else {
            $classes = array('');
        }
        return implode(' ', $classes);
    }

}

/**
 * Get setting from database from shortcode id
 * @param int $shortcode_id
 * @global object $wpdb
 * @return boolean, null or array
 */
if (!function_exists('bdp_get_shortcode_settings')) {

    function bdp_get_shortcode_settings($shortcode_id) {
        global $wpdb;
        $tableName = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $get_settings_query = "SELECT * FROM $tableName WHERE bdid = " . $shortcode_id;
        $settings_val = $wpdb->get_results($get_settings_query, ARRAY_A);
        if (!$settings_val) {
            return;
        }
        $allsettings = $settings_val[0]['bdsettings'];
        if (is_serialized($allsettings)) {
            return $bdp_settings = unserialize($allsettings);
        }
        return false;
    }

}

/**
 * include Blog template
 * @param string $bdp_theme
 * @param array $bdp_settings
 * @param atring $alter_class
 */
if (!function_exists('bdp_get_blog_template')) {

    function bdp_get_blog_template($bdp_theme, $bdp_settings, $alter_class, $prev_year, $paged, $count_sticky, $alter_val) {
        ob_start();
        $themePath = get_stylesheet_directory() . '/bdp_templates/' . $bdp_theme;
        if (!file_exists($themePath)) {
            $themePath = BLOGDESIGNERPRO_DIR . 'bdp_templates/' . $bdp_theme;
        }
        if (file_exists($themePath)) {
            include $themePath;
        }
        return ob_get_clean();
    }

}

/**
 * include Blog load more template
 * @param string $bdp_theme
 * @param array $bdp_settings
 * @param atring $alter_class
 */
if (!function_exists('bdp_get_blog_loadmore_template')) {

    function bdp_get_blog_loadmore_template($bdp_theme, $bdp_settings, $alter_class, $prev_year, $paged, $count_sticky) {
        $themePath = get_stylesheet_directory() . '/bdp_templates/' . $bdp_theme;
        if (!file_exists($themePath)) {
            $themePath = BLOGDESIGNERPRO_DIR . 'bdp_templates/' . $bdp_theme;
        }
        if (file_exists($themePath)) {
            include $themePath;
        }
    }

}

/**
 * include selected template
 * @param string $bdp_theme
 */
if (!function_exists('bdp_get_template')) {

    function bdp_get_template($bdp_theme) {
        $themePath = get_stylesheet_directory() . '/bdp_templates/' . $bdp_theme;
        if (!file_exists($themePath)) {
            $themePath = BLOGDESIGNERPRO_DIR . 'bdp_templates/' . $bdp_theme;
        }
        if (file_exists($themePath)) {
            include $themePath;
        }
    }

}

/**
 * @return int
 */
if (!function_exists('bdp_paged')) {

    function bdp_paged() {
        if (strstr($_SERVER['REQUEST_URI'], 'paged') || strstr($_SERVER['REQUEST_URI'], 'page')) {
            if (isset($_REQUEST['paged'])) {
                $paged = $_REQUEST['paged'];
            } else {
                $uri = explode('/', $_SERVER['REQUEST_URI']);
                $uri = array_reverse($uri);
                if($uri[0] == '') {
                    $paged = $uri[1];
                }
                else {
                    $paged = $uri[0];
                }
            }
        } else {
            $paged = 1;
        }
        return $paged;
    }

}

/**
 * add pagination
 * @return pagination
 */
if (!function_exists('bdp_standard_paging_nav')) {

    function bdp_standard_paging_nav() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        $navigation = '';
        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'total' => $GLOBALS['wp_query']->max_num_pages,
            'current' => $paged,
            'mid_size' => 1,
            'add_args' => array_map('urlencode', $query_args),
            'prev_text' => '&larr; ' . __('Previous', BLOGDESIGNERPRO_TEXTDOMAIN),
            'next_text' => __('Next', BLOGDESIGNERPRO_TEXTDOMAIN) . ' &rarr;',
            'type' => 'list',
        ));

        if ($links) :
            $navigation .= '<nav class="navigation paging-navigation" role="navigation">';
            $navigation .= $links;
            $navigation .= '</nav>';
        endif;
        return $navigation;
    }

}

/**
 * Display total downloads of plugin
 */
if (!function_exists('bdp_get_total_downloads')) {

    function bdp_get_total_downloads() {
        // Set the arguments. For brevity of code, I will set only a few fields.
        $plugins = $response = "";
        $args = array(
            'author' => 'solwininfotech',
            'fields' => array(
                'downloaded' => true,
                'downloadlink' => true
            )
        );
        // Make request and extract plug-in object. Action is query_plugins
        $response = wp_remote_post(
                'https://api.wordpress.org/plugins/info/1.0/', array(
            'body' => array(
                'action' => 'query_plugins',
                'request' => serialize((object) $args)
            )
                )
        );
        if (!is_wp_error($response)) {
            $returned_object = unserialize(wp_remote_retrieve_body($response));
            $plugins = $returned_object->plugins;
        }
        $current_slug = 'blog-designer';
        if ($plugins) {
            foreach ($plugins as $plugin) {
                if ($current_slug == $plugin->slug) {
                    if ($plugin->downloaded) {
                        ?>
                        <span class="total-downloads">
                            <span class="download-number"><?php echo $plugin->downloaded; ?></span>
                        </span>
                        <?php
                    }
                }
            }
        }
    }

}

/**
 * Display rating of plugin
 */
if (!function_exists('bdp_custom_star_rating')) {

    function bdp_custom_star_rating($args = array()) {
        $plugins = $response = "";
        $args = array(
            'author' => 'solwininfotech',
            'fields' => array(
                'downloaded' => true,
                'downloadlink' => true
            )
        );
        // Make request and extract plug-in object. Action is query_plugins
        $response = wp_remote_post(
                'https://api.wordpress.org/plugins/info/1.0/', array(
            'body' => array(
                'action' => 'query_plugins',
                'request' => serialize((object) $args)
            )
                )
        );
        if (!is_wp_error($response)) {
            $returned_object = unserialize(wp_remote_retrieve_body($response));
            $plugins = $returned_object->plugins;
        }
        $current_slug = 'blog-designer';
        if ($plugins) {
            foreach ($plugins as $plugin) {
                if ($current_slug == $plugin->slug) {
                    $rating = $plugin->rating * 5 / 100;
                    if ($rating > 0) {
                        $args = array(
                            'rating' => $rating,
                            'type' => 'rating',
                            'number' => $plugin->num_ratings,
                        );
                        wp_star_rating($args);
                    }
                }
            }
        }
    }

}

/**
 * Get first media
 * @param int postid
 * @return video, audio or gallery
 */
if (!function_exists('bdp_get_first_embed_media')) {

    function bdp_get_first_embed_media($post_id, $bdp_settings = '') {
        $post = get_post($post_id);
        $content = $post->post_content;
        $audio_video = new WP_Embed();
        $content = $audio_video->run_shortcode($content);
        $content = $audio_video->autoembed($content);
        $content = wpautop($content);
        $embeds = get_media_embedded_in_content($content);
        $post_format = get_post_format($post_id);
        if ($post_format == 'gallery') {
            $gallery_images = get_post_gallery($post_id, false);
            ob_start();
            if ($gallery_images) {
                if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                    wp_enqueue_script('bdp-galleryimage-script');
                }
                ?>
                <div class="bdp-flexslider flexslider" style="margin:0">
                    <ul class="bdp-slides slides">
                        <?php
                        if(isset($gallery_images['ids'])) {
                            $gallery_images_ids =  $gallery_images['ids'];
                            $gallery_images_ids = explode(',', $gallery_images_ids);
                            if ($bdp_settings['bdp_media_size'] == 'custom') {
                                foreach ($gallery_images_ids as $gallery_images_id) {
                                    $url = wp_get_attachment_url($gallery_images_id);
                                    $width = isset($bdp_settings['media_custom_width']) ? $bdp_settings['media_custom_width'] : 560;
                                    $height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : 350;
                                    $resizedImage = bdp_resize($url, $width, $height, true, $gallery_images_id);
                                    echo '<li style="margin:0">';
                                    echo'<img src="' . $resizedImage["url"] . '" width="' . $resizedImage["width"] . '" height="' . $resizedImage["height"] . '" />';
                                    echo '</li>';
                                }
                            } elseif($bdp_settings['bdp_media_size'] != 'full') {
                                $post_thumbnail = $bdp_settings['bdp_media_size'];
                                foreach ($gallery_images_ids as $gallery_images_id) {
                                    echo '<li style="margin:0">';
                                    echo wp_get_attachment_image($gallery_images_id, $post_thumbnail);
                                    echo '</li>';
                                }
                            } else {
                                foreach ($gallery_images['src'] as $gallery_images) {
                                    echo '<li style="margin:0">';
                                    echo'<img src="' . $gallery_images . '" />';
                                    echo '</li>';
                                }
                            }
                        } else {
                            foreach ($gallery_images['src'] as $gallery_images) {
                                echo '<li style="margin:0">';
                                echo'<img src="' . $gallery_images . '" />';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
            $gallery_img = ob_get_clean();
            return $gallery_img;
        } elseif ($post_format == 'video') {
            $pattern = get_shortcode_regex();
            if (preg_match_all('/' . $pattern . '/s', $content, $matches) && array_key_exists(2, $matches) && in_array('video', $matches[2])) {
                return do_shortcode($matches[0][0]);
            }
            if (!empty($embeds) && ((strpos($embeds[0], 'youtube') || strpos($embeds[0], 'vimeo') || strpos($embeds[0], 'videopress')))) {
                return $embeds[0];
            }
        } elseif ($post_format == 'audio') {
            $pattern = get_shortcode_regex();
            if (preg_match_all('/' . $pattern . '/s', $content, $matches) && array_key_exists(2, $matches) && in_array('audio', $matches[2])) {
                if (isset($matches[0][0])) {
                    return do_shortcode($matches[0][0]);
                }
            }
            if (preg_match('/https:\/\/[\"soundcloud.com]+\.[a-zA-Z0-9]{2,3}(\/\S*)?/', $post->post_content, $result)) {
                if (isset($result[0]) && wp_oembed_get($result[0])) {
                    return wp_oembed_get($result[0]);
                }
            }
            if (preg_match_all('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $post->post_content, $matches)) {
                if ($matches && isset($matches[1])) {
                    $iframe_round = 0;
                    foreach ($matches[1] as $single_match) {
                        if (strpos($single_match, 'w.soundcloud.com/player/')) {
                            return $matches[0][$iframe_round];
                        }
                        $iframe_round++;
                    }
                }
            }
        }
        return false;
    }

}

/**
 * @param type $content
 * @return content Add a class in first letter
 */
if (!function_exists('bdp_add_first_letter_structure')) {

    function bdp_add_first_letter_structure($content) {

        if (preg_match('#(>|]|^)(([A-Z]|[a-z]|[0-9]|[\p{L}])(.*\R)*(\R)*.*)#m', $content, $matches)) {
            $top_content = str_replace($matches[2], '', $content);
            $content_change = ltrim($matches[2]);
            $bdp_content_first_letter = mb_substr($content_change, 0, 1);
            if (mb_substr($content_change, 1, 1) === ' ') {
                $bdp_remaining_letter = ' ' . mb_substr($content_change, 2);
            } else {
                $bdp_remaining_letter = mb_substr($content_change, 1);
            }
            $spanned_first_letter = '<span class="bdp-first-letter">' . $bdp_content_first_letter . '</span>';
            $bottom_content = $spanned_first_letter . $bdp_remaining_letter;
            return $top_content . $bottom_content;
        }
        return $content;
    }

}

/**
 * change in exceprt content
 * @param int $bdp_post_id
 * @param boolean $rss_use_excerpt
 * @param int $excerpt_length
 * @return content or excerpt
 */
if (!function_exists('bdp_get_content')) {

    function bdp_get_content($bdp_post_id, $rss_use_excerpt = 0, $excerpt_length = 20, $bdp_settings) {
        add_filter( 'the_content_more_link', 'bdp_remove_more_link', 999 );
        if($excerpt_length != '' && $excerpt_length < 1) {
            return;
        }
        remove_all_filters( 'excerpt_more');
        if ($rss_use_excerpt == 0):
            $content = apply_filters('the_content', get_the_content($bdp_post_id));
            $content = apply_filters('bdp_content_change', $content, $bdp_post_id);
            if (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] == 1) {
                return bdp_add_first_letter_structure($content);
            } else {
                return $content;
            }
        else:
            $template_post_content_from = 'from_content';
            if (isset($bdp_settings['template_post_content_from'])) {
                $template_post_content_from = $bdp_settings['template_post_content_from'];
            }
            if ($template_post_content_from == 'from_excerpt') {
                if (get_the_excerpt($bdp_post_id) != '') {
                    $excerpt = get_the_excerpt($bdp_post_id);
                } else {
                    $excerpt = get_the_content($bdp_post_id);
                }
            } else {
                $excerpt = get_the_content($bdp_post_id);
            }

            if (isset($bdp_settings['display_html_tags']) && $bdp_settings['display_html_tags'] == 1) {
                $text = $excerpt;
                $text = apply_filters('the_content', $text);
                if (strpos(_x('Words', 'Word count type. Do not translate!', BLOGDESIGNERPRO_TEXTDOMAIN), 'characters') === 0 && preg_match('/^utf\-?8$/i', get_option('blog_charset'))) {
                    $text = trim(preg_replace("/[\n\r\t ]+/", ' ', $text), ' ');
                    preg_match_all('/./u', $text, $words_array);
                    $words_array = array_slice($words_array[0], 0, $excerpt_length + 1);
                    $sep = '';
                } else {
                    $words_array = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                    $sep = ' ';
                }
                if (count($words_array) > $excerpt_length) {
                    array_pop($words_array);
                    $text = implode($sep, $words_array);
                    $bdp_excerpt_data = $text;
                } else {
                    $bdp_excerpt_data = implode($sep, $words_array);
                }

                $first_letter = $bdp_excerpt_data;
                if (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] == 1) {
                    if (preg_match('#(>|]|^)(([A-Z]|[a-z]|[0-9]|[\p{L}])(.*\R)*(\R)*.*)#m', $first_letter, $matches)) {
                        $top_content = str_replace($matches[2], '', $first_letter);
                        $content_change = ltrim($matches[2]);
                        $bp_content_first_letter = mb_substr($content_change, 0, 1);
                        if (mb_substr($content_change, 1, 1) === ' ') {
                            $bp_remaining_letter = ' ' . mb_substr($content_change, 2);
                        } else {
                            $bp_remaining_letter = mb_substr($content_change, 1);
                        }
                        $spanned_first_letter = '<span class="bp-first-letter">' . $bp_content_first_letter . '</span>';
                        $bottom_content = $spanned_first_letter . $bp_remaining_letter;
                        $bdp_excerpt_data = $top_content . $bottom_content;
                    }
                }
                $bdp_excerpt_data = bdp_advance_contens($bdp_excerpt_data, $bdp_settings);
                $bdp_excerpt_data = bdp_close_tags($bdp_excerpt_data);
                $bdp_excerpt_data = apply_filters('the_content', $bdp_excerpt_data);
                return $bdp_excerpt_data;
            } else {
                $text = strip_shortcodes($excerpt);
                $text = apply_filters('the_content', $text);
                $text = str_replace(']]>', ']]&gt;', $text);

                if (strpos(_x('words', 'Word count type. Do not translate!', BLOGDESIGNERPRO_TEXTDOMAIN), 'characters') === 0 && preg_match('/^utf\-?8$/i', get_option('blog_charset'))) {
                    $text = trim(preg_replace("/[\n\r\t ]+/", ' ', $text), ' ');
                    preg_match_all('/./u', $text, $words_array);
                    $words_array = array_slice($words_array[0], 0, $excerpt_length + 1);
                    $sep = '';
                } else {
                    $words_array = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                    $sep = ' ';
                }
                if (count($words_array) > $excerpt_length) {
                    array_pop($words_array);
                    $text = implode($sep, $words_array);
                    $bdp_excerpt_data = $text;
                } else {
                    $bdp_excerpt_data = implode($sep, $words_array);
                }
                $bdp_excerpt_data = bdp_advance_contens($bdp_excerpt_data, $bdp_settings);

                $bdp_excerpt_data = wp_trim_words($bdp_excerpt_data, $excerpt_length, '');
                $bdp_excerpt_data = apply_filters('bdp_excerpt_change', $bdp_excerpt_data, $bdp_post_id);
                return $bdp_excerpt_data;
            }
        endif;
    }

}

/**
 * Remove read more link from content
 * @since 2.2
 * @param $link
 * @return $link
 */
if(!function_exists('bdp_remove_more_link')) {
    function bdp_remove_more_link($link) {
        $link = '';
        return $link;
    }
}

/**
 * Get the advance contents
 * @since 2.0
 * @param $bdp_excerpt_data
 * @return $bdp_excerpt_data
 */
if (!function_exists('bdp_advance_contens')) {

    function bdp_advance_contens($bdp_excerpt_data = '', $bdp_settings) {
        if ($bdp_excerpt_data == '') {
            return $bdp_excerpt_data;
        }

        if (isset($bdp_settings['advance_contents']) && $bdp_settings['advance_contents'] == 1) {
            $stopage_from = isset($bdp_settings['contents_stopage_from']) ? $bdp_settings['contents_stopage_from'] : 'paragraph';
            if (isset($bdp_settings['display_html_tags']) && $bdp_settings['display_html_tags'] == 1) {
                $stopage_from = 'paragraph';
            }

            if ($stopage_from == 'paragraph') {
                $stopage_characters = array('</p>', '</div>', '<br');
                foreach ($stopage_characters as $stopage_character) {
                    $strpose[] = strrpos($bdp_excerpt_data, $stopage_character);
                }
                $bdp_excerpt_data = substr($bdp_excerpt_data, 0, max($strpose));
            } elseif ($stopage_from == 'character') {
                $stopage_characters = isset($bdp_settings['contents_stopage_character']) ? $bdp_settings['contents_stopage_character'] : array('.');
                foreach ($stopage_characters as $stopage_character) {
                    $strpose[] = strrpos($bdp_excerpt_data, $stopage_character);
                }
                $bdp_excerpt_data = substr($bdp_excerpt_data, 0, max($strpose) + 1);
            }
        }

        return $bdp_excerpt_data;
    }

}


/**
 * Close HTML tags
 * @since 2.0
 * @param $html
 * @return $html
 */
if (!function_exists('bdp_close_tags')) {

    function bdp_close_tags($html = '') {
        if ($html == '') {
            return;
        }
        #put all opened tags into an array
        preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $html, $result);
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all("#</([a-z]+)>#iU", $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        # all tags are closed
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        # close tags
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= "</" . $openedtags[$i] . ">";
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

}

/*
 * add pinterest button on image
 * @param int $bdp_post_id
 * @return html pinterest image
 */
if (!function_exists('bdp_pinterest')) {

    function bdp_pinterest($bdp_post_id) {
        ob_start();
        ?>
        <div class="bdp-pinterest-share-image">
            <?php
            $img_url = wp_get_attachment_url(get_post_thumbnail_id($bdp_post_id));
            apply_filters('bdp_pinterest_img_url', $img_url, $bdp_post_id);
            ?>
            <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($bdp_post_id) . '&media=' . $img_url . '&description =' . get_the_title($bdp_post_id); ?>"></a>
        </div>
        <?php
        $pintrest = ob_get_clean();
        return $pintrest;
    }

}

/**
 * get default image
 * @param string template name
 * @param int $bdp_post_id
 * @return html image
 */
if (!function_exists('bdp_get_sample_image')) {

    function bdp_get_sample_image($template_name = '', $bdp_post_id) {

        if ($template_name == 'boxy-clean') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" src="' . BLOGDESIGNERPRO_URL . '/images/no_image_boxy_clean.png" />';
        } elseif ($template_name == 'deport' || $template_name == 'masonry_timeline' || $template_name == 'my_diary' || $template_name  == 'fairy' || $template_name == 'integer' || $template_name == 'clicky' || $template_name == 'roctangle' || $template_name == 'glamour') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" src="' . BLOGDESIGNERPRO_URL . '/images/No_available_deport.gif" />';
        } elseif ($template_name == 'navia') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/No_available_deport.gif" />';
        } elseif ($template_name == 'invert-grid') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/no_available_image_640_320.png" />';
        } elseif ($template_name == 'brit_co' || $template_name == 'minimal') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/no_available_image_580_255.png" />';
        } elseif ($template_name == 'media-grid') {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/no_available_image_640_320.png" />';
        } elseif ($template_name == 'brit_co') {
            $sample_img = '<img width="500" height="500" alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/No_available_image.png" />';
        } elseif ($template_name == 'elina' || $template_name == 'chapter' || $template_name == 'brite' || $template_name == 'advice') {
            $sample_img = '<img width="900" height="400" alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" class="attachment-full size-full wp-post-image" src="' . BLOGDESIGNERPRO_URL . '/images/no_available_image_900.gif" />';
        } else {
            $sample_img = '<img alt="' . esc_attr__('Feature image not available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" src="' . BLOGDESIGNERPRO_URL . '/images/No_available_image.png" />';
        }
        $sample_img = apply_filters('bdp_sample_img', $sample_img, $template_name, $bdp_post_id);
        return $sample_img;
    }

}

/**
 * get default image
 * @param string template name
 * @param int $bdp_settings, $post_thumbnail, $post_thumbnail_id, $bdp_post_id
 * @return html image
 */
if (!function_exists('bdp_get_the_thumbnail')) {

    function bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, $post_thumbnail_id, $bdp_post_id) {
        $thumbnail = '';
        if ($post_thumbnail == '') {
            $post_thumbnail = 'full';
        }
        if (has_post_thumbnail($bdp_post_id)) {
            if (isset($bdp_settings['bdp_media_size'])) {
                if ($bdp_settings['bdp_media_size'] == 'custom') {
                    $url = wp_get_attachment_url($post_thumbnail_id);
                    $width = isset($bdp_settings['media_custom_width']) ? $bdp_settings['media_custom_width'] : 560;
                    $height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : 350;
                    $resizedImage = bdp_resize($url, $width, $height, true, $post_thumbnail_id);
                    $thumbnail = '<img src="' . $resizedImage["url"] . '" width="' . $resizedImage["width"] . '" height="' . $resizedImage["height"] . '" title="' . get_the_title($bdp_post_id) . '" alt="' . get_the_title($bdp_post_id) . '" />';
                } else {
                    $post_thumbnail = $bdp_settings['bdp_media_size'];
                    $thumbnail = get_the_post_thumbnail($bdp_post_id, $post_thumbnail);
                }
            } else {
                $thumbnail = get_the_post_thumbnail($bdp_post_id, $post_thumbnail);
            }
        } elseif (isset($bdp_settings['bdp_default_image_id']) && $bdp_settings['bdp_default_image_id'] != '') {
            if (isset($bdp_settings['bdp_media_size'])) {
                if ($bdp_settings['bdp_media_size'] == 'custom') {
                    $post_thumbnail_id = $bdp_settings['bdp_default_image_id'];
                    $url = wp_get_attachment_url($post_thumbnail_id);
                    $width = isset($bdp_settings['media_custom_width']) ? $bdp_settings['media_custom_width'] : 560;
                    $height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : 350;
                    $resizedImage = bdp_resize($url, $width, $height, true, $post_thumbnail_id);
                    $thumbnail = '<img src="' . $resizedImage["url"] . '" width="' . $resizedImage["width"] . '" height="' . $resizedImage["height"] . '" title="' . get_the_title($bdp_post_id) . '" alt="' . get_the_title($bdp_post_id) . '" />';
                } else {
                    $post_thumbnail = $bdp_settings['bdp_media_size'];
                    $thumbnail = wp_get_attachment_image($bdp_settings['bdp_default_image_id'], $post_thumbnail);
                }
            } else {
                $thumbnail = wp_get_attachment_image($bdp_settings['bdp_default_image_id'], $post_thumbnail);
            }
        } else {
            if (in_array($bdp_settings['template_name'], array('boxy-clean', 'brit_co', 'deport', 'elina', 'invert-grid', 'media-grid', 'masonry_timeline', 'my_diary', 'navia', 'brite', 'chapter', 'fairy', 'integer', 'advice', 'minimal', 'clicky', 'roctangle', 'glamour')))
                $thumbnail = bdp_get_sample_image($bdp_settings['template_name'], $bdp_post_id);
        }
        return $thumbnail;
    }

}

/**
 * Get the single post thumbnail
 */
if (!function_exists('bdp_get_the_single_post_thumbnail')) {

    function bdp_get_the_single_post_thumbnail($bdp_settings, $post_thumbnail_id, $bdp_post_id) {
        $thumbnail = '';
        $post_thumbnail = 'full';
        if (has_post_thumbnail()) {
            if (isset($bdp_settings['bdp_media_size'])) {
                if ($bdp_settings['bdp_media_size'] == 'custom') {
                    $url = wp_get_attachment_url($post_thumbnail_id);
                    $width = isset($bdp_settings['media_custom_width']) ? $bdp_settings['media_custom_width'] : 560;
                    $height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : 350;
                    $resizedImage = bdp_resize($url, $width, $height, true, $post_thumbnail_id);
                    $thumbnail = '<img src="' . $resizedImage["url"] . '" width="' . $resizedImage["width"] . '" height="' . $resizedImage["height"] . '" title="' . get_the_title($bdp_post_id) . '" alt="' . get_the_title($bdp_post_id) . '" />';
                } else {
                    $post_thumbnail = $bdp_settings['bdp_media_size'];
                    $thumbnail = get_the_post_thumbnail($bdp_post_id, $post_thumbnail);
                }
            } else {
                $thumbnail = get_the_post_thumbnail($bdp_post_id, $post_thumbnail);
            }
        }
        return $thumbnail;
    }

}

/**
 * get default image for related posts
 * @param int $bdp_post_id
 * @return html image
 */
if (!function_exists('bdp_get_related_post_sample_image')) {

    function bdp_get_related_post_sample_image($bdp_post_id) {
        $sample_img = '<img alt="' . esc_attr__('No image available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" title="' . esc_attr__('No image available', BLOGDESIGNERPRO_TEXTDOMAIN) . '" src="' . BLOGDESIGNERPRO_URL . '/images/related_post_no_available_image.png" />';
        return $sample_img;
    }

}

/**
 * insert layout
 * @param string $layout_name
 * @param array $bdp_settings
 * @global object $wpdb
 * @return int layout id
 */
if (!function_exists('bdp_insert_layout')) {

    function bdp_insert_layout($layout_name, $bdp_settings) {
        global $wpdb;
        $bdp_table_name = $wpdb->prefix . 'blog_designer_pro_shortcodes';
        $insert = $wpdb->insert(
                $bdp_table_name, array('shortcode_name' => $layout_name, 'bdsettings' => serialize($bdp_settings)), array('%s', '%s')
        );
        if ($insert === FALSE) {
            return;
        } else {
            return $wpdb->insert_id;
        }
    }

}

/**
 * get parameter array for posts query
 * @param array $bdp_settings
 * @return array parameters for posts query
 */
if (!function_exists('bdp_get_wp_query')) {

    function bdp_get_wp_query($bdp_settings) {
        global $wp_bdp_setting;
        $wp_bdp_setting = $bdp_settings;
        $taxonomy = $terms = $tags = $cats = $author = "";
        $orderby = 'date';
        $order = 'DESC';
        $post_type = 'post';
        if (isset($bdp_settings['custom_post_type']))
            $post_type = $bdp_settings['custom_post_type'];

        if (isset($bdp_settings['template_category']))
            $cat = $bdp_settings['template_category'];

        if (isset($bdp_settings['template_tags']))
            $tag = $bdp_settings['template_tags'];

        if (isset($bdp_settings['template_authors']))
            $author = $bdp_settings['template_authors'];

        if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
            $orderby = $bdp_settings['bdp_blog_order_by'];

        if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
            $order = $bdp_settings['bdp_blog_order'];

        $taxo = get_object_taxonomies($post_type);

        if (empty($cat)) {
            $cat = '';
        }

        if (empty($tag)) {
            $tag = '';
        }
        if (isset($bdp_settings['exclude_category_list'])) {
            $exlude_category = 'NOT IN';
        } else {
            $exlude_category = 'IN';
        }

        if (isset($bdp_settings['exclude_tag_list'])) {
            $exlude_tag = 'NOT IN';
        } else {
            $exlude_tag = 'IN';
        }

        if (isset($bdp_settings['exclude_author_list'])) {
            $exlude_author = 'author__not_in';
        } else {
            $exlude_author = 'author__in';
        }

        $advance_filter = (isset($bdp_settings['advance_filter'])) ? $bdp_settings['advance_filter'] : 0;
        $relation = 'OR';
        if ($advance_filter == 1) {
            if (isset($bdp_settings['tax_filter_with']) && $bdp_settings['tax_filter_with'] == 1) {
                $relation = 'AND';
            }
            if (isset($bdp_settings['author_filter_with']) && $bdp_settings['author_filter_with'] != 1) {
                add_filter('posts_where', 'author_filter_func');
            }
        }

        $tax_query = array();
        if ($cat != '' && $tag != '') {
            $tax_query = array(
                'relation' => $relation,
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $cat,
                    'operator' => $exlude_category
                ),
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'term_id',
                    'terms' => $tag,
                    'operator' => $exlude_tag
                ),
            );
        } elseif ($cat != '') {
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'category',
                    'field' => 'term_id',
                    'terms' => $cat,
                    'operator' => $exlude_category
                ),
            );
        } elseif ($tag != '') {
            $tax_query = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'term_id',
                    'terms' => $tag,
                    'operator' => $exlude_tag
                ),
            );
        }

        if ($bdp_settings['template_name'] == 'cool_horizontal' || $bdp_settings['template_name'] == 'overlay_horizontal') {
            $posts_per_page = -1;
        } else {
            $posts_per_page = $bdp_settings['posts_per_page'];
        }
        if (isset($bdp_settings['paged'])) {
            $paged = $bdp_settings['paged'];
        } else {
            $paged = bdp_paged();
        }

        $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';

        if ($post_type == 'post') {

            if ($orderby == 'meta_value_num') {
                $orderby_str = $orderby . ' date';
            } else {
                $orderby_str = $orderby;
            }
            $posts = array(
                $exlude_author => $author,
                'post_status' => $post_status,
                'post_type' => $post_type,
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'orderby' => $orderby_str,
                'order' => $order,
                'tax_query' => $tax_query
            );

            if ($orderby == 'meta_value_num') {
                $posts['meta_query'] = array(
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
            if (isset($bdp_settings['paged'])) {
                $posts['post_status'] = $post_status;
            }
            if (($orderby == 'date' || $orderby == 'modified') && isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'timeline' || $bdp_settings['template_name'] == 'story')) {
                $posts['ignore_sticky_posts'] = 1;
            }
            if (isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'explore' || $bdp_settings['template_name'] == 'hoverbic')) {
                $posts['ignore_sticky_posts'] = 1;
            }

            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $posts['ignore_sticky_posts'] = 0;
            } else {
                $posts['ignore_sticky_posts'] = 1;
            }

            /**
             * Time Period Coding
             */
            if (isset($bdp_settings['blog_time_period'])) {
                $blog_time_period = $bdp_settings['blog_time_period'];
                if ($blog_time_period == 'today') {
                    $today = getdate();
                    $posts['date_query'] = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                            'day' => $today['mday'],
                        ),
                    );
                }
                if ($blog_time_period == 'tomorrow') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * DAY_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                            'day' => $twodayslater['mday'],
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'this_week') {
                    $week = date('W');
                    $year = date('Y');
                    $posts['date_query'] = array(
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

                    $posts['date_query'] = array(
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
                    $posts['date_query'] = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'this_month') {
                    $today = getdate();
                    $posts['date_query'] = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'last_month') {
                    $twodayslater = getdate(current_time('timestamp') - 1 * MONTH_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'next_month') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * MONTH_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'last_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $last_n_days = $bdp_settings['bdp_time_period_day'] . ' days ago';
                        $posts['date_query'] = array(
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
                        $posts['date_query'] = array(
                            array(
                                'before' => date('Y-m-d', strtotime($next_n_days)),
                                'inclusive' => true,
                            )
                        );
                        $posts['post_status'] = array('future');
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
                    $posts['date_query'] = array(
                        array(
                            'after' => $after,
                            'before' => $before,
                            'inclusive' => true,
                        ),
                    );
                }
            }
        } else {
            $tax_query = array('relation' => 'OR');
            if (isset($bdp_settings['relation']) && !empty($bdp_settings['relation'])) {
                $tax_query = $bdp_settings['relation'];
            }

            foreach ($taxo as $taxonom) {
                if (isset($bdp_settings[$taxonom . "_terms"])) {
                    if (!empty($bdp_settings[$taxonom . "_terms"])) {
                        $terms[$taxonom] = $bdp_settings[$taxonom . "_terms"];
                    }
                    if (isset($bdp_settings["exclude_" . $taxonom . "_list"])) {
                        $operator_value = 'NOT IN';
                    } else {
                        $operator_value = 'IN';
                    }
                    $tax_query[] = array(
                        'taxonomy' => $taxonom,
                        'field' => 'name',
                        'terms' => $terms[$taxonom],
                        'operator' => $operator_value
                    );
                }
            }

            if ($orderby == 'meta_value_num') {
                $orderby_str = $orderby . ' date';
            } else {
                $orderby_str = $orderby;
            }
            $posts = array(
                'post_status' => $post_status,
                'post_type' => $post_type,
                'tax_query' => $tax_query,
                'posts_per_page' => $posts_per_page,
                'paged' => $paged,
                'orderby' => $orderby_str,
                'order' => $order,
                $exlude_author => $author,
            );

            if ($orderby == 'meta_value_num') {
                $posts['meta_query'] = array(
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
            if (($orderby == 'date' || $orderby == 'modified') && isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'timeline' || $bdp_settings['template_name'] == 'story')) {
                $posts['ignore_sticky_posts'] = 1;
            }
            if (isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'explore' || $bdp_settings['template_name'] == 'hoverbic')) {
                $posts['ignore_sticky_posts'] = 1;
            }


            if (isset($bdp_settings['display_sticky']) && $bdp_settings['display_sticky'] == 1) {
                $posts['ignore_sticky_posts'] = 0;
            } else {
                $posts['ignore_sticky_posts'] = 1;
            }
            /**
             * Time Period Coding
             */
            if (isset($bdp_settings['blog_time_period'])) {
                $blog_time_period = $bdp_settings['blog_time_period'];
                if ($blog_time_period == 'today') {
                    $today = getdate();
                    $posts['date_query'] = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                            'day' => $today['mday'],
                        ),
                    );
                }
                if ($blog_time_period == 'tomorrow') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * DAY_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                            'day' => $twodayslater['mday'],
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'this_week') {
                    $week = date('W');
                    $year = date('Y');
                    $posts['date_query'] = array(
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

                    $posts['date_query'] = array(
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
                    $posts['date_query'] = array(
                        array(
                            'year' => $year,
                            'week' => $lastweek,
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'this_month') {
                    $today = getdate();
                    $posts['date_query'] = array(
                        array(
                            'year' => $today['year'],
                            'month' => $today['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'last_month') {
                    $twodayslater = getdate(current_time('timestamp') - 1 * MONTH_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                }
                if ($blog_time_period == 'next_month') {
                    $twodayslater = getdate(current_time('timestamp') + 1 * MONTH_IN_SECONDS);
                    $posts['date_query'] = array(
                        array(
                            'year' => $twodayslater['year'],
                            'month' => $twodayslater['mon'],
                        ),
                    );
                    $posts['post_status'] = array('future');
                }
                if ($blog_time_period == 'last_n_days') {
                    if (isset($bdp_settings['bdp_time_period_day']) && $bdp_settings['bdp_time_period_day']) {
                        $last_n_days = $bdp_settings['bdp_time_period_day'] . ' days ago';
                        $posts['date_query'] = array(
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
                        $posts['date_query'] = array(
                            array(
                                'before' => date('Y-m-d', strtotime($next_n_days)),
                                'inclusive' => true,
                            )
                        );
                        $posts['post_status'] = array('future');
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
                    $posts['date_query'] = array(
                        array(
                            'after' => $after,
                            'before' => $before,
                            'inclusive' => true,
                        ),
                    );
                }
            }
        }
        return $posts;
    }

}

/**
 * get html of layout from layout id
 * @param it $layout_id
 * @param array $bdp_settings
 * @return html Blog Layout design
 */
if (!function_exists('bdp_layout_view_portion')) {

    function bdp_layout_view_portion($layout_id, $bdp_settings) {
        wp_reset_query();
        $posts = bdp_get_wp_query($bdp_settings);
        global $wp_query;
        $temp_query = $wp_query;
        //$wp_query = NULL;
        $loop = new WP_Query($posts);
        $wp_query = $loop;
        $max_num_pages = $wp_query->max_num_pages;
        $sticky_posts = get_option('sticky_posts');
        $alter = 1;
        $class = '';
        $alter_class = '';
        $prev_year = null;

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
        $posts_per_page = $bdp_settings['posts_per_page'];
        $unique_design_option = isset($bdp_settings['unique_design_option']) ? $bdp_settings['unique_design_option'] : '';
        if (isset($bdp_settings['blog_unique_design']) && $bdp_settings['blog_unique_design'] != "") {
            $blog_unique_design = $bdp_settings['blog_unique_design'];
        } else {
            $blog_unique_design = 0;
        }
        if (isset($bdp_settings['bdp_blog_order_by'])) {
            $orderby = $bdp_settings['bdp_blog_order_by'];
        }
        $main_container_class = (isset($bdp_settings['main_container_class']) && $bdp_settings['main_container_class'] != '') ? $bdp_settings['main_container_class'] : '';
        $template = '';
        if ($max_num_pages > 1 && $bdp_settings['pagination_type'] == 'load_more_btn') {
            $template .= "<div class='bdp-load-more-pre'>";
        }
        if ($max_num_pages > 1 && $bdp_settings['pagination_type'] == 'load_onscroll_btn') {
            $template .= "<div class='bdp-load-onscroll-pre' id='bdp-load-onscroll-pre'>";
        }
        if ($bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary" || $bdp_theme == "invert-grid") {
            $template .= "<div class='bdp-row $bdp_theme'>";
        }
        if ($bdp_theme == "media-grid" || $bdp_theme == "chapter" || $bdp_theme == 'roctangle' || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "minimal") {
            $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? 'column_layout_' . $bdp_settings['column_setting'] : 'column_layout_2';
            $column_setting_ipad = (isset($bdp_settings['column_setting_ipad']) && $bdp_settings['column_setting_ipad'] != '') ? 'column_layout_ipad_' . $bdp_settings['column_setting_ipad'] : 'column_layout_ipad_2';
            $column_setting_tablet = (isset($bdp_settings['column_setting_tablet']) && $bdp_settings['column_setting_tablet'] != '') ? 'column_layout_tablet_' . $bdp_settings['column_setting_tablet'] : 'column_layout_tablet_1';
            $column_setting_mobile = (isset($bdp_settings['column_setting_mobile']) && $bdp_settings['column_setting_mobile'] != '') ? 'column_layout_mobile_' . $bdp_settings['column_setting_mobile'] : 'column_layout_mobile_1';
            $column_class = $column_setting . ' ' . $column_setting_ipad . ' ' . $column_setting_tablet . ' ' . $column_setting_mobile;
            if($bdp_theme == 'roctangle') {
                $template .= "<div class='bdp-row masonry $column_class $bdp_theme'>";
            } else {
                $template .= "<div class='bdp-row $column_class $bdp_theme'>";
            }
        }
        if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
            $template .= '<div class="bdp-js-masonry masonry bdp_' . $bdp_theme . '">';
        }
        if ($bdp_theme == 'boxy-clean') {
            $template .= '<div class="blog_template boxy-clean"><ul>';
        }
        $slider_navigation = isset($bdp_settings['navigation_style_hidden']) ? $bdp_settings['navigation_style_hidden'] : 'navigation3';
        if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
            $unique_id = mt_rand();
            $template .= '<div class="blog_template slider_template ' . $bdp_theme .' '. $slider_navigation . ' slider_' . $unique_id .'"><ul class="slides">';
        }
        if ($bdp_theme == 'story') {
            $template .= '<div class="bdp_template story">';
        }
        if ($bdp_theme == 'brit_co') {
            $template .= '<div class="brit_co bdp_brit_co">';
        }
        if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
            $template .= '<div class="logbook flatLine flatNav flatButton">';
        }
        if ($bdp_theme == 'my_diary') {
            $template .= '<div class="my_diary_wrapper">';
        }
        if ($bdp_theme == 'elina') {
            $template .= '<div class="elina_wrapper">';
        }
        if ($bdp_theme == 'masonry_timeline') {
            $template .= '<div class="masonry_timeline_wrapper">';
        }
        if ($bdp_theme == 'brite') {
            $template .= '<div class="brite-wrapp">';
        }
        $prev_year = null;
        $prev_year1 = null;
        $prev_month = null;
        $count_sticky = 0;
        $alter_val = 1;
        if ($loop->have_posts()) {
            if ($bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                $template .= '<div class="blog_template bdp-grid-row">';
            }

            if ($bdp_theme == 'media-grid') {
                $prev_year = 0;
            }

            if ($bdp_theme == 'timeline') {
                if (isset($bdp_settings['bdp_timeline_layout']) && $bdp_settings['bdp_timeline_layout'] == 'left_side') {
                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] != '') {
                        $template .= '<div class="timeline_bg_wrap left_side with_year"><div class="timeline_back clearfix">';
                    } else {
                        $template .= '<div class="timeline_bg_wrap left_side"><div class="timeline_back clearfix">';
                    }
                } elseif (isset($bdp_settings['bdp_timeline_layout']) && $bdp_settings['bdp_timeline_layout'] == 'right_side') {
                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] != '') {
                        $template .= '<div class="timeline_bg_wrap right_side with_year"><div class="timeline_back clearfix">';
                    } else {
                        $template .= '<div class="timeline_bg_wrap right_side"><div class="timeline_back clearfix">';
                    }
                } elseif (isset($bdp_settings['bdp_timeline_layout']) && $bdp_settings['bdp_timeline_layout'] == 'center') {
                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] != '') {
                        $template .= '<div class="timeline_bg_wrap center with_year"><div class="timeline_back clearfix">';
                    } else {
                        $template .= '<div class="timeline_bg_wrap center"><div class="timeline_back clearfix">';
                    }
                } else {
                    if ($orderby == 'date' || $orderby == 'modified') {
                        $template .= '<div class="timeline_bg_wrap date_order"><div class="timeline_back clearfix">';
                    } else {
                        $template .= '<div class="timeline_bg_wrap"><div class="timeline_back clearfix">';
                    }
                }
            }
            if ($bdp_theme == 'easy_timeline') {
                $template .= '<div class="blog_template bdp_blog_template easy-timeline-wrapper"><ul class="easy-timeline" data-effect="' . $bdp_settings['easy_timeline_effect'] . '">';
            }
            if ($bdp_theme == 'steps') {
                $template .= '<div class="blog_template bdp_blog_template steps-wrapper"><ul class="steps" data-effect="' . $bdp_settings['easy_timeline_effect'] . '">';
            }
            $ajax_preious_year = '';
            $ajax_preious_month = '';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            while (have_posts()) : the_post();
                if ($bdp_theme) {
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
                                    $template .= '<p class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></span></p>';
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
                                    $template .= '<p class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></p>';
                                }
                            }
                            $ajax_preious_year = get_the_date('Y');
                            $ajax_preious_month = get_the_time('M');
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

                    if ($bdp_theme == 'media-grid' || $bdp_theme == 'invert-grid') {
                        $alter_val = $alter; // are we on page one?
                    }
                    if ($blog_unique_design == 1) {
                        if ($bdp_theme == 'invert-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'clicky') {
                            $alter_val = $alter; // are we on page one?
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
                        if ($bdp_theme == 'media-grid') {
                            $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                            $alter_val = $alter; // are we on page one?
                            if ($unique_design_option == 'first_post') {
                                if ($column_setting >= 2 && $alter <= 2) {
                                    $prev_year = 0;
                                } elseif (1 == $paged) {
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

                    if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                        $alter_class = $alter;
                    }

                    $template .= bdp_get_blog_template('blog/' . $bdp_theme . '.php', $bdp_settings, $alter_class, $prev_year, $paged, $count_sticky, $alter_val);
                    $alter ++;
                }
            endwhile;
            if ($bdp_theme == 'timeline') {
                $template .= '</div></div>';
            }
            if ($bdp_theme == 'easy_timeline' || $bdp_theme == 'steps') {
                $template .= '</ul></div>';
            }
            if ($bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                $template .= '</div>';
            }
        } else {
            $template .= __('No posts found.', BLOGDESIGNERPRO_TEXTDOMAIN);
        }

        if ($alter % 2 != 1 && ( $bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' )) {
            do_action('bdp_separator_after_post');
            $template .= "</div>";
        } else if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid') {
            $template .= "</div>";
        }

        if ($bdp_theme == "chapter" || $bdp_theme == 'roctangle' || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "integer" || $bdp_theme == "advice" || $bdp_theme == "minimal") {
            $template .= "</div>";
        }

        if ($bdp_theme == 'boxy-clean' || $bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
            $template .= "</ul></div>";
        }

        if (( $bdp_theme == 'glossary' || $bdp_theme == 'boxy' || $bdp_theme == 'story')) {
            $template .= '</div>';
        }
        if ($bdp_theme == 'brit_co') {
            $template .= '</div>';
        }
        if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
            $template .= '</div>';
        }
        if ($bdp_theme == 'my_diary') {
            $template .= '</div>';
        }
        if ($bdp_theme == 'elina') {
            $template .= '</div>';
        }
        if ($bdp_theme == 'masonry_timeline') {
            $template .= '</div>';
        }
        if ($bdp_theme == 'brite') {
            $template .= '</div>';
        }

        if ($bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary") {
            $template .= "</div>";
        }
        $slider_array = array('cool_horizontal', 'overlay_horizontal','crayon_slider', 'sunshiny_slider', 'sallet_slider');
        if (!in_array($bdp_theme, $slider_array) && $bdp_settings['pagination_type'] != 'no_pagination') {
            if ($max_num_pages > 1 && $bdp_settings['pagination_type'] == 'load_more_btn') {
                $template .= '</div>';
                $is_loadmore_btn = '';
                if ($max_num_pages > 1) {
                    $is_loadmore_btn = '';
                } else {
                    $is_loadmore_btn = '1';
                }
                if (is_front_page()) {
                    $bdppaged = (get_query_var('page')) ? get_query_var('page') : 1;
                } else {
                    $bdppaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                }
                $template .= '<form name="bdp-load-more-hidden" id="bdp-load-more-hidden">';
                $template .= '<input type="hidden" name="paged" id="paged" value="' . $bdppaged . '" />';
                $template .= '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . $posts_per_page . '" />';
                $template .= '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . $max_num_pages . '" />';
                $template .= '<input type="hidden" name="blog_template" id="blog_template" value="' . $bdp_theme . '" />';
                $template .= '<input type="hidden" name="blog_layout" id="blog_layout" value="blog_layout" />';
                $template .= '<input type="hidden" name="blog_shortcode_id" id="blog_shortcode_id" value="' . $layout_id . '" />';
                if ($bdp_theme == 'timeline') {
                    $template .= '<input type="hidden" name="timeline_previous_year" id="timeline_previous_year" value="' . $ajax_preious_year . '" />';
                    $template .= '<input type="hidden" name="timeline_previous_month" id="timeline_previous_month" value="' . $ajax_preious_month . '" />';
                }
                $template .= bdp_get_loader($bdp_settings);
                $template .= '</form>';
                if ($is_loadmore_btn == '') {
                    $class = isset($bdp_settings['load_more_button_template']) ? $bdp_settings['load_more_button_template'] : 'template-1';
                    $template .= '<div class="bdp-load-more text-center" style="float:left;width:100%">';
                    $template .= '<a href="javascript:void(0);" class="button bdp-load-more-btn ' . $class . '">';
                    if($class == 'template-3') {
                        $template .= '<span class="bdp-lmb-top"></span>';
                    }
                    $template .= (isset($bdp_settings['loadmore_button_text']) && $bdp_settings['loadmore_button_text'] != '') ? $bdp_settings['loadmore_button_text'] : __('Load More', BLOGDESIGNERPRO_TEXTDOMAIN);
                    if($class == 'template-3') {
                        $template .= '<span class="bdp-lmb-bottom"></span>';
                    }
                    $template .= '</a>';
                    $template .= '</div>';
                }
            } elseif ($max_num_pages > 1 && $bdp_settings['pagination_type'] == 'load_onscroll_btn') {
                $template .= '</div>';
                $is_load_onscroll_btn = '';
                if ($max_num_pages > 1) {
                    $is_load_onscroll_btn = '';
                } else {
                    $is_load_onscroll_btn = '1';
                }
                if (is_front_page()) {
                    $bdppaged = (get_query_var('page')) ? get_query_var('page') : 1;
                } else {
                    $bdppaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                }
                $template .= '<form name="bdp-load-more-hidden" id="bdp-load-more-hidden">';

                $template .= '<input type="hidden" name="paged" id="paged" value="' . $bdppaged . '" />';
                if ($bdp_theme == 'story') {
                    $template .= '<input type="hidden" name="this_year" id="this_year" value="' . $this_year . '" />';
                }
                $template .= '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . $posts_per_page . '" />';
                $template .= '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . $max_num_pages . '" />';
                $template .= '<input type="hidden" name="blog_template" id="blog_template" value="' . $bdp_theme . '" />';
                $template .= '<input type="hidden" name="blog_layout" id="blog_layout" value="blog_layout" />';
                $template .= '<input type="hidden" name="blog_shortcode_id" id="blog_shortcode_id" value="' . $layout_id . '" />';
                if ($bdp_theme == 'timeline') {
                    $template .= '<input type="hidden" name="timeline_previous_year" id="timeline_previous_year" value="' . $ajax_preious_year . '" />';
                    $template .= '<input type="hidden" name="timeline_previous_month" id="timeline_previous_month" value="' . $ajax_preious_month . '" />';
                }
                $template .= bdp_get_loader($bdp_settings);;
                $template .= '</form>';
                if ($is_load_onscroll_btn == '') {
                    $class = '';
                    $template .= '<div class="bdp-load-onscroll text-center">';
                    $template .= '<a href="javascript:void(0);" class="button bdp-load-onscroll-btn ' . $class . '">';
                    $template .= __('Loading Posts', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
                    $template .= '</div>';
                }
            }
            if ($bdp_settings['pagination_type'] == 'paged') {
                $pagination_template = isset($bdp_settings['pagination_template']) ? $bdp_settings['pagination_template'] : 'template-1';
                $template .= '<div class="wl_pagination_box ' . $pagination_template . '">';
                $template .= bdp_standard_paging_nav();
                $template .= '</div>';
            }
        }

        if (((isset($bdp_settings['filter_category']) && $bdp_settings['filter_category'] == 1)) || (isset($bdp_settings['filter_date']) && $bdp_settings['filter_date'] == 1) || (isset($bdp_settings['filter_tags']) && $bdp_settings['filter_tags'] == 1)) {
            if (!wp_style_is('choosen-handle-css')) {
                wp_enqueue_style('choosen-handle-css');
            }
            if (!wp_script_is('choosen-handle-script')) {
                wp_enqueue_script('choosen-handle-script');
            }
            ?>
            <form name="bdp-filer-change" id="bdp-filer-change">
                <?php
                if ($bdp_settings['custom_post_type'] == 'post') {
                    if (isset($bdp_settings['filter_category']) && $bdp_settings['filter_category'] == 1) {
                        $categories = get_categories();
                        if (isset($bdp_settings['template_category'])) {
                            if (isset($bdp_settings['exclude_category_list'])) {
                                ?>
                                <select name="filter_cat[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> category" multiple="multiple">
                                    <?php
                                    foreach ($categories as $category) {
                                        if (in_array($category->term_id, $bdp_settings['template_category']) == false) {
                                            ?>
                                            <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                ?>
                                <select name="filter_cat[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> category" multiple="multiple">
                                    <?php
                                    foreach ($categories as $category) {
                                        if (in_array($category->term_id, $bdp_settings['template_category'])) {
                                            ?>
                                            <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                        } else {
                            ?>
                            <select name="filter_cat[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> category" multiple="multiple">
                                <?php
                                foreach ($categories as $category) {
                                    ?>
                                    <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        }
                    }
                    if (isset($bdp_settings['filter_tags']) && $bdp_settings['filter_tags'] == 1) {
                        $tags = get_terms('post_tag');
                        if (isset($bdp_settings['template_tag'])) {
                            if (isset($bdp_settings['exclude_tag_list'])) {
                                ?>
                                <select name="filter_tag[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> tag" multiple="multiple">
                                    <?php
                                    foreach ($tags as $tag) {
                                        if (in_array($tag->term_id, $bdp_settings['template_tag']) == false) {
                                            ?>
                                            <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            } else {
                                ?>
                                <select name="filter_tag[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> tag" multiple="multiple">
                                    <?php
                                    foreach ($tags as $tag) {
                                        if (in_array($tag->term_id, $bdp_settings['template_tag'])) {
                                            ?>
                                            <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                        } else {
                            ?>
                            <select name="filter_tag[]" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> tag" multiple="multiple">
                                <?php
                                foreach ($tags as $tag) {
                                    ?>
                                    <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                        }
                    }
                } else {
                    $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type']);

                    foreach ($taxonomy_names as $taxonomy) {
                        if (isset($taxonomy)) {
                            if (isset($bdp_settings['filter_' . $taxonomy]) && $bdp_settings['filter_' . $taxonomy] == 1) {
                                $terms_list = get_terms($taxonomy);
                                $select_name = 'filter_' . $taxonomy;
                                ?>
                                <select name="<?php echo $select_name; ?>[]" id="<?php echo $select_name; ?>" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <?php echo $taxonomy; ?>" multiple="multiple">
                                    <?php
                                    foreach ($terms_list as $term_list) {
                                        ?>
                                        <option value="<?php echo $term_list->name; ?>"><?php echo $term_list->name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php
                            }
                        }
                    }
                }
                if (isset($bdp_settings['filter_date']) && $bdp_settings['filter_date'] == 1) {

                    while (have_posts()) : the_post();
                        $dates[get_the_time('Y-m')] = get_the_time('F Y');
                    endwhile;
                    ?>
                    <select name="filer_date[]" id="filer_date" class="chosen-select filter_data" data-placeholder="<?php esc_attr_e('Choose', BLOGDESIGNERPRO_TEXTDOMAIN); ?> date" multiple="multiple">
                        <?php
                        krsort($dates);
                        foreach ($dates as $key => $value) {
                            ?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php
                        }
                        ?>
                    </select>
                    <?php
                }
                ?>
                <input type="hidden" name="blog_template" id="blog_template" value="<?php echo $bdp_theme ?>" />
                <input type="hidden" name="blog_shortcode_id" id="blog_shortcode_id" value="<?php echo $layout_id ?>" />
                <input type="hidden" name="blog_itemMargin" id="blog_itemMargin" value="<?php echo $bdp_settings["template_post_margin"]; ?>" />
                <input type="hidden" name="blog_itemWidth" id="blog_itemWidth" value="<?php echo $bdp_settings["item_width"] ?>" />
                <input type="hidden" name="blog_itemHeight" id="blog_itemHeight" value="<?php echo $bdp_settings["item_height"] ?>" />
                <input type="hidden" name="blog_easing" id="blog_easing" value="<?php echo $bdp_settings["template_easing"] ?>" />
                <input type="hidden" name="blog_startFrom" id="blog_startFrom" value="<?php echo $bdp_settings["timeline_start_from"] ?>" />
                <input type="hidden" name="blog_hideLogbook" id="blog_hideLogbook" value="<?php echo $bdp_settings['display_timeline_bar'] ?>" />
                <input type="hidden" name="blog_autoplay" id="blog_autoplay" value="<?php echo $bdp_settings["enable_autoslide"] ?>" />
                <input type="hidden" name="blog_scrollSpeed" id="blog_scrollSpeed" value="<?php echo $bdp_settings["scroll_speed"] ?>" />
                <input type="hidden" name="blog_page_number" id="blog_page_number" value="<?php echo $paged; ?>" />
            </form>
            <?php
        }
        wp_reset_query();
        $wp_query = NULL;
        $wp_query = $temp_query;

        $template_wrapper = '<div class="bdp_wrapper layout_id_'. $layout_id .'">';
        if (( ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal' || $bdp_theme != 'crayon_slider') && ($bdp_settings['pagination_type'] == 'no_pagination') ) && isset($bdp_settings['display_customread_more']) && $bdp_settings['display_customread_more'] == 0) {
            if (isset($bdp_settings['beforeloop_Readmoretext']) && $bdp_settings['beforeloop_Readmoretext'] != '') {
                $custom_read_more_href = isset($bdp_settings['beforeloop_Readmoretextlink']) && $bdp_settings['beforeloop_Readmoretextlink'] != '' ? $bdp_settings['beforeloop_Readmoretextlink'] : '#';
                $open_customlink = isset($bdp_settings['open_customlink']) ? $bdp_settings['open_customlink'] : '';
                $custom_link_target = '';
                if ($open_customlink == 0) {
                    $custom_link_target = "target = '_blank'";
                }
                $template_wrapper .= '<div class="custom_read_more before_loop"><a href="' . esc_url($custom_read_more_href) . '" ' . $custom_link_target . ' >' . $bdp_settings['beforeloop_Readmoretext'] . '</a></div>';
            }
        }
        if ($main_container_class != '') {
            $template_wrapper .= '<div class="' . $main_container_class . '">';
        }
        $template_wrapper .= $template;
        if ($main_container_class != '') {
            $template_wrapper .= '</div>';
        }
        if (( ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal' || $bdp_theme != 'crayon_slider') && ($bdp_settings['pagination_type'] == 'no_pagination') ) && isset($bdp_settings['display_customread_more']) && $bdp_settings['display_customread_more'] == 1) {
            if (isset($bdp_settings['beforeloop_Readmoretext']) && $bdp_settings['beforeloop_Readmoretext'] != '') {
                $custom_read_more_href = isset($bdp_settings['beforeloop_Readmoretextlink']) && $bdp_settings['beforeloop_Readmoretextlink'] != '' ? $bdp_settings['beforeloop_Readmoretextlink'] : '#';
                $open_customlink = isset($bdp_settings['open_customlink']) ? $bdp_settings['open_customlink'] : '';
                $custom_link_target = '';
                if ($open_customlink == 0) {
                    $custom_link_target = "target = '_blank'";
                }
                $template_wrapper .= '<div class="custom_read_more after_loop"><a href="' . esc_url($custom_read_more_href) . '" ' . $custom_link_target . '>' . $bdp_settings['beforeloop_Readmoretext'] . '</a></div>';
            }
        }
        $template_wrapper .= '</div>';

        return $template_wrapper;
    }

}

/**
 * get comments count
 * @return html comments
 */
if (!function_exists('bdp_comment_count')) {

    function bdp_comment_count($comment_link = true) {
        $id = get_the_ID();
        $num_comments = get_comments_number($id);
        $write_comments = '';
        if (comments_open()) {
            if ($num_comments == 0) {
                $comments = __('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN);
            } elseif ($num_comments > 1) {
                $comments = $num_comments . ' ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN);
            } else {
                $comments = '1 '.__('Comment', BLOGDESIGNERPRO_TEXTDOMAIN);
            }
            if ($comment_link) {
                $write_comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
            } else {
                $write_comments = $comments;
            }
        } else {
            $write_comments = __('Comments are closed', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        echo $write_comments;
    }

}

/**
 * Related Post Display title
 * @param string $template
 * @param int $post_perpage
 * @param string $related_post_by
 * @param string $title
 */
if (!function_exists('bdp_related_post_title')) {

    function bdp_related_post_title($template, $post_perpage, $related_post_by, $title) {
        ?>
        <h3><?php
            if ($title != "") {
                echo $title;
            } else {
                _e('Related Posts', BLOGDESIGNERPRO_TEXTDOMAIN);
            }
            ?></h3>
        <?php
    }

}

/**
 * function for display related post items
 * @param string $template
 * @param int $post_perpage
 * @param string $related_post_by
 * @param string $title
 * @param int $related_post_content_length
 */
if (!function_exists('bdp_related_post_item')) {

    function bdp_related_post_item($template, $post_perpage, $related_post_by, $title, $orderby, $order, $related_post_content_length, $related_post_content_from = "from_content", $bdp_settings = array()) {
        if ($post_perpage == 2) {
            $col_class = "two_post";
        } elseif ($post_perpage == 3) {
            $col_class = "three_post";
        } elseif ($post_perpage == 4) {
            $col_class = "four_post";
        } else {
            $col_class = "";
        }
        ?>
        <div class="related_post_div <?php echo $col_class; ?>">
            <div class="relatedposts">
                <?php
                $args = array();
                if ($related_post_by == "category") {
                    global $post;
                    $categories = get_the_category($post->ID);
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $individual_category)
                            $category_ids[] = $individual_category->term_id;
                        $args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => $post_perpage, // Number of related posts that will be displayed.                            'caller_get_posts' => 1,
                            'orderby' => $orderby,
                            'order' => $order
                        );
                    }
                } elseif ($related_post_by == "tag") {
                    global $post;
                    $tags = wp_get_post_tags($post->ID);
                    if ($tags) {
                        $tag_ids = array();
                        foreach ($tags as $individual_tag)
                            $tag_ids[] = $individual_tag->term_id;
                        $args = array(
                            'tag__in' => $tag_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => $post_perpage, // Number of related posts to display.
                            'orderby' => $orderby,
                            'order' => $order
                        );
                    }
                }
                $my_query = new wp_query($args);
                if ($my_query->have_posts()) {
                    while ($my_query->have_posts()) {
                        $my_query->the_post();
                        ?>
                        <div class="relatedthumb">
                            <a rel="external" href="<?php the_permalink(); ?>"><?php
                                if (has_post_thumbnail()) {
                                    $bdp_related_post_media_size = isset($bdp_settings['bdp_related_post_media_size']) ? $bdp_settings['bdp_related_post_media_size'] : 'related-post-thumb';
                                    if ($bdp_related_post_media_size == 'custom') {
                                        $url = wp_get_attachment_url(get_post_thumbnail_id());
                                        $width = isset($bdp_settings['related_post_media_custom_width']) ? $bdp_settings['related_post_media_custom_width'] : 640;
                                        $height = isset($bdp_settings['related_post_media_custom_height']) ? $bdp_settings['related_post_media_custom_height'] : 300;
                                        $resizedImage = bdp_resize($url, $width, $height, true, get_post_thumbnail_id());
                                        $thumbnail = '<img src="' . $resizedImage["url"] . '" width="' . $resizedImage["width"] . '" height="' . $resizedImage["height"] . '" title="' . get_the_title($post->ID) . '" alt="' . get_the_title($post->ID) . '" />';
                                    } else {
                                        $thumbnail = get_the_post_thumbnail($post->ID, $bdp_related_post_media_size);
                                    }
                                } else {
                                    $thumbnail = bdp_get_related_post_sample_image($post->ID);
                                }
                                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);

                                if (get_the_title() != '') {
                                    ?> <div class="relatedpost_title"><?php the_title(); ?></div> <?php
                                }
                                ?>

                            </a>
                            <?php if ($related_post_content_length != 0 && $related_post_content_length != '') { ?>
                                <?php
                                if ($related_post_content_from == 'from_excerpt' && get_the_excerpt(get_the_ID()) != '') {
                                    $excerpt = get_the_excerpt(get_the_ID());
                                } else {
                                    $excerpt = get_the_content(get_the_ID());
                                }
                                $bdp_excerpt_data = wp_trim_words($excerpt, $related_post_content_length, ' ...');
                                $bdp_excerpt_data = apply_filters('bdp_related_post_content_change', $bdp_excerpt_data, get_the_ID());
                                if (!empty($bdp_excerpt_data)) {
                                    echo '<div class="related_post_content">' . $bdp_excerpt_data . '</div>';
                                }
                                ?>
                            <?php } ?>
                        </div>

                        <?php
                    }
                } else {
                    echo '<span class="bdp-no-post-found">';
                    _e('No posts found.', BLOGDESIGNERPRO_TEXTDOMAIN);
                    echo '</span>';
                }
                wp_reset_query();
                ?>
            </div>
        </div>
        <?php
    }

}

/**
 * Function Display Author Image Using Action
 * @param string $template
 */
if (!function_exists('bdp_display_author_image')) {

    function bdp_display_author_image($template) {
        ?>
        <div class="avtar-img">
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php
                $authorid = get_the_author_meta('ID');
                if ($template == 'brite') {
                    echo get_avatar(get_the_author_meta('ID'), 112);
                } else {
                    echo get_avatar(get_the_author_meta('ID'), 150);
                }
                ?>
            </a>
        </div>
        <?php
    }

}

/**
 * Function Display Author Name Using Action
 * @param string $template
 * @param html $biography
 * @param string $title
 */
if (!function_exists('bdp_display_author_name')) {

    function bdp_display_author_name($template, $biography, $title, $bdp_settings) {
        if (!empty($title)) {
            $disable_link = isset($bdp_settings['disable_link_author_div']) ? $bdp_settings['disable_link_author_div'] : 0;
            ?>
            <span class="author">
                <?php
                if (!is_author()) {
                    $text = $title;
                    if($disable_link == 1) {
                        $replace = get_the_author();
                    } else {
                        $replace = '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>';
                    }
                    echo str_replace('[author]', $replace, $text);
                } else {
                    $text = $title;
                    $replace = get_the_author();
                    echo str_replace('[author]', $replace, $text);
                }
                ?>
            </span>
            <?php
        }
    }

}

/**
 * Function Display Author Biography Using Action
 * @param string $template
 * @param boolean $display_author_biography
 */
if (!function_exists('bdp_display_author_biography')) {

    function bdp_display_author_biography($template, $display_author_biography) {
        if ($display_author_biography == 1) {
            $authorid = get_the_author_meta('ID');
            if (get_the_author_meta('description', $authorid)) {
                ?><p><?php echo get_the_author_meta('description', $authorid); ?></p>
                <?php
            }
        }
    }

}

/**
 * Function Display Author Biography Cover Div Start Using Action
 */
if (!function_exists('bdp_display_author_content_cover_start')) {

    function bdp_display_author_content_cover_start($template) {
        echo '<div class="author_content">';
    }

}

/**
 * Function Display Author Biography Cover Div End Using Action
 */
if (!function_exists('bdp_display_author_content_cover_end')) {

    function bdp_display_author_content_cover_end($template) {
        echo '</div>';
    }

}

add_filter('next_post_link', 'bdp_post_link_attributes', 1);
add_filter('previous_post_link', 'bdp_post_link_attributes', 1);

/**
 * add class in a tag
 * @param string $output
 * @return string anchor tag of with class
 */
if (!function_exists('bdp_post_link_attributes')) {

    function bdp_post_link_attributes($output) {
        $code = 'class="styled-button"';
        return str_replace('<a href=', '<a ' . $code . ' href=', $output);
    }

}

add_filter('user_contactmethods', 'bdp_author_social_links', 12, 1);

/**
 * Add facebook,twitter,Google+ links to user profile page.
 * @param array $user_info
 * @return array updated userinfo
 */
if (!function_exists('bdp_author_social_links')) {

    function bdp_author_social_links($user_info) {

        // Add user social contact links
        $user_info['googleplus'] = __('Google+', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['facebook'] = __('Facebook', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['twitter'] = __('Twitter', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['linkedin'] = __('LinkedIn', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['youtube'] = __('YouTube', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['pinterest'] = __('Pinterest', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['instagram'] = __('Instagram', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['reddit'] = __('Reddit', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['pocket'] = __('Pocket', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['skype'] = __('Skype', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['wordpress'] = __('WordPress', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['snapchat'] = __('Snapchat', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['vine'] = __('Vine', BLOGDESIGNERPRO_TEXTDOMAIN);
        $user_info['tumblr'] = __('Tumblr', BLOGDESIGNERPRO_TEXTDOMAIN);

        return $user_info;
    }

}

/**
 * Add social media links of author display in single post page
 * @param string $bdp_theme
 * @param boolean $display_author_biography
 * @param string $txtAuthorTitle
 * @param array $bdp_settings
 */
if (!function_exists('bdp_display_author_social_links')) {

    function bdp_display_author_social_links($bdp_theme, $display_author_biography, $txtAuthorTitle, $bdp_settings) {
        $enable_share_links = isset($bdp_settings['display_author_social']) && $bdp_settings['display_author_social'] == 0 ? false : true;
        if($enable_share_links) {

            $enable_email = (isset($bdp_settings['author_email_link']) && $bdp_settings['author_email_link'] == 1) ? true : false;
            $enable_website = (isset($bdp_settings['author_website_link']) && $bdp_settings['author_website_link'] == 0) ? false : true;
            $enable_facebook = (isset($bdp_settings['author_facebook_link']) && $bdp_settings['author_facebook_link'] == 0) ? false : true;
            $enable_twitter = (isset($bdp_settings['author_twitter_link']) && $bdp_settings['author_twitter_link'] == 0) ? false : true;
            $enable_googleplus = (isset($bdp_settings['author_google_plus_link']) && $bdp_settings['author_google_plus_link'] == 0) ? false : true;
            $enable_linkedin = (isset($bdp_settings['author_linkedin_link']) && $bdp_settings['author_linkedin_link'] == 0) ? false : true;
            $enable_youtube = (isset($bdp_settings['author_youtube_link']) && $bdp_settings['author_youtube_link'] == 0) ? false : true;
            $enable_pinterest = (isset($bdp_settings['author_pinterest_link']) && $bdp_settings['author_pinterest_link'] == 0) ? false : true;
            $enable_instagram = (isset($bdp_settings['author_instagram_link']) && $bdp_settings['author_instagram_link'] == 0) ? false : true;
            $enable_reddit = (isset($bdp_settings['author_reddit_link']) && $bdp_settings['author_reddit_link'] == 1) ? true : false;
            $enable_pocket = (isset($bdp_settings['author_pocket_link']) && $bdp_settings['author_pocket_link'] == 1) ? true : false;
            $enable_skype = (isset($bdp_settings['author_skype_link']) && $bdp_settings['author_skype_link'] == 1) ? true : false;
            $enable_wordpress = (isset($bdp_settings['author_wordpress_link']) && $bdp_settings['author_wordpress_link'] == 1) ? true : false;
            $enable_snapchat = (isset($bdp_settings['author_snapchat_link']) && $bdp_settings['author_snapchat_link'] == 1) ? true : false;
            $enable_vine = (isset($bdp_settings['author_vine_link']) && $bdp_settings['author_vine_link'] == 1) ? true : false;
            $enable_tumblr = (isset($bdp_settings['author_tumblr_link']) && $bdp_settings['author_tumblr_link'] == 1) ? true : false;

            $website = esc_url(get_the_author_meta('url'));
            $email = sanitize_email(get_the_author_meta('email'));
            $facebook = esc_url(get_the_author_meta('facebook'));
            $twitter = esc_url(get_the_author_meta('twitter'));
            $googleplus = esc_url(get_the_author_meta('googleplus'));
            $linkedin = esc_url(get_the_author_meta('linkedin'));
            $youtube = esc_url(get_the_author_meta('youtube'));
            $pinterest = esc_url(get_the_author_meta('pinterest'));
            $instagram = esc_url(get_the_author_meta('instagram'));
            $reddit = esc_url(get_the_author_meta('reddit'));
            $pocket = esc_url(get_the_author_meta('pocket'));
            $skype = esc_url(get_the_author_meta('skype'));
            $wordpress = esc_url(get_the_author_meta('wordpress'));
            $snapchat = esc_url(get_the_author_meta('snapchat'));
            $vine = esc_url(get_the_author_meta('vine'));
            $tumblr = esc_url(get_the_author_meta('tumblr'));

            if ( (!empty($facebook) && $enable_facebook)  || (!empty($twitter) && $enable_twitter) || (!empty($googleplus) && $enable_googleplus) || (!empty($linkedin) && $enable_linkedin) || (!empty($website) && $enable_website) || (!empty($email) && $enable_email) || (!empty($youtube) && $enable_youtube) || (!empty($pinterest) && $enable_pinterest) || (!empty($instagram) && $enable_instagram) || (!empty($reddit) && $enable_reddit) || (!empty($pocket) && $enable_pocket) || (!empty($skype) && $enable_skype) || (!empty($snapchat) && $enable_snapchat) || (!empty($vine) && $enable_vine) || (!empty($tumblr) && $enable_tumblr) || (!empty($wordpress) && $enable_wordpress)) {
                $social_theme = ' default_social_style_1 ';
                if (isset($bdp_settings['default_icon_theme']) && isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                    $social_theme = ' default_social_style_' . $bdp_settings['default_icon_theme'] . ' ';
                }
                ?>
                <div class="social-component<?php echo $social_theme; ?><?php
                if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 0) {
                    if (isset($bdp_settings['social_icon_size']) && $bdp_settings['social_icon_size'] == 0) {
                        echo ' large ';
                    } elseif (isset($bdp_settings['social_icon_size']) && $bdp_settings['social_icon_size'] == 2) {
                        echo ' extra_small ';
                    }
                }
                ?>">
                    <?php if (!empty($facebook) && $enable_facebook) { ?>

                        <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                            <a href="<?php echo $facebook; ?>" target="_blank" class="bdp-facebook-share social-share-default"></a>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo $facebook; ?>" target="_blank" class="bdp-facebook-share facebook-share social-share-custom">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <?php
                        }
                        ?>

                        <?php
                    }
                    if (!empty($googleplus) && $enable_googleplus) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $googleplus; ?>" target="_blank" class="bdp-google-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $googleplus; ?>" target="_blank" class="bdp-google-share social-share-custom">
                                <i class="fab fa-google-plus-g"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($linkedin) && $enable_linkedin) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $linkedin; ?>" target="_blank" class="bdp-linkedin-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $linkedin; ?>" target="_blank" class="bdp-linkedin-share social-share-custom">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    if (!empty($twitter) && $enable_twitter) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $twitter; ?>" target="_blank" class="bdp-twitter-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $twitter; ?>" target="_blank" class="bdp-twitter-share social-share-custom">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($email) && $enable_email) {
                        ?>
                        <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                            <a href="<?php echo 'mailto:' . $email; ?>" target="_blank" class="bdp-email-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo 'mailto:' . $email; ?>" target="_blank" class="bdp-email-share social-share-custom">
                                <i class="far fa-envelope-open"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($website) && $enable_website) {
                        ?>
                        <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
                            <a href="<?php echo $website; ?>" target="_blank" class="bdp-website-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $website; ?>" target="_blank" class="bdp-website-share social-share-custom">
                                <i class="fas fa-globe"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($youtube) && $enable_youtube) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $youtube; ?>" target="_blank" class="bdp-youtube-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $youtube; ?>" target="_blank" class="bdp-youtube-share social-share-custom">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($pinterest) && $enable_pinterest) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $pinterest; ?>" target="_blank" class="bdp-pinterest-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $pinterest; ?>" target="_blank" class="bdp-pinterest-share social-share-custom">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($instagram) && $enable_instagram) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $instagram; ?>" target="_blank" class="bdp-instagram-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $instagram; ?>" target="_blank" class="bdp-instagram-share social-share-custom">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($reddit) && $enable_reddit) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $reddit; ?>" target="_blank" class="bdp-reddit-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $reddit; ?>" target="_blank" class="bdp-reddit-share social-share-custom">
                                <i class="fab fa-reddit-alien"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($pocket) && $enable_pocket) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $pocket; ?>" target="_blank" class="bdp-pocket-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $pocket; ?>" target="_blank" class="bdp-pocket-share social-share-custom">
                                <i class="fab fa-get-pocket"></i>
                            </a>
                            <?php
                        }
                    }

                    if (!empty($skype) && $enable_skype) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $skype; ?>" target="_blank" class="bdp-skype-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $skype; ?>" target="_blank" class="bdp-skype-share social-share-custom">
                                <i class="fab fa-skype"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($wordpress) && $enable_wordpress) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $wordpress; ?>" target="_blank" class="bdp-wordpress-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $wordpress; ?>" target="_blank" class="bdp-wordpress-share social-share-custom">
                                <i class="fab fa-wordpress"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($snapchat) && $enable_snapchat) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $snapchat; ?>" target="_blank" class="bdp-snapchat-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $snapchat; ?>" target="_blank" class="bdp-snapchat-share social-share-custom">
                                <i class="fab fa-snapchat-ghost"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($vine) && $enable_vine) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $vine; ?>" target="_blank" class="bdp-vine-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $vine; ?>" target="_blank" class="bdp-vine-share social-share-custom">
                                <i class="fab fa-vine"></i>
                            </a>
                            <?php
                        }
                    }
                    if (!empty($tumblr) && $enable_tumblr) {
                        if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) {
                            ?>
                            <a href="<?php echo $tumblr; ?>" target="_blank" class="bdp-tumblr-share social-share-default"></a>
                        <?php } else { ?>
                            <a href="<?php echo $tumblr; ?>" target="_blank" class="bdp-tumblr-share social-share-custom">
                                <i class="fab fa-tumblr"></i>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
        }
    }

}

/**
 * get all archive list
 * @global object $wpdb
 * @return Array List of archive table
 */
if (!function_exists('bdp_get_archive_list')) {

    function bdp_get_archive_list() {
        global $wpdb;
        $archive_array = array();
        $archives = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives ORDER BY id DESC');
        if ($archives) {
            foreach ($archives as $archive) {
                $archive_array[$archive->id] = $archive->archive_template;
            }
        }
        return $archive_array;
    }

}

/**
 * get all Single list
 * @global object $wpdb
 * @return Array List of single tempalte list
 */
if (!function_exists('bdp_get_single_list')) {

    function bdp_get_single_list() {
        global $wpdb;
        $single_array = array();
        $singles = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts ORDER BY id DESC');
        if ($singles) {
            foreach ($singles as $single) {
                $single_array[] = $single->single_template;
            }
        }
        return $single_array;
    }

}

/**
 * get date archive template settings
 * @global object $wpdb
 * @return array Date Template settings
 */
if (!function_exists('bdp_get_date_template_settings')) {

    function bdp_get_date_template_settings() {
        global $wpdb;
        $date_settings = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "date_template"');
        return $date_settings;
    }

}

/**
 * get author template settings
 * @param int $author_id
 * @param array $archive_list
 * @return Array Category Template settings
 */
if (!function_exists('bdp_get_author_template_settings')) {

    function bdp_get_author_template_settings($author_id, $archive_list = array()) {
        $bdp_author_data = $bdp_settings = array();
        $bdp_layout_id = '';
        if (!empty($archive_list) && $archive_list) {
            foreach ($archive_list as $archive) {
                if ($archive == 'author_template') {
                    global $wpdb;
                    $author_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template" AND find_in_set("' . $author_id . '",sub_categories) <> 0');
                    if (!empty($author_template)) {
                        $bdp_layout_id = $author_template->id;
                        $allsettings = $author_template->settings;
                        if (is_serialized($allsettings)) {
                            $bdp_settings = unserialize($allsettings);
                        }
                    } else {
                        $author_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template" AND sub_categories = "" ORDER BY id DESC');
                        if (!empty($author_template)) {
                            $bdp_layout_id = $author_template->id;
                            $allsettings = $author_template->settings;
                            if (is_serialized($allsettings)) {
                                $bdp_settings = unserialize($allsettings);
                            }
                        }
                    }
                }
            }
        }
        $bdp_author_data['id'] = $bdp_layout_id;
        $bdp_author_data['bdp_settings'] = $bdp_settings;
        return $bdp_author_data;
    }

}

/**
 * get author template settings
 * @global object $wpdb
 * @return array Author Template settings
 */
if (!function_exists('bdp_get_search_template_settings')) {

    function bdp_get_search_template_settings() {
        global $wpdb;
        $author_settings = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "search_template"');
        return $author_settings;
    }

}

/**
 * Get single post template settings
 * @global object $wpdb
 * @return array All Post Single Template settings
 */
if (!function_exists('bdp_get_all_single_template_settings')) {

    function bdp_get_all_single_template_settings() {
        global $wpdb;
        $all_settings = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "all"');
        return $all_settings;
    }

}

/**
 * Get single post template settings
 * @global object $wpdb
 * @return array Get bdp settings
 */
if (!function_exists('bdp_get_single_template_settings')) {

    function bdp_get_single_template_settings($cat_ids, $tag_ids) {
        global $wpdb;
        $single_data = '';
        $all_single_settings = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "all"');
        $single_post_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE find_in_set("' . get_the_ID() . '",single_post_id) <> 0');
        $single_category_template = '';
        $single_tag_template = '';
        if ($cat_ids) {
            foreach ($cat_ids as $cat_id) {
                $category_template = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND find_in_set("' . $cat_id . '",sub_categories) <> 0');
                if ($category_template) {
                    $single_category_template = true;
                    break;
                }
            }
            $category_template_blank = '';
            if ($single_category_template) {
                $category_template_blank = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND sub_categories = "" AND single_post_id = ""');
            }
        }
        if ($tag_ids) {
            foreach ($tag_ids as $tag_id) {
                $tag_template = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND find_in_set("' . $tag_id->term_id . '",sub_categories) <> 0');
                if ($tag_template) {
                    $single_tag_template = true;
                    break;
                }
            }
            $tag_template_blank = '';
            if ($single_tag_template) {
                $tag_template_blank = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND sub_categories = "" AND single_post_id = ""');
            }
        }

        if ($single_post_template) {
            if (isset($single_post_template->settings)) {
                $single_data = $single_post_template->settings;
            }
        } elseif ($cat_ids && $single_category_template) {
            if ($category_template_blank) {
                $single_data = isset($category_template_blank->settings) ? $category_template_blank->settings : '';
            } else {
                $single_data = isset($all_single_settings->settings) ? $all_single_settings->settings : '';
            }
            foreach ($cat_ids as $cat_id) {
                $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND find_in_set("' . $cat_id . '",sub_categories) <> 0');
                if ($category_template) {
                    if (isset($category_template->settings)) {
                        $single_data_cat = $category_template->settings;
                        $serialize_single_data = unserialize($single_data_cat);
                        $template_posts = isset($serialize_single_data['template_posts']) ? $serialize_single_data['template_posts'] : array();
                        if (empty($template_posts)) {
                            $single_data = $category_template->settings;
                            break;
                        }
                    }
                }
            }
        } elseif ($tag_ids && $single_tag_template) {
            if ($tag_template_blank) {
                $single_data = isset($tag_template_blank->settings) ? $tag_template_blank->settings : '';
            } else {
                $single_data = isset($all_single_settings->settings) ? $all_single_settings->settings : '';
            }
            foreach ($tag_ids as $tag_id) {
                $tag_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND find_in_set("' . $tag_id->term_id . '",sub_categories) <> 0');
                if ($tag_template) {
                    if (isset($tag_template->settings)) {
                        $single_data_settings = $tag_template->settings;
                        $serialize_single_data = unserialize($single_data_settings);
                        $template_posts = isset($serialize_single_data['template_posts']) ? $serialize_single_data['template_posts'] : array();
                        if (empty($template_posts)) {
                            $single_data = $tag_template->settings;
                            break;
                        }
                    }
                }
            }
        } elseif ($all_single_settings) {
            if (isset($all_single_settings->settings)) {
                $single_data = $all_single_settings->settings;
            }
        }
        return $single_data;
    }

}

if (!function_exists('get_single_template_setting_front_end')) {

    function get_single_template_setting_front_end() {
        global $post, $wpdb;
        $post_id = $post->ID;
        $cat_ids = wp_get_post_categories($post_id);
        $tag_ids = wp_get_post_tags($post_id);
        $all_single_settings = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "all"');
        $single_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE find_in_set("' . get_the_ID() . '",single_post_id) <> 0');
        $single_category_template = '';
        $single_tag_template = '';
        if ($cat_ids) {
            foreach ($cat_ids as $cat_id) {
                $category_template = $wpdb->get_row('SELECT id FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND find_in_set("' . $cat_id . '",sub_categories) <> 0');
                if ($category_template) {
                    $single_category_template = true;
                    break;
                }
            }
            $category_template_blank = '';
            if ($single_category_template) {
                $category_template_blank = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND sub_categories = "" AND single_post_id = ""');
            }
        }
        if ($tag_ids) {
            foreach ($tag_ids as $tag_id) {
                $tag_template = $wpdb->get_row('SELECT id FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND find_in_set("' . $tag_id->term_id . '",sub_categories) <> 0');
                if ($tag_template) {
                    $single_tag_template = true;
                    break;
                }
            }
            $tag_template_blank = '';
            if ($single_tag_template) {
                $tag_template_blank = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND sub_categories = "" AND single_post_id = ""');
            }
        }
        if ($single_template) {
            if (isset($single_template->settings) && is_serialized($single_template->settings)) {
                $bdp_settings = unserialize($single_template->settings);
            }
        } elseif ($cat_ids && $single_category_template) {
            if ($category_template_blank) {
                $bdp_settings = isset($category_template_blank->settings) ? unserialize($category_template_blank->settings) : '';
            } else {
                $bdp_settings = isset($all_single_settings->settings) ? unserialize($all_single_settings->settings) : '';
            }
            foreach ($cat_ids as $cat_id) {
                $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "category" AND find_in_set("' . $cat_id . '",sub_categories) <> 0');
                if ($category_template) {
                    if (isset($category_template->settings) && is_serialized($category_template->settings)) {
                        $serialize_single_data = unserialize($category_template->settings);
                        $template_posts = isset($serialize_single_data['template_posts']) ? $serialize_single_data['template_posts'] : array();
                        if (empty($template_posts)) {
                            $bdp_settings = unserialize($category_template->settings);
                            break;
                        }
                    }
                }
            }
        } elseif ($tag_ids && $single_tag_template) {
            if ($tag_template_blank) {
                $bdp_settings = isset($tag_template_blank->settings) ? unserialize($tag_template_blank->settings) : '';
            } else {
                $bdp_settings = isset($all_single_settings->settings) ? unserialize($all_single_settings->settings) : '';
            }
            foreach ($tag_ids as $tag_id) {
                $tag_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_single_layouts WHERE single_template = "tag" AND find_in_set("' . $tag_id->term_id . '",sub_categories) <> 0');
                if ($tag_template) {
                    if (isset($tag_template->settings) && is_serialized($tag_template->settings)) {
                        $serialize_single_data = unserialize($tag_template->settings);
                        $template_posts = isset($serialize_single_data['template_posts']) ? $serialize_single_data['template_posts'] : array();
                        if (empty($template_posts)) {
                            $bdp_settings = unserialize($tag_template->settings);
                            break;
                        }
                    }
                }
            }
        } elseif ($all_single_settings ) {
            if (isset($all_single_settings->settings) && is_serialized($all_single_settings->settings)) {
                $bdp_settings = unserialize($all_single_settings->settings);
            }
        } else {
            $bdp_settings = array();
        }
        return $bdp_settings;
    }

}

/**
 * get author template settings
 * @param int $tag_id
 * @param array $archive_list
 * @return array Author Template settings
 */
if (!function_exists('bdp_get_tag_template_settings')) {

    function bdp_get_tag_template_settings($tag_id, $archive_list) {
        $bdp_tag_data = $bdp_settings = array();
        $bdp_layout_id = '';
        if ($archive_list) {
            foreach ($archive_list as $archive) {
                if ($archive == 'tag_template') {
                    global $wpdb;
                    $tag_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "tag_template" AND find_in_set("' . $tag_id . '",sub_categories) <> 0');
                    if (!empty($tag_template)) {
                        $bdp_layout_id = $tag_template->id;
                        $allsettings = $tag_template->settings;
                        if (is_serialized($allsettings)) {
                            $bdp_settings = unserialize($allsettings);
                        }
                    } else {
                        $tag_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "tag_template" AND sub_categories = "" ORDER BY id DESC');
                        if (!empty($tag_template)) {
                            $bdp_layout_id = $tag_template->id;
                            $allsettings = $tag_template->settings;
                            if (is_serialized($allsettings)) {
                                $bdp_settings = unserialize($allsettings);
                            }
                        }
                    }
                }
            }
        }
        $bdp_tag_data['id'] = $bdp_layout_id;
        $bdp_tag_data['bdp_settings'] = $bdp_settings;
        return $bdp_tag_data;
    }

}

/**
 * get category template settings
 * @param int $category_id
 * @param array $archive_list
 * @return Array Category Template settings
 */
if (!function_exists('bdp_get_category_template_settings')) {

    function bdp_get_category_template_settings($category_id, $archive_list) {
        $bdp_category_data = $bdp_settings = array();
        $bdp_layout_id = '';
        if ($archive_list) {
            foreach ($archive_list as $archive) {
                if ($archive == 'category_template') {
                    global $wpdb;
                    $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "category_template" AND find_in_set("' . $category_id . '",sub_categories) <> 0');
                    if (!empty($category_template)) {
                        $bdp_layout_id = $category_template->id;
                        $allsettings = $category_template->settings;
                        if (is_serialized($allsettings)) {
                            $bdp_settings = unserialize($allsettings);
                        }
                    } else {
                        $category_template = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "category_template" AND sub_categories = "" ORDER BY id DESC');
                        if (!empty($category_template)) {
                            $bdp_layout_id = $category_template->id;
                            $allsettings = $category_template->settings;
                            if (is_serialized($allsettings)) {
                                $bdp_settings = unserialize($allsettings);
                            }
                        }
                    }
                }
            }
        }
        $bdp_category_data['id'] = $bdp_layout_id;
        $bdp_category_data['bdp_settings'] = $bdp_settings;
        return $bdp_category_data;
    }

}

/**
 * add notice at admin side
 * @global object $current_user
 */
if (!function_exists('bdp_admin_notice')) {

    function bdp_admin_notice() {
        global $current_user;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */

        if (!get_user_meta($user_id, 'bdp_notice_ignore') && current_user_can('manage_options')) {
            echo '<div class="updated notice is-dismissible bdp-admin-notice-pro-layouts"><p>';
            ?>
            <strong><?php _e('Blog Designer PRO is a best blog layout builders plugin of your blog, archive and single post pages. 40+ pre-defined templates will beautify your blog section in just 5 minutes!', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong>
            <p> <a href="<?php echo esc_url('http://blogdesigner.solwininfotech.com/'); ?>" target="_blank"><strong><?php _e('Live Preview ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong> </a> | <a href="<?php echo esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin'); ?>" target="_blank"><strong><?php _e('See Details ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong></a> | <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#quick_guide'); ?>" target="_blank"><strong><?php _e('Detailed Documentation', BLOGDESIGNERPRO_TEXTDOMAIN) ?></strong></a></p>
            <button class="notice-dismiss" type="button">
                <span class="screen-reader-text"><?php _e('Dismiss this notice.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
            </button>
            <?php
            echo "</p></div>";
        }
    }

}

/**
 * add notice at admin side for create sample blog layout
 * @since 1.5
 * @global object $pagenow;
 */
if (!function_exists('bdp_sample_layout_notice')) {

    function bdp_sample_layout_notice() {

        /* Check that the user hasn't already clicked to ignore the message */
        if (isset($_GET['page']) && current_user_can('manage_options') && ($_GET['page'] == 'layouts' || $_GET['page'] == 'add_shortcode')) {
            global $wpdb;
            $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');

            if ($count_layout < 1) {
                echo '<div class="updated notice is-dismissible bdp-admin-notice-pro-layouts"><p>';
                ?>
                <strong><?php _e('Create New Sample Blog layout with Blog Designer PRO Plugin', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong>&nbsp;&nbsp;&nbsp;
                <a class="bdp-create-layout button-primary" href="<?php echo esc_url(add_query_arg('sample-blog-layout', 'new', admin_url('admin.php?page=layouts'))); ?>"><?php _e('Create Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                <button class="notice-dismiss bdp-sample-blog-layout-notice-dismiss" type="button">
                    <span class="screen-reader-text"><?php _e('Dismiss this notice.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                </button>
                <?php
                echo "</p></div>";
            }
        }
    }

}

/**
 * create sample blog layout
 * @since 1.5
 * @global type $wpdb
 */
if (!function_exists('bdp_create_sample_layout')) {

    function bdp_create_sample_layout() {

        if (isset($_GET['sample-blog-layout']) && 'new' == $_GET['sample-blog-layout']) {
            global $wpdb;

            $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');

            $page_id = '';
            $blog_page_id = wp_insert_post(
                    array(
                        'post_title' => __('Sample Blog', BLOGDESIGNERPRO_TEXTDOMAIN),
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'post_content' => ''
                    )
            );

            if ($blog_page_id) {
                $page_id = $blog_page_id;
            }

            /* Array for sample blog layout create */
            $sample_blog_settings = array(
                'template_name' => 'classical',
                'bdp_color_preset' => 'classical_default',
                'unique_shortcode_name' => 'Sample Blog Layout',
                'bdp_timeline_layout' => '',
                'custom_post_type' => 'post',
                'blog_page_display' => $page_id,
                'blog_time_period' => 'all',
                'between_two_date_from' => '',
                'between_two_date_to' => '',
                'bdp_time_period_day' => '15',
                'posts_per_page' => '5',
                'bdp_blog_order_by' => 'date',
                'bdp_blog_order' => 'ASC',
                'timeline_display_option' => '',
                'displaydate_backcolor' => '#414a54',
                'pagination_type' => 'paged',
                'display_category' => '1',
                'display_tag' => '1',
                'display_author' => '1',
                'display_story_year' => '1',
                'display_date' => '1',
                'display_comment_count' => '1',
                'display_postlike' => '0',
                'custom_css' => '',
                'display_timeline_bar' => '0',
                'timeline_start_from' => '28/01/2017',
                'template_easing' => 'easeOutSine',
                'item_width' => '400',
                'item_height' => '570',
                'template_post_margin' => '28',
                'enable_autoslide' => '0',
                'scroll_speed' => '1000',
                'unique_design_option' => 'first_post',
                'template_columns' => '2',
                'template_grid_height' => '300',
                'template_grid_skin' => 'default',
                'grid_col_space' => '10',
                'grid_hoverback_color' => '#000000',
                'template_color' => '#ffffff',
                'template_alternative_color' => '#c34376',
                'story_startup_border_color' => '#ffffff',
                'template_bgcolor' => '#ffffff',
                'blog_background_image_style' => '1',
                'template_bghovercolor' => '#eeeeee',
                'template_alternativebackground' => '0',
                'template_alterbgcolor' => '#ffffff',
                'story_startup_text' => 'STARTUP',
                'story_startup_background' => '#ade175',
                'story_startup_text_color' => '#333',
                'story_ending_text' => 'Ending',
                'story_ending_link' => '',
                'story_ending_background' => '#ade175',
                'story_ending_text_color' => '#333',
                'post_loop_alignment' => 'default',
                'template_ftcolor' => '#007acc',
                'template_fthovercolor' => '#666666',
                'deport_dashcolor' => '',
                'winter_category_color' => '',
                'image_corner_selection' => '0',
                'bdp_post_title_link' => '1',
                'template_titlecolor' => '#007acc',
                'template_titlehovercolor' => '#666666',
                'template_titlebackcolor' => '',
                'template_titlefontface_font_type' => '',
                'template_titlefontface' => '',
                'template_titlefontsize' => '30',
                'template_title_font_weight' => 'normal',
                'template_title_font_line_height' => '1.2',
                'template_title_font_text_transform' => 'none',
                'template_title_font_text_decoration' => 'none',
                'template_title_font_letter_spacing' => '0',
                'rss_use_excerpt' => '1',
                'template_post_content_from' => 'from_content',
                'display_html_tags' => '1',
                'firstletter_fontsize' => '28',
                'firstletter_font_family_font_type' => '',
                'firstletter_font_family' => '',
                'firstletter_contentcolor' => '#777777',
                'txtExcerptlength' => '80',
                'content_font_family_font_type' => '',
                'content_font_family' => '',
                'content_fontsize' => '14',
                'content_font_weight' => 'normal',
                'content_font_line_height' => '1.5',
                'content_font_text_transform' => 'none',
                'content_font_text_decoration' => 'none',
                'content_font_letter_spacing' => '0',
                'template_contentcolor' => '#777777',
                'template_content_hovercolor' => '#ed4b1f',
                'txtReadmoretext' => 'Read More',
                'template_readmorecolor' => '#007acc',
                'template_readmorebackcolor' => '#f1f1f1',
                'display_feature_image' => '0',
                'easy_timeline_effect' => 'flip-effect',
                'thumbnail_skin' => '0',
                'bdp_post_image_link' => '1',
                'bdp_default_image_id' => '',
                'bdp_default_image_src' => '',
                'bdp_media_size' => 'full',
                'media_custom_width' => '800',
                'media_custom_height' => '320',
                'template_slider_columns' => '2',
                'template_slider_effect' => 'slide',
                'template_slider_scroll' => '1',
                'display_slider_navigation' => '1',
                'navigation_style_hidden' => 'navigation3',
                'display_slider_controls' => '1',
                'arrow_style_hidden' => 'arrow1',
                'slider_autoplay' => '1',
                'slider_autoplay_intervals' => '3000',
                'slider_speed' => '300',
                'display_customread_more' => '1',
                'beforeloop_Readmoretext' => '',
                'beforeloop_Readmoretextlink' => '',
                'open_customlink' => '1',
                'beforeloop_readmorecolor' => '#ffffff',
                'beforeloop_readmorebackcolor' => '#333333',
                'beforeloop_readmorehovercolor' => '#333333',
                'beforeloop_readmorehoverbackcolor' => '#f1f1f1',
                'beforeloop_titlefontface_font_type' => '',
                'beforeloop_titlefontface' => '',
                'beforeloop_titlefontsize' => '14',
                'beforeloop_title_font_weight' => 'normal',
                'beforeloop_title_font_line_height' => '1.5',
                'beforeloop_title_font_text_transform' => 'none',
                'beforeloop_title_font_text_decoration' => 'none',
                'beforeloop_title_font_letter_spacing' => '0',
                'social_style' => '1',
                'social_icon_style' => '1',
                'social_icon_size' => '1',
                'default_icon_theme' => '1',
                'facebook_link' => '1',
                'facebook_link_with_count' => '1',
                'google_link' => '1',
                'linkedin_link' => '1',
                'linkedin_link_with_count' => '1',
                'pinterest_link' => '1',
                'pinterest_link_with_count' => '1',
                'twitter_link' => '1',
                'pocket_link' => '0',
                'telegram_link' => '0',
                'email_link' => '1',
                'whatsapp_link' => '0',
                'social_count_position' => 'right',
                'savedata' => 'Save Changes'
            );

            $table_name = $wpdb->prefix . "blog_designer_pro_shortcodes";

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                $insert_shortcode = $wpdb->insert(
                        $table_name, array(
                    'shortcode_name' => __('Sample Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN),
                    'bdsettings' => maybe_serialize($sample_blog_settings),
                        )
                );
                if ($insert_shortcode === FALSE) {
                    wp_die(__('Sample Blog Layout not created.', BLOGDESIGNERPRO_TEXTDOMAIN));
                } else {
                    $layout_id = $wpdb->insert_id;
                    $blog_args = array(
                        'ID' => $page_id,
                        'post_content' => '[wp_blog_designer id="' . $layout_id . '"]',
                    );
                    $layout_inserted = wp_update_post($blog_args);
                    bdp_admin_notice_pro_layouts_dismiss();
                    bdp_create_layout_from_blog_designer_dismiss();
                    if ($layout_inserted) {

                        $blog_url = get_permalink($page_id);
                        $edit_url = admin_url() .'admin.php?page=add_shortcode&action=edit&id='. $layout_id .'&create=sample';
                        echo "<script type=\"text/javascript\">
                                        window.open('$blog_url', '_blank');
                                        window.open('$edit_url', '_self');
                                    </script>";
                    }
                }
            } else {
                wp_die(__('Table not found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN));
            }
        }
    }

}


/**
 * add user meta for ignore notice
 * @global object $current_user
 */
if (!function_exists('bdp_detail_ignore')) {

    function bdp_detail_ignore() {
        global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if (isset($_GET['bdp_notice_ignore']) && '0' == $_GET['bdp_notice_ignore']) {
            add_user_meta($user_id, 'bdp_notice_ignore', 'true', true);
        }
    }

}

/**
 * Add Footer link
 */
if (!function_exists('bdp_footer')) {

    function bdp_footer() {
        $screen = get_current_screen();
        if ($screen->id == "blog-designer_page_add_shortcode" || $screen->id == "blog-designer_page_single_post" || $screen->id == "toplevel_page_layouts" || $screen->id == "blog-designer_page_archive_layouts" || $screen->id == "blog-designer_page_bdp_add_archive_layout" || $screen->id == "blog-designer_page_bdp_google_fonts" || $screen->id == "blog-designer_page_bdp_export" || $screen->id == "blog-designer_page_bdp_getting_started") {
            add_filter('admin_footer_text', 'bdp_remove_footer_admin'); //change admin footer text
        }
    }

}

/**
 * Add rating html at footer of admin
 * @return html rating
 */
if (!function_exists('bdp_remove_footer_admin')) {

    function bdp_remove_footer_admin() {
        ob_start();
        ?>
        <p id="footer-left" class="alignleft">
            <?php _e('If you like ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/blog-designer-pro/'); ?>" target="_blank"><strong><?php _e('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong></a>
            <?php _e('please leave us a', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            <a class="bdp-rating-link" data-rated="Thanks :)" target="_blank" href="<?php echo esc_url('https://codecanyon.net/item/blog-designer-pro-for-wordpress/reviews/17069678?utf8=%E2%9C%93&reviews_controls%5Bsort%5D=ratings_descending&ref=solwin'); ?>">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605;</a>
            <?php _e('rating. A huge thank you from Solwin Infotech in advance!', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
        </p>
        <?php
        return ob_get_clean();
    }

}

/**
 * check if current template is date archive or not
 * @return boolean
 */
if (!function_exists('bdp_check_archive_date_template')) {

    function bdp_check_archive_date_template($item) {
        return $item['archive_template'] === 'date_template';
    }

}

/**
 * check if current template is author archive or not
 * @return boolean
 */
if (!function_exists('bdp_check_archive_author_template')) {

    function bdp_check_archive_author_template($item) {
        return $item['archive_template'] === 'author_template';
    }

}

/**
 * check if current template is author archive or not
 * @return boolean
 */
if (!function_exists('bdp_check_single_all_template')) {

    function bdp_check_single_all_template($item) {
        return $item['single_template'] === 'all';
    }

}

/**
 * get if current theme have template file
 * @return filepath
 */
if (!function_exists('bdp_get_theme_template_file')) {

    function bdp_get_theme_template_file($template) {
        return get_stylesheet_directory() . '/' . apply_filters('bdp_template_directory', 'bdp_templates', $template) . '/' . $template;
    }

}
/**
 * Move template action.
 *
 * @param string $template_type
 */
if (!function_exists('bdp_singlefile_move_template_action')) {

    function bdp_singlefile_move_template_action($template) {
        if (!empty($template) && $template == 'single/single.php') {
            $template = 'single/single.php';
            $theme_file = bdp_get_theme_template_file($template);

            if (wp_mkdir_p(dirname($theme_file)) && !file_exists($theme_file)) {

                // Locate template file
                $template_name = BLOGDESIGNERPRO_DIR . 'bdp_templates/single/single.php';

                $template_file = apply_filters('bdp_locate_core_template', $template_name, $template);
                // Copy template file
                copy($template_file, $theme_file);

                /**
                 * bdp_copy_single_template action hook.
                 *
                 * @param string $template The copied template type
                 */
                do_action('bdp_copy_single_template', $template);

                echo '<div class="updated"><p>' . __('Template file copied to theme.', BLOGDESIGNERPRO_TEXTDOMAIN) . '</p></div>';
            }
        }
    }

}


/**
 * Delete template action.
 *
 * @param string $template_type
 */
if (!function_exists('bdp_singlefile_delete_template_action')) {

    function bdp_singlefile_delete_template_action($template) {
        if (!empty($template) && $template == 'single/single.php') {

            $theme_file = bdp_get_theme_template_file($template);

            if (file_exists($theme_file)) {
                unlink($theme_file);

                /**
                 * bdp_delete_single_template action hook.
                 *
                 * @param string $template The deleted template type
                 * @param string $email The email object
                 */
                do_action('bdp_delete_single_template', $template);

                echo '<div class="updated"><p>' . __('Template file deleted from theme.', BLOGDESIGNERPRO_TEXTDOMAIN) . '</p></div>';
            }
        }
    }

}

/**
 * Save the single templates.
 *
 * @param string $template_code
 * @param string $template_path
 */
if (!function_exists('bdp_singlefile_save_template')) {

    function bdp_singlefile_save_template($template_code, $template_path) {
        if (current_user_can('edit_themes') && !empty($template_code) && !empty($template_path)) {
            $saved = false;
            $file = get_stylesheet_directory() . '/' . $template_path;
            $code = stripslashes($template_code);

            if (is_writeable($file)) {
                $f = fopen($file, 'w+');

                if ($f !== false) {
                    fwrite($f, $code);
                    fclose($f);
                    $saved = true;
                }
            }
            if (!$saved) {
                $redirect = add_query_arg('bdp_errors', urlencode(__('Could not write to template file.', BLOGDESIGNERPRO_TEXTDOMAIN)));
                wp_safe_redirect($redirect);
                exit;
            }
        }
    }

}


/**
 * Admin actions.
 */
if (!function_exists('bdp_admin_singlefile_actions')) {

    function bdp_admin_singlefile_actions() {
        // Handle any actions
        if ((!empty($_GET['move_template']) || !empty($_GET['delete_template']) ) && 'GET' === $_SERVER['REQUEST_METHOD']) {
            if (empty($_GET['_bdp_single_nonce']) || !wp_verify_nonce($_GET['_bdp_single_nonce'], 'bdp_single_template_nonce')) {
                wp_die(__('Action failed. Please refresh the page and retry.', BLOGDESIGNERPRO_TEXTDOMAIN));
            }

            if (!current_user_can('edit_themes')) {
                wp_die(__('Cheatin', BLOGDESIGNERPRO_TEXTDOMAIN) . '&#8217; ' . __('huh?', BLOGDESIGNERPRO_TEXTDOMAIN));
            }

            if (!empty($_GET['move_template'])) {
                bdp_singlefile_move_template_action($_GET['move_template']);
            }

            if (!empty($_GET['delete_template'])) {
                bdp_singlefile_delete_template_action($_GET['delete_template']);
            }
        }
    }

}

/**
 * Queue some JavaScript code to be output in the footer.
 *
 * @param string $code
 */
if (!function_exists('bdp_enqueue_js')) {

    function bdp_enqueue_js($code) {
        global $bdp_queued_js;

        if (empty($bdp_queued_js)) {
            $bdp_queued_js = '';
        }

        $bdp_queued_js .= "\n" . $code . "\n";
    }

}


/**
 * Output any queued javascript code in the footer.
 */
if (!function_exists('bdp_print_js')) {

    function bdp_print_js() {
        global $bdp_queued_js;

        if (!empty($bdp_queued_js)) {
            // Sanitize.
            $bdp_queued_js = wp_check_invalid_utf8($bdp_queued_js);
            $bdp_queued_js = preg_replace('/&#(x)?0*(?(1)27|39);?/i', "'", $bdp_queued_js);
            $bdp_queued_js = str_replace("\r", '', $bdp_queued_js);

            $js = "<!-- Bdp JavaScript -->\n<script type=\"text/javascript\">\njQuery(function($) { $bdp_queued_js });\n</script>\n";

            /**
             * bdp_queued_js filter.
             *
             * @param string $js JavaScript code.
             */
            echo apply_filters('bdp_queued_js', $js);

            unset($bdp_queued_js);
        }
    }

}
add_action('admin_footer', 'bdp_print_js', 25);

/**
 * Display social share text in a single post.
 * @param array $bdp_settings
 */
if (!function_exists('bdp_display_social_share_text')) {

    function bdp_display_social_share_text($bdp_settings) {
        if (!empty($bdp_settings['txtSocialIcon']) || !empty($bdp_settings['txtSocialText'])) {
            ?>
            <div class="share-this">
                <?php if (!empty($bdp_settings['txtSocialIcon'])) { ?>
                    <i class="<?php echo $bdp_settings['txtSocialIcon']; ?>"></i>
                    <?php
                }

                if (!empty($bdp_settings['txtSocialText'])) {
                    ?>
                    <span> <?php echo $bdp_settings['txtSocialText']; ?></span>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }

}

add_action('bdp_author_archive_detail', 'bdp_display_author_image', 5, 2);
add_action('bdp_author_archive_detail', 'bdp_display_author_content_cover_start', 10, 2);
add_action('bdp_author_archive_detail', 'bdp_display_author_name', 15, 4);
add_action('bdp_author_archive_detail', 'bdp_display_author_biography', 20, 2);
add_action('bdp_author_archive_detail', 'bdp_display_author_social_links', 25, 4);
add_action('bdp_author_archive_detail', 'bdp_display_author_content_cover_end', 30, 2);
add_action('bdp_social_share_text', 'bdp_display_social_share_text', 5, 1);


if (!function_exists('bdp_get_post_views')) {

    /**
     * Display counter with view ie. 999 Views
     * @param int $postID
     * @return string $countData
     */
    function bdp_get_post_views($postID, $bdp_settings) {
        $count_key = '_bdp_post_views_count';
        $daily_count_key = '_bdp_post_daily_count';
        $count = get_post_meta($postID, $count_key, true);
        $daily_count = get_post_meta($postID, $daily_count_key, true);
        if ($count == '') {
            $count = 1;
            update_post_meta($postID, $count_key, $count);
        }
        if ($daily_count == '') {
            $daily_count = 1;
            update_post_meta($postID, $daily_count_key, $daily_count);
        }
        $sep = ", ";
        $countData = '';
        if (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] == 1) {
            if($daily_count > 1) {
                $countData.= "<p>" . $daily_count . ' ' . __('Visits today',BLOGDESIGNERPRO_TEXTDOMAIN) . "</p>";
            } else {
                $countData.= "<p>" . $daily_count . ' ' . __('Visit today',BLOGDESIGNERPRO_TEXTDOMAIN) . "</p>";
            }
        }
        if (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] == 2) {
            if($count > 1) {
                $countData.="<p>" . __('Visited', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $count . ' ' . __('Times', BLOGDESIGNERPRO_TEXTDOMAIN);
            } else {
                $countData.="<p>" . __('Visited', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $count . ' ' . __('Time', BLOGDESIGNERPRO_TEXTDOMAIN);
            }

            if($daily_count > 1) {
                $countData.= $sep . $daily_count . ' ' . __('Visits today', BLOGDESIGNERPRO_TEXTDOMAIN) . "</p>";
            } else {
                $countData.= $sep . $daily_count . ' ' . __('Visit today', BLOGDESIGNERPRO_TEXTDOMAIN) . "</p>";
            }
        }
        return $countData;
    }

}


if (!function_exists('bdp_set_post_views')) {

    /**
     * Update calculated post count
     * @param int $postID
     */
    function bdp_set_post_views($postID) {
        $user_ip = $_SERVER['REMOTE_ADDR']; //retrieve the current IP address of the visitor
        $key = $user_ip . 'x' . $postID; //combine post ID & IP to form unique key
        $value = array($user_ip, $postID); // store post ID & IP as separate values (see note)
        $visited = get_transient($key); //get transient and store in variable
        //check to see if the Post ID/IP ($key) address is currently stored as a transient
        if (false === ( $visited )) {
            //store the unique key, Post ID & IP address for 24 hours if it does not exist
            set_transient($key, $value, 60 * 60 * 24);
            // now run post views function
            $count_key = '_bdp_post_views_count';
            $daily_count_key = '_bdp_post_daily_count';
            $daily_count_date = '_bdp_daily_view_date';
            $count = get_post_meta($postID, $count_key, true);

            if ($count == '') {
                $count = 1;
            } else {
                $count++;
            }
            update_post_meta($postID, $count_key, $count);
            $viewed_count_daily = get_post_meta($postID, $daily_count_key, true);
            $daily_date = get_post_meta($postID, $daily_count_date, true);
            if ($daily_date == date('Y-m-d')) {
                update_post_meta($postID, $daily_count_key, $viewed_count_daily + 1);
            } else {
                update_post_meta($postID, $daily_count_key, '1');
            }
            update_post_meta($postID, $daily_count_date, date('Y-m-d'));
        }
    }

}

if (!function_exists('bdp_close_tags')) {

    function bdp_close_tags($html = '') {
        if ($html == '') {
            return;
        }
        #put all opened tags into an array
        preg_match_all("#<([a-z]+)( .*)?(?!/)>#iU", $html, $result);
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all("#</([a-z]+)>#iU", $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        # all tags are closed
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        # close tags
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= "</" . $openedtags[$i] . ">";
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

}

/**
 * Column layout template class
 * @since 1.6
 * @global object $pagenow;
 */
if (!function_exists('bdp_column_class')) {

    function bdp_column_class($bdp_settings) {
        $column_class = '';

        $total_col = (isset($bdp_settings['template_columns']) && $bdp_settings['template_columns'] != '') ? $bdp_settings['template_columns'] : 2;
        if ($total_col == 1) {
            $col_class = 'one_column';
        }
        if ($total_col == 2) {
            $col_class = 'two_column';
        }
        if ($total_col == 3) {
            $col_class = 'three_column';
        }
        if ($total_col == 4) {
            $col_class = 'four_column';
        }

        $total_col_ipad = (isset($bdp_settings['template_columns_ipad']) && $bdp_settings['template_columns_ipad'] != '') ? $bdp_settings['template_columns_ipad'] : 1;
        if ($total_col_ipad == 1) {
            $col_class_ipad = 'one_column_ipad';
        }
        if ($total_col_ipad == 2) {
            $col_class_ipad = 'two_column_ipad';
        }
        if ($total_col_ipad == 3) {
            $col_class_ipad = 'three_column_ipad';
        }
        if ($total_col_ipad == 4) {
            $col_class_ipad = 'four_column_ipad';
        }

        $total_col_tablet = (isset($bdp_settings['template_columns_tablet']) && $bdp_settings['template_columns_tablet'] != '') ? $bdp_settings['template_columns_tablet'] : 1;
        if ($total_col_tablet == 1) {
            $col_class_tablet = 'one_column_tablet';
        }
        if ($total_col_tablet == 2) {
            $col_class_tablet = 'two_column_tablet';
        }
        if ($total_col_tablet == 3) {
            $col_class_tablet = 'three_column_tablet';
        }
        if ($total_col_tablet == 4) {
            $col_class_tablet = 'four_column_tablet';
        }

        $total_col_mobile = (isset($bdp_settings['template_columns_mobile']) && $bdp_settings['template_columns_mobile'] != '') ? $bdp_settings['template_columns_mobile'] : 1;
        if ($total_col_mobile == 1) {
            $col_class_mobile = 'one_column_mobile';
        }
        if ($total_col_mobile == 2) {
            $col_class_mobile = 'two_column_mobile';
        }
        if ($total_col_mobile == 3) {
            $col_class_mobile = 'three_column_mobile';
        }
        if ($total_col_mobile == 4) {
            $col_class_mobile = 'four_column_mobile';
        }

        $column_class = $col_class . ' ' . $col_class_ipad . ' ' . $col_class_tablet . ' ' . $col_class_mobile;
        return $column_class;
    }

}


/**
 * add notice at admin side for transfer blog designer data to Blog Designer PRO
 * @since 1.6
 * @global object $pagenow;
 */
if (!function_exists('bdp_create_layout_from_blog_designer_notice')) {

    function bdp_create_layout_from_blog_designer_notice() {

        /* Check that the user hasn't already clicked to ignore the message */
        if (isset($_GET['page']) && current_user_can('manage_options') && ($_GET['page'] == 'layouts' || $_GET['page'] == 'add_shortcode')) {
            global $wpdb;
            $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');

            if ($count_layout < 1) {
                echo '<div class="updated notice is-dismissible bdp-create-layout-using-blog-designer-div"><p>';
                ?>
                <strong><?php _e('Create Blog Layout using Blog Designer (free plugin) Data', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong>&nbsp;&nbsp;&nbsp;
                <a class="bdp-create-layout-using-blog-designer button-primary" href="<?php echo esc_url(add_query_arg('create-layout-using-blog-designer', 'new', admin_url('admin.php?page=layouts'))); ?>"><?php _e('Create Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                <button class="notice-dismiss bdp-create-layout-using-blog-designer-notice-dismiss" type="button">
                    <span class="screen-reader-text"><?php _e('Dismiss this notice.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                </button>
                <?php
                echo "</p></div>";
            }
        }
    }

}

/**
 * create blog layout using Blog Designer Data
 * @since 1.6
 * @global type $wpdb
 */
if (!function_exists('bdp_create_layout_using_blog_designer')) {

    function bdp_create_layout_using_blog_designer() {
        if (isset($_GET['create-layout-using-blog-designer']) && 'new' == $_GET['create-layout-using-blog-designer']) {
            global $wpdb;

            $count_layout = $wpdb->get_var('SELECT COUNT(`bdid`) FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes');
            $blog_designer_setting = get_option("wp_blog_designer_settings");

            $page_id = $blog_designer_setting['blog_page_display'];

            /* Array for sample blog layout create */
            $sample_blog_settings = array(
                'template_name' => $blog_designer_setting['template_name'],
                'bdp_color_preset' => $blog_designer_setting['template_name'] . '_default',
                'unique_shortcode_name' => 'Blog Designer Light Layout',
                'bdp_timeline_layout' => '',
                'custom_post_type' => 'post',
                'blog_page_display' => $page_id,
                'blog_time_period' => 'all',
                'between_two_date_from' => '',
                'between_two_date_to' => '',
                'bdp_time_period_day' => '15',
                'posts_per_page' => isset($blog_designer_setting['posts_per_page']) ? $blog_designer_setting['posts_per_page'] : '',
                'bdp_blog_order_by' => 'date',
                'bdp_blog_order' => 'ASC',
                'timeline_display_option' => '',
                'displaydate_backcolor' => '#414a54',
                'pagination_type' => 'paged',
                'display_sticky' => isset($blog_designer_setting['display_sticky']) ? $blog_designer_setting['display_sticky'] : '',
                'display_category' => isset($blog_designer_setting['display_category']) ? $blog_designer_setting['display_category'] : '',
                'display_tag' => isset($blog_designer_setting['display_tag']) ? $blog_designer_setting['display_tag'] : '',
                'display_author' => isset($blog_designer_setting['display_author']) ? $blog_designer_setting['display_author'] : '',
                'display_story_year' => '1',
                'display_date' => '1',
                'display_comment_count' => '1',
                'display_postlike' => '0',
                'custom_css' => '',
                'display_timeline_bar' => '0',
                'timeline_start_from' => '28/01/2017',
                'template_easing' => 'easeOutSine',
                'item_width' => '400',
                'item_height' => '570',
                'template_post_margin' => '28',
                'enable_autoslide' => '0',
                'scroll_speed' => '1000',
                'unique_design_option' => 'first_post',
                'template_columns' => '2',
                'template_grid_height' => '300',
                'template_grid_skin' => 'default',
                'grid_col_space' => '10',
                'grid_hoverback_color' => '#000000',
                'template_color' => '#ffffff',
                'template_alternative_color' => '#c34376',
                'story_startup_border_color' => '#ffffff',
                'template_bgcolor' => isset($blog_designer_setting['template_bgcolor']) ? $blog_designer_setting['template_bgcolor'] : '',
                'blog_background_image_style' => '1',
                'template_bghovercolor' => '#eeeeee',
                'template_alternativebackground' => '0',
                'template_alterbgcolor' => isset($blog_designer_setting['template_alternativebackground']) ? $blog_designer_setting['template_alternativebackground'] : '',
                'story_startup_text' => 'STARTUP',
                'story_startup_background' => '#ade175',
                'story_startup_text_color' => '#333',
                'story_ending_text' => 'Ending',
                'story_ending_link' => '',
                'story_ending_background' => '#ade175',
                'story_ending_text_color' => '#333',
                'post_loop_alignment' => 'default',
                'template_ftcolor' => isset($blog_designer_setting['template_ftcolor']) ? $blog_designer_setting['template_ftcolor'] : '',
                'template_fthovercolor' => '#666666',
                'deport_dashcolor' => '',
                'winter_category_color' => '',
                'image_corner_selection' => '0',
                'bdp_post_title_link' => '1',
                'template_titlecolor' => isset($blog_designer_setting['template_titlecolor']) ? $blog_designer_setting['template_titlecolor'] : '',
                'template_titlehovercolor' => '#666666',
                'template_titlebackcolor' => isset($blog_designer_setting['template_titlebackcolor']) ? $blog_designer_setting['template_titlebackcolor'] : '',
                'template_titlefontface_font_type' => '',
                'template_titlefontface' => '',
                'template_titlefontsize' => isset($blog_designer_setting['template_titlefontsize']) ? $blog_designer_setting['template_titlefontsize'] : '',
                'template_title_font_weight' => 'normal',
                'template_title_font_line_height' => '1.2',
                'template_title_font_text_transform' => 'none',
                'template_title_font_text_decoration' => 'none',
                'template_title_font_letter_spacing' => '0',
                'rss_use_excerpt' => isset($blog_designer_setting['rss_use_excerpt']) ? $blog_designer_setting['rss_use_excerpt'] : '',
                'template_post_content_from' => 'from_excerpt',
                'display_html_tags' => '1',
                'firstletter_fontsize' => '28',
                'firstletter_font_family_font_type' => '',
                'firstletter_font_family' => '',
                'firstletter_contentcolor' => '#777777',
                'txtExcerptlength' => isset($blog_designer_setting['txtExcerptlength']) ? $blog_designer_setting['txtExcerptlength'] : '',
                'content_font_family_font_type' => '',
                'content_font_family' => '',
                'content_fontsize' => isset($blog_designer_setting['content_fontsize']) ? $blog_designer_setting['content_fontsize'] : '',
                'content_font_weight' => 'normal',
                'content_font_line_height' => '1.5',
                'content_font_text_transform' => 'none',
                'content_font_text_decoration' => 'none',
                'content_font_letter_spacing' => '0',
                'template_contentcolor' => isset($blog_designer_setting['template_contentcolor']) ? $blog_designer_setting['template_contentcolor'] : '',
                'template_content_hovercolor' => '#ed4b1f',
                'txtReadmoretext' => isset($blog_designer_setting['txtReadmoretext']) ? $blog_designer_setting['txtReadmoretext'] : '',
                'template_readmorecolor' => isset($blog_designer_setting['template_readmorecolor']) ? $blog_designer_setting['template_readmorecolor'] : '',
                'template_readmorebackcolor' => isset($blog_designer_setting['template_readmorebackcolor']) ? $blog_designer_setting['template_readmorebackcolor'] : '',
                'display_feature_image' => '0',
                'easy_timeline_effect' => 'flip-effect',
                'thumbnail_skin' => '0',
                'bdp_post_image_link' => '1',
                'bdp_default_image_id' => '',
                'bdp_default_image_src' => '',
                'bdp_media_size' => 'full',
                'media_custom_width' => '800',
                'media_custom_height' => '320',
                'template_slider_columns' => '2',
                'template_slider_effect' => 'slide',
                'template_slider_scroll' => '1',
                'display_slider_navigation' => '1',
                'navigation_style_hidden' => 'navigation3',
                'display_slider_controls' => '1',
                'arrow_style_hidden' => 'arrow1',
                'slider_autoplay' => '1',
                'slider_autoplay_intervals' => '3000',
                'slider_speed' => '300',
                'display_customread_more' => '1',
                'beforeloop_Readmoretext' => '',
                'beforeloop_Readmoretextlink' => '',
                'open_customlink' => '1',
                'beforeloop_readmorecolor' => '#ffffff',
                'beforeloop_readmorebackcolor' => '#333333',
                'beforeloop_readmorehovercolor' => '#333333',
                'beforeloop_readmorehoverbackcolor' => '#f1f1f1',
                'beforeloop_titlefontface_font_type' => '',
                'beforeloop_titlefontface' => '',
                'beforeloop_titlefontsize' => '14',
                'beforeloop_title_font_weight' => 'normal',
                'beforeloop_title_font_line_height' => '1.5',
                'beforeloop_title_font_text_transform' => 'none',
                'beforeloop_title_font_text_decoration' => 'none',
                'beforeloop_title_font_letter_spacing' => '0',
                'social_style' => '0',
                'social_icon_style' => isset($blog_designer_setting['social_icon_style']) ? $blog_designer_setting['social_icon_style'] : '',
                'social_icon_size' => '1',
                'default_icon_theme' => '1',
                'facebook_link' => isset($blog_designer_setting['facebook_link']) ? $blog_designer_setting['facebook_link'] : '',
                'facebook_link_with_count' => '1',
                'google_link' => isset($blog_designer_setting['google_link']) ? $blog_designer_setting['google_link'] : '',
                'linkedin_link' => isset($blog_designer_setting['linkedin_link']) ? $blog_designer_setting['linkedin_link'] : '',
                'linkedin_link_with_count' => '1',
                'pinterest_link' => '1',
                'pinterest_link_with_count' => '1',
                'twitter_link' => isset($blog_designer_setting['twitter_link']) ? $blog_designer_setting['twitter_link'] : '',
                'pocket_link' => isset($blog_designer_setting['pinterest_link']) ? $blog_designer_setting['pinterest_link'] : '',
                'telegram_link' => '0',
                'email_link' => isset($blog_designer_setting['email_link']) ? $blog_designer_setting['email_link'] : '',
                'whatsapp_link' => '0',
                'social_count_position' => 'right',
                'custom_css' => isset($blog_designer_setting['custom_css']) ? $blog_designer_setting['custom_css'] : '',
                'savedata' => 'Save Changes'
            );

            $table_name = $wpdb->prefix . "blog_designer_pro_shortcodes";

            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                $insert_shortcode = $wpdb->insert(
                        $table_name, array(
                    'shortcode_name' => __('Sample Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN),
                    'bdsettings' => maybe_serialize($sample_blog_settings),
                        )
                );
                if ($insert_shortcode === FALSE) {

                    wp_die(__('Sample Blog Layout not created.', BLOGDESIGNERPRO_TEXTDOMAIN));
                } else {
                    $layout_id = $wpdb->insert_id;
                    $blog_args = array(
                        'ID' => $page_id,
                        'post_content' => '[wp_blog_designer id="' . $layout_id . '"]',
                    );
                    $layout_inserted = wp_update_post($blog_args);
                    bdp_admin_notice_pro_layouts_dismiss();
                    bdp_create_layout_from_blog_designer_dismiss();
                    if ($layout_inserted) {

                        $blog_url = get_permalink($page_id);
                        echo "<script type=\"text/javascript\">
                                        window.open('$blog_url', '_blank')
                                    </script>";
                    }
                }
            } else {
                wp_die(__('Table not found. Please try again.', BLOGDESIGNERPRO_TEXTDOMAIN));
            }
        }
    }
}


if (!function_exists('author_filter_func')) {

    function author_filter_func($query) {
        global $wpdb, $authors, $wp_bdp_setting;
        $query = str_replace("\n", " ", $query);
        $authorArr = (isset($wp_bdp_setting['template_authors'])) ? $wp_bdp_setting['template_authors'] : array();
        $exclude_author_list = isset($wp_bdp_setting['exclude_author_list']) ? true : false;
        if (!empty($authorArr)) {
            if ($exclude_author_list) {
                if (preg_match("/AND (\(.*term_taxonomy_id.*\)) AND/", $query, $matches)) {
                    $query = str_replace($matches[1], '(' . $matches[1] . " OR {$wpdb->posts}.post_author NOT IN (" . implode(',', $authorArr) . ' ) ) ', $query);
                } else {
                    $query .= " AND {$wpdb->posts}.post_author NOT IN (" . implode(',', $authorArr) . ") ";
                }
            } else {
                if (preg_match("/AND (\(.*term_taxonomy_id.*\)) AND/", $query, $matches)) {
                    $query = str_replace($matches[1], '(' . $matches[1] . " OR {$wpdb->posts}.post_author IN (" . implode(',', $authorArr) . ' ) ) ', $query);
                } else {
                    $query .= " AND {$wpdb->posts}.post_author IN (" . implode(',', $authorArr) . ") ";
                }
            }
        }
        return $query;
    }

}

/**
 * Get loader image
 * @since 2.0
 * @global $bdp_settings
 */
if(!function_exists('bdp_get_loader')) {
    function bdp_get_loader($bdp_settings) {
        $loader = '';
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
        if(isset($bdp_settings['loader_type'])){
            if($bdp_settings['loader_type'] == 1) {
                $loading = (isset($bdp_settings['bdp_loader_image_src']) && $bdp_settings['bdp_loader_image_src'] != '') ? $bdp_settings['bdp_loader_image_src'] : BLOGDESIGNERPRO_URL . '/images/loading.gif';
                $loader = '<img src="' . $loading . '" alt="' . esc_attr__('Loading Image', BLOGDESIGNERPRO_TEXTDOMAIN) . '" style="display: none" class="loading-image" />';
            } else {
                $loader_style_hidden = isset($bdp_settings['loader_style_hidden']) ? $bdp_settings['loader_style_hidden'] : 'circularG';
                $loading = $loaders[$loader_style_hidden];
                $loader = '<div style="display: none" class="loading-image" >'.$loading.'</div>';
            }
        } else {
            $loader = '<img src="' . BLOGDESIGNERPRO_URL . '/images/loading.gif" alt="' . esc_attr__('Loading Image', BLOGDESIGNERPRO_TEXTDOMAIN) . '" style="display: none" class="loading-image" />';
        }
        return $loader;
    }
}


/**
 * get parameter array for archive posts query
 * @param array $bdp_settings
 * @return array parameters for posts query
 * @since 2.0
 */
if(!function_exists('bdp_get_archive_wp_query')) {
    function bdp_get_archive_wp_query($bdp_settings) {
        global $wp_query;
        $posts_per_page = isset($bdp_settings['posts_per_page']) ? $bdp_settings['posts_per_page'] : 5;
        $orderby = 'date';
        $order = 'DESC';
        if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
            $orderby = $bdp_settings['bdp_blog_order_by'];
        if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
            $order = $bdp_settings['bdp_blog_order'];
        $paged = bdp_paged();
        $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';
        $post_author = isset($bdp_settings['template_author']) ? $bdp_settings['template_author'] : array();

        if (isset($bdp_settings['custom_archive_type']) && $bdp_settings['custom_archive_type'] == 'category_template') {
            if ($orderby == 'meta_value_num') {
                $orderby_str = $orderby . ' date';
            } else {
                $orderby_str = $orderby;
            }
            $cat = $wp_query->get_queried_object_id();

            $arg_posts = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'orderby' => $orderby_str,
                'order' => $order,
                'paged' => $paged,
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
        } elseif (isset ($bdp_settings['custom_archive_type']) && $bdp_settings['custom_archive_type'] == 'tag_template') {

            $tag = $wp_query->get_queried_object_id();
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

        if (isset($bdp_settings['custom_archive_type']) && $bdp_settings['custom_archive_type'] == 'date_template') {
            $arg_posts['date_query'] = $wp_query->query;
        }

        if (isset($bdp_settings['custom_archive_type']) && $bdp_settings['custom_archive_type'] == 'author_template') {
            $arg_posts['author__in'] = $wp_query->query_vars['author'];
        }

        if (isset($bdp_settings['custom_archive_type']) && $bdp_settings['custom_archive_type'] == 'search_template') {
            $arg_posts['s'] = $_GET['s'];
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

        return $arg_posts;
    }
}


add_filter( 'coauthors_posts_link', 'bdp_coauthors_posts_link' );

if(!function_exists('bdp_coauthors_posts_link')) {
    function bdp_coauthors_posts_link($args) {
        $args['class'] = 'url fn';
        return $args;
    }
}

/**
 * get post author
 * @param $post_id, $bdp_settings
 * @return array post authors
 * @since 2.0
 */
if(!function_exists('bdp_get_post_auhtors')) {
    function bdp_get_post_auhtors($post_id, $bdp_settings) {
        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
        $authors = '';
        if ( function_exists( 'coauthors_posts_links' ) ) {
            $authors = coauthors_posts_links(',', ', ', null, null, false);
            $authors = (!$author_link) ? strip_tags($authors) : $authors;
        } else {
            $authors .= ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" >' : '';
            $authors .= get_the_author();
            $authors .= ($author_link) ? '</a>' : '';
        }
        return $authors;
    }
}

/**
 * display text domain notice
 * @since 2.0
 */
if (!function_exists('bdp_change_text_domain_notice')) {

    function bdp_change_text_domain_notice() {
        echo '<div class="updated notice is-dismissible bdp-admin-notice-change-textdomain"><p>';
        ?>
        <strong><?php _e('Blog Designer PRO plugin Text Domain Change', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong>&nbsp;&nbsp;&nbsp;
        <p><?php echo __('Since Blog Designer PRO plugin version 2.0, we changed text-domain to "', BLOGDESIGNERPRO_TEXTDOMAIN) . '<i><u>' . __('blog-designer-pro', BLOGDESIGNERPRO_TEXTDOMAIN) . '</u></i>' . __('". If you are using translated .po/.mo file with Blog Designer PRO plugin for localization then kindly rename that file name to', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>' . __('blog-designer-pro.po', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> & <b>' . __('blog-designer-pro.mo', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('and update your .po file with latest .pot file.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
        <p> <?php _e('If you have any query, feel free to ', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <a href="<?php echo esc_url('http://support.solwininfotech.com/'); ?>" target="_blank"> <?php _e('contact us', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </a></p>
        <button class="notice-dismiss bdp-change-textdomian-notice-dismiss" type="button">
            <span class="screen-reader-text"><?php _e('Dismiss this notice.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
        </button>
        <?php
        echo "</p></div>";
    }

}

/**
 * Check file version
 * @since 2.0
 * @param $template_path
 * @return $version
 */
if (!function_exists('bdp_check_file_version')) {

    function bdp_check_file_version($template_path) {

        if (!file_exists($template_path)) {
            return;
        }

        // We don't need to write to the file, so just open for reading.
        $fp = fopen($template_path, 'r');

        // Pull only the first 8kiB of the file in.
        $file_data = fread($fp, 8192);

        // PHP will close file handle, but we are good citizens.
        fclose($fp);

        // Make sure we catch CR-only line endings.
        $file_data = str_replace("\r", "\n", $file_data);
        $version = '';

        if (preg_match('/^[ \t\/*#@]*' . preg_quote('@version', '/') . '(.*)$/mi', $file_data, $match) && $match[1]) {
            $version = _cleanup_header_comment($match[1]);
        }

        return $version;
    }

}

 /**
 * display outdated files notice
 * @since 2.0
 */
if (!function_exists('bdp_template_outdated_notice')) {

    function bdp_template_outdated_notice() {
        if(!isset($_GET['page'])) {
            return;
        }
        $bdp_layout = __('Layouts', BLOGDESIGNERPRO_TEXTDOMAIN);
        if($_GET['page'] == 'layouts' || $_GET['page'] == 'add_shortcode') {
            $bdp_layout = __('Blog Layouts', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        if($_GET['page'] == 'archive_layouts' || $_GET['page'] == 'bdp_add_archive_layout') {
            $bdp_layout = __('Post Archive Layouts', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        if($_GET['page'] == 'single_layouts' || $_GET['page'] == 'single_post') {
            $bdp_layout = __('Single Post Layouts', BLOGDESIGNERPRO_TEXTDOMAIN);
        }
        $active_theme = wp_get_theme();
        $active_theme_name = $active_theme->get('Name');
        echo '<div class="updated notice is-dismissible bdp-admin-notice-template-outdated" data-page=" '. $_GET['page'] .'"><p>';
        ?>
        <strong><?php echo __('Your theme', BLOGDESIGNERPRO_TEXTDOMAIN) .' ('.$active_theme_name.') '. __('not compatible or contains outdated copies of some Blog Designer template files.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></strong>&nbsp;&nbsp;&nbsp;
        <p> <?php echo __('These files may required to design your', BLOGDESIGNERPRO_TEXTDOMAIN) .' "'. $bdp_layout .'" '. __('with the current version of Blog Designer PRO. You can see which files are required or outdated from the theme.', BLOGDESIGNERPRO_TEXTDOMAIN) .' <a href="'. esc_url(admin_url('admin.php?page=bdp_getting_started&tab=system_status#bdp_templates_status')) .'"> '. __('Click here', BLOGDESIGNERPRO_TEXTDOMAIN) .'</a>'; ?></p>
        <p> <?php _e('If you have an any query, feel free to create a support ticket on our ', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <a href="<?php echo esc_url('http://support.solwininfotech.com/'); ?>" target="_blank"> <?php _e('support portal', BLOGDESIGNERPRO_TEXTDOMAIN) ?> </a> </p>
        <button class="notice-dismiss bdp-outdated-template-notice-dismiss" type="button">
            <span class="screen-reader-text"><?php _e('Dismiss this notice.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
        </button>
        <?php
        echo "</p></div>";
    }

}


/**
 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
 * @since 2.0
 * @param $size
 * @return int $ret
 */
if (!function_exists('bdp_let_to_num')) {

    function bdp_let_to_num($size) {
        $l = substr($size, -1);
        $ret = substr($size, 0, -1);
        switch (strtoupper($l)) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        return $ret;
    }

}

/**
 * This function get the active plugins details.
 * @since 2.0
 * @return $acive_plugins
 */
if(!function_exists('bdp_get_active_plugins')) {
    function bdp_get_active_plugins() {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        require_once( ABSPATH . 'wp-admin/includes/update.php' );

        if ( ! function_exists( 'get_plugin_updates' ) ) {
            return array();
        }

        $active_plugins = (array) get_option( 'active_plugins', array() );

        if ( is_multisite() ) {
            $network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
            $active_plugins = array_merge( $active_plugins, $network_activated_plugins );
        }
        $active_plugins_data = array();
        $available_updates   = get_plugin_updates();

        foreach ( $active_plugins as $plugin ) {
            $version_latest = '';
            $data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
            if(isset( $available_updates[ $plugin ]->update->new_version )) {
                $version_latest = $available_updates[ $plugin ]->update->new_version;
            }

            $active_plugins_data[] = array(
                'plugin'            => $plugin,
                'name'              => $data['Name'],
                'version'           => $data['Version'],
                'version_latest'    => $version_latest,
                'url'               => $data['PluginURI'],
                'author_name'       => $data['AuthorName'],
                'author_url'        => esc_url_raw( $data['AuthorURI'] ),
                'network_activated' => $data['Network'],
            );
        }

        return $active_plugins_data;
    }
}

/**
 * This function get the theme details.
 * @since 2.0
 * @return $acive_plugins
 */
if (!function_exists('bdp_get_theme_info')) {

    function bdp_get_theme_info() {
        $active_theme = wp_get_theme();
        if (is_child_theme()) {
            $parent_theme = wp_get_theme($active_theme->Template);
            $parent_theme_info = array(
                'parent_name' => $parent_theme->Name,
                'parent_version' => $parent_theme->Version,
                'parent_author_url' => $parent_theme->{'Author URI'},
            );
        } else {
            $parent_theme_info = array('parent_name' => '', 'parent_version' => '', 'parent_version_latest' => '', 'parent_author_url' => '');
        }

        $active_theme_info = array(
            'name' => $active_theme->Name,
            'version' => $active_theme->Version,
            'author_url' => esc_url_raw($active_theme->{'Author URI'}),
            'is_child_theme' => is_child_theme(),
        );

        return array_merge($active_theme_info, $parent_theme_info);
    }

}


add_filter('display_post_states', 'bdp_add_post_states', 10, 2);
/**
 * add page state
 * @param $post_states, $post
 */
if (!function_exists('bdp_add_post_states')) {

    function bdp_add_post_states($post_states, $post) {
        $bdp_data = get_bdp_blog_data();
        if($bdp_data != '') {
        if (array_key_exists($post->ID, $bdp_data)) {
            $bdp_page = $post->ID;
            $post_states[$bdp_page] = $bdp_data[$post->ID]['name'];
        }
        }
        return $post_states;
    }

}


/**
 * Get Blog layout data
 * @global $wpdb
 */
if (!function_exists('get_bdp_blog_data')) {

    function get_bdp_blog_data() {
        global $wpdb;
        $bdp_data = array();
        $shortcodes = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes ');
        if ($shortcodes) {
            foreach ($shortcodes as $shortcode) {
                $allsettings = $shortcode->bdsettings;
                if (is_serialized($allsettings)) {
                    $bdp_settings = unserialize($allsettings);
                }
                $bdp_page = (isset($bdp_settings['blog_page_display']) && $bdp_settings['blog_page_display'] > 0) ? $bdp_settings['blog_page_display'] : -1;
                $name = ($shortcode->shortcode_name != '') ? $shortcode->shortcode_name : __('Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN);
                if ($bdp_page > 0) {
                    $bdp_data[$bdp_page] = array(
                        'name' => $name,
                    );
                }
            }
        }
        return $bdp_data;
    }

}

/**
 * Hide custom taxonomy
 * @param $taxonomy_names
 */
add_filter('bdp_hide_taxonomies', 'bdp_hide_taxonomies', 10);
if (!function_exists('bdp_hide_taxonomies')) {

    function bdp_hide_taxonomies($taxonomy_names) {
        foreach ($taxonomy_names as $taxonomy_i => $taxonomy_name) {
            if (!empty($taxonomy_name)) {
                if ($taxonomy_name->show_ui != '1') {
                    unset($taxonomy_names[$taxonomy_i]);
                }
            }
        }
        return $taxonomy_names;
    }

}
