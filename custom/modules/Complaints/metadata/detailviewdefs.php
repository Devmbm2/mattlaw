<?php
$viewdefs ['Complaints'] = 
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
            'customCode' => '<input type="button" onclick="window.open(\'index.php?entryPoint=printPdf&client_cost_total=true&templateID=a6fabfe4-4f0c-6565-dfdd-5a8e8c78cf9c&module=Complaints&uid={$fields.id.value}\')" target="_blank" value="Cost Report" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button" onclick="show_complaint_related_events_report(\'{$fields.id.value}\');" target="_blank" value="Events Report" />',
          ),
          5 => 
          array (
            'customCode' => '{if $fields.status.value != "Closed"} <input title="{$APP.LBL_CLOSE_BUTTON_TITLE}" id="close_button" class="button"  onclick="this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Complaints\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'"  name="button1"  value="{$APP.LBL_CLOSE_BUTTON_TITLE}"  type="submit">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_CLOSE_BUTTON_TITLE}',
                'class' => 'button',
                'onclick' => 'this.form.status.value=\'Closed\'; this.form.action.value=\'Save\';this.form.return_module.value=\'Complaints\';this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$fields.id.value}\'',
                'name' => 'button1',
                'id' => 'close_button',
              ),
            ),
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL7' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL28' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL29' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL13' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL17' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL10' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL14' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL18' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL11' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL15' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL19' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL12' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL16' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL20' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL21' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL22' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL23' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL24' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL27' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL25' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL26' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'case_name_c',
            'studio' => 'visible',
            'label' => 'LBL_CASE_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_of_incident_c',
            'label' => 'LBL_DATE_OF_INCIDENT',
          ),
          1 => 
          array (
            'name' => 'county_of_incident_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTY_OF_INCIDENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'location_of_incident_c',
            'label' => 'LBL_LOCATION_OF_INCIDENT',
          ),
        ),
        4 => 
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
        5 => 
        array (
          0 => 
          array (
            'name' => 'location_of_2nd_incident_c',
            'label' => 'LBL_LOCATION_OF_2ND_INCIDENT',
          ),
        ),
		6 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'clerk_c',
            'studio' => 'visible',
            'label' => 'LBL_CLERK',
          ),
          1 => 
          array (
            'name' => 'court_venue_c',
            'studio' => 'visible',
            'label' => 'LBL_COURT_VENUE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_person_named_clerk_c',
            'label' => 'LBL_Z_PERSON_NAMED_CLERK',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'ada_coordinator',
            'label' => 'LBL_ADA_COORDINATOR',
          ),
          1 => 
          array (
            'name' => 'z_ada_clerk_contact_info_c',
            'label' => 'LBL_Z_ADA_CLERK_CONTACT_INFO',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_ada_clerk_address_c',
            'label' => 'LBL_Z_ADA_CLERK_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'z_ada_clerk_phone_number_c',
            'label' => 'LBL_Z_ADA_CLERK_PHONE_NUMBER',
          ),
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'injured_person_c',
            'studio' => 'visible',
            'label' => 'LBL_INJURED_PERSON',
          ),
          1 => 
          array (
            'name' => 'z_inured_1_nickname_c',
            'label' => 'LBL_Z_INURED_1_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_name_of_p_representative_c',
            'label' => 'LBL_Z_NAME_OF_P_REPRESENTATIVE',
          ),
          1 => 
          array (
            'name' => 'representation_capacity_c',
            'studio' => 'visible',
            'label' => 'LBL_REPRESENTATION_CAPACITY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'injured_person_age_c',
            'label' => 'LBL_INJURED_PERSON_AGE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_plaintiff_vehicle_descript_c',
            'label' => 'LBL_Z_PLAINTIFF_VEHICLE_DESCRIPT',
          ),
        ),
      ),
      'lbl_editview_panel28' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'injured_person_2_name_c',
            'studio' => 'visible',
            'label' => 'LBL_INJURED_PERSON_2_NAME',
          ),
          1 => 
          array (
            'name' => 'z_injured_person_2_nickname_c',
            'label' => 'LBL_Z_INJURED_PERSON_2_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name_p_injured_2_representat_c',
            'label' => 'LBL_NAME_P_INJURED_2_REPRESENTAT',
          ),
          1 => 
          array (
            'name' => 'representative_cap_inj_2_c',
            'label' => 'LBL_REPRESENTATIVE_CAP_INJ_2',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'injured_2_age_c',
            'label' => 'LBL_INJURED_2_AGE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'injured_2_property_damage_de_c',
            'label' => 'LBL_INJURED_2_PROPERTY_DAMAGE_DE',
          ),
        ),
      ),
      'lbl_editview_panel29' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'z_plaintiff_spouse_name_c',
            'label' => 'LBL_Z_PLAINTIFF_SPOUSE_NAME',
          ),
          1 => 
          array (
            'name' => 'z_ps_dependent_relative_name_c',
            'label' => 'LBL_Z_PS_DEPENDENT_RELATIVE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_ps_minor_child_1_name_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_1_NAME',
          ),
          1 => 
          array (
            'name' => 'z_ps_minor_child_1_age_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_1_AGE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_ps_minor_child_2_name_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_2_NAME',
          ),
          1 => 
          array (
            'name' => 'z_ps_minor_child_2_age_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_2_AGE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_ps_minor_child_3_name_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_3_NAME',
          ),
          1 => 
          array (
            'name' => 'z_ps_minor_child_3_age_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_3_AGE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'z_ps_minor_child_4_name_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_4_NAME',
          ),
          1 => 
          array (
            'name' => 'z_ps_minor_child_4_age_c',
            'label' => 'LBL_Z_PS_MINOR_CHILD_4_AGE',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'bad_driver_1_name_c',
            'studio' => 'visible',
            'label' => 'LBL_BAD_DRIVER_1_NAME',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_1_nickname_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_1_address_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_1_dl_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_DL_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_1_year_birth_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_YEAR_BIRTH',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_1_phone_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_PHONE_NUMBER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_1_vehicle_descr_c',
            'label' => 'LBL_Z_BAD_DRIVER_1_VEHICLE_DESCR',
          ),
        ),
      ),
      'lbl_editview_panel13' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'owner_bad_vehicle_1_name_c',
            'studio' => 'visible',
            'label' => 'LBL_OWNER_BAD_VEHICLE_1_NAME',
          ),  
		  1 => 
          array (
            'name' => 'owner_bad_vehicle_1_name_contact',
            'studio' => 'visible',
            'label' => 'LBL_OWNER_BAD_VEHICLE_1_NAME_CONTACT',
          ),
         
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_1_nickna_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_1_NICKNA',
          ),
        ), 
		2 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_1_ra_nam_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_1_RA_NAM',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_1_addres_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_1_ADDRES',
          ),
        ),
      ),
      'lbl_editview_panel17' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employer_driver_1_name_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYER_DRIVER_1_NAME',
          ),
          1 => 
          array (
            'name' => 'z_employer_driver_1_nickname_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_1_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_1_ra_name_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_1_RA_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_1_address_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_1_ADDRESS',
          ),
        ),
      ),
      'lbl_editview_panel10' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'bad_driver_2_name_c',
            'studio' => 'visible',
            'label' => 'LBL_BAD_DRIVER_2_NAME',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_2_nickname_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_2_address_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_2_dl_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_DL_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_2_year_of_birth_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_YEAR_OF_BIRTH',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_2_phone_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_PHONE_NUMBER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_2_vehicle_descr_c',
            'label' => 'LBL_Z_BAD_DRIVER_2_VEHICLE_DESCR',
          ),
        ),
      ),
      'lbl_editview_panel14' => 
      array (
         0 => 
        array (
          0 => 
          array (
            'name' => 'owner_bad_vehicle_2_name_c',
            'label' => 'LBL_OWNER_BAD_VEHICLE_2_NAME',
          ),  
		  1 => 
          array (
            'name' => 'owner_bad_vehicle_2_name_contact',
            'label' => 'LBL_OWNER_BAD_VEHICLE_2_NAME_CONTACT',
          ),
          
        ),
        1 => 
        array (
          1 => 
          array (
            'name' => 'z_owner_bad_vehicle_2_nickna_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_2_NICKNA',
          ),
        ), 
		2 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_2_ra_nam_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_2_RA_NAM',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_2_addres_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_2_ADDRES',
          ),
        ),
      ),
      'lbl_editview_panel18' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employer_driver_2_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYER_DRIVER_2',
          ),
          1 => 
          array (
            'name' => 'z_employer_driver_2_nickname_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_2_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_2_ra_name_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_2_RA_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_2_address_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_2_ADDRESS',
          ),
        ),
      ),
      'lbl_editview_panel11' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'bad_driver_3_c',
            'studio' => 'visible',
            'label' => 'LBL_BAD_DRIVER_3',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_3_nickname_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_3_address_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_3_dl_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_DL_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_3_year_of_birth_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_YEAR_OF_BIRTH',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_3_phone_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_PHONE_NUMBER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_3_vehicle_descr_c',
            'label' => 'LBL_Z_BAD_DRIVER_3_VEHICLE_DESCR',
          ),
        ),
      ),
      'lbl_editview_panel15' => 
      array (
         0 => 
        array (
          0 => 
          array (
            'name' => 'owner_bad_vehicle_3_c',
            'label' => 'LBL_OWNER_BAD_VEHICLE_3',
          ),       
		  1 => 
          array (
            'name' => 'owner_bad_vehicle_3_name_contact',
            'label' => 'LBL_OWNER_BAD_VEHICLE_3_NAME_CONTACT',
          ),
          
        ),
        1 => 
        array (
			 0 => 
			  array (
				'name' => 'z_owner_bad_vehicle_3_nickna_c',
				'label' => 'LBL_Z_OWNER_BAD_VEHICLE_3_NICKNA',
			  ),
        ), 
		2 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_3_ra_nam_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_3_RA_NAM',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_3_addres_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_3_ADDRES',
          ),
        ),
      ),
      'lbl_editview_panel19' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employer_driver_3_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYER_DRIVER_3',
          ),
          1 => 
          array (
            'name' => 'z_employer_driver_3_nickname_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_3_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_3_ra_name_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_3_RA_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_3_address_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_3_ADDRESS',
          ),
        ),
      ),
      'lbl_editview_panel12' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'bad_driver_4_c',
            'studio' => 'visible',
            'label' => 'LBL_BAD_DRIVER_4',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_4_nickname_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_4_address_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_4_dl_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_DL_NUMBER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_4_year_of_birth_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_YEAR_OF_BIRTH',
          ),
          1 => 
          array (
            'name' => 'z_bad_driver_4_phone_number_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_PHONE_NUMBER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_bad_driver_4_vehicle_descr_c',
            'label' => 'LBL_Z_BAD_DRIVER_4_VEHICLE_DESCR',
          ),
        ),
      ),
      'lbl_editview_panel16' => 
      array (
       0 => 
        array (
          0 => 
          array (
            'name' => 'owner_bad_vehicle_4_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_4_NAME',
          ),   
		  1 => 
          array (
            'name' => 'owner_bad_vehicle_4_name_contact',
            'label' => 'LBL_OWNER_BAD_VEHICLE_4_NAME_CONTACT',
          ),
          
        ),
        1 => 
        array (
         0 => 
          array (
            'name' => 'z_owner_bad_vehicle_4_nickna_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_4_NICKNA',
          ),
        ),
		2 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_4_ra_nam_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_4_RA_NAM',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'z_owner_bad_vehicle_4_addres_c',
            'label' => 'LBL_Z_OWNER_BAD_VEHICLE_4_ADDRES',
          ),
        ),
      ),
      'lbl_editview_panel20' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employer_driver_4_c',
            'studio' => 'visible',
            'label' => 'LBL_EMPLOYER_DRIVER_4',
          ),
          1 => 
          array (
            'name' => 'z_employer_driver_4_nickname_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_4_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_4_ra_name_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_4_RA_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_employer_driver_4_address_c',
            'label' => 'LBL_Z_EMPLOYER_DRIVER_4_ADDRESS',
          ),
        ),
      ),
      'lbl_editview_panel21' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'um_owner_of_car_p_was_in_c',
            'studio' => 'visible',
            'label' => 'LBL_UM_OWNER_OF_CAR_P_WAS_IN',
          ),
          1 => 
          array (
            'name' => 'z_um_vehicle_owner_nickname_c',
            'label' => 'LBL_Z_UM_VEHICLE_OWNER_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_um_vehicle_owner_policy_nu_c',
            'label' => 'LBL_Z_UM_VEHICLE_OWNER_POLICY_NU',
          ),
          1 => 
          array (
            'name' => 'um_owner_date_we_filed_crn',
            'label' => 'LBL_UM_OWNER_DATE_WE_FILED_CRN',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'um_owner_insured_name_c',
            'label' => 'LBL_UM_OWNER_INSURED_NAME',
          ),
		   1 => 
          array (
            'name' => 'um_owner_named_insured',
            'label' => 'LBL_UM_OWNER_NAMED_INSURED',
          ),
        ),
      ),
      'lbl_editview_panel22' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'um_of_driver_p_was_riding_wi_c',
            'studio' => 'visible',
            'label' => 'LBL_UM_OF_DRIVER_P_WAS_RIDING_WI',
          ),
          1 => 
          array (
            'name' => 'z_um_driver_nickname_ins_co_c',
            'label' => 'LBL_Z_UM_DRIVER_NICKNAME_INS_CO',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_um_driver_policy_number_c',
            'label' => 'LBL_Z_UM_DRIVER_POLICY_NUMBER',
          ),
          1 => 
          array (
            'name' => 'z_um_driver_crn_date_filed_c',
            'label' => 'LBL_Z_UM_DRIVER_CRN_DATE_FILED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'um_driver_insured_name_c',
            'label' => 'LBL_UM_DRIVER_INSURED_NAME',
          ),
		  1 => 
          array (
            'name' => 'um_driver_insured_name',
            'label' => 'LBL_UM_DRIVER_INSURED_NAME_1',
          ),
        ),
      ),
      'lbl_editview_panel23' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'um_employer_name_c',
            'studio' => 'visible',
            'label' => 'LBL_UM_EMPLOYER_NAME',
          ),
          1 => 
          array (
            'name' => 'z_um_employer_nickname_c',
            'label' => 'LBL_Z_UM_EMPLOYER_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_um_employer_policy_number_c',
            'label' => 'LBL_Z_UM_EMPLOYER_POLICY_NUMBER',
          ),
          1 => 
          array (
            'name' => 'z_um_employer_date_crn_c',
            'label' => 'LBL_Z_UM_EMPLOYER_DATE_CRN',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'um_employer_insured_name_c',
            'label' => 'LBL_UM_EMPLOYER_INSURED_NAME',
          ),
        ),
      ),
      'lbl_editview_panel24' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'um_of_our_client_c',
            'studio' => 'visible',
            'label' => 'LBL_UM_OF_OUR_CLIENT',
          ),
          1 => 
          array (
            'name' => 'z_um_of_client_nickname_c',
            'label' => 'LBL_Z_UM_OF_CLIENT_NICKNAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'z_um_of_client_policy_number_c',
            'label' => 'LBL_Z_UM_OF_CLIENT_POLICY_NUMBER',
          ),
          1 => 
          array (
            'name' => 'z_um_of_client_date_crn_c',
            'label' => 'LBL_Z_UM_OF_CLIENT_DATE_CRN',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_um_of_client_insured_name_c',
            'label' => 'LBL_Z_UM_OF_CLIENT_INSURED_NAME',
          ),
        ),
      ),
      'lbl_editview_panel27' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'um_settled_with_not_suing_c',
            'studio' => 'visible',
            'label' => 'LBL_UM_SETTLED_WITH_NOT_SUING',
          ),
        ),
      ),
      'lbl_editview_panel25' => 
      array (
		   array (
          0 => 
          array (
            'name' => 'property_owner_where_p_was_i_c',
            'studio' => 'visible',
            'label' => 'LBL_PROPERTY_OWNER_WHERE_P_WAS_I',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'account_id11_c',
                'name' => 'property_owner_where_p_was_i_c',
                'nickname_c' => 'z_property_owner_nickname_c',
                'ra_name_c' => 'ra_of_property_owner_c',
                'full_address' => 'owner_of_property_address_c',
              ),
            ),
          ),  
		  1 => 
          array (
            'name' => 'property_owner_where_p_was_i_c_contact',
            'studio' => 'visible',
            'label' => 'LBL_PROPERTY_OWNER_WHERE_P_WAS_I',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'property_owner_where_p_was_i_c_contact_id',
                'fml_name' => 'property_owner_where_p_was_i_c_contact',
                'middle_name' => 'z_property_owner_nickname_c',
                'full_address' => 'owner_of_property_address_c',
              ),
            ),
          ),
          
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'z_property_owner_nickname_c',
            'label' => 'LBL_Z_PROPERTY_OWNER_NICKNAME',
          ),
        ), 
		3 => 
        array (
          0 => 
          array (
            'name' => 'ra_of_property_owner_c',
            'label' => 'LBL_RA_OF_PROPERTY_OWNER',
          ),
          1 => 
          array (
            'name' => 'owner_of_property_address_c',
            'label' => 'LBL_OWNER_OF_PROPERTY_ADDRESS',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'z_property_location_descript_c',
            'label' => 'LBL_Z_PROPERTY_LOCATION_DESCRIPT',
          ),
        ),
      ),
      'lbl_editview_panel26' => 
      array (
		        0 => 
        array (
          0 => 
          array (
            'name' => 'property_manager_where_p_inj_c',
            'label' => 'LBL_PROPERTY_MANAGER_WHERE_P_INJ',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'account_id12_c',
                'name' => 'property_manager_where_p_inj_c',
                'nickname_c' => 'z_property_manager_nickname_c',
                'ra_name_c' => 'ra_property_manager_c',
                'billing_address_street' => 'property_manager_address_c',
              ),
            ),
          ), 
		  1 => 
          array (
            'name' => 'property_manager_where_p_inj_c_contact',
            'label' => 'LBL_PROPERTY_MANAGER_WHERE_P_INJ_C_CONTACT',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'property_manager_where_p_inj_c_contact_id',
                'fml_name' => 'property_manager_where_p_inj_c_contact',
                'middle_name' => 'z_property_manager_nickname_c',
                'full_address' => 'property_manager_address_c',
              ),
            ),
          ),
          
        ),
        1 => 
        array (
         0 => 
          array (
            'name' => 'z_property_manager_nickname_c',
            'label' => 'LBL_Z_PROPERTY_MANAGER_NICKNAME',
          ),
        ),   
		2 => 
        array (
          0 => 
          array (
            'name' => 'ra_property_manager_c',
            'label' => 'LBL_RA_PROPERTY_MANAGER',
          ),
          1 => 
          array (
            'name' => 'property_manager_address_c',
            'label' => 'LBL_PROPERTY_MANAGER_ADDRESS',
          ),
        ),
      ),
    ),
  ),
);
