jQuery(document).ready(function( $ ) {
	/*
	 * Color Picker
	 */
	$('.color-picker').wpColorPicker();
	$('#pm-thirtyx-label-clr').wpColorPicker(
		options = {
			color: '#ffffff',
		}
		);
	$('#pm-thirtyx-btn-clr').wpColorPicker(
		options = {
			color: '#3f6e9e',
		}
		);
	
	/*
	 * File upload/select
	 */
	$(document).on('click', '.file-upload', function(event) {
		event.preventDefault();
		var current = $(this);
	 	var frame = new wp.media.view.MediaFrame.Select({
			multiple: false,
			button: {
				text: 'Use This'
			}
		});
		frame.on('select', function() {
			var selection = frame.state().get('selection').first().toJSON();
			current.prev().val(selection.url);
			console.log(current.prev());
		});
		frame.open();
	});

	// Email API
	// Aweber
	$('#aweber_auth_code').on('paste', function(e) {
		setTimeout(function() {
			$('#AWCreds').text('One moment while we connect to Aweber');
			var aw_code = $('#aweber_auth_code').val();
			var data = {
				'action': 'pmill_aw_connect',
				'aw_code': aw_code
			};

			$.post(ajaxurl, data, function(jsonResponse) {
				//console.log(data);
				var response = jQuery.parseJSON(jsonResponse);
				if( typeof response == 'object' ) {
					$('#AWCreds').text('Great! Aweber responded. Let\'s check if the information is valid.');
					if(response['aw_consumerKey'] != null) {
						$('#AWCreds').text('Information is valid. One moment.');
						$('#aw_consumerKey').val(response['aw_consumerKey']);
						$('#aw_consumerSecret').val(response['aw_consumerSecret']);
						$('#aw_accessKey').val(response['aw_accessKey']);
						$('#aw_accessSecret').val(response['aw_accessSecret']);
						$('#AWCreds').text('Information received successful. Please Save Settings Now');
					}
				} else {
					$('#AWCreds').text('Something is wrong. Usually the key has become invalid or there is a connection issue. Please perform authorization again.');
				}
				//console.log(jsonResponse);
			});
		}, 300);		
	}); // End Aweber API
	// View form code
	$('#viewarcode').on('click', function(e) {
		$('#ar_advance').toggle();
	});

	/*
	 * Build 30X pages
	 */
	$(document).on('click', '#pm-thirtyx-build', function (event) {
		event.preventDefault();
		$('.pm-thirtyx-kwbox textarea').hide();
		$('.pm-thirtyx-kwbox button').hide();
		$('#pm-thirtyx-kwbox').addClass('pm-thirtyx-preloader');
		var data = {
			'action' : 'pm_thirtyx_build_pages',
			'keywords' : $('#pm-thirtyx-keywords').val(),
			'pg_type' : $('input[name="pm_thirtyx_pg_type"]:checked').val()
		};

		$.post(ajaxurl, data, function(response) {
			$('#pm-thirtyx-build-response').html(response);
			$('#pm-thirtyx-kwbox').removeClass('pm-thirtyx-preloader');
			$('.pm-thirtyx-kwbox textarea').show();
			$('.pm-thirtyx-kwbox button').show();
			console.log(response);
		});
	});
}); // End Wrapper