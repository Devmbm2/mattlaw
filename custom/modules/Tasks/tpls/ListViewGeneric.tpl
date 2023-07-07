{*
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2016 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */
*}
{include file='include/ListView/ListViewColumnsFilterDialog.tpl'}
<script type='text/javascript' src='{sugar_getjspath file='include/javascript/popup_helper.js'}'></script>
<script type='text/javascript' src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>
<link href='custom/include/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'/>
<link href='custom/include/select2/css/select2.css' rel='stylesheet' type='text/css'/>




<script>
{literal}
	$(document).ready(function(){
	    $("ul.clickMenu").each(function(index, node){
	  		$(node).sugarActionMenu();
	  	});

        $('.selectActionsDisabled').children().each(function(index) {
            $(this).attr('onclick','').unbind('click');
        });

        var selectedTopValue = $("#selectCountTop").attr("value");
        if(typeof(selectedTopValue) != "undefined" && selectedTopValue != "0"){
        	sugarListView.prototype.toggleSelected();
        }
	});
{/literal}
</script>
{assign var="currentModule" value = $pageData.bean.moduleDir}
{assign var="singularModule" value = $moduleListSingular.$currentModule}
{assign var="moduleName" value = $moduleList.$currentModule}
{assign var="hideTable" value=false}

{if count($data) == 0}
	{assign var="hideTable" value=true}
	<div class="list view listViewEmpty">
        {if $showFilterIcon}
			<div class="filterContainer">
                {include file='include/ListView/ListViewSearchLink.tpl'}
			</div>
        {/if}
		{if $displayEmptyDataMesssages}
        {if strlen($query) == 0}
                {capture assign="createLink"}<a href="?module={$pageData.bean.moduleDir}&action=EditView&return_module={$pageData.bean.moduleDir}&return_action=DetailView">{$APP.LBL_CREATE_BUTTON_LABEL}</a>{/capture}
                {capture assign="importLink"}<a href="?module=Import&action=Step1&import_module={$pageData.bean.moduleDir}&return_module={$pageData.bean.moduleDir}&return_action=index">{$APP.LBL_IMPORT}</a>{/capture}
                {capture assign="helpLink"}<a target="_blank" href='?module=Administration&action=SupportPortal&view=documentation&version={$sugar_info.sugar_version}&edition={$sugar_info.sugar_flavor}&lang=&help_module={$currentModule}&help_action=&key='>{$APP.LBL_CLICK_HERE}</a>{/capture}
                <p class="msg">
                    {$APP.MSG_EMPTY_LIST_VIEW_NO_RESULTS|replace:"<item2>":$createLink|replace:"<item3>":$importLink}
                </p>
        {elseif $query == "-advanced_search"}
            <p class="msg emptyResults">
                {$APP.MSG_LIST_VIEW_NO_RESULTS_CHANGE_CRITERIA}
            </p>
        {else}
            <p class="msg">
                {capture assign="quotedQuery"}"{$query}"{/capture}
                {$APP.MSG_LIST_VIEW_NO_RESULTS|replace:"<item1>":$quotedQuery}
            </p>
            <p class="submsg">
                <a href="?module={$pageData.bean.moduleDir}&action=EditView&return_module={$pageData.bean.moduleDir}&return_action=DetailView">
                    {$APP.MSG_LIST_VIEW_NO_RESULTS_SUBMSG|replace:"<item1>":$quotedQuery|replace:"<item2>":$singularModule}
                </a>
            </p>
        {/if}
    {else}
        <p class="msg">
            {$APP.LBL_NO_DATA}
        </p>
	{/if}
	</div>
{/if}
{$multiSelectData}
{if $hideTable == false}
	<div class="list-view-rounded-corners">
		<table id = "tab_cases" cellpadding='0' cellspacing='0' border='0' class='list view table-responsive'>
		<input type="text" name="search_task" id="search_tasks" class="form-control" placeholder="Search Task by Subject, Status">
	<thead>
		{assign var="link_select_id" value="selectLinkTop"}
		{assign var="link_action_id" value="actionLinkTop"}
		{assign var="actionsLink" value=$actionsLinkTop}
		{assign var="selectLink" value=$selectLinkTop}
		{assign var="action_menu_location" value="top"}

		<tr height='20'>
			{if $prerow}
				<th class="td_alt">&nbsp;</th>
			{/if}
			{if !empty($quickViewLinks)}
				<th class='td_alt quick_view_links'>&nbsp;</th>
			{/if}
			{counter start=0 name="colCounter" print=false assign="colCounter"}
            {assign var='datahide' value="xs sm"}
			{foreach from=$displayColumns key=colHeader item=params}
                {if $colCounter == '3'}{assign var='datahide' value="xs sm"}{/if}
                {if $colCounter == '5'}{assign var='datahide' value="md"}{/if}

				{if $colCounter == '0'}
					{assign var='hide' value=""}
				{elseif $colHeader  == 'NAME' }
					{assign var='hide' value=""}
				{elseif $colCounter  > '10' }
					{assign var='hide' value="hidden-xs hidden-sm hidden-md"}
				{elseif $colCounter > '4' }
					{assign var='hide' value="hidden-xs hidden-sm"}
				{elseif $colCounter > '0' }
					{assign var='hide' value="hidden-xs"}
				{else}
					{assign var='hide' value=""}
				{/if}
                {if $colHeader == 'NAME' || $params.bold}
					<th scope='col' data-toggle="true" class="{$hide}">
				{else}
					<th scope='col' data-breakpoints="{$datahide}" class="{$hide}">
				{/if}
						<div>
						{if $params.sortable|default:true}
							{if $params.url_sort}
								<a href='{$pageData.urls.orderBy}{$params.orderBy|default:$colHeader|lower}' class='listViewThLinkS1'>
							{else}
								{if $params.orderBy|default:$colHeader|lower == $pageData.ordering.orderBy}
									<a href='javascript:sListView.order_checks("{$pageData.ordering.sortOrder|default:ASCerror}", "{$params.orderBy|default:$colHeader|lower}" , "{$pageData.bean.moduleDir}{"2_"}{$pageData.bean.objectName|upper}{"_ORDER_BY"}")' class='listViewThLinkS1'>
								{else}
									<a href='javascript:sListView.order_checks("ASC", "{$params.orderBy|default:$colHeader|lower}" , "{$pageData.bean.moduleDir}{"2_"}{$pageData.bean.objectName|upper}{"_ORDER_BY"}")' class='listViewThLinkS1'>
								{/if}
							{/if}
							{sugar_translate label=$params.label module=$pageData.bean.moduleDir}
							&nbsp;&nbsp;
							{if $params.orderBy|default:$colHeader|lower == $pageData.ordering.orderBy}
								{if $pageData.ordering.sortOrder == 'ASC'}
									{capture assign="imageName"}arrow_down.{$arrowExt}{/capture}
									{capture assign="alt_sort"}{sugar_translate label='LBL_ALT_SORT_DESC'}{/capture}
									{sugar_getimage name=$imageName attr='align="absmiddle" border="0" ' alt="$alt_sort"}
								{else}
									{capture assign="imageName"}arrow_up.{$arrowExt}{/capture}
									{capture assign="alt_sort"}{sugar_translate label='LBL_ALT_SORT_ASC'}{/capture}
									{sugar_getimage name=$imageName attr='align="absmiddle" border="0" ' alt="$alt_sort"}
								{/if}
							{else}
								{capture assign="imageName"}arrow.{$arrowExt}{/capture}
								{capture assign="alt_sort"}{sugar_translate label='LBL_ALT_SORT'}{/capture}
								{sugar_getimage name=$imageName attr='align="absmiddle" border="0" ' alt="$alt_sort"}
							{/if}
							</a>
						{else}
							{if !isset($params.noHeader) || $params.noHeader == false}
							  {sugar_translate label=$params.label module=$pageData.bean.moduleDir}
							{/if}
						{/if}
						</div>
					</th>
				{counter name="colCounter"}
			{/foreach}
			{* add extra column for icons*}
			<th>{$pageData.additionalDetails.$id}</th>
		</tr>
		{include file='themes/Honey/include/ListView/ListViewPaginationTop.tpl'}
	</thead>
	<tbody id="tbody_id">
		{counter start=$pageData.offsets.current print=false assign="offset" name="offset"}
		{foreach name=rowIteration from=$data key=id item=rowData}
		    {counter name="offset" print=false}
	        {assign var='scope_row' value=true}

			{if $smarty.foreach.rowIteration.iteration is odd}
				{assign var='_rowColor' value=$rowColor[0]}
			{else}
				{assign var='_rowColor' value=$rowColor[1]}
			{/if}
			<tr height='20' class='{$_rowColor}S1'>
				{if $prerow}
				<td>
				 {if !$is_admin && is_admin_for_user && $rowData.IS_ADMIN==1}
						<input type='checkbox' disabled="disabled"  value='{$rowData.ID}'>
				 {else}
	                    <input title="{sugar_translate label='LBL_SELECT_THIS_ROW_TITLE'}" onclick='sListView.check_item(this, document.MassUpdate)' type='checkbox'  name='mass[]' value='{$rowData.ID}'>
				 {/if}
				</td>
				{/if}
				{if !empty($quickViewLinks)}
	            {capture assign=linkModule}{if $params.dynamic_module}{$rowData[$params.dynamic_module]}{else}{$pageData.bean.moduleDir}{/if}{/capture}
	            {capture assign=action}{if $act}{$act}{else}EditView{/if}{/capture}
				<td>
                    {if $pageData.rowAccess[$id].edit}

                        <a  target="_blank" title='{$editLinkString}' id="edit-{$rowData.ID}"
                           href="index.php?module={$linkModule}&offset={$offset}&stamp={$pageData.stamp}&return_module={$linkModule}&action={$action}&record={$rowData.ID}"
                                >
                            {capture name='tmp1' assign='alt_edit'}{sugar_translate label="LNK_EDIT"}{/capture}
                            {sugar_getimage name="edit_inline.gif" attr='border="0" ' alt="$alt_edit"}<!-- </a> -->
                    {/if}
	            </td>

				{/if}
				{counter start=0 name="colCounter" print=false assign="colCounter"}
				{foreach from=$displayColumns key=col item=params}
					{if $colCounter == '0'}
						{assign var='hide' value=""}
					{elseif $col  == 'NAME' }
						{assign var='hide' value=""}
					{elseif $colCounter  > '10' }
						{assign var='hide' value="hidden-xs hidden-sm hidden-md"}
					{elseif $colCounter > '4' }
						{assign var='hide' value="hidden-xs hidden-sm"}
					{elseif $colCounter > '0' }
						{assign var='hide' value="hidden-xs"}
					{else}
						{assign var='hide' value=""}
					{/if}
                    {$displayColumns[type]}
				    {strip}
					<td {if $col == 'STATUS'}     style = "padding-left: 40px; !important;" {/if} {if $scope_row}  {/if}>
						{if $col == 'NAME' || $params.bold}<b>{/if}
					    
						 {if $params.link && !$params.customCode}
							{capture assign=linkModule}{if $params.dynamic_module}{$rowData[$params.dynamic_module]}{else}{$params.module|default:$pageData.bean.moduleDir}{/if}{/capture}
							{capture assign=action}{if $act}{$act}{else}DetailView{/if}{/capture}
							{capture assign=record}{$rowData[$params.id]|default:$rowData.ID}{/capture}
							{capture assign=url}index.php?module={$linkModule}&offset={$offset}&stamp={$pageData.stamp}&return_module={$linkModule}&action={$action}&record={$record}{/capture}
													<{$pageData.tag.$id[$params.ACLTag]|default:$pageData.tag.$id.MAIN} {if $displayColumns.$col.type == 'relate'} style = "color: black;font-weight: bold;font-size: 13px;" {/if} target="_blank" href="{sugar_ajax_url url=$url}">
						{/if}

						{if $params.customCode}
							{sugar_evalcolumn_old var=$params.customCode rowData=$rowData}
						{else}
	                       {sugar_field parentFieldArray=$rowData vardef=$params displayType=ListView field=$col}

						{/if}
						{if empty($rowData.$col) && empty($params.customCode)}&nbsp;{/if}
						{if $params.link && !$params.customCode}
							</{$pageData.tag.$id[$params.ACLTag]|default:$pageData.tag.$id.MAIN}>
	                    {/if}
                        {if $inline_edit && ($displayColumns.$col.inline_edit == 1 || !isset($displayColumns.$col.inline_edit))}{/if}
					</td>
					{/strip}
	                {assign var='scope_row' value=false}
					{counter name="colCounter"}

				{/foreach}
				<td>{$pageData.additionalDetails.$id}</td>
		    	</tr>
		{foreachelse}
		<tr height='20' class='{$rowColor[0]}S1'>
		    <td>
		        {$APP.LBL_NO_DATA}
		    </td>
		</tr>
		{/foreach}
    {assign var="link_select_id" value="selectLinkBottom"}
    {assign var="link_action_id" value="actionLinkBottom"}
    {assign var="selectLink" value=$selectLinkBottom}
    {assign var="actionsLink" value=$actionsLinkBottom}
    {assign var="action_menu_location" value="bottom"}
	</tbody>

    {include file='themes/Honey/include/ListView/ListViewPaginationBottom.tpl'}
	
	</table></div>
{/if}
{if $contextMenus}
<script type="text/javascript">
{$contextMenuScript}
{literal}
function lvg_nav(m,id,act,offset,t){
    if(t.href.search(/#/) < 0){return;}
    else{
        if(act=='pte'){
            act='ProjectTemplatesEditView';
        }
        else if(act=='d'){
            act='DetailView';
        }else if( act =='ReportsWizard'){
            act = 'ReportsWizard';
        }else{
            act='EditView';
        }
    {/literal}
        url = 'index.php?module='+m+'&offset=' + offset + '&stamp={$pageData.stamp}&return_module='+m+'&action='+act+'&record='+id;
        t.href=url;
    {literal}
    }
}{/literal}
{literal}
    function lvg_dtails(id){{/literal}
        return SUGAR.util.getAdditionalDetails( '{$pageData.bean.moduleDir|default:$params.module}',id, 'adspan_'+id);{literal}}{/literal}
</script>
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
{/if}
{literal}
<script type="text/javascript">
$(document).ready(function() {
$('[id^="massupdate_listview"]').click(function() {
	$('html, body').animate({
      scrollTop: $('#massupdate_form').offset().top
    }, 1000);
	
});
var fuzzyNum =function(x){
   return+x.replace(/[^\d\.\-]/g,"");
 };

 $.fn.dataTableExt.oSort['numbercase-asc']=function(x, y){
    return fuzzyNum(x)- fuzzyNum(y);
 }; 
  
 $.fn.dataTableExt.oSort['numbercase-desc']=function(x, y){
    return fuzzyNum(y)- fuzzyNum(x);
 };

$('#tab_cases').DataTable( {
		
		'searching': true,
		'paging':false,
		'info':false,
        initComplete: function () {
			this.api().columns([3]).every( function () {
					var column = this;
					var input = $('<input type="text"  style="color: black;"/>')
						.prependTo( $(column.header()));
					$( 'input', this.header() ).on( 'keyup change clear', function () {
						if ( column.search() !== this.value ) {
							column
								.search( this.value )
								.draw();
						}
					} );
				} );
				this.api().columns().every( function () {
					$(this.header()).css('padding-bottom', 'bottom')
				});
				this.api().columns([5]).every( function () {
					var column = this;
					var select = $('<select id = "status" class="dt-search-select"><option value="">(No filter applied)</option></select>')
						.prependTo( $(column.header()));
						// ===Get language data and append in dropdown===
					    let case_status = SUGAR.language.languages.app_list_strings["case_status_dom"];
					    $.each(case_status, function (keys, values) {
						    $("#status").append('<option value="'+ keys +'">'+ values +'</option>');
					    })
						/*column.data().unique().sort().each( function ( d, j ) {
						   console.log('d');
						   console.log(d);
						   if(d != '' && d != '&nbsp;'){
							select.append( "<option value='"+d+"'>"+d+"</option>" )
							}
						});*/
						  /*$('#status').on('change', function(){
								var search = [];

							  $.each($('#status option:selected'), function(){
									search.push($(this).val());
							  });

							  search = search.join('|');
							  column.search(search, true, false).draw();
							});*/

				});
				this.api().columns([6]).every( function () {
					var column = this;
					var select = $('<select multiple   id = "attorney" class="dt-search-select"><option value="">(No filter applied)</option></select>')
						.prependTo( $(column.header()));
						
						column.data().unique().sort().each( function ( d, j ) {
						   console.log('d');
						   console.log(d);
						   if(d != '' && d != '&nbsp;'&& d != '&nbsp;&nbsp;'){
							select.append( "<option value='"+d+"'>"+d+"</option>" )
							}
						});
						  $('#attorney').on('change', function(){
								var search = [];

							  $.each($('#attorney option:selected'), function(){
									search.push($(this).val());
							  });

							  search = search.join('|');
							  column.search(search, true, false).draw();
							});
				});
			this.api().columns([7]).every( function () {
					var column = this;
					var select = $('<select multiple   id = "task_status" class="dt-search-select"><option value="">(No filter applied)</option></select>')
						.prependTo( $(column.header()));
						
						column.data().unique().sort().each( function ( d, j ) {
						   console.log('d');
						   console.log(d);
						   if(d != '' && d != '&nbsp;'){
							select.append( "<option value='"+d+"'>"+d+"</option>" )
							}
						});
						  $('#task_status').on('change', function(){
						  
								var search = [];

							  $.each($('#task_status option:selected'), function(){
							  console.log($(this).val());
									search.push($(this).val());
							  });

							  search = search.join('|');
							  column.search(search, true, false).draw();
							});
				});
			
				this.api().columns([9]).every( function () {
					var column = this;
					var select = $('<select multiple   id = "team" class="dt-search-select"><option value="">(No filter applied)</option></select>')
						.prependTo( $(column.header()));
						
						column.data().unique().sort().each( function ( d, j ) {
						   console.log('d');
						   console.log(d);
						   if(d != '' && d != '&nbsp;'){
							select.append( "<option value='"+d+"'>"+d+"</option>" )
							}
						});
						  $('#team').on('change', function(){
								var search = [];
								

							  $.each($('#team option:selected'), function(){
							  text = $(this).html();
							  value = text.replace(/\r?\n|\r/g,"");
							  		$(this).attr("value",value);
									search.push($(this).val());
							  });

							  search = search.join('|');
							  column.search(search, true, false).draw();
							});
				});
        }


    } );
	//$('#attorney, #status, #task_status, #team').select2();
	$('#attorney, #task_status, #team').select2();
	//$('#attorney, #status').hide();
	$('#attorney, #task_status, #team').hide();
	 removeduplicate();
	 function removeduplicate()
{
var mycode = {};
$("select[id='team'] > option").each(function () {
    if(mycode[this.text]) {
        $(this).remove();
    } else {
        mycode[this.text] = this.value;
    }

});
console.log(mycode);
}
// Live Search Request
	/*base_url = document.location.origin*/
	let beforeAppend = $("#tbody_id").html();
	$('#search_tasks').on( 'keyup', function () {
		let searcheditem = $(this).val();
		if (searcheditem !== "") {
			$.ajax({
				url:"index.php?module=Tasks&action=liveSearch",
				type: "post",
				data: {searcheditem:searcheditem},
				success:function(result){
					let decode = JSON.parse(result);
					$("#tbody_id").empty();
					$.each(decode, function(k, v) {
						if(v.id != null || v.name != null || v.status != null || v.date_due != null)
						{
							if(v.case_name == null){
								v.case_name = '';
							}
							if(v.case_status == null){
								v.case_status = '';
							}
							if(v.no_of_days == null){
								v.no_of_days = '';
							}
							if(v.status == null){
								v.status = '';
							}
							if(v.date_due == null){
								v.date_due = '';
							}
							if(v.name == null){
								v.name = '';
							}
							if(v.team_name == null){
								v.team_name = '';
							}
							$("#tbody_id").append(`<tr height="20" class="evenListRowS1">

<td><input title="Select this row" onclick="sListView.check_item(this, document.MassUpdate)" type="checkbox" name="mass[]" value=${v.id}>
</td>
<td><a target="_blank" title="Edit" id="edit-${v.id}" href="index.php?module=Tasks&amp;offset=2&amp;stamp=1641484446063359800&amp;return_module=Tasks&amp;action=EditView&amp;record=${v.id}"><img src="themes/Honey/images/edit_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA" border="0" alt="Edit"><!-- </a> -->
</a></td>
<td><a target="_blank" href="index.php?module=Tasks&amp;offset=1&amp;stamp=1652973145072091400&amp;return_module=Tasks&amp;action=DetailView&amp;record=${v.id}">
${v.date_due}
&nbsp;</a></td>
<td>${v.case_name}</td>
<td><a style="color: black;font-weight: bold;font-size: 13px;" target="_blank" href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DTasks%26offset%3D1%26stamp%3D1652973480050559200%26return_module%3DTasks%26action%3DDetailView%26record%3D${v.id}">
${v.name}
&nbsp;</a></td>
<td>${v.case_status}</td>
<td></td>
<td style="padding-left: 40px; !important;">
${v.status}
</td>
<td>${v.no_of_days}</td>
<td><a target="_blank" href="index.php?module=SecurityGroups&amp;offset=1&amp;stamp=1652972076085240600&amp;return_module=SecurityGroups&amp;action=DetailView&amp;record=${v.team_id}">
${v.team_name}
</a></td>
<td><span id="adspan_${v.id}" onclick="lvg_dtails('${v.id}')" style="position: relative;"><!--not_in_theme!--><img vertical-align="middle" class="info" border="0" alt="Additional Details" src="themes/Honey/images/info_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA"></span></td>
</tr>`);
							}
					});

				}

			});
		}
		else
		{
			$("#tbody_id").empty();
			$("#tbody_id").append(beforeAppend);
		}
	});
	// =======Live Search Request for Case Status=======
	$('#status').on('change', function(){
		let search = $(this).find(":selected").val();
		if(search == ''){search = 'no_record'}
			$.ajax({
				url:"index.php?module=Tasks&action=caseStatusSearch",
				type: "post",
				data: {search_data:search},
				success:function(result){
					let decode = JSON.parse(result);
					if (decode.length === 0) {
						$("#tbody_id").empty();
						$("#tbody_id").append(`<tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">No data available in table</td></tr>`);
					}else{
						$("#tbody_id").empty();
						$.each(decode, function (k, v) {
							if (v.id != null || v.name != null || v.status != null || v.date_due != null) {
								if (v.case_name == null) {
									v.case_name = '';
								}
								if (v.case_status == null) {
									v.case_status = '';
								}
								if (v.no_of_days == null) {
									v.no_of_days = '';
								}
								if (v.status == null) {
									v.status = '';
								}
								if (v.date_due == null) {
									v.date_due = '';
								}
								if (v.name == null) {
									v.name = '';
								}
								if (v.team_name == null) {
									v.team_name = '';
								}
								$("#tbody_id").append(`<tr height="20" class="evenListRowS1">

<td><input title="Select this row" onclick="sListView.check_item(this, document.MassUpdate)" type="checkbox" name="mass[]" value=${v.id}>
</td>
<td><a target="_blank" title="Edit" id="edit-${v.id}" href="index.php?module=Tasks&amp;offset=2&amp;stamp=1641484446063359800&amp;return_module=Tasks&amp;action=EditView&amp;record=${v.id}"><img src="themes/Honey/images/edit_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA" border="0" alt="Edit"><!-- </a> -->
</a></td>
<td><a target="_blank" href="index.php?module=Tasks&amp;offset=1&amp;stamp=1652973145072091400&amp;return_module=Tasks&amp;action=DetailView&amp;record=${v.id}">
${v.date_due}
&nbsp;</a></td>
<td>${v.case_name}</td>
<td><a style="color: black;font-weight: bold;font-size: 13px;" target="_blank" href="?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DTasks%26offset%3D1%26stamp%3D1652973480050559200%26return_module%3DTasks%26action%3DDetailView%26record%3D${v.id}">
${v.name}
&nbsp;</a></td>
<td>${v.case_status}</td>
<td></td>
<td style="padding-left: 40px; !important;">
${v.status}
</td>
<td>${v.no_of_days}</td>
<td><a target="_blank" href="index.php?module=SecurityGroups&amp;offset=1&amp;stamp=1652972076085240600&amp;return_module=SecurityGroups&amp;action=DetailView&amp;record=${v.team_id}">
${v.team_name}
</a></td>
<td><span id="adspan_${v.id}" onclick="lvg_dtails('${v.id}')" style="position: relative;"><!--not_in_theme!--><img vertical-align="middle" class="info" border="0" alt="Additional Details" src="themes/Honey/images/info_inline.gif?v=V6Jf_6LIk4nKTRgtYTnxCA"></span></td>
								</tr>`);
								}
						});
					}
				}
			});
	    });
	    // ========Designing of Dropdowns========
	$('#status').css("width","200px");
	$('#attorney').css("width","200px");
    } );
	{/literal}
</script>
{literal}
<style>
#tab_cases_filter{
float:left;
display:none;
}
.select2-container{ width: 250px !important; }
{/literal}
</style>