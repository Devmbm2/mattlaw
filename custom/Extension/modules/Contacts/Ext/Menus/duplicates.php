<?php
if(ACLController::checkAccess('Contacts', 'list', true)) {
    $module_menu[] = array(
        "index.php?module=Contacts&action=index&rec=duplicates",
        'View Duplicates',
        'today',
        'Contacts'
    );
}