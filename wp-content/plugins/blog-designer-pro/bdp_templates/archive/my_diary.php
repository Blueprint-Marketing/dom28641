<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/my_diary.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;


add_action('bd_archive_design_format_function', 'bdp_archive_my_diary_template', 10, 1);
if (!function_exists('bdp_archive_my_diary_template')) {

    /**
     *
     * @global type $post
     */
    function bdp_archive_my_diary_template($bdp_settings) {
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
            $post_format = 'far fa-file-images';;
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
        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        ?>
        <div class="blog_template bdp_blog_template diary-post">
            <?php do_action('bdp_before_archive_post_content'); ?>

            <div class="diary-thumb">
                <?php
                $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                if($label_featured_post != '' && is_sticky()) {
                    ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                }
                ?>
                <?php
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

                $post_thumbnail = 'deport-thumb';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                if (!empty($thumbnail)) {
                    echo '<figure class="' . $image_hover_effect . '">';
                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';
                    echo '</figure>';
                }
                ?>
            </div>
            <div class="post-content-area">
                <div class="diary-posthead">
                    <?php
                    if ($bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        ?>
                        <div class="categories <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                            <?php
                            echo '<span>' . __('in', BLOGDESIGNERPRO_TEXTDOMAIN) . '</span>';
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

                    <div class="post-title">
                        <?php
                        $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                        if ($bdp_post_title_link == 1) {
                            echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
                        }
                        echo get_the_title();
                        if ($bdp_post_title_link == 1) {
                            echo '</a>';
                        }
                        ?>
                    </div>
                    <div class="metadatabox">
                        <?php
                        if ($bdp_settings['display_author'] == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <div class="mauthor <?php echo ($author_link) ? 'bdp_has_links' : '';?>">
                                <span><?php _e('by', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </div>
                            <?php
                        }
                        if ($bdp_settings['display_date'] == 1) {
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');
                            ?>
                            <div class="mdate">
                                <span><?php _e('on', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                <?php
                                echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="diary-postcontent <?php echo $post_format; ?>">
                    <?php
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    ?>
                    <div class="post_content">
                        <?php
                        echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
                        ?>
                    </div>
                    <div class="diary_postfooter">
                        <?php
                        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                        if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
                            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                            $post_link = get_permalink($post->ID);
                            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                            }
                            echo '<div class="read-more-div"><a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a></div>';
                        }

                        if ($bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo (!$tag_link) ? 'bdp_has_links' : 'bdp_no_links'?>">
                                    <i class="fas fa-bookmark"></i>
                                    <?php
                                    _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    echo ' : ';
                                    printf($tags_list);
                                    ?>
                                </div><?php
                            endif;
                        }
                        bdp_get_social_icons($bdp_settings);

                        if ($bdp_settings['display_comment_count'] == 1) {
                            ?>
                            <div class="post-comment">
                                <i class="fas fa-comment"></i>
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number(__('No Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                } else {
                                    comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div>

        <?php
    }

}
