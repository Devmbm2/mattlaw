<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/Emails/Email.php');
class ht_Email extends Email
{
    /**
     * Sends Email
     * @global array $mod_strings
     * @global array $app_strings
     * @global User $current_user
     * @global array $sugar_config
     * @global Localization $locale
     * @param SugarPHPMailer $mail
     * @param NonGmailSentFolderHandler $nonGmailSentFolder
     * @return boolean True on success
     */
    public function send(
        SugarPHPMailer $mail = null,
        NonGmailSentFolderHandler $nonGmailSentFolder = null,
        InboundEmail $ie = null,
        Email $tempEmail = null,
        $check_notify = false,
        $options = "\\Seen"
    ) {
        global $mod_strings, $app_strings;
        global $current_user;
        global $sugar_config;
        global $locale;

        $this->clearTempEmailAtSend();

        $OBCharset = $locale->getPrecedentPreference('default_email_charset');
        $mail = $mail ? $mail : new SugarPHPMailer();

        if (!$this->to_addrs_arr) {
            LoggerManager::getLogger()->error('"To" address(es) is not set or empty to sending email.');
            return false; // return false as error, to-address is required to sending an email
        }
        foreach ((array)$this->to_addrs_arr as $addr_arr) {
            if (empty($addr_arr['display'])) {
                if (!isset($addr_arr['email']) || !$addr_arr['email']) {
                    LoggerManager::getLogger()->error('"To" email address is missing!');
                } else {
                    $mail->AddAddress($addr_arr['email'], "");
                }
            } else {
                $mail->AddAddress(
                    $addr_arr['email'],
                    $locale->translateCharsetMIME(trim($addr_arr['display']), 'UTF-8', $OBCharset)
                );
            }
        }

        if (!$this->cc_addrs_arr) {
            LoggerManager::getLogger()->warn('"CC" address(es) is not set or empty to sending email.');
        }
        foreach ((array)$this->cc_addrs_arr as $addr_arr) {
            if (empty($addr_arr['display'])) {
                $mail->AddCC($addr_arr['email'], "");
            } else {
                $mail->AddCC(
                    $addr_arr['email'],
                    $locale->translateCharsetMIME(trim($addr_arr['display']), 'UTF-8', $OBCharset)
                );
            }
        }

        if (!$this->bcc_addrs_arr) {
            LoggerManager::getLogger()->warn('"BCC" address(es) is not set or empty to sending email.');
        }
        foreach ((array)$this->bcc_addrs_arr as $addr_arr) {
            if (empty($addr_arr['display'])) {
                $mail->AddBCC($addr_arr['email'], "");
            } else {
                $mail->AddBCC(
                    $addr_arr['email'],
                    $locale->translateCharsetMIME(trim($addr_arr['display']), 'UTF-8', $OBCharset)
                );
            }
        }

        $ieId = $this->mailbox_id;
        $mail = $this->setMailer($mail, '', $ieId);

        if (($mail->oe->type === 'system') && (!isset($sugar_config['email_allow_send_as_user']) || (!$sugar_config['email_allow_send_as_user']))) {
            $fromAddr = $mail->oe->smtp_from_addr;
            $fromName = $mail->oe->smtp_from_name;

            $mail->From = $fromAddr;
            $sender = $fromAddr;
            $ReplyToAddr = $fromAddr;
            isValidEmailAddress($mail->From);
            $ReplyToName = $fromName;
            $mail->FromName = $fromName;
        } else {

            // FROM ADDRESS
            if (!empty($this->from_addr)) {
                $mail->From = $this->from_addr;
                isValidEmailAddress($mail->From);
            } else {
                $mail->From = $current_user->getPreference('mail_fromaddress');
                isValidEmailAddress($mail->From);
                $this->from_addr = $mail->From;
                isValidEmailAddress($this->from_addr);
            }
            // FROM NAME
            if (!empty($this->from_name)) {
                $mail->FromName = $this->from_name;
            } elseif (!empty($this->from_addr_name)) {
                $mail->FromName = $this->from_addr_name;
            } else {
                $mail->FromName = $current_user->getPreference('mail_fromname');
                $this->from_name = $mail->FromName;
            }

            //Reply to information for case create and autoreply.
            if (!empty($this->reply_to_name)) {
                $ReplyToName = $this->reply_to_name;
            } else {
                $ReplyToName = $mail->FromName;
            }

            $sender = $mail->From;
            isValidEmailAddress($sender);
            if (!empty($this->reply_to_addr)) {
                $ReplyToAddr = $this->reply_to_addr;
            } else {
                $ReplyToAddr = $mail->From;
            }
            isValidEmailAddress($ReplyToAddr);
        }


        $mail->Sender = $sender; /* set Return-Path field in header to reduce spam score in emails sent via Sugar's Email module */
        isValidEmailAddress($mail->Sender);
        $mail->AddReplyTo($ReplyToAddr, $locale->translateCharsetMIME(trim($ReplyToName), 'UTF-8', $OBCharset));

        $mail->Subject = html_entity_decode($this->name, ENT_QUOTES, 'UTF-8');
        //$mail->Subject = $this->name;

        ///////////////////////////////////////////////////////////////////////
        ////    ATTACHMENTS
        if (isset($this->saved_attachments)) {
            foreach ($this->saved_attachments as $note) {
                $mime_type = 'text/plain';
                if ($note->object_name == 'Note') {
                    if (!empty($note->file->temp_file_location) && is_file($note->file->temp_file_location)) { // brandy-new file upload/attachment
                        $file_location = "file/" . $note->file->temp_file_location;
                        $filename = $note->file->original_file_name;
                        $mime_type = $note->file->mime_type;
                    } else { // attachment coming from template/forward
                        $file_location = "upload/{$note->id}";
                        // cn: bug 9723 - documents from EmailTemplates sent with Doc Name, not file name.
                        $filename = !empty($note->filename) ? $note->filename : $note->name;
                        $mime_type = $note->file_mime_type;
                    }
                } elseif ($note->object_name == 'DocumentRevision') { // from Documents
                    $filePathName = $note->id;
                    // cn: bug 9723 - Emails with documents send GUID instead of Doc name
                    $filename = $note->getDocumentRevisionNameForDisplay();
                    $file_location = "upload/$note->id";
                    $mime_type = $note->file_mime_type;
                }

                // strip out the "Email attachment label if exists
                $filename = str_replace($mod_strings['LBL_EMAIL_ATTACHMENT'] . ': ', '', $filename);
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
                //is attachment in our list of bad files extensions?  If so, append .txt to file location
                //check to see if this is a file with extension located in "badext"
                foreach ($sugar_config['upload_badext'] as $badExt) {
                    if (strtolower($file_ext) == strtolower($badExt)) {
                        //if found, then append with .txt to filename and break out of lookup
                        //this will make sure that the file goes out with right extension, but is stored
                        //as a text in db.
                        $file_location = $file_location . ".txt";
                        break; // no need to look for more
                    }
                }
                $mail->AddAttachment(
                    $file_location,
                    $locale->translateCharsetMIME(trim($filename), 'UTF-8', $OBCharset),
                    'base64',
                    $mime_type
                );

                // embedded Images
                if ($note->embed_flag == true) {
                    $cid = $filename;
                    $mail->AddEmbeddedImage($file_location, $cid, $filename, 'base64', $mime_type);
                }
            }
        } else {
            LoggerManager::getLogger()->fatal('Attachements not found');
        }
        ////    END ATTACHMENTS
        ///////////////////////////////////////////////////////////////////////

        $mail = $this->handleBody($mail);

        $GLOBALS['log']->debug('Email sending --------------------- ');

        ///////////////////////////////////////////////////////////////////////
        ////    I18N TRANSLATION
        $mail->prepForOutbound();
        ////    END I18N TRANSLATION
        ///////////////////////////////////////////////////////////////////////

        $validator = new EmailFromValidator();
        if (!$validator->isValid($this)) {

            // if an email is invalid before sending,
            // maybe at this point sould "return false;" because the email having
            // invalid from address and/or name but we will trying to send it..
            // and we should log the problem at least:

            // (needs EmailFromValidation and EmailFromFixer.. everywhere where from name and/or from email address get a value)

            $errors = $validator->getErrorsAsText();
            $details = "Details:\n{$errors['messages']}\ncodes:{$errors['codes']}\n{$mail->ErrorInfo}";
            LoggerManager::getLogger()->error("Invalid email from address or name detected before sending. $details");
        }
        if ($mail->send()) {
            ///////////////////////////////////////////////////////////////////
            ////    INBOUND EMAIL HANDLING
            // mark replied
            $query = "UPDATE
                emails
            SET
                message_id = '".$mail->GetLastMessageID()."'
            WHERE
                id = '".$this->id."'";
            $GLOBALS['db']->query($query, true);
            if (!empty($_REQUEST['inbound_email_id'])) {
                $ieId = $_REQUEST['inbound_email_id'];
                $this->createTempEmailAtSend($tempEmail);
                $this->getTempEmailAtSend()->status = 'replied';
                $ie = $ie ? $ie : BeanFactory::newBean('InboundEmail');
                $nonGmailSentFolder = $nonGmailSentFolder ? $nonGmailSentFolder : new NonGmailSentFolderHandler();
                if (!$ieMailId = $this->getTempEmailAtSend()->saveAndStoreInSentFolderIfNoGmail($ie, $ieId, $mail, $nonGmailSentFolder, $check_notify, $options)) {
                    LoggerManager::getLogger()->debug('IE Mail ID is ' . ($ieMailId === null ? 'null' : $ieMailId) . ' after save and store in non-gmail sent folder.');
                }
                if (!$this->getTempEmailAtSend()->save()) {
                    LoggerManager::getLogger()->warn('Email saving error: after save and store in non-gmail sent folder.');
                }
            }
            $GLOBALS['log']->debug(' --------------------- buh bye -- sent successful');
            ////    END INBOUND EMAIL HANDLING
            ///////////////////////////////////////////////////////////////////
            return true;
        }
        $GLOBALS['log']->debug($app_strings['LBL_EMAIL_ERROR_PREPEND'] . $mail->ErrorInfo);

        return false;
    }
}
