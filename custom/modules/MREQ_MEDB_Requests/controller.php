<?php
require_once('modules/AOW_Workflow/AOW_Workflow.php');
// require_once('custom/modules/MREQ_MEDB_Requests/views/view.requestedreceiveddate.php');
class MREQ_MEDB_RequestsController extends SugarController
{
    // public function
    public function action_showworkflowStatus()
    {
        $this->view = 'list';
// $this->lv->setup($this->seed,
// 'custom/modules/Leads/tpls/ListViewGeneric.tpl'
// , $this->where, $this->params);
//  		echo $this->lv->display();
    }


}

