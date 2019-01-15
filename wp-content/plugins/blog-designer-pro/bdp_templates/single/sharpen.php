<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/sharpen.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_single_design_format_function', 'bdp_single_sharpen_template', 10, 1);
if (!function_exists('bdp_single_sharpen_template')) {

    /**
     * add html for sharpen template
     * @global object $post
     * @return html display sharpen design
     */
    function bdp_single_sharpen_template($bdp_settings) {
        global $post;
        $has_cat = 'bdp_has_cat';
        ?>
        <div class="blog_template bdp_blog_template box-template sharpen">
            <?php do_action('bdp_before_single_post_content');

            if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) { ?>
                <div class="bdp-post-image">
                    <?php
                    $single_post_image = bdp_get_the_single_post_thumbnail($bdp_settings, get_post_thumbnail_id(), get_the_ID());
                    echo apply_filters('bdp_single_post_thumbnail_filter', $single_post_image, get_the_ID());
                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                        echo bdp_pinterest($post->ID);
                    }
                    ?>
                </div>
                <?php
            }
            if (has_post_thumbnail()) {

                if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {
                    $categories_list = get_the_category_list(', ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list){
                        ?>
                        <div class="category-list-wrap">
                            <div class="category-main-wrap">
                                <div class="category-list category-main <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <?php
                                    echo ' ';
                                    print_r($categories_list);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    $has_cat = 'bdp_no_cat';
                }
            } else { ?>
                <div class="metadatabox">
                    <?php
                    if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        ?>
                        <div class="metacats category-list <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                            <?php
                            if ($categories_link) {
                                $categories_list = strip_tags($categories_list);
                            }
                            if ($categories_list):
                                print_r($categories_list);
                            endif;
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>

            <div class="blog_header <?php
            if (has_post_thumbnail()) {
                echo "blog_header_img";
            }
            echo ' '. $has_cat;
            ?>">
                     <?php
                     $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
                     if ($display_title == 1) {
                         ?>
                    <h1 class="post-title">
                        <?php echo get_the_title(); ?>
                    </h1>
                    <?php
                }


                if ($bdp_settings['display_date'] == 1 || $bdp_settings['display_author'] == 1 ||
                        $bdp_settings['display_tag'] == 1 || $bdp_settings['display_comment'] == 1 || $bdp_settings['display_comment'] == 1) {
                    ?>
                    <div class="meta_data_box metadatabox">
                        <?php
                        if (isset($bdp_settings['display_author']) && $bdp_settings['display_author'] == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <div class="metauser <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no-links'; ?>">
                                <span class="link-lable">
                                <i class="fas fa-user"></i>
                                <?php _e('Posted by', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </div>
                            <?php
                        }
                        if (isset($bdp_settings['display_date']) && $bdp_settings['display_date'] == 1) {
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            ?>
                            <div class="metadate">
                                <span class="mdate"><i class="far fa-calendar-alt"></i>
                                    <?php
                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </span>
                            </div>
                            <?php
                        }
                        if (isset($bdp_settings['display_comment']) && $bdp_settings['display_comment'] == 1) {
                            ?>
                            <div class="metacomments">
                                <i class="fas fa-comment"></i>
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                } else {
                                    comments_popup_link(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' .__('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <span class="link-lable"> <i class="fas fa-tags"></i> </span>
                                    <?php print_r($tags_list); ?>
                                </div>
                                <?php
                            endif;
                        }
                        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                            echo do_shortcode('[likebtn_shortcode]');
                        }
                        ?>
                    </div>
                <?php } ?>
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
                if (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] != 0) {
                    if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                        echo '<div class="display_post_views">';
                        echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <?php
            if (is_single()) {
                do_action('bdp_social_share_text', $bdp_settings);
            }
            bdp_get_social_icons($bdp_settings);

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