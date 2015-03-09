<?php
//Javascript and jQuery text
$lang['addwine_validation'] = '

$().ready(function() {

// validate signup form on keyup and submit
$("#wineForm").validate({
rules: {
mon_wineName: "required",
mon_wineTag: "required",
mon_wineDescription: "required",
mon_winePrice: "required",
mon_wineQuantity: "required",
mon_winebigImage: "required",
tue_wineName: "required",
tue_wineTag: "required",
tue_wineDescription: "required",
tue_winePrice: "required",
tue_wineQuantity: "required",
tue_winebigImage: "required",
wed_wineName: "required",
wed_wineTag: "required",
wed_wineDescription: "required",
wed_winePrice: "required",
wed_wineQuantity: "required",
wed_winebigImage: "required",
thur_wineName: "required",
thur_wineTag: "required",
thur_wineDescription: "required",
thur_winePrice: "required",
thur_wineQuantity: "required",
thur_winebigImage: "required",
fri_wineName: "required",
fri_wineTag: "required",
fri_wineDescription: "required",
fri_winePrice: "required",
fri_wineQuantity: "required",
fri_winebigImage: "required"

},
messages: {
mon_wineName: "Please enter the Wine Name",
mon_wineTag: "Please enter the Wine Tag",
mon_wineDescription: "Please enter Wine Description",
mon_winePrice: "Please enter Wine price",
mon_wineQuantity: "Please enter Wine quantity",
mon_winebigImage: "Please enter a Big Image of Wine",
tue_wineName: "Please enter the Wine Name",
tue_wineTag: "Please enter the Wine Tag",
tue_wineDescription: "Please enter Wine Description",
tue_winePrice: "Please enter Wine price",
tue_wineQuantity: "Please enter Wine quantity",
tue_winebigImage: "Please enter a Big Image of Wine",
wed_wineName: "Please enter the Wine Name",
wed_wineTag: "Please enter the Wine Tag",
wed_wineDescription: "Please enter Wine Description",
wed_winePrice: "Please enter Wine price",
wed_wineQuantity: "Please enter Wine quantity",
wed_winebigImage: "Please enter a Big Image of Wine",
thur_wineName: "Please enter the Wine Name",
thur_wineTag: "Please enter the Wine Tag",
thur_wineDescription: "Please enter Wine Description",
thur_winePrice: "Please enter Wine price",
thur_wineQuantity: "Please enter Wine quantity",
thur_winebigImage: "Please enter a Big Image of Wine",
fri_wineName: "Please enter the Wine Name",
fri_wineTag: "Please enter the Wine Tag",
fri_wineDescription: "Please enter Wine Description",
fri_winePrice: "Please enter Wine price",
fri_wineQuantity: "Please enter Wine quantity",
fri_winebigImage: "Please enter a Big Image of Wine"


}
});

});	';



$lang['editwine_validation'] = '

$().ready(function() {

// validate signup form on keyup and submit
$("#wineForm").validate({
rules: {
mon_wineName: "required",
mon_wineTag: "required",
mon_wineDescription: "required",
mon_winePrice: "required",
mon_wineQuantity: "required",
tue_wineName: "required",
tue_wineTag: "required",
tue_wineDescription: "required",
tue_winePrice: "required",
tue_wineQuantity: "required",
wed_wineName: "required",
wed_wineTag: "required",
wed_wineDescription: "required",
wed_winePrice: "required",
wed_wineQuantity: "required",
thur_wineName: "required",
thur_wineTag: "required",
thur_wineDescription: "required",
thur_winePrice: "required",
thur_wineQuantity: "required",
fri_wineName: "required",
fri_wineTag: "required",
fri_wineDescription: "required",
fri_winePrice: "required",
fri_wineQuantity: "required"


},
messages: {
mon_wineName: "Please enter the Wine Name",
mon_wineTag: "Please enter the Wine Tag",
mon_wineDescription: "Please enter Wine Description",
mon_winePrice: "Please enter Wine price",
mon_wineQuantity: "Please enter Wine quantity",
tue_wineName: "Please enter the Wine Name",
tue_wineTag: "Please enter the Wine Tag",
tue_wineDescription: "Please enter Wine Description",
tue_winePrice: "Please enter Wine price",
tue_wineQuantity: "Please enter Wine quantity",
wed_wineName: "Please enter the Wine Name",
wed_wineTag: "Please enter the Wine Tag",
wed_wineDescription: "Please enter Wine Description",
wed_winePrice: "Please enter Wine price",
wed_wineQuantity: "Please enter Wine quantity",
thur_wineName: "Please enter the Wine Name",
thur_wineTag: "Please enter the Wine Tag",
thur_wineDescription: "Please enter Wine Description",
thur_winePrice: "Please enter Wine price",
thur_wineQuantity: "Please enter Wine quantity",
fri_wineName: "Please enter the Wine Name",
fri_wineTag: "Please enter the Wine Tag",
fri_wineDescription: "Please enter Wine Description",
fri_winePrice: "Please enter Wine price",
fri_wineQuantity: "Please enter Wine quantity"
}
});

});	';

$lang['homeform'] = '

';

$lang['pagination'] = '
applyPagination();

    function applyPagination() {
      $("#ajax_paging a").click(function() {
        var url = $(this).attr("href");
        $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#content").html("");
          },
          success: function(msg) {
            $("#content").html(msg);
            applyPagination();
          }
        });
        return false;
      });
    }
';

$lang['newsticker'] = '$("#news").jCarouselLite({
        vertical: true,
        hoverPause:true,
        btnPrev: ".previous",
        btnNext: ".nextbtn",
        visible: 5,
        auto:3000,
        speed:500
    });
$("#discussticker").jCarouselLite({
        vertical: true,
        hoverPause:true,
        btnPrev: ".disprevious",
        btnNext: ".disnextbtn",
        visible: 5,
        auto:3000,
        speed:500
    });
'; 

$lang['newuser'] = '$("#userform").validate({
rules: {
firstname: "required",
lastname: "required",
email: {
required: true,
email: true,
},
password: {
required: true,
minlength: 5,
},
cpassword: {
required: true,
minlength: 5,
equalTo: "#password"
}
},
messages: {
firstname: "Please enter the First Name",
lastname: "Please enter the Last Name",
email: {
required: "Please enter the email address",
minlength: "Please enter a valid email address",

},
password:  {
required: "Please enter a password",
rangelength: jQuery.format("Enter at least {0} characters")
},
cpassword: {
required: "Repeat your password",
minlength: jQuery.format("Enter at least {0} characters"),
equalTo: "Enter the same password as above"
},
}
});';




$lang['step1'] = '$("#verifyform").validate({
rules: {
firstname: "required",
lastname: "required",
email: {
				required: true,
				email: true,
				},
password: {
			required: true,
			minlength: 5,
},
cpassword: {
			required: true,
			minlength: 5,
			equalTo: "#password"
}
},
messages: {
firstname: "Please enter the First Name",
lastname: "Please enter the Last Name",
email: {
				required: "Please enter the email address",
				minlength: "Please enter a valid email address",
				
		},	
password:  {
				required: "Please enter a password",
				rangelength: jQuery.format("Enter at least {0} characters")
			},
cpassword: {
				required: "Repeat your password",
				minlength: jQuery.format("Enter at least {0} characters"),
				equalTo: "Enter the same password as above"
			},
}


});


function selectvalidate()
{
	var date = true;
	
	if($("#bmonth option:selected").val() == "0")
	{
		date = false;
	}
	
	if($("#bday option:selected").val() == "0")
	{
		date = false;
	}
	
	if($("#byear option:selected").val() == "0")
	{
		date = false;
	}

	if(!date)
	{	
		$("#invdate").show();
		
	}
	else
	{
		$("#invdate").hide();
		return true;
	}
		
		
}


$("#byear").change(function(){
	selectvalidate();
});

$("#submit").click(function(){
	selectvalidate()
});
';


$lang['claim']  =  '$("#claimform").validate({
rules: {
firstname: "required",
lastname: "required",
address: "required",
suburb: "required",
postcode: "required",
encycode: "required"
},
messages: {
firstname: "Please enter the First Name",
lastname: "Please enter the Last Name",
address: "Please enter your Address",	
suburb: "Please enter your suburb",
postcode: "Please enter your postcode",
encycode:"Please enter the encryption code"
}
});


function stateSelect()
{
	if($("#state option:selected").val() == "0")
	{
		$("#errorstate").html("Please select a state");
		$("#errorstate").addClass("error");
	}
	else
	{
		$("#errorstate").html("");
		$("#errorstate").removeClass("error");
	}

}


$("#submit").click(function(){
	stateSelect();
});


$("#state").change(function(){
	stateSelect();
});
';



$lang['feedback']  =  '$("#feedbackform").validate({
rules: {
firstname: "required",
lastname: "required",
email: "required email",
productcode: "required",
estvalue: "required",
quality: "required",
style: "required",
label: "required",
labelInfo: "required",
hearaboutus : "required",
encycode: "required"
},
messages: {
winebrand: "Please enter the Wine Brand",
vintage: "Please enter wine\'s vintage",
variety: "Please enter wine\'s variety",
estvalue: "Please enter wine\'s estimated value",
hearaboutus: "Please select an option"	
}
});

';

$lang['birthdate'] = '$("#picker1").birthdaypicker({});
$(".birth-day").wrap(\'<p class="input_reg2" style=" float:left;" />\');
$(".birth-month").wrap(\'<p class="input_reg2" style=" float:left; " />\');
$(".birth-year").wrap(\'<p class="input_reg2" style=" float:left; margin-right:10px;" />\');';


/**
 *  Admin panel Scripts
 */

$lang['datepicker'] = "$('#postdate').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		beforeShow: function(input, instance) {
		$(input).datepicker('setDate', new Date());
		}
		});";


$lang['addwine'] = "Wine has been added successfully.";
$lang['updatewine'] = "Wine has been updated successfully.";

// End of Admin panel Scripts

/**
 * Email subjects
 */ 
$lang['ditchthepitch_subject_feedback'] = 'Confirmation on Feedback';
$lang['ditchthepitch_subject_feedbackparticipant'] = 'Thanks for the Feedback';
$lang['ditchthepitch_subject_sampleinvitation'] = 'Wine Sample Participation';
$lang['ditchthepitch_subject_confirmrequest'] = 'Wine Sample Confirmation';
$lang['ditchthepitch_subject_newsletter'] = 'Wine Subscription'; 

// Errors
$lang['activationcode_expired'] = 'Your Activation Code has Expired, Please Register again to get another code';
$lang['invalid_code'] = 'Invalid Code provided!';
$lang['age_limit'] = 'You are not eligible for our program because of Age Limit';
$lang['reside_australia'] = 'You are not eligible for our program because you don\'t reside in Australia';
$lang['alcohol_restriction'] = 'You are not eligible for our program because Alcohol is prohibited in your Area';
$lang['already_claimed'] = "You cannot request another wine sample, you have already claimed a wine sample";
$lang['invalid_access'] = "You must first login to access the page!";


?>