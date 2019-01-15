<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/minimal.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_minimal_template', 10, 1);

if (!function_exists('bdp_single_minimal_template')) {

    /**
     * add html for minimal template
     * @global object $post
     * @return html display minimal design
     */
    function bdp_single_minimal_template($bdp_settings) {
        global $post;
        ?>
        <div class="blog_template bdp_blog_template minimal">
            <?php
            do_action('bdp_before_single_post_content');

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
            <?php } ?>

            <div class="post-content-wrapper">
                <?php
                $display_postlike = $bdp_settings['display_postlike'];
                $display_comment_count = $bdp_settings['display_comment'];
                $display_category = $bdp_settings['display_category'];

                if ($display_postlike == 1 || $display_comment_count == 1 || $display_category == 1) {
                    echo '<div class="post-header-meta">';

                    if ($display_postlike == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }

                    if ($display_comment_count == 1) {
                        if (comments_open() || get_comments_number()) {
                            $comment_link = isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1 ? true : false;
                            ?>
                            <span class="post-comment <?php echo ($comment_link) ? 'no-bdp-links' : ''; ?>">
                                <i class="fas fa-comment-o"></i>
                                <?php
                                if ($comment_link) {
                                    comments_number('0', '1', '%');
                                } else {
                                    comments_popup_link('0', '1', '%');
                                }
                                ?>
                            </span>
                            <?php
                        }
                    }

                    if ($display_category == 1) {
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? false : true;
                        $categories_list = get_the_category();
                        if (!empty($categories_list)) {
                            echo '<div class="post-category-wrapp">';
                            foreach ($categories_list as $category_list) {
                                echo '<span class="post-category">';
                                if ($categories_link) {
                                    echo '<a rel="tag" href="' . get_category_link($category_list->term_id) . '">';
                                }
                                echo $category_list->name;
                                if ($categories_link) {
                                    echo '</a>';
                                }
                                echo '</span>';
                            }
                            echo '</div>';
                        }
                    }

                    echo '</div>';
                }

                $display_title = isset($bdp_settings['display_title']) ? $bdp_settings['display_title'] : 1;
                if ($display_title == 1) {
                    ?>
                    <h1 class="post-title">
                    <?php echo get_the_title(); ?>
                    </h1>
                    <?php
                }

                $display_author = $bdp_settings['display_author'];
                $display_date = $bdp_settings['display_date'];
                if ($display_author == 1 || $display_date == 1) {
                    echo '<div class="bdp-post-meta">';
                    if ($display_author == 1) {
                        ?>
                        <span class="author">
                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                        </span>
                        <?php
                    }

                    if ($bdp_settings['display_date'] == 1) {
                        echo ' / ';
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
                            echo $bdp_date;
                            echo ($date_link) ? '</a>' : '';
                            ?>
                        </span>
                        <?php
                    }
                    echo '</div>';
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
                    echo '<div class="post-footer-meta">';

                    if ($display_tag == 1) {
                        $tags_lists = get_the_tags();

                        $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true;
                        $tag_class = ($tag_link) ? 'bdp-has-link' : 'bdp-no-links';
                        if (!empty($tags_lists)) {
                            echo '<div class="post-tags">';
                            _e('Popular Tags: ', BLOGDESIGNERPRO_TEXTDOMAIN);
                            echo '<div class="post-tags-wrapp '. $tag_class .'">';
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

                    if ($display_post_views != 0) {
                        if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                            echo '<div class="display_post_views">';
                            echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                            echo '</div>';
                        }
                    }

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

            </div>

        <?php do_action('bdp_after_single_post_content'); ?>
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
