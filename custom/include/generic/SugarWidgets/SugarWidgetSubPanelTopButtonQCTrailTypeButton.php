<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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
 ********************************************************************************/




require_once "include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonQuickCreate.php";

class SugarWidgetSubPanelTopButtonQCTrailTypeButton extends SugarWidgetSubPanelTopButtonQuickCreate
{
	    public function getWidgetId()
    {
        return parent::getWidgetId();
    }
	function &_get_form($defines, $additionalFormFields = null, $asUrl = false)
	{
		global $app_strings;
		global $currentModule;

		// Create the additional form fields with real values if they were not passed in
		if(empty($additionalFormFields) && $this->additional_form_fields)
		{
			foreach($this->additional_form_fields as $key=>$value)
			{
				if(!empty($defines['focus']->$value))
				{
					$additionalFormFields[$key] = $defines['focus']->$value;
				}
				else
				{
					$additionalFormFields[$key] = '';
				}
			}
		}

		if(!empty($this->module))
		{
			$defines['child_module_name'] = $this->module;
		}
		else
		{
			$defines['child_module_name'] = $defines['module'];
		}

		$defines['parent_bean_name'] = get_class( $defines['focus']);

		$relationship_name = $this->get_subpanel_relationship_name($defines);

		$form = 'form2' . $defines['subpanel_definition']->_instance_properties['subpanel_name'];
		$button = '<form onsubmit="return SUGAR.subpanelUtils.sendAndRetrieve(this.id, \'subpanel_' . $defines['subpanel_definition']->name . '\', \'' . addslashes($app_strings['LBL_LOADING']) . '\');" action="index.php" method="post" name="form2" id="form' . $form . "\">\n";

		//module_button is used to override the value of module name
		$button .= "<input type='hidden' name='target_module' value='".$defines['child_module_name']."'>\n";
		$button .= "<input type='hidden' name='".strtolower($defines['parent_bean_name'])."_id' value='".$defines['focus']->id."'>\n";

		if(isset($defines['focus']->name))
		{
			$button .= "<input type='hidden' name='".strtolower($defines['parent_bean_name'])."_name' value='".$defines['focus']->name."'>";
			#26451,add these fields for custom one-to-many relate field.
            if(!empty($defines['child_module_name'])){
            	$button .= "<input type='hidden' name='". $relationship_name ."_name' value='".$defines['focus']->name."'>";
            	$childFocusName = !empty($GLOBALS['beanList'][$defines['child_module_name']]) ? $GLOBALS['beanList'][$defines['child_module_name']] : "";
            	if(!empty($GLOBALS['dictionary'][ $childFocusName ]["fields"][$relationship_name .'_name']['id_name'])){
            		$button .= "<input type='hidden' name='". $GLOBALS['dictionary'][ $childFocusName ]["fields"][$relationship_name .'_name']['id_name'] ."' value='".$defines['focus']->id."'>";
            	}
            }
            
            //Set the return_name form variable that will allow EditView2.php 
            $additionalFormFields['return_name'] = $defines['focus']->name;
		}
		
		if(!empty($defines['view']))
		$button .= '<input type="hidden" name="target_view" value="'. $defines['view'] . '" />';
		$button .= '<input type="hidden" name="to_pdf" value="true" />';
        $button .= '<input type="hidden" name="tpl" value="QuickCreate.tpl" />';
		$button .= '<input type="hidden" name="return_module" value="' . $currentModule . "\" />\n";
		$button .= '<input type="hidden" name="return_action" value="' . $defines['action'] . "\" />\n";
		$button .= '<input type="hidden" name="return_id" value="' . $defines['focus']->id . "\" />\n";
		$button .= '<input type="hidden" name="return_relationship" value="' . $relationship_name . "\" />\n";
		$button .= '<input type="hidden" name="record" value="" />';

		// TODO: move this out and get $additionalFormFields working properly
		if(empty($additionalFormFields['parent_type']))
		{
			if($defines['focus']->object_name=='Contact') {
				$additionalFormFields['parent_type'] = 'Accounts';
			}
			else {
				$additionalFormFields['parent_type'] = $defines['focus']->module_dir;
			}
		}
		if(empty($additionalFormFields['parent_name']))
		{
			if($defines['focus']->object_name=='Contact') {
				$additionalFormFields['parent_name'] = $defines['focus']->account_name;
				$additionalFormFields['account_name'] = $defines['focus']->account_name;
			}
			else {
				$additionalFormFields['parent_name'] = $defines['focus']->name;
			}
		}
		if(empty($additionalFormFields['parent_id']))
		{
			if($defines['focus']->object_name=='Contact') {
				$additionalFormFields['parent_id'] = $defines['focus']->account_id;
				$additionalFormFields['account_id'] = $defines['focus']->account_id;
			}
			else {
				$additionalFormFields['parent_id'] = $defines['focus']->id;
			}
		}

        if(strtolower($defines['child_module_name']) =='contracts') {
            //set variables to account name, or parent account name
            if(strtolower($defines['parent_bean_name']) == 'account' ){
                //if account is parent bean, then get focus id/focus name
                if(isset($defines['focus']->id))$additionalFormFields['account_id'] = $defines['focus']->id;
                if(isset($defines['focus']->name))$additionalFormFields['account_name'] = $defines['focus']->name;
            }elseif(strtolower($defines['parent_bean_name']) == 'quote' ){
                //if quote is parent bean, then get billing_account_id/billing_account_name
                if(isset($defines['focus']->billing_account_id))$additionalFormFields['account_id'] = $defines['focus']->billing_account_id;
                if(isset($defines['focus']->billing_account_name))$additionalFormFields['account_name'] = $defines['focus']->billing_account_name;
            }else{
                if(isset($defines['focus']->account_id))$additionalFormFields['account_id'] = $defines['focus']->account_id;
                if(isset($defines['focus']->account_name))$additionalFormFields['account_name'] = $defines['focus']->account_name;
            }
        }

		$button .= '<input type="hidden" name="action" value="SubpanelCreates" />' . "\n";
		$button .= '<input type="hidden" name="module" value="Home" />' . "\n";
		$button .= '<input type="hidden" name="target_action" value="QuickCreate" />' . "\n";

		// fill in additional form fields for all but action
		foreach($additionalFormFields as $key => $value)
		{
			if($key != 'action')
			{
				$button .= '<input type="hidden" name="' . $key . '" value=\'' . $value . '\' />' . "\n";
			}
		}

		return $button;
	}
	
	
	
	function display($defines)
	{
		global $app_strings, $currentModule, $app_list_strings;
		$title = $app_strings['LBL_NEW_BUTTON_TITLE'];
		$value = $app_strings['LBL_NEW_BUTTON_LABEL'];
		$this->module = $defines['module']; 
		if( ACLController::moduleSupportsACL($defines['module'])  && !ACLController::checkAccess($defines['module'], 'edit', true)){
			$button = "<input title='$title'class='button' type='button' name='button' value='  $value  ' disabled/>\n";
			return $button;
		} 
		$additionalFormFields = array();
		if(isset($defines['focus']->name)) 
		$additionalFormFields['name'] = $defines['focus']->name;
		$button = $this->_get_form ($defines, $additionalFormFields);
		$button .= "<input title='$title' class='button' type='submit' name='{$this->getWidgetId()}' id='{$this->getWidgetId()}' value='  $value  '/>\n";
		$button .= "<input type='hidden' name='hard_or_soft_doc' value='Hard_Documents'>\n";
		$button .= "<input type='hidden' name='subcategory_id' value='Trial'>\n";
		$button .= "</form>";
		return $button;

	}
		


}
?>
