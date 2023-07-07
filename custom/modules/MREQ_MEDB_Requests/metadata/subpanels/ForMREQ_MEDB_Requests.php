<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$subpanel_layout = array (
	'list_fields' => array(
		'document_name'=>array(
			 'vname' => 'LBL_BILLNAME',
			 'width' => '55%',
			 'link' => false,
		),
		'status'=>array(
            'vname' => 'LBL_ProcesseSTATUS',
            'width' => '15%',
		),
        'requestedDate_c'=>array(
            'vname' => 'LBL_REQUESTEDDATE',
            'width' => '15%',
		),
        'receivedDate_c'=>array(
            'vname' => 'LBL_RECEIVEDDATE',
            'width' => '15%',
		),
	),
);
?>
