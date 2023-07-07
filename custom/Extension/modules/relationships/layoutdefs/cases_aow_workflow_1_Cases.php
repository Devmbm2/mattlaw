<?php
 // created: 2022-09-29 16:36:06
$layout_defs["Cases"]["subpanel_setup"]['cases_aow_workflow_1'] = array (
  'order' => 100,
  'module' => 'aow_workflow',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CASES_AOW_WORKFLOW_1_FROM_AOW_WORKFLOW_TITLE',
  'get_subpanel_data' => 'cases_aow_workflow_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
