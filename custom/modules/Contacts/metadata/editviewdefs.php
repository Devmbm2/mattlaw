<?php
$viewdefs ['Contacts'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">',
          1 => '<input type="hidden" name="case_id" value="{$smarty.request.case_id}">',
          2 => '<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">',
          3 => '<input type="hidden" name="email_id" value="{$smarty.request.email_id}">',
          4 => '<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="Save" accesskey="a" class="button primary" onclick="var _form = document.getElementById(\'EditView\'); _form.action.value=\'Save\';if(custom_validation())if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">',
          ),
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_children.js',
        ),
        1 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_everarre.js',
        ),
        2 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_marital.js',
        ),
        3 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_probwork.js',
        ),
        4 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_pastwork.js',
        ),
        5 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_salutation.js',
        ),
        6 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_suffix.js',
        ),
        7 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_servmili.js',
        ),
        8 => 
        array (
          'file' => 'custom/include/javascript/visible/cont_type.js',
        ),
        9 => 
        array (
          'file' => 'custom/modules/Contacts/js/restrict_charactor.js',
        ),
        10 => 
        array (
          'file' => 'custom/include/javascript/visible/workflow_status.js',
        ),
      ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
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
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'lbl_contact_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'middle_name',
            'label' => 'LBL_MIDDLE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'last_name',
          ),
          1 => 
          array (
            'name' => 'suffix',
            'studio' => 'visible',
            'label' => 'LBL_SUFFIX',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'dear_c',
            'label' => 'LBL_DEAR',
          ),
          1 => 
          array (
            'name' => 'type_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'federal_tax_id_c',
            'label' => 'LBL_FEDERAL_TAX_ID',
          ),
          1 => 
          array (
            'name' => 'expert_type_c',
            'studio' => 'visible',
            'label' => 'LBL_EXPERT_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
          1 => 
          array (
            'name' => 'ssn_c',
            'type' => 'dupdetector',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'gender',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
          1 => 
          array (
            'name' => 'occupation_c',
            'label' => 'LBL_OCCUPATION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'doctor_type_c',
            'studio' => 'visible',
            'label' => 'LBL_DOCTOR_TYPE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'phone_mobile',
            'type' => 'dupdetector',
          ),
          1 => 
          array (
            'name' => 'phone_other',
            'comment' => 'Other phone number for the contact',
            'label' => 'LBL_OTHER_PHONE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'countrycode_ht',
            'comment' => 'Extension for country code',
            'label' => 'LBL_COUNTRYCODE_HT',
          ),
          1 => 
          array (
            'name' => 'phone_work',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'phone_fax',
            'comment' => 'Contact fax number',
            'label' => 'LBL_FAX_PHONE',
          ),
          1 => 
          array (
            'name' => 'assistant',
            'comment' => 'Name of the assistant of the contact',
            'label' => 'LBL_ASSISTANT',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'assistant_phone',
            'comment' => 'Phone number of the assistant of the contact',
            'label' => 'LBL_ASSISTANT_PHONE',
          ),
          1 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL_ADDRESS',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'judge_web_page_c',
            'label' => 'LBL_JUDGE_WEB_PAGE',
          ),
          1 => 
          array (
            'name' => 'birthday_card_c',
            'label' => 'LBL_BIRTHDAY_CARD',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'newsletter_c',
            'label' => 'LBL_NEWSLETTER',
          ),
          1 => 
          array (
            'name' => 'felony_convictions_c',
            'studio' => 'visible',
            'label' => 'LBL_FELONY_CONVICTIONS',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'displayParams' => 
            array (
              'key' => 'billing',
              'copy' => 'primary',
              'billingKey' => 'primary',
              'additionalFields' => 
              array (
                'phone_office' => 'phone_work',
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'county_of_convictions_c',
            'label' => 'LBL_COUNTY_OF_CONVICTIONS',
          ),
        ),
        16 => 
        array (
          0 => 
          array (
            'name' => 'years_of_convictions_c',
            'label' => 'LBL_YEARS_OF_CONVICTIONS',
          ),
          1 => 
          array (
            'name' => 'pre_existing_conditions_c',
            'studio' => 'visible',
            'label' => 'LBL_PRE_EXISTING_CONDITIONS',
          ),
        ),
        17 => 
        array (
          0 => 'assigned_user_name',
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'marital_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MARITAL_STATUS',
          ),
          1 => 
          array (
            'name' => 'spouse_name_c',
            'label' => 'LBL_SPOUSE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'language_spoken_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SPOKEN',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'total_lops_liens_c',
            'label' => 'LBL_TOTAL_LOPS_LIENS',
          ),
          1 => 
          array (
            'name' => 'total_medical_bills_c',
            'label' => 'LBL_TOTAL_MEDICAL_BILLS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'lead_source',
            'comment' => 'How did the contact come about',
            'label' => 'LBL_LEAD_SOURCE',
          ),
          1 => 
          array (
            'name' => 'race_c',
            'studio' => 'visible',
            'label' => 'LBL_RACE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'drivers_license1_c',
            'label' => 'LBL_DRIVERS_LICENSE1',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'license_susp_revoked_c',
            'studio' => 'visible',
            'label' => 'LBL_LICENSE_SUSP_REVOKED',
          ),
          1 => 
          array (
            'name' => 'work_injury_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'work_injury_status_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY_STATUS',
          ),
          1 => 
          array (
            'name' => 'work_injury_details_c',
            'studio' => 'visible',
            'label' => 'LBL_WORK_INJURY_DETAILS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'health_problems_c',
            'studio' => 'visible',
            'label' => 'LBL_HEALTH_PROBLEMS',
          ),
          1 => 
          array (
            'name' => 'avg_annual_income_c',
            'label' => 'LBL_AVG_ANNUAL_INCOME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'military_c',
            'studio' => 'visible',
            'label' => 'LBL_MILITARY',
          ),
          1 => 
          array (
            'name' => 'honorably_discharged_c',
            'studio' => 'visible',
            'label' => 'LBL_HONORABLY_DISCHARGED',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'arrested_c',
            'studio' => 'visible',
            'label' => 'LBL_ARRESTED',
          ),
          1 => 
          array (
            'name' => 'arrest_details_c',
            'studio' => 'visible',
            'label' => 'LBL_ARREST_DETAILS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'filed_taxes_c',
            'studio' => 'visible',
            'label' => 'LBL_FILED_TAXES',
          ),
          1 => 
          array (
            'name' => 'children_c',
            'studio' => 'visible',
            'label' => 'LBL_CHILDREN',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'about_children_c',
            'studio' => 'visible',
            'label' => 'LBL_ABOUT_CHILDREN',
          ),
          1 => 
          array (
            'name' => 'close_contact_c',
            'studio' => 'visible',
            'label' => 'LBL_CLOSE_CONTACT',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'social_skills_c',
            'studio' => 'visible',
            'label' => 'LBL_SOCIAL_SKILLS',
          ),
          1 => 
          array (
            'name' => 'personality_rating_c',
            'studio' => 'visible',
            'label' => 'LBL_PERSONALITY_RATING',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'language_skills_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE_SKILLS',
          ),
          1 => 
          array (
            'name' => 'financial_status_c',
            'studio' => 'visible',
            'label' => 'LBL_FINANCIAL_STATUS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'clients_relationships_c',
            'studio' => 'visible',
            'label' => 'LBL_CLIENTS_RELATIONSHIPS',
          ),
          1 => 
          array (
            'name' => 'appearance_dress_c',
            'studio' => 'visible',
            'label' => 'LBL_APPEARANCE_DRESS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'overall_jury_appeal_c',
            'studio' => 'visible',
            'label' => 'LBL_OVERALL_JURY_APPEAL',
          ),
          1 => 
          array (
            'name' => 'highest_level_of_education_c',
            'studio' => 'visible',
            'label' => 'LBL_HIGHEST_LEVEL_OF_EDUCATION',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'observations_about_client_c',
            'studio' => 'visible',
            'label' => 'LBL_OBSERVATIONS_ABOUT_CLIENT',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'fee_schedule_c',
            'label' => 'LBL_FEE_SCHEDULE',
          ),
          1 => 
          array (
            'name' => 'financial_c',
            'label' => 'LBL_FINANCIAL',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'discovery_c',
            'studio' => 'visible',
            'label' => 'LBL_DISCOVERY',
          ),
          1 => 
          array (
            'name' => 'transcript_c',
            'label' => 'LBL_TRANSCRIPT',
          ),
        ),
      ),
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
    ),
  ),
);
