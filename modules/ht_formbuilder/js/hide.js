
$(window).load(function() {
$('#tab_names').parent().parent().hide();
loadTreeData($("#related_module").val());
rel_module_old = document.getElementById("related_module").value;
if(rel_module_old == 'Cases')
	{
		$("#case_type").parent().parent().show();
	}
	else
	{
		$("#case_type").parent().parent().hide();
	}
});
function loadTreeData(module, node){
	var _node = node;
	$.getJSON('index.php',
			{
				'module' : 'AOR_Reports',
				'action' : 'getModuleFields',
				'aor_module' : module,
				'view' : 'JSON'
			},
			function(relData){
				moduleFields = relData;
				initFormBuilder();
			}
	);
}

function initFormBuilder(){
	if($('#use_tabs').is(":checked")) 
			{ var use_tabs=1;} else{ use_tabs=0;}
		if(use_tabs==0)
		{
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var newAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields,
			},
		};
	/* var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
	fields.forEach(function (item, index) {
		userAttrs[item] = newAttributes;
	}); */
	var options = {
		dataType: 'json',
      formData: $("#description").html(),
	  disabledActionButtons: ['data','clear','save'],
	   disableFields: ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea", "button","file","header","hidden","paragraph"],
	    disabledFieldButtons: {
	    text: ['remove','edit','copy'], 
	    select: ['remove','edit','copy'],
	    textarea: ['remove','edit','copy'],
	    autocomplete: ['remove','edit','copy'], 
	    'checkbox-group': ['remove','edit','copy'],
	    date: ['remove','edit','copy'],
	    number: ['remove','edit','copy'], 
	    'radio-group': ['remove','edit','copy'],
	    button: ['remove','edit','copy'],
	    file: ['remove','edit','copy'], 
	    header: ['remove','edit','copy'],
	    hidden: ['remove','edit','copy'],
	    paragraph: ['remove','edit','copy'],
	  },
    };
	console.log(options);
  formBuild =  $(fbTemplate).formBuilder(options);
 /*  var formData = '[{"type":"text","label":"Full Name","subtype":"text","className":"form-control","name":"text-1476748004559"},{"type":"select","label":"Occupation","className":"form-control","name":"select-1476748006618","values":[{"label":"Street Sweeper","value":"option-1","selected":true},{"label":"Moth Man","value":"option-2"},{"label":"Chemist","value":"option-3"}]},{"type":"textarea","label":"Short Bio","rows":"5","className":"form-control","name":"textarea-1476748007461"}]';
  formBuild.actions.setData(formData); */
}
else{

	$("#build-wrap").append('<ul id="tabs"><li><a  id="click_it" href="#tab-1">tab 1</a></li><li id="add-tab-tab"><a  id="click_it" href="#new-tab" >+ tab</a></li></ul><div id="tab-1" class="fb-editor"></div><div id="new-tab"></div>')
	$("div[data-label='LBL_DESCRIPTION']").html('');
	$("div[field='description']").attr("class", "col-xs-12 col-sm-12 edit-view-field ");
	const fbTemplate = document.getElementById('build-wrap');
	// New attribute for specified fields 'fields' below
	var newAttributes = {
			shape: {
				label: 'Related Field',
				'class': 'select2',
				options: moduleFields,
			},
		};
	/* var userAttrs = {};
	var fields = ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea"];
	fields.forEach(function (item, index) {
		userAttrs[item] = newAttributes;
	}); */	
	var result_it=$("#description").html();
	var res = jQuery.parseJSON(result_it);
	console.log(res);
	var stepLen = res.length;
	console.log(stepLen);
	for (var s = 0; s < stepLen; s++) {
	var options = {
		dataType: 'json',
      formData: res[s],
	  disabledActionButtons: ['data','clear','save'],
	   disableFields: ["autocomplete", "checkbox-group", "date", "number", "radio-group", "select", "text", "textarea", "button","file","header","hidden","paragraph"],
	    disabledFieldButtons: {
	    text: ['remove','edit','copy'], 
	    select: ['remove','edit','copy'],
	    textarea: ['remove','edit','copy'],
	    autocomplete: ['remove','edit','copy'], 
	    'checkbox-group': ['remove','edit','copy'],
	    date: ['remove','edit','copy'],
	    number: ['remove','edit','copy'], 
	    'radio-group': ['remove','edit','copy'],
	    button: ['remove','edit','copy'],
	    file: ['remove','edit','copy'], 
	    header: ['remove','edit','copy'],
	    hidden: ['remove','edit','copy'],
	    paragraph: ['remove','edit','copy'],
	  },
    };
	
	var $fbtabs = $(document.getElementById("build-wrap"));
	var addtabTab = document.getElementById("add-tab-tab");
	var fbInstances = [];
  
	$fbtabs.tabs({
	  beforeActivate: function (event, ui) {
		if (ui.newPanel.selector === "#new-tab") {
		  return false;
		}
	  }
	});
	      if (s!=0) {
		const tabCount = document.getElementById("tabs").children.length;
		const tabId = "tab-" + tabCount.toString();
		const $newtabTemplate = document.getElementById("new-tab");
		const $newTabTemplate = document.getElementById("add-tab-tab");
		const $newtab = $newtabTemplate.cloneNode(true);
		$newtab.setAttribute("id", tabId);
		$newtab.classList.add("fb-editor");
		const $newTab = $newTabTemplate.cloneNode(true);
		$newTab.removeAttribute("id");
		const $tabLink = $newTab.querySelector("a");
		$tabLink.setAttribute("href", "#" + tabId);
		$tabLink.innerText = "tab " + tabCount;
		$newtabTemplate.parentElement.insertBefore($newtab, $newtabTemplate);
		$newTabTemplate.parentElement.insertBefore($newTab, $newTabTemplate);
		$fbtabs.tabs("refresh");
		$fbtabs.tabs("option", "active", tabCount - 1);
		fbInstances.push($($newtab).formBuilder(options));
		
	  }
	   if(s==0){
	  fbInstances.push($(".fb-editor").formBuilder(options));
	   }
	//formBuild =  $(fbTemplate).formBuilder(options);

		}	

		var tabs_get =$('[id=click_it]');
		var get_names_f=$('#tab_names').text();
		var result_tabs = jQuery.parseJSON(get_names_f);
		$(tabs_get).each(function(i, obj) {
		var tab_name=$(obj).text();
		if(tab_name!=="+ tab")	
		{
			$(obj).text(result_tabs[i]);
		}
	});
}
}

