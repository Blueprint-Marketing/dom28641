	function replaceSubstring(inSource, inToReplace, inReplaceWith)
	{
		return inSource.replace(new RegExp(inToReplace, 'g'),inReplaceWith);
	}
	function populate_tabs(title, description){

			var ul = jQuery('.add_tabs ul');
			var tab_number = ul.find('input[id^="title_"]').length;
			tab_number+=1;
			var title_id = 'title_'+tab_number;
			var description_id = 'description_'+tab_number;
			var tab_new = replaceSubstring(tabs_input, 'title_', title_id);
			tab_new = replaceSubstring(tab_new, 'description_', description_id);
	
			ul.append('<li>'+tab_new+'</li>');	
			jQuery('#'+title_id).val(title);
			jQuery('#'+description_id).text(description);
			
	}
	
	jQuery(document).ready(function($) {
		
		$('.add_tabs .add_tab').click(function(){
			var ul = $(this).parents().eq(1);
	
			var tab_number = ul.find('input[id^="title_"]').length;
			tab_number+=1;
			var title_id = 'title_'+tab_number;
			var description_id = 'description_'+tab_number;
			var tab_new = replaceSubstring(tabs_input, 'title_', title_id);
			tab_new = replaceSubstring(tab_new, 'description_', description_id);
	
			ul.append('<li>'+tab_new+'</li>');
		});
		
		$('#wprtabs_sectionid .add_tabs').on('click', 'a',function(){
			var obj = $(this).parents().eq(1);
			obj.slideUp();
			setTimeout(function(){ obj.remove(); }, 500);
		});
		
		$('.wprtabs_shortcodes').on('click', function(){
			$('.wprtabs_shortcodes_list').toggle();
		});
		
	});