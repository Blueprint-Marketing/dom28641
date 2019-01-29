<?php

// =============================================================================
// EMAIL-INTEGRATION/FUNCTIONS/ENQUEUE/SITE/STYLES.PHP
// -----------------------------------------------------------------------------
// Output site styles for the plugin. This file is included within the
// 'tco_head_css' action.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Output Site Styles
// =============================================================================

// Output Site Styles
// =============================================================================
?>
<style id="tco-email-forms-styles" type="text/css">
<?php if ( ! function_exists( 'CS' ) ) : ?>

.tco-subscribe-form fieldset {
  border: 0; margin-bottom: 0;
}
.tco-subscribe-form select,
.tco-subscribe-form input[type="text"],
.tco-subscribe-form input[type="email"],
.tco-subscribe-form textarea {
  width: 100%;
  margin-bottom: 0;
  font-size: inherit;
}
.tco-subscribe-form input::-webkit-input-placeholder,
.tco-subscribe-form textarea::-webkit-input-placeholder{color:#c5c5c5}
.tco-subscribe-form input::-moz-placeholder,
.tco-subscribe-form textarea::-moz-placeholder{color:#c5c5c5}
.tco-subscribe-form input:-ms-input-placeholder,
.tco-subscribe-form textarea:-ms-input-placeholder{color:#c5c5c5}

<?php else : ?>

.tco-subscribe-form fieldset {
    padding: 0;
    margin: 0;
    border: 0;
}

.tco-subscribe-form {
  position: relative;
}

.tco-subscribe-form h1 {
  font-size: 1.75em;
  margin: 0 0 0.5em;
}

.tco-subscribe-form label {
  margin: 0 0 0.375em;
  font-size: 0.85em;
  line-height: 1;
}

.tco-subscribe-form label > span {
  position: relative;
}

.tco-subscribe-form label .required {
  position: absolute;
  top: -0.1em;
  font-size: 1.5em;
}

.tco-subscribe-form select,
.tco-subscribe-form input[type="text"],
.tco-subscribe-form input[type="email"] {
  width: 100%;
  margin-bottom: 1.25em;
  font-size: inherit;
}

.tco-subscribe-form input[type="submit"] {
  display: inline-block;
  width: 100%;
  margin-top: 0.25em;
  font-size: inherit;
}

.tco-subscribe-form input[type="submit"]:focus {
  outline: 0;
}

.tco-subscribe-form .tco-subscribe-form-alert-wrap {
  margin-top: 1.25em;
  font-size: inherit;
}

.tco-alert{
  margin:0;border-left:4px solid #f6dca7;padding:0.915em 2.25em 1.15em 1.15em;font-size:14px;line-height:1.6;color:#c09853;background-color:#fcf8e3;border-radius:3px;
}
.tco-alert.tco-alert-block{
  padding:0.915em 1.15em 1.15em
}
.tco-alert .h-alert{
  margin:0 0 0.5em;padding:0;font-size:18px;letter-spacing:-0.05em;line-height:1.3;text-transform:none;color:inherit;clear:none;
}
.tco-alert .close{
  float:right;position:relative;top:-10px;right:-26px;border:0;padding:0;font-size:18px;line-height:1;text-decoration:none;color:#c09853;background-color:transparent;background-image:none;opacity:0.4;box-shadow:none;cursor:pointer;transition:opacity 0.3s ease;-webkit-appearance:none;
}
.tco-alert .close:hover{
  opacity:1
}
.tco-alert .close:focus{
  outline:0
}
.tco-alert p{
  margin-bottom:0
}
.tco-alert p+p{
  margin-top:6px
}
.tco-alert-muted{
  color:#999;border-color:#cfcfcf;background-color:#eee
}
.tco-alert-muted .close{
  color:#999
}
.tco-alert-info{
  color:#3a87ad;border-color:#b3d1ef;background-color:#d9edf7
}
.tco-alert-info .close{
  color:#3a87ad
}
.tco-alert-success{
  color:#468847;border-color:#c1dea8;background-color:#dff0d8
}
.tco-alert-success .close{
  color:#468847
}
.tco-alert-danger{
  color:#b94a48;border-color:#e5bdc4;background-color:#f2dede
}
.tco-alert-danger .close{
  color:#b94a48
}
.tco-map .tco-map-inner{
  overflow:hidden;position:relative;padding-bottom:56.25%;height:0
}
<?php endif; ?>
</style>
