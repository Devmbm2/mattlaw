<?php

class DiscoveryAfterSave {
    public function MarkDone($bean, $event, $arguments) {
        $getBean = BeanFactory::getBean('DISC_Discovery',$bean->id);
        if($bean->assistant_reviewed_c == 'assistant_pass' && $bean->qc1_reviewed_c == 'qc1_pass')
        {
            $bean->done = 1;
            $getBean->save();
        }
        else{
            $bean->done = 0;
            $getBean->save();
        }
    }
}
