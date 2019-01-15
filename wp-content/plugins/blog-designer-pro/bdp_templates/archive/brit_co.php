<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/brit_co.php.
 * @author  Solwin Infotech 
 * @version 2.0
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
add_action('bd_archive_design_format_function', 'bdp_archive_britco_template', 10, 1);
if (!function_exists('bdp_archive_britco_template')) {

    /**
     *
     * @global type $post
     * @return html display britco design
     */
    function bdp_archive_britco_template($bdp_settings) {
        global $post;
        $col_class = bdp_column_class($bdp_settings);

        $class_name = "blog_template bdp_blog_template britco";
        if ($col_class != '') {
            $class_name .= " " . $col_class;
        }

        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        ?>
        <div class="<?php echo $class_name; ?>">
            <?php do_action('bdp_before_archive_post_content'); ?>
            <div class="bdp_blog_wraper">
                <div class="image_wrapper">
                    <?php
                    $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
                    if($label_featured_post != '' && is_sticky()) {
                        ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
                    }
                    ?>
                    <div class="bdp-post-image"><?php
                        $post_thumbnail = 'brit_co_img';
                        $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                        $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                        if (!empty($thumbnail)) {
                            echo '<figure class="' . $image_hover_effect . '">';
                            echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '" class="deport-img-link">' : '';
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo ($bdp_post_image_link) ? '</a>' : '';
                            if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                                echo bdp_pinterest($post->ID);
                            }
                            echo '</figure>';
                        }
                        ?>
                    </div>
                </div>
                <div class="content_wrapper">
                    <div class="content_avatar_meta">
                        <a class="avatar_wrapper">
                            <div class="author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 50); ?>
                            </div>
                        </a>
                        <div class="post-entry-meta">
                            <?php
                            if ($bdp_settings['display_author'] == 1) {
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                ?>
                                <span class="author">
                                    <span class="link-lable"> <i class="fas fa-user"></i> <?php _e('By: ', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                    <?php
                                    $author_data = '';
                                    $author_data .= '<span class="author-name">';
                                    $author_data .= ($author_link) ? '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" >' : '';
                                    $author_data .= bdp_get_post_auhtors($post->ID, $bdp_settings);;
                                    $author_data .= ($author_link) ? '</a>' : '';
                                    $author_data .= '</span>';
                                    echo apply_filters('bdp_existing_authors', $author_data, get_the_author_meta('ID'));
                                    do_action('bdp_extra_authors', $author_link);
                                    ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_date'] == 1) {
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');

                                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);

                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '" class="date">' : '<span class="date">';
                                ?> <i class="far fa-clock"></i> <?php
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '</span>';
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                                    ?>
                                    <span class="comment">
                                        <i class="fas fa-comments"></i>
                                        <?php
                                        if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                            comments_number('0', '1', '%');
                                        } else {
                                            comments_popup_link('0', '1', '%');
                                        }
                                        ?>
                                    </span>
                                    <?php
                                endif;
                            }
                            if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                                echo do_shortcode('[likebtn_shortcode]');
                            }
                            ?>
                        </div>
                    </div>
                    <h2 class="post-title">
                        <?php
                        $bdp_post_title_link = isset($bdp_settings['bdp_post_title_link']) ? $bdp_settings['bdp_post_title_link'] : 1;
                        if ($bdp_post_title_link == 1) {
                            ?>
                            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php
                            }
                            the_title();
                            if ($bdp_post_title_link == 1) {
                                ?>
                            </a><?php } ?>
                    </h2>
                    <div class="content_bottom_wrapper">
                        <?php if ($bdp_settings['display_category'] == 1) { ?>
                            <span class="post-category">
                                <i class="fas fa-folder"></i>
                                <?php
                                $categories_list = get_the_category_list(', ');
                                $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                                if ($categories_link) {
                                    $categories_list = strip_tags($categories_list);
                                }
                                if ($categories_list):
                                    print_r($categories_list);
                                    $show_sep = true;
                                endif;
                                ?>
                            </span><?php
                        }
                        if ($bdp_settings['display_tag'] == 1) {
                            $tags_list = get_the_tag_list('', ', ');
                            $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                            if ($tag_link) {
                                $tags_list = strip_tags($tags_list);
                            }
                            if ($tags_list):
                                ?>
                                <span class="tags">
                                    <i class="fas fa-bookmark"></i>
                                    <?php
                                    print_r($tags_list);
                                    $show_sep = true;
                                    ?>
                                </span>
                                <?php
                            endif;
                        }
                        ?>
                        <?php bdp_get_social_icons($bdp_settings); ?>
                    </div>
                </div>
            </div>
            <?php do_action('bdp_after_archive_post_content'); ?>
        </div>
        <?php
        do_action('bdp_archive_separator_after_post');
    }

}