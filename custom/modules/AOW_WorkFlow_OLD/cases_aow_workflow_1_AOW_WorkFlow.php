<?php
// created: 2022-09-29 16:29:44
$dictionary["AOW_WorkFlow"]["fields"]["cases_aow_workflow_1"] = array (
  'name' => 'cases_aow_workflow_1',
  'type' => 'link',
  'relationship' => 'cases_aow_workflow_1',
  'source' => 'non-db',
  'module' => 'Cases',
  'bean_name' => 'Case',
  'vname' => 'LBL_CASES_AOW_WORKFLOW_1_FROM_CASES_TITLE',
  'id_name' => 'cases_aow_workflow_1cases_ida',
);
$dictionary["AOW_WorkFlow"]["fields"]["cases_aow_workflow_1_name"] = array (
  'name' => 'cases_aow_workflow_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CASES_AOW_WORKFLOW_1_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'cases_aow_workflow_1cases_ida',
  'link' => 'cases_aow_workflow_1',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["AOW_WorkFlow"]["fields"]["cases_aow_workflow_1cases_ida"] = array (
  'name' => 'cases_aow_workflow_1cases_ida',
  'type' => 'link',
  'relationship' => 'cases_aow_workflow_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CASES_AOW_WORKFLOW_1_FROM_AOW_WORKFLOW_TITLE',
);
