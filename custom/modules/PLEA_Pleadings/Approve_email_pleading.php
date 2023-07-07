<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Approve_email_pleading
{

 function Approve_pleading($bean, $event, $arguments){

		if($bean->email_documents==1 && $bean->approve_pleading==1){

			$bean->email_documents=0;
		}
 }

}

