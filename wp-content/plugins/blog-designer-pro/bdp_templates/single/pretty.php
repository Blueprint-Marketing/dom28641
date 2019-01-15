<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/pretty.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_single_design_format_function', 'bdp_single_pretty_template', 10, 1);
if (!function_exists('bdp_single_pretty_template')) {

    /**
     * add html for region template
     * @global object $post
     * @return html display pretty design
     */
    function bdp_single_pretty_template($bdp_settings) {
        global $post;
        $left_after = '';
        ?>
        <div class="blog_template bdp_blog_template pretty">
            <?php
            do_action('bdp_before_single_post_content');
            ?>
            <div class="entry-container">
                <?php
                if (has_post_thumbnail() && isset($bdp_settings['display_thumbnail']) && $bdp_settings['display_thumbnail'] == 1) {
                    $left_after = 'post-has-image';
                    ?>
                    <div class="bdp-post-image post-has-image">
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
                ?>
                <div class="blog_header">
                    <div class="left-content-wrapper <?php echo $left_after; ?>"></div>
                    <div class="right-content-wrapper">
                        <div class="blog_header_meta_wrapper">
                            <?php
                            $display_title = (isset($bdp_settings['display_title']) && $bdp_settings['display_title'] != '') ? $bdp_settings['display_title'] : 1;
                            if ($display_title == 1) {
                                ?>
                                <h1>
                                    <?php
                                    echo get_the_title();
                                    ?>
                                </h1>
                            <?php } ?>
                            <?php
                            $display_author = $bdp_settings['display_author'];
                            $display_comment_count = $bdp_settings['display_comment'];
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            if ($display_author == 1 || $bdp_settings['display_postlike'] == 1 || $display_comment_count == 1) {
                                ?>
                                <div class="metadatabox">
                                    <?php
                                    if ($bdp_settings['display_author'] == 1) {
                                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                        ?>
                                        <span class="author <?php echo ($author_link) ? 'bdp-has-links' : 'bdp-no-links'; ?>">
                                            <span class="link-lable"><i class="fas fa-user"></i></span>
                                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                        </span>
                                        <?php
                                    }
                                    if ($bdp_settings['display_comment'] == 1) {
                                        if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                                            ?>
                                            <span class="comment">
                                                <span class="icon_cnt">
                                                    <i class="fas fa-comment"></i>
                                                    <?php
                                                    $comment_link = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? false : true;
                                                    bdp_comment_count($comment_link); //comments_popup_link('0', '1', '%');
                                                    ?>
                                                </span>
                                            </span>
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
                        <div class="blog-header-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
                        </div>
                        <?php
                        if ($bdp_settings['display_date'] == 1) {
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            ?>
                            <div class="post_date">
                                <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">'; ?>
                                <span class="date"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('d') : get_the_time('d'); ?></span>
                                <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('F') : get_the_time('F'); ?></span>
                                <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('Y') : get_the_time('Y'); ?></span>
                                <?php echo ($date_link) ? '</a>' : '</span>'; ?>
                            </div>
                        <?php } ?>
                        <div class="post_content">
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
                        if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                            echo '<div class="post-meta-cats-tags">';
                        }
                        if ($bdp_settings['display_category'] == 1) {
                            $categories_list = get_the_category_list(' , ');
                            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                            ?>
                            <div class="category-link <?php echo ($categories_link) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
                                <?php
                                if ($categories_link) {
                                    $categories_list = strip_tags($categories_list);
                                }
                                if ($categories_list):
                                    echo '<span class="link-lable">'. __('Category: ', BLOGDESIGNERPRO_TEXTDOMAIN) .'&nbsp;&nbsp; </span>';
                                    print_r($categories_list);
                                endif;
                                ?>
                            </div>
                            <?php
                        }
                        if ($bdp_settings['display_tag'] == 1) {
                            $tags_list = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? get_the_tag_list('', ', ') : get_the_tag_list('', ' ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo ($tag_link) ? 'bdp-no-links' : 'bdp-has-links'; ?>">
                                    <?php
                                    echo '<span class="link-lable">'. __('Tags: ', BLOGDESIGNERPRO_TEXTDOMAIN) .'&nbsp;&nbsp; </span>';
                                    print_r($tags_list);
                                    ?>
                                </div>
                                <?php
                            endif;
                        }
                        if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                            echo '</div>';
                        }
                        ?>
                        <div class="entry-meta clearfix">
                            <div class="pull-left social-component-count-<?php echo $bdp_settings['social_count_position']; ?>">
                                <?php
                                if (is_single()) {
                                    do_action('bdp_social_share_text', $bdp_settings);
                                }
                                bdp_get_social_icons($bdp_settings);
                                ?>
                            </div>
                        </div>
                    </div>
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
?>
