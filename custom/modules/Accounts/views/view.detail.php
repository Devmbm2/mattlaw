<?php
require_once('include/MVC/View/views/view.detail.php');
class AccountsViewDetail extends ViewDetail {
        function AccountsViewDetail(){
        parent::ViewDetail();
}

function display() {

	echo "<script type='text/javascript'>var bean = ".json_encode($this->bean->toArray()).";
	if(bean['account_type']!='Medical_Provider' && bean['expert_type_c']!='Medical'){
                $(\"[field='medicine_type_c']\").parent().html('');
        }
        if(bean['account_type']!='Expert_Witness'){
                $(\"[field='expert_type_c']\").parent().html('');
        }
	</script>";
        parent::display();
		echo "<script type='text/javascript' src='custom/include/javascript/visible/org_type.js'></script>";
}
protected function _displaySubPanels()
    {
        if (isset($this->bean) && !empty($this->bean->id) && (file_exists('modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/metadata/subpaneldefs.php') || file_exists('custom/modules/' . $this->module . '/Ext/Layoutdefs/layoutdefs.ext.php'))) {
             $GLOBALS['focus'] = $this->bean;
             require_once ('include/SubPanel/SubPanelTiles.php');
             $subpanel = new SubPanelTiles($this->bean, $this->module);
	     if ($this->bean->account_type == "Court_Clerk")
                {
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['contacts']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['leads']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['accounts']);
		    unset($subpanel->subpanel_definitions->layout_defs['subpanel_setup']['account_ht_address_book']);
		}
                echo $subpanel->display();
        }
    }
}
?>
