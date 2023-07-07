<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
class InboundEmailViewEmailArchiver extends SugarView {
    public function __construct() {
        parent::__construct();
    }
    public function preDisplay() {
        if (!is_admin($GLOBALS['current_user'])) {
            sugar_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
        }
    }
    public function display() {
        global $sugar_config, $moduleList, $app_list_strings;
        $allModules      = $GLOBALS['beanList'];
        $validModules    = array();
        $selectedModules = (isset($sugar_config['emailSync']['AllowedModules']) && is_array($sugar_config['emailSync']['AllowedModules'])) ? $sugar_config['emailSync']['AllowedModules'] : array("Accounts", "Contacts", "Leads");
        $selectedEmails  = (isset($sugar_config['emailSync']['emailForArchiveReport']) && !empty($sugar_config['emailSync']['emailForArchiveReport'])) ? $sugar_config['emailSync']['emailForArchiveReport'] : "admin@admin.com";
        $selectedDate    = (isset($sugar_config['emailSync']['emailProcessStartDate']) && !empty($sugar_config['emailSync']['emailProcessStartDate'])) ? $sugar_config['emailSync']['emailProcessStartDate'] : "2020-01-01";
        $selectedCount   = (isset($sugar_config['emailSync']['countForEachRun']) && !empty($sugar_config['emailSync']['countForEachRun'])) ? $sugar_config['emailSync']['countForEachRun'] : 100;
        foreach ($allModules as $moduleName => $moduleArray) {
            if ($moduleName == "Users") {
                continue;
            }
            $validModules[$moduleName] = translate($moduleName);
        }
        ksort($validModules);
        ksort($selectedModules);
        $this->ss->assign('title', "Email Sync");
        $this->ss->assign('selectedModules', $selectedModules);
        $this->ss->assign('selectedEmails', $selectedEmails);
        $this->ss->assign('selectedDate', $selectedDate);
        $this->ss->assign('selectedCount', $selectedCount);
        $this->ss->assign('validModules', $validModules);
        if (isset($_POST['save'])) {
            $this->ss->assign('saved', "1");
        } else {
            $this->ss->assign('saved', "0");
        }
        echo $this->ss->fetch('custom/modules/InboundEmail/tpls/view.emailarchiver.tpl');
    }
}