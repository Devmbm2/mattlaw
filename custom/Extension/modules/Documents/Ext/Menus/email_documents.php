<?php
	if(ACLController::checkAccess('Documents', 'list', true))$module_menu[] =Array("index.php?module=Documents&action=index&return_module=Documents&return_action=DetailView&clear_query=true&email_documents=yes", $mod_strings['LNK_EMAIL_DOCUMENTS'],"list", 'Documents');
