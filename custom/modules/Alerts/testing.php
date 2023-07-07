<?php 

					require_once 'vendor/autoload.php';
					use Smalot\PdfParser\Parser;

					$parser = new Parser();
					$pdf = $parser->parseFile('upload/1.pdf');
					$pages = $pdf->getPages();
						$text=""; 
					foreach ($pages as $pageNumber => $page) {
						$text .= $page->getText();	
					}

					if (strpos(strtolower($text), "case no:") !== false || strpos(strtolower($text), "defendant") !== false) {
						echo 'Attachment saved: ' . $value . '<br>';
						$documentBean = BeanFactory::newBean('Documents');
						$documentBean->document_name = $value;
						$documentBean->description = 'Attachment from Gmail';
						$documentBean->doc_url = $filePath;
						$documentBean->email_documents = 1;
						$documentBean->hard_or_soft_doc = 'Soft_Documents';
						$documentBean->save();
						$document_id = $documentBean->id;
					} else {
						echo "The text does not contain both 'case no:' and 'defendant'.<br>";
					}
