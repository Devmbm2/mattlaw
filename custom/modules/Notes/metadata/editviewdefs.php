<?php
$viewdefs ['Notes'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="sms_text" id ="sms_text" value="">',
          1 => '<input type="hidden" name="user_id" id ="user_id" value="">',
          2 => '<input type="hidden" name="send_slack_notification" id ="send_slack_notification" value="">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
      'javascript' => '{sugar_getscript file="include/javascript/dashlets.js"}
<script>
function deleteAttachmentCallBack(text)
	{literal} { {/literal}
	if(text == \'true\') {literal} { {/literal}
		document.getElementById(\'new_attachment\').style.display = \'\';
		ajaxStatus.hideStatus();
		document.getElementById(\'old_attachment\').innerHTML = \'\';
	{literal} } {/literal} else {literal} { {/literal}
		document.getElementById(\'new_attachment\').style.display = \'none\';
		ajaxStatus.flashStatus(SUGAR.language.get(\'Notes\', \'ERR_REMOVING_ATTACHMENT\'), 2000);
	{literal} } {/literal}
{literal} } {/literal}
</script>
<script>toggle_portal_flag(); function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_NOTE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_note_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'note_type_c',
            'studio' => 'visible',
            'label' => 'LBL_NOTE_TYPE',
          ),
          1 => 'parent_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'size' => 60,
            ),
          ),
          1 => 'contact_name',
        ),
        2 => 
        array (
          0 => 'filename',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_NOTE_STATUS',
          ),
          1 => 
          array (
            'name' => 'mreq_medb_requests_activities_1_notes_name',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'mr_monitor_records_notes_1_name',
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
      ),
    ),
  ),
);

$viewdefs['Contacts']['EditView']['templateMeta']['panels'] =
    array (
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'workflow_end_status_c',
            'label' => 'LBL_WORKFLOW_END_STATUS_C',
          ),
          1 => 
          array (
            'name' => 'workflow_reason_c',
            'label' => 'LBL_WORKFLOW_REASON_C',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'explain_w_reason_c',
            'comment' => 'Full text of the note',
            'label' => 'LBL_EXPLAIN_W_REASON_C',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'why_opt_out_c',
            'comment' => 'Full text of the note',
            'label' => 'LBL_WHY_OPT_OUT_C',
          ),
          1 => '',
        ),
      ),
    );

    $viewdefs['Notes']['EditView']['templateMeta']['includes'] =
    array (
        array (
  'file' => 'custom/modules/FP_events/js/editview.js',
        ),
    );