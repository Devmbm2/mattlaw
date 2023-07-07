<?php

$dictionary["Call"]["fields"]["caller_account_name"] = array (
  'inline_edit' => '1',
  'rname' => 'name',
  'required' => false,
  'source' => 'non-db',
  'name' => 'caller_account_name',
  'vname' => 'LBL_CALLER_ACCOUNT_NAME',
  'type' => 'relate',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => false,
  'reportable' => true,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '255',
  'size' => '20',
  'id_name' => 'caller_account_id',
  'ext2' => 'Accounts',
  'module' => 'Accounts',
  'quicksearch' => 'enabled',
  'studio' => 'visible',
);

$dictionary["Call"]["fields"]['caller_account_id'] = array (
  'inline_edit' => 1,
  'required' => false,
  'name' => 'caller_account_id',
  'vname' => 'LBL_CALLER_ACCOUNT_ID',
  'type' => 'id',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => false,
  'reportable' => false,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '36',
  'size' => '20',
);