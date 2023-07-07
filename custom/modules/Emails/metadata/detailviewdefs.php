<?php
$module_name = 'Emails';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
         // 1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',

          array(
            'customCode' => '<input type=button onclick="openQuickCreateModal(\'PLEA_Pleadings\',\'&name={$bean->name}\',\'{$bean->from_addr_name}\');" value="{$MOD.LBL_CREATE} {$APP.LBL_EMAIL_QC_PLEA_PLEADINGS}">'
                . '<input type="hidden" id="parentEmailId" name="parentEmailId" value="{$bean->id}">'
        ),
          /*4 => 
          array (
            'customCode' => '<input type=button onclick="window.location.href=\'index.php?module=Emails&action=ReplyTo&return_module=Emails&return_action=index&folder=INBOX.TestInbox&folder=inbound&inbound_email_record={$bean->inbound_email_record}&uid={$bean->uid}&msgno={$bean->msgno}&record={$bean->id}\';" value="{$MOD.LBL_BUTTON_REPLY_TITLE}">',
          ),
          5 => 
          array (
            'customCode' => '<input type=button onclick="window.location.href=\'index.php?module=Emails&action=ReplyToAll&return_module=Emails&return_action=index&folder=INBOX.TestInbox&folder=inbound&inbound_email_record={$bean->inbound_email_record}&uid={$bean->uid}&msgno={$bean->msgno}&record={$bean->id}\';" value="{$MOD.LBL_BUTTON_REPLY_ALL}">',
          ),
          6 => 
          array (
            'customCode' => '<input type=button onclick="window.location.href=\'index.php?module=Emails&action=Forward&return_module=Emails&return_action=index&folder=INBOX.TestInbox&folder=inbound&inbound_email_record={$bean->inbound_email_record}&uid={$bean->uid}&msgno={$bean->msgno}&record={$bean->id}\';" value="{$MOD.LBL_BUTTON_FORWARD}">',
          ),*/



        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Emails/include/DetailView/quickCreateModal.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_EMAIL_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'LBL_EMAIL_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'from_addr_name',
            'label' => 'LBL_FROM',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'to_addrs_names',
            'label' => 'LBL_TO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'cc_addrs_names',
            'label' => 'LBL_CC',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'bcc_addrs_names',
            'label' => 'LBL_BCC',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_SUBJECT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'description_html',
            'label' => 'LBL_BODY',
          ),
        ),
        6 => 
        array (
          0 => 'parent_name',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'label' => 'LBL_DATE_ENTERED',
          ),
        ),
      ),
    ),
  ),
);
