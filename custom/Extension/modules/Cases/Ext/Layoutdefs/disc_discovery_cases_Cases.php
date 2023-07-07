<?php
 // created: 2017-06-13 13:49:07
$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases'] = array (
  'order' => 9,
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_FROM_DISC_DISCOVERY_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    2 =>
    array (
      'widget_class' => 'SubPanelTopFilterButton',
    ),
    //1 => 
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
);

$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);



$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_3rd'] = array (
  'order' => 10,
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases_3rd',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_3RD_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonDiscovery_3rdTypeButton',
    ),
    //1 => 
    //array (
    //  'widget_class' => 'SubPanelTopSelectButton',
    //  'mode' => 'MultiSelect',
    //),
  ),
);

$layout_defs["Cases"]["subpanel_setup"]['disc_discovery_cases_done'] = array (
  'module' => 'DISC_Discovery',
  'subpanel_name' => 'Case_subpanel_disc_discovery_cases_done',
  'sort_order' => 'desc',
  'sort_by' => 'date_served',
  'title_key' => 'LBL_DISC_DISCOVERY_CASES_DONE_TITLE',
  'get_subpanel_data' => 'disc_discovery_cases',
  'top_buttons' => 
  array (),
);

