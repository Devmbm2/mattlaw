<?php

class UpdateStatus {
    function update_opt_out_status($bean, $event, $arguments)
    {
        global $db;
        $workflows = $bean->optout_workflows;
        if (!empty($workflows)) {
            $workflows = trim($workflows, '^');
            $idArray = explode('^,^', $workflows);
            $index = 0;
            while ($index < count($idArray)) {
                $workflow_id = trim($idArray[$index]);
                $opt_out_workflow = $bean->optout_workflows;
                $opt_out_status = $bean->workflow_end_status_c;
                $opt_out_reason = $bean->why_opt_out_c;
                $index++;
                $sql = "UPDATE `aow_processed` 
                        SET aow_processed.status='opt_out', 
                            optout_workflows='".$opt_out_workflow."', 
                            why_opt_out_c='".$opt_out_reason."', 
                            workflow_end_status_c='".$opt_out_status."'
                        WHERE  parent_id='".$bean->id."'  ";
                $db->query($sql);
            }
        }
    }
}
