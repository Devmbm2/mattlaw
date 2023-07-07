<?php

require_once('include/MVC/View/views/view.list.php');

class MTS_Medical_Treatment_SummaryViewList extends ViewList
{
	public function preDisplay(){
        parent::preDisplay();
		$this->lv = new ListViewSmarty();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportCsv();
		$this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportExcel();
		
    }

    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('treatment_date');
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
       $this->lv->setup($this->seed, 'custom/modules/MTS_Medical_Treatment_Summary/tpls/ListViewGeneric.tpl', $this->where, $this->params);
       echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
          echo $this->lv->display();
        }   
   }
	public function buildMyMenuItemExportCsv()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='export_csv';
				document.MassUpdate.submit();">Generate CSV</a>
				
EOHTML;
	}	
	public function buildMyMenuItemExportExcel()
    {
        global $app_strings;

		return <<<EOHTML
			<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='export_excel';
				document.MassUpdate.submit();">Generate Excel</a>
				
			EOHTML;
	}
	
}


 
