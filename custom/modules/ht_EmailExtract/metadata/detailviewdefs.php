<?php
$module_name = 'ht_EmailExtract';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
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
            'name' => 'from_email',
            'label' => 'LBL_FROM_EMAIL',
          ),
          1 => 
          array (
            'name' => 'convert_to_module',
            'label' => 'LBL_CONVERT_TO_MODULE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'sync_emails_day',
            'label' => 'LBL_sync_emails_day',
          ),
          1 => 
          array (
            'name' => 'only_sync_status',
            'label' => 'LBL_ONLY_SYNC_STATUS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'check_duplicate',
            'label' => 'LBL_CHECK_DUPLICATE',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'is_active',
            'label' => 'LBL_IS_ACTIVE',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
