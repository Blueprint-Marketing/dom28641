<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/masonry_timeline.php.
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
<div class="bdp_blog_template masonry-timeline-wrapp">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="image-blog">
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
        }
        ?>
        <?php
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            echo '<div class="bdp-post-image post-video bdp-video">';
                echo bdp_get_first_embed_media($post->ID, $bdp_settings);
            echo '</div>';
        } else {
            $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

            echo '<figure class="bdp-post-image ' . $image_hover_effect . '">';
            echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
            $post_thumbnail = 'deport-thumb';
            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
            if (!empty($thumbnail)) {
                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
            }
            echo ($bdp_post_image_link) ? '</a>' : '';

            if ($bdp_settings['pinterest_image_share'] == 1) {
                ?>
                <div class="bdp-pinterest-share-image">
                    <?php $img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                    <a target="_blank" href="<?php echo 'https://pinterest.com/pin/create/button/?url=' . get_permalink($post->ID) . '&media=' . $img_url; ?>"></a>
                </div>
                <?php
            }
            ?>
            <div class="year-number">
                <?php
                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time('Y', $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time('Y', $post->ID), $post->ID);
                echo $bdp_date;
                ?>
            </div>

            <?php
            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                echo do_shortcode('[likebtn_shortcode]');
            }

            echo '</figure>';
        }
        ?>
    </div>
    <div class="post-content-area">

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

        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_category'] == 1) {
                $categories_list = get_the_category_list(', ');
                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                ?>
                <div class="categories <?php echo ($categories_link) ? 'bdp_no_links' : ''; ?>">
                    <?php
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
        }
        ?>

        <div class="post_content">
            <?php
            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);
            ?>
        </div>


        <?php
        if ($bdp_settings['custom_post_type'] == 'post') {
            if ($bdp_settings['display_tag'] == 1) {
                $tags_list = get_the_tag_list('', ', ');
                $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                if ($tag_link) {
                    $tags_list = strip_tags($tags_list);
                }
                if ($tags_list) {
                    ?>
                    <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : ''; ?>">
                        <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                        <?php printf($tags_list); ?>
                    </div>
                    <?php
                }
            }
        }

        if ($bdp_settings['custom_post_type'] != 'post') {
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
                            <div class="tags <?php echo (!$taxonomy_link) ? 'bdp_no_links' : '';?>">
                                <span class="link-lable"><i class="fas fa-folder-open"></i><?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp;</span>
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
                            <?php
                        }
                    }
                }
            }
        }
        ?>

        <?php
        if (get_the_content() != '') {
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
        <div class="post-footer">
            <div class="metadatabox">
                <?php
                if ($bdp_settings['display_author'] == 1) {
                    $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                    ?>
                    <span class="mauthor <?php echo (!$author_link) ? 'bdp_no_links' : '';?>">
                        <i class="fas fa-user"></i>
                        <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                    </span>
                    <?php
                }

                if ($bdp_settings['display_date'] == 1) {
                    $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                    $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                    $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                    $ar_year = get_the_time('Y');
                    $ar_month = get_the_time('m');
                    $ar_day = get_the_time('d');
                    ?>
                    <span class="mdate">
                        <i class="far fa-calendar-alt"></i>
                        <?php
                        echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                        echo $bdp_date;
                        echo ($date_link) ? '</a>' : '';
                        ?>
                    </span>
                    <?php
                }

                if ($bdp_settings['display_comment_count'] == 1) {
                    ?>
                    <span class="post-comment">
                        <i class="fas fa-comment"></i>
                        <?php
                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                            comments_number(__('No Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN));
                        } else {
                            comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% ' . __('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                        }
                        ?>
                    </span>
                    <?php
                }

                $social_share = (isset($bdp_settings['social_share']) && $bdp_settings['social_share'] == 0) ? false : true;
                if($social_share) {
                    if (($bdp_settings['facebook_link'] == 1) || ($bdp_settings['twitter_link'] == 1) ||
                            ($bdp_settings['google_link'] == 1) || ($bdp_settings['linkedin_link'] == 1) ||
                            (isset($bdp_settings['email_link']) && $bdp_settings['email_link'] == 1) || ( $bdp_settings['pinterest_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['pocket_link']) && $bdp_settings['pocket_link'] == 1) ||
                            ( isset($bdp_settings['skype_link']) && $bdp_settings['skype_link'] == 1) ||
                            ( isset($bdp_settings['telegram_link']) && $bdp_settings['telegram_link'] == 1) ||
                            ( isset($bdp_settings['reddit_link']) && $bdp_settings['reddit_link'] == 1) ||
                            ( isset($bdp_settings['digg_link']) && $bdp_settings['digg_link'] == 1) ||
                            ( isset($bdp_settings['tumblr_link']) && $bdp_settings['tumblr_link'] == 1) ||
                            ( isset($bdp_settings['wordpress_link']) && $bdp_settings['wordpress_link'] == 1) ||
                            ( $bdp_settings['whatsapp_link'] == 1)) {
                        ?>
                        <span class="post-share-div">
                            <i class="fas fa-share-alt"></i>
                            <a class="post-share" href="javascript:void(0)" title="<?php _ex('SHARE', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
                                <?php _ex('SHARE', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </a>
                        </span>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            bdp_get_social_icons($bdp_settings);
            ?>
        </div>
    </div>
    <?php do_action('bdp_after_post_content'); ?>
</div>

<?php
do_action('bdp_separator_after_post');
