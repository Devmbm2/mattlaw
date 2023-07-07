{literal}
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
		padding: 7px 15px;
		font-size: 13px;
		background-color: rgb(247, 235, 235);
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
	  background-color: #c7c4c4;
	  font-size: 20px;
	  font-style: bold;
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
{/literal}
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
<form action = "" name="caseintakeform" id="caseintakeform" method="post">
<h1>Create New Intake</h1>
<div><label for = "casetypeoptions">Case Type:</label>
<input type="hidden" id="search_module" value="{$search_module}">
<select name = "casetype" id="casetype">{$intakeform_type_list}</select>
</div>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td  scope="row" width="100">
		<div id="statediv" style = "display:none;"><label for = "stateoptions">Did this accident happens in Florida?</label>
            <select name = "state" id="state">{$states_list}</select>
            </div>
			<div class="tab" id="tab"></div>
            <div id = "intakeformdiv"> </div>
		</td>
	 </tr>
</table>
<br>
<div id = "case-type-heading-div"><h1 id = "case-type-heading-text"></h1></div>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td  scope="row" width="100">
		<div class="tab_spe" id="tab_spe"></div>
            <div id = "specificformdiv" style = "display:none;"></div>
		</td>
	 </tr>
</table>
<br>
<input type = "button" name="savecaseForm" id="savecaseForm" value = "Save"/>
<input type = "button" name="resetcaseForm" id=resetcaseForm" value = "Cancel"/>
</form>
{literal}
	<script>
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
	</script>
{/literal}
{sugar_getscript file="custom/modules/Home/js/intakeform.js"}
{sugar_getscript file="modules/ht_formbuilder/ht_formbuilder_utils.js"}
{sugar_getscript file="modules/ht_formbuilder/js/sweetAlert.js"}