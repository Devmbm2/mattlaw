<?php

$dictionary['FP_events']['fields']['event_workflows'] = array(
	'name' => 'event_workflows',
	'type' => 'link',
	'relationship' => 'event_workflows',
	'source'=>'non-db',
	'vname'=>'LBL_EVENT_WORKFLOWS'
	);

	// Relationship Definition
	$dictionary["FP_events"]["relationships"]['event_workflows'] = array(
	'lhs_module'=> 'FP_events',
	'lhs_table'=> 'fp_events',
	'lhs_key' => 'id', 
	'rhs_module'=> 'AOW_WorkFlow',
	'rhs_table'=> 'aow_workflow',
	'rhs_key' => 'id',
	'relationship_type'=>'one-to-many',
	);
	
	
 