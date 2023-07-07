<?php
require_once 'include/SugarQueue/SugarJobQueue.php';
class inactiveWorkflows
{
	function inactive(&$bean, $event, $arguments){
        global $db;
        if($bean->workflow_type=='runtime_workflows'){
            $bean->status='Inactive';
        }


	}
}

