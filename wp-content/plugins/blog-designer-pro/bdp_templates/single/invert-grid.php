<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/invert-grid.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_single_design_format_function', 'bdp_single_invert_grid_template', 10, 1);
if (!function_exists('bdp_single_invert_grid_template')) {

    /**
     * add html for invert-grid template
     * @global object $post
     * @return html display invert-grid design
     */
    function bdp_single_invert_grid_template($bdp_settings) {
        global $post;
        ?>
        <div class="blog_template bdp_blog_template invert-grid">
            <?php do_action('bdp_before_single_post_content'); ?>
            <div class="post-body-div">
                <?php
                $class = '';
                if (isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1 && has_post_thumbnail()) {
                    ?>
                    <div class="bdp-post-image">
                        <?php
                        $single_post_image = bdp_get_the_single_post_thumbnail($bdp_settings, get_post_thumbnail_id(), get_the_ID());
                        echo apply_filters('bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID());
                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                            ?>
                            <div class="bdp-pinterest-share-image">
                                <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                                <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    $class = "no_thumb";
                }
                ?>

                <?php
                if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {
                    ?>
                    <span class="category-link <?php echo $class; ?>">
                        <?php
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            echo ' ';
                            print_r($categories_list);
                            $show_sep = true;
                        endif;
                        ?>
                    </span>
                    <?php
                }
                ?>

                <div class="header-meta">
                    <div class="metadatabox">
                        <?php
                        if (isset($bdp_settings['display_date']) && $bdp_settings['display_date'] == 1) {
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            ?>
                            <div class="mdate">
                                <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : ''; ?>
                                <span class="mdate-month"> <?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('M') : get_the_time('M'); ?> </span>
                                <span class="mdate-day"> <?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('d') : get_the_time('d'); ?> </span>
                                <?php echo ($date_link) ? '</a>' : ''; ?>
                            </div>
                            <?php
                        }


                        echo '<div class="header-metadatabox">';

                        $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
                        if ($display_title == 1) {
                            ?>
                            <h1 class="post-title <?php echo $class; ?>" title="<?php echo get_the_title(); ?>">
                                <?php echo get_the_title(); ?>
                            </h1>
                            <?php
                        }

                        if ($bdp_settings['display_author'] && $bdp_settings['display_author'] == 1) {
                            echo '<div class="post-author-box">';
                            _e('Posted By: ', BLOGDESIGNERPRO_TEXTDOMAIN);
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <span class="post-author <?php echo ($author_link) ? 'bdp-has-links' : 'bdp-no-links'; ?>">
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </span>
                            <?php
                            echo '</div>';
                        }
                        if (isset($bdp_settings['display_comment']) && $bdp_settings['display_comment'] == 1) {
                            ?>
                            <div class="metacomments-box">
                                <span class="metacomments">
                                    <?php
                                    if (get_comments_number() != 0) {
                                        echo __('Comments: ', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    }
                                    if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                        $id = get_the_ID();
                                        $number = get_comments_number($id);
                                        if (0 == $number && !comments_open() && !pings_open()) {
                                            echo __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        } else {
                                            comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1, '%');
                                        }
                                    } else {
                                        comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1, '%', 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                    }
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                            echo do_shortcode('[likebtn_shortcode]');
                        }

                        if (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] != 0) {
                            if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                                echo '<div class="display_post_views">';
                                echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                                echo '</div>';
                            }
                        }
                        echo '</div>';
                        ?>
                    </div>
                </div>

                <div class="post_content entry-content">
                    <?php
                    if (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] == 1) {
                        $content = bdp_add_first_letter_structure(get_the_content());
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        echo $content;
                    } else {
                        the_content();
                    }
                    ?>
                </div>
                <?php
                $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
                if (($bdp_settings['display_tag'] == 1) || ($social_share && (
                            ( $bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                            ( $bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                            ( isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) ||
                            ( $bdp_settings['pinterest_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) ||
                            ( isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) ||
                            ( isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) ||
                            ( isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) ||
                            ( isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) ||
                            ( $bdp_settings['whatsapp_link'] == 1)))) {
                    ?>
                    <div class="footer_metabox">
                        <?php
                        if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo ($tag_link) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
                                    <?php
                                    echo '<span class="link-lable">'. __('Tags: ', BLOGDESIGNERPRO_TEXTDOMAIN) .'</span>'   ;
                                    print_r($tags_list);
                                    ?>
                                </div><?php
                            endif;
                        }
                        if (is_single()) {
                            do_action('bdp_social_share_text', $bdp_settings);
                        }
                        bdp_get_social_icons($bdp_settings);
                        ?>
                    </div>
                <?php } ?>
                <?php do_action('bdp_after_single_post_content'); ?>
            </div>
        </div>
        <?php
        add_action('bdp_author_detail', 'bdp_display_author_image', 5, 2);
        add_action('bdp_author_detail', 'bdp_display_author_content_cover_start', 10, 2);
        add_action('bdp_author_detail', 'bdp_display_author_name', 15, 4);
        add_action('bdp_author_detail', 'bdp_display_author_biography', 20, 2);
        add_action('bdp_author_detail', 'bdp_display_author_social_links', 25, 4);
        add_action('bdp_author_detail', 'bdp_display_author_content_cover_end', 30, 2);
        add_action('bdp_related_post_detail', 'bdp_related_post_title', 5, 4);
        add_action('bdp_related_post_detail', 'bdp_related_post_item', 10, 9);
    }

}