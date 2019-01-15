<?php
/**
 * The template for displaying all archive posts
 * This template can be overridden by copying it to yourtheme/bdp_templates/archive/archive.php.
 * @author  Solwin Infotech
 * @version 2.1
 */
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        do_action('bdp_before_archive_page');
        $archive_id = $bdp_theme = '';
        $bdp_settings = $archive_list = array();
        $archive_list = bdp_get_archive_list();
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        if (is_date() && in_array('date_template', $archive_list)) {
            $date_settings = bdp_get_date_template_settings();
            $allsettings = $date_settings->settings;
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
            $array = array_keys($archive_list, 'date_template');
            $archive_id = $array[0];
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
        } elseif (is_author() && in_array('author_template', $archive_list)) {
            $author_id = get_query_var('author');
            $bdp_author_data = bdp_get_author_template_settings($author_id, $archive_list);
            $archive_id = $bdp_author_data['id'];
            $bdp_settings = $bdp_author_data['bdp_settings'];
            if ($bdp_settings) {
                $bdp_theme = $bdp_settings['template_name'];
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
            }
        } elseif (is_category() && in_array('category_template', $archive_list)) {
            $categories = get_category(get_query_var('cat'));
            $category_id = $categories->cat_ID;
            $bdp_category_data = bdp_get_category_template_settings($category_id, $archive_list);
            $archive_id = $bdp_category_data['id'];
            $bdp_settings = $bdp_category_data['bdp_settings'];
            if ($bdp_settings) {
                $bdp_theme = $bdp_settings['template_name'];
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
            }
        } elseif (is_tag() && in_array('tag_template', $archive_list)) {
            $tag_id = get_query_var('tag_id');
            $bdp_tag_data = bdp_get_tag_template_settings($tag_id, $archive_list);
            $archive_id = $bdp_tag_data['id'];
            $bdp_settings = $bdp_tag_data['bdp_settings'];
            if ($bdp_settings) {
                $bdp_theme = $bdp_settings['template_name'];
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
            }
        } elseif (is_search() && in_array('search_template', $archive_list)) {
            $search_settings = bdp_get_search_template_settings();
            $allsettings = $search_settings->settings;
            if (is_serialized($allsettings)) {
                $bdp_settings = unserialize($allsettings);
            }
            $array = array_keys($archive_list, 'search_template');
            $archive_id = $array[0];
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
        }
        if (isset($bdp_settings['bdp_blog_order_by'])) {
            $orderby = $bdp_settings['bdp_blog_order_by'];
        }
        if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
            $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
        } else {
            $firstpost_unique_design = 0;
        }
        $alter_class = '';
        $prev_year = '';
        $alter = 1;
        $alter_val = null;

        global $wp_query;
        $paged = bdp_paged();
        $arg_posts = bdp_get_archive_wp_query($bdp_settings);

        $loop = new WP_Query($arg_posts);
        $bdp_is_author = is_author();
        $temp_query = $wp_query;
        $wp_query = NULL;
        $wp_query = $loop;
        $max_num_pages = $wp_query->max_num_pages;
        $sticky_posts = get_option('sticky_posts');
        $prev_year1 = null;
        $prev_year = null;
        $alter_val = null;
        $prev_month = null;
        $ajax_preious_year = '';
        $ajax_preious_month = '';

        $main_container_class = (isset($bdp_settings['main_container_class']) && $bdp_settings['main_container_class'] != '') ? $bdp_settings['main_container_class'] : '';

        if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sunshiny_slider' || $bdp_theme == 'sallet_slider') {
            $unique_id = mt_rand();
        }
        ?>
        <div class="blog_template bdp_wrapper bdp_archive <?php echo $bdp_theme .' layout_id_'. $archive_id; ?>">
            <?php
            if ($main_container_class != '') {
                echo '<div class="' . $main_container_class . '">';
            }
            if ($bdp_theme == "offer_blog") {
                echo '<div class="bdp_single_offer_blog">';
            }
            if ($bdp_theme == "winter") {
                echo '<div class="bdp_single_winter">';
            }
            if ($bdp_is_author && in_array('author_template', $archive_list)) {
                $display_author = isset($bdp_settings['display_author_data']) ? $bdp_settings['display_author_data'] : 0;
                $txtAuthorTitle = isset($bdp_settings['txtAuthorTitle']) ? $bdp_settings['txtAuthorTitle'] : '[author]';
                $display_author_biography = isset($bdp_settings['display_author_biography']) ? $bdp_settings['display_author_biography'] : '';
                if ($display_author == 1) {
                    ?>
                    <div class="author-avatar-div bdp_blog_template bdp-author-avatar">
                        <?php
                        if ($bdp_theme == "news") {
                            ?>
                            <div class="author_div bdp_blog_template">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <span class="ts-fab-tab-text"><?php _e('About Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <?php
                                        do_action('bdp_author_archive_detail', $bdp_theme, $display_author_biography, $txtAuthorTitle, $bdp_settings);
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            do_action('bdp_author_archive_detail', $bdp_theme, $display_author_biography, $txtAuthorTitle, $bdp_settings);
                        }
                        ?>
                    </div>
                    <?php
                }
            }

            if ($max_num_pages > 1 && (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] == 'load_more_btn')) {
                echo "<div class='bdp-load-more-pre'>";
            }
            if ($max_num_pages > 1 && (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] == 'load_onscroll_btn')) {
                echo "<div class='bdp-load-onscroll-pre' id='bdp-load-onscroll-pre'>";
            }

            if ($bdp_theme == 'timeline') {
                if (isset($bdp_settings['bdp_timeline_layout']) && $bdp_settings['bdp_timeline_layout'] == 'left_side') {
                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] != '') {
                        echo '<div class="timeline_bg_wrap left_side with_year"><div class="timeline_back clearfix">';
                    } else {
                        echo '<div class="timeline_bg_wrap left_side"><div class="timeline_back clearfix">';
                    }
                } elseif (isset($bdp_settings['bdp_timeline_layout']) && $bdp_settings['bdp_timeline_layout'] == 'right_side') {
                    if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] != '') {
                        echo '<div class="timeline_bg_wrap right_side with_year"><div class="timeline_back clearfix">';
                    } else {
                        echo '<div class="timeline_bg_wrap right_side"><div class="timeline_back clearfix">';
                    }
                } else {
                    if ($orderby == 'date' || $orderby == 'modified') {
                        echo '<div class="timeline_bg_wrap date_order"><div class="timeline_back clearfix">';
                    } else {
                        echo '<div class="timeline_bg_wrap"><div class="timeline_back clearfix">';
                    }
                }
                $ajax_preious_year = get_the_date('Y');
                $ajax_preious_month = get_the_time('M');
            }

            if ($bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary" || $bdp_theme == "invert-grid") {
                echo "<div class='bdp-row $bdp_theme'>";
            }
            if ($bdp_theme == "media-grid" || $bdp_theme == "chapter" || $bdp_theme == "roctangle" || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "advice" || $bdp_theme == "minimal") {
                $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? 'column_layout_' . $bdp_settings['column_setting'] : 'column_layout_2';
                $column_setting_ipad = (isset($bdp_settings['column_setting_ipad']) && $bdp_settings['column_setting_ipad'] != '') ? 'column_layout_ipad_' . $bdp_settings['column_setting_ipad'] : 'column_layout_ipad_2';
                $column_setting_tablet = (isset($bdp_settings['column_setting_tablet']) && $bdp_settings['column_setting_tablet'] != '') ? 'column_layout_tablet_' . $bdp_settings['column_setting_tablet'] : 'column_layout_tablet_1';
                $column_setting_mobile = (isset($bdp_settings['column_setting_mobile']) && $bdp_settings['column_setting_mobile'] != '') ? 'column_layout_mobile_' . $bdp_settings['column_setting_mobile'] : 'column_layout_mobile_1';
                $column_class = $column_setting . ' ' . $column_setting_ipad . ' ' . $column_setting_tablet . ' ' . $column_setting_mobile;
                if($bdp_theme == 'roctangle') {
                    echo "<div class='bdp-row masonry $column_class $bdp_theme'>";
                } else {
                    echo "<div class='bdp-row $column_class $bdp_theme'>";
                }
            }
            if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
                echo '<div class="bdp-js-masonry masonry bdp_' . $bdp_theme . '">';
            }
            if ($bdp_theme == 'boxy-clean') {
                echo '<div class="blog_template boxy-clean"><ul>';
            }
            $slider_navigation = isset($bdp_settings['select_slider_navigation']) ? $bdp_settings['select_slider_navigation'] : 'navigation1';
            if ($bdp_theme == 'crayon_slider') {
                echo '<div class="blog_template slider_template crayon_slider ' . $slider_navigation . ' slider_' . $unique_id . '"><ul class="slides">';
            }
            if ($bdp_theme == 'sallet_slider') {
                echo '<div class="blog_template slider_template sallet_slider ' . $slider_navigation . ' slider_' . $unique_id . '"><ul class="slides">';
            }
            if ($bdp_theme == 'sunshiny_slider') {
                echo '<div class="blog_template slider_template sunshiny_slider ' . $slider_navigation . ' slider_' . $unique_id . '"><ul class="slides">';
            }
            if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                echo '<div class="logbook flatLine flatNav flatButton">';
            }
            if ($bdp_theme == 'easy_timeline') {
                echo '<div class="blog_template bdp_blog_template easy-timeline-wrapper"><ul class="easy-timeline" data-effect="' . $bdp_settings['easy_timeline_effect'] . '">';
            }
            if ($bdp_theme == 'steps') {
                echo '<div class="blog_template bdp_blog_template steps-wrapper"><ul class="steps" data-effect="' . $bdp_settings['easy_timeline_effect'] . '">';
            }
            if ($bdp_theme == 'my_diary') {
                echo '<div class="my_diary_wrapper">';
            }
            if ($bdp_theme == 'story') {
                echo '<div class="story_wrapper">';
            }
            if ($bdp_theme == 'brite') {
                echo '<div class="brite-wrapp">';
            }
            // Start the loop.

            if ($loop->have_posts()) {
                while (have_posts()) : the_post();

                    if (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] == 1) {
                        if ($alter % 2 == 0) {
                            $alter_class = ' alternative-back';
                        } else {
                            $alter_class = '';
                        }
                    }
                    if ($bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'story' || $bdp_theme == 'fairy' || $bdp_theme == 'clicky') {
                        if ($alter % 2 == 0) {
                            $alter_class = 'even_class';
                        } else {
                            $alter_class = '';
                        }
                    }
                    if ($bdp_theme == 'timeline') {
                        if ($alter % 2 == 0) {
                            $alter_class = 'even_class';
                        } else {
                            $alter_class = 'odd_class';
                        }
                    }
                    if ($bdp_theme == 'invert-grid' || $bdp_theme == 'media-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'story' || $bdp_theme == 'explore' || $bdp_theme == 'hoverbic') {
                        $alter_class = $alter;
                    }
                    if ($bdp_theme) {
                        if ($bdp_theme == 'timeline') {
                            if ($orderby == 'date' || $orderby == 'modified') {
                                if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_year') {
                                    $this_year = get_the_date('Y');
                                    if ($prev_year != $this_year) {
                                        $prev_year = $this_year;
                                        echo '<p class="timeline_year"><span class="year_wrap"><span class="only_year">' . $prev_year . '</span></span></p>';
                                    }
                                } else if (isset($bdp_settings['timeline_display_option']) && $bdp_settings['timeline_display_option'] == 'display_month') {
                                    $prev_month = "";
                                    $this_year = get_the_date('Y');
                                    $this_month = get_the_time('M');
                                    $prev_year = $this_year;
                                    if ($prev_month != $this_month) {
                                        $prev_month = $this_month;
                                        echo '<p class="timeline_year"><span class="year_wrap"><span class="year">' . $this_year . '</span><span class="month">' . $prev_month . '</span></span></p>';
                                    }
                                }
                            }
                        }
                        if ($bdp_theme == 'story') {
                            if ($orderby == 'date' || $orderby == 'modified') {
                                $this_year = get_the_date('Y');
                                if ($prev_year1 != $this_year) {
                                    $prev_year1 = $this_year;
                                    $prev_year = 0;
                                } elseif ($prev_year1 == $this_year) {
                                    $prev_year = 1;
                                }
                            } else {
                                $prev_year = get_the_date('Y');
                            }
                        }

                        if ($bdp_theme == 'media-grid') {
                            $alter_val = $alter;
                        }
                        if ($firstpost_unique_design == 1) {
                            if ($bdp_theme == 'invert-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia') {
                                $alter_val = $alter;
                                if (1 == $paged) {
                                    if ($alter == 1) {
                                        $prev_year = 0;
                                    } else {
                                        $prev_year = 1;
                                    }
                                } else {
                                    $prev_year = 1;
                                }
                            }
                            if ($bdp_theme == 'media-grid') {
                                $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
                                $alter_val = $alter;
                                if (1 == $paged) {
                                    if ($column_setting >= 2 && $alter <= 2) {
                                        $prev_year = 0;
                                    } else {
                                        if ($alter == 1) {
                                            $prev_year = 0;
                                        } else {
                                            $prev_year = 1;
                                        }
                                    }
                                } else {
                                    $prev_year = 1;
                                }
                            }
                        }
                    }
                    // Include the single post content template.
                    bdp_get_template('archive/' . $bdp_theme . '.php');
                    do_action('bd_archive_design_format_function', $bdp_settings, $alter_class, $prev_year, $alter_val, $paged);
                    $alter ++;
                // End of the loop.
                endwhile;
            } else {
                _e('No posts found', BLOGDESIGNERPRO_TEXTDOMAIN);
            }

            if ($bdp_theme == 'boxy-clean' || $bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
                echo "</ul></div>";
            }
            if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy' || $bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary" || $bdp_theme == "invert-grid") {
                echo "</div>";
            }
            if ($bdp_theme == "media-grid" || $bdp_theme == "chapter" || $bdp_theme == "roctangle" || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "advice" || $bdp_theme == "minimal") {
                echo "</div>";
            }
            if ($bdp_theme == 'timeline') {
                echo '</div>
                        </div>';
            }
            if ($bdp_theme == 'easy_timeline' || $bdp_theme == 'steps') {
                echo '</div></ul>';
            }
            if ($bdp_theme == "offer_blog" || $bdp_theme == "winter" || $bdp_theme == 'my_diary' || $bdp_theme == 'story' || $bdp_theme == 'brite' || $bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                echo '</div>';
            }
            $slider_array = array('cool_horizontal', 'overlay_horizontal','crayon_slider', 'sunshiny_slider', 'sallet_slider');
            if (!in_array($bdp_theme, $slider_array) && (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] != 'no_pagination')) {
                if ($max_num_pages > 1 && (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] == 'load_more_btn')) {
                    echo '</div>';
                    $is_loadmore_btn = '';
                    if ($max_num_pages > 1) {
                        $is_loadmore_btn = '';
                    } else {
                        $is_loadmore_btn = '1';
                    }
                    if (is_front_page()) {
                        $bdppaged = (get_query_var('page')) ? get_query_var('page') : 1;
                    } else {
                        $bdppaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    }
                    echo '<form name="bdp-load-more-hidden" id="bdp-load-more-hidden">';
                    echo '<input type="hidden" name="paged" id="paged" value="' . $bdppaged . '" />';
                    echo '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . $posts_per_page . '" />';
                    echo '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . $max_num_pages . '" />';
                    echo '<input type="hidden" name="blog_template" id="blog_template" value="' . $bdp_theme . '" />';
                    echo '<input type="hidden" name="blog_layout" id="blog_layout" value="archive_layout" />';
                    echo '<input type="hidden" name="blog_shortcode_id" id="blog_shortcode_id" value="' . $archive_id . '" />';
                    echo '<input type="hidden" name="term_id" id="term_id" value="' . $temp_query->get_queried_object_id() . '" />';
                    echo '<input type="hidden" name="search_string" id="search_string" value="' . $_GET['s'] . '" />';
                    if ($bdp_theme == 'timeline') {
                        echo '<input type="hidden" name="timeline_previous_year" id="timeline_previous_year" value="' . $ajax_preious_year . '" />';
                        echo '<input type="hidden" name="timeline_previous_month" id="timeline_previous_month" value="' . $ajax_preious_month . '" />';
                    }
                    echo bdp_get_loader($bdp_settings);
                    echo '</form>';
                    if ($is_loadmore_btn == '') {
                        $class = '';
                        echo '<div class="bdp-load-more text-center" style="float:left;width:100%">';
                        echo '<a href="javascript:void(0);" class="button bdp-load-more-btn ' . $class . '">';
                        echo (isset($bdp_settings['loadmore_button_text']) && $bdp_settings['loadmore_button_text'] != '') ? $bdp_settings['loadmore_button_text'] : __('Load More', BLOGDESIGNERPRO_TEXTDOMAIN);
                        echo '</a>';
                        echo '</div>';
                    }
                } elseif ($max_num_pages > 1 && (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] == 'load_onscroll_btn')) {
                    echo '</div>';
                    $is_load_onscroll_btn = '';
                    if ($max_num_pages > 1) {
                        $is_load_onscroll_btn = '';
                    } else {
                        $is_load_onscroll_btn = '1';
                    }
                    if (is_front_page()) {
                        $bdppaged = (get_query_var('page')) ? get_query_var('page') : 1;
                    } else {
                        $bdppaged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    }
                    echo '<form name="bdp-load-more-hidden" id="bdp-load-more-hidden">';

                    echo '<input type="hidden" name="paged" id="paged" value="' . $bdppaged . '" />';
                    if ($bdp_theme == 'story') {
                        echo '<input type="hidden" name="this_year" id="this_year" value="' . $this_year . '" />';
                    }
                    echo '<input type="hidden" name="posts_per_page" id="posts_per_page" value="' . $posts_per_page . '" />';
                    echo '<input type="hidden" name="max_num_pages" id="max_num_pages" value="' . $max_num_pages . '" />';
                    echo '<input type="hidden" name="blog_template" id="blog_template" value="' . $bdp_theme . '" />';
                    echo '<input type="hidden" name="blog_layout" id="blog_layout" value="archive_layout" />';
                    echo '<input type="hidden" name="blog_shortcode_id" id="blog_shortcode_id" value="' . $archive_id . '" />';
                    echo '<input type="hidden" name="term_id" id="term_id" value="' . $temp_query->get_queried_object_id() . '" />';
                    echo '<input type="hidden" name="search_string" id="search_string" value="' . $_GET['s'] . '" />';
                    if ($bdp_theme == 'timeline') {
                        echo '<input type="hidden" name="timeline_previous_year" id="timeline_previous_year" value="' . $ajax_preious_year . '" />';
                        echo '<input type="hidden" name="timeline_previous_month" id="timeline_previous_month" value="' . $ajax_preious_month . '" />';
                    }
                    echo bdp_get_loader($bdp_settings);;
                    echo '</form>';
                    if ($is_load_onscroll_btn == '') {
                        $class = '';
                        echo '<div class="bdp-load-onscroll text-center">';
                        echo '<a href="javascript:void(0);" class="button bdp-load-onscroll-btn ' . $class . '">';
                        echo __('Loading Posts', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
                        echo '</div>';
                    }
                }
                if (isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] == 'paged') {
                    $pagination_template = isset($bdp_settings['pagination_template']) ? $bdp_settings['pagination_template'] : 'template-1';
                    echo '<div class="wl_pagination_box ' . $pagination_template . '">';
                    echo bdp_standard_paging_nav();
                    echo '</div>';
                }
            }
            if ($main_container_class != '') {
                echo '</div">';
            }
            wp_reset_query();
            $wp_query = NULL;
            $wp_query = $temp_query;
            wp_reset_query();
            ?>
        </div>
        <?php do_action('bdp_after_archive_page'); ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>