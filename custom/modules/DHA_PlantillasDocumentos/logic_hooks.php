<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'Send Slack notification', 'custom/include/slack/slack_notification.php','slack_notification_class', 'slack_notification_method'); 
$hook_array['before_save'][] = Array(2, 'Set the Use letterhead to no', 'custom/modules/DHA_PlantillasDocumentos/DHA_PlantillasDocumentosHooks.php','DHA_PlantillasDocumentosHooks', 'checkLitigationCFields'); 


?>