<?php
require_once 'include/SugarQueue/SugarJobQueue.php';
class inactiveWorkflows
{
	function inactive(&$bean, $event, $arguments){
        global $db;
        $query="Select id from aow_workflow where flow_module LIKE '%Tasks%' AND workflow_type LIKE '%runtime_workflows%'";
        // echo $query;die();
        $result = $db->query($query);
            if($result->num_rows){

                while ($record = $db->fetchByAssoc($result)) {
                    $bean=BeanFactory::getBean('AOW_WorkFlow',$record['id']);
                    $bean->status='Inactive';
                    $bean->save();
                }
            }

	}
}

