
	{assign var=idname value={{sugarvar key='name' string=true}}}
	{assign var=field_file value=$idname|cat:'_file'}

<div class="{$idname}_file">
	{if isset($bean->$field_file) && !empty($bean->$field_file)}
		<b>Attachments:</b><br/>
		<div style="margin-left:20px">
			{foreach from=$bean->$field_file key="val" item="file"}
				{$file}<br/>
			{/foreach}
		</div>
	{/if}
</div>
