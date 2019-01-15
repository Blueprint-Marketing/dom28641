<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/elina.php.
 * @author  Solwin Infotech
 * @version 2.1
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;


add_action('bd_archive_design_format_function', 'bdp_archive_elina_template', 10, 1);
if (!function_exists('bdp_archive_elina_template')) {

    /**
     *
     * @global type $post
     */
    function bdp_archive_elina_template($bdp_settings) {
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
            $post_format = 'far fa-file-images';
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
        ?>
        <div class="bdp_blog_template elina-post-wrapper">
            <div class="elina-post-wrapp">
                <?php do_action('bdp_before_archive_post_content'); ?>
                <div class="post-media">
                    <div class="elina-postthumb">
                        <?php
                        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                        if($label_featured_post != '' && is_sticky()) {
                            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                        }
                        ?>
                        <?php
                        if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1) {
                            ?>
                            <div class="author-metabox">
                                <?php
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                if ($bdp_settings['display_author'] == 1) {
                                    echo ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" class="author-img" >' : '';
                                    echo get_avatar(get_the_author_meta('ID'), 51);
                                    echo ($author_link) ? '</a>' : '';
                                }
                                ?>
                                <div class="author-name">
                                    <?php
                                    if ($bdp_settings['display_author'] == 1) {
                                        echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                                    }

                                    if ($bdp_settings['display_date'] == 1) {
                                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                        ?>
                                        <div class="mdate">
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
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }


                        $post_thumbnail = 'full';
                        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                        if (!empty($thumbnail)) {
                            echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo ($bdp_post_image_link) ? '</a>' : '';
                        }

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                            ?>
                            <div class="bdp-pinterest-share-image">
                                <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                                <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="post-content-area">

                    <div class="elina-postformate <?php echo $post_format; ?>"></div>

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

                    <?php
                    if ($bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        ?>
                        <div class="categories-outer">
                            <div class="categories">
                                <div class="categories-inner <?php echo ($categories_link) ? 'bdp_no_links' : ''; ?>">
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
                        </div>
                        <?php
                    }
                    ?>

                    <div class="post_content">
                        <?php
                        echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
                        ?>
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
                            <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : ''; ?>">
                                <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
                                <?php printf($tags_list); ?>
                            </div><?php
                        endif;
                    }

                    if (get_the_content() != '') {
                        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                        if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
                            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                            $post_link = get_permalink($post->ID);
                            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                            }
                            echo '<div class="read-more-div"><a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a></div>';
                        }
                    }
                    ?>
                </div>

                <div class="elina-postfooter">
                    <div class="elina-footer">
                        <?php
                        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                            echo do_shortcode('[likebtn_shortcode]');
                        }
                        if ($bdp_settings['display_comment_count'] == 1) {
                            ?>
                            <div class="post-comment">
                                <i class="fas fa-comment"></i>
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                } else {
                                    comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                }
                                ?>
                            </div>
                            <?php
                        }
                        $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
                        if($social_share) {
                            if (($bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                                    ($bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                                    (isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) || ( $bdp_settings['pinterest_link'] == 1) ||
                                    ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                                    ( isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) ||
                                    ( isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) ||
                                    ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                                    ( isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) ||
                                    ( isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) ||
                                    ( isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) ||
                                    ( isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) ||
                                    ( $bdp_settings['whatsapp_link'] == 1)) {
                                ?>
                                <div class="post-share-div">
                                    <i class="far fa-share-square"></i>
                                    <a class="post-share" href="javascript:void(0)" title="<?php _ex('SHARE', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                        <?php _ex('SHARE', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </a>
                                </div>
                                <?php
                            }
                            bdp_get_social_icons($bdp_settings);
                        }
                        ?>
                    </div>
                </div>

                <?php do_action('bdp_after_archive_post_content'); ?>

                <div class="fakegb"></div>
            </div>
        </div>
        <?php
    }

}
