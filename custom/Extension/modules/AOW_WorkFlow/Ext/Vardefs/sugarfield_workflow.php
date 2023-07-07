<?php
$dictionary['AOW_WorkFlow']['fields']['leads'] = array(
    'required'  => false,
    'source'    => 'non-db',
    'name'      => 'workflow',
    'vname'     => 'LBL_WORKFLOW',
    'type'      => 'relate',
    'rname'     => 'name',
    'id_name'   => 'leads_id',
    //'join_name' => 'a',
    'link'      => 'lead_workflows',
    'table'     => 'leads',
    'isnull'    => 'true',
    'module'    => 'Leads',
    );
$dictionary['AOW_WorkFlow']['fields']['leads_id'] = array(
    'name'              => 'leads_id',
    'rname'             => 'id',
    'vname'             => 'LBL_TASKS_ID',
    'type'              => 'id',
    'table'             => 'leads',
    'isnull'            => 'true',
    'module'            => 'Leads',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
    );

