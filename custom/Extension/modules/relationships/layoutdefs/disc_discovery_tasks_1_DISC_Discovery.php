<?php
 // created: 2018-06-30 17:14:50
$layout_defs["DISC_Discovery"]["subpanel_setup"]['disc_discovery_tasks_1'] = array (
  'order' => 100,
  'module' => 'Tasks',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_DISC_DISCOVERY_TASKS_1_FROM_TASKS_TITLE',
  'get_subpanel_data' => 'disc_discovery_tasks_1',
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
