<?php
require_once 'custom/include/pdf2text.php';
require_once 'custom/include/docReader.php';


global $sugar_config, $db;

$server = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = $sugar_config['email_address'];
$password = $sugar_config['email_password'];
$connection = imap_open($server, $username, $password);
if (!$connection) {
    die('Connection failed: ' . imap_last_error());
}

$messages = imap_search($connection, 'ALL');

if ($messages === false) {
    die('Failed to fetch emails: ' . imap_last_error());
}

foreach ($messages as $message) {
    $structure = imap_fetchstructure($connection, $message);
    $parts = $structure->parts;

    foreach ($parts as $part) {
        $parameters = $part->parameters;

        foreach ($parameters as $parameter) {
            $name = $parameter->attribute;
            $value = $parameter->value;

            if (($name == 'NAME') && (strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'pdf' ||
                strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'doc' ||
                strtolower(pathinfo($value, PATHINFO_EXTENSION)) == 'docx')) {

                $data = imap_fetchbody($connection, $message, 2);

                if ($part->encoding == 3) {
                    $data = base64_decode($data);
                } elseif ($part->encoding == 4) {
                    $data = quoted_printable_decode($data);
                }

                $value = str_replace(' ', '_', $value);
                $value = preg_replace("/[^A-Za-z0-9_.]/", '', $value);
                $filePath = 'upload/' . $value;

                // Check if the file already exists
                if (!file_exists($filePath)) {
                    file_put_contents($filePath, $data);

                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

                    if ($fileExtension === 'pdf') {
                        // Code for PDF file processing
						$text = pdf2text ($filePath);
                    } elseif ($fileExtension === 'docx' || $fileExtension === 'doc') {
                        $docObj = new DocxConversion($filePath);
                        $text = $docObj->convertToText();
                    } else {
                        echo 'Unsupported file format';
                    }

                    $text = strtolower($text);

                    $startPos = strpos($text, '____/') + strlen('____/');
                    $substring = substr($text, $startPos, 100);
                    echo $substring;

                    // Find the type of the pleading
                    $type = "";
                    if (strpos($substring, 'plaintiff') !== false) {
                        $type = "Plaintiff";
                    } elseif (strpos($substring, 'defendant') !== false) {
                        $type = "Defendant";
                    } elseif (strpos($substring, 'court') !== false) {
                        $type = "Court";
                    } else {
                        $type = "Other";
                    }

                    // Finding the subtype for the pleading
                    $subtype = "";
                    if (strpos($substring, 'answer') !== false) {
                        $subtype = "Answer";
                    } elseif (strpos($substring, 'complaint') !== false) {
                        $subtype = "Complaint";
                    } elseif (strpos($substring, 'exhibits') !== false) {
                        $subtype = "Exhibits";
                    } elseif (strpos($substring, 'hearing') !== false) {
                        $subtype = "Hearing_Notice";
                    } elseif (strpos($substring, 'motion') !== false) {
                        $subtype = "Motion";
                    } elseif (strpos($substring, 'notice of') !== false) {
                        $subtype = "Notice";
                    } elseif (strpos($substring, 'request') !== false) {
                        $subtype = "Subpoenas_Service";
                    } elseif (strpos($substring, 'stipulation') !== false) {
                        $subtype = "Stipulation";
                    } elseif (strpos($substring, 'subpoena') !== false) {
                        $subtype = "Subpoena";
                    } elseif (strpos($substring, 'stipulation') !== false) {
                        $subtype = "Stipulation";
                    } elseif (strpos($substring, 'sum') !== false) {
                        $subtype = "sum";
                    } elseif (strpos($substring, 'verdict') !== false) {
                        $subtype = "Verdict";
                    } elseif (strpos($substring, 'witness') !== false) {
                        $subtype = "Witness_List";
                    } else {
                        $subtype = "";
                    }

                    $casePosition = strpos($text, "Case No.:");
                    $casePosition2 = strpos($text, "CASEồO.");

                    if ($casePosition !== false) {
                        // Extract the substring starting from 12 characters after "Case No.:"
                        $caseNumber = substr($text, $casePosition + 12, 12);
                        echo "Case No.: " . $caseNumber;
                    } elseif ($casePosition2 !== false) {
                        // Extract the substring starting from 11 characters after "CASEồO."
                        $caseNumber = substr($text, $casePosition2 + 11, 12);
                        echo "Case No.: " . $caseNumber;
                    } else {
                        echo "Case number not found.";
                    }

                    $sql1 = "SELECT cases.id FROM cases WHERE deleted = 0 AND case_number=20";
                    $result1 = $db->query($sql1, true);

                    while ($row1 = $db->fetchByAssoc($result1)) {
                        $case_id = $row1['id'];
                        echo $case_id;
                        echo "working up to here";
                    }

                    $caseBean = BeanFactory::getbean('Cases', $case_id);

                    if (strpos(strtolower($text), "case no:") !== false || strpos(strtolower($text), "defendant") !== false) {
                        echo 'Attachment saved: ' . $value . '<br>';
                        $documentBean = BeanFactory::newBean('PLEA_Pleadings');
                        $documentBean->document_name = $value;
                        $documentBean->description = 'Attachment from Gmail';
                        $documentBean->doc_url = $filePath;
                        $documentBean->incoming_or_outgoing = "Incoming";
                        $documentBean->author_type = $type;
                        $documentBean->subcategory_id = $subtype;
                        $documentBean->email_documents = 1;
                        $documentBean->save();
                        $document_id = $documentBean->id;
                        echo " before saving relation document";

                        $documentBean->load_relationship('plea_pleadings_cases');
                        $casesID = $documentBean->plea_pleadings_cases->add($caseBean);
                        echo " after saving relation document";
                    } else {
                        echo "The text does not contain both 'case no:' and 'defendant'.<br>";

                        if (unlink($filePath)) {
                            echo 'File deleted successfully.';
                        } else {
                            echo 'Unable to delete the file.';
                        }
                    }
                } else {
                    echo 'Attachment already exists: ' . $value . '<br>';
                }
            }
        }
    }
}

imap_close($connection);

echo 'Done';
?>
