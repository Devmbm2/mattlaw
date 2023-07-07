{$Flash}
 <script type="text/javascript" src="custom/include/javascript/loadingoverlay.min.js"></script>
 <script type="text/javascript" src="custom/modules/Alerts/js/edit.js"></script>
 <script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>
{foreach from=$Results item=result}
    <div class="alert alert-{if $result->type != null and $result->type != 'workflow_discovery_A' }{$result->type}{else}info{/if} alert-dismissible module-alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="Alerts.prototype.markAsRead('{$result->id}');"><span aria-hidden="true">&times;</span></button>
        <h4 class="alert-header">
        {if $result->url_redirect != null and !($result->url_redirect|strstr:"fake_")  and $result->type != 'workflow_discovery_A'}
        <a class="alert-link text-{if $result->type != null and  $result->type != 'workflow_discovery_A'}{$result->type}{else}info{/if}" href="index.php?module=Alerts&action=redirect&record={$result->id}">
        {/if}
            {if $result->target_module != null }
                {* <img src="index.php?entryPoint=getImage&themeName=SuiteP&imageName={$result->target_module}s.gif"/> *}
                <strong class="text-{if $result->type != null and  $result->type != 'workflow_discovery_A'}{$result->type}{else}info{/if}">Click to View</strong>
            {else}
                <strong class="text-{if $result->type != null and $result->type != 'workflow_discovery_A'}{$result->type}{else}info{/if}">Alert</strong>
            {/if}
        {if $result->url_redirect != null }
        </a>
        {/if}
        </h4>
        <p class="alert-body">
            {$result->name|nl2br}<br/>
            {$result->description|nl2br}
            {if $result->type  == 'workflow_discovery_A' }
            <input id="discovery_id"  type="hidden" value="{$result->url_redirect}" >
            <input title="view" accesskey="a" class="button primary" id="show_workflows" 
       onclick="show_workflows();" type="submit" name="button" value="View" >
       {/if}
        </p>
    </div>
{/foreach}

