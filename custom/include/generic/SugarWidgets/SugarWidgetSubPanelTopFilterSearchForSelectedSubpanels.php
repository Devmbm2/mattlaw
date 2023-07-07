<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class SugarWidgetSubPanelTopFilterSearchForSelectedSubpanels  extends SugarWidgetSubPanelTopButton{

    function display($defines, $additionalFormFields = NULL, $nonbutton = false)
    {
        global $app_strings;

        $button = "<script src='custom/include/SubPanel/SubPanel.js'></script>
        <script>
        showSearchPanel('".$defines['subpanel_definition']->name."');
        </script>
        ";

     //   $button .= "<input class='' type='text'    id='". $this->getWidgetId() ."'  name='name_basic  title='".$app_strings['LBL_SUBPANEL_FILTER_LABEL']."' onchange=\"submitSearch('disc_discovery_cases',this);\"/>";

        return $button;
    }

}
