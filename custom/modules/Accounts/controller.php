<?php
class CustomAccountsController extends SugarController
{
	public function action_livesearch()
	{
		global $db;
		$searchText = $_REQUEST['searcheditem'];
		$sql = "SELECT * FROM accounts  WHERE name LIKE  '%$searchText%'
	 			OR nickname_c LIKE '%$searchText%' OR account_type LIKE  '%$searchText%'  OR phone_office LIKE  '%$searchText%' OR billing_address_city LIKE  '%$searchText%' AND deleted =0
				order by account_type asc LIMIT 200";
		$result = $db->query($sql);
		$fetched_record=array();
		if ($result->num_rows > 0) {
			while ($record = $GLOBALS["db"]->fetchByAssoc($result)) {
				$bean = BeanFactory::getBean('Accounts',$record['id']);
				if($bean->id!=null)
				{
				$fetched_record[] = ["id" =>$bean->id,"name"=>$bean->name,"nickname_c" => $bean->nickname_c,"account_type" => $bean->account_type,"phone_office"=> $bean->phone_office,"billing_address_city"=> $bean->billing_address_city, ];
			}
			}
			$output = array(
				"data"       =>  $fetched_record
			   );
		    echo json_encode($output);
			die();
		} else {
            echo json_encode(array('data'=>''));
			die();
		}
	}
}


