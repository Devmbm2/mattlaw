<?php
// created: 2018-08-17 15:36:21
$dictionary["mdoc_medb_doc_mreq_medb_requests"] = array (
  'true_relationship_type' => 'one-to-one',
  'relationships' => 
  array (
    'mdoc_medb_doc_mreq_medb_requests' => 
    array (
      'lhs_module' => 'MDOC_Incoming_Bills',
      'lhs_table' => 'mdoc_incoming_bills',
      'lhs_key' => 'id',
      'rhs_module' => 'MREQ_MEDB_Requests',
      'rhs_table' => 'mreq_medb_requests',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'mdoc_medb_doc_mreq_medb_requests_c',
      'join_key_lhs' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
      'join_key_rhs' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
    ),
  ),
  'table' => 'mdoc_medb_doc_mreq_medb_requests_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'mdoc_medb_doc_mreq_medb_requestsspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'mdoc_medb_doc_mreq_medb_requests_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mdoc_medb_doc_mreq_medb_requestsmdoc_incoming_bills_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'mdoc_medb_doc_mreq_medb_requests_idb2',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'mdoc_medb_doc_mreq_medb_requestsmreq_medb_requests_idb',
      ),
    ),
  ),
);