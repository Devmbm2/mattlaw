<?php

$job_strings[] = 'runWorkflow';
function runWorkflow($bean)
{
   require_once('custom/modules/AOW_WorkFlow/ht_AOW_Workflow.php');
   $mreq_medb_requests=BeanFactory::getBean('MREQ_MEDB_Requests')->get_full_list("","mreq_medb_requests.status_id='Requested'");
   foreach($mreq_medb_requests as $mreq_medb_request){
        $now = time();
        $your_date = strtotime($mreq_medb_request->date_entered);
        $datediff = $now - $your_date;
        $date_check = abs($datediff);
        $findingNumberOfDays=round($date_check / (60 * 60 * 24));
        if($findingNumberOfDays==10 || $findingNumberOfDays==7 || $findingNumberOfDays==3){
            $condition=BeanFactory::getBean('AOW_Conditions')->get_full_list("","aow_conditions.field='status_id' AND aow_conditions.value='Requested'");
            foreach($condition as $con){
                $workflow = new ht_AOW_WorkFlow();
                $workflow->run_bean_flow($mreq_medb_request,$con->aow_workflow_id);
            }
        }

    }
}



