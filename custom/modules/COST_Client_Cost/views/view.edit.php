<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2017 SalesAgility Ltd.
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

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class COST_Client_CostViewEdit extends ViewEdit{

 public function __construct()
    {
        parent::__construct();
		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
    }
    public function display()
    {
	//Fill Case Type from Parent
	global$app_list_strings;
        /*if (isset($_REQUEST['parent_id']) && $_REQUEST['parent_id'] != '' && isset($_REQUEST['parent_type']) &&  $_REQUEST['parent_type'] == 'Cases'){
             $case = new aCase();
             $case->retrieve($_REQUEST['parent_id']);
             $_REQUEST['case_type_c'] = $app_list_strings['case_type_list'][$case->type];//get value from dropdown by key
         }*/

        if (isset($this->bean->id)) {
            $this->ss->assign('FILE_OR_HIDDEN', 'hidden');
            if (empty($_REQUEST['isDuplicate']) || $_REQUEST['isDuplicate'] === 'false') {
                $this->ss->assign('DISABLED', 'disabled');
            }
        } else {
            $this->ss->assign('FILE_OR_HIDDEN', 'file');
        }
		$formName = $this->ev->formName;
		if(empty($formName)){
			$formName = 'EditView';
		}
		$this->ev->process();
		$this->ev->defs['templateMeta']['form']['buttons'] = array('SUBPANELSAVE', 'SUBPANELCANCEL'); // code to remove full form button from quick create view
        echo "<script type='text/javascript'>
			var formName = '{$formName}';
		</script>";
		parent::display();
		
		
			
			
			echo "<script type='text/javascript' src='custom/include/javascript/visible/client_cost_type.js'></script> ";
			echo "<script type='text/javascript' src='custom/include/javascript/visible/client_cost_status.js'></script> ";
			/* echo "<script type='text/javascript' src='custom/include/javascript/visible/client_cost_case_type.js'></script> "; */
			echo "<script type='text/javascript' src='custom/modules/COST_Client_Cost/js/edit.js'></script> ";
			
    }
}
