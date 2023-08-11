<?php
    global $db;
    $workflows_q = $db->query("SELECT id, name FROM aow_workflow WHERE deleted = 0 AND flow_module= '".$_GET['module_get']."'");
    $workflows_options = array();
    while ($workflow = $db->fetchByAssoc($workflows_q)) {
        $workflows_options[] = array(
            'value' => $workflow['id'],
            'text' => $workflow['name']
        );
    }
    $workflows_json = json_encode($workflows_options);
    header('Content-Type: application/json');
    echo $workflows_json;
    exit;
