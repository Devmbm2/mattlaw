<?php 	
		
 require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
 		$workflow = new ht_AOW_WorkFlow();
		$discovery_id= $_REQUEST['discovery_id'];

if($discovery_id!="")
 {
 	   		 $related_discovery = BeanFactory::getBean('DISC_Discovery', $discovery_id);
         	 $case_id=$related_discovery->disc_discovery_casescases_ida;
		     $workflow_ids=array();
		     $workflow_ids= $_REQUEST['get_ids'];
		     $workflow_arr = explode (",", $workflow_ids);
			 $result = array_unique($workflow_arr);
			 $workflow_arr=$result;
  if($workflow_ids!="")
   {
	 foreach ($workflow_arr as $id) 
	 {	
		$workflow_proc = BeanFactory::getBean('AOW_Processed');
			$query_p= " aow_processed.parent_id ='$case_id' AND  aow_processed.aow_workflow_id ='$id' 
					AND  aow_processed.status ='Complete'";
		$check_processed= $workflow_proc->get_full_list('',$query_p);
	  if(empty($check_processed))
	   {
			$workflow_related = BeanFactory::getBean('AOW_WorkFlow', $id);
			if($workflow_related->status=='Active')
			{
			$workflow->retrieve($id);
			$bean = BeanFactory::getBean('Cases', $case_id);
			$workflow->run_actions($bean);
			}
		}
		else{
			$alert_bean = BeanFactory::getBean('Alerts');
			$query_a= " alerts.url_redirect ='$discovery_id'";
		$alert_updates= $alert_bean->get_full_list('', $query_a);
		foreach($alert_updates as $alert_update)
		{
			$alert_update ->is_read=1;
			$alert_update ->save();
		}
			$stream_html .='<div><p style="padding:30px;">Selected Workflows have already run</p></div>';
			echo $stream_html;
			die;

		}
	 }  	
		$stream_html .='<div><p style="padding:30px;">Selected Workflows are activated successfully</p></div>';
			echo $stream_html;
			die;

   }
 else{
	$stream_html .='<div><p style="padding:30px;">Please select a Workflow for activated it </p></div>';	
		echo $stream_html;
		die;
 }
}
else{
	 $stream_html .='<div><p style="padding:30px;">Discovery id is not found </p></div>';	
 	  echo $stream_html;
      die;
}




