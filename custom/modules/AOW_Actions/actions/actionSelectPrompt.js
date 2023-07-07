function HelloWOrld(){
$('#exampleModalPopovers').hide();
console.log("yes here");
}

function LoadWorkflows_Which_Are_Relatedto_selected_option(e){
  var selectedModuleName = $(e).find(":selected").val();
   $.ajax({
      type: 'GET',
      url: 'index.php?module=AOW_WorkFlow&action=getAllRelatedWorkflows&moduleName='+selectedModuleName,
      success: function(data) {
        $('#AllWorkFlows').html(data);
      },
    });
}

function SelectWorkFlowAndAssign(){
  // console.log($('#AllWorkFlows').find(":selected").val());
  $("#AllWorkFlows :selected").map(function(i, el) {
     console.log($(el).val());
}).get();
}

