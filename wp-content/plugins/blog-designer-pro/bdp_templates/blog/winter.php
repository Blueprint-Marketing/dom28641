<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/winter.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;
$class_name = "blog_template bdp_blog_template winter";
if ($alter_class != '') {
    $class_name .= " " . $alter_class;
}
$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="<?php echo $class_name; ?>">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="blog_header">
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
        ?>
        <div class="metadatabox"><?php
            $display_date = $bdp_settings['display_date'];
            $display_author = $bdp_settings['display_author'];
            $ar_year = get_the_time('Y');
            $ar_month = get_the_time('m');
            $ar_day = get_the_time('d');
            if ($display_date == 1) {
                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                ?>
                <time datetime="" class="datetime">
                    <?php
                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                    echo $bdp_date;
                    echo '</a>';
                    ?>
                </time>
                <?php
            }
            if ($display_date == 1 && (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1 && has_tag())) {
                echo '<span>-</span>';
            }
            if ($bdp_settings['custom_post_type'] != 'post') {
                $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
                $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                foreach ($taxonomy_names as $taxonomy_single) {
                    $taxonomy = $taxonomy_single->name;
                    $sep = 1;
                    if ($bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                        $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                        $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;

                        if (isset($taxonomy)) {
                            if (isset($term_list) && !empty($term_list)) {
                                ?>
                                <div class="category-link <?php echo $no_image; ?> <?php echo ($taxonomy_link) ? 'bdp_has_link' : 'bdp_no_links'; ?>">
                                    <span class="link-lable"> <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp; </span>
                                    <?php
                                    foreach ($term_list as $term_nm) {
                                        $term_link = get_term_link($term_nm);
                                        if ($sep != 1) {
                                            ?>,&nbsp;<?php
                                        }
                                        echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                        echo $term_nm->name;
                                        echo ($taxonomy_link) ? '</a>' : '';
                                        $sep++;
                                    }
                                    ?>
                                </div><?php
                            }
                        }
                    }
                }
            }
            if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1 && $bdp_settings['custom_post_type'] == 'post') {
                $tags_list = get_the_tag_list('', ', ');
                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                if ($tag_link) {
                    $tags_list = strip_tags($tags_list);
                }
                if ($tags_list):
                    ?>
                    <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">&nbsp;<?php
                        print_r($tags_list);
                        ?>
                    </div><?php
                endif;
            }
            ?>
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
            </h2>

            <?php
            if ($display_author == 1) {
                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                ?>
                <div class="posted_by">
                    <span><?php _e('By', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span>
                    <?php
                    echo (!$author_link) ? '<span class="auther-inner">' : '';
                    echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                    echo (!$author_link) ? '</span>' : '';
                    ?>
                </div>
                <?php
            }
            if ($bdp_settings['display_comment_count'] == 1 || ( isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1)) {
                ?>
                <div class="metacomments">
                    <?php
                    if ($bdp_settings['display_comment_count'] == 1) {
                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                            comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                        }
                    }
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="bdp-post-image"><?php
        $no_image = 'winter-no-image-post';
        $post_thumbnail = 'full';
        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
        if (!empty($thumbnail)) {
            $no_image = '';
        }
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1) {
                $categories_list = get_the_category_list(', ');
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                if ($categories_link) {
                    $categories_list = strip_tags($categories_list);
                }
                if ($categories_list):
                    echo '<div class="category-link ' . $no_image . ' ">';
                    echo ' ';
                    print_r($categories_list);
                    $show_sep = true;
                    echo '</div>';
                endif;
            }
        }
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            ?>
            <div class="post-video">
                <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
            </div><?php
        } else {
            if (!empty($thumbnail)) {
                echo '<figure class="' . $image_hover_effect . '">';
                echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                    echo bdp_pinterest($post->ID);
                }
                echo ($bdp_post_image_link) ? '</a>' : '';
                echo '</figure>';
            }
        }
        ?>
    </div>
    <div class="post_content_wrap">
        <div class="post_content">
            <p><?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?></p><?php

            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
            if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] != 0) {
                $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                $post_link = get_permalink($post->ID);
                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                }
                echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>';
            }
            ?>
        </div>
        <?php bdp_get_social_icons($bdp_settings); ?>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div><?php
do_action('bdp_separator_after_post');
