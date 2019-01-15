<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/sharpen.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_sharpen_template', 10, 2);
if (!function_exists('bdp_archive_sharpen_template')) {

    /**
     *
     * @global type $post
     * @return html display sharpen design
     */
    function bdp_archive_sharpen_template($bdp_settings, $alterclass) {
        global $post;
        $class_name = "blog_template bdp_blog_template box-template active sharpen";
        if ($alterclass != '') {
            $class_name .= " " . $alterclass;
        }
        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        ?>
        <div class="<?php
        echo $class_name;
        if ($bdp_settings['display_category'] == 0) {
            echo ' no-category-display';
        }
        ?>">
            <?php
                $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                if($label_featured_post != '' && is_sticky()) {
                    ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
                }
            ?>
                 <?php do_action('bdp_before_archive_post_content'); ?>
                 <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
                <div class="bdp-post-image post-video">
                    <?php
                    if (get_post_format() == 'quote') {
                        if (has_post_thumbnail()) {
                            $post_thumbnail = 'full';
                            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo '<div class="upper_image_wrapper">';
                            echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                            echo '</div>';
                        }
                    } else if (get_post_format() == 'link') {
                        if (has_post_thumbnail()) {
                            $post_thumbnail = 'full';
                            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo '<div class="upper_image_wrapper bdp_link_post_format">';
                            echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                            echo '</div>';
                        }
                    } else {
                        echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                    }
                    ?>
                </div>
                <?php
            } else {
                $post_thumbnail = 'full';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                if (!empty($thumbnail)) {
                    $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                    ?>
                    <div class="bdp-post-image">
                        <?php
                        echo '<figure class="' . $image_hover_effect . '">';
                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                            echo bdp_pinterest($post->ID);
                        }
                        echo '</figure>';
                        ?>
                    </div>
                    <?php
                }
            }

            if (isset($bdp_settings['image_corner_selection']) && $bdp_settings['image_corner_selection'] == 1) {
                $image_corner_class = 'square_style';
            } else if (isset($bdp_settings['image_corner_selection']) && $bdp_settings['image_corner_selection'] == 2) {
                $image_corner_class = 'round_style';
            } else {
                $image_corner_class = 'triangle_style';
            }

            if (has_post_thumbnail() || (isset($bdp_settings['bdp_default_image_id']) && $bdp_settings['bdp_default_image_id'] != '')) {
                ?>
                <?php
                if ($bdp_settings['display_category'] == 1) {
                    $categories_list = get_the_category_list(', ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    $class = ($categories_link) ? 'bdp_no_links' : 'bdp_has_links';
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list):
                        echo '<div class="category-list-wrap ' . $image_corner_class . '">';
                        echo '<div class="category-main-wrap">';
                        echo '<div class="category-list category-main '. $class .'">';
                        print_r($categories_list);
                        $show_sep = true;
                        echo '</div></div></div>';
                    endif;
                }
                ?>
            <?php } else { ?>

                <?php
                if ($bdp_settings['display_category'] == 1) {
                    $categories_list = get_the_category_list(', ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    ?>
                    <div class="metadatabox">
                        <div class="metacats category-list <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                            <?php
                            if ($categories_link) {
                                $categories_list = strip_tags($categories_list);
                            }
                            if ($categories_list):
                                print_r($categories_list);
                                $show_sep = true;
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            <?php } ?>
            <div class="blog_header <?php
            echo $image_corner_class . ' ';
            if (has_post_thumbnail() || (isset($bdp_settings['bdp_default_image_id']) && $bdp_settings['bdp_default_image_id'] != '')) {
                echo "blog_header_img";
            }
            ?>">
                <h2 class="post-title">
                    <?php
                    $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                    if ($bdp_post_title_link == 1) {
                        ?>
                        <a href="<?php the_permalink(); ?>">
                        <?php } ?>
                        <?php
                        echo get_the_title();
                        if ($bdp_post_title_link == 1) {
                            ?>
                        </a>
                    <?php } ?>
                    </a>
                </h2>
                <?php if ($bdp_settings['display_date'] == 1 || $bdp_settings['display_postlike'] == 1 || $bdp_settings['display_tag'] == 1 || $bdp_settings['display_author'] == 1 || $bdp_settings['display_category'] == 1 || $bdp_settings['display_comment_count'] == 1) { ?>
                    <div class="meta_data_box metadatabox">
                        <?php
                        $display_date = $bdp_settings['display_date'];
                        $display_author = $bdp_settings['display_author'];
                        if ($display_author == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <div class="metauser <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                <span class="link-lable"> <i class="fas fa-user"></i> <?php _e('Posted by ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </div>
                            <?php
                        }
                        if ($display_date == 1) {
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            ?>
                            <div class="metadate">
                                <span class="mdate">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php
                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </span>
                            </div>
                            <?php
                        }

                        if ($bdp_settings['display_comment_count'] == 1) {
                            ?>
                            <div class="metacomments">
                                <!--<div class="icon-comment"></div>-->
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
                        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                            echo do_shortcode('[likebtn_shortcode]');
                        }
                        if ($bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <i class="fas fa-tags"></i>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </div>
                                <?php
                            endif;
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="post_content">
                <?php
                echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
                ?>
            </div>

            <?php
            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
            if ($bdp_settings['rss_use_excerpt'] == 1 && $bdp_settings['txtReadmoretext'] != ''):
                $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                $post_link = get_permalink($post->ID);
                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                }
                ?>
                <div class="read-more">
                    <a href="<?php echo $post_link; ?>">
                        <?php echo $readmoretxt; ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php bdp_get_social_icons($bdp_settings); ?>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div>
        <?php
        do_action('bdp_archive_separator_after_post');
    }

}