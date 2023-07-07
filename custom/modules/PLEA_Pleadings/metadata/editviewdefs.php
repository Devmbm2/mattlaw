<?php
$module_name = 'PLEA_Pleadings';
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_EVENT' => 
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
          0 => 'document_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_filed_c',
            'label' => 'LBL_DATE_FILED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'incoming_or_outgoing',
            'studio' => 'visible',
            'label' => 'LBL_INCOMING_OR_OUTGOING',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'author_type',
            'label' => 'LBL_AUTHOR_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'approve_pleading',
            'label' => 'LBL_APPROVE_PLE',
          ),
          1 => 
          array (
            'name' => 'author_c',
            'label' => 'LBL_AUTHOR',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'plea_pleadings_cases_name',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'LBL_FLEX_RELATE',
          ),
        ),
        7 => 
        array (
          0 => 'category_id',
          1 => 'subcategory_id',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'delivery_method_c',
            'studio' => 'visible',
            'label' => 'LBL_DELIVERY_METHOD',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'complaint_answer_type',
            'studio' => 'visible',
            'label' => 'LBL_COMPLAINT_ANSWER_TYPE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'name_of_motion',
            'label' => 'LBL_NAME_OF_MOTION',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'notice_type',
            'studio' => 'visible',
            'label' => 'LBL_NOTICE_TYPE',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'filing_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_FILING_SUB_TYPE',
          ),
          1 => 
          array (
            'name' => 'filing_description',
            'studio' => 'visible',
            'label' => 'LBL_FILING_DESCRIPTION',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'hearing_type',
            'studio' => 'visible',
            'label' => 'LBL_HEARING_TYPE',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'orders_sub_type',
            'studio' => 'visible',
            'label' => 'LBL_ORDERS_SUB_TYPE',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'sent_received',
            'studio' => 'visible',
            'label' => 'LBL_SENT_RECEIVED',
          ),
        ),
        17 => 
        array (
          0 => 
          array (
            'name' => 'witness_list_type_c',
            'studio' => 'visible',
            'label' => 'LBL_WITNESS_LIST_TYPE',
          ),
        ),
        18 => 
        array (
          0 => 
          array (
            'name' => 'exhibit_type_c',
            'studio' => 'visible',
            'label' => 'LBL_EXHIBIT_TYPE',
          ),
        ),
        19 => 
        array (
          0 => 
          array (
            'name' => 'stipulation_type_c',
            'studio' => 'visible',
            'label' => 'LBL_STIPULATION_TYPE',
          ),
        ),
        20 => 
        array (
          0 => 
          array (
            'name' => 'sum_subp_type_c',
            'studio' => 'visible',
            'label' => 'LBL_SUM_SUBP_TYPE',
          ),
        ),
        21 => 
        array (
          0 => 
          array (
            'name' => 'lastname_c',
            'label' => 'LBL_LASTNAME',
          ),
          1 => 
          array (
            'name' => 'nickname_c',
            'label' => 'LBL_NICKNAME',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'pleading_sub_type_description',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'uploadfile',
            'displayParams' => 
            array (
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'add_workflow_c',
            'studio' => 'visible',
            'label' => 'LBL_ADD_WORKFLOW',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'create_event',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'created_by_name',
            'label' => 'LBL_CREATED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'qc_reviewed_by_c',
            'studio' => 'visible',
            'label' => 'LBL_QC_REVIEWED_BY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'qc1_reviewed_c',
            'studio' => 'visible',
            'label' => 'LBL_QC1_REVIEWED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'qc1_reason_for_fail_c',
            'studio' => 'visible',
            'label' => 'LBL_QC1_REASON_FOR_FAIL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'assistant_reviewed_by_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSISTANT_REVIEWED_BY',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'assistant_reviewed_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSISTANT_REVIEWED',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'assistant_reason_for_fail_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSISTANT_REASON_FOR_FAIL',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'qc_review_remarks_c',
            'studio' => 'visible',
            'label' => 'LBL_QC_REVIEW_REMARKS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'done_c',
            'label' => 'LBL_DONE',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_lawyer_1_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSIGNED_LAWYER_1',
          ),
          1 => 
          array (
            'name' => 'lawyer_1_time_c',
            'label' => 'LBL_LAWYER_1_TIME',
            'customCode' => '<input id="lawyer_1_time_c" name="lawyer_1_time_c" size="2" maxlength="2" type="text" value="{$fields.lawyer_1_time_c.value}" style = "width:25%;"/>&nbsp;<i>hours</i>&nbsp;{html_options name="duration_minutes_c" id="duration_minutes_c" options=$fields.duration_minutes_c.options selected=$fields.duration_minutes_c.value}&nbsp;<i>minutes</i>
            ',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'assigned_lawyer_2_c',
            'studio' => 'visible',
            'label' => 'LBL_ASSIGNED_LAWYER_2',
          ),
          1 => 
          array (
            'name' => 'lawyer_2_time_c',
            'label' => 'LBL_LAWYER_2_TIME',
            'customCode' => '<input id="lawyer_2_time_c" name="lawyer_2_time_c" size="2" maxlength="2" type="text" value="{$fields.lawyer_2_time_c.value}" style = "width:25%;"/>&nbsp;<i>hours</i>&nbsp;{html_options name="duration_minutes_2_c" id="duration_minutes_2_c" options=$fields.duration_minutes_2_c.options selected=$fields.duration_minutes_2_c.value}&nbsp;<i>minutes</i>
            ',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'time_spent_record_creator_c',
            'label' => 'LBL_TIME_SPENT_RECORD_CREATOR',
            'customCode' => '<input id="time_spent_record_creator_c" name="time_spent_record_creator_c" size="2" maxlength="2" type="text" value="{$fields.time_spent_record_creator_c.value}" style = "width:25%;"/>&nbsp;<i>hours</i>&nbsp;{html_options name="record_creator_duration_c" id="record_creator_duration_c" options=$fields.record_creator_duration_c.options selected=$fields.record_creator_duration_c.value}&nbsp;<i>minutes</i>
            ',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'assistant_time_c',
            'label' => 'LBL_ASSISTANT_TIME',
            'customCode' => '<input id="assistant_time_c" name="assistant_time_c" size="2" maxlength="2" type="text" value="{$fields.assistant_time_c.value}" style = "width:25%;"/>&nbsp;<i>hours</i>&nbsp;{html_options name="assistant_duration_c" id="assistant_duration_c" options=$fields.assistant_duration_c.options selected=$fields.assistant_duration_c.value}&nbsp;<i>minutes</i>
            ',
          ),
        ),
      ),
      'lbl_editview_event' => 
      array (
        0 => 
        array (
          0 => 'date_start',
          1 => 'date_end',
        ),
        1 => 
        array (
          0 => 'type_c',
          1 => 'event_type',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'duration',
            'customCode' => '
                @@FIELD@@
				<input id="event_event_id" name="event_event_id" type="hidden" value="">
				<input id="deleted_events" name="deleted_events" type="hidden" value="">
                <input id="duration_hours" name="duration_hours" type="hidden" value="{$fields.duration_hours.value}">
                <input id="duration_minutes" name="duration_minutes" type="hidden" value="{$fields.duration_minutes.value}">
                {sugar_getscript file="custom/modules/FP_events/duration_dependency.js"}
                <script type="text/javascript">
                    var date_time_format = "{$CALENDAR_FORMAT}";
                    {literal}
                    SUGAR.util.doWhen(function(){return typeof DurationDependency != "undefined" && typeof document.getElementById("duration") != "undefined" && $("#date_start_date").val() != "" && $("#date_end_date").val() != ""}, function(){
                        var duration_dependency = new DurationDependency("date_start","date_end","duration",date_time_format);
                        initEditView(YAHOO.util.Selector.query(\'select#duration\')[0].form);
                    });
                    {/literal}
                </script>            
            ',
            'customCodeReadOnly' => '{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV} ',
          ),
          1 => 
          array (
            'name' => 'events_multiple_assigned_users',
            'label' => 'LBL_MULTIPLE_ASSIGNED_USERS',
          ),
        ),
      ),
      'lbl_editview_attachment' =>
      array (
        0 =>
        array (
          0 =>
          array (
            'name' => 'attachments',
            'type' => 'FileUpload',
          ),
        ),
      ),

    ),
  ),
);
