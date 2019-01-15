<?php
/**
 * Single posts custom style css
 */
add_action('wp_head', 'single_page_style', 13);

function single_page_style() {
    global $post;
    if (is_single() && isset($post->post_type) && $post->post_type == 'post') {
        $post_type = $post->post_type;
        $post_id = $post->ID;
        $cat_ids = wp_get_post_categories($post_id);
        $tag_ids = wp_get_post_tags($post_id);
        $single_data = bdp_get_single_template_settings($cat_ids, $tag_ids);
        //$single_data = get_option('bdp_single_template');
        if (!$single_data) {
            return;
        }
        if ($single_data && is_serialized($single_data)) {
            $single_data_setting = unserialize($single_data);
        }
        $display_comment = $single_data_setting['display_comment'];
        $display_date = $single_data_setting['display_date'];
        $load_single_font = array();
        if (isset($single_data_setting['override_single']) && $single_data_setting['override_single'] == 1) {
            $firstletter_fontsize = $firstletter_contentcolor = $firstletter_contentfontface = '';
            if (isset($single_data_setting['firstletter_big']) && $single_data_setting['firstletter_big'] == 1) {
                $firstletter_fontsize = (isset($single_data_setting['firstletter_fontsize']) && $single_data_setting['firstletter_fontsize'] != '') ? $single_data_setting['firstletter_fontsize'] : 30;
                $firstletter_contentfontface = (isset($single_data_setting['firstletter_font_family']) && $single_data_setting['firstletter_font_family'] != '') ? $single_data_setting['firstletter_font_family'] : "";
                if (isset($single_data_setting['firstletter_font_family_font_type']) && $single_data_setting['firstletter_font_family_font_type'] == 'Google Fonts') {
                    $load_single_font[] = $firstletter_contentfontface;
                }
                $firstletter_contentcolor = (isset($single_data_setting['firstletter_contentcolor']) && $single_data_setting['firstletter_contentcolor'] != '') ? $single_data_setting['firstletter_contentcolor'] : "#000000";
            }
            $template_name = apply_filters('bdp_filter_template', $single_data_setting['template_name']);
            $templatecolor = (isset($single_data_setting['template_color']) && $single_data_setting['template_color'] != '') ? $single_data_setting['template_color'] : "#000";
            $template_bgcolor = (isset($single_data_setting['template_bgcolor']) && $single_data_setting['template_bgcolor'] != '') ? $single_data_setting['template_bgcolor'] : "#fff";

            $titlecolor = (isset($single_data_setting['template_titlecolor']) && $single_data_setting['template_titlecolor'] != '') ? $single_data_setting['template_titlecolor'] : "#000";
            $template_titlefontsize = (isset($single_data_setting['template_titlefontsize']) && $single_data_setting['template_titlefontsize'] != '') ? $single_data_setting['template_titlefontsize'] : 30;
            $template_titlefontface = (isset($single_data_setting['template_titlefontface']) && $single_data_setting['template_titlefontface'] != '') ? $single_data_setting['template_titlefontface'] : "";

            if (isset($single_data_setting['template_titlefontface_font_type']) && $single_data_setting['template_titlefontface_font_type'] == "Google Fonts") {
                $load_single_font[] = $template_titlefontface;
            }

            $winter_category_color = (isset($single_data_setting['winter_category_color']) && $single_data_setting['winter_category_color'] != '') ? $single_data_setting['winter_category_color'] : "#e7492f";
            $linkcolor = (isset($single_data_setting['template_ftcolor']) && $single_data_setting['template_ftcolor'] != '') ? $single_data_setting['template_ftcolor'] : "#000";
            $linkhovercolor = (isset($single_data_setting['template_fthovercolor']) && $single_data_setting['template_fthovercolor'] != '') ? $single_data_setting['template_fthovercolor'] : "#000";

            $contentcolor = (isset($single_data_setting['template_contentcolor']) && $single_data_setting['template_contentcolor'] != '') ? $single_data_setting['template_contentcolor'] : "#000";
            $content_fontsize = (isset($single_data_setting['content_fontsize']) && $single_data_setting['content_fontsize'] != '') ? $single_data_setting['content_fontsize'] : 16;
            $content_fontface = (isset($single_data_setting['template_contentfontface']) && $single_data_setting['template_contentfontface'] != '') ? $single_data_setting['template_contentfontface'] : "";
            if (isset($single_data_setting['template_contentfontface_font_type']) && $single_data_setting['template_contentfontface_font_type'] == "Google Fonts") {
                $load_single_font[] = $content_fontface;
            }

            // for related post title
            $relatedTitleColor = (isset($single_data_setting['related_title_color']) && $single_data_setting['related_title_color'] != '') ? $single_data_setting['related_title_color'] : "#333333";
            $relatedTitleSize = (isset($single_data_setting['related_title_fontsize']) && $single_data_setting['related_title_fontsize'] != '') ? $single_data_setting['related_title_fontsize'] : 25;
            $relatedTitleFace = (isset($single_data_setting['related_title_fontface']) && $single_data_setting['related_title_fontface'] != '') ? $single_data_setting['related_title_fontface'] : "";

            if (isset($single_data_setting['related_title_fontface_font_type']) && $single_data_setting['related_title_fontface_font_type'] == "Google Fonts") {
                $load_single_font[] = $relatedTitleFace;
            }

            // for author title
            $authorTitleSize = (isset($single_data_setting['author_title_fontsize']) && $single_data_setting['author_title_fontsize'] != '') ? $single_data_setting['author_title_fontsize'] : 16;
            $authorTitleFace = (isset($single_data_setting['author_title_fontface']) && $single_data_setting['author_title_fontface'] != '') ? $single_data_setting['author_title_fontface'] : "";

            if (isset($single_data_setting['author_title_fontface_font_type']) && $single_data_setting['author_title_fontface_font_type'] == "Google Fonts") {
                $load_single_font[] = $authorTitleFace;
            }
            // for author title
            $txtSocialTextSize = (isset($single_data_setting['txtSocialTextSize']) && $single_data_setting['txtSocialTextSize'] != '') ? $single_data_setting['txtSocialTextSize'] : 22;
            $txtSocialTextFont = (isset($single_data_setting['txtSocialTextFont']) && $single_data_setting['txtSocialTextFont'] != '') ? $single_data_setting['txtSocialTextFont'] : "";

            if (isset($single_data_setting['txtSocialTextFont_font_type']) && $single_data_setting['txtSocialTextFont_font_type'] == "Google Fonts") {
                $load_single_font[] = $txtSocialTextFont;
            }

            $social_icon_style = (isset($single_data_setting['social_icon_style']) && $single_data_setting['social_icon_style'] != '') ? $single_data_setting['social_icon_style'] : 0;
            $social_style = (isset($single_data_setting['social_style']) && $single_data_setting['social_style'] != '') ? $single_data_setting['social_style'] : '';

            $story_startup_background = (isset($single_data_setting['story_startup_background']) && $single_data_setting['story_startup_background'] != '') ? $single_data_setting['story_startup_background'] : "";
            $story_startup_text_color = (isset($single_data_setting['story_startup_text_color']) && $single_data_setting['story_startup_text_color'] != '') ? $single_data_setting['story_startup_text_color'] : "";

            /**
             * Post title font options
             */
            $template_title_font_weight = isset($single_data_setting['template_title_font_weight']) ? $single_data_setting['template_title_font_weight'] : '';
            $template_title_font_line_height = isset($single_data_setting['template_title_font_line_height']) ? $single_data_setting['template_title_font_line_height'] : '';
            $template_title_font_italic = isset($single_data_setting['template_title_font_italic']) ? $single_data_setting['template_title_font_italic'] : '';
            $template_title_font_text_transform = isset($single_data_setting['template_title_font_text_transform']) ? $single_data_setting['template_title_font_text_transform'] : 'none';
            $template_title_font_text_decoration = isset($single_data_setting['template_title_font_text_decoration']) ? $single_data_setting['template_title_font_text_decoration'] : 'none';
            $template_title_font_letter_spacing = isset($single_data_setting['template_title_font_letter_spacing']) ? $single_data_setting['template_title_font_letter_spacing'] : '0';

            /**
             * Post Content font options
             */
            $template_content_font_weight = isset($single_data_setting['template_content_font_weight']) ? $single_data_setting['template_content_font_weight'] : '';
            $template_content_font_line_height = isset($single_data_setting['template_content_font_line_height']) ? $single_data_setting['template_content_font_line_height'] : '';
            $template_content_font_italic = isset($single_data_setting['template_content_font_italic']) ? $single_data_setting['template_content_font_italic'] : '';
            $template_content_font_text_transform = isset($single_data_setting['template_content_font_text_transform']) ? $single_data_setting['template_content_font_text_transform'] : 'none';
            $template_content_font_text_decoration = isset($single_data_setting['template_content_font_text_decoration']) ? $single_data_setting['template_content_font_text_decoration'] : 'none';
            $template_content_font_letter_spacing = isset($single_data_setting['template_content_font_letter_spacing']) ? $single_data_setting['template_content_font_letter_spacing'] : '0';

            if (get_option('bdp_custom_google_fonts') != '') {
                $sidebar = explode(',', get_option('bdp_custom_google_fonts'));
                foreach ($sidebar as $key => $value) {
                    $whatIWant = substr($value, strpos($value, "=") + 1);
                    $load_single_font[] = $whatIWant;
                }
            }
            if (!empty($load_single_font)) {
                $loadFontArr = array_values(array_unique($load_single_font));
                foreach ($loadFontArr as $font_family) {
                    if ($font_family != '') {
                        $setBase = (is_ssl()) ? "https://" : "http://";
                        $font_href = $setBase . 'fonts.googleapis.com/css?family=' . $font_family;
                        ?>
                        <script type="text/javascript">

                            var gfont = document.createElement("link"),
                                    before = document.getElementsByTagName("link")[0],
                                    loadHref = true;

                            jQuery('head').find('*').each(function () {
                                if (jQuery(this).attr('href') == '<?php echo $font_href; ?>')
                                {
                                    loadHref = false;
                                }
                            });
                            if (loadHref)
                            {
                                gfont.href = '<?php echo $font_href; ?>';
                                gfont.rel = 'stylesheet';
                                gfont.type = 'text/css';
                                gfont.media = 'all';
                                before.parentNode.insertBefore(gfont, before);
                            }
                        </script>
                        <?php
                    }
                }
            }
            ?>

            <style type="text/css" id="bdp_single_page_style">
            <?php if ($social_icon_style == 0 && $social_style == 0) { ?>
                    .bdp_blog_template .social-component a {
                        border-radius: 100%;
                        -webkit-border-radius: 100%;
                        -moz-border-radius: 100%;
                        -khtml-border-radius: 100%;
                    }
            <?php } ?>
                .bdp-count {
                    padding-left: 5px;
                }
                .bdp_single .comment-list .comment-content,
                .bdp_single .comment-form label,
                .bdp_single .comment-list .comment-content p{
                    font-size: <?php echo $content_fontsize . 'px'; ?>;
                    color: <?php echo $contentcolor; ?>;
                    <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                }
                .bdp_single #respond .comment-form-comment textarea#comment{
                    font-size: <?php echo $content_fontsize . 'px'; ?>;
                    color: <?php echo $contentcolor; ?>;
                    <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                }
                .bdp_single .relatedposts .relatedthumb .related_post_content,
                .bdp_single .bdp_blog_template .post_content,
                .bdp_single .bdp_blog_template .post_content p,
                .bdp_single .author_content p,
                .display_post_views p{
                    font-size: <?php echo $content_fontsize . 'px'; ?>;
                    color: <?php echo $contentcolor; ?>;
                    <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                    <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                    <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                    <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                    <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    margin-bottom: 10px;
                }
                .bdp_single .bdp_blog_template .post_content h1,
                .bdp_single .bdp_blog_template .post_content h2,
                .bdp_single .bdp_blog_template .post_content h3,
                .bdp_single .bdp_blog_template .post_content h4,
                .bdp_single .bdp_blog_template .post_content h5,
                .bdp_single .bdp_blog_template .post_content h6 {
                    <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                }
                .bdp_single .bdp_blog_template .blog_header h1.post-title,
                .bdp_single .bdp_blog_template .blog_header h1,
                .bdp_single .bdp_blog_template h1.post-title {
                    font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                    color: <?php echo $titlecolor; ?>;
                    <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                    <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
                    <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
                    <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                    <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
                    <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
                    <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
                }
                .bdp_single .share-this span {
                    font-size: <?php echo $txtSocialTextSize . 'px'; ?>;
                   <?php if ($txtSocialTextFont) { ?> font-family: <?php echo $txtSocialTextFont; ?>; <?php } ?>
                   color : <?php echo $titlecolor; ?>   
                }
                .bdp_single .bdp_blog_template a,
                .bdp_single .post-navigation .nav-links a .post-title,
                .bdp_single .post-navigation .nav-links a .post-title,
                .bdp_single .bdp_blog_template .tags a,
                .bdp_single .bdp_blog_template .categories a,
                .bdp_single .bdp_blog_template .category-link a,
                .bdp_single .author a,
                .bdp_single .related_post_wrap a,
                .bdp_single .comment-respond .comment-form a,
                .bdp_single .comments-area .comment-body a,
                .bdp_single .social-component .social-share a {
                    color:<?php echo $linkcolor; ?>;
                    font-size: <?php echo $content_fontsize . 'px'; ?>;
                    <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                    <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                    <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                    <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                    <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                }
                .bdp_single span.left_nav,
                .bdp_single span.right_nav {
                    color:<?php echo $linkcolor; ?>;
                    <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                    <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                    <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                    <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                }
                .bdp_single .bdp_blog_template .social-component.bdp-social-style-custom a{
                    border: 1px solid <?php echo $linkcolor; ?>;
                }
                .bdp_single .comments-area .comment-reply-link {
                    border-color:<?php echo $linkcolor; ?>;
                    color:<?php echo $linkcolor; ?>;
                }
                .bdp_single .bdp_blog_template a:hover,
                .bdp_single a.styled-button:hover span.left_nav,
                .bdp_single a.styled-button:hover span.right_nav,
                .bdp_single .post-navigation .nav-links a:focus .post-title,
                .bdp_single .post-navigation .nav-links a:hover .post-title,
                .bdp_single .bdp_blog_template .tags a:hover,
                .bdp_single .bdp_blog_template .categories a:hover,
                .bdp_single .bdp_blog_template .category-link a:hover,
                .bdp_single .author a:hover,
                .bdp_single .related_post_wrap a:hover,
                .bdp_single .comment-respond .comment-form a:hover,
                .bdp_single .comments-area .comment-body a:hover,
                .bdp_single .social-component .social-share a:hover {
                    color: <?php echo $linkhovercolor; ?>;
                }
                .bdp_single .comments-area .comment-reply-link:hover {
                    border-color:<?php echo $linkhovercolor; ?>;
                    color: <?php echo $linkhovercolor; ?>;

                }
                .bdp_single .bdp_blog_template .tags a,
                .bdp_single .bdp_blog_template .categories a,
                .bdp_single .bdp_blog_template .category-link a {
                    color:<?php echo $linkcolor; ?>;
                }
                .bdp_single .related_post_wrap h3 {
                    color:<?php echo $relatedTitleColor; ?>;
                    font-size: <?php echo $relatedTitleSize . 'px'; ?>;
                <?php if ($relatedTitleFace) { ?> font-family: <?php echo $relatedTitleFace; ?>; <?php } ?>
                }
                .bdp_single.region .related_post_wrap h3:before {
                    background-color: <?php echo $relatedTitleColor; ?>;
                }
                .bdp_single .author-avatar-div .author_content .author a,
                .bdp_single .author-avatar-div .author_content .author {
                    font-size: <?php echo $authorTitleSize . 'px'; ?>;
                <?php if ($authorTitleFace) { ?> font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
                }
                .bdp_single .bdp_blog_template .share-this {
                    font-size: <?php echo $txtSocialTextSize . 'px'; ?>;
                    <?php if ($txtSocialTextFont) { ?> font-family: <?php echo $txtSocialTextFont; ?>; <?php } ?>
                    color : <?php echo $titlecolor; ?>
                }
                .bdp_single .bdp_blog_template .social-component .social-share .count,
                .bdp_single .navigation.post-navigation .post-data .navi-post-date{
                    color: <?php echo $contentcolor; ?>;
                }
                .bdp_single .author-avatar-div span.author,
                .bdp_single .comments-title,
                .bdp_single .comment-reply-title,
                .bdp_single .no-comments {
                    color: <?php echo $titlecolor; ?>;
                }
                .bdp_single .navigation.post-navigation .nav-links a .post-data span.navi-post-title {
                    color: <?php echo $linkcolor; ?>;
                }
                .bdp_single .navigation.post-navigation .nav-links a:hover .post-data span.navi-post-title {
                    color: <?php echo $linkhovercolor; ?>;
                }
                .bdp_single blockquote {
                    border-color: <?php echo $linkhovercolor; ?>;
                    background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                    padding: 15px 15px 15px 30px;
                    margin: 15px 0;
                    color: <?php echo $contentcolor; ?>;
                    font-size: <?php echo $content_fontsize . 'px'; ?>;
                    <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                    <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                    <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                    <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                    <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                }
            <?php
            if ($template_name == "boxy-clean") {
                ?>
                    .single_wrap.blog_template .full_wrap,
                    .post-meta .post-comment,
                    .post-meta .postdate,
                    .bdp_single.boxy-clean .author-avatar-div,
                    .bdp_single.boxy-clean .related_post_wrap,
                    .bdp_single.boxy-clean .comments-area{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.boxy-clean a,.relatedpost_title,
                    .bdp_single.boxy-clean .post-navigation .nav-links a:hover .post-title,
                    .bdp_single.boxy-clean .post-navigation .nav-links a:focus .post-title{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.boxy-clean .blog_header h1{
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
                    }
                    .bdp_single.boxy-clean .bdp_blog_template .post_content,
                    .bdp_single.boxy-clean .bdp_blog_template .post_content p,
                    .bdp_single.boxy-clean .author_content p{
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_single.boxy-clean .bdp-wrapper-like i,
                    .bdp_single.boxy-clean .author_content .author,
                    .bdp_single.boxy-clean .tags.bdp-no-links,
                    .bdp_single.boxy-clean .tags .link-lable,
                    .bdp_single.boxy-clean .post-meta .post-comment,
                    .bdp_single.boxy-clean .footer_meta .category-link.bdp-no-links,
                    .bdp_single.boxy-clean .footer_meta .category-link .link-lable,
                    .bdp_single .related_post_div .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.boxy-clean .tags,
                    .bdp_single.boxy-clean .footer_meta .category-link {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.boxy-clean .post-comment > a {
                        border-color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.boxy-clean .bdp_blog_template.boxy-clean a:hover,
                    .bdp_single .relatedthumb:hover .relatedpost_title,.bdp_single .relatedthumb:hover .relatedpost_title
                    .bdp_single.boxy-clean .post-navigation .nav-links a:focus .post-title,
                    .bdp_single.boxy-clean .post-navigation .nav-links a:hover .post-title {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.boxy-clean .author.box_author {
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.boxy-clean .navigation.post-navigation .post-data span.navi-post-title, 
                    .bdp_single.boxy-clean .navigation.post-navigation .post-data span.navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.boxy-clean .post-meta .post-comment, .bdp_single.boxy-clean .post-meta .postdate{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.boxy-clean .navigation.post-navigation .post-previous a.prev-link:hover span.left_nav,
                    .bdp_single.boxy-clean .navigation.post-navigation .post-previous a.prev-link:hover span.navi-post-title,
                    .bdp_single.boxy-clean .navigation.post-navigation .post-next a.next-link:hover span.right_nav,
                    .bdp_single.boxy-clean .navigation.post-navigation .post-next a.next-link:hover span.navi-post-title,
                    .bdp_single.boxy-clean .navigation.post-navigation .post-next a.next-link:hover span.navi-post-text,
                    .bdp_single.boxy-clean .navigation.post-navigation .post-previous a.prev-link:hover span.navi-post-text{
                        color: <?php echo $linkhovercolor; ?>
                    }
                <?php
                if ($display_date == 1 || $display_comment == 1) {
                    ?>
                        .bdp_single.boxy-clean{
                            /*padding-right:80px;*/
                            padding-right:75px;
                        }
                        @media screen and (max-width: 910px) {
                            .bdp_single.boxy-clean {
                                padding-right: 90px;
                            }
                        }
                    <?php
                }
            }
            if ($template_name == "boxy") {
                ?>
                    .bdp_single.boxy .author-avatar,
                    .bdp_single.boxy .post-meta,
                    .post-comment{
                        border-bottom:4px solid <?php echo $templatecolor; ?>;
                    }
                    .avtar-img > a {
                        border:4px solid <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.boxy .footer_meta .category-link.bdp-no-links,
                    .bdp_single.boxy .footer_meta .category-link .link-lable,
                    .bdp_single.boxy .footer_meta .tags.bdp-no-links,
                    .bdp_single.boxy .footer_meta .tags .link-lable,
                    .bdp_single .relatedposts .relatedthumb .related_post_content{
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.boxy .footer_meta .tags,
                    .bdp_single.boxy .footer_meta .category-link {
                        color: <?php echo $linkcolor; ?>;
                    }
                    <?php if (isset($single_data_setting['related_post_content_length']) && $single_data_setting['related_post_content_length'] == 0 && $single_data_setting['related_post_content_length'] == '') { ?>
                        .bdp_single.boxy .related_post_div .relatedthumb > a .relatedpost_title{
                            border-radius: 0 0 5px 5px;
                        }
                    <?php
                }
            }
            if ($template_name == "lightbreeze") {
                ?>
                    .bdp_blog_template.blog_template,
                    .bdp_blog_template .category-main,
                    .bdp_single .navigation.post-navigation .nav-links .nav-previous,
                    .bdp_single .navigation.post-navigation .nav-links .nav-next,
                    .bdp_single.lightbreeze .author-avatar-div,
                    .bdp_single.lightbreeze .related_post_wrap,
                    .bdp_single.lightbreeze .comments-area{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_blog_template .category-main::before,.bdp_blog_template .category-main::after{
                        border-bottom-color: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.lightbreeze #post-nav .post-data .navi-post-title,
                    .bdp_single.lightbreeze #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.lightbreeze #post-nav .post-data .navi-post-title,
                    .bdp_single.lightbreeze #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.lightbreeze #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.lightbreeze #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.lightbreeze #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.lightbreeze #post-nav a.next-link:hover .right_nav,
                    .bdp_single.lightbreeze #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.lightbreeze #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template .metadatabox .category-link.bdp-no-links,
                    .bdp_blog_template .metadatabox .category-link .link-lable,
                    .bdp_single.lightbreeze .meta_data_box,
                    .bdp_blog_template.lightbreeze .tags.bdp-no-links,
                    .bdp_blog_template.lightbreeze .tags i,
                    .bdp_blog_template .metadatabox .metauser,
                    .bdp_single.lightbreeze .bdp_blog_template .share-this,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.lightbreeze .author_content .author {
                        color: <?php echo $titlecolor; ?>;
                    }
                    .bdp_blog_template .metadatabox .metauser .bdp-has-links,
                    .bdp_blog_template.lightbreeze .tags,
                    .bdp_blog_template .metadatabox .category-link {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "classical") {
                ?>
                    .bdp_blog_template.classical .entry-container,
                    .bdp_blog_template.classical,
                    .bdp_blog_template.classical .entry-meta{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_blog_template.classical .entry-meta .up_arrow:after,
                    .bdp_blog_template.classical .entry-meta .up_arrow::before{
                        border-color : rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $template_bgcolor; ?>;
                    }
                <?php if (isset($single_data_setting['template_bgcolor'])) { ?>
                        .bdp_single.classical .navigation.post-navigation{
                            background: transparent;
                        }
                        .bdp_single.classical .related_post_wrap,.bdp_single.classical .comments-area,
                        .bdp_single .navigation.post-navigation .nav-links .nav-previous,.bdp_single .navigation.post-navigation .nav-links .nav-next,.bdp_single.classical .author-avatar-div{
                            background: <?php echo $template_bgcolor; ?>;
                        }
                <?php } ?>
                    .bdp_single .bdp_blog_template.classical a,.bdp_single .navigation.post-navigation .post-data span.navi-post-title,
                    .bdp_single .navigation.post-navigation .post-data span.navi-post-text,
                    .bdp_single .bdp_blog_template .social-component a{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single .bdp_blog_template.classical a:hover,.bdp_single .navigation.post-navigation .post-data span.navi-post-title:hover,
                    .bdp_single .navigation.post-navigation .post-data span.navi-post-text:hover{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single .bdp_blog_template.classical .blog_header h1 {
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
                        color: <?php echo $titlecolor; ?>;
                    }
                    .bdp_single .bdp_blog_template.classical .post_content,
                    .bdp_single .bdp_blog_template.classical .post_content p{
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_blog_template.classical .post-meta-cats-tags .tags .link-lable,
                    .bdp_blog_template.classical .post-meta-cats-tags .category-link .link-lable,
                    .bdp_blog_template.classical .post-meta-cats-tags .category-link.bdp-no-links,
                    .bdp_blog_template.classical .metadatabox,
                    .bdp_single .relatedposts .relatedthumb .related_post_content    {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_blog_template.classical .metadatabox span.bdp-has-links,
                    .bdp_blog_template.classical .post-meta-cats-tags .tags,
                    .bdp_blog_template.classical .post-meta-cats-tags .category-link {
                        color: <?php echo $linkcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>;
                    }

                    .bdp_single.classical .navigation.post-navigation{
                        border: medium none;
                    }

                <?php
            }
            if ($template_name == "nicy") {
                ?>
                    .bdp_blog_template.nicy .post-meta-cats-tags .tags.bdp-no-links,
                    .bdp_blog_template.nicy .post-meta-cats-tags .tags .link-lable,
                    .bdp_blog_template.nicy .post-meta-cats-tags .category-link.bdp-no-links,
                    .bdp_blog_template.nicy .post-meta-cats-tags .category-link .link-lable {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_blog_template.nicy .post-meta-cats-tags .tags,
                    .bdp_blog_template.nicy .post-meta-cats-tags .category-link {
                        color: <?php echo $linkcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>;
                    }
                <?php
            }
            if ($template_name == "winter") {
                ?>
                    .bdp_single.winter .bdp_blog_template .posted_by.bdp_has_links,
                    .bdp_single.winter .bdp_blog_template .tags.bdp_has_links {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.winter .bdp-post-image .category-link {
                        background-color:<?php echo $winter_category_color; ?>;
                    }
                    .bdp_single.winter .bdp-post-image .category-link:before {
                        border-right: 10px solid <?php echo $winter_category_color; ?>;
                    }
                    .bdp_single.winter a,.relatedpost_title,
                    .bdp_single.winter .post-navigation .nav-links a .post-title,
                    .bdp_single.winter .post-navigation .nav-links a .post-title{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.winter a:hover ,.relatedthumb:hover .relatedpost_title,
                    .bdp_single.winter .post-navigation .nav-links a:hover .post-title,
                    .bdp_single.winter .post-navigation .nav-links a:focus .post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.winter #post-nav .post-data .navi-post-title,
                    .bdp_single.winter #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.winter #post-nav .post-data .navi-post-title,
                    .bdp_single.winter #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.winter #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.winter #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.winter #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.winter #post-nav a.next-link:hover .right_nav,
                    .bdp_single.winter #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.winter #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.winter .posted_by,
                    .bdp_single.winter .posted_by .link-lable,
                    .bdp_single .relatedposts .relatedthumb .related_post_content, .datetime{
                        color: <?php echo $contentcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "sharpen") {
                ?>
                    .bdp_single.sharpen .meta_data_box div.bdp_has_links,
                    .bdp_single.sharpen .category-list.bdp_has_links {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.sharpen .meta_data_box div,
                    .bdp_single.sharpen .meta_data_box div .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "spektrum") {
                ?>
                    .bdp_blog_template.spektrum a.date{
                        background: <?php echo $titlecolor; ?>
                    }
                    .bdp_single.spektrum .author_content .author a::before{
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.spektrum .post-bottom > span.bdp_has_links,
                    .bdp_single.spektrum .author_content .author a{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.spektrum .author_content .author a:hover {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.spektrum #post-nav .post-data .navi-post-title,
                    .bdp_single.spektrum #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.spektrum #post-nav .post-data .navi-post-title,
                    .bdp_single.spektrum #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.spektrum #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.spektrum #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.spektrum #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.spektrum #post-nav a.next-link:hover .right_nav,
                    .bdp_single.spektrum #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.spektrum #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.spektrum .author-avatar-div .author_content .author a:hover::before{
                        background: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.spektrum .post-bottom > span .link-lable,
                    .post-bottom > span,
                    .bdp_single .relatedposts .relatedthumb .related_post_content,
                    .bdp_single.spektrum .author_content > p{
                        color: <?php echo $contentcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "media-grid") {
                ?>
                    .bdp_blog_template.media-grid .category-link{
                        background-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.media-grid h1.entry-title{
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
                    }
                    .bdp_single.media-grid .author-avatar-div .avtar-img a:before{
                        background-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.media-grid .entry-meta .metabox-upper > span .post-author.bdp-no-links,
                    .bdp_blog_template.media-grid .entry-meta .metabox-upper > span .post-author .link-lable,
                    .bdp_blog_template.media-grid .metadatabox .tags i,
                    .bdp_blog_template.media-grid .metadatabox .tags.bdp-no-links {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_blog_template.media-grid .entry-meta .metabox-upper > span .post-author,
                    .bdp_blog_template.media-grid .metadatabox .tags {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "deport") {
                ?>
                    .bdp_single.deport .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.deport h1.post-title{
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                    }
                    .bdp_single.deport .bdp_single-meta-line{
                        background: <?php echo $templatecolor; ?>;
                    }
                    .deport .metadatabox span.dot-separater{
                        color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.deport .tags.bdp-no-links, 
                    .bdp_single.deport .tags i, 
                    .bdp_single.deport .category-links i,
                    .bdp_single.deport .category-links.bdp-no-links,
                    .bdp_single .bdp_blog_template.deport .metadatabox .single-metadatabox,
                    .bdp_single .bdp_blog_template.deport .metadatabox .single-metadatabox .post-author.bdp-no-links,
                    .bdp_single .bdp_blog_template.deport .metadatabox .single-metadatabox .post-author .link-lable,
                    .bdp_single.deport .metadatabox > span,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single .bdp_blog_template.deport .metadatabox .single-metadatabox .post-author,
                    .bdp_single.deport .tags, 
                    .bdp_single.deport .category-links {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "navia") {
                ?>
                    .bdp_single.navia .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.navia h1.post-title{
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?>font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                    }
                    .bdp_single.navia #post-nav .post-data .navi-post-title,
                    .bdp_single.navia #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.navia #post-nav .post-data .navi-post-title,
                    .bdp_single.navia #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.navia #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.navia #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.navia #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.navia #post-nav a.next-link:hover .right_nav,
                    .bdp_single.navia #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.navia #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.navia .author-avatar-div .author_content .author a::before{
                        background: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.navia .author-avatar-div .author_content .author a:hover::before{
                        background: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.navia .post-metadata .post-author.bdp-no-links,
                    .bdp_single.navia .post-metadata .post-author .link-lable,
                    .bdp_single.navia .post-metadata .bdp_date_category_comment .post-category.bdp-no-links,
                    .bdp_single.navia .post-metadata .bdp_date_category_comment .post-category .link-lable,
                    .bdp_single.navia .post-content-area .tags,
                    .bdp_single .relatedposts .relatedthumb .related_post_content,
                    .bdp_single.navia .bdp_date_category_comment {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    }
                    .bdp_single.navia .post-metadata .post-author,
                    .bdp_single .post-metadata .bdp_date_category_comment > span a,
                    .bdp_single.navia .post-metadata .bdp_date_category_comment .post-category,
                     .bdp_single.navia .post-metadata .bdp_date_category_comment .post-category a {
                        color: <?php echo $linkcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    }
                    .bdp_single .post-metadata .bdp_date_category_comment > span a:hover,
                    .bdp_single.navia .post-metadata .bdp_date_category_comment .post-category a:hover {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                <?php
            }
            if ($template_name == "news") {
                ?>
                    .bdp_single.news h1.post-title {
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                    }
                    .bdp_single.news .post-content-div .post-content,
                    .bdp_single.news .post-content-div .post-content p {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_single.news .related_post_wrap h3,
                    .bdp_single.news .author_content .author,
                    .bdp_single.news .author_div li.active {
                        color: <?php echo $titlecolor; ?>;
                    }
                    .bdp_single.news #post-nav .post-data .navi-post-title,
                    .bdp_single.news #post-nav .post-data .navi-post-text {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.news #post-nav .post-data .navi-post-title,
                    .bdp_single.news #post-nav .post-data .navi-post-text {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.news #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.news #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.news #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.news #post-nav a.next-link:hover .right_nav,
                    .bdp_single.news #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.news #post-nav a.next-link:hover .post-data span.navi-post-title {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.news .author_content .author,
                    .bdp_single.news .author_content .author a {
                        font-size: <?php echo $authorTitleSize . 'px'; ?>;
                        <?php if ($authorTitleFace) { ?> font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
                    }
                    .bdp_single.news .post-category.bdp-no-links,
                    .bdp_single.news .post-category i,
                    .bdp_single.news .tags.bdp-no-links,
                    .bdp_single.news .tags i,
                    .bdp_single.news .post_meta,
                    .bdp_single.news .relatedposts .relatedthumb .related_post_content,
                    .bdp_single.news .tag_cat {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.news .tags,
                    .bdp_single.news .post-category,
                    .bdp_single.news .post_meta .post-author.bdp-has-links {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "region") {
                ?>
                    .bdp_single.region .navigation.post-navigation .nav-links > div a span.screen-reader-text:hover{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.region #post-nav .post-data .navi-post-title,
                    .bdp_single.region #post-nav .post-data .navi-post-text,
                    .bdp_single.region .navigation.post-navigation .post-data .navi-post-date{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.region #post-nav .post-data .navi-post-title,
                    .bdp_single.region #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.region #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.region #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.region #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.region #post-nav a.next-link:hover .right_nav,
                    .bdp_single.region #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.region #post-nav a.next-link:hover .post-data span.navi-post-title,
                    .bdp_single.region .navigation.post-navigation a:hover .post-data .navi-post-date{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.region .blog_footer.footer_meta .category-link.bdp-no-links,
                    .bdp_single.region .blog_footer.footer_meta .category-link .link-lable,
                    .bdp_single.region .blog_footer.footer_meta .tags.bdp-no-links,
                    .bdp_single.region .blog_footer.footer_meta .tags .link-lable,
                    .bdp_single.region .posted_by, .bdp_single .relatedposts .relatedthumb .related_post_content, .article_comments {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.region .posted_by .bdp-has-links,
                    .bdp_single.region .blog_footer.footer_meta .category-link,
                    .bdp_single.region .blog_footer.footer_meta .tags {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "glossary") {
                ?>
                    .bdp_single.glossary .blog_header .posted_by a:hover time,
                    .bdp_single.glossary .related_post_div .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.glossary .blog_header .posted_by a time,
                    .bdp_single.glossary #post-nav .post-data .navi-post-title,
                    .bdp_single.glossary #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.glossary #post-nav .post-data .navi-post-title,
                    .bdp_single.glossary #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.glossary #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.glossary #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.glossary #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.glossary #post-nav a.next-link:hover .right_nav,
                    .bdp_single.glossary #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.glossary #post-nav a.next-link:hover .post-data span.navi-post-title,
                    .bdp_single.glossary .nav-links a:hover span.navi-post-date{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single .blog_item .blog_footer .category-link.bdp-no-links,
                    .bdp_single .blog_item .blog_footer .category-link .link-lable,
                    .bdp_single .blog_item .blog_footer .tags.bdp-no-links,
                    .bdp_single .blog_item .blog_footer .tags .link-lable,
                    .bdp_single.glossary .posted_by .post-author.bdp-no-links,
                    .bdp_single.glossary .posted_by .post-author .link-lable,
                    .bdp_single.glossary .posted_by .metacomments,
                    .bdp_single.glossary .posted_by .datetime,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_single.glossary .blog_item .blog_footer .share-this {
                        color: <?php echo $titlecolor; ?>;
                    }
                    .bdp_single.glossary .posted_by .post-author,
                    .bdp_single .blog_item .blog_footer .tags,
                    .bdp_single .blog_item .blog_footer .category-link {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "offer_blog") {
                ?>
                    .bdp_single.offer_blog .related_post_div .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.offer_blog .bdp_single_offer_blog {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.offer_blog #post-nav .post-data .navi-post-title,
                    .bdp_single.offer_blog #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.offer_blog #post-nav .post-data .navi-post-title,
                    .bdp_single.offer_blog #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.offer_blog #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.offer_blog #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.offer_blog #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.offer_blog #post-nav a.next-link:hover .right_nav,
                    .bdp_single.offer_blog #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.offer_blog #post-nav a.next-link:hover .post-data span.navi-post-title,
                    .bdp_single.offer_blog .nav-links a:hover span.navi-post-date{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single .offer_blog.bdp_blog_template span.date,
                    .bdp_single .offer_blog.bdp_blog_template span.author,
                    .bdp_single .offer_blog.bdp_blog_template span.post-category i,
                    .bdp_single .offer_blog.bdp_blog_template span.post-category.bdp-no-links,
                    .bdp_single .offer_blog.bdp_blog_template span.comment,
                    .bdp_single .offer_blog.bdp_blog_template span.tags,
                    .bdp_single .relatedposts .relatedthumb .related_post_content{
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single .offer_blog.bdp_blog_template span.author .bdp-has-links,
                    .bdp_single .offer_blog.bdp_blog_template span.post-category {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.offer_blog .bdp_blog_template .share-this {
                        color: <?php echo $titlecolor; ?>;
                    }
                    .offer_blog.bdp_blog_template .tags a {
                        background-color: <?php echo $template_bgcolor; ?>;
                        border-color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "timeline") {
                ?>
                    .bdp_single.timeline .datetime{
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single .bdp_blog_template.timeline .post_content_wrap,
                    .bdp_single .bdp_blog_template.timeline .post_content_wrap .blog_footer,
                    .bdp_single.timeline .navigation.post-navigation,
                    .bdp_single.timeline .comments-area {
                        border-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.timeline .related_post_div .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.timeline .author_div,.bdp_single.timeline .related_post_wrap{
                        border: 1px solid <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.timeline #post-nav .post-data .navi-post-title,
                    .bdp_single.timeline #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.timeline #post-nav .post-data .navi-post-title,
                    .bdp_single.timeline #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.timeline #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.timeline #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.timeline #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.timeline #post-nav a.next-link:hover .right_nav,
                    .bdp_single.timeline #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.timeline #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.timeline .author_div .author {
                        font-size: <?php echo $authorTitleSize . 'px'; ?>;
                        <?php if ($authorTitleFace) { ?>font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
                        line-height: 1.5;
                    }
                    .bdp_single.timeline .blog_footer span,
                    .bdp_single.timeline .blog_footer span.comments-link,
                    .bdp_single.timeline .blog_footer span.tags,
                    .bdp_single.timeline .blog_footer span.categories,
                    .bdp_single.timeline .blog_footer span.categories .link-lable,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.timeline .blog_footer span.tags.bdp_has_links,
                    .bdp_single.timeline .blog_footer span.posted_by.bdp_has_links,
                    .bdp_single.timeline .blog_footer span.categories.bdp_has_links {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "brit_co") {
                ?>
                    .bdp_single.brit_co{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.brit_co .post-navigation .nav-links > div > a span.screen-reader-text,
                    .bdp_single .navigation.post-navigation .nav-links a .post-data span.navi-post-title {
                        color : <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.brit_co .post-navigation .nav-links > div > a:hover span.screen-reader-text,
                    .bdp_single .navigation.post-navigation .nav-links a:hover .post-data span.navi-post-title  {
                        color : <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.brit_co a.prev-link:hover span.left_nav, .bdp_single.brit_co a.next-link:hover span.right_nav{
                        color : <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.britco .metadatabox .tags.bdp-no-links,
                    .bdp_blog_template.britco .metadatabox .tags .link-lable,
                    .bdp_blog_template.britco .metadatabox .post-category.bdp-no-links,
                    .bdp_blog_template.britco .metadatabox .post-category .link-lable,
                    .bdp_single.brit_co .metadatabox,
                    .bdp_single.brit_co .metadatabox .metauser .link-lable,
                    .bdp_single.brit_co .metadatabox .metauser.bdp-no-links,
                    .bdp_single.brit_co .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.brit_co .metadatabox .metauser,
                    .bdp_blog_template.britco .metadatabox .tags,
                    .bdp_blog_template.britco .metadatabox .post-category {
                        color : <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.brit_co .navigation.post-navigation .nav-links .nav-previous, .bdp_single.brit_co .navigation.post-navigation .nav-links .nav-next {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "evolution") {
                ?>
                    .bdp_single.evolution{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_single.evolution .post-category.bdp-no-links,
                    .bdp_single.evolution .tags.bdp-no-links,
                    .bdp_single.evolution .tags i,
                    .bdp_single.evolution .date,
                    .bdp_single.evolution .author.bdp-no-links,
                    .bdp_single.evolution .author i,
                    .bdp_single.evolution .author .link-lable,
                    .bdp_single.evolution .comment,
                    .bdp_single.evolution .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.evolution .author-avatar-div:before,
                    .bdp_single.evolution .author-avatar-div:after{
                        background: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.evolution .author,
                    .bdp_single.evolution .post-category,
                    .bdp_single.evolution .tags,
                    .bdp_single.evolution .nav-links a .navi-post-title {
                        color : <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.evolution .nav-links a:hover .navi-post-title {
                        color : <?php echo $linkhovercolor; ?>;
                    }
                <?php
            }
            if ($template_name == "invert-grid") {
                ?>
                    .bdp_single.invert-grid .category-link{
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.invert-grid .metadatabox .mdate {
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.invert-grid .metadatabox .mdate a,
                    .bdp_single.invert-grid .metadatabox .mdate a:hover {
                        color: #ffffff;
                    }
                    .bdp_single.invert-grid #post-nav .post-data .navi-post-title,
                    .bdp_single.invert-grid #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.invert-grid #post-nav .post-data .navi-post-title,
                    .bdp_single.invert-grid #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.invert-grid #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.invert-grid #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.invert-grid #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.invert-grid #post-nav a.next-link:hover .right_nav,
                    .bdp_single.invert-grid #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.invert-grid #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.invert-grid .metadatabox,
                    .bdp_single.invert-grid .tags.bdp-has-links,
                    .bdp_single.invert-grid .tags .link-lable,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.invert-grid .metadatabox .post-author.bdp-has-links,
                    .bdp_single.invert-grid .tags {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .metadatabox .mdate span.mdate-month {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                    }
                    .metadatabox .mdate span.mdate-day {
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                    }
                <?php
            }
            if ($template_name == "story") {
                ?>
                    .bdp_single.story .relatedposts .relatedthumb .related_post_content{
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    <?php if ($content_fontface) { ?>
                        .story .author_content .author{
                            font-family: <?php echo $content_fontface; ?>;
                        }
                    <?php } ?>
                    .story .line-col-top{
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .story .date-icon-left{
                        background: <?php echo $templatecolor; ?>
                    }
                    .story .author_content .author,
                    .story .bdp-wrapper-like i,
                    .story .tags,
                    .story .tags .link-lable,
                    .story .post-metadata,
                    .story .categories,
                    .story .categories .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .story .tags.bdp_has_links,
                    .story .categories.bdp_has_links,
                    .story .post-metadata span.bdp_has_links {
                        color: <?php echo $linkcolor; ?>
                    }
                    .story .date-icon-arrow-bottom::before{
                        border-top-color: <?php echo $templatecolor; ?>;
                    }
                    .startup{
                        background: <?php echo $story_startup_background; ?>;
                        color: <?php echo $story_startup_text_color; ?>;
                    }
                <?php
            }
            if ($template_name == "easy_timeline") {
                ?>
                    .bdp_single.easy_timeline .related_post_div .relatedthumb:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.easy_timeline #post-nav .post-data .navi-post-title,
                    .bdp_single.easy_timeline #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.easy_timeline #post-nav .post-data .navi-post-title,
                    .bdp_single.easy_timeline #post-nav .post-data .navi-post-text{
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.easy_timeline #post-nav a.prev-link:hover .left_nav,
                    .bdp_single.easy_timeline #post-nav a.prev-link:hover .post-data span.navi-post-text,
                    .bdp_single.easy_timeline #post-nav a.prev-link:hover .post-data span.navi-post-title,
                    .bdp_single.easy_timeline #post-nav a.next-link:hover .right_nav,
                    .bdp_single.easy_timeline #post-nav a.next-link:hover .post-data span.navi-post-text,
                    .bdp_single.easy_timeline #post-nav a.next-link:hover .post-data span.navi-post-title{
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.easy_timeline .author_div .author {
                        font-size: <?php echo $authorTitleSize . 'px'; ?>;
                        <?php if ($authorTitleFace) { ?> font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
                        line-height: 1.5;
                    }
                    .bdp_single.easy_timeline .blog_footer > span,
                    .bdp_single.easy_timeline .blog_footer span.comments-link,
                    .bdp_single.easy_timeline .blog_footer span.tags.bdp-no-links,
                    .bdp_single.easy_timeline .blog_footer span.tags i,
                    .bdp_single.easy_timeline .easy_timeline_auth_date .posted_by.bdp-no-links,
                    .bdp_single.easy_timeline .easy_timeline_auth_date .posted_by i,
                    .bdp_single.easy_timeline .blog_footer span.categories.bdp-no-links,
                    .bdp_single.easy_timeline .blog_footer span.categories i,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.easy_timeline .easy_timeline_auth_date .posted_by,
                    .bdp_single.easy_timeline .blog_footer span.tags,
                    .bdp_single.easy_timeline .blog_footer span.categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.easy_timeline .reply a.comment-reply-link {
                        background: <?php echo $titlecolor; ?>;
                    }
                    .bdp_single.easy_timeline .reply a.comment-reply-link:hover {
                        background: #fff;
                    }
                    .bdp_single.easy_timeline .easy_timeline_auth_date,
                    .bdp_single.easy_timeline .easy_timeline_comment,
                    .bdp_single.easy_timeline .desc,
                    .bdp_single.easy_timeline .blog_footer,
                    .bdp_single.easy_timeline .author_div,
                    .bdp_single.easy_timeline .post-navigation,
                    .bdp_single.easy_timeline .related_post_wrap,
                    .bdp_single.easy_timeline .comments-area{
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                        font-size: <?php echo $content_fontsize; ?>px;
                        color: <?php echo $contentcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "cool_horizontal") {
                ?>
                    .photo.bdp-post-image {
                        background: <?php echo bdp_hex2rgba($templatecolor, 0.5); ?> none repeat scroll 0 0;
                    }
                    .bdp_single.cool_horizontal:before {
                        background: <?php echo $templatecolor; ?>;
                    }
                    <?php if ($template_titlefontface) { ?>
                        .bdp_single.cool_horizontal .author_div .author_content .author{
                            font-family: <?php echo $template_titlefontface; ?>;
                        }
                    <?php } ?>
                    .bdp_single.cool_horizontal .date-dot,
                    .bdp_single.cool_horizontal .comment-list:before,
                    .bdp_single.cool_horizontal .avtar-img:before {
                        border: 2px solid <?php echo $templatecolor; ?>;
                    }
                    body.single .site-content .bdp_single.cool_horizontal .comments-area,
                    .bdp_single .bdp_blog_template.cool_horizontal .post_content_wrap .blog_footer,
                    .bdp_single .bdp_blog_template.cool_horizontal pre code,
                    .bdp_single .bdp_blog_template.cool_horizontal .datetime,
                    .bdp_single.cool_horizontal .comment-author,
                    .bdp_single.cool_horizontal .bdp-wrapper-like i,
                    .bdp_single.cool_horizontal .author_content .author,
                    .bdp_single.cool_horizontal .comment-form label,
                    .bdp_single.cool_horizontal .relatedposts .relatedthumb .related_post_content,
                    .comment-form label {
                        color : <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                        font-size: <?php echo $content_fontsize; ?>px;
                    }
                    .bdp_single.cool_horizontal input[type="text"],
                    .bdp_single.cool_horizontal input[type="date"],
                    .bdp_single.cool_horizontal input[type="time"],
                    .bdp_single.cool_horizontal input[type="datetime-local"],
                    .bdp_single.cool_horizontal input[type="week"],
                    .bdp_single.cool_horizontal input[type="month"], input[type="text"],
                    .bdp_single.cool_horizontal input[type="email"],
                    .bdp_single.cool_horizontal input[type="url"],
                    .bdp_single.cool_horizontal input[type="password"],
                    .bdp_single.cool_horizontal input[type="search"],
                    .bdp_single.cool_horizontal input[type="tel"],
                    .bdp_single.cool_horizontal input[type="number"],
                    .bdp_single.cool_horizontal textarea {
                        color : <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.cool_horizontal .blog_footer span .posted_by.bdp-no-links,
                    .bdp_single.cool_horizontal .blog_footer span .posted_by i,
                    .bdp_single.cool_horizontal .blog_footer span .tags.bdp-no-links,
                    .bdp_single.cool_horizontal .blog_footer span .tags i,
                    .bdp_single.cool_horizontal .blog_footer span .categories.bdp-no-links,
                    .bdp_single.cool_horizontal .blog_footer span .categories i {
                        color : <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.cool_horizontal .blog_footer span .posted_by,
                    .bdp_single.cool_horizontal .blog_footer span .tags,
                    .bdp_single.cool_horizontal .blog_footer span .categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "overlay_horizontal") {
                ?>
                    .bdp_single.overlay_horizontal *,
                    .bdp_single.overlay_horizontal .author_div .author_content span.author,
                    .bdp_single.overlay_horizontal input[type="text"],
                    .bdp_single.overlay_horizontal input[type="date"],
                    .bdp_single.overlay_horizontal input[type="time"],
                    .bdp_single.overlay_horizontal input[type="datetime-local"],
                    .bdp_single.overlay_horizontal input[type="week"],
                    .bdp_single.overlay_horizontal input[type="month"], input[type="text"],
                    .bdp_single.overlay_horizontal input[type="email"],
                    .bdp_single.overlay_horizontal input[type="url"],
                    .bdp_single.overlay_horizontal input[type="password"],
                    .bdp_single.overlay_horizontal input[type="search"],
                    .bdp_single.overlay_horizontal input[type="tel"],
                    .bdp_single.overlay_horizontal input[type="number"],
                    .bdp_single.overlay_horizontal textarea {
                        color : <?php echo $contentcolor; ?>;
                    }
                    body.single .site-content .bdp_single.overlay_horizontal .comments-area,
                    .bdp_single .bdp_blog_template.overlay_horizontal .post_content_wrap .blog_footer,
                    .bdp_single .bdp_blog_template.overlay_horizontal pre code,
                    .bdp_single.overlay_horizontal .comment-author,
                    .bdp_single.overlay_horizontal .comment-form label,
                    .bdp_single.overlay_horizontal .relatedposts .relatedthumb .related_post_content,
                    .comment-form label {
                        color : <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                        font-size: <?php echo $content_fontsize; ?>px;
                    }
                    .horizontal2-cover {
                        background: <?php echo bdp_hex2rgba($template_bgcolor, '0.65'); ?>;
                    }
                    .overlay_horizontal pre {
                        background-color: <?php echo bdp_hex2rgba($contentcolor, 0.1); ?>;
                    }
                    .bdp-date-meta > a:hover .month,
                    .bdp-wrapper-like > .bdp-like-button:hover .bdp-count,
                    .bdp-wrapper-like > .bdp-like-button:hover i,
                    .relatedthumb > a:hover .relatedpost_title{
                        color: <?php echo $linkhovercolor; ?> !important;
                    }
                    .author_content .author {
                        <?php if ($authorTitleFace) { ?>font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
                    }
                <?php
            }
            if ($template_name == "explore") {
                ?>
                    .explore_wrapper {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                <?php if (isset($single_data_setting['firstletter_big']) && $single_data_setting['firstletter_big'] == 1) { ?>
                        .bdp_single .bdp_blog_template .post_content.entry-content > p:nth-child(2):first-letter{
                            font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                            color: <?php echo $firstletter_contentcolor; ?>;
                            <?php if ($firstletter_contentfontface) { ?>font-family:<?php echo $firstletter_contentfontface; ?>; <?php } ?>
                            float: left;
                            margin-right:10px;
                            <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                            <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                            <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                            <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                            <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                            <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                        }
                <?php } ?>
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "my_diary") {
                ?>
                    .my_diary_wrapper,
                    .bdp_single.my_diary .author-avatar-div,
                    .bdp_single.my_diary .related_post_wrap,
                    .navigation.post-navigation {
                        background: <?php echo $template_bgcolor; ?>;
                    }

                    .my_diary.bdp_single .my_diary_wrapper .blog_header h1.post-title {
                        font-size: <?php echo $template_titlefontsize; ?>px;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                        color: <?php echo $titlecolor; ?>;
                    }
                <?php
            }
            if ($template_name == "elina") {
                ?>
                    .elina-post-wrapper,
                    .elina.bdp_single .author-avatar-div,
                    .bdp_single.elina .author-avatar-div,
                    .bdp_single.elina .related_post_wrap,
                    body.single.elina .comments-area,
                    .nav-links .previous-post,
                    .nav-links .next-post {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .elina.bdp_single .blog_header h1.post-title {
                        font-size: <?php echo $template_titlefontsize; ?>px;
                        <?php if ($template_titlefontface) { ?>font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                        color: <?php echo $titlecolor; ?>;
                    }
                    .elina.bdp_single .elina-post-wrapper .bdp-wrapper-like i,
                    .elina.bdp_single .elina-post-wrapper .tags.bdp-no-links,
                    .elina.bdp_single .elina-post-wrapper .tags .link-lable,
                    .elina.bdp_single .elina-post-wrapper .metadatabox,
                    .elina.bdp_single .elina-post-wrapper .categories.bdp-no-links,
                    .bdp_single .relatedposts .relatedthumb .related_post_content {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .elina.bdp_single .elina-post-wrapper .metadatabox .bdp-has-links,
                    .elina.bdp_single .elina-post-wrapper .tags,
                    .elina.bdp_single .elina-post-wrapper .categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "masonry_timeline") {
                ?>
                    .masonry_timeline .masonry-timeline-wrapp,
                    .masonry_timeline.bdp_single .navigation.post-navigation,
                    body.single .site-content .comments-area,
                    .bdp_single.masonry_timeline .related_post_wrap,
                    .masonry_timeline .author-avatar-div,
                    .masonry-timeline-wrapp.bdp_blog_template .social-component {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .masonry_timeline .post-content-area .categories.bdp-no-links,
                    .bdp_single .relatedposts .relatedthumb .related_post_content, 
                    .post-content-area .categories, .post-footer .metadatabox, 
                    .masonry_timeline .post-footer .metadatabox > span.mauthor.bdp-no-links,
                    .masonry_timeline .post-footer .metadatabox > span.mauthor i,
                    .masonry_timeline .tags.bdp-has-links,
                    .masonry_timeline .tags .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .masonry_timeline .post-footer .metadatabox > span.mauthor,
                    .masonry_timeline .tags,
                    .masonry_timeline .post-content-area .categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "brite") {
                ?>
                    .bdp_blog_template.brite .post-tags {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-tags span.tag a,
                    .bdp_blog_template.brite .post-tags-wrapp.bdp-no-links span {
                        background-color: <?php echo $winter_category_color; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                        padding: <?php echo $content_fontsize .'px'?> 1em;
                    }
                    .bdp_blog_template.brite .post-tags-wrapp.bdp-no-links span:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-tags-wrapp.bdp-no-links span:hover:after {
                        border-right: <?php echo $content_fontsize . 'px'; ?> solid <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-tags span.tag a:after,
                    .bdp_blog_template.brite .post-tags-wrapp.bdp-no-links span:after {
                        border-top: <?php echo $content_fontsize + ($content_fontsize / 2)  .'px'?> solid transparent;
                        border-bottom: <?php echo $content_fontsize + ($content_fontsize / 2) .'px'?> solid transparent;
                        border-right: <?php echo $content_fontsize .'px'?> solid <?php echo $winter_category_color; ?>;
                    }
                    .bdp_blog_template.brite .post-tags span.tag a:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-tags span.tag a:hover:after {
                        border-right: <?php echo $content_fontsize . 'px'; ?> solid <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-tags-wrapp.bdp-no-links span {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        margin-bottom: <?php echo $content_fontsize + 15 . 'px'; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                    }
                    .bdp_blog_template.brite .post-meta > .post-categories.bdp-no-links,
                    .bdp_blog_template.brite .post-meta > .post-categories i {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_blog_template.brite .post-author .author-name.bdp-has-links,
                    .bdp_blog_template.brite .post-meta > .post-categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if ($template_name == "chapter") {
                ?>
                    .chapter .blog_template.bdp_blog_template.chapter,
                    .chapter .author-avatar-div.bdp_blog_template,
                    .chapter .related_post_wrap,
                    .chapter .navigation.post-navigation {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .chapter .post-categories,
                    .chapter .chapter-footer,
                    .chapter .chapter-header{
                        color: <?php echo $contentcolor; ?>;
                    }
                    .chapter-header .post-comment i {
                        color: <?php echo $linkcolor; ?>;
                    }

                    .chapter-header .post-comment:hover i,
                    .chapter-header .post-comment:hover a {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                <?php
            }
            if ($template_name == "tagly") {
                ?>
                    .bdp_blog_template.tagly .right-side-area h1.bdp_post_title {
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                        color: <?php echo $titlecolor; ?>;
                        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
                        <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
                        <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
                        <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_blog_template.tagly .right-side-area h1.bdp_post_title:before {
                        background: <?php echo $templatecolor; ?>;
                        box-shadow: 6px -2px 0 <?php echo $templatecolor; ?>;
                        height: <?php echo $template_titlefontsize . 'px'; ?>;
                        top: <?php echo ($template_titlefontsize / 10); ?>px;
                    }
                    .bdp_blog_template.tagly .left-side-area {
                        background-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.tagly .left-side-area:before {
                        border-top-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.tagly .social-component::before {
                        border-bottom-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.tagly .right-side-area .tagly-footer,
                    .tagly .tagly-footer .post-tags {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_blog_template.tagly .right-side-area .categories,
                    .bdp_blog_template.tagly .right-side-area .tagly-footer a,
                    .bdp_blog_template.tagly .right-side-area .categories a,
                    .bdp_blog_template.tagly .metadatabox,
                    .bdp_blog_template.tagly .metadatabox span,
                    .bdp_blog_template.tagly .metadatabox a {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    }

                    .bdp_blog_template.tagly .metadatabox i {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                    }
                    .bdp_blog_template.tagly .metadatabox span.author i,
                    .tagly .tagly-footer .post-tags .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_blog_template.tagly .metadatabox span.author.bdp_has_links,
                    .tagly .tagly-footer .post-tags.bdp_has_links,
                    .bdp_blog_template.tagly .right-side-area .tagly-footer a,
                    .bdp_blog_template.tagly .right-side-area .categories.bdp_has_links,
                    .bdp_blog_template.tagly .right-side-area .categories a,
                    .bdp_blog_template.tagly .metadatabox span a {
                        color: <?php echo $linkcolor; ?>;
                    }

                    .bdp_blog_template.tagly .right-side-area .tagly-footer a:hover,
                    .bdp_blog_template.tagly .right-side-area .tagly-footer a:focus,
                    .bdp_blog_template.tagly .right-side-area .categories a:hover,
                    .bdp_blog_template.tagly .right-side-area .categories a:focus,
                    .bdp_blog_template.tagly .metadatabox span a:hover,
                    .bdp_blog_template.tagly .metadatabox span a:focus {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                <?php
            }
            if ($template_name == 'pretty') {
                ?>
                    .single .bdp_single.pretty .navigation.post-navigation,
                    .bdp_single .author-avatar-div, .bdp_single .related_post_wrap,
                    .bdp_single.pretty .author-avatar-div,
                    .single .bdp_single.pretty .comment-list article,
                    .single .bdp_single.pretty .comment-list .pingback,
                    .bdp_single.pretty .comment-respond .comment-form,
                    .single .bdp_single.pretty .comment-list .trackback,
                    .bdp_blog_template.pretty .right-content-wrapper,
                    .bdp_blog_template.pretty .bdp-post-image.post-has-image::before,
                    .bdp_archive.pretty .author-avatar-div {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .bdp_blog_template.pretty .blog_header .post_date {
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_blog_template.pretty .left-content-wrapper{
                        background: <?php echo bdp_hex2rgba($templatecolor, 0.5); ?>;
                    }
                    .bdp_blog_template.pretty .left-content-wrapper.post-has-image::before {
                        border-bottom-color: <?php echo bdp_hex2rgba($templatecolor, 0.5); ?>;
                    }
                    .bdp_blog_template.pretty .post-meta-cats-tags .tags > a:hover {
                        border-color: <?php echo $linkhovercolor; ?>;
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.pretty .post-meta-cats-tags .tags > a {
                        border-color: <?php echo $linkcolor; ?>;
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.pretty .post-meta-cats-tags .tags.bdp-no-links,
                    .bdp_blog_template.pretty .post-meta-cats-tags .tags .link-lable,
                    .bdp_blog_template.pretty .post-meta-cats-tags .category-link.bdp-no-links,
                    .bdp_blog_template.pretty .post-meta-cats-tags .category-link .link-lable,
                    .bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox author.bdp-no-links,
                    .bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox author .link-lable,
                    .bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                    .bdp_blog_template.pretty p, .bdp_blog_template.pretty .metadatabox author,
                    .bdp_blog_template.pretty .post-meta-cats-tags .tags,
                    .bdp_blog_template.pretty .post-meta-cats-tags .category-link {
                        color: <?php echo $linkcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>;<?php } ?>
                    }
                <?php
            }

            if ($template_name == 'roctangle') {
                ?>
                    .bdp_single.roctangle .author-avatar-div.bdp_blog_template .author_content {
                        border-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.roctangle .blog_template .post-meta-wrapper .post_date {
                        background: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.roctangle .post-content-wrapper .metadatabox .link-lable,
                    .bdp_single.roctangle .blog_template .post-content-wrapper .metadatabox .tags,
                    .bdp_single.roctangle .blog_template .post-content-wrapper .metadatabox .tags .link-lable {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $contentcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    }
                    .bdp_single.roctangle .blog_template .post-meta-wrapper .post-meta-div > span,
                    .bdp_single.roctangle .blog_template .post-content-wrapper .metadatabox .post-category,
                    .bdp_single.roctangle .metadatabox .tags a {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        border-color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?>font-family: <?php echo $content_fontface; ?>; <?php } ?>
                    }
                    .bdp_single.roctangle .blog_template .post-meta-wrapper .post-meta-div span a:hover,
                    .bdp_single.roctangle .blog_template .post-meta-wrapper .post-meta-div span a:hover i,
                    .bdp_single.roctangle .metadatabox .post-categories a:hover,
                    .bdp_single.roctangle .metadatabox .tags a:hover {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.roctangle .blog_template .post-content-wrapper .metadatabox .tags.bdp_has_links,
                    .bdp_single.roctangle .blog_template .post-meta-wrapper .post-meta-div span i {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.roctangle blockquote {
                        border-color: <?php echo $templatecolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($templatecolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }

                <?php
            }

            if ($template_name == "minimal") {
                $meta_fontsize = $content_fontsize + 3;
                ?>
                    .minimal .post-content-wrapper,
                    .bdp_single.minimal .bdp-post-navigation,
                    .bdp_single.minimal .author-avatar-div,
                    .bdp_single.minimal .related_post_wrap,
                    .bdp_single.minimal #comments {
                        background: <?php echo $template_bgcolor; ?>;
                    }
                    .minimal .post-category-wrapp .post-category {
                        border-color: <?php echo $linkcolor; ?>;
                    }
                    .minimal .post-header-meta > span {
                        font-size: <?php echo $meta_fontsize . 'px'; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp.bdp-no-links span {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        margin-bottom: <?php echo $content_fontsize + 15 . 'px'; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp span a,
                    .minimal .post-tags .post-tags-wrapp.bdp-no-links span {
                        background-color: <?php echo $winter_category_color; ?>;
                        padding: <?php echo $content_fontsize .'px'?> 1em;
                    }
                    .minimal .post-tags .post-tags-wrapp span a:after,
                    .minimal .post-tags .post-tags-wrapp.bdp-no-links span:after {
                        border-top: <?php echo $content_fontsize + ($content_fontsize / 2)  .'px'?> solid transparent;
                        border-bottom: <?php echo $content_fontsize + ($content_fontsize / 2) .'px'?> solid transparent;
                        border-right: <?php echo $content_fontsize .'px'?> solid <?php echo $winter_category_color; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp.bdp-no-links span:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp.bdp-no-links span:hover:after {
                        border-right: <?php echo $content_fontsize . 'px'; ?> solid <?php echo $linkcolor; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp span a {
                        background-color: <?php echo $winter_category_color; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp span a:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .minimal .post-tags .post-tags-wrapp span a:hover:after {
                        border-right: <?php echo $content_fontsize . 'px'; ?> solid <?php echo $linkcolor; ?>;
                    }

                    .minimal .post-tags {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_single.minimal blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                    .minimal .post-header-meta > span,
                    .minimal .post-category-wrapp .post-category,
                    .bdp_single.minimal .bdp-post-meta,
                    .bdp_single.minimal .post-comment:not(.no-bdp-links) {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.minimal .post-comment:not(.no-bdp-links):hover {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                <?php
            }

            if ($template_name == "glamour") {
                ?>
                    .bdp_single.glamour .bdp_blog_template.glamour,
                    .bdp_single.glamour .bdp-post-navigation,
                    .bdp_single.glamour .related_post_wrap,
                    .bdp_single.glamour .comments-area,
                    .glamour .post-content-wrapper,
                    .glamour .post-footer-meta,
                    .glamour .glamour-social-cover,
                    .bdp_single.glamour .author-avatar-div {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .glamour .post-footer-meta,
                    .glamour .glamour-social-cover {
                        border-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.glamour .post-content-wrapper > .category-link a,
                    .bdp_single.glamour .post-content-wrapper > .category-link {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.glamour .post-content-wrapper > .category-link a:hover {
                        color: <?php echo $linkcolor; ?>;
                        text-decoration: underline;
                    }
                    .glamour-social-cover .glamour-social-links-closed i,
                    .glamour-footer-icon span a i {
                        color: <?php echo $linkhovercolor; ?>;
                        border-color: <?php echo $linkhovercolor; ?>;
                    }
                    .glamour-social-cover .glamour-social-links-closed i:hover,
                    .glamour-footer-icon span a i:hover {
                        background: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.glamour blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: #<?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                    .bdp_single.glamour .post-content-wrapper > .tags.link-lable {
                        color: <?php echo $contentcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_single.glamour .post-content-wrapper > .tags,
                    .bdp_single.glamour .post-footer-meta > span,
                    .bdp_single .display_post_views p {
                        color: <?php echo $linkcolor; ?>;
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                <?php
            }

            if($template_name == 'famous') {
                ?>
                    .bdp_single.famous blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                    .bdp_single.famous .category-link,
                    .bdp_single.famous .post-meta,
                    .bdp_single.famous .post-footer-meta,
                    .bdp_single.famous .post-footer-meta .display_post_views p {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_single.famous .category-link,
                    .bdp_single.famous .category-link a {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.famous .category-link a:hover {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }
            if($template_name == 'fairy') {
                ?>
                    .bdp_single.fairy .bdp_blog_template,
                    .bdp_single.fairy .author-avatar-div,
                    .bdp_single.fairy .bdp-post-navigation,
                    .bdp_single.fairy .author-avatar-div,
                    .bdp_single.fairy .related_post_wrap,
                    .bdp_single.fairy .comments-area {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .bdp_blog_template.fairy .post-meta .display_post_views p {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.fairy .post-tags .post-tags-wrapp span {
                        border-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.fairy .category-link,
                    .bdp_blog_template.fairy .post-tags {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_blog_template.fairy .category-link .link-lable,
                    .bdp_blog_template.fairy .post-tags .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.fairy blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                <?php
            }
            if($template_name == 'clicky') {
                ?>
                    .clicky .post-meta,
                    .clicky .post-tags,
                    .clicky .author .author-name,
                    .clicky .post-category-wrapp span,
                    .clicky .display_post_views p {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .clicky .post-category-wrapp span {
                        border-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.clicky .bdp_blog_template,
                    .bdp_single.clicky .bdp-post-navigation,
                    .bdp_single.clicky .author-avatar-div,
                    .bdp_single.clicky .comments-area {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .clicky .post-tags .post-tags-wrapp span {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        margin-bottom: <?php echo $content_fontsize + 15 . 'px'; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                    }
                    .clicky .post-tags .post-tags-wrapp.bdp-no-links span,
                    .clicky .post-tags .post-tags-wrapp span a{
                        background-color: <?php echo $winter_category_color; ?>;
                        padding: <?php echo round($content_fontsize / 2) .'px'?> 1em;
                    }
                    .clicky .post-tags .post-tags-wrapp span a:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .clicky .post-tags .post-tags-wrapp span a:hover:after {
                        border-right-color: <?php echo $linkcolor; ?>;
                    }

                    .clicky .post-tags .post-tags-wrapp.bdp-no-links span{
                        background-color: <?php echo $winter_category_color; ?>;
                        margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
                    }
                    .clicky .post-tags .post-tags-wrapp.bdp-no-links span:after,
                    .clicky .post-tags .post-tags-wrapp span a:after {
                        border-top-color: transparent;
                        border-bottom-color: transparent;
                        border-right-color: <?php echo $winter_category_color; ?>;
                    }
                    .clicky .post-tags .post-tags-wrapp.bdp-no-links span:hover {
                        background-color: <?php echo $linkcolor; ?>;
                    }
                    .clicky .post-tags .post-tags-wrapp.bdp-no-links span:hover:after {
                        border-right-color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_single.clicky blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                <?php
            }

            if($template_name == 'cover') {
                ?>
                    .bdp_single.cover .bdp_blog_template,
                    .bdp_single.cover .bdp-post-navigation,
                    .bdp_single.cover .comments-area {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .bdp_blog_template.cover .category-link,
                    .bdp_blog_template.cover .post-meta,
                    .bdp_blog_template.cover .post-footer-meta,
                    .bdp_blog_template.cover .post-footer-meta .display_post_views p {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_blog_template.cover .category-link,
                    .bdp_blog_template.cover .category-link a {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_blog_template.cover .category-link a:hover {
                        color: <?php echo $linkcolor; ?>;
                    }
                    .bdp_blog_template.cover blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                <?php
            }

            if($template_name == 'steps') {
                ?>
                    .bdp_single.steps,
                    .bdp_single.steps > div,
                    .bdp_blog_template.steps .post-meta,
                    .bdp_single.steps > .bdp-post-navigation,
                    .bdp_single.steps > div:before,
                    .bdp_single.steps > .bdp-post-navigation:before {
                        border-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.steps > div:after,
                    .bdp_single.steps > .bdp-post-navigation:after {
                        color: <?php echo $templatecolor; ?>;
                        border-color: <?php echo $templatecolor; ?>;
                    }
                    .bdp_single.steps > div,
                    .bdp_single.steps > .bdp-post-navigation,
                    .bdp_single.steps > div:after,
                    .bdp_single.steps > .bdp-post-navigation:after,
                    .bdp_single.steps > div:before,
                    .bdp_single.steps > .bdp-post-navigation:before {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .bdp_blog_template.cover .post-meta,
                    .bdp_blog_template.steps .display_post_views p,
                    .bdp_blog_template.steps .post-meta-cats-tags {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_blog_template.steps .post-meta-cats-tags .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.steps blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($templatecolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                    .bdp_blog_template.steps .post-meta > span {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }

            if ($template_name == "miracle") {
                ?>
                    .bdp_single.miracle .miracle_blog .bdp-post-format {
                        color: <?php echo $titlecolor; ?>;
                        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                    }
                    .bdp_single.miracle .miracle_blog,
                    .bdp_single.miracle .navigation.post-navigation,
                    .bdp_single.miracle .author-avatar-div,
                    .bdp_single.miracle .related_post_wrap,
                    .bdp_single.miracle .comments-area {
                        background: <?php echo $template_bgcolor; ?> !important;
                    }
                    .bdp_single.miracle .miracle_blog .post-meta,
                    .bdp_single.miracle .miracle_blog .post-meta a,
                    .bdp_single.miracle .miracle_blog .category-link,
                    .bdp_single.miracle .miracle_blog .category-link a,
                    .bdp_single.miracle .miracle_blog .tags,
                    .bdp_single.miracle .miracle_blog .tags a {
                        font-size: <?php echo $content_fontsize . 'px'; ?>;
                        color: <?php echo $linkcolor; ?>;
                        <?php if ($content_fontface) { ?> font-family: <?php echo $content_fontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($template_content_font_line_height) { ?> line-height: <?php echo $template_content_font_line_height; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                    .bdp_single.miracle .miracle_blog .post-meta .bdp_no_links,
                    .bdp_single.miracle .miracle_blog .category-link a:hover,
                    .bdp_single.miracle .miracle_blog .tags a:hover,
                    .bdp_single.miracle .miracle_blog .post-meta a:hover {
                        color: <?php echo $linkhovercolor; ?>;
                    }
                    .bdp_single.miracle .miracle_blog .category-link.bdp_no_links,
                    .bdp_single.miracle .miracle_blog .category-link .link-lable,
                    .bdp_single.miracle .miracle_blog .tags.bdp_no_links,
                    .bdp_single.miracle .miracle_blog .tags .link-lable {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_single.miracle .miracle_blog blockquote {
                        border-color: <?php echo $linkhovercolor; ?>;
                        background-color: <?php echo bdp_hex2rgba($linkhovercolor, 0.1); ?>;
                        padding: 15px 15px 15px 30px;
                        margin: 15px 0;
                    }
                <?php
            }
            
            if ($template_name == "hub") {
                ?>
                    .bdp_blog_template.hub .tags.bdp-no-links,
                    .bdp_blog_template.hub .tags i,
                    .bdp_blog_template.hub .post-bottom .categories.bdp-no-links,
                    .bdp_blog_template.hub .post-bottom .categories i {
                        color: <?php echo $contentcolor; ?>;
                    }
                    .bdp_blog_template.hub .post-bottom span.post-by .bdp-has-links,
                    .bdp_blog_template.hub .tags,
                    .bdp_blog_template.hub .post-bottom .categories {
                        color: <?php echo $linkcolor; ?>;
                    }
                <?php
            }

            if (isset($single_data_setting['firstletter_big']) && $single_data_setting['firstletter_big'] == 1) {
                ?>
                    .bdp_single .bdp_blog_template .entry-content > *:first-child:first-letter,
                    .bdp_single .bdp_blog_template .entry-content > p:first-child:first-letter,
                    .bdp_single .bdp_blog_template .post_content > p:first-child:first-letter,
                    .bdp_single .bdp-first-letter{
                        margin-right:10px;
                        font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                        color: <?php echo $firstletter_contentcolor; ?>;
                        <?php if ($firstletter_contentfontface) { ?> font-family:<?php echo $firstletter_contentfontface; ?>; <?php } ?>
                        <?php if ($template_content_font_weight) { ?> font-weight: <?php echo $template_content_font_weight; ?>;<?php } ?>
                        <?php if ($firstletter_fontsize) { ?> line-height: <?php echo $firstletter_fontsize * 75 / 100 . 'px'; ?>;<?php } ?>
                        <?php if ($template_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                        <?php if ($template_content_font_text_transform) { ?> text-transform: <?php echo $template_content_font_text_transform; ?>;<?php } ?>
                        <?php if ($template_content_font_text_decoration) { ?> text-decoration: <?php echo $template_content_font_text_decoration; ?>;<?php } ?>
                        <?php if ($template_content_font_letter_spacing) { ?> letter-spacing: <?php echo $template_content_font_letter_spacing . 'px'; ?>;<?php } ?>
                    }
                <?php
            }
            if (isset($single_data_setting['custom_css']) && !empty($single_data_setting['custom_css'])) {
                echo stripslashes($single_data_setting['custom_css']);
            }
            ?></style>
            <?php
        }
    }
}
