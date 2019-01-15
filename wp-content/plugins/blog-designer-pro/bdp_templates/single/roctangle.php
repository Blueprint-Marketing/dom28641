<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/roctangle.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_roctangle_template', 10, 1);

if (!function_exists('bdp_single_roctangle_template')) {

    /**
     * add html for roctangle template
     * @global object $post
     * @return html display roctangle design
     */
    function bdp_single_roctangle_template($bdp_settings) {
        global $post;
        $thumbnail_class = "bdp-no-thumbnail";
        if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
            $thumbnail_class = "bdp-has-thumbnail";
        }
        ?>
        <div class="blog_template bdp_blog_template roctangle">
                <?php do_action('bdp_before_single_post_content'); ?>
            <div class="post-image-wrap <?php echo $thumbnail_class; ?>">
                <?php if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) { ?>
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
                <div class="post-meta-wrapper">
                    <?php
                    $display_date = $bdp_settings['display_date'];
                    $display_author = $bdp_settings['display_author'];
                    $display_postlike = $bdp_settings['display_postlike'];
                    $display_comment_count = $bdp_settings['display_comment'];
                    $display_post_views = (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] != 0) ? 1 : 0;

                    if ($display_date == 1) {
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        $ar_year = get_the_time('Y');
                        $ar_month = get_the_time('m');
                        $ar_day = get_the_time('d');
                        ?>
                        <div class="post_date">
                            <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">'; ?>
                            <span class="date"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('d') : get_the_time('d'); ?></span>
                                <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('M') : get_the_time('M'); ?></span>
                                <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('Y') : get_the_time('Y'); ?></span>
                            <?php echo ($date_link) ? '</a>' : '</span>'; ?>
                        </div>
                        <?php
                    }

                    if ($display_author == 1 || $display_postlike == 1 || $display_comment_count == 1) {
                        echo '<div class="post-meta-div-cover">';
                        ?> <div class="post-meta-div"> <?php
                        if ($display_author == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                                <span class="author <?php echo ($author_link) ? 'bdp_has_link' : 'bdp_no_links'; ?>">
                                    <i class="fas fa-user"></i>
                                    <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings);?>
                                </span>
                                <?php
                            }

                            if ($display_postlike == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            echo '</div>';
                            if ($display_comment_count == 1) {
                                if (comments_open() || get_comments_number()) {
                                    ?>
                                    <span class="post-comment">
                                        <i class="fas fa-comment-o"></i>
                                        <?php
                                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                            comments_number('0', '1', '%');
                                        } else {
                                            comments_popup_link('0', '1', '%');
                                        }
                                        ?>
                                    </span>
                                    <?php
                                }
                            }

                            if ($display_post_views == 1) {
                                if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                                    echo '<div class="display_post_views">';
                                    echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                                    echo '</div>';
                                }
                            }
                            if (is_single()) {
                                do_action('bdp_social_share_text', $bdp_settings);
                            }
                            bdp_get_social_icons($bdp_settings);
                            ?> </div> <?php
                    }
                    ?>
                </div>

                <div class="post-content-wrapper">
                    <?php
                    $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
                    if ($display_title == 1) {
                        ?>
                        <h1 class="post-title">
                        <?php echo get_the_title(); ?>
                        </h1>
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
                    if ((isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) ||
                            (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1)) {
                        ?>
                        <div class="metadatabox">
                        <?php 
                        if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {                                                           
                            $categories_list = get_the_category();
                            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? false : true;
                            if (!empty($categories_list)) {
                                echo '<div class="post-category-wrapp">';
                                ?> <span class="link-lable"> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span> <?php
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
                                if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
                                    $tags_list = get_the_tag_list('', ', ');
                                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                                    if ($tag_link) {
                                        $tags_list = strip_tags($tags_list);
                                    }
                                    if ($tags_list) {
                                        ?>
                                        <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'?>">
                                            <span class="link-lable"> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                            <?php printf($tags_list); ?>
                                        </div>
                                    <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
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