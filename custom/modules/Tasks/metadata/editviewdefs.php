<?php
$viewdefs ['Tasks'] =
array (
  'EditView' =>
  array (
    'templateMeta' =>
    array (
      'form' =>
      array (
        'hidden' =>
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
        ),
        'buttons' =>
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
          2 =>
          array (
            'customCode' => '{if $fields.status.value == "Completed"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" class="button" onclick="document.getElementById(\'status\').value=\'Completed\'; this.form.action.value=\'Save\'; this.form.return_module.value=\'Tasks\'; this.form.isDuplicate.value=true; this.form.isSaveAndNew.value=true; this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'; if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(this.form);" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
        'enctype' => 'multipart/form-data',
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
        'LBL_TASK_INFORMATION' =>
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' =>
    array (
      'lbl_task_information' =>
      array (
        0 =>
        array (
          0 =>
          array (
            'name' => 'type_of_todo_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE_OF_TODO',
          ),
          1 =>
          array (
            'name' => 'time_spent_c',
            'label' => 'LBL_TIME_SPENT',
          ),
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'name',
            'displayParams' =>
            array (
              'required' => true,
            ),
          ),
          1 =>
          array (
            'name' => 'status',
            'displayParams' =>
            array (
              'required' => true,
            ),
          ),
        ),

        2 => array(
            0=>array(
                'name'=>'reasons',
                'label'=>'LBL_REASONS'
            ),
            1=>array(
                'name'=>'reason_on_selected_other_option',
            )
        ),
        3 =>
        array (
          0 =>
          array (
            'name' => 'date_due',
            'type' => 'datetimecombo',
            'displayParams' =>
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
          1 =>
          array (
            'name' => 'contact_name',
            'label' => 'LBL_CONTACT_NAME',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
        ),
        5 =>
        array (
          0 =>
          array (
            'name' => 'multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
          1 =>
          array (
            'name' => 'task_file_c',
            'label' => 'LBL_TASK_FILE',
          ),
        ),
        6 =>
        array (
          0 =>
          array (
            'name' => 'description',
          ),
          1 =>
          array (
            'name' => 'team_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAM',
          ),
        ),
        7 =>
        array (
          0 =>
          array (
            'name' => 'dha_plantillasdocumentos_tasks_1_name',
          ),
          1 =>
          array (
            'name' => 'request_types_c',
            'studio' => 'visible',
            'label' => 'LBL_REQUEST_TYPES',
          ),
        ),
        8 =>
        array (
          0 =>
          array (
            'name' => 'disc_discovery_tasks_1_name',
          ),
          1 =>
          array (
            'name' => 'mreq_medb_requests_tasks_1_name',
          ),
        ),
        9 =>
        array (
          0 =>
          array (
            'name' => 'mreq_medb_requests_activities_1_tasks_name',
          ),
          1 =>
          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' =>
            array (
              'showNoneCheckbox' => true,
              'showFormats' => true,
            ),
          ),
        ),
      ),
    ),
  ),
);

$viewdefs['Tasks']['EditView']['templateMeta']['includes'] =
    array (
        array (
                'file' => 'custom/modules/Tasks/js/editview.js',

        ),
        array(
                'file' => 'cache/include/javascript/sugar_grp_yui_widgets.js'
        ),
    );


