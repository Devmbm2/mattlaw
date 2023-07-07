<?php
 // created: 2022-08-31 09:27:29
$dictionary['Contact']['fields']['lost_reason_c']['labelValue']='Lost Reason';
$dictionary['Contact']['fields']['lost_reason_c']['required_formula']='equal($physician_status_c,"Closed Lost")';
$dictionary['Contact']['fields']['lost_reason_c']['readonly_formula']='';
$dictionary['Contact']['fields']['lost_reason_c']['visibility_grid']=array (
  'trigger' => 'physician_status_c',
  'values' => 
  array (
    'Qualified' => 
    array (
      0 => '',
    ),
    'Enrolled in Onboarding and Training' => 
    array (
      0 => '',
    ),
    'Proctoring in Progress' => 
    array (
      0 => '',
    ),
    'Certified' => 
    array (
      0 => '',
    ),
    'Closed' => 
    array (
      0 => '',
      1 => '',
      2 => 'Did Not Complete Onboarding',
      3 => 'Did Not Complete Training',
      4 => 'Different Country',
      5 => 'Not a Physician',
      6 => 'Not Interested',
      7 => 'Duplicate',
      8 => 'Not Qualified',
      9 => 'Other',
    ),
  ),
);

 ?>