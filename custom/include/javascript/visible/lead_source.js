$(document).ready(function() {
function initSource(){
        /* $('div[data-label="LBL_REFERRAL_ATTORNEY"]').parent().hide(); */
        $('div[field="referral_attorney_c"]').parent().hide();
        /* $('div[data-label="LBL_REFERRAL_PERSON"]').parent().hide(); */
        $('div[field="referral_person_c"]').parent().hide();
	//Show fields
        value = $('#source_c').val();
        if(value =="Referral_from_Attorney")
        {
                /* $('div[data-label="LBL_REFERRAL_ATTORNEY"]').parent().show(); */
                $('div[field="referral_attorney_c"]').parent().show();
        }
	if(value =="Referral_from_NonAttorney")
        {
                /* $('div[data-label="LBL_REFERRAL_PERSON"]').parent().show(); */
                $('div[field="referral_person_c"]').parent().show();
        }
    changeSource(); //Call onchange function
}

function changeSource(){
     document.getElementById("source_c").onchange = function() {
        initSource(); //Call hide/show function
    }
}
initSource();
});
