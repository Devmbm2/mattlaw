
<?php

use PhpParser\Node\Stmt\Echo_;

global $sugar_config, $audit_details, $db;
require_once('modules/InboundEmail/InboundEmail.php');
if (! function_exists('imap_open')) {
	echo "IMAP is not configured.";
	exit();
} else {
	
	$InboundEmailBean     = BeanFactory::getBean('InboundEmail');
	$InboundEmailBeanList = $InboundEmailBean->get_full_list("", "inbound_email.status='Active' ");
	foreach ($InboundEmailBeanList as $InboundEmail) {
		   $email_password = blowfishDecode(blowfishGetKey('InboundEmail'), $InboundEmail->email_password);
				   $user_email=$InboundEmail->email_user;    
			$imap_conn = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $user_email, $email_password) or die('Cannot connect to Gmail: ' . imap_last_error());
						
			print_r($imap_conn); 

			$data_yesterday = date ( "d M Y", strToTime ( "-4 days" ) );
			$inbox = imap_search($imap_conn, 'BODY "test" ');
		    echo "<pre>";	print_r($inbox); echo "</pre>"; 
			if (! empty($inbox)) {
				foreach ($inbox as $email) {

					$overview = imap_fetch_overview($imap_conn, $email, 0); echo "<br>";
					$message = imap_fetchbody($imap_conn, $email, '2'); echo "<br>";
					$date = date($overview[0]->date);
					echo  $overview[0]->from; echo "<br>";
					echo $overview[0]->subject;  echo "<br>";
 					echo $message; echo "<br>";
					echo $date; echo "<br>";	
				// $leads_bean  = BeanFactory::newBean('Leads');
		        // $leads_bean->first_name =   $overview[0]->from;  ;
				// $leads_bean->description=   $overview[0]->subject.$message;    
				// $leads_bean->lead_source=   'email'  ;
				// $leads_bean->save();
				$header = imap_headerinfo($imap_conn, $email);
                $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
				echo '<p>Email: ' . $fromaddr . '<p>';
 				
				}
		}
		imap_close($imap_conn); 
	}
	}