<?php
$pm_thirtyx_meta = get_post_meta( $post->ID, '_pm_thirtyx' );
$pm_thirtyx_meta = $pm_thirtyx_meta[0];
?>
<html>
	<head>
		<style>
		header {
			background-color: <?php echo $pm_thirtyx_meta['hdr_color']; ?>
		}
		</style>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(  ); ?>>
		<header>
			<div class="pm-thirtyx-wrap">
				<img src="<?php echo esc_url_raw( $pm_thirtyx_meta['logo_image'] ); ?> " alt="Logo">
			</div>
		</header>
		<content class="pm-thirtyx-wrap">
			<div class="pm-thirtyx-headline">
				<?php echo wpautop( $pm_thirtyx_meta['headline'], true ); ?>
			</div>
			<div class="pm-thirtyx-columns">
			<div id="pm-thirtyx-col-1">
				<?php
					if( !empty( $pm_thirtyx_meta['is_yt'] ) ) {
						$yt_id = parse_url( $pm_thirtyx_meta['video'] );
						$yt_id = str_replace( 'v=', '', $yt_id['query']);
						?>
						<iframe width="708" height="398" src="https://www.youtube.com/embed/<?php echo stripslashes( $yt_id ); ?>?rel=0&autoplay=1&showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						<?php
					} else {
						?>
						<video controls autoplay controlsList="nodownload" src="<?php echo $pm_thirtyx_meta['video']; ?>"></video>
						<?php
					}
				?>
			</div>
			<div id="pm-thirtyx-col-2">
				<?php echo wpautop( $pm_thirtyx_meta['optin_text'], $br = true ) ; ?>
				<form action="<?php echo esc_url( $pm_thirtyx_meta['ar_url'] ); ?>" method="POST">
				<?php if( !empty( $pm_thirtyx_meta['ar_name'] ) ) { ?>
				<input type="text" name="<?php echo stripslashes( $pm_thirtyx_meta['ar_name'] ); ?>" placeholder="Your Name">
				<?php } ?>
				<input type="text" name="<?php echo stripslashes($pm_thirtyx_meta['ar_email']); ?>" placeholder="Your Primary Email">
				<?php echo stripslashes($pm_thirtyx_meta['ar_hidden']); ?>
				<input style="color:<?php echo $pm_thirtyx_meta['label_clr']; ?>; background-color:<?php echo $pm_thirtyx_meta['btn_clr']; ?>" type="submit" name="submit" value="<?php echo $pm_thirtyx_meta['btn_label']; ?>">
				</form>
			</div>
			</div>
		</content>
		<footer>
			<div id="pm-thirtyx-footer" class="pm-thirtyx-wrap">
				<div class="pm-thirtyx-footer-content">
					<?php echo wpautop( $pm_thirtyx_meta['footer'] ); ?>
				</div>	
			</div>
		</footer>
			<?php wp_footer(); ?>	
	</body>
</html>