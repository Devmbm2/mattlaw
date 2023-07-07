<?php
$module_name = 'DISC_Discovery';
$OBJECT_NAME = 'DISC_DISCOVERY';
$listViewDefs [$module_name] = 
array (
  'DATE_SERVED' => 
  array (
    'type' => 'date',
    'label' => 'LBL_DATE_SERVED',
    'width' => '10%',
    'default' => true,
    'link' => true,
    'sortable' => false,
  ),
  'DISC_DISCOVERY_CASES_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_DISC_DISCOVERY_CASES_FROM_CASES_TITLE',
    'id' => 'DISC_DISCOVERY_CASESCASES_IDA',
    'width' => '10%',
    'default' => true,
    'sortable' => false,
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'sortable' => false,
  ),
  'UPLOADFILE' => 
  array (
    'type' => 'file',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'width' => '10%',
    'default' => true,
    'sortable' => false,
    'displayParams' => 
    array (
      'module' => 'DISC_Discovery',
    ),
  ),
  'DISCOVERY_MATRIX_C' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DISCOVERY_MATRIX',
    'width' => '10%',
  ),
  'RELATED_CASE_ASSISTANT' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RELATED_CASE_ASSISTANT',
    'link' => true,
    'width' => '10%',
    'sortable' => false,
  ),
  'RELATED_CASE_ASSIGNED_TO' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_ASSIGNED_TO',
    'link' => true,
    'width' => '10%',
    'sortable' => false,
  ),
  'DONE' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_DONE',
    'width' => '10%',
  ),
  'TYPE' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
    'default' => false,
    'sortable' => false,
  ),
);
