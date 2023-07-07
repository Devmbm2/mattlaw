<?php
$hook_version = 1;
$hook_array = Array();
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(1, 'inactivating status related workflows ', 'custom/modules/AOW_WorkFLow/inactivateRelatedWOrkflowsDependingOnType.php','inactiveWorkflows', 'inactive');


?>
