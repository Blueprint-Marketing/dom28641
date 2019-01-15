<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/crayon_slider.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;
$class_name = "blog_template bdp_blog_template crayon_slider";
$bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
$slider_column = 1;
if ($bdp_settings['template_slider_effect'] == 'slide') {
    $slider_column = isset($bdp_settings['template_slider_columns']) ? $bdp_settings['template_slider_columns'] : 1;
}
$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<li class="<?php echo $class_name . ' columns_' . $slider_column; ?>">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="post_hentry">
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
        ?>
        <div class="bdp-post-image">
            <?php
            $post_thumbnail = 'full';
            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
            $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
            if (!empty($thumbnail)) {
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
            }
            ?>
        </div>
        <div class="blog_header">
            <?php
            if ($bdp_settings['custom_post_type'] == 'post') {
                if ($bdp_settings['display_category'] == 1) {
                    ?>
                    <div class="category-link">
                        <?php
                        $categories_list = get_the_category_list(' ');
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        if ($categories_link) {
                            $categories_list = get_the_category_list(', ');
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
            }
            ?>
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
            if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1 || $bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                ?>
                <div class="metadatabox">
                    <?php
                    if ($bdp_settings['display_author'] == 1 || $bdp_settings['display_date'] == 1) {
                        if ($bdp_settings['display_author'] == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            $author_class = (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1 && get_post_format($post->ID) != 'gallery') ? 'class="post-video-format"' : '';
                            ?>
                            <div class="mauthor">
                                <span class="author <?php echo (!$author_link) ? 'bdp-no-links' : ''; ?>">
                                <i class="fas fa-user"></i>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                </span>
                            </div>
                            <?php
                        }
                        if ($bdp_settings['display_date'] == 1) {
                            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                            ?>
                            <div class="post-date">
                                <?php
                                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');

                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '"><i class="far fa-calendar-alt"></i>' : '<i class="far fa-calendar-alt"></i>';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                ?>

                            </div>
                            <?php
                        }
                    }
                    if ($bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                        if ($bdp_settings['display_comment_count'] == 1) {
                            ?>
                            <div class="post-comment">
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number('<i class="fas fa-comment"></i>' . __('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>' . __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                } else {
                                    comments_popup_link('<i class="fas fa-comment"></i>' . __('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>' . __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '<i class="fas fa-comment"></i>% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', '<i class="fas fa-comment"></i>' . __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                }
                                ?>
                            </div>
                            <?php
                        }

                        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                            echo '<div class="postlike_btn">';
                            echo do_shortcode('[likebtn_shortcode]');
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="post_content">
                <div class="post_content-inner">
                    <?php
                    echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

                    $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                    if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1) {
                        $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                        $post_link = get_permalink($post->ID);
                        if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                            $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                        }
                        ?>
                        <div class="read-more">
                            <?php echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>'; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            if ($bdp_settings['custom_post_type'] == 'post') {
                if ($bdp_settings['display_tag'] == 1) {
                    $tags_list = get_the_tag_list('', ', ');
                    $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                    if ($tag_link) {
                        $tags_list = strip_tags($tags_list);
                    }
                    if ($tags_list):
                        ?>
                        <div class="tags<?php echo ($tag_link) ? ' tag_link' : ''; ?>">
                            <i class="fas fa-bookmark"></i>&nbsp;
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </div>
                        <?php
                    endif;
                }
            }

            if($bdp_settings['custom_post_type'] != 'post') {
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
                                ?>
                                <div class="tags <?php echo ($taxonomy_link) ?'bdp-has-links' : 'tag_link'?>">
                                    <span class="link-lable"> <i class="fas fa-folder"></i> <?php echo $taxonomy_single->label; ?>:&nbsp; </span>
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
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</li>
<?php
do_action('bdp_separator_after_post');
