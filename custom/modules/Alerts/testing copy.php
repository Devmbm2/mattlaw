<?php
			
		require_once 'vendor/autoload.php';
		 use Smalot\PdfParser\Parser;
		    $server = '{imap.gmail.com:993/imap/ssl}INBOX';
			$username = 'devmbm2@gmail.com';
			$password = 'rgrmxdqayqkhzeey';
			$connection = imap_open($server, $username, $password);
			if (!$connection) {
			die('Connection failed: ' . imap_last_error());
			}
			$criteria = 'SEEN';
			$messages = imap_search($connection, $criteria);
foreach ($messages as $message) {
			$structure = imap_fetchstructure($connection, $message);
			$parts = $structure->parts;
  foreach ($parts as $part) {
				$parameters = $part->parameters;
         foreach ($parameters as $parameter) {
					$name = $parameter->attribute;
					$value = $parameter->value;
					if ($name == 'NAME' && strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'pdf') {
						$data = imap_fetchbody($connection, $message, 2);
						if ($part->encoding == 3) {
						$data = base64_decode($data);
						} elseif ($part->encoding == 4) {
						$data = quoted_printable_decode($data);
						}
						file_put_contents('upload/' . $value, $data);
					}
	 			 if (strtolower($parameter->attribute) == 'name') {
					$filename = $parameter->value;
					$attachment = imap_fetchbody($mailbox, $email, $partNum + 1);
					$filePath = "upload/" . $filename;
					echo "Attachment saved: " . $filename . "<br>";
					$documentBean = BeanFactory::newBean('Documents');
					$documentBean->document_name = $filename;
					$documentBean->description = "Attachment from Gmail";
					$documentBean->doc_url = $filePath;
					$documentBean->hard_or_soft_doc = 'Soft_Documents';
					$documentBean->save();
					$document_id=$documentBean->id;
						$parser = new Parser();
						$pdf = $parser->parseFile($filePath);
						$pages = $pdf->getPages();
							$text=""; 
						foreach ($pages as $pageNumber => $page) {
							$text .= $page->getText();
								
							
						}
						//echo $text;
						echo "<br>";
					$pattern = '/(\d{2}-[A-Z]{2}-\d{6})/';
					preg_match($pattern, $text, $matches);
					if (isset($matches[1])) {
						$caseNumber = $matches[1];
						echo "Case Number: $caseNumber";
					} else {
						echo "No case number found.";
					}
				$caseNumber = 5;
				$db = DBManagerFactory::getInstance();
				$caseNumber = $db->quote($caseNumber);
				$query = "SELECT id FROM cases WHERE case_number = $caseNumber";
				$result = $db->query($query);
				if ($result) {
					$row = $db->fetchByAssoc($result);
					$caseId = $row['id'];
				   echo "Case ID: " . $caseId;			
			    $documentId = $document_id;
				echo " here is the woringk"; 
				$casesBean= BeanFactory::getBean('Cases' , $caseId);
					print_r($casesBean);
				// $casesBean->load_relationship('documents_cases');
				// $casesID=$casesBean->documents_cases->add($documentBean);
			    //  echo "here runing";
			} else {
				echo "No case found.";
			}

	}

    }
  }
}

// Close the IMAP connection
imap_close($connection);

echo 'Done';
?>
