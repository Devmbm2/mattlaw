<?php

class EmailToRecord implements RunnableSchedulerJob
{	
	
   public function run($arguments)
   {
     $arguments = json_decode($arguments,1);
     $bean = BeanFactory::getBean($arguments['module'],$arguments['id']);

     // write your custom code here


     global $sugar_config, $audit_details, $db;
     $user_email=$bean->from_email;
     $get_days=preg_replace('/[^A-Za-z0-9\-]/', '', $bean->sync_emails_day);
     $get_date = date ( "d M Y", strToTime ( "-".$get_days." days" ) );
     $only_sync_status=$bean->only_sync_status;
     // $only_sync_status='sent';
     $query_11= "SELECT * FROM `emails` WHERE emails.date_entered > '".$get_date."' AND emails.status = '".$only_sync_status."' AND emails.deleted=0 ";
     echo $query_11; echo "<br>";
    $result_1=$db->query($query_11);
    print_r($result_1); 
     while ($row1 = mysqli_fetch_array($result_1)) {
        $email_id=$row1['id']; 
        echo $email_id; echo "<br>";  
     $query_2="SELECT * FROM `emails_text` WHERE emails_text.email_id='".$email_id."'";
     $result_2=$db->query($query_2);
     while ($row2 = mysqli_fetch_array($result_2)) {		
     $module_name=$bean->convert_to_module;
     $sender_name=$row2['from_addr'];
     $sender_email=$row2[3];
     $body=$row2['description'];	
     $subject=$row1['name'];
     $date=$row1['date_entered'];
     $create_bean = BeanFactory::newBean($module_name);
     
      $get_table_name= strtolower($module_name);
      echo "<br>".$get_table_name."<br>"; 
    $decodedText = html_entity_decode($bean->fieldForJsonData);
    $Object = json_decode($decodedText);
    foreach ($Object as $fields=>$value){
     //dubliation check   
    $duplicate_c_q="SELECT * FROM ".$get_table_name."  WHERE
     ".$fields." IN  ('".$sender_name."', '".$subject."', 
     '".$date."', '".$sender_email."') ";
    $result_d=$db->query($duplicate_c_q);
     $row_d=mysqli_fetch_array($result_d);
            if(!empty($row_d))
            {	
              $check_duplication=1;
            }else{
              $check_duplication=0;
            }	
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
     if($check_duplication==0)
     {
        $create_bean->save();
     }
     
     }
        
     ///end 
   }
   public function setJob(SchedulersJob $job)
   {
     $this->job = $job;
   }
}