<?php

class SyncEmails {
	function syncEmailsToDB($bean, $event, $arguments)
	{			
		      global $sugar_config, $audit_details, $db;
		
			  require_once 'include/SugarQueue/SugarJobQueue.php';
			  $scheduledJob = new SchedulersJob();
			  $scheduledJob->name = "Emails sync to DB";
	   
			  $scheduledJob->assigned_user_id = '1';
	   
			  
			  $scheduledJob->data = json_encode(array(
													'id' => $bean->id,
													'module' => $bean->module_name)
												);	
			  $scheduledJob->target = "class::BeanEmailJob";
			  $queue = new SugarJobQueue();
			  $queue->submitJob($scheduledJob);
			
			  
	}
}

