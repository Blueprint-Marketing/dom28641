<?php

	include('wprtabs.inc.php');
	if(!function_exists('pre')){
	function pre($data){
			if(isset($_GET['debug'])){
				pree($data);
			}
		}	 
	} 	
	if(!function_exists('pree')){
	function pree($data){
				echo '<pre>';
				print_r($data);
				echo '</pre>';	
		
		}	 
	} 

	function register_wprtabs_scripts($hook_suffix) {
		
		
		
		wp_register_style( 'wprtab-style', plugins_url('css/style.css', __FILE__) );
		
		
		wp_enqueue_script('jquery');	
		
		if(is_admin()){
			wp_enqueue_style( 'wprtab-style' );
			
			
				
			wp_enqueue_script(
				'wprtab-scripts',
				plugins_url('js/scripts.js', __FILE__)
			);		
						
		}else{
			wp_register_style( 'wprtab-responsive-tabs', plugins_url('css/easy-responsive-tabs.css', __FILE__) );
			wp_enqueue_style( 'wprtab-responsive-tabs' );
			
			wp_enqueue_script(
				'wprtab-easyResponsiveTabs',
				plugins_url('js/easyResponsiveTabs.js', __FILE__)
			);		
		}
		
	}	
		
	function get_include_contents($filename) {
		$filename =  plugin_dir_path(__FILE__).$filename;
		if (is_file($filename)) {
			ob_start();
			include $filename;
			return ob_get_clean();
		}
		return false;
	}	
	
		
	function ertab_plugin_links($links) { 
	  $settings_link = '<a href="post-new.php?post_type=page">'.__('Try').'</a>';
	  $premium_link = '<a href="http://shop.androidbubbles.com/product/easy-responsive-tabs-accordion/" title="Go Premium" target=_blank>'.__('Go Premium').'</a>'; 
	  array_unshift($links, $settings_link,$premium_link); 
	  return $links; 
	}