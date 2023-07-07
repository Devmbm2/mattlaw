<?php

$hook_array['after_save'][] = array(
    1,
    'Mark done when assistant pass the document',
    'custom/modules/DISC_Discovery/LogicHooks/DiscoveryAfterSave.php',
    'DiscoveryAfterSave',
    'MarkDone'
);
