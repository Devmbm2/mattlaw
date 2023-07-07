<?php

require_once('include/MVC/View/views/view.list.php');

class AccountsViewList extends ViewList
{
    function __construct(){
        parent::__construct();
        $this->useForSubpanel = true;
        $this->useModuleQuickCreateTemplate = true;
    }
    public function preDisplay()
    {
        parent::preDisplay();
    }
    public function listViewPrepare()
    {
		if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('name');
            $_REQUEST['sortOrder'] = 'ASC';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    echo "<link href='custom/include/multiselect/multiselect.css' rel='stylesheet' />";
        echo "<script type='text/javascript' src='custom/include/multiselect/multiselect.js'></script>";
        // echo "<script type='text/javascript' src='custom/modules/Accounts/js/changing_multienum_to_enum.js'></script>";
    }
    public function listViewProcess()
    {

        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
            $this->lv->setup($this->seed, 'custom/modules/Accounts/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
}
