<?php
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
$job_strings[] = 'dailyEmailArchiveReport';
function dailyEmailArchiveReport() {
        global $db;
        $data   = array();
        $send   = false;
        $query  = "SELECT email_archive_audit.id, inbound_email.id AS mailbox_id, inbound_email.email_user, inbound_email.stored_options, DATE(email_archive_audit.date_modified) AS DateToday, msgs_count, msgs_ids
                FROM email_archive_audit
                INNER JOIN inbound_email ON inbound_email.id = email_archive_audit.mailbox_id AND inbound_email.deleted = 0
                WHERE DATE(email_archive_audit.date_modified) = DATE(UTC_TIMESTAMP()) AND email_archive_audit.deleted = 0";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            while ($row = $db->fetchByAssoc($result)) {
                $data[$row['mailbox_id']][] = $row;
            }
            $table_html = "<table style='width:100%' border='1' cellspacing='0'>
            <tr>
                <th style='text-align:left'>Inbound Email</th>
                <th style='text-align:left'>No. Of Mails Synced</th>
            </tr>";
            foreach ($data as $key => $audit_infos) {
                $send       = true;
                $totalCount = 0;
                $emailId    = "";
                foreach ($audit_infos as $sub_key => $audit_info) {
                    $content    = unserialize(base64_decode($audit_info['stored_options']));
                    $totalCount = $totalCount + $audit_info['msgs_count'];
                    $emailId    = (isset($content['from_addr'])) ? $content['from_addr'] : $audit_info['email_user'];
                    $DateToday  = $audit_info['DateToday'];
                }
                $table_html .= "
                <tr>
                    <td style='text-align:left'>" . $emailId . "</td>
                    <td style='text-align:left'>" . $totalCount . "</td>
                </tr>";
            }
            $table_html .= "</table>";
            sendDailyEmailArchiveReport($DateToday, $table_html);
        }
    return TRUE;
}
function sendDailyEmailArchiveReport($DateToday, $table_html) {
    include_once('include/SugarPHPMailer.php');
    $template = new EmailTemplate();
    $template->retrieve('email_for_archive_report');
    $mail           = new SugarPHPMailer();
    $emailObj       = new Email();
    $defaults       = $emailObj->getSystemDefaultEmail();
    $mail->From     = $defaults['email'];
    $mail->FromName = $defaults['name'];
    $mail->ClearAllRecipients();
    $mail->ClearReplyTos();
    $listOfEmails = explode(",", $GLOBALS['sugar_config']['emailSync']['emailForArchiveReport']);
    foreach ($listOfEmails as $email_address) {
        $mail->AddAddress($email_address);
    }
    $mail->Subject       = $template->subject;
    $mail->Body_html     = $template->body_html;
    $template->body_html = str_replace('$DateToday', $DateToday, $template->body_html);
    $template->body_html = str_replace('$table_html', $table_html, $template->body_html);
    $mail->Body          = wordwrap($template->body_html, 900);
    $mail->isHTML(true);
    $mail->prepForOutbound();
    $mail->setMailerForSystem();
    if (!$mail->Send()) {
        $GLOBALS['log']->fatal("ERROR: DailyEmailArchiveReport Mail Sending Failed!");
    }
    return TRUE;
}