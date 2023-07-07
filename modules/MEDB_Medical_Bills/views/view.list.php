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
    }

}


 
