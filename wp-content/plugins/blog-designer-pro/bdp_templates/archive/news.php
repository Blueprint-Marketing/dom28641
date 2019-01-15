<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/news.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_news_template', 10, 5);
if (!function_exists('bdp_archive_news_template')) {

    /**
     *
     * @global type $post
     * @param type $alterclass
     */
    function bdp_archive_news_template($bdp_settings, $alterclass, $prev_year, $alter_val, $paged) {
        global $post;
        $news_content_full = '';
        if (!has_post_thumbnail() && !bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['bdp_default_image_id'] == '') {
            $news_content_full = 'news_content_fullwidth';
        }
        if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
            $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
        } else {
            $firstpost_unique_design = 0;
        }

        if ($firstpost_unique_design == 1) {
            if ($prev_year == 0 && $alter_val == 1 && $paged == 1) {
                $class_name = "bdp_blog_template news news-wrapper first_post";
                $post_thumbnail = 'full';
            } elseif ($prev_year == 1 && $alter_val != 1 && $paged == 1) {
                $class_name = "bdp_blog_template news news-wrapper";
                $post_thumbnail = 'news-thumb';
            } elseif ($prev_year == 1 && $paged != 1) {
                $class_name = "bdp_blog_template news news-wrapper";
                $post_thumbnail = 'news-thumb';
            }
        } else {
            $class_name = "bdp_blog_template news news-wrapper";
            $post_thumbnail = 'news-thumb';
        }
        if ($alterclass != '') {
            $class_name .= " " . $alterclass;
        }
        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        ?>
        <div class="<?php echo $class_name; ?>">
            <?php do_action('bdp_before_archive_post_content'); ?>
            <div>
                <div class="post-thumbnail-div bdp-post-image">
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                    }
                    ?>
                    <?php
                    $class = '';
                    if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                        ?>
                        <div class="bdp-post-image post-video bdp-video">
                            <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
                        </div>
                        <?php
                    } else {
                        $post_thumbnail = 'news-thumb';
                        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                        if (!empty($thumbnail)) {
                            $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                            $image_class = (isset($bdp_settings['thumbnail_skin']) && $bdp_settings['thumbnail_skin'] == 1) ? 'circle' : 'square';
                            echo '<figure class="' . $image_hover_effect . '">';
                            echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="' . $image_class . '">' : '';
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
                            echo '</figure>';
                        } else {
                            $class = "fullwrap";
                        }
                    }
                    ?>
                </div>
                <div class="post-content-div <?php echo $news_content_full; ?><?php echo " " . $class; ?>" ><?php
                    $display_date = $bdp_settings['display_date'];
                    if ($display_date == 1) {
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                        $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                        $ar_year = get_the_time('Y');
                        $ar_month = get_the_time('m');
                        $ar_day = get_the_time('d');
                        echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                        echo $bdp_date;
                        echo ($date_link) ? '</a>' : '';
                    }
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    ?>

                    <h2 class="post-title">
                        <?php
                        $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                        if ($bdp_post_title_link == 1) {
                            ?>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                            <?php } ?>
                            <?php
                            echo get_the_title();
                            if ($bdp_post_title_link == 1) {
                                ?>
                            </a>
                        <?php } ?>
                    </h2>

                    <?php
                    $display_author = $bdp_settings['display_author'];
                    if ($display_author == 1) {
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        ?>
                        <span class="post-author <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                        </span>
                        <?php
                    }
                    if ($bdp_settings['display_comment_count'] == 1) {
                        ?>
                        <span class="metacomments">
                            <?php
                            if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                            } else {
                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                            }
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                    <div class="post-content"><?php
                        echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

                        if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {
                            $categories_list = get_the_category_list(', ');
                            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                            $class = ($categories_link) ? 'post-category bdp_no_links' : 'post-category bdp_has_link';
                            if ($categories_link) {
                                $categories_list = strip_tags($categories_list);
                            }
                            if ($categories_list):
                                echo '<span class="'. $class .'"><i class="fas fa-bookmark"></i>';
                                echo ' ';
                                print_r($categories_list);
                                $show_sep = true;
                                echo '</span>';
                            endif;
                        }
                        if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            $class = ($tag_link) ? 'tags bdp_no_links' : 'tags bdp_has_link';
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="<?php echo $class; ?>">
                                    <i class="fas fa-tags"></i>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </div><?php
                            endif;
                        }

                        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                        if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1) :
                            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                            $post_link = get_permalink($post->ID);
                            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                            }
                            ?>
                            <div class="post-bottom">
                                <?php
                                echo '<a href="' . $post_link . '">' . $readmoretxt . ' </a>';
                                ?>
                            </div>
                        <?php endif;
                        ?>
                        <?php bdp_get_social_icons($bdp_settings); ?>
                    </div>
                </div>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div><?php
        do_action('bdp_archive_separator_after_post');
    }

}