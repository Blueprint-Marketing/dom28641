<?php

class FHS_Reports_Common {

	
	function __construct() {

		$this->hooks();

	}

	function hooks() {
	
		add_action( 'admin_footer', array( $this, 'add_reports_link' ) );
	
	}
	
	public function add_reports_link(){
		global $pagenow;
		if ( 'admin.php' === $pagenow && ! empty( $_GET['page'] ) && 'ldAdvQuiz' === $_GET['page'] && ! empty( $_GET['module'] ) && 'statistics' === $_GET['module'] ){
			$quiz_nonce = wp_create_nonce( 'generate_quiz_report' );
		    $url = add_query_arg( array( 'page' => $_GET['page'], 'module' => $_GET['module'], 'quiz_id' => $_GET['id'], 'nonce' => $quiz_nonce ),admin_url( 'admin.php?' ) );
		    $html = '<a id ="exam_url"  class="button-primary" href="' . $url . '">Exam Report</a>'
        
		 ?>
			<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
			<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <style>
                .wpProQuiz_report_tab {
                    text-align: right;
                    position: relative;
                    top: -40px;
                    margin-left: 500px;
                } 
            </style>
			<script>
				jQuery('.wpProQuiz_tab_wrapper').after( '<div class="wpProQuiz_report_tab">Date From: <input type="text" id="datefrom" class="datepicker"> Date To: <input type="text" id="dateto"  class="datepicker"> <?php echo $html; ?> </div>' );
				jQuery(document).ready(function() {
					jQuery(".datepicker").datepicker();
					
						jQuery("a#exam_url").click(function(){
							var datefrom1 = jQuery("#datefrom").val();
							var dateto1 = jQuery("#dateto").val();
								if(datefrom1 == ''){
										alert("Select a Date");
										jQuery('a#exam_url').attr( 'href', '' );				
								}
								   else if(dateto1 == ''){
									   alert("Select a Date");
									   jQuery('a#exam_url').attr( 'href', '' );	
								}
								else{
									setTimeout(function(){
									jQuery('a#exam_url').attr('href','<?php echo $url;?>');
									jQuery('.datepicker ').val('');
									 }, 3000); 
									 
								} 
						});	  
				 
						jQuery("#datefrom").on("change",function(){
								var date_from = jQuery(this).val();
								var timeStamp = function(str) {
								return new Date(str.replace(/^(\d{2}\-)(\d{2}\-)(\d{4})$/,'$2$1$3')).getTime();};
								var date_from_stamp = timeStamp(date_from);
									var num = date_from_stamp; 
									var str = num.toString(); 
									var result = str.substring(0,10)  
									result = parseInt(result);
					
								 $('a#exam_url').each(function(){
								 this.href += "&datefrom=" + result;
								}) 
						 });
						
						 jQuery("#dateto").on("change",function(){
								var date_to = jQuery(this).val();
								var timeStamp = function(str) {
								return new Date(str.replace(/^(\d{2}\-)(\d{2}\-)(\d{4})$/,'$2$1$3')).getTime();};
								var date_to_stamp = timeStamp(date_to);
								var num = date_to_stamp; 
									var str = num.toString(); 
									var result = str.substring(0,10)  
									result = parseInt(result);
									
								$('a#exam_url').each(function(){
								 this.href += "&dateto=" + result;
								})
						 });  
				});
				 
				 
				 </script>
			
			<?php
		}
	}
}