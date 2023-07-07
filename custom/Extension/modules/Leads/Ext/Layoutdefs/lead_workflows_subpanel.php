<?php
$layout_defs["Leads"]["subpanel_setup"]['lead_workflows'] = array (
  'order' => 100,
  'module' => 'AOW_WorkFlow',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LEAD_WORKFLOWS',
  'get_subpanel_data' => 'lead_workflows',
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