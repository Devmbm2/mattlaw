<?php
$layout_defs["Tasks"]["subpanel_setup"]['task_workflows'] = array (
  'order' => 100,
  'module' => 'AOW_WorkFlow',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_TASK_WORKFLOWS',
  'get_subpanel_data' => 'task_aow_workflow',
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



?>
