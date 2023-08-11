<?php
$job_strings[] = 'assignworkflow';
function assignworkflow()
{	
	global $db;
	$sql = "SELECT * FROM aow_workflow WHERE deleted = 0";
	$result = $db->query($sql);
	while ($row = $db->fetchByAssoc($result)) {
		$userId = $row['assigned_user_id'];
		$flowid = $row['id'];
		$userBean = BeanFactory::getBean('Users', $userId);
		if ($userBean->status == 'Active') {
			echo $row['name']." workflow has active user<br>";
		} else {
			$activeUserIds = array(); 
			$userBean_f = BeanFactory::getBean('Users');
			$activeUsers = $userBean_f->get_full_list("status = 'Active'");
			foreach ($activeUsers as $activeUser) {
				$activeUserIds[] = $activeUser->id;
			}
			$randomActiveUserId = $activeUserIds[array_rand($activeUserIds)];
			$workflowbean = BeanFactory::getBean('AOW_WorkFlow', $flowid);
			$workflowbean->assigned_user_id = $randomActiveUserId;
			$workflowbean->save();
		}
	}
	return true;
}

