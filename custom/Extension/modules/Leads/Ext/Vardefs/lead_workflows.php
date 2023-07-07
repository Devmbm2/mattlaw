<?php

$dictionary['Leads']['fields']['lead_workflows'] = array(
	'name' => 'lead_workflows',
	'type' => 'link',
	'relationship' => 'lead_workflows',
	'source'=>'non-db',
	'vname'=>'LBL_LEAD_WORKFLOWS'
	);

	// Relationship Definition
	$dictionary["Leads"]["relationships"]['lead_workflows'] = array(
	'lhs_module'=> 'Leads',
	'lhs_table'=> 'leads',
	'lhs_key' => 'id', 
	'rhs_module'=> 'AOW_WorkFlow',
	'rhs_table'=> 'aow_workflow',
	'rhs_key' => 'id',
	'relationship_type'=>'one-to-many',
	);
	
	
 