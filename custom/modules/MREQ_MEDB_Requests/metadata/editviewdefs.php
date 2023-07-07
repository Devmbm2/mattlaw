<?php
$module_name = 'MREQ_MEDB_Requests';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
	{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
	{sugar_getscript file="modules/Documents/documents.js"}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'status_id',
          1 => 
          array (
            'name' => 'mreq_medb_requests_medb_medical_bills_name',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_range_bills_liens_c',
            'studio' => 'visible',
            'label' => 'LBL_DATE_RANGE_BILLS_LIENS',
          ),
          1 => 
          array (
            'name' => 'date_requested',
            'label' => 'LBL_DATE_REQUESTED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
          1 => 
          array (
            'name' => 'mdoc_medb_doc_mreq_medb_requests_name',
          ),
        ),
        3 => 
        array (
          0 => '',
        ),
      ),
    ),
  ),
);
