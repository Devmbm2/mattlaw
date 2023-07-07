<?php
class PLEA_PleadingsController extends SugarController{
	function __construct(){
		parent::__construct();
	}
	function action_get_related_case_lawyer() {
		ob_clean();
		$fetched_record = array();
		$case_id = $_REQUEST['case_id'];
		if(!empty($case_id)){
			$case = BeanFactory::getBean('Cases', $case_id);
			if(!empty($case->default_assistant_lawyer_name || $case->default_assistant_lawyer_id || $case->assigned_user_name || $case->assigned_user_id)){
				$fetched_record[] = ["default_assistant_lawyer_name" =>$case->default_assistant_lawyer_name,"default_assistant_lawyer_id" =>$case->default_assistant_lawyer_id,"assigned_user_name" =>$case->assigned_user_name,
                            "assigned_user_id" =>$case->assigned_user_id];
				echo json_encode($fetched_record);die();
			}else{
				echo '';die;
			}
		}else{
			echo '';die;
		}
	
	}
}