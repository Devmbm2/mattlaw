$(document).ready(function(){
	$('#contact_id_c').attr('onchange','updateRelatedContactFields();');	
	$('#judge_c').attr('onblur','updateRelatedContactFields();');
	$('#assigned_user_name').attr('onblur','updateRelatedAssignedAttorney();');
	$('#default_assistant_id').attr('onchange','updateRelatedAssignedAttorney();');
	$('#assigned_user_name').attr('onchange','updateRelatedAssignedAttorney();');
	$("#btn_default_assistant_lawyer_name").attr("onclick", "OpenPopupRelatedAssignedAttorney();");
	/* $('#default_assistant_lawyer_name').attr('onblur','SQSChangeRelatedAssignedAttorney();');
	$('#default_assistant_lawyer_name').attr('onchange','SQSChangeRelatedAssignedAttorney();'); */
	/* SQSChangeRelatedAssignedAttorney(); */
	/* updateRelatedAssignedAttorney(); */
});

function updateRelatedContactFields(collection){
		var related_id = '';
		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			related_id = collection['name_to_value_array']['contact_id_c'];
		}
		else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
			related_id = collection['id'];
		}else if($('#contact_id_c').val() != ''){
			related_id = $('#contact_id_c').val();
		}
		if(related_id != ''){
			$.ajax({
				type: 'POST',
				url: 'index.php?module=Cases&action=getRelatedContactFields&related_id='+related_id,
				async: false,
				success: function(response){
				console.log(response);
				var obj = JSON.parse(response);
				console.log('run');
				console.log(obj);
				$('#judge_assistant_c').val(obj.judge_assistant_c);     
				$('#judge_asst_phone_c').val(obj.judge_asst_phone_c);      
				$('#judge_web_page_c').val(obj.judge_web_page_c);     
				$('#judge_asst_email_c').val(obj.judge_asst_email_c);
			}
			});
		}

		if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
			set_return(collection);
		}
}
function updateRelatedAssignedAttorney(collection){
	var related_id = '';
	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		related_id = collection['name_to_value_array']['assigned_user_id'];
	}
	else if(typeof(collection) != 'undefined' && typeof(collection['id']) !='undefined' && collection['id'] != ''){
		related_id = collection['id'];
	}else if($('#assigned_user_id').val() != ''){
		related_id = $('#assigned_user_id').val();
	}
	if(related_id != ''){
		$.ajax({
			type: 'POST',
			url: 'index.php?module=Cases&action=getRelatedAssignedAttorney&related_id='+related_id,
			async: false,
			success: function(response){
			console.log(response);
			var obj = JSON.parse(response);
			console.log('run');
			console.log(obj);
			$('#default_assistant_lawyer_name').val(obj.default_assistant_name);     
			$('#default_assistant_lawyer_id').val(obj.default_assistant_id); 
		}
		});
	}

	if(typeof(collection) != 'undefined' && typeof(collection['name_to_value_array']) != 'undefined'){
		set_return(collection);
	}
}
function SQSChangeRelatedAssignedAttorney(){
	sqs_objects["EditView_default_assistant_lawyer_name"].parent_id = $("#assigned_user_id").val();
}
function OpenPopupRelatedAssignedAttorney(){
    if ($("#assigned_user_id")) {
     	open_popup(
			"Users", 
			600, 
			400, 
			"&query=1&parent_id=" +
					$("#assigned_user_id").val(),
			true, 
			false, 
			{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"default_assistant_lawyer_id","name":"default_assistant_lawyer_name"}}, 
			"single", 
			true
		 );
	
    }
}
function get_ids_workflow()
{   
	    var get_id = [];
		$.each($("input[name='workflow_related']:checked"), function()
		{
				get_id.push($(this).val());
		});
		return get_id;
}

 function activate_workflows_case()
 {
	       var get_ids=get_ids_workflow();
		$.LoadingOverlay("show", {zIndex: 999999 } );
		$.ajax({
			url: 'index.php?module=Cases&action=activate_related_workflows&get_ids='+get_ids,
			type: 'POST',
			contentType: 'application/x-www-form-urlencoded',
			dataType: 'text',
			data: 'sugar_body_only=true',						
			async: true,			
			success : function (data){ 		
		   YAHOO.SUGAR.MessageBox.show
		   ({msg: data,height: '500px',width: '300px',position: 'centre',title: 'Success',});
		    $.LoadingOverlay("hide");
        	 save_form();	
			}
		});
		var close_it =$('#popup_confirm_close');
		ClosePopup_confirm(close_it); 
		$('#sugarMsgWindow_mask').hide();		
 }
 


$(document).ready(function() 
  {
	 var type= $( "#type option:selected" ).val();
  if(type=="Car_Accident")
  {
  	$( "#number_potential_plaintif_c" ).parent().parent().show();
  } 
    $("#type").change(function() 
	 {
		   var type= $( "#type option:selected" ).val();
		  if(type=="Car_Accident")
		  {
  			$( "#number_potential_plaintif_c" ).parent().parent().show();
		  } 
     });
});
$(document).ready(function() {
	$('#EditView > div.buttons')[0].childNodes[1].setAttribute( "onClick", "javascript: workflows_popup(); return false;" );
 document.getElementById( "SAVE" ).setAttribute( "onClick", "javascript: workflows_popup(); return false;" );
  });

function workflows_popup(){
	
	var conditions_check={};

	 var type= $( "#type option:selected" ).val();
  if(type=="Car_Accident"){
  		conditions_check={type:"type",}
  }

  var insurance_or_collectability_c= $( "#insurance_or_collectability_c option:selected" ).val();
  if(insurance_or_collectability_c=="Low_Insurance" || insurance_or_collectability_c=="Medium_Insurance" ||
  insurance_or_collectability_c=="High_Insurance" ){
  		conditions_check.insurance_or_collectability_c="insurance_or_collectability_c";
  	 }

 var damages_c= $( "#damages_c option:selected" ).val();
  if(damages_c=="Low_Damages" || damages_c=="Medium_Damages" ||
  damages_c=="High_Damages" ){
  		conditions_check.damages_c="damages_c"; }

var liability_c= $( "#liability_c option:selected" ).val();
  if(liability_c=="Low_Liability" || liability_c=="Medium_Liability" ||
  liability_c=="High_Liability" ){
  			conditions_check.liability_c="liability_c"; }

 var number_potential_plaintif_c= $( "#number_potential_plaintif_c option:selected" ).val();
  if(number_potential_plaintif_c !=""){
  		conditions_check.number_potential_plaintif_c="number_potential_plaintif_c";
  	 }

  	if(conditions_check.type=="type" && 
   conditions_check.insurance_or_collectability_c=="insurance_or_collectability_c" && 
  	 conditions_check.damages_c=="damages_c" && 
  		conditions_check.liability_c=="liability_c" && 
  		 conditions_check.number_potential_plaintif_c=="number_potential_plaintif_c" ) 
  	{
	 var recordID=document.querySelector('input[name=record]').value;
    if(recordID!="")
	{
   var contact_id = $("[name='contact_id2_c']").val();
	$.LoadingOverlay("show", {zIndex: 999999 } );
	         
	$.ajax({
		url: 'index.php?module=Cases&action=show_related_workflows&contact_id='+contact_id+'&recordID='+recordID,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
		if(result!='false')
		{
	YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active'});
		$.LoadingOverlay("hide");
		}
		else{
			   save_form();
			$.LoadingOverlay("hide");
		}
		
			
		}
   
	});
}
 else{ save_form();}

}
  else{ save_form(); }

}

function save_form()
 {
				var _form = 
	        document.getElementById('EditView'); 
			_form.action.value='Save'; 
		if(check_form('EditView'))
		{
			SUGAR.ajaxUI.submitForm(_form);
			return false;
		}
 }


function confirm_activate_workflows_case(){
	var get_ids=get_ids_workflow();
	$.ajax({
		url: 'index.php?module=Cases&action=show_confirm_workflows&get_ids='+get_ids,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
         
         $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Confirmation</div>
 <div class="bd">
 `+result+`
 <div class="container " style="width: 600px; font-size:15px; background-color:white; ">
<hr>
<div>
 <p>Do you want to activate selected workflow ? </p>
 <br>
 <div style="padding-bottom:45px;">
 <input title="No" accesskey="a" class="button primary" onclick="ClosePopup_confirm(this);" type="submit" name="button" value="No" id="popup_confirm_close"  style="float:right; border-radius:20px; ">
 <input title="Yes" accesskey="a" class="button primary" onclick="activate_workflows_case();" type="submit" name="button" value="Yes" style="float:right; border-radius:20px; ">
</div>
</div>
      </div>

         </div>
 </div>`);
         
		}
		});

 


}
function ClosePopup_confirm(e){
   
 $($(e).parent().parent().parent().parent().parent()[0]).remove();
  
}



function ShowDescription_case(){
	var myTitle = $('#show_descriptions').attr('title');
 $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Description</div>
 <div class="bd">
 <div class="container " style="width: 400px; font-size:15px; background-color:white; ">
<div style="padding:5%;">
`+myTitle+`
</div>
                                        </div>


         </div>

 </div>`);


}

function ClosePopup(e){
  // console.log();
 $($(e).parent()[0]).remove();
}


function save_form_upon_cancel(e){
	
	 $($(e).parent().parent().parent().parent()[0]).remove();
	 $('#sugarMsgWindow_mask').hide();

	 	var _form = 
document.getElementById('EditView');
        _form.action.value='Save'; 
if(check_form('EditView')){
SUGAR.ajaxUI.submitForm(_form);
return false;
}


}

YAHOO.util.Event.addListener(YAHOO.util.Selector.query('#contact_id1_c'), "change", function(){
	window.client_id=$(this).val();
	showpopup_equal_client_injuredp($(this).val());
}); 
YAHOO.util.Event.addListener(YAHOO.util.Selector.query('#contact_id2_c'), "change", function(){
	window.injured_id=$(this).val();
	showpopup_equal_client_injuredp($(this).val());
});

function showpopup_equal_client_injuredp(id){
	if (window.client_id === window.injured_id && window.client_id != "" )
{
$.ajax({
		url: 'index.php?module=Cases&action=show_related_workflows_client',
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
		// if(result!='false')
		// {
	YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active'});
		$.LoadingOverlay("hide");
		// }
		// else{
		// 	$.LoadingOverlay("hide");
		// }
			
		}
	});

}
	



}