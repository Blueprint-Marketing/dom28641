<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/clicky.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;

$image_hover_effect = '';
if(isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="bdp_blog_template blog_template clicky <?php echo get_post_format() .' '. $alter_class; ?>">
    <?php do_action('bdp_before_post_content'); ?>
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
        ?>
    <div class="bdp-post-image">
        <div class="clicky-wrap-middel">
            <?php
            if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                $class = (get_post_format() == 'video') ? 'post-video bdp-video' : 'post-video';
                echo '<div class="'. $class .'">';
                echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                echo '</div>';
            } else {
                $post_thumbnail = 'clicky-thumbnail';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                $image_class = (isset($bdp_settings['thumbnail_skin']) && $bdp_settings['thumbnail_skin'] == 1) ? ' circle' : '';
                echo '<figure class="'. $image_hover_effect .' '. $image_class .'">';
                echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="clicky-img-link">' : '';
                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                echo ($bdp_post_image_link) ? '</a>' : '';

                if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && !empty($thumbnail)) {
                    ?>
                    <div class="bdp-pinterest-share-image">
                        <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                        <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                    </div>
                    <?php
                }
                echo '</figure>';

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
            ?>
        </div>
    </div>

    <div class="clicky-wrap">
        <div class="clicky-wrap-middel">
            <?php
            $display_date = $bdp_settings['display_date'];
            $display_author = $bdp_settings['display_author'];
            $display_comment_count = $bdp_settings['display_comment_count'];
            $display_postlike = $bdp_settings['display_postlike'];

            if($display_author == 1 || $display_date == 1 || $display_comment_count == 1 || $display_postlike == 1) {
                echo '<div class="metadatabox">';
                if ($display_author == 1) {
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        ?>
                        <span <?php echo (!$author_link) ? 'class="bdp-no-links"' : '';?>>
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
                        <span class="mdate <?php echo (!$date_link) ? 'bdp-no-links' : '';?>">
                            <?php
                            echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                            echo $bdp_date;
                            echo ($date_link) ? '</a>' : '';
                            ?>
                        </span>
                        <?php
                    }

                    if ($display_comment_count == 1) {
                        $disable_link_comment = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? true : false;
                        ?>
                        <span class="metacomments <?php echo ($disable_link_comment) ? 'bdp-no-links' : '';?>">
                            <?php
                            if ($disable_link_comment) {
                                comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                            } else {
                                comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
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
            ?>

            <h2 class="post-title">
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

            <div class="post_content">
                <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
            </div>

            <?php
            if ($bdp_settings['custom_post_type'] == 'post') {
                if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                    echo '<div class="post-meta-cats-tags">';
                }

                if ($bdp_settings['display_category'] == 1) {
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    ?>
                    <div class="category-link<?php echo ($categories_link) ? ' bdp-no-links' : ''; ?>">
                        <span class="link-lable"> <i class="fas fa-folder-open"></i> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
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
                        <div class="tags tag_link<?php echo ($tag_link) ? ' bdp-no-links' : ''; ?>">
                            <span class="link-lable"> <i class="fas fa-tags"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </div>
                        <?php
                    endif;
                }

                if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
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
                                $sep = 1;
                                echo '<div class="post-meta-cats-tags">';
                                ?>
                                <span class="category-link taxonomies <?php echo $taxonomy; ?> <?php echo ($taxonomy_link) ? ' bdp-has-links' : 'bdp-no-links'; ?>">
                                    <span class="link-lable"> <i class="fas fa-folder-open"></i> <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp; </span>
                                    <span class="category-link<?php echo ($taxonomy_link) ? ' categories_link' : ''; ?>"><?php
                                        foreach ($term_list as $term_nm) {
                                            $term_link = get_term_link($term_nm);

                                            if ($sep != 1) {
                                                ?><span class="seperater"><?php echo ', '; ?></span><?php
                                            }
                                            echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                            echo $term_nm->name;
                                            echo ($taxonomy_link) ? '</a>' : '';
                                            $sep++;
                                        }
                                        ?>
                                    </span>
                                </span>
                                <?php
                                echo '</div>';
                            }
                        }
                    }
                }
            }
            ?>

            <?php bdp_get_social_icons($bdp_settings); ?>
        </div>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div><?php
