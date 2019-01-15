<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/invert-grid.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post, $wp_query;
$no_image_post = '';
$post_thumbnail = '';
if (!has_post_thumbnail()) {
    $no_image_post = 'no_image_post';
}
if (isset($bdp_settings['blog_unique_design']) && $bdp_settings['blog_unique_design'] != "") {
    $blog_unique_design = $bdp_settings['blog_unique_design'];
} else {
    $blog_unique_design = 0;
}
$unique_design_option = isset($bdp_settings['unique_design_option']) ? $bdp_settings['unique_design_option'] : '';

if ($blog_unique_design == 1 && $unique_design_option == 'first_post' && $alter_val == 1 && $prev_year == 0 && $paged == 1) {
    $post_thumbnail = 'full';
    echo '<div class="invert-grid-wrap first_post">';
} elseif ($blog_unique_design == 1 && $unique_design_option == 'featured_posts' && $alter_val <= $count_sticky && $prev_year == 0 && $paged == 1) {
    $post_thumbnail = 'full';
    echo '<div class="invert-grid-wrap first_post">';
} else {
    if ($blog_unique_design != 1 && $alter_val == 1) {
        echo '<div class="invert-grid-wrapper">';
    } elseif ($paged > 1 && $alter_val == 1) {
        echo '<div class="invert-grid-wrapper">';
    } elseif ($blog_unique_design == 1 && $unique_design_option == 'first_post' && $paged == 1 && $alter_val == 2) {
        echo '<div class="invert-grid-wrapper">';
    } elseif ($blog_unique_design == 1 && $unique_design_option == 'featured_posts' && $paged == 1) {
        $count_sticky = $count_sticky + 1;
        if ($alter_val == $count_sticky) {
            echo '<div class="invert-grid-wrapper">';
        }
    }
}
?>
<div class="blog_template bdp_blog_template invert-grid <?php echo get_post_format($post->ID); ?>">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="post-body-div">
        <?php
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            ?>
            <div class="post-video bdp-video">
                <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
            </div>
            <?php
        } else {
            ?>
            <?php
            $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
            if($label_featured_post != '' && is_sticky()) {
                ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
            }
            ?>
            <div class="bdp-post-image">
                <?php
                $post_link = get_permalink($post->ID);
                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                }

                if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                    echo bdp_pinterest($post->ID);
                }
                echo '<a href="' . $post_link . '">';
                if ($post_thumbnail == '') {
                    $post_thumbnail = 'invert-grid-thumb';
                }
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);

                $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1):
                    $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                    ?>
                    <span class="read-more">
                        <span>
                            <?php
                            echo $readmoretxt;
                            ?>
                        </span>
                    </span>
                    <?php
                endif;
                echo '</a>';
                ?>
            </div>
        <?php } ?>
        <h2 title="<?php echo get_the_title(); ?>">
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
        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1) {
                ?>
                <span class="category-link <?php echo $no_image_post; ?>">
                    <?php
                    $categories_list = get_the_category_list(', ');
                    $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                    if ($categories_link) {
                        $categories_list = strip_tags($categories_list);
                    }
                    if ($categories_list):
                        echo ' ';
                        print_r($categories_list);
                        $show_sep = true;
                    endif;
                    ?>
                </span>
                <?php
            }
        }
        ?>
        <div class="post_content">
            <?php
            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
            ?>
        </div>
        <div class="metadatabox">
            <?php
            $display_author = $bdp_settings['display_author'];
            $display_date = $bdp_settings['display_date'];

            if ($display_author == 1 || $display_date == 1) {
                ?>
                <span><?php _e('Posted ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                <?php
            }
            if ($display_author == 1) {
                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                ?>
                <span class="post-author <?php echo (!$author_link) ? 'bdp_no_links' : ''; ?>">
                    <?php
                    echo '<span class="link-lable">'. __('by ', BLOGDESIGNERPRO_TEXTDOMAIN) .'</span>';
                    echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                    ?>
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
                <span class="mdate">
                    <?php
                    echo __('on', BLOGDESIGNERPRO_TEXTDOMAIN) . '&nbsp;';
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
                    <?php if ($bdp_settings['display_author'] == 1 || $display_date == 1) { ?>- <?php
                    }
                    if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                        comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                    } else {
                        comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                    }
                    ?>
                </span>
                <?php
            }
            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                echo do_shortcode('[likebtn_shortcode]');
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
                        <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : ''; ?>">
                            <i class="fas fa-tags"></i>
                            <?php
                            print_r($tags_list);
                            $show_sep = true;
                            ?>
                        </div><?php
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
                                <div class="taxonomies <?php echo $taxonomy; ?>">
                                    <div class="tags <?php echo $no_image_post; ?>">
                                        <span class="link-lable"> <i class="fas fa-folder-open"></i> <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;</span>
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
                                </div><?php
                            }
                        }
                    }
                }
            }
            ?>
        </div>
        <?php bdp_get_social_icons($bdp_settings); ?>
        <div class="clear"></div>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div>
<?php
do_action('bdp_separator_after_post');


if ($blog_unique_design == 1 && $unique_design_option == 'first_post' && $prev_year == 0 && $paged == 1 && $alter_val == 1) {
    echo '</div>';
} elseif ($blog_unique_design == 1 && $unique_design_option == 'featured_posts' && $alter_val <= $count_sticky && $prev_year == 0 && $paged == 1) {
    echo '</div>';
} elseif ($prev_year == 1 && $wp_query->post_count == $alter_val) {
    echo '</div>';
} elseif ($blog_unique_design != 1 && $wp_query->post_count == $alter_val) {
    echo '</div>';
}