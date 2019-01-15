<?php
$pm_thirtyx_meta = get_post_meta( $post->ID, '_pm_thirtyx' );
$pm_thirtyx_meta = $pm_thirtyx_meta[0];
?>
<html>
	<head>
		<style>
		header {
			background-color: <?php echo $pm_thirtyx_meta['bb_hdr_color']; ?>
		}
		</style>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(  ); ?>>
		<header>
			<div class="pm-thirtyx-wrap">
				<img src="<?php echo esc_url_raw( $pm_thirtyx_meta['bb_logo_image'] ); ?> " alt="Logo">
			</div>
		</header>
		<content class="pm-thirtyx-wrap">
			<div class="pm-thirtyx-headline">
				<?php echo wpautop( $pm_thirtyx_meta['bb_headline'] ); ?>
			</div>
			<div class="pm-thirtyx-columns">
			<div id="pm-thirtyx-col-1">
				<?php
				if( !empty( $pm_thirtyx_meta['bb_is_yt'] ) ) {
					$yt_id = parse_url( $pm_thirtyx_meta['bb_video'] );
					$yt_id = str_replace( 'v=', '', $yt_id['query']);
					?>
					<iframe width="708" height="398" src="https://www.youtube.com/embed/<?php echo stripslashes( $yt_id ); ?>?rel=0&autoplay=1&showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<?php
				} else {
					?>
					<video controls autoplay controlsList="nodownload" src="<?php echo $pm_thirtyx_meta['bb_video']; ?>"></video>
					<?php
				}
				?>
			</div>
			<div id="pm-thirtyx-col-2">
				<form>
					<?php echo wpautop( $pm_thirtyx_meta['bb_optin_text'], $br = true ) ; ?>
					<a href="<?php echo $pm_thirtyx_meta['bb_btn_url']; ?>" id="pm-thirtyx-billboard-button" style="background-color: <?php echo $pm_thirtyx_meta['bb_btn_clr']; ?>; color: <?php echo $pm_thirtyx_meta['bb_label_clr']; ?>"><?php echo $pm_thirtyx_meta['bb_btn_label']; ?></a>
				</form>
			</div>
			</div>
		</content>
		<footer>
			<div id="pm-thirtyx-footer">
				<div class="pm-thirtyx-wrap">
					<div class="pm-thirtyx-footer-content">
					<?php echo wpautop( $pm_thirtyx_meta['bb_footer'] ); ?>
					</div>
				</div>	
			</div>
		</footer>
			<?php wp_footer(); ?>	
	</body>
</html>