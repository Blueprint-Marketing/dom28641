<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/roctangle.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $post;
?>
<div class="bdp_blog_template roctangle-post-wrapper blog_masonry_item">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="post-image-wrap">
        <?php
        $thumbnail_class = 'bdp-has-thumbnail';
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            $thumbnail_class = 'bdp-no-thumbnail';
            echo '<div class="post-video bdp-video">';
            echo bdp_get_first_embed_media($post->ID, $bdp_settings);
            echo '</div>';
        } else {
            ?>
            <figure class="post-image bdp-post-image">
                <?php
                $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                if($label_featured_post != '' && is_sticky()) {
                    ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                }
                ?>
                <?php
                $post_thumbnail = 'deport-thumbnail';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                if (!empty($thumbnail)) {
                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';
                }

                if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                    ?>
                    <div class="bdp-pinterest-share-image">
                        <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                        <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                    </div>
                    <?php
                }
                ?>
            </figure>
            <?php
        }
        ?>
        <div class="post-meta-wrapper <?php echo $thumbnail_class; ?>">
            <?php
            $display_date = $bdp_settings['display_date'];
            $display_author = $bdp_settings['display_author'];
            $display_postlike = $bdp_settings['display_postlike'];
            $display_comment_count = $bdp_settings['display_comment_count'];

            if($display_date == 1) {
                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                $ar_year = get_the_time('Y');
                $ar_month = get_the_time('m');
                $ar_day = get_the_time('d');
                ?>
                <div class="post_date">
                    <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">'; ?>
                    <span class="date"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('d') : get_the_time('d'); ?></span>
                    <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('M') : get_the_time('M'); ?></span>
                    <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_the_modified_time('Y') : get_the_time('Y'); ?></span>
                    <?php echo ($date_link) ? '</a>' : '</span>'; ?>
                </div>
                <?php
            }

            if($display_author == 1 || $display_postlike == 1 || $display_comment_count == 1) {
                if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                    echo '<div class="post-meta-div-cover">';
                }
                if($display_author == 1 || $display_postlike == 1) {
                    ?> <div class="post-meta-div"> <?php
                        if($display_author == 1) {
                            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                            ?>
                            <span class="author">
                                <i class="fas fa-user"></i>
                                <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                            </span>
                            <?php
                        }
                        if($display_postlike == 1) {
                            echo do_shortcode('[likebtn_shortcode]');
                        }
                    ?> </div> <?php
                }

                if($display_comment_count == 1 && !post_password_required()) {
                    if ( comments_open() || get_comments_number()) {
                        ?>
                        <span class="post-comment">
                            <i class="fas fa-comment-o"></i>
                            <?php
                            if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                comments_number('0', '1', '%');
                            } else {
                                comments_popup_link('0', '1', '%');
                            }
                            ?>
                        </span>
                        <?php
                    }
                }

                if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    <div class="post-content-wrapper <?php echo $thumbnail_class;?>">
        <div class="post-title">
            <h2>
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
        </div>

        <div class="post-content">
            <?php
            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
            ?>
        </div>

        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1) {
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? false : true;
                $categories_list = get_the_category();
                if (!empty($categories_list)) {
                    ?>
                    <div class="category-link<?php echo ($categories_link) ? ' categories_link' : '';?>">
                        <?php
                        _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN);
                        foreach ($categories_list as $category_list) {
                            echo '<span class="post-category">';
                            if ($categories_link) {
                                echo '<a rel="tag" href="' . get_category_link($category_list->term_id) . '">';
                            }
                            echo $category_list->name;
                            if ($categories_link) {
                                echo '</a>';
                            }
                            echo '</span>';
                        }
                        ?>
                    </div>
                    <?php
                }
            }
        } else {
            $taxonomy_names = get_object_taxonomies($bdp_settings['custom_post_type'],'objects');
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
                            <div class="category-link<?php echo ($taxonomy_link) ? ' categories_link' : '';?>">
                                <?php
                                echo $taxonomy_single->label;
                                foreach ($term_list as $term_nm) {
                                    $term_link = get_term_link($term_nm);
                                    echo '<span class="post-category">';
                                    echo ($taxonomy_link) ? '<a href="' . $term_link . '">' : '';
                                    echo $term_nm->name;
                                    echo ($taxonomy_link) ? '</a>' : '';
                                    echo '</span>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                }
            }
        }

        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_tag'] == 1) {
                $tags_lists = get_the_tags();
                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? false : true;

                if (!empty($tags_lists)) {
                    ?>
                    <div class="tags<?php echo ($tag_link) ? ' tag_link' : ''; ?>">
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
        }

        echo '<div class="content-footer">';

        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
        if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
            $post_link = get_permalink($post->ID);
            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
            }
            ?>
            <div class="read-more">
                <?php echo '<a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a>'; ?>
            </div>
            <?php
        }
        bdp_get_social_icons($bdp_settings);
        echo '</div>';
        ?>

    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div>

<?php
do_action('bdp_separator_after_post');
