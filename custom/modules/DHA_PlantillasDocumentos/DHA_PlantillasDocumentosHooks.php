<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class DHA_PlantillasDocumentosHooks
{
    public function checkLitigationCFields($bean, $event, $arguments)
    {
        if ($bean->litigation_c=="Pleadings") {
            $bean->use_letterhead = 'no';
        }
        elseif ($bean->litigation_c != "Pleadings") {
            $bean->use_letterhead = 'yes';
        }
    }
}
