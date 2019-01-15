<?php

// =============================================================================
// EMAIL-INTEGRATION/FUNCTIONS/ADMIN/CPT-METABOXES.PHP
// -----------------------------------------------------------------------------
// Describe and declare metaboxes to be used with our post type.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Variables
//   02. Form
//   03. Appearance (General)
//   04. Appearance (Form Container)
//   05. Appearance (Form)
//   06. Sidebar
//   07. Add Meta Boxes
// =============================================================================

// Variables
// =============================================================================

$id          = $this->slug;
$master_list = $this->format_master_list_for_mb();



// Form
// =============================================================================

$meta_box_form = array(
  'id'          => 'email-forms-form',
  'title'       => __( 'Form', '__tco__' ),
  'description' => __( 'Here you will find various options you can use to setup your form and the functionality associated with it.', '__tco__' ),
  'page'        => 'email-forms',
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'name'    => __( 'Email List/Form/Campaign', '__tco__' ),
      'desc'    => __( 'Choose a list/form/campaign where subscribers from this form should be added. (MailChimp uses "lists", ConvertKit uses "Forms" and GetResponse uses "Campaigns" to group subscriptions)', '__tco__' ),
      'id'      => $id . '_list',
      'type'    => 'select',
      'std'     => 'Select a List',
      'options' => ( empty( $master_list ) ) ? array( 'No Lists Found' ) : $master_list,
    ),
    array(
      'name'    => __( 'Confirmation Method', '__tco__' ),
      'desc'    => __( 'When a subscription is successful, would you like to display a message or redirect the user to a page?', '__tco__' ),
      'id'      => $id . '_confirmation_type',
      'type'    => 'radio',
      'std'     => 'Message',
      'options' => array( 'Message', 'Redirect' )
    ),
    array(
      'name' => __( 'Confirmation Message', '__tco__' ),
      'desc' => __( 'Enter your message to display to the user after successfully subscribing.', '__tco__' ),
      'id'   => $id . '_confirmation_message',
      'type' => 'textarea',
      'std'  => __( 'Thank you! You are now subscribed.', '__tco__' ),
    ),
    array(
      'name' => __( 'Confirmation Redirect', '__tco__' ),
      'desc' => __( 'Enter the URL to redirect your users to after successfully subscribing.', '__tco__' ),
      'id'   => $id . '_confirmation_redirect',
      'type' => 'text',
      'std'  => home_url( 'thank-you/' ),
    ),
    array(
      'name'    => __( 'Show Title', '__tco__' ),
      'desc'    => __( 'Turn this on to enable a title before your form.', '__tco__' ),
      'id'      => $id . '_show_title',
      'type'    => 'radio',
      'std'     => 'No',
      'options' => array( 'Yes', 'No' )
    ),
    array(
      'name' => __( 'Title', '__tco__' ),
      'desc' => __( 'Enter your title text here.', '__tco__' ),
      'id'   => $id . '_title',
      'type' => 'text',
      'std'  => 'But Wait, There\'s More!',
    ),
    array(
      'name'    => __( 'Name Field', '__tco__' ),
      'desc'    => __( 'Select how you would like the name field presented.', '__tco__' ),
      'id'      => $id . '_name_display',
      'type'    => 'select',
      'std'     => 'Full (Combined)',
      'options' => array( 'None', 'First', 'Last', 'Full (Separate)', 'Full (Combined)' )
    ),
    array(
      'name' => __( 'First Name Placeholder', '__tco__' ),
      'desc' => __( 'Text inside the name field before a user types.', '__tco__' ),
      'id'   => $id . '_first_name_placeholder',
      'type' => 'text',
      'std'  => 'John',
    ),
    array(
      'name' => __( 'Last Name Placeholder', '__tco__' ),
      'desc' => __( 'Text inside the name field before a user types.', '__tco__' ),
      'id'   => $id . '_last_name_placeholder',
      'type' => 'text',
      'std'  => 'Smith',
    ),
    array(
      'name' => __( 'Full Name Placeholder', '__tco__' ),
      'desc' => __( 'Text inside the name field before a user types.', '__tco__' ),
      'id'   => $id . '_full_name_placeholder',
      'type' => 'text',
      'std'  => 'John Smith',
    ),
    array(
      'name'    => __( 'Name Requirement', '__tco__' ),
      'desc'    => __( 'Should entering a name be required? If "No," it may still be displayed based on your settings but will be considered optional.', '__tco__' ),
      'id'      => $id . '_name_required',
      'type'    => 'radio',
      'std'     => 'No',
      'options' => array( 'Yes', 'No' )
    ),
    array(
      'name' => __( 'Email Field Placeholder', '__tco__' ),
      'desc' => __( 'Text inside the email field before a user types.', '__tco__' ),
      'id'   => $id . '_email_placeholder',
      'type' => 'text',
      'std'  => 'john.smith@example.com',
    ),
    array(
      'name' => __( 'Submit Button Text', '__tco__' ),
      'desc' => __( 'Text inside the submit button.', '__tco__' ),
      'id'   => $id . '_submit_label',
      'type' => 'text',
      'std'  => 'Subscribe!',
    ),
    array(
      'name'    => __( 'Show Labels', '__tco__' ),
      'desc'    => __( 'Turn this on to enable labels before your inputs.', '__tco__' ),
      'id'      => $id . '_show_labels',
      'type'    => 'radio',
      'std'     => 'No',
      'options' => array( 'Yes', 'No' )
    ),
    array(
      'name' => __( 'First Name Label', '__tco__' ),
      'desc' => __( 'Text displayed before the first name input.', '__tco__' ),
      'id'   => $id . '_first_name_label',
      'type' => 'text',
      'std'  => 'First Name',
    ),
    array(
      'name' => __( 'Last Name Label', '__tco__' ),
      'desc' => __( 'Text displayed before the last name input.', '__tco__' ),
      'id'   => $id . '_last_name_label',
      'type' => 'text',
      'std'  => 'Last Name',
    ),
    array(
      'name' => __( 'Full Name Label', '__tco__' ),
      'desc' => __( 'Text displayed before the full name input.', '__tco__' ),
      'id'   => $id . '_full_name_label',
      'type' => 'text',
      'std'  => 'Name',
    ),
    array(
      'name' => __( 'Email Label', '__tco__' ),
      'desc' => __( 'Text displayed before the email input.', '__tco__' ),
      'id'   => $id . '_email_label',
      'type' => 'text',
      'std'  => 'Email Address',
    ),
  )
);



// Appearance (General)
// =============================================================================

$meta_box_appearance_general = array(
  'id'          => 'email-forms-appearance-general',
  'title'       => __( 'Appearance (General)', '__tco__' ),
  'description' => __( 'Specify your desired general appearance settings for the form.', '__tco__' ),
  'page'        => 'email-forms',
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'name' => __( 'Custom Class', '__tco__' ),
      'desc' => __( 'This will be applied to the containing element so you can target this form specifically with CSS.', '__tco__' ),
      'id'   => $id . '_class',
      'type' => 'text',
      'std'  => '',
    ),
    array(
      'name' => __( 'Font Size', '__tco__' ),
      'desc' => __( 'Allows you to determine the overall font size for this form. Larger fonts will result in larger inputs.', '__tco__' ),
      'id'   => $id . '_font_size',
      'type' => 'text',
      'std'  => '18px',
    ),
    array(
      'name' => __( 'Max Width', '__tco__' ),
      'desc' => __( 'Specify the maximum width of your form.', '__tco__' ),
      'id'   => $id . '_max_width',
      'type' => 'text',
      'std'  => '250px',
    ),
  )
);

// if custom styling
if ( function_exists( 'CS' ) ) {

  $meta_box_appearance_general['fields'][] = array(
    'name'    => __( 'Custom Styling', '__tco__' ),
    'desc'    => __( 'Turning on custom styling will allow you to have greater flexibility over the appearance of your form.', '__tco__' ),
    'id'      => $id . '_custom_styling',
    'type'    => 'radio',
    'std'     => 'No',
    'options' => array( 'Yes', 'No' )
  );

  // Appearance (Form Container)
  // =============================================================================

  $meta_box_appearance_form_container = array(
    'id'          => 'email-forms-appearance-form-container',
    'title'       => __( 'Appearance (Form Container)', '__tco__' ),
    'description' => __( 'Specify your desired appearance settings for the form container.', '__tco__' ),
    'page'        => 'email-forms',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name'    => __( 'Inner Container', '__tco__' ),
        'desc'    => __( 'Choose whether or not you would like an inner container element placed around your form.', '__tco__' ),
        'id'      => $id . '_inner_container',
        'type'    => 'radio',
        'std'     => 'No',
        'options' => array( 'Yes', 'No' )
      ),
      array(
        'name'    => __( 'Remove Margin', '__tco__' ),
        'desc'    => __( 'Choose whether or not you would like to remove the margin. This is good to keep if placed on a standard page or post, but if you are creating a custom homepage and using this as a fullwidth content band, then it is typically best to remove this.', '__tco__' ),
        'id'      => $id . '_remove_margin',
        'type'    => 'radio',
        'std'     => 'No',
        'options' => array( 'Yes', 'No' )
      ),
      array(
        'name'    => __( 'Border', '__tco__' ),
        'desc'    => __( 'Optionally include a subtle border around your form container. Select which sides you would like it to appear on (if any).', '__tco__' ),
        'id'      => $id . '_border',
        'type'    => 'select',
        'std'     => 'None',
        'options' => array( 'None', 'Top', 'Left', 'Right', 'Bottom', 'Vertical', 'Horizontal', 'All' )
      ),
      array(
        'name' => __( 'Padding', '__tco__' ),
        'desc' => __( 'Specify the padding for your form container. You can use this like a normal CSS "padding" property and set all sides at once (e.g. 40px), individual sides (e.g. 45px 60px 50px 60px), et cetera.', '__tco__' ),
        'id'   => $id . '_padding',
        'type' => 'text',
        'std'  => '45px',
      ),
      array(
        'name'    => __( 'Background Option', '__tco__' ),
        'desc'    => __( 'Choose what type of background you would like to have for your form.', '__tco__' ),
        'id'      => $id . '_bg_option',
        'type'    => 'select',
        'std'     => 'Transparent',
        'options' => array( 'Transparent', 'Color', 'Pattern', 'Image', 'Video' )
      ),
      array(
        'name' => __( 'Background Color', '__tco__' ),
        'desc' => __( 'Select the background color for your form.', '__tco__' ),
        'id'   => $id . '_bg_color',
        'type' => 'color',
        'std'  => '#ffffff'
      ),
      array(
        'name' => __( 'Background Pattern', '__tco__' ),
        'desc' => __( 'Use this field to upload your repeatable background pattern.', '__tco__' ),
        'id'   => $id . '_bg_pattern',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name' => __( 'Background Image', '__tco__' ),
        'desc' => __( 'Use this field to upload your background image.', '__tco__' ),
        'id'   => $id . '_bg_image',
        'type' => 'uploader',
        'std'  => ''
      ),
      array(
        'name'    => __( 'Parallax', '__tco__' ),
        'desc'    => __( 'Choose whether or not you would like a parallax effect to be applied to your background pattern or image.', '__tco__' ),
        'id'      => $id . '_bg_parallax',
        'type'    => 'radio',
        'std'     => 'No',
        'options' => array( 'Yes', 'No' )
      ),
      array(
        'name' => __( 'Background Video', '__tco__' ),
        'desc' => __( 'Input the .mp4 URL to a video you would like to use as your background.', '__tco__' ),
        'id'   => $id . '_bg_video',
        'type' => 'text',
        'std'  => '',
      ),
      array(
        'name' => __( 'Background Video Poster', '__tco__' ),
        'desc' => __( 'Use this field to upload your background video poster, which will be used on mobile devices instead of your background video for performance reasons.', '__tco__' ),
        'id'   => $id . '_bg_video_poster',
        'type' => 'uploader',
        'std'  => ''
      )
    )
  );



  // Appearance (Form)
  // =============================================================================

  $meta_box_appearance_form = array(
    'id'          => 'email-forms-appearance-form',
    'title'       => __( 'Appearance (Form)', '__tco__' ),
    'description' => __( 'Specify your desired appearance settings for the form.', '__tco__' ),
    'page'        => 'email-forms',
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'name' => __( 'Title', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_title_color',
        'type' => 'color',
        'std'  => '#ffffff'
      ),
      array(
        'name' => __( 'Labels', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_label_color',
        'type' => 'color',
        'std'  => '#ffffff'
      ),
      array(
        'name'    => __( 'Button Shape', '__tco__' ),
        'desc'    => __( 'Select your button shape for the form.', '__tco__' ),
        'id'      => $id . '_button_shape',
        'type'    => 'select',
        'std'     => 'Rounded',
        'options' => array( 'Square', 'Rounded', 'Pill' )
      ),
      array(
        'name'    => __( 'Button Style', '__tco__' ),
        'desc'    => __( 'Select your button style for the form.', '__tco__' ),
        'id'      => $id . '_button_style',
        'type'    => 'select',
        'std'     => '3D',
        'options' => array( '3D', 'Flat', 'Transparent' )
      ),
      array(
        'name' => __( 'Button Text', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_text_color',
        'type' => 'color',
        'std'  => '#ffffff'
      ),
      array(
        'name' => __( 'Button Background', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_bg_color',
        'type' => 'color',
        'std'  => '#ff2a13'
      ),
      array(
        'name' => __( 'Button Border', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_border_color',
        'type' => 'color',
        'std'  => '#ac1100'
      ),
      array(
        'name' => __( 'Button Bottom', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_bottom_color',
        'type' => 'color',
        'std'  => '#a71000'
      ),
      array(
        'name' => __( 'Button Text Hover', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_text_color_hover',
        'type' => 'color',
        'std'  => '#ffffff'
      ),
      array(
        'name' => __( 'Button Background Hover', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_bg_color_hover',
        'type' => 'color',
        'std'  => '#ef2201'
      ),
      array(
        'name' => __( 'Button Border Hover', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_border_color_hover',
        'type' => 'color',
        'std'  => '#600900'
      ),
      array(
        'name' => __( 'Button Bottom Hover', '__tco__' ),
        'desc' => __( 'Select your color.', '__tco__' ),
        'id'   => $id . '_button_bottom_color_hover',
        'type' => 'color',
        'std'  => '#a71000'
      ),
    )
  );

} // endif custom styling

// Sidebar
// =============================================================================

function email_forms_sidebar_meta_box() { ?>
  <p>Once you have finished setting up your form, head back over to the Email Forms list to locate your generated shortcode.</p>
  <p><a href="<?php echo admin_url( 'admin.php?page=tco-extensions-email-forms' ); ?>" class="button">Go to Email Forms List</a></p>
<?php }



// Add Meta Boxes
// =============================================================================

tco_add_meta_box( $meta_box_form );
tco_add_meta_box_mailchimp();
tco_add_meta_box_custom_field();
tco_add_meta_box( $meta_box_appearance_general );
// if custom styling
if ( function_exists( 'CS' ) ) {
  tco_add_meta_box( $meta_box_appearance_form_container );
  tco_add_meta_box( $meta_box_appearance_form );
}
add_meta_box( 'email-forms-sidebar', __( 'After Publication', '__tco__' ), 'email_forms_sidebar_meta_box', 'email-forms', 'side', 'default' );
