<?php

$dictionary['Contact']['fields']['fbsg_accounts'] = array (
    'name' => 'fbsg_accounts',
    'type' => 'link',
    'relationship' => 'accounts_contacts',
    'link_type' => 'one',
    'source' => 'non-db',
    'vname' => 'LBL_FBSG_ACCOUNTS',
    'duplicate_merge' => 'disabled',
);