////  workflow end status fields checks ////// START 	
$(document).ready(function() 
{	
	$('#EditView > div.buttons')[0].childNodes[1].setAttribute( "onClick", "javascript: save_opt_workflow(); return false;" );
		$('#workflow_reason_c').parent().parent().hide();
		$('#explain_w_reason_c').parent().parent().hide();
		$('#why_opt_out_c').parent().parent().hide();
		if($('#workflow_end_status_c').val()=="Not_Done")
		{
			$('#workflow_reason_c').parent().parent().show();
			 if($('#workflow_reason_c').val()=="other")
			 {
				$('#explain_w_reason_c').parent().parent().show();
			 }
		}
		else if($('#workflow_end_status_c').val()=="Opt_Out")
		{
			$('#why_opt_out_c').parent().parent().show();
			
		}
		else
		{
			$('#workflow_reason_c').parent().parent().hide();
			$('#why_opt_out_c').parent().parent().hide();
			$('#explain_w_reason_c').parent().parent().hide();
			
		}
	$('#workflow_end_status_c').on('change', function() 
	{
			if($('#workflow_end_status_c').val()=="Not_Done")
		{
			$('#workflow_reason_c').parent().parent().show();
			$('#why_opt_out_c').parent().parent().hide();
			$('#why_opt_out_c').val('');
		}
		else if($('#workflow_end_status_c').val()=="Opt_Out")
		{
			$('#workflow_reason_c').parent().parent().hide();
			$('#workflow_reason_c').val('');
			$('#explain_w_reason_c').parent().parent().hide();
			$('#explain_w_reason_c').val('');
			$('#why_opt_out_c').parent().parent().show();
			
		}
		else
		{
			$('#workflow_reason_c').parent().parent().hide();
			$('#workflow_reason_c').val('');
			$('#why_opt_out_c').parent().parent().hide();
			$('#why_opt_out_c').val('');
			$('#explain_w_reason_c').parent().parent().hide();
			$('#explain_w_reason_c').val('');
		}
	});
		  
		  $('#workflow_reason_c').on('change', function() 
		  {

				if($('#workflow_reason_c').val()=="other")
				{
					    $('#explain_w_reason_c').parent().parent().show();
				}
				else
				{
						$('#explain_w_reason_c').parent().parent().hide();
						$('#explain_w_reason_c').val('');
				}
		
   			});
});
////  workflow end status fields checks ////// END


$( "#SAVE" ).click(function() 
{
	save_opt_workflow();
});



function save_opt_workflow() 
{
//	alert('shslslssjlsj');
 var record_id=$('input[name="record"]').val();
 var module_get=$('input[name="return_module"]').val();
var opt_out = $('#why_opt_out_c').val();
if(opt_out!=="")
{
$.ajax({
	url: 'index.php?module='+module_get+'&action=send_opt_alert&record_id='+record_id+'&opt_out='+opt_out,
	type: 'POST',
	contentType: 'application/x-www-form-urlencoded',
	dataType: 'text',
	data: 'sugar_body_only=true',						
	async: true,			
	success : function (result)
	{     
		
	}
});
}
var _form = 
document.getElementById('EditView');
        _form.action.value='Save'; 
if(check_form('EditView')){
SUGAR.ajaxUI.submitForm(_form);
return false;
}
}