<?php
		
				$bean = BeanFactory::getBean('AOW_Conditions');
				$query = " aow_conditions.field !=''  ";
				$conditions_workflows = $bean->get_full_list('',$query);	
				$stream_html .='<head>
				<script type="text/javascript" src="custom/modules/Cases/js/edit.js">
				</script>
				</head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<div class="container-fluid" style="padding-top:30px; overflow-y:scroll; max-height:250px;">
				<table class="table table-striped" style="width:700px;"  >
				<tr style="background-color:#D3D3D3;">
				    <th style="width:5%"> </th>
					<th style="width:45%">Workflows </th>
					<th style="width:30%; style="text-align:center;">Actions </th>
					<th style="width:5%">Description </th>
					<th style="width:15%"> </th>
					</tr>';
	   	 if (!empty($conditions_workflows))
	    {
	   	           $arr = array();
	         foreach ($conditions_workflows as $rows) 
	        {
                   $arr[] = $rows->aow_workflow_id;
            }	
                   $get_ids = array_unique($arr);   
                foreach($get_ids as $get_id)
		     	{
					if (!empty($get_id)) 
					{	
					  $workflow_related = BeanFactory::getBean('AOW_WorkFlow', $get_id);
						if($workflow_related->flow_module=='Cases')
						{
									$workflow_related->status='Inactive';
									$workflow_related->save();
									$workflow_proc = BeanFactory::getBean('AOW_Processed');
								    $query_p= " aow_processed.parent_id ='$record' AND  aow_processed.aow_workflow_id ='$get_id' 
											AND  aow_processed.status ='Complete'";
								$check_processed= $workflow_proc->get_full_list('',$query_p);
								$already_workflow_run=1;	
							if(empty($check_processed))
							{	
									  $already_workflow_run=0;
									$workflow_proc = BeanFactory::getBean('AOW_Processed');
									$query_p= " aow_processed.parent_id ='$recordID' AND  aow_processed.aow_workflow_id ='$get_id' ";
									$check_processed= $workflow_proc->get_full_list('',$query_p);	
								  if(empty($check_processed))
									{
										    $id_workflow=$workflow_related->id;
											$name_workflow=$workflow_related->name;
											$description_workflow=$workflow_related->description;
									        $bean = BeanFactory::getBean('AOW_Actions');
											$query_2 = " aow_actions.aow_workflow_id = '$get_id'";
											$actions_workflow = $bean->get_full_list('',$query_2);	

									
										  $stream_html .='
												
												<tr>
												<td>
												<input name="age_check" id="age_check" type="hidden" value="ok">
												<input type="checkbox" id="workflow_related" name="workflow_related" value="'.$id_workflow.'" style="padding-bottom:22px;"></td>
												<td><label for="workflow_related" style="font-size:14px; "> '.$name_workflow.'</label></td><td>';
												
													$i=1;
													foreach($actions_workflow as $actions )
													{		
											$stream_html .='
											<p  style="font-size:12px; padding-left:20px;"><b> '.$i++.'. ' .$actions->name.'</b></p>';
													}
													
													$stream_html .='</td>
													<td><div class="popup" onclick="ShowDescription();" id="show_descriptions" 
													title="'.$description_workflow.'"><i  class="fa fa-info-circle" style="font-size:14px; color: #edd03d;  " ></i>
													</div></p>';
													
												$stream_html .=' </td>
												<td style="width:20%">
													
													<a href="index.php?module=AOW_WorkFlow&action=DetailView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-eye" style="font-size:14px; color: #edd03d; " ></i></a>
																	&nbsp; | &nbsp;
													<a href="index.php?module=AOW_WorkFlow&action=EditView&record='.$id_workflow.'" target="_blank"><i  class="fa fa-edit" style="font-size:14px;  color: #edd03d; " ></i></a>
													</td>
													</tr>';
										
									}
				   			}				
		          		}
            		}
    			}

					$stream_html .='</table><input title="Activate" accesskey="a" class="button primary" onclick="confirm_activate_workflows_case() " type="submit" name="button" value="Activate" id="SAVE" style="float:right; border-radius:20px; "><input title="CANCEL" accesskey="a" class="button primary" onclick="save_form_upon_cancel(this)" type="submit" name="button" value="CANCEL" id="SAVE" style="float:right; border-radius:20px; "></div>';
					             if($already_workflow_run==1)
							    {
						          echo 'false'; die;
							    }
								else{ echo $stream_html; die;
									}
		}
