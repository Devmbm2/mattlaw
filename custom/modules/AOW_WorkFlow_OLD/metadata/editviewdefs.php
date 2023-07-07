<?php
$viewdefs ['AOW_WorkFlow'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'headerTpl' => 'custom/modules/AOW_WorkFlow/tpls/EditViewHeader.tpl',
        'footerTpl' => 'custom/modules/AOW_WorkFlow/tpls/EditViewFooter.tpl',
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
      'syncDetailEditViews' => false,
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/AOW_WorkFlow/js/conditionLines.js',
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
            'name' => 'StartWorkflowAction',
            'label' => 'LBL_STARTWORKFLOWACTION',
          ),
          1 => 
          array (
            'name' => 'EndWorkflowAction',
            'label' => 'LBL_ENDWORKFLOWACTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'StartTimeWorkflowAction',
            'label' => 'LBL_STARTTIMEWORKFLOWACTION',
          ),
          1 => 
          array (
            'name' => 'EndTimeWorkflowAction',
            'label' => 'LBL_ENDTIMEWORKFLOWACTION',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 'DefineStateOfWorkflow',
        ),
        7 => 
        array (
          0 => 'ReasonForOPTOut',
        ),
        8 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'cases_aow_workflow_1_name',
          ),
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
