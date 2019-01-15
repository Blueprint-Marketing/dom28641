<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/pretty.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;
$left_after = '';

$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="blog_template bdp_blog_template pretty">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="entry-container">
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
        ?>
        <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
            <div class="bdp-post-image post-video">
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
            </div>
            <?php
        } else {
            $post_thumbnail = 'full';
            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
            if (!empty($thumbnail)) {
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                $left_after = 'post-has-image';
                ?>
                <div class="bdp-post-image post-has-image">
                    <?php
                    echo '<figure class="' . $image_hover_effect . '">';
                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';

                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                        echo bdp_pinterest($post->ID);
                    }
                    echo '</figure>';
                    ?>
                </div>
                <?php
            }
        }
        ?>
        <div class="blog_header">
            <div class="left-content-wrapper <?php echo $left_after; ?>"></div>
            <div class="right-content-wrapper">
                <div class="blog_header_meta_wrapper">
                    <h2>
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
                    $display_author = $bdp_settings['display_author'];
                    $display_comment_count = $bdp_settings['display_comment_count'];
                    $ar_year = get_the_time('Y');
                    $ar_month = get_the_time('m');
                    $ar_day = get_the_time('d');
                    if ($display_author == 1 || $bdp_settings['display_postlike'] == 1 || $display_comment_count == 1 || ($bdp_settings['display_category'] == 1 && $bdp_settings['custom_post_type'] == 'post')) {
                        ?>
                        <div class="metadatabox">
                            <?php
                            if ($bdp_settings['display_author'] == 1) {
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                ?>
                                <span class="author <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                    <i class="fas fa-user"></i>
                                    <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings);?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                $comment_link = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? false : true;
                                if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                                    ?>
                                    <span class="comment <?php echo ($comment_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                        <span class="icon_cnt">
                                            <i class="fas fa-comment"></i>
                                            <?php

                                            bdp_comment_count($comment_link); //comments_popup_link('0', '1', '%');
                                            ?>
                                        </span>
                                    </span>
                                    <?php
                                endif;
                            }
                            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            if ($bdp_settings['display_category'] == 1 && $bdp_settings['custom_post_type'] == 'post') {
                                $categories_list = get_the_category_list(' , ');
                                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                                ?>
                                <span class="categories <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <i class="fas fa-bookmark"></i>
                                    <?php
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
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="blog-header-avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 70); ?>
                </div>
                <?php
                if ($bdp_settings['display_date'] == 1) {
                    $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                    $ar_year = get_the_time('Y');
                    $ar_month = get_the_time('m');
                    $ar_day = get_the_time('d');
                    ?>
                    <div class="post_date">
                        <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">'; ?>
                        <span class="date"><?php the_time('d'); ?></span>
                        <span class="month"><?php the_time('F'); ?></span>
                        <span class="year"><?php the_time('Y'); ?></span>
                        <?php echo ($date_link) ? '</a>' : '</span>'; ?>
                    </div>
                <?php } ?>
                <div class="post_content">
                    <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
                </div>
                <?php
                if ($bdp_settings['custom_post_type'] == 'post') {
                    if ($bdp_settings['display_tag'] == 1) {
                        echo '<div class="post-meta-cats-tags">';
                    }
                    if ($bdp_settings['display_tag'] == 1) {
                        $tags_lists = get_the_tags();
                        $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true  ;
                        if (!empty($tags_lists)) {
                            ?>
                            <div class="tags<?php echo ($tag_link) ? ' bdp_has_link' : ' bdp_no_links'; ?>">
                                <?php
                                _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN);
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
                                ?>
                            </div>
                            <?php
                        }
                    }
                    if ($bdp_settings['display_tag'] == 1) {
                        echo '</div>';
                    }
                } else {
                    $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
                    $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);

                    foreach ($taxonomy_names as $taxonomy_single) {
                        $taxonomy = $taxonomy_single->name;
                        if ($bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                            $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                            $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;
                            if (isset($taxonomy)) {
                                if (isset($term_list) && !empty($term_list)) {
                                    echo '<div class="post-meta-cats-tags">';
                                    ?>
                                    <div class="tags taxonomies<?php echo ($taxonomy_link) ? ' bdp_no_links' : ' bdp_has_link'; ?>">

                                            <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;
                                            <?php
                                            foreach ($term_list as $term_nm) {
                                                $term_link = get_term_link($term_nm);
                                                echo '<span class="tag">';
                                                echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                                echo $term_nm->name;
                                                echo ($taxonomy_link) ? '</a>' : '';
                                                echo '</span>';
                                            }
                                            ?>
                                    </div>
                                    <?php
                                    echo '</div>';
                                }
                            }
                        }
                    }
                }
                ?>
                <div class="entry-meta clearfix">
                    <div class="read-more-wrapper">
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
                    </div>
                    <div class="pull-left social-component-count-<?php echo $bdp_settings['social_count_position']; ?>">
                        <?php bdp_get_social_icons($bdp_settings); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div>
<?php
do_action('bdp_separator_after_post');
