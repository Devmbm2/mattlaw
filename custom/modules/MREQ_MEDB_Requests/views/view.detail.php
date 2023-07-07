<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once('include/MVC/View/views/view.detail.php');
class MREQ_MEDB_RequestsViewDetail extends ViewDetail {
        function MREQ_MEDB_RequestsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "
        <script type='text/javascript' src='custom/include/javascript/visible/mreq_date_range.js'></script>";
        parent::display();
}
}
?>

