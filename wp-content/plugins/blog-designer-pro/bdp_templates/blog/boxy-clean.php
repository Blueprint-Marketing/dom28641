<?php
/**
 * The template for displaying all blog posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/blog/boxy-clean.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $post;

$total_col = $bdp_settings['template_columns'];
$total_col_ipad = isset($bdp_settings['template_columns_ipad']) ? $bdp_settings['template_columns_ipad'] : 2;
$total_col_tablet = isset($bdp_settings['template_columns_tablet']) ? $bdp_settings['template_columns_tablet'] : 1;
$total_col_mobile = isset($bdp_settings['template_columns_mobile']) ? $bdp_settings['template_columns_mobile'] : 1;

$blog_unique_design = (isset($bdp_settings['blog_unique_design']) && $bdp_settings['blog_unique_design'] != "") ? $bdp_settings['blog_unique_design'] : 0;
$unique_design_option = isset($bdp_settings['unique_design_option']) ? $bdp_settings['unique_design_option'] : '';

$image_hover_effect = '';
if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
    $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
}

$col_class = bdp_column_class($bdp_settings);
if ($blog_unique_design == 1) {
    if ($unique_design_option == 'first_post' && $prev_year == 0 && $alter_val == 1 && $paged == 1) {
        $col_class = " first_post";
        $col_class .= ' bb bt';
    } elseif ($unique_design_option == 'first_post' && $prev_year == 1 && $alter_val != 1 && $paged == 1) {
        if (($alter_val - 1) % $total_col != 0) {
            $col_class .= " br_desktop";
        }
        if (($alter_val - 1) % $total_col_ipad != 0) {
            $col_class .= " br_ipad";
        }
        if (($alter_val - 1) % $total_col_tablet != 0) {
            $col_class .= " br_tablet";
        }
        if (($alter_val - 1) % $total_col_mobile != 0) {
            $col_class .= " br_mobile";
        }
        $col_class .= " bb";
        if (($alter_val - 1) <= $total_col) {
            $col_class .= " bt_desktop";
        }
        if (($alter_val - 1) <= $total_col_ipad) {
            $col_class .= " bt_ipad";
        }
        if (($alter_val - 1) <= $total_col_tablet) {
            $col_class .= " bt_tablet";
        }
        if (($alter_val - 1) <= $total_col_mobile) {
            $col_class .= " bt_mobile";
        }
    } elseif ($unique_design_option == 'first_post' && $prev_year == 1 && $paged != 1) {
        if (($alter_val) % $total_col != 0) {
            $col_class .= " br_desktop";
        }
        if (($alter_val) % $total_col_ipad != 0) {
            $col_class .= " br_ipad";
        }
        if (($alter_val) % $total_col_tablet != 0) {
            $col_class .= " br_tablet";
        }
        if (($alter_val) % $total_col_mobile != 0) {
            $col_class .= " br_mobile";
        }
        $col_class .= " bb";
        if (($alter_val) <= $total_col) {
            $col_class .= " bt_desktop";
        }
        if (($alter_val) <= $total_col_ipad) {
            $col_class .= " bt_ipad";
        }
        if (($alter_val) <= $total_col_tablet) {
            $col_class .= " bt_tablet";
        }
        if (($alter_val) <= $total_col_mobile) {
            $col_class .= " bt_mobile";
        }
    } elseif ($unique_design_option == 'featured_posts' && $prev_year == 0 && $alter_val <= $count_sticky && $paged == 1) {
        $col_class .= " first_post";
        $col_class .= ' bb bt';
    } elseif ($unique_design_option == 'featured_posts' && $prev_year == 1 && $alter_val > $count_sticky && $paged == 1) {
        if (($alter_val - $count_sticky) % $total_col != 0) {
            $col_class .= " br_desktop";
        }
        if (($alter_val - $count_sticky) % $total_col_ipad != 0) {
            $col_class .= " br_ipad";
        }
        if (($alter_val - $count_sticky) % $total_col_tablet != 0) {
            $col_class .= " br_tablet";
        }
        if (($alter_val - $count_sticky) % $total_col_mobile != 0) {
            $col_class .= " br_mobile";
        }
        $col_class .= " bb";
        if (($alter_class - $count_sticky) <= $total_col) {
            $col_class .= " bt_desktop";
        }
        if (($alter_class - $count_sticky) <= $total_col_ipad) {
            $col_class .= " bt_ipad";
        }
        if (($alter_class - $count_sticky) <= $total_col_tablet) {
            $col_class .= " bt_tablet";
        }
        if (($alter_class - $count_sticky) <= $total_col_mobile) {
            $col_class .= " bt_mobile";
        }
    } elseif ($unique_design_option == 'featured_posts' && $prev_year == 1 && $paged != 1) {
        if (($alter_val) % $total_col != 0) {
            $col_class .= " br_desktop";
        }
        if (($alter_val) % $total_col_ipad != 0) {
            $col_class .= " br_ipad";
        }
        if (($alter_val) % $total_col_tablet != 0) {
            $col_class .= " br_tablet";
        }
        if (($alter_val) % $total_col_mobile != 0) {
            $col_class .= " br_mobile";
        }
        $col_class .= " bb";
        if (($alter_val) <= $total_col) {
            $col_class .= " bt_desktop";
        }
        if (($alter_val) <= $total_col_ipad) {
            $col_class .= " bt_ipad";
        }
        if (($alter_val) <= $total_col_tablet) {
            $col_class .= " bt_tablet";
        }
        if (($alter_val) <= $total_col_mobile) {
            $col_class .= " bt_mobile";
        }
    }
} else {
    if ($alter_class % $total_col != 0) {
        $col_class .= " br_desktop";
    }
    if ($alter_class % $total_col_ipad != 0) {
        $col_class .= " br_ipad";
    }
    if ($alter_class % $total_col_tablet != 0) {
        $col_class .= " br_tablet";
    }
    if ($alter_class % $total_col_mobile != 0) {
        $col_class .= " br_mobile";
    }
    $col_class .= " bb";

    if ($alter_class <= $total_col) {
        $col_class .= " bt_desktop";
    }
    if ($alter_class <= $total_col_ipad) {
        $col_class .= " bt_ipad";
    }
    if ($alter_class <= $total_col_tablet) {
        $col_class .= " bt_tablet";
    }
    if ($alter_class <= $total_col_mobile) {
        $col_class .= " bt_mobile";
    }
}
?>

<li class="blog_wrap bdp_blog_template <?php echo ($col_class != '') ? $col_class : ''; ?>">
    <?php do_action('bdp_before_post_content'); ?>
    <div class="post-meta">
        <?php
        $display_date = $bdp_settings['display_date'];
        $ar_year = get_the_time('Y');
        $ar_month = get_the_time('m');
        $ar_day = get_the_time('d');

        if ($display_date == 1) {
            $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
            ?>
            <div class="postdate">
                <?php echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : ''; ?>
                <span class="month"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('M d') : get_the_time('M d'); ?></span>
                <span class="year"><?php echo (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? get_post_modified_time('Y') : get_the_time('Y'); ?></span>
                <?php echo ($date_link) ? '</a>' : ''; ?>
            </div>
            <?php
        }
        if ($bdp_settings['display_comment_count'] == 1) {
            if (comments_open()) {
                ?>
                <span class="post-comment">
                    <i class="fas fa-comment"></i>
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
        ?>
    </div>
    <div class="post-media">
        <?php
        $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
        if($label_featured_post != '' && is_sticky()) {
            ?> <div class="label_featured_post"><span><?php echo $label_featured_post; ?></span></div> <?php
        }
        
        if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) {
            ?>
            <div class="bdp-post-image post-video">
                <?php echo bdp_get_first_embed_media($post->ID, $bdp_settings); ?>
            </div>
            <?php
        } else {
            ?>
            <div class="bdp-post-image">
                <?php
                $post_thumbnail = 'invert-grid-thumb';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;

                echo '<figure class="' . $image_hover_effect . '">';

                echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                echo ($bdp_post_image_link) ? '</a>' : '';

                if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
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
                ?>
            </div>
            <?php
        }
        $display_author = $bdp_settings['display_author'];
        if ($display_author == 1) {
            $author_class = (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1 && get_post_format($post->ID) != 'gallery') ? 'post-video-format' : '';
            ?>
            <span class="author <?php echo $author_class; ?>">
                <?php  echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
            </span>
            <?php
        }
        ?>
    </div>
    <div class="post_summary_outer">
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
        <div class="post_content">
            <?php
            echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings);

            $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
            if (($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) || (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1)) {
                echo '<div class="content-footer">';
                if ($read_more_link == 1 && $bdp_settings['rss_use_excerpt'] == 1) {
                    $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                    $post_link = get_permalink($post->ID);
                    if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                        $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                    }
                    ?>
                    <div class="read-more">
                        <?php echo '<a class="more-tag" href="' . $post_link . '"><i class="fas fa-link"></i>' . $readmoretxt . ' </a>'; ?>
                    </div>
                    <?php
                }
                if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                    echo do_shortcode('[likebtn_shortcode]');
                }
                echo '</div>';
            }
            ?>

        </div>
    </div>

    <?php
    if ($bdp_settings['display_category'] == 1 || $bdp_settings['display_tag'] == 1) {
        ?>
        <div class="blog_footer">

            <div class="footer_meta">
                <?php
                if ($bdp_settings['custom_post_type'] == 'post') {
                    if ($bdp_settings['display_category'] == 1) {
                        $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                        ?>
                        <span class="category-link<?php echo ($categories_link) ? ' categories_link' : ''; ?>">
                            <span class="link-lable"> <i class="fas fa-folder"></i> <?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
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
                        <?php
                    }
                } else {
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
                                    <span class="category-link<?php echo ($taxonomy_link) ? '' : ' categories_link'; ?>">
                                        <span class="link-lable"> <i class="fas fa-folder"></i> <?php echo $taxonomy_single->label; ?>&nbsp;:&nbsp; </span>
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
                                    <?php
                                }
                            }
                        }
                    }
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
                            <div class="tags<?php echo ($tag_link) ? ' tag_link' : ''; ?>">
                                <span class="link-lable"> <i class="fas fa-bookmark"></i> <?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?> &nbsp;:&nbsp; </span>
                                <?php
                                print_r($tags_list);
                                $show_sep = true;
                                ?>
                            </div>
                            <?php
                        endif;
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
    <?php bdp_get_social_icons($bdp_settings); ?>
    <?php do_action('bdp_after_post_content'); ?>
</li>
<?php
do_action('bdp_separator_after_post');
