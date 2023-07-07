<?php
$dictionary['MREQ_MEDB_Request']['relationships']['mreq_medb_requests_aow_workflow'] = array(
	'lhs_module'    	=> 'MREQ_MEDB_Requests',
	'lhs_table'     	=> 'mreq_medb_requests',
	'lhs_key'       	=> 'id',
	'rhs_module'    	=> 'AOW_WorkFlow',
	'rhs_table'     	=> 'aow_workflow',
	'rhs_key'       	=> 'id',
	'relationship_type' => 'many-to-many',
    'join_table' => 'mreq_medb_requests_aow_workflow_1_c',
    'join_key_lhs' => 'mreq_medb_request_aow_workflow_left',
    'join_key_rhs' => 'mreq_medb_request_aow_workflow_right'
);
$dictionary['MREQ_MEDB_Requests']['fields']['mreq_medb_request_aow_workflow_left'] = array(
	'name'      	=> 'mreq_medb_request_aow_workflow_left',
	'type'      	=> 'link',
	'relationship'  => 'mreq_medb_requests_aow_workflow',
	'module'    	=> 'MREQ_MEDB_Requests',
	'bean_name' 	=> 'MREQ_MEDB_Requests',
	'source'    	=> 'non-db',
	'vname'     	=> 'LBL_ACCOUNT',
);
$dictionary['MREQ_MEDB_Requests']['fields']['mreq_medb_request_aow_workflow_right'] = array(
	'name'      	=> 'mreq_medb_request_aow_workflow_right',
	'type'      	=> 'link',
	'relationship'  => 'mreq_medb_requests_aow_workflow',
	'module'    	=> 'MREQ_MEDB_Requests',
	'bean_name' 	=> 'MREQ_MEDB_Requests',
	'source'    	=> 'non-db',
	'vname'     	=> 'LBL_ACCOUNT',
);
 ?>
