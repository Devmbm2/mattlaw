
<input title="Save" accesskey="a" class="button primary" onclick="var _form = document.getElementById('EditView'); _form.action.value='Save';if(custom_validation())if(check_form('EditView'))SUGAR.ajaxUI.submitForm(_form);return false;" type="submit" name="button" value="Save" id="SAVE">
<input title="Cancel [Alt+l]" accesskey="l" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&amp;module=Cases'); return false;" type="button" name="button" value="Cancel" id="CANCEL"> <input type="button" class="button" id="slack_notification" title="Send Slack Notification" value="Save &amp; Notify">
<button type="button" id="save_and_continue" class="button saveAndContinue" title="" onclick="SUGAR.saveAndContinue(this);">
Save and Continue
</button>
