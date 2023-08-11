<?php
$listViewDefs ['Documents'] = 
array (
  'DATE_OF_DOCUMENT_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_DATE_OF_DOCUMENT',
    'width' => '10%',
    'link' => true,
  ),
  'NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_NAME',
    'width' => '10%',
    'default' => true,
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
  'CASES_DOCUMENTS_NAME' => 
  array (
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASES',
    'link' => true,
    'width' => '10%',
  ),
  'DOCUMENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'bold' => true,
  ),
  'EMAIL_DOCUMENTS' => 
  array (
    'type' => 'bool',
    'studio' => 'true',
    'label' => 'LBL_EMAIL_DOCUMENTS',
    'width' => '10%',
    'default' => true,
  ),
  'SUBCATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '15%',
    'label' => 'LBL_LIST_SUBCATEGORY',
    'default' => true,
  ),
  'FILENAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_VIEW_DOCUMENT',
    'link' => true,
    'default' => true,
    'bold' => false,
    'displayParams' => 
    array (
      'module' => 'Documents',
    ),
    'sortable' => false,
    'related_fields' => 
    array (
      0 => 'document_revision_id',
      1 => 'doc_id',
      2 => 'doc_type',
      3 => 'doc_url',
    ),
  ),
  'RELATED_CASE_ASSISTANT' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RELATED_CASE_ASSISTANT',
    'width' => '10%',
    'source' => 'non-db',
    'sortable' => false,
  ),
  'CATEGORY_ID' => 
  array (
    'type' => 'enum',
    'width' => '10%',
    'label' => 'LBL_LIST_CATEGORY',
    'default' => true,
  ),
  'CASE_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CASE_STATUS',
    'width' => '10%',
  ),
  'ASSIGNED_LAWYER_CASES' => 
  array (
    'label' => 'LBL_ASSIGNED_LAWYER_CASES',
    'type' => 'enum',
    'width' => '10%',
    'default' => false,
  ),
);
