<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/region.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_region_template', 10, 2);
if (!function_exists('bdp_archive_region_template')) {

    /**
     *
     * @global type $post
     * @param type $alterclass
     */
    function bdp_archive_region_template($bdp_settings, $alterclass) {
        global $post;
        $class_name = "blog_template bdp_blog_template region";
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
            <?php
            $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
            if($label_featured_post != '' && is_sticky()) {
                ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
            }
            ?>
            <div class="blog_header">
                <div class="metadatabox"><?php
                    $display_date = $bdp_settings['display_date'];
                    $display_author = $bdp_settings['display_author'];
                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                    $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                    $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                    $ar_year = get_the_time('Y');
                    $ar_month = get_the_time('m');
                    $ar_day = get_the_time('d');
                    if ($bdp_settings['display_comment_count'] == 1) {
                        ?>
                        <div class="comment_wrapper">
                            <div class="metacomments">
                                <span class="article_comments">
                                    <?php
                                    if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                        comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                    } else {
                                        comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                    }
                                    ?>
                                </span>
                            </div>
                        </div><?php
                    }
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    ?>
                    <div class="posted_by"><?php
                        if ($display_author == 1 && $display_date == 1) {
                            if((isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify')) {
                                _e('Last updated', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else {
                                _e('Published on', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                            ?>&nbsp;:&nbsp;
                            <time datetime="" class="datetime">
                                <?php
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                ?>
                            </time>

                            <span class="author-meta <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                <span class="link-lable"> | <?php _e('By', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </span>
                            <?php
                        } elseif ($display_author == 1) {
                            ?>
                            <span class="author-meta <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                <span class="link-lable"> <?php _e('By', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings);?>
                            </span>
                            <?php
                        } elseif ($display_date == 1) {
                            if((isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify')) {
                                _e('Last updated', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else {
                                _e('Published on', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            ?>&nbsp;:&nbsp;
                            <time datetime="" class="datetime">
                                <?php
                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                ?>
                            </time><?php
                        }
                        ?>
                    </div>
                </div>
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
                <?php if ($bdp_settings['display_category'] == 1) {
                    $categories_list = get_the_category_list(', ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    ?>
                    <span class="category-link <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>"><?php
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            ?> <span class="link-lable"><?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span> <?php
                            echo ' ';
                            print_r($categories_list);
                        endif;
                        ?>
                    </span><?php
                }
                ?>
            </div>

            <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
                <div class="post-video">
                    <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
                </div><?php
            } else {
                $post_thumbnail = 'full';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                if (!empty($thumbnail)) {
                    ?>
                    <div class="bdp-post-image">
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
                }
            }
            ?>
            <div class="post_content_wrap">
                <?php if (bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings)) { ?>
                    <div class="post_content">
                        <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
                    </div>
                <?php } ?>
                <?php
                $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                if ($bdp_settings['rss_use_excerpt'] != 0 && $read_more_link == 1):
                    $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                    $post_link = get_permalink($post->ID);
                    if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                        $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                    }
                    echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>';
                endif;
                ?>
            </div>
            <div class="blog_footer">
                <?php
                if ($bdp_settings['display_tag'] == 1) {
                    $tags_list = get_the_tag_list('', ', ');
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                    if ($tag_link) {
                        $tags_list = strip_tags($tags_list);
                    }
                    if ($tags_list):
                        ?>
                        <div class="footer_meta">
                            <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                <span class="link-lable"><?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
                                <?php print_r($tags_list); ?>
                            </div>
                        </div><?php
                    endif;
                }

                bdp_get_social_icons($bdp_settings);
                ?>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div><?php
        do_action('bdp_archive_separator_after_post');
    }

}