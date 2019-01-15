<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $import_success, $import_error;
?>
<div class="wrap">
    <h2>
        <?php _e('Import Blog Layouts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
    </h2>
    <?php
    if (isset($import_error)) {
        ?>
        <div class="error notice">
            <p><?php echo $import_error; ?></p>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($import_success)) {
        ?>
        <div class="updated notice">
            <p><?php echo $import_success; ?></p>
        </div>
        <?php
    }
    ?>
    <div class="narrow">
        <p>
            <?php _e('Select import type and Choose a .txt file to upload, then click Upload file and import', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
        </p>
        <form method="post" id="bdp-import-upload-form" class="bdp-upload-form" enctype="multipart/form-data" name="bdp-import-upload-form">
            <p>
                <?php wp_nonce_field('bdp_import', 'bdp_import_nonce'); ?>
                <label><?php _e('Import Type', BLOGDESIGNERPRO_TEXTDOMAIN); ?> : </label>
                <select id="layout_import_types" name="layout_import_types">
                    <option value=""><?php _e('Please Select', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                    <option value="blog_layouts"><?php _e('Blog Layouts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                    <option value="archive_layouts"><?php _e('Archive Layouts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                    <option value="single_layouts"><?php _e('Single Layouts', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                </select>
            </p>
            <p>
                <label for="bdp_import_layout"><?php _e('Choose a file from your computer', BLOGDESIGNERPRO_TEXTDOMAIN); ?> : </label>
                <input type="file" id="bdp_import_layout" name="bdp_import">
                <?php _e('To download Sample Blog Layout, please', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <a class="download-sample-layout" href="<?php echo BLOGDESIGNERPRO_URL . '/admin/assets/sample_layout.txt' ?>" download><?php _e('click here', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </p>
            <p>
                <strong><?php _e('Note', BLOGDESIGNERPRO_TEXTDOMAIN); ?>:</strong> <?php _e('If you have an query or face any issue while importing layout, please refer', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#import_export'); ?>" target="_blank"><?php _e('Blog Designer PRO Document', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </p>
            <p class="submit">
                <input id="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Upload file and import', BLOGDESIGNERPRO_TEXTDOMAIN) ?>" name="submit">
            </p>

        </form>
    </div>
</div>