<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{literal}
  <style>

</style>
{/literal}
    <br><br><br>
    <form id="ConfigureSettings" name="ConfigureSettings"  method="POST"
    action="index.php?module=Administration&action=email_extraction_config&do=save" autocomplete = "off"> 
    <table width="100%" border="0" cellspacing="1" cellpadding="0" style="background-color: white; height:150px;">
    <tbody>
    <tr>
<td class="dataLabel" width="5%">
Email ID:&nbsp;
                        <span class="required">*</span>
                </td>
<td class="dataLabel" width="65%">
                        <input type="text" id="user_name" name="user_name" size="75" {if $config_email} value="{$config_email}" {else} value = ""{/if} style="width:400px;">
                </td>
</tr>
<tr>
<td class="dataLabel" width="5%">
Password:&nbsp;
                        <span class="required">*</span>
                </td>
<td class="dataLabel" width="65%">
                        <input type="password" id="user_password" name="user_password" size="75" {if $config_password} value="{$config_password}" {else} autocomplete="new-password"{/if}  placeholder="{if isset($config_email)}Already Saved , if you want to Edit write here {/if}" style="width:400px;">
                        </td>
</tr>

</tbody>
</table>
    <br><br>
    {$BUTTONS}
    {$JAVASCRIPT}
    </form>
    <br>
    <br><br><br>
{literal}
<script>

</script>

{/literal}