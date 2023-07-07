<?php
require_once('include/MVC/View/SugarView.php');
// include('include\SugarObjects\SugarSession.php');

class Viewdatatabledisplay extends SugarView
{
    public function display(){
        global $app_list_strings;
        $smarty = new Sugar_Smarty();
            // $session=new SugarSession();

            // print_r(SugarSession::getInstance());
            // $session->__set('TestSession',"HelloWorld");
            // print_r( $session->destroy());
        // die();
        $smarty->assign('AllModules',get_select_options_with_id($app_list_strings['ModuleNames'],'""'));
        $smarty->assign('status',get_select_options_with_id($app_list_strings['StatusForWorkflows'],''));
        $obj=new User();
        $smarty->assign('AllUsers',get_select_options_with_id($obj->getActiveUsers(),'1'));
        $sss=new MysqliManager();
            $result=$sss->query(
            "select name from securitygroups where deleted=0"
            );
            $SecurityGroupdNames="";
            while($row=$sss->fetchRow($result)){
                $SecurityGroupdNames.="<option>".$row['name']."</option>";
            }
            $smarty->assign('SecurityGroupdNames',$SecurityGroupdNames);
        $storePage = $smarty->fetch('custom/modules/AOR_Reports/tpls/datatabledisplay.tpl');
        echo $storePage;
    }
}
