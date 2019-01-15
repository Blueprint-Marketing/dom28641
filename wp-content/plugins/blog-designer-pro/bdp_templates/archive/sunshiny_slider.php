<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/sunshiny_slider.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_archive_design_format_function', 'bdp_archive_sunshiny_slider_template', 10, 2);

if (!function_exists('bdp_archive_sunshiny_slider_template')) {

    /**
     *
     * @global type $post
     * @param type $alterclass
     */
    function bdp_archive_sunshiny_slider_template($bdp_settings, $alterclass) {
        global $post;
        $class_name = "blog_template bdp_blog_template sunshiny_slider";
        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
        $slider_column = $slider_column_ipad = $slider_column_tablet = $slider_column_mobile = 1;
        if ($bdp_settings['template_slider_effect'] == 'slide') {
            $slider_column = isset($bdp_settings['template_slider_columns']) ? $bdp_settings['template_slider_columns'] : 1;
            $slider_column_ipad = isset($bdp_settings['template_slider_columns_ipad']) ? $bdp_settings['template_slider_columns_ipad'] : 1;
            $slider_column_tablet = isset($bdp_settings['template_slider_columns_tablet']) ? $bdp_settings['template_slider_columns_tablet'] : 1;
            $slider_column_mobile = isset($bdp_settings['template_slider_columns_mobile']) ? $bdp_settings['template_slider_columns_mobile'] : 1;
        }
        $column_class = 'columns_' . $slider_column . 'columns_' . $slider_column_ipad . 'columns_' . $slider_column_tablet . 'columns_' . $slider_column_mobile;
        ?>
        <li class="<?php echo $class_name . ' ' . $column_class; ?>">
            <?php do_action('bdp_before_archive_post_content'); ?>
            <div class="post_hentry">
                <div class="bdp-post-image">
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
                    }
                    ?>
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><span> <?php echo $label_featured_post; ?> </span></div> <?php
                    }

                    $post_thumbnail = 'full';
                    $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                    $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                    if (!empty($thumbnail)) {
                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                            ?>
                            <div class="bdp-pinterest-share-image">
                                <?php
                                $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                                ?>
                                <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="blog_header">
                    <?php
                    if ($bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(' ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = get_the_category_list(', ');
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            echo '<div class="category-link">';
                            echo ' ';
                            print_r($categories_list);
                            $show_sep = true;
                            echo '</div>';
                        endif;
                    }
                    ?>

                    <h2>
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
                    </h2>

                    <?php
                    if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1 || $bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                        ?>
                        <div class="metadatabox">
                            <?php
                            if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1) {
                                if ($bdp_settings['display_author'] == 1) {
                                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                    $author_class = (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1 && get_post_format($post->ID) != 'gallery') ? 'class="post-video-format"' : '';
                                    ?>
                                    <div class="mauthor">
                                        <i class="fas fa-user"></i>
                                        <span class="author">
                                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                        </span>
                                    </div>
                                    <?php
                                }
                                if ($bdp_settings['display_date'] == 1) {
                                    $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                    ?>
                                    <div class="post-date">
                                        <?php
                                        $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                        $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                        $ar_year = get_the_time('Y');
                                        $ar_month = get_the_time('m');
                                        $ar_day = get_the_time('d');

                                        echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '"><i class="far fa-calendar-alt"></i>' : '<i class="far fa-calendar-alt"></i>';
                                        echo $bdp_date;
                                        echo ($date_link) ? '</a>' : '';
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            if ($bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                                if ($bdp_settings['display_comment_count'] == 1) {
                                    ?>
                                    <div class="post-comment">
                                        <?php
                                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                            comments_number('<i class="fas fa-comment"></i>' . __('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>' . __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        } else {
                                            comments_popup_link('<i class="fas fa-comment"></i>' . __('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>' . __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', '<i class="fas fa-comment"></i>' . __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }

                                if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                    echo '<div class="postlike_btn">';
                                    echo do_shortcode('[likebtn_shortcode]');
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="post_content">
                        <div class="post_content-inner">
                            <?php
                            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

                            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                            if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1) {
                                $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                                $post_link = get_permalink($post->ID);
                                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                                }
                                ?>
                                <div class="read-more">
                                    <?php
                                    echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>';
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    if ($bdp_settings['display_tag'] == 1) {
                        $tags_list = get_the_tag_list('', ', ');
                        $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                        if ($tag_link) {
                            $tags_list = strip_tags($tags_list);
                        }
                        if ($tags_list):
                            ?>
                            <div class="tags"> <?php
                                print_r($tags_list);
                                $show_sep = true;
                                ?>
                            </div><?php
                        endif;
                    }

                    bdp_get_social_icons($bdp_settings);
                    ?>
                </div>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </li>
        <?php
    }

}