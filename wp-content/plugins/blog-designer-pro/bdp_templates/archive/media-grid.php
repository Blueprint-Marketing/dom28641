<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/media-grid.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_media_grid_template', 10, 5);
if (!function_exists('bdp_archive_media_grid_template')) {

    /**
     *
     * @global type $post
     * @return html display media-grid design
     */
    function bdp_archive_media_grid_template($bdp_settings, $alter, $prev_year, $alter_val, $paged) {
        global $post, $wp_query;
        $no_image_post = '';
        if (!has_post_thumbnail() || empty($bdp_settings['bdp_default_image_id'])) {
            $no_image_post = 'no_image_post';
        }

        $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;

        if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
            $blog_unique_design = $bdp_settings['firstpost_unique_design'];
        } else {
            $blog_unique_design = 0;
        }

        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }

        if ($column_setting >= 3 && $blog_unique_design == 1 && $alter_val == 1 && $prev_year == 0 && $paged == 1) {
            echo '<div class="media-grid-wrap first_post">';
        } elseif ($column_setting <= 2 && $blog_unique_design == 1 && $alter_val == 1 && $prev_year == 0 && $paged == 1) {
            echo '<div class="media-grid-wrapp first_post">';
        } else {
            if ($blog_unique_design != 1 && $alter_val == 1) {
                echo '<div class="media-grid-wrapper">';
            } elseif ($paged > 1 && $alter_val == 1) {
                echo '<div class="media-grid-wrapper">';
            } elseif ($blog_unique_design == 1 && $paged == 1 && $alter_val == 2 && $column_setting <= 2) {
                echo '<div class="media-grid-wrapper">';
            } elseif ($blog_unique_design == 1 && $paged == 1 && $alter_val == 3 && $column_setting >= 2) {
                echo '<div class="media-grid-wrapper">';
            }
        }
        ?>
        <div class="blog_template bdp_blog_template media-grid <?php echo get_post_format($post->ID); ?>">
            <?php do_action('bdp_before_archive_post_content'); ?>
            <div class="post-body-div <?php echo $no_image_post; ?><?php
            if ($bdp_settings['display_category'] == 0) {
                echo ' category-not-visible';
            }
            ?>">
                <div class="bdp-post-image">
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                    }
                    ?>
                    <?php
                    if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                        echo '<div class="post-video bdp-video">';
                        echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                        echo '</div>';
                    } else {
                        echo '<figure class="' . $image_hover_effect . '">';
                        $post_thumbnail = 'invert-grid-thumb';
                        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                            echo bdp_pinterest($post->ID);
                        }
                        echo '</figure>';
                    }

                    if ($bdp_settings['display_category'] == 1) {
                        ?>
                        <?php
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            echo '<span class="category-link">';
                            echo ' ';
                            print_r($categories_list);
                            $show_sep = true;
                            echo '</span>';
                        endif;
                        ?>
                        <?php
                    }
                    ?>
                </div>
                <div class="content-container">
                    <div class="shadow-box"></div>
                    <div class="content-inner">
                        <h2 class="post-title entry-title" title="<?php echo get_the_title(); ?>">
                            <?php
                            $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                            if ($bdp_post_title_link == 1) {
                                ?>
                                <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php } ?>
                                <?php
                                echo get_the_title();
                                if ($bdp_post_title_link == 1) {
                                    ?>
                                </a>
                            <?php } ?>
                        </h2>
                        <div class="post_content">
                            <?php
                            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
                            ?>
                        </div>
                        <?php
                        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                        if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1):
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

                        <div class="metadatabox">
                            <?php
                            $display_author = $bdp_settings['display_author'];
                            $display_date = $bdp_settings['display_date'];
                            if($display_author == 1 || $display_date == 1)  {
                                ?><span><?php _e('Posted ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span><?php
                            }
                            if ($display_author == 1) {
                                ?>
                                <span class="post-author">
                                    <span><?php _e('by ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
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
                                <span class="mdate"><span><?php _e('on', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                    <?php
                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                ?>
                                <span class="metacomments">
                                    <i class="fas fa-comments"></i>
                                    <?php
                                    if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                        comments_number('0', '1', '%');
                                    } else {
                                        comments_popup_link('0', '1', '%');
                                    }
                                    ?>
                                </span>
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
                                    <div class="tags">
                                        <?php
                                        print_r($tags_list);
                                        $show_sep = true;
                                        ?>
                                    </div><?php
                                endif;
                            }
                            ?>
                        </div>
                        <?php bdp_get_social_icons($bdp_settings); ?>
                    </div>
                </div>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div>
        <?php
        if ($column_setting >= 3 && $blog_unique_design == 1 && $alter_val == 2 && $prev_year == 0 && $paged == 1) {
            echo '</div>';
        } elseif ($column_setting <= 2 && $blog_unique_design == 1 && $alter_val == 1 && $prev_year == 0 && $paged == 1) {
            echo '</div>';
        } elseif ($prev_year == 1 && $wp_query->post_count == $alter_val) {
            echo '</div>';
        } elseif ($blog_unique_design != 1 && $wp_query->post_count == $alter_val) {
            echo '</div>';
        }
    }

}