<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/steps.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $post;

$image_hover_effect = '';
if(isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}

$format = get_post_format($post->ID);
$post_format = '';
if ($format == "status") {
    $post_format = 'fas fa-comment';
} elseif ($format == "aside") {
    $post_format = 'far fa-file-alt';
} elseif ($format == "image") {
    $post_format = 'far fa-file-image';
} elseif ($format == "gallery") {
    $post_format = 'far fa-file-images';
} elseif ($format == "link") {
    $post_format = 'fas fa-link';
} elseif ($format == "quote") {
    $post_format = 'fas fa-quote-left';
} elseif ($format == "audio") {
    $post_format = 'fas fa-music';
} elseif ($format == "video") {
    $post_format = 'fas fa-video';
} elseif ($format == "chat") {
    $post_format = 'fab fa-weixin';
} else {
    $post_format = 'fas fa-thumbtack';
}


?>
<?php do_action('bdp_before_post_content'); ?>

<li>
    <div class="steps-postformate <?php echo $post_format?>"></div>
    <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
        }
        ?>
    <?php
    if ($bdp_settings['custom_post_type'] == 'post') {
        if (isset($bdp_settings['display_category']) && $bdp_settings['display_category'] == 1) {
            $categories_list = get_the_category_list(', ');
            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
            ?> <div class="categories <?php echo ($categories_link) ? 'bdp-no-links' : ''; ?>"> <?php
                if ($categories_link) {
                    $categories_list = strip_tags($categories_list);
                }
                if ($categories_list) {
                    ?>
                    <span class="categorry-inner">
                        <?php print_r($categories_list);  ?>
                    </span>
                <?php }
            ?> </div> <?php
        }
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

    <?php

    if (isset($bdp_settings['display_feature_image']) && $bdp_settings['display_feature_image'] == 1) {
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            ?>
            <div class="post-image post-video bdp-video">
                <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
            </div>
            <?php
        } else {
            $post_thumbnail = 'easy_timeline_img';
            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
            $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
            if (!empty($thumbnail)) {
                echo '<figure class="'. $image_hover_effect .'">';
                ?>
                <div class="photo post-image bdp-post-image">
                    <?php
                    echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                    echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                    echo ($bdp_post_image_link) ? '</a>' : '';

                    if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1) {
                        echo bdp_pinterest($post->ID);
                    }
                    ?>

                </div>
                <?php
                echo '</figure>';
            }
        }
    }

    ?>

    <div class="post_content">
        <?php
        echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

        $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
        if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
            $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
            $post_link = get_permalink($post->ID);
            if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
            }
            echo '<div class="read-more-div"><a class="more-tag" href="' . $post_link . '">' . $readmoretxt . ' </a></div>';
        }
        ?>
    </div>

    <?php

    $display_date = $bdp_settings['display_date'];
    $display_author = $bdp_settings['display_author'];
    $display_comment_count = $bdp_settings['display_comment_count'];
    $display_postlike = $bdp_settings['display_postlike'];

    if($display_date == 1 || $$display_author == 1 || $display_comment_count == 1 || $display_postlike == 1) {
        echo '<div class="post-meta">';

        if ($bdp_settings['display_author'] == 1) {
            $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
            ?>
            <span class="mauthor <?php echo (!$author_link) ? 'bdp-no-links' : ''; ?>">
                <?php
                echo (!$author_link) ? '<span class="author-inner">' : '';
                echo '<i class="fas fa-user"></i> ';
                echo bdp_get_post_auhtors($post->ID, $bdp_settings);
                echo (!$author_link) ? '</span>' : '';
                ?>
            </span>
            <?php
        }

        if ($display_date == 1) {
            $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
            $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
            $ar_year = get_the_time('Y');
            $ar_month = get_the_time('m');
            $ar_day = get_the_time('d');
            ?>
            <span class="mdate <?php echo (!$date_link) ? 'bdp-no-links' : ''; ?>">
                <?php
                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '<span class="date-inner">';
                echo '<i class="far fa-calendar-alt"></i>';
                echo $bdp_date;
                echo ($date_link) ? '</a>' : '</span>';
                ?>
            </span>
            <?php
        }

        if ($bdp_settings['display_comment_count'] == 1) {
            $disable_link_comment = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? true : false;
            ?>
            <span class="mcomments <?php echo ($disable_link_comment) ? 'bdp-no-links' : ''; ?>">
                <i class="fas fa-comment"></i>
                <?php if ($disable_link_comment) { ?>
                    <span class="comment-count-inner"><?php comments_number(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% '.__('comments', BLOGDESIGNERPRO_TEXTDOMAIN)); ?></span>
                    <?php
                } else {
                    comments_popup_link(__('Leave a Comment', BLOGDESIGNERPRO_TEXTDOMAIN), __('1 comment', BLOGDESIGNERPRO_TEXTDOMAIN), '% '.__('comments', BLOGDESIGNERPRO_TEXTDOMAIN), 'comments-link', __('Comments are off', BLOGDESIGNERPRO_TEXTDOMAIN));
                }
                ?>
            </span>
            <?php
        }

        if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
            echo do_shortcode('[likebtn_shortcode]');
        }

        echo '</div>';
    }

    if ($bdp_settings['custom_post_type'] == 'post') {
        if (isset($bdp_settings['display_tag']) && $bdp_settings['display_tag'] == 1) {
            $tags_list = get_the_tag_list('', ', ');
            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
            if ($tag_link) {
                $tags_list = strip_tags($tags_list);
            }
            if ($tags_list) {
                ?>
                <div class="tags <?php echo ($tag_link) ? 'bdp-no-links' : ''; ?>">
                    <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:&nbsp; </span>
                    <?php printf($tags_list); ?>
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
            if (isset($bdp_settings["display_taxonomy_" . $taxonomy]) && $bdp_settings["display_taxonomy_" . $taxonomy] == 1) {
                $term_list = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
                $taxonomy_link = (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy]) && $bdp_settings['disable_link_taxonomy_' . $taxonomy] == 1) ? false : true;
                if (isset($taxonomy)) {
                    if (isset($term_list) && !empty($term_list)) {
                        ?>
                        <div class="tags <?php echo (!$taxonomy_link) ? 'bdp-no-links' : '';?>">
                            <span class="link-lable"> <i class="fas fa-folder-open"></i> <?php echo $taxonomy_single->label; ?>:&nbsp; </span>
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

    bdp_get_social_icons($bdp_settings);
    ?>

</li>

<?php do_action('bdp_after_post_content'); ?>
