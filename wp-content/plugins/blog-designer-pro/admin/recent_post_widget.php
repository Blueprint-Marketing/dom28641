<?php
/*
 * Widget for Blog Designer Pro suppprt
 */

if (!defined('ABSPATH'))
    exit;


add_action('widgets_init', 'bdp_recent_post_widget');

function bdp_recent_post_widget() {
    register_widget('BDP_Widget_RecentPost');
}

class BDP_Widget_RecentPost extends WP_Widget {

    public function __construct() {
        parent::__construct('bdp_recent_post_widget', 'BDP &rarr; ' . __('Recent Posts', BLOGDESIGNERPRO_TEXTDOMAIN), array('classname' => 'bdp_recent_post_widget', 'description' => __('Show recent posts, most liked posts and most commented post.', BLOGDESIGNERPRO_TEXTDOMAIN)));
        $this->alt_option_name = 'bdp_recent_post_widget';

        add_action('save_post', array($this, 'flush_bdp_recent_post_widget'));
        add_action('deleted_post', array($this, 'flush_bdp_recent_post_widget'));
        add_action('switch_theme', array($this, 'flush_bdp_recent_post_widget'));
    }

    public function widget($args, $instance) {
        $before_widget = $args['before_widget'];
        $after_widget = $args['after_widget'];
        $before_title = $args['before_title'];
        $after_title = $args['after_title'];
        $title = isset($instance['title']) ? $instance['title'] : '';
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : true;
        $show_view = isset($instance['show_view']) ? (bool) $instance['show_view'] : false;
        $select_post_type = isset($instance['select_post_type']) ? esc_attr($instance['select_post_type']) : '';
        $select_image_layout = isset($instance['select_image_layout']) ? esc_attr($instance['select_image_layout']) : '';
        $posts_per_page = isset($instance['posts_per_page']) ? esc_attr($instance['posts_per_page']) : -1;
        $show_feature_image = isset($instance['show_feature_image']) ? (bool) $instance['show_feature_image'] : true;
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        if ($select_post_type == 'most_viewed_post') {
            $query = array(
                'post_type' => 'post',
                'meta_key' => '_bdp_post_daily_count',
                'orderby' => 'meta_value_num',
                'posts_per_page' => $posts_per_page,
                'ignore_sticky_posts' => 1,
            );
        } elseif ($select_post_type == 'most_liked_post') {
            $query = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'meta_key' => '_post_like_count',
                'orderby' => 'meta_value_num',
                'ignore_sticky_posts' => 1,
            );
        } elseif ($select_post_type == 'most_commented_post') {
            $query = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'orderby' => 'comment_count',
                'ignore_sticky_posts' => 1,
            );
        } else {
            $query = array(
                'post_type' => 'post',
                'posts_per_page' => $posts_per_page,
                'ignore_sticky_posts' => 1,
            );
        }
        $image_layout = '';
        if ($select_image_layout == 'circle') {
            $image_layout = ' img_circle';
        }
        // The Query
        $the_query = new WP_Query($query);

        // The Loop
        if ($the_query->have_posts()) {
            $remove_space = '';
            if (!$show_feature_image) {
                $remove_space = ' remove_padding';
            }
            echo '<div class="recent-post-wrapper">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $remove_space_thumb = '';
                ?>
                <div class="recent-post-inner">
                    <?php
                    if ($show_feature_image) {
                        if (!has_post_thumbnail()) {
                            $remove_space_thumb = ' remove_padding';
                        }
                        if (has_post_thumbnail()) {
                            ?>
                            <div class="bdp-feature-image<?php echo $image_layout; ?>">
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                    <?php
                                    echo get_the_post_thumbnail(get_the_ID(), array(60, 60), '');
                                    ?>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="bdp-metadata<?php echo $remove_space . $remove_space_thumb; ?>">
                        <h3>
                            <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                        </h3>
                        <?php
                        if ($show_date) {
                            ?>
                            <span>
                                <?php
                                $date_format = get_option('date_format');
                                $ar_year = get_the_time('Y');
                                $ar_month = get_the_time('m');
                                $ar_day = get_the_time('d');
                                echo '<a href="' . get_day_link($ar_year, $ar_month, $ar_day) . '">';
                                echo '<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;';
                                echo apply_filters('bdp_date_format', get_the_time($date_format, get_the_ID()), get_the_ID());
                                echo '</a>';
                                ?>
                            </span>
                            <?php
                        }
                        
                        if($show_view) {                            
                            $count = get_post_meta(get_the_ID(), '_bdp_post_views_count', true);                            
                            ?>
                            <span>
                                <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php echo ($show_date) ? '  - ' : ''; ?>
                                <?php 
                                if($count != '' && $count > 0) {
                                    echo $count .' '. __('Views', BLOGDESIGNERPRO_TEXTDOMAIN); 
                                }
                                ?> 
                                </a>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            wp_reset_postdata();
        }
        echo $after_widget;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $select_post_type = isset($instance['select_post_type']) ? esc_attr($instance['select_post_type']) : '';
        $select_image_layout = isset($instance['select_image_layout']) ? esc_attr($instance['select_image_layout']) : '';
        $posts_per_page = isset($instance['posts_per_page']) ? $instance['posts_per_page'] : '5';
        $show_feature_image = isset($instance['show_feature_image']) ? (bool) $instance['show_feature_image'] : true;
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : true;
        $show_view = isset($instance['show_view']) ? (bool) $instance['show_view'] : false;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('select_post_type'); ?>"><?php _e('Select Post Layout:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
            <select name="<?php echo $this->get_field_name('select_post_type'); ?>">
                <option value="recent_post" <?php selected($select_post_type, 'recent_post'); ?> ><?php _e('Most Recent Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="most_liked_post" <?php selected($select_post_type, 'most_liked_post'); ?> ><?php _e('Most Liked Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="most_commented_post" <?php selected($select_post_type, 'most_commented_post'); ?> ><?php _e('Most Commented Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="most_viewed_post" <?php selected($select_post_type, 'most_viewed_post'); ?> ><?php _e('Most Viewed Posts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('select_image_layout'); ?>"><?php _e('Select Image Layout:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
            <select name="<?php echo $this->get_field_name('select_image_layout'); ?>">
                <option value="circle" <?php selected($select_image_layout, 'circle'); ?> ><?php _e('Circle', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="square" <?php selected($select_image_layout, 'square'); ?> ><?php _e('Square', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" min="1" value="<?php echo $posts_per_page; ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_feature_image); ?> id="<?php echo $this->get_field_id('show_feature_image'); ?>" name="<?php echo $this->get_field_name('show_feature_image'); ?>" />
            <label for="<?php echo $this->get_field_id('show_feature_image'); ?>"><?php esc_attr_e('Show Feature Image', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_date); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php esc_attr_e('Show Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_view); ?> id="<?php echo $this->get_field_id('show_view'); ?>" name="<?php echo $this->get_field_name('show_view'); ?>" />
            <label for="<?php echo $this->get_field_id('show_view'); ?>"><?php esc_attr_e('Show Views', BLOGDESIGNERPRO_TEXTDOMAIN); ?></label>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = isset($new_instance['title']) ? $new_instance['title'] : '';
        $instance['select_post_type'] = isset($new_instance['select_post_type']) ? $new_instance['select_post_type'] : '';
        $instance['select_image_layout'] = isset($new_instance['select_image_layout']) ? $new_instance['select_image_layout'] : '';
        $instance['posts_per_page'] = isset($new_instance['posts_per_page']) ? $new_instance['posts_per_page'] : '';
        $instance['show_feature_image'] = isset($new_instance['show_feature_image']) ? (bool) $new_instance['show_feature_image'] : false;
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;
        $instance['show_view'] = isset($new_instance['show_view']) ? (bool) $new_instance['show_view'] : false;


        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['bdp_recent_post_widget']))
            delete_option('bdp_recent_post_widget');
        return $instance;
    }

    public function flush_bdp_recent_post_widget() {
        wp_cache_delete('bdp_recent_post_widget', 'widget');
    }

}
