<?php
$layout_defs["FP_events"]["subpanel_setup"]['event_workflows'] = array (
  'order' => 100,
  'module' => 'AOW_WorkFlow',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_EVENT_WORKFLOWS',
  'get_subpanel_data' => 'event_workflows',
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