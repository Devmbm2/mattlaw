<?php

$dictionary['Tasks']['fields']['task_workflows'] = array(
	'name' => 'task_workflows',
	'type' => 'link',
	'relationship' => 'task_workflows',
	'source'=>'non-db',
	'vname'=>'LBL_TASK_WORKFLOWS'
	);

	// Relationship Definition
	$dictionary["Tasks"]["relationships"]['task_workflows'] = array(
	'lhs_module'=> 'Tasks',
	'lhs_table'=> 'tasks',
	'lhs_key' => 'id', 
	'rhs_module'=> 'AOW_WorkFlow',
	'rhs_table'=> 'aow_workflow',
	'rhs_key' => 'id',
	'relationship_type'=>'one-to-many',
	);
	
	
 