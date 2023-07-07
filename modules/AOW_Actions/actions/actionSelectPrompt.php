<?php
require_once('modules/AOW_Actions/actions/actionBase.php');
class actionSelectPrompt extends actionBase {

    function actionSelectPrompt($id = '')
    {
        $GLOBALS['log']->fatal("actionSelectPrompt");
        parent::actionBase($id);
    }

    function loadJS(){
        return array('modules/AOW_Actions/actions/actionSelectPrompt.js');
    }
    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    function run_action(SugarBean $bean,$params = array())
    {
        //logic define krni hoti ha is function may
        $GLOBALS['log']->fatal("run_action");
        echo "HelloWOrld";
        return true;
    }
    function edit_display($line, SugarBean $bean = null, $params = array())
    {
        //popup ko display krwane k liye ye function istmal kiya jata ha
        global $sugar_config, $db;
        global $app_list_strings;

$app_list_strings['aow_moduleList'] = $app_list_strings['moduleList'];

echo "<style>
.fade.show {
    opacity: 1;
}
.modal {
    position: fixed;
    top:30%;
    right: 0;
    bottom: 0;
    left: 0;
    outline: 0;
}
.fade {
    transition: opacity .15s linear;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}
.modal-content {
    position: relative;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border-radius: 0.3rem;
    outline: 0;
}
.modal-header {
    display: flex;
    -webkit-box-align: start;
    align-items: flex-start;
    -webkit-box-pack: justify;
    justify-content: space-between;
    border-bottom: 1px solid #e9ecef;
    border-top-left-radius: 0.3rem;
    border-top-right-radius: 0.3rem;
}
div.modal-header {
    padding: 16px;
}
.modal-body {
    position: relative;
    -webkit-box-flex: 1;
    flex: 1 1 auto;
    padding: 1rem;
}
.modal-footer {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: end;
    justify-content: flex-end;
    padding: 1rem;
    border-top: 1px solid #e9ecef;
}
.close{
        opacity:1;
}

</style>";

        $html = '<div id="exampleModalPopovers" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalPopoversLabel" style="display: block; padding-right: 17px;">
        <div class="" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalPopoversLabel">Modal title</h5>
              <button type="button" style="padding:5px;" class="close" data-dismiss="modal" aria-label="Close" onclick="HelloWOrld()">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="col-md-5">
            <label>Modules</label><br>
              <select onchange="LoadWorkflows_Which_Are_Relatedto_selected_option(this)" style="width:200px;">
              ';
              foreach($app_list_strings['aow_moduleList'] as $mkey => $mvalue){
                $html.=' <option value="'.$mkey.'">'.$mvalue.'</option>';
              }

              $html.='</select>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-6">
              <label>Workflows</label><br>
              <select name="AllWorkFlows"  style="width:200px;">
              ';
              $html.='</select>

            </div>
            </div>
            <div class="modal-footer">
              <button type="button"  style="
              width:100px;
              display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
   // padding: 0.375rem 0.75rem;
    font-size: 1.5rem;
    line-height: 2;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
              " data-dismiss="modal">run</button>
            </div>
          </div>
        </div>
      </div>


      ';

echo $html;

            // Object.entries(result).forEach(([key, v]) => {
            // $(".bd").append(`<div class="container" style="width: 600px;font-size:15px;
            // background-color:white;">
            // <form action="index.php?module=Documents&action=submit_qc_remarks" method
            // ="POST" id="form_id">
            // <input type="hidden" id="record_id" name="record_id" value="${v.id}">
            // <input type="hidden" id="users_id" name="users_id" value="${v.created_by}">
            // <input type="hidden" id="module_name" name="module_name" value="${v.Module}">
            // <input type="hidden" id="document_name" name="document_name"
            // value="${v.document_name}">
            // <div class="form-group">
            // <label for="remarks">Remarks</label>
            // <textarea style="overflow:scroll;" class="form-control" id="remarks" name="remarks"
            // rows="10" cols="5" required></textarea>
            // </div>
            // <div class="form-group">
            // <input type="submit" class="btn btn-info" id="save_btn" name="save_btn">
            // </div>
            // </form></div> `);
            // })
       // return $html;
    }

}
