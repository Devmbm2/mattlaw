<?php
class CustomEmailSync {
    public function syncNow() {
        global $sugar_config, $audit_details, $db;
    
            require_once('modules/InboundEmail/backup/InboundEmail.php');
    
            $GLOBALS['log']->info('Email Linking Script Started');
            $InboundEmailBean     = BeanFactory::getBean('InboundEmail');
            // print_r($InboundEmailBean);die();
            $InboundEmailBeanList = $InboundEmailBean->get_full_list("", "inbound_email.status='Active' AND inbound_email.inbound_sync = 1");
    
            foreach ($InboundEmailBeanList as $InboundEmail) {
                $folders = array();
    
                $content = unserialize(base64_decode($InboundEmail->stored_options));
                $folders[]=$InboundEmail->mailbox;
                    
                // if (isset($content['mailbox']) && !empty($content['mailbox']) && $content['mailbox'] != "") {
                //     $folders[] = $content['mailbox'];
                // }
                // if (isset($content['sentFolder']) && !empty($content['sentFolder']) && $content['sentFolder'] != "") {
                //     $folders[] = $content['sentFolder'];
                // }
                // print_r($folders);die();
                //$GLOBALS['log']->fatal(print_r($content, true));
                $GLOBALS['audit_details'][$InboundEmail->id]['count'] = 0;
                foreach ($folders as $folder) {
    
                    $InboundEmail->email_password = blowfishDecode(blowfishGetKey('InboundEmail'), $InboundEmail->email_password);
                    $InboundEmail->mailbox        = $folder;
    
                    if ($InboundEmail->connectMailserver()) {
                        $GLOBALS['log']->fatal(['bbtest it ' , $InboundEmail->email_user , $InboundEmail->mailbox]);
                        $usersEmail = (isset($content['reply_to_addr']) && !empty($content['reply_to_addr'])) ? $content['reply_to_addr'] : $InboundEmail->email_user;
                        $user       = new User();
                        $email_user = $user->retrieve_by_email_address($usersEmail);
                        $this->importEmailsByFolder($InboundEmail, $email_user, $InboundEmail->latestUid);
                    } else {
                        $GLOBALS['log']->fatal("Can't Connect To Inbound MailServer");
                    }
                }
                $guid       = create_guid();
                $msgs_count = $GLOBALS['audit_details'][$InboundEmail->id]['count'];
                if ($msgs_count > 0) {
                    $mailbox_id = $InboundEmail->id;
                    $msgs_ids   = "^" . implode("^,^", $GLOBALS['audit_details'][$InboundEmail->id]['msg_id']) . "^";
                    $insert_sql = "INSERT INTO email_archive_audit(id, date_modified, deleted, mailbox_id, msgs_count, msgs_ids)
                                VALUES ('" . $guid . "', UTC_TIMESTAMP(), 0, '" . $mailbox_id . "', '" . $msgs_count . "', '" . $msgs_ids . "')";
                    $db->query($insert_sql);
                } else if ($msgs_count == 0) {
                    $mailbox_id = $InboundEmail->id;
                    $insert_sql = "INSERT INTO email_archive_audit(id, date_modified, deleted, mailbox_id, msgs_count, msgs_ids)
                                VALUES ('" . $guid . "', UTC_TIMESTAMP(), 0, '" . $mailbox_id . "', '" . $msgs_count . "', '^^')";
                    $db->query($insert_sql);
                }
                unset($GLOBALS['audit_details']);
            }
            $GLOBALS['log']->fatal('Email Linking Script Ended Successfully');
        }
        public function importEmailsByFolder(&$InboundEmail, $assigned_user, $latestUid) {
           
            $initialDate  = $GLOBALS['sugar_config']['emailSync']['emailProcessStartDate'];
            $unserialized = unserialize(base64_decode($latestUid));
            $syncID       = (isset($unserialized[$InboundEmail->mailbox]) && $unserialized[$InboundEmail->mailbox] != "") ? $unserialized[$InboundEmail->mailbox] : 0;
            $allUIDs      = imap_search($InboundEmail->conn, 'ALL', SE_UID);
            $GLOBALS['log']->info("Total:" . $InboundEmail->email_user . "'s (" . $InboundEmail->mailbox . "): " . count($allUIDs));
            // if ($syncID != 0) {
            //     $split   = array_search($syncID, $allUIDs);
            //     $allUIDs = array_slice($allUIDs, $split + 1);
            // }
            $mainCount = $GLOBALS['sugar_config']['emailSync']['countForEachRun'];
            $lastUid   = 0;
    // $i=0;
            $GLOBALS['log']->info("Remaining:" . $InboundEmail->email_user . "'s (" . $InboundEmail->mailbox . "): " . count($allUIDs));
            //$GLOBALS['log']->fatal(['latestuid' , $allUIDs]);
            $GLOBALS['log']->fatal(['mainCount' , $mainCount]);
            foreach ($allUIDs as $uid) {
                
                if ($mainCount == 0) {
                    break;
                }
    //             if($i==4){
        $GLOBALS['log']->fatal(['uid' , $uid]);
    //             }
    // $i++;
                $msgNo        = $InboundEmail->getImap()->getMessageNo((int) $uid);
          
                $fullHeader   = $InboundEmail->getImap()->fetchHeader($msgNo);
                $header       = $InboundEmail->getImap()->rfc822ParseHeaders($fullHeader);
                $fromaddr     = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                $GLOBALS['log']->fatal(['fromaddr' , $fromaddr]);
                // print_r($fromaddr);die();
                $toaddress    = $header->to[0]->mailbox . "@" . $header->to[0]->host;
                $date_entered = "";

                if (isset($header->date) && !empty($header->date) && $header->date != "") {
                    try {
                        $givenDate = new DateTime($header->date);
    
                    }
                    catch (Exception $e) {
                        $lastUid = $uid;
                        $mainCount--;
                        $GLOBALS['log']->info("DateParseIssue: " . $e->getMessage());
                        continue;
                    }
    
                    // print_r(isset($initialDate) && $initialDate != "" && $givenDate->format("Y-m-d") < $initialDate);die();
                    if (isset($initialDate) && $initialDate != "" && $givenDate->format("Y-m-d") < $initialDate) {
                        $lastUid = $uid;
                        $mainCount--;
                        $GLOBALS['log']->info("SkipEmail: " . $initialDate . " > " . $givenDate->format("Y-m-d"));
                        continue;
                    }
                    $date_entered = $givenDate->format("Y-m-d H:i:s");
                }
    
                if (preg_match('/Sent/i', $InboundEmail->mailbox) || preg_match('/Outbox/i', $InboundEmail->mailbox)) {
                    $shouldLink = $this->shouldLinkTo($toaddress);
                } else if (preg_match('/Inbox/i', $InboundEmail->mailbox)) {
                    // $fromaddr='devmbm2@gmail.com';
                    // print_r($fromaddr);die();
                    //output : googlecommunityteam-noreply@google.com
                    $shouldLink = $this->shouldLinkTo($fromaddr);
                    $GLOBALS['log']->fatal(['shouldLink',$shouldLink]);
    
                }
                //isset($shouldLink[0]['id']) && $shouldLink[0]['id'] != ""
                //output :1
    
                if (isset($shouldLink[0]['id']) && $shouldLink[0]['id'] != "") {
                    $GLOBALS['log']->info("Linking Email, User: " . $InboundEmail->email_user . " Target: " . $shouldLink[0]['email_address']);
                    $email_id = $this->returnImportedEmail($InboundEmail, $msgNo, $uid, false, true, false, $date_entered, $shouldLink[0], 1, $shouldLink);
    
                }
                $lastUid = $uid;
                $mainCount--;
            }
            if ($lastUid != 0) {
                $unserialized[$InboundEmail->mailbox] = $lastUid;
                $dbValue                              = base64_encode(serialize($unserialized));
                $InboundEmail->latestUid              = $dbValue;
                $GLOBALS['db']->query("UPDATE inbound_email SET latestUid = '" . $dbValue . "' WHERE id = '" . $InboundEmail->id . "'");
            }
        }
        public function divideBodyToParts($messageParts, $flattenedParts = array(), $prefix = '', $index = 1, $fullPrefix = true) {
            foreach ($messageParts as $part) {
                $flattenedParts[$prefix . $index] = $part;
                if (isset($part->parts)) {
                    if ($part->type == 2) {
                        $flattenedParts = $this->divideBodyToParts($part->parts, $flattenedParts, $prefix . $index . '.', 0, false);
                    } elseif ($fullPrefix) {
                        $flattenedParts = $this->divideBodyToParts($part->parts, $flattenedParts, $prefix . $index . '.');
                    } else {
                        $flattenedParts = $this->divideBodyToParts($part->parts, $flattenedParts, $prefix);
                    }
                    unset($flattenedParts[$prefix . $index]->parts);
                }
                $index++;
            }
            return $flattenedParts;
        }
        public function getBodyDetailsByPart($connection, $messageNumber, $partNumber, $encoding) {
            $data = imap_fetchbody($connection, $messageNumber, $partNumber);
            switch ($encoding) {
                case 0:
                    return $data;
                case 1:
                    return $data;
                case 2:
                    return $data;
                case 3:
                    return base64_decode($data);
                case 4:
                    return quoted_printable_decode($data);
                case 5:
                    return $data;
            }
            $GLOBALS['log']->fatal('out of func');
        }
              
        public function returnImportedEmail($InboundEmail, $msgNo, $uid, $forDisplay = false, $clean_email = true, $isGroupFolderExists = false, $date_entered, $parent, $related_user_id, $all_parents) {
            $GLOBALS['log']->fatal('in the func');
            require_once('modules/Emails/Email.php');
            global $timedate;
            global $current_user;
            if (empty($msgNo) and !empty($uid)) {
                $msgNo = $InboundEmail->getImap()->getMessageNo((int) $uid);
            }
            $emailOverView              = $InboundEmail->getImap()->fetchOverview($msgNo);
            $GLOBALS['log']->fatal(['emailOverView' , $emailOverView]);
            $fullHeader                 = $InboundEmail->getImap()->fetchHeader($msgNo);
            $header                     = $InboundEmail->getImap()->rfc822ParseHeaders($fullHeader);
            $message_id                 = isset($header->message_id) ? $header->message_id : '';
            $InboundEmail->inlineImages = array();
            $dupeCheckResult            = $InboundEmail->importDupeCheck($message_id, $header, $fullHeader);
            $query                      = "SELECT count(emails.id) AS total FROM emails WHERE emails.message_id = '" . $message_id . "' and emails.deleted = 0";
            $results                    = $GLOBALS['db']->query($query, true);
            $row                        = $GLOBALS['db']->fetchByAssoc($results);
            // print_r($dupeCheckResult);die();
            if ($row['total'] > 0) {
                $GLOBALS['log']->debug('Email Linking Scheduler Found A Duplicate Email With ID (' . $message_id . ')');
                return true;
            }
    
            if ($forDisplay || $dupeCheckResult) {
                $structure          = $InboundEmail->getImap()->fetchStructure($msgNo);
                // print_r($structure);die();
                $email              = new Email();
    
                $email->isDuplicate = $dupeCheckResult ? false : true;
                $email->mailbox_id  = $InboundEmail->id;
                $email->uid         = $uid;
                $email->msgNo       = $msgNo;
                $email->id          = create_guid();
                $email->new_with_id = true;
                if (empty($current_user)) {
                    $current_user = new User();
                    $current_user->getSystemUser();
                }
                $current_user->getUserDateTimePreferences();
    
                if (!empty($header->date)) {
                    $unixHeaderDate = $timedate->fromString($header->date);
                }
                // $structure->type=0;
                // print_r($structure->type);die();
                // print_r($structure->type);die();
                if ($structure->type == 1 && !empty($structure->parts)) {
                    $GLOBALS['log']->info('InboundEmail found multipart email - saving attachments if found.');
                    // print_r($structure->parts);die();
                    $InboundEmail->saveAttachments($msgNo, $structure->parts, $email->id, 0, $forDisplay);
                } elseif ($structure->type == 0) {
    
                    $UUEncodedEmail = $InboundEmail->isUuencode($email->description) ? true : false;
                    //nichy if may say may $UUEncodedEmail likhe tha mane remove
                    //kr k true kr dia
                    if ($UUEncodedEmail) {
                        $email->description = $InboundEmail->handleUUEncodedEmailBody($email->description, $email->id);
                        $email->retrieve($email->id);
                        $email->save();
                    }
                } else {
                    if ($InboundEmail->port != 110) {
                        $GLOBALS['log']->info('InboundEmail found a multi-part email (id:' . $msgNo . ') with no child parts to parse.');
                    }
                }
    
                $email->name = $InboundEmail->handleMimeHeaderDecode($header->subject);
    
                if (!empty($unixHeaderDate)) {
                    $email->date_sent_received = $timedate->asUser($unixHeaderDate);
                    list($email->date_start, $email->time_start) = $timedate->split_date_time($email->date_sent_received);
                } else {
                    $email->date_start = $email->time_start = $email->date_sent_received = "";
                }
                if (preg_match('/Sent/i', $InboundEmail->mailbox) || preg_match('/Outbox/i', $InboundEmail->mailbox)) {
                    $email->type = 'inbound';
                    if (isset($emailOverView[0]) && isset($emailOverView[0]->seen) && $emailOverView[0]->seen) {
                        $email->status = 'read';
                    } else {
                        $email->status = 'unread';
                    }
                } else if (preg_match('/Inbox/i', $InboundEmail->mailbox)) {
                    $email->type   = 'out';
                    $email->status = 'sent';
                }
                if (!empty($header->toaddress)) {
                    $email->to_name        = $InboundEmail->handleMimeHeaderDecode($header->toaddress);
                    $email->to_addrs_names = $email->to_name;
                }
                if (!empty($header->to)) {
                    $email->to_addrs = $InboundEmail->convertImapToSugarEmailAddress($header->to);
                }
                // $header->fromaddress='devmbm2@gmail.com';
                // $header->from='devmbm2@gmail.com';
                $email->from_name      = $InboundEmail->handleMimeHeaderDecode($header->fromaddress);
                $email->from_addr_name = $email->from_name;
                $email->from_addr      = $InboundEmail->convertImapToSugarEmailAddress($header->from);
                // print_r($header->from);die();
                // isValidEmailAddress($header->fromaddress);
    
                if (!empty($header->cc)) {
                    $email->cc_addrs = $InboundEmail->convertImapToSugarEmailAddress($header->cc);
                }
                if (!empty($header->ccaddress)) {
                    $email->cc_addrs_names = $InboundEmail->handleMimeHeaderDecode($header->ccaddress);
                }
                $email->reply_to_name  = $InboundEmail->handleMimeHeaderDecode($header->reply_toaddress);
                $email->reply_to_email = $InboundEmail->convertImapToSugarEmailAddress($header->reply_to);
                if (!empty($email->reply_to_email)) {
                    $email->reply_to_addr = $email->reply_to_name;
                }
                $email->intent     = $InboundEmail->mailbox_type;
                $email->message_id = $InboundEmail->compoundMessageId;
    
                $oldPrefix         = $InboundEmail->imagePrefix;
                if (!$forDisplay) {
                    $InboundEmail->imagePrefix = 'cid:';
                }
                if (isset($structure->parts)) {
                    $html_text      = "";
                    $flattenedParts = $this->divideBodyToParts($structure->parts);
                    foreach ($flattenedParts as $partNo => $part) {
                        if (isset($part->ifdisposition) && $part->ifdisposition == 0) {
                            $html_text = $this->getBodyDetailsByPart($InboundEmail->conn, $msgNo, $partNo, $part->encoding);
                        }
                    }
                    $email->description_html = $html_text;
                    $email->description      = $html_text;
                } else {
                    $email->description_html = $InboundEmail->getMessageTextWithUid($uid, 'HTML', $structure, $fullHeader, $clean_email);
                    $email->description      = $InboundEmail->getMessageTextWithUid($uid, 'PLAIN', $structure, $fullHeader, $clean_email);
                }
                // print_r($email);die();
                $InboundEmail->imagePrefix = $oldPrefix;
                if (empty($email->description)) {
                    $GLOBALS['log']->info('InboundEmail Message (id:' . $email->message_id . ') has no body');
                }
                if ($date_entered != "") {
                    $email->date_entered  = $date_entered;
                    $email->date_modified = $date_entered;
                }
                if (!empty($related_user_id)) {
                    $email->assigned_user_id = $related_user_id;
                }
                if (!empty($parent['parent_id']) && !empty($parent['parent_type'])) {
                    $email->parent_id   = $parent['parent_id'];
                    $email->parent_type = $parent['parent_type'];
                    $mod                = strtolower($email->parent_type);
                    $rel                = array_key_exists($mod, $email->field_defs) ? $mod : $mod . '_activities_emails';
                    if (!$email->load_relationship($rel)) {
                        return false;
                    }
                    $email->$rel->add($email->parent_id);
                }
                if ($forDisplay && $InboundEmail->isAutoImport()) {
                    $forDisplay = false;
                }
                if (!$forDisplay) {
                    $email->save();
                    $email->new_with_id = false;
                    $InboundEmail->handleMailboxType($email, $header);
                    if (!empty($email->reply_to_email)) {
                        $contactAddress = $email->reply_to_email;
                        isValidEmailAddress($contactAddress);
                    } else {
                        $contactAddress = $email->from_addr;
                        isValidEmailAddress($contactAddress);
                    }
                    if (!$InboundEmail->isMailBoxTypeCreateCase()) {
                        $InboundEmail->handleAutoresponse($email, $contactAddress);
                    }
                }
                $InboundEmail->db->query('UPDATE emails SET date_entered = "' . $date_entered . '", date_modified = "' . $date_entered . '"  WHERE id = "' . $email->id . '"');
            } else {
                if ($InboundEmail->protocol != 'pop3') {
                    $GLOBALS['log']->info('InboundEmail found a duplicate email: ' . $message_id);
                }
                if (!empty($InboundEmail->compoundMessageId)) {
                    $result = $InboundEmail->db->query('SELECT id, date_entered, date_modified from emails WHERE message_id ="' . $InboundEmail->compoundMessageId . '"' . 'AND mailbox_id = "' . $InboundEmail->id . '"');
                    $row    = $InboundEmail->db->fetchRow($result);
                    if (!empty($row['id'])) {
                        if ($date_entered != "" && ($date_entered != $row['date_entered'] || $date_entered != $row['date_modified'])) {
                            $InboundEmail->db->query('UPDATE emails SET date_entered = "' . $date_entered . '", date_modified = "' . $date_entered . '"  WHERE id = "' . $row['id'] . '"');
                        }
                        if (count($all_parents) > 1) {
                            $this->checkAndUpdateRelations($row['id'], $all_parents);
                        }
                        $this->createUpdateAssignedUser($row['id'], $all_parents, $related_user_id);
                        return $row['id'];
                    }
                }
                return false;
            }
            if (!$forDisplay) {
                if (!$isGroupFolderExists) {
                    $r = $InboundEmail->getImap()->setFlagFull($msgNo, '\\SEEN');
                } else {
                    $r = $InboundEmail->getImap()->clearFlagFull($msgNo, '\\SEEN');
                }
                if ($InboundEmail->delete_seen == 1 && !$forDisplay) {
                    $GLOBALS['log']->info("INBOUNDEMAIL: delete_seen == 1 - deleting email");
                    $InboundEmail->getImap()->setFlagFull($msgNo, '\\DELETED');
                }
            }
            $InboundEmail->email = $email;
            if (empty($InboundEmail->email->et)) {
                $InboundEmail->email->email2init();
            }
            if (isset($email->id) and !empty($email->id)) {
                if (count($all_parents) > 1) {
                    $this->checkAndUpdateRelations($email->id, $all_parents);
                }
                $this->createUpdateAssignedUser($email->id, $all_parents, $related_user_id);
                $GLOBALS['audit_details'][$InboundEmail->id]['count']    = $GLOBALS['audit_details'][$InboundEmail->id]['count'] + 1;
                $GLOBALS['audit_details'][$InboundEmail->id]['msg_id'][] = $email->id;
                return $email->id;
            }
            return true;
        }
        public function shouldLinkTo($email) {
    
            global $db, $sugar_config;
            $data           = array();
            $email          = str_replace("'", "", $email);
            $email          = str_replace('"', "", $email);
            $allowedModules = "('" . implode("','", $sugar_config['emailSync']['AllowedModules']) . "')";
            //nichy wali query may mane from address static likha ha pahle waha par $email
            //likha howa tha
            $query          = "SELECT email_addresses.id, email_addr_bean_rel.bean_id AS parent_id, email_addr_bean_rel.bean_module AS parent_type, email_addresses.email_address  FROM email_addresses INNER JOIN email_addr_bean_rel ON email_addr_bean_rel.email_address_id = email_addresses.id WHERE email_addresses.deleted = 0 AND email_addr_bean_rel.deleted = 0 AND email_address = '" . 'devmbm2@gmail.com' . "' AND email_addr_bean_rel.bean_module IN " . $allowedModules . " ORDER BY email_addr_bean_rel.bean_module ASC";
            $result         = $db->query($query);
    
            if ($result->num_rows > 0) {
                while ($row = $db->fetchByAssoc($result)) {
    
                    if ($this->recordExists($row['parent_id'], $row['parent_type'])) {
                        $data[] = $row;
                    }
                }
                // print_r($data);die();
                return $data;
            }
            return array();
        }
        public function checkAndUpdateRelations($email_id, $parents) {
            global $db;
            foreach ($parents as $parent) {
                $email = $this->checkIfExists($email_id, $parent['parent_id'], $parent['parent_type']);
                if ($email == "" || empty($email)) {
                    $guid = create_guid();
                    $sql  = "INSERT INTO emails_beans(id, email_id, bean_id, bean_module, campaign_data, date_modified, deleted) VALUES ('" . $guid . "', '" . $email_id . "', '" . $parent['parent_id'] . "', '" . $parent['parent_type'] . "', '', UTC_TIMESTAMP(), 0)";
                    $db->query($sql);
                }
            }
        }
        public function checkIfExists($email_id, $bean_id, $bean_module) {
            global $db;
            $query  = "SELECT id FROM emails_beans WHERE emails_beans.bean_id = '" . $bean_id . "' AND emails_beans.bean_module = '" . $bean_module . "' AND emails_beans.email_id = '" . $email_id . "' AND emails_beans.deleted = 0 ";
            $result = $db->query($query);
            if ($result->num_rows > 0) {
                $row = $db->fetchByAssoc($result);
                return $row['id'];
            }
            return "";
        }
        public function recordExists($bean_id, $bean_module) {
            global $db;
            $query  = " SELECT id FROM " . strtolower($bean_module) . " WHERE id = '" . $bean_id . "' AND deleted = 0 ";
            $result = $db->query($query);
            if ($result->num_rows == 0) {
                return false;
            }
            return true;
        }
        public function createUpdateAssignedUser($email_id, $parents, $related_user_id) {
            global $db;
            $db->query("UPDATE emails SET assigned_user_id = '" . $related_user_id . "' WHERE id = '" . $email_id . "'");
            return true;
        }
    }
