<style id="bdp_dynamic_style_<?php echo $shortcode_id; ?>">
    <?php
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

    $layout_id = '.layout_id_'.$shortcode_id;

    if($loader_color != '') {
        ?>
        .bdp-circularG,
        .bdp-windows8 .bdp-wBall .bdp-wInnerBall,
        .bdp-cssload-thecube .bdp-cssload-cube:before,
        .bdp-ball-grid-pulse > div,
        .bdp-square,
        .bdp-floatBarsG,
        .bdp-movingBallLineG,
        .bdp-movingBallG,
        .bdp-cssload-ball:after,
        .bdp-spinload-loading i:first-child,
        .bdp-csball-loading i:nth-child(1), .bdp-csball-loading i:nth-child(1):before, .bdp-csball-loading i:nth-child(1):after,
        .bdp-bigball-loading i,
        .bdp-bubble-loading i,
        .bdp-ccball-loading i:nth-child(1), .bdp-ccball-loading i:nth-child(2):before,
        .bdp-cssload-dots:nth-child(n):before,
        .bdp-circlewave {
            background-color: <?php echo $loader_color; ?>;
        }
        .bdp-square:nth-child(3),
        .bdp-spinload-loading i,
        .bdp-bigball-loading i:nth-child(2),
        .bdp-bubble-loading i:nth-child(2),
        .bdp-csball-loading i:nth-child(2), .bdp-csball-loading i:nth-child(2):before, .bdp-csball-loading i:nth-child(2):after,
        .bdp-ccball-loading i:nth-child(2), .bdp-ccball-loading i:nth-child(1):before,
        .bdp-cssload-dots:nth-child(n):after {
            background-color: <?php echo $color; ?>;
        }
        .bdp-spinload-loading i:last-child,
        .bdp-csball-loading i:nth-child(3), .bdp-csball-loading i:nth-child(3):before, .bdp-csball-loading i:nth-child(3):after {
            background-color: <?php echo $linkhovercolor; ?>;
        }
        .bdp-spinloader,
        .bdp-cssload-inner.bdp-cssload-three {
            border-top-color: <?php echo $loader_color; ?>;
        }
        .bdp-cssload-inner.bdp-cssload-one {
            border-bottom-color: <?php echo $loader_color; ?>;
        }
        .bdp-cssload-inner.bdp-cssload-two {
            border-right-color: <?php echo $loader_color; ?>;
        }
        .bdp-circlewave:after {
            border-top-color: <?php echo $loader_color; ?>;
            border-bottom-color: <?php echo $loader_color; ?>;
        }
        .bdp-doublec-loading {
            border-bottom-color: <?php echo $loader_color; ?>;
            border-left-color: <?php echo $loader_color; ?>;
        }
        .bdp-doublec-loading:before {
            border-top-color: <?php echo $loader_color; ?>;
            border-right-color: <?php echo $loader_color; ?>;
        }
        .bdp-cssload-aim {
            border-left-color: <?php echo $loader_color; ?>;
            border-right-color: <?php echo $loader_color; ?>;
        }
        .bdp-doublec-loading:after,
        .bdp-facebook_blockG,
        .bdp-loader div,
        .bdp-cssload-ball {
            border-color: <?php echo $loader_color; ?>;
        }
        .bdp-warningGradientOuterBarG {
            border-color: <?php echo $loader_color; ?>;
            background: -moz-gradient(linear,0% 0%,0% 100%,from(#fff),to(<?php echo $loader_color; ?>));
            background: linear-gradient(top,#fff,<?php echo $loader_color; ?>);
            background: -o-linear-gradient(top,#fff,<?php echo $loader_color; ?>);
            background: -ms-linear-gradient(top,#fff,<?php echo $loader_color; ?>);
            background: -webkit-linear-gradient(top,#fff,<?php echo $loader_color; ?>);
            background: -moz-linear-gradient(top,#fff,<?php echo $loader_color; ?>);
        }
        .bdp-cssload-heartL,
        .bdp-cssload-heartR,
        .bdp-cssload-square {
            border-color: <?php echo $loader_color; ?>;
            background-color: <?php echo $loader_color; ?>;
        }
        @keyframes f_fadeG{
            0%{
                background-color:<?php echo $loader_color; ?>;
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }
        @keyframes ballsWaveG{
            0%{
                background-color:<?php echo $loader_color; ?>;
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }
        @keyframes bounce_floatBarsG{
            0%{
                transform:scale(1);
                background-color:<?php echo $loader_color; ?>;
            }

            100%{
                transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }
        @keyframes bounce_fountainG{
            0%{
                transform:scale(1);
                background-color:<?php echo $loader_color; ?>;
            }

            100%{
                transform:scale(.3);
                background-color:rgb(255,255,255);
            }
        }
        @keyframes audio_wave {
            0% {height:5px;transform:translateY(0px);background:<?php echo $loader_color; ?>;}
            25% {height:30px;transform:translateY(15px);background:<?php echo $color; ?>;}
            50% {height:5px;transform:translateY(0px);background:<?php echo $loader_color; ?>;}
            100% {height:5px;transform:translateY(0px);background:<?php echo $color; ?>;}
        }
        @keyframes fadeG {
            0%{
                background-color:<?php echo $loader_color; ?>;
            }

            100%{
                background-color:rgb(255,255,255);
            }
        }
        @keyframes circlewave {
            0% {transform: rotate(0deg);}
            50% {transform: rotate(180deg);background:<?php echo $color; ?>;}
            100% {transform: rotate(360deg);}
        }
        @keyframes circlewave_after {
            0% {border-top:10px solid #9b59b6;border-bottom:10px solid <?php echo $color; ?>;}
            50% {border-top:10px solid #3498db;border-bottom:10px solid <?php echo $loader_color; ?>;}
            100% {border-top:10px solid #9b59b6;border-bottom:10px solid <?php echo $color; ?>;}
        }

        <?php
    }
    ?>

    <?php if ($social_icon_style == 0 && $social_style == 0) { ?>
        .social-component a {
            border-radius: 100%;
        }
        <?php
    }

    if ($beforeloop_Readmoretext != '') {
        ?>
        .bdp_wrapper<?php echo $layout_id?> .custom_read_more.before_loop,
        .bdp_wrapper<?php echo $layout_id?> .custom_read_more.after_loop{
            display: inline-block;
            margin: 30px 0;
            text-align: center;
            width: 100%;
        }
        .bdp_wrapper<?php echo $layout_id?> .custom_read_more a{
            transition: 0.2s all;
            -webkit-transition: 0.2s all;
            -ms-transition: 0.2s all;
            -o-transition: 0.2s all;
            display: inline-block;
            padding: 7px 20px;
            box-shadow: none;
            <?php if ($beforeloop_readmorebackcolor) { ?> background: <?php echo $beforeloop_readmorebackcolor; ?>;<?php } ?>
            <?php if ($beforeloop_readmorecolor) { ?> color: <?php echo $beforeloop_readmorecolor; ?>;<?php } ?>
            <?php if ($beforeloop_titlefontsize) { ?> font-size: <?php echo $beforeloop_titlefontsize . 'px'; ?>;<?php } ?>
            <?php if ($beforeloop_titlefontface) { ?> font-family: <?php echo $beforeloop_titlefontface; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_weight) { ?> font-weight: <?php echo $beforeloop_title_font_weight; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_line_height) { ?> line-height: <?php echo $beforeloop_title_font_line_height; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_text_transform) { ?> text-transform: <?php echo $beforeloop_title_font_text_transform; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_text_decoration) { ?> text-decoration: <?php echo $beforeloop_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($beforeloop_title_font_letter_spacing) { ?> letter-spacing: <?php echo $beforeloop_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        .bdp_wrapper<?php echo $layout_id?> .custom_read_more a:hover{
            color: <?php echo $beforeloop_readmorehovercolor; ?>;
            background: <?php echo $beforeloop_readmorehoverbackcolor; ?>;
        }
        <?php
    }
    if ($template_alternativebackground == '1') {
        ?>
        <?php echo $layout_id?> .white-content .alternative-back{
            background: <?php echo $alterbackground; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.alternative-back{
            background: <?php echo $alterbackground; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.evolution.alternative-back{
            background: <?php echo $alterbackground; ?>;
        }
    <?php } ?>
    <?php echo $layout_id?> .bdp_blog_template .post_content {
        color: <?php echo $contentcolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .bdp-pinterest-share-image a {
        background-image: url("<?php echo plugins_url(); ?>/blog-designer-pro/images/pinterest.png");
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content a {
        color: <?php echo $color; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content a.more-tag {
        background: <?php echo $readmorebackcolor; ?>;
        color:<?php echo $readmorecolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content a.more-tag:hover {
        background: <?php echo $readmorehoverbackcolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content a:hover,
    <?php echo $layout_id?> .bdp_blog_template .tags a:hover,
    <?php echo $layout_id?> .bdp_blog_template .categories a:hover,
    <?php echo $layout_id?> .bdp_blog_template .category-link a:hover,
    <?php echo $layout_id?> .bdp_blog_template a:hover,
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a:hover,
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a:hover .bdp-count,
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a:hover i {
        color: <?php echo $linkhovercolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a,
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a i,
    <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a .bdp-count {
        color: <?php echo $color; ?>;
    }

    <?php if (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 1) { ?>
        <?php echo $layout_id?> .bdp_blog_template .social-component a.social-share-default{
            padding: 0;
            border:0;
            box-shadow: none;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.large a.social-share-default{
            padding: 0;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component{
            float: left;
            margin-top: 10px;
            width: 100%;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share,
        <?php echo $layout_id?> .blog_template.bdp_blog_template .social-component > a {
            margin: 10px 8px 0 0;
            float: left;
        }
        <?php
    } elseif (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] == 2) {
        ?>
        <?php echo $layout_id?> .bdp_blog_template .social-component.extra_small .social-share {
            display: inline-block;
            margin: 10px 0 0;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.extra_small a {
            font-size: 13px;
            height: 27px;
            line-height: 20px;
            margin: 0px 2px 0 !important;
            padding: 7px 0;
            width: 27px;
        }
        <?php
    }
    if (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'bottom') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count {
            background-color: transparent;
            border: 1px solid #dddddd;
            border-radius: 5px;
            clear: both;
            color: <?php echo $contentcolor; ?>;
            float: left;
            line-height: 1;
            margin: 10px 0 0;
            padding: 5px 4%;
            text-align: center;
            width: 38px;
            position: relative;
            word-wrap: break-word;
            height: auto;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.large .social-share .count {
            width: 45px;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count:before {
            border-bottom: 8px solid #dddddd;
            border-left: 8px solid rgba(0, 0, 0, 0);
            border-right: 8px dashed rgba(0, 0, 0, 0);
            content: "";
            left: 0;
            margin: 0 auto;
            position: absolute;
            right: 0;
            top: -8px;
            width: 0;
        }

        <?php
    } elseif (isset($bdp_settings['social_count_position']) && $bdp_settings['social_count_position'] == 'top') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count {
            background-color: transparent;
            border: 1px solid #dddddd;
            border-radius: 5px;
            clear: both;
            color: <?php echo $contentcolor; ?>;
            float: none;
            line-height: 1;
            margin: 0 0 10px 0;
            padding: 5px 4%;
            text-align: center;
            width: 38px;
            position: relative;
            height: auto;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.large .social-share .count {
            width: 45px;
        }
        <?php echo $layout_id?> .bdp_blog_template.even_class .social-component .social-share .count{
            float: none;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count:before {
            border-top: 8px solid #dddddd;
            border-left: 8px solid rgba(0, 0, 0, 0);
            border-right: 8px dashed rgba(0, 0, 0, 0);
            content: "";
            left: 0;
            margin: 0 auto;
            position: absolute;
            right: 0;
            bottom: -9px;
            width: 0;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template .social-component > a{
            display: inline-block;
            margin-bottom: 0;
            float:none;
            vertical-align: bottom;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share {
            display: inline-block;
            float: none;
        }
        <?php
    } else {
        ?>
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count {
            background-color: transparent;
            border: 1px solid #dddddd;
            border-radius: 5px;
            color: <?php echo $contentcolor; ?>;
            float: right;
            line-height: 20px;
            margin: 0 0 0 10px;
            padding: 8px 0;
            text-align: center;
            width: 38px;
            height: 38px;
            position: relative;
            box-sizing: border-box;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.large .social-share .count {
            margin: 0 0 0 7px;
            padding: 12px 0;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.large .social-share .count:before {
            top: 30%;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component .social-share .count:before {
            border-top: 8px solid rgba(0, 0, 0, 0);
            border-bottom: 8px dashed rgba(0, 0, 0, 0);
            border-right: 8px solid #dddddd;
            content: "";
            margin: 0 auto;
            position: absolute;
            left: -8px;
            top: 27%;
            width: 0;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component.extra_small .social-share .count:before {
            border-top: 6px solid rgba(0, 0, 0, 0);
            border-bottom: 8px dashed rgba(0, 0, 0, 0);
            border-right: 6px solid #dddddd;
            content: "";
            left: -33px;
            margin: 0 auto;
            position: absolute;
            right: 0;
            top: 27%;
            width: 0;
        }
        <?php
    }
    ?>
    <?php echo $layout_id?> .bdp-load-more .button.bdp-load-more-btn:hover {
        background: <?php echo $loadmore_button_color; ?>;
        color: <?php echo $loadmore_button_bg_color; ?>;
    }
    <?php echo $layout_id?> .bdp-load-more a.button.bdp-load-more-btn {
        background: <?php echo $loadmore_button_bg_color; ?>;
        border-color: <?php echo $loadmore_button_bg_color; ?>;
        color: <?php echo $loadmore_button_color; ?>;
    }
    <?php echo $layout_id?> .bdp-load-more a.button.bdp-load-more-btn.template-3 span:before,
    <?php echo $layout_id?> .bdp-load-more a.button.bdp-load-more-btn.template-3 span:after {
        background: <?php echo $loadmore_button_color; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template h2.post-title {
        color: <?php echo $titlecolor; ?>;
        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
        <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
        <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
        <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
        <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
        <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
    }
    <?php echo $layout_id?> .bdp_blog_template .entry-title a,
    <?php echo $layout_id?> .bdp_blog_template h2.post-title a {
        color: <?php echo $titlecolor; ?>;
        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content_wrap,
    <?php echo $layout_id?> .bdp_blog_template .post_content,
    <?php echo $layout_id?> .bdp_blog_template .label_featured_post,
    <?php echo $layout_id?> .bdp_blog_template .label_featured_post span,
    <?php echo $layout_id?> .bdp_blog_template .post_summary_outer,
    <?php echo $layout_id?> .bdp_blog_template .post_hentry,
    <?php echo $layout_id?> .bdp_blog_template .blog_footer {
        <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
    }
    <?php echo $layout_id?> .bdp_blog_template .metacomments a,
    <?php echo $layout_id?> .deport .metadatabox a span.bdp-count {
        color:<?php echo $color; ?>;
    }
    <?php echo $layout_id?> .deport-category-text.categories_link{
        color: <?php echo $contentcolor; ?>
    }
    <?php echo $layout_id?> .deport-category-text{
        color: <?php echo $color; ?>
    }

    <?php echo $layout_id?> .bdp_blog_template .tags a,
    <?php echo $layout_id?> .bdp_blog_template .categories a,
    <?php echo $layout_id?> .bdp_blog_template .category-link a {
        color:<?php echo $color; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template.box-template .blog_header .post-title{
        background: <?php echo $titlebackcolor; ?>;
    }
    <?php echo $layout_id?> .blog_template .social-component a {
        border-color: <?php echo $color; ?>;
        color: <?php echo $color; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template h2.post-title a:hover,
    <?php echo $layout_id?> .bdp_blog_template .entry-title a:hover {
        color:<?php echo $titlehovercolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .post_content,
    <?php echo $layout_id?> .bdp_blog_template .label_featured_post,
    <?php echo $layout_id?> .bdp_blog_template .label_featured_post span,
    <?php echo $layout_id?> .bdp_blog_template .post_content p {
        font-size: <?php echo $content_fontsize . 'px'; ?>;
        <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
        <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
        <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
        <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
        <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
        <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
    }
    <?php echo $layout_id?> .bdp_blog_template .upper_image_wrapper blockquote,
    <?php echo $layout_id?> .bdp_blog_template .upper_image_wrapper blockquote p{
        font-size: <?php echo $content_fontsize + 3 . 'px'; ?>;
        font-family: <?php echo $content_font_family; ?>;
        color: <?php echo $contentcolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .upper_image_wrapper blockquote{
        background: <?php echo bdp_hex2rgba($background, 0.9); ?>;
        border-color: <?php echo $templatecolor; ?>;
    }
    <?php echo $layout_id?> .bdp_blog_template .upper_image_wrapper blockquote:before{
        font-size: <?php echo $content_fontsize + 5 . 'px'; ?>;
        color: <?php echo $contentcolor; ?>
    }
    <?php echo $layout_id?> .blog_template .upper_image_wrapper.bdp_link_post_format a:hover{
        color: <?php echo $linkhovercolor; ?>;
    }
    <?php echo $layout_id?> .blog_template .upper_image_wrapper.bdp_link_post_format a{
        font-size: <?php echo $content_fontsize + 5 . 'px'; ?>;
        font-family: <?php echo $content_font_family; ?>;
        background: <?php echo bdp_hex2rgba($background, 0.9); ?>;
        color: <?php echo $color; ?>;
    }

    <?php echo $layout_id?>.bdp_archive .author-avatar-div {
        background-color: <?php echo $author_bgcolor; ?>;
    }

    .bdp_archive<?php echo $layout_id?> .author-avatar-div .author_content .author {
        color: <?php echo $titlecolor; ?>;
        font-size: <?php echo $template_titlefontsize . 'px'; ?>;
        <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
        <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
        <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
        <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
        <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
        <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
    }
    <?php echo $layout_id?> .bdp_blog_template h2.post-title a:hover,
    <?php echo $layout_id?> .bdp_blog_template .entry-title a:hover {
        color:<?php echo $titlehovercolor; ?>;
    }
    <?php if ($bdp_theme == 'lightbreeze') { ?>
        <?php echo $layout_id?> .blog_template.lightbreeze {
            background:<?php echo $background; ?>;
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .blog_header h2{
            background: <?php echo $titlebackcolor; ?>;
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .blog_header h2 a{
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .blog_header h2 a:hover{
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .read-more a,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .label_featured_post span {
            background-color: <?php echo $readmorebackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.lightbreeze  .read-more a:hover {
            background-color: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .post_content p,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .tags,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metacats,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metadate,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metacomments,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze.category-main-wrap .category-list {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metacats a{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .blog_template.lightbreeze .post_content {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .tags,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .taxonomies,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metauser,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .category-link,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metauser.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .metauser .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .category-link.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .metadatabox .category-link .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .taxonomies .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .taxonomies.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .tags.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .tags i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze.alternative-back .category-main:before,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze.alternative-back .category-main:after{
            border-bottom-color: <?php echo $alterbackground; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze .category-main{
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze.alternative-back,
        <?php echo $layout_id?> .bdp_blog_template.lightbreeze.alternative-back .category-main{
            background: <?php echo $alterbackground; ?>;
        }
        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .lightbreeze.bdp_blog_template div.post_content > *:first-child:first-letter,
            <?php echo $layout_id?> .lightbreeze.bdp_blog_template div.post_content > p:first-child:first-letter,
            <?php echo $layout_id?> .lightbreeze.bdp_blog_template .post_content:first-letter {
                <?php if ($firstletter_font_family) { ?> font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: none;
                margin-right:0;
                line-height: 0;
            }
            <?php echo $layout_id?> .lightbreeze.bdp_blog_template div.post_content {
                margin-top: <?php echo ($firstletter_fontsize / 2), 'px'; ?>;
            }
        <?php
        }
    }
    if ($bdp_theme == 'sharpen') {
        ?>
        <?php echo $layout_id?> .blog_template.sharpen {
            background:<?php echo $background; ?>;
        }
        <?php echo $layout_id?> .blog_template.sharpen .blog_header h2{
            background: <?php echo $titlebackcolor; ?>;
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.sharpen .blog_header h2 a{
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.sharpen .blog_header h2 a:hover{
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metauser.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .category-list.bdp_has_links,
        <?php echo $layout_id?> <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .tags.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.sharpen a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.sharpen .read-more a,
        <?php echo $layout_id?> .bdp_blog_template.blog_template.sharpen .label_featured_post span{
            background-color: <?php echo $readmorebackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .blog_template.sharpen .read-more a:hover {
            background-color: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .tags i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.sharpen .post_content p,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metauser .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metauser,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metacats,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .tags,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metadate,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metacomments,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .category-link,
        <?php echo $layout_id?> .bdp_blog_template.sharpen.category-main-wrap .category-list {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen .metadatabox .metacats a{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .blog_template.sharpen .post_content,
        <?php echo $layout_id?> .bdp_blog_template.blog_template.sharpen .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen .triangle_style .category-main:before,
        <?php echo $layout_id?> .bdp_blog_template.sharpen .triangle_style .category-main:after{
            border-bottom-color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen.alternative-back .category-main:before,
        <?php echo $layout_id?> .bdp_blog_template.sharpen.alternative-back .category-main:after{
            border-bottom-color: <?php echo $alterbackground; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen .category-main{
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sharpen.alternative-back,
        <?php echo $layout_id?> .bdp_blog_template.sharpen.alternative-back .category-main{
            background: <?php echo $alterbackground; ?>;
        }
        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .sharpen.bdp_blog_template div.post_content > *:first-child:first-letter,
            <?php echo $layout_id?> .sharpen.bdp_blog_template div.post_content > p:first-child:first-letter,
            <?php echo $layout_id?> .sharpen.bdp_blog_template .post_content:first-letter {
                <?php if ($firstletter_font_family) { ?> font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: none;
                margin-right:0;
                line-height: 0;
            }
            <?php echo $layout_id?> .sharpen.bdp_blog_template div.post_content {
                margin-top: <?php echo ($firstletter_fontsize / 2), 'px'; ?>;
            }
        <?php
        }
    }
    if ($bdp_theme == 'classical') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.classical,.bdp_blog_template.classical .entry-container,
        <?php echo $layout_id?> .bdp_blog_template.classical .entry-meta {
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .blog_header h2 {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .blog_header h2 a {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .blog_header h2 a:hover {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .post_content,
        <?php echo $layout_id?> .bdp_blog_template.classical .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?>.bdp_archive.classical .author_content p,
        <?php echo $layout_id?>  .bdp_blog_template.classical .post-meta-cats-tags .category-link .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags .category-link.categories_link,
        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags .tags.tag_link,
        <?php echo $layout_id?> .bdp_blog_template.classical .metadatabox,
        <?php echo $layout_id?> .bdp_blog_template.classical p {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>;
        }

        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags .category-link,
        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags .tags {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .post-meta-cats-tags {
            border-color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .read-more a,
        <?php echo $layout_id?> .bdp_blog_template.classical .label_featured_post {
            border-color: <?php echo $readmorebackcolor; ?>;
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .read-more a:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical span,
        <?php echo $layout_id?> .bdp_blog_template.classical a,
        <?php echo $layout_id?> .bdp_blog_template.classical .metacomments a,
        <?php echo $layout_id?> .bdp_blog_template.classical .tags,
        <?php echo $layout_id?> .bdp_blog_template.classical .tags a,
        <?php echo $layout_id?> .bdp_blog_template.classical .categories a,
        <?php echo $layout_id?> .bdp_blog_template.classical .category-link a,
        <?php echo $layout_id?> .bdp_archive .author-avatar-div .author_content .author a,
        <?php echo $layout_id?> .author-avatar-div.bdp_blog_template .social-component a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical span.bdp_no_link {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component a {
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.classical .metacomments a:hover,
        <?php echo $layout_id?> .bdp_blog_template.classical .tags a:hover,
        <?php echo $layout_id?> .bdp_blog_template.classical .categories a:hover,
        <?php echo $layout_id?> .bdp_blog_template.classical .category-link a:hover,
        <?php echo $layout_id?> .bdp_blog_template.classical a:hover,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.classical .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'evolution') {
        ?>

        <?php echo $layout_id?> .bdp_blog_template.evolution .entry-title a,
        <?php echo $layout_id?> .bdp_blog_template.evolution h2.post-title a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php if ($titlebackcolor != '') { ?>
            <?php echo $layout_id?> .bdp_blog_template.evolution .post-title{
                background: <?php echo $titlebackcolor; ?>;
            }
        <?php } ?>
        <?php echo $layout_id?> .evolution .post-content-body,
        <?php echo $layout_id?> .evolution.bdp_blog_template .label_featured_post span{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .evolution .post-bottom a,
        <?php echo $layout_id?> .evolution.bdp_blog_template .label_featured_post span{
            background: <?php echo $readmorebackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .evolution .post-bottom a:hover{
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .evolution .post-content-body p,
        <?php echo $layout_id?> .evolution.bdp_blog_template .author.bdp_no_links,
        <?php echo $layout_id?> .evolution.bdp_blog_template .author .link-lable,
        <?php echo $layout_id?> .evolution.bdp_blog_template .date,
        <?php echo $layout_id?> .evolution.bdp_blog_template .comment,
        <?php echo $layout_id?> .evolution.bdp_blog_template .tags.bdp_no_links,
        <?php echo $layout_id?> .evolution.bdp_blog_template .post-category.bdp_no_links,
        <?php echo $layout_id?> .evolution.bdp_blog_template .post-category .link-lable,
        <?php echo $layout_id?> .evolution.bdp_blog_template .bdp-wrapper-like {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .evolution.bdp_blog_template .tags a,
        <?php echo $layout_id?> .evolution.bdp_blog_template .post-category a {
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .evolution.bdp_blog_template .author,
        <?php echo $layout_id?> .evolution.bdp_blog_template .tags,
        <?php echo $layout_id?> .evolution.bdp_blog_template .tags a,
        <?php echo $layout_id?> .evolution.bdp_blog_template .post-category,
        <?php echo $layout_id?> .evolution.bdp_blog_template .post-category a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .evolution .post-category a:hover,
        <?php echo $layout_id?> .evolution .author a:hover,
        <?php echo $layout_id?> .evolution .icon_cnt a:hover,
        <?php echo $layout_id?> .evolution .number-date a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .evolution .blog_header{
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .evolution .blog_header h2 a{
            color: <?php echo $color; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .evolution .blog_header .title .metadate a,
        <?php echo $layout_id?> .evolution .blog_header .title .metadate span.author,
        <?php echo $layout_id?> .evolution .blog_header .title .metadate span.time,
        <?php echo $layout_id?> .evolution .post-bottom .categories,
        <?php echo $layout_id?> .evolution .post-bottom .categories a,
        <?php echo $layout_id?> .evolution .post-category a,
        <?php echo $layout_id?> .evolution .icon_cnt a,
        <?php echo $layout_id?> .evolution .author a,.evolution .number-date a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .evolution.bdp_blog_template {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_archive.evolution .author-avatar-div:before,
        <?php echo $layout_id?> .bdp_archive.evolution .author-avatar-div:after {
            background: <?php echo $contentcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'spektrum') {
        ?>
        <?php echo $layout_id?> .blog_template.bdp_blog_template.spektrum {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .spektrum .post_content,
        <?php echo $layout_id?> .bdp_blog_template.spektrum .label_featured_post span
        {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.spektrum .post-bottom{
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .spektrum .blog_header h2 a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.spektrum .blog_header h2 {
            display: inline;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.spektrum .bdp-post-image .overlay a {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .post-bottom span{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .spektrum .post-meta-div > span .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .spektrum .post-meta-div > span,
        <?php echo $layout_id?> .spektrum .post-meta-div > span a,
        <?php echo $layout_id?> .spektrum .meta_tags span a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .spektrum .post-meta-div > span a:hover,
        <?php echo $layout_id?> .spektrum .meta_tags span a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .spektrum .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .spektrum .details a:hover{
            color :<?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.spektrum a.more-tag,
        <?php echo $layout_id?> .bdp_blog_template.spektrum .label_featured_post span {
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.spektrum a.more-tag:focus,
        <?php echo $layout_id?> .bdp_blog_template.spektrum a.more-tag:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .spektrum .bdp-post-image{
            width:100%;
        }
        <?php echo $layout_id?> .bdp_blog_template.spektrum .date {
            background: <?php echo $titlecolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'hub') {
        ?>
        <?php echo $layout_id?> .blog_template.bdp_blog_template.hub{
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .hub .post_content{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hub .post-bottom{
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .hub .blog_header h2 a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hub .blog_header h2 {
            display: inline;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .post-bottom span,
        <?php echo $layout_id?> .hub .label_featured_post{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .hub .meta_tags span a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .hub .meta_tags span a:hover ,
        <?php echo $layout_id?> .bdp_blog_template.hub a.date:hover{
            color:<?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .hub .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .hub .details a:hover{
            color :<?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.hub a.more-tag,
        <?php echo $layout_id?> .hub .label_featured_post{
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hub a.more-tag:focus,
        <?php echo $layout_id?> .bdp_blog_template.hub a.more-tag:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .hub .bdp-post-image{
            width:100%;
        }
        <?php if (isset($bdp_settings['date_color_of_readmore']) && isset($bdp_settings['date_color_of_readmore']) == 1) { ?>
            <?php echo $layout_id?> .bdp_blog_template.hub a.date{
                color:<?php echo $color; ?>;
                <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            }
        <?php } else { ?>
            <?php echo $layout_id?> .bdp_blog_template.hub .date,
            <?php echo $layout_id?> .hub .number-date {
                background: #212121;
                color:#ffffff;
                <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            }
            <?php
        }
    }
    if ($bdp_theme == 'offer_blog') {
        ?>
        <?php echo $layout_id?> .blog_template.offer_blog.bdp_blog_template {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post_content,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .offer_blog.bdp_blog_template,
        <?php echo $layout_id?> .offer_blog.bdp_blog_template .date,
        <?php echo $layout_id?> .offer_blog.bdp_blog_template .tags,
        <?php echo $layout_id?> .offer_blog .post-entry-meta {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .blog-title-meta h2 a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog h2 a:hover {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog h2 {
            display: inline-block;
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .offer_blog .label_featured_post span{
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .offer_blog.bdp_blog_template span.author,
        <?php echo $layout_id?> .offer_blog.bdp_blog_template span.author i,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category i,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .offer_blog.bdp_blog_template span.author.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-by span,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category a,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .comment a,
        <?php echo $layout_id?> .post-entry-meta a,
        <?php echo $layout_id?> .post_content a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-category a:hover,
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .comment a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-bottom a,
        <?php echo $layout_id?> .offer_blog .label_featured_post span {
            border:1px solid <?php echo $readmorebackcolor; ?>;
            color :<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.offer_blog .post-bottom a:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_archive.offer_blog .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'nicy') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.nicy .entry-meta .up_arrow::after {
            border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy,
        <?php echo $layout_id?> .bdp_blog_template.nicy .entry-container,
        <?php echo $layout_id?> .bdp_blog_template.nicy .entry-meta {
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .blog_header h2 {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .blog_header h2 a {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .blog_header h2 a:hover {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .post_content,
        <?php echo $layout_id?> .bdp_blog_template.nicy .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?>.bdp_archive.nicy .author_content p,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .tags,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .category-link,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .category-link .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.nicy p,
        <?php echo $layout_id?> .bdp_blog_template.nicy .metadatabox {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags {
            border-color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .entry-meta .read-more a,
        <?php echo $layout_id?> .bdp_blog_template.nicy .label_featured_post {
            border-color: <?php echo $readmorebackcolor; ?>;
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .entry-meta .read-more a:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .post_author.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .tags.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.nicy .post-meta-cats-tags .category-link.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.nicy a,
        <?php echo $layout_id?> .bdp_blog_template.nicy .metacomments a,
        <?php echo $layout_id?> .bdp_blog_template.nicy .tags a,
        <?php echo $layout_id?> .bdp_blog_template.nicy .categories a,
        <?php echo $layout_id?> .bdp_blog_template.nicy .category-link a,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a,
        .author-avatar-div.bdp_blog_template .social-component a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .social-component a {
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.nicy .metacomments a:hover,
        <?php echo $layout_id?> .bdp_blog_template.nicy .tags a:hover,
        <?php echo $layout_id?> .bdp_blog_template.nicy .categories a:hover,
        <?php echo $layout_id?> .bdp_blog_template.nicy .category-link a:hover,
        <?php echo $layout_id?> .bdp_blog_template.nicy a:hover,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.nicy .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'winter') {
        ?>
        <?php echo $layout_id?> .winter {
            background-color:<?php echo $background; ?>
        }
        <?php echo $layout_id?> .winter a,
        <?php echo $layout_id?> .winter .tags.bdp_has_links,
        <?php echo $layout_id?> .blog_header .metadatabox .posted_by,
        <?php echo $layout_id?> .winter .blog_header .metadatabox div.tags a,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button span,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .winter a:hover,
        <?php echo $layout_id?> .winter .blog_header .metadatabox > span,
        <?php echo $layout_id?> .winter .blog_header .metadatabox div.tags a:hover,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button:hover span,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .bdp-wrapper-like .bdp-like-button:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .winter .date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .winter .bdp-post-image .category-link a {
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .winter .post_content p,
        <?php echo $layout_id?> .blog_header .metadatabox .posted_by span.auther-inner,
        <?php echo $layout_id?> .winter .datetime,
        <?php echo $layout_id?> .winter .tags,
        <?php echo $layout_id?> .winter .category-link.bdp_no_links,
        <?php echo $layout_id?> .winter .tags,
        <?php echo $layout_id?> .winter .category-link .link-lable,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .posted_by span,
        <?php echo $layout_id?> .winter .blog_header .metadatabox > span{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .winter .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>
        }
        <?php echo $layout_id?> .winter .metacomments i {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .winter .blog_header h2 a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.winter .blog_header h2 {
            display: inline-block;
            background:<?php echo $titlebackcolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .winter .number-date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .winter .post-bottom .post-by span,
        <?php echo $layout_id?> .winter .tags, .winter .category-link,
        <?php echo $layout_id?> .blog_header .metadatabox .posted_by span.auther-inner a,
        <?php echo $layout_id?> .winter .post-bottom .categories a{
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .winter .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.winter a.more-tag{
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.winter a.more-tag:hover{
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter {
            border-bottom: 3px solid;
            border-color: <?php echo $bdp_settings['winter_category_color']; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.winter .metacomments a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.winter .metacomments a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .posted_by span,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .metacomments span,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.winter .metacomments{
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?>.bdp_archive.winter .author-avatar-div {
            background: <?php echo $author_bgcolor; ?>;
        }

        <?php if (isset($bdp_settings['winter_category_color'])) { ?>
            <?php echo $layout_id?> .winter .label_featured_post,
            <?php echo $layout_id?> .winter .bdp-post-image .category-link {
                background-color : <?php echo $bdp_settings['winter_category_color']; ?>;
            }
            <?php echo $layout_id?> .winter .label_featured_post:before,
            <?php echo $layout_id?> .winter .bdp-post-image .category-link:before {
                border-right: 10px solid <?php echo $bdp_settings['winter_category_color']; ?>;
                opacity: 0.65;
            }
            <?php
        }
    }
    if ($bdp_theme == 'region') {
        ?>
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region .blog_footer {
            background:<?php echo $background; ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region.alternative-back,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region.alternative-back .blog_footer {
            background:<?php echo $alterbackground; ?>
        }
        <?php echo $layout_id?> .region .date,
        <?php echo $layout_id?> .region .number-date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .region .post_content,
        <?php echo $layout_id?> .region .post_content p,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region .label_featured_post{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .region .category-link,
        <?php echo $layout_id?> .region .category-link .link-lable,
        <?php echo $layout_id?> .region .tags,
        <?php echo $layout_id?> .region .tags .link-lable,
        <?php echo $layout_id?> .region .posted_by,
        <?php echo $layout_id?> .region .posted_by .author-meta,
        <?php echo $layout_id?> .region .posted_by .author-meta .link-lable,
        <?php echo $layout_id?> .region .metadatabox .article_comments,
        <?php echo $layout_id?> .region .metadatabox .bdp-wrapper-like{
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .region .blog_header h2 a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .region .blog_header h2 a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.region .blog_header h2{
            display: inline-block;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .region .category-link.bdp_has_links,
        <?php echo $layout_id?> .region .tags.bdp_has_links,
        <?php echo $layout_id?> .region .posted_by .author-meta.bdp_has_links,
        <?php echo $layout_id?> .region .post-bottom .post-by span,
        <?php echo $layout_id?> .region .post-bottom .categories a,
        <?php echo $layout_id?> .region .category-link a,
        <?php echo $layout_id?> .region .tags a,
        <?php echo $layout_id?> .region .posted_by a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .region .post-bottom .categories a:hover,
        <?php echo $layout_id?> .region .category-link a:hover,
        <?php echo $layout_id?> .region .tags a:hover,
        <?php echo $layout_id?> .region .posted_by a:hover,
        <?php echo $layout_id?> .bdp_blog_template .metacomments a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .region .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.region a.more-tag,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.region .label_featured_post {
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
            border: 1px solid <?php echo $readmorebackcolor; ?>;
            transition: 0.2s all;
            -ms-transition: 0.2s all;
            -o-transition: 0.2s all;
            -webkit-transition: 0.2s all;
        }
        <?php echo $layout_id?> .bdp_blog_template.region a.more-tag:hover{
            background: <?php echo $readmorehoverbackcolor; ?>;
            border: 1px solid <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.region .bdp-post-image{
            padding: 0 40px;
        }
        <?php echo $layout_id?>.bdp_archive.region .author-avatar-div {
            background: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'glossary') {
        ?>
        <?php echo $layout_id?> .blog_template.glossary .blog_item {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .glossary .post_content p{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .glossary .post_summary_outer .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            background: <?php echo $background; ?>;
            color: <?php echo $color; ?>;
            border-color: <?php echo $bdp_settings['template_content_hovercolor'] ?>;
        }
        <?php echo $layout_id?> .glossary .blog_header h2 a,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author{
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.glossary .blog_header h2{
            display: block;
            background: <?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.glossary .blog_header h2 a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .glossary .number-date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .glossary .post-bottom .post-by span,
        <?php echo $layout_id?> .glossary .footer_meta .category-link a,
        <?php echo $layout_id?> .glossary .footer_meta .tags a,
        <?php echo $layout_id?> .glossary .post-author a,.glossary .comment a,.glossary .posted_by a,
        <?php echo $layout_id?> .glossary .bdp_blog_template .social-component a ,
        <?php echo $layout_id?> .glossary .posted_by a .datetime {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .glossary .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.glossary a.more-tag{
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
            opacity: 0.9;
        }
        <?php echo $layout_id?> .bdp_blog_template.glossary a.more-tag:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .glossary .post_content-inner {
            border-color: <?php echo $bdp_settings['template_content_hovercolor'] ?>;
        }
        <?php echo $layout_id?> .bdp-load-more a.button.bdp-load-more-btn {
            border-color:<?php echo $readmorebackcolor; ?>
        }
        <?php echo $layout_id?> .glossary .footer_meta .category-link.bdp_no_links,
        <?php echo $layout_id?> .glossary .footer_meta .category-link .link-lable,
        <?php echo $layout_id?> .glossary .posted_by .datetime,
        <?php echo $layout_id?> .glossary .footer_meta .tags.bdp_no_links,
        <?php echo $layout_id?> .glossary .footer_meta .tags .link-lable,
        <?php echo $layout_id?> .glossary .posted_by .post-author.bdp_no_links,
        <?php echo $layout_id?> .glossary .posted_by .post-author .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .glossary .footer_meta .category-link,
        <?php echo $layout_id?> .glossary .footer_meta .tags,
        <?php echo $layout_id?> .glossary .posted_by .post-author {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .glossary .footer_meta .category-link a:hover,
        <?php echo $layout_id?> .glossary .footer_meta .tags a:hover,
        <?php echo $layout_id?> .glossary .post-author a:hover,.glossary .comment a:hover,
        <?php echo $layout_id?> .glossary .posted_by a:hover,
        <?php echo $layout_id?> .glossary .posted_by a:hover .datetime{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .glossary .comment{
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.glossary .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .glossary div.post-content .post_content-inner > *:first-child:first-letter,
            <?php echo $layout_id?> .glossary div.post-content .post_content-inner> p:first-child:first-letter,
            <?php echo $layout_id?> .glossary div.post-content .post_content-inner:first-letter,
            <?php echo $layout_id?> .glossary div.post_content .post_content-inner > *:first-child:first-letter,
            <?php echo $layout_id?> .glossary div.post_content .post_content-inner> p:first-child:first-letter {
                <?php if ($firstletter_font_family) { ?> font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: left;
                margin-right:5px;
            }
        <?php } ?>
        <?php
    }
    if ($bdp_theme == 'boxy') {
        ?>
        <?php echo $layout_id?> .blog_template.boxy .post_hentry{
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .boxy .post_content p,
        <?php echo $layout_id?> .post_content-inner{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .boxy .blog_header h2 a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            padding: 0;
        }
        <?php echo $layout_id?> .bdp_blog_template.boxy .blog_header h2{
            color: <?php echo $titlecolor; ?>;
            display: inline-block;
            background: <?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .boxy .number-date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .boxy .post-bottom .post-by span,
        <?php echo $layout_id?> .boxy .footer_meta .category-link a,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link a,
        <?php echo $layout_id?> .boxy .author a,
        <?php echo $layout_id?> .boxy .post-metadata > span.author,
        <?php echo $layout_id?> .boxy .post-metadata > span a.comments-link,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a,
        <?php echo $layout_id?> .boxy .post-metadata .post-date a,
        <?php echo $layout_id?> .boxy .post-metadata .post-date a span,
        <?php echo $layout_id?> .bdp_blog_template.boxy .social-component a,
        <?php echo $layout_id?> .bdp_blog_template .blog_footer .footer_meta .tags a,
        <?php echo $layout_id?> .post-metadata span.author a,
        <?php echo $layout_id?> .post-metadata > span.post-date a,
        <?php echo $layout_id?> .post-metadata .post-comment a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .category-link a:hover,
        <?php echo $layout_id?> .bdp_blog_template .tags a:hover,
        <?php echo $layout_id?> .boxy .footer_meta .category-link a:hover,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a:hover,
        <?php echo $layout_id?> .boxy .footer_meta .category-link a:hover,
        <?php echo $layout_id?> .boxy .post-metadata .post-date a:hover span,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link a:hover,
        <?php echo $layout_id?> .bdp_blog_template .blog_footer .footer_meta .tags a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .boxy .blog_header h2 a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .boxy .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.boxy a.more-tag,
        <?php echo $layout_id?> .bdp_blog_template.boxy a.more-tag i,
        <?php echo $layout_id?> .boxy .label_featured_post span {
            color: <?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy .read-more a.more-tag:hover,
        <?php echo $layout_id?> .blog_template.boxy .read-more a.more-tag:hover i {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy .footer_meta .tags a,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link a{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy .footer_meta .tags,
        <?php echo $layout_id?> .boxy .label_featured_post span,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link {
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .blog_template.boxy .footer_meta .tags,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy .footer_meta .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.boxy .post-category span.category-link.categories_link,
        <?php echo $layout_id?> .blog_template.boxy .footer_meta .tags.tag_link {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .boxy .post-metadata > span.bdp-no-kink {
            color: #fff;
        }
        <?php
    }
    if ($bdp_theme == 'boxy-clean') {
        ?>
        <?php echo $layout_id?> .blog_template.boxy-clean ul li {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.boxy-clean .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean ul li:hover,
        <?php echo $layout_id?>.bdp_archive.boxy-clean .author-avatar-div:hover,
        <?php echo $layout_id?> .blog_template.boxy-clean ul li:hover .blog_header h2 {
            background: <?php echo $template_bghovercolor; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .date,
        <?php echo $layout_id?> .boxy-clean .number-date {
            color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .footer_meta .tags a,
        <?php echo $layout_id?> .boxy-clean .footer_meta .category-link a,
        <?php echo $layout_id?> .boxy-clean .post-bottom .post-by span,
        <?php echo $layout_id?> .boxy-clean a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .post_content{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
         <?php echo $layout_id?> .blog_template.boxy-clean .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .blog_header h2 {
            background: <?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .boxy-clean .blog_header h2 a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
        }
        <?php echo $layout_id?>.bdp_archive.blog_template.boxy-clean .author_content .author {
            color: <?php echo $author_titlecolor; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .blog_header h2 a:hover {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .boxy-clean .footer_meta .tags a:hover,
        <?php echo $layout_id?> .boxy-clean .footer_meta .category-link a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .blog_wrap.bdp_blog_template .author,
        <?php echo $layout_id?> .blog_template.boxy-clean .label_featured_post span {
            background:<?php echo $templatecolor; ?>
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .blog_wrap.bdp_blog_template .author:hover {
            background:<?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.boxy-clean .blog_header h2 {
            display: inline-block;
        }
        <?php echo $layout_id?> .boxy-clean .details a {
            color :<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.boxy-clean a.more-tag{
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .read-more a.more-tag{
            color: <?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .read-more a.more-tag:hover{
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .tags,
        <?php echo $layout_id?> .blog_template.boxy-clean .category-link {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .tags .link-lable,
        <?php echo $layout_id?> .blog_template.boxy-clean .category-link .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.boxy-clean .tags.tag_link,
        <?php echo $layout_id?> .blog_template.boxy-clean .category-link.categories_link {
            color: <?php echo $contentcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'news') {
        ?>
        <?php echo $layout_id?> .news.bdp_blog_template {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .news.bdp_blog_template a span,
        <?php echo $layout_id?> .news.bdp_blog_template a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .news.bdp_blog_template a span:hover,
        <?php echo $layout_id?> .news.bdp_blog_template a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .news.bdp_blog_template h2 {
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .news.bdp_blog_template h2 a{
            color: <?php echo $titlecolor; ?>;
            background: <?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.news .entry-title a,
        <?php echo $layout_id?> .bdp_blog_template.news h2.post-title a,
        <?php echo $layout_id?> .bdp_archive.news .author_div li.active{
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.news .entry-title a:hover,
        <?php echo $layout_id?> .bdp_blog_template.news h2.post-title a:hover,
        <?php echo $layout_id?> .news.bdp_blog_template h2 a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .news.bdp_blog_template.alternative-back{
            background: <?php echo $alterbackground; ?>;
        }
        <?php echo $layout_id?> .news .post-content,
        <?php echo $layout_id?> .bdp_blog_template.news .post-thumbnail-div .label_featured_post{
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .news.bdp_blog_template .post-bottom a:hover{
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .news.bdp_blog_template .post-bottom a,
        <?php echo $layout_id?> .bdp_blog_template.news .post-thumbnail-div .label_featured_post {
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            padding:5px 15px;
            border:none;
        }
        <?php echo $layout_id?> .news .post-category,
        <?php echo $layout_id?> .news .tags,
        <?php echo $layout_id?> .news .metacomments {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .news .post-category .link-lable,
        <?php echo $layout_id?> .news .post-category i,
        <?php echo $layout_id?> .news .tags i,
        <?php echo $layout_id?> .news .mdate,
        <?php echo $layout_id?> .news .post-author {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .news .mdate,
        <?php echo $layout_id?> .news .post-author,
        <?php echo $layout_id?> .news .metacomments,
        <?php echo $layout_id?> .news.bdp_blog_template .post-bottom a{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .news .post-author.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.news .metacomments a,
        <?php echo $layout_id?> .deport .metadatabox a span.bdp-count,
        <?php echo $layout_id?> .bdp_blog_template.news .tags a,
        <?php echo $layout_id?> .news .tags.bdp_has_link,
        <?php echo $layout_id?> .news .post-category.bdp_has_link,
        <?php echo $layout_id?> .bdp_blog_template.news .categories a,
        <?php echo $layout_id?> .bdp_blog_template .category-link a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.news .tags a:hover,
        <?php echo $layout_id?> .bdp_blog_template.news .metacomments a:hover,
        <?php echo $layout_id?> .bdp_blog_template.news .categories a:hover,
        <?php echo $layout_id?> .bdp_blog_template .category-link a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.news .author_div ul.nav-tabs li.active,
        <?php echo $layout_id?>.bdp_archive.news .author_div .tab-content {
            background: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'deport') {
        ?>
        <?php echo $layout_id?> .deport a{
            color: <?php echo $color; ?>;
            box-shadow:none;
        }
        <?php echo $layout_id?> .deport .deport-wrap .deport-title-area .post-title,
        <?php echo $layout_id?> .deport .deport-wrap .deport-title-area .post-title a {
            color: <?php echo $titlecolor; ?>;
            background: <?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .deport .deport-wrap .deport-title-area .post-title a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.deport .tags a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.deport .tags a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .deport .post_content {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .deport.bdp_blog_template .read-more-div a:hover{
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .deport.bdp_blog_template .read-more-div a {
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.deport .label_featured_post{
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .deport .deport-wrap .deport-title-area::after{
            background:<?php if (isset($bdp_settings['deport_dashcolor'])) echo $bdp_settings['deport_dashcolor']; ?> !important;
        }
        <?php echo $layout_id?> .deport .metadatabox span.author.bdp_no_link,
        <?php echo $layout_id?> .deport .metadatabox span {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .deport .metadatabox .custom-categories,
        <?php echo $layout_id?> .deport .metadatabox .custom-categories span.seperater,
        <?php echo $layout_id?> .deport .metadatabox span.author {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .deport .metadatabox span i,
        <?php echo $layout_id?> .deport .metadatabox span.tags i,
        <?php echo $layout_id?> .deport .metadatabox span.tags.tag_link,
        <?php echo $layout_id?> .deport .metadatabox .custom-categories.bdp-no-links,
        <?php echo $layout_id?> .deport .metadatabox .custom-categories.bdp-no-links span,
        <?php echo $layout_id?> .deport .metadatabox .custom-categories .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .deport .metadatabox span.tags {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.deport .deport-title-area{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .deport.even_class .post_content::first-letter{
            line-height: <?php echo $firstletter_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_archive.deport .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.deport .author-avatar-div .author_content p {
            color: <?php echo $author_content_color; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'navia') {
        ?>
        <?php echo $layout_id?> .navia .navia-content-wrap span.metacomments a:hover{
            color: <?php echo $linkhovercolor ?>;
        }
        <?php echo $layout_id?> .navia a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .navia .post-title{
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .navia .post-title a{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .navia .post_content ,.bdp_archive .navia .post_content{
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .navia .more-tag{
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.navia .author-avatar-div .author_content .author {
            color: <?php echo $author_titlecolor; ?>;
        }
        <?php echo $layout_id?> .navia.bdp_blog_template .mdate{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .blog_template.navia .post-metadata,
        <?php echo $layout_id?> .blog_template.navia .post-content-area .tags.bdp_no_links,
        <?php echo $layout_id?> .navia .navia-content-wrap .post-metadata .bdp_no_links,
        <?php echo $layout_id?> .blog_template.navia .post-content-area .tags i,
        <?php echo $layout_id?> .blog_template.navia .post-content-area .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.navia .bdp-post-image {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .navia .navia-content-wrap .post-metadata .bdp_has_links,
        <?php echo $layout_id?> .blog_template.navia .post-content-area .tags {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.navia .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.navia .post_content a.more-tag,
        <?php echo $layout_id?> .bdp_blog_template.navia .bdp-post-image .label_featured_post {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorebackcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.navia .post_content a.more-tag:hover {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorehoverbackcolor; ?>;
            border-color: <?php echo $readmorehoverbackcolor; ?>;
        }

        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .navia.bdp_blog_template div.post_content > *:first-child:first-letter,
            <?php echo $layout_id?> .navia.bdp_blog_template .post_content:first-letter {
                <?php if ($firstletter_font_family) { ?>  font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: none;
                margin-right:0;
                line-height: 0;
            }
            <?php echo $layout_id?> .navia.bdp_blog_template div.post_content {
                margin-top: <?php echo ($firstletter_fontsize / 2), 'px'; ?>;
            }
        <?php } ?>
        <?php
    }
    if ($bdp_theme == 'invert-grid') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .tags,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-author,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-body-div h2 a{
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-body-div h2 a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-body-div h2{
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post_content{
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
        }
         <?php echo $layout_id?> .bdp_blog_template.invert-grid .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .metadatabox {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-author .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .post-author.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .tags.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .tags i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .category-link a,
        <?php echo $layout_id?> .invert-grid .read-more > span{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .invert-grid .read-more > span{
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .invert-grid .read-more > span:hover{
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .category-link,
        <?php echo $layout_id?> .bdp_blog_template.invert-grid .label_featured_post {
            background: <?php echo $color; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.invert-grid .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'brit_co') {
        ?>
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category a,
        <?php echo $layout_id?> .brit_co .bdp_blog_template a,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .social-component .social-share .count,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a {
            color:<?php echo $color; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .tags {
            color:<?php echo $color; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category i,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category.bdp-no-links,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category .link-lable,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .tags i,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .tags.bdp-no-links {
            color: <?php echo $titlecolor; ?>
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template a:hover,
        <?php echo $layout_id?> .brit_co .bdp_blog_template .post-category a:hover,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a:hover {
            color:<?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .read_more_text a{
            background: <?php echo $readmorebackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .read_more_text a:hover{
            background: <?php echo $readmorecolor; ?>;
            color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template:hover .bdp_blog_wraper,
        <?php echo $layout_id?> .bdp_blog_template.britco:hover .label_featured_post{
            border-color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .comment a{
            color:<?php echo $color; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .comment a:hover{
            color:<?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .content_wrapper h2.post-title{
            background: <?php echo $titlebackcolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.brit_co .author_content .author {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .brit_co .bdp_blog_template .social-component a {
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.brit_co .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.britco .label_featured_post {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }

        <?php
    }
    if ($bdp_theme == 'media-grid') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.media-grid a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid a:hover,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .category-link a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .post-body-div h2.post-title a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .post-body-div h2.post-title a:hover,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .post-body-div h2.post-title a:focus {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.media-grid .author_content .author {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .post-body-div h2.post-title {
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .post_content {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .bdp-post-image .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .bdp-post-image .category-link a {
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .read-more > a {
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .read-more > a:hover {
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .bdp-post-image .category-link,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .bdp-post-image .label_featured_post {
            background: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .metadatabox span.metacomments i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.media-grid .author-avatar-div .avtar-img a::before {
            background: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .metadatabox,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .metadatabox .tags.bdp_no_links {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .taxonomies.bdp_no_links,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .taxonomies .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.media-grid .metadatabox .tags i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .metadatabox .tags {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.media-grid .content-inner {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.media-grid .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'timeline') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::before,
        <?php echo $layout_id?> .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::after {
            border-right-color : <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .timeline.blog-wrap .datetime,
        <?php echo $layout_id?> .timeline_bg_wrap:before {
            background: none repeat scroll 0 0 <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .timeline_year span.year_wrap {
            background: none repeat scroll 0 0 <?php echo $displaydate_backcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .post_hentry:before,
        <?php echo $layout_id?> .blog_template.timeline .timeline_bg_wrap:before{
            background:<?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
            border-left: 8px solid <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
            border-right: 8px solid <?php echo $templatecolor; ?>;
        }
        /* left side design */
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
            border-right: 8px solid <?php echo $templatecolor; ?>;
            border-left: none;
        }
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
            border-right: 8px solid <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::before,
        <?php echo $layout_id?> .timeline_bg_wrap.right_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::after {
            border-left-color : <?php echo $templatecolor; ?>;
        }
        /* right side design */
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:after {
            border-left: 8px solid <?php echo $templatecolor; ?>;
            border-right: none;
        }
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before,
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .blog_template.bdp_blog_template.timeline.blog-wrap.even_class .post_content_wrap:after {
            border-left: 8px solid <?php echo $templatecolor; ?>;
            border-right: none;
        }
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::before,
        <?php echo $layout_id?> .timeline_bg_wrap.left_side .bdp_blog_template.timeline.blog-wrap.odd_class .post_content_wrap::after {
            border-right-color : <?php echo $templatecolor; ?>;
        }

        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .post_content_wrap {
            border:1px solid <?php echo $templatecolor; ?>;
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .post_content_wrap .blog_footer,
        <?php echo $layout_id?>.bdp_archive.timeline .author-avatar-div .avtar-img img.avatar{
            border-top: 1px solid <?php echo $templatecolor; ?> ;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .read_more a.btn-more,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .label_featured_post span{
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .label_featured_post span{
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .post-icon {
            background:<?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by.bdp_has_links,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by a,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .categories.bdp_has_links,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .tags.bdp_has_links,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .tags a,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .categories a {
            color:<?php echo $color; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by a:hover,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .tags a:hover,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .categories a:hover {
            color:<?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .desc h3 {
            color:<?php echo $titlecolor; ?>;
            background:<?php echo $titlebackcolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            margin: 0;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .desc h3:hover a {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .desc h3 a{
            color:<?php echo $titlecolor; ?>;
            font-size:  <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author{
            color:<?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .timeline a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .timeline a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .tags,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .tags .link-lable,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .categories,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .categories .link-lable,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .post_content {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?>.bdp_archive.timeline .author-avatar-div{
            border: 1px solid <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline.blog-wrap .date_wrap .posted_by i,
        <?php echo $layout_id?> .blog_footer span,.date_wrap{
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.timeline .read_more a.btn-more:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
            border: 1px solid <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'cool_horizontal') {
        ?>
        <?php echo $layout_id?> .horizontal .post-title {
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .horizontal .post-title > a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .horizontal .post-title > a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .logbook.flatLine .lb-node-desc span,
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node:after,
        <?php echo $layout_id?> .logbook.flatLine .lb-item.lb-node-hover:before,
        <?php echo $layout_id?> #content .logbook.flatLine .lb-item.lb-node-hover:before,
        <?php echo $layout_id?> #content .logbook.flatLine .lb-node-desc span,
        <?php echo $layout_id?> #content .logbook.flatLine a.lb-line-node:after{
            background-color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node.active:after,
        <?php echo $layout_id?> #content .logbook.flatLine a.lb-line-node.active:after  {
            border-color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine .lb-item.lb-node-hover:after,
        <?php echo $layout_id?> #content .logbook.flatLine .lb-item.lb-node-hover:after {
            border-top-color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node.active,
        <?php echo $layout_id?> #content .logbook.flatLine a.lb-line-node.active {
            color: <?php echo $titlehovercolor; ?>
        }

        <?php echo $layout_id?> .horizontal .blog_footer .tags,
        <?php echo $layout_id?> .horizontal .blog_footer .categories {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .horizontal .mauthor.bdp_no_link,
        <?php echo $layout_id?> .horizontal .bdp_no_link i,
        <?php echo $layout_id?> .horizontal .blog_footer .tags,
        <?php echo $layout_id?> .horizontal .blog_footer .tags .link-lable,
        <?php echo $layout_id?> .horizontal .blog_footer .categories .link-lable,
        <?php echo $layout_id?> .horizontal .blog_footer .categories.categories_link {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .horizontal a,
        <?php echo $layout_id?> .horizontal .post-title .mdate a,
        <?php echo $layout_id?> .horizontal .post-title .mdate i,
        <?php echo $layout_id?> .horizontal .blog_footer .tags.tag_link,
        <?php echo $layout_id?> .horizontal .blog_footer .tags a,
        <?php echo $layout_id?> .horizontal .blog_footer .categories a,
        <?php echo $layout_id?> .horizontal .mauthor,
        <?php echo $layout_id?> .horizontal.mdate i,
        <?php echo $layout_id?> .horizontal.mauthor i,
        <?php echo $layout_id?> .horizontal.mcomments i{
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .horizontal a:hover,
        <?php echo $layout_id?> .horizontal .post-title .mdate a:hover,
        <?php echo $layout_id?> .horizontal .blog_footer .tags a:hover,
        <?php echo $layout_id?> .horizontal .blog_footer .categories a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .horizontal .post-title .mdate a{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>;  <?php } ?>
        }
        <?php echo $layout_id?> .mdate i,
        <?php echo $layout_id?> .mauthor i,
        <?php echo $layout_id?> .mcomments i,
        <?php echo $layout_id?> .tags i,
        <?php echo $layout_id?> .categories i {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .horizontal .post-title .mdate,
        <?php echo $layout_id?> .horizontal .metadatabox,
        <?php echo $layout_id?> .horizontal .blog_footer {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .horizontal .post-content-area .post_content {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>;  <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .horizontal .read-more-div a.more-tag {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .horizontal .read-more-div a.more-tag:hover {
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> #content .logbook .lb-node-desc > span:after {
            border-color: #dd5555 transparent transparent;
        }
        <?php echo $layout_id?> .bdp_blog_template.horizontal .post_content,
        <?php echo $layout_id?> .bdp_blog_template.horizontal .post_content p{
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .horizontal .label_featured_post span {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>;  <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php
    }
    if ($bdp_theme == 'overlay_horizontal') {
        ?>
        <?php echo $layout_id?> .overlay_horizontal .post-content-area .post-title{
            padding: 0 2px;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .overlay_horizontal .post-title a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .overlay_horizontal .post-title a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .overlay_horizontal .post-content-area .post_content {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal .read-more-div a.more-tag {
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal .read-more-div a.more-tag:hover {
            color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal a,
        <?php echo $layout_id?> .overlay_horizontal .post-title .mdate a,
        <?php echo $layout_id?> .overlay_horizontal .blog_footer .tags a,
        <?php echo $layout_id?> .overlay_horizontal .blog_footer .categories a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal .post-content-area .blog_footer .categories,
        <?php echo $layout_id?> .overlay_horizontal .post-content-area .blog_footer .tags {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal a:hover,
        <?php echo $layout_id?> .overlay_horizontal .post-title .mdate a:hover,
        <?php echo $layout_id?> .overlay_horizontal .blog_footer .tags a:hover,
        <?php echo $layout_id?> .overlay_horizontal .blog_footer .categories a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node.active, #content .logbook.flatLine a.lb-line-node.active{
            color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine .lb-item.lb-node-hover::after, #content .logbook.flatLine .lb-item.lb-node-hover::after{
            border-color: <?php echo $templatecolor; ?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
        }
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node.active::after, #content .logbook.flatLine a.lb-line-node.active::after{
            border-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .logbook.flatLine .lb-node-desc span, #content .logbook.flatLine .lb-node-desc span,
        <?php echo $layout_id?> .logbook.flatLine .lb-item.lb-node-hover::before, #content .logbook.flatLine .lb-item.lb-node-hover::before,
        <?php echo $layout_id?> .logbook.flatLine a.lb-line-node::after, #content .logbook.flatLine a.lb-line-node::after{
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .overlay_horizontal .post_content_wrap .label_featured_post {
            background: <?php echo $templatecolor; ?>;
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>;  <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php
    }
    if ($bdp_theme == 'story') {
        ?>
        <?php echo $layout_id?> .story .blog_header{
            background: <?php echo $titlebackcolor; ?>;
            line-height: 1.5;
            padding: 0 2px;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .story .blog_header,
        <?php echo $layout_id?> .story .blog_header a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .story .blog_header a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .story .read-more a.more-tag {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .story .read-more a.more-tag:hover {
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .story .blog_footer,
        <?php echo $layout_id?> .story .post_content,
        <?php echo $layout_id?> .story .post-metadata,
        <?php echo $layout_id?> .story .footer_meta .tags .link-lable,
        <?php echo $layout_id?> .story .footer_meta .category-link .link-lable {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .story .blog_template .social-component a {
            color: <?php echo $contentcolor; ?>;
            border-color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .story a,
        <?php echo $layout_id?> .story .post-metadata .author-inner,
        <?php echo $layout_id?> .story .post-media a,
        <?php echo $layout_id?> .story .footer_meta .tags a,
        <?php echo $layout_id?> .story .footer_meta .tags.bdp_has_links,
        <?php echo $layout_id?> .story .footer_meta .category-link.bdp_has_links,
        <?php echo $layout_id?> .story .footer_meta .category-link a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .story a:hover,
        <?php echo $layout_id?> .story .post-media a:hover,
        <?php echo $layout_id?> .story .footer_meta .tags a:hover,
        <?php echo $layout_id?> .story .footer_meta .category-link a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .story .line-col-bottom-secound,
        <?php echo $layout_id?> .story .date-icon-left {
            background : <?php echo $template_alternative_color; ?>;
        }
        <?php echo $layout_id?> .story .entity-content-right .label_featured_post,
        <?php echo $layout_id?> .story .entity-content-left .label_featured_post {
            background : <?php echo $template_alternative_color; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .story .line-col-top,
        <?php echo $layout_id?> .story .date-icon-rights {
            background : <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .story .line-col-left {
            border-color: <?php echo $template_alternative_color; ?>;
        }
        <?php echo $layout_id?> .story .line-col-right {
            border-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .story .date-icon-rights.date-icon-arrow-bottom:after {
            border-top-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .story .date-icon-left.date-icon-arrow-bottom:after {
            border-top-color: <?php echo $template_alternative_color; ?>;
        }
        <?php echo $layout_id?> .startup{
            background: <?php echo $story_startup_background; ?>;
            color: <?php echo $story_startup_text_color; ?>;
        }
        <?php echo $layout_id?> .startup.ending{
            background: <?php echo $story_ending_background; ?>;
            color: <?php echo $story_ending_text_color; ?>;
        }
        <?php echo $layout_id?> .story .date-icon-arrow-bottom::before {
            border-top-color: <?php echo $story_startup_border_color; ?>
        }
        <?php echo $layout_id?> .story .startup,
        <?php echo $layout_id?> .story .date-icon,
        <?php echo $layout_id?> .story .blog_post_wrap .post-media img {
            border-color: <?php echo $story_startup_border_color; ?>
        }
        <?php echo $layout_id?> .story .dote span {
            background-color: <?php echo $story_startup_border_color; ?>
        }

        <?php
    }
    if ($bdp_theme == 'easy_timeline') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template .easy-timeline > li{
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post-title{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post-title a {
            background-color: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post-title a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post_content {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .comment-count-inner,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .author-inner,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .date-inner,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .metadatabox span,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .categories .link-lable,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .categories .bdp_no_links,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .tags .link-lable,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .tags.bdp_no_links {
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .read-more-div a.more-tag {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .read-more-div a.more-tag:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline a,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post-title .mdate a,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .metadatabox span.bdp_has_links,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .tags,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .blog_footer .tags a,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .categories,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .blog_footer .categories a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .label_featured_post span {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline a:hover,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .post-title .mdate a:hover,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .blog_footer .tags a:hover,
        <?php echo $layout_id?> .easy-timeline-wrapper .easy-timeline .blog_footer .categories a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline > li{
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .easy-timeline .mdate i,
        <?php echo $layout_id?> .easy-timeline .metadatabox span i,
        <?php echo $layout_id?> .easy-timeline .comments-link,
        <?php echo $layout_id?> .easy-timeline .category {
            color: <?php echo $contentcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'explore') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .post-title,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .post-title a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .label_featured_post {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .grid-overlay,
        <?php echo $layout_id?> .bdp_blog_template.explore .label_featured_post {
            background: <?php echo bdp_hex2rgba($grid_hoverback_color, 0.5); ?> none repeat scroll 0 0;
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .post-title a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header a,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header i,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .tags,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .post-comment,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .metabox-top,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .category-link,
        <?php echo $layout_id?> .bdp_blog_template.explore .comments-link,
        <?php echo $layout_id?> .bdp_blog_template.explore .label_featured_post {
            color: <?php echo $color; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header a:hover,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header a:hover i {
            color: <?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .read-more-div a.more-tag {
            color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .read-more-div a.more-tag:hover,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header .read-more-div a.more-tag:focus {
            color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.explore.large-col,
        <?php echo $layout_id?> .bdp_blog_template.explore.small-col{
            padding-left:<?php echo ($grid_col_space / 2) . 'px'; ?>;
            padding-right:<?php echo ($grid_col_space / 2) . 'px'; ?>;
            padding-bottom:<?php echo $grid_col_space . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.explore .bdp-grid-row{
            margin-left:-<?php echo ($grid_col_space / 2) . 'px'; ?>;
            margin-right:-<?php echo ($grid_col_space / 2) . 'px'; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'hoverbic') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header .post-title{
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header .post-title a {
            color: <?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .label_featured_post {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header .post-title a:hover {
            color: <?php echo $titlehovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .label_featured_post {
            background: <?php echo $grid_hoverback_color != '' ? bdp_hex2rgba($grid_hoverback_color, 0.8) : 'transparent'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header a,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header i,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header .tags,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header .category-link,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .comments-link,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .author,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .label_featured_post {
            color: <?php echo $color; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic .blog_header a:hover,
        <?php echo $layout_id?> .bdp_blog_template.explore .blog_header a:hover i{
            color: <?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.hoverbic.small-col,
        <?php echo $layout_id?> .bdp_blog_template.hoverbic.full-col {
            padding-left:<?php echo ($grid_col_space / 2) . 'px'; ?>;
            padding-right:<?php echo ($grid_col_space / 2) . 'px'; ?>;
            padding-bottom:<?php echo $grid_col_space . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp-grid-row{
            margin-left:-<?php echo ($grid_col_space / 2) . 'px'; ?>;
            margin-right:-<?php echo ($grid_col_space / 2) . 'px'; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'my_diary') {
        ?>
        <?php echo $layout_id?> .my_diary_wrapper:before {
            background-color: <?php echo $background; ?>;
            opacity: 0.03;
        }
        <?php echo $layout_id?> .diary-post.bdp_blog_template div.post_content,
        <?php echo $layout_id?> .diary-post .diary-thumb .label_featured_post {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>;  <?php } ?>
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .categories,
        <?php echo $layout_id?> .diary-posthead .metadatabox,
        <?php echo $layout_id?> .diary_postfooter .post-comment,
        <?php echo $layout_id?> .diary_postfooter .tags {
            font-size: <?php echo $content_fontsize - 2; ?>px;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .categories span,
        <?php echo $layout_id?> .metadatabox div span,
        <?php echo $layout_id?> .diary_postfooter .post-comment i,
        <?php echo $layout_id?> .diary_postfooter .tags i {
            font-size: <?php echo $content_fontsize; ?>px;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .categories.bdp_has_links,
        <?php echo $layout_id?> .diary-posthead .categories .seperater,
        <?php echo $layout_id?> .diary-posthead .categories a,
        <?php echo $layout_id?> .diary-posthead .metadatabox a,
        <?php echo $layout_id?> .diary-posthead .metadatabox .mauthor.bdp_has_links,
        <?php echo $layout_id?> .diary_postfooter .post-comment a,
        <?php echo $layout_id?> .diary_postfooter .tags.bdp_has_links,
        <?php echo $layout_id?> .diary_postfooter .tags a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .categories a:hover,
        <?php echo $layout_id?> .diary-posthead .categories a:focus,
        <?php echo $layout_id?> .diary-posthead .metadatabox a:hover,
        <?php echo $layout_id?> .diary-posthead .metadatabox a:focus,
        <?php echo $layout_id?> .diary_postfooter .post-comment a:hover,
        <?php echo $layout_id?> .diary_postfooter .post-comment a:focus,
        <?php echo $layout_id?> .diary_postfooter .tags a:hover,
        <?php echo $layout_id?> .diary_postfooter .tags a:focus {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .post-title {
            font-size: <?php echo $template_titlefontsize; ?>px;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .diary-post .diary-thumb .label_featured_post {
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .diary-posthead .post-title a:before,
        <?php echo $layout_id?> .diary-posthead .post-title a:after {
            background-color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .post-title,
        <?php echo $layout_id?> .diary-posthead .post-title a {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .diary-posthead .post-title a:hover,
        <?php echo $layout_id?> .diary-posthead .post-title a:focus {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .diary-postcontent:before {
            border-color: <?php echo bdp_hex2rgba($contentcolor, 0.5) ?>;
            color: <?php echo bdp_hex2rgba($contentcolor, 0.5) ?>;
        }
        <?php echo $layout_id?> .diary-post.bdp_blog_template .social-component a {
            border-color: <?php echo bdp_hex2rgba($contentcolor, 0.5) ?>;
            color: <?php echo bdp_hex2rgba($contentcolor, 0.5) ?>;
        }
        <?php echo $layout_id?> .diary-post .read-more-div .more-tag,
        <?php echo $layout_id?> .diary-post .diary-thumb .label_featured_post {
            color: <?php echo $readmorecolor; ?>;
            background-color: <?php echo $readmorebackcolor; ?>;
            border-color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .read-more-div .more-tag:hover,
        <?php echo $layout_id?> .read-more-div .more-tag:focus {
            background-color: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .diary_postfooter {
            border-color: <?php echo bdp_hex2rgba($readmorebackcolor, 0.3) ?>;
        }
        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .diary-post.bdp_blog_template div.post_content > *:first-child:first-letter,
            <?php echo $layout_id?> .diary-post.bdp_blog_template .post_content:first-letter {
                <?php if ($firstletter_font_family) { ?> font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: none;
                margin-right:5px;
                line-height: 0;
            }
            <?php echo $layout_id?> .diary-post.bdp_blog_template div.post_content {
                margin-top: <?php echo ($firstletter_fontsize / 2), 'px'; ?>;
            }
        <?php } ?>

        <?php
    }
    if ($bdp_theme == 'elina') {
        ?>
        <?php echo $layout_id?> .elina_wrapper .elina-post-wrapper {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .post-title {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .elina-post-wrapper .post-title a {
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area:before,
        <?php echo $layout_id?> .post-content-area::after,
        <?php echo $layout_id?> .elina-footer{
            background-color: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .post-title a:hover,
        <?php echo $layout_id?> .elina-post-wrapper .post-title a:focus {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .categories-outer .categories .categories-inner.bdp_no_links,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags .link-lable,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags.bdp_no_links {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .categories-outer .categories .categories-inner,
        <?php echo $layout_id?> .elina-post-wrapper .categories-outer .categories .categories-inner a,
        <?php echo $layout_id?> .elina-post-wrapper .elina-footer a.comments-link,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags a,
        <?php echo $layout_id?> .elina-post-wrapper .post-share-div a.post-share {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .post_content,
        <?php echo $layout_id?> .elina-post-wrapper .post-media .label_featured_post,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?> font-family: <?php echo $content_font_family; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .elina-post-wrapper .categories-outer .categories .categories-inner a:hover,
        <?php echo $layout_id?> .elina-post-wrapper .elina-footer a.comments-link:hover,
        <?php echo $layout_id?> .elina-post-wrapper .post-content-area .tags a:hover,
        <?php echo $layout_id?> .elina-post-wrapper .post-share-div a.post-share:hover {
            color: <?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .elina-post-wrapper .post-media .label_featured_post,
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag,
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag:before,
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag:after {
            color: <?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag:hover,
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag:hover:before,
        <?php echo $layout_id?> .elina-post-wrapper .read-more-div a.more-tag:hover:after {
            color: <?php echo $readmorebackcolor; ?>;
            border-color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .elina .author-avatar-div .fakegb {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'masonry_timeline') {
        ?>
        <?php echo $layout_id?> .masonry-timeline-wrapp,
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .social-component {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-content-area .post-title {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.masonry-timeline-wrapp .bdp-wrapper-like i,
        <?php echo $layout_id?> .masonry-timeline-wrapp .metadatabox span.mauthor i,
        <?php echo $layout_id?> .masonry-timeline-wrapp .metadatabox span.mauthor.bdp_no_links,
        <?php echo $layout_id?> .masonry-timeline-wrapp .categories.bdp_no_links,
        <?php echo $layout_id?> .masonry-timeline-wrapp .tags.bdp_no_links,
        <?php echo $layout_id?> .masonry-timeline-wrapp .tags .link-lable,
        <?php echo $layout_id?> .masonry-timeline-wrapp .year-number,
        <?php echo $layout_id?> .masonry-timeline-wrapp .metadatabox {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .metadatabox span.mauthor,
        <?php echo $layout_id?> .masonry-timeline-wrapp .categories,
        <?php echo $layout_id?> .masonry-timeline-wrapp .tags {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-content-area .post_content{
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .image-blog .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px;' ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .read-more-div a.more-tag {
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .read-more-div a.more-tag:hover,
        <?php echo $layout_id?> .masonry-timeline-wrapp .image-blog .label_featured_post {
            color: <?php echo $readmorebackcolor; ?>;
            border-color: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .metadatabox a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .metadatabox a:hover,
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .metadatabox a:focus {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .social-component .social-share a.close-div {
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .masonry-timeline-wrapp .post-footer .social-component .social-share a.close-div:hover {
            background: <?php echo $color; ?>;
        }
        <?php if (isset($firstletter_big) && $firstletter_big == 1) { ?>
            <?php echo $layout_id?> .masonry-timeline-wrapp.bdp_blog_template div.post_content > *:first-child:first-letter,
            <?php echo $layout_id?> .masonry-timeline-wrapp.bdp_blog_template div.post_content > p:first-child:first-letter,
            <?php echo $layout_id?> .masonry-timeline-wrapp.bdp_blog_template .post_content:first-letter {
                <?php if ($firstletter_font_family) { ?> font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
                font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
                color: <?php echo $firstletter_contentcolor; ?>;
                float: none;
                margin-right:0;
                line-height: 0;
            }
            <?php echo $layout_id?> .masonry-timeline-wrapp.bdp_blog_template div.post_content {
                margin-top: <?php echo ($firstletter_fontsize / 2), 'px'; ?>;
            }
        <?php } ?>
        <?php
    }
    if ($bdp_theme == 'sallet_slider') {
        ?>
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .bdp-post-image{
            height: <?php echo $slider_image_height . 'px'; ?>;
            overflow: hidden;
        }
        <?php echo $layout_id?> .bdp_blog_template.sallet_slider .blog_header > div > div > div{
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.sallet_slider img{
            height: 100%;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .blog_header h2{
            background: <?php echo $titlebackcolor; ?>;
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .blog_header h2 a{
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .blog_header h2 a:hover{
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a span,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date a,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment a {
            color: <?php echo $color; ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor:hover i,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a:hover span {
            color: <?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .category-link a,
        <?php echo $layout_id?> .bdp_blog_template.sallet_slider .blog_header > div > div > div::before{
            background: <?php echo isset($bdp_settings['winter_category_color']) ? $bdp_settings['winter_category_color'] : '#FF00AE' ?>;
        }
        <?php echo $layout_id?> .blog_template.sallet_slider .post_content .post_content-inner,
        <?php echo $layout_id?> .blog_template.sallet_slider .post_content .post_content-inner p{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .tags,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .tags i,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .category-link,
        <?php echo $layout_id?> .bdp_blog_template .bdp-wrapper-like a{
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .blog_template.sallet_slider .label_featured_post {
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .mauthor a:hover,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-date a:hover,
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .metadatabox .post-comment a:hover{
            color: <?php echo $linkhovercolor; ?>
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .post_content a.more-tag,
        <?php echo $layout_id?> .blog_template.sallet_slider .label_featured_post{
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorebackcolor; ?>;
        }
        <?php echo $layout_id?> .blog_template.bdp_blog_template.sallet_slider .post_content a.more-tag:hover{
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'crayon_slider') {
        if ($slider_image_height != '') {
            ?>
            <?php echo $layout_id?> .bdp_blog_template.crayon_slider .blog_header {
                background: <?php echo bdp_hex2rgba($templatecolor, 0.8); ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .bdp-post-image {
                height: <?php echo $slider_image_height . 'px'; ?>;
                overflow: hidden;
            }
            <?php echo $layout_id?> .bdp_blog_template.crayon_slider img {
                height: <?php echo $slider_image_height . 'px'; ?>;
                max-height: 100%;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .blog_header h2 {
                background: <?php echo $titlebackcolor; ?>;
                color:<?php echo $titlecolor; ?>;
                font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
                <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
                <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
                <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
                <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
                <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .blog_header h2 a{
                color:<?php echo $titlecolor; ?>;
                font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .blog_header h2 a:hover{
                color:<?php echo $titlehovercolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor a,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor span,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date a,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment a{
                color: <?php echo $color; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor span:hover {
                color: <?php echo $linkhovercolor; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .category-link a,
            <?php echo $layout_id?> .bdp_blog_template.crayon_slider .blog_header::before{
                background: <?php echo isset($bdp_settings['winter_category_color']) ? $bdp_settings['winter_category_color'] : '#FF00AE' ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor span.bdp-no-links,
            <?php echo $layout_id?> .blog_template.crayon_slider .post_content .post_content-inner,
            <?php echo $layout_id?> .blog_template.crayon_slider .post_content .post_content-inner p{
                font-size: <?php echo $content_fontsize . 'px'; ?>;
                color: <?php echo $contentcolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .category-link{
                <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
                <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
                <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
                <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
                <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
                color: <?php echo $contentcolor; ?>;
                font-size: <?php echo $content_fontsize . 'px'; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags .link-lable,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags .link-lable i,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags.tag_link {
                color: <?php echo $contentcolor; ?>;
            }

            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags i,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags {
                color: <?php echo $color; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .mauthor a:hover,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-date a:hover,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .metadatabox .post-comment a:hover{
                color: <?php echo $linkhovercolor; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .tags > a:hover {
                color: <?php echo $linkhovercolor; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .post_content a.more-tag {
                color:<?php echo $readmorecolor; ?>;
                background: <?php echo $readmorebackcolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .label_featured_post{
                color:<?php echo $readmorecolor; ?>;
                background: <?php echo $readmorebackcolor; ?>;
                <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
                <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
                <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
                <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
                <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
                font-size: <?php echo $content_fontsize . 'px'; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.crayon_slider .post_content a.more-tag:hover{
                background: <?php echo $readmorehoverbackcolor; ?>;
            }
            <?php
        }
    }
    if ($bdp_theme == 'sunshiny_slider') {
        if ($slider_image_height != '') {
            ?>
            <?php echo $layout_id?> .bdp_blog_template.sunshiny_slider .post_hentry:before {
                background: linear-gradient(to top, <?php echo bdp_hex2rgba($templatecolor, 0.8); ?> 0px, rgba(0, 0, 0, 0) 100%);
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .bdp-post-image{
                height: <?php echo $slider_image_height . 'px'; ?>;
                overflow: hidden;
            }
            <?php echo $layout_id?> .bdp_blog_template.sunshiny_slider img{
                height: 100%;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 {
                background: <?php echo $titlebackcolor; ?>;
                color:<?php echo $titlecolor; ?>;
                font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
                <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
                <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
                <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
                <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
                <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 a{
                color:<?php echo $titlecolor; ?>;
                font-size: <?php echo $template_titlefontsize . 'px'; ?>;
                <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>; <?php } ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .blog_header h2 a:hover{
                color:<?php echo $titlehovercolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a span,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date a,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment a{
                color: <?php echo $color; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a:hover span {
                color: <?php echo $linkhovercolor; ?>;
            }
            <?php echo $layout_id?> .label_featured_post span,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .category-link a{
                background: <?php echo isset($bdp_settings['winter_category_color']) ? $bdp_settings['winter_category_color'] : '#FF00AE' ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox,
            <?php echo $layout_id?> .blog_template.sunshiny_slider .post_content .post_content-inner,
            <?php echo $layout_id?> .blog_template.sunshiny_slider .post_content .post_content-inner p{
                font-size: <?php echo $content_fontsize . 'px'; ?>;
                color: <?php echo $contentcolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .tags,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .tags i,
            <?php echo $layout_id?> .blog_template.sunshiny_slider .label_featured_post,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .category-link{
                <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
                <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
                <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
                <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
                <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
                <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
                color: <?php echo $contentcolor; ?>;
                font-size: <?php echo $content_fontsize . 'px'; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .mauthor a:hover,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-date a:hover,
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .metadatabox .post-comment a:hover{
                color: <?php echo $linkhovercolor; ?>
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .post_content a.more-tag{
                color:<?php echo $readmorecolor; ?>;
                background: <?php echo $readmorebackcolor; ?>;
            }
            <?php echo $layout_id?> .blog_template.bdp_blog_template.sunshiny_slider .post_content a.more-tag:hover{
                background: <?php echo $readmorehoverbackcolor; ?>;
            }
            <?php
        }
    }
    if ($bdp_theme == 'pretty') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.pretty .right-content-wrapper,
        <?php echo $layout_id?> .bdp_blog_template.pretty .bdp-post-image.post-has-image::before {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .blog_header .post_date{
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .left-content-wrapper{
            background: <?php echo bdp_hex2rgba($templatecolor, 0.5); ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .left-content-wrapper.post-has-image::before{
            border-bottom-color: <?php echo bdp_hex2rgba($templatecolor, 0.5); ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags > a:hover{
            border-color: <?php echo $linkhovercolor; ?>;
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags > span{
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .blog_header h2 {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .blog_header h2 a,
        <?php echo $layout_id?> .bdp_archive.pretty .author-avatar-div .author_content .author{
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .blog_header h2 a:hover {
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post_content,
        <?php echo $layout_id?> .bdp_blog_template.pretty .entry-container .label_featured_post,
        <?php echo $layout_id?>.bdp_archive.pretty .author_content p{
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .date > span{
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags,
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .category-link ,
        <?php echo $layout_id?> .bdp_blog_template.pretty p,
        <?php echo $layout_id?> .bdp_blog_template.pretty .metadatabox {
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .entry-meta .read-more a,
        <?php echo $layout_id?> .bdp_blog_template.pretty .entry-container .label_featured_post {
            border-color: <?php echo $readmorebackcolor; ?>;
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .entry-meta .read-more a:hover {
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags.bdp_no_links > span,
        <?php echo $layout_id?> .bdp_blog_template.pretty .metadatabox > span i {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags > span a,
        <?php echo $layout_id?> .bdp_blog_template.pretty .metadatabox > span.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.pretty a,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a,
        <?php echo $layout_id?> .author-avatar-div.bdp_blog_template .social-component a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .social-component a {
            border-color: <?php echo $color; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.pretty .post-meta-cats-tags .tags > span a:hover,
        <?php echo $layout_id?> .bdp_blog_template.pretty a:hover,
        <?php echo $layout_id?>.bdp_archive .author-avatar-div .author_content .author a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.pretty .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'tagly') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.tagly {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .categories a,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .categories {
            color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .left-side-area,
        <?php echo $layout_id?> .bdp_blog_template.tagly .label_featured_post {
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .left-side-area:before{
            border-top-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .social-component::before{
            border-bottom-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area h2.bdp_post_title::before{
            background-color: <?php echo $templatecolor; ?>;
            box-shadow: 6px -2px 0 <?php echo $templatecolor; ?>;
            height: <?php echo $template_titlefontsize . 'px'; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox span a,
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox .author.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox .author a,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags.bdp_has_links,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags a{
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .categories a:hover,
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox span a:hover,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags a:hover{
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area h2.bdp_post_title a{
            color: <?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area h2.bdp_post_title a:hover{
            color: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area h2.bdp_post_title{
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            color: <?php echo $titlecolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox > span,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags,
        <?php echo $layout_id?> .bdp_blog_template.tagly .post_content,
        <?php echo $layout_id?> .bdp_blog_template.tagly .label_featured_post,
        <?php echo $layout_id?> .bdp_blog_template.tagly .post_content p,
        <?php echo $layout_id?>.bdp_archive.tagly .author_content p{
            color: <?php echo $contentcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags i,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox .author i,
        <?php echo $layout_id?> .bdp_blog_template.tagly .metadatabox span,
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .tags{
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .read-more > a{
            padding: 10px 20px;
            border-radius: 5px;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .read-more > a:hover{
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.tagly .right-side-area .read-more > a{
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .tagly .author-avatar-div.bdp_blog_template {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'brite') {
        $brite_tag_bgcolor = (isset($bdp_settings['winter_category_color']) && $bdp_settings['winter_category_color'] != '') ? $bdp_settings['winter_category_color'] : '#0e83cd';
        ?>

        <?php echo $layout_id?> .brite-post-wrapper .brite-post-inner-wrapp{
            background: <?php echo $templatecolor; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-title h2 {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-title a h2 {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-title a:hover h2,
        <?php echo $layout_id?> .brite-post-wrapper .post-title a:focus h2 {
            color:<?php echo $titlehovercolor; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-header-meta .date-meta,
        <?php echo $layout_id?> .brite-post-wrapper .post-content-body,
        <?php echo $layout_id?> .brite-post-wrapper .post-content-body .post-content,
        <?php echo $layout_id?> .brite-post-wrapper .label_featured_post,
        <?php echo $layout_id?> .brite-post-wrapper .post-footer {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .brite-post-wrapper .post-author .author-name {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }


        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like a i,
        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like a:hover i,
        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like a:focus i {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .brite-post-wrapper .date-meta > a,
        <?php echo $layout_id?> .brite-post-wrapper .post-categories > a,
        <?php echo $layout_id?> .brite-post-wrapper .post-meta > a,
        <?php echo $layout_id?> .brite-post-wrapper .post-comment > a,
        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like > a {
            color: <?php echo $color; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .date-meta > a:hover,
        <?php echo $layout_id?> .brite-post-wrapper .date-meta > a:focus,
        <?php echo $layout_id?> .brite-post-wrapper .post-categories > a:hover,
        <?php echo $layout_id?> .brite-post-wrapper .post-categories > a:focus,
        <?php echo $layout_id?> .brite-post-wrapper .post-meta > a:hover,
        <?php echo $layout_id?> .brite-post-wrapper .post-meta > a:focus,
        <?php echo $layout_id?> .brite-post-wrapper .post-comment > a:hover,
        <?php echo $layout_id?> .brite-post-wrapper .post-comment > a:focus,
        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like > a:hover,
        <?php echo $layout_id?> .brite-post-wrapper .bdp-wrapper-like > a:focus {
            color: <?php echo $linkhovercolor; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-tags span.tag:before {
            border-top: <?php echo $content_fontsize . 'px'; ?> solid transparent;
            border-bottom: <?php echo $content_fontsize . 'px'; ?> solid transparent;
            border-right: <?php echo $content_fontsize . 'px'; ?> solid;
            border-right-color: <?php echo $brite_tag_bgcolor; ?>;
            left: -<?php echo $content_fontsize . 'px'; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-tags span.tag {
            margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
            background: <?php echo $brite_tag_bgcolor; ?>;
        }
        <?php echo $layout_id?> .brite-post-wrapper .label_featured_post {
            background: <?php echo $brite_tag_bgcolor; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-tags span.tag:hover:before {
            border-top: <?php echo $content_fontsize . 'px'; ?> solid transparent;
            border-bottom: <?php echo $content_fontsize . 'px'; ?> solid transparent;
            border-right: <?php echo $content_fontsize . 'px'; ?> solid;
            border-right-color: <?php echo $contentcolor; ?>;
            left: -<?php echo $content_fontsize . 'px'; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .post-tags span.tag:hover {
            margin-left: <?php echo $content_fontsize + 15 . 'px'; ?>;
            background: <?php echo $contentcolor; ?>;
        }

        <?php echo $layout_id?> .brite-post-wrapper .read-more-div a:hover {
            background:<?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .brite-post-wrapper .read-more-div a {
            background:<?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'chapter') {
        ?>
        <?php echo $layout_id?> .chapter-post-container {
            border-color:  <?php echo $templatecolor; ?>
        }
        <?php echo $layout_id?> .chapter-post-wrapper .chapter-header,
        <?php echo $layout_id?> .chapter-post-wrapper .chapter-footer,
        <?php echo $layout_id?> .chapter .chapter-post-container .label_featured_post {
            background: <?php echo bdp_hex2rgba($background, 0.8); ?>;
        }

        <?php echo $layout_id?> .chapter-post-wrapper .post-title h2 {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
            <?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .chapter-post-wrapper .post-title a h2 {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .chapter-post-wrapper .post-title a:hover h2,
        <?php echo $layout_id?> .chapter-post-wrapper .post-title a:focus h2{
            color:<?php echo $titlehovercolor; ?>;
        }

        <?php echo $layout_id?> .chapter-post-wrapper .date-meta,
        <?php echo $layout_id?> .chapter-post-wrapper .post-author,
        <?php echo $layout_id?> .chapter-post-wrapper .post-categories,
        <?php echo $layout_id?> .chapter .chapter-post-container .label_featured_post,
        <?php echo $layout_id?> .chapter-post-wrapper .post-meta,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment,
        <?php echo $layout_id?> .chapter-post-wrapper .bdp-wrapper-like,
        <?php echo $layout_id?> .chapter-post-wrapper {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }

        <?php echo $layout_id?> .chapter-post-wrapper .date-meta > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-author > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-categories > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-meta > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment > a,
        <?php echo $layout_id?> .chapter-post-wrapper .bdp-wrapper-like > a {
            color: <?php echo $color; ?>;
        }

        <?php echo $layout_id?> .chapter-post-wrapper .date-meta > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .date-meta > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .post-author > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .post-author > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .post-categories > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .post-categories > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .post-meta > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .post-meta > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment:hover > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment:focus > a,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment:hover i,
        <?php echo $layout_id?> .chapter-post-wrapper .post-comment:focus i,
        <?php echo $layout_id?> .chapter-post-wrapper .bdp-wrapper-like > a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .bdp-wrapper-like > a:focus,
        <?php echo $layout_id?> .chapter-post-wrapper .read-more-div a:hover,
        <?php echo $layout_id?> .chapter-post-wrapper .read-more-div a:focus {
            color: <?php echo $linkhovercolor; ?>;
        }

        <?php echo $layout_id?> .chapter-post-wrapper .read-more-div a {
            color:<?php echo $readmorecolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'roctangle') {
        ?>
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post_date,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-image .label_featured_post {
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .post-title {
            background: <?php echo $titlebackcolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .post-title h2,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .post-title h2 a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .post-title h2 a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-image .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .link-lable {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .category-link a,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .tags a {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $color; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .category-link span,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .tags span {
            border-color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .category-link a:hover,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .tags a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .post-meta-div .author a,
        <?php echo $layout_id?> .post-meta-div .bdp-wrapper-like .bdp-count {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $color; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment a {
            color: <?php echo $color; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-meta-div span i {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment i {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment:hover i,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-comment:hover a,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-image-wrap .post-meta-wrapper .post-meta-div span:hover i,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-meta-div .author a:hover,
        <?php echo $layout_id?> .roctangle-post-wrapper .post-meta-div .bdp-wrapper-like:hover .bdp-count {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .content-footer .read-more a.more-tag {
            color: <?php echo $readmorecolor; ?>;
            border-color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .roctangle-post-wrapper .post-content-wrapper .content-footer .read-more a.more-tag:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'glamour') {
        ?>
        <?php echo $layout_id?> .glamour-blog .glamour-inner .post-title h2,
        <?php echo $layout_id?> .glamour-blog .glamour-inner .post-title h2 a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .glamour-blog .glamour-inner .post-title h2 a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .glamour-blog .glamour-inner .post-content {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .glamour-inner .post-categories,
        <?php echo $layout_id?> .glamour-inner .tags,
        <?php echo $layout_id?> .glamour-inner .glamour-meta div,
        <?php echo $layout_id?> .glamour-inner .post-categories a,
        <?php echo $layout_id?> .glamour-inner .tags a,
        <?php echo $layout_id?> .glamour-inner .glamour-meta div > a {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $color; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .glamour-blog .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
             <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
            background: <?php echo $color; ?>;
            border-color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .footer-entry .glamour-meta div .bdp-separator,
        <?php echo $layout_id?> .glamour-inner .tags,
        <?php echo $layout_id?> .glamour-inner .post-author,
        <?php echo $layout_id?> .glamour-inner .post-comment i {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .glamour-inner .post-categories a:hover,
        <?php echo $layout_id?> .glamour-inner .tags a:hover,
        <?php echo $layout_id?> .glamour-inner .glamour-meta div > a:hover,
        <?php echo $layout_id?> .glamour-inner .glamour-meta div:hover i,
        <?php echo $layout_id?> .glamour-inner .read-more-div a.more-tag:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .glamour-blog .glamour-opacity {
            background: <?php echo bdp_hex2rgba($background, 0.4); ?>;
        }
        <?php echo $layout_id?> .glamour-social-cover {
            background: <?php echo bdp_hex2rgba($background, 0.8); ?>;
        }
        <?php echo $layout_id?> .glamour-inner .read-more-div a.more-tag {
            color: <?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .glamour-social-cover .glamour-social-links-closed i,
        <?php echo $layout_id?> .footer-entry .glamour-footer-icon span a i {
            color: <?php echo $color; ?>;
            border-color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .glamour-social-cover .glamour-social-links-closed i:hover,
        <?php echo $layout_id?> .footer-entry .glamour-footer-icon span a i:hover {
            background: <?php echo $color; ?>;
        }
        <?php
    }
    if ($bdp_theme == 'cover') {
        ?>
        <?php echo $layout_id?> .cover-post {
            background: linear-gradient(to right, <?php echo $templatecolor; ?> 0%,<?php echo $templatecolor; ?> 20%,<?php echo $background; ?> 20%,<?php echo $background; ?> 50%);
        }
        <?php echo $layout_id?> .cover-post .cover-blog h2.bdp_post_title,
        <?php echo $layout_id?> .cover-post .cover-blog h2.bdp_post_title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .cover-post .cover-blog h2.bdp_post_title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .cover-post .cover-blog .post_content {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-categories,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-cover-tag,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-meta span {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-categories.bdp-no-links,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-cover-tag.bdp-no-links,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-cover-tag .link-lable,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-meta span.bdp-no-links {
            color: <?php echo $contentcolor; ?>;
        }

        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-categories a,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-cover-tag a,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-meta span a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-categories a:hover,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-cover-tag a:hover,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-meta span a:hover,
        <?php echo $layout_id?> .cover-post .cover-blog .bdp-post-meta .comment:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.cover-post .post_content a.more-tag  {
            background: <?php echo $readmorebackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.cover-post .post_content a.more-tag:hover,
        <?php echo $layout_id?> .cover-post .label_featured_post{
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?>  .cover-post .label_featured_post{
            background: <?php echo $readmorehoverbackcolor; ?>;
            color: <?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        .blog_template.bdp_archive.cover .bdp-author-avatar {
            background: linear-gradient(to right, <?php echo $templatecolor; ?> 0%,<?php echo $templatecolor; ?> 20%,<?php echo $author_bgcolor; ?> 20%,<?php echo $author_bgcolor; ?> 50%);
        }
        <?php
    }
    if ($bdp_theme == 'fairy') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.fairy .fairy_wrap .fairy-social-cover,
        <?php echo $layout_id?> .bdp_blog_template.fairy .fairy_wrap .fairy_footer,
        <?php echo $layout_id?> .bdp_blog_template.fairy .label_featured_post {
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.fairy .fairy_wrap {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .fairy .bdp-post-image h2.post_title,
        <?php echo $layout_id?> .fairy .bdp-post-image h2.post_title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .fairy .post_content_area h2.post_title,
        <?php echo $layout_id?> .fairy .post_content_area h2.post_title a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .fairy .post_content_area h2.post_title a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area .custom-categories.bdp_no_links,
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area .custom-categories .link-lable,
        <?php echo $layout_id?> .bdp_blog_template.fairy.even_class .post_content_area .post_title {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.fairy.even_class .post_content_area .post_title a {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.fairy.even_class .post_content_area .post_title a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> div.bdp-post-image .post-meta-cover,
        <?php echo $layout_id?> div.bdp-post-image .post-meta-cover a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> div.bdp-post-image .post-meta-cover a:hover,
        <?php echo $layout_id?> .fairy .bdp-post-image h2.post_title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content,
        <?php echo $layout_id?> .bdp_blog_template.fairy .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area,
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area .custom-categories,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox .metacomments,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox .metacomments.bdp-no-links:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy_footer .fairy-post-share,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy_footer span,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox span {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area a,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy_footer span a,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox span a,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy-social-cover .fairy-social-links-closed,
        <?php echo $layout_id?> .bdp_blog_template.fairy .label_featured_post {
            color: <?php echo $color; ?>;
        }
        <?php echo $layout_id?> .fairy .fairy_wrap .post_content_area a:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy_footer .fairy-post-share:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy-social-cover .fairy-social-links-closed:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox .metacomments:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .fairy_footer span a:hover,
        <?php echo $layout_id?> .fairy .fairy_wrap .metadatabox span a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php
    }
    if($bdp_theme == 'famous') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .post-body-div {
            background: <?php echo $background; ?>;
        }
        <?php echo $layout_id?> .bdp_archive.famous .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .famous-grid .post-body-div h2.post_title,
        <?php echo $layout_id?> .famous-grid .post-body-div h2.post_title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .post-body-div .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .famous-grid .post-body-div h2.post_title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .famous-grid .post-body-div .post_content,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .post-tags span.link-lable,
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .read_more_div a {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .famous-grid .bdp_post_content .category-link,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .category-link a,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .post-tags,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .post-tags a,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .metadatabox > span,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .metadatabox > span a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .famous-grid .bdp_post_content .category-link.bdp-no-links,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .metadatabox > span.bdp-no-links,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .post-tags.bdp-no-links {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .famous-grid .bdp_post_content .category-link a:hover,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .post-tags a:hover,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .metadatabox > span a:hover,
        <?php echo $layout_id?> .famous-grid .bdp_post_content .metadatabox > span:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .read_more_div a,
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .post-body-div .label_featured_post {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template.famous-grid .read_more_div a:hover {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php
    }
    if($bdp_theme == 'steps') {
        ?>
        <?php echo $layout_id?> .steps-wrapper .steps,
        <?php echo $layout_id?> .bdp_blog_template .steps > li,
        <?php echo $layout_id?> .bdp_blog_template .steps > li:before,
        <?php echo $layout_id?> .bdp_archive.steps .author-avatar-div,
        <?php echo $layout_id?> .bdp_archive.steps .author-avatar-div:before {
            border-color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .steps > li .steps-postformate {
            border-color: <?php echo $templatecolor; ?>;
            color: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .steps > li,
        <?php echo $layout_id?> .bdp_blog_template .steps > li:before {
            background:<?php echo $background; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.steps .author-avatar-div,
        <?php echo $layout_id?>.bdp_archive.steps .author-avatar-div:before {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .steps-wrapper .steps::before,
        <?php echo $layout_id?> .steps-wrapper .steps::after {
            background: <?php echo $templatecolor; ?>;
            box-shadow: <?php echo bdp_hex2rgba($templatecolor, 0.3); ?>;
        }
        <?php echo $layout_id?> .steps-wrapper .steps h2.post-title,
        <?php echo $layout_id?> .steps-wrapper .steps h2.post-title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .steps-wrapper .steps h2.post-title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .bdp_blog_template .steps > li .label_featured_post span {
            border-color: <?php echo $templatecolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
            color:<?php echo $titlehovercolor; ?>;
            background: <?php echo $templatecolor; ?>;
        }
        <?php echo $layout_id?> .steps-wrapper .steps .post_content {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .steps .post_content .read-more-div .more-tag {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color:<?php echo $readmorecolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .steps-wrapper .steps .categories,
        <?php echo $layout_id?> .steps-wrapper .steps .categories a,
        <?php echo $layout_id?> .steps-wrapper .steps .tags,
        <?php echo $layout_id?> .steps-wrapper .steps .tags a,
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta > span,
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta > span a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .steps-wrapper .steps .categories a:hover,
        <?php echo $layout_id?> .steps-wrapper .steps .tags a:hover,
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta span:hover,
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta span a:hover,
        <?php echo $layout_id?> .steps .post_content .read-more-div .more-tag:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta > span.bdp-no-links,
        <?php echo $layout_id?> .steps-wrapper .steps .post-meta > span.bdp-no-links:hover,
        <?php echo $layout_id?> .steps-wrapper .steps .tags .link-lable,
        <?php echo $layout_id?> .steps-wrapper .steps .tags.bdp-no-links,
        <?php echo $layout_id?> .steps-wrapper .steps .categories.bdp-no-links {
            color:<?php echo $contentcolor; ?>;
        }
        <?php
    }
    if($bdp_theme == 'minimal') {
        ?>
        <?php echo $layout_id?> .minimal-post-container .minimal-entry,
        <?php echo $layout_id?> .minimal-entry .minimal-social-cover {
            background:<?php echo $background; ?>;
        }
        <?php echo $layout_id?>.bdp_archive.minimal .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-title h2,
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .minimal-post-container:after {
            background: <?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-content,
        <?php echo $layout_id?> .minimal .minimal-content-cover .tags .link-lable,
        <?php echo $layout_id?> .minimal-post-container .label_featured_post {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-categories,
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-categories a,
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-meta,
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-meta a,
        <?php echo $layout_id?> .minimal .minimal-content-cover .tags,
        <?php echo $layout_id?> .minimal .minimal-content-cover tags a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .minimal .minimal-footer span,
        <?php echo $layout_id?> .minimal .minimal-footer span a,
        <?php echo $layout_id?> .minimal-social-cover .minimal-social-share-btn-close a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-categories a:hover,
        <?php echo $layout_id?> .minimal .minimal-content-cover .post-meta a:hover,
        <?php echo $layout_id?> .minimal .minimal-content-cover .tags a:hover,
        <?php echo $layout_id?> .minimal .minimal-footer span:hover,
        <?php echo $layout_id?> .minimal .minimal-footer span:hover a,
        <?php echo $layout_id?> .minimal .minimal-footer span a:hover,
        <?php echo $layout_id?> .minimal-social-cover .minimal-social-share-btn-close a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .read_more_div a,
        <?php echo $layout_id?> .minimal-post-container .label_featured_post {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
        }
        <?php echo $layout_id?> .minimal .minimal-content-cover .read_more_div a:hover {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?> .minimal .bdp_blog_template .social-component {
            width: calc(100% - 24px);
        }
        <?php
    }
    if($bdp_theme == 'clicky') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.clicky,
        <?php echo $layout_id?> .bdp_archive.clicky .bdp-author-avatar {
            background:<?php echo $background; ?>;
        }

        <?php echo $layout_id?> .clicky .clicky-wrap h2.post-title,
        <?php echo $layout_id?> .clicky .clicky-wrap h2.post-title a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .clicky .clicky-wrap h2.post-title a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .clicky .clicky-wrap .post_content,
        <?php echo $layout_id?> .clicky .clicky-wrap .post-meta-cats-tags .link-lable {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span,
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span a,
        <?php echo $layout_id?> .bdp_blog_template.clicky .label_featured_post,
        <?php echo $layout_id?> .clicky .clicky-wrap .post-meta-cats-tags,
        <?php echo $layout_id?> .clicky .clicky-wrap .post-meta-cats-tags a {
            color: <?php echo $color; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
        }
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span:hover,
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span:hover a,
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span a:hover,
        <?php echo $layout_id?> .clicky .clicky-wrap .post-meta-cats-tags a:hover {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span.bdp-no-links,
        <?php echo $layout_id?> .clicky .clicky-wrap .post-meta-cats-tags .bdp-no-links,
        <?php echo $layout_id?> .clicky .clicky-wrap .metadatabox span:hover.bdp-no-links {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?>.bdp-author-avatar .avtar-img:before,
        <?php echo $layout_id?>.bdp-author-avatar .avtar-img:after,
        <?php echo $layout_id?>.bdp-author-avatar .author_content:before,
        <?php echo $layout_id?>.bdp-author-avatar .author_content:after,
        <?php echo $layout_id?> .clicky.even_class div.bdp-post-image:before,
        <?php echo $layout_id?> .clicky.even_class div.bdp-post-image:after,
        <?php echo $layout_id?> .clicky div.bdp-post-image:before,
        <?php echo $layout_id?> .clicky div.bdp-post-image:after,
        <?php echo $layout_id?> .clicky.even_class .clicky-wrap:before,
        <?php echo $layout_id?> .clicky.even_class .clicky-wrap:after,
        <?php echo $layout_id?> .clicky .clicky-wrap:before,
        <?php echo $layout_id?> .clicky .clicky-wrap:after {
            border-color: <?php echo $color; ?> !important;
        }
        <?php echo $layout_id?>.clicky .bdp-post-image .read-more-div a.more-tag {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?>.clicky .bdp-post-image .read-more-div a.more-tag:hover {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php echo $layout_id?>.bdp_blog_template.clicky .label_featured_post {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorehoverbackcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $contentcolor; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php
    }

    if($bdp_theme == 'miracle') {
        ?>
        <?php echo $layout_id?> .bdp_blog_template.miracle_blog {
            background:<?php echo $background; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .bdp-author-avatar {
            border-color:<?php echo $background; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .bdp-post-format {
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            color:<?php echo $titlecolor; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .post-title h2,
        <?php echo $layout_id?> .miracle_blog .post-title h2 a {
            color:<?php echo $titlecolor; ?>;
            font-size: <?php echo $template_titlefontsize . 'px'; ?>;
            background: <?php echo $titlebackcolor; ?>;
            <?php if ($template_titlefontface) { ?> font-family: <?php echo $template_titlefontface; ?>;<?php } ?><?php if ($template_title_font_weight) { ?> font-weight: <?php echo $template_title_font_weight; ?>;<?php } ?>
            <?php if ($template_title_font_line_height) { ?> line-height: <?php echo $template_title_font_line_height; ?>;<?php } ?>
            <?php if ($template_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($template_title_font_text_transform) { ?> text-transform: <?php echo $template_title_font_text_transform; ?>;<?php } ?>
            <?php if ($template_title_font_text_decoration) { ?> text-decoration: <?php echo $template_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($template_title_font_letter_spacing) { ?> letter-spacing: <?php echo $template_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .miracle_blog .post-title h2 a:hover {
            color:<?php echo $titlehovercolor; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .post-meta-cats-tags > div,
        <?php echo $layout_id?> .miracle_blog .post-meta > span,
        <?php echo $layout_id?> .miracle_blog .post-meta > span a {
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            color: <?php echo $color; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .miracle_blog .post-meta-cats-tags > div.bdp_no_links,
        <?php echo $layout_id?> .miracle_blog .post-meta > span.bdp_no_links,
        <?php echo $layout_id?> .miracle_blog .post-meta-cats-tags > div .link-lable {
            color: <?php echo $contentcolor; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .post-meta > span a:hover,
        <?php echo $layout_id?> .miracle_blog .post-meta > span a:focus {
            color: <?php echo $linkhovercolor; ?>;
        }
        <?php echo $layout_id?> .miracle_blog .read_more_div a.more-tag,
        <?php echo $layout_id?> .miracle_blog .label_featured_post span {
            background: <?php echo $readmorebackcolor; ?>;
            color:<?php echo $readmorecolor; ?>;
            border-color: <?php echo $readmorehoverbackcolor; ?>;
            font-size: <?php echo $content_fontsize . 'px'; ?>;
            <?php if ($content_font_family) { ?>font-family: <?php echo $content_font_family; ?>; <?php } ?>
            <?php if ($content_font_weight) { ?> font-weight: <?php echo $content_font_weight; ?>;<?php } ?>
            <?php if ($content_font_line_height) { ?> line-height: <?php echo $content_font_line_height; ?>;<?php } ?>
            <?php if ($content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($content_font_text_transform) { ?> text-transform: <?php echo $content_font_text_transform; ?>;<?php } ?>
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
            <?php if ($content_font_letter_spacing) { ?> letter-spacing: <?php echo $content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php echo $layout_id?> .miracle_blog .read_more_div a.more-tag:hover {
            color:<?php echo $readmorecolor; ?>;
            background: <?php echo $readmorehoverbackcolor; ?>;
        }
        <?php
    }

    $archive_list = bdp_get_archive_list();
    if (is_author() && in_array('author_template', $archive_list)) {
        ?>
        .bdp_archive .author-avatar-div {
            background-color: <?php echo $author_bgcolor; ?>;
        }

        .bdp_archive.chapter .author-avatar-div,
        .bdp_archive.hoverbic .author-avatar-div,
        .bdp_archive.crayon_slider .author-avatar-div{
            background: <?php echo bdp_hex2rgba($author_bgcolor, 0.8); ?>;
        }
        .bdp_archive.explore .author-avatar-div {
            background: <?php echo bdp_hex2rgba($author_bgcolor, 0.5); ?>;
        }
        .bdp_archive .author-avatar-div .author_content .author a,
        .bdp_archive .author-avatar-div .author_content .author {
            color: <?php echo $author_titlecolor; ?>;
            font-size: <?php echo $authorTitleSize . 'px'; ?>;
            <?php if ($authorTitleFace) { ?> font-family: <?php echo $authorTitleFace; ?>; <?php } ?>
            <?php if ($author_title_font_weight) { ?> font-weight: <?php echo $author_title_font_weight; ?>;<?php } ?>
            <?php if ($author_title_font_line_height) { ?> line-height: <?php echo $author_title_font_line_height; ?>;<?php } ?>
            <?php if ($auhtor_title_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($author_title_font_text_transform) { ?> text-transform: <?php echo $author_title_font_text_transform; ?>;<?php } ?>
            <?php if ($author_title_font_text_decoration) { ?> text-decoration: <?php echo $author_title_font_text_decoration; ?>;<?php } ?>
            <?php if ($author_title_font_letter_spacing) { ?> letter-spacing: <?php echo $author_title_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        .bdp_archive .author-avatar-div .author_content p {
            color: <?php echo $author_content_color; ?>;
            font-size: <?php echo $author_content_fontsize . 'px'; ?>;
            <?php if ($author_content_fontface) { ?> font-family: <?php echo $author_content_fontface; ?>; <?php } ?>
            <?php if ($author_content_font_weight) { ?> font-weight: <?php echo $author_content_font_weight; ?>;<?php } ?>
            <?php if ($author_content_font_line_height) { ?> line-height: <?php echo $author_content_font_line_height; ?>;<?php } ?>
            <?php if ($auhtor_content_font_italic) { ?> font-style: <?php echo 'italic'; ?>;<?php } ?>
            <?php if ($author_content_font_text_transform) { ?> text-transform: <?php echo $author_content_font_text_transform; ?>;<?php } ?>
            <?php if ($author_content_font_text_decoration) { ?> text-decoration: <?php echo $author_content_font_text_decoration; ?>;<?php } ?>
            <?php if ($auhtor_content_font_letter_spacing) { ?> letter-spacing: <?php echo $auhtor_content_font_letter_spacing . 'px'; ?>;<?php } ?>
        }
        <?php
    }
    if (isset($firstletter_big) && $firstletter_big == 1) {
        $first_letter_line_height = $firstletter_fontsize * 75 / 100;
        ?>
        <?php echo $layout_id?> .bdp_blog_template div.post-content > *:first-child:first-letter,
        <?php echo $layout_id?> .bdp_blog_template div.post-content > p:first-child:first-letter,
        <?php echo $layout_id?> .bdp_blog_template div.post-content:first-letter,
        <?php echo $layout_id?> .bdp_blog_template div.post_content > *:first-child:first-letter,
        <?php echo $layout_id?> .bdp_blog_template div.post_content > p:first-child:first-letter,
        <?php echo $layout_id?> .bdp_blog_template div.post_content:first-letter ,
        <?php echo $layout_id?> .bdp-first-letter{
            <?php if ($firstletter_font_family) { ?>font-family:<?php echo $firstletter_font_family; ?>; <?php } ?>
            font-size:<?php echo $firstletter_fontsize . 'px'; ?>;
            color: <?php echo $firstletter_contentcolor; ?>;
            margin-right:5px;
            line-height: <?php echo $first_letter_line_height . 'px'; ?>;
            display: inline-block;
            <?php if ($content_font_text_decoration) { ?> text-decoration: <?php echo $content_font_text_decoration; ?>;<?php } ?>
        }
        <?php
    }
    if (isset($bdp_settings['custom_css']) && !empty($bdp_settings['custom_css'])) {
        echo stripslashes($bdp_settings['custom_css']);
    }
    ?></style>