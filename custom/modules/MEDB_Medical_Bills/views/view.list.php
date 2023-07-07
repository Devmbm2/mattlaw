<?php

require_once('include/MVC/View/views/view.list.php');

class MEDB_Medical_BillsViewList extends ViewList
{

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_entered');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }

    public function listViewProcess() {
        global $db;
        $this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
			return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
       $this->lv->setup($this->seed, 'custom/modules/MEDB_Medical_Bills/tpls/ListViewGeneric.tpl', $this->where, $this->params);
       echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
          echo $this->lv->display();
        }   
   }


}


 
