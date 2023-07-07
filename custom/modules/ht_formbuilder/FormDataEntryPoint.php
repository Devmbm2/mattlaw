<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	global $log,$db,$app_list_strings;
	$questions = [];
	$form_id = $_REQUEST["id"];
	$specific_id = $_REQUEST["specificid"];
	$userUpdate = BeanFactory::getBean("ht_formbuilder", $form_id);
	$specificuserUpdate = BeanFactory::getBean("ht_formbuilder", $specific_id);
	$case_type = $userUpdate->case_type;
	$fbdesc = $userUpdate->description;
	$specdesc = $specificuserUpdate->description;
	$fbmodule = $userUpdate->related_module;
	$use_tabs = $userUpdate->use_tabs;
 if($use_tabs==1)
 {
	$json = str_replace('&quot;', '"', $fbdesc);
	$fbdesc_decodes= json_decode($json);
	$bean = BeanFactory::newBean($fbmodule);
	$contactBean = BeanFactory::newBean('Contacts');
	foreach ($fbdesc_decodes as $fbdesc_decode) 
	{
	// if($specdesc)
	// {
	// $json2 = str_replace('&quot;', '"', $specdesc);
	// $specdesc_decode = json_decode($json2);
	// $concatdesc = array_merge($fbdesc_decode,$specdesc_decode);
	// }
	// else
	// {	
		
		$fbdesc_decode_c= json_decode($fbdesc_decode);
		$concatdesc = $fbdesc_decode_c;
	//}
 
	
	    $questions_c=array();
		foreach($concatdesc as $key => $record)
		{	
			if($record->shape)
			{
				if($record->subtype == 'email')
				{
					$bean->email1 = $_REQUEST[$record->name];
					$contactBean->email1 = $_REQUEST[$record->name];
				}	
				//print_r($record); die;
		        $bean->{$record->shape} = $_REQUEST[$record->name];
		        $contactBean->{$record->shape} = $_REQUEST[$record->name];
			    if($record->type == "select")
			    {
			        foreach($record->values as $key=> $option)
			        	{
					        if($option->value == $_REQUEST[$record->name])
					        {
					         $record->values[$key]->selected = true;
						    }
						     else
					        {
					        	$record->values[$key]->selected = false;
					        }
			    		}
			    	
		        }
		    }
		        if($record->subtype == 'email')
					{
						$bean->email1 = $_REQUEST[$record->name];
						$contactBean->email1 = $_REQUEST[$record->name];
					}
				if($record->type=='select')
					{
						if($record->multiple==1)
						{
						$record->value = implode(',', $_REQUEST[$record->name]);
						}
					}
	         $record->value = $_REQUEST[$record->name];
			 array_push( $questions_c, $record);
             $questions_c[]=$record;
			}
			
		}
		//print_r ("<pre>"); print_r ($bean);die();
			if(isset($_REQUEST['casetype']))
			{
				$bean->case_type_c = $_REQUEST['casetype'];
			}
			if(isset($_REQUEST['state']))
			{
				$bean->primary_address_state = $_REQUEST['state'];
			}
			foreach($questions_c as $questions)
		   {
			$questions = json_encode($questions);
			if(isset($questions) && $fbmodule == 'Cases')
			{
			$bean->questioner = $questions;
			}
	       }
			if(isset($_REQUEST['date-loss']) && isset($_REQUEST['wrong-death']) && $fbmodule == 'Leads')
			{
			$dt = $_REQUEST['date-loss'];
			$case_type_time = $app_list_strings["case_type_year_list"][$case_type];
			if($_REQUEST['wrong-death']=='no')
			{
				$bean->statute_of_limitations_c = date('Y-m-d', strtotime($dt. ' + '.$case_type_time. 'year'));
			}	
			else
			{
				$case_type_time = $case_type_time/2;
				$bean->statute_of_limitations_c = date('Y-m-d', strtotime($dt. ' + '.$case_type_time. 'year'));
			}	
			}
   	
		
			// print_r ("<pre>"); print_r ($bean);die();
			$contactBean->save();
			$bean->client_c = $contactBean->first_name;
			$bean->contact_id1_c = $contactBean->id;
			$bean->injured_person_c = $contactBean->first_name;
			$bean->contact_id2_c = $contactBean->id;
			$bean->save();
		
		header("Location:index.php?module={$fbmodule}&action=DetailView&record={$bean->id}");

	}
	else 
	{
	$json = str_replace('&quot;', '"', $fbdesc);
	$fbdesc_decode = json_decode($json);
	if($specdesc)
	{
	$json2 = str_replace('&quot;', '"', $specdesc);
	$specdesc_decode = json_decode($json2);
	$concatdesc = array_merge($fbdesc_decode,$specdesc_decode);
	}
	else
	{
		$concatdesc = $fbdesc_decode;
	}
	
	$bean = BeanFactory::newBean($fbmodule);
	$contactBean = BeanFactory::newBean('Contacts');
		foreach($concatdesc as $key=> $record){
			if($record->shape)
			{
				if($record->subtype == 'email')
				{
					$bean->email1 = $_REQUEST[$record->name];
					$contactBean->email1 = $_REQUEST[$record->name];
				}
		        $bean->{$record->shape} = $_REQUEST[$record->name];
		        $contactBean->{$record->shape} = $_REQUEST[$record->name];
			    if($record->type == "select")
			    {
			        foreach($record->values as $key=> $option)
			        	{
					        if($option->value == $_REQUEST[$record->name])
					        {
					         $record->values[$key]->selected = true;
						    }
						     else
					        {
					        	$record->values[$key]->selected = false;
					        }
			    		}
			    	
		        }
		    }
		        if($record->subtype == 'email')
					{
						$bean->email1 = $_REQUEST[$record->name];
						$contactBean->email1 = $_REQUEST[$record->name];
					}
				if($record->type=='select')
					{
						if($record->multiple==1)
						{
						$record->value = implode(',', $_REQUEST[$record->name]);
						}
					}
	         $record->value = $_REQUEST[$record->name];
             $questions[]=$record;
			}
			if(isset($_REQUEST['casetype']))
			{
				$bean->case_type_c = $_REQUEST['casetype'];
			}
			if(isset($_REQUEST['state']))
			{
				$bean->primary_address_state = $_REQUEST['state'];
			}
			$questions = json_encode($questions);
			if(isset($questions) && $fbmodule == 'Cases')
			{
			$bean->questioner = $questions;
			}
			if(isset($_REQUEST['date-loss']) && isset($_REQUEST['wrong-death']) && $fbmodule == 'Leads')
			{
			$dt = $_REQUEST['date-loss'];
			$case_type_time = $app_list_strings["case_type_year_list"][$case_type];
			if($_REQUEST['wrong-death']=='no')
			{
				$bean->statute_of_limitations_c = date('Y-m-d', strtotime($dt. ' + '.$case_type_time. 'year'));
			}	
			else
			{
				$case_type_time = $case_type_time/2;
				$bean->statute_of_limitations_c = date('Y-m-d', strtotime($dt. ' + '.$case_type_time. 'year'));
			}	
			}
			// print_r ("<pre>"); print_r ($bean);die();
			$contactBean->save();
			$bean->client_c = $contactBean->first_name;
			$bean->contact_id1_c = $contactBean->id;
			$bean->injured_person_c = $contactBean->first_name;
			$bean->contact_id2_c = $contactBean->id;
			$bean->save();
			
			header("Location:index.php?module={$fbmodule}&action=DetailView&record={$bean->id}");



	}