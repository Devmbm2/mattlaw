$(document).ready(function () {
    $("select#status").change(function () {
      $.ajax({
        type: 'GET',
        url: 'index.php?module=Cases&action=getAllRelatedWorkflows',
        success: function(data) {
         $('#AllWorkFlows').html(data);
         var handleOK = function() {
          this.hide();
          CheckedAllWorkflows();
      };
          YAHOO.SUGAR.MessageBox.show({
            msg: '',
            height: '70px',
            width: '50px',
            position: 'centre',
            title: 'Workflows to be Active',
            buttons:[
              { text: 'Active',handler: handleOK ,isDefault:true},
              ]


        });
$('#sugarMsgWindow').append(`
<style>
#sugarMsgWindow > div.ft > span>span>span>button{
width: 100px;
padding: 7px;
border-radius: 30px;
border-color: transparent;
background-color: #edd03d;
}
</style>
`);
        $(".bd").append(`
<style>

.tooltip2 {
  position: relative;
  display: inline-block;
  //border-bottom: 1px dotted black;
}

.tooltip2 .tooltiptext {
  visibility: hidden;
  width: 300px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip2:hover .tooltiptext {
  visibility: visible;
}

</style>
<div class="container" style="width: 600px; font-size:15px; background-color:white;">
        `+data+`</div>


        `);
        },
      });


    });
});


function CheckedAllWorkflows(){
  var ids = [];
  $('input#WorkflowCheckBox:checked').each(function() {
  ids.push(this.value);
  });
  var case_id= document.getElementsByName("record")[0].value;
  $.ajax({
    type: 'POST',
    url: 'index.php?module=Cases&action=StatusActiveAndInactive',
    data:{checkboxArray:ids,record_id:case_id},
    success: function(data) {
      console.log(data);
      var handleOK = function() {
        this.hide();
    };
              YAHOO.SUGAR.MessageBox.show({
                msg: '<div class="container" style="padding:20px; width: 600px; font-size:15px; background-color:white;">Your Selected workflows has been activate</div>',
                height: '70px',
                width: '50px',
                position: 'centre',
                title: 'Workflows to be Active',
                buttons:[
                  { text: 'OK',handler: handleOK},
                  ]
            });
            $('#sugarMsgWindow').append(`
                  <style>
                  #sugarMsgWindow > div.ft > span>span>span>button{
                  width: 100px;
                  padding: 7px;
                  border-radius: 30px;
                  border-color: transparent;
                  background-color: #edd03d;
                  }
                  </style>
                  `);
    }});
}

function ShowDescription(description){
 $('#sugarMsgWindow_c').append(`
 <div  id="sugarMsgWindow "  class="yui-module yui-overlay yui-panel " style="visibility: inherit; position: absolute; top:10%; margin:20px 15%;">
 <a class="container-close" href="#" onclick="ClosePopup(this)" >Close</a>
 <div class="hd" id="sugarMsgWindow_h" style="cursor: move;">Description</div>
 <div class="bd">
 <div class="container " style="width: 400px; font-size:15px; background-color:white; ">
<div style="padding:5%;">
`+description+`
</div>
                                        </div>


         </div>

 </div>`);


}

function ClosePopup(e){
  // console.log();
 $($(e).parent()[0]).remove();
}
