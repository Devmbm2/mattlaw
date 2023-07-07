<h2 class="module-title-text">{$title}</h2><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="moduleTitle">
    <h2 class="module-title-text">{$title}</h2>
</div>
<div class="clear"></div>
{if $saved == 1}
<p class="success">Data saved successfully</p>
{/if}
<form name="ConfigureAjaxUI" method="POST" method="POST" action="index.php">
    <input type="hidden" name="module" value="InboundEmail" />
    <input type="hidden" name="action" value="EmailArchiver" />
    <div class="panel-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="" role="button" data-toggle="collapse-edit" aria-expanded="false">
                    <div class="col-xs-10 col-sm-11 col-md-11">
                        CONFIGURE
                    </div>
                </a>
            </div>
            <div class="panel-body panel-collapse collapse in panelContainer" style="padding-left: 20px; padding-right: 20px;">
                <div>&nbsp;</div>
                <div class="tab-content">
                    <div class="row edit-view-row">
                        <div class="col-xs-12 col-sm-8 edit-view-row-item">
                            <div class="col-xs-12 col-sm-4 label">Send daily report to:</div>
                            <div class="col-xs-12 col-sm-8 edit-view-field">
                                <input type="text" name="selectedEmails" id="selectedEmails" title="Comma separted multiple email addresses" value="{$selectedEmails}" />
                            </div>
                        </div>
                    </div>
                    <div class="row edit-view-row">
                        <div class="col-xs-12 col-sm-8 edit-view-row-item">
                            <div class="col-xs-12 col-sm-4 label">Sync on each run:</div>
                            <div class="col-xs-12 col-sm-8 edit-view-field">
                                <input type="text" name="selectedCount" id="selectedCount" title="Number of emails to be synced in each run for each mailbox." value="{$selectedCount}" />
                            </div>
                        </div>
                    </div>
                    <div class="row edit-view-row">
                        <div class="col-xs-12 col-sm-8 edit-view-row-item">
                            <div class="col-xs-12 col-sm-4 label">Sync emails after:</div>
                            <div class="col-xs-12 col-sm-8 edit-view-field">
                                <input type="text" name="selectedDate" id="selectedDate" title="Date to start sync from." onblur="parseDate(this, 'Y-m-d');" value="{$selectedDate}" style="width: 95%;" />
                                {sugar_getimage name="jscalendar" ext=".gif" alt=$APP.LBL_ENTER_DATE other_attributes='align="absmiddle" id="selectedDateTrigger" '}
                            </div>
                        </div>
                    </div>
                    <div class="row edit-view-row">
                        <div class="col-xs-12 col-sm-8 edit-view-row-item">
                            <div class="col-xs-12 col-sm-4 label">Modules for linking emails:</div>
                            <div class="col-xs-12 col-sm-8 edit-view-field">
                                <input type="hidden" name="selectedModules" id="selectedModules" value="{','|implode:$selectedModules}" />
                                <select name="validModules" id="validModules" style="width: 100%;" multiple onchange="updateValues()">
                                    {html_options options=$validModules selected=$selectedModules}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row edit-view-row">
                        <div class="col-xs-12 col-sm-6 edit-view-row-item">
                            <input type="submit" name="save" value="Save" />
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>
</form>
{literal}
<script>
    function updateValues() {
        var selected = [];
        $("#validModules option:selected").each(function () {
            selected.push($(this).val());
        });
        $("#selectedModules").val(selected.join(","));
    }
    Calendar.setup({
        inputField: "selectedDate",
        ifFormat: "Y-m-d",
        showsTime: false,
        button: "selectedDateTrigger",
        singleClick: true,
        step: 1,
        weekNumbers: false,
    });
</script>
{/literal}
