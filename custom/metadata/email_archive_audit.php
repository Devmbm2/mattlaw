<?php
$dictionary["email_archive_audit"] = array(
    'table' => 'email_archive_audit',
    'fields' => array(
        0 => array(
            'name' => 'id',
            'type' => 'varchar',
            'len' => 36
        ),
        1 => array(
            'name' => 'date_modified',
            'type' => 'datetime'
        ),
        2 => array(
            'name' => 'deleted',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => true
        ),
        3 => array(
            'name' => 'mailbox_id',
            'type' => 'varchar',
            'len' => 36
        ),
        4 => array(
            'name' => 'msgs_count',
            'type' => 'int',
            'default' => '0',
            'len' => 11
        ),
        5 => array(
            'name' => 'msgs_ids',
            'type' => 'text'
        )
    ),
    'indices' => array(
        0 => array(
            'name' => 'email_archive_auditspk',
            'type' => 'primary',
            'fields' => array(
                0 => 'id'
            )
        ),
        1 => array(
            'name' => 'email_archive_audit_ida1',
            'type' => 'index',
            'fields' => array(
                0 => 'mailbox_id'
            )
        ),
        2 => array(
            'name' => 'email_archive_audit_ida2',
            'type' => 'index',
            'fields' => array(
                0 => 'mailbox_id',
                1 => 'msgs_count'
            )
        )
    )
);