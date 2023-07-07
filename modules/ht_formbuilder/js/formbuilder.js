$(document).on('change', '#use_tabs', function () {
		if($('#use_tabs').is(":checked")) {
			$(".form-builder").remove();
		    loadTreeData($(this).val());
			loadTreeDataNewmultitabs($("#related_module").val());
			$('#tabs').show();
			window.multitab_active=1;
		 }else{
			$(".form-builder").remove();
		    loadTreeData($(this).val());
			loadTreeDataNew($("#related_module").val());
			$('#tabs').hide();
			window.multitab_active=0;
		}
	})

var rel_module_old = ''; 
var formBuild = '';
var moduleFields;
let existingFormId = "";
$(window).load(function () {
	//alert(window.multitab_active);
	$("#tab_names").parent().parent().hide();
	$("#ruuid").val($("input[name='record']").val());
	if($('#use_tabs').is(":checked")) {
		window.multitab_active=1;
		loadTreeDatamultitabs($("#related_module").val());
	}
	else{
		window.multitab_active=0;
		loadTreeData($("#related_module").val());
	}
	//loadTreeData($("#related_module").val());
	rel_module_old = document.getElementById("related_module").value;
	if (rel_module_old) {
		$("#name").parent().parent().show();
	}
	else {
		$("#name").parent().parent().hide();
	}
	$("#save_and_continue").css("display", "none");
	if (rel_module_old == 'Cases' || rel_module_old == 'Leads') {
		$("#question_type").parent().parent().show();
		// $("#case_type").parent().parent().show();
	}
	else {
		$("#question_type").parent().parent().hide();
		$("#case_type").parent().parent().hide();
		$("#case_sub_type").parent().parent().hide();
	}
	question_type_old = document.getElementById("question_type").value;
	if(question_type_old)
	{
	if(question_type_old == 'specific')
	{
		$("#case_type").parent().parent().hide();
		$("#case_sub_type").parent().parent().show();
	}
	else if(question_type_old == 'beginning')
	{
		$("#case_type").parent().parent().show();
		$("#case_sub_type").parent().parent().hide();
	}
 }
 else
	{
		$("#case_type").parent().parent().hide();
		$("#case_sub_type").parent().parent().hide();
	}
});
$(document).on('change', '#related_module', function () {
	var rel_module_new = $(this).val();
	$("#name").val('');
	$("#question_type option:selected").prop("selected", false);
	$("#case_type option:selected").prop("selected", false);
	$("#column_size option:selected").prop("selected", false);
	$("#name").parent().parent().hide();
	if (rel_module_old == rel_module_new) {
		$(".form-builder").remove();	
	}
	else {
		$(".form-builder").remove();
		loadTreeDataNew($("#related_module").val());
	}
	if (rel_module_new == 'Cases' || rel_module_new == 'Leads') {
		$("#question_type").parent().parent().show();
		// $("#case_type").parent().parent().show();
		$("#name").parent().parent().hide();
	}
	else {
		$("#question_type").parent().parent().hide();
		$("#case_type").parent().parent().hide();
		$("#case_sub_type").parent().parent().hide();
		$("#name").parent().parent().show();
	}
});
function loadTreeData(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				console.log(moduleFields);
				if(moduleFields.hasOwnProperty('phone')){
                    moduleFields.phone[emptyData] = "--None--";
				}else{
					moduleFields['phone']={};
					moduleFields.phone[emptyData] = "--None--";
				}
				if($('#use_tabs').is(":checked")) {
					initFormBuildermultitabs();
				}
				else{
					initFormBuilder();
				}
			}
	);
}

function initFormBuilder(){
	
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.text,
			},
		};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},
	};
	if(moduleFields.phone)
		{
			
			var numberAttributes = {
					shape: {
						label: 'Related Field',
						'class': 'select2',
						options: moduleFields.phone,
					},
				};
			
		}
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea","Email"];
	var fields = [{
  label: "Email",
  type: "text",
  subtype: "email",
  icon: "✉"
}];
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
		if(numberAttributes)
		userAttrs["number"] = numberAttributes;
		var options = {
		dataType: 'json',
		formData: $("#description").html(),
		typeUserAttrs: userAttrs,
		fields: fields,
		onOpenFieldEdit: function(editPanel) {
			$(".select2").select2();
		},
		disabledActionButtons: ['data','clear','save'],
		fieldRemoveWarn: true,
		actionButtons: [{
    id: 'Create New Condition Logic',
    className: 'btn btn-success',
    label: 'Create New Condition Logic',
    type: 'button',
    style: 'width:100%',
    events: {
    click: function() {
    	$( 'form#logic-form' ).each(function(){
       this.reset();
        })
    	$(".error-message").text("");
      $(".success-message").text("");
      $("#field-value").parent().show(); 
      customlogicpopup();
    }
  }
},
{
  	id: 'View Condition Logic',
    className: 'btn btn-success',
    label: 'View Conditional Logics',
    type: 'button',
    style: 'width:100%',
    events: {
    click: function() {
      viewcustomlogicpopup();
    }
  }
  }]
	};
	formBuild =  $(fbTemplate).formBuilder(options);
	changeShape();
}

function loadTreeDataNew(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				console.log(moduleFields);
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				if(moduleFields.hasOwnProperty('phone')){
                    moduleFields.phone[emptyData] = "--None--";
				}else{
					moduleFields['phone']={};
					moduleFields.phone[emptyData] = "--None--";
				}
				initFormBuilderNew();
				
			}
	);
}

function initFormBuilderNew(){
	
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.text,
		},
	};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};	
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},

	};
	if(moduleFields.phone)
		{
			
			var numberAttributes = {
					shape: {
						label: 'Related Field',
						'class': 'select2',
						options: moduleFields.phone,
					},
				};
			
		}
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
	var fields = [{
  label: "Email",
  type: "text",
  subtype: "email",
  icon: "✉"
}];
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
		if(numberAttributes)
		userAttrs["number"] = numberAttributes;
		var options = {
	  onAddField: function(fieldId) {
		<!-- updateFields(); -->
		
	  },
	  // onAddOption: (optionTemplate, optionIndex) => {
  // },
	  disabledActionButtons: ['data','clear','save'],
	  typeUserAttrs: userAttrs,
	  fields: fields,
	  fieldRemoveWarn: true,
	  onOpenFieldEdit: function(editPanel) {
        $(".select2").select2();
      },
	};
  formBuild =  $(fbTemplate).formBuilder(options);
  changeShape();
}


function getFields(){
	return moduleFields
};


jQuery($ => {

});
function updateFields(){
		
        $markup = $("<div/>");
        $markup.formRender({ dataType:'xml',
			formData: formBuild.actions.getData('xml') });

        <!-- $("#outDiv").show(); -->

        var opts = {};
        opts.indent_size = 4;
        opts.indent_char = " ";
        opts.eol = "\n";
        opts.indent_level = 0;
        opts.indent_with_tabs = false;
        opts.preserve_newlines = true;
        opts.max_preserve_newlines = 5;
        opts.jslint_happy = false;
        opts.space_after_anon_function = false;
        opts.brace_style = "collapse";
        opts.keep_array_indentation = false;
        opts.keep_function_indentation = false;
        opts.space_before_conditional = true;
        opts.break_chained_methods = false;
        opts.eval_code = false;
        opts.unescape_strings = false;
        opts.wrap_line_length = 0;
        opts.wrap_attributes = "auto";
        opts.wrap_attributes_indent_size = 4;
        opts.end_with_newline = false;
				console.log('Test');
        $("#EditView #description").val(html_beautify($markup.formRender("html"), opts));
		return;
}


$(document).on("click",".savebtn",function(){
	if(window.multitab_active!=1)
	 {
		var hiddenfieldhtml = `<input type="hidden" class="randomID" name="ruuid" id="ruuid" value=""/>`
		$("form#EditView").append(hiddenfieldhtml);
		let record_idd = $("input[name='record']").val();
		if(record_idd){
	
		}
		else{
			if (existingFormId.length > 0) {
			// document.getElementById("ruuid").value = existingFormId;
			$("input[name='record']").val(existingFormId);
		} else {
			$("input[name='record']").val('');
			document.getElementById("ruuid").value = createGuidLocations();
		}
		}
		
		$("form#EditView #description").html(formBuild.formData);
		var _form = document.getElementById('EditView'); 
		_form.action.value='Save';
		if(check_form('EditView'))
		SUGAR.ajaxUI.submitForm(_form);
		return false;
}
});

//});
$(document).on("click",".clearbtn",function(){
	if(window.multitab_active!=1)
	{
	formBuild.actions.clearFields();
    }
});
$(document).on("click",".showhtmlbtn",function(e){
	//// fro multitabs   start  /////
	if(window.multitab_active!=1)
	{
	//formBuild.actions.showData();
	e.preventDefault();	
		var modalhtml = `
<style>
.w3-container,.w3-panel{padding:0.01em 16px;background:black;}.w3-panel{margin-top:16px;margin-bottom:16px}
.w3-modal{z-index:3;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px}
.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#fff;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
.w3-display-topright{position:absolute;right:0;top:0}
.w3-button:hover{color:#000!important;background-color:#ccc!important}
</style>
<div class="w3-container">

  <div id="showhtml" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('showhtml').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <textarea style="height:500px;background:black;color:#fff;" class="form-control" id="htmlmodaldiv" name="htmlinnerdiv"></textarea>
      </div>
    </div>
  </div>
</div>`;
	$("body").append(modalhtml);		
        var form_rendering_json = formBuild.actions.getData('json');
		var html = renderForm(form_rendering_json);
        $("#htmlmodaldiv").text(html);
		document.getElementById('showhtml').style.display='block'
	}		
});

$(document).on("click",".downloadhtmlbtn",function(){
	if(window.multitab_active!=1)
	{
		
	var testid = $("input[name='record']").val();
	var column_size = $("#column_size").val();
	var site_url = window.location.protocol+window.location.hostname+window.location.pathname;
	$markup = $("<div/>");

	$markup.formRender({formData: formBuild.actions.getData('json') });	
	let description_html_value = $markup.formRender("html");
  var filename = "code.html";
  let html = `<!DOCTYPE html>
<html>
    <head>
	 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>HTML</title>
		<style>
		input.formEntryPointButton
		{
			margin:auto;
			display:block;
		}
		</style>
    </head>
    <body>
	<form action="${site_url}?entryPoint=FormDataEntryPoint&id=${testid}" name="HtmlForm" id="htform" method="post">
	${description_html_value}
	<input type = "hidden" name="epformbuilder" id="epformbuilder" value="${testid}"/>
	<input class="formEntryPointButton" type = "submit" name ="htformsubmit" value="Submit"/>
	</form>
    </body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
 <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
	$(".rendered-form").addClass("container");
	if("${column_size}")
	{
		$(".form-group").addClass("${column_size}");
	}
	else
	{
	$(".form-group").addClass("col-lg-6");
	}
  </script>
  
   </html>`;
   
  download(filename, html);
}
});
function download(filename, text) {
	
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}
function createGuidLocations(){  
   function S4() {  
	  return (((1+Math.random())*0x10000)|0).toString(16).substring(1);  
   }  
   return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();  
}
$(document).on('change', '#case_type,#case_sub_type', function () {
	getTypeForm($(this).attr("id"));
});

$(document).on('change', '#question_type', function () {
		question_type = $(this).val();
			if(question_type == 'beginning')
				{
					$("#case_type").parent().parent().show();
					$("#case_sub_type").parent().parent().hide();
					$("#name").parent().parent().hide();
					$("#name").val('');
					$("#column_size").val('');
					$("#case_sub_type").val('');
					$(".form-builder").remove();
					loadTreeDataNew($("#related_module").val());
				}
			else if(question_type == 'specific')
				{
				$("#case_sub_type").parent().parent().show();
				$("#case_type").parent().parent().hide();
				$("#name").parent().parent().hide();
				$("#name").val('');
				$("#column_size").val('');
				$("#case_type").val('');
				$(".form-builder").remove();
				loadTreeDataNew($("#related_module").val());
				}
			else
				{
					$("#case_type").parent().parent().hide();
					$("#case_sub_type").parent().parent().hide();
					$("#name").parent().parent().hide();
					$("#name").val('');
					$("#column_size").val('');
					$("#case_type").val('');
					$("#case_sub_type").val('');
					$(".form-builder").remove();
					loadTreeDataNew($("#related_module").val());
				}
});



//////// multitab form start from here/////////

  
function changename(e)
{	
	var get_text= $($(e).siblings()[0]).text();
	if(get_text!=="+ tab")
	{
		
	$(e).after( '<input type="text" name="tab_name_changer" id="tab_name_changer" size="20" maxlength="255" placeholder="Personal-info...etc" >' );
	$(e).hide()
	$($(e).siblings()[0]).hide();
	$($(e).siblings()[1]).show();
	$($(e).siblings()[3]).hide();
	console.log($(e).siblings()); 
}
}

function changenamedone(e)
{
	console.log($(e).siblings());
	var get_text= $($(e).siblings()[2]).val();
	//console.log(get_text);
	 $(e).hide()
	 $($(e).siblings()[0]).show();
	 if(get_text!=''){
	 $($(e).siblings()[0]).text(get_text);
	}
	 $($(e).siblings()[1]).show();
	 $($(e).siblings()[3]).show();
	 $($(e).siblings()[2]).remove();	
	 //console.log($(e).siblings()); 
	
}

function loadTreeDataNewmultitabs(module, node){
	//alert('multiabs is working now')
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				console.log(moduleFields);
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				if(moduleFields.hasOwnProperty('phone')){
                    moduleFields.phone[emptyData] = "--None--";
				}else{
					moduleFields['phone']={};
					moduleFields.phone[emptyData] = "--None--";
				}
				initFormBuilderNewmultitabs();
				
			}
	);
}
function initFormBuilderNewmultitabs(){
		$('#tabs').show();
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.text,
		},
	};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};	
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},

	};
	if(moduleFields.phone)
		{
			
			var numberAttributes = {
					shape: {
						label: 'Related Field',
						'class': 'select2',
						options: moduleFields.phone,
					},
				};
			
		}
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
	var fields = [{
  label: "Email",
  type: "text",
  subtype: "email",
  icon: "✉"
}];
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
		if(numberAttributes)
		userAttrs["number"] = numberAttributes;
		var options = {
	  onAddField: function(fieldId) {
		<!-- updateFields(); -->
		
	  },
	  // onAddOption: (optionTemplate, optionIndex) => {
  // },
	  disabledActionButtons: ['data','clear','save'],
	  typeUserAttrs: userAttrs,
	  fields: fields,
	  fieldRemoveWarn: true,
	  onOpenFieldEdit: function(editPanel) {
        $(".select2").select2();
      },
	};
// comment the formbuilder line and add following code

 // formBuild =  $(fbTemplate).formBuilder(options);
  jQuery(($) => {
	"use strict";
	var tab_c_id = 1;
	var $fbtabs = $(document.getElementById("build-wrap"));
	var addtabTab = document.getElementById("add-tab-tab");
	window.fbInstances = [];
  
	$fbtabs.tabs({
	  beforeActivate: function (event, ui) {
		if (ui.newPanel.selector === "#new-tab") {
		  return false;
		}
	  }
	});
	
	addtabTab.addEventListener(
	  "click",
	  (click) => {
		const tabCount = document.getElementById("tabs").children.length;
		const tabId = "tab-" + tab_c_id;
		const $newtabTemplate = document.getElementById("new-tab");
		const $newTabTemplate = document.getElementById("add-tab-tab");
		const $newtab = $newtabTemplate.cloneNode(true);
		$newtab.setAttribute("id", tabId);
		$newtab.classList.add("fb-editor");
		const $newTab = $newTabTemplate.cloneNode(true);
		$newTab.removeAttribute("id");
		const $tabLink = $newTab.querySelector("a");
		$tabLink.setAttribute("href", "#" + tabId);
		$tabLink.innerText = "tab " + tab_c_id;
		$newtabTemplate.parentElement.insertBefore($newtab, $newtabTemplate);
		$newTabTemplate.parentElement.insertBefore($newTab, $newTabTemplate);
		$fbtabs.tabs("refresh");
		$fbtabs.tabs("option", "active", tab_c_id - 1);
		window.fbInstances.push($($newtab).formBuilder(options));
		tab_c_id++;
	  },
	  false
	);
  
	
	
$(document).on("click",".clearbtn",function(){
	window.fbInstances.map((fb) => {
        fb.actions.clearFields();
    });
  });

$(document).on("click",".savebtn",function(){
	var array11 =[];
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	store_data_tabs(get_tabs_data);
  });


  $(document).on("click",".showhtmlbtn",function(){
	var array11 =[];
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	renderForm_multitabs_showbtn(get_tabs_data);
  });

  $(document).on("click",".downloadhtmlbtn",function(){
	var array11 =[];
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	renderForm_multitabs_downloadbtn(get_tabs_data);
  });

 });

  changeShape();
}

function loadTreeDatamultitabs(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'ht_formbuilder',
				'action' : 'getFieldData',
				'ht_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				var emptyData = "";
				moduleFields.enum[emptyData] = "--None--";
				moduleFields.varchar[emptyData] = "--None--";
				moduleFields.text[emptyData] = "--None--";
				moduleFields.datetime[emptyData] = "--None--";
				moduleFields.bool[emptyData] = "--None--";
				console.log(moduleFields);
				if(moduleFields.hasOwnProperty('phone')){
                    moduleFields.phone[emptyData] = "--None--";
				}else{
					moduleFields['phone']={};
					moduleFields.phone[emptyData] = "--None--";
				}
				initFormBuildermultitabs();
			}
	);
}


function initFormBuildermultitabs(){
	$('#tabs').show();
	//alert('in the multbs fetching')
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	var textAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.varchar,
			},
		};
	var selectAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.enum,
			},
		};	
	var textareaAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields.text,
			},
		};	
	var dateAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.datetime,
		},
	};
	var boolAttributes = {
		shape: {
			label: 'Related Field',
			'class': 'select2',
			options: moduleFields.bool,
		},
	};
	if(moduleFields.phone)
		{
			
			var numberAttributes = {
					shape: {
						label: 'Related Field',
						'class': 'select2',
						options: moduleFields.phone,
					},
				};
			
		}
	var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea","Email"];
	var fields = [{
  label: "Email",
  type: "text",
  subtype: "email",
  icon: "✉"
}];		


 // console.log($("#description").html());
  var result_it=$("#description").html();
  var res = jQuery.parseJSON(result_it);
 // console.log(res);
  var stepLen = res.length;
  //console.log(stepLen);
 window.fbInstances = [];
  var option_arr=[];
  for (var s = 0 ; s < stepLen; s++) {
	
		userAttrs["text"] = textAttributes;
		userAttrs["select"] = selectAttributes;
		userAttrs["textarea"] = textareaAttributes;
		userAttrs["date"] = dateAttributes;
		userAttrs["radio-group"] = boolAttributes;
		if(numberAttributes)
		userAttrs["number"] = numberAttributes;
		var options = {
		dataType: 'json',
		formData: res[s],
		typeUserAttrs: userAttrs,
		fields: fields,
		onOpenFieldEdit: function(editPanel) {
			$(".select2").select2();
		},
		disabledActionButtons: ['data','clear','save'],
		fieldRemoveWarn: true,
		actionButtons: [{
    id: 'Create New Condition Logic',
    className: 'btn btn-success',
    label: 'Create New Condition Logic',
    type: 'button',
    style: 'width:100%',
    events: {
    click: function() {
    	$( 'form#logic-form' ).each(function(){
       this.reset();
        })
    	$(".error-message").text("");
      $(".success-message").text("");
      $("#field-value").parent().show(); 
      customlogicpopup();
    }
  }
},
{
  	id: 'View Condition Logic',
    className: 'btn btn-success',
    label: 'View Conditional Logics',
    type: 'button',
    style: 'width:100%',
    events: {
    click: function() {
      viewcustomlogicpopup();
    }
  }
  }]
	};
   option_arr.push(options);
  // console.log(option_arr);
}	

for (var s = 0 ; s < stepLen; s++) {
   // console.log(option_arr);
    var tab_c_id=1;	
    var $fbtabs = $(document.getElementById("build-wrap"));
	var addtabTab = document.getElementById("add-tab-tab");
	if(s==0){
$fbtabs.tabs({
	  beforeActivate: function (event, ui) {
		if (ui.newPanel.selector === "#new-tab") {
		  return false;
		}
	  }
	}); 
	}

	setTimeout(function() {
	  var tabCount = document.getElementById("tabs").children.length;
	  var tabId = "tab-" + tabCount.toString();
	  var $newtabTemplate = document.getElementById("new-tab");
	  var $newTabTemplate = document.getElementById("add-tab-tab");
	  var $newtab = $newtabTemplate.cloneNode(true);
	  $newtab.setAttribute("id", tabId);
	  $newtab.classList.add("fb-editor");
	  var $newTab = $newTabTemplate.cloneNode(true);
	  $newTab.removeAttribute("id");
	  var $tabLink = $newTab.querySelector("a");
	  $tabLink.setAttribute("href", "#" + tabId);
	  $tabLink.innerText = "tab " + tabCount;
	  $newtabTemplate.parentElement.insertBefore($newtab, $newtabTemplate);
	  $newTabTemplate.parentElement.insertBefore($newTab, $newTabTemplate);
	  $fbtabs.tabs("refresh");
	  $fbtabs.tabs("option", "active", tabCount - 1);
	      var n =tabCount-1;
	  window.fbInstances.push($($newtab).formBuilder(option_arr[n]));
	 }, 500 * s );	 	
	window.timer= 500*s;
	}
	setTimeout(function() {
		var tabs_get =$('[id=click_it]');
		var get_names_f=$('#tab_names').val();
		var result_tabs = jQuery.parseJSON(get_names_f);
		 $(tabs_get).each(function(i, obj) {
		 var tab_name=$(obj).text();
		if(tab_name!=="+ tab")	
		{
			$(obj).text(result_tabs[i]);
		}
		 
		});
		const tabCount = document.getElementById("tabs").children.length;
		tab_c_id=tabCount;
		}, window.timer+100 );	

	var options = {
  onAddField: function(fieldId) {
	<!-- updateFields(); -->
	
  },
  // onAddOption: (optionTemplate, optionIndex) => {
// },
  disabledActionButtons: ['data','clear','save'],
  typeUserAttrs: userAttrs,
  fields: fields,
  fieldRemoveWarn: true,
  onOpenFieldEdit: function(editPanel) {
	$(".select2").select2();
  },
};

 
addtabTab.addEventListener(
	"click",
	(click) => {
	  const tabId = "tab-" + tab_c_id;
	  const $newtabTemplate = document.getElementById("new-tab");
	  const $newTabTemplate = document.getElementById("add-tab-tab");
	  const $newtab = $newtabTemplate.cloneNode(true);
	  $newtab.setAttribute("id", tabId);
	  $newtab.classList.add("fb-editor");
	  const $newTab = $newTabTemplate.cloneNode(true);
	  $newTab.removeAttribute("id");
	  const $tabLink = $newTab.querySelector("a");
	  $tabLink.setAttribute("href", "#" + tabId);
	  $tabLink.innerText = "tab " + tab_c_id;
	  $newtabTemplate.parentElement.insertBefore($newtab, $newtabTemplate);
	  $newTabTemplate.parentElement.insertBefore($newTab, $newTabTemplate);
	  $fbtabs.tabs("refresh");
	  $fbtabs.tabs("option", "active", tab_c_id - 1);
	  window.fbInstances.push($($newtab).formBuilder(options));
	  tab_c_id++;
	},
	false
  );



$(document).on("click",".clearbtn",function(){
	window.fbInstances.map((fb) => {
        fb.actions.clearFields();
    });
  });

$(document).on("click",".savebtn",function(){
	var array11 =[];
	console.log(fbInstances)
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	store_data_tabs(get_tabs_data);
  });


  $(document).on("click",".showhtmlbtn",function(){
	var array11 =[];
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	renderForm_multitabs_showbtn(get_tabs_data);
  });

  $(document).on("click",".downloadhtmlbtn",function(){
	var array11 =[];
	window.fbInstances.map((fb) => {
     console.log(fb);
	 var  array1 =JSON.stringify(fb.actions.getData());
	   array11.push(array1);
	 
    });
	console.log(array11);
	var get_tabs_data=JSON.stringify(array11);
	renderForm_multitabs_downloadbtn(get_tabs_data);
  });


	changeShape();
}




$("#SAVE").click(function () {
	var tabs_get =$('[id=click_it]');
	var tab_array= [];
	 $(tabs_get).each(function(i, obj) {
	 	var tab_name=$(obj).text();
	if(tab_name!=="+ tab")	
	{
      tab_array.push(tab_name);
	}
	  get_data_arr= tab_array;
	});
	var  tab_names_arr=JSON.stringify(get_data_arr);
     $('#tab_names').val(tab_names_arr);

});

function store_data_tabs (get_tabs_data){
	if(window.multitab_active==1)
		{
			var hiddenfieldhtml = `<input type="hidden" class="randomID" name="ruuid" id="ruuid" value=""/>`
			$("form#EditView").append(hiddenfieldhtml);
			let record_idd = $("input[name='record']").val();
			if(record_idd){
		
			}
			else{
				if (existingFormId.length > 0) {
				// document.getElementById("ruuid").value = existingFormId;
				$("input[name='record']").val(existingFormId);
			} else {
				$("input[name='record']").val('');
				document.getElementById("ruuid").value = createGuidLocations();
			}
			}
			$("form#EditView #description").html(get_tabs_data);
		
		var _form = document.getElementById('EditView'); 
		_form.action.value='Save';
		if(check_form('EditView'))
		SUGAR.ajaxUI.submitForm(_form);
		return false;
	  //});	
	  }
	}

	function renderForm_multitabs_showbtn(get_tabs_data)
	{	
		var modalhtml = `
		<style>
		.w3-container,.w3-panel{padding:0.01em 16px;background:black;}.w3-panel{margin-top:16px;margin-bottom:16px}
		.w3-modal{z-index:3;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)}
		.w3-modal-content{margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px}
		.w3-btn,.w3-button{border:none;display:inline-block;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:#fff;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap}
		.w3-display-topright{position:absolute;right:0;top:0}
		.w3-button:hover{color:#000!important;background-color:#ccc!important}
		</style>
		<div class="w3-container">
		  <div id="showhtml" class="w3-modal">
			<div class="w3-modal-content">
			  <div class="w3-container">
				<span onclick="document.getElementById('showhtml').style.display='none'" class="w3-button w3-display-topright">&times;</span>
				<textarea style="height:500px;background:black;color:#fff;" class="form-control" id="htmlmodaldiv" name="htmlinnerdiv"></textarea>
			  </div>
			</div>
		  </div>
		</div>`;
			    $("body").append(modalhtml);
				var case_type =$('#case_type').val();
				var search_module=$('#related_module').val();
		   $.ajax({
			   url:"index.php?module=Home&action=getCaseType&sugar_body_only=true",   
			   type: "post",
			   // dataType: 'json',
			   data: {case_type: case_type,search_module:search_module},
			   success:function(result){
				   //console.log(result);
			   var decode =JSON.parse(result);
				 if(decode!="") 
					 {
					 let condition_description = decode.condition_description;
						 if(condition_description){
						 var convert_condition_description = condition_description.replaceAll('&quot;', '"');
						  var decode_data=convert_condition_description; 
						 }				
					 }
					 var html = renderForm_multitabs(decode_data , get_tabs_data);
				$("#htmlmodaldiv").text(html);
				document.getElementById('showhtml').style.display='block';	
			   }
			
		   
		   });
	}

	
function renderForm_multitabs(decode_data , get_tabs_data)
{		
	
	var testid = $("input[name='record']").val();
	var column_size = $("#column_size").val();
	var site_url = window.location.protocol+window.location.hostname+window.location.pathname;
	$markup = $("<div/>");
	var filename = "code.html";
	let html = `<!DOCTYPE html>
	<html>
	<head>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<title>HTML</title>
		<style>
		input.formEntryPointButton
		{
			margin:auto;
			display:block;
		}
		body {
			font-family: Arial;
			background-color: rgb(245, 243, 248)
		}
		/* Style the tab */
		.tab {
		  overflow: hidden;	
		}
		
		/* Style the buttons inside the tab */
		.tablinks {	
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			transition: 0.3s;
			font-size: 17px;
			padding: 15px 15px;
			font-size: 13px;
			background-color: #ddd;
			color: #111;
			cursor: pointer;
			margin: 0 2px 0 2px;
			border-color: #eee #eee #fff;
			border-radius: 7px 7px 0px 0px;	
		}
		
		/* Change background color of buttons on hover */
		.tablinks:hover {
		  background-color: #756e6e;
		  text-decoration: none;
		}
		
		/* Create an active/current tablink class */
		.tablinks.active {
		  background-color: white;
		}
		
		/* Style the tab content */
		.tabcontent {
		  display: none;
		  padding: 6px 20px;
		  border-top: none;
		  background-color: white;
		}
		.custom_container {
			padding: 50px;
		}	
		</style>
	</head>
	<body>
	<div class="custom_container">
	<form action="${site_url}?entryPoint=FormDataEntryPoint&id=${testid}" name="HtmlForm" id="htform" method="post">
	<input type = "hidden" name="epformbuilder" id="epformbuilder" value="${testid}"/>
	<textarea  name="decode_data" id="decode_data" style="display:none;" >${decode_data}</textarea>
	<div class="tab">`;

	console.log(get_tabs_data);
	var got_data = jQuery.parseJSON(get_tabs_data);
	var tabs_get =$('[id=click_it]');
			var tab_array= [];
			$(tabs_get).each(function(i, obj) {
				var tab_name=$(obj).text();
			if(tab_name!=="+ tab")	
			{
			tab_array.push(tab_name);
			}
			window.get_data_arr= tab_array;
			});
		 var tab_names_arr=window.get_data_arr;
			var for_one_itr=tab_names_arr.length;
		   for(var h=0; h<tab_names_arr.length; h++)
		   {

	$markup.formRender({formData: got_data[h] });	
	let description_html_value = $markup.formRender("html");
	if(h==0)
	{ 
		for(var J=0; J<tab_names_arr.length; J++)
		   {
		html+=`<a class="tablinks ${J === 0 ? 'active' : ''}" onclick="openCity(event, '${tab_names_arr[J]}')">${tab_names_arr[J]}</a>`;
		   }
	}
		if(h==0)
		{   
	html+=`</div>`;
		}
	html+=`
	<div id="${tab_names_arr[h]}" class="tabcontent"   ${h === 0 ? 'style="display:block;" ': ''}" >
	<h3>${tab_names_arr[h]}</h3>
	${description_html_value}
	</div>`;	   
		}	
	html+=`<br><br><input class="formEntryPointButton" type = "submit" name ="htformsubmit" value="Submit" >
	</form>
	</div>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$(".rendered-form").addClass("container");
	if("${column_size}")
	{
		$(".form-group").addClass("${column_size}");
	}
	else
	{
	$(".form-group").addClass("col-lg-6");
	}

	function openCity(evt, cityName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
		  tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " active";	
	  }

$(document).ready(function () {

			 var decode_data = $('#decode_data').val();
			  var decode2 = JSON.parse(decode_data);				
			  if(decode2)
			  {
			  decode2.forEach(checkCondition);
			   console.log(decode2);

			  }

			  function checkCondition(item, index)
			  {
				  switch (item.State)
				  {
					  case 'isEmpty':
					  {
						  if(item.Do == 'hide')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
									  if($("#"+item.IF).val().length==0)
									  {
										  // $("input[name="+item.Field+"]").parent().hide();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
									  }
									  else{
											  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
									  }		
							  }
							  else
							  {
								  // $("#"+item.Field).parent().hide();
								  // $("input[name="+item.Field+"]").parent().hide();
								  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
							  }
						  }
						  else if(item.Do == 'show')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
									  if($("#"+item.IF).val().length>0)
									  {
										  // $("#"+item.Field).parent().show();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
									  }
									  else{
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
									  }	
							  }
							  else
							  {
								  // $("#"+item.Field).parent().show();
								  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
							  }
						  }
						  else if(item.Do == 'hide-multiple')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  // $("#"+item.IF).on("keyup",function(){
									  if($("#"+item.IF).val().length==0)
									  {
										  
										  let explodebrk = item.Field.split(',');
							  explodebrk.forEach((field)=>{
								  console.log(field);
								  // $("#"+field).parent().hide();
								  
								  if($("input[name="+field+"]").attr("type")=='radio' )
							  {
								  $("input[name="+field+"]").parent().parent().parent().hide();
							  }
							  
							  else{
								  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
								  $("input[name='"+field+"[]']").parent().parent().parent().hide();
							  }
							  else{
								  $("input[name="+field+"],select[name="+field+"]").parent().hide();
							  }
							  }
							  })
									  }
									  else
									  {
											  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
												  if($("input[name="+field+"]").attr("type")=='radio')
											  {
												  $("input[name="+field+"]").parent().parent().parent().show();
											  }
											  else{
												  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
												  $("input[name="+field+"],select[name="+field+"]").parent().show();
											  }
										  }
											  })
									  }
								  // })		
							  }
							  
						  }
						  else if(item.Do == 'show-multiple')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  // $("#"+item.IF).on("keyup",function(){
									  if($("#"+item.IF).val().length>0)
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
											  if($("input[name="+field+"]").attr("type")=='radio')
										  {
											  $("input[name="+field+"]").parent().parent().parent().show();
										  }
										  else{
											  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
											  $("input[name="+field+"],select[name="+field+"]").parent().show();
										  }
									  }
										  })
									  }
									  else
									  {
											  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
												  if($("input[name="+field+"]").attr("type")=='radio')
											  {
												  $("input[name="+field+"]").parent().parent().parent().hide();
											  }
											  else{
												  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().hide();
											  }
											  else{
												  $("input[name="+field+"],select[name="+field+"]").parent().hide();
											  }
										  }
											  })
									  }
								  // })		
							  }
							  
						  }
					  }
					  break;
					  case 'isEqualTo':
					  {
								  // console.log(item.IF);
							  $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
								  var currentValue = $(this).val();
								  var value = item.Value;
								  // console.log(value);
							  if(currentValue == value)
							  {
								  // if(item.Id == index )
								  // {
									  // $("#"+item.Field).parent().show();
									  if(item.Do == 'hide')
									  {
										  // $("#"+item.Field).parent().hide();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
									  }
									  else if(item.Do == 'show')
									  {
										  // $("#"+item.Field).parent().show();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
								  }
									  else if(item.Do == 'hide-multiple')
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
											  // $("#"+field).parent().hide();
											  if($("input[name="+field+"]").attr("type")=='radio')
												  {
													  $("input[name="+field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+field+"],select[name="+field+"]").parent().hide();
												  }
											  }
										  })
										  
									  }
									  else if(item.Do == 'show-multiple')
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
											  // $("#"+field).parent().show();
											  if($("input[name="+field+"]").attr("type")=='radio')
												  {
													  $("input[name="+field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+field+"],select[name="+field+"]").parent().show();
												  }
											  }
										  })
										  
									  }
								  // }
							  }
							  
						  })
					  }
					  break;
					  case 'isNotEqualTo':
					  {
								  // console.log(item.IF);
							  $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
								  var currentValue = $(this).val();
								  var value = item.Value;
								  // console.log(value);
							  if(currentValue != value)
							  {
								  // if(item.Id == index )
								  // {
									  // $("#"+item.Field).parent().show();
									  if(item.Do == 'hide')
									  {
										  // $("#"+item.Field).parent().hide();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
									  }
									  else if(item.Do == 'show')
									  {
										  // $("#"+item.Field).parent().show();
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
								  }
									  else if(item.Do == 'hide-multiple')
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
											  // $("#"+field).parent().hide();
											  if($("input[name="+field+"]").attr("type")=='radio')
												  {
													  $("input[name="+field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+field+"],select[name="+field+"]").parent().hide();
												  }
											  }
										  })
										  
									  }
									  else if(item.Do == 'show-multiple')
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
											  // $("#"+field).parent().show();
											  if($("input[name="+field+"]").attr("type")=='radio')
												  {
													  $("input[name="+field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+field+"],select[name="+field+"]").parent().show();
												  }
											  }
										  })
										  
									  }
								  // }
							  }
							  
						  })
					  }
					  break;
					  case 'isFilled':
					  {
						  if(item.Do == 'hide')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  $("#"+item.IF).on("keyup",function(){
			  
									  if($("#"+item.IF).val().length==0)
									  {
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
										  // $("#"+item.Field).parent().hide();
									  }
									  else{
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
									  }
										  
								  })		
							  }	
									  }
						  // }
						  else if(item.Do == 'show')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  $("#"+item.IF).on("keyup",function(){
									  if($("#"+item.IF).val().length>0)
									  {
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().show();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().show();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
												  }
											  }
										  // $("#"+item.Field).parent().show();
									  }
									  else{
										  if($("input[name="+item.Field+"]").attr("type")=='radio')
												  {
													  $("input[name="+item.Field+"]").parent().parent().parent().hide();
												  }
												  else{
													  if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
											  }
											  else{
													  $("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
												  }
											  }
									  }
								  })		
							  }
						  }
						  else if(item.Do == 'show-multiple')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  $("#"+item.IF).on("keyup",function(){
									  if($("#"+item.IF).val().length>0)
									  {
										  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
											  if($("input[name="+field+"]").attr("type")=='radio')
										  {
											  $("input[name="+field+"]").parent().parent().parent().show();
										  }
										  else{
											  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
											  $("input[name="+field+"],select[name="+field+"]").parent().show();
										  }
									  }
										  })
									  }
									  else
									  {
											  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
												  if($("input[name="+field+"]").attr("type")=='radio')
											  {
												  $("input[name="+field+"]").parent().parent().parent().hide();
											  }
											  else{
												  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().hide();
											  }
											  else{
												  $("input[name="+field+"],select[name="+field+"]").parent().hide();
											  }
										  }
											  })
									  }
								  })		
							  }
						  }
						  else if(item.Do == 'hide-multiple')
						  {
							  if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
							  {
								  $("#"+item.IF).on("keyup",function(){
									  if($("#"+item.IF).val().length==0)
									  {
										  
										  let explodebrk = item.Field.split(',');
							  explodebrk.forEach((field)=>{
								  console.log(field);
								  // $("#"+field).parent().hide();
								  
								  if($("input[name="+field+"]").attr("type")=='radio')
							  {
								  $("input[name="+field+"]").parent().parent().parent().hide();
							  }
							  else{
								  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().hide();
											  }
											  else{
								  $("input[name="+field+"],select[name="+field+"]").parent().hide();
							  }
						  }
							  })
									  }
									  else
									  {
											  let explodebrk = item.Field.split(',');
										  explodebrk.forEach((field)=>{
										  console.log(field);
										  // $("#"+field).parent().hide();
								  
												  if($("input[name="+field+"]").attr("type")=='radio')
											  {
												  $("input[name="+field+"]").parent().parent().parent().show();
											  }
											  else{
												  if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
												  $("input[name='"+field+"[]']").parent().parent().parent().show();
											  }
											  else{
												  $("input[name="+field+"],select[name="+field+"]").parent().show();
											  }
										  }
											  })
									  }
								  })		
							  }
						  }
					  }
					  break;
				  }
			  }

});
	 
</script>

</html>`;
		   return html;
}

function renderForm_multitabs_downloadbtn(get_tabs_data)
   {		
		 var case_type =$('#case_type').val();
		 var search_module=$('#related_module').val();
	$.ajax({
		url:"index.php?module=Home&action=getCaseType&sugar_body_only=true",   
		type: "post",
		// dataType: 'json',
		data: {case_type: case_type,search_module:search_module},
		success:function(result){
			//console.log(result);
		var decode =JSON.parse(result);
		  if(decode!="") 
			  {
			  let condition_description = decode.condition_description;
				  if(condition_description){
				  var convert_condition_description = condition_description.replaceAll('&quot;', '"');
				   var decode_data=convert_condition_description; 
				  }				
			  }
			downloadformwithcondtions(decode_data , get_tabs_data)
		}
	 
	
	});
}

function downloadformwithcondtions(decode_data , get_tabs_data)
{		

		var testid = $("input[name='record']").val();
		var column_size = $("#column_size").val();
		var site_url = window.location.protocol+window.location.hostname+window.location.pathname;
		$markup = $("<div/>");
		var filename = "code.html";
		let html = `<!DOCTYPE html>
		<html>
		<head>
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<title>HTML</title>
			<style>
			input.formEntryPointButton
			{
				margin:auto;
				display:block;
			}
			body {
				font-family: Arial;
				background-color: rgb(245, 243, 248)
			}
			/* Style the tab */
			.tab {
			  overflow: hidden;	
			}
			
			/* Style the buttons inside the tab */
			.tablinks {	
				float: left;
				border: none;
				outline: none;
				cursor: pointer;
				transition: 0.3s;
				font-size: 17px;
				padding: 15px 15px;
				font-size: 13px;
				background-color: #ddd;
				color: #111;
				cursor: pointer;
				margin: 0 2px 0 2px;
				border-color: #eee #eee #fff;
				border-radius: 7px 7px 0px 0px;	
			}
			
			/* Change background color of buttons on hover */
			.tablinks:hover {
			  background-color: #756e6e;
			  text-decoration: none;
			}
			
			/* Create an active/current tablink class */
			.tablinks.active {
			  background-color: white;
			}
			
			/* Style the tab content */
			.tabcontent {
			  display: none;
			  padding: 6px 20px;
			  border-top: none;
			  background-color: white;
			}
			.custom_container {
				padding: 50px;
			}	
			</style>
		</head>
		<body>
		<div class="custom_container">
		<form action="${site_url}?entryPoint=FormDataEntryPoint&id=${testid}" name="HtmlForm" id="htform" method="post">
		<input type = "hidden" name="epformbuilder" id="epformbuilder" value="${testid}"/>
		<textarea  name="decode_data" id="decode_data" style="display:none;" >${decode_data}</textarea>
		<div class="tab">`;

		console.log(get_tabs_data);
		var got_data = jQuery.parseJSON(get_tabs_data);
		var tabs_get =$('[id=click_it]');
				var tab_array= [];
				$(tabs_get).each(function(i, obj) {
					var tab_name=$(obj).text();
				if(tab_name!=="+ tab")	
				{
				tab_array.push(tab_name);
				}
				window.get_data_arr= tab_array;
				});
			 var tab_names_arr=window.get_data_arr;
			    var for_one_itr=tab_names_arr.length;
			   for(var h=0; h<tab_names_arr.length; h++)
			   {

		$markup.formRender({formData: got_data[h] });	
		let description_html_value = $markup.formRender("html");
		if(h==0)
		{ 
			for(var J=0; J<tab_names_arr.length; J++)
			   {
			html+=`<a class="tablinks ${J === 0 ? 'active' : ''}" onclick="openCity(event, '${tab_names_arr[J]}')">${tab_names_arr[J]}</a>`;
			   }
		}
			if(h==0)
			{   
		html+=`</div>`;
	        }
		html+=`
		<div id="${tab_names_arr[h]}" class="tabcontent"   ${h === 0 ? 'style="display:block;" ': ''}" >
		<h3>${tab_names_arr[h]}</h3>
		${description_html_value}
		</div>`;	   
			}	
		html+=`<br><br><input class="formEntryPointButton" type = "submit" name ="htformsubmit" value="Submit" >
		</form>
		</div>
		</body>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
	<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		$(".rendered-form").addClass("container");
		if("${column_size}")
		{
			$(".form-group").addClass("${column_size}");
		}
		else
		{
		$(".form-group").addClass("col-lg-6");
		}

		function openCity(evt, cityName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
			  tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
			  tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";	
		  }

 $(document).ready(function () {

		         var decode_data = $('#decode_data').val();
				  var decode2 = JSON.parse(decode_data);				
				  if(decode2)
				  {
				  decode2.forEach(checkCondition);
				   console.log(decode2);

				  }

				  function checkCondition(item, index)
{
	switch (item.State)
	{
		case 'isEmpty':
		{
			if(item.Do == 'hide')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
						if($("#"+item.IF).val().length==0)
						{
							// $("input[name="+item.Field+"]").parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else{
								if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}		
			    }
			    else
			    {
			    	// $("#"+item.Field).parent().hide();
			    	// $("input[name="+item.Field+"]").parent().hide();
			    	if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
			    }
			}
			else if(item.Do == 'show')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
						if($("#"+item.IF).val().length>0)
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}	
			    }
			    else
			    {
					// $("#"+item.Field).parent().show();
			    	if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				}
			}
			else if(item.Do == 'hide-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					// $("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length==0)
						{
							
							let explodebrk = item.Field.split(',');
				explodebrk.forEach((field)=>{
					console.log(field);
					// $("#"+field).parent().hide();
					
					if($("input[name="+field+"]").attr("type")=='radio' )
				{
					$("input[name="+field+"]").parent().parent().parent().hide();
				}
				
				else{
					if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
					$("input[name='"+field+"[]']").parent().parent().parent().hide();
				}
				else{
					$("input[name="+field+"],select[name="+field+"]").parent().hide();
				}
				}
				})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().show();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().show();
								}
							}
								})
						}
					// })		
			    }
				
			}
			else if(item.Do == 'show-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					// $("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
								if($("input[name="+field+"]").attr("type")=='radio')
							{
								$("input[name="+field+"]").parent().parent().parent().show();
							}
							else{
								if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
								$("input[name="+field+"],select[name="+field+"]").parent().show();
							}
						}
							})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().hide();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().hide();
								}
							}
								})
						}
					// })		
			    }
				
			}
		}
		break;
		case 'isEqualTo':
		{
					// console.log(item.IF);
			    $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
			    	var currentValue = $(this).val();
			    	var value = item.Value;
			    	// console.log(value);
				if(currentValue == value)
				{
					// if(item.Id == index )
					// {
						// $("#"+item.Field).parent().show();
						if(item.Do == 'hide')
						{
							// $("#"+item.Field).parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else if(item.Do == 'show')
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				    }
				    	else if(item.Do == 'hide-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().hide();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().hide();
									}
								}
							})
							
						}
						else if(item.Do == 'show-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().show();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().show();
									}
								}
							})
							
						}
				    // }
				}
				
			})
		}
		break;
		case 'isNotEqualTo':
		{
					// console.log(item.IF);
			    $("input[name="+item.IF+"],select[name="+item.IF+"],input[type='checkbox']").on('change',function(){
			    	var currentValue = $(this).val();
			    	var value = item.Value;
			    	// console.log(value);
				if(currentValue != value)
				{
					// if(item.Id == index )
					// {
						// $("#"+item.Field).parent().show();
						if(item.Do == 'hide')
						{
							// $("#"+item.Field).parent().hide();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
						else if(item.Do == 'show')
						{
							// $("#"+item.Field).parent().show();
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
				    }
				    	else if(item.Do == 'hide-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().hide();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().hide();
									}
								}
							})
							
						}
						else if(item.Do == 'show-multiple')
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
								// $("#"+field).parent().show();
								if($("input[name="+field+"]").attr("type")=='radio')
									{
										$("input[name="+field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+field+"],select[name="+field+"]").parent().show();
									}
								}
							})
							
						}
				    // }
				}
				
			})
		}
		break;
		case 'isFilled':
		{
			if(item.Do == 'hide')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){

						if($("#"+item.IF).val().length==0)
						{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
							// $("#"+item.Field).parent().hide();
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
						}
							
					})		
			    }	
						}
			// }
			else if(item.Do == 'show')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().show();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().show();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().show();
									}
								}
							// $("#"+item.Field).parent().show();
						}
						else{
							if($("input[name="+item.Field+"]").attr("type")=='radio')
									{
										$("input[name="+item.Field+"]").parent().parent().parent().hide();
									}
									else{
										if($("input[name='"+item.Field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+item.Field+"[]']").parent().parent().parent().hide();
								}
								else{
										$("input[name="+item.Field+"],select[name="+item.Field+"]").parent().hide();
									}
								}
						}
					})		
			    }
			}
			else if(item.Do == 'show-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length>0)
						{
							let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
								if($("input[name="+field+"]").attr("type")=='radio')
							{
								$("input[name="+field+"]").parent().parent().parent().show();
							}
							else{
								if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
								$("input[name="+field+"],select[name="+field+"]").parent().show();
							}
						}
							})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().hide();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().hide();
								}
							}
								})
						}
					})		
			    }
			}
			else if(item.Do == 'hide-multiple')
			{
				if($("#"+item.IF).attr("type")=='text' || $("#"+item.IF).attr("type")=='textarea')
				{
					$("#"+item.IF).on("keyup",function(){
						if($("#"+item.IF).val().length==0)
						{
							
							let explodebrk = item.Field.split(',');
				explodebrk.forEach((field)=>{
					console.log(field);
					// $("#"+field).parent().hide();
					
					if($("input[name="+field+"]").attr("type")=='radio')
				{
					$("input[name="+field+"]").parent().parent().parent().hide();
				}
				else{
					if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().hide();
								}
								else{
					$("input[name="+field+"],select[name="+field+"]").parent().hide();
				}
			}
				})
						}
						else
						{
								let explodebrk = item.Field.split(',');
							explodebrk.forEach((field)=>{
							console.log(field);
							// $("#"+field).parent().hide();
					
									if($("input[name="+field+"]").attr("type")=='radio')
								{
									$("input[name="+field+"]").parent().parent().parent().show();
								}
								else{
									if($("input[name='"+field+"[]'").attr('type') == 'checkbox'){
									$("input[name='"+field+"[]']").parent().parent().parent().show();
								}
								else{
									$("input[name="+field+"],select[name="+field+"]").parent().show();
								}
							}
								})
						}
					})		
			    }
			}
		}
		break;
	}
}

});
		 
	</script>
	
	</html>`;
	
	download(filename, html);
}

function close_t(e)
{	
	var href_tab =$($(e).siblings()[0]).prop("href");
	 var got_t_name = href_tab.split("#");
	 if(got_t_name[1] != "new-tab"){
	if (confirm("Are you sure you want to proceed?")) {	 
	  $('#'+got_t_name[1]+'').remove();
	  $(e).parent().remove();
	  var tab_no = got_t_name[1].split("-");
		var tab_index= tab_no[1]-1;
		console.log(window.fbInstances);
		window.fbInstances.splice(tab_index , 1);
		console.log(window.fbInstances);
	}

}
}