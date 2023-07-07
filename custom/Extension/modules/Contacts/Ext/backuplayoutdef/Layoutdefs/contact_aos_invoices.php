<?php
$layout_defs["Contacts"]["subpanel_setup"]["contact_aos_invoices"]["top_buttons"] = array(
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
        2 =>array (
        'widget_class' => 'SubPanelTopFilterSearchForSelectedSubpanels',
  
),
);

$layout_defs["Contacts"]["subpanel_setup"]['contact_aos_invoices']['searchdefs'] =
array ( 'name' =>
        array (
            'name' => 'name',
            'default' => true,
            'width' => '10%',
        ),
);
