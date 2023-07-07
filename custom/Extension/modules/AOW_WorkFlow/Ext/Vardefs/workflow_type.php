<?php
$dictionary['AOW_Workflow']['fields']['workflow_type'] = array (
	'required' => false,
        'name' => 'workflow_type',
        'vname' => 'LBL_WORKFLOW_TYPE',
        'type' => 'enum',
        'massupdate' => 0,
        'default' => '',
        'comments' => '',
        'help' => '',
        'importable' => 'true',
        'duplicate_merge' => 'disabled',
        'duplicate_merge_dom_value' => '0',
        'audited' => false,
        'reportable' => true,
        'unified_search' => false,
        'merge_filter' => 'disabled',
        'len' => 100,
        'size' => '20',
        'options' => 'aok_status_list',
        'studio' => 'visible',
        'dependency' => false,
);