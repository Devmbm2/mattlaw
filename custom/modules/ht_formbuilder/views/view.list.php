<?php


require_once('include/MVC/View/views/view.list.php');
class ht_formbuilderViewList extends ViewList {

    public function __construct() {
        parent::__construct();
    }

    public function listViewProcess() {

         if(!empty($_POST['search_data'])){
         $this->params['custom_where']= " AND ht_formbuilder.name Like '%".$_POST['search_data']."%' ";
         }
        $this->lv->setup($this->seed, 'custom/modules/ht_formbuilder/tpls/ListViewGeneric.tpl', $this->where, $this->params);
             echo $this->lv->display();
    }
}
