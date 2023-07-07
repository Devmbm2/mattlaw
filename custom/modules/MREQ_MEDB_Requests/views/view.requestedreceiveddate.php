<?php

require_once('include/MVC/View/views/view.list.php');

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
// unset($this->lv->displayColumns['DOCUMENT_NAME']);
        // print_r();die();
    $this->lv->setup($this->seed,'custom/modules/MREQ_MEDB_Requests/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            echo $this->lv->display();
    }

}



