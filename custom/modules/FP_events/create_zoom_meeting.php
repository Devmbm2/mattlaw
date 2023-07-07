<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class zoom{

		function create_zoom_meeting($bean, $event, $arguments){
			if(isset($bean->type_c) && !empty($bean->type_c) && $bean->type_c == 'Virtual_Meeting_Online'){
				include_once 'custom/include/zoom/Zoom_Api.php';
				$GLOBALS['sugar_config']['zoom']['email'] = $GLOBALS['current_user']->email1;
				$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']);

				$data = array();
				$data['topic'] 		= $bean->name;
				$data['start_date'] = date("Y-m-d h:i:s", strtotime($bean->date_start));
				$data['duration'] 	= 30;
				$data['type'] 		= 2;
				$data['password'] 	= "12345";

				/* try { */
				$response = $zoom_meeting->createMeeting($data);
				$bean->meeting_id = $response->id;
				$bean->meeting_password = $response->password;
				$bean->meeting_url = $response->join_url;
				if($response->id){
					SugarApplication::appendErrorMessage("Your New Meeting has been created. You can start the meeting with zoom Credentials.");
				}else{
					SugarApplication::appendErrorMessage("Zoom meeting has not created: {$response->code} : {$response->message}");
				}	
				/* } catch (Exception $ex) {
					echo $ex;
				} */
			}
		}
	}

