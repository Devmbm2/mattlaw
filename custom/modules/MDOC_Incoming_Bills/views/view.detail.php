<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class MDOC_Incoming_BillsViewDetail extends ViewDetail
{
	function MDOC_Incoming_BillsViewDetail()
    {
        parent::ViewDetail();
    }
	    public function  display(){
			global $app_list_strings;
			parent::display();
			echo "<link href='custom/include/select2/css/select2.min.css' rel='stylesheet' type='text/css'/>";
			echo "<script type='text/javascript' src='custom/include/select2/js/select2.min.js'></script> ";
		}
}

?>