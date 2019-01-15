<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/miracle.php.
 * @author  Solwin Infotech
 * @version 2.1
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_miracle_template', 10, 1);

if(!function_exists('bdp_single_miracle_template')) {

    /**
     * add html for minimal template
     * @global object $post
     * @return html display miracle design
     */
    function bdp_single_miracle_template($bdp_settings) {
        global $post;

        $format = get_post_format($post->ID);
        $post_format = '';
        if ($format == "status") {
            $post_format = 'fas fa-comment';
        } elseif ($format == "aside") {
            $post_format = 'far fa-file-alt';
        } elseif ($format == "image") {
            $post_format = 'far fa-file-image';
        } elseif ($format == "gallery") {
            $post_format = 'far fa-file-images';
        } elseif ($format == "link") {
            $post_format = 'fas fa-link';
        } elseif ($format == "quote") {
            $post_format = 'fas fa-quote-left';
        } elseif ($format == "audio") {
            $post_format = 'fas fa-music';
        } elseif ($format == "video") {
            $post_format = 'fas fa-video';
        } elseif ($format == "chat") {
            $post_format = 'fab fa-weixin';
        } else {
            $post_format = 'fas fa-thumbtack';
        }
        ?>
        <div class="blog_template bdp_blog_template miracle_blog">
            <?php
            do_action('bdp_before_single_post_content');

            echo '<span class="bdp-post-format"><i class="'. $post_format .'"></i></span>';

            $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
            if ($display_title == 1) {
                ?>
                <h1 class="post-title">
                    <?php echo get_the_title(); ?>
                </h1>
                <?php
            }

            $display_date = $bdp_settings['display_date'];
            $display_author = $bdp_settings['display_author'];
            $display_comment = $bdp_settings['display_comment'];
            $display_postlike = $bdp_settings['display_postlike'];
            $display_post_views = $bdp_settings['display_post_views'];

            if($display_date == 1 || $display_author == 1 || $display_comment == 1 || $display_postlike == 1 || $display_post_views != 0) {
                echo '<div class="post-meta">';

                    if ($display_date == 1) {
                        $ar_year = get_the_time('Y');
                        $ar_month = get_the_time('m');
                        $ar_day = get_the_time('d');
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        ?>
                        <span class="date-meta <?php echo ($date_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                            <?php
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');

                            echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                            echo $bdp_date;
                            echo ($date_link) ? '</a>' : '';
                            ?>
                        </span>
                        <?php
                    }

                    if ($display_author == 1) {
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        $author_class = ($author_link) ? 'bdp_has_links' : 'bdp_no_links';
                        echo '<span class="author-name '. $author_class .'">';
                        echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                        echo '</span>';
                    }

                    if ($display_comment == 1) {
                        $disable_link_comment = isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1 ? true : false;
                        ?>
                        <span class="post-comment <?php echo ($disable_link_comment) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                            <?php
                            if ($disable_link_comment == 1) {
                                comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1 . __('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                            } else {
                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1 . __('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                            }
                            ?>
                        </span>
                        <?php
                    }

                    if ($display_postlike == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }

                    if ($display_post_views != 0) {
                        if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                            echo '<span class="display_post_views">';
                            echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                            echo '</span>';
                        }
                    }

                echo '</div>';
            }

            if ((has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) || $display_author == 1) {
                $thumbnail_class = (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) ? 'bdp-has-thumbnail' : 'bdp-no-thumbnail';
                ?>
                <div class="bdp-post-image <?php echo $thumbnail_class; ?>">
                    <?php
                    if($display_author == 1) {
                        ?>
                        <div class="bdp-author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                        </div>
                        <?php
                    }


                    if(has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
                        ?>
                        <figure>
                            <?php
                            $single_post_image = bdp_get_the_single_post_thumbnail($bdp_settings, get_post_thumbnail_id(), get_the_ID());
                            echo apply_filters('bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID());
                            if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                                echo bdp_pinterest($post->ID);
                            }
                            ?>
                        </figure>
                        <?php
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

            if ($bdp_settings['display_category'] == 1) {
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                ?>
                <div class="category-link<?php echo ($categories_link) ? ' bdp_no_links' : ' bdp_has_links'; ?>">
                    <span class="link-lable"> <?php _e('Posted in', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list):
                        echo ' ';
                        print_r($categories_list);
                    endif;
                    ?>
                </div>
                <?php
            }

            if ($bdp_settings['display_tag'] == 1) {
                $tags_list = get_the_tag_list('', ', ');
                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                if ($tag_link) {
                    $tags_list = strip_tags($tags_list);
                }
                if ($tags_list):
                    ?>
                    <div class="tags<?php echo ($tag_link) ? ' bdp_no_links' : ' bdp_has_links'; ?>">
                        <span class="link-lable"> <?php _e('Filed under', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                        <?php print_r($tags_list); ?>
                    </div>
                    <?php
                endif;
            }

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
                    echo '<div class="social-share-cover">';
                        if (is_single()) {
                            do_action('bdp_social_share_text', $bdp_settings);
                        }
                        bdp_get_social_icons($bdp_settings);
                    echo '</div>';
                }
            }

            do_action('bdp_after_single_post_content');
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
