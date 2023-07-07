<?php
// created: 2017-10-26 12:38:34
$dictionary["dha_plantillasdocumentos_tasks_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'dha_plantillasdocumentos_tasks_1' => 
    array (
      'lhs_module' => 'DHA_PlantillasDocumentos',
      'lhs_table' => 'dha_plantillasdocumentos',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'dha_plantillasdocumentos_tasks_1_c',
      'join_key_lhs' => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
      'join_key_rhs' => 'dha_plantillasdocumentos_tasks_1tasks_idb',
    ),
  ),
  'table' => 'dha_plantillasdocumentos_tasks_1_c',
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
      'name' => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'dha_plantillasdocumentos_tasks_1tasks_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'dha_plantillasdocumentos_tasks_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'dha_plantillasdocumentos_tasks_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dha_plantillasdocumentos_tasks_1dha_plantillasdocumentos_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'dha_plantillasdocumentos_tasks_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'dha_plantillasdocumentos_tasks_1tasks_idb',
      ),
    ),
  ),
);