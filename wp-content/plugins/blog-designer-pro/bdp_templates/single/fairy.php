<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/fairy.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_fairy_template', 10, 1);

if (!function_exists('bdp_single_fairy_template')) {

    /**
     * add html for fairy template
     * @global object $post
     * @return html display fairy design
     */
    function bdp_single_fairy_template($bdp_settings) {
        global $post;
        $has_thumbnail = true;
        ?>
        <div class="blog_template bdp_blog_template fairy">
            <?php
            do_action('bdp_before_single_post_content');

            $display_author = $bdp_settings['display_author'];
            $display_date = $bdp_settings['display_date'];
            $display_comment = $bdp_settings['display_comment'];
            $display_postlike = $bdp_settings['display_postlike'];
            $display_post_views = $bdp_settings['display_post_views'];
            $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
            if ($display_title == 1) {
                ?>
                <h1 class="post-title">
                    <?php echo get_the_title(); ?>
                </h1>
                <?php
            }

            if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
                ?>
                <div class="bdp-post-image">
                    <div class="post-thumbnail-cover">
                        <?php
                        $single_post_image = bdp_get_the_single_post_thumbnail($bdp_settings, get_post_thumbnail_id(), get_the_ID());
                        echo apply_filters('bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID());
                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                            echo bdp_pinterest($post->ID);
                        }
                        ?>
                        <div class="post-img-overlay"></div>
                    </div>
                    <?php
                    if ($display_author == 1 || $display_date == 1) {
                        echo '<div class="post-meta-cover">';
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        if ($display_author == 1) {
                            echo '<div class="author-avatar">';
                            echo ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' : '';
                            echo get_avatar(get_the_author_meta('ID'), 60);
                            echo ($author_link) ? '</a>' : '';
                            echo '</div>';
                        }
                        echo '<div class="post-meta-wrapp">';
                        if ($display_author == 1) {
                            echo '<div class="author-name">';
                            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                            echo '</div>';
                        }
                        if ($bdp_settings['display_date'] == 1) {
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            ?>
                            <div class="mdate">
                                <?php
                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                ?>
                            </div>
                            <?php
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <?php
            } else {
                $has_thumbnail = false;
                if ($display_author == 1 || $display_date == 1) {
                    ?>
                    <div class="post-meta">
                        <?php
                        if ($display_author == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <span class="author">
                                <?php
                                echo ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' : '';
                                echo __('by', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ';
                                echo get_the_author();
                                echo ($author_link) ? '</a>' : '';
                                ?>
                            </span>
                            <?php
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
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');

                                echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                echo ($date_link) ? '</a>' : '';
                                ?>
                            </span>
                            <?php
                        }
                        if ($display_comment != 1 && $display_postlike != 1 && $display_post_views == 0) {
                            echo '</div>';
                        }
                    }
                }

                if ($display_comment == 1 || $display_postlike == 1 || $display_post_views != 0) {
                    if ($has_thumbnail) {
                        echo '<div class="post-meta">';
                    }
                    if ($display_comment == 1) {
                        ?>
                        <span class="post-comment">
                            <?php
                            if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                            } else {
                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
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
                            echo '<div class="display_post_views">';
                            echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                            echo '</div>';
                        }
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
            if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                echo '<div class="post-meta-cats-tags">';
            }

            if ($bdp_settings['display_category'] == 1) {
                ?>
                <div class="category-link">
                    <span class="link-lable"> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
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
                </div>
                <?php
            }

            if ($bdp_settings['display_tag'] == 1) {
                $tags_lists = get_the_tags();

                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true;

                if (!empty($tags_lists)) {
                    echo '<div class="post-tags">';
                    echo '<span class="link-lable">' . __('Tags: ', BLOGDESIGNERPRO_TEXTDOMAIN) . '</span>';
                    echo '<div class="post-tags-wrapp">';
                    foreach ($tags_lists as $tags_list) {
                        echo '<span class="tag">';
                        if ($tag_link) {
                            echo '<a rel="tag" href="' . get_tag_link($tags_list->term_id) . '">';
                        }
                        echo $tags_list->name;
                        if ($tag_link) {
                            echo '</a>';
                        }
                        echo '</span>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
            }

            if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                echo '</div>';
            }

            ?>
            <div class="post-share-div">
                <?php
                if (is_single()) {
                    do_action('bdp_social_share_text', $bdp_settings);
                }
                bdp_get_social_icons($bdp_settings);
                ?>
            </div>
            <?php

            do_action('bdp_after_single_post_content');
            ?>
        </div>
        <?php
        add_action('bdp_author_detail', 'bdp_display_author_image', 5, 1);
        add_action('bdp_author_detail', 'bdp_display_author_content_cover_start', 10, 1);
        add_action('bdp_author_detail', 'bdp_display_author_name', 15, 4);
        add_action('bdp_author_detail', 'bdp_display_author_biography', 20, 2);
        add_action('bdp_author_detail', 'bdp_display_author_social_links', 25, 4);
        add_action('bdp_author_detail', 'bdp_display_author_content_cover_end', 30, 2);
        add_action('bdp_related_post_detail', 'bdp_related_post_title', 5, 4);
        add_action('bdp_related_post_detail', 'bdp_related_post_item', 10, 9);
    }

}