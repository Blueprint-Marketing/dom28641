<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/boxy.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;

$col_class = bdp_column_class($bdp_settings);

$class_name = "blog_template bdp_blog_template boxy blog_masonry_item";
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
    <div class="post_hentry">
         <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
        }
        ?>
        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1) {
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                ?>
                <div class="post-category">
                    <span class="category-link<?php echo ($categories_link) ? ' categories_link' : ''; ?>">
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
                    </span>
                </div>
                <?php
            }
        }
        ?>
        <div class="blog_header">
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
        <div class="post-media">
            <?php
            if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                ?>
                <div class="bdp-post-image post-video <?php echo get_post_format($post->ID); ?>">
                    <?php
                    echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                    $display_date = $bdp_settings['display_date'];
                    $display_author = $bdp_settings['display_author'];
                    if ($display_author == 1 || $display_date == 1 || $bdp_settings['display_postlike'] == 1 || $bdp_settings['display_comment_count'] == 1) {
                        $no_image = (!has_post_thumbnail() && $bdp_settings['bdp_default_image_id'] == '') ? "no_image_post" : "";
                        ?>
                        <div class="post-metadata <?php echo $no_image; ?>">
                            <?php
                            if ($display_author == 1) {
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                ?>
                                <span class="author <?php echo ($author_link) ? 'bdp_has_link' : 'bdp-no-kink'; ?>">
                                    <span class="link-lable"> <?php _e('Written by ', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </span>
                                    <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                </span>
                                <?php
                            }
                            if ($display_date == 1) {
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                ?>

                                <span class="post-date">&nbsp;
                                    <?php
                                    _e('on', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                    $ar_year = get_the_time('Y');
                                    $ar_month = get_the_time('m');
                                    $ar_day = get_the_time('d');

                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : ''
                                    ?>
                                    <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('M d') : get_the_time('M d'); ?></span>
                                    <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('Y') : get_the_time('Y'); ?></span> <?php echo '</a>'; ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                ?>
                                <span class="post-comment">
                                    <i class="fas fa-comment"></i>
                                    <span class="comment-count-inner">
                                        <?php
                                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                            comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        } else {
                                            comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        }
                                        ?>
                                    </span>
                                </span>
                                <?php
                            }
                            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <?php
            } else {
                ?>
                <div class="bdp-post-image">
                    <?php
                    $no_image = '';
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
                    } else {
                        $no_image = 'no_image_post';
                    }
                    $display_date = $bdp_settings['display_date'];
                    $display_author = $bdp_settings['display_author'];
                    if ($display_author == 1 || $display_date == 1 || $bdp_settings['display_comment_count'] == 1 || $bdp_settings['display_postlike'] == 1) {
                        ?>
                        <div class="post-metadata <?php echo $no_image; ?>">
                            <?php
                            if ($display_author == 1) {
                                ?>
                                <span class="author">
                                    <?php
                                    _e('Written by ', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                                    ?>
                                </span>
                                <?php
                            }
                            if ($display_date == 1) {
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                ?>
                                <span class="post-date">
                                    <?php
                                    echo ' ';
                                    _e('on ', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    $date_format = get_option('date_format');
                                    $ar_year = get_the_time('Y');
                                    $ar_month = get_the_time('m');
                                    $ar_day = get_the_time('d');

                                    echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : ''
                                    ?>
                                    <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('M d') : get_the_time('M d'); ?></span>
                                    <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('Y') : get_the_time('Y'); ?></span> <?php echo '</a>'; ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                ?>
                                <span class="post-comment">
                                    <i class="fas fa-comment"></i>
                                    <span class="comment-count-inner">
                                        <?php
                                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                            comments_number(__('No Comments', BLOGDESIGNERPRO_TEXTDOMAIN), '1 ' . __('comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        } else {
                                            comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                                        }
                                        ?>
                                    </span>
                                </span>
                                <?php
                            }

                            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="post_summary_outer">
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
                            <?php echo '<a class="more-tag" href="' . $post_link . '"><i class="fas fa-link"></i>' . $readmoretxt . ' </a>'; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="blog_footer">
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
                        <div class="footer_meta">
                            <div class="tags<?php echo ($tag_link) ? ' tag_link' : ''; ?>">
                                <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                                <?php
                                print_r($tags_list);
                                $show_sep = true;
                                ?>
                            </div>
                        </div>
                        <?php
                    endif;
                }
            }
            if($bdp_settings['custom_post_type'] != 'post') {
                $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'], 'objects');
                $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
                foreach ($taxonomy_names as $taxonomy) {
                    $sep = 1;
                    if ($bdp_settings["display_taxonomy_" . $taxonomy->name] == 1) {
                        $term_list = wp_get_post_terms(get_the_ID(), $taxonomy->name, array("fields" => "all"));
                        $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy->name]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy->name] == 1) ? false : true;
                        if (isset($taxonomy)) {
                            if (isset($term_list) && !empty($term_list)) {
                                ?>
                                <div class="post-category custom-post-category">
                                    <span class="link-lable"><i class="fas fa-bookmark"></i> <?php echo $taxonomy->label;?>:&nbsp;</span>
                                    <span class="category-link<?php echo ($taxonomy_link) ? '' : ' categories_link'; ?>">
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
                                    </span>
                                </div>
                                <?php
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
</div>
<?php
do_action('bdp_separator_after_post');
