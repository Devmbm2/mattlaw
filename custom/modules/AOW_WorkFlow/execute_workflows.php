<?php
require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
	global $db;
	$sql = "SELECT id FROM aow_workflow WHERE run_when = 'In_Custom_Scheduler' AND deleted = 0;";
	$result = $db->query($sql);

	while ($row = $db->fetchByAssoc($result)) {
		$workflow = new ht_AOW_WorkFlow();

		$workflow->retrieve($row['id']);
		run_flow2($workflow);
	}

	function run_flow2($workflow){
	$beans = $workflow->get_flow_beans();
    // print_r($beans);die();
	if(!empty($beans)){

		foreach($beans as $bean){
			$bean->retrieve($bean->id);
			$workflow->run_actions($bean);
		}
	}
}
