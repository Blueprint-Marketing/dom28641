( function( $ ) {
	
	jQuery(document).ready(function() {
		$('form#loginform .login-submit').after('<a href="/forgot-password" id="forgot">Forgot Password?</a>');
		$(".menu-item-has-children").addClass("clearfix");
		$('.usaHtml5MapStateInfo').bind("DOMNodeInserted DOMNodeRemoved", function(){
			window.scrollTo(0, $( ".usaHtml5MapStateInfo" ).offset().top - 100);
			console.log( $( ".usaHtml5MapStateInfo" ).offset().top );
		});
		if($(document).width() <= 1125){
			$('.sfh-legend').insertBefore($('.sfh-legend').prev('.sfh-step-group'));
			console.log("2");
		}else{
			$('.sfh-step-group').insertBefore($('.sfh-step-group').prev('.sfh-legend'));
			console.log("3");
		}
		$(window).resize(function(){
			console.log("1");
			if($(document).width() <= 1125){
				$('.sfh-legend').insertBefore($('.sfh-legend').prev('.sfh-step-group'));
				console.log("2");
			}else{
				$('.sfh-step-group').insertBefore($('.sfh-step-group').prev('.sfh-legend'));
				console.log("3");
			}
		});
		$("#terms").prop('disabled', true);

	});

} )( jQuery );



jQuery(document).on("blur",function() {
	alert("");
	$("#terms").prop('disabled', true);
	$(document).on("change",function() {
		if($("#discrete_checker").is(":checked") && $("#information_checker").is(":checked")){
			$("#terms").prop('disabled', false);
		}else{
			$("#terms").prop('disabled', true);
		}
	});
});

