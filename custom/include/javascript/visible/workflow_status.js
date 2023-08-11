////  workflow end status fields checks ////// START 	
$(document).ready(function() 
{	
	   $('#EditView > div.buttons')[0].childNodes[1].setAttribute( "onClick", "javascript: save_opt_workflow(); return false;" );
		$('#workflow_reason_c').parent().parent().hide();
		$('#explain_w_reason_c').parent().parent().hide();
		$('#why_opt_out_c').parent().parent().hide(); 
		$('#optout_workflows').parent().parent().hide();
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
			$('#optout_workflows').parent().parent().show();
			
		}
		else
		{
			$('#workflow_reason_c').parent().parent().hide();
			$('#why_opt_out_c').parent().parent().hide();
			$('#optout_workflows').parent().parent().hide();
			$('#explain_w_reason_c').parent().parent().hide();
			
		}
	$('#workflow_end_status_c').on('change', function() 
	{
			if($('#workflow_end_status_c').val()=="Not_Done")
		{
			$('#workflow_reason_c').parent().parent().show();
			$('#optout_workflows').parent().parent().hide();
			$('#optout_workflows').val('');
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
			$('#optout_workflows').parent().parent().show();
			   add_workflows_options();
		}
		else
		{
			$('#workflow_reason_c').parent().parent().hide();
			$('#workflow_reason_c').val('');
			$('#why_opt_out_c').parent().parent().hide();
			$('#why_opt_out_c').val('');
			$('#optout_workflows').parent().parent().hide();
			$('#optout_workflows').val('');
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

function add_workflows_options(){
	var module_get=$('input[name="return_module"]').val();
	$.ajax({
		url: 'index.php?module='+module_get+'&action=related_workflow_list&module_get='+module_get,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result)
		{
            $('#optout_workflows').empty();
            var workflows = JSON.parse(result);
            $.each(workflows, function (index, workflow) {
                var option = $('<option>', {
                    value: workflow.value,
                    text: workflow.text
                });
                $('#optout_workflows').append(option);
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching workflows:', error);
        }
	});

} 