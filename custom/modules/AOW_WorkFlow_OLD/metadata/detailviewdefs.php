<?php
$viewdefs ['AOW_WorkFlow'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'CONDITIONS' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'ACTIONS' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'flow_module',
            'studio' => 'visible',
            'label' => 'LBL_FLOW_MODULE',
          ),
          1 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'run_when',
            'label' => 'LBL_RUN_WHEN',
          ),
          1 => 
          array (
            'name' => 'flow_run_on',
            'studio' => 'visible',
            'label' => 'LBL_FLOW_RUN_ON',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'multiple_runs',
            'label' => 'LBL_MULTIPLE_RUNS',
          ),
          1 => 
          array (
            'name' => 'workflow_type',
            'label' => 'LBL_WORKFLOW_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 'description',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'cases_aow_workflow_1_name',
          ),
        ),
      ),
      'LBL_CONDITION_LINES' => 
      array (
        0 => 
        array (
          0 => 'condition_lines',
        ),
      ),
      'LBL_ACTION_LINES' => 
      array (
        0 => 
        array (
          0 => 'action_lines',
        ),
      ),
    ),
  ),
);
