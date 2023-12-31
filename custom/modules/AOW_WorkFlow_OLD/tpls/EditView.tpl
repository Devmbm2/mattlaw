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
{{sugar_include type="smarty" file=$headerTpl}}
{sugar_include include=$includes}
<div id="EditView_tabs">
    {*display tabs*}
    {{counter name="tabCount" start=-1 print=false assign="tabCount"}}
    <ul class="nav nav-tabs">
        {{if $useTabs}}
        {{foreach name=section from=$sectionPanels key=label item=panel}}
        {{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
        {* if tab *}
        {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
        {*if tab display*}
        {{counter name="tabCount" print=false}}
        {{if $tabCount == '0'}}
        <li role="presentation" class="active">
            <a id="tab{{$tabCount}}" data-toggle="tab" class="hidden-xs">
                {sugar_translate label='{{$label}}' module='{{$module}}'}
            </a>
            <a id="xstab{{$tabCount}}" href="#" class="visible-xs first-tab-xs dropdown-toggle" data-toggle="dropdown">
                {sugar_translate label='{{$label}}' module='{{$module}}'}
            </a>
            <ul id="first-tab-menu-xs" class="dropdown-menu">
                {{counter name="tabCountXS" start=-1 print=false assign="tabCountXS"}}
                {{foreach name=sectionXS from=$sectionPanels key=label item=panelXS}}
                {{counter name="tabCountXS" print=false}}
                <li role="presentation">
                    <a id="tab{{$tabCountXS}}"  data-toggle="tab" onclick="changeFirstTab(this, 'tab-content-{{$tabCountXS}}');">
                        {sugar_translate label='{{$label}}' module='{{$module}}'}
                    </a>
                </li>
                {{/foreach}}
            </ul>
        </li>
        {{else}}
        <li role="presentation" class="hidden-xs">
            <a id="tab{{$tabCount}}"  data-toggle="tab">
                {sugar_translate label='{{$label}}' module='{{$module}}'}
            </a>
        </li>
        {{/if}}
        {{else}}
        {* if panel skip*}
        {{/if}}
        {{/foreach}}
        {{/if}}

    </ul>

    <div class="clearfix"></div>
    {{if $useTabs}}
    <div class="tab-content">
        {{else}}
        <div class="tab-content" style="padding: 0; border: 0;">
            {{/if}}
            {* Loop through all top level panels first *}
            {{counter name="tabCount" start=0 print=false assign="tabCount"}}
            {{if $useTabs}}
            {{foreach name=section from=$sectionPanels key=label item=panel}}
            {{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
            {{if isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true}}
            {{if $tabCount == '0'}}
            <div class="tab-pane-NOBOOTSTRAPTOGGLER active fade in" id='detailpanel_{{$tabCount}}' style="display: block;">
                {{include file='themes/SuiteP/include/EditView/tab_panel_content.tpl'}}
            </div>
            {{else}}
            <div class="tab-pane-NOBOOTSTRAPTOGGLER fade active in" id='detailpanel_{{$tabCount}}' style="display: none;">
                {{include file='themes/SuiteP/include/EditView/tab_panel_content.tpl'}}
            </div>
            {{/if}}
            {{/if}}
            {{counter name="tabCount" print=false}}
            {{/foreach}}
            {{else}}
            <!-- <div class="tab-pane panel-collapse">test</div> -->
            {{/if}}
        </div>
        {*display panels*}
        <div class="panel-content">
            {{counter name="panelCount" start=-1 print=false assign="panelCount"}}
            {{foreach name=section from=$sectionPanels key=label item=panel}}
            {{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
            {* if tab *}
            {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true && $useTabs)}}
            {*if tab skip*}
            {{else}}
            {* if panel display*}
            {*if panel collasped*}
            {{if (isset($tabDefs[$label_upper].panelDefault) && $tabDefs[$label_upper].panelDefault == "collapsed") }}
            {*collapse panel*}
            {{assign var='collapse' value="panel-collapse collapse"}}
            {{assign var='collapsed' value="collapsed"}}
            {{assign var='collapseIcon' value="glyphicon glyphicon-plus"}}
            {{assign var='panelHeadingCollapse' value="panel-heading-collapse"}}
            {{else}}
            {*expand panel*}
            {{assign var='collapse' value="panel-collapse collapse in"}}
            {{assign var='collapseIcon' value="glyphicon glyphicon-minus"}}
            {{assign var='panelHeadingCollapse' value=""}}
            {{/if}}

            <div class="panel panel-default">
                <div class="panel-heading {{$panelHeadingCollapse}}">
                    <a class="{{$collapsed}}" role="button" data-toggle="collapse" aria-expanded="false">
                        <div class="col-xs-10 col-sm-11 col-md-11">
                            {sugar_translate label='{{$label}}' module='{{$module}}'}
                        </div>
                    </a>

                </div>
                <div class="panel-body {{$collapse}}" id="detailpanel_{{$panelCount}}">
                    <div class="tab-content">
					{{if $label eq 'LBL_CONDITION_LINES'}}
						{{include file='custom/modules/AOW_WorkFlow/tpls/EditViewConditionPanel.tpl'}}
						
					{{else}}
                        {{include file='themes/SuiteP/include/EditView/tab_panel_content.tpl'}}
					{{/if}}
                    </div>
                </div>
            </div>

            {{/if}}
            {{counter name="panelCount" print=false}}
            {{/foreach}}
        </div>
        </div>
{{sugar_include type='smarty' file=$footerTpl}}


{{if $useTabs}}
{sugar_getscript file="cache/include/javascript/sugar_grp_yui_widgets.js"}
<script type="text/javascript">
var {{$form_name}}_tabs = new YAHOO.widget.TabView("{{$form_name}}_tabs");
{{$form_name}}_tabs.selectTab(0);
</script>
{{/if}}
<script type="text/javascript">
YAHOO.util.Event.onContentReady("{{$form_name}}",
    function () {ldelim} initEditView(document.forms.{{$form_name}}) {rdelim});
//window.setTimeout(, 100);
{{if $module == "Users"}}
window.onbeforeunload = function () {ldelim} return disableOnUnloadEditView(); {rdelim};
{{else}}
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
{{/if}}
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {ldelim}
$(document).ready(function() {ldelim}
    $(".collapseLink,.expandLink").click(function (e) {ldelim} e.preventDefault(); {rdelim});
  {rdelim});
{rdelim}
</script>

{literal}

    <script type="text/javascript">

    var selectTab = function(tab) {
        $('#EditView_tabs div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').hide();
        $('#EditView_tabs div.tab-content div.tab-pane-NOBOOTSTRAPTOGGLER').eq(tab).show().addClass('active').addClass('in');
    };

    var selectTabOnError = function(tab) {
        selectTab(tab);
        $('#EditView_tabs ul.nav.nav-tabs li').removeClass('active');
        $('#EditView_tabs ul.nav.nav-tabs li a').css('color', '');

        $('#EditView_tabs ul.nav.nav-tabs li').eq(tab).find('a').first().css('color', 'red');
        $('#EditView_tabs ul.nav.nav-tabs li').eq(tab).addClass('active');

    };

    var selectTabOnErrorInputHandle = function(inputHandle) {
        var tab = $(inputHandle).closest('.tab-pane-NOBOOTSTRAPTOGGLER').attr('id').match(/^detailpanel_(.*)$/)[1];
        selectTabOnError(tab);
    };


    $(function(){
        $('#EditView_tabs ul.nav.nav-tabs li').click(function(e){
            if(typeof $(this).find('a').first().attr('id') != 'undefined') {
                var tab = parseInt($(this).find('a').first().attr('id').match(/^tab(.)*$/)[1]);
                selectTab(tab);
            }
        });

        $('a[data-toggle="collapse"]').click(function(e){
            var content;
            if($(this).hasClass('collapsed')) {
                $(this).removeClass('collapsed');
                if($(this).closest('.panel-content').length) {
                    content = $(this).closest('.panel-content').find('.panel-body.panel-collapse.collapse');
                }
                else if($(this).closest('.panel.panel-default').length){
                    content = $(this).closest('.panel.panel-default').next();
                }
                content.addClass('in');
            } else {
                $(this).addClass('collapsed');
                if($(this).closest('.panel-content').length) {
                    content = $(this).closest('.panel-content').find('.panel-body.panel-collapse.collapse');
                }
                else if($(this).closest('.panel.panel-default').length){
                    content = $(this).closest('.panel.panel-default').next();
                }
                content.removeClass('in');
            }
        });
    });

    </script>

{/literal}