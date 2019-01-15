<?php
/**
 * The template for displaying all single posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/single/single.php.
 * @author  Solwin Infotech
 * @version 2.0
 */

get_header();
bdp_set_post_views(get_the_ID());
global $wpdb;
$bdp_settings = get_single_template_setting_front_end();
$alter_class = $style = '';
$bdp_theme = apply_filters('bdp_filter_template', $bdp_settings['template_name']);
$bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
if ($bdp_template_name_changed == 1) {
    if ($bdp_theme == 'classical') {
        $bdp_theme = 'nicy';
    } elseif ($bdp_theme == 'lightbreeze') {
        $bdp_theme = 'sharpen';
    } elseif ($bdp_theme == 'spektrum') {
        $bdp_theme = 'hub';
    }
} else {
    update_option('bdp_template_name_changed', 0);
}
$main_container_class = (isset($bdp_settings['main_container_class']) && $bdp_settings['main_container_class'] != '') ? $bdp_settings['main_container_class'] : '';
if (has_post_thumbnail() && $bdp_theme == "overlay_horizontal" ) {
        $url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
        $style = 'style="background-image:url('. $url .')"';
}
if ($bdp_theme == "overlay_horizontal" || $bdp_theme == "cool_horizontal") {
    ?>
    <div class="horizontal2-wrapper" <?php echo $style;?>>
        <div class="horizontal2-cover"><?php }
?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                do_action('bdp_before_single_page');

                if ($main_container_class != '') {
                    echo '<div class="' . $main_container_class . '">';
                }
                ?>
                <div class="bdp_single <?php echo $bdp_theme; ?>">
                    <?php
                    if ($bdp_theme == "offer_blog") {
                        echo '<div class="bdp_single_offer_blog">';
                    }
                    if ($bdp_theme == "winter") {
                        echo '<div class="bdp_single_winter">';
                    }
                    // Start the loop.
                    while (have_posts()) : the_post();
                        // Include the single post content template.
                        bdp_get_template('single/' . $bdp_theme . '.php');

                        do_action('bd_single_design_format_function', $bdp_settings, $alter_class);

                        $display_author = isset($bdp_settings['display_author_data']) ? $bdp_settings['display_author_data'] : 0;
                        $txtAuthorTitle = isset($bdp_settings['txtAuthorTitle']) ? $bdp_settings['txtAuthorTitle'] : '[author]';
                        $display_author_biography = $bdp_settings['display_author_biography'];

                        if ($display_author == 1 && $bdp_theme == "brite") {
                            ?>
                            <div class="author-avatar-div bdp_blog_template">
                                <?php
                                do_action('bdp_author_detail', $bdp_theme, $display_author_biography, $txtAuthorTitle, $bdp_settings);
                                ?>
                            </div>
                            <?php
                        }


                        if (isset($bdp_settings['display_navigation']) && $bdp_settings['display_navigation'] == 1) {
                            // Previous/next post navigation.
                            ?>
                            <nav id="post-nav" class="navigation post-navigation bdp-post-navigation">
                                <div class="nav-links">
                                    <?php
                                    if (isset($bdp_settings['bdp_post_navigation_filter']) && $bdp_settings['bdp_post_navigation_filter'] != '') {
                                        $navigation_type = $bdp_settings['bdp_post_navigation_filter'];
                                        $prevPost = get_previous_post(true, '', $navigation_type);
                                    } else {
                                        $prevPost = get_previous_post();
                                    }
                                    $navThumbSize = array(60, 60);
                                    $navThumbClass = array("class" => "bdp_nav_post_img");
                                    $postNavDateFormat = get_option('date_format');
                                    if (!empty($prevPost)) {
                                        $args = array(
                                            'posts_per_page' => 1,
                                            'include' => $prevPost->ID
                                        );
                                        $prevPost = get_posts($args);
                                        foreach ($prevPost as $post) {
                                            setup_postdata($post);
                                            ?>
                                            <div class="previous-post">
                                                <div class="post-previous nav-previous">
                                                    <a href="<?php the_permalink(); ?>" class="prev-link">
                                                        <span class="left_nav fas fa-chevron-left"></span>
                                                        <?php if (has_post_thumbnail() && isset($bdp_settings['display_pn_image']) && $bdp_settings['display_pn_image'] == 1) {
                                                            ?>
                                                            <span class="navi-post-thumbnail">
                                                                <?php
                                                                echo apply_filters('bdp_nav_post_thumbnail_filter', get_the_post_thumbnail(get_the_ID(), $navThumbSize, $navThumbClass), get_the_ID());
                                                                ?>
                                                            </span>
                                                        <?php } ?>
                                                        <div class="post-data">
                                                            <?php
                                                            if (isset($bdp_settings['display_pn_title']) && $bdp_settings['display_pn_title'] == 1) {
                                                                ?>
                                                                <span class="navi-post-title"><?php the_title(); ?></span>
                                                            <?php } else { ?>
                                                                <span class="navi-post-text meta-nav" aria-hidden="true">
                                                                    <?php echo apply_filters('bdp_post_nav_prev_title', __('Previous Post', BLOGDESIGNERPRO_TEXTDOMAIN)); ?>
                                                                </span>
                                                                <?php
                                                            }
                                                            if (isset($bdp_settings['display_pn_date']) && $bdp_settings['display_pn_date'] == 1) {
                                                                ?>
                                                                <span class="navi-post-date"><?php echo apply_filters('bdp_post_nav_date_format', get_the_time($postNavDateFormat, get_the_ID()), get_the_ID()); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            wp_reset_postdata();
                                        } //end foreach
                                    } // end if

                                    if (isset($bdp_settings['bdp_post_navigation_filter']) && $bdp_settings['bdp_post_navigation_filter'] != '') {
                                        $navigation_type = $bdp_settings['bdp_post_navigation_filter'];
                                        $nextPost = get_next_post(true, '', $navigation_type);
                                    } else {
                                        $nextPost = get_next_post();
                                    }
                                    if (!empty($nextPost)) {
                                        $args = array(
                                            'posts_per_page' => 1,
                                            'include' => $nextPost->ID
                                        );
                                        $nextPost = get_posts($args);
                                        foreach ($nextPost as $post) {
                                            setup_postdata($post);
                                            ?>
                                            <div class="next-post">
                                                <div class="post-next nav-next">
                                                    <a href="<?php the_permalink(); ?>" class="next-link">

                                                        <div class="post-data">
                                                            <?php
                                                            if (isset($bdp_settings['display_pn_title']) && $bdp_settings['display_pn_title'] == 1) {
                                                                ?>
                                                                <span class="navi-post-title"><?php the_title(); ?></span>
                                                            <?php } else { ?>
                                                                <span class="navi-post-text meta-nav" aria-hidden="true">
                                                                    <?php echo apply_filters('bdp_post_nav_next_title', __('Next Post', BLOGDESIGNERPRO_TEXTDOMAIN)); ?>
                                                                </span>
                                                                <?php
                                                            }
                                                            if (isset($bdp_settings['display_pn_date']) && $bdp_settings['display_pn_date'] == 1) {
                                                                ?>
                                                                <span class="navi-post-date"><?php echo apply_filters('bdp_post_nav_date_format', get_the_time($postNavDateFormat, get_the_ID()), get_the_ID()); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                        <?php if (has_post_thumbnail() && isset($bdp_settings['display_pn_image']) && $bdp_settings['display_pn_image'] == 1) {
                                                            ?>
                                                            <span class="navi-post-thumbnail">
                                                                <?php
                                                                echo apply_filters('bdp_nav_post_thumbnail_filter', get_the_post_thumbnail(get_the_ID(), $navThumbSize, $navThumbClass), get_the_ID());
                                                                ?>
                                                            </span>
                                                        <?php } ?>
                                                        <span class="right_nav fas fa-chevron-right"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            wp_reset_postdata();
                                        } //end foreach
                                    } // end if
                                    ?>
                                </div>
                            </nav>
                            <?php
                        }

                        $display_author = isset($bdp_settings['display_author_data']) ? $bdp_settings['display_author_data'] : 0;
                        $txtAuthorTitle = isset($bdp_settings['txtAuthorTitle']) ? $bdp_settings['txtAuthorTitle'] : '[author]';
                        $display_author_biography = $bdp_settings['display_author_biography'];
                        if ($display_author == 1 && $bdp_theme != "news" && $bdp_theme != "timeline" && $bdp_theme != "story" && $bdp_theme != "brite") {
                            ?>
                            <div class="author-avatar-div bdp_blog_template">
                                <?php
                                do_action('bdp_author_detail', $bdp_theme, $display_author_biography, $txtAuthorTitle, $bdp_settings);
                                ?>
                            </div>
                            <?php
                        }
                        $related_post_number = $bdp_settings['related_post_number'];
                        $col_class = '';
                        if ($related_post_number == 2) {
                            $post_perpage = 2;
                        }
                        if ($related_post_number == 3) {
                            $post_perpage = 3;
                        }
                        if ($related_post_number == 4) {
                            $post_perpage = 4;
                        }
                        $related_post_by = $bdp_settings['related_post_by'];
                        $title = $bdp_settings['related_post_title'];
                        if (isset($bdp_settings['display_related_post']) && $bdp_settings['display_related_post'] == 1) {
                            $related_post_content_from = isset($bdp_settings['related_post_content_from']) ? $bdp_settings['related_post_content_from'] : '';
                            $related_post_content_length = isset($bdp_settings['related_post_content_length']) ? $bdp_settings['related_post_content_length'] : '';
                            $args = array();
                            $orderby = 'date';
                            $order = 'DESC';
                            if (isset($bdp_settings['bdp_related_post_order_by']) && $bdp_settings['bdp_related_post_order_by'] != '') {
                                $orderby = $bdp_settings['bdp_related_post_order_by'];
                            }

                            if (isset($bdp_settings['bdp_related_post_order'])) {
                                $order = $bdp_settings['bdp_related_post_order'];
                            }
                            if ($related_post_by == "category") {
                                global $post;
                                $categories = get_the_category($post->ID);
                                if ($categories) {
                                    $category_ids = array();
                                    foreach ($categories as $individual_category)
                                        $category_ids[] = $individual_category->term_id;
                                    $args = array(
                                        'category__in' => $category_ids,
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page' => $post_perpage, // Number of related posts that will be displayed.                            'caller_get_posts' => 1,
                                        'orderby' => $orderby,
                                        'order' => $order
                                    );
                                }
                            } elseif ($related_post_by == "tag") {
                                global $post;
                                $tags = wp_get_post_tags($post->ID);
                                if ($tags) {
                                    $tag_ids = array();
                                    foreach ($tags as $individual_tag)
                                        $tag_ids[] = $individual_tag->term_id;
                                    $args = array(
                                        'tag__in' => $tag_ids,
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page' => $post_perpage, // Number of related posts to display.
                                        'orderby' => $orderby,
                                        'order' => $order
                                    );
                                }
                            }
                            $my_query = new wp_query($args);
                            if ($my_query->have_posts()) {
                                ?>
                                <div class="related_post_wrap">
                                    <?php
                                    do_action('bdp_related_post_detail', $bdp_theme, $post_perpage, $related_post_by, $title, $orderby, $order, $related_post_content_length, $related_post_content_from, $bdp_settings);
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ($bdp_settings['display_comment'] == 1) {
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }
                        }

                    // End of the loop.
                    endwhile;
                    if ($bdp_theme == "offer_blog" || $bdp_theme == "winter") {
                        echo '</div>';
                    }
                    ?>
                </div>
                <?php
                if ($main_container_class != '') {
                    echo '</div">';
                }
                do_action('bdp_after_single_page');
                ?>
            </main><!-- .site-main -->
        </div><!-- .content-area -->
        <?php
        get_sidebar();
        if ($bdp_theme == "overlay_horizontal" || $bdp_theme == "cool_horizontal") {
            ?>
        </div>
    </div><?php
}
get_footer();
