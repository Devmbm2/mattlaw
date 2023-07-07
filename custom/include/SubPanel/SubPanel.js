/**
 * Created by salesagility on 27/01/14.
 */

 function showSearchPanel(subpanel){
    
    console.log(subpanel);
    if(subpanel=='activities'){
      buildSearchPanel(subpanel);
    }
  if(document.getElementById(subpanel+'_search') == null){
      buildSearchPanel(subpanel);
  }

  if(document.getElementById(subpanel+'_search').style.display == 'none'){
      document.getElementById(subpanel+'_search').style.display = '';
  } else {
      document.getElementById(subpanel+'_search').style.display = 'none';
  }


}

function buildSearchPanel(subpanel){
  var tables = document.getElementById("list_subpanel_"+subpanel).getElementsByTagName("table");
  var module = get_module_name();
  var row = tables[0].rows[1].getElementsByTagName("table");
   // console.log(row);
  // row.id = subpanel+'_search';
  // row.className = "pagination";
  // row.style.display = 'none';
  var row2 = row[0].rows[0];
  var button_style = row2.querySelectorAll('input[type="button"]');
  for (var i = 0; i < button_style.length; i++) {
    button_style[i].style.marginTop  = '0px';
  }
  var col = row2.insertCell(1);
  col.id = subpanel+'_search';
  col.className = "pagination";
  col.style.display = 'none';
  if(subpanel=='activities'){
    col.style.display = 'block';
  }
  var table = document.createElement('table');
  table.width = "100%";
$.ajax({url:"index.php?module="+currentModule+"&action=SubPanelSearch&subpanel="+subpanel+"&query=%25",
      success:function(result){
          table.innerHTML += result;
          SUGAR.util.evalScript(result);
      }
  });
  var firstLabel = table.querySelector('td:first-of-type label');
  var firstLabelText = firstLabel.textContent;
  var input = table.querySelector('td:nth-of-type(2) input');
  input.placeholder = firstLabelText;
  input.style = "padding: 5px 13px; line-height: initial; height: initial;";
  var buttons = table.querySelector('td:nth-of-type(3)');
  var firstbutton = buttons.querySelectorAll('input')[0];
  var secondbutton = buttons.querySelectorAll('input')[1];
  secondbutton.style = "padding: 5px 13px; line-height: initial; height: initial;";
  firstbutton.style = "padding: 5px 13px; line-height: initial; height: initial;";
  var tds =table.getElementsByTagName('td');
  tds[0].style.display = 'none';
  col.appendChild(table);
}


function submitSearch(subpanel) {
  var submit_data = [];
  var module = get_module_name();
  var id = get_record_id();
  submit_data.push(module);

  $('#'+subpanel+'_search input,select').each(function() {
      var type = $(this).attr("type");

      if ((type == "checkbox" || type == "radio")) {
          if($(this).is(":checked")) submit_data.push($(this).attr("name")+'='+$(this).val());
      }
      else if (type != "button" && type != "submit") {
          if ($(this).val() != '') submit_data.push($(this).attr("name")+'='+encodeURIComponent($(this).val()));
      }
  });

  var url = 'index.php?sugar_body_only=1&module='+module+'&subpanel='+subpanel+'&action=SubPanelViewer&inline=1&record='+id + '&layout_def_key=%'+submit_data.join('&');
  let index = url.indexOf('name_basic=');
if (index !== -1) {
  index += 'name_basic='.length; // Move the index to the end of "name_basic="
  url = url.slice(0, index) + '%' + url.slice(index);
}
 console.log(url);
  showSubPanel(subpanel,url,true);
}

function clearSearch(subpanel) {
  var submit_data = [];
  var module = get_module_name();
  var id = get_record_id();
  submit_data.push(module);

  $('#'+subpanel+'_search input').each(function() {
      var type = $(this).attr("type");

      if ((type == "checkbox" || type == "radio")) {
          $(this).prop('checked', false);
      }
      else if (type != "button" && type != "submit") {
          $(this).val('');
      }
  });

$('#'+subpanel+'_search select').each(function() {
      var id_temp = $(this).attr("id");
  if ($(this).is("[multiple]"))
  {
    $("#"+id_temp+" > option").attr("selected",false);
  }
  else
  {
    $("#"+id_temp).val( $("#"+id_temp+" option:first-child").val() );
  }
  });


  $('#'+subpanel+'_search input,select').each(function() {
    var type = $(this).attr("type");

    if ((type == "checkbox" || type == "radio")) {
        if($(this).is(":checked")) submit_data.push($(this).attr("name")+'='+$(this).val());
    }
    else if (type != "button" && type != "submit") {
        if ($(this).val() != '') submit_data.push($(this).attr("name")+'='+encodeURIComponent($(this).val()));
    }
});

var url = 'index.php?sugar_body_only=1&module='+module+'&subpanel='+subpanel+'&action=SubPanelViewer&inline=1&record='+id + '&layout_def_key='+submit_data.join('&');

showSubPanel(subpanel,url,true);


}
