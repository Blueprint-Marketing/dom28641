<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/cover.php.
 * @author  Solwin Infotech
 * @version 2.0
 */


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_cover_template', 10, 1);

if (!function_exists('bdp_single_cover_template')) {

    /**
     * add html for cover template
     * @global object $post
     * @return html display cover design
     */
    function bdp_single_cover_template($bdp_settings) {
        global $post;
        ?>
        <div class="blog_template bdp_blog_template cover">
            <?php
            do_action('bdp_before_single_post_content');

            if ($bdp_settings['display_category'] == 1) {
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                ?>
                <div class="category-link<?php echo ($categories_link) ? ' categories_link' : ''; ?>">
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list):
                        echo ' ';
                        print_r($categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </div>
                <?php
            }

            $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
            if ($display_title == 1) {
                ?>
                <h1 class="post-title">
                    <?php echo get_the_title(); ?>
                </h1>
                <?php
            }

            $display_author = $bdp_settings['display_author'];
            $display_date = $bdp_settings['display_date'];
            $display_comment = $bdp_settings['display_comment'];
            $display_postlike = $bdp_settings['display_postlike'];
            if ($display_author == 1 || $display_date == 1 || $display_comment == 1 || $display_postlike == 1) {
                ?>
                <div class="post-meta">
                    <?php
                    if ($display_author == 1) {
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        echo '<span class="author">';
                        echo '<span class="author-avatar">';
                        echo ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' : '';
                        echo get_avatar(get_the_author_meta('ID'), 61);
                        echo ($author_link) ? '</a>' : '';
                        echo '</span>';

                        echo '<span class="author-name">';
                        echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                        echo '</span>';
                        echo '</span>';
                    }

                    if ($display_date == 1) {
                        $ar_year = get_the_time('Y');
                        $ar_month = get_the_time('m');
                        $ar_day = get_the_time('d');
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        ?>
                        <span class="date-meta">
                            <?php
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');

                            echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                            echo '<i class="far fa-clock"></i>';
                            echo $bdp_date;
                            echo ($date_link) ? '</a>' : '';
                            ?>
                        </span>
                        <?php
                    }

                    if ($display_postlike == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }

                    if ($display_comment == 1) {
                        ?>
                        <span class="post-comment">
                            <i class="fas fa-comment"></i>
                            <?php
                            if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ',  '% ');
                            } else {
                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '1', '% ', 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                            }
                            ?>
                        </span>
                        <?php
                    }

                    ?>
                </div>
                <?php
            }

            if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
                ?>
                <div class="bdp-post-image">
                    <?php
                    $single_post_image = bdp_get_the_single_post_thumbnail($bdp_settings, get_post_thumbnail_id(), get_the_ID());
                    echo apply_filters('bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID());
                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                        echo bdp_pinterest($post->ID);
                    }
                    ?>
                </div>
                <?php
            }

            ?>
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

            $display_tag = $bdp_settings['display_tag'];
            $display_post_views = $bdp_settings['display_post_views'];
            if ($display_tag == 1 || $display_post_views != 0) {
                ?>
                <div class="post-footer-meta">
                    <?php
                    if ($display_tag == 1) {
                        $tags_list = get_the_tag_list('', ', ');
                        $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                        if ($tag_link) {
                            $tags_list = strip_tags($tags_list);
                        }
                        if ($tags_list):
                            ?>
                            <div class="tags">
                                <span class="link-lable"> <?php _e('Popular Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
                                <?php
                                print_r($tags_list);
                                $show_sep = true;
                                ?>
                            </div>
                            <?php
                        endif;
                    }

                    if ($display_post_views != 0) {
                        if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                            echo '<div class="display_post_views">';
                            echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
                <?php
            }
            $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
            if($social_share) {
                if (($bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                            ( $bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                            ( isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) || ( $bdp_settings['pinterest_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) ||
                            ( isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) ||
                            ( isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) ||
                            ( isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) ||
                            ( isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) ||
                            ( $bdp_settings['whatsapp_link'] == 1)) {
                    echo '<div class="social-share-cover">';
                        if (is_single()) {
                            do_action('bdp_social_share_text', $bdp_settings);
                        }
                        bdp_get_social_icons($bdp_settings);
                    echo '</div>';
                }
            }

            do_action('bdp_before_single_post_content');
            ?>
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