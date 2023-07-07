<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
// $hook_array['process_record'] = Array(); 
// $hook_array['before_save'][] = Array(1, 'Complaints push feed', 'modules/Complaints/SugarFeeds/ComplaintFeed.php','ComplaintFeed', 'pushFeed'); 
// $hook_array['before_save'][] = Array(10, 'Save complaint updates', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'saveUpdate'); 
// $hook_array['before_save'][] = Array(11, 'Save complaint events', 'modules/AOP_Complaint_Events/ComplaintEventsHook.php','ComplaintEventsHook', 'saveUpdate'); 
// $hook_array['before_save'][] = Array(12, 'Complaint closure prep', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'closureNotifyPrep'); 
// $hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'modules/Complaints/ComplaintsJjwg_MapsLogicHook.php','ComplaintsJjwg_MapsLogicHook', 'updateGeocodeInfo'); 
// //$hook_array['before_save'][] = Array(99, 'Create New Complaint Number Logic Hook', 'custom/modules/Complaints/new_complaint_number.php','ComplaintNumber', 'newComplaintNumber'); 
// $hook_array['before_save'][] = Array(100, 'update custom fields', 'custom/modules/Complaints/UpdateCustomFields.php','UpdateCustomFields', 'update_custom_fields'); 
// $hook_array['before_save'][] = Array(50, 'Create a Work Flow that trigger that fires after PRe-Suit 1', 'custom/modules/Complaints/workflow_status_change.php','complaint_workflow', 'status_change'); 
// $hook_array['before_save'][] = Array(50, 'statute_of_limitations_calculations', 'custom/modules/Complaints/complaint_calculation.php','complaint_calculation', 'statute_of_limitations_calculations'); 
// $hook_array['before_save'][] = Array(50, 'Create Relations with Contacts according to roles', 'custom/modules/Complaints/complaint_role.php','complaint_role_class', 'add_contacts_roles'); 
// $hook_array['before_save'][] = Array(50, ' [a.fee_minus_referral_c] = [a.firm_fee_c] minus [a.referral_fee_c]', 'custom/modules/Complaints/complaint_calculation.php','complaint_calculation', 'calculate_fee_minus_referral_c'); 
// $hook_array['before_save'][] = Array(50, ' sum of all running bill/lien records related to the injured_person_c contact', 'custom/modules/Complaints/complaint_calculation.php','complaint_calculation', 'calculate_total_medical_bill'); 
// //$hook_array['process_record'][] = Array(1005, 'filter 6 to 6.6', 'custom/modules/Complaints/complaint_calculation.php','complaint_calculation', 'Setfilter_6');
// $hook_array['before_save'][] = Array(145, 'Contact Archived', 'custom/modules/Complaints/contact_archived.php','contact_archived', 'set_contact_archived'); 
// $hook_array['before_save'][] = Array(50, 'Litigation Workflow trigger before Save', 'custom/modules/Complaints/workflow_status_change.php','complaint_workflow', 'litigation_workflow');
// $hook_array['after_save'] = Array(); 

// $hook_array['after_save'][] = Array(10, 'Send contact complaint closure email', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'closureNotify'); 
// $hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'modules/Complaints/ComplaintsJjwg_MapsLogicHook.php','ComplaintsJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo'); 
// $hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
// $hook_array['after_save'][] = Array(1, 'Save related complaint role', 'custom/modules/Complaints/complaint_role.php','complaint_role_class', 'complaint_role_method'); 
// $hook_array['after_relationship_add'] = Array(); 
// $hook_array['after_relationship_add'][] = Array(9, 'Assign account', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'assignAccount'); 
// $hook_array['after_relationship_add'][] = Array(10, 'Send contact complaint email', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'creationNotify'); 
// $hook_array['after_relationship_add'][] = Array(77, 'addRelationship', 'modules/Complaints/ComplaintsJjwg_MapsLogicHook.php','ComplaintsJjwg_MapsLogicHook', 'addRelationship'); 
// $hook_array['after_retrieve'] = Array(); 
// $hook_array['after_retrieve'][] = Array(10, 'Filter HTML', 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php','ComplaintUpdatesHook', 'filterHTML'); 
// $hook_array['after_relationship_delete'] = Array(); 
// $hook_array['after_relationship_delete'][] = Array(77, 'deleteRelationship', 'modules/Complaints/ComplaintsJjwg_MapsLogicHook.php','ComplaintsJjwg_MapsLogicHook', 'deleteRelationship'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Complaints/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesComplaintsHook_class', 'after_ui_frame_method'); 



?>
