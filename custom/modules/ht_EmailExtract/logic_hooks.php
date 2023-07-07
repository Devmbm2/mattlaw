<?php 
 
 $hook_version = 1;
 $hook_array = Array();
$hook_array['before_save'][] = Array(10, 'Get all configuration field for email extraction module', 'custom/modules/ht_EmailExtract/EmailConfiguration.php','emailConfig', 'configuration');
$hook_array['after_save'][] = Array(1, 'Sync Emails into DB', 'custom/modules/ht_EmailExtract/SyncEmails.php','SyncEmails', 'syncEmailsToDB');
$hook_array['after_save'][] = Array(12, 'Create record form the emails', 'custom/modules/ht_EmailExtract/CreatRecordFromEmails.php','CreatRecordFromEmails', 'createRecord');
