<?php

/**
 * Date: 05/05/16
 * Time: 12:26 AM
 */

class FHS_Reports_Quiz {

	public function __construct() {

		add_action( 'init', array( $this, 'individual_report_export_init' ) );
	}
		
	public function individual_report_export_init(){
		if ( check_ajax_referer( 'generate_quiz_report', 'nonce', false ) ){
			$quizId = $_GET['quiz_id'];
				
			/**
			 * plugins/sfwd-lms/includes/vendor/wp-pro-quiz/lib/view/WpProQuiz_View_StatisticsAjax.php
			 * showHistoryTable
			 */
			$statisticRefMapper = new WpProQuiz_Model_StatisticRefMapper();
			
			$count = $statisticRefMapper->countHistory($quizId);
			
			$statisticModel = $statisticRefMapper->fetchHistory($quizId, 0, $count );
			
			$view = new WpProQuiz_View_StatisticsAjax();
			$view->historyModel = $statisticModel;
			
			//Prepare header line
			$arr_header = array(
				'uname' => 'User Name',
				'quiz_attempt' => 'Attempt No',
			); 
			
			$quizMapper = new WpProQuiz_Model_QuizMapper();
			$questionMapper = new WpProQuiz_Model_QuestionMapper();
			$question = $questionMapper->fetchAll($quizId);
			
			$index = 1;
			foreach ( $question as $que_post  ){
				$arr_header[ 'q' . $index ] = 'Q' . $index;
				$index++;
			}
			$arr_header['time'] = 'Time';

			//Prepare user statistics data
			$arr_statistics = array();
			$total_time = 0;
			foreach($view->historyModel as $model) {
				
				$arr_userstatistics = array();
				
				//User name
				$arr_userstatistics['uname'] = $model->getUserName();
				$user_ID = $model->getUserID();
				//$arr_userstatistics['ID'] = $user_ID ;
				/**
				 * Prepare User answers data
				 *
				 * plugins/sfwd-lms/includes/vendor/wp-pro-quiz/lib/controller/WpProQuiz_Controller_Statistics.php
				 * ajaxLoadStatisticUser
				 */
				$statisticUserMapper = new WpProQuiz_Model_StatisticUserMapper();
				$statisticUsers = $statisticUserMapper->fetchUserStatistic( $model->getStatisticRefId(), $quizId, 0);
				// echo"<pre>";
				// print_r($statisticUserMapper);
				// echo"</pre>";
				global $wpdb;				
					$result = $wpdb->get_results  
								("
								SELECT count(quiz_id) as 'quiz_id' 
								FROM `wp_wp_pro_quiz_statistic_ref` 
								WHERE user_id = '".$user_ID."' order by create_time ASC
								");
						$data = $result[0]->quiz_id;
						for($i = 1; $i <= $data; $i++){
							$arr_userstatistics['quiz_attempt'] =  $i;
						} 
				 $index = 1;
				foreach($statisticUsers as $statistic) {
					$questionId = $statistic->getQuestionId();
					if ( !empty( $questionId ) ) {
						$arr_userstatistics[ 'q' . $index ] = array(
							'correct' => empty( $statistic->getCorrectCount()  ) ? 0 : 1,
							'answer' => $this->get_answers( $statistic ),
						);
						$arr_userstatistics['time'] += $statistic->getQuestionTime();
					}
					$index++;
				}
				
				$total_time += $arr_userstatistics['time'];
				$arr_userstatistics['time'] = WpProQuiz_Helper_Until::convertToTimeString( $arr_userstatistics['time'] );
				$arr_statistics[] = $arr_userstatistics;

			}
			//Calculate AVG quiz time
			$avgTime = $total_time / count( $arr_statistics );
			$avgTime = WpProQuiz_Helper_Until::convertToTimeString( $avgTime );

			$this->csv_export( $arr_header, $arr_statistics, array( 'avg_time' => $avgTime, 'ID' => $quizId ) );
		}
	}
	
	private function get_answers( $statistic ){
		$answers = array();
		$statistcAnswerData = $statistic->getStatisticAnswerData();
		switch ( $statistic->getAnswerType() ){
			case 'single':
            case 'multiple':
                $demo_answer = range('A', 'Z');
				foreach ( $statistcAnswerData as $key => $AnswerData ){
					if ( 1 === $AnswerData ){
						$answers[] = $demo_answer[ $key ];
					}
				}
				break;
		}
		return implode( ',', $answers );
	}
	
	Private function csv_export( $header, $report_data, $extra ){
		error_reporting( 0 );
		set_time_limit( 0 );
		
		$quizId = $_GET['quiz_id'];
		if($quizId == 8){
		$file_name =   'Quiz_' . '1003' . '_Report.xlsx';
		}
		elseif($quizId == 9){
		$file_name =   'Quiz_' . '1004' . '_Report.xlsx';
	 } 
		
		/**
		 * include parseCSV to write csv file
		 */
		require_once( fhs_reports()->plugin_dir . 'vendor/PHPExcel/Classes/PHPExcel.php' );
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getProperties()->setTitle( 'Quiz Report' );
		$objPHPExcel->getProperties()->setCreator( 'Food Handler Solution' );
		$objPHPExcel->setActiveSheetIndex(0);
		
		$arr_cols = array();
		
		$row = 1;
		$col = 0;
		if ( ! empty( $header ) ){
			foreach ( $header as $key => $item ){
				$colString = PHPExcel_Cell::stringFromColumnIndex($col);
				$arr_cols[ $key ] = $colString;
				$objPHPExcel->getActiveSheet()->setCellValue($colString.$row, $item );
				$col++;
			}
			$row++;
		}

		if ( ! empty( $report_data ) ){
			foreach ( $report_data as $r_item ){
			    $index = 0;
				foreach ( $arr_cols as $key => $item ){
					if ( isset( $r_item[$key] ) ) {
						if ( isset( $r_item[ $key ]['answer'] ) ) {
							$objPHPExcel->getActiveSheet()->setCellValue($item.$row, $r_item[$key]['answer'] );

                            //Highlight correct/incorrect
                            if ( 1 == $r_item[ $key ]['correct'] ){
                                $objPHPExcel->getActiveSheet()->getStyle($item.$row . ":" . $item.$row)->applyFromArray(
                                    array(
                                        'borders' => array(
                                            'allborders' => array(
                                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                'color' => array('rgb' => '7CFC00')
                                            )
                                        )
                                    )
                                );
                            } else {
                                $objPHPExcel->getActiveSheet()->getStyle($item.$row . ":" . $item.$row)->applyFromArray(
                                    array(
                                        'borders' => array(
                                            'allborders' => array(
                                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                'color' => array('rgb' => 'FF0000')
                                            )
                                        )
                                    )
                                );
                            }

						} else {
							$objPHPExcel->getActiveSheet()->setCellValue($item.$row, $r_item[$key] );
						}
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue($item.$row, '' );
					}
                    $index++;
				}
				$row++;
			}
		}

        if ( ! empty( $extra['avg_time'] ) ) {

            $count = count( $arr_cols );
            $colString = PHPExcel_Cell::stringFromColumnIndex($count-2 );
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Avg Quiz Time');

            $objPHPExcel->getActiveSheet()->mergeCells('A'.$row . ':' . $colString . $row );
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row . ':' . $colString . $row )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row . ':' . $colString . $row )->getFont()->setBold(true);

            $colString = PHPExcel_Cell::stringFromColumnIndex($count-1 );
            $objPHPExcel->getActiveSheet()->setCellValue($colString . $row, $extra['avg_time']);
        }
		
		$objWriter = new PHPExcel_Writer_Excel2007( $objPHPExcel );
		
		$reportDir = fhs_reports()->plugin_dir . '../../uploads/reports/';
		if ( ! file_exists( $reportDir ) ) {
			wp_mkdir_p( $reportDir );
			
		}
		$v= $objWriter->save( $reportDir . $file_name );
		 
		if ( file_exists( $reportDir . $file_name ) ){
			
			wp_redirect( fhs_reports()->plugin_url . '../../uploads/reports/' . $file_name );
			
		}
		die();
	}


}
