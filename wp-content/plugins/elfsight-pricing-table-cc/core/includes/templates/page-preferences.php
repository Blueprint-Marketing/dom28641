<?php

if (!defined('ABSPATH')) exit;

?><article class="elfsight-admin-page-preferences elfsight-admin-page" data-elfsight-admin-page-id="preferences">
	<div class="elfsight-admin-page-heading">
		<h2><?php _e('Preferences', $this->textDomain); ?></h2>

		<div class="elfsight-admin-page-heading-subheading">
			<?php _e('These settings will be applied to each widget of the plugin.', $this->textDomain); ?>
		</div>
    </div>

    <div class="elfsight-admin-divider"></div>

	<div class="elfsight-admin-page-preferences-form" data-nonce="<?php echo wp_create_nonce($this->getOptionName('update_preferences_nonce')); ?>">
        <div class="elfsight-admin-page-preferences-option-force-script elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <label for="forceScriptAdd"><?php _e('Add plugin script to every page', $this->textDomain); ?></label>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php _e('By default the plugin adds its scripts only to pages with its shortcode. This option makes the plugin add scripts to every page. It is useful for ajax websites.', $this->textDomain); ?>
                </div>
            </div>

            <div class="elfsight-admin-page-preferences-option-input-container">
                <input type="checkbox" name="preferences_force_script_add" value="true" id="forceScriptAdd" class="elfsight-admin-page-preferences-option-input-toggle"<?php echo ($preferences_force_script_add === 'on') ? ' checked' : ''?>>
                <label for="forceScriptAdd"><i></i></label>
            </div>
        </div>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-preferences-option-css elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <?php _e('Custom CSS', $this->textDomain); ?>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php _e('Here you can set the plugin\'s custom styles. The code will be added to each page with the widget.', $this->textDomain); ?>
                </div>
            </div>

            <div class="elfsight-admin-page-preferences-option-input-container">
                <div class="elfsight-admin-page-preferences-option-editor">
                    <div class="elfsight-admin-page-preferences-option-editor-code" id="elfsightPreferencesSnippetCSS"><?php echo htmlspecialchars($preferences_custom_css)?></div>
                </div>

                <div class="elfsight-admin-page-preferences-option-save-container">
                    <a href="#" class="elfsight-admin-page-preferences-option-css-save elfsight-admin-page-preferences-option-save elfsight-admin-button-green elfsight-admin-button">
                        <span class="elfsight-admin-page-preferences-option-save-label"><?php _e('Save', $this->textDomain); ?></span>

                        <span class="elfsight-admin-page-preferences-option-save-loader"></span>
                    </a>

                    <span class="elfsight-admin-page-preferences-option-save-success">
                        <span class="elfsight-admin-icon-check-green-small elfsight-admin-icon"></span><span class="elfsight-admin-page-preferences-option-save-success-label"><?php _e('Done!', $this->textDomain); ?></span>
                    </span>

                    <span class="elfsight-admin-page-preferences-option-save-error"></span>
                </div>
            </div>
        </div>

        <div class="elfsight-admin-divider"></div>

        <div class="elfsight-admin-page-preferences-option-js elfsight-admin-page-preferences-option">
            <div class="elfsight-admin-page-preferences-option-info">
                <h4 class="elfsight-admin-page-preferences-option-info-name">
                    <?php _e('Custom JavaScript', $this->textDomain); ?>
                </h4>

                <div class="elfsight-admin-caption">
                    <?php _e('Here you can set the plugin\'s custom javascript code. The code will be added to each page with the widget.', $this->textDomain); ?>
                </div>
            </div>
            
            <div class="elfsight-admin-page-preferences-option-input-container">
                <div class="elfsight-admin-page-preferences-option-editor">
                    <div class="elfsight-admin-page-preferences-option-editor-code" id="elfsightPreferencesSnippetJS"><?php echo htmlspecialchars($preferences_custom_js) ?></div>
                </div>

                <div class="elfsight-admin-page-preferences-option-save-container">
                    <a href="#" class="elfsight-admin-page-preferences-option-js-save elfsight-admin-page-preferences-option-save elfsight-admin-button-green elfsight-admin-button">
                        <span class="elfsight-admin-page-preferences-option-save-label"><?php _e('Save', $this->textDomain); ?></span>

                        <span class="elfsight-admin-page-preferences-option-save-loader"></span>
                    </a>

                    <span class="elfsight-admin-page-preferences-option-save-success">
                        <span class="elfsight-admin-icon-check-green-small elfsight-admin-icon"></span><span class="elfsight-admin-page-preferences-option-save-success-label"><?php _e('Done!', $this->textDomain); ?></span>
                    </span>

                    <span class="elfsight-admin-page-preferences-option-save-error"></span>
                </div>
            </div>
        </div>
    </div>
</article>