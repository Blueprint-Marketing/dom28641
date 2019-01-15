<?php $string = addslashes(preg_replace("/[\r\n]+/",' ',(preg_replace('/\s\s+/', ' ', get_include_contents("admin/wprtabs_inputs.php"))))); ?>
<script type="text/javascript" language="javascript">
var tabs_input = '<?php echo $string; ?>';
</script>
<div class="add_tabs">
<ul>
<li><input type="button" value="<?php _e('Add Tab'); ?>" class="button add_tab"></li>
</ul>

</div>

<div class="tabs_settings">
<ul>
<li>

</li>
</ul>
</div>
<?php if(!empty($tab_titles)): ?>
<script type="text/javascript" language="javascript">
<?php foreach($tab_titles as $key=>$titles): ?>
populate_tabs('<?php echo $titles; ?>', '<?php echo  str_replace(array('&quot;', '&lt;', '&gt;'), array('', '<', '>'), htmlspecialchars(json_encode($tab_descriptions[$key]), ENT_QUOTES, 'UTF-8')); ?>');
<?php endforeach; ?>
</script>
<?php endif; ?>