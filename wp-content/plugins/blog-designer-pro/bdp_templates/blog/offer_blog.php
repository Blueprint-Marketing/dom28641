<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/offer_blog.php.
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
<div class="blog_template bdp_blog_template offer_blog">
    <?php do_action('bdp_before_post_content'); ?>
    <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
        }
        ?>
    <div class="middle-title">
        <div class="gravatar-img">
            <?php $user_email = get_the_author_meta('user_email'); ?>
            <?php echo get_avatar($user_email, 100); ?>
        </div>
        <div class="blog-title-meta">
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
            <div class="post-entry-meta">
                <?php
                if ($bdp_settings['display_author'] == 1) {
                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                    ?>
                    <span class="author <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                        <i class="fas fa-user"></i>
                        <span class="author-name">
                            <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                        </span>
                    </span>
                    <?php
                }
                if ($bdp_settings['display_date'] == 1) {
                    $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                    ?>
                    <span class="date">
                        <i class="far fa-clock"></i>
                        <span class="number-date"><?php
                            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                            $ar_year = get_the_time('Y');
                            $ar_month = get_the_time('m');
                            $ar_day = get_the_time('d');

                            echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                            echo $bdp_date;
                            echo ($date_link) ? '</a>' : '';
                            ?>
                        </span>
                    </span><?php
                }
                if ($bdp_settings['custom_post_type'] == 'post') {
                    if ($bdp_settings['display_category'] == 1) {
                        $categories_list = get_the_category_list(', ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        ?>
                        <span class="post-category <?php echo ($categories_link) ? 'bdp_no-links' : 'bdp_has_links'; ?>">
                            <i class="fas fa-folder-open"></i><?php
                            if ($categories_link) {
                                $categories_list = strip_tags($categories_list);
                            }
                            if ($categories_list):
                                print_r($categories_list);
                                $show_sep = true;
                            endif;
                            ?>
                        </span><?php
                    }
                }
                if ($bdp_settings['display_comment_count'] == 1) {
                    if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                        ?>
                        <span class="comment">
                            <span class="icon_cnt">
                                <i class="fas fa-comments"></i>
                                <?php
                                $comment_link = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? false : true;
                                bdp_comment_count($comment_link);
                                ?>
                            </span>
                        </span><?php
                    endif;
                }
                if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                    echo do_shortcode('[likebtn_shortcode]');
                }
                ?>
            </div>
        </div>
    </div>
    <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
        <div class="post-video">
            <?php
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
            ?>
        </div><?php
    } else {
        $post_thumbnail = 'full';
        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
        if (!empty($thumbnail)) {
            ?>
            <div class="text-center">
                <div class="bdp-post-image">
                    <?php
                    echo '<figure class="' . $image_hover_effect . '">';
                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';
                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                        echo bdp_pinterest($post->ID);
                    }
                    echo '</figure>';
                    ?>

                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="post-content-body post_content">
        <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
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
        <div class="post-bottom">
            <?php echo '<a href="' . $post_link . '">' . $readmoretxt . ' </a>'; ?>
        </div>
        <?php
    endif;
    if ($bdp_settings['custom_post_type'] == 'post') {
        if ($bdp_settings['display_tag'] == 1) {
            $tags_list = get_the_tag_list('', ' ');
            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
            if ($tag_link) {
                $tags_list = strip_tags($tags_list);
            }
            if ($tags_list):
                ?>
                <span class="tags">
                    <span><?php echo _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>&nbsp;:&nbsp;</span><?php print_r($tags_list); ?>
                </span><?php
            endif;
        }
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
                        <span class="tags taxonomies <?php echo $taxonomy; ?> <?php echo ($taxonomy_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                            <span class="link-lable"><?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;</span>
                            <?php
                                foreach ($term_list as $term_nm) {
                                    $term_link = get_term_link($term_nm);

                                    if ($sep != 1) {
                                        echo ($taxonomy_link) ? '&nbsp;' : ',&nbsp;';
                                    }
                                    echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                    echo $term_nm->name;
                                    echo ($taxonomy_link) ? '</a>' : '';
                                    $sep++;
                                }
                                ?>
                        </span><?php
                    }
                }
            }
        }
    }

    bdp_get_social_icons($bdp_settings);
    do_action('bdp_after_post_content');
    ?>
</div><?php
do_action('bdp_separator_after_post');
