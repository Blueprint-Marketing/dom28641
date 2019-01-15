<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/chapter.php.
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
<div class="bdp_blog_template chapter-post-wrapper">
    <div class="chapter-post-container">
        <?php
                $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                if($label_featured_post != '' && is_sticky()) {
                    ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                }
                ?>
        <?php
        $post_thumbnail = 'full';
        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
        if (!empty($thumbnail)) {
            echo '<figure class="' . $image_hover_effect . '">';
            echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="chapter-img-link">' : '';
            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
            echo ($bdp_post_image_link) ? '</a>' : '';

            if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                ?>
                <div class="bdp-pinterest-share-image">
                    <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                    <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                </div>
                <?php
            }
            echo '</figure>';
        }
        ?>
        <div class="chapter-header">
            <?php
            if ($bdp_settings['custom_post_type'] == 'post' && $bdp_settings['display_category'] == 1) {
                ?>
                <div class="post-categories">
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
            ?>

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

            <?php
            if ($bdp_settings['txtExcerptlength'] > 0) {
                ?>
                <div class="post-content">
                    <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
                </div>
                <?php
            }

            if ($bdp_settings['custom_post_type'] == 'post') {
                if ($bdp_settings['display_tag'] == 1) {
                    $tags_list = get_the_tag_list('', ', ');
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                    if ($tag_link) {
                        $tags_list = strip_tags($tags_list);
                    }
                    if ($tags_list):
                        ?>
                        <div class="tags">
                            <span class="link-lable"> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>&nbsp;:&nbsp; </span>
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </div>
                        <?php
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
                                <div class="post-categories">
                                    <strong><?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;</strong>
                                    <?php
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
                                </div>
                                <?php
                            }
                        }
                    }
                }
            }

            bdp_get_social_icons($bdp_settings);
            ?>
        </div>
        <?php
        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
        if ($read_more_link == 1 || $bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1 || $bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
            ?>
            <div class="chapter-footer">
                <?php
                if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
                    $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                    $post_link = get_permalink($post->ID);
                    if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                        $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                    }
                    ?>
                    <div class="read-more-div">
                        <a class="more-tag" href="<?php echo $post_link; ?>">
                            <?php echo $readmoretxt; ?>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php
                }

                if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1 || $bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                    ?>
                    <div class="post-meta">
                        <?php
                        if ($bdp_settings['display_author'] == 1) {
                            echo '<div class="post-author">';
                            echo '<i class="fas fa-user"></i>';
                            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                            echo '</div>';
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

                                echo ($date_link) ? '<a class="mdate" href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo '<i class="far fa-calendar-alt"></i>';
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
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    </div>
</div>
