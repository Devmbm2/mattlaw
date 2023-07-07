<?php

class CreatRecordFromEmails {
	function createRecord($bean, $event, $arguments)
	{			
		// global $sugar_config, $audit_details, $db;
		
		// require_once 'include/SugarQueue/SugarJobQueue.php';
		// $scheduledJob = new SchedulersJob();
		// $scheduledJob->name = "Create Record from Emails";
		// $scheduledJob->assigned_user_id = '1';
        // $scheduledJob->data = json_encode(array(
		// 									  'id' => $bean->id,
		// 									  'module' => $bean->module_name)
		// 								  );	
		// $scheduledJob->target = "class::EmailToRecord";
		// $queue = new SugarJobQueue();
		// $queue->submitJob($scheduledJob);




		

		global $sugar_config, $audit_details, $db;
		//geting input details from the mapping module
			$user_email=$bean->from_email;
			$check_duplicate=$bean->CheckDuplicate_C;
			$get_days=preg_replace('/[^A-Za-z0-9\-]/', '', $bean->sync_emails_day);
			$get_date = date ( "d M Y", strToTime ( "-".$get_days." days" ) );
			$only_sync_status=$bean->only_sync_status;
			$query_11= "SELECT * FROM `emails` WHERE emails.date_entered > '".$get_date."' AND emails.status = '".$only_sync_status."' AND emails.deleted=0 ";
	        $result_1=$db->query($query_11);		
		while ($row1 = mysqli_fetch_array($result_1)) 
		{
		   		$email_id=$row1['id']; 
				$query_2="SELECT * FROM `emails_text` WHERE emails_text.email_id='".$email_id."' AND 
				emails_text.to_addrs='".$user_email."'" ;
				$result_2=$db->query($query_2); 
			while ($row2 = mysqli_fetch_array($result_2)) 
			{		
				$module_name=$bean->convert_to_module;
				$sender_name=$row2['from_addr'];
				$sender_email=$row2[3];
				$body=$row2['description'];	
				$subject=$row1['name'];
				$date=$row1['date_entered'];
				$create_bean = BeanFactory::newBean($module_name);
				$get_table_name= strtolower($module_name);
				$decodedText = html_entity_decode($bean->fieldForJsonData);
				$Object = json_decode($decodedText);
			 foreach ($Object as $fields=>$value)
			 {
		      //dubliation check  
				if($check_duplicate=='subject')
				{
				$get_dup_val= $subject;
				}
				else if($check_duplicate=='sender_name')
				{
				$get_dup_val= $sender_name;
				}
				else if($check_duplicate=='date')
				{
				$get_dup_val= $date;
				}
				else if($check_duplicate=='sender_email')
				{
				$get_dup_val= $sender_email;
				}
				else if($check_duplicate=='body')
				{
				$get_dup_val= $body;
				}
			 
				$duplicate_c_q="SELECT * FROM ".$get_table_name."  WHERE
					".$fields." IN  ('".$get_dup_val."') ";
				$result_d=$db->query($duplicate_c_q);
				$row_d=mysqli_fetch_array($result_d);
						if(!empty($row_d))
						{	
							$check_duplication=1;
						}else{
							$check_duplication=0;
						}	

						//// map fields with  values ////
						if($value=='subject')
						{
						 $create_bean->$fields= $subject;
						}
						else if($value=='sender_name')
						{
						 $create_bean->$fields= $sender_name;
						}
						else if($value=='date')
						{
						 $create_bean->$fields= $date;
						}
						else if($value=='sender_email')
						{
						 $create_bean->$fields= $sender_email;
						}
						else if($value=='body')
						{
						 $create_bean->$fields= $body;
						}
		   
			
			    
					} 
			   }	
		}
		/// dublication check upon save///
		if($check_duplication==0)
		{
		   $create_bean->save();
		}
		
	}	
}


