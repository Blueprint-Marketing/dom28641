<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/fairy.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_fairy_template', 10, 5);
if (!function_exists('bdp_archive_fairy_template')) {

    /**
     *
     * @global type $post
     * @param type $alterclass
     */
    function bdp_archive_fairy_template($bdp_settings, $alterclass, $prev_year, $alter_val, $paged) {
        global $post;

        if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
            $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
        } else {
            $firstpost_unique_design = 0;
        }
        $class_name = 'bdp_blog_template blog_template fairy';
        if ($firstpost_unique_design == 1) {
            if ($prev_year == 0 && $alter_val == 1 && $paged == 1) {
                $class_name = "bdp_blog_template blog_template fairy first_post";
                $post_thumbnail = 'full';
            } elseif ($prev_year == 1 && $alter_val != 1 && $paged == 1) {
                $class_name = "bdp_blog_template blog_template fairy";
                $post_thumbnail = 'fairy-thumb';
            } elseif ($prev_year == 1 && $paged != 1) {
                $class_name = "bdp_blog_template blog_template fairy";
                $post_thumbnail = 'fairy-thumb';
            }
        } else {
            $class_name = "bdp_blog_template blog_template fairy";
            $post_thumbnail = 'fairy-thumb';
        }
        if ($alterclass != '') {
            $class_name .= " " . $alterclass;
        }
        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
        ?>
        <div class="<?php echo $class_name; ?>">
            <?php do_action('bdp_before_post_content'); ?>
            <?php
            $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
            if($label_featured_post != '' && is_sticky()) {
                ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
            }
            ?>
            <div class="bdp-post-image">
                <?php
                $post_thumbnail = 'fairy-thumbnail';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

                if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                    ?>
                    <div class="post-video <?php echo (get_post_format() == 'video') ? 'bdp-video' : '';?>">
                        <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
                    </div>
                    <?php
                } else {
                    echo '<div class="post-thumbnail-cover">';

                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="fairy-img-link">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';

                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && !empty($thumbnail)) {
                        ?>
                        <div class="bdp-pinterest-share-image">
                            <?php
                            $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                            ?>
                            <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                        </div>
                        <?php
                    }
                    echo '<div class="post-img-overlay"></div>';
                    echo '</div>';

                    if((isset($bdp_settings['display_author']) && $bdp_settings['display_author'] == 1) || $bdp_settings['display_date'] == 1) {
                        echo '<div class="post-meta-cover">';
                        echo '<div class="post-meta">';
                            if (isset($bdp_settings['display_author']) && $bdp_settings['display_author'] == 1) {
                                echo '<div class="post_author">';
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;

                                echo '<div class="author-avatar">';
                                echo get_avatar(get_the_author_meta('ID'), 60);
                                echo '</div>';

                                echo '<div class="author-name">';
                                echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                                echo '</div>';

                                echo '</div>';
                            }

                            if ($bdp_settings['display_date'] == 1) {
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');
                                ?>
                                <span class="mdate">
                                    <?php
                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </span>
                                <?php
                            }
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                    <h2 class="post_title">
                        <?php
                        $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                        echo ($bdp_post_title_link == 1) ? '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' : '';
                        echo get_the_title();
                        echo ($bdp_post_title_link == 1) ? '</a>' : '';
                        ?>
                    </h2>
                    <?php
                }
                ?>
            </div>

            <div class="fairy_wrap">
                <div class="post_content_area">
                    <?php
                    if (bdp_get_first_embed_media($post->ID, $bdp_settings)) {
                        ?>
                        <h2 class="post_title">
                            <?php
                            $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                            echo ($bdp_post_title_link == 1) ? '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' : '';
                            echo get_the_title();
                            echo ($bdp_post_title_link == 1) ? '</a>' : '';
                            ?>
                        </h2>
                        <?php
                    }

                    if ($bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            ?>
                            <span class="fairy-category-text<?php echo ($categories_link) ? ' categories_link' : ''; ?>"><?php
                            echo ' ';
                            print_r($categories_list);
                            $show_sep = true;
                            ?>
                            </span>
                            <?php
                        endif;
                    }
                    ?>

                    <div class="metadatabox">
                        <?php
                        if (bdp_get_first_embed_media($post->ID, $bdp_settings)) {
                            $display_author = $bdp_settings['display_author'];
                            $display_date = $bdp_settings['display_date'];
                            if ($display_author == 1) {
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                ?>
                                <span class="post-author <?php echo (!$author_link) ? 'bdp-no-links' : ''; ?>">
                                 <i class="fas fa-user-o"></i>
                                    <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                </span>
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
                                <span class="mdate <?php echo (!$date_link) ? 'bdp-no-links' : ''; ?>">
                                    <?php
                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo '<i class="far fa-clock"></i>';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </span>
                                <?php
                            }
                        }

                        if ($bdp_settings['display_comment_count'] == 1) {
                        ?>
                            <span class="metacomments">
                                <i class="fas fa-comment"></i>
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number('0 Comments', '1 Comments', '% Comments');
                                } else {
                                    comments_popup_link('0 Comments', '1 Comments', '% Comments');
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
                    <div class="post_content">
                        <?php
                        echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

                        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                        if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
                            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                            $post_link = get_permalink($post->ID);
                            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                            }
                            echo '<div class="read_more_div"><a class="more_tag" href="' . $post_link . '">' . $readmoretxt . ' </a></div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="fairy_footer">
                    <?php
                    $tags_lists = get_the_tags();
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true;
                    if ($tags_lists):
                        ?>
                        <span class="tags">
                            <span><?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN)?> </span>
                            <?php
                            foreach ($tags_lists as $tags_list) {
                                echo '<span class="bdp-tag">';
                                if ($tag_link) {
                                    echo '<a rel="tag" href="' . get_tag_link($tags_list->term_id) . '">';
                                }
                                echo $tags_list->name;
                                if ($tag_link) {
                                    echo '</a>';
                                }
                                echo '</span>';
                            }
                            ?>
                        </span>
                        <?php
                    endif;
                    ?>

                    <?php
                    if($social_share) {
                        if (( $bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                            ( $bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                            ( isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) || ( $bdp_settings['pinterest_link'] == 1) ||
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
                            <div class="post_share_div">
                                <a class="fairy-post-share" href="javascript:void(0)" title="<?php _e('SHARE', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
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
                                echo '<div class="fairy-social-cover">';
                                bdp_get_social_icons($bdp_settings);
                                echo '<span class="fairy-social-div-closed"><a href="javascript:void(0)" class="fairy-social-links-closed"> <i class="fas fa-times"></i></a></span>';
                                echo '</div>';
                    }
                }
                ?>
            </div>
            <?php do_action('bdp_after_post_content'); ?>
        </div><?php
            do_action('bdp_archive_separator_after_post');
        }

    }