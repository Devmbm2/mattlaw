<?php
require_once "modules/Cases/controller.php";
require_once('modules/AOW_Workflow/AOW_Workflow.php');
class CustomCasesController extends CasesController
{
	public function action_client_costs_to_be_paid(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;

		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">

				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>CLIENT COSTS TO BE PAID</b></span></td>
					<td></td><td></td><td></td>
					<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
		</table>';

		$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%;word-wrap:break-word;" border="1">
				<thead>
				<tr>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Date</strong></td>
				<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Payee</strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Type </strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Amount</strong></td>
				<td  style="width:10%;font-size: 14px;font-weight: bold; "><strong>Check</strong></td>


				</tr>
				</thead>
		';
		$total = 0;
		$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
		if($case_bean->load_relationship('cost_client_cost_cases')){
			if($case_bean->load_relationship('cost_client_cost_cases')){
				$query = "SELECT cost_client_cost.id
						FROM cost_client_cost
						LEFT JOIN cost_client_cost_cstm ON(cost_client_cost_cstm.id_c = cost_client_cost.id)
						LEFT JOIN cost_client_cost_cases_c ON(cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
						WHERE cost_client_cost.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescases_ida = '{$_REQUEST['record']}' AND cost_client_cost.recovery_of_costs != 'waived_this_client_cost' AND cost_client_cost.recovery_of_costs != 'Recovered_and_paid_back_in_full'
						ORDER BY cost_client_cost.date_entered ASC";
				$result = $GLOBALS['db']->query($query, true);
				while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
					$COST_Client_Cost = BeanFactory::getBean('COST_Client_Cost', $row['id']);
					if($COST_Client_Cost->status == 'Due' || $COST_Client_Cost->status == 'Deferred_Until_End_of_Case'){
						$check_number = 'Due';
					}else{
						$check_number = $COST_Client_Cost->check_number;
					}
					$total += $COST_Client_Cost->total_amount;
					$html .='<tr>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->paid_date . '</span></td>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->parent_name . '</span></td>
						<td><span style="font-size: 15px;">'. $GLOBALS['app_list_strings']['cost_type_list'][$COST_Client_Cost->type] . '</span></td>
						<td><span style="font-size: 15px;">'. number_format($COST_Client_Cost->total_amount, 2) . '</span></td>
						<td><span style="font-size: 15px;">'. $check_number . '</span></td>

					</tr>';
				}
					$html .='<tr>
						<td colspan ></td>
						<td colspan ></td>
						<td colspan = "1"><span style="font-size: 15px;"><b> TOTAL COSTS : </b></span></td>
						<td colspan = "1"><span style="font-size: 15px;">'. number_format($total, 2) . '</span></td>
						<td></td>

						</tr>';
			}
		}
		$html .='</table>';

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '15', '3', '3', '3','3');

		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Client Costs TO Be Paid.pdf", 'I');
	}
	public function action_client_costs_waived(){
		require_once ('modules/AOS_PDF_Templates/PDF_Lib/mpdf.php');
		global $db, $timedate, $current_user, $app_list_strings;

		$date_time = $timedate->getInstance()->nowDb();
		$current_date = date('Y/m/d', strtotime($date_time));
		$current_time = date('H:i:s A', strtotime($date_time));

		$header = '<table style="table-layout: fixed;height: 60px; width: 800px;" border="0">

				<tr border="0" style="height: 51px; color: white;border:none;">
					<td  style="width: 232px; height: 51px;border:none;"><span style="color:black;font-size:15px;"><b>CLIENT COSTS WAIVED</b></span></td>
					<td></td><td></td><td></td>
					<td  style="width: 253px; height: 51px;border:none;"><span style="color:black;float:right;font-size:10px;">Date Printed: <b>'.$current_date.'</b></span><br><span style="color:black;float:right;font-size:10px;">Time Printed:<b>'.$current_time.'</b></span></td>
				</tr>
		</table>';

		$html = '<table style="border-collapse:collapse; table-layout:fixed;width:100%;word-wrap:break-word;" border="1">
				<thead>
				<tr>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Date</strong></td>
				<td  style="width:20%;font-size: 14px;font-weight: bold; "><strong>Payee</strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Type </strong></td>
				<td  style="width:15%;font-size: 14px;font-weight: bold; "><strong>Amount</strong></td>


				</tr>
				</thead>
		';
		$total = 0;
		$case_bean = BeanFactory::getBean('Cases', $_REQUEST['record']);
		if($case_bean->load_relationship('cost_client_cost_cases')){
			if($case_bean->load_relationship('cost_client_cost_cases')){
				$query = "SELECT cost_client_cost.id
						FROM cost_client_cost
						LEFT JOIN cost_client_cost_cstm ON(cost_client_cost_cstm.id_c = cost_client_cost.id)
						LEFT JOIN cost_client_cost_cases_c ON(cost_client_cost_cases_c.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescost_client_cost_idb = cost_client_cost.id)
						WHERE cost_client_cost.deleted = 0 AND cost_client_cost_cases_c.cost_client_cost_casescases_ida = '{$_REQUEST['record']}' AND cost_client_cost.recovery_of_costs = 'waived_this_client_cost'
						ORDER BY cost_client_cost.date_entered ASC";
				$result = $GLOBALS['db']->query($query, true);
				while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
					$COST_Client_Cost = BeanFactory::getBean('COST_Client_Cost', $row['id']);
					$total += $COST_Client_Cost->total_amount;
					$html .='<tr>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->paid_date . '</span></td>
						<td><span style="font-size: 15px;">'. $COST_Client_Cost->parent_name . '</span></td>
						<td><span style="font-size: 15px;">'. $GLOBALS['app_list_strings']['cost_type_list'][$COST_Client_Cost->type] . '</span></td>
						<td><span style="font-size: 15px;">'. number_format($COST_Client_Cost->total_amount, 2) . '</span></td>

					</tr>';
				}
					$html .='<tr>
						<td colspan = "2"></td>
						<td colspan = "2"><span style="font-size: 15px;"><b> TOTAL COSTS WAIVED : </b>'. number_format($total, 2) . '</span></td>

					</tr>';
			}
		}
		$html .='</table>';

		$pdf = new mPDF('en', 'A4', '', 'DejaVuSansCondensed', '10', '10', '15', '3', '3', '3','3');

		$pdf->SetHTMLHeader($header);
		$pdf->AddPage();
		$pdf->WriteHTML($html);
		$pdf->Output();
		ob_clean();
		$pdf->Output("Client Costs Waived.pdf", 'I');
	}
	public function action_intakeForm(){
        $this->view = 'intakeform';
    }
	public function action_getCaseType(){
        global $db;
		$caseType = $_REQUEST['case_type'];
		$module = $_REQUEST['module'];
		$sql = "SELECT ht_formbuilder.id,ht_formbuilder.description,ht_formbuilder.column_size FROM ht_formbuilder WHERE ht_formbuilder.case_type='{$caseType}' AND ht_formbuilder.related_module='{$module}' ";
		$result = $db->query($sql);
		$row = $db->fetchByAssoc($result);
		echo json_encode($row);
		die();
    }
    public function action_statueoflimitation()
	{


		$this->view = 'statueoflimitation';
	}
    public function action_sol()
	{
		global $db;

		$states_dom = $_POST['states_dom'];
		//die($states_dom);
		if (empty(trim($states_dom))) {
			SugarApplication::redirect('index.php?module=Cases&action=statueoflimitation');
			die();
		}

		$sol_time = $_POST['sol_time'];

		$case_type = $_POST['case_type'];
		$sol_category = $_POST['sol_category'];
		// die(print_r($sol_time));
		$sql1 = "SELECT * FROM sol_time where state_id='$states_dom'";
		$result = $db->query($sql1);
		if ($result->num_rows > 0) {

			foreach ($case_type as $x => $val) {

				if (($case_type[$x] !== '')) {
					//$sql="INSERT INTO sol_time (case_type,sol,state_id) values('$val','$sol_time[$x]','$states_dom')";

					$sql = "UPDATE  sol_time SET sol='$sol_time[$x]', sol_category='$sol_category[$x]'  where case_type='$val' and state_id='$states_dom' ";

					if ($db->query($sql)) {
					} else {
						die('error');
					}
				}
			}
		} else {
			foreach ($case_type as $x => $val) {

				if (($case_type[$x] !== '')) {
					$sql = "INSERT INTO sol_time (case_type,sol,state_id,sol_category) values('$val','$sol_time[$x]','$states_dom','$sol_category[$x]')";



					if ($db->query($sql)) {
					} else {
						die('error');
					}
				}
			}
		}
		SugarApplication::redirect('index.php?module=Cases&action=statueoflimitation');
	}
	public function action_getsol()
	{
		global $db;
		$case_type = $_POST['case_type'];
		$state = $_POST['state'];
		// echo $state;
		// die();
		// $sql1= "SELECT case_type FROM sol_time WHERE state_id='$state' ";
		$sql = "SELECT * FROM sol_time WHERE state_id='{$state}' ";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			while ($product = $GLOBALS["db"]->fetchByAssoc($result)) {
				$products[] = $product;
			}

			echo json_encode($products);
			die();
		} else {
			echo "false";
			die();
		}
		// $row = $db->fetchByAssoc($result);


	}
	// public function action_insertsol(){
	// 	global $db;
	// 	$sql = "INSERT INTO sol_state (case_type) values('$val')";";
	// 	$result = $db->query($sql);
	// 	while ( $product = $GLOBALS["db"]->fetchByAssoc($result) ) {
	// 		$products[] = $product;
	//    }
	// 	// $row = $db->fetchByAssoc($result);
	// 	echo json_encode($products);
	// 	die();
	// }
	public function action_showsubpanels()
	{
		// echo "test";
		// die();
		$this->view = 'subpanels';
	}
	public function action_relatedDocuments(){
        $this->view = 'relatedDocuments';
    }
    public function action_searchByStatus(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }

    public function action_searchByType(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }
    public function action_searchByAssignedLawyer(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }
    public function action_searchByAssistentLawyer(){
        global $db;
		$sql=$this->GenrateQueryDependingOnDropdowns($_POST);
       $result = $db->query($sql);
       $output=$this->generalizeCode($result);
       echo json_encode($output);
       die();
    }

    public function action_SearchCases(){
        global $db;
        $searchText = $_REQUEST['searcheditem'];

         $sql = "SELECT cases.*,cases_cstm.* FROM cases INNER JOIN cases_cstm on cases.id=cases_cstm.id_c WHERE cases.name LIKE '%".$searchText."%' AND cases.deleted=0 AND cases.status!='Closed' LIMIT 200";
         $result = $db->query($sql);
         $output=$this->generalizeCode($result);
        echo json_encode($output);
        die();
    }
public function GenrateQueryDependingOnDropdowns($POSTArray){
        global $db;
        $query="";
		foreach($POSTArray as $keys => $values) {
            if($keys=="status"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.status IS NULL OR cases.status='') AND";
                 }else{
                         $query.=" cases.status LIKE '%". $_POST[$keys]."%' AND";
                 }
             }else if($keys=="type"){
               if($_POST[$keys]=="NoFilterApply"){

               }else if($_POST[$keys]==""){
                        $query.=" (cases.type IS NULL OR cases.type='') AND";
                }else{
                        $query.=" cases.type LIKE '%". $_POST[$keys]."%' AND";
                }
            }else if($keys=="assignedLawyer"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.assigned_user_id IS NULL OR cases.assigned_user_id='') AND";
                 }else{
                    $sql = "SELECT id FROM users WHERE users.last_name LIKE '%".$_POST[$keys]/*"Admin"*/."%'";
                    $result = $db->query($sql);
                    $record=$GLOBALS["db"]->fetchByAssoc($result);
                     if($record['id']){
                         $query.=" cases.assigned_user_id= '".$record['id']."' AND";
                     }else{
                        echo json_encode(array('data'=>''));
                        die();
                     }
                 }
             }else if($keys=="AssistantLaywer"){
                if($_POST[$keys]=="NoFilterApply"){

                }else if($_POST[$keys]==""){
                         $query.=" (cases.default_assistant_lawyer_id IS NULL OR cases.default_assistant_lawyer_id='') AND";
                 }else{
                    $sql = "SELECT id FROM users WHERE users.last_name LIKE '%".$_POST[$keys]/*"Admin"*/."%'";
                    $result = $db->query($sql);
                    $record=$GLOBALS["db"]->fetchByAssoc($result);
                     if($record['id']){
                         $query.=" cases.default_assistant_lawyer_id= '".$record['id']."' AND";
                     }else{
                        echo json_encode(array('data'=>''));
                        die();
                     }
                 }
             }

          }
          $sql="SELECT cases.*,cases_cstm.* FROM cases INNER JOIN cases_cstm on cases.id=cases_cstm.id_c WHERE ".$query."  cases.deleted=0 ORDER BY name ASC LIMIT 200";
          return $sql;
          die();
	}
    function generalizeCode($result){
        $fetched_record=array();
        global $app_list_strings;
        $appListLabel = $app_list_strings['case_status_dom'];
        $appTypeLabel = $app_list_strings['complaint_type_list'];
        $status_label = '';
        $type_label = '';

        if ($result->num_rows > 0) {

            while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
                if (!empty($record['status'])) {
                    foreach ($appListLabel as $key => $value) {
                        if ($key == $record['status']) {
                            $status_label = $value;
                        }
                    }
                }
                if (!empty($record['type'])) {
                    foreach ($appTypeLabel as $key => $value) {
                        if ($key == $record['type']) {
                            $type_label = $value;
                        }
                    }
                }
                $bean = BeanFactory::getBean('Users', $record['assigned_user_id']);
                if($record['date_of_incident_c'] == '' || empty($record['date_of_incident_c']))
                {
                	$changeDate = $record['date_of_incident_c'];
                }
                else{
                	$changeDate = date("m/d/Y", strtotime($record['date_of_incident_c']));
                }

                $default_assistant_lawyer_id = BeanFactory::getBean('Users', $record['default_assistant_lawyer_id']);
                $fetched_record[] =["FirstCheckBox"=>'<input title="Select this row" onclick="sListView.check_item(this, document.MassUpdate)" type="checkbox" name="mass[]" value="'.$record['id'].'">','EditIconForEachRecord'=>'<a target="_blank" title="Edit" id="edit-'.$record['id'].'" href="index.php?module=Cases&amp;offset=1&amp;stamp=1653916918004779100&amp;return_module=Cases&amp;action=EditView&amp;record='.$record['id'].'">
                <img src="themes/Honey/images/edit_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA" border="0" alt="Edit"><!-- </a> -->
</a>',"id" =>$record['id'],"name"=>'<b><a target="_blank" href="index.php?module=Cases&amp;offset=1&amp;stamp=1653913081018878600&amp;return_module=Cases&amp;action=DetailView&amp;record='.$record['id'].'">
                '.$record['name'].'
                </a></b>',"status" => $status_label,"type" => $type_label,"date_of_incident_c" => $changeDate ,"UserName" => $bean->last_name,'Info'=>'<span id="adspan_'.$reocrd['id'].'" onclick="lvg_dtails(\''.$reocrd['id'].'\')" style="position: relative;"><!--not_in_theme!--><img vertical-align="middle" class="info" border="0" alt="Additional Details" src="themes/Honey/images/info_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA"></span>'
                ,"assistant_lawyer" => ($default_assistant_lawyer_id->last_name),
                "insurance_summary" => $record['case_insurance_summary_c'],
                "estimated_case_value" => $record['mdp_estimated_case_value_c'],
                "trial_conference_hearing" => $record['pre_trial_conference_hearing_c'],
            ];
            }

            $output = array(

                "data"       =>  $fetched_record
               );
               return $output;
        }else {
                return array('data'=>'');
        }
    }
    function RunFunctionOnChangingStatus($bean){
        // print_r($bean->status);die();
        // $thisisForRuningWorkflow=new AOW_WorkFlow();
        // $thisisForRuningWorkflow->run_bean_flows($bean);
    }
    function action_StatusActiveAndInactive2(){
        global $timedate;
        // global $locale;

        // $module = new $beanList['Cases'];
        // require "modules/AOW_WorkFlow/aow_utils.php";
        // $casesBean= BeanFactory::getBean('Tasks','bc914738-ca9e-2b1c-71de-632052826399');
        // $vardef = getDateField("Cases",'plus','EditView','');
        // $moduleName=$module->cases_aow_workflow_1->getRelatedModuleName();
        // require_once ('include/SubPanel/SubPanelTiles.php');
        // $subpanel = new SubPanelTiles($this->bean, $this->module);

        //     print_r($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['comp_companions_cases']);die();
            // echo $subpanel->display();
        // create the dropdowns for the parent type fields
        // $vardefFields = $focus->getFieldDefinitions();
        // $date_time = $timedate->getInstance()->nowDb();
        // $name = $casesBean->load_relationship('tasks_aow_workflows');
		// require ('modules/AOW_WorkFlow/AOW_WorkFlow.php');
		// $obj=new User();
        // print_r($obj->getActiveUsers());
		// $flows = AOW_WorkFlow::get_full_list('desc', "aow_workflow.status = 'Active'  AND (aow_workflow.run_when = 'Always' OR aow_workflow.run_when = 'In_Scheduler' OR aow_workflow.run_when = 'Create') ");
		// $account = BeanFactory::getBean('Accounts')->retrieve_by_string_fields(array('name'=>'test3org'));
		$accounts = BeanFactory::getBean('AOW_WorkFlow')->get_full_list('name DESC','aow_workflow.flow_module="Tasks"',true);
		foreach($accounts as $item)
		{
			print_r($item->date_entered."\n");
		}
        die();
    }
    function action_StatusActiveAndInactive(){
        global $db;
        $checkboxIDs="";
        foreach($_POST['checkboxArray'] as $id){
           $checkboxIDs.='\''.$id.'\''.',';
        }
         $query='UPDATE `aow_workflow` SET `status`="Inactive" WHERE aow_workflow.workflow_type="runtime_workflows" AND aow_workflow.flow_module LIKE "%Cases%" AND id NOT IN ('.substr_replace($checkboxIDs ,"", -1).')';
        $result = $db->query($query);
        $query='UPDATE `aow_workflow` SET `status`="Active" WHERE aow_workflow.workflow_type="runtime_workflows" AND aow_workflow.flow_module LIKE "%Cases%" AND id  IN ('.substr_replace($checkboxIDs ,"", -1).')';
        $result = $db->query($query);
        print_r($result);die();
    }
    public function action_getAllRelatedWorkflows(){
        global $db;
        // $query="Select aow_workflow.* from aow_workflow inner join aow_conditions on aow_conditions.aow_workflow_id=aow_workflow.id where aow_workflow.workflow_type LIKE '%runtime_workflows%' AND aow_workflow.flow_module LIKE '%Cases%' ";
        // $result = $db->query($query);
        $bean = BeanFactory::getBean('AOW_Conditions');
        $query = "aow_conditions.field LIKE '%status%'";
        $conditions_workflows = $bean->get_full_list('',$query);
        // print_r($conditions_workflows);die();
        $stream_html .="<link  rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css\">
        ";
        if (!empty($conditions_workflows))
        {
                    foreach($conditions_workflows as $row)
                        {
                            if (!empty($row->aow_workflow_id))
                                {
                                $get_id=$row->aow_workflow_id;
                                $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
                                if($workflow_related->flow_module=='Cases' && $workflow_related->workflow_type=='runtime_workflows'){
                                    $bean = BeanFactory::getBean('AOW_Actions');
                                    $query = "aow_actions.aow_workflow_id='$workflow_related->id'";
                                    $all_actions_related_to_workflow = $bean->get_full_list('',$query);
                                    // print_r($workflow_related);die();
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
    public function action_get_case_assistant_options(){
        global $db;
        $sql = "SELECT users.id, 
        CONCAT_WS(' ', NULLIF(users.first_name, ''), NULLIF(users.last_name, '')) as assistant_name
        FROM users 
        WHERE users.status='Active' AND users.deleted='0' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        }
        $arr_for_options_p = json_encode($rows);
        }
        echo $arr_for_options_p;
        die();
    
    }
    public function action_get_attorney_options(){
        global $db;
        $sql = "SELECT users.id, 
        CONCAT_WS(' ', NULLIF(users.first_name, ''), NULLIF(users.last_name, '')) as assistant_name
        FROM users 
        WHERE users.status='Active' AND users.deleted='0' ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
        $rows[] = $row;
        }
        $arr_for_options_p = json_encode($rows);
        }
        echo $arr_for_options_p;
        die();
    
    }



}
