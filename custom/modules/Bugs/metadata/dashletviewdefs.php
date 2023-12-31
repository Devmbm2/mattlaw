<?php
$dashletData['BugsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  '' => 
  array (
    'default' => '',
  ),
  'priority' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
  'type' => 
  array (
    'default' => '',
  ),
  'modified_by_name' => 
  array (
    'default' => '',
  ),
  'name' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['BugsDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'modified_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => true,
  ),
  'priority' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIORITY',
    'default' => true,
    'name' => 'priority',
  ),
  'status' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'default' => true,
    'name' => 'status',
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'work_log' => 
  array (
    'type' => 'text',
    'label' => 'LBL_WORK_LOG',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'resolution' => 
  array (
    'width' => '15%',
    'label' => 'LBL_RESOLUTION',
    'name' => 'resolution',
    'default' => false,
  ),
  'release_name' => 
  array (
    'width' => '15%',
    'label' => 'LBL_FOUND_IN_RELEASE',
    'related_fields' => 
    array (
      0 => 'found_in_release',
    ),
    'name' => 'release_name',
    'default' => false,
  ),
  'type' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'name' => 'type',
    'default' => false,
  ),
  'fixed_in_release_name' => 
  array (
    'width' => '15%',
    'label' => 'LBL_FIXED_IN_RELEASE',
    'name' => 'fixed_in_release_name',
    'default' => false,
  ),
  'source' => 
  array (
    'width' => '15%',
    'label' => 'LBL_SOURCE',
    'name' => 'source',
    'default' => false,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => false,
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
);
