 <?php
 /* unset($layout_defs['Cases']['subpanel_setup']['activities']); */
$layout_defs["MREQ_MEDB_Requests"]["subpanel_setup"]['get_mreq_medb_requests_workflows'] = array(
	// numeric order position of subpanel by default ( lowest number comes first )
    'order' => 3,
    // 'sort_by' => 'date_entered',
    'sort_order' => 'desc',
    'title_key' => 'Workflows',
    'subpanel_name' => 'ForMREQ_MEDB_Requests',
    'module' => 'MREQ_MEDB_Requests',
    // Specify the custom function to call
    'get_subpanel_data' => 'function:get_mreq_medb_requests_workflows',
	'top_buttons' =>
	  array (
		// 0 =>
		// array (
		//   'widget_class' => 'SubPanelTopExecuteWorkflowButton',
		// ),
    // 1 =>
    // array (
    //   'widget_class' => 'SubPanelTopSelectButton',
    //   'mode' => 'MultiSelect',
    // ),
	  ),
    // Set to true to indicate we are building a custom SQL query
    'generate_select' => true,
    'function_parameters' => array(
        // File where the above function is defined at
        'import_function_file' => 'custom/include/custom_utils.php',
        ),
);


