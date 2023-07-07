<?php 		
	     // $workflow_ids=array();
	     $discovery_id= $_REQUEST['discovery_id'];  
	     $description_ctsm= $_REQUEST['description_ctsm'];
	      $custom_added_details= $_REQUEST['custom_added_details'];
 	 if($discovery_id!=""){
 	   $related_discovery = BeanFactory::getBean('DISC_Discovery', $discovery_id);
         $case_id=$related_discovery->disc_discovery_casescases_ida;
          $related_case = BeanFactory::getBean('Cases', $case_id); 
 	    	$related_case->exception_details_c=$description_ctsm;
 	    	$related_case->workflow_exception_details_c=$custom_added_details;			
  	    $related_case->save();
	
      }
 $stream_html .='<div><p style="padding:30px;">your provided details has saved successfully </p></div>';	
 	echo $stream_html;
      die;




