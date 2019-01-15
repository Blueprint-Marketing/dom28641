<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/miracle.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

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

$image_hover_effect = 'bdp-post-image ';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect .= (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="bdp_blog_template blog_template miracle_blog">
    <?php do_action('bdp_before_post_content'); ?>
    <span class="bdp-post-format"><i class="<?php echo $post_format; ?>"></i></span>
    <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
        }
    ?>
    <div class="post-title">
        <h2>
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
        </h2>
    </div>

    <?php
    $display_date = isset($bdp_settings['display_date']) ? $bdp_settings['display_date'] : 1;
    $display_author = isset($bdp_settings['display_author']) ? $bdp_settings['display_author'] : 1;
    $display_comment_count = isset($bdp_settings['display_comment_count']) ? $bdp_settings['display_comment_count'] : 1;
    $display_postlike = isset($bdp_settings['display_postlike']) ? $bdp_settings['display_postlike'] : 0;

    if ($display_date == 1 || $display_author == 1 || $display_comment_count == 1 || $display_postlike == 1) {
        echo '<div class="post-meta">';
        if ($display_date == 1) {
            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
            $ar_year = get_the_time('Y');
            $ar_month = get_the_time('m');
            $ar_day = get_the_time('d');
            $date_class = ($date_link) ? 'bdp_has_links' : 'bdp_no_links';
            echo '<span class="post-date '. $date_class .'">';
            echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
            echo $bdp_date;
            echo ($date_link) ? '</a>' : '';
            echo '</span>';
        }

        if ($display_author == 1) {
            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
            $author_class = ($author_link) ? 'bdp_has_links' : 'bdp_no_links';
            echo '<span class="post-author '. $author_class .'">';
            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
            echo '</span>';
        }

        if ($display_comment_count == 1) {
            $disable_link_comment = isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1 ? true : false;
            ?>
            <span class="post-comment <?php echo ($disable_link_comment) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                <?php
                if ($disable_link_comment == 1) {
                    comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1 . __('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                } else {
                    comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), 1 . __('Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('Comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                }
                ?>
            </span>
            <?php
        }

        if ($display_postlike == 1) {
            echo do_shortcode('[likebtn_shortcode]');
        }
        echo '</div>';
    }

    if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
        echo '<div class="bdp-post-image post-video">';
        echo bdp_get_first_embed_media($post->ID, $bdp_settings);
        echo '</div>';
    } else {
        $post_thumbnail = 'full';
        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);

        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

        if($display_author == 1 || !empty($thumbnail) ) {
            ?>
            <div class="bdp-post-image <?php echo (empty($thumbnail)) ? 'bdp-no-thumbnail' : ''; ?>">
                <div class="bdp-post-image-cover">
                    <?php
                    if ($display_author == 1) {
                        ?>
                        <div class="bdp-author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 100); ?>
                        </div>
                        <?php
                    }
                    if (!empty($thumbnail)) {
                        echo '<figure class="' . $image_hover_effect . '">';
                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                            echo bdp_pinterest($post->ID);
                        }
                        echo '</figure>';
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <div class="post_content">
        <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
    </div>

    <?php
    $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
    if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
        $readmoretxt = $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Continue Reading', BLOGDESIGNERPRO_TEXTDOMAIN);
        $post_link = get_permalink($post->ID);
        if (isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
            $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
        }
        ?> <div class="read_more_div"> <?php
        echo '<a class="more-tag" href="' . $post_link . '"> ' . $readmoretxt . ' →</a>';
        ?> </div><?php
    }

    if ($bdp_settings['custom_post_type'] == 'post') {
        if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
            echo '<div class="post-meta-cats-tags">';
            if ($bdp_settings['display_category'] == 1) {
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                ?>
                <div class="category-link<?php echo ($categories_link) ? ' bdp_no_links' : ' bdp_has_links'; ?>">
                    <span class="link-lable"> <?php _e('Posted in', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list):
                        echo ' ';
                        print_r($categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </div>
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
                    <div class="tags<?php echo ($tag_link) ? ' bdp_no_links' : ' bdp_has_links'; ?>">
                        <span class="link-lable"> <?php _e('Filed under', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                        <?php
                        print_r($tags_list);
                        $show_sep = true;
                        ?>
                    </div>
                    <?php
                endif;
            }
            echo '</div>';
        }
    } else {
        $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
        $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
        foreach ($taxonomy_names as $taxonomy_single) {
            $taxonomy = $taxonomy_single->name;
            if ($bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                echo '<div class="post-meta-cats-tags">';
                $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;
                $taxonomy_class = ($taxonomy_link) ? 'bdp_has_links' : 'bdp_no_links';
                if (isset($taxonomy)) {
                    if (isset($term_list) && !empty($term_list)) {
                        $sep = 1;
                        ?>
                        <div class="category-link taxonomies <?php echo $taxonomy .' '. $taxonomy_class; ?>">
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
                        </div>
                        <?php
                    }
                }
                echo '</div>';
            }
        }
    }

    bdp_get_social_icons($bdp_settings);

    do_action('bdp_after_post_content');
    ?>
</div>
<?php
