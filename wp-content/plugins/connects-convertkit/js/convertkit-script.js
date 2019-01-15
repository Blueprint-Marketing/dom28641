// JavaScript Document

jQuery(document).on("change keyup paste keydown","#convertkit_api_key", function(e) {
	var val = jQuery(this).val();
	if( val !== "" )
		jQuery("#auth-convertkit").removeAttr('disabled');
	else
		jQuery("#auth-convertkit").attr('disabled','true');
});

jQuery(document).on( "click", "#auth-convertkit", function(e){
	e.preventDefault();
	jQuery(".smile-absolute-loader").css('visibility','visible');
	var convertkit_api_key = jQuery("#convertkit_api_key").val();
	
	var action = 'update_convertkit_authentication';
	var data = {action:action,convertkit_api_key:convertkit_api_key};
	jQuery.ajax({
		url: ajaxurl,
		data: data,
		type: 'POST',
		dataType: 'JSON',
		success: function(result){
			if(result.status == "success" ){
				jQuery(".bsf-cnlist-mailer-help").hide();
				jQuery("#save-btn").removeAttr('disabled');
				jQuery("#convertkit_api_key").closest('.bsf-cnlist-form-row').hide();
				jQuery("#auth-convertkit").closest('.bsf-cnlist-form-row').hide();
				jQuery(".convertkit-list").html(result.message);

			} else {
				jQuery(".convertkit-list").html('<span class="bsf-mailer-success">'+result.message+'</span>');
			}
			jQuery(".smile-absolute-loader").css('visibility','hidden');
		}
	});
	e.preventDefault();
});

jQuery(document).on( "click", "#disconnect-convertkit", function(){
															
	if(confirm("Are you sure? If you disconnect, your previous campaigns syncing with ConvertKit will be disconnected as well.")) {
		var action = 'disconnect_convertkit';
		var data = {action:action};
		jQuery(".smile-absolute-loader").css('visibility','visible');
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			type: 'POST',
			dataType: 'JSON',
			success: function(result){
				
				jQuery("#save-btn").attr('disabled','true');
				if(result.message == "disconnected" ){
					jQuery("#convertkit_api_key").val('');
					jQuery(".convertkit-list").html('');
					jQuery("#disconnect-convertkit").replaceWith('<button id="auth-convertkit" class="button button-secondary auth-button" disabled="true">Authenticate ConvertKit</button><span class="spinner" style="float: none;"></span>');
					jQuery("#auth-convertkit").attr('disabled','true');
				}

				jQuery('.bsf-cnlist-form-row').fadeIn('300');
				jQuery(".bsf-cnlist-mailer-help").show();
				jQuery(".smile-absolute-loader").css('visibility','hidden');
			}
		});
	}
	else {
		return false;
	}
});