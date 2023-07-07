<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
include('custom\modules\AOW_WorkFlow\ht_AOW_Workflow.php');
include('include\SugarSQLValidate.php');
    class StatusofRequestedOrReceivedDate
    {
        function CheckStatusofRequestedOrReceivedDate($bean, $event, $arguments)
        {
            // echo "here";
            // $validater=new SugarSQLValidate();
            // print_r($validater->validateQueryClauses('name=testname',));
            // die();
// global $dictionary;
//             // print_r($bean);die();
//             $Record=BeanFactory::getBean(
//                 'MREQ_MEDB_Requests',$bean->id
//                 );
//             $relationship=$Record->load_relationship('mreq_medb_requests_aow_workflow');
//  echo "<pre>";
//     print_r(
//         $relationship
//     );
//  echo "</pre>";
//  die();
            $record_id=$bean->id;
            $Record=BeanFactory::getBean('MREQ_MEDB_Requests',$bean->id);
            if($Record->receivedDate_c==null && $bean->status_id=='Received'){
                $recordWorkflow=new ht_AOW_WorkFlow();
                $recordWorkflow->saveField('receivedDate_c',"$bean->id",'MREQ_MEDB_Requests',"'".date_create(date("m/d/Y",strtotime($bean->date_modified)))."'");
                $condition=BeanFactory::getBean('AOW_Conditions')->get_full_list("","aow_conditions.field='status_id' AND aow_conditions.value='Received'");
                foreach($condition as $con){
                $recordWorkflow->run_bean_flow($Record,$con->aow_workflow_id);
                }
            }
            if($bean->status_id=='Requested'){
                if($Record->requestedDate_c==null){
                    $Record->requestedDate_c=$bean->fetched_row['date_entered'];
                    $Record->save();
                }

            }
        }
    }



?>
