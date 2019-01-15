<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/hub.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;
$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="blog_template bdp_blog_template hub">
    <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
    ?>
    <div class="post-image-content-wrap">
        <?php
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            if (get_post_format() == 'quote') {
                if (has_post_thumbnail()) {
                    $post_thumbnail = 'full';
                    $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo '<div class="upper_image_wrapper">';
                    echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                    echo '</div>';
                }
            } else if (get_post_format() == 'link') {
                if (has_post_thumbnail()) {
                    $post_thumbnail = 'full';
                    $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo '<div class="upper_image_wrapper bdp_link_post_format">';
                    echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                    echo '</div>';
                }
            } else {
                echo bdp_get_first_embed_media($post->ID, $bdp_settings);
            }
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
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
    if ($bdp_settings['display_date'] == 1) {
        $class = '';
    } else {
        $class = 'no_date';
    }
    ?>
    <div class="blog_header <?php echo $class; ?>">
        <?php
        if ($bdp_settings['display_date'] == 1) {
            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
            $ar_year = get_the_time('Y');
            $ar_month = get_the_time('m');
            $ar_day = get_the_time('d');
            ?>
            <div class="post_date">
                <?php
                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">';
                echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('d M', $post->ID) : get_post_time('d M', $post->ID);
                ?>
                <span class="number-date">
                    <?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('Y', $post->ID) : get_post_time('Y', $post->ID); ?>
                </span>
                <?php echo ($date_link) ? '</a>' : '</span>'; ?>
            </div>
        <?php } ?>
        <div class="meta_tags">
            <h2 class="post-title">
                <?php
                $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                if ($bdp_post_title_link == 1) {
                    ?><a href="<?php the_permalink(); ?>"><?php
                    }
                    echo get_the_title();
                    if ($bdp_post_title_link == 1) {
                        ?> </a> <?php }
                    ?>
            </h2>
            <div class="post-bottom">
                <?php
                if ($bdp_settings['display_author'] == 1) {
                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                    ?>
                    <span class="post-by">
                        <div class="icon-author"></div>
                        <i class="fas fa-user"></i>
                        <span>
                            <?php
                            _e('By ', BLOGDESIGNERPRO_TEXTDOMAIN);
                            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                            ?>
                        </span>
                    </span>
                    <?php
                }
                if ($bdp_settings['display_category'] == 1 && $bdp_settings['custom_post_type'] == 'post') {
                    ?>
                    <span class="categories">
                        <i class="fas fa-bookmark"></i>
                        <?php
                        $categories_list = get_the_category_list(' , ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = strip_tags($categories_list);
                        }
                        if ($categories_list):
                            echo ' ';
                            print_r($categories_list);
                            echo ' ';
                            $show_sep = true;
                        endif;
                        ?>
                    </span>
                    <?php
                }
                if ($bdp_settings['custom_post_type'] != 'post') {
                    $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
                    $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                    foreach ($taxonomy_names as $taxonomy_single) {
                        $taxonomy = $taxonomy_single->name;
                        if ($bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                            $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                            $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;
                            if (isset($taxonomy)) {
                                if (isset($term_list) && !empty($term_list)) {
                                    ?>
                                    <span class="taxonomies <?php echo $taxonomy; ?>">
                                        <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp; </span>
                                        <span class="terms"><?php
                                            foreach ($term_list as $term_nm) {
                                                $term_link = get_term_link($term_nm);
                                                echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                                echo $term_nm->name;
                                                ?><span class="seperater"><?php echo ','; ?></span> <?php
                                                echo ($taxonomy_link) ? '</a>' : '';
                                            }
                                            ?>
                                        </span>
                                    </span><?php
                                }
                            }
                        }
                    }
                }

                if ($bdp_settings['display_tag'] == 1 && $bdp_settings['custom_post_type'] == 'post') {
                    $tags_list = get_the_tag_list('', ' , ');
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                    if ($tag_link) {
                        $tags_list = strip_tags($tags_list);
                    }
                    if ($tags_list):
                        ?>
                        <span class="tags">
                            <i class="fas fa-tags"></i>
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </span><?php
                    endif;
                }
                if ($bdp_settings['display_comment_count'] == 1) {
                    ?>
                    <span class="metacomments">
                        <i class="fas fa-comments-o"></i>
                        <?php
                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                            comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            comments_popup_link(__('0 comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                        }
                        ?>
                    </span><?php
                }
                if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                    echo do_shortcode('[likebtn_shortcode]');
                }
                ?>
            </div>
        </div>
    </div>
    <div class="post_content">
        <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
    </div>
    <?php

    $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
    if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1):
        $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
        $post_link = get_permalink($post->ID);
        if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
            $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
        }
        ?>
        <span class="details">
            <?php
            echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>';
            ?>
        </span><?php endif;
        ?>

    <?php bdp_get_social_icons($bdp_settings); ?>
    <?php
    do_action('bdp_after_post_content');
    ?>
</div>
<?php
do_action('bdp_separator_after_post');
