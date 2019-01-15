//Set the templates for show blog post Uniqu design for first post and selected post
var $unique_design = ["navia", "boxy-clean", "invert-grid", "deport", "media-grid", "news"];
//Set the templates for show blog columns
var $blog_columns = ["glossary", "brit_co", "boxy", "boxy-clean"];
//Set the templates for show grid blog columns heights
var $blog_gridheight = ["explore", "hoverbic"];

var $blog_explore = ["explore"];

//Set the templates for show template color
var $blog_templatecolor = ["timeline", "classical", "nicy","boxy-clean", "story", "easy_timeline", "crayon_slider", "overlay_horizontal", "sallet_slider", "sunshiny_slider", "pretty", "tagly", "brite", "chapter", "advice", "roctangle", "cover", "fairy", "steps"];

// Title background color
var $titlebackcolor_hide = ["brite", "chapter", "advice"];

//Set the templates for show template alternative color
var $blog_template_alternative_color = ["story"];

//Set the templates for show template year
var $blog_display_year = ["story"];

//Set the templates for show blog post background color
var $blog_bgcolor = ["region", "evolution", "lightbreeze", "sharpen", "winter"];

//Set the templates for show blog alternative post background color
var $blog_alternativebgcolor = ["region", "evolution", "lightbreeze", "sharpen", "winter"];

//Set the templates for show dash color
var $dashcolor = ["deport"];

//Set the templates for show Category Background Color
var $cat_bgcolor = ["winter", "crayon_slider", "sallet_slider", "sunshiny_slider", "brite"];

//Set the templates for show Post content hover color
var $post_content_hover = ["glossary"];

//Set the templates for Show post date color
var $post_date_color = ["hub", "spektrum"];

//Set the templates for Hide content setting block
var $bdp_content_setting = ["brit_co", "explore", "hoverbic"];

//Set the templates for hide feed excert
var $feed_excert = ["brit_co"];

//Set the templates for hide excerpt length
var $excerpt_len = ["brit_co"];

//Set the templates for hide comment
var $display_comment = [""];

var $boxy_clean = ["boxy-clean"];

var $only_background_color = ["boxy-clean", "boxy", "glossary", "news","navia", "timeline", "offer_blog", "spektrum", "hub", "my_diary", "pretty", "chapter", "tagly", "media-grid", "advice","glamour", "cover", "fairy", "famous", "steps", "minimal", "clicky", "miracle"];

var $pagination_hide = ["cool_horizontal", "overlay_horizontal"];

var $horizontal_timeline_option = ["cool_horizontal", "overlay_horizontal"];

var $active_post_timeline_option = ["cool_horizontal", "overlay_horizontal"];

var $easy_timeline_effect = ['easy_timeline', 'steps'];

var $story_template_style = ['story'];

var $my_diary_template_options = ['my_diary'];

var $elina_template_options = ['elina'];

var $masonry_timeline_options = ['masonry_timeline'];

var $thumbnail_skin = ['deport', 'news', 'story', 'cover', 'clicky'];

var $feature_image_as_background_image = ['timeline'];

var $filter_option = ["boxy", "cool_horizontal", "overlay_horizontal", "news", "invert-grid", "brit_co"];

var $image_corner_selection = ["sharpen"];

var $slider_template = ["crayon_slider", "sallet_slider", "sunshiny_slider"];

var $slider_custom_read_more = ["crayon_slider", "sallet_slider", "sunshiny_slider"];

var $pinterest_image_share = ["sallet_slider"];

var $column_setting = ["media-grid", "chapter", "roctangle", "advice","glamour", "famous", "integer", "minimal"];

var $story_tr = ["story"];

//var $content_hide = ["hoverbic", "explore"];

var $readmore_bg_color = ["chapter", "roctangle", "advice","glamour", "steps"];

var $readmore_bg_hover_color = ["chapter", "elina", "masonry_timeline", "overlay_horizontal", "cool_horizontal", "advice","roctangle", "glamour", "steps"];

var $image_hover_effect_hide = ["brite", "elina", "explore", "hoverbic", "invert-grid", "overlay_horizontal", "sallet_slider", "spektrum", "sunshiny_slider", "glamour", "roctangle", "fairy"];

var $date_formate = ["hub", "pretty", "roctangle", "spektrum", "story", "timeline"];

var $date_from = ["story", "timeline"];

function setOptionVisibility(template) {

    template = jQuery.trim(template);

    //Show/Hide Blog columns
    if (jQuery.inArray(template, $blog_columns) !== -1) {
        jQuery('.blog-columns-tr').show();
    } else {
        jQuery('.blog-columns-tr').hide();
    }

    if (jQuery.inArray(template, $story_tr) !== -1) {
        jQuery('.story-startup-tr').show();
        jQuery('.story-ending-tr').show();
    } else {
        jQuery('.story-startup-tr').hide();
        jQuery('.story-ending-tr').hide();
    }

    if (jQuery.inArray(template, $titlebackcolor_hide) !== -1) {
        jQuery('.titlebackcolor_tr').hide();
    }

    if (jQuery.inArray(template, $blog_explore) !== -1) {
        jQuery('.blog-gridskin-tr .only_explore').show();
    } else {
        jQuery('.blog-gridskin-tr .only_explore').hide();
    }

    if (jQuery.inArray(template, $blog_gridheight) !== -1) {
        jQuery('.hoverbic-hoverbackcolor-tr').show();
        jQuery('.titlebackcolor_tr').hide();
    } else {
        jQuery('.hoverbic-hoverbackcolor-tr').hide();
    }

    if (jQuery.inArray(template, $blog_gridheight) !== -1) {
        jQuery('.blog-grid-height-tr').show();
        if (jQuery("input[name='blog_grid_height']:checked").val() == 1) {
            jQuery('.blog-post-grid-height-tr').show();
        } else {
            jQuery('.blog-post-grid-height-tr').hide();
        }
        jQuery('.blog-gridskin-tr').show();
        jQuery('.bdp-content-setting').hide();
        jQuery('.gridcol_space_tr').show();
        jQuery('.bdp_media_size_tr').hide();
    } else {
        jQuery('.blog-grid-height-tr').hide();
        jQuery('.blog-post-grid-height-tr').hide();
        jQuery('.blog-gridskin-tr').hide();
        jQuery('.gridcol_space_tr').hide();
        jQuery('.bdp-content-setting').show();
    }

    if (jQuery.inArray(template, $blog_template_alternative_color) !== -1) {
        jQuery('.template_alternative_color').show();
    } else {
        jQuery('.template_alternative_color').hide();
    }

    if (jQuery.inArray(template, $blog_display_year) !== -1) {
        jQuery('.display_year').show();
    } else {
        jQuery('.display_year').hide();
    }

    if (jQuery.inArray(template, $pagination_hide) !== -1) {
        jQuery('.archive_pagination_type').hide();
        jQuery('.loadmore_btn_option').hide();
    } else {
        jQuery('.archive_pagination_type').show();
        if(jQuery("select[name='pagination_type']").val() == 'load_more_btn') {
            jQuery('.loadmore_btn_option').show();
        } else {
            jQuery('.loadmore_btn_option').hide();
        }
    }

    if (jQuery.inArray(template, $active_post_timeline_option) !== -1) {
        jQuery('.display_active_post_option').show();
    } else {
        jQuery('.display_active_post_option').hide();
    }
    if (jQuery.inArray(template, $horizontal_timeline_option) !== -1) {
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'dbptimeline') {
                jQuery(this).removeClass('clickDisable');
            }
        });
        jQuery('.bdp_posts_per_page').hide();
        jQuery('.titlebackcolor_tr').hide();
        jQuery('.bdp_media_size_tr').hide();
    } else {
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'dbptimeline') {
                jQuery(this).addClass('clickDisable');
            }
        });
        jQuery('#dbptimeline').hide();
        jQuery('.bdp_posts_per_page').show();
    }

    if (jQuery.inArray(template, $filter_option) !== -1) {
        jQuery('.filter_data').show();
    } else {
        jQuery('.filter_data').hide();
    }

    if (jQuery.inArray(template, $easy_timeline_effect) !== -1) {
        jQuery('.easy_timeline_effect_tr').show();
        jQuery('.display_feature_image_tr').show();
        jQuery('.titlebackcolor').hide();
    } else {
        jQuery('.easy_timeline_effect_tr').hide();
        jQuery('.display_feature_image_tr').hide();
        jQuery('.titlebackcolor').show();
    }

    if (template == 'cool_horizontal') {
        jQuery('.item_height_td').html(bdpro_js.change_html);
    }

    if (jQuery.inArray(template, $story_template_style) !== -1) {
        jQuery('.story-startup-tr').show();
    } else {
        jQuery('.story-startup-tr').hide();
    }

    //show-hide image corner selection
    if (jQuery.inArray(template, $image_corner_selection) !== -1) {
        jQuery('.lightbreeze-image-corner').show();
    } else {
        jQuery('.lightbreeze-image-corner').hide();
    }

    //Show/Hide Blog template color
    if (jQuery.inArray(template, $blog_templatecolor) !== -1) {
        jQuery('.blog-templatecolor-tr').show();
    } else {
        jQuery('.blog-templatecolor-tr').hide();
    }

    //Show/Hide Blog post background color
    if (jQuery.inArray(template, $blog_bgcolor) !== -1) {
        jQuery('.blog-template-tr').show();
    } else {
        jQuery('.blog-template-tr').hide();
    }

    //Show/Hide Blog post background color only
    if (jQuery.inArray(template, $only_background_color) !== -1) {
        jQuery('.blog-template-tr.bdp-back-color-blog').show();
        jQuery('.bdp-archive-page .bdp-back-color-blog').show();
    }

    //Show/Hide Blog post background color only
    if (jQuery.inArray(template, $blog_bgcolor) !== -1) {
        jQuery('.bdp-archive-page .bdp-back-color-blog').show();
    } else {
        jQuery('.bdp-archive-page .bdp-back-color-blog').hide();
    }
    //Show/Hide Blog post background Hover color only
    if (jQuery.inArray(template, $boxy_clean) !== -1) {
        jQuery('.bdp-back-hover-color-blog').show();
    } else {
        jQuery('.bdp-back-hover-color-blog').hide();
    }
    //Show/Hide Blog post unique design only
    if (jQuery.inArray(template, $unique_design) !== -1) {
        jQuery('.blog_unique_design_tr').show();
        if (jQuery('#blog_unique_design').attr('checked')) {
            jQuery('.blog-unique-tr').show();
        } else {
            jQuery('.blog-unique-tr').hide();
        }
    } else {
        jQuery('.blog-unique-tr').hide();
        jQuery('.blog_unique_design_tr').hide();
    }
    jQuery('#blog_unique_design').change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery('.blog-unique-tr').show();
        } else {
            jQuery('.blog-unique-tr').hide();
        }
        bdpAltBackground();
    });
    //Show/Hide archive post unique design only
    if (jQuery.inArray(template, $unique_design) !== -1) {
        jQuery('.firstpost_unique_archive-tr').show();
    } else {
        jQuery('.firstpost_unique_archive-tr').hide();
    }
    //Show/Hide Blog post background color only archive page
    if (jQuery.inArray(template, $only_background_color) !== -1) {
        jQuery('.bdp-archive-page .bdp-back-color-blog').show();
    }

    //Show/Hide Blog post background color
    if (jQuery.inArray(template, $blog_alternativebgcolor) !== -1) {
        if (jQuery("input[name='template_alternativebackground']:checked").val() == 1) {
            jQuery('.alternative-color-tr').show();
        } else {
            jQuery('.alternative-color-tr').hide();
        }
    } else {
        jQuery('.alternative-color-tr').hide();
    }


    //Show/Hide Dash color
    if (jQuery.inArray(template, $dashcolor) !== -1) {
        if (jQuery("input[name='display_category']:checked").val() == 1) {
            jQuery('.deport-dash-div').show();
        } else {
            jQuery('.deport-dash-div').hide();
        }
        jQuery("input[name='display_category']").change(function () {
            if (jQuery(this).val() == 1) {
                jQuery('.deport-dash-div').show();
            } else {
                jQuery('.deport-dash-div').hide();
            }
        });
    } else {
        jQuery('.deport-dash-div').hide();
    }

    //Show/Hide Category Background color
    if (jQuery.inArray(template, $cat_bgcolor) !== -1) {
        jQuery('.winter-category-back-color').show();
    }
    else {
        jQuery('.winter-category-back-color').hide();
    }

    //Show/Hide content setting block
    if (jQuery.inArray(template, $bdp_content_setting) !== -1) {
        jQuery('.bdp-content-setting').hide();
        jQuery('.bdp-content-settings-info').show();
    } else {
        jQuery('.bdp-content-setting').show();
        jQuery('.bdp-content-settings-info').hide();
    }

    //Show/Hide feed_excert
    if (jQuery.inArray(template, $feed_excert) !== -1) {
        jQuery('.feed_excert').hide();
    } else {
        jQuery('.feed_excert').show();
    }

    //Show/Hide excerpt length
    if (jQuery.inArray(template, $excerpt_len) !== -1) {
        jQuery('.post_content_from').hide();
        jQuery('.display_html_tags_tr').hide();
        jQuery('.content-firstletter-tr').hide();
        jQuery('.excerpt_length').hide();
        jQuery('.contentcolor_tr').hide();
        jQuery('.advance_contents_tr').hide();
        jQuery('.post_content_hover').hide();
        jQuery('.read_more_text').hide();
        jQuery('.read_more_text_color').hide();
        jQuery('.read_more_text_background').hide();
        jQuery('.read_more_text_hover_background').hide();
        jQuery('.sprecrum_date_color').hide();
    } else {
        jQuery('.post_content_from').show();
        jQuery('.display_html_tags_tr').show();
        jQuery('.content-firstletter-tr').show();
        jQuery('.excerpt_length').show();
        jQuery('.contentcolor_tr').show();
        jQuery('.advance_contents_tr').show();
        jQuery('.post_content_hover').show();
        jQuery('.read_more_text').show();
        jQuery('.read_more_text_color').show();
        jQuery('.read_more_text_background').show();
        jQuery('.read_more_text_hover_background').show();
        jQuery('.sprecrum_date_color').show();
        if (jQuery.inArray(template, $readmore_bg_color) !== -1) {
            jQuery('.read_more_text_background').hide();
        }
        if (jQuery("input[name='advance_contents']:checked").val() == 1) {
            jQuery(".advance_contents_settings").show();
            if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                jQuery(".advance_contents_settings_character").show();
            } else {
                jQuery(".advance_contents_settings_character").hide();
            }
        } else {
            jQuery(".advance_contents_settings").hide();
        }
    }

    //Show/Hide Post date color
    if (jQuery.inArray(template, $post_content_hover) !== -1) {
        jQuery('.post_content_hover').show();
    } else {
        jQuery('.post_content_hover').hide();
    }

    //Show/Hide Post date color
    if (jQuery.inArray(template, $post_date_color) !== -1) {
        jQuery('.sprecrum_date_color').show();
    } else {
        jQuery('.sprecrum_date_color').hide();
    }

    //Show/Hide comment
    if (jQuery.inArray(template, $display_comment) !== -1) {
        jQuery('.display_comment').hide();
    } else {
        jQuery('.display_comment').show();
    }

    if (jQuery.inArray(template, $my_diary_template_options) !== -1) {
        jQuery('.pinterest_image_share_tr').hide();
        jQuery('.blog-template-tr.bdp-back-color-blog').show();
        jQuery('#blog-columns-tr').hide();
        jQuery('.titlebackcolor_tr').hide();
    }

    if (jQuery.inArray(template, $elina_template_options) !== -1) {
        jQuery('.blog-template-tr.bdp-back-color-blog').show();
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery('.titlebackcolor_tr').hide();
        jQuery('#blog-columns-tr').hide();
        jQuery('.read_more_text_color_td').html(bdpro_js.read_more_hover);
        jQuery('.social_count_position_tr').hide();
    }

    if (jQuery.inArray(template, $masonry_timeline_options) !== -1) {
        jQuery('.blog-template-tr.bdp-back-color-blog').show();
        jQuery('.titlebackcolor_tr').hide();
        jQuery('#blog-columns-tr').hide();
        jQuery('.read_more_text_color_td').html(bdpro_js.read_more_hover);
    }

    if (jQuery.inArray(template, $thumbnail_skin) !== -1) {
        jQuery('.thumbnail_skin_tr').show();
    } else {
        jQuery('.thumbnail_skin_tr').hide();
    }

    if (jQuery.inArray(template, $feature_image_as_background_image) !== -1) {
        jQuery('.blog_background_image_tr').show();
    } else {
        jQuery('.blog_background_image_tr').hide();
    }

    /*Hide and show slider setting*/
    if (jQuery.inArray(template, $slider_template) !== -1) {
        jQuery('.archive_pagination_type').hide();
        jQuery('.loadmore_btn_option').hide();
        jQuery('.archive_pagination_template').hide();
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpslider') {
                jQuery(this).removeClass('clickDisable');
            }
        });
    } else {
        if (jQuery.inArray(template, $pagination_hide) !== -1) {
            jQuery('.archive_pagination_type').hide();
            jQuery('.loadmore_btn_option').hide();
        } else {
            jQuery('.archive_pagination_type').show();
            if(jQuery("select[name='pagination_type']").val() == 'load_more_btn') {
                jQuery('.loadmore_btn_option').show();
            } else {
                jQuery('.loadmore_btn_option').hide();
            }
        }
        if (jQuery("select[name='pagination_type']").val() == 'paged') {
            jQuery(".archive_pagination_template").show();
        } else {
            jQuery(".archive_pagination_template").hide();
        }
        jQuery('div#bdpslider').hide();
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpslider') {
                jQuery(this).addClass('clickDisable');
            }
        });
    }

    /*Hide and show pinterest image share setting*/
    if (jQuery.inArray(template, $pinterest_image_share) !== -1) {
        jQuery('.pinterest_image_share_tr').hide();
    }

    /*Hide and show column settings*/
    if (jQuery.inArray(template, $column_setting) !== -1) {
        jQuery('.column_setting_tr').show();
    } else {
        jQuery('.column_setting_tr').hide();
    }

    if (jQuery.inArray(template, $readmore_bg_color) !== -1) {
        jQuery('.read_more_text_background').hide();
    }

    if (jQuery.inArray(template, $readmore_bg_hover_color) !== -1) {
        jQuery('.read_more_text_hover_background').hide();
    }

    if (jQuery('#pagination_type').val() == 'no_pagination') {
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpcustomreadmore') {
                jQuery(this).removeClass('clickDisable');
            }
        });
    }

    if (jQuery.inArray(jQuery('.bdp_template_name').val(), $slider_custom_read_more) === -1) {
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpcustomreadmore') {
                jQuery(this).removeClass('clickDisable');
            }
        });
    };

    /* First Letter Setting show hide*/
    if(jQuery('input[name="firstletter_big"]:checked').val() == 0) {
        jQuery('input[name="firstletter_big"]').closest('ul.bdp-settings').find('.firstletter-setting').hide();
    } else {
        jQuery('input[name="firstletter_big"]').closest('ul.bdp-settings').find('.firstletter-setting').show();
    }
    jQuery('input[name="firstletter_big"]').on('click', function() {
        if(jQuery('input[name="firstletter_big"]:checked').val() == 0) {
            jQuery(this).closest('ul.bdp-settings').find('.firstletter-setting').hide();
        } else {
            jQuery(this).closest('ul.bdp-settings').find('.firstletter-setting').show();
        }
        bdpAltBackground();
    });

    if (jQuery.inArray(template, $image_hover_effect_hide) !== -1) {
        jQuery('.bdp-image-hover-effect').hide()
    } else {
        jQuery('.bdp-image-hover-effect').show()
    }

    if (jQuery.inArray(template, $date_formate) !== -1) {
        jQuery('.post_date_format_tr').hide();
    } else {
        jQuery('.post_date_format_tr').show();
    }

    if (jQuery.inArray(template, $date_from) !== -1) {
        jQuery('.date_from_tr').hide();
    } else {
        jQuery('.date_from_tr').show();
    }

}

function setSingleLayoutOptionVisibility(template) {
    var $template_color = ["classical", "media-grid", "deport", "boxy", "timeline", "invert-grid", "boxy-clean", "cool_horizontal", "story", "pretty", "tagly", "roctangle", "steps"];
    var $background_color = ["boxy", "deport", "glossary", "invert-grid", "media-grid", "navia", "news", "region", "spektrum", "hub", "timeline", "winter", "cool_horizontal", "easy_timeline", "brite", "tagly", "roctangle", "famous"];
    var $bdp_single_post_published_year = ["story"];
    var $custom_image_selection = ["overlay_horizontal"];
    var $cat_bgcolor = ["winter", "crayon_slider", "sallet_slider", "sunshiny_slider", "brite", "minimal", "clicky"];
    var $date_formate = ["boxy", "hub", "invert-grid", "pretty", "roctangle", "spektrum", "story", "timeline"];

    template = jQuery.trim(template);
    //Show/Hide Template color
    if (jQuery.inArray(template, $template_color) !== -1) {
        jQuery('.single-layout .blog-templatecolor-tr').show();
    } else {
        jQuery('.single-layout .blog-templatecolor-tr').hide();
    }

    if (jQuery.inArray(template, $custom_image_selection) !== -1) {
        jQuery('.single-layout .bdp_single_custom_media_selection').hide();
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpsinglemedia') {
                jQuery(this).addClass('clickDisable');
            }
        });
    } else {
        jQuery('.single-layout .bdp_single_custom_media_selection').show();
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpsinglemedia') {
                jQuery(this).removeClass('clickDisable');
            }
        });
    }

    if (jQuery.inArray(template, $background_color) !== -1) {
        jQuery('.single-layout .single-background-tr').hide();
    } else {
        jQuery('.single-layout .single-background-tr').show();
    }

    //Show/Hide Post Published Year option
    if (jQuery.inArray(template, $bdp_single_post_published_year) !== -1) {
        jQuery('.bdp_single_post_published_year').show();
        jQuery('.story-startup-tr').show();
    }
    else {
        jQuery('.bdp_single_post_published_year').hide();
        jQuery('.story-startup-tr').hide();
    }

    //Show/Hide Category Background color
    if (jQuery.inArray(template, $cat_bgcolor) !== -1) {
        jQuery('.winter-category-back-color').show();
    }

    //Show/Hide date formate
    if (jQuery.inArray(template, $date_formate) !== -1) {
        jQuery('.single-layout .post_date_format_tr').hide();
    } else {
        jQuery('.single-layout .post_date_format_tr').show();
    }

}

jQuery('document').ready(function () {

    /* System Resport */
    jQuery('.bdp-debug-status-report').on('click', function (e) {
        e.preventDefault();
        var report = "\n##### Blog Designer PRO #####\n________________________________\n";
        jQuery(this).closest('.bdp-get-system-status').hide();

        jQuery('.bdp-system-status-cover .bdp-status-cover .bdp-status-head, .bdp-system-status-cover .bdp-status-contents').each(
                function () {
                    if (jQuery(this).hasClass('bdp-status-head')) {
                        var label = jQuery(this).data('export-label') || jQuery(this).text();
                        report = report + "\n\n### " + jQuery.trim(label) + " ###\n";
                    } else {
                        jQuery('p', jQuery(this)).each(
                                function () {
                                    var label = jQuery(this).find('span:eq(0)').data('export-label') || jQuery(this).find('span:eq(0)').text();
                                    var the_name = jQuery.trim(label).replace(/(<([^>]+)>)/ig, ''); // Remove HTML
                                    var the_value = jQuery(this).find('span:eq(1)').data('export-label') || jQuery.trim(jQuery(this).find('span:eq(1)').text());
                                    var value_array = the_value.split('~ ');

                                    if (value_array.length > 1) {
                                        var output = '';
                                        var temp_line = '';
                                        jQuery.each(
                                                value_array, function (key, line) {
                                                    temp_line = temp_line + line + '\n';
                                                }
                                        );
                                        the_value = temp_line;
                                    }
                                    report = report + '' + the_name + ': ' + the_value + "\n";
                                }
                        );
                    }
                }
        );

        try {
            jQuery("#bdp-debug-report").slideDown();
            jQuery("#bdp-debug-report textarea").val(report).focus().select();
            jQuery(this).fadeOut();

            return false;
        } catch (e) {
            console.log(e);
        }
        return false;
    });

    if (jQuery('#bdp_wp_status_report').length > 0) {
        var clipboard = new Clipboard('#bdp-copy-for-support');
        clipboard.on('success', function (event) {
            event.clearSelection();
            event.trigger.textContent = bdpro_js.copied;
            window.setTimeout(function () {
                event.trigger.textContent = bdpro_js.copy_for_support;
            }, 1000);
        });
    }

    /* bdp admin notice*/
    jQuery('.bdp-admin-notice-pro-layouts .notice-dismiss').on('click', function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_admin_notice_pro_layouts_dismiss',
            },
        });
    });
    jQuery('.bdp-create-layout-using-blog-designer-div .notice-dismiss').on('click', function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_create_layout_from_blog_designer_dismiss',
            },
        });
    });
    jQuery('.bdp-admin-notice-change-textdomain .notice-dismiss').on('click', function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_notice_change_textdomain_dismiss',
            },
        });
    });
    jQuery('.bdp-admin-notice-template-outdated .notice-dismiss').on('click', function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_notice_template_outdated_dismiss',
            },
        });
    });


    jQuery('script').each(function () {
        var src = jQuery(this).attr('src');
        if (typeof src !== typeof undefined && src !== false) {
            if (src.search('bootstrap.js') !== -1 || src.search('bootstrap.min.js') !== -1) {
                if (jQuery(this).parent('head').length > 0) {
                    jQuery('#wpwrap').append('<script type="text/javascript" src="' + src + '">');
                }
                if (jQuery.fn.button.noConflict) {
                    var bootstrapButton = jQuery.fn.button.noConflict();
                    jQuery.fn.bootstrapBtn = bootstrapButton;
                }
            }
        }
    });
    jQuery(".range_slider_days").slider({
        range: "min",
        value: jQuery('.range_slider_days').data('value'),
        step: 1,
        min: 0,
        max: 365,
        slide: function (event, ui) {
            jQuery(this).next().find('.range-slider__value_day').val(ui.value);
        }
    });
    if (jQuery('#between_two_date_from').length >= 1) {
        jQuery('#between_two_date_from').datepicker({});
    }
    if (jQuery('#between_two_date_to').length >= 1) {
        jQuery('#between_two_date_to').datepicker({});
    }

    var color_template = jQuery('.bdp_template_name').val();
    jQuery('div.controls_preset').hide();
    jQuery('div.controls_preset.' + color_template).show();

    jQuery('div.color-option.preset').on('click', function () {
        jQuery(this).find('input.of-radio-color').attr('checked', 'checked');
        var data_value = jQuery(this).data('value');
        if (data_value) {
            var $list_array = data_value.split(',');
            jQuery.each($list_array, function (i) {
                var $single_color = $list_array[i].split(':');
                jQuery('#' + $single_color[0]).iris('color', $single_color[1]);
            });
        }
    });

    jQuery('.slider_controls div').on('click', function () {
        jQuery(this).find(jQuery('input')).attr('checked', 'checked');
    });

    jQuery("#template_titlefontsizeInput,#template_postTitlefontsizeInput,#firstletter_fontsize_slider,#content_fontsize_slider,#beforeloop_titlefontsizeInput,#author_title_fontsize_slider,#related_post_fontsize,#social_share_fontsize,#author_content_fontsize_slider,#template_template_post_marginInput").slider({
        range: "min",
        value: 1,
        step: 1,
        min: 0,
        max: 100,
        slide: function (event, ui) {
            jQuery(this).parent().find('input.range-slider__value').val(ui.value);
        }
    });
    var post_margin = jQuery('#template_template_post_marginInput').parent().find('input.range-slider__value').val(),
            title_fontsize = jQuery('#template_titlefontsizeInput').parent().find('input.range-slider__value').val(),
            post_title_fontsize = jQuery('#template_postTitlefontsizeInput').parent().find('input.range-slider__value').val(),
            first_letter_fontsize = jQuery('#firstletter_fontsize_slider').parent().find('input.range-slider__value').val(),
            content_fontsize = jQuery('#content_fontsize_slider').parent().find('input.range-slider__value').val(),
            before_loop_fontsize = jQuery('#beforeloop_titlefontsizeInput').parent().find('input.range-slider__value').val(),
            author_title_fontsize = jQuery('#author_title_fontsize_slider').parent().find('input.range-slider__value').val(),
            author_content_fontsize = jQuery('#author_content_fontsize_slider').parent().find('input.range-slider__value').val(),
            related_post_fontsize = jQuery('#related_post_fontsize').parent().find('input.range-slider__value').val(),
            social_share_fontsize = jQuery('#social_share_fontsize').parent().find('input.range-slider__value').val();

    jQuery("#template_template_post_marginInput").slider("value", post_margin);
    jQuery("#template_titlefontsizeInput").slider("value", title_fontsize);
    jQuery("#template_postTitlefontsizeInput").slider("value", post_title_fontsize);
    jQuery("#firstletter_fontsize_slider").slider("value", first_letter_fontsize);
    jQuery("#content_fontsize_slider").slider("value", content_fontsize);
    jQuery("#beforeloop_titlefontsizeInput").slider("value", before_loop_fontsize);
    jQuery("#author_title_fontsize_slider").slider("value", author_title_fontsize);
    jQuery("#author_content_fontsize_slider").slider("value", author_content_fontsize);
    jQuery("#related_post_fontsize").slider("value", related_post_fontsize);
    jQuery("#social_share_fontsize").slider("value", social_share_fontsize);

    jQuery(".range-slider__value").change(function () {
        var value = this.value;
        var max = 100;
        if (value > max) {
            jQuery(this).parent().parent().find('.range_slider_fontsize').slider("value", '100');
            jQuery(this).val('100');
        } else {
            jQuery(this).parent().parent().find('.range_slider_fontsize').slider("value", parseInt(value));
        }
    });

    jQuery("#grid_col_spaceInputId").slider({
        range: "min",
        value: 1,
        step: 1,
        min: 0,
        max: 50,
        slide: function (event, ui) {
            jQuery("#grid_col_spaceOutputId").val(ui.value);
        }
    });
    var grid_space = jQuery("#grid_col_spaceOutputId").val();
    jQuery("#grid_col_spaceInputId").slider("value", grid_space);
    jQuery("#grid_col_spaceOutputId").change(function () {
        var value = this.value;
        var max = 50;
        if (value > max) {
            jQuery("#grid_col_spaceInputId").slider("value", '50');
            jQuery(this).val('50');
        } else {
            jQuery("#grid_col_spaceInputId").slider("value", parseInt(value));
        }
    });

    jQuery("#single-layout-form #template_titlefontface,#single-layout-form  #template_contentfontface,#single-layout-form #txtSocialTextFont,#single-layout-form #related_title_fontface,#single-layout-form #author_title_fontface,#single-layout-form #firstletter_font_family").change(function () {
        var $name = jQuery(this).attr('name');
        var selected = jQuery(':selected', this);
        var $label = selected.closest('optgroup').attr('label');
        jQuery('#' + $name + '_font_type').val($label);
    });

    jQuery("#edit_layout_form #template_titlefontface,#edit_layout_form #content_font_family,#edit_layout_form #firstletter_font_family,#edit_archive_layout_form #author_title_fontface,#edit_archive_layout_form #template_titlefontface,#edit_archive_layout_form #content_font_family,#edit_archive_layout_form #firstletter_font_family,#edit_layout_form #beforeloop_titlefontface,#edit_archive_layout_form #author_content_fontface").change(function () {
        var $name = jQuery(this).attr('name');
        var selected = jQuery(':selected', this);
        var $label = selected.closest('optgroup').attr('label');
        jQuery('#' + $name + '_font_type').val($label);
    });

    jQuery("#dialogbox").dialog({
        autoOpen: false,
        maxWidth: 600,
        maxHeight: 500,
        width: 600,
        height: 500
    });
    jQuery('.scroll_speed_tr').hide();
    if (jQuery('input[name=enable_autoslide]:checked').val() == 1) {
        jQuery('.scroll_speed_tr').show();
    }
    jQuery('input[name=enable_autoslide]').on('click', function () {
        if (jQuery(this).val() == 1) {
            jQuery('.scroll_speed_tr').fadeIn();
        } else {
            jQuery('.scroll_speed_tr').fadeOut();
        }
        bdpAltBackground();
    });
//    jQuery(".social-share-section .icon").on('click', function (e)    // Open button Treatment
//    {
//        e.preventDefault();
//        var clas_id = '.dialogbox.single_layout';
//        getIconSet(clas_id);
//        jQuery('#dialogbox').dialog("open");
//        jQuery('body').prepend("<div id='pageflip'> </div>");
//        return false;
//    });
    jQuery(document).on('click', '.dialogbox.single_layout .icon_div .bdp-element-icon', function (e) {
        e.preventDefault();
        var iconclass = jQuery(this).find('i').attr('class');
        window.top.jQuery('#txtSocialIcon').val(iconclass);
        jQuery('.ui-dialog-titlebar-close').trigger('click');
        jQuery('#pageflip').remove();
    });
    jQuery(document).on('click', '.ui-dialog-titlebar-close', function (e) {
        e.preventDefault();
        jQuery('#pageflip').remove();
    });

    /*button preview trigger*/
    jQuery("#bdp-btn-show-submit").click(function () {
        jQuery(".bloglyout_savebtn").trigger("click");
    });
    jQuery(".show_archive_save").click(function () {
        jQuery(".archive_savebtn").trigger("click");
    });
    jQuery("#bdp-btn-single").click(function () {
        jQuery(".bdp_single_save_btn").trigger("click");
    });
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: bdpro_js.nothing_found},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        jQuery(selector).chosen(config[selector]);
    }

    jQuery('.buttonset').buttonset();

    /* Template selection for Archive Layout */
    jQuery(".bdp-archive-page .bdp_select_template").click(function (e) {
        e.preventDefault();
        var template_name = jQuery('.bdp_template_name').val();
        jQuery("#popupdiv.bdp-archive-popupdiv").dialog({
            title: bdpro_js.choose_archive,
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
            create: function (e, ui) {
                var pane = jQuery(this).dialog("widget").find(".ui-dialog-buttonpane");
                var checked = '';
                if (jQuery('.bdp_template_name').hasClass('bdp-create-shortcode')) {
                    checked = 'checked=checked';
                }
                jQuery("<div class='bdp-div-default-style'><label><input id='bdp-apply-default-style' class='bdp-apply-default-style' type='checkbox' " + checked + "/>" + bdpro_js.default_style_template + "</label></div>").prependTo(pane);
            },
            buttons: [{
                    text: bdpro_js.set_archive_template,
                    id: "btnSetBlogTemplate",
                    click: function () {
                        var template_src = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('src');
                        if (typeof template_src === 'undefined' || template_src === null) {
                            jQuery('.bdp_template_name').val('');
                            jQuery("#popupdiv").dialog('close');
                            return;
                        }
                        var template_name = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .bdp-span-template-name').html();
                        var template_value = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('data-value');
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").empty();
                        jQuery('.bdp_template_name').val(template_value);
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").append('<img src="' + template_src + '" alt="' + template_name + '" /><label id="template_select_name">' + template_name + '</label>');
                        jQuery("#popupdiv").dialog('close');

                        //Show/Hide Options
                        setOptionVisibility(jQuery(".bdp_template_name").val());
                        bdpContentHide(jQuery(".bdp_template_name").val());

                        if (jQuery('#bdp-apply-default-style').is(":checked")) {
                            bdp_set_template_default_data();
                            jQuery("input[name=bdp_color_preset][value=" + jQuery(".bdp_template_name").val() + "_default]").attr('checked', 'checked');
                        }
                        disable_link_chk();
                        blog_background_image();
                        jQuery('div.controls_preset').hide();
                        jQuery('div.controls_preset.' + jQuery(".bdp_template_name").val()).show();
                    }
                },
                {
                    text: bdpro_js.close,
                    class: 'bdp_template_close',
                    click: function () {
                        jQuery(this).dialog("close");
                    },
                }
            ],
            open: function (event, ui) {
                jQuery('#popupdiv .template-thumbnail').removeClass('bdp_selected_template');
                jQuery('#popupdiv .template-thumbnail').each(function () {
                    if (jQuery(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                        jQuery(this).addClass('bdp_selected_template');
                    }
                });
                jQuery('body.blog-designer_page_bdp_add_archive_layout').css('position', 'relative').css('overflow', 'hidden');
                jQuery('.bdp-blog-template-search-cover #bdp-template-search').val('');
                var $template_name = '';
                blogTemplateSearch($template_name)
            },
            close: function (event, ui) {
                jQuery('body.blog-designer_page_bdp_add_archive_layout').css('position', 'unset').css('overflow', 'visible');
                jQuery('.bdp-blog-template-search-cover #bdp-template-search').val('');
            }
        });
        return false;
    });
    /* End of Template selection for Archive Layout */

    var loaders = {
        circularG: '<div class="bdp-circularG-wrapper"><div class="bdp-circularG bdp-circularG_1"></div><div class="bdp-circularG bdp-circularG_2"></div><div class="bdp-circularG bdp-circularG_3"></div><div class="bdp-circularG bdp-circularG_4"></div><div class="bdp-circularG bdp-circularG_5"></div><div class="bdp-circularG bdp-circularG_6"></div><div class="bdp-circularG bdp-circularG_7"></div><div class="bdp-circularG bdp-circularG_8"></div></div>',
        floatingCirclesG: '<div class="bdp-floatingCirclesG"><div class="bdp-f_circleG bdp-frotateG_01"></div><div class="bdp-f_circleG bdp-frotateG_02"></div><div class="bdp-f_circleG bdp-frotateG_03"></div><div class="bdp-f_circleG bdp-frotateG_04"></div><div class="bdp-f_circleG bdp-frotateG_05"></div><div class="bdp-f_circleG bdp-frotateG_06"></div><div class="bdp-frotateG_07 bdp-f_circleG"></div><div class="bdp-frotateG_08 bdp-f_circleG"></div></div>',
        spinloader: '<div class="bdp-spinloader"></div>',
        doublecircle: '<div class="bdp-doublec-container"><ul class="bdp-doublec-flex-container"><li><span class="bdp-doublec-loading"></span></li></ul></div>',
        wBall: '<div class="bdp-windows8"><div class="bdp-wBall bdp-wBall_1"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_2"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_3"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall bdp-wBall_4"><div class="bdp-wInnerBall"></div></div><div class="bdp-wBall_5 bdp-wBall"><div class="bdp-wInnerBall"></div></div></div>',
        cssanim: '<div class="bdp-cssload-aim"></div>',
        thecube: '<div class="bdp-cssload-thecube"><div class="bdp-cssload-cube bdp-cssload-c1"></div><div class="bdp-cssload-cube bdp-cssload-c2"></div><div class="bdp-cssload-cube bdp-cssload-c4"></div><div class="bdp-cssload-cube bdp-cssload-c3"></div></div>',
        ballloader: '<div class="bdp-ballloader"><div class="bdp-loader-inner bdp-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
        squareloader: '<div class="bdp-squareloader"><div class="bdp-square"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div><div class="bdp-square clear"></div><div class="bdp-square"></div><div class="bdp-square last"></div></div>',
        loadFacebookG: '<div class="bdp-loadFacebookG"><div class="bdp-blockG_1 bdp-facebook_blockG"></div><div class="bdp-blockG_2 bdp-facebook_blockG"></div><div class="bdp-facebook_blockG bdp-blockG_3"></div></div>',
        floatBarsG: '<div class="bdp-floatBarsG-wrapper"><div class="bdp-floatBarsG_1 bdp-floatBarsG"></div><div class="bdp-floatBarsG_2 bdp-floatBarsG"></div><div class="bdp-floatBarsG_3 bdp-floatBarsG"></div><div class="bdp-floatBarsG_4 bdp-floatBarsG"></div><div class="bdp-floatBarsG_5 bdp-floatBarsG"></div><div class="bdp-floatBarsG_6 bdp-floatBarsG"></div><div class="bdp-floatBarsG_7 bdp-floatBarsG"></div><div class="bdp-floatBarsG_8 bdp-floatBarsG"></div></div>',
        movingBallG: '<div class="bdp-movingBallG-wrapper"><div class="bdp-movingBallLineG"></div><div class="bdp-movingBallG_1 bdp-movingBallG"></div></div>',
        ballsWaveG: '<div class="bdp-ballsWaveG-wrapper"><div class="bdp-ballsWaveG_1 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_2 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_3 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_4 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_5 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_6 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_7 bdp-ballsWaveG"></div><div class="bdp-ballsWaveG_8 bdp-ballsWaveG"></div></div>',
        fountainG: '<div class="fountainG-wrapper"><div class="bdp-fountainG_1 bdp-fountainG"></div><div class="bdp-fountainG_2 bdp-fountainG"></div><div class="bdp-fountainG_3 bdp-fountainG"></div><div class="bdp-fountainG_4 bdp-fountainG"></div><div class="bdp-fountainG_5 bdp-fountainG"></div><div class="bdp-fountainG_6 bdp-fountainG"></div><div class="bdp-fountainG_7 bdp-fountainG"></div><div class="bdp-fountainG_8 bdp-fountainG"></div></div>',
        audio_wave: '<div class="bdp-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
        warningGradientBarLineG: '<div class="bdp-warningGradientOuterBarG"><div class="bdp-warningGradientFrontBarG bdp-warningGradientAnimationG"><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div><div class="bdp-warningGradientBarLineG"></div></div></div>',
        floatingBarsG: '<div class="bdp-floatingBarsG"><div class="bdp-rotateG_01 bdp-blockG"></div><div class="bdp-rotateG_02 bdp-blockG"></div><div class="bdp-rotateG_03 bdp-blockG"></div><div class="bdp-rotateG_04 bdp-blockG"></div><div class="bdp-rotateG_05 bdp-blockG"></div><div class="bdp-rotateG_06 bdp-blockG"></div><div class="bdp-rotateG_07 bdp-blockG"></div><div class="bdp-rotateG_08 bdp-blockG"></div></div>',
        rotatecircle: '<div class="bdp-cssload-loader"><div class="bdp-cssload-inner bdp-cssload-one"></div><div class="bdp-cssload-inner bdp-cssload-two"></div><div class="bdp-cssload-inner bdp-cssload-three"></div></div>',
        overlay_loader: '<div class="bdp-overlay-loader"><div class="bdp-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
        circlewave: '<div class="bdp-circlewave"></div>',
        cssload_ball: '<div class="bdp-cssload-ball"></div>',
        cssheart: '<div class="bdp-cssload-main"><div class="bdp-cssload-heart"><span class="bdp-cssload-heartL"></span><span class="bdp-cssload-heartR"></span><span class="bdp-cssload-square"></span></div><div class="bdp-cssload-shadow"></div></div>',
        spinload: '<div class="bdp-spinload-loading"><i></i><i></i><i></i></div>',
        bigball: '<div class="bdp-bigball-container"><div class="bdp-bigball-loading"><i></i><i></i><i></i></div></div>',
        bubblec: '<div class="bdp-bubble-container"><div class="bdp-bubble-loading"><i></i><i></i></div></div>',
        csball: '<div class="bdp-csball-container"><div class="bdp-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
        ccball: '<div class="bdp-ccball-container"><div class="bdp-ccball-loading"><i></i><i></i></div></div>',
        circulardot: '<div class="bdp-cssload-wrap"><div class="bdp-circulardot-container"><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span><span class="bdp-cssload-dots"></span></div></div>',
    };

    jQuery(".bdp_select_loader").click(function (e) {
        e.preventDefault();
        jQuery(".bdp-loader-popupdiv").dialog({
            title: 'Select Loader',
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
        });

        var $loader_style = jQuery('#loader_style_hidden').val();

        jQuery('.bdp-loader-style-box .bdp-dialog-loader-style').each(function () {
            jQuery(this).removeClass('bdp-active-loader');
            if(jQuery(this).hasClass($loader_style)) {
               jQuery(this).addClass('bdp-active-loader');
            }
        });
        return false;
    });
    jQuery(".bdp-dialog-loader-style").click(function (e) {
        var loader_val = jQuery(this).children('input.bdp-loader-style-hidden').val();
        jQuery(".loader_style_hidden").val(loader_val);
        jQuery(".loader_hidden").html( );

        if (loader_val != 'audio_wave') {
            var loader_val_new = loader_val.replace('-', '_');
        } else {
            var loader_val_new = loader_val;
        }

        jQuery(".loader_hidden").html(loaders[loader_val_new]);
        jQuery("#popuploaderdiv").dialog("close");
    });

    /* Select Slider Navigation*/
    jQuery(".bdp_select_navigation").click(function (e) {
        e.preventDefault();
        jQuery(".bdp-navigation-popupdiv").dialog({
            title: 'Select Navigation',
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
        });

        var $navigation_style = jQuery('#navigation_style_hidden').val();

        jQuery('.bdp-navigation-style-box .bdp-navigation-cover').each(function () {
            jQuery(this).removeClass('bdp-active-nav');
            if(jQuery(this).hasClass($navigation_style)) {
               jQuery(this).addClass('bdp-active-nav');
            }
        });
        return false;
    })
    jQuery(".bdp-navigation-cover").click(function (e) {
        var navigation_val = jQuery(this).children('input.bdp-navigation-style-hidden').val();
        var navigation_src = jQuery(this).children('img').attr('src');
        jQuery(".navigation_style_hidden").val(navigation_val);
        jQuery(".bdp_navigation_image_holder").html( );

        jQuery(".bdp_navigation_image_holder").html('<img src="'+ navigation_src +'">');
        jQuery("#popupnavifationdiv").dialog("close");
    });


    /* Select Slider Arrow*/
    jQuery(".bdp_select_arrow").click(function (e) {
        e.preventDefault();
        jQuery(".bdp-arrow-popupdiv").dialog({
            title: bdpro_js.select_arrow,
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
        });

        var $arrow_style = jQuery('#arrow_style_hidden').val();

        jQuery('.bdp-arrow-style-box .bdp-arrow-cover').each(function () {
            jQuery(this).removeClass('bdp-active-arrow');
            if(jQuery(this).hasClass($arrow_style)) {
               jQuery(this).addClass('bdp-active-arrow');
            }
        });
        return false;
    });
    jQuery(".bdp-arrow-cover").click(function (e) {
        var arrow_val = jQuery(this).children('input.bdp-arrow-style-hidden').val();
        var arrow_src = jQuery(this).children('img').attr('src');
        jQuery(".arrow_style_hidden").val(arrow_val);
        jQuery(".bdp_arrow_image_holder").html( );

        jQuery(".bdp_arrow_image_holder").html('<img src="'+ arrow_src +'">');
        jQuery("#popuparrowdiv").dialog("close");
    });


    /* Template selection for Blog Layout */
    jQuery("#popupdiv div.template-thumbnail .popup-select a").click(function (e) {
        e.preventDefault();
        jQuery('#popupdiv div.template-thumbnail').removeClass('bdp_selected_template');
        jQuery(this).parents('div.template-thumbnail').addClass('bdp_selected_template');
    });
    jQuery(".bdp-edit-layout .bdp_select_template").click(function (e) {
        e.preventDefault();
        var template_name = jQuery('.bdp_template_name').val();
        jQuery("#popupdiv").dialog({
            title: bdpro_js.choose_blog_template,
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
            create: function (e, ui) {
                var pane = jQuery(this).dialog("widget").find(".ui-dialog-buttonpane");
                var checked = '';
                if (jQuery('.bdp_template_name').hasClass('bdp-create-shortcode')) {
                    checked = 'checked=checked';
                }
                jQuery("<div class='bdp-div-default-style'><label><input id='bdp-apply-default-style' class='bdp-apply-default-style' type='checkbox' " + checked + "/>" + bdpro_js.default_style_template + "</label></div>").prependTo(pane);
            },
            buttons: [{
                    text: bdpro_js.set_blog_template,
                    id: "btnSetBlogTemplate",
                    click: function () {
                        var template_src = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('src');
                        if (typeof template_src === 'undefined' || template_src === null) {
                            jQuery("#popupdiv").dialog('close');
                            return;
                        }
                        var template_name = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .bdp-span-template-name').html();
                        var template_value = jQuery('#popupdiv div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('data-value');
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").empty();
                        jQuery('.bdp_template_name').val(template_value);
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").append('<img src="' + template_src + '" alt="' + template_name + '" /><label id="template_select_name">' + template_name + ' </label>');
                        jQuery("#popupdiv").dialog('close');


                        //Show/Hide Options
                        setOptionVisibility(jQuery(".bdp_template_name").val());
                        bdpContentHide(jQuery(".bdp_template_name").val());
                        var $bdp_temp = ['brit_co', 'hoverbic', 'explore'];
                        if (jQuery.inArray(jQuery(".bdp_template_name").val(), $bdp_temp) !== -1) {
                            jQuery('.bdp-content-settings-info').show();
                        } else {
                            jQuery('.bdp-content-settings-info').hide();
                        }

                        if (jQuery('#bdp-apply-default-style').is(":checked")) {
                            bdp_set_template_default_data();
                            //Set default color preset select
                            jQuery("input[name=bdp_color_preset][value=" + jQuery(".bdp_template_name").val() + "_default]").attr('checked', 'checked');
                        }
                        disable_link_chk();
                        blog_background_image();
                        jQuery('div.controls_preset').hide();
                        jQuery('div.controls_preset.' + jQuery(".bdp_template_name").val()).show();

                        bdpAltBackground();
                    }
                },
                {
                    text: bdpro_js.close,
                    class: 'bdp_template_close',
                    click: function () {
                        jQuery(this).dialog("close");
                    },
                }
            ],
            open: function (event, ui) {
                jQuery('#popupdiv .template-thumbnail').removeClass('bdp_selected_template');
                jQuery('#popupdiv .template-thumbnail').each(function () {
                    if (jQuery(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                        jQuery(this).addClass('bdp_selected_template');
                    }
                });
                jQuery('body.blog-designer_page_add_shortcode').css('position', 'relative').css('overflow', 'hidden');
                jQuery('body.blog-designer_page_single_post').css('position', 'relative').css('overflow', 'hidden');
                jQuery('.bdp-blog-template-search-cover #bdp-template-search').val('');
                var $template_name = '';
                blogTemplateSearch($template_name)

                jQuery('.bdp-blog-template-cover .template-thumbnail').each(function () {
                    var templateLable = jQuery(this).data('value');
                    if(templateLable != '' && templateLable != undefined) {
                        jQuery(this).append('<div class="bdp-label">'+ templateLable +'</div>')
                    }
                });
            },
            close: function (event, ui) {
                jQuery('body.blog-designer_page_add_shortcode').css('position', 'unset').css('overflow', 'visible');
                jQuery('body.blog-designer_page_single_post').css('position', 'unset').css('overflow', 'visible');
                jQuery('.bdp-blog-template-search-cover #bdp-template-search').val('');
            }
        });
        return false;
    });
    /* End of Template selection for Blog Layout */

    /* Template selection for Single Post Layout */
    jQuery("#popupdiv-single div.template-thumbnail .popup-select a").click(function (e) {
        e.preventDefault();
        jQuery('#popupdiv-single div.template-thumbnail').removeClass('bdp_selected_template');
        jQuery(this).parents('div.template-thumbnail').addClass('bdp_selected_template');
    });
    jQuery(".bdp_select_template").click(function (e) {
        e.preventDefault();
        var template_name = jQuery('.bdp_template_name').val();
        jQuery("#popupdiv-single").dialog({
            title: bdpro_js.choose_single_post_template,
            dialogClass: 'bdp_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
            create: function (e, ui) {
                var pane = jQuery(this).dialog("widget").find(".ui-dialog-buttonpane");
                var checked = '';
                if (jQuery('.bdp_template_name').hasClass('bdp-create-shortcode')) {
                    checked = 'checked=checked';
                }
                jQuery("<div class='bdp-div-default-style'><label><input id='bdp-apply-default-style' class='bdp-apply-default-style' type='checkbox' " + checked + "/>" + bdpro_js.default_style_template + "</label></div>").prependTo(pane);
            },
            buttons: [{
                    text: bdpro_js.set_single_template,
                    id: "btnSetBlogTemplate",
                    click: function () {
                        var template_src = jQuery('#popupdiv-single div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('src');
                        if (typeof template_src === 'undefined' || template_src === null) {
                            jQuery("#popupdiv-single").dialog('close');
                            return;
                        }
                        var template_name = jQuery('#popupdiv-single div.template-thumbnail.bdp_selected_template .bdp-span-template-name').html();
                        var template_value = jQuery('#popupdiv-single div.template-thumbnail.bdp_selected_template .template-thumbnail-inner').children('img').attr('data-value');
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").empty();
                        jQuery('.bdp_template_name').val(template_value);
                        jQuery(".select_button_upper_div .bdp_selected_template_image > div").append('<img src="' + template_src + '" alt="' + template_name + '" /><label id="template_select_name">' + template_name + '</label>');
                        jQuery("#popupdiv-single").dialog('close');

                        //Show/Hide Options
                        setSingleLayoutOptionVisibility(jQuery(".bdp_template_name").val());

                        if (jQuery('#bdp-apply-default-style').is(":checked")) {
                            bdp_set_single_template_default_data();
                            jQuery("input[name=bdp_color_preset][value=" + jQuery(".bdp_template_name").val() + "_default]").attr('checked', 'checked');
                        }
                        disable_link_chk();
                        blog_background_image();
                        jQuery('div.controls_preset').hide();
                        jQuery('div.controls_preset.' + jQuery(".bdp_template_name").val()).show();
                    }
                },
                {
                    text: bdpro_js.close,
                    class: 'bdp_template_close',
                    click: function () {
                        jQuery(this).dialog("close");
                    },
                }
            ],
            open: function (event, ui) {
                jQuery('#popupdiv-single .template-thumbnail').removeClass('bdp_selected_template');
                jQuery('#popupdiv-single .template-thumbnail').each(function () {
                    if (jQuery(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                        jQuery(this).addClass('bdp_selected_template');
                    }
                });
                jQuery('body.blog-designer_page_add_shortcode').css('position', 'relative').css('overflow', 'hidden');
                jQuery('body.blog-designer_page_single_post').css('position', 'relative').css('overflow', 'hidden');
                jQuery('.bdp-single-blog-template-search-cover #bdp-template-search').val('');
                var $template_name = '';
                singleBlogTemplateSearch($template_name);
                jQuery('.bdp-blog-template-cover .template-thumbnail').each(function () {
                    var templateLable = jQuery(this).data('value');
                    if(templateLable != '' && templateLable != undefined) {
                        jQuery(this).append('<div class="bdp-label">'+ templateLable +'</div>')
                    }
                });
            },
            close: function (event, ui) {
                jQuery('body.blog-designer_page_add_shortcode').css('position', 'unset').css('overflow', 'visible');
                jQuery('body.blog-designer_page_single_post').css('position', 'unset').css('overflow', 'visible');
                jQuery('.bdp-single-blog-template-search-cover #bdp-template-search').val('');
            }
        });
        return false;
    });
    /* End of template selection for Single Post Layout */

    jQuery(".bd-form-class .bdp-reset-data").click(function () {
        if (jQuery(this).closest('form#single-layout-form').length != 0) {
            if (confirm(bdpro_js.reset_data)) {
                bdp_set_single_template_default_data();
                jQuery('form#single-layout-form')[0].submit();
                disable_link_chk();
                blog_background_image();
            } else {
                return false;
            }
        } else {
            if (confirm(bdpro_js.reset_data)) {
                bdp_set_template_default_data();
                jQuery('#custom_post_type').val('post');
                jQuery('form.bd-form-class')[0].submit();
                disable_link_chk();
                blog_background_image();
            } else {
                return false;
            }
        }
        jQuery("input[name=bdp_color_preset][value=" + jQuery(".bdp_template_name").val() + "_default]").attr('checked', 'checked');
    });

    jQuery('.bdp_template_tab li a').click(function (e) {
        e.preventDefault();
        var all_template_hide = true;
        jQuery('.bdp_template_tab li').removeClass('current_tab');
        jQuery(this).parent('li').addClass('current_tab');
        var href = jQuery(this).attr('href').replace('#', '');
        jQuery('.template-thumbnail').hide();
        if (href == 'all') {
            jQuery('.template-thumbnail').show();
        } else {
            jQuery('.' + href + '.template-thumbnail').show();
        }
        jQuery('.template-thumbnail').each(function () {
            if (jQuery(this).is(':visible')) {
                all_template_hide = false;
            }
        });
        if (all_template_hide) {
            jQuery('.no-template').show();
        } else {
            jQuery('.no-template').hide();
        }
    });
    /* End of template selection*/

    /* Allow enter key only in textarea */
    jQuery('.bd-form-class').keydown(function (event) {
        if (event.target.tagName != 'TEXTAREA') {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        }
    });

    jQuery('.bdp-blog-template-search-cover #bdp-template-search').keyup(function () {
        var $template_name = jQuery(this).val();
        blogTemplateSearch($template_name);
    });
    jQuery('.bdp-blog-template-search-cover .bdp-template-search-clear').on('click', function () {
        jQuery('.bdp-blog-template-search-cover #bdp-template-search').val('');
        var $template_name = '';
        blogTemplateSearch($template_name);
    });

    jQuery('.bdp-single-blog-template-search-cover #bdp-template-search').keyup(function () {
        var $template_name = jQuery(this).val();
        singleBlogTemplateSearch($template_name);
    });
    jQuery('.bdp-single-blog-template-search-cover .bdp-template-search-clear').on('click', function () {
        jQuery('.bdp-single-blog-template-search-cover #bdp-template-search').val('');
        var $template_name = '';
        singleBlogTemplateSearch($template_name);
    });


    /* Remove ui.css for pro plugin */
    jQuery('link').each(function () {
        var href = jQuery(this).attr('href');
        if (href.search('jquery-ui.css') !== -1 || href.search('jquery-ui.min.css') !== -1) {
            jQuery(this).remove('link');
        }
    });
    /* End of code*/
    /* End of enter key only in textarea */

    jQuery('.bd-form-class .bd-setting-handle > li').click(function (event) {
        if (jQuery(this).hasClass('clickDisable')) {
            clickDisable();
        } else {
            var closed = jQuery(this).data('show');
            jQuery('.bd-form-class .bd-setting-handle > li').removeClass('bd-active-tab');
            jQuery(this).addClass('bd-active-tab');
            jQuery('.bd-settings-wrappers .postbox').hide();
            jQuery('#' + closed).show();
            jQuery('#' + closed + ' .inside').show();

            jQuery.post(ajaxurl, {
                action: 'bdp_closed_bdpboxes',
                closed: closed,
                page: jQuery('.bdporiginalpage').val()
            });
        }
        bdpAltBackground();
    });


    //Initialize colorpicker
    jQuery('#template_ftcolor,#template_bgcolor,#template_alterbgcolor,#template_titlecolor,#template_titlebackcolor,#template_contentcolor,#template_readmorecolor,#template_readmorebackcolor,#template_readmore_hover_backcolor,#template_content_hovercolor,#template_color,#deport_dashcolor,#winter_category_color,#template_titlehovercolor,#template_fthovercolor,#related_title_color,#template_bghovercolor,#displaydate_backcolor,#template_alternative_color,#story_startup_background,#story_startup_text_color,#story_ending_background,#story_ending_text_color,#firstletter_contentcolor,#grid_hoverback_color,#story_startup_border_color,#beforeloop_readmorecolor,#beforeloop_readmorebackcolor,#beforeloop_readmorehovercolor,#beforeloop_readmorehoverbackcolor,#author_titlecolor,#author_content_color,#author_bgcolor, #loader_color, #loadmore_button_color, #loadmore_button_bg_color').wpColorPicker();

    jQuery('#TB_window').css('max-height', '500px');

    setOptionVisibility(jQuery(".bdp_template_name").val());

    //Slider navigation icon hide/show
    if (jQuery("input[name='display_slider_navigation']:checked").val() == 1) {
        jQuery(".select_slider_navigation_tr").show();
    } else {
        jQuery(".select_slider_navigation_tr").hide();
    }
    jQuery("input[name='display_slider_navigation']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.select_slider_navigation_tr').show();
        } else {
            jQuery('.select_slider_navigation_tr').hide();
        }
        bdpAltBackground();
    });

    //Slider Controls
    if (jQuery("input[name='display_slider_controls']:checked").val() == 1) {
        jQuery(".select_slider_controls_tr").show();
    } else {
        jQuery(".select_slider_controls_tr").hide();
    }
    jQuery("input[name='display_slider_controls']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.select_slider_controls_tr').show();
        } else {
            jQuery('.select_slider_controls_tr').hide();
        }
        bdpAltBackground();
    });

    jQuery(".bdp-admin thead .check-column > input[type='checkbox']").click(function () {
        if (jQuery(this).prop("checked")) {
            jQuery(".chk_remove_all").prop("checked", true);
        } else {
            jQuery(".chk_remove_all").prop("checked", false);
        }
    });

    jQuery('.chk_remove_all').click(function () {
        if (jQuery(".chk_remove_all").length == jQuery(".chk_remove_all:checked").length) {
            jQuery(".bdp-admin thead .check-column > input[type='checkbox']").prop("checked", true);
        } else {
            jQuery(".bdp-admin thead .check-column > input[type='checkbox']").prop("checked", false);
        }
    });

    if (jQuery('#display_related_post').attr('checked')) {
        jQuery('#display_related_post').closest('li').nextAll('li').show();
        jQuery('.bdp_related_post_media_custom_size_tr').hide();
        if (jQuery('#bdp_related_post_media_size').val() == 'custom') {
            jQuery('.bdp_related_post_media_custom_size_tr').show();
        }
    } else {
        jQuery('#display_related_post').closest('li').nextAll('li').hide();
    }
    jQuery('#display_related_post').change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery(this).closest('li').nextAll('li').show();
            jQuery('.bdp_related_post_media_custom_size_tr').hide();
            if (jQuery('#bdp_related_post_media_size').val() == 'custom') {
                jQuery('.bdp_related_post_media_custom_size_tr').show();
            }
        } else {
            jQuery(this).closest('li').nextAll('li').hide();
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='rss_use_excerpt']:checked").val() == 1) {
        jQuery('.excerpt_length').show();
        jQuery('.advance_contents_tr').show();
        jQuery('.read_more_text').show();
        jQuery('.read_more_text_color').show();
        jQuery('.read_more_text_background').show();
        jQuery('.post_content_from').show();
        jQuery('.display_html_tags_tr').show();
        if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_color) !== -1) {
            jQuery('.read_more_text_background').hide();
        }
        if (jQuery("input[name='advance_contents']:checked").val() == 1) {
            jQuery(".advance_contents_settings").show();
            if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                jQuery(".advance_contents_settings_character").show();
            } else {
                jQuery(".advance_contents_settings_character").hide();
            }
        } else {
            jQuery(".advance_contents_settings").hide();
        }
    } else {
        jQuery('.excerpt_length').hide();
        jQuery('.advance_contents_tr').hide();
        jQuery('.read_more_text').hide();
        jQuery('.read_more_text_color').hide();
        jQuery('.read_more_text_background').hide();
        jQuery('.post_content_from').hide();
        jQuery('.display_html_tags_tr').hide();
    }

    jQuery("input[name='display_date']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.sprecrum_date_color').show();
        } else {
            jQuery('.sprecrum_date_color').hide();
        }
        bdpAltBackground();
    });

    jQuery("input[name='template_alternativebackground']").change(function () {
        if (jQuery(this).val() == 0) {
            jQuery('.alternative-color-tr').hide();
        } else {
            jQuery('.alternative-color-tr').show();
        }
        bdpAltBackground();
    });

    jQuery("select[name='bdp_blog_order_by']").next('div.blg_order').show();
    if (jQuery("select[name='bdp_blog_order_by']").val() == '' || jQuery("select[name='bdp_blog_order_by']").val() == 'rand') {
        jQuery("select[name='bdp_blog_order_by']").next('div.blg_order').hide();
    }

    if (jQuery("select[name='bdp_related_post_order_by']").val() == '' || jQuery("select[name='bdp_related_post_order_by']").val() == 'rand') {
        jQuery("select[name='bdp_related_post_order_by']").next('div.blg_order').hide();
    } else {
        jQuery("select[name='bdp_related_post_order_by']").next('div.blg_order').show();
    }

    jQuery("select[name='bdp_blog_order_by']").change(function () {
        if (jQuery(this).val() == '' || jQuery(this).val() == 'rand') {
            jQuery(this).next('div.blg_order').hide();
        } else {
            jQuery(this).next('div.blg_order').show();
        }
        bdpAltBackground();
    });

    jQuery("select[name='bdp_related_post_order_by']").change(function () {
        if (jQuery(this).val() == '' || jQuery(this).val() == 'rand') {
            jQuery(this).next('div.blg_order').hide();
        } else {
            jQuery(this).next('div.blg_order').show();
        }
        bdpAltBackground();
    });


    if(jQuery("input[name='advance_contents']:checked").val() == 1) {
        jQuery(".advance_contents_settings").show();
        if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
            jQuery(".advance_contents_settings_character").show();
        } else {
            jQuery(".advance_contents_settings_character").hide();
        }
        if(jQuery("input[name='display_html_tags']:checked").val() == 1) {
            jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",true);
            jQuery("#contents_stopage_from option:contains('Paragraph')").attr("selected",true);
            jQuery('#contents_stopage_from').trigger("chosen:updated");
            jQuery(".advance_contents_settings_character").hide();
        }
    } else {
        jQuery(".advance_contents_settings").hide();
    }
    jQuery("input[name='advance_contents']").change(function () {
       if (jQuery(this).val() == 1) {
            jQuery(".advance_contents_settings").show();
            if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                jQuery(".advance_contents_settings_character").show();
            } else {
                jQuery(".advance_contents_settings_character").hide();
            }
            if(jQuery("input[name='display_html_tags']") == 1) {
                jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",true);
                jQuery("#contents_stopage_from option:contains('Paragraph')").attr("selected",true);
                jQuery('#contents_stopage_from').trigger("chosen:updated");
                jQuery(".advance_contents_settings_character").hide();
            }
        } else {
            jQuery(".advance_contents_settings").hide();
        }
        bdpAltBackground();
    });
    jQuery("select[name='contents_stopage_from']").change(function () {
        if (jQuery(this).val() == 'character') {
            jQuery(".advance_contents_settings_character").show();
        } else {
            jQuery(".advance_contents_settings_character").hide();
        }
        if(jQuery("input[name='display_html_tags']") == 1) {
            jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",true);
            jQuery("#contents_stopage_from option:contains('Paragraph')").attr("selected",true);
            jQuery('#contents_stopage_from').trigger("chosen:updated");
            jQuery(".advance_contents_settings_character").hide();
        }
        bdpAltBackground();
    });


    if(jQuery("select[name='pagination_type']").val() == 'load_more_btn') {
        jQuery('.read_more_text_background').show();
        jQuery('.read_more_text_hover_background').show();
        jQuery('.loadmore_btn_option').show();

    } else {
        jQuery('.loadmore_btn_option').hide();
        if(jQuery.inArray(jQuery('.bdp_template_name').val(), $readmore_bg_color) !== -1) {
            jQuery('.read_more_text_background').hide();
        }
        if(jQuery.inArray(jQuery('.bdp_template_name').val(), $readmore_bg_hover_color) !== -1) {
            jQuery('.read_more_text_hover_background').hide();
        }
    }
    jQuery("select[name='pagination_type']").change(function () {
        if (jQuery(this).val() == 'load_more_btn') {
            jQuery('.read_more_text_background').show();
            jQuery('.read_more_text_hover_background').show();
            jQuery('.loadmore_btn_option').show();
        } else {
            if(jQuery.inArray(jQuery('.bdp_template_name').val(), $readmore_bg_color) !== -1) {
                jQuery('.read_more_text_background').hide();
            }
            if(jQuery.inArray(jQuery('.bdp_template_name').val(), $readmore_bg_hover_color) !== -1) {
                jQuery('.read_more_text_hover_background').hide();
            }
            jQuery('.loadmore_btn_option').hide();
        }
        bdpAltBackground();
    });

    if(jQuery('input[name="bdp_post_title_link"]:checked').val() == 0) {
        jQuery('.title-link-hover-color-tr').hide();
    } else {
        jQuery('.title-link-hover-color-tr').show();
    }
    jQuery('input[name="bdp_post_title_link"]').on('click', function() {
        if(jQuery('input[name="bdp_post_title_link"]:checked').val() == 0) {
            jQuery('.title-link-hover-color-tr').hide();
        } else {
            jQuery('.title-link-hover-color-tr').show();
        }
        bdpAltBackground();
    });

    if(jQuery.inArray(jQuery(".bdp_template_name").val(), $image_hover_effect_hide) !== -1) {
        jQuery('.bdp-image-hover-effect-tr').hide();
    } else {
        if (jQuery("input[name='bdp_image_hover_effect']:checked").val() == 1) {
            jQuery('.bdp-image-hover-effect-tr').show();
        } else {
            jQuery('.bdp-image-hover-effect-tr').hide();
        }
    }
    jQuery("input[name='bdp_image_hover_effect']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.bdp-image-hover-effect-tr').show();
        } else {
            jQuery('.bdp-image-hover-effect-tr').hide();
        }
        bdpAltBackground();
    });

    jQuery('.bdp_media_custom_size_tr').hide();
    if (jQuery('#bdp_media_size').val() == 'custom') {
        jQuery('.bdp_media_custom_size_tr').show();
    }
    jQuery('#bdp_media_size').on('change', function () {
        if (jQuery(this).val() == 'custom') {
            jQuery('.bdp_media_custom_size_tr').show();
        } else {
            jQuery('.bdp_media_custom_size_tr').hide();
        }
        bdpAltBackground();
    });

    if (jQuery.inArray(jQuery('.bdp_template_name').val(), $easy_timeline_effect) !== -1) {
        if (jQuery("input[name='display_feature_image']") == 1) {
            jQuery('.display_image_tr').show();
            var template = jQuery(".bdp_template_name").val();

            if (jQuery('#bdp_media_size').val() == 'custom') {
                jQuery('.bdp_media_custom_size_tr').show();
            } else {
                jQuery('.bdp_media_custom_size_tr').hide();
            }
            if (jQuery.inArray(template, $horizontal_timeline_option) !== -1) {
                jQuery('.bdp_media_size_tr').hide();
            } else {
                jQuery('.bdp_media_size_tr').show();
            }
            if (jQuery.inArray(template, $image_hover_effect_hide) !== -1) {
                jQuery('.bdp-image-hover-effect').hide()
            } else {
                jQuery('.bdp-image-hover-effect').show()
            }
            if(jQuery.inArray(template, $easy_timeline_effect) !== -1) {
                jQuery('.easy_timeline_effect_tr').show();
            } else {
                jQuery('.easy_timeline_effect_tr').hide();
            }
            if(jQuery.inArray(template, $thumbnail_skin) !== -1) {
                jQuery('.thumbnail_skin_tr').show();
            } else {
                jQuery('.thumbnail_skin_tr').hide();
            }
            if(jQuery.inArray(template, $image_hover_effect_hide) !== -1) {
                jQuery('.bdp-image-hover-effect-tr').hide();
            } else {
                if (jQuery("input[name='bdp_image_hover_effect']:checked").val() == 1) {
                    jQuery('.bdp-image-hover-effect-tr').show();
                } else {
                    jQuery('.bdp-image-hover-effect-tr').hide();
                }
            }
        } else {
            jQuery('.display_image_tr').hide();
        }
    }

    jQuery("input[name='display_feature_image']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.display_image_tr').show();
            var template = jQuery(".bdp_template_name").val();

            if (jQuery('#bdp_media_size').val() == 'custom') {
                jQuery('.bdp_media_custom_size_tr').show();
            } else {
                jQuery('.bdp_media_custom_size_tr').hide();
            }
            if (jQuery.inArray(template, $horizontal_timeline_option) !== -1) {
                jQuery('.bdp_media_size_tr').hide();
            } else {
                jQuery('.bdp_media_size_tr').show();
            }
            if (jQuery.inArray(template, $image_hover_effect_hide) !== -1) {
                jQuery('.bdp-image-hover-effect').hide()
            } else {
                jQuery('.bdp-image-hover-effect').show()
            }
            if(jQuery.inArray(template, $easy_timeline_effect) !== -1) {
                jQuery('.easy_timeline_effect_tr').show();
            } else {
                jQuery('.easy_timeline_effect_tr').hide();
            }
            if(jQuery.inArray(template, $thumbnail_skin) !== -1) {
                jQuery('.thumbnail_skin_tr').show();
            } else {
                jQuery('.thumbnail_skin_tr').hide();
            }
            if(jQuery.inArray(template, $image_hover_effect_hide) !== -1) {
                jQuery('.bdp-image-hover-effect-tr').hide();
            } else {
                if (jQuery("input[name='bdp_image_hover_effect']:checked").val() == 1) {
                    jQuery('.bdp-image-hover-effect-tr').show();
                } else {
                    jQuery('.bdp-image-hover-effect-tr').hide();
                }
            }
        } else {
            jQuery('.display_image_tr').hide();
        }
        bdpAltBackground();
    });

    if (jQuery.inArray(jQuery('.bdp_template_name').val(), $blog_gridheight) !== -1) {
        if (jQuery("input[name='blog_grid_height']:checked").val() == 1) {
            jQuery('.blog-post-grid-height-tr').show();
        } else {
            jQuery('.blog-post-grid-height-tr').hide();
        }
        jQuery("input[name='blog_grid_height']").change(function () {
            if (jQuery(this).val() == 1) {
                jQuery('.blog-post-grid-height-tr').show();
            } else {
                jQuery('.blog-post-grid-height-tr').hide();
            }
        });
    }

    jQuery('.orderby_date_display').hide();
    jQuery('.displayorder_backcolor').hide();
    jQuery('.display-layout_type').hide();
    if (jQuery('.bdp_template_name').val() == 'timeline') {
        jQuery('.display-layout_type').show();
        if (jQuery("select[name='bdp_blog_order_by']").val() == 'date' || jQuery("select[name='bdp_blog_order_by']").val() == 'modified') {
            jQuery('.orderby_date_display').show();
            if (jQuery("select[name='timeline_display_option']").val() != '') {
                jQuery('.displayorder_backcolor').show();
            } else {
                jQuery('.displayorder_backcolor').hide();
            }
        } else {
            jQuery('.orderby_date_display').hide();
            jQuery('.displayorder_backcolor').hide();
        }
        jQuery("select[name='bdp_blog_order_by']").change(function () {
            if (jQuery(this).val() == 'date' || jQuery(this).val() == 'modified') {
                jQuery('.orderby_date_display').show();
                if (jQuery("select[name='timeline_display_option']").val() != '') {
                    jQuery('.displayorder_backcolor').show();
                } else {
                    jQuery('.displayorder_backcolor').hide();
                }
            } else {
                jQuery('.orderby_date_display').hide();
                jQuery('.displayorder_backcolor').hide();
            }
        });
        jQuery("select[name='timeline_display_option']").change(function () {
            if (jQuery(this).val() != '') {
                jQuery('.displayorder_backcolor').show();
            } else {
                jQuery('.displayorder_backcolor').hide();
            }
        });
    }
    if (jQuery("input[name='advance_filter']:checked").val() == 1) {
        jQuery('.advance_filter_option').show();
    } else {
        jQuery('.advance_filter_option').hide();
    }
    jQuery("input[name='advance_filter']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.advance_filter_option').show();
        } else {
            jQuery('.advance_filter_option').hide();
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='read_more_link']:checked").val() == 1) {
        jQuery('.read_more_wrap').show();
        if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_color) !== -1) {
            jQuery('.read_more_text_background').hide();
        }
        if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_hover_color) !== -1) {
            jQuery('.read_more_text_hover_background').hide();
        }
    } else {
        jQuery('.read_more_wrap').hide();
    }
    jQuery("input[name='read_more_link']").change(function () {

        if (jQuery(this).val() == 1) {
            jQuery('.read_more_wrap').show();
            if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_color) !== -1) {
                jQuery('.read_more_text_background').hide();
            }
            if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_hover_color) !== -1) {
                jQuery('.read_more_text_hover_background').hide();
            }
            if (jQuery("input[name='post_link_type']:checked").val() == 1) {
                jQuery('.custom_link_url').show();
            } else {
                jQuery('.custom_link_url').hide();
            }
        } else {
            jQuery('.read_more_wrap').hide();
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='post_link_type']:checked").val() == 1 && jQuery("input[name='read_more_link']:checked").val() == 1) {
        jQuery('.custom_link_url').show();
    } else {
        jQuery('.custom_link_url').hide();
    }
    jQuery("input[name='post_link_type']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.custom_link_url').show();
        } else {
            jQuery('.custom_link_url').hide();
        }
        bdpAltBackground();
    });

    jQuery("select[name='pagination_template']").change(function () {
        var imgname = jQuery("select[name='pagination_template']").val();
        var imgpath = plugin_path + '/images/pagination/'+ imgname + '.png';
        jQuery(".pagination_template_images").attr("src",imgpath);
        bdpAltBackground();
    });
    jQuery("select[name='load_more_button_template']").change(function () {
        var imgname = jQuery("select[name='load_more_button_template']").val();
        var imgpath = plugin_path + '/images/buttons/'+ imgname + '.png';
        jQuery(".load_more_button_template_images").attr("src",imgpath);
        bdpAltBackground();
    });

    if (jQuery("select[name='pagination_type']").val() == 'paged') {
        jQuery(".archive_pagination_template").show();
    } else {
        jQuery(".archive_pagination_template").hide();
    }
    if (jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
        jQuery(".archive_loader_template").show();
        if(jQuery("select[name='pagination_type']").val() == 'load_more_btn') {
            jQuery('.loadmore_btn_option').show();
        } else {
            jQuery('.loadmore_btn_option').hide();
        }

        if (jQuery("select[name='loader_type']").val() != 1 ) {
            jQuery(".default_loader").show();
            jQuery(".upload_loader").hide();
        } else if ( jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
            jQuery(".default_loader").hide();
            jQuery(".upload_loader").show();
        }
    } else {
        jQuery(".archive_loader_template").hide();
    }

    jQuery("select[name='pagination_type']").change(function () {
        if (jQuery(this).val() == 'paged') {
            jQuery(".archive_pagination_template").show();
        } else {
            jQuery(".archive_pagination_template").hide();
        }

        if (jQuery(this).val() == 'load_more_btn' || jQuery(this).val() == 'load_onscroll_btn') {
            jQuery(".archive_loader_template").show();
            if(jQuery(this).val() == 'load_more_btn') {
                jQuery('.loadmore_btn_option').show();
            } else {
                jQuery('.loadmore_btn_option').hide();
            }

            if (jQuery("select[name='loader_type']").val() != 1 ) {
                jQuery(".default_loader").show();
                jQuery(".upload_loader").hide();
            } else if ( jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
                jQuery(".default_loader").hide();
                jQuery(".upload_loader").show();
                bdpAltBackground();
            }
            bdpAltBackground();
        } else {
            jQuery(".archive_loader_template").hide();
        }
        bdpAltBackground();
    });


    if (jQuery("select[name='loader_type']").val() != 1 && ( jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') ) {
        jQuery(".default_loader").show();
        jQuery(".upload_loader").hide();
    } else if ( jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
        jQuery(".default_loader").hide();
        jQuery(".upload_loader").show();
    }

    jQuery("select[name='loader_type']").change(function () {
        if (jQuery(this).val() != 1 ) {
            jQuery(".default_loader").show();
            jQuery(".upload_loader").hide();
        } else {
            jQuery(".default_loader").hide();
            jQuery(".upload_loader").show();
        }
    });

    if (jQuery("input[name='social_share']:checked").val() == 1) {
        jQuery('.social_share_options').show();
    } else {
        jQuery('.social_share_options').hide();
    }
    jQuery("input[name='social_share']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.social_share_options').show();
        } else {
            jQuery('.social_share_options').hide();
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='social_style']:checked").val() == 1) {
        jQuery("input[name='social_style']:checked").closest('li').next().hide();
        jQuery("input[name='social_style']:checked").closest('li').next().next().hide();
        jQuery("input[name='social_style']:checked").closest('li').siblings('.default_icon_layouts').show();
    } else {
        jQuery("input[name='social_style']:checked").closest('li').next().show();
        jQuery("input[name='social_style']:checked").closest('li').next().next().show();
        jQuery("input[name='social_style']:checked").closest('li').siblings('.default_icon_layouts').hide();
    }

    jQuery("input[name='social_style']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery("input[name='social_style']:checked").closest('li').next().hide();
            jQuery("input[name='social_style']:checked").closest('li').next().next().hide();
            jQuery("input[name='social_style']:checked").closest('li').siblings('.default_icon_layouts').show();
        } else {
            jQuery("input[name='social_style']:checked").closest('li').next().show();
            jQuery("input[name='social_style']:checked").closest('li').next().next().show();
            jQuery("input[name='social_style']:checked").closest('li').siblings('.default_icon_layouts').hide();
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='email_link']:checked").val() == 1) {
        jQuery('.mail_share_content').show();
    } else {
        jQuery('.mail_share_content').hide();
    }
    jQuery("input[name='email_link']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.mail_share_content').show();
        } else {
            jQuery('.mail_share_content').hide();
        }
        bdpAltBackground();
    });

    jQuery("input[name='rss_use_excerpt']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.excerpt_length').show();
            jQuery('.advance_contents_tr').show();
            jQuery('.read_more_text').show();
            jQuery('.read_more_text_color').show();
            jQuery('.read_more_text_background').show();
            jQuery('.post_content_from').show();
            jQuery('.remove_html_tags_tr').show();
            jQuery('.display_html_tags_tr').show();
            if (jQuery.inArray(jQuery(".bdp_template_name").val(), $readmore_bg_color) !== -1) {
                jQuery('.read_more_text_background').hide();
            }
            if (jQuery("input[name='advance_contents']:checked").val() == 1) {
                jQuery(".advance_contents_settings").show();
                if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                    jQuery(".advance_contents_settings_character").show();
                } else {
                    jQuery(".advance_contents_settings_character").hide();
                }
            } else {
                jQuery(".advance_contents_settings").hide();
            }
        } else {
            jQuery('.excerpt_length').hide();
            jQuery('.advance_contents_tr').hide();
            jQuery('.read_more_text').hide();
            jQuery('.read_more_text_color').hide();
            jQuery('.read_more_text_background').hide();
            jQuery('.post_content_from').hide();
            jQuery('.remove_html_tags_tr').hide();
            jQuery('.display_html_tags_tr').hide();
        }
        bdpAltBackground();
    });

    if(jQuery("input[name='display_html_tags']") == 1) {
        jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",true);
        jQuery("#contents_stopage_from option:contains('Paragraph')").attr("selected",true);
        jQuery('#contents_stopage_from').trigger("chosen:updated");
        jQuery(".advance_contents_settings_character").hide();
    } else {
        jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",false);
        jQuery('#contents_stopage_from').trigger("chosen:updated");
        if (jQuery("input[name='advance_contents']:checked").val() == 1) {
            jQuery(".advance_contents_settings").show();
            if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                jQuery(".advance_contents_settings_character").show();
            } else {
                jQuery(".advance_contents_settings_character").hide();
            }
        }
    }
    jQuery("input[name='display_html_tags']").change(function () {
        if(jQuery(this).val() == 1) {
            jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",true);
            jQuery("#contents_stopage_from option:contains('Paragraph')").attr("selected",true);
            jQuery('#contents_stopage_from').trigger("chosen:updated");
            jQuery(".advance_contents_settings_character").hide();
        } else {
            jQuery("#contents_stopage_from option:contains('Characters')").attr("disabled",false);
            jQuery('#contents_stopage_from').trigger("chosen:updated");
            if (jQuery("input[name='advance_contents']:checked").val() == 1) {
                jQuery(".advance_contents_settings").show();
                if (jQuery("select[name='contents_stopage_from']").val() == 'character') {
                    jQuery(".advance_contents_settings_character").show();
                } else {
                    jQuery(".advance_contents_settings_character").hide();
                }
            }
        }
        bdpAltBackground();
    });

    if (jQuery("input[name='display_author_biography']:checked").val() == 1) {
        jQuery('.author_biography_div').show();
    } else {
        jQuery('.author_biography_div').hide();
    }
    jQuery("input[name='display_author_biography']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.author_biography_div').show();
        } else {
            jQuery('.author_biography_div').hide();
        }
        bdpAltBackground();
    });
    if (jQuery("input[name='display_author_social']:checked").val() == 1) {
        jQuery('.display_author_social_div').show();
    } else {
        jQuery('.display_author_social_div').hide();
    }
    jQuery("input[name='display_author_social']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.display_author_social_div').show();
        } else {
            jQuery('.display_author_social_div').hide();
        }
        bdpAltBackground();
    });


    if (jQuery("input[name='display_author_data']:checked").val() == 1) {
        jQuery('.display_author_biography_div').show();
        jQuery('.author_biography_div').hide();
        jQuery('.display_author_social_div').hide();
        if (jQuery("input[name='display_author_biography']:checked").val() == 1) {
            jQuery('.author_biography_div').show();
        }
        if (jQuery("input[name='display_author_social']:checked").val() == 1) {
            jQuery('.display_author_social_div').show();
        }
    } else {
        jQuery('.display_author_biography_div').hide();
        jQuery('.author_biography_div').hide();
        jQuery('.display_author_social_div').hide();
    }
    jQuery("input[name='display_author_data']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.display_author_biography_div').show();
            jQuery('.author_biography_div').hide();
            if (jQuery("input[name='display_author_biography']:checked").val() == 1) {
                jQuery('.author_biography_div').show();
            }
            if (jQuery("input[name='display_author_social']:checked").val() == 1) {
                jQuery('.display_author_social_div').show();
            }
        } else {
            jQuery('.display_author_biography_div').hide();
            jQuery('.author_biography_div').hide();
            jQuery('.display_author_social_div').hide();
        }
    });

    if (jQuery("select[name='custom_post_type']").val() == 'post') {
        jQuery('.custom_post_taxonomy_div').hide();
        jQuery(".post-category").show();
        jQuery(".post-tag").show();
        jQuery(".display-taxonomy").hide();
        jQuery(".display-term").hide();
        jQuery(".display-tag").show();
        jQuery(".display-category").show();
    } else {
        jQuery('.custom_post_taxonomy_div').show();
        jQuery(".post-category").hide();
        jQuery(".post-tag").hide();
        jQuery(".display-taxonomy").show();
        jQuery(".display-term").show();
        jQuery(".display-tag").hide();
        jQuery(".display-category").hide();
    }

    jQuery("select[name='custom_post_type']").change(function () {
        if (jQuery('.bdp_template_name').val() == 'cool_horizontal' || jQuery('.bdp_template_name').val() == 'overlay_horizontal') {
            var posttypeval = jQuery(this).val();
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'get_post_type_post_list',
                    posttype: posttypeval,
                },
                success: function (response) {
                    jQuery('.active_post_list').html('');
                    jQuery('.active_post_list').html(response);
                    jQuery(".bd-settings-wrappers .bdp-settings select:not(.chosen-select)").wrap("<div class='select-cover'></div>");
                    jQuery(".select-cover select").chosen();
                    jQuery('.select-cover select').trigger("chosen:updated");
                    bdpAltBackground();
                }
            });
        }
    });

    jQuery("select[name='custom_post_type']").change(function () {
        var posttypeval = jQuery(this).val();
        jQuery("#bdpgeneral .bdp-display-settings .display-custom-taxonomy").remove();
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'custom_post_taxonomy_display_settings',
                posttype: posttypeval,
            },
            success: function (response) {
                jQuery("#bdpgeneral .bdp-display-settings .display-custom-taxonomy").remove();
                jQuery('#bdpgeneral .bdp-display-settings .bdp-typography-wrapper').prepend(response);
                if(response == "") {
                    jQuery("#bdpgeneral .bdp-display-settings .display-custom-taxonomy").remove();
                }
                jQuery('.buttonset').buttonset();
            }
        });
        bdpAltBackground();
    });

    jQuery("select[name='custom_post_type']").change(function () {
        var posttypeval = jQuery(this).val();
        if(posttypeval == 'post') {
            jQuery(".post-category").show();
            jQuery(".post-tag").show();
            jQuery(".advance_filter_settings").show();
            jQuery(".bdp-post-terms ").remove();
        } else {
          jQuery(".post-category").hide();
          jQuery(".post-tag").hide();
          jQuery(".advance_filter_settings").hide();
          jQuery("#advance_filter_0").prop("checked", true);
          jQuery("#advance_filter_1").prop("checked", false);
          jQuery.ajax({
              type: 'POST',
              url: ajaxurl,
              data: {
                  action: 'get_custom_taxonomy_terms',
                  posttype: posttypeval,
              },
              success: function (response) {
                  jQuery('.bdp-post-authors-list').before(response);
                  jQuery("#bdpfilter .bdp-settings .bdp-post-terms select").each(function() {
                      if(jQuery(this).parent('.select-cover').length == 0) {
                        jQuery(this).wrap("<div class='select-cover'></div>");
                        jQuery('.select-cover select').chosen();
                        jQuery('.select-cover select').trigger("chosen:updated");
                      }

                  });
                  bdpAltBackground();
              }
          });
        }
        bdpAltBackground();
    });



    if (jQuery('#blog_time_period').val() == 'between_two_date') {
        jQuery('.bdp_between_two_date').show();
    } else {
        jQuery('.bdp_between_two_date').hide();
    }
    if (jQuery('#blog_time_period').val() == 'last_n_days' || jQuery('#blog_time_period').val() == 'next_n_days') {
        jQuery('.bdp_time_period_days').show();
    } else {
        jQuery('.bdp_time_period_days').hide();
    }
    jQuery('#blog_time_period').change(function () {
        if (jQuery(this).val() == 'between_two_date') {
            jQuery('.bdp_between_two_date').show();
        } else {
            jQuery('.bdp_between_two_date').hide();
        }
        if (jQuery(this).val() == 'last_n_days' || jQuery(this).val() == 'next_n_days') {
            jQuery('.bdp_time_period_days').show();
        } else {
            jQuery('.bdp_time_period_days').hide();
        }
    });

    /* Archive Show hide category and tag*/
    if (jQuery("select[name='custom_archive_type']").val() == 'category_template') {
        jQuery('.bdp-archive-page .post-category').show();
    } else {
        jQuery('.bdp-archive-page .post-category').hide();
    }
    if (jQuery("select[name='custom_archive_type']").val() == 'tag_template') {
        jQuery('.bdp-archive-page .post-tag').show();
    } else {
        jQuery('.bdp-archive-page .post-tag').hide();
    }
    if (jQuery("select[name='custom_archive_type']").val() == 'author_template') {
        jQuery('.bdp-archive-page .post-author').show();
    } else {
        jQuery('.bdp-archive-page .post-author').hide();
    }
    if (jQuery('#edit_archive_layout_form').length > 0) {
        if (jQuery("select[name='custom_archive_type']").val() == 'author_template') {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).removeClass('clickDisable');
                }
            });
        } else {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).addClass('clickDisable');
                }
            });
        }
    }

    jQuery("select[name='custom_archive_type']").change(function () {
        if (jQuery(this).val() == 'category_template') {
            jQuery('.bdp-archive-page .post-category').show();
        } else {
            jQuery('.bdp-archive-page .post-category').hide();
        }
        if (jQuery(this).val() == 'author_template') {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).removeClass('clickDisable');
                }
            });
        } else {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).addClass('clickDisable');
                }
            });
        }
        if (jQuery(this).val() == 'tag_template') {
            jQuery('.bdp-archive-page .post-tag').show();
        } else {
            jQuery('.bdp-archive-page .post-tag').hide();
        }
        if (jQuery(this).val() == 'author_template') {
            jQuery('.bdp-archive-page .post-author').show();
        } else {
            jQuery('.bdp-archive-page .post-author').hide();
        }
    });
    /* end of Archive Show hide category and tag*/

    //Show/Hide Options

    bdpContentHide(jQuery(".bdp_template_name").val());

    //Show/Hide Options for single post
    if(jQuery('body').hasClass('blog-designer_page_single_post')) {
        setSingleLayoutOptionVisibility(jQuery(".bdp_template_name").val());
    }

    /**
     * No Pagination show Story Ending
     */
    if (jQuery('#pagination_type').val() == 'no_pagination' && jQuery('.bdp_template_name ').val() == 'story') {
        jQuery('.story-ending-tr').show();
    } else {
        jQuery('.story-ending-tr').hide();
    }
    jQuery('#pagination_type').change(function () {
        if (jQuery(this).val() == 'no_pagination' && jQuery('.bdp_template_name ').val() == 'story') {
            jQuery('.story-ending-tr').show();
        } else {
            jQuery('.story-ending-tr').hide();
        }
    });

    /**
     * Show Custom Read More Text
     */
    bdpCustomReadMore('hide');
    if (jQuery('#pagination_type').val() == 'no_pagination') {
        bdpCustomReadMore('show');
    }
    jQuery('#pagination_type').change(function () {
        if (jQuery(this).val() == 'no_pagination') {
            bdpCustomReadMore('show');
        } else {
            bdpCustomReadMore('hide');
        }
    });

    var $title_template = jQuery('.bdp_template_name').val();

    /* Hide or show for override template */
    if (jQuery('#override_single').attr('checked')) {
        jQuery('#bdpsinglegeneral .override-single-design-li').show();
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpsinglestandard' || hide == 'bdpsinglemedia' || hide == 'bdpsingletitle' || hide == 'bdpsingleconent' || hide == 'bdpsinglepostnavigation' || hide == 'bdpsinglepostauthor' || hide == 'bdpsinglerelated' || hide == 'bdpsinglesocial') {
                jQuery(this).removeClass('clickDisable');
            }
        });

    } else {
        jQuery('.override-single-design-li').hide();
        jQuery('#override_single').closest('div.postbox').nextAll('div.postbox').hide();

        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpsinglestandard' || hide == 'bdpsinglemedia' || hide == 'bdpsingletitle' || hide == 'bdpsingleconent' || hide == 'bdpsinglepostnavigation' || hide == 'bdpsinglepostauthor' || hide == 'bdpsinglerelated' || hide == 'bdpsinglesocial') {
                jQuery(this).addClass('clickDisable');
            }
        });

    }
    jQuery('#override_single').change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery('#bdpsinglegeneral .override-single-design-li').show();
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglestandard' || hide == 'bdpsinglemedia' || hide == 'bdpsingletitle' || hide == 'bdpsingleconent' || hide == 'bdpsinglepostnavigation' || hide == 'bdpsinglepostauthor' || hide == 'bdpsinglerelated' || hide == 'bdpsinglesocial') {
                    jQuery(this).removeClass('clickDisable');
                }
            });

            bdp_set_single_template_default_data();

            if (jQuery("input[name='display_navigation']:checked").val() == 1) {
               jQuery('.post-navigation-blocks').show();
           } else {
               jQuery('.post-navigation-blocks').hide();
           }
        } else {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglestandard' || hide == 'bdpsinglemedia' || hide == 'bdpsingletitle' || hide == 'bdpsingleconent' || hide == 'bdpsinglepostnavigation' || hide == 'bdpsinglepostauthor' || hide == 'bdpsinglerelated' || hide == 'bdpsinglesocial') {
                    jQuery(this).addClass('clickDisable');
                }
            });
            jQuery('#bdpsinglegeneral .override-single-design-li').hide();
            jQuery(this).closest('div.postbox').nextAll('div.postbox').hide();
        }
        bdpAltBackground();
    });

    /* Show post navigation settings when post navaition is on.*/
    if (jQuery("input[name='display_navigation']:checked").val() == 1) {
        jQuery('.post-navigation-blocks').show();
    } else {
        jQuery('.post-navigation-blocks').hide();
    }
    jQuery("input[name='display_navigation']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.post-navigation-blocks').show();
        } else {
            jQuery('.post-navigation-blocks').hide();
        }
    });
    if (jQuery('#edit_archive_layout_form').length > 0) {
        if (jQuery("select[name='custom_archive_type']").val() == 'author_template') {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).removeClass('clickDisable');
                }
            });
        } else {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsinglepostauthor') {
                    jQuery(this).addClass('clickDisable');
                }
            });
        }
    }


    /* Slide Effect change.*/
    if (jQuery("input[name='display_navigation']:checked").val() == 1) {
        jQuery('.post-navigation-blocks').show();
    } else {
        jQuery('.post-navigation-blocks').hide();
    }
    jQuery("input[name='display_navigation']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.post-navigation-blocks').show();
        } else {
            jQuery('.post-navigation-blocks').hide();
        }
    });
    if (jQuery("select[name='template_slider_effect']").val() == 'fade') {
        jQuery('.slider_columns_tr').hide();
        jQuery('.slider_scroll_tr').hide();
    } else {
        jQuery('.slider_columns_tr').show();
        jQuery('.slider_scroll_tr').show();
    }
    jQuery("select[name='template_slider_effect']").change(function () {
        if (jQuery(this).val() == 'fade') {
            jQuery('.slider_columns_tr').hide();
            jQuery('.slider_scroll_tr').hide();
        } else {
            jQuery('.slider_columns_tr').show();
            jQuery('.slider_scroll_tr').show();
        }
    });

    /*Ajax call for preview*/
    var can_preview = 1;
    jQuery("#bdp-btn-show-preview").on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        jQuery('.splash-screen').show();
        jQuery('#bdp-preview-box').addClass('preview-in');
        if (can_preview) {
            var data = jQuery('.bd-form-class').serialize();
            var $bdp_template_name = jQuery('.bdp_template_name').val();
            if (bdpro_js.bdp_template_name_changed == 1) {
                if ($bdp_template_name == 'classical') {
                    $bdp_template_name = 'nicy';
                } else if ($bdp_template_name == 'lightbreeze') {
                    $bdp_template_name = 'sharpen';
                } else if ($bdp_template_name == 'spektrum') {
                    $bdp_template_name = 'hub';
                }
            }
            var href = plugin_path + '/css/layouts/' + $bdp_template_name + '.css';
            var front_href = plugin_path + '/css/front.css';
            if (jQuery('body').hasClass('rtl')) {
                var front_rtl_href = plugin_path + '/css/front-rtl.css';
            }
            var $template_titlefontface = jQuery('#template_titlefontface').val();
            var $column_setting = jQuery('#column_setting').val();
            var $background = jQuery('#template_bgcolor').iris('color');
            var $template_bghovercolor = jQuery('#template_bghovercolor').iris('color');
            var $templatecolor = jQuery('#template_color').iris('color');
            var $template_alternative_color = jQuery('#template_alternative_color').iris('color');
            var $displaydate_backcolor = jQuery('#displaydate_backcolor').iris('color');
            var $color = jQuery('#template_ftcolor').iris('color');
            var $linkhovercolor = jQuery('#template_fthovercolor').iris('color');
            var $titlecolor = jQuery('#template_titlecolor').iris('color');
            var $titlehovercolor = jQuery('#template_titlehovercolor').iris('color');
            var $contentcolor = jQuery('#template_contentcolor').iris('color');
            var $readmorecolor = jQuery('#template_readmorecolor').iris('color');
            var $readmorebackcolor = jQuery('#template_readmorebackcolor').iris('color');
            var $readmorehoverbackcolor = jQuery('#template_readmore_hover_backcolor').iris('color');
            var $alterbackground = jQuery('#template_alterbgcolor').iris('color');
            var $titlebackcolor = jQuery('#template_titlebackcolor').iris('color');
            var $story_startup_background = jQuery('#story_startup_background').iris('color');
            var $story_startup_text_color = jQuery('#story_startup_text_color').iris('color');
            var $story_ending_background = jQuery('#story_ending_background').iris('color');
            var $story_ending_text_color = jQuery('#story_ending_text_color').iris('color');
            var $story_startup_border_color = jQuery('#story_startup_border_color').iris('color');
            var $template_titlefontsize = jQuery('#template_titlefontsize').val();
            var $content_fontsize = jQuery('#content_fontsize').val();
            var $content_font_family = jQuery('#content_font_family').val();
            var $social_icon_style = jQuery('#social_icon_style_0').attr('checked');
            var $template_alternativebackground = jQuery('#template_alternativebackground_1').attr('checked');
            var $authorTitleSize = jQuery('#author_title_fontsize').val();
            var $authorTitleFace = jQuery('#author_title_fontface').val();
            var $template_easing = jQuery('#template_easing').val();
            var $grid_col_space = jQuery('#grid_col_spaceOutputId').val();
            var $item_width = jQuery('#item_width').val();
            var $grid_hoverback_color = jQuery('#grid_hoverback_color').iris('color');

            var $template_title_font_weight = jQuery('#template_title_font_weight').val();
            var $template_title_font_line_height = jQuery('#template_title_font_line_height').val();
            var $template_title_font_italic = jQuery("input[name='template_title_font_italic']:checked").val();
            var $template_title_font_text_transform = jQuery('#template_title_font_text_transform').val();
            var $template_title_font_text_decoration = jQuery('#template_title_font_text_decoration').val();
            var $template_title_font_letter_spacing = jQuery('#template_title_font_letter_spacing').val();

            var $content_font_weight = jQuery('#content_font_weight').val();
            var $content_font_line_height = jQuery('#content_font_line_height').val();
            var $content_font_italic = jQuery("input[name='content_font_italic']:checked").val();
            var $content_font_text_transform = jQuery('#content_font_text_transform').val();
            var $content_font_text_decoration = jQuery('#content_font_text_decoration').val();
            var $content_font_letter_spacing = jQuery('#content_font_letter_spacing').val();

            var $firstletter_big = jQuery('input[name="firstletter_big"]:checked').val();
            var $firstletter_fontsize = jQuery('#firstletter_fontsize').val();
            var $firstletter_font_family = jQuery('#firstletter_font_family').val();
            var $firstletter_contentcolor = jQuery('#firstletter_contentcolor').iris('color');

            var $slider_image_height = jQuery('#media_custom_height').val();

            var $beforeloop_Readmoretext = jQuery('#beforeloop_Readmoretext').val();
            var $beforeloop_titlefontface = jQuery('#beforeloop_titlefontface').val();
            var $beforeloop_titlefontsize = jQuery('#beforeloop_titlefontsize').val();
            var $beforeloop_title_font_weight = jQuery('#beforeloop_title_font_weight').val();
            var $beforeloop_title_font_line_height = jQuery('#beforeloop_title_font_line_height').val();
            var $beforeloop_title_font_italic = jQuery("input[name='beforeloop_title_font_italic']:checked").val();
            var $beforeloop_title_font_text_transform = jQuery('#beforeloop_title_font_text_transform').val();
            var $beforeloop_title_font_text_decoration = jQuery('#beforeloop_title_font_text_decoration').val();
            var $beforeloop_title_font_letter_spacing = jQuery('#beforeloop_title_font_letter_spacing').val();
            var $beforeloop_readmorecolor = jQuery('#beforeloop_readmorecolor').iris('color');
            var $beforeloop_readmorebackcolor = jQuery('#beforeloop_readmorebackcolor').iris('color');
            var $beforeloop_readmorehovercolor = jQuery('#beforeloop_readmorehovercolor').iris('color');
            var $beforeloop_readmorehoverbackcolor = jQuery('#beforeloop_readmorehoverbackcolor').iris('color');

            if (jQuery('#template_titlefontface_font_type').val() == "Google Fonts" && $template_titlefontface != '') {
                var font_family_link = bdpro_js.bdp_font_base + 'fonts.googleapis.com/css?family=' + $template_titlefontface;
                jQuery('head').append('<link type="text/css" class="bdp_google_font_link" rel="stylesheet" href="' + font_family_link + '">');
            }

            if ($social_icon_style) {
                var $style = '.social-component a.social-share-custom {border-radius: 100%;}';
            }
            if ($beforeloop_Readmoretext != '') {
                $style += '.bdp_wrapper .custom_read_more.before_loop,.bdp_wrapper .custom_read_more.after_loop {display: inline-block; margin: 30px 0; text-align: center; width: 100%;}';
                $style += '.bdp_wrapper .custom_read_more a {transition: 0.2s all; -webkit-transition: 0.2s all; -ms-transition: 0.2s all;-o-transition: 0.2s all;display: inline-block;padding: 7px 20px; box-shadow: none; background: ' + $beforeloop_readmorebackcolor + '; color: ' + $beforeloop_readmorecolor + '; font-size: ' + $beforeloop_titlefontsize + 'px; font-family: ' + $beforeloop_titlefontface + '; font-weight: ' + $beforeloop_title_font_weight + '; line-height: ' + $beforeloop_title_font_line_height + '; text-transform: ' + $beforeloop_title_font_text_transform + '; text-decoration: ' + $beforeloop_title_font_text_decoration + '; letter-spacing: ' + $beforeloop_title_font_letter_spacing + 'px; }';
                if ($beforeloop_title_font_italic == 1) {
                    $style += '.bdp_wrapper .custom_read_more a{ font-style: italic }';
                }
                $style += '.bdp_wrapper .custom_read_more a:hover {color: ' + $beforeloop_readmorehovercolor + '; background: ' + $beforeloop_readmorehoverbackcolor + ';}';
            }
            if ($template_alternativebackground) {
                $style += '.white-content .alternative-back{ background:' + $alterbackground + '; }';
                $style += '.bdp_blog_template.alternative-back{ background:' + $alterbackground + '; }';
                $style += '.bdp_blog_template.evolution.alternative-back{ background:' + $alterbackground + '; }';
            }
            $style += '.wl_pagination_box .wl_pagination span, .wl_pagination_box .wl_pagination a{ background:' + $readmorebackcolor + ';color:' + $readmorecolor + '; }';
            $style += '.wl_pagination_box .wl_pagination span.current, .wl_pagination_box .wl_pagination a:hover{ background:' + $color + ';color:' + $background + '; }';
            $style += '.wl_pagination_box .paging-navigation ul.page-numbers li a.page-numbers:hover , .wl_pagination_box .paging-navigation ul.page-numbers li > span.current { background:' + $color + ';color:' + $background + '; }';
            $style += '.bdp_blog_template .post_content{ color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
            $style += '.bdp_blog_template .bdp-pinterest-share-image a{ background-image:url(' + plugin_path + '/images/pinterest.png); }';
            $style += '.bdp_blog_template .tags a:hover,.bdp_blog_template .categories a:hover,.bdp_blog_template .category-link a:hover,.bdp_blog_template a:hover{ color:' + $linkhovercolor + '; }';
            $style += '.bdp_blog_template .bdp-wrapper-like a:hover,.bdp_blog_template .bdp-wrapper-like a:hover, .bdp_blog_template .bdp-wrapper-like a:hover i{ color:' + $linkhovercolor + '; }';
            $style += '.bdp_blog_template .bdp-wrapper-like a,.bdp_blog_template .bdp-wrapper-like a i,.bdp_blog_template .bdp-wrapper-like a .bdp-count{ color:' + $color + '; }';
            $style += '.bdp_blog_template .post_content a.more-tag { background:' + $readmorebackcolor + ';color:' + $readmorecolor + ';}';
            $style += '.bdp_blog_template .post_content a.more-tag:hover: {background:' + $readmorehoverbackcolor + ';}';
            if (jQuery('#social_style_1').attr('checked')) {
                $style += '.bdp_blog_template .social-component a.social-share-default{ padding: 0;border:0;box-shadow: none;}';
                $style += '.bdp_blog_template .social-component.large a.social-share-default{ padding: 0; }';
                $style += '.bdp_blog_template .social-component{ float: left;margin-top: 10px;width: 100%; }';
                $style += '.bdp_blog_template .social-component .social-share,.blog_template.bdp_blog_template .social-component > a{ margin: 10px 10px 0 0;float: left; }';
            }

            if (jQuery('#social_sharecount').val() == 'top') {
                $style += '.bdp_blog_template .social-component .social-share{ float: none !important; display: inline-block; }';
            }

            if (jQuery('#social_sharecount').val() == 'bottom') {
                $style += '.bdp_blog_template .social-component .social-share .count { background-color: transparent;border: 1px solid #dddddd;border-radius: 5px;clear: both;color:' + $contentcolor + ';float: left;line-height: 1;margin: 10px 0 0;padding: 5px 4%;text-align: center;width: 38px;position: relative;word-wrap: break-word;height: auto; }';
                $style += '.bdp_blog_template .social-component.large .social-share .count { width: 45px; }';
                $style += '.bdp_blog_template .social-component .social-share .count:before { border-bottom: 8px solid #dddddd;border-left: 8px solid rgba(0, 0, 0, 0);border-right: 8px dashed rgba(0, 0, 0, 0);content: "";left: 0;margin: 0 auto;position: absolute;right: 0;top: -8px;width: 0; }';
            } else if (jQuery('#social_sharecount').val() == 'top') {
                $style += '.bdp_blog_template .social-component .social-share .count {background-color: transparent;border: 1px solid #dddddd;border-radius: 5px;clear: both;color:' + $contentcolor + ';float: none;line-height: 1;margin: 0 0 10px 0;padding: 5px 4%;text-align: center;width: 38px;position: relative;height: auto;}';
                $style += '.bdp_blog_template .social-component.large .social-share .count { width: 45px; }';
                $style += '.bdp_blog_template.even_class .social-component .social-share .count{ float: none; }';
                $style += '.bdp_blog_template .social-component .social-share .count:before { border-top: 8px solid #ddd;border-left: 8px solid rgba(0, 0, 0, 0);border-right: 8px dashed rgba(0, 0, 0, 0);content: "";left: 0;margin: 0 auto;position: absolute;right: 0;bottom: -9px;width: 0; }';
                $style += '.blog_template.bdp_blog_template .social-component > a{ display: inline-block;margin-bottom: 0;float:none;vertical-align: bottom; }';
                $style += '.bdp_blog_template .social-component .social-share { display: inline-block;float: none; }';
            } else {
                $style += '.bdp_blog_template .social-component .social-share .count { background-color: transparent;border: 1px solid #dddddd;border-radius: 5px;color: ' + $contentcolor + ';float: right;line-height: 20px;margin: 0 0 0 10px;padding: 8px 0;text-align: center;width: 38px;position: relative;box-sizing: border-box; }';
                $style += '.bdp_blog_template .social-component.large .social-share .count{ margin: 0 0 0 7px;padding: 12px 0; }';
                $style += '.bdp_blog_template .social-component.large .social-share .count:before { top: 30%; }';
                $style += '.bdp_blog_template .social-component .social-share .count:before { border-top: 8px solid rgba(0, 0, 0, 0);border-bottom: 8px dashed rgba(0, 0, 0, 0);border-right: 8px solid #ddd;content: "";left: -46px;margin: 0 auto;position: absolute;right: 0;top: 27%;width: 0; }';
            }
            $style += '.blog_header h2 a:hover,.entry-title a:hover,.bdp_blog_template .entry-title a:hover{ color:' + $titlehovercolor + ';}';
            $style += '.bdp-load-more .button.bdp-load-more-btn:hover{ background:' + $readmorecolor + ';color:' + $readmorebackcolor + '; }';
            $style += '.bdp-load-more a.button.bdp-load-more-btn { background:' + $readmorebackcolor + ';color:' + $readmorecolor + ';box-shadow: none; }';
            $style += '.bdp_blog_template h2.post-title{ font-size:' + $template_titlefontsize + 'px;color:' + $titlecolor + ';font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
            if ($template_title_font_italic == 1) {
                $style += '.bdp_blog_template h2.post-title{ font-style: italic }';
            }

            if ($firstletter_big == 1) {
                $style += '.bdp_blog_template div.post-content > *:first-child:first-letter, .bdp_blog_template div.post-content > p:first-child:first-letter, .bdp_blog_template div.post-content:first-letter, .bdp_blog_template div.post_content > *:first-child:first-letter, .bdp_blog_template div.post_content > p:first-child:first-letter, .bdp_blog_template div.post_content:first-letter {color: ' + $firstletter_contentcolor + '; font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; margin-right: 5px; float: left;}';
                $style += '.bdp_blog_template div.post_content {margin-top: 20px;}';
            }

            $style += '.bdp_blog_template .post_content,.bdp_blog_template .post_content p{ font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
            var $blockquote = parseInt($content_fontsize) + 3;
            var $blockquote_before = parseInt($content_fontsize) + 5;
            $style += '.bdp_blog_template .upper_image_wrapper blockquote,.bdp_blog_template .upper_image_wrapper blockquote p{ line-height: ' + $content_font_line_height + '; font-family: ' + $content_font_family + '; font-size:' + $blockquote + 'px;}';
            $style += '.bdp_blog_template .upper_image_wrapper blockquote{ background: ' + $background + '; opacity: 0.9; border-color: ' + $templatecolor + ';}';
            $style += '.bdp_blog_template .upper_image_wrapper blockquote:before{ color: ' + $contentcolor + '; font-size: ' + $blockquote_before + 'px;}';
            $style += '.blog_template .upper_image_wrapper.bdp_link_post_format a{ color:' + $color + ' ;background: ' + $background + '; font-size: ' + $blockquote_before + 'px;font-family: ' + $content_font_family + ';opacity: 0.9;}';
            $style += '.blog_template .upper_image_wrapper.bdp_link_post_format a:hover{ color:' + $linkhovercolor + ' ;}';
            if ($content_font_italic == 1) {
                $style += '.bdp_blog_template .post_content{ font-style: italic }';
            }
            $style += '.bdp_blog_template h2.post-title a{ font-size:' + $template_titlefontsize + 'px;color:' + $titlecolor + ';font-family: ' + $template_titlefontface + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
            $style += '.bdp_blog_template h2.post-title a:hover, .bdp_blog_template .entry-title a:hover { color: ' + $titlehovercolor + '; }';
            $style += '.bdp_blog_template .metacomments a{ color:' + $color + ';}';
            $style += '.bdp_blog_template .tags a,.bdp_blog_template .categories a,.bdp_blog_template .category-link a { color:' + $color + ';}';
            $style += '.bdp_blog_template.box-template .blog_header .post-title{ background:' + $titlebackcolor + ';}';
            $style += '.blog_template .social-component a { border-color:' + $color + ' !important;color: ' + $color + ' !important;}';
            $style += '.social-component a > i{ line-height: inherit;  }';
            $style += 'audio,source { visibility: visible !important; }';
            $style += '.bdp_blog_template .post_content_wrap, .bdp_blog_template .post_content, .bdp_blog_template .post_summary_outer, .bdp_blog_template .post_hentry, .bdp_blog_template .blog_footer{font-family:' + $content_font_family + ';}';
            var $bdp_theme = $bdp_template_name;
            if ($bdp_theme == 'lightbreeze') {
                $style += '.blog_template .blog_header h2{font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template .blog_header h2{font-style: italic }';
                }
                $style += '.blog_template.lightbreeze,.bdp_archive.lightbreeze .author-avatar-div { background:' + $background + '; }';
                $style += '.blog_template.lightbreeze .blog_header h2 {background:' + $titlebackcolor + '; color:' + $titlecolor + ';font-size: ' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.lightbreeze .blog_header h2{ font-style: italic }';
                }
                $style += '.blog_template.lightbreeze .blog_header h2 a {color:' + $titlecolor + ';font-size: ' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + '; }';
                $style += '.blog_template.lightbreeze .blog_header h2 a:hover {color: ' + $titlehovercolor + ';}';
                $style += '.bdp_archive.lightbreeze .author-avatar-div .author_content .author{ color:' + $titlecolor + '; }';
                $style += '.bdp_blog_template .social-component a { color:' + $contentcolor + ';border-color: ' + $contentcolor + '; }';
                $style += '.bdp_blog_template .social-component .social-share .count{ border-color: ' + $contentcolor + '; }';
                $style += '.bdp_blog_template img { width: 100%; }';
                $style += '.bdp_blog_template .metadatabox,.bdp_blog_template .tags{ color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.lightbreeze a{ color: ' + $color + '; }';
                $style += '.bdp_blog_template.lightbreeze a:hover{ color: ' + $linkhovercolor + '; }';
                $style += '.blog_template.lightbreeze .read-more a, .bdp_blog_template.lightbreeze .label_featured_post { background-color: ' + $readmorebackcolor + ';color: ' + $readmorecolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.blog_template.lightbreeze .read-more a:hover{ background-color: ' + $readmorehoverbackcolor + ';box-shadow: 0 0 6px 0' + $readmorebackcolor + '; -webkit-box-shadow: 0 0 6px 0' + $readmorebackcolor + '; -moz-box-shadow: 0 0 6px 0' + $readmorebackcolor + ';}';
                $style += '.blog_template.lightbreeze .post_content p, .bdp_blog_template.lightbreeze .metadatabox .metauser, .bdp_blog_template.lightbreeze .metadatabox .metacats, .bdp_blog_template.lightbreeze .metadatabox .tags, .bdp_blog_template.lightbreeze .metadatabox .metadate, .bdp_blog_template.lightbreeze .metadatabox .metacomments, .bdp_blog_template.lightbreeze.category-main-wrap .category-list { color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.lightbreeze .metadatabox .metacats a {font-family: ' + $content_font_family + ';}';
                $style += '.blog_template.lightbreeze .post_content {font-size: ' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.lightbreeze .triangle_style .category-main:before, .bdp_blog_template.lightbreeze .triangle_style .category-main:after {border-bottom-color: ' + $background + ';}';
                $style += '.bdp_blog_template.lightbreeze.alternative-back .category-main:before, .bdp_blog_template.lightbreeze.alternative-back .category-main:after{  border-bottom-color: ' + $alterbackground + '; }';
                $style += '.bdp_blog_template.lightbreeze .category-main{  background: ' + $background + '; }';
                $style += '.bdp_blog_template.lightbreeze.alternative-back, .bdp_blog_template.lightbreeze.alternative-back .category-main {background: ' + $alterbackground + ';}';
                if ($firstletter_big == 1) {
                    $style += '.lightbreeze.bdp_blog_template div.post_content > *:first-child:first-letter, .lightbreeze.bdp_blog_template div.post_content > p:first-child:first-letter, .lightbreeze.bdp_blog_template .post_content:first-letter {font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; color: ' + $firstletter_contentcolor + '; float: none; margin-right:0; line-height: 0; }';
                    $style += '.lightbreeze.bdp_blog_template div.post_content {margin-top: ' + ($firstletter_fontsize / 2) + 'px;}';
                }
            }
            if ($bdp_theme == 'sharpen') {
                $style += '.blog_template .blog_header h2{font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template .blog_header h2{font-style: italic }';
                }
                $style += '.blog_template.sharpen,.bdp_archive.sharpen .author-avatar-div { background:' + $background + '; }';
                $style += '.blog_template.sharpen .blog_header h2 {background:' + $titlebackcolor + '; color:' + $titlecolor + ';font-size: ' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.sharpen .blog_header h2{ font-style: italic }';
                }
                $style += '.blog_template.sharpen .blog_header h2 a {color:' + $titlecolor + ';font-size: ' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + '; }';
                $style += '.blog_template.sharpen .blog_header h2 a:hover {color: ' + $titlehovercolor + ';}';
                $style += '.bdp_archive.sharpen .author-avatar-div .author_content .author{ color:' + $titlecolor + '; }';
                $style += '.bdp_blog_template .social-component a { color:' + $contentcolor + ';border-color: ' + $contentcolor + '; }';
                $style += '.bdp_blog_template .social-component .social-share .count{ border-color: ' + $contentcolor + '; }';
                $style += '.bdp_blog_template img { width: 100%; }';
                $style += '.bdp_blog_template .metadatabox,.bdp_blog_template .tags{ color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.sharpen .metadatabox .metauser.bdp_has_links, .bdp_blog_template.sharpen .category-list.bdp_has_links, .bdp_blog_template.sharpen .metadatabox .tags.bdp_has_links, .bdp_blog_template.sharpen a{ color: ' + $color + '; }';
                $style += '.bdp_blog_template.sharpen a:hover{ color: ' + $linkhovercolor + '; }';
                $style += '.blog_template.sharpen .read-more a, .bdp_blog_template.blog_template.sharpen .label_featured_post { background-color: ' + $readmorebackcolor + ';color: ' + $readmorecolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.blog_template.sharpen .read-more a:hover{ background-color: ' + $readmorehoverbackcolor + ';}';
                $style += '.blog_template.sharpen .post_content p, .bdp_blog_template.sharpen .metadatabox .metauser .link-lable, .bdp_blog_template.sharpen .metadatabox .metauser, .bdp_blog_template.sharpen .metadatabox .metacats, .bdp_blog_template.sharpen .metadatabox .tags, .bdp_blog_template.sharpen .metadatabox .metadate, .bdp_blog_template.sharpen .metadatabox .metacomments, .bdp_blog_template.sharpen .metadatabox .category-link, .bdp_blog_template.sharpen.category-main-wrap .category-list { color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.sharpen .metadatabox .tags i { color: ' + $contentcolor + ';}';
                $style += '.bdp_blog_template.sharpen .metadatabox .metacats a {font-family: ' + $content_font_family + ';}';
                $style += '.blog_template.sharpen .post_content {font-size: ' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.sharpen .triangle_style .category-main:before, .bdp_blog_template.sharpen .triangle_style .category-main:after {border-bottom-color: ' + $background + ';}';
                $style += '.bdp_blog_template.sharpen.alternative-back .category-main:before, .bdp_blog_template.sharpen.alternative-back .category-main:after{  border-bottom-color: ' + $alterbackground + '; }';
                $style += '.bdp_blog_template.sharpen .category-main{  background: ' + $background + '; }';
                $style += '.bdp_blog_template.sharpen.alternative-back, .bdp_blog_template.sharpen.alternative-back .category-main {background: ' + $alterbackground + ';}';
                if ($firstletter_big == 1) {
                    $style += '.sharpen.bdp_blog_template div.post_content > *:first-child:first-letter, .sharpen.bdp_blog_template div.post_content > p:first-child:first-letter, .sharpen.bdp_blog_template .post_content:first-letter {font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; color: ' + $firstletter_contentcolor + '; float: none; margin-right:0; line-height: 0; }';
                    $style += '.sharpen.bdp_blog_template div.post_content {margin-top: ' + ($firstletter_fontsize / 2) + 'px;}';
                }
            }
            if ($bdp_theme == 'classical') {
                $style += '.bdp_blog_template.classical .entry-meta .up_arrow::after{ border-color:  rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) ' + $templatecolor + '; }';
                $style += '.bdp_archive.classical .author-avatar-div,.bdp_blog_template.classical .entry-meta, .bdp_blog_template.classical,.bdp_blog_template.classical .entry-container {background:  ' + $templatecolor + ';}';
                $style += '.bdp_blog_template.classical .blog_header h2 { font-size: ' + $template_titlefontsize + 'px;background: ' + $titlebackcolor + ';color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.classical .blog_header h2 { font-style: italic }';
                }
                $style += '.bdp_blog_template.classical .blog_header h2 a,.bdp_archive.classical .author-avatar-div .author_content .author { color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.classical .blog_header h2 a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.classical .post_content { font-size: ' + $content_fontsize + 'px; color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                if ($content_font_italic == 1) {
                    $style += '.bdp_blog_template.classical .blog_header h2 { font-style: italic }';
                }
                $style += '.bdp_blog_template.classical .entry-meta .read-more a { border-color:' + $readmorebackcolor + ';background: ' + $readmorebackcolor + ';color: ' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.classical .entry-meta .read-more a:hover {background: ' + $readmorehoverbackcolor + ';color: ' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.classical a,.bdp_blog_template.classical .metacomments a, .bdp_blog_template.classical .tags, .bdp_blog_template.classical .tags a,.bdp_archive .author-avatar-div .author_content .author a,.author-avatar-div.bdp_blog_template .social-component a{ color:' + $color + '; }';
                $style += '.bdp_blog_template .social-component a {color:' + $color + '; border-color:' + $color + ';}';
                $style += '.bdp_blog_template.classical span, .bdp_blog_template.classical a:hover, .bdp_archive .author-avatar-div .author_content .author a:hover {color:' + $linkhovercolor + ';}';
                $style += '.bdp_archive.classical .author_content p, .bdp_blog_template.classical .post-meta-cats-tags .category-link .link-lable, .bdp_blog_template.classical .post-meta-cats-tags .tags .link-lable, .bdp_blog_template.classical .metadatabox, .bdp_blog_template.classical p, .bdp_blog_template.classical .post-meta-cats-tags .category-link.categories_link, .bdp_blog_template.classical .post-meta-cats-tags .tags.tag_link { color: ' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.classical .post-meta-cats-tags .category-link, .bdp_blog_template.classical .post-meta-cats-tags .tags { color: ' + $color + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.classical span.bdp_no_link {color: ' + $contentcolor + '; }';
                $style += '.bdp_blog_template.classical .post-meta-cats-tags {border-color:' + $color + ';}';
                $style += '.bdp_blog_template.classical .read-more a, .bdp_blog_template.classical .label_featured_post {border-color:' + $readmorebackcolor + '; background:' + $readmorebackcolor + ';color: ' + $readmorecolor + ';}';
                $style += '.bdp_blog_template.classical .read-more a:hover {border-color:' + $readmorehoverbackcolor + '; background:' + $readmorehoverbackcolor + ';color: ' + $readmorecolor + ';}';
            }
            if ($bdp_theme == 'evolution') {
                $style += '.evolution .post-title a{ color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                $style += '.bdp_blog_template.evolution .post-title {background: ' + $titlebackcolor + ';}';
                $style += '.evolution .post-content-body{ font-size:' + $content_fontsize + 'px; }';
                $style += '.evolution .post-bottom a, .evolution.bdp_blog_template .label_featured_post { background:' + $readmorebackcolor + ';color: ' + $readmorecolor + '; }';
                $style += '.evolution .post-bottom a:hover{ background:' + $readmorehoverbackcolor + '; }';
                $style += '.evolution .post-content-body p, .evolution.bdp_blog_template .author.bdp_no_links, .evolution.bdp_blog_template .author .link-lable, .evolution.bdp_blog_template .date, .evolution.bdp_blog_template .comment, .evolution.bdp_blog_template .tags.bdp_no_links, .evolution.bdp_blog_template .post-category.bdp_no_links, .evolution.bdp_blog_template .bdp-wrapper-like { color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.evolution.bdp_blog_template .tags a, .evolution.bdp_blog_template .post-category a {font-family: ' + $content_font_family + ';}'
                $style += '.evolution.bdp_blog_template .author, .evolution.bdp_blog_template .tags, .evolution.bdp_blog_template .post-category { color: ' + $color + '; }';
                $style += '.evolution .post-category a:hover, .evolution .author a:hover, .evolution .icon_cnt a:hover,.evolution .number-date a:hover { color: ' + $linkhovercolor + '; }';
                $style += '.evolution .blog_header{ background: ' + $background + '; }';
                $style += '.evolution .blog_header h2 a{ color: ' + $color + ';font-family: ' + $template_titlefontface + '; }';
                $style += '.evolution .post-title{ background: ' + $titlebackcolor + '; }';
                $style += '.evolution .blog_header .title .metadate a, .evolution .blog_header .title .metadate span.author, .evolution .blog_header .title .metadate span.time, .evolution .post-bottom .categories, .evolution .post-bottom .categories a, .evolution .post-category a,.evolution .icon_cnt a, .evolution .author a,.evolution .number-date a { color: ' + $color + '; }';
                $style += '.evolution.bdp_blog_template,.bdp_archive.evolution .author-avatar-div{ background: ' + $background + '; }';
                $style += '.bdp_archive.evolution .author-avatar-div .author_content .author{ color: ' + $titlecolor + '; }';
                $style += '.bdp_archive.evolution .author-avatar-div:before,.bdp_archive.evolution .author-avatar-div:after{ background: ' + $contentcolor + '; }';
            }
            if ($bdp_theme == 'spektrum') {
                $style += '.blog_template.bdp_blog_template.spektrum{ background: ' + $background + '; }';
                $style += '.spektrum .post_content{ color: ' + $contentcolor + ';font-size:' + $content_fontsize + 'px; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.spektrum .post-bottom {color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.spektrum .blog_header h2 a{ color: ' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_blog_template.spektrum .blog_header h2{ background: ' + $titlebackcolor + ';display: inline; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.spektrum .blog_header h2{ font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.spektrum .bdp-post-image .overlay a { font-size:' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                $style += '.post-bottom span { font-size:' + $content_fontsize + 'px; }';
                $style += '.spektrum .post-meta-div > span .link-lable { color: ' + $contentcolor + '; }';
                $style += '.spektrum .post-meta-div > span, .spektrum .post-meta-div > span a, .spektrum .meta_tags span a {color: ' + $color + ';}';
                $style += '.spektrum .post-meta-div > span a:hover, .spektrum .meta_tags span a:hover { color: ' + $linkhovercolor + '; }';
                $style += '.spektrum .details a { color: ' + $readmorecolor + '; }';
                $style += '.spektrum .details a:hover{ color: ' + $readmorebackcolor + '; }';
                $style += '.bdp_blog_template.spektrum a.more-tag, .bdp_blog_template.spektrum .label_featured_post { color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.spektrum a.more-tag:focus, .bdp_blog_template.spektrum a.more-tag:hover {background: ' + $readmorehoverbackcolor + ';}';
                $style += '.spektrum .bdp-post-image{width:100%;}';
                $style += '.bdp_blog_template.spektrum .date { background: ' + $titlecolor + ';color: #ffffff;}';
                $style += '.bdp_archive .author-avatar-div .author_content .author {color: ' + $titlecolor + ';}';
                $style += '.wl_pagination_box .wl_pagination span, .wl_pagination_box .wl_pagination a{ color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; }';
                $style += '.wl_pagination_box .wl_pagination span.current, .wl_pagination_box .wl_pagination a:hover{ color: ' + $background + ';background: ' + $color + '; }';
            }
            if ($bdp_theme == 'hub') {
                $style += '.blog_template.bdp_blog_template.hub{ background: ' + $background + '; }';
                $style += '.hub .post_content{ color: ' + $contentcolor + ';font-size:' + $content_fontsize + 'px; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.hub .post-bottom {color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.hub .blog_header h2 a{ color: ' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_blog_template.hub .blog_header h2{ background: ' + $titlebackcolor + ';display: inline; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.hub .blog_header h2{ font-style: italic }';
                }
                $style += '.bdp_archive .author-avatar-div .author_content .author {color: ' + $titlecolor + ';}';
                $style += '.post-bottom span { font-size:' + $content_fontsize + 'px; }';
                $style += '.hub .meta_tags span a {color: ' + $color + ';}';
                $style += '.hub .meta_tags span a:hover ,.bdp_blog_template.hub a.date:hover {color: ' + $linkhovercolor + ';}';
                $style += '.bdp_blog_template.hub a.more-tag, .hub .label_featured_post { color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.hub a.more-tag:hover{ background: ' + $readmorehoverbackcolor + ';}';
                $style += '.wl_pagination_box .wl_pagination span, .wl_pagination_box .wl_pagination a{ color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; }';
                $style += '.wl_pagination_box .wl_pagination span.current, .wl_pagination_box .wl_pagination a:hover{ color: ' + $background + ';background: ' + $color + '; }';
                $style += '.hub .bdp-post-image{width:100%;}';
                $style += '.bdp_archive.hub .author-avatar-div{ background: ' + $background + '; }'
                if (jQuery('#date_color_of_readmore').attr('checked')) {
                    $style += '.bdp_blog_template.hub a.date { color: ' + $color + '; font-family: ' + $content_font_family + ';}';
                } else {
                    $style += '.bdp_blog_template.hub .date , .hub .number-date { background: #212121;color: #ffffff; font-family: ' + $content_font_family + ';}';
                }
            }
            if ($bdp_theme == 'offer_blog') {
                $style += '.blog_template.offer_blog.bdp_blog_template,.bdp_archive.offer_blog .author-avatar-div{ background: ' + $background + '; }';
                $style += '.bdp_blog_template.offer_blog .post_content { color: ' + $contentcolor + '; font-size:' + $content_fontsize + 'px;}';
                $style += '.offer_blog.bdp_blog_template, .offer_blog.bdp_blog_template .date, .offer_blog.bdp_blog_template .tags, .offer_blog .post-entry-meta {color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.offer_blog .blog-title-meta h2 a { color: ' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive.offer_blog .author-avatar-div .author_content .author { color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.offer_blog h2 a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.offer_blog h2{ display: inline-block;background:' + $titlebackcolor + ';font-size: ' + $template_titlefontsize + 'px;font-family:' + $template_titlefontface + ';color:' + $titlecolor + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.offer_blog h2{ font-style: italic }';
                }
                $style += '.offer_blog.bdp_blog_template span.author, .offer_blog.bdp_blog_template span.author i, .bdp_blog_template.offer_blog .post-category, .bdp_blog_template.offer_blog .post-category i, .bdp_blog_template.offer_blog .post-category .link-lable { color: ' + $contentcolor + ' }';
                $style += '.offer_blog.bdp_blog_template span.author.bdp_has_links, .bdp_blog_template.offer_blog .post-category.bdp_has_links, .bdp_blog_template.offer_blog .post-by span, .bdp_blog_template.offer_blog .post-category a ,.bdp_blog_template.offer_blog .comment a ,.post-entry-meta a , .post_content a {color: ' + $color + ';}';
                $style += '.bdp_blog_template.offer_blog .post-category a:hover ,.bdp_blog_template.offer_blog .comment a:hover { color: ' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.offer_blog .post-bottom a, .offer_blog .middle-title .label_featured_post { border:1px solid ' + $readmorebackcolor + ';color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; }';
                $style += '.bdp_blog_template.offer_blog .post-bottom a:hover{ background: ' + $readmorehoverbackcolor + '; }';
            }
            if ($bdp_theme == 'nicy') {
                $style += '.bdp_blog_template.nicy .entry-meta .up_arrow::after{ border-color:  rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) ' + $templatecolor + '; }';
                $style += '.bdp_archive.nicy .author-avatar-div,.bdp_blog_template.nicy .entry-meta, .bdp_blog_template.nicy,.bdp_blog_template.nicy .entry-container {background:  ' + $templatecolor + ';}';
                $style += '.bdp_blog_template.nicy .blog_header h2 { font-size: ' + $template_titlefontsize + 'px;background: ' + $titlebackcolor + ';color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.nicy .blog_header h2 { font-style: italic }';
                }
                $style += '.bdp_blog_template.nicy .blog_header h2 a,.bdp_archive.nicy .author-avatar-div .author_content .author { color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.nicy .blog_header h2 a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.nicy .post_content { font-size: ' + $content_fontsize + 'px; color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                if ($content_font_italic == 1) {
                    $style += '.bdp_blog_template.nicy .blog_header h2 { font-style: italic }';
                }
                $style += '.bdp_archive.nicy .author_content p, .bdp_blog_template.nicy .post-meta-cats-tags .tags, .bdp_blog_template.nicy .post-meta-cats-tags .tags .link-lable, .bdp_blog_template.nicy .post-meta-cats-tags .category-link,.bdp_blog_template.nicy .post-meta-cats-tags .category-link .link-lable, .bdp_blog_template.nicy p, .bdp_blog_template.nicy .metadatabox{ color: ' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.nicy .post-meta-cats-tags { border-left: 10px solid  ' + $color + '; }';
                $style += '.bdp_blog_template.nicy .entry-meta .read-more a, .bdp_blog_template.nicy .label_featured_post { border-color:' + $readmorebackcolor + ';background: ' + $readmorebackcolor + ';color: ' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.nicy .entry-meta .read-more a:hover {background: ' + $readmorehoverbackcolor + '; }';
                $style += '.bdp_blog_template.nicy .post_author.bdp_has_links, .bdp_blog_template.nicy .post-meta-cats-tags .tags.bdp_has_links, .bdp_blog_template.nicy .post-meta-cats-tags .category-link.bdp_has_links, .bdp_blog_template.nicy a,.bdp_archive .author-avatar-div .author_content .author a,.author-avatar-div.bdp_blog_template .social-component a{ color:' + $color + '; }';
                $style += '.bdp_blog_template .social-component a {color:' + $color + '; border-color:' + $color + ';}';
                $style += '.bdp_blog_template.nicy a:hover, .bdp_archive .author-avatar-div .author_content .author a:hover {color:' + $linkhovercolor + ';}';
            }
            if ($bdp_theme == 'winter') {
                var $winter_category = jQuery('#winter_category_color').iris('color');
                $style += '.winter, .bdp_archive.winter .author-avatar-div { background-color: ' + $background + ';}';
                $style += '.winter a, .winter .tags.bdp_has_links, .blog_header .metadatabox .posted_by, .winter .blog_header .metadatabox div.tags a, .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button span, .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button { color: ' + $color + '; }';
                $style += '.winter a:hover, .winter .blog_header .metadatabox > span, .winter .blog_header .metadatabox div.tags a:hover, .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button:hover span,.blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button:hover { color: ' + $linkhovercolor + '; }';
                $style += '.winter .date { color: ' + $background + ';}';
                $style += '.winter .bdp-post-image .category-link a {font-family: ' + $content_font_family + ';}';
                $style += '.winter .post_content p, .blog_header .metadatabox .posted_by span.auther-inner, .winter .datetime, .winter .tags, .winter .category-link, .blog_template.bdp_blog_template.winter .posted_by span, .winter .blog_header .metadatabox > span{ color: ' + $contentcolor + ';font-size:' + $content_fontsize + 'px; font-family: ' + $content_font_family + ';}';
                $style += '.winter .metacomments i,{ color: ' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.winter .blog_header h2 a{ color: ' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px;font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive.winter .author-avatar-div .author_content .author {color: ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.winter .blog_header h2{ background: ' + $titlebackcolor + ';display: inline-block; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.winter .blog_header h2 { font-style: italic }';
                }
                $style += '.winter .number-date { color: ' + $background + '; }';
                $style += '.winter .post-bottom .post-by span, .blog_header .metadatabox .posted_by span.auther-inner a, .winter .post-bottom .categories a, .bdp_blog_template.winter .metacomments a { color: ' + $color + '; }';
                $style += '.winter .details a { color: ' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.winter a.more-tag{ color: ' + $readmorecolor + ';background:' + $readmorebackcolor + '; }';
                $style += '.bdp_blog_template.winter a.more-tag:hover{ background:' + $readmorehoverbackcolor + '; }';
                $style += '.blog_template.bdp_blog_template.winter { border-bottom: 3px solid;border-color: ' + $winter_category + '; }';
                $style += '.bdp_blog_template.winter .metacomments a:hover {color: ' + $linkhovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.winter .posted_by span,.blog_template.bdp_blog_template.winter .metacomments span,.blog_template.bdp_blog_template.winter .metacomments{ color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                if ($winter_category) {
                    $style += '.winter .label_featured_post, .winter .bdp-post-image .category-link{ background-color : ' + $winter_category + '; }';
                    $style += '.winter .label_featured_post:before, .winter .bdp-post-image .category-link:before{ border-right: 10px solid ' + $winter_category + ';opacity: 0.65; }';
                }
            }
            if ($bdp_theme == 'region') {
                $style += '.blog_template.bdp_blog_template.region, .blog_template.bdp_blog_template.region .blog_footer, .bdp_archive.region .author-avatar-div { background:' + $background + ';}';
                $style += '.blog_template.bdp_blog_template.region.alternative-back, .blog_template.bdp_blog_template.region.alternative-back .blog_footer { background:' + $alterbackground + ';}';
                $style += '.region .date, .region .number-date { color:' + $background + ';}';
                $style += '.region .post_content{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.region .category-link, .region .category-link .link-lable, .region .tags, .region .tags .link-lable, .region .posted_by, .region .posted_by .author-meta, .region .posted_by .author-meta .link-lable, .bdp_archive.region .author-avatar-div .author_content p, .region .metadatabox .article_comments, .region .metadatabox .bdp-wrapper-like { color:' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.region .blog_header h2 a{ color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive.region .author-avatar-div .author_content .author { color:' + $titlecolor + '; }'
                $style += '.region .blog_header h2 a:hover{ color:' + $titlehovercolor + ';}';
                $style += '.bdp_blog_template.region .blog_header h2{ display: inline-block;background:' + $titlebackcolor + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.region .blog_header h2 { font-style: italic }';
                }
                $style += '.region .category-link.bdp_has_links, .region .tags.bdp_has_links, .region .posted_by .author-meta.bdp_has_links, .region .post-bottom .post-by span, .region .post-bottom .categories a,.region .category-link a, .region .tags a,.region .posted_by a {color:' + $color + '}';
                $style += '.region .post-bottom .categories a:hover,.region .category-link a:hover, .region .tags a:hover,.region .posted_by a:hover,.bdp_blog_template .metacomments a:hover{ color:' + $linkhovercolor + ';}';
                $style += '.region .details a { color :' + $readmorecolor + ';}';
                $style += '.bdp_blog_template.region a.more-tag, .blog_template.bdp_blog_template.region .label_featured_post { background:' + $readmorebackcolor + ';color:' + $readmorecolor + ';border: 1px solid ' + $readmorecolor + '; transition: 0.2s all; -ms-transition: 0.2s all;-o-transition: 0.2s all; -webkit-transition: 0.2s all;}';
                $style += '.bdp_blog_template.region a.more-tag:hover {background: ' + $readmorehoverbackcolor + '; border: 1px solid ' + $readmorehoverbackcolor + '; }';
                $style += '.bdp_blog_template.region .bdp-post-image{ padding: 0 40px; }';
            }
            if ($bdp_theme == 'glossary') {
                var $template_content_hovercolor = jQuery('#template_content_hovercolor').iris('color');
                $style += '.blog_template.glossary .blog_item,.bdp_archive.glossary .author-avatar-div { background:' + $background + '; }';
                $style += '.glossary .post_content p{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.glossary .blog_header h2 a,.bdp_archive .author-avatar-div .author_content .author{ color:' + $titlecolor + ';}';
                $style += '.bdp_blog_template.glossary .blog_header h2{ display: inline-block;background:' + $titlebackcolor + ';font-size: ' + $template_titlefontsize + 'px;font-family:' + $template_titlefontface + ';color:' + $titlecolor + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.glossary .blog_header h2{ font-style: italic }';
                }
                $style += '.glossary .footer_meta { font-size:' + $content_fontsize + 'px }';
                $style += '.glossary .blog_header h2 a:hover{ color:' + $titlehovercolor + ';}';
                $style += '.glossary .number-date { color:' + $background + ';}';
                $style += '.glossary .post-bottom .post-by span, .glossary .footer_meta .category-link a,.glossary .footer_meta .tags a,.glossary .post-author a, .glossary .comment a,.glossary .posted_by a, .glossary .bdp_blog_template .social-component a, .glossary .posted_by a .datetime, .glossary .blog_header h2 .label_featured_post { color:' + $color + ';}';
                $style += '.glossary .details a { color:' + $readmorecolor + ';}';
                $style += '.bdp_blog_template.glossary a.more-tag{ color:' + $readmorecolor + ';background: ' + $readmorebackcolor + '; opacity: 0.9;}';
                $style += '.bdp_blog_template.glossary a.more-tag:hover{ background: ' + $readmorehoverbackcolor + '; }';
                $style += '.glossary .post_content-inner, .glossary .blog_header h2 .label_featured_post {border-left: 4px solid ' + $template_content_hovercolor + '; }';
                $style += '.bdp-load-more a.button.bdp-load-more-btn { border-color: ' + $readmorebackcolor + '; }';
                $style += '.glossary .footer_meta .category-link,.glossary .footer_meta .tags,.glossary .posted_by .post-author{ color: ' + $contentcolor + '; }';
                $style += '.glossary .footer_meta .category-link a:hover,.glossary .footer_meta .tags a:hover,.glossary .post-author a:hover,.glossary .comment a:hover,.glossary .posted_by a:hover, .glossary .posted_by a:hover .datetime  { color: ' + $linkhovercolor + '; }';
                $style += '.glossary .comment { color:' + $contentcolor + ';}';
                if ($firstletter_big == 1) {
                    $style += '.glossary div.post-content .post_content-inner > *:first-child:first-letter, .glossary div.post-content .post_content-inner > p:first-child:first-letter, .glossary div.post-content .post_content-inner:first-letter, .glossary div.post_content .post_content-inner > *:first-child:first-letter, .glossary div.post_content .post_content-inner > p:first-child:first-letter {font-family: ' + $firstletter_font_family + '; font-size:' + $firstletter_fontsize + 'px; color:' + $firstletter_contentcolor + '; float:left; margin-right:5px;}'
                }
            }
            if ($bdp_theme == 'boxy') {
                $style += '.blog_template.boxy .author-avatar-div, .blog_template.boxy .post_hentry, .boxy .label_featured_post span{ background:' + $background + '; }';
                $style += '.boxy .post_content p, .post_content-inner { color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.boxy .blog_header h2 a{ color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';padding: 0; }';
                $style += '.bdp_blog_template.boxy .blog_header h2{ display: inline-block;background:' + $titlebackcolor + ';color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px;font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.boxy .blog_header h2{ font-style: italic }';
                }
                $style += '.boxy .number-date { color:' + $background + '; }';
                $style += '.boxy .post-bottom .post-by span, .boxy .footer_meta .category-link a,.bdp_blog_template.boxy .post-category span.category-link a, .boxy .author a, .boxy .post-metadata > span.author, .boxy .post-metadata > span a.comments-link, .bdp_archive .author-avatar-div .author_content .author a, .boxy .post-metadata .post-date a, .bdp_blog_template.boxy .social-component a, .bdp_blog_template .blog_footer .footer_meta .tags a, .post-metadata span.author a, .post-metadata > span.post-date a, .post-metadata .post-comment a  { color:' + $color + ';}';
                $style += '.bdp_blog_template .category-link a:hover, .bdp_blog_template .tags a:hover, .boxy .footer_meta .category-link a:hover,.bdp_blog_template.boxy .post-category span.category-link a:hover, .boxy .footer_meta .category-link a:hover, .boxy .author a:hover, .boxy .post-metadata > span a.comments-link:hover, .bdp_archive .author-avatar-div .author_content .author a:hover, .boxy .post-metadata .post-date a:hover, .boxy .post-date a:hover span, .bdp_blog_template .blog_footer .footer_meta .tags a:hover { color:' + $linkhovercolor + ';}';
                $style += '.boxy .blog_header h2 a:hover{ color:' + $titlehovercolor + ';}';
                $style += '.bdp_blog_template.boxy a.more-tag, .bdp_blog_template.boxy a.more-tag i { color:' + $readmorecolor + ';background:' + $readmorebackcolor + '; border-color:#ffffff;}';
                $style += '.bdp_blog_template.boxy a.more-tag:hover, .bdp_blog_template.boxy a.more-tag:hover i { background:' + $readmorehoverbackcolor + ';}';
                $style += '.blog_template.boxy .footer_meta .tags a, .bdp_blog_template.boxy .post-category span.category-link a {font-size:' + $content_fontsize + 'px;}';
                $style += '.blog_template.boxy .footer_meta .tags, .bdp_blog_template.boxy .post-category span.category-link { font-size: ' + $content_fontsize + 'px;color: ' + $color + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.blog_template.boxy .footer_meta .tags .link-lable, .bdp_blog_template.boxy .post-category span.category-link.categories_link, .blog_template.boxy .footer_meta .tags.tag_link {color: ' + $contentcolor + ';}';
                if ($content_font_italic == 1) {
                    $style += '.blog_template.boxy .footer_meta .tags, .bdp_blog_template.boxy .post-category span.category-link { font-style: italic }';
                }
                $style += '.boxy .post-metadata > span.bdp-no-kink { color: #fff; }';
            }
            if ($bdp_theme == 'boxy-clean') {
                $style += '.blog_template.boxy-clean ul li,.bdp_archive.boxy-clean .author-avatar-div { background:' + $background + '; }';
                $style += '.blog_template.boxy-clean ul li:hover, .bdp_archive.boxy-clean .author-avatar-div:hover, .blog_template.boxy-clean ul li:hover .blog_header h2{ background:' + $template_bghovercolor + '; }';
                $style += '.boxy-clean .date , .boxy-clean .number-date { color:' + $background + '; }';
                $style += '.boxy-clean .footer_meta .tags a:hover, .boxy-clean .footer_meta .category-link a, .boxy-clean .post-bottom .post-by span, .boxy-clean a{ color:' + $color + '; }';
                $style += '.boxy-clean .post_content p{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.boxy-clean .blog_header h2{ background:' + $titlebackcolor + '; display: inline-block; font-size:' + $template_titlefontsize + 'px; font-family:' + $template_titlefontface + ';color:' + $titlecolor + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.boxy-clean .blog_header h2{ font-style: italic }';
                }
                $style += '.boxy-clean .blog_header h2 a{ color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive.blog_template.boxy-clean .author_content .author { color:' + $titlecolor + '; }';
                $style += '.boxy-clean .blog_header h2 a:hover {color: ' + $titlehovercolor + '; }';
                $style += '.boxy-clean .footer_meta .category-link a:hover {color: ' + $linkhovercolor + '; }';
                $style += '.blog_template.boxy-clean .blog_wrap.bdp_blog_template .author, .blog_template.boxy-clean .label_featured_post span { background:' + $templatecolor + '; }';
                $style += '.blog_template.boxy-clean .blog_wrap.bdp_blog_template .author:hover { background:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.boxy-clean .blog_header h2 {display: inline-block;}';
                $style += '.boxy-clean .details a { color:' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.boxy-clean a.more-tag{ color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; }';
                $style += '.blog_template.boxy-clean .read-more a.more-tag{ color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + '; }';
                $style += '.blog_template.boxy-clean .read-more a.more-tag:hover{ background: ' + $readmorehoverbackcolor + '; }';
                $style += '.blog_template.boxy-clean .tags, .blog_template.boxy-clean .category-link { color: ' + $color + '; }';
                $style += '.blog_template.boxy-clean .tags .link-lable, .blog_template.boxy-clean .category-link .link-lable, .blog_template.boxy-clean .tags.tag_link, .blog_template.boxy-clean .category-link.categories_link { color: ' + $contentcolor + '; }';
            }
            if ($bdp_theme == 'news') {
                $style += '.news.bdp_blog_template, .bdp_archive.news ul.nav-tabs li.active, .bdp_archive.news .tab-content { background:' + $background + '; }';
                $style += '.news.bdp_blog_template a span, .news.bdp_blog_template a { color:' + $color + '; }';
                $style += '.news.bdp_blog_template a span:hover, .news.bdp_blog_template a:hover { color:' + $linkhovercolor + '; }';
                $style += '.news.bdp_blog_template h2{ font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.news.bdp_blog_template h2{ font-style: italic }';
                }
                $style += '.news.bdp_blog_template h2 a{ color:' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';background: ' + $titlebackcolor + ';}';
                $style += '.bdp_archive.news .author-avatar-div .author_content span.author, .bdp_archive.news .author_div li.active {color:' + $titlecolor + ';}'
                $style += '.news.bdp_blog_template h2 a:hover{ color: ' + $titlehovercolor + '; }';
                $style += '.news.bdp_blog_template.alternative-back{ background: ' + $alterbackground + '; }';
                $style += '.news .post-content{ font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.news.bdp_blog_template .post-bottom a:hover{ background:' + $readmorehoverbackcolor + ';}';
                $style += '.news.bdp_blog_template .post-bottom a, .bdp_blog_template.news .post-thumbnail-div .label_featured_post { background:' + $readmorebackcolor + ';color:' + $readmorecolor + ';padding:5px 15px;border:none;}';
                $style += '.news .post-category, .news .tags,.news .metacomments {color: ' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.news .post-category i, .news .tags i, .news .mdate, .news .post-author { color: ' + $contentcolor + '; }';
                $style += '.news .mdate, .news .post-author, .news .metacomments, .news.bdp_blog_template .post-bottom a { font-family: ' + $content_font_family + '; }';
                $style += '.news .post-author.bdp_has_links, .bdp_blog_template.news .metacomments a, .deport .metadatabox a span.bdp-count, .bdp_blog_template.news .tags a, .news .tags.bdp_has_link, .news .post-category.bdp_has_link, .bdp_blog_template.news .categories a, .bdp_blog_template .category-link a { color:' + $color + '; }';
            }
            if ($bdp_theme == 'deport') {
                $style += '.deport a{ color:' + $color + '; box-shadow:none;}';
                $style += '.deport .deport-wrap .deport-title-area .post-title, .deport .deport-wrap .deport-title-area .post-title a { background:' + $titlebackcolor + ';color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive.deport .author-avatar-div .author_content .author {color:' + $titlecolor + ';}';
                $style += '.deport .deport-wrap .deport-title-area .post-title a:hover {color:' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.deport .tags a {color: ' + $color + ';}';
                $style += '.bdp_blog_template.deport .tags a:hover {color: ' + $linkhovercolor + ';}';
                $style += '.deport .metadatabox span, .deport .post_content,.bdp_archive.deport .author-avatar-div .author_content > p{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.deport .metadatabox span.tags i, .deport .metadatabox span.tags.tag_link {color:' + $contentcolor + ';}';
                $style += '.deport .metadatabox span.tags {color:' + $color + ';}';
                $style += '.deport.bdp_blog_template .read-more-div a:hover{ background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + ';}';
                $style += '.deport.bdp_blog_template .read-more-div a, .bdp_blog_template.deport .label_featured_post{ background:' + $readmorebackcolor + ';color:' + $readmorecolor + ';}';
                $style += '.deport .deport-wrap .deport-title-area::after {background: ' + jQuery('#deport_dashcolor').iris('color') + ' !important;}';
                $style += '.bdp_blog_template.deport .deport-title-area { font-family: ' + $content_font_family + '; }';
                $style += '.deport.even_class .post_content::first-letter {font-size: ' + $firstletter_fontsize + 'px;}';
            }
            if ($bdp_theme == 'navia') {
                $style += '.bdp_blog_template.navia,.bdp_archive.navia .author-avatar-div { background:' + $background + '; }';
                $style += '.navia .navia-content-wrap span.metacomments a:hover{ color:' + $linkhovercolor + '; }';
                $style += '.navia a{ color:' + $color + '; }';
                $style += '.navia .post-title { background:' + $titlebackcolor + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.navia .post-title { font-style: italic }';
                }
                $style += '.navia .post-title a{ font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';color: ' + $titlecolor + ';}';
                $style += '.navia .post_content ,.bdp_archive .navia .post_content {color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px; font-family: ' + $content_font_family + ';}';
                $style += '.navia .more-tag{ background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; }';
                $style += '.bdp_archive.navia .author-avatar-div .author_content .author {color:' + $titlecolor + ';}';
                $style += '.navia.bdp_blog_template .mdate {font-family: ' + $content_font_family + ';}';
                $style += '.blog_template.navia .post-metadata, .blog_template.navia .post-content-area .tags.bdp_no_links, .navia .navia-content-wrap .post-metadata .bdp_no_links, .blog_template.navia .post-content-area .tags i, .bdp_blog_template.navia .bdp-post-image {color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.navia .navia-content-wrap .post-metadata .bdp_has_links, .blog_template.navia .post-content-area .tags { color:' + $color + '; }';
                $style += '.bdp_blog_template.navia .post_content a.more-tag, .bdp_blog_template.navia .bdp-post-image .label_featured_post { background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; border-color:' + $readmorebackcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                $style += '.bdp_blog_template.navia .post_content a.more-tag:hover { background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + '; border-color:' + $readmorehoverbackcolor + ';}';
                if ($firstletter_big == 1) {
                    $style += '.navia.bdp_blog_template div.post_content > *:first-child:first-letter, .navia.bdp_blog_template .post_content:first-letter {font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; color: ' + $firstletter_contentcolor + '; float: none; margin-right:0; line-height: 0; }';
                    $style += '.navia.bdp_blog_template div.post_content {margin-top: ' + ($firstletter_fontsize / 2) + 'px;}';
                }
            }
            if ($bdp_theme == 'invert-grid') {
                $style += '.bdp_blog_template.invert-grid .tags, .bdp_blog_template.invert-grid .post-author, .bdp_blog_template.invert-grid a{ color:' + $color + '; }';
                $style += '.bdp_blog_template.invert-grid a:hover{ color:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.invert-grid .post-body-div h2 a {color: ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.invert-grid .post-body-div h2 a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.invert-grid .post-body-div h2{ background:' + $titlebackcolor + '; color: ' + $titlecolor + '; font-size: ' + $template_titlefontsize + 'px; font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += 'bdp_blog_template.invert-grid .post-body-div h2 {font-style: italic }';
                }
                $style += '.bdp_blog_template.invert-grid .metadatabox {color:' + $contentcolor + '; font-size:' + $content_fontsize + 'px; font-family: ' + $content_font_family + ';}';
                $style +- '.bdp_blog_template.invert-grid .post-author .link-lable, .bdp_blog_template.invert-grid .post-author.bdp_no_links, .bdp_blog_template.invert-grid .tags.bdp_no_links, .bdp_blog_template.invert-grid .tags i { color:' + $contentcolor + '; }';
                $style += '.bdp_blog_template.invert-grid .post_content{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.invert-grid .category-link a, .invert-grid .read-more > span {font-family: ' + $content_font_family + ';}';
                $style += '.invert-grid .read-more > span{ background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; }';
                $style += '.invert-grid .read-more > span:hover{ background:' + $readmorehoverbackcolor + '; }';
                $style += '.bdp_blog_template.invert-grid .category-link, .bdp_blog_template.invert-grid .label_featured_post { background: ' + $templatecolor + '; }';
                $style += '.bdp_single.invert-grid .metadatabox .mdate { background: ' + $templatecolor + '; }';
            }
            if ($bdp_theme == 'brit_co') {
                $style += '.bdp_blog_template.britco a,.bdp_archive .author-avatar-div .author_content .author a{ color:' + $color + '; }';
                $style += '.bdp_blog_template.britco a:hover,.bdp_blog_template.britco .post-category a:hover,.bdp_archive .author-avatar-div .author_content .author a:hover{ color:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.britco .comment a, .bdp_blog_template.britco .post-category a{ color:' + $color + '; }';
                $style += '.bdp_blog_template.britco .read_more_text a{ background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.britco .read_more_text a:hover{ background:' + $readmorecolor + '; color:' + $readmorebackcolor + '; }';
                $style += '.bdp_blog_template.britco:hover .bdp_blog_wraper, .bdp_blog_template.britco:hover .label_featured_post{ border-color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.britco .comment a:hover {color:' + $linkhovercolor + ';}';
                $style += '.bdp_blog_template.britco .content_wrapper h2.post-title{ background: ' + $titlebackcolor + '; }';
                $style += '.bdp_archive.brit_co .author_content .author, .bdp_blog_template.britco .label_featured_post { color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.britco .social-component a { color:' + $color + '; border-color:' + $color + ';}';
                $style += '.bdp_blog_template.britco .social-component .social-share .count{ color: ' + $color + '; }';
            }
            if ($bdp_theme == 'media-grid') {
                $style += '.media-grid-wrapper .media-grid:nth-child(' + $column_setting + 'n + 1) {clear: both;}';
                $style += '.bdp_blog_template.media-grid a { color:' + $color + '; }';
                $style += '.bdp_blog_template.media-grid a:hover, .bdp_blog_template.media-grid .category-link a:hover { color:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.media-grid .post-body-div h2.post-title a { font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';color: ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.media-grid .post-body-div h2.post-title a:hover, .bdp_blog_template.media-grid .post-body-div h2.post-title a:focus {color: ' + $titlehovercolor + ';}';
                $style += '.bdp_archive.media-grid .author_content .author {color: ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.media-grid .post-body-div h2.post-title{ background:' + $titlebackcolor + ';font-size: ' + $template_titlefontsize + 'px;font-family:' + $template_titlefontface + ';color:' + $titlecolor + '; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.media-grid .post-body-div h2.post-title{font-style: italic }';
                }
                $style += '.bdp_blog_template.media-grid .post_content{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.bdp_blog_template.media-grid .bdp-post-image .category-link a {font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.media-grid .read-more > a{ background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.media-grid .read-more > a:hover{ background:' + $readmorehoverbackcolor + '; }';
                $style += '.bdp_blog_template.media-grid .bdp-post-image .category-link, .bdp_blog_template.media-grid .bdp-post-image .label_featured_post{ background:' + $color + '; }';
                $style += '.bdp_blog_template.media-grid .metadatabox span.metacomments i{ color:' + $color + '; }';
                $style += '.bdp_archive.media-grid .author-avatar-div .avtar-img a::before{ background:' + $color + '; }';
                $style += '.bdp_blog_template.media-grid .metadatabox{ color:' + $contentcolor + '; font-family: ' + $content_font_family + ';}';
                $style += '.bdp_blog_template.media-grid .content-inner { background:' + $background + ';}';
            }
            if ($bdp_theme == 'timeline') {
                $style += '.post_wrapper.box-blog .label_featured_post, .timeline.blog-wrap .datetime, .timeline_bg_wrap:before { background: none repeat scroll 0 0 ' + $templatecolor + '; }';
                $style += '.timeline_year span.year_wrap { background: none repeat scroll 0 0 ' + $displaydate_backcolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .post_hentry:before, .blog_template.timeline .timeline_bg_wrap:before { background: ' + $templatecolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before, .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {border-left: 8px solid ' + $templatecolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before, .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {border-right: 8px solid ' + $templatecolor + '; }';
                $style += '.timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before, .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {border-right: 8px solid ' + $templatecolor + '; border-left: none;}';
                $style += '.timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before, .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {border-right: 8px solid ' + $templatecolor + ';}';
                $style += '.timeline_bg_wrap.right_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::before, .timeline_bg_wrap.right_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::after {border-left-color: ' + $templatecolor + ';}';
                $style += '.timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,.timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after { border-left: 8px solid ' + $templatecolor + '; border-left: none; }';
                $style += '.timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before, .timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after { border-left: 8px solid ' + $templatecolor + '; border-right: none; }';
                $style += '.timeline_bg_wrap.left_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::before, .timeline_bg_wrap.left_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::after { border-right-color: 8px solid ' + $templatecolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .post_content_wrap {  border: 1px solid ' + $templatecolor + ';background: ' + $background + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .post_content_wrap .blog_footer,.bdp_archive.timeline .author-avatar-div .avtar-img img.avatar { border-top: 1px solid ' + $templatecolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline .read_more a.btn-more, .blog_template.bdp_blog_template.timeline .label_featured_post { background:' + $readmorebackcolor + '; border-color: ' + $readmorebackcolor + '; color:' + $readmorecolor + '; }';
                $style += '.post-icon { background:' + $readmorebackcolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by.bdp_has_links, .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by a, .blog_template.bdp_blog_template.timeline.blog-wrap .categories.bdp_has_links, .blog_template.bdp_blog_template.timeline.blog-wrap .tags.bdp_has_links, .blog_template.bdp_blog_template.timeline.blog-wrap .tags a,.blog_template.bdp_blog_template.timeline.blog-wrap .categories a { color:' + $color + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by a:hover, .blog_template.bdp_blog_template.timeline.blog-wrap .tags a:hover,.blog_template.bdp_blog_template.timeline.blog-wrap .categories a:hover { color:' + $linkhovercolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline .desc h3 { font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';color: ' + $titlecolor + ';background: ' + $titlebackcolor + ';margin: 0; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.bdp_blog_template.timeline .desc h3{ font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.timeline .desc h3:hover a { color: ' + $titlehovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.timeline .desc h3 a{ color: ' + $titlecolor + ';font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_archive .author-avatar-div .author_content .author { color: ' + $titlecolor + '; }';
                $style += '.timeline a{ color: ' + $color + '; }';
                $style += '.timeline a:hover{ color: ' + $linkhovercolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by, .blog_template.bdp_blog_template.timeline.blog-wrap .tags, .blog_template.bdp_blog_template.timeline.blog-wrap .tags .link-lable, .blog_template.bdp_blog_template.timeline.blog-wrap .categories, .blog_template.bdp_blog_template.timeline.blog-wrap .categories .link-lable, .blog_template.bdp_blog_template.timeline .post_content{ color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px; }';
                $style += '.bdp_archive.timeline .author-avatar-div{ border: 1px solid ' + $templatecolor + ';background:' + $background + 'px; }';
                $style += '.blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by i, .blog_footer span,.date_wrap{ color: ' + $contentcolor + '; }';
                $style += '.blog_template.bdp_blog_template.timeline .read_more a.btn-more:hover{border: 1px solid ' + $readmorehoverbackcolor + '; background:' + $readmorehoverbackcolor + ';}';
            }
            if ($bdp_theme == 'cool_horizontal') {
                $style += '.horizontal .post-title {background: ' + $titlebackcolor + '; color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.horizontal .post-title { font-style: italic }';
                }
                $style += '.horizontal .post-title > a {color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + '; }';
                $style += '.horizontal .post-title > a:hover {color: ' + $titlehovercolor + ';}';
                $style += '.logbook.flatLine .lb-node-desc span, .logbook.flatLine a.lb-line-node:after, .logbook.flatLine .lb-item.lb-node-hover:before, #content .logbook.flatLine .lb-item.lb-node-hover:before, #content .logbook.flatLine .lb-node-desc span, #content .logbook.flatLine a.lb-line-node:after { background-color:' + $titlecolor + '; };';
                $style += '.logbook.flatLine a.lb-line-node.active:after, #content .logbook.flatLine a.lb-line-node.active:after { border-color: ' + $titlecolor + '; }';
                $style += '.logbook.flatLine .lb-item.lb-node-hover:after, #content .logbook.flatLine .lb-item.lb-node-hover:after { border-top-color: ' + $titlecolor + '; }'
                $style += '.logbook.flatLine a.lb-line-node.active, #content .logbook.flatLine a.lb-line-node.active { color: ' + $titlehovercolor + '; }';
                $style += '.horizontal .blog_footer .tags, .horizontal .blog_footer .categories {color: ' + $color + '; }';
                $style += '.horizontal .mauthor.bdp_no_link, .horizontal .bdp_no_link i, .horizontal .blog_footer .tags .link-lable, .horizontal .blog_footer .categories .link-lable {color: ' + $contentcolor + '; }';
                $style += '.horizontal a, .horizontal .post-title .mdate a, .horizontal .blog_footer .tags a, .horizontal .blog_footer .categories a {color: ' + $color + '; font-size: ' + $content_fontsize + ';}';
                $style += '.horizontal a:hover, .horizontal .post-title .mdate a:hover, .horizontal .blog_footer .tags a:hover, .horizontal .blog_footer .categories a:hover {color:' + $linkhovercolor + ';}';
                $style += '.horizontal .post-title .mdate a { font-family:' + $content_font_family + '; }';
                $style += '.mdate i, .mauthor i, .mcomments i, .tags i, .categories i { font-size: ' + $content_fontsize + 'px; }';
                $style += '.horizontal .post-title .mdate, .horizontal .metadatabox, .horizontal .blog_footer {color:' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.horizontal .post-content-area .post_content { color:' + $contentcolor + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.horizontal .read-more-div a.more-tag, .horizontal .label_featured_post span { background: ' + $readmorebackcolor + '; color: ' + $readmorecolor + '; border-color:' + $readmorecolor + ';}';
                $style += '.horizontal .read-more-div a.more-tag:hover {  background: ' + $readmorehoverbackcolor + ';}';
                $style += '#content .logbook .lb-node-desc > span:after {border-color: #dd5555 transparent transparent;}';
                $style += '.bdp_blog_template.horizontal .post_content, .bdp_blog_template.horizontal .post_content p { font-size: ' + $content_fontsize + 'px }';

                var logbook_css = plugin_path + '/css/logbook.css';
                var logbook_js = plugin_path + '/js/logbook.js';
                var easing_js = plugin_path + '/js/jquery.easing.js';

                jQuery('head').append('<script type="text/javascript" id="bdp-admin-logbook-js" src="' + logbook_js + '">');
                jQuery('head').append('<script type="text/javascript" id="bdp-admin-easing-js" src="' + easing_js + '">');
                jQuery('head').append('<link rel="stylesheet" id="bdp-admin-timeline-css" type="text/css" href="' + logbook_css + '">');

            }
            if ($bdp_theme == 'overlay_horizontal') {
                $style += '.overlay_horizontal .author-avatar-div {background: ' + $titlebackcolor + ';}';
                $style += '.overlay_horizontal .post-content-area .post-title { padding: 0 2px; color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                if ($template_title_font_italic == 1) {
                    $style += '.overlay_horizontal .post-content-area .post-title { font-style: italic }';
                }
                $style += '.overlay_horizontal .post-title a {color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.overlay_horizontal .post-title a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.overlay_horizontal .post-content-area .post_content { color:' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.overlay_horizontal .read-more-div a.more-tag { color: ' + $readmorecolor + ';}';
                $style += '.overlay_horizontal .read-more-div a.more-tag:hover {color: ' + $readmorebackcolor + ';}';
                $style += '.overlay_horizontal a, .overlay_horizontal .post_content_wrap .label_featured_post, .overlay_horizontal .post-title .mdate a, .overlay_horizontal .blog_footer .tags a, .overlay_horizontal .blog_footer .categories a {color: ' + $color + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.overlay_horizontal .post-content-area .blog_footer .categories, .overlay_horizontal .post-content-area .blog_footer .tags {color: ' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.overlay_horizontal a:hover, .overlay_horizontal .post-title .mdate a:hover, .overlay_horizontal .blog_footer .tags a:hover, .overlay_horizontal .blog_footer .categories a:hover {color:' + $linkhovercolor + ';}';
                $style += '.logbook.flatLine a.lb-line-node.active, #content .logbook.flatLine a.lb-line-node.active {color:' + $templatecolor + ';}';
                $style += '.logbook.flatLine .lb-item.lb-node-hover::after, #content .logbook.flatLine .lb-item.lb-node-hover::after {border-color: ' + $templatecolor + ' rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);}';
                $style += '.logbook.flatLine a.lb-line-node.active::after, #content .logbook.flatLine a.lb-line-node.active::after {border-color: ' + $templatecolor + '; }';
                $style += '.logbook.flatLine .lb-node-desc span, #content .logbook.flatLine .lb-node-desc span, .logbook.flatLine .lb-item.lb-node-hover::before, #content .logbook.flatLine .lb-item.lb-node-hover::before, .logbook.flatLine a.lb-line-node::after, #content .logbook.flatLine a.lb-line-node::after {background:  ' + $templatecolor + ';}';

                var logbook_css = plugin_path + '/css/logbook.css';
                var logbook_js = plugin_path + '/js/logbook.js';
                var easing_js = plugin_path + '/js/jquery.easing.js';

                jQuery('head').append('<script type="text/javascript" id="bdp-admin-logbook-js" src="' + logbook_js + '">');
                jQuery('head').append('<script type="text/javascript" id="bdp-admin-easing-js" src="' + easing_js + '">');
                jQuery('head').append('<link rel="stylesheet" id="bdp-admin-timeline-css" type="text/css" href="' + logbook_css + '">');

            }
            if ($bdp_theme == 'explore') {
                $style += '.bdp_blog_template.explore .blog_header .post-title, .bdp_blog_template.explore .blog_header .post-title a { color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.bdp_blog_template.explore .grid-overlay, .bdp_blog_template.explore .label_featured_post {background:'+ bdp_hex2rgba($grid_hoverback_color,50) +' none repeat scroll 0 0;}';
                $style += '.bdp_blog_template.explore .blog_header .post-title a:hover {color: ' + $titlehovercolor + ';}';
                $style += '.bdp_blog_template.explore .blog_header a,.bdp_blog_template.explore .blog_header i,.bdp_blog_template.explore .blog_header .tags,.bdp_blog_template.explore .blog_header .category-link, .bdp_blog_template.explore .blog_header .post-comment, .bdp_blog_template.explore .blog_header .metabox-top, .bdp_blog_template.explore .comments-link, .bdp_blog_template.explore .label_featured_post {color: ' + $color + ';}';
                $style += '.bdp_blog_template.explore .blog_header a:hover, .bdp_blog_template.explore .blog_header a:hover i {color: ' + $linkhovercolor + ';}';
                $style += '.bdp_blog_template.explore .blog_header .read-more-div a.more-tag {color:' + $readmorecolor + ';}';
                $style += '.bdp_blog_template.explore .blog_header .read-more-div a.more-tag:hover, .bdp_blog_template.explore .blog_header .read-more-div a.more-tag:focus {color:' + $readmorebackcolor + ';}';
                $style += '.bdp_blog_template.explore.large-col,.bdp_blog_template.explore.small-col{padding-left: ' + ($grid_col_space / 2) + 'px;padding-right:' + ($grid_col_space / 2) + 'px;padding-bottom:' + $grid_col_space + 'px;}';
                $style += '.bdp_blog_template.explore .bdp-grid-row {margin-left: -' + ($grid_col_space / 2) + 'px;margin-right: -' + ($grid_col_space / 2) + 'px;}';
            }
            if ($bdp_theme == 'hoverbic') {
                $style += '.bdp_blog_template.hoverbic .blog_header .post-title {color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.hoverbic .blog_header .post-title{ font-style: italic }';
                }
                $style += '.bdp_blog_template.hoverbic .blog_header .post-title a {color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.bdp_blog_template.hoverbic .blog_header .post-title a:hover {color: ' + $titlehovercolor + ';}';
                if ($grid_hoverback_color != '') {
                    $style += '.bdp_archive.hoverbic .author-avatar-div, .bdp_blog_template.hoverbic .blog_header, .bdp_blog_template.hoverbic .label_featured_post { background: ' + bdp_hex2rgba($grid_hoverback_color, 80) + ';}';
                }

                $style += '.bdp_blog_template.hoverbic .blog_header a,.bdp_blog_template.hoverbic .blog_header i,.bdp_blog_template.hoverbic .blog_header .tags,.bdp_blog_template.hoverbic .blog_header .category-link, .bdp_blog_template.explore .comments-link, .bdp_blog_template.hoverbic .label_featured_post {color: ' + $color + ';}';
                $style += '.bdp_blog_template.hoverbic .blog_header a:hover, .bdp_blog_template.explore .blog_header a:hover i {color: ' + $linkhovercolor + ';}';
                $style += '.bdp_blog_template.hoverbic.small-col,.bdp_blog_template.hoverbic.full-col{padding-left: ' + ($grid_col_space / 2) + 'px;padding-right:' + ($grid_col_space / 2) + 'px;padding-bottom:' + $grid_col_space + 'px;}';
                $style += '.bdp-grid-row{margin-left: -' + ($grid_col_space / 2) + 'px;margin-right: -' + ($grid_col_space / 2) + 'px;}';
            }
            if ($bdp_theme == 'story') {
                $style += '.story .blog_header{background:' + $titlebackcolor + '; line-height: 1.5;padding: 0 2px; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.story .blog_header{ font-style: italic }';
                }
                $style += '.story .blog_header,.story .blog_header a{ font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';color: ' + $titlecolor + ';}';
                $style += '.story .blog_header a:hover{color:' + $titlehovercolor + '}';
                $style += '.story .read-more a.more-tag {background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; border-color:' + $readmorecolor + ';}';
                $style += '.story .read-more a.more-tag:hover {background:' + $readmorehoverbackcolor + ';}';
                $style += '.story .post_content,.story .blog_footer,.story .post-metadata, .story .footer_meta .tags .link-lable, .story .footer_meta .category-link .link-lable { color:' + $contentcolor + ';font-size:' + $content_fontsize + 'px;}';
                $style += '.story .blog_template .social-component a {color:' + $contentcolor + ';border-color:' + $contentcolor + '}';
                $style += '.story a, .story .post-metadata .author-inner, .story .post-media a,.story .footer_meta .tags a, .story .footer_meta .tags.bdp_has_links, .story .footer_meta .category-link.bdp_has_links, .story .footer_meta .category-link a{ color:' + $color + ';font-size:' + $content_fontsize + ' }';
                $style += '.story a:hover,.story .post-media a:hover,.story .footer_meta .tags a:hover,.story .footer_meta .category-link a:hover{ color:' + $linkhovercolor + '; }';
                $style += '.story .line-col-bottom-secound,.story .date-icon-left, .story .entity-content-left .label_featured_post, .story .entity-content-right .label_featured_post {background:' + $template_alternative_color + '}';
                $style += '.story .line-col-top,.story .date-icon-rights{background:' + $templatecolor + '}';
                $style += '.story .line-col-left {border-color:' + $template_alternative_color + '}';
                $style += '.story .line-col-right {border-color:' + $templatecolor + ';}';
                $style += '.story .date-icon-rights.date-icon-arrow-bottom:after{border-top-color:' + $templatecolor + '}';
                $style += '.story .date-icon-left.date-icon-arrow-bottom:after{border-top-color:' + $template_alternative_color + '}';
                $style += '.startup{background:' + $story_startup_background + ';color:' + $story_startup_text_color + ';}';
                $style += '.startup.ending{background:' + $story_ending_background + ';color:' + $story_ending_text_color + ';}';
                $style += '.story .date-icon-arrow-bottom::before {border-top-color: ' + $story_startup_border_color + ';}';
                $style += '.story .startup, .story .date-icon, .story .blog_post_wrap .post-media img {border-color: ' + $story_startup_border_color + ';}';
                $style += '.story .dote span {background-color: ' + $story_startup_border_color + ';}';
            }
            if ($bdp_theme == 'easy_timeline') {
                $style += '.bdp_archive.easy_timeline .author-avatar-div, .bdp_blog_template .easy-timeline > li {background:' + $templatecolor + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline .post-title{color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                $style += '.easy-timeline-wrapper .easy-timeline .post-title a {background : ' + $titlebackcolor + '; color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline .post-title a:hover {color: ' + $titlehovercolor + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline .post_content { color:' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.easy-timeline-wrapper .easy-timeline .comment-count-inner, .easy-timeline-wrapper .easy-timeline .author-inner, .easy-timeline-wrapper .easy-timeline .date-inner, .easy-timeline-wrapper .easy-timeline .metadatabox span, .easy-timeline-wrapper .easy-timeline .categories .link-lable, .easy-timeline-wrapper .easy-timeline .categories .bdp_no_links, .easy-timeline-wrapper .easy-timeline .tags .link-lable, .easy-timeline-wrapper .easy-timeline .tags.bdp_no_links {color:' + $contentcolor + '; font-size: ' + $content_fontsize + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline .read-more-div a.more-tag { color: ' + $readmorecolor + ';background: ' + $readmorebackcolor + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline .read-more-div a.more-tag:hover, .easy-timeline-wrapper .easy-timeline .label_featured_post { background: ' + $readmorehoverbackcolor + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline a, .easy-timeline-wrapper .easy-timeline .post-title .mdate a, .easy-timeline-wrapper .easy-timeline .metadatabox span.bdp_has_links, .easy-timeline-wrapper .easy-timeline .tags, .easy-timeline-wrapper .easy-timeline .blog_footer .tags a, .easy-timeline-wrapper .easy-timeline .categories, .easy-timeline-wrapper .easy-timeline .blog_footer .categories a, .easy-timeline-wrapper .easy-timeline .label_featured_post { color: ' + $color + '; font-size: ' + $content_fontsize + ';}';
                $style += '.easy-timeline-wrapper .easy-timeline a:hover, .easy-timeline-wrapper .easy-timeline .post-title .mdate a:hover, .easy-timeline-wrapper .easy-timeline .blog_footer .tags a:hover, .easy-timeline-wrapper .easy-timeline .blog_footer .categories a:hover {color:' + $linkhovercolor + ';}';
                $style += '.easy-timeline > li{ background: ' + $templatecolor + '; }';
                $style += '.easy-timeline .mdate i, .easy-timeline .metadatabox span i, .easy-timeline  .comments-link {color:' + $contentcolor + ';}';
            }
            if ($bdp_theme == 'elina') {
                $style += '.elina_wrapper .elina-post-wrapper {color:' + $contentcolor + '; }';
                $style += '.elina-post-wrapper .post-title {color:' + $titlecolor + '; font-size:' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.elina-post-wrapper .post-title { font-style: italic }';
                }
                $style += '.elina-post-wrapper .post-title a {color: ' + $titlecolor + ';}';
                $style += '.blog_template bdp_archive.elina .author-avatar-div, .elina-post-wrapper .post-content-area, .elina-post-wrapper .post-content-area:before, .post-content-area::after,.elina-footer {background-color: ' + $background + ';}';
                $style += '.elina-post-wrapper .post-title a:hover, .elina-post-wrapper .post-title a:focus {color: ' + $titlehovercolor + ';}';
                $style += '.elina-post-wrapper .categories-outer .categories .categories-inner.bdp_no_links, .elina-post-wrapper .post-content-area .tags .link-lable, .elina-post-wrapper .post-content-area .tags.bdp_no_links { color:' + $contentcolor + ' }';
                $style += '.elina-post-wrapper .categories-outer .categories .categories-inner a, .elina-post-wrapper .post-content-area .tags a, .elina-post-wrapper .elina-footer a.comments-link,  .elina-post-wrapper .post-content-area .tags a, .elina-post-wrapper .post-share-div a.post-share {color: ' + $color + ';}';
                $style += '.elina-post-wrapper .post_content, .elina-post-wrapper .post-content-area .tags {font-size: ' + $content_fontsize + 'px; font-family:' + $content_font_family + ';}';
                $style += '.elina-post-wrapper .categories-outer .categories .categories-inner a:hover, .elina-post-wrapper .elina-footer a.comments-link:hover, .elina-post-wrapper .post-content-area .tags a:hover, .elina-post-wrapper .post-share-div a.post-share:hover {color: ' + $linkhovercolor + ';}';
                $style += '.elina-post-wrapper .read-more-div a.more-tag, .elina-post-wrapper .read-more-div a.more-tag:before, .elina-post-wrapper .read-more-div a.more-tag:after, .elina-post-wrapper .post-media .label_featured_post {color:' + $readmorecolor + '; border-color: ' + $readmorecolor + '}';
                $style += '.elina-post-wrapper .read-more-div a.more-tag:hover,.elina-post-wrapper .read-more-div a.more-tag:hover:before, .elina-post-wrapper .read-more-div a.more-tag:hover:after {color:' + $readmorebackcolor + '; border-color: ' + $readmorebackcolor + '}';
            }
            if ($bdp_theme == 'masonry_timeline') {
                $style += '.masonry-timeline-wrapp, .bdp_archive.masonry_timeline .author-avatar-div, .masonry-timeline-wrapp .post-footer .social-component {background: ' + $background + ';}';
                $style += '.masonry-timeline-wrapp .post-content-area .post-title {font-size: ' + $template_titlefontsize + 'px; font-family: ' + $template_titlefontface + '; color: ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.masonry-timeline-wrapp .bdp-wrapper-like i, .masonry-timeline-wrapp .metadatabox span.mauthor i, .masonry-timeline-wrapp .metadatabox span.mauthor.bdp_no_links, .masonry-timeline-wrapp .categories.bdp_no_links, .masonry-timeline-wrapp .tags.bdp_no_links, .masonry-timeline-wrapp .tags .link-lable, .masonry-timeline-wrapp .year-number, .masonry-timeline-wrapp .metadatabox {color: ' + $contentcolor + ';}';
                $style += '.masonry-timeline-wrapp .metadatabox span.mauthor, .masonry-timeline-wrapp .categories, .masonry-timeline-wrapp .tags {color: ' + $color + '}';
                $style += '.masonry-timeline-wrapp .post-content-area .post_content {color: ' + $contentcolor + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.masonry-timeline-wrapp .read-more-div a.more-tag {color: ' + $readmorecolor + '; border-color: ' + $readmorecolor + ';}'
                $style += '.masonry-timeline-wrapp .read-more-div a.more-tag:hover, .masonry-timeline-wrapp .image-blog .label_featured_post {color: ' + $readmorebackcolor + '; border-color: ' + $readmorebackcolor + ';}'
                $style += '.masonry-timeline-wrapp .post-footer .metadatabox a {color: ' + $color + '}';
                $style += '.masonry-timeline-wrapp .post-footer .metadatabox a:hover, .masonry-timeline-wrapp .post-footer .metadatabox a:focus {color: ' + $linkhovercolor + ';}';
                $style += '.masonry-timeline-wrapp .post-footer .social-component .social-share a.close-div {border-color: ' + $color + '}';
                $style += '.masonry-timeline-wrapp .post-footer .social-component .social-share a.close-div:hover {background: ' + $color + '}';
                if ($firstletter_big == 1) {
                    $style += '.masonry-timeline-wrapp.bdp_blog_template div.post_content > *:first-child:first-letter, .masonry-timeline-wrapp.bdp_blog_template div.post_content > p:first-child:first-letter, .masonry-timeline-wrapp.bdp_blog_template .post_content:first-letter {font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; color: ' + $firstletter_contentcolor + '; float: none; margin-right:0; line-height: 0; }';
                    $style += '.masonry-timeline-wrapp.bdp_blog_template div.post_content {margin-top: ' + ($firstletter_fontsize / 2) + 'px;}';
                }
            }
            if ($bdp_theme == 'my_diary') {
                $style += '.my_diary_wrapper:before {background-color: ' + $background + ';opacity: 0.03; }';
                $style += '.diary-post.bdp_blog_template div.post_content {color:' + $contentcolor + '; font-size: ' + $content_fontsize + 'px; font-family:' + $content_font_family + ';}';
                $style += '.diary-posthead .categories,.diary-posthead .metadatabox,.diary_postfooter .post-comment,.diary_postfooter .tags {font-size: ' + $content_fontsize - 2 + 'px;color: ' + $color + '; }';
                $style += '.diary-posthead .categories span,.metadatabox div span,.diary_postfooter .post-comment i,.diary_postfooter .tags i {font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; }';
                $style += '.diary-posthead .categories a,.diary-posthead .metadatabox a,.diary_postfooter .post-comment a,.diary_postfooter .tags a {color: ' + $color + '; }';
                $style += '.diary-posthead .categories a:hover,.diary-posthead .categories a:focus,.diary-posthead .metadatabox a:hover,.diary-posthead .metadatabox a:focus,.diary_postfooter .post-comment a:hover,.diary_postfooter .post-comment a:focus,.diary_postfooter .tags a:hover,.diary_postfooter .tags a:focus{color: ' + $linkhovercolor + '; }';
                $style += '.diary-posthead .post-title {font-size : ' + $template_titlefontsize + 'px; font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.diary-posthead .post-title {font-style: italic }';
                }
                $style += '.diary-posthead .post-title a:before,.diary-posthead .post-title a:after {background-color: ' + $titlehovercolor + '; }';
                $style += '.diary-posthead .post-title,.diary-posthead .post-title a {color: ' + $titlecolor + '; }';
                $style += '.diary-posthead .post-title a:hover,.diary-posthead .post-title a:focus {color: ' + $titlehovercolor + '; }';
                $style += '.diary-postcontent:before {color: ' + bdp_hex2rgba($contentcolor, 50) + '; border-color: ' + bdp_hex2rgba($contentcolor, 50) + '; }';
                $style += '.diary-post .read-more-div .more-tag, .diary-post .diary-thumb .label_featured_post {color: ' + $readmorecolor + ';background-color: ' + $readmorebackcolor + ';border-color:' + $readmorebackcolor + ';}';
                $style += '.read-more-div .more-tag:hover,.read-more-div .more-tag:focus {background-color: ' + $readmorehoverbackcolor + ';}';
                $style += '.diary_postfooter {border-color: ' + bdp_hex2rgba($readmorebackcolor, 30) + ';}';
                if ($firstletter_big == 1) {
                    $style += '.diary-post.bdp_blog_template div.post_content > *:first-child:first-letter, .diary-post.bdp_blog_template div.post_content > p:first-child:first-letter, .diary-post.bdp_blog_template .post_content:first-letter {font-family: ' + $firstletter_font_family + '; font-size: ' + $firstletter_fontsize + 'px; color: ' + $firstletter_contentcolor + '; float: none; margin-right:5px; line-height: 0; }';
                    $style += '.diary-post.bdp_blog_template div.post_content {margin-top: ' + ($firstletter_fontsize / 2) + 'px;}';
                }
            }
            if ($bdp_theme == 'crayon_slider') {
                var $category_bg = jQuery('#winter_category_color').iris('color');

                $style += '.bdp_archive.crayon_slider .author-avatar-div, .bdp_blog_template.crayon_slider .blog_header {background: ' + bdp_hex2rgba($templatecolor, 80) + '; }';
                $style += '.blog_template.bdp_blog_template.crayon_slider .bdp-post-image {height : ' + $slider_image_height + 'px; overflow: hidden;}';
                $style += '.bdp_blog_template.crayon_slider img {height: 100%;}'
                $style += '.blog_template.bdp_blog_template.crayon_slider .blog_header h2 { font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + '; letter-spacing: ' + $template_title_font_letter_spacing + 'px; background : ' + $titlebackcolor + '; color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.bdp_blog_template.crayon_slider .blog_header h2 { font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.crayon_slider .blog_header h2 a {color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                $style += '.blog_template.bdp_blog_template.crayon_slider .blog_header h2 a:hover {color : ' + $titlehovercolor + '; }';
                $style += '.blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor a, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date a, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment a {color: ' + $color + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .category-link a, .bdp_blog_template.crayon_slider .blog_header::before {background : ' + $category_bg + '; }';
                $style += '.blog_template.crayon_slider .post_content .post_content-inner, .blog_template.crayon_slider .post_content .post_content-inner p {font-size: ' + $content_fontsize + 'px;}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment, .blog_template.bdp_blog_template.crayon_slider .tags, .blog_template.bdp_blog_template.crayon_slider .tags i,.blog_template.bdp_blog_template.crayon_slider .category-link {font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; font-family:' + $content_font_family + ';}';
                if ($content_font_italic == 1) {
                    $style += '.blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment, .blog_template.bdp_blog_template.crayon_slider .tags, .blog_template.bdp_blog_template.crayon_slider .tags i,.blog_template.bdp_blog_template.crayon_slider .category-link{ font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.crayon_slider .tags.tag_link {color : ' + $contentcolor + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .tags {color : ' + $color + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .tags > a:hover  {color : ' + $linkhovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor a:hover, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date a:hover, .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment a:hover {color : ' + $linkhovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .post_content a.more-tag, .blog_template.bdp_blog_template.crayon_slider .label_featured_post {color : ' + $readmorecolor + '; background : ' + $readmorebackcolor + ';}';
                $style += '.blog_template.bdp_blog_template.crayon_slider .post_content a.more-tag:hover {background : ' + $readmorehoverbackcolor + ';}';
            }
            if ($bdp_theme == 'sallet_slider') {
                var $category_bg = jQuery('#winter_category_color').iris('color');
                $style += '.blog_template.bdp_blog_template.sallet_slider .bdp-post-image {height : ' + $slider_image_height + 'px; overflow: hidden;}';
                $style += '.bdp_blog_template.sallet_slider .blog_header > div > div > div { background : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.sallet_slider img{height: 100%;}'
                $style += '.blog_template.bdp_blog_template.sallet_slider .blog_header h2 { font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + '; letter-spacing: ' + $template_title_font_letter_spacing + 'px; background : ' + $titlebackcolor + '; color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.bdp_blog_template.sallet_slider .blog_header h2 { font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.sallet_slider .blog_header h2 a {color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                $style += '.blog_template.bdp_blog_template.sallet_slider .blog_header h2 a:hover {color : ' + $titlehovercolor + '; }';
                $style += '.blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor, .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a, .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date a, .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment a {color: ' + $color + ';}';
                $style += '.blog_template.bdp_blog_template.sallet_slider .category-link a, .bdp_blog_template.sallet_slider .blog_header > div > div > div::before {background : ' + $category_bg + '; }';
                $style += '.blog_template.sallet_slider .post_content .post_content-inner, .blog_template.sallet_slider .post_content .post_content-inner p {font-size: ' + $content_fontsize + 'px;}';
                $style += '.blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor, .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date,.blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment,.blog_template.bdp_blog_template.sallet_slider .tags,.blog_template.bdp_blog_template.sallet_slider .tags i,.blog_template.bdp_blog_template.sallet_slider .category-link,.bdp_blog_template .bdp-wrapper-like a {}';
                $style += '.bdp_blog_template.sallet_slider .blog_header .post_content-inner { font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; font-family:' + $content_font_family + ';}';
                if ($content_font_italic == 1) {
                    $style += '.bdp_blog_template.sallet_slider .blog_header .post_content-inner { font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor:hover i, .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a:hover, .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date a:hover, .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment a:hover {color : ' + $linkhovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.sallet_slider .post_content a.more-tag, .blog_template.sallet_slider .label_featured_post {color : ' + $readmorecolor + '; background : ' + $readmorebackcolor + ';}';
                $style += '.blog_template.bdp_blog_template.sallet_slider .post_content a.more-tag:hover {background : ' + $readmorehoverbackcolor + ';}';
            }
            if ($bdp_theme == 'sunshiny_slider') {
                var $category_bg = jQuery('#winter_category_color').iris('color');
                $style += '.bdp_blog_template.sunshiny_slider .post_hentry:before {background: linear-gradient(to top, ' + bdp_hex2rgba($templatecolor, 80) + '0px, rgba(0, 0, 0, 0) 100%);}';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .bdp-post-image {height : ' + $slider_image_height + 'px; overflow: hidden;}';
                $style += '.bdp_blog_template.sunshiny_slider img {height: 100%; }';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 { font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + '; letter-spacing: ' + $template_title_font_letter_spacing + 'px; background : ' + $titlebackcolor + '; color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 { font-style: italic }';
                }
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 a {color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 a:hover {color : ' + $titlehovercolor + '; }';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date a, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment a {color:' + $color + ';}';
                $style += '.label_featured_post span, .blog_template.bdp_blog_template.sunshiny_slider .category-link a {background : ' + $category_bg + '; }';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .metadatabox, .blog_template.sunshiny_slider .post_content .post_content-inner,.blog_template.sunshiny_slider .post_content .post_content-inner p {font-size: ' + $content_fontsize + 'px;}';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment, .blog_template.bdp_blog_template.sunshiny_slider .tags,.blog_template.bdp_blog_template.sunshiny_slider .tags i, .blog_template.bdp_blog_template.sunshiny_slider .category-link {font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a:hover, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date a:hover, .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment a:hover {color : ' + $linkhovercolor + ';}';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .post_content a.more-tag {color : ' + $readmorecolor + '; background : ' + $readmorebackcolor + ';}';
                $style += '.blog_template.bdp_blog_template.sunshiny_slider .post_content a.more-tag:hover {background : ' + $readmorehoverbackcolor + ';}';
            }
            if ($bdp_theme == 'pretty') {
                $style += '.bdp_blog_template.pretty .right-content-wrapper,.bdp_blog_template.pretty .bdp-post-image.post-has-image::before,.bdp_archive.pretty .author-avatar-div {background : ' + $background + '; }';
                $style += '.bdp_blog_template.pretty .blog_header .post_date {background : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.pretty .left-content-wrapper {background : ' + bdp_hex2rgba($templatecolor, 50) + ';}';
                $style += '.bdp_blog_template.pretty .left-content-wrapper.post-has-image::before {border-bottom-color: ' + bdp_hex2rgba($templatecolor, 50) + ';}';
                $style += '.bdp_blog_template.pretty .post-meta-cats-tags .tags > a:hover{ color: ' + $linkhovercolor + ';border-color: ' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.pretty .post-meta-cats-tags .tags > a{ color: ' + $color + ';border-color: ' + $color + '; }';
                $style += '.bdp_blog_template.pretty .blog_header h2 { font-size: ' + $template_titlefontsize + 'px;background: ' + $titlebackcolor + ';color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.pretty .blog_header h2 { font-style: italic }';
                }
                $style += '.bdp_blog_template.pretty .blog_header h2 a,.bdp_archive.pretty .author-avatar-div .author_content .author { color: ' + $titlecolor + '; }';
                $style += '.bdp_blog_template.pretty .blog_header h2 a:hover { color: ' + $titlehovercolor + '; }';
                $style += '.bdp_blog_template.pretty .post_content,.bdp_archive.pretty .author_content p { font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.bdp_blog_template.pretty .date > span {font-family:' + $content_font_family + ';}';
                $style += '.bdp_blog_template.pretty .post-meta-cats-tags .tags, .bdp_blog_template.pretty .post-meta-cats-tags .category-link ,.bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox{ color: ' + $contentcolor + '; font-family:' + $content_font_family + ';}';
                $style += '.bdp_blog_template.pretty .entry-meta .read-more a, .bdp_blog_template.pretty .entry-container .label_featured_post { border-color:' + $readmorebackcolor + ';background: ' + $readmorebackcolor + ';color: ' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.pretty .entry-meta .read-more a:hover { background: ' + $readmorehoverbackcolor + ' }';
                $style += '.bdp_blog_template.pretty a,.bdp_archive .author-avatar-div .author_content .author a,.author-avatar-div.bdp_blog_template .social-component a{ color:' + $color + '; }';
                $style += '.bdp_blog_template.pretty .social-component a {color:' + $color + '; border-color:' + $color + ';}';
                $style += '.bdp_blog_template.pretty a:hover{ color:' + $linkhovercolor + '; .bdp_archive .author-avatar-div .author_content .author a:hover}';
                $style += '.bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox { line-height: 15px; }';
            }
            if ($bdp_theme == 'brite') {
                var $margin_left = parseInt($content_fontsize) + 15;
                var $category_bg = jQuery('#winter_category_color').iris('color');
                if ($category_bg == '') {
                    $category_bg = '#0e83cd';
                }

                $style += '.brite-post-wrapper .brite-post-inner-wrapp, .bdp_archive.brite .author-avatar-div {background:' + $templatecolor + ';}';
                $style += '.brite-post-wrapper .post-title h2 {font-size: ' + $template_titlefontsize + 'px;background: ' + $titlebackcolor + ';color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.brite-post-wrapper .post-title h2 { font-style: italic }';
                }
                $style += '.brite-post-wrapper .post-title a h2 {color : ' + $titlecolor + '; font-size : ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + '; }';
                $style += '.brite-post-wrapper .post-title a:hover h2, .brite-post-wrapper .post-title a:focus h2 { color: ' + $titlehovercolor + '; }';
                $style += '.brite-post-wrapper .post-header-meta .date-meta, .brite-post-wrapper .post-author .author-name, .brite-post-wrapper .post-content-body, .brite-post-wrapper .post-content-body .post-content, .brite-post-wrapper .post-footer { font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; font-family:' + $content_font_family + ';}';
                $style += '.brite-post-wrapper .bdp-wrapper-like a i, .brite-post-wrapper .bdp-wrapper-like a:hover i, .brite-post-wrapper .bdp-wrapper-like a:focus i { font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + '; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                if ($content_font_italic == 1) {
                    $style += '.brite-post-wrapper .post-header-meta .date-meta, .brite-post-wrapper .post-author .author-name, .brite-post-wrapper .post-content-body, .brite-post-wrapper .post-content-body .post-content, .brite-post-wrapper .post-footer, .brite-post-wrapper .bdp-wrapper-like a i, .brite-post-wrapper .bdp-wrapper-like a:hover i, .brite-post-wrapper .bdp-wrapper-like a:focus i {font-style: italic; }';
                }
                $style += '.brite-post-wrapper .date-meta > a, .brite-post-wrapper .post-categories > a, .brite-post-wrapper .post-meta > a, .brite-post-wrapper .post-comment > a, .brite-post-wrapper .bdp-wrapper-like > a {color: ' + $color + ';}';
                $style += '.brite-post-wrapper .date-meta > a:hover, .brite-post-wrapper .date-meta > a:focus, .brite-post-wrapper .post-categories > a:hover, .brite-post-wrapper .post-categories > a:focus, .brite-post-wrapper .post-meta > a:hover, .brite-post-wrapper .post-meta > a:focus, .brite-post-wrapper .post-comment > a:hover, .brite-post-wrapper .post-comment > a:focus, .brite-post-wrapper .bdp-wrapper-like > a:hover, .brite-post-wrapper .bdp-wrapper-like > a:focus { color:' + $linkhovercolor + '; }';
                $style += '.brite-post-wrapper .post-tags span.tag:before {border-top: ' + $content_fontsize + 'px solid transparent; border-bottom: ' + $content_fontsize + 'px solid transparent; border-right: ' + $content_fontsize + 'px solid; border-right-color: ' + $category_bg + '; left: -' + $content_fontsize + 'px;}';
                $style += '.brite-post-wrapper .post-tags span.tag, .brite-post-wrapper .label_featured_post {margin-left: ' + $margin_left + 'px; background: ' + $category_bg + ';}';
                $style += '.brite-post-wrapper .post-tags span.tag:hover:before {border-top: ' + $content_fontsize + 'px solid transparent; border-bottom: ' + $content_fontsize + 'px solid transparent; border-right: ' + $content_fontsize + 'px solid; border-right-color: ' + $contentcolor + '; left: -' + $content_fontsize + 'px;}';
                $style += '.brite-post-wrapper .post-tags span.tag:hover {background: ' + $contentcolor + '; margin-left: ' + $margin_left + 'px; }';
                $style += '.brite-post-wrapper .read-more-div a:hover {background:' + $readmorehoverbackcolor + ';}';
                $style += '.brite-post-wrapper .read-more-div a {background:' + $readmorebackcolor + '; color:' + $readmorecolor + ';}';
            }
            if ($bdp_theme == 'tagly') {
                $style += '.bdp_blog_template.tagly {background : ' + $background + ';}';
                $style += '.bdp_blog_template.tagly .right-side-area .categories a,.bdp_blog_template.tagly .right-side-area .categories{ color : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.tagly .left-side-area, .bdp_blog_template.tagly .label_featured_post { background : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.tagly .left-side-area:before{ border-top-color : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.tagly .social-component::before{ border-bottom-color : ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.tagly .right-side-area h2.bdp_post_title::before{ background-color : ' + $templatecolor + '; box-shadow: 6px -2px 0 ' + $templatecolor + ';height : ' + $template_titlefontsize + 'px;}';
                $style += '.bdp_blog_template.tagly .metadatabox span a, .bdp_blog_template.tagly .metadatabox .author.bdp_has_links, .bdp_blog_template.tagly .metadatabox .author a, .bdp_blog_template.tagly .right-side-area .tags.bdp_has_links, .bdp_blog_template.tagly .right-side-area .tags a{ color : ' + $color + ';}';
                $style += '.bdp_blog_template.tagly .right-side-area .categories a:hover,.bdp_blog_template.tagly .metadatabox span a:hover,.bdp_blog_template.tagly .right-side-area .tags a:hover{ color : ' + $linkhovercolor + ';}';
                $style += '.bdp_blog_template.tagly .right-side-area h2.bdp_post_title a{ color : ' + $titlecolor + ';}';
                $style += '.bdp_blog_template.tagly .right-side-area h2.bdp_post_title a:hover{ color : ' + $titlehovercolor + ';}';
                $style += '.bdp_blog_template.tagly .right-side-area h2.bdp_post_title{ background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                if ($template_title_font_italic == 1) {
                    $style += '.bdp_blog_template.tagly .right-side-area h2.bdp_post_title{ font-style: italic }';
                }
                $style += '.bdp_blog_template.tagly .metadatabox > span, .bdp_blog_template.tagly .right-side-area .tags, .bdp_blog_template.tagly .post_content,.bdp_blog_template.tagly .post_content p,.bdp_archive.tagly .author_content p{ color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                if ($content_font_italic == 1) {
                    $style += '.bdp_blog_template.tagly .post_content,.bdp_blog_template.tagly .post_content p,.bdp_archive.tagly .author_content p{ font-style: italic }';
                }
                $style += '.bdp_blog_template.tagly .right-side-area .tags i, .bdp_blog_template.tagly .metadatabox .author i, .bdp_blog_template.tagly .metadatabox span,.bdp_blog_template.tagly .right-side-area .tags{ color:' + $contentcolor + '; }';
                $style += '.bdp_blog_template.tagly .right-side-area .read-more > a{ background:' + $readmorebackcolor + ';color:' + $readmorecolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                $style += '.bdp_blog_template.tagly .right-side-area .read-more > a{ padding: 10px 20px; border-radius: 5px; }';
                $style += '.bdp_blog_template.tagly .right-side-area .read-more > a:hover{ background: ' + $readmorehoverbackcolor + '; }';
            }
            if ($bdp_theme == 'chapter') {
                $style += '.chapter-post-container {border-color : ' + $templatecolor + ';}';
                $style += '.bdp_archive.chapter .author-avatar-div, .chapter-post-wrapper .chapter-header, .chapter-post-wrapper .chapter-footer, .chapter .chapter-post-container .label_featured_post {background : ' + bdp_hex2rgba($background, 80) + ';}';
                $style += '.chapter-post-wrapper .post-title h2 {font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                $style += '.chapter-post-wrapper .post-title a h2 {color : ' + $titlecolor + '; font-size: ' + $template_titlefontsize + 'px; font-family : ' + $template_titlefontface + ';}';
                $style += '.chapter-post-wrapper .post-title a:hover h2, .chapter-post-wrapper .post-title a:focus h2 {color : ' + $titlehovercolor + ';}';
                $style += '.chapter-post-wrapper .date-meta, .chapter-post-wrapper .post-author, .chapter-post-wrapper .post-categories, .chapter .chapter-post-container .label_featured_post, .chapter-post-wrapper .post-meta, .chapter-post-wrapper .post-comment, .chapter-post-wrapper .bdp-wrapper-like, .chapter-post-wrapper {color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                if ($content_font_italic == 1) {
                    $style += '.chapter-post-wrapper .date-meta, .chapter-post-wrapper .post-author, .chapter-post-wrapper .post-categories, .chapter-post-wrapper .post-meta, .chapter-post-wrapper .post-comment, .chapter-post-wrapper .bdp-wrapper-like, .chapter-post-wrapper { font-style: italic }';
                }
                $style += '.chapter-post-wrapper .date-meta > a, .chapter-post-wrapper .post-author > a, .chapter-post-wrapper .post-categories > a, .chapter-post-wrapper .post-meta > a,.chapter-post-wrapper .post-comment > a, .chapter-post-wrapper .bdp-wrapper-like > a {color : ' + $color + ';}';
                $style += '.chapter-post-wrapper .date-meta > a:hover, .chapter-post-wrapper .date-meta > a:focus, .chapter-post-wrapper .post-author > a:hover, .chapter-post-wrapper .post-author > a:focus, .chapter-post-wrapper .post-categories > a:hover, .chapter-post-wrapper .post-categories > a:focus, .chapter-post-wrapper .post-meta > a:hover, .chapter-post-wrapper .post-meta > a:focus, .chapter-post-wrapper .post-comment > a:hover, .chapter-post-wrapper .post-comment > a:focus, .chapter-post-wrapper .post-comment:hover > a, .chapter-post-wrapper .post-comment:focus > a, .chapter-post-wrapper .post-comment:hover i, .chapter-post-wrapper .post-comment:focus i, .chapter-post-wrapper .bdp-wrapper-like > a:hover, .chapter-post-wrapper .bdp-wrapper-like > a:focus, .chapter-post-wrapper .read-more-div a:hover, .chapter-post-wrapper .read-more-div a:focus {color:' + $linkhovercolor + ';}'
                $style += '.chapter-post-wrapper .read-more-div a {color:' + $readmorecolor + ';}';
            }
            if ($bdp_theme == 'roctangle') {
                $style += '.roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post_date, .roctangle-post-wrapper .post-image-wrap .post-image .label_featured_post {background: ' + $templatecolor + ';}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .post-title {background: ' + $titlebackcolor + ';}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .post-title h2, .roctangle-post-wrapper .post-content-wrapper .post-title h2 a {font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px;}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .post-title h2 a:hover {color : ' + $titlehovercolor + ';}';
                if ($template_title_font_italic == 1) {
                    $style += '.roctangle-post-wrapper .post-content-wrapper .post-title h2{ font-style: italic }';
                }
                $style += '.roctangle-post-wrapper .post-content {color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;}';
                if ($content_font_italic == 1) {
                    $style += '.roctangle-post-wrapper .post-content { font-style: italic }';
                }
                $style += '.roctangle-post-wrapper .post-content-wrapper .link-lable {color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .category-link a, .roctangle-post-wrapper .post-content-wrapper .tags a {color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .category-link span, .roctangle-post-wrapper .post-content-wrapper .tags span {border-color:' + $linkhovercolor + ';}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .category-link a:hover, .roctangle-post-wrapper .post-content-wrapper .tags a:hover {color:' + $linkhovercolor + ';}';
                $style += '.post-meta-div .author a, .post-meta-div .bdp-wrapper-like .bdp-count, .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment a {color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-meta-div span i {color:' + $color + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment i {color:' + $color + ';}';
                $style += '.roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment:hover i, .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment:hover a, .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-meta-div span:hover i, .roctangle-post-wrapper .post-meta-div .author a:hover, .roctangle-post-wrapper .post-meta-div .bdp-wrapper-like:hover .bdp-count {color:' + $linkhovercolor + ';}';
                $style += '.roctangle-post-wrapper .post-content-wrapper .content-footer .read-more a.more-tag {color:' + $readmorecolor + '; border-color:' + $contentcolor + '; }';
                $style += '.roctangle-post-wrapper .post-content-wrapper .content-footer .read-more a.more-tag:hover {color:' + $linkhovercolor + ';}';
            }
            if ($bdp_theme == 'glamour') {
                $style += '.glamour-blog .glamour-inner .post-title h2, .glamour-blog .glamour-inner .post-title h2 a {background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.glamour-blog .glamour-inner .post-title h2 a:hover {color : ' + $titlehovercolor + ';}';
                if ($template_title_font_italic == 1) {
                    $style += '.glamour-blog .glamour-inner .post-title h2{ font-style: italic }';
                }
                $style += '.glamour-blog .glamour-inner .post-content { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                if ($content_font_italic == 1) {
                    $style += '.glamour-blog .glamour-inner .post-content { font-style: italic }';
                }
                $style += '.glamour-inner .post-categories, .glamour-inner .tags, .glamour-inner .glamour-meta div, .glamour-inner .post-categories a, .glamour-inner .tags a, .glamour-inner .glamour-meta div > a {color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px;}';
                $style += '.footer-entry .glamour-meta div .bdp-separator, .glamour-inner .tags, .glamour-inner .post-comment i {color:' + $color + ';}';
                $style += '.glamour-inner .post-categories a:hover, .glamour-inner .tags a:hover, .glamour-inner .glamour-meta div > a:hover, .glamour-inner .glamour-meta div:hover i, .glamour-inner .glamour-meta div:hover a, .glamour-inner .read-more-div a.more-tag:hover {color:' + $linkhovercolor + ';}';
                $style += '.glamour-inner .read-more-div a.more-tag {color:' + $readmorecolor + '; font-family:' + $content_font_family + ';}';
                $style += '.glamour-blog .glamour-opacity {background : ' + bdp_hex2rgba($background, 40) + ';}';
                $style += '.glamour-social-cover {background : ' + bdp_hex2rgba($background, 90) + ';}';
                $style += '.glamour-social-cover .glamour-social-links-closed i, .footer-entry .glamour-footer-icon span a i, .glamour-blog .label_featured_post { color:' + $color + '; border-color:' + $color + '; }';
                $style += '.glamour-social-cover .glamour-social-links-closed i:hover, .footer-entry .glamour-footer-icon span a i:hover { background: ' + $color + '; }';
            }
            if($bdp_theme == 'cover') {
                $style += '.cover-post { background: linear-gradient(to right, '+ $templatecolor +' 0%,'+ $templatecolor +' 20%,'+ $background +' 20%,'+ $background +' 50%); }';
                $style += '.cover-post .cover-blog h2.bdp_post_title, .cover-post .cover-blog h2.bdp_post_title a {background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.cover-post .cover-blog h2.bdp_post_title a:hover { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.cover-post .cover-blog h2.bdp_post_title{ font-style: italic }';
                }
                $style += '.cover-post .cover-blog .post_content { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                if ($content_font_italic == 1) {
                    $style += '.cover-post .cover-blog .post_content { font-style: italic }';
                }
                $style += '.cover-post .cover-blog .bdp-post-categories, .cover-post .cover-blog .bdp-cover-tag, .cover-post .cover-blog .bdp-post-meta span { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.cover-post .cover-blog .bdp-post-categories.bdp-no-links, .cover-post .cover-blog .bdp-cover-tag.bdp-no-links, .cover-post .cover-blog .bdp-cover-tag .link-lable, .cover-post .cover-blog .bdp-post-meta span.bdp-no-links { color:' + $contentcolor + '; }';
                $style += '.cover-post .cover-blog .bdp-post-categories a, .cover-post .cover-blog .bdp-cover-tag a, .cover-post .cover-blog .bdp-post-meta span a { color:' + $color + '; }';
                $style += '.cover-post .cover-blog .bdp-post-categories a:hover, .cover-post .cover-blog .bdp-cover-tag a:hover, .cover-post .cover-blog .bdp-post-meta span a:hover, .cover-post .cover-blog .bdp-post-meta .comment:hover { color:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.cover-post .post_content a.more-tag, .cover-post .label_featured_post { background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; font-family:' + $content_font_family + '; }';
                $style += '.bdp_blog_template.cover-post .post_content a.more-tag:hover, .cover-post .label_featured_post { background:' + $readmorehoverbackcolor + '; }';
            }
            if($bdp_theme == 'fairy') {
                $style += '.bdp_blog_template.fairy .fairy_wrap .fairy-social-cover, .bdp_blog_template.fairy .fairy_wrap .fairy_footer, .bdp_blog_template.fairy .label_featured_post { background: ' + $templatecolor + '; }';
                $style += '.bdp_blog_template.fairy .fairy_wrap, .bdp_blog_template.fairy .fairy_wrap .fairy_footer span a  { background : ' + $background + ';  }';
                $style += '.fairy .bdp-post-image h2.post_title, .fairy .bdp-post-image h2.post_title a { background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.fairy .bdp-post-image h2.post_title a:hover { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.fairy .bdp-post-image h2.post_title{ font-style: italic }';
                }
                $style += 'div.bdp-post-image .post-meta-cover, div.bdp-post-image .post-meta-cover a { color:' + $titlecolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;  }';
                $style += 'div.bdp-post-image .post-meta-cover a:hover, .fairy .bdp-post-image h2.post_title a:hover { color : ' + $titlehovercolor + '; }';
                $style += '.fairy .fairy_wrap .post_content { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                if ($content_font_italic == 1) {
                    $style += '.fairy .fairy_wrap .post_content { font-style: italic }';
                }
                $style += '.fairy .fairy_wrap .post_content_area, .fairy .fairy_wrap .metadatabox .metacomments, .fairy .fairy_wrap .metadatabox .metacomments.bdp-no-links:hover, .fairy .fairy_wrap .fairy_footer .fairy-post-share, .fairy .fairy_wrap .fairy_footer span, .fairy .fairy_wrap .metadatabox span { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.fairy .fairy_wrap .post_content_area a, .fairy .fairy_wrap .fairy_footer span a, .fairy .fairy_wrap .metadatabox span a, .fairy .fairy_wrap .fairy-social-cover .fairy-social-links-closed, .bdp_blog_template.fairy .label_featured_post { color:' + $color + '; }';
                $style += '.fairy .fairy_wrap .post_content_area a:hover, .fairy .fairy_wrap .fairy_footer .fairy-post-share:hover, .fairy .fairy_wrap .fairy-social-cover .fairy-social-links-closed:hover, .fairy .fairy_wrap .metadatabox .metacomments:hover, .fairy .fairy_wrap .fairy_footer span a:hover, .fairy .fairy_wrap .metadatabox span a:hover { color:' + $linkhovercolor + '; }';
            }
            if($bdp_theme == 'famous') {
                $style += '.bdp_archive.famous .author-avatar-div, .bdp_blog_template.famous-grid .post-body-div { background: ' + $background + ';  }';
                $style += '.famous-grid .post-body-div h2.post_title, .famous-grid .post-body-div h2.post_title a { font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.famous-grid .post-body-div h2.post_title a:hover { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.famous-grid .post-body-div h2.post_title{ font-style: italic }';
                }
                $style += '.famous-grid .post-body-div .post_content, .famous-grid .bdp_post_content .post-tags span.link-lable, .bdp_blog_template.famous-grid .read_more_div a { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;  }';
                if ($content_font_italic == 1) {
                    $style += '.famous-grid .post-body-div .post_content, .famous-grid .bdp_post_content .post-tags span.link-lable, .bdp_blog_template.famous-grid .read_more_div a { font-style: italic }';
                }
                $style += '.famous-grid .bdp_post_content .category-link, .famous-grid .bdp_post_content .category-link a, .famous-grid .bdp_post_content .post-tags, .famous-grid .bdp_post_content .post-tags a, .famous-grid .bdp_post_content .metadatabox > span, .famous-grid .bdp_post_content .metadatabox > span a { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.famous-grid .bdp_post_content .category-link.bdp-no-links, .famous-grid .bdp_post_content .metadatabox > span.bdp-no-links, .famous-grid .bdp_post_content .post-tags.bdp-no-links { color:' + $contentcolor + '; }';
                $style += '.famous-grid .bdp_post_content .category-link a:hover, .famous-grid .bdp_post_content .post-tags a:hover, .famous-grid .bdp_post_content .metadatabox > span a:hover, .famous-grid .bdp_post_content .metadatabox > span:hover { color:' + $linkhovercolor + '; }';
                $style += '.bdp_blog_template.famous-grid .read_more_div a, .bdp_blog_template.famous-grid .post-body-div .label_featured_post { background:' + $readmorebackcolor + ';color:' + $readmorecolor + '; }';
                $style += '.bdp_blog_template.famous-grid .read_more_div a:hover { background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + '; }';
            }
            if($bdp_theme == 'steps') {
                $style += '.steps-wrapper .steps, .bdp_blog_template .steps > li, .bdp_blog_template .steps > li:before, .bdp_archive.steps .author-avatar-div, .bdp_archive.steps .author-avatar-div:before, .bdp_blog_template .steps > li .label_featured_post { border-color: ' + $templatecolor + '; }';
                $style += '.bdp_blog_template .steps > li .steps-postformate { border-color: ' + $templatecolor + '; color: ' + $templatecolor + ';  }';
                $style += '.bdp_blog_template .steps > li, .bdp_blog_template .steps > li:before, .bdp_archive.steps .author-avatar-div, .bdp_archive.steps .author-avatar-div:before { background : ' + $background + '; }';
                $style += '.steps-wrapper .steps::before, .steps-wrapper .steps::after { background: ' + $templatecolor + '; box-shadow: ' + bdp_hex2rgba($templatecolor, 30) + '; }';
                $style += '.steps-wrapper .steps h2.post-title, .steps-wrapper .steps h2.post-title a {background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.steps-wrapper .steps h2.post-title a:hover, .bdp_blog_template .steps > li .label_featured_post { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.steps-wrapper .steps h2.post-title{ font-style: italic }';
                }
                $style += '.steps-wrapper .steps .post_content { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                if ($content_font_italic == 1) {
                    $style += '.steps-wrapper .steps .post_content, .steps .post_content .read-more-div .more-tag { font-style: italic }';
                }
                $style += '.steps .post_content .read-more-div .more-tag { color:' + $readmorecolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }'
                $style += '.steps-wrapper .steps .categories, .steps-wrapper .steps .categories a, .steps-wrapper .steps .tags, .steps-wrapper .steps .tags a, .steps-wrapper .steps .post-meta > span, .steps-wrapper .steps .post-meta > span a { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.steps-wrapper .steps .categories a:hover, .steps-wrapper .steps .tags a:hover, .steps-wrapper .steps .post-meta span:hover, .steps-wrapper .steps .post-meta span a:hover, .steps .post_content .read-more-div .more-tag:hover { color:' + $linkhovercolor + '; }';
                $style += '.steps-wrapper .steps .post-meta > span.bdp-no-links, .steps-wrapper .steps .post-meta > span.bdp-no-links:hover, .steps-wrapper .steps .tags .link-lable, .steps-wrapper .steps .tags.bdp-no-links, .steps-wrapper .steps .categories.bdp-no-links { color:' + $contentcolor + '; }';
            }
            if($bdp_theme == 'minimal') {
                $style += '.minimal-post-container .minimal-entry, .minimal-entry .minimal-social-cover { background : ' + $background + '; }';
                $style += '.minimal .minimal-content-cover .post-title h2, .minimal .minimal-content-cover .post-title a { background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.minimal .minimal-content-cover .post-title a:hover { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.minimal .minimal-content-cover .post-title h2, .minimal .minimal-content-cover .post-title a { font-style: italic }';
                }
                $style += '.minimal .minimal-post-container:after {background : ' + $titlehovercolor + ';}';
                $style += '.minimal .minimal-content-cover .post-content, .minimal .minimal-content-cover .tags .link-lable { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px;  }';
                if ($content_font_italic == 1) {
                    $style += '.minimal .minimal-content-cover .post-content, .minimal .minimal-content-cover .tags .link-lable { font-style: italic }';
                }
                $style += '.minimal .minimal-content-cover .post-categories, .minimal .minimal-content-cover .post-categories a, .minimal .minimal-content-cover .post-meta, .minimal .minimal-content-cover .post-meta a, .minimal .minimal-content-cover .tags, .minimal .minimal-content-cover tags a { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.minimal .minimal-footer span, .minimal .minimal-footer span a, .minimal-social-cover .minimal-social-share-btn-close { color:' + $color + '; font-family:' + $template_titlefontface + '; font-size: ' + $template_titlefontsize + 'px; }';
                $style += '.minimal .minimal-content-cover .post-categories a:hover, .minimal .minimal-content-cover .post-meta a:hover, .minimal .minimal-content-cover .tags a:hover, .minimal .minimal-footer span:hover, .minimal .minimal-footer span:hover a, .minimal .minimal-footer span a:hover, .minimal-social-cover .minimal-social-share-btn-close:hover { color:' + $linkhovercolor + '; }';
                $style += '.minimal .minimal-content-cover .read_more_div a, .minimal-post-container .label_featured_post { background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; }'
                $style += '.minimal .minimal-content-cover .read_more_div a:hover { background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + ';  }'
            }
            if($bdp_theme == 'clicky') {
                $style += '.bdp_blog_template.clicky, .bdp_archive.clicky .bdp-author-avatar { background : ' + $background + '; }';
                $style += '.clicky .clicky-wrap h2.post-title, .clicky .clicky-wrap h2.post-title a {background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                $style += '.clicky .clicky-wrap h2.post-title a:hover { color : ' + $titlehovercolor + '; }';
                if ($template_title_font_italic == 1) {
                    $style += '.clicky .clicky-wrap h2.post-title { font-style: italic }';
                }
                $style += '.clicky .clicky-wrap .post_content, .clicky .clicky-wrap .post-meta-cats-tags .link-lable { color:' + $contentcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                $style += '.clicky .clicky-wrap .metadatabox span, .clicky .clicky-wrap .metadatabox span a, .clicky .clicky-wrap .post-meta-cats-tags, .clicky .clicky-wrap .post-meta-cats-tags a, .bdp_blog_template.clicky .label_featured_post { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; }';
                $style += '.clicky .clicky-wrap .metadatabox span:hover, .clicky .clicky-wrap .metadatabox span:hover a, .clicky .clicky-wrap .metadatabox span a:hover, .clicky .clicky-wrap .post-meta-cats-tags a:hover { color:' + $linkhovercolor + '; }';
                $style += '.clicky .clicky-wrap .metadatabox span.bdp-no-links, .clicky .clicky-wrap .post-meta-cats-tags .bdp-no-links, .clicky .clicky-wrap .metadatabox span:hover.bdp-no-links { color:' + $contentcolor + '; }';
                $style += '.bdp-author-avatar .avtar-img:before, .bdp-author-avatar .avtar-img:after, .bdp-author-avatar .author_content:before, .bdp-author-avatar .author_content:after, .clicky.even_class div.bdp-post-image:before, .clicky.even_class div.bdp-post-image:after, .clicky div.bdp-post-image:before,  .clicky div.bdp-post-image:after, .clicky.even_class .clicky-wrap:before, .clicky.even_class .clicky-wrap:after, .clicky .clicky-wrap:before, .clicky .clicky-wrap:after, .bdp_blog_template.clicky .label_featured_post { border-color:' + $color + ' !important; }';
                $style += '.clicky .bdp-post-image .read-more-div a.more-tag, .bdp_blog_template.clicky .label_featured_post {background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; border-color:' + $readmorehoverbackcolor + '; }';
                $style += '.clicky .bdp-post-image .read-more-div a.more-tag:hover { background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + '; }';
            }
            if($bdp_theme == 'miracle') {
                $style += '.bdp_blog_template.miracle_blog { background : ' + $background + '; }';
                $style += '.miracle_blog .bdp-author-avatar { border-color : ' + $background + '; }';
                $style += '.miracle_blog .bdp-post-format { font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + '; }';
                $style += '.miracle_blog .post-title h2, .miracle_blog .post-title h2 a {background: ' + $titlebackcolor + '; font-size: ' + $template_titlefontsize + 'px;color: ' + $titlecolor + ';font-family:' + $template_titlefontface + ';font-weight: ' + $template_title_font_weight + ';line-height: ' + $template_title_font_line_height + ';text-transform: ' + $template_title_font_text_transform + ';text-decoration: ' + $template_title_font_text_decoration + ';letter-spacing: ' + $template_title_font_letter_spacing + 'px; }';
                if ($template_title_font_italic == 1) {
                    $style += '.miracle_blog .post-title h2 { font-style: italic }';
                }
                $style += '.miracle_blog .post-title h2 a:hover { color : ' + $titlehovercolor + '; }';
                $style += '.miracle_blog .post-meta-cats-tags > div, .miracle_blog .post-meta > span, .miracle_blog .post-meta > span a { color:' + $color + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                $style += '.miracle_blog .post-meta-cats-tags > div.bdp_no_links, .miracle_blog .post-meta > span.bdp_no_links, .miracle_blog .post-meta-cats-tags > div .link-lable {  color:' + $contentcolor + ';  }';
                $style += '.miracle_blog .post-meta > span a:hover, .miracle_blog .post-meta > span a:focus { color:' + $linkhovercolor + '; }';
                $style += '.miracle_blog .read_more_div a.more-tag, .miracle_blog .label_featured_post span { background:' + $readmorebackcolor + '; color:' + $readmorecolor + '; border-color:' + $readmorehoverbackcolor + '; font-family:' + $content_font_family + '; font-size: ' + $content_fontsize + 'px; font-weight: ' + $content_font_weight + ';line-height: ' + $content_font_line_height + ';text-transform: ' + $content_font_text_transform + ';text-decoration: ' + $content_font_text_decoration + ';letter-spacing: ' + $content_font_letter_spacing + 'px; }';
                $style += '.miracle_blog .read_more_div a.more-tag:hover { background:' + $readmorehoverbackcolor + ';color:' + $readmorecolor + '; }';
            }

            if (jQuery('.custom_archive_type').val() == 'author_template') {
                $style += '.bdp_archive .author-avatar-div .author_content .author a,.bdp_archive .author-avatar-div .author_content .author{ font-size: ' + $authorTitleSize + 'px;font-family: ' + $authorTitleFace + ' }';
                $style += '.bdp_archive .author-avatar-div .author_content > p{ font-size: ' + $content_fontsize + 'px;color: ' + $contentcolor + ' }';
            }

            if (jQuery('#custom_css').val() != '') {
                $style += jQuery('#custom_css').val();
            }
            var flexslider_css = plugin_path + '/css/flexslider.css';
            var flexslider_js = plugin_path + '/js/jquery.flexslider-min.js';
            jQuery('head').append('<link rel="stylesheet" id="bdp-template-main-css" type="text/css" href="' + href + '">');
            jQuery('head').append('<style type="text/css" id="template-dynamic-style" >' + $style + '</style>');
            jQuery('head').append('<link rel="stylesheet" id="bdp-theme-style" type="text/css" href="' + style_path + '">');
            jQuery('head').append('<script type="text/javascript" id="bdp-admin-flexslider-js" src="' + flexslider_js + '">');
            jQuery('head').append('<link rel="stylesheet" id="bdp-admin-flexslider-css" type="text/css" href="' + flexslider_css + '">');
            jQuery('head').append('<link rel="stylesheet" id="bdp-front-style" type="text/css" href="' + front_href + '">');
            if (jQuery('body').hasClass('rtl')) {
                jQuery('head').append('<link rel="stylesheet" id="bdp-front-rtl-style" type="text/css" href="' + front_rtl_href + '">');
            }
            if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
                jQuery('head').append('<script type="text/javascript" id="bdp-admin-masonary-effect" src="' + home_path + '/wp-includes/js/masonry.min.js">');
                jQuery('head').append('<script type="text/javascript" id="bdp-admin-image-effect" src="' + home_path + '/wp-includes/js/imagesloaded.min.js">');
            }
            if (jQuery(this).hasClass('archive_show_preview')) {
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'bdp_archive_preview_request',
                        settings: data
                    },
                    success: function (response) {
                        if (response != 0) {
                            if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
                                if (jQuery('#pagination_type').val() == 'load_more_btn') {
                                    var $masonry_div = jQuery(jQuery.parseHTML(response)).find(".bdp-js-masonry.masonry");
                                } else {
                                    var $masonry_div = jQuery(jQuery.parseHTML(response)).find(".bdp-js-masonry.masonry");
                                }
                                if ($masonry_div.hasClass('bdp_glossary') || $masonry_div.hasClass('bdp_boxy')) {
                                    jQuery('.bdp-js-masonry.masonry').imagesLoaded(function () {
                                        jQuery('.bdp-js-masonry.masonry').masonry({
                                            columnWidth: 0,
                                            itemSelector: '.blog_masonry_item',
                                            isResizable: true
                                        });
                                    });
                                }
                            }
                            jQuery('#bdp-preview-box').html(response).dialog({
                                title: bdpro_js.archive_template_preview,
                                dialogClass: 'bdp_template_preview_model',
                                width: jQuery(window).width() - 216,
                                height: jQuery(window).height() - 100,
                                modal: true,
                                draggable: false,
                                resizable: false,
                                open: function (event, ui) {
                                    setTimeout(function () {
                                    }, 5000);
                                    jQuery('body.blog-designer_page_bdp_add_archive_layout').css('position', 'relative').css('overflow', 'hidden');
                                    if ($bdp_theme == 'boxy-clean') {
                                        bdp_get_boxy_clean_height();
                                    }
                                    if ($bdp_theme == 'brit_co') {
                                        bdp_get_brit_co_height();
                                    }
                                    if ($bdp_theme == 'timeline') {
                                        jQuery('.bdp_template_preview_model #bdp-preview-box').animate({
                                            scrollTop: 0
                                        }, 0);
                                        var elems = jQuery('.animateblock');
                                        var winheight = jQuery(window).height();
                                        elems.each(function () {
                                            var elm = jQuery(this);
                                            var topcoords = elm.offset().top;
                                            if (topcoords < winheight) {
                                                elm.addClass('animated');
                                                elm.removeClass('animateblock');
                                            }
                                        });
                                        jQuery('.timeline').each(function () {
                                            if (jQuery(this).offset().top < winheight)
                                            {
                                                var width = jQuery(this).attr('data-width');
                                                jQuery(this).animate({
                                                    width: width
                                                }, 1000);
                                            }
                                        });
                                        jQuery('.bdp_template_preview_model #bdp-preview-box').scroll(function () {
                                            bdp_animate_elems();
                                        });
                                    }
                                    if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                                        jQuery(".logbook").logbook({
                                            levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                            showYears: 10,
                                            del: 130,
                                            vertical: false,
                                            isPostLink: false,
                                            isYears: false,
                                            triggerWidth: 800,
                                            itemMargin: 20,
                                            customSize: {
                                                "sheet": {"itemWidth": jQuery('#item_width').val(), "itemHeight": jQuery('#item_height').val(), "margin": "20"},
                                                "active": {"itemWidth": jQuery('#item_width').val(), "itemHeight": jQuery('#item_height').val(), "imageHeight": "150"}
                                            },
                                            id: 10,
                                            easing: jQuery('#template_easing').val(),
                                            enableSwipe: true,
                                            startFrom: '' + jQuery("#timeline_start_from").val() + '',
                                            enableYears: true,
                                            class: {
                                                readMore: '.lb-read-more',
                                            },
                                            hideLogbook: (jQuery("input[name='display_timeline_bar']:checked").val() == 1) ? true : false,
                                            hideArrows: false,
                                            closeItemOnTransition: false,
                                            autoplay: (jQuery("input[name='enable_autoslide']:checked").val() == 1) ? true : false,
                                            scrollSpeed: jQuery('#scroll_speed').val(),
                                        });
                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post-title').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post-title').css('min-height', maxHeight + 70);

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post_content_wrap').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post_content_wrap').css('min-height', Math.round(maxHeight) + 30);

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post_hentry').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post_hentry').css('min-height', Math.round(maxHeight));

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post-content-area .post_content').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post-content-area .post_content').css('min-height', Math.round(maxHeight + 80));

                                        var maxHeight = Math.max.apply(null, jQuery('.overlay_horizontal .post_hentry').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        if (maxHeight == 0) {
                                            maxHeight = '420';
                                        }
                                        jQuery('.logbook .lb-item .post-image img').css('min-height', Math.round(maxHeight));
                                        jQuery('.logbook .lb-item .post-image').css('min-height', Math.round(maxHeight));
                                    }
                                    if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
                                        var $slider_columns = 1;
                                        if (jQuery('#template_slider_effect').val() == 'slide') {
                                            if (jQuery(window).width() > 980) {
                                                $slider_columns = jQuery('#template_slider_columns').val();
                                            } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
                                                $slider_columns = jQuery('#template_slider_columns_ipad').val();
                                            } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
                                                $slider_columns = jQuery('#template_slider_columns_tablet').val();
                                            } else if (jQuery(window).width() <= 480) {
                                                $slider_columns = jQuery('#template_slider_columns_mobile').val();
                                            }
                                        }
                                        jQuery('.slider_template').flexslider({
                                            move: jQuery('#template_slider_scroll').val(),
                                            animation: jQuery('#template_slider_effect').val(),
                                            itemWidth: 10,
                                            itemMargin: 15,
                                            minItems: 1,
                                            maxItems: $slider_columns,
                                            slideshow: (jQuery('input[name=slider_autoplay]:checked').val() == 1) ? true : false,
                                            slideshowSpeed: jQuery('#slider_autoplay_intervals').val(),
                                            animationSpeed: jQuery('#slider_speed').val(),
                                            prevText: '<div class="' + jQuery('input[name=arrow_style_hidden]').val() + '"></div>',
                                            nextText: '<div class="' + jQuery('input[name=arrow_style_hidden]').val() + '"></div>',
                                            directionNav: (jQuery('input[name=display_slider_controls]:checked').val() == 1) ? true : false,
                                            rtl: (jQuery('body').hasClass('rtl')) ? true : false,
                                        });
                                    }
                                    if ($bdp_theme == 'easy_timeline') {
                                        var effect = jQuery('.easy-timeline').attr('data-effect');
                                        jQuery('.easy-timeline li').each(function () {
                                            if (jQuery(this).offset().top > jQuery(window).scrollTop() + jQuery(window).height() * 0.75) {
                                                jQuery(this).addClass('is-hidden');
                                            } else {
                                                jQuery(this).addClass(effect);
                                            }
                                        });

                                        jQuery('.bdp_template_preview_model .bdp-preview-box').on('scroll', function () {
                                            jQuery('.easy-timeline li').each(function () {
                                                if ((jQuery(this).offset().top <= (jQuery(window).scrollTop() + jQuery(window).height() * 0.75)) && jQuery(this).hasClass("is-hidden")) {
                                                    jQuery(this).removeClass("is-hidden").addClass(effect);
                                                }
                                            });
                                        });
                                    }
                                    if ($bdp_theme == 'elina') {
                                        jQuery('.post-share-div > a.post-share').parent().find('.social-component').append("<div class='social-share social-close-btn'><a class='close-div'title='close' href='javascript:void(0)'>x</a></div>");
                                        jQuery('.post-share-div > a.post-share').on('click', function () {
                                            jQuery(this).parent().find('.social-component').addClass('open-content');
                                            jQuery(this).parent().find('.social-component > .social-share > a').addClass('add-eff');
                                        });
                                        jQuery('.social-share a.close-div').on('click', function () {
                                            jQuery(this).parents('.post-share-div').find('.social-component').removeClass('open-content');
                                            jQuery(this).parents('.post-share-div').find('.social-component > .social-share > a').removeClass('add-eff');
                                        });
                                    }
                                    if($bdp_theme == 'glamour') {
                                        jQuery(document).on('click', '.glamour-social-links', function () {
                                            jQuery(this).parents('.glamour-blog').find('.glamour-social-cover').addClass('show');
                                        });
                                        jQuery(document).on('click', '.glamour-social-links-closed', function () {
                                            jQuery(this).parents('.glamour-social-cover').removeClass('show');
                                        });

                                        var $minHeight = jQuery('.glamour .glamour-social-cover').outerHeight();
                                        $minHeight = $minHeight + 2;
                                        jQuery('.glamour .glamour-social-cover').css({ 'bottom': '-'+ $minHeight +'px'});
                                    }
                                    if($bdp_theme == 'fairy') {
                                        fairy_template_height();
                                        jQuery(document).on('click', '.fairy .fairy_footer .fairy-post-share', function() {
                                            jQuery(this).parents('.fairy_wrap').find('.fairy-social-cover').addClass('show');
                                            jQuery(this).parents('.fairy_wrap').find('.fairy-social-cover').css({'bottom': 0 });
                                        })
                                        jQuery(document).on('click', '.fairy .fairy-social-cover .fairy-social-div-closed', function() {
                                            var $fairy_wrap =  jQuery(this).closest('.fairy_wrap');
                                            var $minHeight = $fairy_wrap.find('.fairy_footer').outerHeight();
                                            var $socialHeight = $fairy_wrap.find('.fairy-social-cover .social-component').outerHeight();
                                            if($minHeight < $socialHeight) {
                                                $minHeight = $socialHeight;
                                            }
                                            jQuery(this).parents('.fairy-social-cover').removeClass('show');
                                            jQuery(this).parents('.fairy-social-cover').css({ 'bottom': '-'+ $minHeight +'px' });
                                        })
                                    }
                                    if($bdp_theme == 'clicky') {
                                        setTimeout( function(){
                                            jQuery('.bdp_blog_template.clicky').each(function() {
                                                jQuery(this).find('.clicky-wrap').removeClass('bdp-clicky-center');
                                                jQuery(this).find('.bdp-post-image').removeClass('bdp-clicky-center');
                                                jQuery(this).find('.clicky-wrap').removeAttr('style');
                                                jQuery(this).find('.bdp-post-image').removeAttr('style');
                                                var $imgDivHeight = jQuery(this).find('.bdp-post-image').outerHeight();
                                                var $contentDivHeight = jQuery(this).find('.clicky-wrap').outerHeight();
                                                if($imgDivHeight > $contentDivHeight) {
                                                    jQuery(this).find('.clicky-wrap').addClass('bdp-clicky-center').css('min-height', $imgDivHeight + 'px');
                                                } else if($imgDivHeight < $contentDivHeight) {
                                                    jQuery(this).find('.bdp-post-image').addClass('bdp-clicky-center').css('min-height', $contentDivHeight + 'px');
                                                }
                                            });

                                        }, 1000);
                                    }
                                    if($bdp_theme == 'minimal') {
                                        jQuery(document).on('click', '.minimal-footer span.minimal-social-share-btn', function() {
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').addClass('show');
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').css({'bottom': '15px' });
                                        });
                                        jQuery(document).on('click', '.minimal-social-cover span.minimal-social-share-btn-close', function() {
                                            var $minHeight = jQuery('.minimal .minimal-entry .minimal-social-cover').outerHeight();
                                            $minHeight = $minHeight + 2;
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').removeClass('show');
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').css({ 'bottom': '-'+ $minHeight +'px' });
                                        });
                                    }
                                    jQuery('.bdp-flexslider.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: false,
                                        prevText: "",
                                        nextText: "",
                                        rtl: bdpro_js.is_rtl
                                    });
                                },
                                close: function (event, ui) {
                                    jQuery('#template-dynamic-style').remove();
                                    jQuery('#bdp-template-main-css').remove();
                                    jQuery('#bdp-theme-style').remove();
                                    jQuery('#bdp-front-style').remove();
                                    jQuery('#bdp-front-rtl-style').remove();
                                    jQuery('#bdp-admin-masonary-effect').remove();
                                    jQuery('#bdp-admin-image-effect').remove();
                                    jQuery('#bdp-admin-flexslider-js').remove();
                                    jQuery('#bdp-admin-flexslider-css').remove();
                                    jQuery('body.blog-designer_page_bdp_add_archive_layout').css('position', 'unset').css('overflow', 'visible');
                                }
                            }).dialog('open');
                            can_preview = 1;
                            jQuery('.splash-screen').hide();
                        }
                    }
                });
            } else {
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'bdp_preview_request',
                        settings: data
                    },
                    success: function (response) {
                        if (response != 0) {
                            if ($bdp_theme == 'glossary' || $bdp_theme == 'boxy') {
                                if (jQuery('#pagination_type').val() == 'load_more_btn') {
                                    var $masonry_div = jQuery(jQuery.parseHTML(response)).find(".bdp-js-masonry.masonry");
                                } else {
                                    var $masonry_div = jQuery(jQuery.parseHTML(response)).find(".bdp-js-masonry.masonry");
                                }

                                if ($masonry_div.hasClass('bdp_glossary') || $masonry_div.hasClass('bdp_boxy')) {
                                    jQuery('.bdp-js-masonry.masonry').imagesLoaded(function () {
                                        jQuery('.bdp-js-masonry.masonry').masonry({
                                            columnWidth: 0,
                                            itemSelector: '.blog_masonry_item',
                                            isResizable: true
                                        });
                                    });
                                }
                            }
                            jQuery('#bdp-preview-box').html(response).dialog({
                                title: bdpro_js.template_preview,
                                dialogClass: 'bdp_template_preview_model',
                                width: jQuery(window).width() - 216,
                                height: jQuery(window).height() - 100,
                                modal: true,
                                draggable: false,
                                resizable: false,
                                open: function (event, ui) {
                                    setTimeout(function () {
                                    }, 5000);
                                    jQuery('body.blog-designer_page_add_shortcode').css('position', 'relative').css('overflow', 'hidden');
                                    if ($bdp_theme == 'boxy-clean') {
                                        bdp_get_boxy_clean_height();
                                    }
                                    if ($bdp_theme == 'brit_co') {
                                        bdp_get_brit_co_height();
                                    }
                                    if ($bdp_theme == 'timeline') {
                                        jQuery('.bdp_template_preview_model #bdp-preview-box').animate({
                                            scrollTop: 0
                                        }, 0);
                                        var elems = jQuery('.animateblock');
                                        var winheight = jQuery(window).height();
                                        elems.each(function () {
                                            var elm = jQuery(this);
                                            var topcoords = elm.offset().top;
                                            if (topcoords < winheight) {
                                                elm.addClass('animated');
                                                elm.removeClass('animateblock');
                                            }
                                        });
                                        jQuery('.timeline').each(function () {
                                            if (jQuery(this).offset().top < winheight)
                                            {
                                                var width = jQuery(this).attr('data-width');
                                                jQuery(this).animate({
                                                    width: width
                                                }, 1000);
                                            }
                                        });
                                        jQuery('.bdp_template_preview_model #bdp-preview-box').scroll(function () {
                                            bdp_animate_elems();
                                        });
                                    }
                                    if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                                        jQuery(".logbook").logbook({
                                            levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                            showYears: 10,
                                            del: 130,
                                            vertical: false,
                                            isPostLink: false,
                                            isYears: false,
                                            triggerWidth: 800,
                                            itemMargin: 20,
                                            customSize: {
                                                "sheet": {"itemWidth": jQuery('#item_width').val(), "itemHeight": jQuery('#item_height').val(), "margin": "20"},
                                                "active": {"itemWidth": jQuery('#item_width').val(), "itemHeight": jQuery('#item_height').val(), "imageHeight": "150"}
                                            },
                                            id: 10,
                                            easing: jQuery('#template_easing').val(),
                                            enableSwipe: true,
                                            startFrom: '' + jQuery("#timeline_start_from").val() + '',
                                            enableYears: true,
                                            class: {
                                                readMore: '.lb-read-more',
                                            },
                                            hideLogbook: false,
                                            hideArrows: false,
                                            closeItemOnTransition: false,
                                            scrollSpeed: jQuery('#scroll_speed').val(),
                                        });
                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post-title').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post-title').css('min-height', maxHeight + 70);

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post_content_wrap').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post_content_wrap').css('min-height', Math.round(maxHeight) + 30);

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post_hentry').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post_hentry').css('min-height', Math.round(maxHeight));

                                        var maxHeight = Math.max.apply(null, jQuery('.horizontal .post-content-area .post_content').map(function () {
                                            return jQuery(this).height();
                                        }).get());
                                        jQuery('.horizontal .post-content-area .post_content').css('min-height', Math.round(maxHeight + 80));
                                    }
                                    if ($bdp_theme == 'crayon_slider' || $bdp_theme == 'sallet_slider' || $bdp_theme == 'sunshiny_slider') {
                                        var $slider_columns = 1;
                                        if (jQuery('#template_slider_effect').val() == 'slide') {
                                            if (jQuery(window).width() > 980) {
                                                $slider_columns = jQuery('#template_slider_columns').val();
                                            } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
                                                $slider_columns = jQuery('#template_slider_columns_ipad').val();
                                            } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
                                                $slider_columns = jQuery('#template_slider_columns_tablet').val();
                                            } else if (jQuery(window).width() <= 480) {
                                                $slider_columns = jQuery('#template_slider_columns_mobile').val();
                                            }
                                        }
                                        jQuery('.slider_template').flexslider({
                                            move: jQuery('#template_slider_scroll').val(),
                                            animation: jQuery('#template_slider_effect').val(),
                                            itemWidth: 210,
                                            itemMargin: 15,
                                            minItems: 1,
                                            maxItems: $slider_columns,
                                            slideshow: (jQuery('input[name=slider_autoplay]:checked').val() == 1) ? true : false,
                                            slideshowSpeed: jQuery('#slider_autoplay_intervals').val(),
                                            animationSpeed: jQuery('#slider_speed').val(),
                                            prevText: '<div class="' + jQuery('input[name=arrow_style_hidden]').val() + '"></div>',
                                            nextText: '<div class="' + jQuery('input[name=arrow_style_hidden]').val() + '"></div>',
                                            directionNav: (jQuery('input[name=display_slider_controls]:checked').val() == 1) ? true : false,
                                            rtl: (jQuery('body').hasClass('rtl')) ? true : false,
                                        });
                                    }
                                    if ($bdp_theme == 'easy_timeline') {
                                        var effect = jQuery('.easy-timeline').attr('data-effect');
                                        jQuery('.easy-timeline li').each(function () {
                                            if (jQuery(this).offset().top > jQuery(window).scrollTop() + jQuery(window).height() * 0.75) {
                                                jQuery(this).addClass('is-hidden');
                                            } else {
                                                jQuery(this).addClass(effect);
                                            }
                                        });

                                        jQuery('.bdp_template_preview_model .bdp-preview-box').on('scroll', function () {
                                            jQuery('.easy-timeline li').each(function () {
                                                if ((jQuery(this).offset().top <= (jQuery(window).scrollTop() + jQuery(window).height() * 0.75)) && jQuery(this).hasClass("is-hidden")) {
                                                    jQuery(this).removeClass("is-hidden").addClass(effect);
                                                }
                                            });
                                        });
                                    }

                                    if ($bdp_theme == 'story') {
                                        jQuery('.bdp_template_preview_model #bdp-preview-box').scroll(function () {
                                            bdp_animate_elems();
                                        });
                                    }
                                    if ($bdp_theme == 'elina') {
                                        jQuery('.post-share-div > a.post-share').parent().find('.social-component').append("<div class='social-share social-close-btn'><a class='close-div'title='close' href='javascript:void(0)'>x</a></div>");
                                        jQuery('.post-share-div > a.post-share').on('click', function () {
                                            jQuery(this).parent().find('.social-component').addClass('open-content');
                                            jQuery(this).parent().find('.social-component > .social-share > a').addClass('add-eff');
                                        });
                                        jQuery('.social-share a.close-div').on('click', function () {
                                            jQuery(this).parents('.post-share-div').find('.social-component').removeClass('open-content');
                                            jQuery(this).parents('.post-share-div').find('.social-component > .social-share > a').removeClass('add-eff');
                                        });
                                    }
                                    if($bdp_theme == 'glamour') {
                                        jQuery(document).on('click', '.glamour-social-links', function () {
                                            jQuery(this).parents('.glamour-blog').find('.glamour-social-cover').addClass('show');
                                        });
                                        jQuery(document).on('click', '.glamour-social-links-closed', function () {
                                            jQuery(this).parents('.glamour-social-cover').removeClass('show');
                                        });
                                        var $minHeight = jQuery('.glamour .glamour-social-cover').outerHeight();
                                        $minHeight = $minHeight + 2;
                                        jQuery('.glamour .glamour-social-cover').css({ 'bottom': '-'+ $minHeight +'px'});
                                    }
                                    if($bdp_theme == 'fairy') {
                                        fairy_template_height();

                                        jQuery(document).on('click', '.fairy .fairy_footer .fairy-post-share', function() {
                                            jQuery(this).parents('.fairy_wrap').find('.fairy-social-cover').addClass('show');
                                            jQuery(this).parents('.fairy_wrap').find('.fairy-social-cover').css({'bottom': 0 });
                                        })
                                        jQuery(document).on('click', '.fairy .fairy-social-cover .fairy-social-div-closed', function() {
                                            var $fairy_wrap =  jQuery(this).closest('.fairy_wrap');
                                            var $minHeight = $fairy_wrap.find('.fairy_footer').outerHeight();
                                            var $socialHeight = $fairy_wrap.find('.fairy-social-cover .social-component').outerHeight();
                                            if($minHeight < $socialHeight) {
                                                $minHeight = $socialHeight;
                                            }
                                            jQuery(this).parents('.fairy-social-cover').removeClass('show');
                                            jQuery(this).parents('.fairy-social-cover').css({ 'bottom': '-'+ $minHeight +'px' });
                                        })
                                    }
                                    if($bdp_theme == 'minimal') {
                                        jQuery(document).on('click', '.minimal-footer span.minimal-social-share-btn', function() {
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').addClass('show');
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').css({'bottom': '15px' });
                                        });
                                        jQuery(document).on('click', '.minimal-social-cover span.minimal-social-share-btn-close', function() {
                                            var $minHeight = jQuery('.minimal .minimal-entry .minimal-social-cover').outerHeight();
                                            $minHeight = $minHeight + 2;
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').removeClass('show');
                                            jQuery(this).parents('.minimal-entry').find('.minimal-social-cover').css({ 'bottom': '-'+ $minHeight +'px' });
                                        });
                                    }
                                    if($bdp_theme == 'clicky') {
                                        setTimeout( function(){
                                            jQuery('.bdp_blog_template.clicky').each(function() {
                                                jQuery(this).find('.clicky-wrap').removeClass('bdp-clicky-center');
                                                jQuery(this).find('.bdp-post-image').removeClass('bdp-clicky-center');
                                                jQuery(this).find('.clicky-wrap').removeAttr('style');
                                                jQuery(this).find('.bdp-post-image').removeAttr('style');
                                                var $imgDivHeight = jQuery(this).find('.bdp-post-image').outerHeight();
                                                var $contentDivHeight = jQuery(this).find('.clicky-wrap').outerHeight();
                                                if($imgDivHeight > $contentDivHeight) {
                                                    jQuery(this).find('.clicky-wrap').addClass('bdp-clicky-center').css('min-height', $imgDivHeight + 'px');
                                                } else if($imgDivHeight < $contentDivHeight) {
                                                    jQuery(this).find('.bdp-post-image').addClass('bdp-clicky-center').css('min-height', $contentDivHeight + 'px');
                                                }
                                            });

                                        }, 1000);
                                    }
                                    jQuery('.bdp-flexslider.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: false,
                                        prevText: "",
                                        nextText: "",
                                        rtl: bdpro_js.is_rtl
                                    });
                                },
                                close: function (event, ui) {
                                    if ($bdp_theme == 'cool_horizontal' || $bdp_theme == 'overlay_horizontal') {
                                        jQuery('#bdp-admin-logbook-js').remove();
                                        jQuery('#bdp-admin-easing-js').remove();
                                        jQuery('#bdp-admin-logbook-css').remove();
                                    }
                                    jQuery('#template-dynamic-style').remove();
                                    jQuery('#bdp-template-main-css').remove();
                                    jQuery('#bdp-theme-style').remove();
                                    jQuery('#bdp-front-style').remove();
                                    jQuery('#bdp-front-rtl-style').remove();
                                    jQuery('#bdp-admin-masonary-effect').remove();
                                    jQuery('#bdp-admin-flexslider-js').remove();
                                    jQuery('#bdp-admin-flexslider-css').remove();
                                    jQuery('#bdp-admin-timeline-js').remove();
                                    jQuery('#bdp-admin-timeline-css').remove();
                                    jQuery('.bdp_google_font_link').remove();
                                    jQuery('body.blog-designer_page_add_shortcode').css('position', 'unset').css('overflow', 'visible');
                                }
                            }).dialog('open');
                            can_preview = 1;
                            jQuery('.splash-screen').hide();
                        }
                    }
                });
            }
        }
    });

    jQuery(document).on('click', ".wl_pagination_box .page-numbers li a", function (e) {
        e.preventDefault();
    });

    jQuery(".excerpt_length input[type='text']").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                        (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    /* Licence Page Version, Newsletter, and Update history. */
    jQuery('.bdp-info-block .bdp-info-heading').click(function () {
        if (jQuery(this).parent('div.bdp-info-block').hasClass('closed')) {
            jQuery(this).parent('div.bdp-info-block').removeClass('closed');
        } else {
            jQuery(this).parent('div.bdp-info-block').addClass('closed');
        }
        var closed = jQuery('.bdp-admin').find('.closed').map(function () {
            return this.id;
        }).get().join(',');
        jQuery.post(ajaxurl, {
            action: 'bdp_closed_bdpboxes',
            closed: closed,
            page: 'bdp_getting_started&tab=register_product'
        });
    });

    jQuery(document).on('click', '.bdp-upload_image_button', function (event) {
        event.preventDefault();
        var frame;
        var $el = jQuery(this);
        var _parentTD = $el.closest('div');
        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create the media frame.
        frame = wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),
            // Customize the submit button.
            button: {
                // Set the text of the button.
                text: $el.data('update'),
                // Tell the button not to close the modal, since we're
                // going to refresh the page when the image is selected.
                close: false,
            },
            multiple: false,
            library: {
                type: 'image'
            },
        });

        // When an image is selected, run a callback.
        frame.on('select', function () {
            // Grab the selected attachment.
            var attachment = frame.state().get('selection').first();
            frame.close(attachment);
            console.log(attachment);
            _parentTD.find('span.bdp_default_image_holder').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
            _parentTD.find('#bdp_default_image_id').val(attachment.attributes.id);
            _parentTD.find('#bdp_default_image_src').val(attachment.attributes.url);
            $el.removeClass('bdp-upload_image_button');
            $el.addClass('bdp-remove_image_button');
            $el.val('');
            $el.val('Remove Image');
        });

        // Finally, open the modal.
        frame.open();
    });
    jQuery(document).on('click', '.bdp-remove_image_button', function (event) {
        event.preventDefault();
        var $el = jQuery(this);
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');
        $el.addClass('bdp-upload_image_button');
        $el.removeClass('bdp-remove_image_button');
        $el.val('');
        $el.val('Upload Image');
    });

    /* BDP loader upload */
    jQuery(document).on('click', '.bdp-loader_upload_image_button', function (event) {
        event.preventDefault();
        var frame;
        var $el = jQuery(this);
        var _parentTD = $el.closest('td');
        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create the media frame.
        frame = wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),
            // Customize the submit button.
            button: {
                // Set the text of the button.
                text: $el.data('update'),
                // Tell the button not to close the modal, since we're
                // going to refresh the page when the image is selected.
                close: false,
            },
            multiple: false,
            library: {
                type: 'image'
            },
        });

        // When an image is selected, run a callback.
        frame.on('select', function () {
            // Grab the selected attachment.
            var attachment = frame.state().get('selection').first();
            frame.close(attachment);
            _parentTD.find('span.bdp_loader_image_holder').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
            _parentTD.find('#bdp_loader_image_id').val(attachment.attributes.id);
            _parentTD.find('#bdp_loader_image_src').val(attachment.attributes.url);
            $el.removeClass('bdp-loader_upload_image_button');
            $el.addClass('bdp-remove_upload_image_button');
            $el.val('');
            $el.val('Remove Image');
        });

        // Finally, open the modal.
        frame.open();
    });
    jQuery(document).on('click', '.bdp-remove_upload_image_button', function (event) {
        event.preventDefault();
        var $el = jQuery(this);
        jQuery('.bdp_loader_image_holder > img').slideDown().remove();
        jQuery('#bdp_loader_image_id').val('');
        jQuery('#bdp_loader_image_src').val('');
        $el.addClass('bdp-loader_upload_image_button');
        $el.removeClass('bdp-remove_upload_image_button');
        $el.val('');
        $el.val('Upload Image');
    });

    /**
     * Single Page Override type
     */
    if (jQuery('#bdp_single_type').val() == 'category') {
        jQuery('.single_category_list_tr').show();
        jQuery('.single_tag_list_tr').hide();
        jQuery('.single_all_post_tr').show();
    } else if (jQuery('#bdp_single_type').val() == 'tag') {
        jQuery('.single_category_list_tr').hide();
        jQuery('.single_tag_list_tr').show();
        jQuery('.single_all_post_tr').show();
    } else {
        jQuery('.single_category_list_tr').hide();
        jQuery('.single_tag_list_tr').hide();
        jQuery('.single_all_post_tr').hide();
    }
    if (!jQuery('#override_single').attr('checked')) {
        jQuery('.single_category_list_tr').hide();
        jQuery('.single_tag_list_tr').hide();
        jQuery('.single_all_post_tr').hide();
    }
    jQuery('#bdp_single_type').change(function () {
        jQuery('#template_category').find('option:selected').prop("selected", false);
        jQuery('#template_category').trigger("chosen:updated");
        jQuery('#template_tags').find('option:selected').prop("selected", false);
        jQuery('#template_tags').trigger("chosen:updated");
        jQuery('#template_posts').find('option:selected').prop("selected", false);
        jQuery('#template_posts').trigger("chosen:updated");
        if (jQuery(this).val() == 'all') {
            jQuery('.single_category_list_tr').hide();
            jQuery('.single_tag_list_tr').hide();
            jQuery('.single_all_post_tr').hide();
        } else if (jQuery(this).val() == 'category') {
            var taxonomy_ids = jQuery(".single_category_list_tr #template_category").val();
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'bdp_get_posts_single_template',
                    tax_ids: taxonomy_ids,
                    tax: 'category'
                },
                success: function (response) {
                    jQuery(response).find(".chosen-select").chosen();
                    jQuery('.single_all_post_tr').html(response);
                    jQuery(".chosen-select").chosen();
                    bdpAltBackground();
                }
            });
            jQuery('.single_category_list_tr').show();
            jQuery('.single_tag_list_tr').hide();
            jQuery('.single_all_post_tr').show();
        } else {
            var taxonomy_ids = jQuery(".single_tag_list_tr #template_tags").val();
            jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'bdp_get_posts_single_template',
                    tax_ids: taxonomy_ids,
                    tax: 'tag'
                },
                success: function (response) {
                    jQuery(response).find(".chosen-select").chosen();
                    jQuery('.single_all_post_tr').html(response);
                    jQuery(".chosen-select").chosen();
                    bdpAltBackground();
                }
            });
            jQuery('.single_category_list_tr').hide();
            jQuery('.single_tag_list_tr').show();
            jQuery('.single_all_post_tr').show();
        }
    });
    jQuery(".single_tag_list_tr #template_tags").chosen().change(function () {
        var taxonomy_ids = jQuery(this).val();
        var taxonomy = 'tag';
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_get_posts_single_template',
                tax_ids: taxonomy_ids,
                tax: taxonomy
            },
            success: function (response) {
                jQuery(response).find(".chosen-select").chosen();
                jQuery('.single_all_post_tr').html(response);
                jQuery(".chosen-select").chosen();
                bdpAltBackground();
            }
        });
    });
    jQuery(".single_category_list_tr #template_category").chosen().change(function () {
        var taxonomy_ids = jQuery(this).val();
        var taxonomy = 'category';
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bdp_get_posts_single_template',
                tax_ids: taxonomy_ids,
                tax: taxonomy
            },
            success: function (response) {
                jQuery(response).find(".chosen-select").chosen();
                jQuery('.single_all_post_tr').html(response);
                jQuery(".chosen-select").chosen();
                bdpAltBackground();
            }
        });
    });
    bdpAltBackground();
});


function blogTemplateSearch($template_name) {
    var template_name = jQuery('.bdp_template_name').val();
    var $template_cat = jQuery('.bdp_template_tab').find('.current_tab a').attr('href');
    var $all_template_hide = true;
    if ($template_name.length < 3) {
        $template_name = '';
    }
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'bdp_blog_template_search_result',
            temlate_name: $template_name,
        },
        success: function (response) {
            jQuery('.bdp-blog-template-cover').html(response);
            var $href = $template_cat.replace('#', '');
            jQuery('.template-thumbnail').hide();
            if ($href == 'all') {
                jQuery('.template-thumbnail').show();
            } else {
                jQuery('.' + $href + '.template-thumbnail').show();
            }
            jQuery('.template-thumbnail').each(function () {
                if (jQuery(this).is(':visible')) {
                    $all_template_hide = false;
                }
            });
            if ($all_template_hide) {
                jQuery('.no-template').show();
            } else {
                jQuery('.no-template').hide();
            }
            jQuery("#popupdiv div.template-thumbnail .popup-select a").click(function (e) {
                e.preventDefault();
                jQuery('#popupdiv div.template-thumbnail').removeClass('bdp_selected_template');
                jQuery(this).parents('div.template-thumbnail').addClass('bdp_selected_template');
            });
            jQuery('#popupdiv .template-thumbnail').removeClass('bdp_selected_template');
            jQuery('#popupdiv .template-thumbnail').each(function () {
                if (jQuery(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                    jQuery(this).addClass('bdp_selected_template');
                }
            });

            jQuery('.bdp-blog-template-cover .template-thumbnail').each(function () {
                var templateLable = jQuery(this).data('value');
                if(templateLable != '' && templateLable != undefined) {
                    jQuery(this).append('<div class="bdp-label">'+ templateLable +'</div>')
                }
            });
        }
    });
}

function singleBlogTemplateSearch($template_name) {
    var template_name = jQuery('.bdp_template_name').val();
    var $template_cat = jQuery('.bdp_template_tab').find('.current_tab a').attr('href');
    var $all_template_hide = true;
    if ($template_name.length < 3) {
        $template_name = '';
    }
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'bdp_single_blog_template_search_result',
            temlate_name: $template_name,
        },
        success: function (response) {
            jQuery('.bdp-blog-template-cover').html(response);
            var $href = $template_cat.replace('#', '');
            jQuery('.template-thumbnail').hide();
            if ($href == 'all') {
                jQuery('.template-thumbnail').show();
            } else {
                jQuery('.' + $href + '.template-thumbnail').show();
            }
            jQuery('.template-thumbnail').each(function () {
                if (jQuery(this).is(':visible')) {
                    $all_template_hide = false;
                }
            });
            if ($all_template_hide) {
                jQuery('.no-template').show();
            } else {
                jQuery('.no-template').hide();
            }
            jQuery("#popupdiv-single div.template-thumbnail .popup-select a").click(function (e) {
                e.preventDefault();
                jQuery('#popupdiv-single div.template-thumbnail').removeClass('bdp_selected_template');
                jQuery(this).parents('div.template-thumbnail').addClass('bdp_selected_template');
            });
            jQuery('#popupdiv-single .template-thumbnail').removeClass('bdp_selected_template');
            jQuery('#popupdiv-single .template-thumbnail').each(function () {
                if (jQuery(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                    jQuery(this).addClass('bdp_selected_template');
                }
            });

            jQuery('.bdp-blog-template-cover .template-thumbnail').each(function () {
                var templateLable = jQuery(this).data('value');
                if(templateLable != '' && templateLable != undefined) {
                    jQuery(this).append('<div class="bdp-label">'+ templateLable +'</div>')
                }
            });
        }
    });
}

jQuery(window).load(function () {


    if(jQuery('body').hasClass('blog-designer_page_single_post')) {
        /* Hide/Show Featured image */
        if (jQuery("input[name='display_thumbnail']:checked").val() == 1) {
            jQuery('.bdp_media_size_tr').show();

            jQuery('.bdp_media_custom_size_tr').hide();
            if (jQuery('#bdp_media_size').val() == 'custom') {
                jQuery('.bdp_media_custom_size_tr').show();
            }
        } else {
            jQuery('.bdp_media_size_tr').hide();
            jQuery('.bdp_media_custom_size_tr').hide();
        }
        jQuery("input[name='display_thumbnail']").change(function () {
            if (jQuery(this).val() == 1) {
                jQuery('.bdp_media_size_tr').show();

                jQuery('.bdp_media_custom_size_tr').hide();
                if (jQuery('#bdp_media_size').val() == 'custom') {
                    jQuery('.bdp_media_custom_size_tr').show();
                }

            } else {
                jQuery('.bdp_media_size_tr').hide();
                jQuery('.bdp_media_custom_size_tr').hide();
            }
        });

    }

    /* Hide/Show date formate*/
    if (jQuery("input[name='display_date']:checked").val() == 1) {
        jQuery('.bdp-display-date-settings').show();
        jQuery('.post_date_from_tr').show();
        jQuery('.post_date_format_tr').show();
        var $date_formate = ["boxy", "hub", "invert-grid", "pretty", "roctangle", "spektrum", "story", "timeline"];
        if (jQuery.inArray(jQuery('.bdp_template_name').val(), $date_formate) !== -1) {
            jQuery('.post_date_format_tr').hide();
        }
    } else {
        jQuery('.bdp-display-date-settings').hide();
        jQuery('.post_date_from_tr').hide();
        jQuery('.post_date_format_tr').hide();
    }
    if (!jQuery('#override_single').attr('checked')) {
        jQuery('.bdp-display-date-settings').hide();
        jQuery('.post_date_from_tr').hide();
        jQuery('.post_date_format_tr').hide();
    }
    jQuery("input[name='display_date']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery('.bdp-display-date-settings').show();
            jQuery('.post_date_format_tr').show();
            jQuery('.post_date_from_tr').show();
            var $date_formate = ["boxy", "hub", "invert-grid", "pretty", "roctangle", "spektrum", "story", "timeline"];
            if (jQuery.inArray(jQuery('.bdp_template_name').val(), $date_formate) !== -1) {
                jQuery('.post_date_format_tr').hide();
            }
        } else {
            jQuery('.bdp-display-date-settings').hide();
            jQuery('.post_date_from_tr').hide();
            jQuery('.post_date_format_tr').hide();
        }
        bdpAltBackground();
    });

    jQuery('.slider_autoplay_tr').hide();
    if (jQuery("input[name='slider_autoplay']:checked").val() == 1) {
        jQuery('.slider_autoplay_tr').show();
    }
    jQuery("input[name='slider_autoplay']").on('change', function () {
        if (jQuery(this).val() == 1) {
            jQuery('.slider_autoplay_tr').show();
        } else {
            jQuery('.slider_autoplay_tr').hide();
        }
        bdpAltBackground();
    });

    jQuery('.bdp_related_post_media_custom_size_tr').hide();
    if (jQuery('#bdp_related_post_media_size').val() == 'custom') {
        jQuery('.bdp_related_post_media_custom_size_tr').show();
    }
    jQuery('#bdp_related_post_media_size').on('change', function () {
        if (jQuery(this).val() == 'custom') {
            jQuery('.bdp_related_post_media_custom_size_tr').show();
        } else {
            jQuery('.bdp_related_post_media_custom_size_tr').hide();
        }
        bdpAltBackground();
    });

    jQuery('#blog_background_image').change(function () {
        if (jQuery(this).is(":checked")) {
            jQuery('.blog_background_image_style_tr').show();
        } else {
            jQuery('.blog_background_image_style_tr').hide();
        }
        bdpAltBackground();
    });

    disable_link_chk();
    blog_background_image();
    // Title links options
    if (jQuery("input[name='display_title']:checked").val() == 1) {
        if (jQuery('#override_single').attr('checked')) {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsingletitle') {
                    jQuery(this).removeClass('clickDisable');
                }
            });
        }
    } else {
        jQuery('.bd-setting-handle li').each(function () {
            var hide = jQuery(this).attr('data-show');
            if (hide == 'bdpsingletitle') {
                jQuery(this).addClass('clickDisable');
            }
        });
        jQuery("#bdpsingletitle").hide();
    }
    jQuery("input[name='display_title']").change(function () {
        if (jQuery(this).val() == 1) {
//            jQuery('#bdpsingletitle').fadeIn();
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsingletitle') {
                    jQuery(this).removeClass('clickDisable');
                }
            });
        } else {
            jQuery('.bd-setting-handle li').each(function () {
                var hide = jQuery(this).attr('data-show');
                if (hide == 'bdpsingletitle') {
                    jQuery(this).addClass('clickDisable');
                }
            });
            jQuery('#bdpsingletitle').fadeOut();
        }
    });

    // Categories link option
    jQuery("input[name='display_category']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });

    // Tags link option
    jQuery("input[name='display_tag']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });

    // Author link option
    jQuery("input[name='display_author']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });

    // Publish Date link option
    jQuery("input[name='display_date']").change(function () {
        if (jQuery(this).val() == 1 && jQuery('.bdp_template_name').val() != 'story') {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });

    // Comment Form link option
    jQuery("input[name='display_comment_count'],input[name='display_comment']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });


    // Taxonomy Set
    jQuery("fieldset.taxonomies_set input").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });



    // social icon share with count option display based on share icon yes or not selection
    // Facebook
    if (jQuery("input[name='facebook_link']:checked").val() == 1) {
        jQuery("input[name='facebook_link']").closest("div.bdp-typography-content").find('.social_link_with_count').show();
    } else {
        jQuery("input[name='facebook_link']").closest("div.bdp-typography-content").find('.social_link_with_count').hide();
    }
    jQuery("input[name='facebook_link']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').hide();
        }
    });

    // LinkedIn
    if (jQuery("input[name='linkedin_link']:checked").val() == 1) {
        jQuery("input[name='linkedin_link']").closest("div.bdp-typography-content").find('.social_link_with_count').show();
    } else {
        jQuery("input[name='linkedin_link']").closest("div.bdp-typography-content").find('.social_link_with_count').hide();
    }
    jQuery("input[name='linkedin_link']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').hide();
        }
    });

    // Pinterest
    if (jQuery("input[name='pinterest_link']:checked").val() == 1) {
        jQuery("input[name='pinterest_link']").closest("div.bdp-typography-content").find('.social_link_with_count').show();
    } else {
        jQuery("input[name='pinterest_link']").closest("div.bdp-typography-content").find('.social_link_with_count').hide();
    }
    jQuery("input[name='pinterest_link']").change(function () {
        if (jQuery(this).val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.social_link_with_count').hide();
        }
    });
    bdpAltBackground();
});


function blog_background_image() {
    if (jQuery('#blog_background_image').attr('checked')) {
        jQuery('.blog_background_image_style_tr').show();
    } else {
        jQuery('.blog_background_image_style_tr').hide();
    }
}

function disable_link_chk() {
    // Categories link option
    if (jQuery("input[name='display_category']:checked").val() == 1) {
        jQuery("input[name='display_category']").closest("div.bdp-typography-content").find('.disable_link').show();
    } else {
        jQuery("input[name='display_category']").closest("div.bdp-typography-content").find('.disable_link').hide();
    }

    // Tags link option
    if (jQuery("input[name='display_tag']:checked").val() == 1) {
        jQuery("input[name='display_tag']").closest("div.bdp-typography-content").find('.disable_link').show();
    } else {
        jQuery("input[name='display_tag']").closest("div.bdp-typography-content").find('.disable_link').hide();
    }

    // Author link option
    if (jQuery("input[name='display_author']:checked").val() == 1) {
        jQuery("input[name='display_author']").closest("div.bdp-typography-content").find('.disable_link').show();
    } else {
        jQuery("input[name='display_author']").closest("div.bdp-typography-content").find('.disable_link').hide();
    }

    // Publish Date link option
    if (jQuery("input[name='display_date']:checked").val() == 1 && jQuery('.bdp_template_name').val() != 'story') {
        jQuery("input[name='display_date']").closest("div.bdp-typography-content").find('.disable_link').show();
    } else {
        jQuery("input[name='display_date']").closest("div.bdp-typography-content").find('.disable_link').hide();
    }

    // Comment Form link option
    if (jQuery("input[name='display_comment_count']:checked").val() == 1 || jQuery("input[name='display_comment']:checked").val() == 1) {
        jQuery("input[name='display_comment_count']").closest("div.bdp-typography-content").find('.disable_link').show();
        jQuery("input[name='display_comment']").closest("div.bdp-typography-content").find('.disable_link').show();
    } else {
        jQuery("input[name='display_comment_count']").closest("div.bdp-typography-content").find('.disable_link').hide();
        jQuery("input[name='display_comment']").closest("div.bdp-typography-content").find('.disable_link').hide();
    }

    // Taxonomy Set
    jQuery("fieldset.taxonomies_set input").each(function () {
        var name = jQuery(this).attr("name");
        if (jQuery("input[name='" + name + "']:checked").val() == 1) {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').show();
        } else {
            jQuery(this).closest("div.bdp-typography-content").find('.disable_link').hide();
        }
    });
}

function bdp_set_template_default_data() {
    jQuery('#bdp_post_status').val('publish');
    jQuery("#bdp_post_image_link_0").prop("checked", false);
    jQuery("#bdp_post_image_link_1").prop("checked", true);
    jQuery("#bdp_image_hover_effect_0").prop("checked", true);
    jQuery("#bdp_image_hover_effect_1").prop("checked", false);
    jQuery("#bdp_image_hover_effect_type").val("zoom_in");
    jQuery('.bdp-image-hover-effect-tr').hide();
    jQuery("#blog_grid_height_0").prop("checked", false);
    jQuery("#blog_grid_height_1").prop("checked", true);

    jQuery('.of-radio-color').prop("checked", false);
    jQuery("#default_icon_theme_1").prop("checked", true);
    jQuery("#pocket_link_0").prop("checked", true);
    jQuery("#pocket_link_1").prop("checked", false);
    jQuery("#telegram_link_0").prop("checked", true);
    jQuery("#telegram_link_1").prop("checked", false);
    jQuery("#reddit_link_0").prop("checked", true);
    jQuery("#reddit_link_1").prop("checked", false);
    jQuery("#digg_link_0").prop("checked", true);
    jQuery("#digg_link_1").prop("checked", false);
    jQuery("#skype_link_0").prop("checked", true);
    jQuery("#skype_link_1").prop("checked", false);
    jQuery("#tumblr_link_0").prop("checked", true);
    jQuery("#tumblr_link_1").prop("checked", false);
    jQuery("#wordpress_link_0").prop("checked", true);
    jQuery("#wordpress_link_1").prop("checked", false);
    jQuery("#display_sticky_0").prop("checked", true);
    jQuery("#display_sticky_1").prop("checked", false);
    jQuery("#advance_filter_0").prop("checked", true);
    jQuery("#advance_filter_1").prop("checked", false);
    jQuery("#tax_filter_with_0").prop("checked", true);
    jQuery("#tax_filter_with_1").prop("checked", false);
    jQuery("#author_filter_with_0").prop("checked", false);
    jQuery("#author_filter_with_1").prop("checked", true);
    jQuery(".advance_filter_option").hide();
    jQuery("#beforeloop_Readmoretext").val('');
    jQuery("#beforeloop_Readmoretextlink").val('');
    jQuery("#dsiplay_date_from").val('publish');
    jQuery("#post_date_format").val('default');
    jQuery("#advance_contents_0").prop("checked", true);
    jQuery("#advance_contents_1").prop("checked", false);

    jQuery('#facebook_link_with_count').prop("checked", true);
    jQuery('#linkedin_link_with_count').prop("checked", true);
    jQuery('#pinterest_link_with_count').prop("checked", true);

    if (jQuery('.bdp_template_name').val() == 'boxy') {
        /*---set option values for boxy template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#template_name").val("2");
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#239190');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_bgcolor').iris('color', '');
        jQuery('#author_bgcolor').val('');
        jQuery('#author_titlecolor').iris('color', '#239190');
        jQuery('#author_title_font_weight').val('normal');
        jQuery('#author_title_font_line_height').val('1.5');
        jQuery('#author_title_font_text_transform').val('none');
        jQuery('#author_title_font_text_decoration').val('none');
        jQuery('#auhtor_title_font_letter_spacing').val('0');
        jQuery("#auhtor_title_font_italic_0").prop("checked", true);
        jQuery("#auhtor_title_font_italic_1").prop("checked", false);
        jQuery('#author_content_color').iris('color', '#555555');
        jQuery("#author_content_fontsize").val("14");
        jQuery("#author_content_fontface").val("");
        jQuery('#author_content_font_weight').val('normal');
        jQuery('#author_content_font_line_height').val('1.5');
        jQuery('#author_content_font_text_transform').val('none');
        jQuery('#author_content_font_text_decoration').val('none');
        jQuery('#auhtor_content_font_letter_spacing').val('0');
        jQuery("#auhtor_content_font_italic_0").prop("checked", true);
        jQuery("#auhtor_content_font_italic_1").prop("checked", false);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#239190');
        jQuery('#template_titlehovercolor').iris('color', '#333333');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("15");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#239190');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#155756');
        jQuery('#template_titlefontface').val('');
        jQuery('#template_titlefontsize').val('22');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#main_container_class').val("");
        jQuery('#template_columns').val("2");
        jQuery('#template_columns_ipad').val("1");
        jQuery('#template_columns_tablet').val("1");
        jQuery('#template_columns_mobile').val("1");

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('');


        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('560');
        jQuery('#media_custom_height').val('350');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'boxy-clean') {
        /*---set option values for boxy clean template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("title");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#bdp_blog_order_by").val("name");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery("#template_name").val("3");
        jQuery('#template_color').iris('color', '#15506F');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_bghovercolor').iris('color', '#DFEDF1');
        jQuery('#template_ftcolor').iris('color', '#15506F');
        jQuery('#template_fthovercolor').iris('color', '#999999');
        jQuery('#author_bgcolor').iris('color', '#555555');

        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author] " + bdpro_js.info);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_content_color').iris('color', '#15506F');
        jQuery('#author_titlecolor').iris('color', '#239190');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#15506F');
        jQuery('#template_titlehovercolor').iris('color', '#555555');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("22");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);


        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#firstletter_font_family").val('');
        jQuery("#txtExcerptlength").val("20");
        jQuery("#content_fontsize").val("14");
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery("#txtReadmoretext").val("Continue");
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#15506F');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#0e384d');

        jQuery("#default_icon_theme_9").prop("checked", true);

        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);

        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").hide();
        jQuery("#social_sharecount").val("bottom");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('invert-grid-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('350');
        jQuery('#media_custom_height').val('180');

        jQuery('#main_container_class').val("");
        jQuery('#template_columns').val("3");
        jQuery('#template_columns_ipad').val("2");
        jQuery('#template_columns_tablet').val("1");
        jQuery('#template_columns_mobile').val("1");

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'brit_co') {
        /*---set option values for Brit Co template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#template_name").val("3");
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#3E91AD');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);

        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("About [author]");
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("fantasy");

        jQuery('#bdp_post_title_link_0').prop("checked", false);
        jQuery('#bdp_post_title_link_1').prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#3E91AD');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);

        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#3E91AD');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#2b6579');
        jQuery("#custom_post_type").val("post");
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery("#social_sharecount").val("bottom");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('brit_co_img');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('580');
        jQuery('#media_custom_height').val('255');

        jQuery('#main_container_class').val("");
        jQuery('#template_columns').val("3");
        jQuery('#template_columns_ipad').val("2");
        jQuery('#template_columns_tablet').val("1");
        jQuery('#template_columns_mobile').val("1");

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'classical') {
        /*---set option values for classical template---*/
        jQuery('#template_color').iris('color', '#fff');
        jQuery("#posts_per_page").val("5");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#FFFFFF');
        jQuery('#template_ftcolor').iris('color', '#2a97ea');
        jQuery('#template_fthovercolor').iris('color', '#555555');


        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author] " + bdpro_js.information);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#999999');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#2a97ea');
        jQuery('#template_titlebackcolor').iris('color', 'ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.2");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("80");
        jQuery("#content_fontsize").val("14");
        jQuery("#firstletter_fontsize").val("28");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#2a97ea');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#bb2178');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#social_sharecount').val('right');

        /**
         * Make font family to default
         */
        jQuery("#content_font_family").val('');
        jQuery("#firstletter_font_family").val('');


        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'nicy') {
        /*---set option values for nicy template---*/
        jQuery('#template_color').iris('color', '#fff');
        jQuery("#posts_per_page").val("5");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#FFFFFF');
        jQuery('#template_ftcolor').iris('color', '#ED4961');
        jQuery('#template_fthovercolor').iris('color', '#555555');


        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author] " + bdpro_js.information);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#999999');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#ED4961');
        jQuery('#template_titlebackcolor').iris('color', 'ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.2");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("80");
        jQuery("#content_fontsize").val("14");
        jQuery("#firstletter_fontsize").val("28");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#ED4961');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#a53343');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#social_sharecount').val('right');

        /**
         * Make font family to default
         */
        jQuery("#content_font_family").val('');
        jQuery("#firstletter_font_family").val('');


        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'deport') {
        /*---set option values for deport template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#92A660');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#deport_dashcolor').iris('color', '#92A660');

        jQuery("#thumbnail_skin_0").prop("checked", true);
        jQuery("#thumbnail_skin_1").prop("checked", false);

        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + " [author] " + bdpro_js.information);
        jQuery("#author_title_fontsize").val("28");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#777777');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#92A660');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("15");
        jQuery('#template_contentcolor').iris('color', '#777777');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#92A660');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#667443');
        jQuery("#blog_unique_design").prop("checked", false);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#default_icon_theme_7").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_sharecount').val('bottom');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('deport-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('400');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'evolution') {
        /*---set option values for evolution template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#pagination_type").val("paged");
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#grid_hoverback_color').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", false);
        jQuery("#template_alternativebackground_1").prop("checked", true);
        jQuery('#template_alterbgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#2E6480');
        jQuery('#template_fthovercolor').iris('color', '#555555');


        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("About [author]");
        jQuery("#author_title_fontsize").val("28");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#333333');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#2E6480');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery("#firstletter_fontsize").val("32");
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("80");
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#2E6480');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#204659');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#default_icon_theme_9").prop("checked", true);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_sharecount').val("bottom");
        jQuery(".social_link_with_count").hide();
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('420');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();

        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'glossary') {
        /*---set option values for glossary template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("title");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery("#template_name").val("2");
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#EA4335');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');

        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#2b2b2b');
        jQuery('#author_content_color').iris('color', '#7a7a7a');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#2b2b2b');
        jQuery('#template_titlehovercolor').iris('color', '#ea4335');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("40");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#7a7a7a');
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#7a7a7a');
        jQuery('#template_content_hovercolor').iris('color', '#ea4335');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#2b2b2b');
        jQuery('#template_readmorebackcolor').iris('color', '#ffffff');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#e5e5e5');

        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery(".social_link_with_count").show();
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#social_sharecount').val("top");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('560');
        jQuery('#media_custom_height').val('350');

        jQuery('#main_container_class').val("");
        jQuery('#template_columns').val("2");
        jQuery('#template_columns_ipad').val("2");
        jQuery('#template_columns_tablet').val("1");
        jQuery('#template_columns_mobile').val("1");

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'invert-grid') {
        /*---set option values for invert grid template---*/
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val("");
        jQuery(".blg_order").hide();
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#CC0001');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');

        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('');
        jQuery('#author_titlecolor').iris('color', '#2b2b2b');
        jQuery('#author_content_color').iris('color', '#4c3e37');
        jQuery("#template_titlefontface").val('');
        jQuery("#content_font_family").val('');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#2b2b2b');
        jQuery('#template_titlehovercolor').iris('color', '#CC0001');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("40");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#4c3e37');
        jQuery('#txtReadmoretext').val(bdpro_js.learn_more);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#CC0001');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#a30000');

        jQuery("#default_icon_theme_2").prop("checked", true);

        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('#social_icon_style_0').prop("checked", false);
        jQuery('#social_icon_style_1').prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").hide();
        jQuery("#social_sharecount").val("bottom");

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('invert-grid-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'media-grid') {
        /*---set option values for media grid template---*/
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#2b2b2b');
        jQuery('#author_content_color').iris('color', '#7b6b79');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#A49538');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery('#template_titlecolor').iris('color', '#000000');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#A49538');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery('#template_contentcolor').iris('color', '#7b6b79');
        jQuery('#txtReadmoretext').val(bdpro_js.view_more);
        jQuery('#template_readmorecolor').iris('color', '#dddddd');
        jQuery('#template_readmorebackcolor').iris('color', '#A49538');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#83772c');
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#firstpost_unique_design").prop("checked", false);
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('24');
        jQuery("#author_title_fontface").val('Palatino Linotype, Book Antiqua, Palatino, serif');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('invert-grid-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'spektrum') {
        /*---set option values for spektrum template---*/
        jQuery('#posts_per_page').val('10');
        jQuery('#bdp_blog_order_by').val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#444');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#2d7fc1');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#2d7fc1');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("100");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#txtReadmoretext').val(bdpro_js.view_more);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#2d7fc1');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#24659a');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#shape_social_icon").hide();
        jQuery("#size_social_icon").hide();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#date_color_of_readmore').prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.info_about + ' [author]');
        jQuery("#author_title_fontsize").val('23');
        jQuery("#author_title_fontface").val('');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('420');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'hub') {
        /*---set option values for hub template---*/
        jQuery('#posts_per_page').val('10');
        jQuery('#bdp_blog_order_by').val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#444');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#495F85');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#495F85');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("100");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#txtReadmoretext').val(bdpro_js.view_more);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#495F85');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#3a4c6a');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#shape_social_icon").hide();
        jQuery("#size_social_icon").hide();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#date_color_of_readmore').prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.info_about + ' [author]');
        jQuery("#author_title_fontsize").val('23');
        jQuery("#author_title_fontface").val('');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('420');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'lightbreeze') {
        /*---set option values for lightbreeze template---*/
        jQuery('#template_color').iris('color', '#fff');
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#FFFFFF');
        jQuery("#template_alternativebackground_0").prop("checked", true);
        jQuery("#template_alternativebackground_1").prop("checked", false);
        jQuery('.alternative-color-tr').hide();
        jQuery('#template_ftcolor').iris('color', '#1eafa6');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#1eafa6');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#1eafa6');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#188c84');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#999999');
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery(".social_link_with_count").hide();
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val('fantasy');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'sharpen') {
        /*---set option values for sharpen template---*/
        jQuery('#template_color').iris('color', '#fff');
        jQuery("#posts_per_page").val("12");
        jQuery("#bdp_blog_order_by").val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#FFFFFF');
        jQuery("#template_alternativebackground_0").prop("checked", true);
        jQuery("#template_alternativebackground_1").prop("checked", false);
        jQuery('.alternative-color-tr').hide();
        jQuery('#template_ftcolor').iris('color', '#2E6480');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#2E6480');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#2E6480');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#245066');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#999999');
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery(".social_link_with_count").hide();
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val('fantasy');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'region') {
        /*---set option values for Region template---*/
        jQuery('#posts_per_page').val('10');
        jQuery('#bdp_blog_order_by').val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", true);
        jQuery("#template_alternativebackground_1").prop("checked", false);
        jQuery('#template_alterbgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#AC619B');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#AC619B');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("25");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("60");
        jQuery("#content_fontsize").val("15");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery("#firstletter_fontsize").val("30");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#txtReadmoretext').val(bdpro_js.continue_reading);
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#AC619B');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#894d7c');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery("#shape_social_icon").show();
        jQuery("#size_social_icon").show();
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('helvetica');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('400');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'winter') {
        /*---set option values for Winter template---*/
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#template_alternativebackground_0").prop("checked", true);
        jQuery("#template_alternativebackground_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#E7492F');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#winter_category_color').iris('color', '#E7492F');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#E7492F');
        jQuery('#template_alterbgcolor').iris('color', '#ffffff');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#txtExcerptlength").val("30");
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery("#content_fontsize").val("16");
        jQuery('#txtReadmoretext').val(bdpro_js.view_article);
        jQuery('#template_readmorecolor').iris('color', '#fff');
        jQuery('#template_readmorebackcolor').iris('color', '#E7492F');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#b83a25');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#666666');
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontface_font_type").val("");
        jQuery("#content_font_family").val("");
        /* Author section */
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author]');
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('');
        jQuery("#firstletter_font_family").val('');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('1200');
        jQuery('#media_custom_height').val('700');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'offer_blog') {
        /*---set option values for Offer Blog template---*/
        jQuery('#posts_per_page').val('15');
        jQuery('#bdp_blog_order_by').val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#BE6A67');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlehovercolor').iris('color', '#BE6A67');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("25");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("100");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery("#content_font_family").val("Verdana, Geneva, sans-serif");
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#666666');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#BE6A67');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#985452');
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#666666');
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery("#shape_social_icon").show();
        jQuery("#size_social_icon").show();
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#txtAuthorTitle").val('About [author]');
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('Courier');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('1200');
        jQuery('#media_custom_height').val('700');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'news') {
        /*---set option values for news template---*/
        jQuery('#posts_per_page').val('18');
        jQuery('#bdp_blog_order_by').val('');
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", true);
        jQuery("#template_alternativebackground_1").prop("checked", false);
        jQuery('#template_ftcolor').iris('color', '#AF583D');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#AF583D');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("48");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#content_font_family").val("");
        jQuery("#firstletter_fontsize").val("26");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#AF583D');
        jQuery('#template_readmorebackcolor').iris('color', '#f1f1f1');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#c0c0c0');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#44444');
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#shape_social_icon").hide();
        jQuery("#size_social_icon").hide();
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", true);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery("#thumbnail_skin_0").prop("checked", true);
        jQuery("#thumbnail_skin_1").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('Posts author: [author]');
        jQuery("#author_title_fontsize").val('26');
        jQuery("#author_title_fontface").val('TimesNewRoman');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('news-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('300');
        jQuery('#media_custom_height').val('300');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'navia') {
        /*---set option values for Navia template---*/
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#D65D88');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("25");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#firstletter_fontsize").val("26");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#txtReadmoretext').val(bdpro_js.keep_reading);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#D65D88');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#ab4a6c');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#999999');
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('#shape_social_icon').hide();
        jQuery('#size_social_icon').hide();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#default_icon_theme_4").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#txtAuthorTitle").val('[author] Posts');
        jQuery("#author_title_fontsize").val('28');
        jQuery("#author_title_fontface").val('Courier');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('560');
        jQuery('#media_custom_height').val('350');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'timeline') {
        /*---set option values for timeline template---*/
        jQuery('#bdp_blog_order_by').val('date');
        jQuery("#pagination_type").val("load_onscroll_btn");
        jQuery("#bdp_timeline_layout").val('');
        jQuery('#posts_per_page').val(5);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery(".blg_order").show();
        jQuery("#timeline_display_option").val('display_month');
        jQuery('#template_color').iris('color', '#E0254D');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#E0254D');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#E0254D');
        jQuery('#template_titlehovercolor').iris('color', '#444444');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("25");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#displaydate_backcolor').iris('color', '#414a54');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#E0254D');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#b31d3d');
        jQuery('#author_titlecolor').iris('color', '#E0254D');
        jQuery('#author_content_color').iris('color', '#44444');
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#shape_social_icon").hide();
        jQuery("#size_social_icon").hide();
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        /*New settings*/
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontface_font_type").val("");
        jQuery("#content_font_family").val("");

        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('24');
        jQuery("#author_title_fontface").val('Times New Roman, Times, serif');
        jQuery("#author_title_fontface_font_type").val('Serif Fonts');
        jQuery('.display-layout_type').show();

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#firstletter_font_family").val('');

        jQuery("#blog_background_image").prop("checked", false);
        jQuery("#blog_background_image_style_0").prop("checked", false);
        jQuery("#blog_background_image_style_1").prop("checked", true);
        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('400');

        /* show hide option of select display year or moth wise timeline */
        if (jQuery('.bdp_template_name').val() == 'timeline') {
            if (jQuery("select[name='bdp_blog_order_by']").val() == 'date' || jQuery("select[name='bdp_blog_order_by']").val() == 'modified') {
                if (jQuery("select[name='timeline_display_option']").val() != '') {
                    jQuery('.displayorder_backcolor').show();
                } else {
                    jQuery('.displayorder_backcolor').hide();
                }
                jQuery('.orderby_date_display').show();
            }
            else {
                jQuery('.orderby_date_display').hide();
                jQuery('.displayorder_backcolor').hide();
            }
            jQuery("select[name='bdp_blog_order_by']").change(function () {
                if (jQuery('.bdp_template_name').val() == 'timeline') {
                    if (jQuery(this).val() == 'date' || jQuery(this).val() == 'modified') {
                        jQuery('.orderby_date_display').show();
                        if (jQuery("select[name='timeline_display_option']").val() != '') {
                            jQuery('.displayorder_backcolor').show();
                        } else {
                            jQuery('.displayorder_backcolor').hide();
                        }
                    }
                    else {
                        jQuery('.orderby_date_display').hide();
                        jQuery('.displayorder_backcolor').hide();
                    }
                }
            });
            jQuery("select[name='timeline_display_option']").change(function () {
                if (jQuery(this).val() != '') {
                    jQuery('.displayorder_backcolor').show();
                } else {
                    jQuery('.displayorder_backcolor').hide();
                }
            });
        } else {
            jQuery('.orderby_date_display').hide();
            jQuery('.displayorder_backcolor').hide();
        }
        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'cool_horizontal') {
        /*---set option values for Horizontal 1 template---*/
        jQuery("#pagination_type").val("no_pagination");
        jQuery('#posts_per_page').val(30);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#disable_link_author").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#disable_link_date").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#F16C20');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#F16C20');
        jQuery('#template_titlehovercolor').iris('color', '#333333');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("25");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#firstletter_fontsize").val("28");
        jQuery('#firstletter_contentcolor').iris('color', '#999999');
        jQuery('#firstletter_font_family').val('');
        jQuery('#content_font_family').val('');
        jQuery('#txtReadmoretext').val(bdpro_js.keep_reading);
        jQuery('#template_readmorecolor').iris('color', '#F16C20');
        jQuery('#template_readmorebackcolor').iris('color', '#ffffff');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#e5e5e5');
        jQuery('#author_titlecolor').iris('color', '#F16C20');
        jQuery('#author_content_color').iris('color', '#999999');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#shape_social_icon').show();
        jQuery('#size_social_icon').show();
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('.filter_data').prop("checked", false);
        jQuery(".social_link_with_count input").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#txtAuthorTitle").val('[author] Posts');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('Courier');
        jQuery('#template_easing').val('easeOutSine');
        jQuery('#display_timeline_bar_0').prop("checked", true);
        jQuery('#display_timeline_bar_1').prop("checked", false);
        jQuery('#display_arrows_0').prop("checked", false);
        jQuery('#display_arrows_1').prop("checked", true);
        jQuery('#item_width').val('400');
        jQuery('#item_height').val('200');
        jQuery('#enable_autoslide_0').prop("checked", true);
        jQuery('#enable_autoslide_1').prop("checked", false);
        jQuery('#template_titlefontface').val('');
        jQuery('#scroll_speed').val('1000');
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');
        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*-------------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'overlay_horizontal') {
        /*---set option values for Horizontal 1 template---*/
        jQuery("#pagination_type").val("no_pagination");
        jQuery('#posts_per_page').val(30);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery("#display_timeline_bar_1").prop("checked", false);
        jQuery("#display_timeline_bar_0").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#ffffff');
        jQuery('#template_fthovercolor').iris('color', '#aaaaaa');
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#aaaaaa');
        jQuery('#template_color').iris('color', '#dd5555');
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("25");
        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_family").val("");
        jQuery("#firstletter_fontsize").val("26");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#ffffff');
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery('#txtReadmoretext').val(bdpro_js.keep_reading);
        jQuery('#template_readmorecolor').iris('color', '#fff');
        jQuery('#template_readmorebackcolor').iris('color', '#aaaaaa');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#888888');
        jQuery('#author_titlecolor').iris('color', '#dd5555');
        jQuery('#author_content_color').iris('color', '#ffffff');
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#shape_social_icon').show();
        jQuery('#size_social_icon').show();
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery(".social_link_with_count input").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#txtAuthorTitle").val('[author] Posts');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('Courier');
        jQuery('#template_easing').val('easeOutSine');
        jQuery('#display_timeline_bar_0').prop("checked", true);
        jQuery('#display_timeline_bar_1').prop("checked", false);
        jQuery('#display_arrows_0').prop("checked", false);
        jQuery('#display_arrows_1').prop("checked", true);
        jQuery('#item_width').val('400');
        jQuery('#item_height').val('500');
        jQuery('#enable_autoslide_0').prop("checked", true);
        jQuery('#enable_autoslide_1').prop("checked", false);
        jQuery('#scroll_speed').val('1000');
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('.filter_data').prop("checked", false);
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');
        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*-------------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'explore') {
        /*---set option values for explore template---*/
        jQuery("#posts_per_page").val("11");
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#template_grid_height").val("300");
        jQuery("#template_grid_skin").val("default");
        jQuery('#template_ftcolor').iris('color', '#e0e0e0');
        jQuery('#template_fthovercolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("");
        jQuery("#author_title_fontface").val("");
        jQuery('#bdp_post_title_link_0').prop("checked", false);
        jQuery('#bdp_post_title_link_1').prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#e0e0e0');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_titlehovercolor").iris('color', '#ffffff');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(0);
        jQuery("#custom_post_type").val("post");
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery("#social_sharecount").val("bottom");
        jQuery("#grid_col_spaceOutputId").val("10");
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');
        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'hoverbic') {
        /*---set option values for hoverbic template---*/
        jQuery("#posts_per_page").val("11");
        jQuery("#bdp_blog_order_by").val("");
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#template_grid_height").val("300");
        jQuery("#template_grid_skin").val("default");
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#template_ftcolor').iris('color', '#ff9600');
        jQuery('#template_fthovercolor').iris('color', '#ffffff');
        jQuery('#grid_hoverback_color').iris('color', '#000000');
        jQuery("#author_title_fontface").val("fantasy");
        jQuery('#bdp_post_title_link_0').prop("checked", false);
        jQuery('#bdp_post_title_link_1').prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#e0e0e0');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_titlehovercolor").iris('color', '#ff9600');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery("#custom_post_type").val("post");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery("#social_sharecount").val("bottom");
        jQuery("#grid_col_spaceOutputId").val("10");
        jQuery('#default_icon_theme_5').prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');
        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'story') {
        /*---set option values for story template---*/
        jQuery('#posts_per_page').val('30');
        jQuery('#bdp_blog_order_by').val('date');
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('#template_color').iris('color', '#0c555e');
        jQuery('#template_alternative_color').iris('color', '#ff6861');
        jQuery('#story_startup_border_color').iris('color', '#ffffff');
        jQuery('#story_startup_background').iris('color', '#71a405');
        jQuery('#story_ending_background').iris('color', '#71a405');
        jQuery('#story_startup_text_color').iris('color', '#ffffff');
        jQuery('#story_ending_text_color').iris('color', '#ffffff');
        jQuery('#story_startup_text').val(bdpro_js.startup_text);
        jQuery('#template_ftcolor').iris('color', '#0c555e');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlehovercolor').iris('color', '#0c555e');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#template_titlefontface").val("");
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#template_titlefontsize").val("20");
        jQuery("#story_ending_link").val("#");
        jQuery("#story_ending_text").val("Our Next Goals");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery(".story-ending-tr").show();

        /*New Feature default value*/
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#blog_unique_design").prop("checked", false);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontface_font_type").val("");
        jQuery("#content_font_family").val("");

        jQuery("#txtExcerptlength").val("25");
        jQuery("#content_fontsize").val("16");
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery('#txtReadmoretext').val(bdpro_js.view_more);
        jQuery('#template_readmorecolor').iris('color', '#d6d6d6');
        jQuery('#template_readmorebackcolor').iris('color', '#333333');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#5b5b5b');
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#666666');
        jQuery("#social_style_0").prop("checked", true);
        jQuery("#social_style_1").prop("checked", false);
        jQuery("#shape_social_icon").show();
        jQuery("#size_social_icon").show();
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#date_color_of_readmore').prop("checked", true);
        jQuery('.social_link_with_count').hide();
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('thumbnail');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('150');
        jQuery('#media_custom_height').val('150');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'easy_timeline') {
        /*---set option values for Easy Timeline template---*/

        jQuery("#pagination_type").val("no_pagination");
        jQuery('#posts_per_page').val('50');
        jQuery('#bdp_blog_order_by').val('date');
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#C58A3C,');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222,');
        jQuery('#template_titlehovercolor').iris('color', '#C58A3C');
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("0");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#template_color').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("20");
        jQuery("#template_titlefontface").val("");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("25");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#txtReadmoretext').val(bdpro_js.keep_reading);
        jQuery('#template_readmorecolor').iris('color', '#C58A3C');
        jQuery('#template_readmorebackcolor').iris('color', '#ffffff');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#e5e5e5');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#555555');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#author_title_fontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#shape_social_icon').show();
        jQuery('#size_social_icon').show();
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery(".social_link_with_count input").prop("checked", false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#txtAuthorTitle").val('[author] Posts');
        jQuery("#author_title_fontsize").val('20');
        jQuery('#easy_timeline_effect').val('flip-effect');
        jQuery("#display_feature_image_0").prop("checked", true);
        jQuery("#display_feature_image_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#firstletter_font_family").val('');
        jQuery("#content_font_family").val('');

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('easy_timeline_img');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('500');
        jQuery('#media_custom_height').val('300');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'my_diary') {
        /*---set option values for my diary template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);
        jQuery("#pagination_type").val("load_more_btn");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery("#blog-columns-tr").hide();
        jQuery('#column_setting').val(2);
        jQuery('#column_setting_ipad').val(2);
        jQuery('#column_setting_tablet').val(1);
        jQuery('#column_setting_mobile').val(1);
        jQuery(".bdp-back-color-blog").show();
        jQuery('#template_bgcolor').iris('color', '#313131');
        jQuery('#template_ftcolor').iris('color', '#128775');
        jQuery('#template_fthovercolor').iris('color', '#000000');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("28");
        jQuery("#author_title_fontface").val("");
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#128775');
        jQuery('#template_titlehovercolor').iris('color', '#000000');
        jQuery(".titlebackcolor").hide();
        jQuery('#template_titlebackcolor').iris('color', '#313131');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("18");
        jQuery("#firstletter_font_family").val("18");
        jQuery("#firstletter_fontsize").val("32");
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#128775');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#0e6c5d');
        jQuery('#author_titlecolor').iris('color', '#128775');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery(".pinterest_image_share_tr").hide();
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#social_sharecount").val("bottom");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('deport-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('520');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'elina') {
        /*---set option values for elina template---*/
        jQuery("#pagination_type").val("paged");
        jQuery('#posts_per_page').val(10);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery(".blog-templatecolor-tr").show();
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#3E91AD');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#3E91AD');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(0);
        jQuery(".titlebackcolor_tr").hide();
        jQuery("#template_titlefontface").val("");
        jQuery("#template_titlefontsize").val("30");
        jQuery("#content_font_family").val("");
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("150");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery("#firstletter_fontsize").val("28");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#666666');
        jQuery("#txtReadmoretext").val(bdpro_js.continue_reading);
        jQuery('#template_readmorecolor').iris('color', '#3E91AD');
        jQuery('#template_readmorebackcolor').iris('color', '#666666');
        jQuery('.read_more_text_hover_background').hide();
        jQuery('#template_readmore_hover_backcolor').iris('color', '');
        jQuery('#template_readmore_hover_backcolor').val('');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#666666');
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", false);
        jQuery('#social_icon_style_1').prop("checked", true);
        jQuery('#social_icon_style_2').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", true);
        jQuery('#facebook_link_0').prop("checked", false);
        jQuery('#facebook_link_1').prop("checked", true);
        jQuery('#google_link_0').prop("checked", false);
        jQuery('#google_link_1').prop("checked", true);
        jQuery('#linkedin_link_0').prop("checked", false);
        jQuery('#linkedin_link_1').prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#social_sharecount").val("right");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('400');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'masonry_timeline') {
        /*---set option values for masonry timeline template---*/
        jQuery("#pagination_type").val("no_pagination");
        jQuery('#posts_per_page').val(30);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery(".blog-templatecolor-tr").show();
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#A39D5A');
        jQuery('#template_fthovercolor').iris('color', '#222222');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#A39D5A');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery("#template_titlefontface").val("");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery(".titlebackcolor_tr").hide();
        jQuery("#template_titlefontsize").val("20");
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("16");
        jQuery("#content_font_family").val("");
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery("#firstletter_fontsize").val("32");
        jQuery("#firstletter_font_family").val("");
        jQuery('#firstletter_contentcolor').iris('color', '#666666');
        jQuery("#txtReadmoretext").val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#666666');
        jQuery('#template_readmorebackcolor').iris('color', '#A39D5A');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#827d48');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#666666');
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", false);
        jQuery('#social_icon_style_1').prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", true);
        jQuery('#facebook_link_0').prop("checked", false);
        jQuery('#facebook_link_1').prop("checked", true);
        jQuery('#google_link_0').prop("checked", false);
        jQuery('#google_link_1').prop("checked", true);
        jQuery('#linkedin_link_0').prop("checked", false);
        jQuery('#linkedin_link_1').prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#social_sharecount").val("right");
        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('deport-thumb');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('520');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'crayon_slider') {
        /*---set option values for Crayon Slider template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#displaytemplate_ftcolor_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#000000');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#F5C034');
        jQuery('#template_fthovercolor').iris('color', '#ffffff');
        jQuery('#winter_category_color').iris('color', '#F5C034');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#ffffff');
        jQuery('#author_content_color').iris('color', '#ffffff');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#F5C034');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#F5C034');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#c49929');
        jQuery('#template_titlefontface').val('');
        jQuery("#template_titlefontsize").val(22);
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);

        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('');

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#template_slider_columns').val('1');
        jQuery('#template_slider_columns_ipad').val('1');
        jQuery('#template_slider_columns_tablet').val('1');
        jQuery('#template_slider_columns_mobile').val('1');
        jQuery('#template_slider_effect').val('slide');
        jQuery('#template_slider_scroll').val('1');
        jQuery("#display_slider_navigation_0").prop("checked", false);
        jQuery("#display_slider_navigation_1").prop("checked", true);
        jQuery("#navigation_style_hidden").val('navigation3');
        jQuery("#display_slider_controls_0").prop("checked", true);
        jQuery("#display_slider_controls_1").prop("checked", false);
        jQuery("#control1").prop("checked", false);
        jQuery("#control2").prop("checked", true);
        jQuery("#control3").prop("checked", false);
        jQuery("#slider_autoplay_0").prop("checked", false);
        jQuery("#slider_autoplay_1").prop("checked", true);
        jQuery("#slider_autoplay_intervals").val("3000");
        jQuery("#slider_speed").val("500");


        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('900');
        jQuery('#media_custom_height').val('530');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'sallet_slider') {
        /*---set option values for boxy template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#displaytemplate_ftcolor_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#ffffff');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#3E8563');
        jQuery('#winter_category_color').iris('color', '#3E8563');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#0E663C');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#0E663C');
        jQuery('#template_titlehovercolor').iris('color', '#3E8563');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("30");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#3E8563');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#316a4f');
        jQuery('#template_titlefontface').val('');
        jQuery('#template_titlefontsize').val('22');
        jQuery('#template_title_font_weight').val('bold');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery(".pinterest_image_share_tr").hide();
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);

        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('');


        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#template_slider_columns').val('1');
        jQuery('#template_slider_columns_ipad').val('1');
        jQuery('#template_slider_columns_tablet').val('1');
        jQuery('#template_slider_columns_mobile').val('1');
        jQuery('#template_slider_effect').val('slide');
        jQuery('#template_slider_scroll').val('1');
        jQuery("#display_slider_navigation_0").prop("checked", false);
        jQuery("#display_slider_navigation_1").prop("checked", true);
        jQuery("#navigation_style_hidden").val('navigation3');
        jQuery("#display_slider_controls_0").prop("checked", false);
        jQuery("#display_slider_controls_1").prop("checked", true);
        jQuery("#control1").prop("checked", false);
        jQuery("#control2").prop("checked", true);
        jQuery("#control3").prop("checked", false);
        jQuery("#slider_autoplay_0").prop("checked", false);
        jQuery("#slider_autoplay_1").prop("checked", true);
        jQuery("#slider_autoplay_intervals").val("3000");
        jQuery("#slider_speed").val("500");

        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('1200');
        jQuery('#media_custom_height').val('530');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'sunshiny_slider') {
        /*---set option values for boxy template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("date");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);
        jQuery("#pagination_type").val("no_pagination");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#displaytemplate_ftcolor_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#000000');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#ffffff');
        jQuery('#template_fthovercolor').iris('color', '#ff00ae');
        jQuery('#winter_category_color').iris('color', '#ff00ae');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#ffffff');
        jQuery('#author_content_color').iris('color', '#ffffff');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#ff00ae');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#ff00ae');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#cc008b');
        jQuery('#template_titlefontface').val('');
        jQuery('#template_titlefontsize').val('20');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);

        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('');

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#template_slider_columns').val('2');
        jQuery('#template_slider_columns_ipad').val('2');
        jQuery('#template_slider_columns_tablet').val('1');
        jQuery('#template_slider_columns_mobile').val('1');
        jQuery('#template_slider_effect').val('slide');
        jQuery('#template_slider_scroll').val('1');
        jQuery("#display_slider_navigation_0").prop("checked", false);
        jQuery("#display_slider_navigation_1").prop("checked", true);
        jQuery("#navigation_style_hidden").val('navigation3');
        jQuery("#display_slider_controls_0").prop("checked", true);
        jQuery("#display_slider_controls_1").prop("checked", false);
        jQuery("#control1").prop("checked", false);
        jQuery("#control2").prop("checked", true);
        jQuery("#control3").prop("checked", false);
        jQuery("#slider_autoplay_0").prop("checked", false);
        jQuery("#slider_autoplay_1").prop("checked", true);
        jQuery("#slider_autoplay_intervals").val("3000");
        jQuery("#slider_speed").val("500");


        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('380');
        jQuery('#media_custom_height').val('500');

        bdpCustomReadMore('show');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'pretty') {
        /*---set option values for New Layout template---*/
        jQuery('#template_color').iris('color', '#ff93a3');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("");
        jQuery(".blg_order").hide();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#b7b7b7');
        jQuery('#template_fthovercolor').iris('color', '#859f88');


        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author] " + bdpro_js.information);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#859f88');
        jQuery('#author_content_color').iris('color', '#484848');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#859f88');
        jQuery('#template_titlehovercolor').iris('color', '#ff93a3');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("Lobster");
        jQuery("#template_titlefontface_font_type").val("Google Fonts");
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_title_font_weight").val("bold");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("2");
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#firstletter_fontsize").val("28");
        jQuery('#firstletter_contentcolor').iris('color', '#484848');
        jQuery('#template_contentcolor').iris('color', '#484848');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#f7fbfc');
        jQuery('#template_readmorebackcolor').iris('color', '#859f88');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#6a7f6c');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery('#social_sharecount').val('right');

        /**
         * Make font family to default
         */
        jQuery("#content_font_family").val('Ubuntu');
        jQuery("#content_font_family_font_type").val('Google Fonts');
        jQuery("#firstletter_font_family").val('');

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'tagly') {
        /*---set option values for New Layout template---*/
        jQuery('#template_color').iris('color', '#b79a5e');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("");
        jQuery(".blg_order").hide();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '');
        jQuery('#author_bgcolor').val('');
        jQuery('#template_ftcolor').iris('color', '#999999');
        jQuery('#template_fthovercolor').iris('color', '#b79a5e');


        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author] " + bdpro_js.information);
        jQuery("#author_title_fontsize").val("25");
        jQuery("#author_title_fontface").val("Ubuntu");
        jQuery("#author_title_fontface_font_type").val("Google Fonts");
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#555555');

        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlehovercolor').iris('color', '#b79a5e');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontface").val("Ubuntu");
        jQuery("#template_titlefontface_font_type").val("Google Fonts");
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_title_font_weight").val("normal");
        jQuery("#template_title_font_line_height").val("1.5");
        jQuery("#template_title_font_text_transform").val("none");
        jQuery("#template_title_font_text_decoration").val("none");
        jQuery("#template_title_font_letter_spacing").val("2");
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);

        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#firstletter_fontsize").val("30");
        jQuery('#firstletter_contentcolor').iris('color', '#555555');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#txtReadmoretext').val(bdpro_js.continue_reading);
        jQuery('#template_readmorecolor').iris('color', '#b79a5e');
        jQuery('#template_readmorebackcolor').iris('color', '#ffffff');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#927b4b');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('.firstletter-setting').hide();

        jQuery("#default_icon_theme_1").prop("checked", false);
        jQuery("#default_icon_theme_8").prop("checked", true);

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery('#social_sharecount').val('bottom');

        /**
         * Make font family to default
         */
        jQuery("#content_font_family").val('Ubuntu');
        jQuery("#content_font_family_font_type").val('Google Fonts');
        jQuery("#firstletter_font_family").val('');

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);

        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');
        jQuery('.bdp_media_custom_size_tr').hide();
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('320');

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'brite') {
        /*---set option values for boxy template---*/
        jQuery("#posts_per_page").val("10");
        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#0e83cd');
        jQuery('#winter_category_color').iris('color', '#0e83cd');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("22");
        jQuery("#author_title_fontface").val("");
        jQuery("#bdp_post_title_link_0").prop("checked", true);
        jQuery("#bdp_post_title_link_1").prop("checked", false);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#0e83cd');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#545454');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#0e83cd');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#0b68a4');
        jQuery('#template_titlefontface').val('Libre Baskerville');
        jQuery('#template_titlefontsize').val('22');
        jQuery('#template_title_font_weight').val('bold');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#545454');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        if (jQuery("#social_style_0").prop("checked", false));
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('Ubuntu');


        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('800');
        jQuery('#media_custom_height').val('500');

        jQuery("#default_icon_theme_8").prop("checked", true);

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'chapter') {
        /*---set option values for boxy template---*/
        jQuery("#posts_per_page").val("9");
        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_color').iris('color', '#a9181d');
        jQuery('#template_bgcolor').iris('color', '#000000');
        jQuery('#template_ftcolor').iris('color', '#ffffff');
        jQuery('#template_fthovercolor').iris('color', '#ffffff');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("");
        jQuery('#author_titlecolor').iris('color', '#ffffff');
        jQuery('#author_content_color').iris('color', '#ffffff');
        jQuery("#bdp_post_title_link_0").prop("checked", true);
        jQuery("#bdp_post_title_link_1").prop("checked", false);
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#ffffff');
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery("#txtExcerptlength").val("0");
        jQuery("#content_fontsize").val("14");
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#000000');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#323232');
        jQuery('#template_titlefontface').val('Libre Baskerville');
        jQuery('#template_titlefontsize').val('26');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#bdp_post_image_link_0').prop("checked", true);
        jQuery('#bdp_post_image_link_1').prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", true);
        jQuery('#disable_link_tag').prop("checked", true);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", true);
        jQuery('#disable_link_comment').prop("checked", true);
        jQuery('#filter_cat').prop("checked", false);
        jQuery('#filter_date').prop("checked", false);
        jQuery('.filter_taxonomy').prop("checked", false);
        jQuery('#column_setting').val(3);
        jQuery('#column_setting_ipad').val(3);
        jQuery('#column_setting_tablet').val(1);
        jQuery('#column_setting_mobile').val(1);
        jQuery('.titlebackcolor_tr').hide();

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('Ubuntu');


        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('350');
        jQuery('#media_custom_height').val('250');

        jQuery("#default_icon_theme_8").prop("checked", true);

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'roctangle') {
        jQuery("#posts_per_page").val("10");
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#column_setting").val("2");
        jQuery("#column_setting_ipad").val("2");
        jQuery("#column_setting_tablet").val("1");
        jQuery("#column_setting_mobile").val("1");
        jQuery('#template_color').iris('color', '#f18293');
        jQuery('#template_ftcolor').iris('color', '#444444');
        jQuery('#template_fthovercolor').iris('color', '#666666');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlehovercolor').iris('color', '#f18293');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery('#template_titlefontface').val('Playfair Display');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('600');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('30');
        jQuery('#firstletter_font_family').val('Poppins');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#txtExcerptlength").val("60");
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#222222');

        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.2');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('Poppins');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery('#bdp_media_size').val('deport-thumbnail');
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('640');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);

        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#f18293');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("");


        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", false);
        jQuery("#reddit_link_1").prop("checked", true);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_8").prop("checked", true);

        /**
         * Content font style default
         */
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('Ubuntu');


        jQuery('#bdp-image-action-button').removeClass('bdp-remove_image_button');
        jQuery('#bdp-image-action-button').addClass('bdp-upload_image_button');
        jQuery('.bdp_default_image_holder > img').slideDown().remove();
        jQuery('#bdp_default_image_id').val('');
        jQuery('#bdp_default_image_src').val('');

        jQuery('#bdp_media_size').val('full');

        jQuery("#default_icon_theme_8").prop("checked", true);

        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'glamour') {
        jQuery("#posts_per_page").val("10");
        jQuery("#pagination_type").val("load_more_btn");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#column_setting").val("3");
        jQuery("#column_setting_ipad").val("2");
        jQuery("#column_setting_tablet").val("2");
        jQuery("#column_setting_mobile").val("1");
        jQuery('#template_color').iris('color', '#000000');
        jQuery('#template_bgcolor').iris('color', '#000000');
        jQuery('#template_ftcolor').iris('color', '#f5c034');
        jQuery('#template_fthovercolor').iris('color', '#ffffff');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#f5c034');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery('#template_titlefontface').val('Roboto Slab');
        jQuery('#template_titlefontsize').val('18');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('1');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('30');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#ffffff');
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery("#txtExcerptlength").val("0");
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#f5c034');
        jQuery('#template_readmorebackcolor').iris('color', '#2d2d2d');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#000000');

        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val(0);
        jQuery("#content_font_family").val('Ubuntu');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery('#bdp_media_size').val('deport-thumbnail');
        jQuery('#media_custom_width').val('400');
        jQuery('#media_custom_height').val('500');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#222222');
        jQuery('#author_content_color').iris('color', '#f18293');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("Roboto Slab");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", false);
        jQuery("#reddit_link_1").prop("checked", true);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_3").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'cover') {
        jQuery("#posts_per_page").val("10");
        jQuery("#pagination_type").val("load_more_btn");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#template_color').iris('color', '#f2f2f2');
        jQuery('#template_bgcolor').iris('color', '#f9f9f9');
        jQuery('#template_ftcolor').iris('color', '#fb6262');
        jQuery('#template_fthovercolor').iris('color', '#666666');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlehovercolor').iris('color', '#fb6262');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery('#template_titlefontface').val('Playfair Display');
        jQuery('#template_titlefontsize').val('24');
        jQuery('#template_title_font_weight').val('400');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#666666');
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery("#txtExcerptlength").val("90");
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#666666');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#fb6262');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Ubuntu');

        jQuery("#thumbnail_skin_0").prop("checked", true);
        jQuery("#thumbnail_skin_1").prop("checked", false);
        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", false);
        jQuery("#bdp_image_hover_effect_1").prop("checked", true);
        jQuery("#bdp_image_hover_effect_type").val("shine_circle");
        jQuery('#bdp_media_size').val('cover_thumb');
        jQuery('#media_custom_width').val('320');
        jQuery('#media_custom_height').val('480');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", true);
        jQuery("#bdp_blog_order_desc").prop("checked", false);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#fb6262');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("28");
        jQuery("#author_title_fontface").val("Playfair Display");


        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_2").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'fairy') {
        jQuery("#posts_per_page").val("5");
        jQuery("#pagination_type").val("load_more_btn");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#template_color').iris('color', '#f7f7f7');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#333333');
        jQuery('#template_fthovercolor').iris('color', '#888888');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery('#template_titlehovercolor').iris('color', '#e5d3d3');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery('#template_titlefontface').val('Poppins');
        jQuery('#template_titlefontsize').val('26');
        jQuery('#template_title_font_weight').val('500');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('1');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Arial, Helvetica, sans-serif');
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery("#txtExcerptlength").val("30");
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#333333');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#888888');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Arial, Helvetica, sans-serif');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#bdp_image_hover_effect_type").val("shine_circle");
        jQuery('#bdp_media_size').val('custom');
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('500');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("Poppins");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_2").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'famous') {
        jQuery("#posts_per_page").val("9");
        jQuery("#pagination_type").val("load_more_btn");
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#column_setting").val("3");
        jQuery("#column_setting_ipad").val("2");
        jQuery("#column_setting_tablet").val("2");
        jQuery("#column_setting_mobile").val("1");
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#f42887');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#777777');
        jQuery('#template_titlehovercolor').iris('color', '#333333');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery('#template_titlefontface').val('Poppins');
        jQuery('#template_titlefontsize').val('18');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Poppins');
        jQuery('#firstletter_contentcolor').iris('color', '#333333');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery("#txtExcerptlength").val("20");
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#f42887');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#333333');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Poppins');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#bdp_image_hover_effect_type").val("slide");
        jQuery('#bdp_media_size').val('easy_timeline_img');
        jQuery('#media_custom_width').val('500');
        jQuery('#media_custom_height').val('300');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#333333');
        jQuery('#author_content_color').iris('color', '#333333');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("20");
        jQuery("#author_title_fontface").val("Poppins");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_8").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'steps') {
        jQuery("#posts_per_page").val("4");
        jQuery("#pagination_type").val("load_onscroll_btn");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#template_color').iris('color', '#d1d1d1');
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#b7b7b7');
        jQuery('#template_fthovercolor').iris('color', '#2a2727');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#2a2727');
        jQuery('#template_titlehovercolor').iris('color', '#e21130');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlefontface').val('Roboto Slab');
        jQuery('#template_titlefontsize').val('26');
        jQuery('#template_title_font_weight').val('400');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#504d4d');
        jQuery('#template_contentcolor').iris('color', '#504d4d');
        jQuery("#txtExcerptlength").val("40");
        jQuery('#txtReadmoretext').val(bdpro_js.continue_reading);
        jQuery('#template_readmorecolor').iris('color', '#e21130');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Ubuntu');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#display_feature_image_0").prop("checked", true);
        jQuery("#display_feature_image_1").prop("checked", false);
        jQuery("#bdp_image_hover_effect_type").val("slide");
        jQuery('#bdp_media_size').val('easy_timeline_img');
        jQuery('#media_custom_width').val('500');
        jQuery('#media_custom_height').val('300');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#2a2727');
        jQuery('#author_content_color').iris('color', '#504d4d');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("Poppins");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_7").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'minimal') {
        jQuery("#posts_per_page").val("9");
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#column_setting").val("3");
        jQuery("#column_setting_ipad").val("2");
        jQuery("#column_setting_tablet").val("2");
        jQuery("#column_setting_mobile").val("1");
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#444444');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#444444');
        jQuery('#template_titlehovercolor').iris('color', '#e84c89');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlefontface').val('Poppins');
        jQuery('#template_titlefontsize').val('24');
        jQuery('#template_title_font_weight').val('600');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('32');
        jQuery('#firstletter_font_family').val('Poppins');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#txtExcerptlength").val("20");
        jQuery("#read_more_link_0").prop("checked", true);
        jQuery("#read_more_link_1").prop("checked", false);
        jQuery('#txtReadmoretext').val('');
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#e84c89');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#444444');

        jQuery("#content_fontsize").val("16");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Poppins');

        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#display_feature_image_0").prop("checked", true);
        jQuery("#display_feature_image_1").prop("checked", false);
        jQuery("#bdp_image_hover_effect_type").val("slide");
        jQuery('#bdp_media_size').val('easy_timeline_img');
        jQuery('#media_custom_width').val('500');
        jQuery('#media_custom_height').val('300');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#444444');
        jQuery('#author_content_color').iris('color', '#444444');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("26");
        jQuery("#author_title_fontface").val("Poppins");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery('#pinterest_image_share').prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_8").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'clicky') {
        jQuery("#posts_per_page").val("5");
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#adadad');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#5b7090');
        jQuery('#template_titlehovercolor').iris('color', '#000000');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlefontface').val('Eczar');
        jQuery('#template_titlefontsize').val('28');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#txtExcerptlength").val("20");
        jQuery('#txtReadmoretext').val(bdpro_js.readmore);
        jQuery('#template_readmorecolor').iris('color', '#5b7090');
        jQuery('#template_readmorebackcolor').iris('color', '#ffffff');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#e7e7e7');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Ubuntu');

        jQuery("#thumbnail_skin_0").prop("checked", true);
        jQuery("#thumbnail_skin_1").prop("checked", false);
        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#display_feature_image_0").prop("checked", false);
        jQuery("#display_feature_image_1").prop("checked", true);
        jQuery("#bdp_image_hover_effect_type").val("slide");
        jQuery('#bdp_media_size').val('deport-thumbnail');
        jQuery('#media_custom_width').val('640');
        jQuery('#media_custom_height').val('640');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#5b7090');
        jQuery('#author_content_color').iris('color', '#444444');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("30");
        jQuery("#author_title_fontface").val("Eczar");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_2").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'miracle') {
        jQuery("#posts_per_page").val("5");
        jQuery("#pagination_type").val("paged");
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#62bf7c');
        jQuery('#template_fthovercolor').iris('color', '#686868');
        jQuery("#bdp_post_title_link_0").prop("checked", false);
        jQuery("#bdp_post_title_link_1").prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#353535');
        jQuery('#template_titlehovercolor').iris('color', '#62bf7c');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery('#template_titlefontface').val('Raleway');
        jQuery('#template_titlefontsize').val('34');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.4');
        jQuery('#template_title_font_text_transform').val('none');
        jQuery('#template_title_font_text_decoration').val('none');
        jQuery('#template_title_font_letter_spacing').val('0');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('#display_html_tags_0').prop("checked", true);
        jQuery('#display_html_tags_1').prop("checked", false);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Raleway');
        jQuery('#firstletter_contentcolor').iris('color', '#252525');
        jQuery('#template_contentcolor').iris('color', '#252525');
        jQuery("#txtExcerptlength").val("20");
        jQuery('#txtReadmoretext').val(bdpro_js.continue_reading);
        jQuery('#template_readmorecolor').iris('color', '#ffffff');
        jQuery('#template_readmorebackcolor').iris('color', '#62bf7c');
        jQuery('#template_readmore_hover_backcolor').iris('color', '#686868');

        jQuery("#content_fontsize").val("14");
        jQuery("#content_font_weight").val('normal');
        jQuery("#content_font_line_height").val('1.5');
        jQuery("#content_font_italic").prop("checked", false);
        jQuery("#content_font_text_transform").val('none');
        jQuery("#content_font_text_decoration").val('none');
        jQuery("#content_font_letter_spacing").val('1');
        jQuery("#content_font_family").val('Raleway');

        jQuery("#thumbnail_skin_0").prop("checked", true);
        jQuery("#thumbnail_skin_1").prop("checked", false);
        jQuery('#bdp_post_image_link_0').prop("checked", false);
        jQuery('#bdp_post_image_link_1').prop("checked", true);
        jQuery("#bdp_image_hover_effect_0").prop("checked", true);
        jQuery("#bdp_image_hover_effect_1").prop("checked", false);
        jQuery("#display_feature_image_0").prop("checked", false);
        jQuery("#display_feature_image_1").prop("checked", true);
        jQuery("#bdp_image_hover_effect_type").val("slide");
        jQuery('#bdp_media_size').val('full');
        jQuery('#media_custom_width').val('1200');
        jQuery('#media_custom_height').val('640');

        jQuery("#bdp_blog_order_by").val("ID");
        jQuery(".blg_order").show();
        jQuery("#bdp_blog_order_asc").prop("checked", false);
        jQuery("#bdp_blog_order_desc").prop("checked", true);

        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#author_titlecolor').iris('color', '#353535');
        jQuery('#author_content_color').iris('color', '#252525');
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#txtAuthorTitle").val("[author]");
        jQuery("#author_title_fontsize").val("34");
        jQuery("#author_title_fontface").val("Raleway");

        jQuery("#social_style_0").prop("checked", false);
        jQuery("#social_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_size_0").prop("checked", true);
        jQuery("#social_icon_size_1").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");

        jQuery("#default_icon_theme_2").prop("checked", true);
        bdpCustomReadMore('hide');
        jQuery('.buttonset').buttonset();
    }

    jQuery('.select-cover select').trigger("chosen:updated");

    paginationTypeSelection();
}

function paginationTypeSelection() {
    if (jQuery("select[name='pagination_type']").val() == 'paged') {
        jQuery(".archive_pagination_template").show();
    } else {
        jQuery(".archive_pagination_template").hide();
    }
    if (jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
        jQuery(".archive_loader_template").show();
        if(jQuery("select[name='pagination_type']").val() == 'load_more_btn') {
            jQuery('.loadmore_btn_option').show();
        } else {
            jQuery('.loadmore_btn_option').hide();
        }

        if (jQuery("select[name='loader_type']").val() != 1 ) {
            jQuery(".default_loader").show();
            jQuery(".upload_loader").hide();
        } else if ( jQuery("select[name='pagination_type']").val() == 'load_more_btn' || jQuery("select[name='pagination_type']").val() == 'load_onscroll_btn') {
            jQuery(".default_loader").hide();
            jQuery(".upload_loader").show();
        }
    } else {
        jQuery(".archive_loader_template").hide();
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 36 || charCode > 41) && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }
}
/*----------- code to apply same height to all template 4 li ---------------*/
function bdp_get_boxy_clean_height() {
    var divs = jQuery(".boxy-clean li.blog_wrap").not('.first_post');
    if (jQuery(window).width() > 980) {
        var column = 4;
        if (divs.hasClass('three_column')) {
            column = 3;
        } else if (divs.hasClass('two_column')) {
            column = 2;
        } else if (divs.hasClass('one_column')) {
            column = 1;
        }
    } else if (jQuery(window).width() <= 980 && jQuery(window).width() > 720) {
        var column = 4;
        if (divs.hasClass('three_column_ipad')) {
            column = 3;
        } else if (divs.hasClass('two_column_ipad')) {
            column = 2;
        } else if (divs.hasClass('one_column_ipad')) {
            column = 1;
        }
    } else if (jQuery(window).width() <= 720 && jQuery(window).width() > 480) {
        var column = 4;
        if (divs.hasClass('three_column_tablet')) {
            column = 3;
        } else if (divs.hasClass('two_column_tablet')) {
            column = 2;
        } else if (divs.hasClass('one_column_tablet')) {
            column = 1;
        }
    } else if (jQuery(window).width() <= 480) {
        var column = 4;
        if (divs.hasClass('one_column_mobile')) {
            column = 3;
        } else if (divs.hasClass('two_column_mobile')) {
            column = 2;
        } else if (divs.hasClass('three_column_mobile')) {
            column = 1;
        }
    }
    jQuery(".boxy-clean li.blog_wrap").removeAttr('style');

    for (var i = 0; i < divs.length; i += column) {
        var heights = jQuery(".boxy-clean li.blog_wrap").not('.first_post').slice(i, i + column).map(function () {
            return jQuery(this).height();
        }).get();
        var maxHeight = Math.max.apply(null, heights);
        if (screen.width > 640) {
            jQuery(".boxy-clean li.blog_wrap").not('.first_post').slice(i, i + column).css('height', maxHeight + 50);
        }
    }
}
/* Height of brit_co template */
function bdp_get_brit_co_height() {
    var heights = jQuery(".image_wrapper").map(function () {
        return jQuery(this).height();
    }).get(),
            maxHeight = Math.max.apply(null, heights);
    var content_heights = jQuery(".content_wrapper").map(function () {
        return jQuery(this).height();
    }).get(),
    content_height = Math.max.apply(null, content_heights);
    jQuery('.britco').each(function () {
        var total_height = maxHeight + content_height + 30;
        jQuery(this).find('.bdp_blog_wraper').height(total_height);
    });
}

function fairy_template_height() {
    jQuery('.bdp_wrapper .blog_template.fairy').each(function() {
        var $minHeight = jQuery(this).find('.fairy_footer').outerHeight();
        var $socialHeight = jQuery(this).find('.fairy-social-cover .social-component').outerHeight();
        if($minHeight < $socialHeight) {
            $minHeight = $socialHeight;
        }
        jQuery(this).find('.fairy_wrap .fairy-social-cover').css({ 'min-height': $minHeight + 'px','bottom': '-'+ $minHeight +'px' });

    });

    jQuery('.bdp_blog_template.fairy').find('.fairy_wrap').removeClass('bdp-fairy-center');
    jQuery('.bdp_blog_template.fairy').find('.bdp-post-image').removeClass('bdp-fairy-center');
    if(jQuery(window).width() > 899) {
        setTimeout( function(){
            jQuery('.bdp_blog_template.fairy').each(function() {
                var $imgDivHeight = jQuery(this).find('.bdp-post-image').outerHeight();
                var $contentDivHeight = jQuery(this).find('.fairy_wrap').outerHeight();
                if($imgDivHeight > $contentDivHeight) {
                    jQuery(this).find('.fairy_wrap').addClass('bdp-fairy-center');
                } else if($imgDivHeight < $contentDivHeight) {
                    jQuery(this).find('.bdp-post-image').addClass('bdp-fairy-center');
                }
            });
        }, 1000 );
    }
}

function bdp_animate_elems() {
    var elems = jQuery('.animateblock');
    var winheight = jQuery(window).height();
    var wintop = jQuery(window).scrollTop(); // calculate distance from top of window
    // loop through each item to check when it animates
    elems.each(function () {
        var elm = jQuery(this);
        if (elm.hasClass('animated')) {
            return true;
        } // if already animated skip to the next item
        var topcoords = elm.offset().top; // element's distance from top of page in pixels
        if (wintop > (topcoords - (winheight * 0.6))) {
            // animate when top of the window is 3/4 above the element
            elm.addClass('animated');
            elm.removeClass('animateblock');
        }
    });
    jQuery('.timeline').each(function () {
        if (wintop > jQuery(this).offset().top - winheight)
        {
            var width = jQuery(this).attr('data-width');
            jQuery(this).animate({
                width: width
            }, 500);
        }
    });
}

function bdp_set_single_template_default_data() {
    jQuery("#dsiplay_date_from").val('publish');
    jQuery("#post_date_format").val('default');
    jQuery('#disable_link_author_div').prop("checked", false);
    jQuery("#display_thumbnail_0").prop("checked", false);
    jQuery('#display_thumbnail_1').prop("checked", true);
    jQuery('#social_icon_size_0').prop("checked", false);
    jQuery('#social_icon_size_1').prop("checked", true);
    jQuery("#social_icon_size_2").prop("checked", false);

    if (jQuery('.bdp_template_name').val() == 'invert-grid') {
        /*---set option values for invert grid template---*/
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#47c2dc');
        jQuery('#template_ftcolor').iris('color', '#d35400');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery('#template_titlecolor').iris('color', '#d35400');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#4c3e37');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author]');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#333333');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('26');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'evolution') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#2376ad');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery('#template_titlecolor').iris('color', '#2b2b2b');
        jQuery("#template_titlefontsize").val("32");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("Lucida Console, Monaco, monospace");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#333');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author]');
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val("Get More Posts");
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#333333');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('far fa-hand-point-right');
        jQuery('#txtSocialText').val(bdpro_js.share_posts);
        jQuery('#txtSocialTextFont').val('Lucida Console, Monaco, monospace');
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'timeline') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#displaydate_backcolor').iris('color', '#0099CB');
        jQuery('#template_color').iris('color', '#0099CB');
        jQuery('#template_ftcolor').iris('color', '#0099CB');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#0099CB');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('sans-serif');
        jQuery("#related_post_title").val(bdpro_js.show_more_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('Trebuchet MS, Helvetica, sans-serif');
        jQuery("#related_title_color").iris('color', '#333333');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#facebook_link_with_count").prop("checked", true);
        jQuery("#linkedin_link_with_count").prop("checked", true);
        jQuery("#pinterest_link_with_count").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'cool_horizontal') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#fff');
        jQuery('#template_color').iris('color', '#e21130');
        jQuery('#template_ftcolor').iris('color', '#e21130');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#e21130');
        jQuery("#template_titlefontsize").val("24");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#template_titlefontface").val("");
        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#444');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', true);
        jQuery('#display_pn_date_1').prop('checked', false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.the_author + ' [author]');
        jQuery("#author_title_fontsize").val('18');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('18');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#e21130');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_0").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val("");
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('20');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'overlay_horizontal') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#000000');
        jQuery('#template_ftcolor').iris('color', '#fff');
        jQuery('#template_fthovercolor').iris('color', '#aaa');
        jQuery('#template_titlecolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("48");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#ffffff');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.the_author + ' [author]');
        jQuery("#author_title_fontsize").val('24');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('18');
        jQuery("#related_title_fontface").val('helvetica');
        jQuery("#related_title_color").iris('color', '#fff');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#display_thumbnail_0").prop("checked", true);
        jQuery('#display_thumbnail_1').prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val("");
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'brit_co') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#author_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#2177ce');
        jQuery('#template_ftcolor').iris('color', '#2bb0d8');
        jQuery('#template_fthovercolor').iris('color', '#aaaaaa');
        jQuery('#template_titlecolor').iris('color', '#2bb0d8');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('Palanquin');
        jQuery("#related_post_title").val(bdpro_js.you_also_like);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('Palanquin');
        jQuery("#related_title_color").iris('color', '#444444');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('.shape_social_icon').show();
        jQuery('.size_social_icon').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery('#txtSocialIcon').val('fas fa-arrows-alt');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'navia') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#0E7699');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', true);
        jQuery('#display_pn_image_1').prop('checked', false);
        jQuery('#display_pn_date_0').prop('checked', true);
        jQuery('#display_pn_date_1').prop('checked', false);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author]');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.more_stories);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val(bdpro_js.share);
        jQuery('#txtSocialTextFont').val('Comic Sans MS, cursive, sans-serif');
        jQuery('#txtSocialTextSize').val('26');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'deport') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#3E91AD');
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#3E91AD');
        jQuery('#template_titlecolor').iris('color', '#0E7699');
        jQuery("#template_titlefontsize").val("35");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#888888');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#555555');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('10');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val(bdpro_js.share_posts);
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'boxy-clean') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#18a3b2');
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#3e91ad');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("Palanquin");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('About [author]');
        jQuery("#author_title_fontsize").val('25');
        jQuery("#author_title_fontface").val('Palanquin');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('Palanquin');
        jQuery("#related_title_color").iris('color', '#444444');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").hide();
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('25');
        jQuery("#txtSocialTextFont").val("Palanquin");
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'boxy') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery("#display_navigation_0").prop("checked", false);
        jQuery("#display_navigation_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("14");
        jQuery("#related_post_number").val('3');
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#related_post_title").val(bdpro_js.more_stories);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#04030c');
        jQuery('#template_fthovercolor').iris('color', '#dd3333');
        jQuery('#template_titlecolor').iris('color', '#484848');
        jQuery("#template_titlefontsize").val("30");
        jQuery('#template_contentcolor').iris('color', '#7b7b7b');
        jQuery('#pinterest_image_share').prop("checked", false);
        jQuery("#social_style_1").prop("checked", false);
        if (jQuery("#social_style_0").prop("checked", true)) {
            jQuery(".shape_social_icon").show();
            jQuery(".size_social_icon").show();
        }
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_size_0").prop("checked", false);
        jQuery("#social_icon_size_1").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#dd3333');
        jQuery("#related_post_content_length").val("10");
        jQuery("#author_title_fontsize").val("25");
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#txtSocialIcon").val("far fa-hand-point-right");
        jQuery("#txtSocialText").val(bdpro_js.share_posts);
        jQuery("#txtSocialTextSize").val("30");
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'winter') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#37aece');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery('#winter_category_color').iris('color', '#e7492f');
        jQuery('#template_titlecolor').iris('color', '#444444');
        jQuery("#template_titlefontsize").val("40");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('About [author]');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val("");
        jQuery("#related_title_color").iris('color', '#444444');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val("");
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'spektrum') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#0E7699');
        jQuery('#template_ftcolor').iris('color', '#0E7699');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#888888');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('Times New Roman, Times, serif');
        jQuery("#related_post_title").val(bdpro_js.chk_related_post);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val(bdpro_js.share_posts);
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'region') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#0E7699');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("40");
        jQuery("#template_titlefontface").val('');
        jQuery("#content_fontsize").val("15");
        jQuery("#template_contentfontface").val('');
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('8');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('helvetica');
        jQuery('#txtSocialTextSize').val('26');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'news') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#A95624');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', true);
        jQuery('#display_pn_image_1').prop('checked', false);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val('[author]');
        jQuery("#author_title_fontsize").val('21');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.more_post);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val();
        jQuery('#txtSocialTextFont').val('fantasy');
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'glossary') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#ea4335');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery('#template_contentcolor').iris('color', '#888888');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#related_post_title").val(bdpro_js.chk_more_related_post);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Impact, Charcoal, sans-serif");
        jQuery("#related_title_fontface").val("Impact, Charcoal, sans-serif");
        jQuery("#txtSocialTextFont").val("Lucida Console,Monaco,monospace");
        jQuery('#txtSocialTextSize').val('26');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'classical') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#3E91AD');
        jQuery('#template_ftcolor').iris('color', '#3E91AD');
        jQuery('#template_fthovercolor').iris('color', '#555555');
        jQuery('#template_titlecolor').iris('color', '#0E7699');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("Verdana, Geneva, sans-serif");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_color").iris('color', '#0E7699');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#default_icon_theme_1').prop("checked", true);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery("#txtSocialTextFont").val("Verdana, Geneva, sans-serif");
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'lightbreeze') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#fff');
        jQuery('#template_ftcolor').iris('color', '#f5ab35');
        jQuery('#template_fthovercolor').iris('color', '#4c4c4c');
        jQuery('#template_titlecolor').iris('color', '#4c4c4c');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#808080');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author] ' + bdpro_js.information);
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('Courier New, Courier, monospace');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('Courier New, Courier, monospace');
        jQuery("#related_title_color").iris('color', '#444444');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val(bdpro_js.share_it);
        jQuery('#txtSocialTextFont').val('Courier New, Courier, monospace');
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'media-grid') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_color').iris('color', '#3E91AD');
        jQuery('#template_ftcolor').iris('color', '#3E91AD');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery("#template_titlefontsize").val("28");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("16");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author]');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#333333');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('24');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'offer_blog') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#fff');
        jQuery('#template_ftcolor').iris('color', '#0E7699');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery("#template_titlefontsize").val("25");
        jQuery("#content_fontsize").val("16");
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', true);
        jQuery('#display_pn_image_1').prop('checked', false);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author]');
        jQuery("#author_title_fontsize").val('21');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_color").iris('color', '#222222');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val();
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('24');
        jQuery("#template_titlefontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Times New Roman, Times, serif");
        jQuery("#related_title_fontface").val("Times New Roman, Times, serif");
        jQuery("#txtSocialTextFont").val("Tahoma, Geneva, sans-serif");

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'story') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_0").prop("checked", false);
        jQuery("#display_comment_1").prop("checked", true);
        jQuery("#display_thumbnail_0").prop("checked", false);
        jQuery("#display_thumbnail_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#display_single_story_year_0").prop("checked", false);
        jQuery("#display_single_story_year_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#4458c9');
        jQuery('#story_startup_background').iris('color', '#85e71c');
        jQuery('#story_startup_text_color').iris('color', '#333333');
        jQuery('#story_startup_text').val(bdpro_js.startup_text);
        jQuery('#template_color').iris('color', '#b00dd8');
        jQuery('#template_ftcolor').iris('color', '#4458c9');
        jQuery('#template_fthovercolor').iris('color', '#2b2b2b');
        jQuery('#template_titlecolor').iris('color', '#707070');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery("#content_fontsize").val("14");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', true);
        jQuery('#display_pn_image_1').prop('checked', false);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#display_author_data_0").prop("checked", false);
        jQuery("#display_author_data_1").prop("checked", true);
        jQuery("#display_author_biography_0").prop("checked", false);
        jQuery("#display_author_biography_1").prop("checked", true);
        jQuery("#txtAuthorTitle").val(bdpro_js.about + ' [author]');
        jQuery("#author_title_fontsize").val('20');
        jQuery("#author_title_fontface").val('');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('');
        jQuery("#related_title_color").iris('color', '#707070');
        jQuery("#related_post_by").val('category');
        jQuery("#bdp_related_post_order_by").val('date');
        jQuery("#bdp_related_post_asc").prop("checked", false);
        jQuery("#bdp_related_post_desc").prop("checked", true);
        jQuery("#related_post_number").val('3');
        jQuery("#related_post_content_length").val('');
        jQuery("#social_sharecount").val("bottom");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery(".social_link_with_count").show();
        jQuery(".shape_social_icon").hide();
        jQuery(".size_social_icon").hide();
        jQuery('#txtSocialIcon').val();
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextFont').val('');
        jQuery('#txtSocialTextSize').val('29');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'easy_timeline') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#template_ftcolor").iris('color', '#E21130');
        jQuery("#template_fthovercolor").iris('color', '#444444');
        jQuery("#template_titlecolor").iris('color', '#444444');
        jQuery('#template_titlefontsize').val('28');
        jQuery("#template_contentcolor").iris('color', '#666666');
        jQuery("#firstletter_contentcolor").iris('color', '#666666');
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery('#content_fontsize').val('14');
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val(bdpro_js.share_posts);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);

    }
    if (jQuery('.bdp_template_name').val() == 'explore') {
        /*---set option values for explore template---*/
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#template_grid_height").val("300");
        jQuery("#template_grid_skin").val("default");
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#333333');
        jQuery('#template_fthovercolor').iris('color', '#44545d');
        jQuery("#template_titlefontface").val("");
        jQuery("#author_title_fontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#related_title_fontface").val("");
        jQuery('#bdp_post_title_link_0').prop("checked", false);
        jQuery('#bdp_post_title_link_1').prop("checked", true);
        jQuery('#template_titlecolor').iris('color', '#152934');
        jQuery('#template_titlebackcolor').iris('color', '');
        jQuery('#template_titlebackcolor').val('');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(0);
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#custom_post_type").val("post");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery(".social_link_with_count").show();
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialIcon").val("");
        jQuery('.buttonset').buttonset();
        /*---------------------------------------------*/
    }
    if (jQuery('.bdp_template_name').val() == 'my_diary') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#333333');
        jQuery('#template_fthovercolor').iris('color', '#e84159');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlefontsize').val('30');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_contentfontface").val("");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("");
        jQuery("#related_title_fontface").val("");
        jQuery("#txtSocialTextFont").val("");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery('#content_fontsize').val('18');
        jQuery('#template_contentcolor').iris('color', '#333333');
        jQuery('#author_title_fontsize').val('24');
        jQuery('#related_title_fontsize').val('24');
        jQuery('#related_title_color').iris('color', '#333333');
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val();
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('18');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'elina') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#e21130');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlefontsize').val('30')
        jQuery('#content_fontsize').val('16');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#firstletter_contentcolor').iris('color', '#555555');
        jQuery("#template_contentfontface").val("Verdana, Geneva, sans-serif");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Verdana, Geneva, sans-serif");
        jQuery("#related_title_fontface").val("Verdana, Geneva, sans-serif");
        jQuery("#txtSocialTextFont").val("Verdana, Geneva, sans-serif");
        jQuery('#author_title_fontsize').val('24');
        jQuery('#related_title_fontsize').val('24');
        jQuery('#related_title_color').iris('color', '#333333');
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('fas fa-sign-out-alt');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#template_titlefontface").val("");
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(0);
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('18');
        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'masonry_timeline') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#e21130');
        jQuery('#template_fthovercolor').iris('color', '#333333');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#content_fontsize').val('16');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery('#author_title_fontsize').val('24');
        jQuery('#related_title_fontsize').val('24');
        jQuery('#related_title_color').iris('color', '#333333');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery("#template_titlefontface").val("");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery('.social_link_with_count').show();
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('18');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#template_contentfontface").val("Montserrat");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Montserrat");
        jQuery("#related_title_fontface").val("Montserrat");
        jQuery("#txtSocialTextFont").val("Montserrat");

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'brite') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery('#winter_category_color').iris('color', '#0e83cd');
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '');
        jQuery('#template_bgcolor').val('');
        jQuery('#template_ftcolor').iris('color', '#999999');
        jQuery('#template_fthovercolor').iris('color', '#0e83cd');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlefontsize').val('25');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#author_title_fontsize').val('25');
        jQuery('#related_title_fontsize').val('25');
        jQuery('#related_title_color').iris('color', '#222222');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(2);
        jQuery("#template_titlefontface").val("Libre Baskerville");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery('.social_link_with_count').show();
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('18');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#template_contentfontface").val("Ubuntu");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Libre Baskerville");
        jQuery("#related_title_fontface").val("Libre Baskerville");
        jQuery("#txtSocialTextFont").val("Libre Baskerville");
        jQuery("#display_post_views_0").prop("checked", true);
        jQuery("#display_post_views_1").prop("checked", false);
        jQuery("#display_post_views_2").prop("checked", false);

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'chapter') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#555555');
        jQuery('#template_fthovercolor').iris('color', '#a9181d');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlefontsize').val('25');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#author_title_fontsize').val('25');
        jQuery('#related_title_fontsize').val('25');
        jQuery('#related_title_color').iris('color', '#222222');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery("#template_titlefontface").val("Libre Baskerville");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", false);
        jQuery("#whatsapp_link_1").prop("checked", true);
        jQuery('.social_link_with_count').show();
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('18');
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#template_contentfontface").val("Ubuntu");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Libre Baskerville");
        jQuery("#related_title_fontface").val("Libre Baskerville");
        jQuery("#txtSocialTextFont").val("Libre Baskerville");
        jQuery("#display_post_views_0").prop("checked", true);
        jQuery("#display_post_views_1").prop("checked", false);
        jQuery("#display_post_views_2").prop("checked", false);

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'tagly') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '');
        jQuery('#template_bgcolor').val('');
        jQuery('#template_color').iris('color', '#d4c6a8');
        jQuery('#template_ftcolor').iris('color', '#b79a5e');
        jQuery('#template_fthovercolor').iris('color', '#d4c6a8');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#author_title_fontsize').val('25');
        jQuery('#related_title_fontsize').val('25');
        jQuery('#related_title_color').iris('color', '#333333');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery("#template_titlefontface").val("Droid Serif");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", false);
        jQuery('#social_icon_style_1').prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery('.social_link_with_count').show();
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('14');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#template_contentfontface").val("Ubuntu");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Droid Serif");
        jQuery("#related_title_fontface").val("Droid Serif");
        jQuery("#txtSocialTextFont").val("Droid Serif");
        jQuery("#display_post_views_0").prop("checked", true);
        jQuery("#display_post_views_1").prop("checked", false);
        jQuery("#display_post_views_2").prop("checked", false);

        jQuery("#default_icon_theme_3").prop("checked", true);

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'pretty') {
        jQuery('#disable_link_category').prop("checked", false);
        jQuery('#disable_link_tag').prop("checked", false);
        jQuery('#disable_link_author').prop("checked", false);
        jQuery('#disable_link_date').prop("checked", false);
        jQuery('#disable_link_comment').prop("checked", false);
        jQuery("#display_postlike_0").prop("checked", true);
        jQuery("#display_postlike_1").prop("checked", false);
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery("#display_category_0").prop("checked", false);
        jQuery("#display_category_1").prop("checked", true);
        jQuery("#display_postlike_0").prop("checked", false);
        jQuery("#display_postlike_1").prop("checked", true);
        jQuery("#display_tag_0").prop("checked", false);
        jQuery("#display_tag_1").prop("checked", true);
        jQuery("#display_author_0").prop("checked", false);
        jQuery("#display_author_1").prop("checked", true);
        jQuery("#display_date_0").prop("checked", false);
        jQuery("#display_date_1").prop("checked", true);
        jQuery("#display_comment_count_0").prop("checked", false);
        jQuery("#display_comment_count_1").prop("checked", true);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#ff93a3');
        jQuery('#template_ftcolor').iris('color', '#999999');
        jQuery('#template_fthovercolor').iris('color', '#859f88');
        jQuery('#template_titlecolor').iris('color', '#859f88');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#author_title_fontsize').val('25');
        jQuery('#related_title_fontsize').val('25');
        jQuery('#related_title_color').iris('color', '#859f88');
        jQuery("#template_title_font_weight").val('normal');
        jQuery("#template_title_font_line_height").val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val(1);
        jQuery("#template_titlefontface").val("Lobster");
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#display_navigation_0').prop('checked', false);
        jQuery('#display_navigation_1').prop('checked', true);
        jQuery('.post-navigation-blocks').show();
        jQuery('#display_pn_title_0').prop('checked', false);
        jQuery('#display_pn_title_1').prop('checked', true);
        jQuery('#display_pn_image_0').prop('checked', false);
        jQuery('#display_pn_image_1').prop('checked', true);
        jQuery('#display_pn_date_0').prop('checked', false);
        jQuery('#display_pn_date_1').prop('checked', true);
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('.default_icon_layouts').show();
        jQuery('#social_icon_style_0').prop("checked", false);
        jQuery('#social_icon_style_1').prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery('.social_link_with_count').show();
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery('#txtSocialIcon').val('');
        jQuery('#txtSocialText').val('');
        jQuery('#txtSocialTextSize').val('14');
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#template_contentfontface").val("Ubuntu");
        jQuery("#template_content_font_weight").val("normal");
        jQuery("#template_content_font_line_height").val("1.5");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#author_title_fontface").val("Ubuntu");
        jQuery("#related_title_fontface").val("Ubuntu");
        jQuery("#txtSocialTextFont").val("Ubuntu");
        jQuery("#display_post_views_0").prop("checked", true);
        jQuery("#display_post_views_1").prop("checked", false);
        jQuery("#display_post_views_2").prop("checked", false);

        jQuery("#default_icon_theme_2").prop("checked", true);
        jQuery('.buttonset').buttonset();

    }
    if (jQuery('.bdp_template_name').val() == 'roctangle') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", true);
        jQuery('#display_category_1').prop("checked", false);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);
        jQuery('#template_color').iris('color', '#f18293');
        jQuery('#template_ftcolor').iris('color', '#888888');
        jQuery('#template_fthovercolor').iris('color', '#666666');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlefontface').val('Playfair Display');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('30');
        jQuery('#firstletter_font_family').val('Poppins');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery('#template_contentfontface').val('Poppins');
        jQuery('#content_fontsize').val('15');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.2');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("30");
        jQuery('#author_title_fontface').val("Playfair Display");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('30');
        jQuery("#related_title_fontface").val('Playfair Display');
        jQuery('#related_title_color').iris('color', '#222222');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("30");

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'minimal') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", false);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", true);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#444444');
        jQuery('#template_fthovercolor').iris('color', '#e84c89');
        jQuery('#winter_category_color').iris('color', '#e84c89');
        jQuery('#template_titlecolor').iris('color', '#000000');
        jQuery('#template_titlefontface').val('Poppins');
        jQuery('#template_titlefontsize').val('24');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Arial, Helvetica, sans-serif');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery('#template_contentfontface').val('Arial, Helvetica, sans-serif');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("1");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("24");
        jQuery('#author_title_fontface').val("Poppins");
        jQuery("#display_related_post").prop("checked", true);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('24');
        jQuery("#related_title_fontface").val('Poppins');
        jQuery('#related_title_color').iris('color', '#000000');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset();

    }
    if (jQuery('.bdp_template_name').val() == 'glamour') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", true);
        jQuery('#display_tag_1').prop("checked", false);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#444444');
        jQuery('#template_fthovercolor').iris('color', '#f5c034');
        jQuery('#template_titlecolor').iris('color', '#000000');
        jQuery('#template_titlefontface').val('Roboto Slab');
        jQuery('#template_titlefontsize').val('24');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#444444');
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery('#template_contentfontface').val('Ubuntu');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("1");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("24");
        jQuery('#author_title_fontface').val("Poppins");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('24');
        jQuery("#related_title_fontface").val('Roboto Slab');
        jQuery('#related_title_color').iris('color', '#000000');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset();

    }
    if (jQuery('.bdp_template_name').val() == 'famous') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", true);
        jQuery('#display_postlike_1').prop("checked", false);
        jQuery('#display_post_views_0').prop("checked", false);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", true);

        jQuery('#template_ftcolor').iris('color', '#a5a5a5');
        jQuery('#template_fthovercolor').iris('color', '#f20075');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlefontface').val('Libre Baskerville');
        jQuery('#template_titlefontsize').val('24');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", false);
        jQuery("#template_title_font_italic_1").prop("checked", true);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Libre Franklin');
        jQuery('#firstletter_contentcolor').iris('color', '#555555');
        jQuery('#template_contentcolor').iris('color', '#555555');
        jQuery('#template_contentfontface').val('Libre Franklin');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("1");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("24");
        jQuery('#author_title_fontface').val("Libre Baskerville");
        jQuery("#display_related_post").prop("checked", true);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('24');
        jQuery("#related_title_fontface").val('Libre Baskerville');
        jQuery('#related_title_color').iris('color', '#333333');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset()
    }
    if(jQuery('.bdp_template_name').val() == 'fairy') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#b6b6b6');
        jQuery('#template_fthovercolor').iris('color', '#0089bb');
        jQuery('#template_titlecolor').iris('color', '#000000');
        jQuery('#template_titlefontface').val('Slabo 27px');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Montserrat');
        jQuery('#firstletter_contentcolor').iris('color', '#5b5b5b');
        jQuery('#template_contentcolor').iris('color', '#5b5b5b');
        jQuery('#template_contentfontface').val('Montserrat');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("24");
        jQuery('#author_title_fontface').val("Libre Baskerville");
        jQuery("#display_related_post").prop("checked", true);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('24');
        jQuery("#related_title_fontface").val('Slabo 27px');
        jQuery('#related_title_color').iris('color', '#000000');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_2").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset()

    }
    if(jQuery('.bdp_template_name').val() == 'clicky') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", true);
        jQuery('#display_category_1').prop("checked", false);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", false);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", true);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#a7a7a7');
        jQuery('#template_fthovercolor').iris('color', '#586f8c');
        jQuery('#winter_category_color').iris('color', '#586f8c');
        jQuery('#template_titlecolor').iris('color', '#586f8c');
        jQuery('#template_titlefontface').val('Montserrat');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.5');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Montserrat');
        jQuery('#firstletter_contentcolor').iris('color', '#686868');
        jQuery('#template_contentcolor').iris('color', '#686868');
        jQuery('#template_contentfontface').val('Montserrat');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("24");
        jQuery('#author_title_fontface').val("Montserrat");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('24');
        jQuery("#related_title_fontface").val('Montserrat');
        jQuery('#related_title_color').iris('color', '#000000');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery("#default_icon_theme_2").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset()

    }
    if (jQuery('.bdp_template_name').val() == 'cover') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", true);
        jQuery('#display_tag_1').prop("checked", false);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", true);
        jQuery('#display_date_1').prop("checked", false);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#b6b6b6');
        jQuery('#template_fthovercolor').iris('color', '#ff6063');
        jQuery('#template_titlecolor').iris('color', '#272727');
        jQuery('#template_titlefontface').val('Playfair Display');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#696969');
        jQuery('#template_contentcolor').iris('color', '#696969');
        jQuery('#template_contentfontface').val('Ubuntu');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("28");
        jQuery('#author_title_fontface').val("Montserrat");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('28');
        jQuery("#related_title_fontface").val('Playfair Display');
        jQuery('#related_title_color').iris('color', '#000000');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", true);
        jQuery('#social_style_1').prop("checked", false);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery("#default_icon_theme_2").prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#social_icon_size_2").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'steps') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", false);
        jQuery('#display_postlike_1').prop("checked", true);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_color').iris('color', '#cbcbcb');
        jQuery('#template_ftcolor').iris('color', '#b7b7b7');
        jQuery('#template_fthovercolor').iris('color', '#f8c04e');
        jQuery('#template_titlecolor').iris('color', '#363636');
        jQuery('#template_titlefontface').val('Roboto Slab');
        jQuery('#template_titlefontsize').val('30');
        jQuery('#template_title_font_weight').val('normal');
        jQuery('#template_title_font_line_height').val('1.2');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Ubuntu');
        jQuery('#firstletter_contentcolor').iris('color', '#666666');
        jQuery('#template_contentcolor').iris('color', '#666666');
        jQuery('#template_contentfontface').val('Ubuntu');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("0");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("28");
        jQuery('#author_title_fontface').val("Roboto Slab");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('28');
        jQuery("#related_title_fontface").val('Montserrat');
        jQuery('#related_title_color').iris('color', '#363636');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#social_icon_size_2").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", false);
        jQuery("#facebook_link_1").prop("checked", true);
        jQuery("#twitter_link_0").prop("checked", false);
        jQuery("#twitter_link_1").prop("checked", true);
        jQuery("#google_link_0").prop("checked", false);
        jQuery("#google_link_1").prop("checked", true);
        jQuery("#linkedin_link_0").prop("checked", false);
        jQuery("#linkedin_link_1").prop("checked", true);
        jQuery("#pinterest_link_0").prop("checked", false);
        jQuery("#pinterest_link_1").prop("checked", true);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", false);
        jQuery("#email_link_1").prop("checked", true);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("26");

        jQuery('.buttonset').buttonset();
    }
    if (jQuery('.bdp_template_name').val() == 'miracle') {
        jQuery('#display_title_0').prop("checked", false);
        jQuery('#display_title_1').prop("checked", true);
        jQuery('#display_category_0').prop("checked", false);
        jQuery('#display_category_1').prop("checked", true);
        jQuery("#disable_link_category").prop("checked", false);
        jQuery('#display_tag_0').prop("checked", false);
        jQuery('#display_tag_1').prop("checked", true);
        jQuery("#disable_link_tag").prop("checked", false);
        jQuery('#display_author_0').prop("checked", false);
        jQuery('#display_author_1').prop("checked", true);
        jQuery("#disable_link_author").prop("checked", false);
        jQuery('#display_date_0').prop("checked", false);
        jQuery('#display_date_1').prop("checked", true);
        jQuery("#disable_link_date").prop("checked", false);
        jQuery('#display_comment_0').prop("checked", false);
        jQuery('#display_comment_1').prop("checked", true);
        jQuery("#disable_link_comment").prop("checked", false);
        jQuery('#display_thumbnail_0').prop("checked", false);
        jQuery('#display_thumbnail_1').prop("checked", true);
        jQuery('#display_postlike_0').prop("checked", true);
        jQuery('#display_postlike_1').prop("checked", false);
        jQuery('#display_post_views_0').prop("checked", true);
        jQuery('#display_post_views_1').prop("checked", false);
        jQuery('#display_post_views_2').prop("checked", false);

        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery('#template_ftcolor').iris('color', '#62bf7c');
        jQuery('#template_fthovercolor').iris('color', '#686868');
        jQuery('#template_titlecolor').iris('color', '#353535');
        jQuery('#template_titlefontface').val('Raleway');
        jQuery('#template_titlefontsize').val('42');
        jQuery('#template_title_font_weight').val('700');
        jQuery('#template_title_font_line_height').val('1.4');
        jQuery("#template_title_font_italic_0").prop("checked", true);
        jQuery("#template_title_font_italic_1").prop("checked", false);
        jQuery("#template_title_font_text_transform").val('none');
        jQuery("#template_title_font_text_decoration").val('none');
        jQuery("#template_title_font_letter_spacing").val('0');
        jQuery('#firstletter_big_0').prop("checked", true);
        jQuery('#firstletter_big_1').prop("checked", false);
        jQuery('#firstletter_fontsize').val('28');
        jQuery('#firstletter_font_family').val('Raleway');
        jQuery('#firstletter_contentcolor').iris('color', '#252525');
        jQuery('#template_contentcolor').iris('color', '#252525');
        jQuery('#template_contentfontface').val('Raleway');
        jQuery('#content_fontsize').val('14');
        jQuery('#template_content_font_weight').val('normal');
        jQuery('#template_content_font_line_height').val('1.5');
        jQuery("#template_content_font_italic_0").prop("checked", true);
        jQuery("#template_content_font_italic_1").prop("checked", false);
        jQuery("#template_content_font_text_transform").val("none");
        jQuery("#template_content_font_text_decoration").val("none");
        jQuery("#template_content_font_letter_spacing").val("1");
        jQuery("#bdp_media_size").val('full');
        jQuery('#display_navigation_0').prop("checked", false);
        jQuery('#display_navigation_1').prop("checked", true);
        jQuery('#bdp_post_navigation_filter').val("");
        jQuery('#display_pn_title_0').prop("checked", false);
        jQuery('#display_pn_title_1').prop("checked", true);
        jQuery('#display_pn_image_0').prop("checked", true);
        jQuery('#display_pn_image_1').prop("checked", false);
        jQuery('#display_pn_date_0').prop("checked", true);
        jQuery('#display_pn_date_1').prop("checked", false);
        jQuery('#display_author_data_0').prop("checked", false);
        jQuery('#display_author_data_1').prop("checked", true);
        jQuery('#display_author_biography_0').prop("checked", false);
        jQuery('#display_author_biography_1').prop("checked", true);
        jQuery('#txtAuthorTitle').val("About [author]");
        jQuery('#author_title_fontsize').val("32");
        jQuery('#author_title_fontface').val("Raleway");
        jQuery("#display_related_post").prop("checked", false);
        jQuery("#bdp_related_post_media_size").val("related-post-thumb");
        jQuery("#related_post_title").val(bdpro_js.related_posts);
        jQuery("#related_title_fontsize").val('32');
        jQuery("#related_title_fontface").val('Raleway');
        jQuery('#related_title_color').iris('color', '#353535');
        jQuery('#related_post_by').val('category');
        jQuery('#bdp_related_post_order_by').val('date');
        jQuery('#bdp_related_post_asc').prop("checked", false);
        jQuery('#bdp_related_post_desc').prop("checked", true);
        jQuery('#related_post_number').val("3");
        jQuery('#related_post_content_from').val("from_content");
        jQuery('#related_post_content_length').val("");
        jQuery('#social_style_0').prop("checked", false);
        jQuery('#social_style_1').prop("checked", true);
        jQuery('#social_icon_style_0').prop("checked", true);
        jQuery('#social_icon_style_1').prop("checked", false);
        jQuery("#default_icon_theme_8").prop("checked", true);
        jQuery('#social_icon_size_0').prop("checked", false);
        jQuery('#social_icon_size_1').prop("checked", true);
        jQuery("#social_icon_size_2").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#pinterest_image_share").prop("checked", true);
        jQuery("#skype_link_0").prop("checked", true);
        jQuery("#skype_link_1").prop("checked", false);
        jQuery("#pocket_link_0").prop("checked", true);
        jQuery("#pocket_link_1").prop("checked", false);
        jQuery("#telegram_link_0").prop("checked", true);
        jQuery("#telegram_link_1").prop("checked", false);
        jQuery("#reddit_link_0").prop("checked", true);
        jQuery("#reddit_link_1").prop("checked", false);
        jQuery("#tumblr_link_0").prop("checked", true);
        jQuery("#tumblr_link_1").prop("checked", false);
        jQuery("#digg_link_0").prop("checked", true);
        jQuery("#digg_link_1").prop("checked", false);
        jQuery("#wordpress_link_0").prop("checked", true);
        jQuery("#wordpress_link_1").prop("checked", false);
        jQuery("#email_link_0").prop("checked", true);
        jQuery("#email_link_1").prop("checked", false);
        jQuery("#whatsapp_link_0").prop("checked", true);
        jQuery("#whatsapp_link_1").prop("checked", false);
        jQuery("#social_sharecount").val("bottom");
        jQuery("#txtSocialIcon").val("");
        jQuery("#txtSocialText").val("");
        jQuery("#txtSocialTextFont_font_type").val("");
        jQuery("#txtSocialTextSize").val("18");

        jQuery('.buttonset').buttonset();
    }

    jQuery('.select-cover select').trigger("chosen:updated");

}
var initial_form_state = jQuery('#single-layout-form,#edit_layout_form,#edit_archive_layout_form').serialize();
jQuery(window).bind('beforeunload', function (e) {
    var form_state = jQuery('#single-layout-form,#edit_layout_form,#edit_archive_layout_form').serialize();
    if (initial_form_state != form_state) {
        var message = "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
        e.returnValue = message; // Cross-browser compatibility (src: MDN)
        //return message;
    }
});
jQuery('#single-layout-form,#edit_layout_form,#edit_archive_layout_form').submit(function () {
    initial_form_state = jQuery('#single-layout-form,#edit_layout_form,#edit_archive_layout_form').serialize();
});


//Fill Icon set in dialog box
function getIconSet(element) {
    var sheets = document.styleSheets;
    if (sheets) {
        jQuery.each(sheets, function (index, sheet) {
            var gotIcon = false,
                    iconSet = "";
            try {
                if (sheet.cssRules !== null & sheet.cssRules != undefined) {
                    jQuery.each(sheet.cssRules, function (index, rule) {

                        if (rule && rule !== null && rule !== "null" && rule.selectorText != undefined) {
                            var prefix = 'fa-';
                            console.log(rule.selectorText);
                            if (rule.selectorText.split(prefix).length > 1 && rule.cssText.split("content").length > 1) {
                                var csname = rule.selectorText.split("::before")[0].split(":before")[0];

                                if (csname != undefined) {
                                    csname = csname.split(".")[1];
                                    if (csname != undefined) {
                                        gotIcon = true;
                                        iconSet = iconSet + '<div class="bdp-element-icon"><i class="fas ' + csname + '"></i></div>';
                                    }
                                }
                            }
                        }
                    });
                }
            } catch (e) {
            }
            if (gotIcon) {
                jQuery(element).find('.icon_div').html(iconSet);
            }
        });
    }
}


//New design script

jQuery(document).ready(function () {
    clickDisable();

    jQuery(".bd-settings-wrappers .postbox table tr td:first-child").hover(function () {
        var $height = jQuery(this).children('.bd-title-tooltip').height();
        jQuery(this).children('.bd-title-tooltip').css('top', 'calc(50% - 30px - ' + $height + 'px)');
    });

    jQuery('#blog_page_display').change(function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bd_get_page_link',
                page_id: jQuery(this).val(),
            },
            success: function (response) {
                jQuery('.page_link').html('');
                jQuery('.page_link').append(response);
            }
        });
    });

    jQuery(".bd-settings-wrappers .bdp-settings li select:not(.chosen-select)").wrap("<div class='select-cover'></div>");
    jQuery(".bd-settings-wrappers .bdp-settings input[type='number']").wrap("<div class='input-type-number'></div>");

    jQuery(".select-cover select").chosen({no_results_text: "Oops, nothing found!"});

    jQuery('<div class="input-type-number-nav"><div class="input-type-number-button input-type-number-up">+</div><div class="input-type-number-button input-type-number-down">-</div></div>').insertAfter('.input-type-number input');
    jQuery('.input-type-number').each(function () {
        var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.input-type-number-up'),
                btnDown = spinner.find('.input-type-number-down'),
                min = input.attr('min'),
                max = input.attr('max');

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });
    bdpAltBackground();
});


function clickDisable() {
    jQuery('.clickDisable').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        e.stopImmediatePropagation();
        return false;
    });
}

function bdpCustomReadMore($data) {
    jQuery('.bd-setting-handle li').each(function () {
        var hide = jQuery(this).attr('data-show');
        if (hide == 'bdpcustomreadmore') {
            if ($data == 'show' && jQuery('#pagination_type').val() == 'no_pagination') {
                jQuery(this).removeClass('clickDisable');
            } else if ($data == 'hide') {
                jQuery(this).addClass('clickDisable');
            }
        }
    });
}

function bdpContentHide(template) {
    template = jQuery.trim(template);
    jQuery('.bd-setting-handle li').each(function () {
        var hide = jQuery(this).attr('data-show');
        if (hide == 'bdpcontent') {
            if (jQuery.inArray(template, $bdp_content_setting) !== -1) {
                jQuery(this).addClass('clickDisable');
            } else {
                jQuery(this).removeClass('clickDisable');
            }
        }
    });
}

function bdp_hex2rgba(color, opacity) {
    color = color.replace('#', '');
    r = parseInt(color.substring(0, 2), 16);
    g = parseInt(color.substring(2, 4), 16);
    b = parseInt(color.substring(4, 6), 16);

    result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
    return result;
}

(function ($) {
    var $, win;

    $ = window.jQuery;

    win = $(window);

    $.fn.stick_in_parent = function (opts) {
        var doc, elm, enable_bottoming, fn, i, inner_scrolling, len, manual_spacer, offset_top, outer_width, parent_selector, recalc_every, sticky_class;
        if (opts == null) {
            opts = {};
        }
        sticky_class = opts.sticky_class, inner_scrolling = opts.inner_scrolling, recalc_every = opts.recalc_every, parent_selector = opts.parent, offset_top = opts.offset_top, manual_spacer = opts.spacer, enable_bottoming = opts.bottoming;
        if (offset_top == null) {
            offset_top = 0;
        }
        if (parent_selector == null) {
            parent_selector = void 0;
        }
        if (inner_scrolling == null) {
            inner_scrolling = true;
        }
        if (sticky_class == null) {
            sticky_class = "is_stuck";
        }
        doc = $(document);
        if (enable_bottoming == null) {
            enable_bottoming = true;
        }
        outer_width = function (el) {
            var _el, computed, w;
            if (window.getComputedStyle) {
                _el = el[0];
                computed = window.getComputedStyle(el[0]);
                w = parseFloat(computed.getPropertyValue("width")) + parseFloat(computed.getPropertyValue("margin-left")) + parseFloat(computed.getPropertyValue("margin-right"));
                if (computed.getPropertyValue("box-sizing") !== "border-box") {
                    w += parseFloat(computed.getPropertyValue("border-left-width")) + parseFloat(computed.getPropertyValue("border-right-width")) + parseFloat(computed.getPropertyValue("padding-left")) + parseFloat(computed.getPropertyValue("padding-right"));
                }
                return w;
            } else {
                return el.outerWidth(true);
            }
        };
        fn = function (elm, padding_bottom, parent_top, parent_height, top, height, el_float, detached) {
            var bottomed, detach, fixed, last_pos, last_scroll_height, offset, parent, recalc, recalc_and_tick, recalc_counter, spacer, tick;
            if (elm.data("sticky_kit")) {
                return;
            }
            elm.data("sticky_kit", true);
            last_scroll_height = doc.height();
            parent = elm.parent();
            if (parent_selector != null) {
                parent = parent.closest(parent_selector);
            }
            if (!parent.length) {
                throw "failed to find stick parent";
            }
            fixed = false;
            bottomed = false;
            spacer = manual_spacer != null ? manual_spacer && elm.closest(manual_spacer) : $("<div />");
            if (spacer) {
                spacer.css('position', elm.css('position'));
            }
            recalc = function () {
                var border_top, padding_top, restore;
                if (detached) {
                    return;
                }
                last_scroll_height = doc.height();
                border_top = parseInt(parent.css("border-top-width"), 10);
                padding_top = parseInt(parent.css("padding-top"), 10);
                padding_bottom = parseInt(parent.css("padding-bottom"), 10);
                parent_top = parent.offset().top + border_top + padding_top;
                parent_height = parent.height();
                if (fixed) {
                    fixed = false;
                    bottomed = false;
                    if (manual_spacer == null) {
                        elm.insertAfter(spacer);
                        spacer.detach();
                    }
                    elm.css({
                        position: "",
                        top: "",
                        width: "",
                        bottom: ""
                    }).removeClass(sticky_class);
                    restore = true;
                }
                top = elm.offset().top - (parseInt(elm.css("margin-top"), 10) || 0) - offset_top;
                height = elm.outerHeight(true);
                el_float = elm.css("float");
                if (spacer) {
                    spacer.css({
                        width: outer_width(elm),
                        height: height,
                        display: elm.css("display"),
                        "vertical-align": elm.css("vertical-align"),
                        "float": el_float
                    });
                }
                if (restore) {
                    return tick();
                }
            };
            recalc();
            if (height === parent_height) {
                return;
            }
            last_pos = void 0;
            offset = offset_top;
            recalc_counter = recalc_every;
            tick = function () {
                var css, delta, recalced, scroll, will_bottom, win_height;
                if (detached) {
                    return;
                }
                recalced = false;
                if (recalc_counter != null) {
                    recalc_counter -= 1;
                    if (recalc_counter <= 0) {
                        recalc_counter = recalc_every;
                        recalc();
                        recalced = true;
                    }
                }
                if (!recalced && doc.height() !== last_scroll_height) {
                    recalc();
                    recalced = true;
                }
                scroll = win.scrollTop();
                if (last_pos != null) {
                    delta = scroll - last_pos;
                }
                last_pos = scroll;
                if (fixed) {
                    if (enable_bottoming) {
                        will_bottom = scroll + height + offset > parent_height + parent_top;
                        if (bottomed && !will_bottom) {
                            bottomed = false;
                            offset = offset + 32;
                            elm.css({
                                position: "fixed",
                                bottom: "",
                                top: offset
                            }).trigger("sticky_kit:unbottom");
                        }
                    }
                    if (scroll < top) {
                        fixed = false;
                        offset = offset_top;
                        if (manual_spacer == null) {
                            if (el_float === "left" || el_float === "right") {
                                elm.insertAfter(spacer);
                            }
                            spacer.detach();
                        }
                        css = {
                            position: "",
                            width: "",
                            top: ""
                        };
                        elm.css(css).removeClass(sticky_class).trigger("sticky_kit:unstick");
                    }
                    if (inner_scrolling) {
                        win_height = win.height();
                        if (height + offset_top > win_height) {
                            if (!bottomed) {
                                offset -= delta;
                                offset = Math.max(win_height - height, offset);
                                offset = Math.min(offset_top, offset);
                                offset = offset + 32;
                                if (fixed) {
                                    elm.css({
                                        top: offset + "px"
                                    });
                                }
                            }
                        }
                    }
                } else {
                    if (scroll > top) {
                        fixed = true;
                        offset = 32;
                        css = {
                            position: "fixed",
                            top: offset
                        };
                        css.width = elm.css("box-sizing") === "border-box" ? elm.outerWidth() + "px" : elm.width() + "px";
                        elm.css(css).addClass(sticky_class);
                        if (manual_spacer == null) {
                            elm.after(spacer);
                            if (el_float === "left" || el_float === "right") {
                                spacer.append(elm);
                            }
                        }
                        elm.trigger("sticky_kit:stick");
                    }
                }
                if (fixed && enable_bottoming) {
                    if (will_bottom == null) {
                        will_bottom = scroll + height + offset > parent_height + parent_top;
                    }
                    if (!bottomed && will_bottom) {
                        bottomed = true;
                        if (parent.css("position") === "static") {
                            parent.css({
                                position: "relative"
                            });
                        }
                        return elm.css({
                            position: "absolute",
                            bottom: padding_bottom,
                            top: "auto"
                        }).trigger("sticky_kit:bottom");
                    }
                }
            };
            recalc_and_tick = function () {
                recalc();
                return tick();
            };
            detach = function () {
                detached = true;
                win.off("touchmove", tick);
                win.off("scroll", tick);
                win.off("resize", recalc_and_tick);
                $(document.body).off("sticky_kit:recalc", recalc_and_tick);
                elm.off("sticky_kit:detach", detach);
                elm.removeData("sticky_kit");
                elm.css({
                    position: "",
                    bottom: "",
                    top: "",
                    width: ""
                });
                parent.position("position", "");
                if (fixed) {
                    if (manual_spacer == null) {
                        if (el_float === "left" || el_float === "right") {
                            elm.insertAfter(spacer);
                        }
                        spacer.remove();
                    }
                    return elm.removeClass(sticky_class);
                }
            };
            win.on("touchmove", tick);
            win.on("scroll", tick);
            win.on("resize", recalc_and_tick);
            $(document.body).on("sticky_kit:recalc", recalc_and_tick);
            elm.on("sticky_kit:detach", detach);
            return setTimeout(tick, 0);
        };
        for (i = 0, len = this.length; i < len; i++) {
            elm = this[i];
            fn($(elm));
        }
        return this;
    };

}).call(this);

jQuery(".bd-menu-setting").stick_in_parent();


/*Alternet background color set*/
function bdpAltBackground() {
    jQuery('.postbox').each(function() {
        jQuery(this).find('ul.bdp-settings > li').removeClass('bdp-gray');
        jQuery(this).find('ul.bdp-settings > li:visible:odd').addClass('bdp-gray');
    });
}