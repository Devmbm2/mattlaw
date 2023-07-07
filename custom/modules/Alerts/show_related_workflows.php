<?php

	  	   $stream_html .='<head>
	<script type="text/javascript" src="custom/modules/Alerts/js/edit.js"></script>
	</script>
	<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
	</script>
</head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	   <div class="container-fluid" style="padding-top:30px; overflow-y:scroll; max-height:250px;">
	   <table class="table table-striped" style="width:700px;"  >
	   <tr style="background-color:#D3D3D3;">
	      <th style="width:5%"></th>
		  <th style="width:45%">Workflows </th>
		  <th style="width:30%; style="text-align:center;">Action name</th>
		  <th style="width:5%">Description </th>
		  <th style="width:15%">Actions </th>
		  </tr>';

        $bean = BeanFactory::getBean('AOW_WorkFlow');
     $query = "name LIKE '%Affirmative Defenses%' AND name LIKE '%response%' ";
    $workflows_related = $bean->get_full_list('',$query);
if (!empty($workflows_related)) {	
foreach($workflows_related as $workflow_related )
		     {	
  		   $id_workflow=$workflow_related->id;
	   	$name_workflow=$workflow_related->name;
	   	$description_workflow=$workflow_related->description;
			$bean_AOW_Actions = BeanFactory::getBean('AOW_Actions');
			$query_2 = " aow_actions.aow_workflow_id = '$id_workflow'";
			$actions_workflow = $bean_AOW_Actions->get_full_list('',$query_2);	



$stream_html .='
		  
		 <tr>
		 <td>
		 <input type="checkbox" id="workflow_related" name="workflow_related" value="'.$id_workflow.'" style="padding-bottom:22px;"></td>
			 <td><label for="workflow_related" style="font-size:14px;"> '.$name_workflow.'</label></td><td>'; 
			 $i=1;
			 foreach($actions_workflow as $actions )
			 {		
	 $stream_html .='
	 <p  style="font-size:12px; padding-left:20px;"><b> '.$i++.'. ' .$actions->name.'</b></p>';
			 }
			 
			 $stream_html .='</td>
			  <td><div class="popup" onclick="ShowDescription();" id="show_descriptions" 
			  title="'.$description_workflow.'"><i  class="fa fa-info-circle" style="font-size:14px; color: #edd03d;  " ></i>
</div> 
	</p>
			 ';
			
		 $stream_html .=' </td>
		 <td style="width:20%">
			 
			 <a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-eye" style="font-size:14px; color: #edd03d; " ></i></a>
			 				&nbsp; | &nbsp;
			 <a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px; color: #edd03d; " ></i></a>
			</td>
			</tr>';
		
		
		 
}
$stream_html .='</table><input title="Exception" accesskey="a" class="button primary" onclick="exception_workflows() " type="submit" name="button" value="Exception" id="SAVE" style="float:right; border-radius:20px; "><input title="Activate" accesskey="a" class="button primary" onclick="confirm_activate_workflows() " type="submit" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; ">
<input title="CANCEL" accesskey="a" class="button primary" onclick="cancel_alert(this) " type="submit" name="button" value="CANCEL" id="SAVE" style="float:right; border-radius:20px; "></div>';

echo $stream_html;

die;

}

 else{
 $stream_html .='<div><p style="padding:30px;">NO related workflows found</p></div>';	
 	echo $stream_html;
      die;
 }