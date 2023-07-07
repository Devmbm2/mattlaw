<?php

require_once('include/upload_file.php');
require_once('custom/modules/Documents/DocumentSoap.php');
class join_document
{
    function join_doc($bean, $event, $arguments)
    {
        global $db;
        $query = "SELECT join_document FROM ht_damages where id='" . $bean->id . "'";
        $result = $db->query($query);
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $joinDocument = $row['join_document'];
                if ($joinDocument == 0) {
                    $document = BeanFactory::newBean('Documents');
                    $document->document_name = $bean->name;
                    $document->description = $bean->description;
                    $document->date_of_document_c = date('Y-m-d', strtotime($bean->date_entered));
                    $document->case_id = $bean->case_id;
                    $documentSoap = new DocumentSoap();
                    $filename = "upload://{$bean->id}";
                    $fileData = array(
                        'id' => ' ',
                        'file' => base64_encode(sugar_file_get_contents($filename)),
                        'filename' => $_FILES['file_file']['name'],
                        'revision' => '1'
                    );
                    $result = $documentSoap->saveFile($fileData);
                    $document->document_revision_id = $result;
                    $document->save();
                    $sql = "UPDATE `ht_damages` SET `join_document`=1 WHERE id='" . $bean->id . "'";
                    $db->query($sql);
                }
            }
        }
    }
}
