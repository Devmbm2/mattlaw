<?php



class BeanEmailJob implements RunnableSchedulerJob
{	
	
   public function run($arguments)
   {
	require_once 'custom/include/getemails.php';	
     $arguments = json_decode($arguments,1);
     $bean = BeanFactory::getBean($arguments['module'],$arguments['id']);

     // write your custom code here

	$syncemails= new CustomEmailSync();
	$syncemails->syncNow();
	 ///end 
     
   }
   public function setJob(SchedulersJob $job)
   {
     $this->job = $job;
   }
}