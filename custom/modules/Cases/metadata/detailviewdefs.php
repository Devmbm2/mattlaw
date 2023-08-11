<?php
$viewdefs ['Cases'] = 
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
          3 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?entryPoint=printPdf&client_cost_total=true&templateID=a6fabfe4-4f0c-6565-dfdd-5a8e8c78cf9c&module=Cases&uid={$fields.id.value}\')" target="_blank" value="Cost Report" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?&module=Cases&action=client_costs_to_be_paid&record={$fields.id.value}\')" target="_blank" target="_blank" value="CLIENT COSTS TO BE PAID" />',
          ),
          5 => 
          array (
            'customCode' => '<input type="button" onclick="window.open(\'index.php?&module=Cases&action=client_costs_waived&record={$fields.id.value}\')" target="_blank" target="_blank" value="CLIENT COSTS WAIVED" />',
          ),
          6 => 
          array (
            'customCode' => '<input type="button" onclick="show_case_related_events_report(\'{$fields.id.value}\');" target="_blank" value="Events Report" />',
          ),
          7 => 
          array (
            'customCode' => '{if $fields.status.value != "Closed"} <input title="{$APP.LBL_CLOSE_BUTTON_TITLE}" id="close_button" class="button"  onclick="this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Cases\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'"  name="button1"  value="{$APP.LBL_CLOSE_BUTTON_TITLE}"  type="submit">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
                'class' => 'button',
                'onclick' => 'this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Cases\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'',
                'name' => 'button1',
                'id' => 'close_button',
              ),
            ),
          ),
          8 => 
          array (
            'customCode' => '<input type="button" onclick="show_related_module_files_zip_menu();" target="_blank" value="Download Related Module Files AS Zip" />',
          ),
          9 => 
          array (
            'customCode' => '<input type="button" onclick="send_document_to_sign();" target="_blank" value="Send Document to Sign" />',
          ),
          10 => 
          array (
            'customCode' => '<input type="button" onclick="show_case_related_damages_report(\'{$fields.id.value}\');" target="_blank" value="Damages Report" />',
          ),
        ),
        'hidden' => 
        array (
          0 => '<input type="hidden" name="status" value="">',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Cases/js/form-builder.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Cases/js/form-render.js',
        ),
        2 => 
        array (
          'file' => 'custom/modules/Cases/js/main.js',
        ),
        3 => 
        array (
          'file' => 'custom/modules/Cases/js/ht_formbuilder_utils.js',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CASE_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_RESOLUTION_STRATEGY_PANEL' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_case_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
          ),
          1 => 'status',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'client_c',
            'studio' => 'visible',
            'label' => 'LBL_CLIENT',
          ),
          1 => 
          array (
            'name' => 'injured_person_c',
            'studio' => 'visible',
            'label' => 'LBL_INJURED_PERSON',
          ),
        ),
        2 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'gender',
            'label' => 'LBL_GENDER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'representation_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATION_CAPACITY',
          ),
        ),
        4 => 
        array (
          0 => 'type',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description_short_c',
            'label' => 'LBL_DESCRIPTION_SHORT',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'date_of_2nd_incident_c',
            'label' => 'LBL_DATE_OF_2ND_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'county_of_2nd_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_2ND_INCIDENT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'location_of_2nd_incident_c',
            'label' => 'LBL_LOCATION_OF_2ND_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'statute_of_limitations_2nd_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS_2ND',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'insurance_or_collectability_c',
            'studio' => 'visible',
            'label' => 'LBL_INSURANCE_OR_COLLECTABILITY',
          ),
          1 => 
          array (
            'name' => 'case_insurance_summary_c',
            'label' => 'LBL_CASE_INSURANCE_SUMMARY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'damages_c',
            'studio' => 'visible',
            'label' => 'LBL_DAMAGES',
          ),
          1 => 
          array (
            'name' => 'liability_c',
            'studio' => 'visible',
            'label' => 'LBL_LIABILITY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'number_potential_plaintif_c',
            'studio' => 'visible',
            'label' => 'LBL_NUMBER_POTENTIAL_PLAINTIF',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'case_description_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_DESCRIPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'liability_description_c',
            'studio' => 'visible',
            'label' => 'LBL_LIABILITY_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'damages_description_c',
            'studio' => 'visible',
            'label' => 'LBL_DAMAGES_DESCRIPTION',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'police_c',
            'studio' => 'visible',
            'label' => 'LBL_POLICE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'date_of_incident_c',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'statute_of_limitations_c',
            'label' => 'LBL_STATUTE_OF_LIMITATIONS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'location_of_incident_c',
            'label' => 'LBL_LOCATION_OF_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'county_of_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_INCIDENT',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'state_of_incident',
            'label' => 'LBL_STATE_OF_INCIDENT',
          ),
          1 => '',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 'default_assistant_lawyer_name',
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'referral_person_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_PERSON',
          ),
          1 => 
          array (
            'name' => 'referral_attorney_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_ATTORNEY',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'judge_c',
            'studio' => 'visible',
            'label' => 'LBL_JUDGE',
          ),
          1 => 
          array (
            'name' => 'clerk_c',
            'studio' => 'visible',
            'label' => 'LBL_CLERK',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'judge_assistant_c',
            'label' => 'LBL_JUDGE_ASSISTANT',
          ),
          1 => 
          array (
            'name' => 'judge_asst_phone_c',
            'label' => 'LBL_JUDGE_ASST_PHONE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'judge_asst_email_c',
            'label' => 'LBL_JUDGE_ASST_EMAIL',
          ),
          1 => 
          array (
            'name' => 'judge_web_page_c',
            'label' => 'LBL_JUDGE_WEB_PAGE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'court_style_caption_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_STYLE_CAPTION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'court_venue_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_VENUE',
          ),
          1 => 
          array (
            'name' => 'court_case_number_c',
            'label' => 'LBL_COURT_CASE_NUMBER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'court_division_c',
            'label' => 'LBL_COURT_DIVISION',
          ),
          1 => 
          array (
            'name' => 'pre_trial_conference_hearing_c',
            'label' => 'LBL_PRE_TRIAL_CONFERENCE_HEARING',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'caption_plaintiff_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_PLAINTIFF',
          ),
          1 => 
          array (
            'name' => 'caption_defendant_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_DEFENDANT',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'plural_p_c',
            'label' => 'LBL_PLURAL_P',
          ),
          1 => 
          array (
            'name' => 'plural_d_c',
            'label' => 'LBL_PLURAL_D',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'caption_counterclaim_c',
            'studio' => 'visible',
            'label' => 'LBL_CAPTION_COUNTERCLAIM',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'cos_c',
            'studio' => 'visible',
            'label' => 'LBL_COS',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'mdp_estimated_case_value_c',
            'label' => 'LBL_MDP_ESTIMATED_CASE_VALUE',
          ),
          1 => 
          array (
            'name' => 'amount_to_calc_closing_c',
            'label' => 'LBL_AMOUNT_TO_CALC_CLOSING',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'fee_percentage_c',
            'studio' => 'visible',
            'label' => 'LBL_FEE_PERCENTAGE',
          ),
          1 => 
          array (
            'name' => 'firm_fee_c',
            'label' => 'LBL_FIRM_FEE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'referral_fee_c',
            'label' => 'LBL_REFERRAL_FEE',
          ),
          1 => 
          array (
            'name' => 'cost_hold_back_c',
            'label' => 'LBL_COST_HOLD_BACK',
          ),
        ),
      ),
      'lbl_resolution_strategy_panel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'resolution_strategy',
            'label' => 'LBL_RESOLUTION_STRATEGY',
          ),
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'exception_details_c',
            'label' => 'LBL_EXCEPTION_DETAILS_C',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'workflow_exception_details_c',
            'comment' => 'Full text of the note',
            'studio' => 'visible',
            'label' => 'LBL_WORKFLOW_EXCEPTION_DETAILS',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
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
          1 => 
          array (
            'name' => 'optout_workflows',
            'label' => 'LBL_OPTOUT_WORKFLOWS',
          ),
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
    ),
  ),
);
