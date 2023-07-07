var fields = ['phone_work', 'phone_other', 'phone_mobile'];
$.each(fields, function(index, value){
	if($('#'+value).length > 0){
		$('#'+value).attr('placeholder', '999-999-9999 X 999999');
		$('#'+value).mask('999-999-9999 X 999999');
	}
});