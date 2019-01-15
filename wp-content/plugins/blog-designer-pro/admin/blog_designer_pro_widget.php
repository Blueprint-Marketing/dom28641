<?php
/*
 * Widget for Blog Designer Pro suppprt
 */

if (!defined('ABSPATH'))
    exit;


add_action('widgets_init', 'register_blogdesigner_widget');

function register_blogdesigner_widget() {
    register_widget('BDP_Widget_BlogDesignerPro');
}

class BDP_Widget_BlogDesignerPro extends WP_Widget {

    public function __construct() {
        parent::__construct('blog_designer_pro_widget', __('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN), array('classname' => 'widgte_blog_designer_pro_shortcode_list', 'description' => __('Show blogs of Blog Designer Pro. Please use this widget only for full width container area.', BLOGDESIGNERPRO_TEXTDOMAIN)));
        $this->alt_option_name = 'widgte_blog_designer_pro_shortcode_list';

        add_action('save_post', array($this, 'flush_widgte_blog_designer_pro_shortcode_list'));
        add_action('deleted_post', array($this, 'flush_widgte_blog_designer_pro_shortcode_list'));
        add_action('switch_theme', array($this, 'flush_widgte_blog_designer_pro_shortcode_list'));
    }

    public function widget($args, $instance) {
        $blog_designer_pro_shortcode_list = (isset($instance['blog_designer_pro_shortcode_list']) && $instance['blog_designer_pro_shortcode_list'] != '' ) ? (int) ($instance['blog_designer_pro_shortcode_list']) : '';
        $before_widget = $args['before_widget'];
        $after_widget = $args['after_widget'];

        if ($blog_designer_pro_shortcode_list) {
            $bdp_settings = bdp_get_shortcode_settings($blog_designer_pro_shortcode_list);
            $shortcode_id = $blog_designer_pro_shortcode_list;
            $bdp_theme = $bdp_settings['template_name'];
            $style_name = 'bdp-' . $bdp_theme . '-template-css';
            wp_enqueue_style($style_name);
            wp_enqueue_style('bdp-basic-tools');
            wp_enqueue_style('bdp-front-css');
            $template_titlefontface = (isset($bdp_settings['template_titlefontface']) && $bdp_settings['template_titlefontface'] != '') ? $bdp_settings['template_titlefontface'] : "";
            $load_goog_font_blog = array();
            if (isset($bdp_settings['template_titlefontface_font_type']) && $bdp_settings['template_titlefontface_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $template_titlefontface;
            }
            $column_setting = (isset($bdp_settings['column_setting']) && $bdp_settings['column_setting'] != '') ? $bdp_settings['column_setting'] : 2;
            $background = (isset($bdp_settings['template_bgcolor']) && $bdp_settings['template_bgcolor'] != '') ? $bdp_settings['template_bgcolor'] : "";
            $template_bghovercolor = (isset($bdp_settings['template_bghovercolor']) && $bdp_settings['template_bghovercolor'] != '') ? $bdp_settings['template_bghovercolor'] : "";
            $displaydate_backcolor = (isset($bdp_settings['displaydate_backcolor']) && $bdp_settings['displaydate_backcolor'] != '') ? $bdp_settings['displaydate_backcolor'] : "";
            $templatecolor = (isset($bdp_settings['template_color']) && $bdp_settings['template_color'] != '') ? $bdp_settings['template_color'] : "inherit";
            $color = (isset($bdp_settings['template_ftcolor']) && $bdp_settings['template_ftcolor'] != '') ? $bdp_settings['template_ftcolor'] : "inherit";
            $grid_hoverback_color = (isset($bdp_settings['grid_hoverback_color']) && $bdp_settings['grid_hoverback_color'] != '') ? $bdp_settings['grid_hoverback_color'] : "";
            $linkhovercolor = (isset($bdp_settings['template_fthovercolor']) && $bdp_settings['template_fthovercolor'] != '') ? $bdp_settings['template_fthovercolor'] : "";
            $loader_color = (isset($bdp_settings['loader_color']) && $bdp_settings['loader_color'] != '') ? $bdp_settings['loader_color'] : "";
            $loadmore_button_color = (isset($bdp_settings['loadmore_button_color']) && $bdp_settings['loadmore_button_color'] != '') ? $bdp_settings['loadmore_button_color'] : "#ffffff";
            $loadmore_button_bg_color = (isset($bdp_settings['loadmore_button_bg_color']) && $bdp_settings['loadmore_button_bg_color'] != '') ? $bdp_settings['loadmore_button_bg_color'] : "#444444";
            $titlecolor = (isset($bdp_settings['template_titlecolor']) && $bdp_settings['template_titlecolor'] != '') ? $bdp_settings['template_titlecolor'] : "";
            $titlehovercolor = (isset($bdp_settings['template_titlehovercolor']) && $bdp_settings['template_titlehovercolor'] != '') ? $bdp_settings['template_titlehovercolor'] : "";
            $contentcolor = (isset($bdp_settings['template_contentcolor']) && $bdp_settings['template_contentcolor'] != '') ? $bdp_settings['template_contentcolor'] : "";
            $readmorecolor = (isset($bdp_settings['template_readmorecolor']) && $bdp_settings['template_readmorecolor'] != '') ? $bdp_settings['template_readmorecolor'] : "";
            $readmorebackcolor = (isset($bdp_settings['template_readmorebackcolor']) && $bdp_settings['template_readmorebackcolor'] != '') ? $bdp_settings['template_readmorebackcolor'] : "";
            $readmorehoverbackcolor = (isset($bdp_settings['template_readmore_hover_backcolor']) && $bdp_settings['template_readmore_hover_backcolor'] != '') ? $bdp_settings['template_readmore_hover_backcolor'] : "";
            $alterbackground = (isset($bdp_settings['template_alterbgcolor']) && $bdp_settings['template_alterbgcolor'] != '') ? $bdp_settings['template_alterbgcolor'] : "";
            $titlebackcolor = (isset($bdp_settings['template_titlebackcolor']) && $bdp_settings['template_titlebackcolor'] != '') ? $bdp_settings['template_titlebackcolor'] : "";
            $social_icon_style = (isset($bdp_settings['social_icon_style']) && $bdp_settings['social_icon_style'] != '') ? $bdp_settings['social_icon_style'] : 0;
            $social_style = (isset($bdp_settings['social_style']) && $bdp_settings['social_style'] != '') ? $bdp_settings['social_style'] : '';
            $template_alternativebackground = (isset($bdp_settings['template_alternativebackground']) && $bdp_settings['template_alternativebackground'] != '') ? $bdp_settings['template_alternativebackground'] : 0;
            $firstletter_fontsize = (isset($bdp_settings['firstletter_fontsize']) && $bdp_settings['firstletter_fontsize'] != '') ? $bdp_settings['firstletter_fontsize'] : '';
            $firstletter_font_family = (isset($bdp_settings['firstletter_font_family']) && $bdp_settings['firstletter_font_family'] != '') ? $bdp_settings['firstletter_font_family'] : "";
            if (isset($bdp_settings['firstletter_font_family_font_type']) && $bdp_settings['firstletter_font_family_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $firstletter_font_family;
            }
            $firstletter_contentcolor = (isset($bdp_settings['firstletter_contentcolor']) && $bdp_settings['firstletter_contentcolor'] != '') ? $bdp_settings['firstletter_contentcolor'] : "";
            $firstletter_big = (isset($bdp_settings['firstletter_big']) && $bdp_settings['firstletter_big'] != '') ? $bdp_settings['firstletter_big'] : "";
            $template_titlefontsize = (isset($bdp_settings['template_titlefontsize']) && $bdp_settings['template_titlefontsize'] != '') ? $bdp_settings['template_titlefontsize'] : "";
            $content_fontsize = (isset($bdp_settings['content_fontsize']) && $bdp_settings['content_fontsize'] != '') ? $bdp_settings['content_fontsize'] : "inherit";
            $content_font_family = (isset($bdp_settings['content_font_family']) && $bdp_settings['content_font_family'] != '') ? $bdp_settings['content_font_family'] : '';
            if (isset($bdp_settings['content_font_family_font_type']) && $bdp_settings['content_font_family_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $content_font_family;
            }
            $grid_col_space = (isset($bdp_settings['grid_col_space']) && $bdp_settings['grid_col_space'] != '') ? $bdp_settings['grid_col_space'] : 10;
            $template_alternative_color = (isset($bdp_settings['template_alternative_color']) && $bdp_settings['template_alternative_color'] != '') ? $bdp_settings['template_alternative_color'] : "";
            $story_startup_background = (isset($bdp_settings['story_startup_background']) && $bdp_settings['story_startup_background'] != '') ? $bdp_settings['story_startup_background'] : "";
            $story_startup_text_color = (isset($bdp_settings['story_startup_text_color']) && $bdp_settings['story_startup_text_color'] != '') ? $bdp_settings['story_startup_text_color'] : "";
            $story_ending_background = (isset($bdp_settings['story_ending_background']) && $bdp_settings['story_ending_background'] != '') ? $bdp_settings['story_ending_background'] : "";
            $story_ending_text_color = (isset($bdp_settings['story_ending_text_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_ending_text_color'] : "";

            $story_startup_border_color = (isset($bdp_settings['story_startup_border_color']) && $bdp_settings['story_ending_text_color'] != '') ? $bdp_settings['story_startup_border_color'] : "";

            /**
             * Post Title Font style Setting
             */
            $template_title_font_weight = isset($bdp_settings['template_title_font_weight']) ? $bdp_settings['template_title_font_weight'] : '';
            $template_title_font_line_height = isset($bdp_settings['template_title_font_line_height']) ? $bdp_settings['template_title_font_line_height'] : '';
            $template_title_font_italic = isset($bdp_settings['template_title_font_italic']) ? $bdp_settings['template_title_font_italic'] : '';
            $template_title_font_text_transform = isset($bdp_settings['template_title_font_text_transform']) ? $bdp_settings['template_title_font_text_transform'] : 'none';
            $template_title_font_text_decoration = isset($bdp_settings['template_title_font_text_decoration']) ? $bdp_settings['template_title_font_text_decoration'] : 'none';
            $template_title_font_letter_spacing = isset($bdp_settings['template_title_font_letter_spacing']) ? $bdp_settings['template_title_font_letter_spacing'] : '0';

            /**
             * Content Font style Setting
             */
            $content_font_weight = isset($bdp_settings['content_font_weight']) ? $bdp_settings['content_font_weight'] : '';
            $content_font_line_height = isset($bdp_settings['content_font_line_height']) ? $bdp_settings['content_font_line_height'] : '';
            $content_font_italic = isset($bdp_settings['content_font_italic']) ? $bdp_settings['content_font_italic'] : '';
            $content_font_text_transform = isset($bdp_settings['content_font_text_transform']) ? $bdp_settings['content_font_text_transform'] : 'none';
            $content_font_text_decoration = isset($bdp_settings['content_font_text_decoration']) ? $bdp_settings['content_font_text_decoration'] : 'none';
            $content_font_letter_spacing = isset($bdp_settings['content_font_letter_spacing']) ? $bdp_settings['content_font_letter_spacing'] : '0';

            $author_bgcolor = (isset($bdp_settings['author_bgcolor']) && $bdp_settings['author_bgcolor'] != '') ? $bdp_settings['author_bgcolor'] : "";
            /**
             * Author Title Setting
             */
            $author_titlecolor = (isset($bdp_settings['author_titlecolor']) && $bdp_settings['author_titlecolor'] != '') ? $bdp_settings['author_titlecolor'] : "";
            $authorTitleSize = (isset($bdp_settings['author_title_fontsize']) && $bdp_settings['author_title_fontsize'] != '') ? $bdp_settings['author_title_fontsize'] : "";
            $authorTitleFace = (isset($bdp_settings['author_title_fontface']) && $bdp_settings['author_title_fontface'] != '') ? $bdp_settings['author_title_fontface'] : "";
            if (isset($bdp_settings['author_title_fontface_font_type']) && $bdp_settings['author_title_fontface_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $authorTitleFace;
            }
            $author_title_font_weight = isset($bdp_settings['author_title_font_weight']) ? $bdp_settings['author_title_font_weight'] : '';
            $author_title_font_line_height = isset($bdp_settings['author_title_font_line_height']) ? $bdp_settings['author_title_font_line_height'] : '';
            $auhtor_title_font_italic = isset($bdp_settings['auhtor_title_font_italic']) ? $bdp_settings['auhtor_title_font_italic'] : '';
            $author_title_font_text_transform = isset($bdp_settings['author_title_font_text_transform']) ? $bdp_settings['author_title_font_text_transform'] : 'none';
            $author_title_font_text_decoration = isset($bdp_settings['author_title_font_text_decoration']) ? $bdp_settings['author_title_font_text_decoration'] : 'none';
            $author_title_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letter_spacing']) ? $bdp_settings['auhtor_title_font_letter_spacing'] : '0';


            /**
             * Author Content Font style Setting
             */
            $author_content_color = (isset($bdp_settings['author_content_color']) && $bdp_settings['author_content_color'] != '') ? $bdp_settings['author_content_color'] : "";
            $author_content_fontsize = (isset($bdp_settings['author_content_fontsize']) && $bdp_settings['author_content_fontsize'] != '') ? $bdp_settings['author_content_fontsize'] : "";
            $author_content_fontface = (isset($bdp_settings['author_content_fontface']) && $bdp_settings['author_content_fontface'] != '') ? $bdp_settings['author_content_fontface'] : "";
            if (isset($bdp_settings['author_content_fontface_font_type']) && $bdp_settings['author_content_fontface_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $author_content_fontface;
            }
            $author_content_font_weight = isset($bdp_settings['author_content_font_weight']) ? $bdp_settings['author_content_font_weight'] : '';
            $author_content_font_line_height = isset($bdp_settings['author_content_font_line_height']) ? $bdp_settings['author_content_font_line_height'] : '';
            $auhtor_content_font_italic = isset($bdp_settings['auhtor_content_font_italic']) ? $bdp_settings['auhtor_content_font_italic'] : '';
            $author_content_font_text_transform = isset($bdp_settings['author_content_font_text_transform']) ? $bdp_settings['author_content_font_text_transform'] : 'none';
            $author_content_font_text_decoration = isset($bdp_settings['author_content_font_text_decoration']) ? $bdp_settings['author_content_font_text_decoration'] : 'none';
            $auhtor_content_font_letter_spacing = isset($bdp_settings['auhtor_title_font_letterauhtor_content_font_letter_spacing_spacing']) ? $bdp_settings['auhtor_content_font_letter_spacing'] : '0';


            /**
             *  Custom Read More Setting
             */
            $beforeloop_Readmoretext = isset($bdp_settings['beforeloop_Readmoretext']) ? $bdp_settings['beforeloop_Readmoretext'] : '';
            $beforeloop_readmorecolor = isset($bdp_settings['beforeloop_readmorecolor']) ? $bdp_settings['beforeloop_readmorecolor'] : '';
            $beforeloop_readmorebackcolor = isset($bdp_settings['beforeloop_readmorebackcolor']) ? $bdp_settings['beforeloop_readmorebackcolor'] : '';
            $beforeloop_readmorehovercolor = isset($bdp_settings['beforeloop_readmorehovercolor']) ? $bdp_settings['beforeloop_readmorehovercolor'] : '';
            $beforeloop_readmorehoverbackcolor = isset($bdp_settings['beforeloop_readmorehoverbackcolor']) ? $bdp_settings['beforeloop_readmorehoverbackcolor'] : '';
            $beforeloop_titlefontface = (isset($bdp_settings['beforeloop_titlefontface']) && $bdp_settings['beforeloop_titlefontface'] != '') ? $bdp_settings['beforeloop_titlefontface'] : '';
            if (isset($bdp_settings['beforeloop_titlefontface_font_type']) && $bdp_settings['beforeloop_titlefontface_font_type'] == 'Google Fonts') {
                $load_goog_font_blog[] = $beforeloop_titlefontface;
            }
            $beforeloop_titlefontsize = (isset($bdp_settings['beforeloop_titlefontsize']) && $bdp_settings['beforeloop_titlefontsize'] != '') ? $bdp_settings['beforeloop_titlefontsize'] : "inherit";
            $beforeloop_title_font_weight = isset($bdp_settings['beforeloop_title_font_weight']) ? $bdp_settings['beforeloop_title_font_weight'] : '';
            $beforeloop_title_font_line_height = isset($bdp_settings['beforeloop_title_font_line_height']) ? $bdp_settings['beforeloop_title_font_line_height'] : '';
            $beforeloop_title_font_italic = isset($bdp_settings['beforeloop_title_font_italic']) ? $bdp_settings['beforeloop_title_font_italic'] : '';
            $beforeloop_title_font_text_transform = isset($bdp_settings['beforeloop_title_font_text_transform']) ? $bdp_settings['beforeloop_title_font_text_transform'] : 'none';
            $beforeloop_title_font_text_decoration = isset($bdp_settings['beforeloop_title_font_text_decoration']) ? $bdp_settings['beforeloop_title_font_text_decoration'] : 'none';
            $beforeloop_title_font_letter_spacing = isset($bdp_settings['beforeloop_title_font_letter_spacing']) ? $bdp_settings['beforeloop_title_font_letter_spacing'] : '0';

            /**
             * Slider Image height
             */
            $slider_image_height = isset($bdp_settings['media_custom_height']) ? $bdp_settings['media_custom_height'] : '';
            include(WP_PLUGIN_DIR . '/blog-designer-pro/css/layout_dynamic_style.php');
        }
        echo $before_widget;
        echo do_shortcode('[wp_blog_designer id=' . "$blog_designer_pro_shortcode_list" . ']');
        echo $after_widget;
    }

    public function form($instance) {
        $blog_designer_pro_shortcode_list = isset($instance['blog_designer_pro_shortcode_list']) ? $instance['blog_designer_pro_shortcode_list'] : '';
        ?>
        <p>
            <label for="blog_designer_pro_shortcode_list"><?php _e('Select Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN) ?>:</label>
            <select name="<?php echo $this->get_field_name('blog_designer_pro_shortcode_list'); ?>" class="blog_designer_pro_shortcode_list" id="blog_designer_pro_shortcode_list" style="width: 100%;">
                <option value="">-- <?php _e('Select Blog Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?> --</option>
                <?php
                global $wpdb;
                $shortcodes = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'blog_designer_pro_shortcodes ');
                if ($shortcodes) {
                    foreach ($shortcodes as $shortcode) {
                        $shortcode_name = $shortcode->shortcode_name;
                        ?>
                        <option value="<?php echo $shortcode->bdid; ?>" <?php
                        if ($blog_designer_pro_shortcode_list == $shortcode->bdid) {
                            echo 'selected=selected';
                        }
                        ?>><?php
                            if ($shortcode_name) {
                                echo $shortcode_name;
                            } else {
                                _e('No title', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                            ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['blog_designer_pro_shortcode_list'] = (!empty($new_instance['blog_designer_pro_shortcode_list']) ) ? (int) ($new_instance['blog_designer_pro_shortcode_list']) : '';

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['widgte_blog_designer_pro_shortcode_list']))
            delete_option('widgte_blog_designer_pro_shortcode_list');

        return $instance;
    }

    public function flush_widgte_blog_designer_pro_shortcode_list() {
        wp_cache_delete('widgte_blog_designer_pro_shortcode_list', 'widget');
    }

}
