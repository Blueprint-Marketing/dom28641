<?php
/**
 * @package LearnDash
 */

//  Exit if accessed directly.
defined('ABSPATH') || exit;

// Enqueue JS and CSS.
include( plugin_dir_path( __FILE__ ) . 'lib/enqueue-scripts.php' );
include( plugin_dir_path( __FILE__ ) . 'lib/class-ld-rest-gutenberg-posts-controller.php' );
// Register meta boxes.
//include( plugin_dir_path( __FILE__ ) . 'lib/meta-boxes.php');
// Block Templates
//include( plugin_dir_path( __FILE__ ) . 'lib/block-templates.php');

// Dynamic Blocks.
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-course-complete/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-course-content/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-courseinfo/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-course-inprogress/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-course-notstarted/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-course-progress/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-group/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-payment-buttons/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-profile/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-student/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-user-course-points/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-user-groups/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-usermeta/index.php' );
include( plugin_dir_path( __FILE__ ) . 'blocks/ld-visitor/index.php' );
