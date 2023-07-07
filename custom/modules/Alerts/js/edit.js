function get_ids_workflow()
{   
	    var get_id = [];
		$.each($("input[name='workflow_related']:checked"), function()
		{
				get_id.push($(this).val());
		});
		return get_id;
}

function show_workflows(){
    	     $.LoadingOverlay("show", {zIndex: 999999 } );   
	$.ajax({
		url: 'index.php?module=Alerts&action=show_related_workflows',
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result)
		{

		YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active'});
		
		}

	});
	$.LoadingOverlay("hide");
}

function confirm_activate_workflows(){
	   var get_ids=get_ids_workflow();
	$.ajax({
		url: 'index.php?module=Alerts&action=show_confirm_workflows&get_ids='+get_ids,
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
 <input title="Yes" accesskey="a" class="button primary" onclick="activate_workflows();" type="submit" name="button" value="Yes" style="float:right; border-radius:20px; ">
 </div>
  </div>
   </div>
     </div>
      </div>`);     
		}
	  });
     }

	 function activate_workflows()
	 {
				  var get_ids=get_ids_workflow();
					  $.LoadingOverlay("show", {zIndex: 999999 } );
	  $.ajax({
					  url: 'index.php?module=Alerts&action=activate_related_workflows&get_ids='+get_ids+'&discovery_id='+$('#discovery_id').val(),
					  type: 'POST',
					  contentType: 'application/x-www-form-urlencoded',
					  dataType: 'text',
					  data: 'sugar_body_only=true',						
					  async: true,			
				success : function (data)
					  { 
							  YAHOO.SUGAR.MessageBox.show({
								msg: data,
								height: '500px',
								width: '300px',
								position: 'centre',
								title: 'Alert',      	
							});   
					  $.LoadingOverlay("hide");
					 }
		  });	
		  var close_it =$('#popup_confirm_close');
		  ClosePopup_confirm(close_it); 
		  $('#sugarMsgWindow_mask').hide();
	  }

function ClosePopup_confirm(e)
	{
		
		$($(e).parent().parent().parent().parent().parent()[0]).remove();
		
	}

function ShowDescription()
{
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
 $($(e).parent()[0]).remove();
}

function exception_workflows()
{

	$.LoadingOverlay("show", {zIndex: 999999 } );   
	$.ajax({
		url: 'index.php?module=Alerts&action=show_exception_workflows',
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'WorkFlows to be Active'});	
		}
	});
	$.LoadingOverlay("hide");      
}

$(document).on('change','#reason_exception',function()
{
	var element=document.getElementById("reason_exception");
   var check_reason=element.options[element.selectedIndex].text;
    if(check_reason=='Custom description'){
    	$('#custom_added_details').show();
    	$('#custom_added_details').val('');
    	$('#custom_added_details').prop('required',true);
     }
     else{
     	$('#custom_added_details').hide();
     	$('#custom_added_details').val('please write your details here...');
     }
});

function Submit_exception()
{
	    var custom_added_details= document.getElementById("custom_added_details").value;
	    var description_ctsm= $("#reason_exception option:selected" ).val();
    if (custom_added_details!="" && description_ctsm!="")
      {
		var discovery_id= document.getElementById("discovery_id").value;	
	    $.LoadingOverlay("show", {zIndex: 999999 } );
	   $.ajax({
		url: 'index.php?module=Alerts&action=save_exception_workflow&discovery_id='+discovery_id+'&description_ctsm='+description_ctsm+'&custom_added_details='+custom_added_details,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){

				YAHOO.SUGAR.MessageBox.show({msg: result, height:'700px', width:'200px',title: 'Success'});		
		}
	        });
	$.LoadingOverlay("hide");
  }
  $('#sugarMsgWindow_mask').hide();
}

function cancel_alert(e){
	
	$($(e).parent().parent().parent().parent()[0]).remove();
	$('#sugarMsgWindow_mask').hide();

}