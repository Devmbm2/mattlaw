
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
{literal}
<style>
.tableInputs{
    box-sizing: border-box;
}
.tableInputs>div{
    padding:5px;
}
</style>
{/literal}
</head>
<body>
<div class="row tableInputs">
    <div class="col-xs-2">
        <label for="module">module:</label><br>
        <select class="module" id="module" onchange="FetchDataDependingOnSelectedModule()" aria-label="Default select example">
            {$AllModules}
        </select>
    </div>
    <div class="col-xs-2">
        <label for="name">name:</label>
        <select class="name" id="name" aria-label="Default select example">
        </select>
    </div>
    <div class="col-xs-2">
        <label for="workflow">workflow:</label>
        <select class="workflow" id="workflow" aria-label="Default select example">
        </select>
    </div>

    <div class="col-xs-2">
        <label for="Assigned_to">Assigned to:</label>
        <select class="Assigned_to" id="Assigned_to" aria-label="Default select example">
            {$AllUsers}
            {$SecurityGroupdNames}
        </select>
    </div>
    <div class="col-xs-2 Case_Type222">
        <label for="Case_Type">Case Type:</label>
        <select class="Case_Type" id="Case_Type" aria-label="Default select example">
        </select>
    </div>
        <div class="col-xs-2">
        <label for="Status">Status:</label><br>
        <select class="Status" id="Status" aria-label="Default select example">
            {$status}
        </select>
    </div>
</div>{*row ends here*}
    <table id="Table_ID" style="width:100%">
        <thead>
            <tr>
                <th>module</th>
                <th>name</th>
                <th>workflow</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
            </tr>
        </tbody>
    </table>
    {* <script type="text/javascript" src=""></script> *}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="custom/include/javascript/jquery.dataTables.min.js"></script>
    {literal}
<script>

$(document).ready(function() {
$('.Case_Type222').hide();
$('.module').on('change',function(e){
    if($(".module option:selected").val()=='Cases'){
        $('.Case_Type222').show();
    }else{
        $('.Case_Type222').hide();
    }
});
            $('#Table_ID').DataTable({
            "ordering": false,
            'order': [[ 0, 'DESC' ]],
            'searching': false,
            'paging':false,
            'info':false,
            "bDestroy": true,
            /*initComplete: function () {
                    this.api().columns([1]).every( function () {
                        var column = this;
                        $('<input type="text" id="case_other" style="color: black;"/><br>').prependTo( $(column.header()));
                        // We Send Ajax Request and use Append Technique to show Searched Data...
                    });
                }*/
            });
});

function FetchDataDependingOnSelectedModule(){
     $.ajax({
        url:"index.php?module=AOR_Reports&action=getNamesOfModule",
             type: "post",
             data: {moduleName:($("#module").children("option:selected").val())},
             success: function (response, status, jqxhr) {
                $('#name').html(JSON.parse(response).CasesName);
                $('#workflow').html(JSON.parse(response).WorkFlowsName);
                $('#Case_Type').html(JSON.parse(response).CaseTypes);
             }
             });



}
$('.module , .workflow , .Status').on('change',function(){
    setTimeout(datatableData, 1000);
});
function datatableData(){
//console.log("module: "+$("#module").children("option:selected").val()+", workflow : "+);
/*$.ajax({
          url:"index.php?module=AOR_Reports&action=getWorkflowDataBehalfOfSelectedModule",
               type: "post",
               data: {moduleName:($("#module").children("option:selected").val()),'workflow':$("#workflow").val(),'status':$("#Status").val()},
               success: function(response){
                    console.log(response);
               }
           });*/
 $('#Table_ID').DataTable( {
        ajax: {
          url:"index.php?module=AOR_Reports&action=getWorkflowDataBehalfOfSelectedModule",
               type: "post",
               data: {moduleName:($("#module").children("option:selected").val()),'workflow':$("#workflow").val(),'status':$("#Status").val()},
           },
           "ordering": false,
           'order': [[ 0, 'DESC' ]],
           'searching': false,
           'paging':false,
           'info':false,
           "bDestroy": true,
           columns:[
            {data:"ModuleName"},
            {data:function(row){
                    return "";
             }
             },
            {data:'name'},
            {data:'status'},
        ]

      });
}
    </script>
    {/literal}
</body>
    </html>
