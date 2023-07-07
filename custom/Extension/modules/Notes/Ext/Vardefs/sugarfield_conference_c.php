<?php
 // created: 2022-08-31 09:27:28
$dictionary['Contact']['fields']['conference_c']['labelValue']='Conference';
$dictionary['Contact']['fields']['conference_c']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['conference_c']['enforced']='';
$dictionary['Contact']['fields']['conference_c']['dependency']='equal($lead_source,"Conference")';
$dictionary['Contact']['fields']['conference_c']['required_formula']='';
$dictionary['Contact']['fields']['conference_c']['readonly_formula']='';

 ?>