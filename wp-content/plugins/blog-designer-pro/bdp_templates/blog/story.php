<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/story.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;
$format = get_post_format($post->ID);
$line_col_bottom = 'line-col-bottom-secound';
$date_class = 'date-icon-rights';
$entity_content = 'entity-content-right';
$curv_line = 'line-col-left';
$year_class = 'right-year';
$eding_class = 'right_ending';
if ($alter_class % 2 != 0) {
    $line_col_bottom = 'line-col-top';
    $date_class = 'date-icon-left';
    $entity_content = 'entity-content-left';
    $curv_line = 'line-col-right';
    $year_class = 'left-year';
    $eding_class = 'left_ending';
}

$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="blog_template bdp_blog_template story blog-wrap yearly-info">
    <?php
    do_action('bdp_before_post_content');
    $this_year = get_the_date('Y');
    if ($prev_year == 0 || $prev_year == $this_year) {
        $prev_year = $this_year;
    } else {
        $prev_year = '';
    }
    ?>
    <div class="<?php echo $line_col_bottom; ?>">
        <?php
        $display_story_year = isset($bdp_settings['display_story_year']) ? $bdp_settings['display_story_year'] : 1;
        if ($display_story_year == 1) {
            if ($prev_year != 0) {
                ?>
                <span class="year-number <?php echo $year_class; ?>">
                    <?php echo $prev_year; ?>
                </span>
                <?php
            }
        }
        ?>
    </div>
    <?php
    global $wp_query;
    $story_ending_text = isset($bdp_settings['story_ending_text']) ? $bdp_settings['story_ending_text'] : '';
    $story_ending_link = isset($bdp_settings['story_ending_link']) ? $bdp_settings['story_ending_link'] : '';
    if ($wp_query->current_post + 1 == $wp_query->post_count && $story_ending_text != '' && $bdp_settings['pagination_type'] == 'no_pagination') {
        ?>
        <span class="startup ending <?php echo $eding_class; ?>">
            <span>
                <?php if ($story_ending_link != '') { ?>
                    <a href="<?php echo $story_ending_link; ?>"><?php echo $story_ending_text; ?></a>
                    <?php
                } else {
                    echo $story_ending_text;
                }
                ?>
            </span>
        </span>
    <?php } ?>
    <?php
    $story_startup_text = isset($bdp_settings['story_startup_text']) ? $bdp_settings['story_startup_text'] : '';
    if ($alter_class == 1 && $story_startup_text != '') {
        ?>
        <span class="startup"><span><?php echo $story_startup_text; ?></span></span>
    <?php }
    ?>
    <div class="post_hentry">
        <?php
        $display_date = isset($bdp_settings['display_date']) ? $bdp_settings['display_date'] : 1;
        $ar_year = get_the_time('Y');
        $ar_month = get_the_time('m');
        $ar_day = get_the_time('d');

        if ($display_date == 1) {
            ?>
            <div class="date-icon date-icon-arrow-bottom <?php echo $date_class; ?>">
                <?php echo get_the_date('n/j'); ?>
                <div class="dote dote-bottom">
                    <span></span><span></span><span></span>
                </div>
            </div>
        <?php } ?>
        <div class="entity-content animateblock <?php
        echo $entity_content;
        echo ' ';
        echo (isset($bdp_settings['post_loop_alignment']) && $bdp_settings['post_loop_alignment'] != '') ? $bdp_settings['post_loop_alignment'] : 'default';
        ?>">
            <?php
            $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
            if($label_featured_post != '' && is_sticky()) {
                ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
            }
            ?>
            <div class="blog_post_wrap
            <?php
            echo (!bdp_get_first_embed_media($post->ID, $bdp_settings) && !has_post_thumbnail() && $bdp_settings['bdp_default_image_id'] == '') ? 'no-post-media' : '';
            echo ' ';
            echo (isset($bdp_settings['post_loop_alignment']) && $bdp_settings['post_loop_alignment'] != '') ? $bdp_settings['post_loop_alignment'] : 'default';
            ?>">
                <h2 class="blog_header">
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
                if (bdp_get_first_embed_media($post->ID, $bdp_settings) || has_post_thumbnail() || ( isset($bdp_settings['bdp_default_image_id']) && $bdp_settings['bdp_default_image_id'] != '')) {
                    ?>
                    <div class="post-media <?php
                    echo get_post_format();
                    echo ' ';
                    echo (isset($bdp_settings['thumbnail_skin']) && $bdp_settings['thumbnail_skin'] == 1) ? 'circle' : 'square';
                    ?>">
                             <?php
                             if (bdp_get_first_embed_media($post->ID, $bdp_settings)) {
                                 echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                             } else {
                                 $post_thumbnail = 'thumbnail';
                                 $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                                 $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                                 if (!empty($thumbnail)) {
                                     echo '<figure class="' . $image_hover_effect . '">';
                                     echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                                     echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                                     echo ($bdp_post_image_link) ? '</a>' : '';
                                     echo '</figure>';
                                 }
                             }
                             ?>
                    </div>
                    <?php
                }
                ?>

                <div class="post_content">
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
                            <?php
                            echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>';
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <?php
                $display_author = $bdp_settings['display_author'];
                $display_comment_count = $bdp_settings['display_comment_count'];
                if ($display_author == 1 || $display_comment_count == 1 || ( isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1 )) {
                    ?>
                    <div class="post-metadata">
                        <?php
                        if ($display_author == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <span class="author">
                                <span class="link-lable"><?php _e('Written by ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                <?php
                                echo (!$author_link) ? '<span class="author-inner">' : '';
                                echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                                echo (!$author_link) ? '</span>' : '';
                                ?>
                            </span>
                            <?php
                        }
                        if ($bdp_settings['display_comment_count'] == 1) {
                            ?>
                            <span class="post-comment">
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
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
                        ?>
                    </div>
                    <?php
                }
                ?>

                <div class="blog_footer">
                    <div class="footer_meta">
                        <?php
                        $custom_post_type = $bdp_settings['custom_post_type'];
                        if ($custom_post_type == 'post') {
                            if ($bdp_settings['display_category'] == 1) {
                                $categories_list = get_the_category_list(', ');
                                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                                ?>
                                <span class="category-link <?php echo ($categories_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                    <?php
                                    if ($categories_link) {
                                        $categories_list = strip_tags($categories_list);
                                    }
                                    if ($categories_list):
                                        ?>
                                        <span class="link-lable"> <i class="fas fa-folder"></i> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                        <?php
                                        echo ' ';
                                        print_r($categories_list);
                                        $show_sep = true;
                                    endif;
                                    ?>
                                </span>
                                <?php
                            }
                            if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
                                $tags_list = get_the_tag_list('', ', ');
                                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                                if ($tag_link) {
                                    $tags_list = strip_tags($tags_list);
                                }
                                if ($tags_list):
                                    ?>
                                    <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                        <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                        <?php
                                        print_r($tags_list);
                                        $show_sep = true;
                                        ?>
                                    </div>
                                    <?php
                                endif;
                            }
                        } else {
                            $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
                            $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                            foreach ($taxonomy_names as $taxonomy_single) {
                                $taxonomy = $taxonomy_single->name;
                                $sep = 1;
                                if (isset($bdp_settings["display_taxonomy_" . $taxonomy]) && $bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                                    $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                                    $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;
                                    if (isset($taxonomy)) {
                                        if (isset($term_list) && !empty($term_list)) {
                                            ?>
                                            <span class="category-link <?php echo ($taxonomy_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
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
                                            </span><?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php bdp_get_social_icons($bdp_settings); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo $curv_line; ?>"></div>
    <?php do_action('bdp_after_post_content'); ?>
</div>
<?php
do_action('bdp_separator_after_post');
