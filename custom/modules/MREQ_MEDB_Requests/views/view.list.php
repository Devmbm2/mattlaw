<?php

require_once('include/MVC/View/views/view.list.php');
require_once('include\SugarObjects\VardefManager.php');
class MREQ_MEDB_RequestsViewList extends ViewList
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
    public function listViewProcess()
    {
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;
        if (!$this->headers)
            return;
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->ss->assign("SEARCH", true);
            $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
        if($_GET['CheckWhichListViewShouldLoad']=='true'){
            global $beanList;
            global $dictionary;
            // $module = new $beanList['MREQ_MEDB_Requests'];
            // $objectName = BeanFactory::getObjectName('MREQ_MEDB_Requests');
            // $defination=$module->getFieldDefinition('date_entered');
            // $vardef=VardefManager::loadVardef('MREQ_MEDB_Requests','MREQ_MEDB_Requests');
            $name=$this->lv->displayColumns['DOCUMENT_NAME'];
            $documentReceived=$this->lv->displayColumns['RECEIVEDDATE_C'];
            $documentRequested=$this->lv->displayColumns['DATE_ENTERED'];
            $StatusId=$this->lv->displayColumns['STATUS_ID'];
//     require('include/InlineEditing/InlineEditing.php');
//             // SugarBean $module;
//             // $module->get_custom_table_name()
// $bean = BeanFactory::getBean(
//     "MREQ_MEDB_Requests",
//     '572c8934-6697-3a9c-e359-634577fdac69'
// );
// echo "<pre>";
//     print_r(saveField('description','572c8934-6697-3a9c-e359-634577fdac69','MREQ_MEDB_Requests',"Test Description"));
// echo "</pre>";
// die();

            unset($this->lv->displayColumns);

            $this->lv->displayColumns['DOCUMENT_NAME']=$name;
            $this->lv->displayColumns['RECEIVEDDATE_C']=$documentReceived;
            $this->lv->displayColumns['DATE_ENTERED']=$documentRequested;
            $this->lv->displayColumns['STATUS_ID']=$StatusId;
        //    echo "<pre>";
        //     print_r($this->searchForm->seed->field_name_map['receivedDate_c']);
        //     echo "</pre>";
        //     die();

            // print_r($this->lv->displayColumns);
            // print_r($this->lv);
            $this->lv->setup($this->seed,'custom/modules/MREQ_MEDB_Requests/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            echo $this->lv->display();
        }else{
            // print_r($this->lv->displayColumns);die();
            $this->lv->setup($this->seed,'custom/modules/MREQ_MEDB_Requests/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            echo $this->lv->display();
        }

    
        }
    }

}



