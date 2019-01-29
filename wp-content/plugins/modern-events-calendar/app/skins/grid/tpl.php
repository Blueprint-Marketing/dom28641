<?php
/** no direct access **/
defined('_MECEXEC_') or die();

// Get layout path
$render_path = $this->get_render_path();

ob_start();
include $render_path;
$items_html = ob_get_clean();

if(isset($this->atts['return_items']) and $this->atts['return_items'])
{
    echo json_encode(array('html'=>$items_html, 'end_date'=>$this->end_date, 'offset'=>$this->next_offset, 'count'=>$this->found));
    exit;
}

// Generating javascript code tpl
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery("#mec_skin_'.$this->id.'").mecGridView(
    {
        id: "'.$this->id.'",
        start_date: "'.$this->start_date.'",
        end_date: "'.$this->end_date.'",
		offset: "'.$this->next_offset.'",
		limit: "'.$this->limit.'",
        atts: "'.http_build_query(array('atts'=>$this->atts), '', '&').'",
        ajax_url: "'.admin_url('admin-ajax.php?lang=ru', NULL).'",
        sed_method: "'.$this->sed_method.'",
        sf:
        {
            container: "'.($this->sf_status ? '#mec_search_form_'.$this->id : '').'",
        },
    });
});
</script>';

// Include javascript code into the footer
$this->factory->params('footer', $javascript);
?>
<div class="mec-wrap mec-skin-grid-container <?php echo $this->html_class; ?>" id="mec_skin_<?php echo $this->id; ?>">
    
    <?php if($this->sf_status) echo $this->sf_search_form(); ?>
    
    <?php if($this->found): ?>
    <div class="mec-skin-grid-events-container" id="mec_skin_events_<?php echo $this->id; ?>">
        <?php echo $items_html; ?>
    </div>
    <div class="mec-skin-grid-no-events-container mec-util-hidden" id="mec_skin_no_events_<?php echo $this->id; ?>">
        <?php _e('No event found!', 'mec'); ?>
    </div>
    <?php else: ?>
    <div class="mec-skin-grid-events-container" id="mec_skin_events_<?php echo $this->id; ?>">
        <?php _e('No event found!', 'mec'); ?>
    </div>
    <?php endif; ?>
    
    <?php if($this->load_more_button and $this->found >= $this->limit): ?>
    <div class="mec-load-more-wrap"><div class="mec-load-more-button" onclick=""><?php echo __('Load More', 'mec'); ?></div></div>
    <?php endif; ?>
    
</div>
<?php /** Append JS codes for full-calendar skin **/ if(isset($this->atts['append_js_codes']) and $this->atts['append_js_codes']) echo $javascript;