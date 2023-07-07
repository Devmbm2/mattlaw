$( document ).ready(function() {

  $("#detailpanel_-1 > div > div > div:nth-child(17)").before(`<br><br>
  <div class="col-xs-12 col-sm-6 edit-view-row-item" >
  <div class="col-xs-12 col-sm-4 label" data-label="LBL_CHECK_DUPLICATE">
  Map fields:
  </div>
  </div>
  <div class="col-xs-12 col-sm-6 edit-view-row-item"><br></div>
  <div class="col-xs-12 col-sm-8 edit-view-field " type="text" field="case_description_c" colspan="3" style="padding-left:200px">

  <table style="width:130%" id="map_table">
  <tr>
  <th style="width:25%"></th>
  <th style="width:45%">Module fields:</th>
  <th style="width:65%">Email Tag Name:</th>
  </tr>
  </table>
  </div>
  <div class="col-xs-12 col-sm-8 edit-view-field" style="padding-left:200px">
  <input  type="button" class="button" id="add_field" title="Add Field" value="Add Field"></input>
  </div>
  <div class="col-xs-12 col-sm-8 edit-view-field ">
 <br><br>    </div>
  `);

  $("#add_field").click(function(){
        $("#map_table").append(` <tr>`+
        `
        <td>  <input  type="button" class="button" id="remove_field"   title="-" value="-"></td>
        <td>
          <select name="maping_fields[]" id="maping_fields" title="" style="width:200px">
            <option label="" value=""></option>
            `+getfields(this)+`
            </select></td>
            <td>
            <select name="_emails_day[]" id="_emails_day" title="" style="width:200px">
              <option label="" value="subject">Subject</option>
              <option label="" value="sender_name">Sender Name</option>
              <option label="" value="sender_email">Sender Email</option>
              <option label="" value="body">Body</option>
              <option label="" value="date">Date</option>
              </select></td>
               </tr>`);
    //   $("#map_table").append(` <tr>
    //   <td>  <input  type="button" class="button" id="remove_field"
    //    title="-" value="-"></td>
    //  <td> <select name="maping_fields[]" id="maping_fields" title="" style="width:200px">
    //  <option label="" value=""></option>
    //  `+getfields(this)+`
    //  </select> </td>
    //  <td><input type="text" name="sync_emails_day" id="sync_emails_day" size="30" value="" title="" tabindex="0"></td>
    //  </tr>`);

  });



  $("#map_table").on('click', '#remove_field', function(){
      $(this).parent().parent().remove();
  });

});

function ajaxGeneralFunction(Data,ID,URL){
  // console.log(ID+"  "+URL);
    $.ajax({
      type: 'POST',
      url:URL,
      data:Data,
      success: function(data) {
          $(ID).html(data);
          $('[id=maping_fields]').html(data);

      }
  });
}

ajaxGeneralFunction("",'#convert_to_module','index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase&CodeType=module');
$('#convert_to_module').on('change',function(){
  $('#check_duplicate').css('width','250px');
  ajaxGeneralFunction({moduleName:$('#convert_to_module').val()},'#check_duplicate','index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase');
});


function getfields(e){
  ajaxGeneralFunction({moduleName:$('#convert_to_module').val()},'#maping_fields','index.php?module=ht_EmailExtract&action=GetAllModulesFromDatabase');
}
