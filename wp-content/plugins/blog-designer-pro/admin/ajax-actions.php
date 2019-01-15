<?php
/**
 * Administration API: Core Ajax handlers
 * @since 1.0
 */
/**
 * Ajax handler to get custom post taxonomy
 */
if (!function_exists('bdp_custom_post_taxonomy')) {

    function bdp_custom_post_taxonomy() {
        ob_start();
        ?>
        <table>
            <tbody>
                <?php
                if (isset($_POST['posttype']) && !empty($_POST['posttype'])) {
                    $custom_posttype = $_POST['posttype'];
                }
                $taxonomy_names = get_object_taxonomies($custom_posttype, 'objects');
                $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);

                if (!empty($taxonomy_names)) {
                    foreach ($taxonomy_names as $taxonomy_name) {
                        if (!empty($taxonomy_name)) {
                            $terms = get_terms($taxonomy_name->name, array('hide_empty' => false));
                            if (!empty($terms)) {
                                ?>
                                <tr class="custom-taxonomy">
                                    <td>
                                        <?php _e('Select', BLOGDESIGNERPRO_TEXTDOMAIN); echo ' '.$taxonomy_name->label; ?>
                                    </td>
                                    <td>
                                        <select data-placeholder="Choose <?php echo $taxonomy_name->label; ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo $taxonomy_name->name; ?>_terms[]" id="terms_<?php echo $taxonomy_name->name; ?>"><?php foreach ($terms as $term) { ?>
                                                <option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="exclude_tag_list_div">
                                            <label>
                                                <input id="exclude_<?php echo $taxonomy_name->name; ?>_list" name="exclude_<?php echo $taxonomy_name->name; ?>_list" type="checkbox" value="1" /> <?php echo __('Exclude Selected ', BLOGDESIGNERPRO_TEXTDOMAIN) . $taxonomy_name->label; ?>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table><?php
        $data = ob_get_clean();
        echo $data;
        die();
    }

}

/**
 * Administration API: Core Ajax handlers
 * Ajax handler to get custom post taxonomy terms
 * @since 2.1
 */
if(!function_exists('bdp_get_custom_taxonomy_terms')) {
    function bdp_get_custom_taxonomy_terms() {
        ob_start();
        if (isset($_POST['posttype']) && !empty($_POST['posttype'])) {
            $custom_posttype = $_POST['posttype'];
        }
        $taxonomy_names = get_object_taxonomies($custom_posttype, 'objects');
        $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);

        if (!empty($taxonomy_names)) {
            foreach ($taxonomy_names as $taxonomy_name) {
              $terms = get_terms($taxonomy_name->name, array('hide_empty' => false));
              if (!empty($terms)) {
                ?>
                <li class="bdp-post-terms">
                    <div class="bdp-left">
                        <span class="bdp-key-title">
                            <?php echo __('Select', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label; ?>
                        </span>
                    </div>
                    <div class="bdp-right">
                        <span class="fas fa-question-circle bdp-tooltips-icon bdp-tooltips-icon-select"><span class="bdp-tooltips"><?php echo __('Filter post via', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label; ?></span></span>
                        <select data-placeholder="Choose <?php echo $taxonomy_name->label; ?>" multiple style="width:220px;" class="chosen-select custom_post_term" name="<?php echo $taxonomy_name->name; ?>_terms[]" id="terms_<?php echo $taxonomy_name->name; ?>">
                          <?php foreach ($terms as $term) { ?>
                                  <option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
                          <?php } ?>
                          </select>
                          <div class="exclude_tag_list_div">
                              <label>
                                  <input id="exclude_<?php echo $taxonomy_name->name; ?>_list" name="exclude_<?php echo $taxonomy_name->name; ?>_list" type="checkbox" value="1" /> <?php echo __('Exclude Selected ', BLOGDESIGNERPRO_TEXTDOMAIN) . $taxonomy_name->label; ?>
                              </label>
                          </div>
                    </div>
                </li>
                <?php
              }
            }
        }

        $data = ob_get_clean();
        echo $data;
        die();
    }
}

/**
 * Ajax handler to get custom post taxonomy display settings
 * Administration API: Core Ajax handlers
 * @since 2.1
 */
if(!function_exists('bdp_custom_post_taxonomy_display_settings')) {
    function bdp_custom_post_taxonomy_display_settings() {
        ob_start();
        if (isset($_POST['posttype']) && !empty($_POST['posttype'])) {
            $custom_posttype = $_POST['posttype'];
        }
        $taxonomy_names = get_object_taxonomies($custom_posttype, 'objects');
        $taxonomy_names = apply_filters('bdp_hide_taxonomies',$taxonomy_names);
        if($custom_posttype == 'post') {
            ?>
            <div class="bdp-typography-cover display-custom-taxonomy">
                <div class="bdp-typography-label">
                    <span class="bd-key-title">
                        <?php _e('Post Category', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                    </span>
                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post category on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                </div>
                <div class="bdp-typography-content">
                    <fieldset class="bdp-social-options bdp-display_author buttonset">
                        <input id="display_category_1" name="display_category" type="radio" value="1" checked="checked" />
                        <label for="display_category_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                        <input id="display_category_0" name="display_category" type="radio" value="0" />
                        <label for="display_category_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                    </fieldset>
                    <label class="disable_link">
                        <input id="disable_link_category" name="disable_link_category" type="checkbox" value="1" /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </label>
                    <label class="filter_data">
                        <input id="filter_cat" name="filter_category" type="checkbox" value="1" /> <?php _e('Display Filter for Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </label>
                </div>
            </div>

            <div class="bdp-typography-cover display-custom-taxonomy">
                <div class="bdp-typography-label">
                    <span class="bd-key-title">
                        <?php _e('Post Tag', BLOGDESIGNERPRO_TEXTDOMAIN) ?>
                    </span>
                    <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e('Show post tag on blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                </div>
                <div class="bdp-typography-content">
                    <fieldset class="bdp-social-options bdp-display_author buttonset">
                        <input id="display_tag_1" name="display_tag" type="radio" value="1" checked="checked" />
                        <label for="display_tag_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                        <input id="display_tag_0" name="display_tag" type="radio" value="0" />
                        <label for="display_tag_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                    </fieldset>
                    <label class="disable_link">
                        <input id="disable_link_tag" name="disable_link_tag" type="checkbox" value="1" /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </label>
                    <label class="filter_data">
                        <input id="filter_tag" name="filter_tags" type="checkbox" value="1" /> <?php _e('Display Filter for Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </label>
                </div>
            </div>
            <?php
        } elseif (!empty($taxonomy_names)) {
            foreach ($taxonomy_names as $taxonomy_name) {
                if (!empty($taxonomy_name)) {
                    ?>
                    <div class="bdp-typography-cover display-custom-taxonomy">
                        <div class="bdp-typography-label">
                            <span class="bd-key-title">
                                <?php echo $taxonomy_name->label; ?>
                            </span>
                            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php echo __('Enable/Disable', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $taxonomy_name->label .' '. __('in blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
                        </div>
                        <div class="bdp-typography-content">
                            <fieldset class="bdp-display_tax buttonset">
                                <input id="display_taxonomy_<?php echo $taxonomy_name->name; ?>_1" name="display_taxonomy_<?php echo $taxonomy_name->name; ?>" type="radio" value="1" />
                                <label for="display_taxonomy_<?php echo $taxonomy_name->name; ?>_1"><?php _e('Yes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                                <input id="display_taxonomy_<?php echo $taxonomy_name->name; ?>_0" name="display_taxonomy_<?php echo $taxonomy_name->name; ?>" type="radio" value="0" checked="checked"/>
                                <label for="display_taxonomy_<?php echo $taxonomy_name->name; ?>_0"><?php _e('No', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
                            </fieldset>
                            <label class="disable_link">
                                <input id="disable_link_taxonomy_<?php echo $taxonomy_name->name; ?>" name="disable_link_taxonomy_<?php echo $taxonomy_name->name; ?>" type="checkbox" value="1" <?php
                                if (isset($bdp_settings['disable_link_taxonomy_' . $taxonomy_name->name])) {
                                    checked(1, $bdp_settings['disable_link_taxonomy_' . $taxonomy_name->name]);
                                }
                                ?> /> <?php _e('Disable Link', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </label>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        $data = ob_get_clean();
        echo $data;
        die();
    }
}

/**
 * Get post listing
 */
function bdp_get_posts_single_template() {
    ob_start();
    $tax_ids = isset($_POST['tax_ids']) ? $_POST['tax_ids'] : array();
    $tax = isset($_POST['tax']) ? $_POST['tax'] : '';

        global $wpdb;
        $db_posts = $wpdb->get_results('SELECT single_post_id FROM ' . $wpdb->prefix . 'bdp_single_layouts');
        $db_posts_list = array();
        if ($db_posts) {
            foreach ($db_posts as $db_post) {
                $sub_list = $db_post->single_post_id;
                if ($sub_list) {
                    $db_post_ids = explode(',', $sub_list);
                    foreach ($db_post_ids as $db_post_id) {
                        $db_posts_list[] = $db_post_id;
                    }
                }
            }
        }
        $final_posts = $db_posts_list;
        if ($tax == 'tag') {
            $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc', 'tag__in' => $tax_ids);
        } else if ($tax == 'category') {
            $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc', 'category__in' => $tax_ids);
        } else {
            $args = array('posts_per_page' => -1, 'post_type' => 'post', 'orderby' => 'date', 'order' => 'desc');
        }
        $allposts = get_posts($args);
        ?>
        <div class="bdp-left">
            <span class="bdp-key-title">
                <?php _e('Select Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
            </span>
        </div>
        <div class="bdp-right">
            <span class="fas fa-question-circle bdp-tooltips-icon"><span class="bdp-tooltips"><?php _e("Select post from available posts for single post layout", BLOGDESIGNERPRO_TEXTDOMAIN); ?></span></span>
            <?php
            if ($allposts) {
                ?>
                <select data-placeholder="<?php esc_attr_e('Choose Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" class="chosen-select" multiple style="width:220px;" name="template_posts[]" id="template_posts">
                    <?php
                    foreach ($allposts as $single_post) : setup_postdata($single_post);
                        ?>
                        <option <?php
                        if (in_array($single_post->ID, $final_posts)) {
                            echo 'disabled="disabled"';
                        }
                        ?> value="<?php echo $single_post->ID; ?>"><?php echo $single_post->post_title; ?></option>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                </select>
                <div class="bdp-setting-description bdp-note">
                    <b class="note"><?php _e('Note:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></b>
                <?php _e('Default All Posts Selected', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                </div>
                <?php
            } else {
                _e('No posts found', BLOGDESIGNERPRO_TEXTDOMAIN);
            }
            ?>
        </div>
    <?php
    $data = ob_get_clean();
    echo $data;
    die();
}

/**
 * Function for getting post list
 */
function bdp_get_taxonomy_list() {
    ob_start();
    if (isset($_POST['posttype']) && !empty($_POST['posttype'])) {
        $custom_posttype = $_POST['posttype'];
    }
    $taxonomy_names = get_object_taxonomies($custom_posttype);
    $sep = 1;
    if (!empty($taxonomy_names)) {
        foreach ($taxonomy_names as $taxonomy_name) {
            if (!empty($taxonomy_name)) {
                $terms = get_terms($taxonomy_name, array('hide_empty' => false));
                if (!empty($terms)) {

                    if ($sep != 1) {
                        echo ',';
                    } echo $taxonomy_name;
                    $sep++;
                }
            }
        }
    }
    $data = ob_get_clean();
    echo $data;
    die();
}

/**
 * Ajax handler for preview
 */
if (!function_exists('bdp_preview_request')) {

    function bdp_preview_request() {
        if (isset($_POST['settings'])) {
            $bdp_settings = array();
            parse_str($_POST['settings'], $bdp_settings);
            echo bdp_layout_view_portion('', $bdp_settings);
            exit();
        }
    }

}
/*
 * Ajax handler for archive preview
 */
if (!function_exists('bdp_archive_preview_request')) {

    function bdp_archive_preview_request() {
        if (isset($_POST['settings'])) {
            $bdp_settings = array();
            parse_str($_POST['settings'], $bdp_settings);
            $alter_class = '';

            $alter = 1;
            $bdp_theme = $bdp_settings['template_name'];
            if (isset($bdp_settings['bdp_blog_order_by'])) {
                $orderby = $bdp_settings['bdp_blog_order_by'];
            }
            if (isset($bdp_settings['firstpost_unique_design']) && $bdp_settings['firstpost_unique_design'] != "") {
                $firstpost_unique_design = $bdp_settings['firstpost_unique_design'];
            } else {
                $firstpost_unique_design = 0;
            }
            ?>
            <div class="blog_template bdp_wrapper bdp_archive <?php echo $bdp_theme; ?>">
                <?php
                if ($bdp_theme == "offer_blog") {
                    echo '<div class="bdp_single_offer_blog">';
                }
                if ($bdp_theme == "winter") {
                    echo '<div class="bdp_single_winter">';
                }
                if ($bdp_settings['custom_archive_type'] == 'author_template') {
                    $display_author = isset($bdp_settings['display_author_data']) ? $bdp_settings['display_author_data'] : 0;
                    $txtAuthorTitle = isset($bdp_settings['txtAuthorTitle']) ? $bdp_settings['txtAuthorTitle'] : '[author]';
                    $display_author_biography = $bdp_settings['display_author_biography'];
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
                }
                if ($bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary" || $bdp_theme == "invert-grid") {
                    echo "<div class='bdp-row $bdp_theme'>";
                }
                if ($bdp_theme == "media-grid" || $bdp_theme == "chapter" || $bdp_theme == "roctangle" || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "minimal") {
                    $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? 'column_layout_' . $bdp_settings['column_setting'] : 'column_layout_2';
                    $column_setting_ipad = (isset($bdp_settings['column_setting_ipad']) && $bdp_settings['column_setting_ipad'] != '') ? 'column_layout_ipad_' . $bdp_settings['column_setting_ipad'] : 'column_layout_ipad_2';
                    $column_setting_tablet = (isset($bdp_settings['column_setting_tablet']) && $bdp_settings['column_setting_tablet'] != '') ? 'column_layout_tablet_' . $bdp_settings['column_setting_tablet'] : 'column_layout_tablet_1';
                    $column_setting_mobile = (isset($bdp_settings['column_setting_mobile']) && $bdp_settings['column_setting_mobile'] != '') ? 'column_layout_mobile_' . $bdp_settings['column_setting_mobile'] : 'column_layout_mobile_1';
                    $column_class = $column_setting . ' ' . $column_setting_ipad . ' ' . $column_setting_tablet . ' ' . $column_setting_mobile;
                    echo "<div class='bdp-row $column_class $bdp_theme'>";
                }
                if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
                    echo '<div class="bdp-js-masonry masonry bdp_' . $bdp_theme . '">';
                }
                if ($bdp_theme == 'boxy-clean') {
                    echo '<div class="blog_template boxy-clean"><ul>';
                }
                $slider_navigation = isset($bdp_settings['navigation_style_hidden']) ? $bdp_settings['navigation_style_hidden'] : 'navigation3';
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
                global $wp_query;
                $posts_per_page = $bdp_settings['posts_per_page'];
                $orderby = 'date';
                $order = 'DESC';
                if (isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                    $orderby = $bdp_settings['bdp_blog_order_by'];
                if (isset($bdp_settings['bdp_blog_order']) && isset($bdp_settings['bdp_blog_order_by']) && $bdp_settings['bdp_blog_order_by'] != '')
                    $order = $bdp_settings['bdp_blog_order'];
                $paged = bdp_paged();
                $post_status =  isset($bdp_settings['bdp_post_status']) ? $bdp_settings['bdp_post_status'] : 'publish';

                if ($bdp_settings['custom_archive_type'] == 'category_template') {
                    if (isset($bdp_settings['template_category'][0])) {
                        $cat = $bdp_settings['template_category'][0];
                    } else {
                        $cat = '';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $arg_posts = array(
                        'post_type' => 'post',
                        'posts_per_page' => $posts_per_page,
                        'orderby' => $orderby_str,
                        'order' => $order,
                        'paged' => $paged,
                        'post_status' => $post_status,
                        'cat' => $cat
                    );
                    if ($orderby == 'meta_value_num') {
                        $arg_posts['meta_query'] = array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                        );
                    }
                } elseif ($bdp_settings['custom_archive_type'] == 'tag_template') {
                    if (isset($bdp_settings['template_tags'][0])) {
                        $tag = $bdp_settings['template_tags'][0];
                    } else {
                        $tag = '';
                    }
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $arg_posts = array(
                        'post_type' => 'post',
                        'posts_per_page' => $posts_per_page,
                        'orderby' => $orderby_str,
                        'order' => $order,
                        'paged' => $paged,
                        'post_status' => $post_status,
                        'tag_id' => $tag
                    );
                    if ($orderby == 'meta_value_num') {
                        $arg_posts['meta_query'] = array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                        );
                    }
                } else {
                    if ($orderby == 'meta_value_num') {
                        $orderby_str = $orderby . ' date';
                    } else {
                        $orderby_str = $orderby;
                    }
                    $arg_posts = array(
                        'post_type' => 'post',
                        'posts_per_page' => $posts_per_page,
                        'orderby' => $orderby_str,
                        'order' => $order,
                        'paged' => $paged,
                        'post_status' => $post_status,
                    );
                    if ($orderby == 'meta_value_num') {
                        $arg_posts['meta_query'] = array(
                            'relation' => 'OR',
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'NOT EXISTS'
                            ),
                            array(
                                'key' => '_post_like_count',
                                'compare' => 'EXISTS'
                            ),
                        );
                    }
                }

                if (($orderby == 'date' || $orderby == 'modified') && isset($bdp_settings['template_name']) && ( $bdp_settings['template_name'] == 'story' || $bdp_settings['template_name'] == 'timeline' )) {
                    $arg_posts['ignore_sticky_posts'] = 1;
                }
                if (isset($bdp_settings['template_name']) && ($bdp_settings['template_name'] == 'explore' || $bdp_settings['template_name'] == 'hoverbic')) {
                    $arg_posts['ignore_sticky_posts'] = 1;
                }
                $loop = new WP_Query($arg_posts);
                $temp_query = $wp_query;
                $wp_query = NULL;
                $wp_query = $loop;
                $prev_year1 = null;
                $prev_year = null;
                $alter_val = null;
                $prev_month = null;
                if ($loop->have_posts()) {
                    // Start the loop.
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
                            if ($bdp_theme == 'invert-grid' || $bdp_theme == 'boxy-clean' || $bdp_theme == 'news' || $bdp_theme == 'deport' || $bdp_theme == 'navia' || $bdp_theme == 'clicky') {
                                if ($firstpost_unique_design == 1) {
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
                    if ($bdp_theme == 'boxy-clean' || $bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
                        echo "</ul></div>";
                    }
                    if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy' || $bdp_theme == "boxy" || $bdp_theme == "brit_co" || $bdp_theme == "glossary" || $bdp_theme == "invert-grid") {
                        echo "</div>";
                    }
                    if ($bdp_theme == "media-grid" || $bdp_theme == "chapter" || $bdp_theme == "roctangle" || $bdp_theme == "glamour" || $bdp_theme == "famous" || $bdp_theme == "minimal") {
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
                    $slider_array = array('crayon_slider', 'sunshiny_slider', 'sallet_slider');
                    if (in_array($bdp_theme, $slider_array)) {
                        if (!wp_script_is('bdp-galleryimage-script', $list = 'enqueued')) {
                            wp_enqueue_script('bdp-galleryimage-script');
                        }
                        $template_slider_scroll = isset($bdp_settings['template_slider_scroll']) ? $bdp_settings['template_slider_scroll'] : 1;
                        $display_slider_navigation = isset($bdp_settings['display_slider_navigation']) ? $bdp_settings['display_slider_navigation'] : 1;
                        $display_slider_controls = isset($bdp_settings['display_slider_controls']) ? $bdp_settings['display_slider_controls'] : 1;
                        $slider_autoplay = isset($bdp_settings['slider_autoplay']) ? $bdp_settings['slider_autoplay'] : 1;
                        $slider_autoplay_intervals = isset($bdp_settings['slider_autoplay_intervals']) ? $bdp_settings['slider_autoplay_intervals'] : 7000;
                        $slider_speed = isset($bdp_settings['slider_speed']) ? $bdp_settings['slider_speed'] : 600;
                        $template_slider_effect = isset($bdp_settings['template_slider_effect']) ? $bdp_settings['template_slider_effect'] : 'slide';
                        $slider_column = 1;
                        if ($bdp_settings['template_slider_effect'] == 'slide') {
                            $slider_column = isset($bdp_settings['template_slider_columns']) ? $bdp_settings['template_slider_columns'] : 1;
                            $slider_column_ipad = isset($bdp_settings['template_slider_columns_ipad']) ? $bdp_settings['template_slider_columns_ipad'] : 1;
                            $slider_column_tablet = isset($bdp_settings['template_slider_columns_tablet']) ? $bdp_settings['template_slider_columns_tablet'] : 1;
                            $slider_column_mobile = isset($bdp_settings['template_slider_columns_mobile']) ? $bdp_settings['template_slider_columns_mobile'] : 1;
                        } else {
                            $slider_column = $slider_column_ipad = $slider_column_tablet = $slider_column_mobile = 1;
                        }
                        $slider_arrow = isset($bdp_settings['arrow_style_hidden']) ? $bdp_settings['arrow_style_hidden'] : 'arrow1';
                        if ($slider_arrow == '') {
                            $prev = "<i class='fas fa-chevron-left'></i>";
                            $next = "<i class='fas fa-chevron-right'></i>";
                        } else {
                            $prev = "<div class='" . $slider_arrow . "'></div>";
                            $next = "<div class='" . $slider_arrow . "'></div>";
                        }
                        ?>
                        <script type="text/javascript" class="dynamic_script">
                            jQuery(document).ready(function () {
                                var $maxItems = 1;
                                if (jQuery(window).width() > 980) {
                                    $maxItems = <?php echo $slider_column; ?>;
                                } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
                                    $maxItems = <?php echo $slider_column_ipad; ?>;
                                } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
                                    $maxItems = <?php echo $slider_column_tablet; ?>;
                                } else if (jQuery(window).width() <= 480) {
                                    $maxItems = <?php echo $slider_column_mobile; ?>;
                                }

                                jQuery('.slider_' + <?php echo $unique_id; ?>).flexslider({
                                move: <?php echo $template_slider_scroll; ?>,
                                        animation: '<?php echo $template_slider_effect; ?>',
                                        itemWidth: 10,
                                        itemMargin: 15,
                                        minItems: 1,
                                        maxItems: $maxItems,
                                        rtl: <?php if(is_rtl()) { echo 1; } else { echo 0; } ?>,
                                        <?php if ($display_slider_navigation) { ?>
                                                        directionNav: true,
                                        <?php } else { ?>
                                                        directionNav: false,
                                        <?php } ?>
                                        <?php if ($display_slider_controls) { ?>
                                                        controlNav: true,
                                        <?php } else { ?>
                                                        controlNav: false,
                                        <?php } ?>
                                        <?php if ($slider_autoplay) { ?>
                                                        slideshow: true,
                                        <?php } else { ?>
                                                        slideshow: false,
                                        <?php } ?>
                                        <?php if ($slider_autoplay) { ?>
                                                        slideshowSpeed: <?php echo $slider_autoplay_intervals; ?>,
                                        <?php } ?>
                                        <?php if ($slider_speed) { ?>
                                                        animationSpeed: <?php echo $slider_speed; ?>,
                                        <?php } ?>
                                        prevText: "<?php echo $prev; ?>",
                                        nextText: "<?php echo $next; ?>"
                            });
                            });
                        </script>
                        <?php
                    }
                    if (!in_array($bdp_theme, $slider_array) && isset($bdp_settings['pagination_type']) && $bdp_settings['pagination_type'] != 'no_pagination') {
                        $pagination_template = isset($bdp_settings['pagination_template']) ? $bdp_settings['pagination_template'] : 'template-1';
                        echo '<div class="wl_pagination_box ' . $pagination_template . '">';
                        echo bdp_standard_paging_nav();
                        echo '</div>';
                    }
                } else {
                    _e('No posts found', BLOGDESIGNERPRO_TEXTDOMAIN);
                }
                wp_reset_query();
                $wp_query = NULL;
                $wp_query = $temp_query;
                ?>
            </div>
            <?php
        }
        exit();
    }

}


/**
 * Ajax handler for Store closed box id
 */
if (!function_exists('bdp_closed_bdpboxes')) {

    function bdp_closed_bdpboxes() {

        $closed = isset($_POST['closed']) ? explode(',', $_POST['closed']) : array();
        $closed = array_filter($closed);

        $page = isset($_POST['page']) ? $_POST['page'] : '';

        if ($page != sanitize_key($page))
            wp_die(0);

        if (!$user = wp_get_current_user())
            wp_die(-1);

        if (is_array($closed))
            update_user_option($user->ID, "bdpclosedbdpboxes_$page", $closed, true);

        wp_die(1);
    }

}


/**
 * Admin notice layouts notice dismiss
 * @since 1.6
 */
if(!function_exists('bdp_admin_notice_pro_layouts_dismiss')) {
    function bdp_admin_notice_pro_layouts_dismiss () {
        update_option('bdp_admin_notice_pro_layouts_dismiss', true);
    }
}

/**
 * Admin notice layouts transfer notice dismiss
 * @since 1.6
 */
if(!function_exists('bdp_create_layout_from_blog_designer_dismiss')) {
    function bdp_create_layout_from_blog_designer_dismiss () {
        update_option('bdp_admin_notice_create_layout_from_blog_designer_dismiss', true);
    }
}


/**
 * Get blog template list
 * @since 1.6
 */
if(!function_exists('bdp_blog_template_list')) {
    function bdp_blog_template_list() {
        $tempate_list = array(
            'boxy' => array(
                'template_name' => __('Boxy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'image_name' => 'boxy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-boxy-blog-template/')
            ),
            'boxy-clean' => array(
                'template_name' => __('Boxy Clean Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'boxy-clean.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-boxy-clean-blog-template/')
            ),
            'brit_co' => array(
                'template_name' => __('Brit Co Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'brit_co.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-brit-co-blog-template/')
            ),
            'classical' => array(
                'template_name' => __('Classical Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'classical.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-classical-blog-template/')
            ),
            'cool_horizontal' => array(
                'template_name' => __('Cool Horizontal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline slider',
                'image_name' => 'cool_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-cool-horizontal-timeline-blog-template/')
            ),
            'cover' => array(
                'template_name' => __('Cover Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'cover.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-cover-blog-template/')
            ),
            'clicky' => array(
                'template_name' => __('Clicky Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'clicky.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-clicky-blog-template/')
            ),
            'deport' => array(
                'template_name' => __('Deport Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'deport.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-deport-blog-template/')
            ),
            'easy_timeline' => array(
                'template_name' => __('Easy Timeline', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'easy_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-easy-timeline-blog-template/')
            ),
            'elina' => array(
                'template_name' => __('Elina Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'elina.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-elina-blog-template/')
            ),
            'evolution' => array(
                'template_name' => __('Evolution Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'evolution.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-evolution-blog-template/')
            ),
            'fairy' => array(
                'template_name' => __('Fairy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'fairy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-fairy-blog-template/')
            ),
            'famous' => array(
                'template_name' => __('Famous Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'famous.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-famous-blog-template/')
            ),
            'glamour' => array(
                'template_name' => __('Glamour Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'glamour.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-glamour-blog-template/')
            ),
            'glossary' => array(
                'template_name' => __('Glossary Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'image_name' => 'glossary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-glossary-blog-template/')
            ),
            'explore' => array(
                'template_name' => __('Explore Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'explore.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-explore-blog-template/')
            ),
            'hoverbic' => array(
                'template_name' => __('Hoverbic Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'hoverbic.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-hoverbic-blog-template/')
            ),
            'hub' => array(
                'template_name' => __('Hub Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'hub.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-hub-blog-template/')
            ),
            'minimal' => array(
                'template_name' => __('Minimal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'minimal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-minimal-grid-blog-template/')
            ),
            'masonry_timeline' => array(
                'template_name' => __('Masonry Timeline', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine timeline',
                'image_name' => 'masonry_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-masonry-timeline-blog-template/')
            ),
            'invert-grid' => array(
                'template_name' => __('Invert Grid Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'invert-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-invert-grid-blog-template/')
            ),
            'lightbreeze' => array(
                'template_name' => __('Lightbreeze Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'lightbreeze.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-light-breeze-blog-template/')
            ),
            'media-grid' => array(
                'template_name' => __('Media Grid Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'media-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-media-grid-blog-template/')
            ),
            'my_diary' => array(
                'template_name' => __('My Diary Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'my_diary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-my-diary-blog-template/')
            ),
            'navia' => array(
                'template_name' => __('Navia Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'navia.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-navia-blog-template/')
            ),
            'news' => array(
                'template_name' => __('News Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'news.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-news-blog-template/')
            ),
            'offer_blog' => array(
                'template_name' => __('Offer Blog Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'offer_blog.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-offer-blog-template/')
            ),
            'overlay_horizontal' => array(
                'template_name' => __('Overlay Horizontal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline slider',
                'image_name' => 'overlay_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-overlay-horizontal-timeline-blog-template/')
            ),
            'nicy' => array(
                'template_name' => __('Nicy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'nicy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-nicy-blog-template/')
            ),
            'region' => array(
                'template_name' => __('Region Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'region.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-region-blog-template/')
            ),
            'roctangle' => array(
                'template_name' => __('Roctangle Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'data' => 'NEW',
                'image_name' => 'roctangle.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-roctangle-blog-template/')
            ),
            'sharpen' => array(
                'template_name' => __('Sharpen Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'sharpen.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sharpen-blog-template/')
            ),
            'spektrum' => array(
                'template_name' => __('Spektrum Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'spektrum.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-spektrum-blog-template/')
            ),
            'story' => array(
                'template_name' => __('Story Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'story.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-story-timeline-blog-template/')
            ),
            'timeline' => array(
                'template_name' => __('Timeline Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-timeline-blog-template/')
            ),
            'winter' => array(
                'template_name' => __('Winter Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'winter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-winter-blog-template/')
            ),
            'crayon_slider' => array(
                'template_name' => __('Crayon Slider Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'slider',
                'image_name' => 'crayon_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-crayon-slider-blog-template/')
            ),
            'sallet_slider' => array(
                'template_name' => __('Sallet Slider Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'slider',
                'image_name' => 'sallet_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sallet-slider-blog-template/')
            ),
            'sunshiny_slider' => array(
                'template_name' => __('Sunshiny Slider Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'slider',
                'image_name' => 'sunshiny_slider.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-sunshiny-slider-blog-template/')
            ),
            'pretty' => array(
                'template_name' => __('Pretty Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'pretty.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-pretty-blog-template/')
            ),
            'tagly' => array(
                'template_name' => __('Tagly Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'tagly.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-tagly-blog-template/')
            ),
            'brite' => array(
                'template_name' => __('Brite Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'brite.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-brite-blog-template/')
            ),
            'chapter' => array(
                'template_name' => __('Chapter Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'chapter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-chapter-blog-template/')
            ),
            'steps' => array(
                'template_name' => __('Steps Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'data' => 'NEW',
                'image_name' => 'steps.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-steps-timeline-blog-template/')
            ),
            'miracle' => array(
                'template_name' => __('Miracle Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'miracle.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/demo/blog-miracle-blog-template/')
            ),
        );
        ksort($tempate_list);
        return $tempate_list;
    }
}

/**
 * Get single blog template list
 * @since 1.6
 */
if (!function_exists('bdp_single_blog_template_list')) {

    function bdp_single_blog_template_list() {
        $tempate_list = array(
            'boxy' => array(
                'template_name' => __('Boxy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'image_name' => 'boxy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=boxy')
            ),
            'boxy-clean' => array(
                'template_name' => __('Boxy Clean Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'boxy-clean.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=boxy-clean')
            ),
            'brit_co' => array(
                'template_name' => __('Brit Co Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'brit_co.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=brit_co')
            ),
            'brite' => array(
                'template_name' => __('Brite Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'brite.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=brite')
            ),
            'chapter' => array(
                'template_name' => __('Chapter Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'chapter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=chapter')
            ),
            'classical' => array(
                'template_name' => __('Classical Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'classical.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=classical')
            ),
            'cool_horizontal' => array(
                'template_name' => __('Cool Horizontal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline slider',
                'image_name' => 'cool_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=cool_horizontal')
            ),
            'deport' => array(
                'template_name' => __('Deport Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'deport.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=deport')
            ),
            'easy_timeline' => array(
                'template_name' => __('Easy Timeline Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'easy_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=easy_timeline')
            ),
            'elina' => array(
                'template_name' => __('Elina Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'elina.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=elina')
            ),
            'evolution' => array(
                'template_name' => __('Evolution Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'evolution.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=evolution')
            ),
            'hub' => array(
                'template_name' => __('Hub Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'hub.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=hub')
            ),
            'glossary' => array(
                'template_name' => __('Glossary Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'image_name' => 'glossary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=glossary')
            ),
            'explore' => array(
                'template_name' => __('Explore Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'explore.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=explore')
            ),
            'masonry_timeline' => array(
                'template_name' => __('Masonry Timeline', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine timeline',
                'image_name' => 'masonry_timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=masonry_timeline')
            ),
            'nicy' => array(
                'template_name' => __('Nicy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'nicy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=nicy')
            ),
            'invert-grid' => array(
                'template_name' => __('Invert Grid Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'invert-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=invert-grid')
            ),
            'lightbreeze' => array(
                'template_name' => __('Lightbreeze Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'lightbreeze.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=lightbreeze')
            ),
            'media-grid' => array(
                'template_name' => __('Media Grid Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'image_name' => 'media-grid.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=media-grid')
            ),
            'my_diary' => array(
                'template_name' => __('My Diary Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'my_diary.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=my_diary')
            ),
            'navia' => array(
                'template_name' => __('Navia Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'navia.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=navia')
            ),
            'news' => array(
                'template_name' => __('News Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'magazine',
                'image_name' => 'news.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=news')
            ),
            'offer_blog' => array(
                'template_name' => __('Offer Blog Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'offer_blog.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=offer_blog')
            ),
            'overlay_horizontal' => array(
                'template_name' => __('Overlay Horizontal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline slider',
                'image_name' => 'overlay_horizontal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=overlay_horizontal')
            ),
            'region' => array(
                'template_name' => __('Region Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'region.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=region')
            ),
            'roctangle' => array(
                'template_name' => __('Roctangle Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'masonry',
                'data' => 'NEW',
                'image_name' => 'roctangle.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=roctangle')
            ),
            'spektrum' => array(
                'template_name' => __('Spektrum Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'spektrum.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=spektrum')
            ),
            'sharpen' => array(
                'template_name' => __('Sharpen Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'sharpen.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=sharpen')
            ),
            'story' => array(
                'template_name' => __('Story Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'story.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=story_timeline')
            ),
            'tagly' => array(
                'template_name' => __('Tagly Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'tagly.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=tagly')
            ),
            'timeline' => array(
                'template_name' => __('Timeline Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'image_name' => 'timeline.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=timeline')
            ),
            'winter' => array(
                'template_name' => __('Winter Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'winter.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=winter')
            ),
            'pretty' => array(
                'template_name' => __('Pretty Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'image_name' => 'pretty.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=pretty')
            ),
            'minimal' => array(
                'template_name' => __('Minimal Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'minimal.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=minimal')
            ),
            'glamour' => array(
                'template_name' => __('Glamour Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'glamour.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=glamour')
            ),
            'famous' => array(
                'template_name' => __('Famous Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'famous.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=famous')
            ),
            'fairy' => array(
                'template_name' => __('Fairy Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'fairy.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=fairy')
            ),
            'clicky' => array(
                'template_name' => __('Clicky Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'clicky.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=clicky')
            ),
            'cover' => array(
                'template_name' => __('Cover Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'grid',
                'data' => 'NEW',
                'image_name' => 'cover.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=cover')
            ),
            'steps' => array(
                'template_name' => __('Steps Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'timeline',
                'data' => 'NEW',
                'image_name' => 'steps.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=steps')
            ),
            'miracle' => array(
                'template_name' => __('Miracle Template', BLOGDESIGNERPRO_TEXTDOMAIN),
                'class' => 'full-width',
                'data' => 'NEW',
                'image_name' => 'miracle.jpg',
                'demo_link' => esc_url('http://blogdesigner.solwininfotech.com/blog-designer-plugin-instead-of-replacing-wordpress-theme-simultaneously/?template=miracle')
            ),
        );
        ksort($tempate_list);
        return $tempate_list;
    }
}

/**
 * Blog Template Search Result
 * @since 1.6
 */
if (!function_exists('bdp_blog_template_search_result')) {

    function bdp_blog_template_search_result() {
        $template_name = strtolower($_POST['temlate_name']);
        $tempate_list = bdp_blog_template_list();
        foreach ($tempate_list as $key => $value) {
            if ($template_name == '') {
                ?>
                <div class="template-thumbnail <?php echo $value['class']; ?>" <?php echo (isset($value['data']) && $value['data'] != '') ? 'data-value="'.$value['data'].'"' : ''?>>
                    <div class="template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <div class="hover_overlay">
                            <div class="popup-template-name">
                                <div class="popup-select"><a href="#"><?php _e('Select Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                                <div class="popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <span class="bdp-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            } elseif (preg_match('/' . trim($template_name) . '/', $key)) {
                ?>
                <div class="template-thumbnail <?php echo $value['class']; ?>" <?php echo (isset($value['data']) && $value['data'] != '') ? 'data-value="'.$value['data'].'"' : ''?>>
                    <div class="template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/layouts/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <div class="hover_overlay">
                            <div class="popup-template-name">
                                <div class="popup-select"><a href="#"><?php _e('Select Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                                <div class="popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <span class="bdp-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            }
        }
        exit();
    }
}


/**
 * Single Blog Template Search Result
 * @since 1.6
 */
if (!function_exists('bdp_single_blog_template_search_result')) {

    function bdp_single_blog_template_search_result() {
        $template_name = $_POST['temlate_name'];
        $tempate_list = bdp_single_blog_template_list();
        foreach ($tempate_list as $key => $value) {
            if ($template_name == '') {
                ?>
                <div class="template-thumbnail <?php echo $value['class']; ?>" <?php echo (isset($value['data']) && $value['data'] != '') ? 'data-value="'.$value['data'].'"' : ''?>>
                    <div class="template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/single/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <div class="hover_overlay">
                            <div class="popup-template-name">
                                <div class="popup-select"><a href="#"><?php _e('Select Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                                <div class="popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <span class="bdp-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            } elseif (preg_match('/' . trim($template_name) . '/', $key)) {
                ?>
                <div class="template-thumbnail <?php echo $value['class']; ?>" <?php echo (isset($value['data']) && $value['data'] != '') ? 'data-value="'.$value['data'].'"' : ''?>>
                    <div class="template-thumbnail-inner">
                        <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/single/' . $value['image_name']; ?>" data-value="<?php echo $key; ?>" alt="<?php echo $value['template_name']; ?>" title="<?php echo $value['template_name']; ?>">
                        <div class="hover_overlay">
                            <div class="popup-template-name">
                                <div class="popup-select"><a href="#"><?php _e('Select Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                                <div class="popup-view"><a href="<?php echo $value['demo_link']; ?>" target="_blank"><?php _e('Live Demo', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <span class="bdp-span-template-name"><?php echo $value['template_name']; ?></span>
                </div>
                <?php
            }
        }
        exit();
    }
}

/**
 * Admin notice text domain change notice dismiss
 * @since 2.0
 */
if(!function_exists('bdp_notice_change_textdomain_dismiss')) {
    function bdp_notice_change_textdomain_dismiss () {
        global $bdp_db_version;
        update_option('bdp_change_text_domain_notice', 1);
        update_option("bdp_db_version", $bdp_db_version);
    }
}

/**
 * Admin notice template outdated notice dismiss
 * @since 2.0
 */
if(!function_exists('bdp_notice_template_outdated_dismiss')) {
    function bdp_notice_template_outdated_dismiss () {
        update_option('bdp_template_outdated', 1);
    }
}
