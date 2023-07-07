<?php
require_once('modules/AOW_WorkFlow/AOW_WorkFlow.php');
class ht_AOW_WorkFlow extends AOW_WorkFlow {
	function get_flow_beans(){
        global $beanList;

        if($beanList[$this->flow_module]){
            $module = new $beanList[$this->flow_module]();

            $query = '';
            $query_array = array();

            $query_array['select'][] = $module->table_name.".id AS id";
            $query_array = $this->build_flow_query_where($query_array);

            if(!empty($query_array)){
                foreach ($query_array['select'] as $select){
                    $query .=  ($query == '' ? 'SELECT ' : ', ').$select;
                }

                $query .= ' FROM '.$module->table_name.' ';

                if(isset($query_array['join'])){
                    foreach ($query_array['join'] as $join){
                        $query .= $join;
                    }
                }
				if(isset($query_array['where'])){
                    $query_where = ' WHERE ';
                    foreach ($query_array['where'] as $where){
                        $query_where .= ' '.$where;
                    }
                    $query .= ' '.$query_where;
                }
				/* if(isset($query_array['where'])){
                    $query_where = '';
                    foreach ($query_array['where'] as $where){
                        $query_where .=  ($query_where == '' ? 'WHERE ' : '  ').$where;
                    }
					// $query_where = $this->queryWhereRepair($query_where);
                    $query .= ' '.$query_where;
                } */
				/* if (isset($query_array['where'])) {
					$query_where = '';
					$query_array['where'] = array_reverse($query_array['where']);
					foreach ($query_array['where'] as $where) {
						$query_where .= ($query_where == '' ? 'WHERE ' : ' AND ') . $where;
					}

					$query .= ' ' . $query_where;
				} */
				return $module->process_full_list_query($query);
            }


        }
        return null;
    }

	function build_flow_query_where($query = array()){
        global $beanList;

        if($beanList[$this->flow_module]){
            $module = new $beanList[$this->flow_module]();

            $sql = "SELECT id FROM aow_conditions WHERE aow_workflow_id = '".$this->id."' AND deleted = 0 ORDER BY condition_order ASC";
            $result = $this->db->query($sql);

            while ($row = $this->db->fetchByAssoc($result)) {
                $condition = new AOW_Condition();
                $condition->retrieve($row['id']);
                $query = $this->build_query_where($condition,$module,$query);
                if(empty($query)){
                    return $query;
                }
            }
			// print"<pre>";print_r($query);die;
            if($this->flow_run_on){
                switch($this->flow_run_on){

                    case'New_Records':
                        $query['where'][] = ' AND '.$module->table_name . '.' . 'date_entered' . ' > ' . "'" .$this->date_entered."'";
                        Break;

                    case'Modified_Records':
                        $query['where'][] = ' AND '.$module->table_name . '.' . 'date_modified' . ' > ' . "'" .$this->date_entered."'" . ' AND ' . $module->table_name . '.' . 'date_entered' . ' <> ' . $module->table_name . '.' . 'date_modified';
                        Break;

                }
            }

            if(!$this->multiple_runs){
                $query['where'][] .= " AND NOT EXISTS (SELECT * FROM aow_processed WHERE aow_processed.aow_workflow_id='".$this->id."' AND aow_processed.parent_id=".$module->table_name.".id AND aow_processed.status = 'Complete' AND aow_processed.deleted = 0)";
            }

			$query['where'][] = ' AND '.$module->table_name .".deleted = 0 ";

        }

        return $query;
    }
    function run_bean_flow(SugarBean &$bean,$id){
        if(!isset($_REQUEST['module']) || $_REQUEST['module'] != 'Import'){
            $query = "SELECT id FROM aow_workflow WHERE aow_workflow.flow_module = '".$bean->module_dir."' AND aow_workflow.status = 'Active'  AND aow_workflow.deleted = 0 AND aow_workflow.id='$id'";
            $result = $this->db->query($query, false);
            // print_r($result);die();
            $flow = new AOW_WorkFlow();
            while (($row = $bean->db->fetchByAssoc($result)) != null){

                $flow ->retrieve($row['id']);
                if($flow->check_valid_bean($bean))
                    $flow->run_actions($bean, true);
            }


        }
        return true;
    }
function saveField($field, $id, $module, $value)
{
    global $current_user;

    if ($module == 'Users' && $field == 'is_admin' && !$current_user->is_admin) {
        $err = 'SECURITY: Only admin user can change user type';
        $GLOBALS['log']->fatal($err);
        throw new RuntimeException($err);
    }

    $bean = BeanFactory::getBean($module,"$id");
//  print_r($value);die();
    if (is_object($bean) && $bean->id != "") {

        if ($bean->field_defs[$field]['type'] == "multienum") {
            $bean->$field = encodeMultienumValue($value);
        }else if ($bean->field_defs[$field]['type'] == "relate" || $bean->field_defs[$field]['type'] == 'parent'){
            $save_field = $bean->field_defs[$field]['id_name'];
            $bean->$save_field = $value;
            if ($bean->field_defs[$field]['type'] == 'parent') {
                $bean->parent_type = $_REQUEST['parent_type'];
                $bean->fill_in_additional_parent_fields(); // get up to date parent info as need it to display name
            }
        }else if ($bean->field_defs[$field]['type'] == "currency"){
			if (stripos($field, 'usdollar')) {
				$newfield = str_replace("_usdollar", "", $field);
				$bean->$newfield = $value;
			}
			else{
				$bean->$field = $value;
			}

        }else{
            $bean->$field = $value;
        }

        $check_notify = FALSE;

        if (isset( $bean->fetched_row['assigned_user_id']) && $field == "assigned_user_name") {
            $old_assigned_user_id = $bean->fetched_row['assigned_user_id'];
            if (!empty($value) && ($old_assigned_user_id != $value) && ($value != $current_user->id)) {
                $check_notify = TRUE;
            }
        }

        $adminOnlyModules = array('Users', 'Employees');

        $enabled = true;
        if(in_array($module, $adminOnlyModules) && !is_admin($current_user)) {
            $enabled = false;
        }

        if(($bean->ACLAccess("edit") || is_admin($current_user)) && $enabled) {
            if(!$bean->save($check_notify)) {
                $GLOBALS['log']->fatal("Saving probably failed or bean->save() method did not return with a positive result.");
            }
        } else {
            $GLOBALS['log']->fatal("ACLAccess denied to save this field.");
        }
        $bean->retrieve();
        return getDisplayValue($bean, $field);
    } else {
        return false;
    }

}

}
