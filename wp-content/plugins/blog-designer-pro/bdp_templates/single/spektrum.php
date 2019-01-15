<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/spektrum.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_single_design_format_function', 'bdp_single_spektrum_template', 10, 1);
if (!function_exists('bdp_single_spektrum_template')) {

    /**
     * add html for spectrum template
     * @global object $post
     * @return html display spectrum design
     */
    function bdp_single_spektrum_template($bdp_settings) {
        global $post;
        ?>
        <div class="blog_template bdp_blog_template spektrum">
            <?php
            if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
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
                    <?php } ?>
                </div><?php
            }
            ?>
            <div class="blog_header" <?php
            if ($bdp_settings['display_date'] == 0) {
                echo 'style="padding-left:0;"';
            }
            ?>>

                <?php
                if ($bdp_settings['display_date'] == 1) {
                    $ar_year = get_the_time('Y');
                    $ar_month = get_the_time('m');
                    $ar_day = get_the_time('d');
                    $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                    ?>
                    <div class="post_date">
                        <?php echo ($date_link) ? '<a class="date" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '<span class="date">'; ?>
                        <?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('d') : get_the_time('d'); ?>
                        <span class="number-date">
                            <?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('F') : get_the_time('F'); ?>
                        </span>
                        <?php echo ($date_link) ? '</a>' : '</span>'; ?>
                    </div>
                    <div class="meta_tags">
                        <?php
                    }
                    ?>
                    <div <?php
                    if ($bdp_settings['display_date'] == 0) {
                        echo 'style="border:medium none;padding-left:0;"';
                    }
                    ?>>
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

                    </div>
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
                if (isset($bdp_settings['display_post_views']) && $bdp_settings['display_post_views'] != 0) {
                    if (bdp_get_post_views(get_the_ID(), $bdp_settings) != '') {
                        echo '<div class="display_post_views">';
                        echo bdp_get_post_views(get_the_ID(), $bdp_settings);
                        echo '</div>';
                    }
                }
                ?>
            </div>
            <div class="post-meta-div post-bottom">
                <?php
                if ($bdp_settings['display_category'] == 1) {
                    $categories_list = get_the_category_list(' , ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    ?>
                    <span class="categories <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                        <span class="link-lable"> <i class="fas fa-folder-open"></i> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
                        <?php
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            echo ' ';
                            print_r($categories_list);
                            echo ' ';
                            $show_sep = true;
                        endif;
                        ?>
                    </span>
                    <?php
                }

                if ($bdp_settings['display_author'] == 1) {
                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                    ?>
                    <span class="post-by <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                        <span class="link-lable">
                            <i class="fas fa-user"></i>
                            <?php echo _e('By ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                        </span>
                        <span>
                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                        </span>
                    </span>
                    <?php
                }
                if ($bdp_settings['display_tag'] == 1) {
                    $tags_list = get_the_tag_list('', ' , ');
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                    if ($tag_link) {
                        $tags_list = strip_tags($tags_list);
                    }
                    if ($tags_list):
                        ?>
                        <span class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'?>">
                            <span class="link-lable"> <i class="fas fa-tags"></i> </span>
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </span><?php
                    endif;
                }
                if ($bdp_settings['display_comment'] == 1) {
                    if (!post_password_required() && ( comments_open() || get_comments_number() )) {
                        $disable_link_comment = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? true : false;
                        ?>
                        <span class="metacomments <?php echo ($disable_link_comment) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                            <span class="link-lable"> <i class="fas fa-comments-o"></i> </span>
                            <?php
                            if ($disable_link_comment) {
                                $id = get_the_ID();
                                $number = get_comments_number($id);
                                if (0 == $number && !comments_open() && !pings_open()) {
                                    echo __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN);
                                } else {
                                    comments_number(__('0 comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                }
                            } else {
                                comments_popup_link(__('0 comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                            }
                            ?>
                        </span><?php
                    }
                }
                if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                    echo do_shortcode('[likebtn_shortcode]');
                }
                ?>
            </div>
        </div>
        <?php
        if (is_single()) {
            do_action('bdp_social_share_text', $bdp_settings);
        }
        bdp_get_social_icons($bdp_settings);
        do_action('bdp_after_single_post_content');
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