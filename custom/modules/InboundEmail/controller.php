<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
class InboundEmailController extends SugarController {
    protected function action_EmailArchiver() {
        if(isset($_POST['save'])){
            require_once('modules/Configurator/Configurator.php');
            $configurator = new Configurator();
            $configurator->config['emailSync']['AllowedModules'] = (isset($_POST['selectedModules']) && !empty($_POST['selectedModules'])) ? explode(",", $_POST['selectedModules']) : array();
            $configurator->config['emailSync']['emailForArchiveReport'] = (isset($_POST['selectedEmails']) && !empty($_POST['selectedEmails'])) ? $_POST['selectedEmails'] : "";
            $configurator->config['emailSync']['emailProcessStartDate'] = (isset($_POST['selectedDate']) && !empty($_POST['selectedDate'])) ? $_POST['selectedDate'] : "2020-01-01";
            $configurator->config['emailSync']['countForEachRun'] = (isset($_POST['selectedCount']) && !empty($_POST['selectedCount'])) ? $_POST['selectedCount'] : 100;
            $configurator->handleOverride();
            $this->view = 'emailarchiver';
        } else {
            $this->view = 'emailarchiver';
        }
    }
}