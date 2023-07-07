<?php


require_once('include/MVC/View/views/view.list.php');
class AOW_WorkFlowViewList extends ViewList {

    public function __construct() {
        parent::__construct();
    }

    public function listViewProcess() {

         if(!empty($_POST['search_data'])){
         $this->params['custom_where']= " AND aow_workflow.name Like '%".$_POST['search_data']."%' ";
         }
        $this->lv->setup($this->seed, 'custom/modules/AOW_WorkFlow/tpls/ListViewGeneric.tpl', $this->where, $this->params);
             echo $this->lv->display();
    }
}
