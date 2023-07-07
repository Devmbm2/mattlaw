<?php

require_once('include/MVC/View/views/view.list.php');

class LeadsViewList extends ViewList
{

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('leadrank_c');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
		echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
    }

    function listViewProcess() {
		global $current_user;
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if (!$this->headers)
				return;
		if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
			$this->lv->ss->assign("SEARCH", true);
			$this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
			// if($_SESSION['converted'] != '1'){
			// 	$this->params['custom_where'] = " AND leads.converted != '1' AND leads.status != 'Dead'";
			// }
			// if($_REQUEST['archive_leads_basic']){
			// 	$this->params['custom_where'] = " AND leads.converted = '1' OR leads.status = 'Dead'";
			// }
            $this->params['custom_where'] = " ORDER BY leads_cstm.leadrank_c DESC";
            // $this->params['orderBy']='LEADRANK';

            $this->params['orderBy'] = " leadrank_c ";
            $this->params['sortOrder'] = " DESC";
            // echo "<pre>";
            // print_r($this->params);
            // echo "</pre>";
            // die();
			$this->lv->setup($this->seed, 'custom/modules/Leads/tpls/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);

			echo $this->lv->display();
		}
    }
}



