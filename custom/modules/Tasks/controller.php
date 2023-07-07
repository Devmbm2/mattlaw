<?php

require_once('custom/include/slack/slackHelper.php');
class TasksController extends SugarController{
	function __construct(){
		parent::__construct();
	}

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function TasksController(){
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if(isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        }
        else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }


	protected function action_getsmshtml(){
		$this->view = 'message';
	}
	protected function action_setsmshtml(){
		if(!empty($_REQUEST['user_id'])&& !empty($_REQUEST['record_id'])){
			global $sugar_config,$current_user;
			//$Slack = new Slack('xoxp-173581060022-304504807861-311991756548-466c3d9d1066bef127cbb29c1b8fb283');
			$Slack = new Slack($current_user->slack_token);
			$message .= $_REQUEST['sms_text'];
			$message .= PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL ;
		    $message .= $sugar_config['site_url'].'/index.php?module=Tasks&action=DetailView&record='.$_REQUEST['record_id'];

			if($_REQUEST['user_channel']=='user'){
				$Slack->call('chat.postMessage', array(
				   'channel' => $_REQUEST['user_id'],
				    'text'=> $message,
					'as_user' => 'true',
				 ));
			}
			if($_REQUEST['user_channel']=='channel'){
				$Slack->call('chat.postMessage', array(
				   'channel' => $_REQUEST['user_id'],
				    'text'=> $message,
					'as_user' => 'true',
				 ));
			}
		}
	}
    // ===============Live Search Request for List View===============
    public function action_liveSearch()
    {
        global $db,$app_list_strings;
        $fetched_record0=array();
        $searchText = $_REQUEST['searcheditem'];
        $appListLabel = $app_list_strings['case_status_dom'];
        $sql0 = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
                 tasks.description AS task_description,tasks.status AS task_status,
                 tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
                 cases.id AS case_id,cases.name AS case_name,cases.status AS case_status
                 FROM tasks LEFT JOIN cases ON tasks.parent_id = cases.id WHERE (tasks.name LIKE '%$searchText%'
                 OR tasks.status LIKE '%$searchText%') AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
        $result0 = $db->query($sql0);
        while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
            $date_due = $record0['task_dueDate'];
            $date = strtotime($date_due);
            $new_date_due = date('m/d/Y', $date);
//          =====Get Team Assigned=====
            $task_id = $record0['task_id'];
            $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
            $result1 = $db->query($sql1);
            $row1 = $db->fetchByAssoc($result1);
            $security_group_id = $row1['securitygroup_id_c'];
            $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
            $result2 = $db->query($sql2);
            $row2 = $db->fetchByAssoc($result2);
            $team_assigned_id = $row2['id'];
            $team_assigned_name = $row2['name'];
            $new_case_status = '';
            if(!empty($record0['case_status'])){
                foreach ($appListLabel as $key => $value){
                    if($key == $record0['case_status']){
                        $new_case_status = $value;
                    }
                }
            }
                $fetched_record0[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
                "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
                "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
                "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
                "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
                "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
                "team_name" => $team_assigned_name];
            }

            echo json_encode($fetched_record0);
            die();
    }

    // ===============Live Search Request for List View Case Status===============
    public function action_caseStatusSearch()
    {
        global $db, $app_list_strings;
        $fetched_record = array();
        $searchText = $_REQUEST['search_data'];
        $appListLabel = $app_list_strings['case_status_dom'];
        if(!empty($searchText)){
                $sql = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
                        tasks.description AS task_description,tasks.status AS task_status,
                        tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
                        cases.id AS case_id,cases.name AS case_name,cases.status AS case_status
                        FROM tasks JOIN cases ON tasks.parent_id = cases.id WHERE ( cases.status LIKE '%$searchText%' )
                        AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
                $result = $db->query($sql);
                while ($record0 = $GLOBALS["db"]->fetchByAssoc($result)) {
                    $date_due = $record0['task_dueDate'];
                    $date = strtotime($date_due);
                    $new_date_due = date('m/d/Y', $date);
                    //          =====Get Team Assigned=====
                    $task_id = $record0['task_id'];
                    $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
                    $result1 = $db->query($sql1);
                    $row1 = $db->fetchByAssoc($result1);
                    $security_group_id = $row1['securitygroup_id_c'];
                    $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
                    $result2 = $db->query($sql2);
                    $row2 = $db->fetchByAssoc($result2);
                    $team_assigned_id = $row2['id'];
                    $team_assigned_name = $row2['name'];
                    $new_case_status = '';
                    if(!empty($record0['case_status'])){
                        foreach ($appListLabel as $key => $value){
                            if($key == $record0['case_status']){
                                $new_case_status = $value;
                            }
                        }
                    }
                    $fetched_record[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
                        "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
                        "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
                        "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
                        "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
                        "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
                        "team_name" => $team_assigned_name];
                }
                            echo json_encode($fetched_record);
                            die();
        }

    }
    public function action_getAllWorkflowsRelatedStatus(){
        global $db;
        $bean = BeanFactory::getBean('AOW_Conditions');
        $query = "aow_conditions.field LIKE '%status%'";
        $conditions_workflows = $bean->get_full_list('',$query);
        $stream_html .="<link  rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css\">
        <link  rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap-v4-grid-only@1.0.0/dist/bootstrap-grid.css\">

        ";
        if (!empty($conditions_workflows))
        {
                    foreach($conditions_workflows as $row)
                        {
                            if (!empty($row->aow_workflow_id))
                                {
                                $get_id=$row->aow_workflow_id;
                                $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
                                if($workflow_related->flow_module=='Tasks' && $workflow_related->workflow_type=='runtime_workflows'){
                                    $bean = BeanFactory::getBean('AOW_Actions');
                                    $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
                                    $all_actions_related_to_workflow = $bean->get_full_list('',$query);

                                    $workflow_related->status='Inactive';
                                    $workflow_related->save();
                                    $stream_html .="
                                    <div class='row' style='padding-left:20px; margin:20px 0px 10px 0px;'>
                                        <div class='col-xs-10' style='font-weight:bold'>
                                            <div class='col-xs-6'>
                                                Workflows
                                            </div>
                                            <div class='col-xs-3'>
                                                Actions
                                            </div>
                                            <div class='col-xs-3'>
                                                Description
                                            </div>
                                        </div>
                                    </div>
                                <div class='row'style='padding-left:20px; margin:20px 0px 10px 0px;'>

                                    <div class='col-xs-10'>

                                        <div class='row'>

                                            <div class='col-xs-6'>
                                                <div class='tooltip2'>
                                                    <input type='checkbox' id='WorkflowCheckBox' name='WorkflowCheckBox[]'  value='".$workflow_related->id."'>
                                                    <span class='tooltiptext'>".$workflow_related->description."</span>
                                                </div> &nbsp;<label>".$workflow_related->name."</label>
                                            </div>
                                            <div class='col-xs-6'>
                                                <div class='row'>
                                                    <div class='col-xs-6'>
                                            ";
                                                foreach($all_actions_related_to_workflow as $action){
                                                    $stream_html.="$action->name<br>";

                                            $stream_html.="
                                                    </div>
                                                    <div class='col-xs-6'>

                                                            <a href='#' style='color:#edd03d;' onclick='ShowDescription(\"$action->description\")'><i class='fa fa-info-circle' aria-hidden='true'></i></a>

                                                    </div>

                                                    ";
                                                }
                                                    $stream_html.="
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class='col-xs-2'>
                                    <a style='color:#edd03d;' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DAOW_WorkFlow%26offset%3D2%26stamp%3D1664354004005013000%26return_module%3DAOW_WorkFlow%26action%3DDetailView%26record%3D".$workflow_related->id."'><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></a> | <a style='color:#edd03d;' href='index.php?module=AOW_WorkFlow&offset=1&stamp=1664354004005013000&return_module=AOW_WorkFlow&action=EditView&record=".$workflow_related->id."'><i class=\"fa-solid fa-pen-to-square\"></i></a>
                                    </div>
                                </div>";
                                    }
                                }
                        }
        }


        echo $stream_html;
        die();
    }
    public function action_StatusActiveAndInactive(){
        global $db;
        $checkboxIDs="";
        foreach($_POST['checkboxArray'] as $id){
           $checkboxIDs.='\''.$id.'\''.',';
        }
        // $bean = BeanFactory::getBean('AOW_WorkFlow');
        // $query = 'aow_workflow.flow_module="Tasks" AND aow_workflow.id NOT IN ('.substr_replace($checkboxIDs ,"", -1).') AND aow_workflow.workflow_type="runtime_workflows"';
        // $workflows = $bean->get_full_list('',$query);
        // foreach($workflows as $flow){
        //     $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $flow->id);
        //     $workflow_related->status="Inactive";
        //     $workflow_related->save();
        // }

        // $bean2 = BeanFactory::getBean('AOW_WorkFlow');
        // $query = 'aow_workflow.flow_module="Tasks" AND aow_workflow.id  IN ('.substr_replace($checkboxIDs ,"", -1).') AND aow_workflow.workflow_type="runtime_workflows"';
        // $workflows2 = $bean2->get_full_list('',$query);
        // foreach($workflows2 as $flow2){
        //     $workflow_related2 = BeanFactory::getBean('AOW_WorkFlow', $flow2->id);
        //     $workflow_related2->status="Active";
        //     $workflow_related2->save();
        // }
        // die();
        $query='UPDATE `aow_workflow` SET `status`="Inactive" WHERE flow_module="Tasks" AND id NOT IN ('.substr_replace($checkboxIDs ,"", -1).') AND workflow_type="runtime_workflows"';
        $result = $db->query($query);
        $query='UPDATE `aow_workflow` SET `status`="Active" WHERE flow_module="Tasks" AND id  IN ('.substr_replace($checkboxIDs ,"", -1).') AND workflow_type="runtime_workflows"';
        $result = $db->query($query);
        print_r($result);die();
    }
    // ======Live Search Request for List View Case Other=======
    // public function action_caseOtherSearch()
    // {
    //     global $db, $app_list_strings;
    //     $fetched_record = array();
    //     $searchText = $_REQUEST['search_data'];
    //     $appListLabel = $app_list_strings['case_status_dom'];
    //     if(!empty($searchText)){
    //         $sql = "SELECT tasks.id AS task_id,tasks.date_due AS task_dueDate,tasks.name AS task_name,
    //                     tasks.description AS task_description,tasks.status AS task_status,
    //                     tasks.parent_type AS task_parent_type,tasks.priority AS task_priority,tasks.no_of_days AS task_noOfDays,
    //                     cases.id AS case_id,cases.name AS case_name,cases.status AS case_status
    //                     FROM tasks JOIN cases ON tasks.parent_id = cases.id WHERE ( cases.name LIKE '%$searchText%' )
    //                     AND tasks.deleted = 0 order by tasks.name asc LIMIT 200";
    //         $result = $db->query($sql);
    //         while ($record0 = $GLOBALS["db"]->fetchByAssoc($result)) {
    //             $date_due = $record0['task_dueDate'];
    //             $date = strtotime($date_due);
    //             $new_date_due = date('m/d/Y', $date);
    //             //          =====Get Team Assigned=====
    //             $task_id = $record0['task_id'];
    //             $sql1 = "SELECT tasks_cstm.securitygroup_id_c FROM tasks_cstm WHERE id_c = '$task_id'";
    //             $result1 = $db->query($sql1);
    //             $row1 = $db->fetchByAssoc($result1);
    //             $security_group_id = $row1['securitygroup_id_c'];
    //             $sql2 = "SELECT securitygroups.id,securitygroups.name FROM securitygroups WHERE id = '$security_group_id'";
    //             $result2 = $db->query($sql2);
    //             $row2 = $db->fetchByAssoc($result2);
    //             $team_assigned_id = $row2['id'];
    //             $team_assigned_name = $row2['name'];
    //             $new_case_status = '';
    //             if(!empty($record0['case_status'])){
    //                 foreach ($appListLabel as $key => $value){
    //                     if($key == $record0['case_status']){
    //                         $new_case_status = $value;
    //                     }
    //                 }
    //             }
    //             $fetched_record[] = ["id" =>$task_id,"name"=>$record0['task_name'],"description" => $record0['task_description'],
    //                 "status" => $record0['task_status'],"parent_type"=> $record0['task_parent_type'],
    //                 "parent_id"=> $record0['parent_id'], "contact_id"=> $record0['contact_id'],
    //                 "priority"=> $record0['task_priority'], "no_of_days"=> $record0['task_noOfDays'],
    //                 "date_due"=> $new_date_due,"case_id"=>$record0['case_id'],"case_name"=>$record0['case_name'],
    //                 "case_status" => $new_case_status,"assistant"=>'',"team_id" => $team_assigned_id,
    //                 "team_name" => $team_assigned_name];
    //         }
    //         echo json_encode($fetched_record);
    //         die();
    //     }
    // }

}
?>
