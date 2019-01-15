<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/brite.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_archive_design_format_function', 'bdp_archive_brite_template', 10, 1);

if (!function_exists('bdp_archive_brite_template')) {

    function bdp_archive_brite_template($bdp_settings) {
        global $post;
        ?>
        <div class="bdp_blog_template brite-post-wrapper">
            <div class="brite-post-inner-wrapp">
                <?php do_action('bdp_before_archive_post_content'); ?>

                <div class="post-content-area">
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                    }
                    ?>
                    <div class="post-content-body">
                        <div class="post-title">
                            <?php
                            $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                            if ($bdp_post_title_link == 1) {
                                echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';
                            }
                            ?><h2><?php echo get_the_title(); ?></h2><?php
                            if ($bdp_post_title_link == 1) {
                                echo '</a>';
                            }
                            ?>
                        </div>

                        <div class="post-meta">
                            <?php
                            if ($bdp_settings['display_category'] == 1) {
                                ?>
                                <div class="post-categories">
                                    <i class="fas fa-folder-open"></i>
                                    <?php
                                    $categories_list = get_the_category_list(', ');
                                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                                    if ($categories_link) {
                                        $categories_list = strip_tags($categories_list);
                                    }
                                    if ($categories_list) {
                                        print_r($categories_list);
                                    }
                                    ?>
                                </div>
                                <?php
                            }


                            if ($bdp_settings['display_date'] == 1) {
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                ?>
                                <div class="date-meta">
                                    <?php
                                    $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                    $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                    $ar_year = get_the_time('Y');
                                    $ar_month = get_the_time('m');
                                    $ar_day = get_the_time('d');

                                    echo '<i class="far fa-calendar-alt"></i>';
                                    echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                    echo $bdp_date;
                                    echo ($date_link) ? '</a>' : '';
                                    ?>
                                </div>
                                <?php
                            }

                            if ($bdp_settings['display_comment_count'] == 1) {
                                ?>
                                <div class="post-comment">
                                    <i class="fas fa-comment"></i>
                                    <?php
                                    if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                        comments_number('0', '1', '%');
                                    } else {
                                        comments_popup_link('0', '1', '%', 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                    }
                                    ?>
                                </div>
                                <?php
                            }


                            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            ?>
                        </div>

                        <div class="post-content">
                            <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
                        </div>

                        <?php
                        if ($bdp_settings['display_tag'] == 1) {

                            $tags_lists = get_the_tags();

                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true;

                            if (!empty($tags_lists)) {
                                echo '<div class="post-tags">';
                                _e('Tags: ', BLOGDESIGNERPRO_TEXTDOMAIN);
                                echo '<div class="post-tags-wrapp">';
                                foreach ($tags_lists as $tags_list) {
                                    echo '<span class="tag">';
                                    if ($tag_link) {
                                        echo '<a rel="tag" href="' . get_tag_link($tags_list->term_id) . '">';
                                    }
                                    echo $tags_list->name;
                                    if ($tag_link) {
                                        echo '</a>';
                                    }
                                    echo '</span>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>

                    </div>

                    <div class="post-footer">
                        <?php
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

                        bdp_get_social_icons($bdp_settings);
                        ?>
                    </div>

                </div>

                <div class="post-media">
                    <?php
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

                    if ($bdp_settings['display_author'] == 1) {
                        echo '<div class="post-author">';
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        echo '<div class="author-avatar">';
                        echo get_avatar(get_the_author_meta('ID'), 60);
                        echo '</div>';
                        echo '<div class="author-name">';
                        echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>

                <?php do_action('bdp_after_archive_post_content'); ?>
            </div>
        </div>
        <?php
    }

}