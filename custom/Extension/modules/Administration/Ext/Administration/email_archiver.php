<?php
$admin_option_defs = array();
$admin_option_defs['Administration']['EmailArchiver'] = array(
    'Administration',
    'LBL_EMAIL_ARCHIVER',
    'LBL_EMAIL_ARCHIVER_DESCRIPTION_SHORT',
    './index.php?module=InboundEmail&action=EmailArchiver',
    'email-settings'
);
$admin_group_header[] = array(
    'LBL_EMAIL_ARCHIVER',
    '',
    false,
    $admin_option_defs,
    'LBL_EMAIL_ARCHIVER_DESCRIPTION'
);
?>