<?php
/*
Plugin Name: Pagely Security HotFixes 
Plugin URI: https://pagely.com
Description: Maintains WP Core functionality hotfixes for security issues.
Version: 0.1
Author: Pagely
Author URI: https://pagely.com
License: GPL
*/

if (!defined('SKIP_ALL_HOTFIX')) {

  /******
  Hotfix to santize thumbnail metadata
  https://blog.ripstech.com/2018/wordpress-file-delete-to-code-execution/
  ******/
  if (!defined('SKIP_UNLINK_HOTFIX')) {
    add_filter( 'wp_update_attachment_metadata', 'pagely_unlink_hotfix' );

    function pagely_unlink_hotfix( $data ) {
      if( isset($data['thumb']) ) {
          $data['thumb'] = basename($data['thumb']);
      }
      return $data;
    }
  }
}
