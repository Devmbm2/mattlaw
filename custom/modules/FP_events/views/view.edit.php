<?php
require_once('include/MVC/View/views/view.edit.php');
class FP_eventsViewEdit extends ViewEdit {
   public function __construct(){
 		parent::__construct();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 	}
	function display() {
		global $current_user;
		if(empty($this->bean->id)){
			/* $this->bean->multiple_assigned_users = $current_user->id;	 */
			$this->bean->assigned_user_id = $current_user->id;	
		}
		$formName = $this->ev->formName;
		if(empty($formName)){
			$formName = 'EditView';
		}
		parent::display();
		
		echo '
			<div class="message_dialog_div" id="message_dialog_div" style="display:none;  background-color:white;">
				<div class="message_dialog" id="message_dialog_Events" style="width:870px;height:200px;background-color:white;overflow-y: auto;
				overflow-x: auto;">
				</div>
			</div>
		';
		if($_REQUEST['redirect']){	
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						$('#redirect').val('1');
					});	
				</script> 
			";
		}
		echo "
				<script type='text/javascript'>
				var redirect = '';
					redirect = '{$_REQUEST['redirect']}';
						console.log('redirect');
						console.log(redirect);
					$(document).ready(function(){
						var formName = '{$formName}';
						
					});	
					

				</script> 
			";
				echo "<script type='text/javascript' src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>";
				echo '<link href="custom/include/multiselect/multiselect.css" rel="stylesheet" />';
				echo '<link href="custom/modules/FP_events/css/password_style.css" rel="stylesheet" />';
				/* echo "<script type='text/javascript' src='custom/modules/FP_events/js/events_holds.js'></script>"; */
			    echo '<script type="text/javascript" src="custom/include/multiselect/multiselect.js"></script>';
			 	echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						
						$('#'+ formName +' #assigned_user_name').parent().parent().hide();
						
						$('#'+ formName +' #multiple_assigned_users').multiselect({
							columns: 1,
							placeholder: 'Select Multiple Assigned Users',
							search: true,
							selectAll: true
						});
						
					});
					$('#primary_address_street').css('width','45%');
					$('#primary_address_street').css('height','30px');
				</script> 
			";
			if(empty($this->bean->id) && isset($_REQUEST['cases_fp_events_1cases_ida']) && !empty($_REQUEST['cases_fp_events_1cases_ida'])){
				$case = BeanFactory::getBean('Cases', $_REQUEST['cases_fp_events_1cases_ida']);
				/* echo $case->assigned_user_id; */
				$this->bean->multiple_assigned_users = $case->assigned_user_id;	
				/* print"<pre>";print_r($_REQUEST['cases_fp_events_1cases_ida']); */
				echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var related_case_assigned_user_id = '{$case->assigned_user_id}';
						$('#'+ formName + ' #multiple_assigned_users option[value='+ related_case_assigned_user_id+']').attr('selected', 'selected');
						$('#'+ formName + ' #multiple_assigned_users').multiselect( 'reset' );
					});
				</script> 
				";
			}
		/*  if(empty($this->bean->id)){
			echo "
				<script type='text/javascript'>
					$(document).ready(function(){
						var current_user = '{$current_user->id}';
						$('#'+ formName +' #multiple_assigned_users').val(current_user).trigger('change.select2');
					});
				</script> 
			";
		} */
	
	}
}
?>
