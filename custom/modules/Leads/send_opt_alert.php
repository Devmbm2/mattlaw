<?php
			global $db , $sugar_config;
			$record= $_REQUEST['record_id'];
			$opt_out= $_REQUEST['opt_out'];
		    $sql = $db->query("SELECT description from alerts   where target_module='".$record."' ORDER BY date_entered DESC limit 1");
            $dec = $db->fetchByAssoc($sql);
		$descriptions=$dec['description'];
    if( !empty($descriptions)) 
    {   
		if( $descriptions !=$opt_out)
		{ 
			$bean = BeanFactory::getBean('Leads',$record);
			$assignto_id=$bean->assigned_user_id;
			$bean_alert= BeanFactory::newBean('Alerts');
			$bean_alert->name="Opt out workflow";
			$bean_alert->description=$opt_out;
			$bean_alert->target_module=$record;
			$bean_alert->is_read=0;
			$bean_alert->url_redirect='index.php?module=Leads&action=DetailView&record='.$record;
			$bean_alert->assigned_user_id=$assignto_id;
			$bean_alert->save();
		}
	}
else{

    $bean = BeanFactory::getBean('Leads',$record);
			$assignto_id=$bean->assigned_user_id;
			$bean_alert= BeanFactory::newBean('Alerts');
			$bean_alert->name="Opt out workflow";
			$bean_alert->description=$opt_out;
			$bean_alert->target_module=$record;
			$bean_alert->is_read=0;
			$bean_alert->url_redirect='index.php?module=Leads&action=DetailView&record='.$record;
			$bean_alert->assigned_user_id=$assignto_id;
			$bean_alert->save();
}
			die;
    	