<?php
	if(!empty($_REQUEST['record_id']) && !empty($_REQUEST['record_module']) && !empty($_REQUEST['workflow_id'])){
		require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');

		$workflow = new ht_AOW_WorkFlow();
		$workflow->retrieve($_REQUEST['workflow_id']);

        print_r($workflow);die();
		$bean = BeanFactory::getBean($_REQUEST['record_module'], $_REQUEST['record_id']);
		if($bean->id)
			$workflow->run_actions($bean);
	}

