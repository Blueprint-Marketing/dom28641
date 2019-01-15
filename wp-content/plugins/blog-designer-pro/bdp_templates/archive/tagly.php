<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/tagly.php.
 * @author  Solwin Infotech
 * @version 2.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

add_action('bd_archive_design_format_function', 'bdp_archive_tagly_template', 10, 5);

if (!function_exists('bdp_archive_tagly_template')) {

    function bdp_archive_tagly_template($bdp_settings, $alterclass, $prev_year, $alter_val, $paged) {
        global $post;
        $left_after = '';

        $image_hover_effect = '';
        if (isset($bdp_settings['bdp_image_hover_effect']) && $bdp_settings['bdp_image_hover_effect'] == 1) {
            $image_hover_effect = (isset($bdp_settings['bdp_image_hover_effect_type']) && $bdp_settings['bdp_image_hover_effect_type'] != '') ? $bdp_settings['bdp_image_hover_effect_type'] : '';
        }
        ?>
        <div class="blog_template bdp_blog_template tagly">
            <?php do_action('bdp_before_post_content'); ?>
            <?php if (bdp_get_first_embed_media($post->ID, $bdp_settings) && $bdp_settings['rss_use_excerpt'] == 1) { ?>
                <div class="bdp-post-image post-video">
                    <?php
                    if (get_post_format() == 'quote') {
                        if (has_post_thumbnail()) {
                            $post_thumbnail = 'full';
                            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo '<div class="upper_image_wrapper">';
                            echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                            echo '</div>';
                        }
                    } else if (get_post_format() == 'link') {
                        if (has_post_thumbnail()) {
                            $post_thumbnail = 'full';
                            $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                            echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                            echo '<div class="upper_image_wrapper bdp_link_post_format">';
                            echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                            echo '</div>';
                        }
                    } else {
                        echo bdp_get_first_embed_media($post->ID, $bdp_settings);
                    }
                    ?>
                </div>
                <?php
            } else {
                $post_thumbnail = 'full';
                $thumbnail = bdp_get_the_thumbnail($bdp_settings, $post_thumbnail, get_post_thumbnail_id(), $post->ID);
                if (!empty($thumbnail)) {
                    $bdp_post_image_link = (isset($bdp_settings['bdp_post_image_link']) && $bdp_settings['bdp_post_image_link'] == 0) ? false : true;
                    $left_after = 'post-has-image';
                    ?>
                    <div class="bdp-post-image post-has-image">
                        <?php
                        echo '<figure class="' . $image_hover_effect . '">';
                        echo ($bdp_post_image_link) ? '<a href="' . get_permalink($post->ID) . '">' : '';
                        echo apply_filters('bdp_post_thumbnail_filter', $thumbnail, $post->ID);
                        echo ($bdp_post_image_link) ? '</a>' : '';

                        if (isset($bdp_settings['pinterest_image_share']) && $bdp_settings['pinterest_image_share'] == 1 && has_post_thumbnail()) {
                            echo bdp_pinterest($post->ID);
                        }
                        echo '</figure>';
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
             <?php
            $label_featured_post = (isset($bdp_settings['label_featured_post']) && $bdp_settings['label_featured_post'] != '') ? $bdp_settings['label_featured_post'] : '';
            if($label_featured_post != '' && is_sticky()) {
                ?> <div class="label_featured_post"><?php echo $label_featured_post; ?></div> <?php
            }
            ?>
            <div class="post-content-wrapper">
                <div class="left-side-area">
                    <?php
                    if (isset($bdp_settings['display_postlike']) && $bdp_settings['display_postlike'] == 1) {
                        echo do_shortcode('[likebtn_shortcode]');
                    }
                    if ($bdp_settings['display_comment_count'] == 1) {
                        if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                            ?>
                            <span class="comment">
                                <?php
                                if (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) {
                                    ?>
                                    <a href="#">
                                    <?php } else { ?>
                                        <a href="<?php comments_link(); ?>">
                                        <?php } ?>
                                        <i class="fas fa-comment-o"></i>
                                    </a>
                            </span>
                            <?php
                        endif;
                    }
                    ?>
                    <div class="social-share">
                        <i class="far fa-paper-plane"></i>
                        <?php bdp_get_social_icons($bdp_settings); ?>
                    </div>
                </div>
                <div class="right-side-area">
                    <?php
                    if ($bdp_settings['display_category'] == 1) {
                        ?>
                        <span class="categories">
                            <?php
                            $categories_list = get_the_category_list(', ');
                            $categories_link = (isset($bdp_settings['disable_link_category']) && $bdp_settings['disable_link_category'] == 1) ? true : false;
                            if ($categories_link) {
                                $categories_list = strip_tags($categories_list);
                            }
                            if ($categories_list):
                                echo ' ';
                                print_r($categories_list);
                                echo ' ';
                                $show_sep = true;
                            endif;
                            ?>
                        </span>
                        <?php
                    }
                    ?>
                    <h2 class="bdp_post_title">
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
                    $display_author = $bdp_settings['display_author'];
                    if ($display_author == 1 || $bdp_settings['display_date'] == 1 || $bdp_settings['display_comment_count'] == 1) {
                        ?>
                        <div class="metadatabox">
                            <?php
                            if ($bdp_settings['display_author'] == 1) {
                                $author_link = (isset($bdp_settings['disable_link_author']) && $bdp_settings['disable_link_author'] == 1) ? false : true;
                                ?>
                                <span class="author <?php echo ($author_link) ? 'bdp_has_links' : 'bdp_no_links'; ?>">
                                    <i class="fas fa-user"></i>
                                    <?php echo bdp_get_post_auhtors($post->ID, $bdp_settings); ?>
                                </span>
                                <?php
                            }
                            if ($bdp_settings['display_date'] == 1) {
                                $date_format = (isset($bdp_settings['post_date_format']) && $bdp_settings['post_date_format'] != 'default') ? $bdp_settings['post_date_format'] : get_option('date_format');
                                $date_link = (isset($bdp_settings['disable_link_date']) && $bdp_settings['disable_link_date'] == 1) ? false : true;
                                $bdp_date = (isset($bdp_settings['dsiplay_date_from']) && $bdp_settings['dsiplay_date_from'] == 'modify') ? apply_filters('bdp_date_format', get_post_modified_time($date_format, $post->ID), $post->ID) : apply_filters('bdp_date_format', get_the_time($date_format, $post->ID), $post->ID);
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');
                                echo '<span class="date"><i class="far fa-clock"></i>';
                                echo ($date_link) ? '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">' : '';
                                echo $bdp_date;
                                echo ($date_link) ? '</a>' : '';
                                echo '</span>';
                            }
                            if ($bdp_settings['display_comment_count'] == 1) {
                                if (!post_password_required() && ( comments_open() || get_comments_number() )) :
                                    ?>
                                    <span class="comment">
                                        <i class="fas fa-comment"></i>
                                        <?php
                                        $comment_link = (isset($bdp_settings['disable_link_comment']) && $bdp_settings['disable_link_comment'] == 1) ? false : true;
                                        bdp_comment_count($comment_link); //comments_popup_link('0', '1', '%');
                                        ?>
                                    </span>
                                    <?php
                                endif;
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <div class="post_content">
                        <?php echo bdp_get_content($post->ID, $bdp_settings['rss_use_excerpt'], $bdp_settings['txtExcerptlength'], $bdp_settings); ?>
                    </div>
                    <?php
                    if ($bdp_settings['display_tag'] == 1) {
                        $tags_list = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? get_the_tag_list('', ', ') : get_the_tag_list('', ', ');
                        $tag_link = (isset($bdp_settings['disable_link_tag']) && $bdp_settings['disable_link_tag'] == 1) ? true : false;
                        if ($tag_link) {
                            $tags_list = strip_tags($tags_list);
                        }
                        if ($tags_list):
                            ?>
                            <div class="tags <?php echo ($tag_link) ? 'bdp_no_links' : 'bdp_has_links'; ?>">
                                <i class="fas fa-tags"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php
                                print_r($tags_list);
                                $show_sep = true;
                                ?>
                            </div>
                            <?php
                        endif;
                    }

                    $read_more_link = isset($bdp_settings['read_more_link']) ? $bdp_settings['read_more_link'] : 1;
                    if ($bdp_settings['rss_use_excerpt'] == 1 && $read_more_link == 1):
                        $readmoretxt =  $bdp_settings['txtReadmoretext'] != '' ? $bdp_settings['txtReadmoretext'] : __('Read More', BLOGDESIGNERPRO_TEXTDOMAIN);
                        $post_link = get_permalink($post->ID);
                        if(isset($bdp_settings['post_link_type']) && $bdp_settings['post_link_type'] == 1) {
                            $post_link = (isset($bdp_settings['custom_link_url']) && $bdp_settings['custom_link_url'] != '') ? $bdp_settings['custom_link_url'] : get_permalink($post->ID);
                        }
                        ?>
                        <div class="read-more">
                            <a href="<?php echo $post_link; ?>">
                                <?php echo $readmoretxt; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php do_action('bdp_after_post_content'); ?>
        </div>
        <?php
        do_action('bdp_separator_after_post');
    }

}