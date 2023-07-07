<?php
 // created: 2022-08-31 09:27:29
$dictionary['Contact']['fields']['lost_reason_comment_c']['labelValue']='Lost Reason Comment';
$dictionary['Contact']['fields']['lost_reason_comment_c']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['lost_reason_comment_c']['enforced']='';
$dictionary['Contact']['fields']['lost_reason_comment_c']['dependency']='equal($physician_status_c," Closed Lost")';
$dictionary['Contact']['fields']['lost_reason_comment_c']['required_formula']='equal($physician_status_c," Closed Lost")';
$dictionary['Contact']['fields']['lost_reason_comment_c']['readonly_formula']='';

 ?>