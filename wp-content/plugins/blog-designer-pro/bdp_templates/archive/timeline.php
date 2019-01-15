<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/timeline.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_timeline_template', 10, 2);
if (!function_exists('bdp_archive_timeline_template')) {

    /**
     *
     * @global type $post
     */
    function bdp_archive_timeline_template($bdp_settings, $alter) {
        global $post;

        $format = get_post_format();
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
        if (isset($bdp_settings['blog_background_image']) && $bdp_settings['blog_background_image'] == 1) {
            if (has_post_thumbnail()) {
                $url = wp_get_attachment_url(get_post_thumbnail_id());
            } elseif (isset($bdp_settings['bdp_default_image_id']) && $bdp_settings['bdp_default_image_id'] != '') {
                $url = wp_get_attachment_url($bdp_settings['bdp_default_image_id']);
            } else {
                $url = '';
            }
            if ($url != '') {
                $background_attachment = (isset($bdp_settings['blog_background_image_style']) && $bdp_settings['blog_background_image_style'] == 1) ? 'fixed' : 'scroll';
                $style = 'style = "background-color: transparent; background-attachment: ' . $background_attachment . '; background-size: cover; background-image: url(' . $url . '); "';
            }
        }
        ?>
        <div class="blog_template bdp_blog_template timeline blog-wrap <?php echo $alter; ?>">
            <?php do_action('bdp_before_post_content'); ?>
            <div class="post_hentry  <?php echo $post_format; ?>">
                <div class="post_content_wrap animateblock" <?php echo (isset($style) && $style != '') ? $style : ''; ?>>
                    <div class="post_wrapper box-blog">
                        <?php
                        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                        if($label_featured_post != '' && is_sticky()) {
                            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
                        }
                        ?>
                        <?php
                        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                        if($label_featured_post != '' && is_sticky()) {
                            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                        }
                        $show_fearue_image = 1;
                        if (isset($bdp_settings['blog_background_image']) && $bdp_settings['blog_background_image'] == 1) {
                            $show_fearue_image = 0;
                        }
                        if ($show_fearue_image == 1) {
                            if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                                ?>
                                <div class="bdp-post-image post-video bdp-video">
                                    <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
                                </div>
                                <?php
                            } else {
                                $post_thumbnail = 'full';
                                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                                if (!empty($thumbnail)) {
                                    ?>
                                    <div class="photo bdp-post-image">
                                        <?php
                                        echo '<figure class="' . $image_hover_effect . '">';
                                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                                        echo ($bdp_post_image_link) ? '</a>' : '';
                                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                                            echo bdp_pinterest($post->ID);
                                        }
                                        echo '</figure>';
                                        ?>
                                    </div>
                                    <?php
                                } else {
                                    $display_date = $bdp_settings['display_date'];
                                    if ($display_date == 1) {
                                        ?>
                                        <div class="no_post_media">
                                        </div><?php
                                    }
                                }
                            }
                        } else {
                            $display_date = $bdp_settings['display_date'];
                            if ($display_date == 1) {
                                ?>
                                <div class="no_post_media">
                                </div><?php
                            }
                        }
                        ?>
                        <div class="desc">
                            <h3 class="entry-title">
                                <?php
                                $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                                if ($bdp_post_title_link == 1) {
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                    <?php } ?>
                                    <?php
                                    the_title();
                                    if ($bdp_post_title_link == 1) {
                                        ?>
                                    </a>
                                <?php } ?>
                            </h3>
                            <?php
                            if ($bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1 || $bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1) {
                                ?>
                                <div class="date_wrap">
                                    <?php
                                    $display_author = $bdp_settings['display_author'];
                                    if ($display_author == 1) {
                                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                        ?>
                                        <span class="posted_by <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                            <i class="fas fa-user"></i>
                                            <span> <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?> </span>
                                        </span>
                                        <?php
                                    }
                                    $display_date = $bdp_settings['display_date'];
                                    $ar_year = get_the_time('Y');
                                    $ar_month = get_the_time('m');
                                    $ar_day = get_the_time('d');
                                    if ($display_date == 1) {
                                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                        ?>
                                        <div class="datetime">
                                            <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : ''; ?>
                                            <span class="month"><?php the_time('M'); ?></span>
                                            <span class="date"><?php the_time('d'); ?></span>
                                            <?php echo '</a>'; ?>
                                        </div>
                                        <?php
                                    }
                                    if ($bdp_settings['display_comment_count'] == 1) {
                                        ?>
                                        <span class="post-comment">
                                            <i class="fas fa-comment"></i>
                                            <?php
                                            if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                                comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                            } else {
                                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                            }
                                            ?>
                                        </span>
                                        <?php
                                    }

                                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                        echo do_shortcode('[likebtn_shortcode]');
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                            <?php
                            if (bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings)) {
                                ?>
                                <div class="post_content">
                                    <?php
                                    echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php
                            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                            if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1):
                                $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                                $post_link = get_permalink($post->ID);
                                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                                }
                                ?>

                                <div class="read_more">
                                    <?php echo '<a class="btn-more" href="' . $post_link . '"><i class="fas fa-plus"></i> ' . $readmoretxt . ' </a>'; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
                    if (($bdp_settings['display_category'] == 1) || ($bdp_settings['display_tag'] == 1) || ($social_share && (
                            ($bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
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
                            ( $bdp_settings['whatsapp_link'] == 1)))) {
                        ?>
                        <footer class="blog_footer text-capitalize"><?php
                            if ($bdp_settings['display_category'] == 1) {
                                $categories_list = get_the_category_list(', ');
                                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                                ?>
                                <span class="categories <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <span class="link-lable"> <i class="fas fa-folder"></i> <?php _e('Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                    <?php
                                    if ($categories_link) {
                                        $categories_list = strip_tags($categories_list);
                                    }
                                    if ($categories_list):
                                        print_r($categories_list);
                                        $show_sep = true;
                                    endif;
                                    ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_tag'] == 1) {
                                $tags_list = get_the_tag_list('', ', ');
                                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                                if ($tag_link) {
                                    $tags_list = strip_tags($tags_list);
                                }
                                if ($tags_list):
                                    ?>
                                    <span class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                        <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                        <?php
                                        printf($tags_list);
                                        $show_sep = true;
                                        ?>
                                    </span>
                                    <?php
                                endif;
                            }
                            bdp_get_social_icons($bdp_settings);
                            ?>
                        </footer>
                    <?php } ?>
                </div>
            </div>
            <?php do_action('bdp_after_post_content'); ?>
        </div>
        <?php
        do_action('bdp_separator_after_post');
    }

}
