<?php

require_once('include/MVC/View/views/view.list.php');

class DISC_DiscoveryViewList extends ViewList
{
			public function preDisplay()
    {
        parent::preDisplay();
	echo "<script type='text/javascript' src='custom/include/javascript/goto_massupdate.js'></script>";
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemExportMulti();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItemPrintMulti();
    }
	  public function buildMyMenuItem()
    {
        global $app_strings;

return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="javascript:void(0)" onmouseover='hiliteItem(this,"yes");'
				onmouseout='unhiliteItem(this);'
				onclick="sugarListView.get_checks();
				document.MassUpdate.action.value='mark_done';
				document.MassUpdate.submit();">Mark Done</a>
				
EOHTML;
		}
    public function listViewPrepare()
    {
        if (empty($_REQUEST['orderBy'])) {
            $_REQUEST['orderBy'] = strtoupper('date_served');
            $_REQUEST['sortOrder'] = 'DESC';
        }
        parent::listViewPrepare();
    }
	
	protected function buildMyMenuItemExportMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'DISC_Discovery', 'index.php?entryPoint=download_attachment_multi','Please select at least 1 record to proceed.')">Export Attachments</a>
EOHTML;
    }
	protected function buildMyMenuItemPrintMulti()
    {
        global $app_strings;
        return <<<EOHTML
		<a class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
				onmouseout='unhiliteItem(this);' 
				onclick="return sListView.send_form(true, 'DISC_Discovery', 'index.php?entryPoint=download_attachment_multi&merge=true','Please select at least 1 record to proceed.')">Print Attachments</a>
EOHTML;
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
            if($_REQUEST['filter_module']){
                $menu_qc = $_REQUEST['filter_module'];
                if($menu_qc == 'qc1_inbox'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND (disc_discovery_cstm.qc1_reviewed_c IS NULL OR disc_discovery_cstm.qc1_reviewed_c = '') 
                   AND (disc_discovery_cstm.assistant_reviewed_c IS NULL OR disc_discovery_cstm.assistant_reviewed_c = '') AND 
                   disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'qc1_failed'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery_cstm.qc1_reviewed_c = 'qc1_fail' 
                   AND  disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'qc1_fixed'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery_cstm.qc1_reviewed_c = 'qc1_fixed' 
                   AND disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'qc2_inbox'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery_cstm.qc1_reviewed_c = 'qc1_pass' 
                   AND disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'qc2_failed'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                    AND disc_discovery_cstm.assistant_reviewed_c = 'assistant_fail'
                    AND disc_discovery_cstm.qc1_reviewed_c != 'qc1_fail'
                    AND disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'assistant_pass'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery_cstm.assistant_reviewed_c = 'assistant_pass' 
                   AND disc_discovery.deleted = 0";
                }
                else if($menu_qc == 'discovery_matrix'){
                    $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery_cstm.discovery_matrix_c = 0 
                   AND disc_discovery.deleted = 0";
                }
                
            }
            else{
                $this->params['custom_where'] .= " AND disc_discovery.done = 0 
                   AND disc_discovery.deleted = 0";
            }
            $this->params['orderBy'] = 'date_entered';
            $this->params['sortOrder'] = 'DESC';
            $this->lv->setup($this->seed, 'custom/modules/DISC_Discovery/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
		}
    }
	
}


 
