<?php
class Pm_ThirtyX_AdminPage
{
	private $options;
	private $plugin_slug;
	private $plugin_version;

	public function __construct( Pm_ThirtyX_Options $options, $plugin_slug, $plugin_version ) {
		$this->options = $options;
		$this->shared_options = get_option( '_pm_pluginmill_shared' );
		$this->plugin_slug = $plugin_slug;
		$this->plugin_version = $plugin_version;
		$this->admin = new Pm_ThirtyX_Admin( $this->plugin_slug, $this->plugin_version );
	}

	/*
	 * Add admin page to the menu
	 */
	public function registerPostType() {
		$args = array(
			'public' => true,
			'label' => '30X Pages',
			'rewrite' => array('slug' => 'x'),
			'register_meta_box_cb' => array($this, 'ThirtyxAddMetabox'),
			'supports' => array('title'),
			'capabilities' => array(
				'create_posts' => false,
			),
			'map_meta_cap' => true,
			'taxonomies' => array( 'pg_type', 'thirtyx' )
		);
		register_post_type( 'thirtyx', $args );
	}

	public function registerTaxonomy() {
		register_taxonomy(
			'pg_type',
			'thirtyx',
			array(
				'label' => 'Page Type',
				'show_ui' => false,
				'show_admin_column' => true
			)
		);
	}
	
	public function addOptionsPage() {
		$settings = add_submenu_page(
			'edit.php?post_type=thirtyx',
			__('Setup & Build', 'pm-thirtyx'),
			__('Setup & Build', 'pm-thirtyx'),
			'manage_options',
			'30x_options',
			array($this, 'render')
		);  		
	}

	public function ThirtyxAddMetabox () {
		$metaboxes = array(
			'page_content_options' => array (
				'id' => 'page_content_options',
				'title' => 'Page Content & Options',
				'callback' => 'content_options_metabox',
				'screen' => 'thirtyx',
				'context' => 'advanced',
				'priority' => 'default',
				'callback_args' => ''
			)
		);

		foreach ($metaboxes as $key => $mbox) {
			add_meta_box( 
				'pm-thirtyx-'.$mbox['id'],
				$mbox['title'], 
				array($this, $mbox['callback']), 
				$mbox['screen'], 
				$mbox['context'], 
				$mbox['priority'], 
				$mbox['callback_args'] );
		}
	}

		public function content_options_metabox() {
			global $post;
			$meta = get_post_meta( get_the_id(), '_pm_thirtyx' );
			$terms = get_the_terms( get_the_id(), 'pg_type' );
			$prefix = ( !empty( $terms[0]->name ) && $terms[0]->name === 'opt' ) ? '' : 'bb_' ;		
			$saved = ( empty( $meta ) ) ? '' : $meta[0] ;

			$headline = ( empty( $saved[$prefix.'headline'] ) ? '' : html_entity_decode( $saved[$prefix.'headline'] ) );
			$keyword = ( empty( $saved[$prefix.'keyword'] ) ? '' : stripslashes( $saved[$prefix.'keyword'] ) );
			$label = ( empty( $saved[$prefix.'keyword'] ) ) ? '' : stripslashes( $saved[$prefix.'keyword'] ) ;
			$logo_image = ( empty( $saved[$prefix.'logo_image'] ) ) ? '' : esc_url( $saved[$prefix.'logo_image'] );
			$hdr_color = ( empty( $saved[$prefix.'hdr_color'] ) ) ? '' : stripslashes( $saved[$prefix.'hdr_color'] );
			$video = ( empty( $saved[$prefix.'video'] ) ) ? '' : esc_url( $saved[$prefix.'video'] );
			$optin_text = ( empty( $saved[$prefix.'optin_text'] ) ) ? '' : stripslashes( $saved[$prefix.'optin_text'] );
			$optin_form = ( empty( $saved[$prefix.'optin_form'] ) ) ? '' : stripslashes( $saved[$prefix.'optin_form'] );
			$ar_name = ( empty( $saved[$prefix.'ar_name'] ) ) ? '' : stripslashes( $saved[$prefix.'ar_name'] );
			$ar_email = ( empty( $saved[$prefix.'ar_email'] ) ) ? '' : stripslashes( $saved[$prefix.'ar_email'] );
			$ar_url = ( empty( $saved[$prefix.'ar_url'] ) ) ? '' : stripslashes( $saved[$prefix.'ar_url'] );
			$ar_hidden = ( empty( $saved[$prefix.'ar_hidden'] ) ) ? '' : stripslashes( $saved[$prefix.'ar_hidden'] );		
			$label = ( empty( $saved[$prefix.'btn_label'] ) ) ? '' : stripslashes( $saved[$prefix.'btn_label'] ) ;
			$label_color = ( empty( $saved[$prefix.'label_clr'] ) ) ? '' : stripslashes( $saved[$prefix.'label_clr'] ) ;
			$color = ( empty( $saved[$prefix.'btn_clr'] ) ) ? '' : stripslashes( $saved[$prefix.'btn_clr'] ) ;
			$btn_url = ( empty( $saved[$prefix.'btn_url'] ) ) ? '' : stripslashes( $saved[$prefix.'btn_url'] ) ;
			$footer = ( empty( $saved[$prefix.'footer'] ) ) ? '' : stripslashes( $saved[$prefix.'footer'] );
			wp_nonce_field( 'save_pm_thirtyx_metabox', 'pm_thirtyx_metabox_nonce' );
			?>
			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-headline" class="post-attributes-label">Headline</label>
			</p>
			<?php
			wp_editor( $headline, 'pm-thirtyx-headline', array( 'textarea_name' => 'headline', 'media_buttons' => false, 'teeny' => false, 'editor_height' => '150' ) );
			?>
			<input type="hidden" id="pm-thirtyx-keyword" name="keyword" value="<?php echo $keyword; ?>">

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-logo-image" class="post-attributes-label">Logo</label>
			</p>
			<input type="text" id="pm-thirtyx-logo-image" name="logo_image" class="large-text" value="<?php echo $logo_image; ?>">
			<button class="button button-secondary file-upload logo-image button-large"><?php _e('Choose Image', 'pm-thirtyx'); ?></button>

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-hdr-color" class="post-attributes-label">Header Color</label>
			</p>
			<input type="text" id="pm-thirtyx-hdr-color" class="color-picker" name="hdr_color" value="<?php echo $hdr_color; ?>">

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-video" class="post-attributes-label">Video URL</label>
			</p>
			<input type="text" id="pm-thirtyx-video" name="video" class="large-text" value="<?php echo $video; ?>">
				<button class="button button-secondary file-upload video button-large"><?php _e('Choose Video', 'pm-thirtyx'); ?></button>

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-optin-text" class="post-attributes-label">Optin Text</label>
				<small>Enter %keyword% where you want the keyword to appear.</small>
			</p>
			<?php wp_editor( $optin_text, 'pm-thirtyx-optin-text', array( 'textarea_name' => 'optin_text', 'media_buttons' => false, 'teeny' => false, 'editor_height' => '150' ) ); ?>
			
			<?php if( $terms[0]->name == 'opt' ) { ?>
			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-optin-form" class="post-attributes-label">Optin Form</label>
			</p>
			<textarea name="optin_form" id="pm-thirtyx-optin-form" class="pm-thirtyx-page-options large-text"><?php echo $optin_form; ?></textarea><br>
			If your optin form doesn't work as expected, <a href="#ar_advance" id="viewarcode">view autoresponder code</a> to check.
			<div id="arcode_hdn_div" ></div>
			<div id="arcode_hdn_div2"></div>
			<div id="ar_advance" class="ar_advance">
				<p>Name field</p>
				<input type="text" name="ar_name" id="ar_name" class="ar_name regular-text" value="<?php echo $ar_name; ?>">
				<p>Email field</p>
				<input type="text" name="ar_email" id="ar_email" class="ar_email regular-text" value="<?php echo $ar_email; ?>">
				<p>Form URL</p>
				<input type="text" name="ar_url" id="ar_url" class="ar_url regular-text"  value="<?php echo $ar_url; ?>">
				<p>Hidden fields</p>
				<textarea name="ar_hidden" id="ar_hidden" cols="30" rows="10" class="ar_hidden large-text"><?php echo $ar_hidden; ?></textarea>
			</div>
			<?php } ?>
			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-btn-label" class="post-attributes-label">Button Text</label>
			</p>
			<input type="text" id="pm-thirtyx-btn-label" class="regular-text" name="btn_label" value="<?php echo $label; ?>">

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-label-clr" class="post-attributes-label">Button Text Color</label>
			</p>
			<input type="text" id="pm-thirtyx-label-clr" class="color-picker" name="label_clr" value="<?php echo $label_color; ?>">
			
			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-btn-clr" class="post-attributes-label">Button Color</label>
			</p>
			<input type="text" id="pm-thirtyx-btn-clr" class="color-picker" name="btn_clr" value="<?php echo $color; ?>">

			<?php
			if( $terms[0]->name === 'bb') { ?>
				<p class="post-attributes-label-wrapper"><label for="pm-thirtx-btn-url">Button URL</label></p>
				<input type="text" id="pm-thirtyx-btn-url" class="large-text" name="btn_url" value="<?php echo $btn_url; ?>">
			<?php }	?>		

			<p class="post-attributes-label-wrapper">
				<label for="pm-thirtyx-footer" class="post-attributes-label">Footer</label>
			</p>
			<?php
			wp_editor( $footer, 'pm-thirtyx-footer', array( 'textarea_name' => 'footer', 'media_buttons' => false, 'teeny' => false, 'editor_height' => '150' ) );		
		}

	/*
	 * Renders admin page container using Settings API
	 */
	public function render(){
		$tab = ( isset( $_GET['tab'] )  ? $_GET['tab'] : 'keywords' );
		$settings_section = 'pm_thirtyx_'.$tab.'_tab';
		?>
		<div class="wrap">
			<h2><?php _e(PM_THIRTYX_PLUGIN_NAME, 'pm-thirtyx'); ?></h2>
			<?php $this->render_page_tabs(); ?>
			<form action="options.php" method="POST">
				<?php
				settings_fields( 'pm_thirtyx_opts' );				
				do_settings_sections( $settings_section );
				submit_button( 'Save Changes', 'primary', 'pm_thirtyx_opts[submit-'.$tab.']', false, array( 'id' => 'submit-'.$tab ) );
				?>
			</form>
		</div>
		<?php
	}

	/*
	 * Define Tabs
	 */
	public function define_page_tabs() {
		$tabs = array(
			'keywords' => __('Build', 'pm-thirtyx'),
			'config' => __('Optin Page Setup', 'pm-thirtyx'),
			'billboard' => __('Billboard Page Setup', 'pm-thirtyx')
			//'services' => __('Email Services', 'pm-thirtyx'),
			//'license' => __('License', 'pm-thirtyx'),
			);
		return $tabs;
	}

	/*
	 * Render Tabs
	 */
	public function render_page_tabs( $current = 'keywords' ) {
		// Determine which tab to display
		if( isset( $_GET['tab'] ) ) :
			$current = $_GET['tab'];
		else:
			$current = 'keywords';
		endif;

		// Get list of tabs
		$tabs = $this->define_page_tabs();
		$links = array();

		// Create links for each tab
		foreach ($tabs as $tab => $name) :
			if( $tab == $current ) :
				$links[] = '<a class="nav-tab nav-tab-active" href="edit.php?post_type=thirtyx&page=30x_options&tab='.$tab.'">'.$name.'</a>';
			else :
				$links[] = '<a class="nav-tab" href="edit.php?post_type=thirtyx&page=30x_options&tab='.$tab.'">'.$name.'</a>';
			endif;
		endforeach;
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $links as $link ) {
			echo $link;
		}
		echo '</h2>';
	}

	/**
	 * Configure the options page using Settings API
	 */
	public function configure() {
		// Register setting
		register_setting( 'pm_thirtyx_opts', 'pm_thirtyx_opts', array($this, 'sanitize') );

		// Add sections
		add_settings_section( 'pm_thirtyx_keyword_section', __('Build Keyword Pages', 'pm-thirtyx'), array($this, 'renderKeywordSection'), 'pm_thirtyx_keywords_tab' );
		add_settings_section( 'pm_thirtyx_config_section', __('Optin Page Options', 'pm-thirtyx'), array($this, 'renderGeneralSection'), 'pm_thirtyx_config_tab' );
		add_settings_section( 'pm_thirtyx_billboard_section', __('Billboard Page Options', 'pm-thirtyx'), array($this, 'renderBillBoardSection'), 'pm_thirtyx_billboard_tab' );
		add_settings_section( 'pm_thirtyx_api_keys', __('API Keys', 'pm-thirtyx'), array($this, 'renderApiKeysSection') , 'pm_thirtyx_services_tab' );
		add_settings_section(
			'license_section',
			__('Plugin Mill Support License', 'pm-thirtyx'),
			array($this, 'renderLicenseSection'),
			'pm_thirtyx_license_tab'
			);

		// Build Tab
		add_settings_field(
			'pm_thirtyx_pg_type',
			__('Page Type', 'pm-thirtyx'),
			array($this, 'renderPgTypeField'),
			'pm_thirtyx_keywords_tab',
			'pm_thirtyx_keyword_section'
		);
		add_settings_field(
			'pm_thirtyx_keywords',
			__('Keywords/phrase', 'pm-thirtyx'),
			array($this, 'renderKeywordField'),
			'pm_thirtyx_keywords_tab',
			'pm_thirtyx_keyword_section'
		);
		// Option Page
		add_settings_field(
			'pm_thirtyx_logo',
			__('Logo', 'pm-thirtyx'),
			array($this, 'renderLogoField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_hdr_bg_clr',
			__('Header Background Color', 'pm-thirtyx'),
			array($this, 'renderBGColorField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_headline',
			__('Headline', 'pm-thirtyx'),
			array($this, 'renderHeadlineField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_keyword',
			'',
			array($this, 'renderKeywordHiddenField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_video',
			__('Video', 'pm-thirtyx'),
			array($this, 'renderVideoField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_optin_text',
			__('Opt-in Text', 'pm-thirtyx'),
			array($this, 'renderOptTextField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_optin_form',
			__('Optin Form', 'pm-thirtyx'),
			array($this, 'renderOptFormField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_optin_button',
			__('Optin Button', 'pm-thirtyx'),
			array($this, 'renderButtonField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);
		add_settings_field(
			'pm_thirtyx_footer',
			__('Footer Text', 'pm-thirtyx'),
			array($this, 'renderFooterField'),
			'pm_thirtyx_config_tab',
			'pm_thirtyx_config_section',
			array(
				'pg_type' => 'opt'
			)
		);

		// Billboard Page
		add_settings_field(
			'pm_thirtyx_logo',
			__('Logo', 'pm-thirtyx'),
			array($this, 'renderLogoField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_hdr_bg_clr',
			__('Header Background Color', 'pm-thirtyx'),
			array($this, 'renderBGColorField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_headline',
			__('Headline', 'pm-thirtyx'),
			array($this, 'renderHeadlineField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_keyword',
			'',
			array($this, 'renderKeywordHiddenField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_video',
			__('Video', 'pm-thirtyx'),
			array($this, 'renderVideoField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_optin_text',
			__('Link Text', 'pm-thirtyx'),
			array($this, 'renderOptTextField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_optin_button',
			__('Button', 'pm-thirtyx'),
			array($this, 'renderButtonField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);
		add_settings_field(
			'pm_thirtyx_footer',
			__('Footer Text', 'pm-thirtyx'),
			array($this, 'renderFooterField'),
			'pm_thirtyx_billboard_tab',
			'pm_thirtyx_billboard_section',
			array(
				'pg_type' => 'bb'
			)
		);

		// Keys
		add_settings_field(
			'pm_thirtyx_aweber_key',
			__('Aweber Key', 'pm-thirtyx'),
			array($this, 'renderAweberKeyField'),
			'pm_thirtyx_services_tab',
			'pm_thirtyx_api_keys',
			array('name' => 'aw')
		);
		add_settings_field(
			'pm_thirtyx_mailchimp_key',
			__('Mailchimp Key', 'pm-thirtyx'),
			array($this, 'renderMailchimpKeyField'),
			'pm_thirtyx_services_tab',
			'pm_thirtyx_api_keys',
			array()
		);
		add_settings_field(
			'pm_thirtyx_support_key',
			__('Plugin Mill Support Key', 'pm-thirtyx'),
			array($this, 'renderLicenseKeyField'),
			'pm_thirtyx_license_tab',
			'license_section',
			array('name' => 'support')
		);
	}

	/*
	 * Render Sections
	 */
	public function renderGeneralSection() {
	//echo "<pre>".print_r($this->options->get('config'), true)."</pre>"; 
	 ?>
		<div>Set up & save page elements here.</div>
	<?php }
	public function renderBillboardSection() {
	//echo "<pre>".print_r($this->options->get('bboard'), true)."</pre>"; 
	 ?>
		<div>Set up & save page elements here.</div>
	<?php }
	public function renderKeywordSection() {
		echo "Enter your keywords in the box below. One keyword per line. Each keyword or phrase will be use used to replace the %keyword% in your page and in the URL.";
	}
	public function renderApiKeysSection() {
		echo "API Keys Section";
	}
	public function renderLicenseSection() {
		echo "License Key Section";
	}

	/*
	 * Render fields
	 */
	public function renderPgTypeField( $args ) {
		?>
		<label for="pm-thirtyx-opt-pg-type">Optin</label>
		<input type="radio" id="pm-thirtyx-opt-pg-type" name="pm_thirtyx_pg_type" value="opt">
		
		<label for="pm-thirtyx-bb-pg-type">Billboard</label>
		<input type="radio" id="pm-thirtyx-bb-pg-type" name="pm_thirtyx_pg_type" value="bb">
		<p><small>Select the type of page you want to build.</small></p>
		<?php
	}
	public function renderKeywordField( $args ) {
		?>
		<div id="pm-thirtyx-build-response"></div>
		<div id="pm-thirtyx-kwbox">
			<textarea name="pm_thirtyx_opts[keywords]" id="pm-thirtyx-keywords" class="regular-text"></textarea>
			<button id="pm-thirtyx-build" class="button secondary-button">Build Pages</button>
		</div>
		<?php
	}
	public function renderLogoField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'logo_image',
			'logo-image',
			'esc_url_raw',
			'bb_logo_image',
			'bb-logo-image'
		));

		$this->buildLogoField( $v );
	}
	public function renderBGColorField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'hdr_color',
			'hdr-color',
			'sanitize_text_field',
			'bb_hdr_color',
			'bb-hdr-color',
			'#ffffff'
		));

		$this->buildBGColorField( $v );
	}
	public function renderHeadlineField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'headline',
			'headline',
			'stripslashes',
			'bb_headline',
			'bb-headline'
		));

		$this->buildHeadlineField( $v );
	}
	public function renderKeywordHiddenField( $args ) {
		$v = $this->buildFieldArray (array(
			$args['pg_type'],
			'keyword',
			'keyword',
			'sanitize_text_field',
			'bb_keyword',
			'bb-keyword'
		));
		$this->buildKeywordField( $v );
	}
	public function renderVideoField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'video',
			'video',
			'esc_url_raw',
			'bb_video',
			'bb-video'
		));
		$this->buildVideoField( $v );
	}
	public function renderOptTextField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'optin_text',
			'optin-text',
			'stripslashes',
			'bb_optin_text',
			'bb-optin-text'
		));
		$this->buildOptTextField( $v );
	}
	public function renderOptFormField( $args ) {
		$form = $this->options->get('config');
		$optin_form = ( empty( $form['optin_form'] ) ) ? '' : esc_html( $form['optin_form'] );
		$ar_name = ( empty( $form['ar_name'] ) ) ? '' : stripslashes( $form['ar_name'] ) ;
		$ar_email = ( empty( $form['ar_email'] ) ) ? '' : stripslashes( $form['ar_email'] ) ;
		$ar_url = ( empty( $form['ar_url'] ) ) ? '' : esc_url( $form['ar_url'] ) ;
		$ar_hidden = ( empty( $form['ar_hidden'] ) ) ? '' : stripslashes( $form['ar_hidden'] ) ;
		?>
		<textarea name="pm_thirtyx_opts[optin_form]" id="pm-thirtyx-optin-form" cols="30" rows="10" class="pm-thirtyx-page-options large-text"><?php echo $optin_form; ?></textarea><br>
		If your optin form doesn't work as expected, <a href="#ar_advance" id="viewarcode">view autoresponder code</a> to check.
		<div id="arcode_hdn_div" ></div>
		<div id="arcode_hdn_div2"></div>
		<div id="ar_advance" class="ar_advance">
			<p>Name field</p>
			<input type="text" name="pm_thirtyx_opts[ar_name]" id="ar_name" class="ar_name regular-text" value="<?php echo $ar_name; ?>">
			<p>Email field</p>
			<input type="text" name="pm_thirtyx_opts[ar_email]" id="ar_email" class="ar_email regular-text" value="<?php echo $ar_email; ?>">
			<p>Form URL</p>
			<input type="text" name="pm_thirtyx_opts[ar_url]" id="ar_url" class="ar_url regular-text"  value="<?php echo $ar_url; ?>">
			<p>Hidden fields</p>
			<textarea name="pm_thirtyx_opts[ar_hidden]" id="ar_hidden" cols="30" rows="10" class="ar_hidden large-text"><?php echo $ar_hidden; ?></textarea>
		</div>
		<?php
	}
	public function renderButtonField( $args ) {
		$v = array(
			$this->buildFieldArray( array(
				$args['pg_type'],
				'btn_label',
				'btn-label',
				'stripslashes',
				'bb_btn_label',
				'bb-btn-label'
			)),
			$this->buildFieldArray( array(
				$args['pg_type'],
				'label_clr',
				'label-clr',
				'stripslashes',
				'bb_label_clr',
				'bb-label-clr',
				'#ffffff'
			)),
			$this->buildFieldArray( array(
				$args['pg_type'],
				'btn_clr',
				'btn-clr',
				'stripslashes',
				'bb_btn_clr',
				'bb-btn-clr',
				'#3f6e9e'
			)),
			$this->buildFieldArray( array(
				$args['pg_type'],
				'btn_url',
				'btn-url',
				'esc_url_raw',
				'bb_btn_url',
				'bb-btn-url'
			)),
			$args['pg_type']
		);
		$this->buildButtonField( $v );
	}
	public function renderFooterField( $args ) {
		$v = $this->buildFieldArray( array(
			$args['pg_type'],
			'footer',
			'footer',
			'stripslashes',
			'bb_footer',
			'bb-footer'
		));
		$this->buildFooterField( $v );
	}
	public function renderAweberKeyField( $args ) {
		$saved_opts = $this->shared_options;
		$saved_opts['email_services']['aw']['app_id'] = PM_THIRTYX_AW_APP_ID;
		$saved_opts['email_services']['aw']['opt_name'] = 'pm_thirtyx_opts';
		$aw_consumerKey = ( empty( $saved_opts['email_services']['aw']['aw_consumerKey'] ) ) ? '' : wp_strip_all_tags( $saved_opts['email_services']['aw']['aw_consumerKey'] ) ;
		//echo "<hr><pre>".print_r($saved_opts['email_services']['aw'], true)."</pre>";
		
		$pm_thirtyx_aweber_api = new Pmill_Aweber_Api( $saved_opts );

		if( !empty( $aw_consumerKey ) ) { ?>
		<div id="aw_authorized">
			<span class="dashicons dashicons-yes"></span> <?php _e( 'Aweber account connected.', 'pm-thirtyx' ); ?>
			<label for=""><input id="service_deauthorize" type="checkbox" name="pm_thirtyx_opts[aw][aweber_deauth]" data-service="aweber" value="1"> <?php _e( 'Deauthorize', 'pm-thirtyx' ); ?></label>
		</div>
		<?php } ?>
		<div id="aw_unauthorized">
			<?php $pm_thirtyx_aweber_api->authorization_fields(); ?>
		</div>
		<?php
	}

	public function renderMailchimpKeyField( $args ) {
		$saved_opts = $this->shared_options;
		$saved_opts['email_services']['mc']['opt_name'] = 'pm_thirtyx_opts';
		$mc_key = ( empty( $saved_opts['email_services']['mc']['mc_key'] ) ) ? '' : wp_strip_all_tags( $saved_opts['email_services']['mc']['mc_key'] ) ;

		/*
		echo "<pre>".print_r($saved_opts, true)."</pre>";
		[email_services] => Array
        (
            [aw_consumerKey] => Azfk5e3jl7kSB2Y5YH2L2bMZ
            [aw_consumerSecret] => LnX68PnD7NjHaJ0ybAMJXJdqBzfCYarpaEZWe0q7
            [aw_accessKey] => AgNcZGrsHX5SbAENol20MXyr
            [aw_accessSecret] => 2FnKcoKvTiAvA8qW75qJOM1rrpyamjSakbwR1WhD
            [mc_key] => 278f49855ee4015ad0626ff4cc985005-us8
        )
        */
		$pm_thirtyx_mc_api = new Pmill_Mailchimp_Api( $saved_opts );
		$pm_thirtyx_mc_api->key_fields();
	}

	public function renderLicenseKeyField( $args ) {
		$support = ($this->shared_options) ? $this->shared_options['support']: array() ;
		$key_value = ( empty( $support['key'] ) ) ? '' : esc_attr( $support['key'] ) ;
		$input_class = ( empty( $key_value ) ) ? 'pm-support-key-show' : 'pm-support-key-hide' ;
		//echo "<pre>".print_r($this->shared_options, true)."</pre>";
		?>
		<input type="text" id="pm-thirtyx-support-key" class="regular-text <?php echo $input_class; ?>" name="pm_thirtyx_opts[support_key]" value="" >
		<?php
		if( !empty( $support['activation_code'] ) ) {
			if( $support['activation_code'] != 'ok' ) {
				echo $support['activation_message'].'. '.__('De-activate from other sites before activating on this site.', 'pm-thirtyx');
			} else {
				?>
				<p class="pm-thirtyx-key-message">Your license is <span class="pm-thirtyx-key-active">ACTIVE!</span></p>
				<button id="pm-thirtyx-reenter-key" class="button button-primary">Enter/Re-enter Key</button>
				<button id="deactivate-key" class="button secondary-button">De-activate Key</button>
				<div id="deactivate-response"></div>
				<?php
			}
		}
	}

	/*
	 * Field Helpers
	 */
	private function getSavedData( $a ) {
		$dataset = ( $a[2] === 'opt' ) ? 'config' : 'billboard' ;
		$o = $this->options->get( $dataset );
		$value = ( empty( $o[$a[0]] ) ) ? '' :$a[1]( $o[$a[0]] ) ;
		return $value;
	}
	private function buildFieldArray( $a ) {
		//return $a; exit();
		if( $a[0] === 'opt' ) {
			$name = $a[1];
			$id = $a[2];
			$value = $this->getSavedData( array( $a[1], $a[3], $a[0] ) );
		} else {
			$name = $a[1];
			$id = $a[2];
			$value = $this->getSavedData( array( $a[4], $a[3], $a[0] ) );
		}
		$value = ( empty( $value ) && !empty( $a[6] ) ) ? $a[6] : $value ;
		
		$v = array(
			'name' => $name,
			'id' => $id,
			'value' => $value
		);
		return $v;
	}
	private function buildLogoField( $args ) {
		?>
		<input type="text" name="pm_thirtyx_opts[<?php echo $args['name']; ?>]" id="pm-thirtyx-<?php echo $args['id']; ?>" class="pm-thirtyx-page-options large-text" value="<?php echo $args['value']; ?>">
		<button class="button button-secondary file-upload <?php echo $args['id']; ?> button-large"><?php _e('Choose Image', 'pm-thirtyx'); ?></button>
		<?php
	}
	private function buildBGColorField( $args ) {
		?>
		<input type="text" name="pm_thirtyx_opts[<?php echo $args['name']; ?>]" id="pm-thirtyx-<?php echo $args['id']; ?>" class="color-picker pm-thirtyx-page-options" value="<?php echo $args['value']; ?>">
		<?php
	}
	private function buildHeadlineField( $args ) {
		$settings = array(
			'textarea_name' => 'pm_thirtyx_opts['.$args['name'].']',
			'media_buttons' => false,
			'teeny' => false,
			'editor_height' => '100'
		);
		wp_editor( $args['value'], 'pm-thirtyx-'.$args['id'], $settings );
		echo "<small>Enter %keyword% where you want the keyword to appear.</small>";
	}
	private function buildKeywordField( $args ) {
		?>
		<input type="hidden" id="<?php echo $args['id']; ?>" name="pm_thirtyx_opts[<?php echo $args['name']; ?>]" value="%keyword%">
		<?php
	}
	private function buildVideoField( $args ) {
		?>
		<input type="text" name="pm_thirtyx_opts[<?php echo $args['name'] ?>]" id="pm-thirtyx-<?php echo $args['id']; ?>" class="pm-thirtyx-page-options large-text" value="<?php echo $args['value']; ?>">
		<button class="button button-secondary file-upload video button-large"><?php _e('Choose Video', 'pm-thirtyx'); ?></button>
		<br><small>Choose/Upload video, enter a URL or paste YouTube URL</small>
		<?php
	}
	private function buildOptTextField( $args ) {
		$settings = array(
			'textarea_name' => 'pm_thirtyx_opts['.$args['name'].']',
			'media_buttons' => false,
			'teeny' => false,
			'editor_height' => '150'
		);
		wp_editor( $args['value'], 'pm-thirtyx-'.$args['id'], $settings );
		echo "<small>Enter %keyword% where you want the keyword to appear.</small>";
	}
	private function buildButtonField( $args ) {
		?>
		<div class="pm-thirtyx-opt-col">
			<p>Text</p>
			<input type="text" id="pm-thirtyx-<?php echo $args[0]['id']; ?>" class="regular-text" name="pm_thirtyx_opts[<?php echo $args[0]['name']; ?>]" value="<?php echo $args[0]['value']; ?>">
		</div>
		<div class="pm-thirtyx-opt-col col2">
			<p>Text Color</p>
			<input type="text" id="pm-thirtyx-<?php echo $args[1]['id']; ?>" class="color-picker" name="pm_thirtyx_opts[<?php echo $args[1]['name']; ?>]" value="<?php echo $args[1]['value']; ?>">
		</div>
		<div class="pm-thirtyx-opt-col col2">
			<p>Button Color</p>
			<input type="text" id="pm-thirtyx-<?php echo $args[2]['id']; ?>" class="color-picker" name="pm_thirtyx_opts[<?php echo $args[2]['name']; ?>]" value="<?php echo $args[2]['value']; ?>">
		</div>
		<?php if( $args[4] === 'bb' )  { ?>
		<p>Button URL</p>
		<input type="text" id="pm-thirtyx-<?php echo $args[3]['id'] ?>" class="large-text" name="pm_thirtyx_opts[<?php echo $args[3]['name'] ?>]" value="<?php echo $args[3]['value']; ?>">
		<?php
		}
	}
	private function buildFooterField( $args ) {
		$settings = array(
			'textarea_name' => 'pm_thirtyx_opts['.$args['name'].']',
			'media_buttons' => false,
			'teeny' => false,
			'editor_height' => '100'
		);
		wp_editor( $args['value'], 'pm-thirtyx-'.$args['id'], $settings );
	}

	/*
	 * Sanitize input
	 */
	public function sanitize( $input ) {
		$saved_opts = $this->options;
		$keys = $saved_opts->get('keys');		
		$now = new DateTime( null, new DateTimeZone('UTC') );
		$reverifyDate = strtotime('+30day', $now->getTimestamp());

		// Figure out which tab is submitted
		$services_tab = ( !empty( $input['submit-services'] ) ? true : false );
		$license_tab = ( !empty( $input['submit-license'] ) ? true : false );
		$config_tab = ( !empty( $input['submit-config'] ) ? true : false );
		$billboard_tab = ( !empty( $input['submit-billboard'] ) ? true : false );
		$keywords_tab = ( !empty( $input['submit-keywords'] ) ? true : false );

		// Save based on tab
		if ( $keywords_tab ) {
		} elseif ( $config_tab ) {
			$valid_config = $this->buildSanitizedArray( $input, 'opt' );

			$valid_input = array(
				'config' => $valid_config,
				'billboard' => $this->options->get('billboard')
			);

		} elseif ( $billboard_tab ) {
			$valid_billboard = $this->buildSanitizedArray( $input, 'bb' );
			$valid_input = array(
				'config' => $this->options->get('config'),
				'billboard' => $valid_billboard
			);
			//error_log(print_r($valid_input, true) );
		} elseif( $services_tab ) {
			// Sanitize
			$valid_keys['pixabay'] = isset( $input['keys']['pixabay'] ) ? sanitize_key( $input['keys']['pixabay'] ) : $keys['pixabay'] ;

			$valid_input = array(
				'keys' => $valid_keys
				);
		} elseif ( $license_tab ) {
			// Sanitize
			$valid_shared_input['support']['key'] = isset( $input['support_key'] ) ? sanitize_key( $input['support_key'] ) : $shared_options['support']['key'];

			// Verify support license
			$licensing = new Pm_PluginMill_Licensing($valid_shared_input['support']['key'], $this->admin->get_plugin_license_api());
			$verify = $licensing->verifyPluginLicense();

			if( $verify['valid'] ) {
				// Try activating key
				$activate = $licensing->activatePluginLicense( $shared_options['support'] );
				if( $activate['activation_code'] == 'ok' ) {
					$valid_shared_input['support']['key'] = $valid_shared_input['support']['key'];
					$valid_shared_input['support']['reverifydate'] = $reverifyDate ;
					$valid_shared_input['support']['activation_code'] = $activate['activation_code'];
					$valid_shared_input['support']['activation_message'] = $activate['activation_message'];
					$valid_shared_input['support']['activation_cache'] = $activate['activation_cache'];
					$message = $verify['message'];
					$type = 'updated';
				} else {
					$valid_shared_input['support']['key'] = '';
					$valid_shared_input['support']['reverifydate'] = '';
					$valid_shared_input['support']['activation_code'] = $activate['activation_code'];
					$valid_shared_input['support']['activation_message'] = $activate['activation_message'];
					$valid_shared_input['support']['activation_cache'] = '';
					$message = $activate['activation_message'];
					$type = 'error';
				}
			} else {
				$message = __($verify['message'].'. Please verify and re-enter Plugin Mill Support Key.', 'pm-thirtyx' );
				$type = 'error';
				$valid_shared_input = array( 'support' => array() );
			}

			// Update shared options
			update_option( '_pm_pluginmill_shared', $valid_shared_input, null );

			add_settings_error( 'pm_thirtyx_opts', esc_attr('settings_updated'), $message, $type );

			// Use Saved settings for other tabs
			$valid_input['keys'] = ( $this->options->get('keys') ) ? $this->options->get('keys') : array() ;
		}

		//echo "<pre>",print_r($valid_input, true),"</pre>";exit();

		return $valid_input;

		add_settings_error( 'pm_thirtyx_opts', esc_attr('settings_updated') );
	}

	private function sanitizeFunctions( $a ) {		
		if( $a['type'] === 'html' ) {
			$value = ( empty( $a['ivalue'] ) ) ? '' : stripslashes( $a['ivalue'] );
		}
		if( $a['type'] === 'text' ) {
			$value = ( empty( $a['ivalue'] ) ) ? '' : sanitize_text_field( $a['ivalue'] );
		}
		if( $a['type'] === 'url' ) {
			$value = ( empty( $a['ivalue'] ) ) ? '' : esc_url_raw( $a['ivalue'] );
		}
		if( $a['type'] === 'color' ) {
			$value = ( !empty( $a['ivalue'] ) && ( preg_match( '/^#[a-f0-9]{6}$/i', $a['ivalue'] ) == '1' ) ) ? sanitize_text_field( $a['ivalue'] ) : '' ;
		}
		if( $a['type'] === 'strmatch' ) {
			if( strstr( $a['ivalue'] , $a['match'] )  == TRUE ) {
				$value = 1;
			} else {
				$value = 0;
			}
		}

		return $value;
	}

	private function buildSanitizedArray( $input, $page_type ) {
		$prefix = ( $page_type === 'opt' ) ? '' : 'bb_' ; 
		$validated_input[$prefix.'logo_image'] = $this->sanitizeFunctions( array('type' => 'url', 'ivalue' => $input['logo_image'] ) );
		$validated_input[$prefix.'video'] = $this->sanitizeFunctions( array('type' => 'url', 'ivalue' => $input['video'] ) );
		$validated_input[$prefix.'hdr_color'] = $this->sanitizeFunctions( array('type' => 'color', 'ivalue' => $input['hdr_color'] ) );
		$validated_input[$prefix.'headline'] = $this->sanitizeFunctions( array( 'type' => 'html', 'ivalue' => $input['headline'] ) );
		$validated_input[$prefix.'keyword'] = $this->sanitizeFunctions( array( 'type' => 'text', 'ivalue' => $input['keyword'] ) );
		$validated_input[$prefix.'optin_text'] = $this->sanitizeFunctions( array( 'type' => 'html', 'ivalue' => $input['optin_text'] ) );
		if( empty( $prefix ) ) {
			$validated_input[$prefix.'optin_form'] = $this->sanitizeFunctions( array( 'type' => 'html', 'ivalue' => $input['optin_form'] ) );
			$validated_input[$prefix.'ar_name'] = $this->sanitizeFunctions( array( 'type' => 'text', 'ivalue' => $input['ar_name'] ) );
			$validated_input[$prefix.'ar_email'] = $this->sanitizeFunctions( array( 'type' => 'text', 'ivalue' => $input['ar_email'] ) );
			$validated_input[$prefix.'ar_url'] = $this->sanitizeFunctions( array( 'type' => 'url', 'ivalue' => $input['ar_url'] ) );
			$validated_input[$prefix.'ar_hidden'] = $this->sanitizeFunctions( array( 'type' => 'html', 'ivalue' => $input['ar_hidden'] ) );
		}
		$validated_input[$prefix.'btn_label'] = $this->sanitizeFunctions( array( 'type' => 'text', 'ivalue' => $input['btn_label'] ) );
		$validated_input[$prefix.'label_clr'] = $this->sanitizeFunctions( array( 'type' => 'color', 'ivalue' => $input['label_clr'] ) );
		$validated_input[$prefix.'btn_clr'] = $this->sanitizeFunctions( array( 'type' => 'color', 'ivalue' => $input['btn_clr'] ) );
		if( $prefix === 'bb_' ) {
			$validated_input[$prefix.'btn_url'] = $this->sanitizeFunctions( array( 'type' => 'url', 'ivalue' => $input['btn_url'] ) );
		}
		$validated_input[$prefix.'footer'] = $this->sanitizeFunctions( array( 'type' => 'html', 'ivalue' => $input['footer'] ) );
		$validated_input[$prefix.'is_yt'] = $this->sanitizeFunctions( array( 'type' => 'strmatch', 'ivalue' => $input['video'], 'match' => 'youtube.com' ) );

		return $validated_input;
	}

	/*
	 * Processes the keywords entered
	 */
	public function process_keyword_input() {
		if ( !empty( $_POST['keywords'] ) ) {
			$keywords = $_POST['keywords'];
			sanitize_text_field( $keywords );

			$keywords = explode("\n", $keywords);

			$pg_type = sanitize_text_field( $_POST['pg_type'] );

			echo $this->build_30x_pages( $keywords, $pg_type );

		} else {
			echo "No keywords found";
		}

		wp_die();
	}

	/*
	 * Builds the pages
	 */
	public function build_30x_pages( $keywords, $pg_type ) {
		$pg_data = ( $pg_type == 'opt' ) ? 'config' : 'billboard' ;
		$prefix = ( $pg_type == 'opt' ) ? '' : 'bb_' ;
		$pg_type = ( $pg_type == 'opt' ) ? 'opt' : 'bb' ;
		$page = $this->options->get( $pg_data );

		foreach ($keywords as $key => $word) {
			# code to build words and add meta here
			$user_id = get_current_user_id();
			$word = sanitize_text_field( $word );
			$post_title = $word;
			$headline = str_replace( '%keyword%' , $word, stripslashes( $page[$prefix.'headline'] ) );
			$optin_text = str_replace( '%keyword%' , $word, stripslashes( $page[$prefix.'optin_text'] ) );
			$footer = str_replace( '%keyword%' , $word, stripslashes( $page[$prefix.'footer'] ) );
			if( $pg_type == 'opt') {
				$optin_form = $page[$prefix.'optin_form'];
				$ar_name = $page[$prefix.'ar_name'];
				$ar_email = $page[$prefix.'ar_email'];
				$ar_url = $page[$prefix.'ar_url'];
				$ar_hidden = $page[$prefix.'ar_hidden'];
				$btn_url = '';
			} else {
				$optin_form = '';
				$ar_name = '';
				$ar_email = '';
				$ar_url = '';
				$ar_hidden = '';
				$btn_url = $page[$prefix.'btn_url'] ;
			}

			// Build post array
			$postarr = array(
				'post_title' => sanitize_text_field( $post_title ),
				'post_content' => '',
				'post_author' => $user_id,
				'post_type' => 'thirtyx',
				'post_status' => 'publish',
				'post_name' => $word,
				'tax_input' => array(
					'pg_type' => $pg_type
				),
				'meta_input' => array(
					'_pm_thirtyx' => array(
						$prefix.'logo_image' => $page[$prefix.'logo_image'],
						$prefix.'hdr_color' => $page[$prefix.'hdr_color'],
						$prefix.'video' => $page[$prefix.'video'],
						$prefix.'headline' => $headline,
						$prefix.'keyword' => $word,
						$prefix.'optin_text' => $optin_text,
						$prefix.'optin_form' => $optin_form,
						$prefix.'ar_name' => $ar_name,
						$prefix.'ar_email' => $ar_email,
						$prefix.'ar_url' => $ar_url,
						$prefix.'ar_hidden' => $ar_hidden,
						$prefix.'btn_label' => $page[$prefix.'btn_label'],
						$prefix.'label_clr' => $page[$prefix.'label_clr'],
						$prefix.'btn_clr' => $page[$prefix.'btn_clr'],
						$prefix.'btn_url' => $btn_url,
						$prefix.'footer' => $footer,
						$prefix.'is_yt' => $page[$prefix.'is_yt']
					)					
				)
			);

			//error_log(print_r($postarr, true) ); exit();

			$post_id = wp_insert_post( $postarr );
			if( is_wp_error( $post_id ) ) {
				echo "<p>Error " . $post_id->intl_get_error_message() . " creating page with keyword " . $word . "</p>";
			} else {
				echo "<p>" . wp_filter_post_kses( $word ) . " page created.</p>";
			}
		}
	}

	/*
	 * Saves metaboxes
	 */
	public function save_metabox( $post_id ) {
		if( !isset( $_POST['pm_thirtyx_metabox_nonce'] ) ) {
			return;
		}
		if( !wp_verify_nonce( $_POST['pm_thirtyx_metabox_nonce'], 'save_pm_thirtyx_metabox' ) ) {
			return;
		}
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if( !current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if( is_multisite() && ms_is_switched() ) {
			return $post_id;
		}
		if( !wp_is_post_revision( $post_id ) ) {

			if( isset( $_POST['post_type'] ) && 'thirtyx' === $_POST['post_type'] ) {
				$pg_type = get_the_terms( $post_id, 'pg_type' );
				$type = ( $pg_type[0]->name === 'opt' ) ? 'opt' : 'bb' ;
				
				// Sanitize
				$valid = $this->buildSanitizedArray( $_POST, $type );
				//error_log(print_r($_POST, true) );

				update_post_meta( $post_id, '_pm_thirtyx', $valid );

				if ( $type == 'bb') {
					$post_title = sanitize_text_field($valid['bb_keyword']);
				} else {
					$post_title = sanitize_text_field($valid['keyword']);
				}
			}
		}
	}

	/*
	 * Runs the class
	 */
	public function run() {
		add_action( 'init', array($this, 'registerPostType') );
		add_action( 'init', array($this, 'registerTaxonomy') );
		add_action( 'admin_init', array($this, 'configure') );
		add_action( 'admin_menu', array($this, 'addOptionsPage') );
		add_action( 'wp_ajax_pm_thirtyx_build_pages', array($this, 'process_keyword_input') );
		add_action( 'save_post', array($this, 'save_metabox') );
	}
}