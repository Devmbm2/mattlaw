<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
//$hook_array['before_save'] = Array(); 
//$hook_array['before_save'][] = Array(99, 'Pleadings Name Concat', 'custom/modules/PLEA_Pleadings/name_concat.php','name_concat', 'plea_name_concat'); 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Create Event', 'custom/modules/Documents/create_event.php','create_event', 'save_event');
$hook_array['process_record'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['before_save'][] = Array(199, 'Update fields on done', 'custom/modules/Documents/update_fields_on_done.php','updateFieldsOnDone', 'update_fields_on_done'); 
$hook_array['process_record'][] = Array(12, 'Update Case Assigned to ', 'custom/modules/PLEA_Pleadings/update_case_assigned_to.php','update', 'update_case_assigned_to'); 
$hook_array['before_save'][] = Array(200, 'Approve Pleading incoming from Email ', 'custom/modules/PLEA_Pleadings/Approve_email_pleading.php','Approve_email_pleading', 'Approve_pleading'); 


?>

