// ======Send Ajax Request to Fetch Data========
$(document).ready(function() {
    var encoded_array =$('#encoded_array').val();
    console.log(encoded_array);
 if(encoded_array!="") {
    console.log(encoded_array);
    $("#new_cases > tbody").children('tr').remove();
    $("#new_source_advertisement > tbody").children('tr').remove();
    $("#new_cost > tbody").children('tr').remove();
    $("#new_records_received > tbody").children('tr').remove();
    $("#new_records_requested > tbody").children('tr').remove();
    $("#documents_info > tbody").children('tr').remove();
    $("#cases_closed_info > tbody").children('tr').remove();
    let all_events = $('.all_events').val();
    let all_years  = $('.all_years').val();
    let all_years_text  = $('.all_years option:selected').text();
    let all_months = $('.all_months').val();
            let return_result = JSON.parse(encoded_array);
            console.log(return_result);
            $.each(return_result, function (index, obj) {
              // $(".all_months option[value='" + index + "']").prop('selected', true);
            });
            if(all_events == 1){
            $.each(return_result, function (index, obj) {
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                        $(".cost_info_block").css("display", "none");
                        $(".source_advertisement_block").css("display", "none");
                        $(".cases_closed").css("display", "none");
                        $(".documents_generated").css("display", "none");
                        $(".medical_records_requested").css("display", "none");
                        $(".medical_records_received").css("display", "none");
                        $(".new_cases_block").css("display", "block");
                        $("#new_cases > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+obj.count+"&nbsp;&nbsp;<i  onclick='show_details_c(`"+month_name+"`);' class='fa fa-info-circle' style='font-size:14px; color: #edd03d;  ' ></i></td></tr>");
            });             
                

          }else if(all_events == 3){
                $.each(return_result, function (index, obj) {
                    let case_source = obj.source;
                    if (case_source.length === 0) {
                        case_source = '';
                    }
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                    $(".cost_info_block").css("display", "none");
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "block");
                    $("#new_source_advertisement > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+case_source+"</td></tr>");
                });
            }else if(all_events == 4){
                $.each(return_result, function (index, obj) {
                        let cost_info = obj.count;
                        switch (index) {
                            case '1':
                                month_name  = "January";
                                break;
                            case '2':
                                month_name  = "February";
                                break;
                            case '3':
                                month_name  = "March";
                                break;
                            case '4':
                                month_name  = "April";
                                break;
                            case '5':
                                month_name  = "May";
                                break;
                            case '6':
                                month_name  = "June";
                                break;
                            case '7':
                                month_name  = "July";
                                break;
                            case '8':
                                month_name  = "August";
                                break;
                            case '9':
                                month_name  = "September";
                                break;
                            case '10':
                                month_name  = "October";
                                break;
                            case '11':
                                month_name  = "November";
                                break;
                            default:
                                month_name = "December";
                        }

                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "block");
                    $("#new_cost > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+cost_info+"</td></tr>");
                });
            }else if(all_events == 5){
                $.each(return_result, function (index, obj) {
                    let status_info = obj.status;
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "block");
                    $("#new_records_received > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+status_info+"</td></tr>");
                });
            }else if(all_events == 6){
                $.each(return_result, function (index, obj) {
                    let medical_status_info = obj.medical_status;
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                    $(".cases_closed").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "block");
                    $("#new_records_requested > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+medical_status_info+"</td></tr>");
                });
            }else if(all_events == 7){
                $.each(return_result, function (index, obj) {
                    let documents_generated = obj.soft_documents;
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                    $(".cases_closed").css("display", "none");
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".documents_generated").css("display", "block");
                    $("#documents_info > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+documents_generated+"</td></tr>");
                });
            }else if(all_events == 2){
                $.each(return_result, function (index, obj) {
                    let closed_cases_info = obj.closed_cases;
                    switch (index) {
                        case '1':
                            month_name  = "January";
                            break;
                        case '2':
                            month_name  = "February";
                            break;
                        case '3':
                            month_name  = "March";
                            break;
                        case '4':
                            month_name  = "April";
                            break;
                        case '5':
                            month_name  = "May";
                            break;
                        case '6':
                            month_name  = "June";
                            break;
                        case '7':
                            month_name  = "July";
                            break;
                        case '8':
                            month_name  = "August";
                            break;
                        case '9':
                            month_name  = "September";
                            break;
                        case '10':
                            month_name  = "October";
                            break;
                        case '11':
                            month_name  = "November";
                            break;
                        default:
                            month_name = "December";
                    }
                    $(".new_cases_block").css("display", "none");
                    $(".source_advertisement_block").css("display", "none");
                    $(".cost_info_block").css("display", "none");
                    $(".medical_records_received").css("display", "none");
                    $(".medical_records_requested").css("display", "none");
                    $(".documents_generated").css("display", "none");
                    $(".cases_closed").css("display", "block");
                    $("#cases_closed_info > tbody").append("<tr><td style='text-align: center;'>"+month_name+"</td><td style='text-align: center;'>"+closed_cases_info+"</td></tr>");
                });
            }
        }        
});


function show_details_c(month_name) {
    let all_events = $('.all_events').val();
    let all_years  = $('.all_years').val();
    let all_years_text  = $('.all_years option:selected').text();
    let get_details = 'yes';
    $.ajax({
		url: 'index.php?module=Cases&action=case_reports&all_events='+all_events+'&all_years='+all_years+'&all_years_text='+all_years_text+'&month_name='+month_name+'&get_details='+get_details,
		type: 'POST',
		contentType: 'application/x-www-form-urlencoded',
		dataType: 'text',
		data: 'sugar_body_only=true',						
		async: true,			
		success : function (result){
		console.log(result);    	
		}
   
	});
}

