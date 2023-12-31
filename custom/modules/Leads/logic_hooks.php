<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'Leads push feed', 'modules/Leads/SugarFeeds/LeadFeed.php','LeadFeed', 'pushFeed');
$hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'modules/Leads/LeadsJjwg_MapsLogicHook.php','LeadsJjwg_MapsLogicHook', 'updateGeocodeInfo');
/* $hook_array['before_save'][] = Array(77, 'Leads Calculation', 'custom/modules/Leads/lead_calculation.php','lead_calculation', 'calculation');  */
$hook_array['before_save'][] = Array(77, 'Leads from web form', 'custom/modules/Leads/lead_calculation.php','lead_calculation', 'lead_from_web');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'modules/Leads/LeadsJjwg_MapsLogicHook.php','LeadsJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo');
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method');
$hook_array['after_ui_frame'] = Array();
$hook_array['after_ui_frame'][] = Array(1002, 'Document Templates after_ui_frame Hook', 'custom/modules/Leads/DHA_DocumentTemplatesHooks.php','DHA_DocumentTemplatesLeadsHook_class', 'after_ui_frame_method');
$hook_array['after_ui_frame'][] = Array(100, 'SMS Connector', 'modules/SMS_Configuration/SMS_UIFrame.php', 'SMS_Class', 'SMS_Func');


?>
