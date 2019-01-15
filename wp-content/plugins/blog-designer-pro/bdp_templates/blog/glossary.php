<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/glamour.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;

$col_class = bdp_column_class($bdp_settings);

$class_name = "blog_template bdp_blog_template glossary blog_masonry_item";
if ($col_class != '') {
    $class_name .= " " . $col_class;
}
$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}
?>
<div class="<?php echo $class_name; ?>">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="blog_item">
        <div class="blog_header"> <?php
            $display_date = $bdp_settings['display_date'];
            $display_author = $bdp_settings['display_author'];
            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
            $commentCnt = $bdp_settings['display_comment_count'];
            $ar_year = get_the_time('Y');
            $ar_month = get_the_time('m');
            $ar_day = get_the_time('d');
            if ($display_author == 1 || $display_date == 1 || $commentCnt == 1 || $bdp_settings['display_postlike'] == 1) {
                ?>
                <div class="posted_by">
                    <?php
                    if ($display_author == 1 && $display_date == 1 || $bdp_settings['display_postlike'] == 1) {
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;

                        echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                        ?>
                        <time datetime="" class="datetime">
                            <?php echo $bdp_date; ?>
                        </time>
                        <?php
                        echo ($date_link) ? '</a>' : '';
                        ?>
                        <span class="post-author <?php echo (!$author_link) ? 'bdp_no_links' : ''; ?>">&nbsp; | &nbsp;
                            <?php
                            echo '<span class="link-lable">'.  __('By ', BLOGDESIGNERPRO_TEXTDOMAIN) . '</span>';
                            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                            ?>
                        </span>
                        <?php
                    } elseif ($display_author == 1) {
                        $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                        ?>
                        <div class="icon-date"></div>
                        <span class="post-author <?php echo (!$author_link) ? 'bdp_no_links' : ''; ?>">
                            <?php
                            echo '<span class="link-lable">'.  __('By ', BLOGDESIGNERPRO_TEXTDOMAIN) . '</span>';
                            echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                            ?>
                        </span>

                        <?php
                    } elseif ($display_date == 1) {
                        $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                        echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                        ?>
                        <time datetime="" class="datetime">
                            <?php echo apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID); ?>
                        </time>
                        <?php
                        echo ($date_link) ? '</a>' : '';
                    }
                    if ($commentCnt == 1) {
                        if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                            ?>
                            <span class="comment">
                                <?php
                                echo (($display_author == 1 && $display_date == 1) || ($display_author == 1 || $display_date == 1)) ? " | " : "";
                                $comment_link = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? false : true;
                                bdp_comment_count($comment_link);
                                ?>
                            </span>
                            <?php
                        endif;
                    }
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    ?>
                </div><?php }
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
        </div>
        <div class="post_summary_outer">
            <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
                <div class="post-video">
                    <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
                </div><?php
            } else {
                $post_thumbnail = 'full';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                if (!empty($thumbnail)) {
                    ?>
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                    }
                    ?>
                    <div class="bdp-post-image">
                        <?php
                        echo '<figure class="' . $image_hover_effect . '">';
                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                            echo bdp_pinterest($post->ID);
                        }
                        echo '</figure>';
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="post_content">
                <div class="post_content-inner">
                    <?php if ($bdp_settings['rss_use_excerpt'] == 0): ?>
                        <div class="content_upper_div">
                            <?php
                            $content = apply_filters('the_content', get_the_content($post->ID));
                            $content = apply_filters('bdp_content_change', $content, $post->ID);
                            echo $content;
                            ?>
                        </div>
                        <?php
                    else:
                        $template_post_content_from = 'from_content';
                        if (isset($bdp_settings['template_post_content_from'])) {
                            $template_post_content_from = $bdp_settings['template_post_content_from'];
                        }
                        if ($template_post_content_from == 'from_excerpt') {
                            if (get_the_excerpt() != '') {
                                $bdp_excerpt_data = get_the_excerpt(get_the_ID());
                            } else {
                                $excerpt = get_the_content($post->ID);
                                $excerpt_length = $bdp_settings['txtExcerptlength'];
                                $text = strip_shortcodes($excerpt);
                                $text = apply_filters('the_content', $text);
                                $text = str_replace(']]>', ']]&gt;', $text);
                                $bdp_excerpt_data = wp_trim_words($text, $excerpt_length, '');
                                $bdp_excerpt_data = apply_filters('bdp_excerpt_change', $bdp_excerpt_data, $post->ID);
                            }
                        } else {
                            $excerpt = get_the_content($post->ID);
                            $excerpt_length = $bdp_settings['txtExcerptlength'];
                            $text = strip_shortcodes($excerpt);
                            $text = apply_filters('the_content', $text);
                            $text = str_replace(']]>', ']]&gt;', $text);
                            $bdp_excerpt_data = wp_trim_words($text, $excerpt_length, '');
                            $bdp_excerpt_data = apply_filters('bdp_excerpt_change', $bdp_excerpt_data, $post->ID);
                        }
                        if ($bdp_excerpt_data != '') {
                            ?>
                            <p><?php echo $bdp_excerpt_data; ?></p>

                            <?php
                            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                            if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] != 0) {
                                $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                                $post_link = get_permalink($post->ID);
                                if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                                    $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                                }
                                ?>
                                <div class="overlay" style="background:<?php echo bdp_hex2rgba($bdp_settings['template_content_hovercolor'], 0.9); ?>">
                                    <div class="read-more-class">
                                        <?php echo '<a class="more-tag" href="' . $post_link . '"><i class="fas fa-link"></i>' . $readmoretxt . ' </a>'; ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    endif;
                    ?>
                </div>
            </div>
        </div>

        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
                ?>
                <div class="blog_footer">
                    <div class="footer_meta">
                        <?php
                        if ($bdp_settings['display_category'] == 1) {
                            $categories_list = get_the_category_list(', ');
                            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                            ?>
                            <span class="category-link <?php echo ($categories_link) ? 'bdp_no_links' : ''; ?>">
                                <span class="link-lable"> <i class="fas fa-folder"></i><?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?>&nbsp;:&nbsp; </span>
                                <?php
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
                        if ($bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : ''; ?>">
                                    <span class="link-lable"> <i class="fas fa-bookmark"></i><?php _e('Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?>&nbsp;:&nbsp; </span>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </div><?php
                            endif;
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }else {
            $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
            $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
            if (!empty($taxonomy_names)) {
                ?>
                <div class="blog_footer">
                    <?php
                    foreach ($taxonomy_names as $taxonomy_single) {
                        $taxonomy = $taxonomy_single->name;
                        $sep = 1;
                        if ($bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                            $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                            $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;

                            if (isset($taxonomy)) {
                                if (isset($term_list) && !empty($term_list)) {
                                    ?>
                                    <div class="footer_meta">
                                        <span class="category-link">
                                            <span class="link-lable"> <i class="fas fa-folder"></i><?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;</span>
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
                                        </span>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            }
        }
        ?>
        <?php
        bdp_get_social_icons($bdp_settings);
        ?>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div>
<?php
do_action('bdp_separator_after_post');
