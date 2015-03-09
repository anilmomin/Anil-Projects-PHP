
	$(function(){

			

				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
	

				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					width: 600,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$('a.progress img.status').attr('src','/pharmaadmin/assets/images/grey.png');
							$('a.progress').parent().find('> img:first').attr('src','/pharmaadmin/assets/images/red.png');
							$('a.progress').removeClass('progress');
							
							$('img.grey').removeClass('grey');
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('a.progress  img.status').attr('src','/pharmaadmin/assets/images/yellow.png');
							$('a.progress img.status').insertAfter('a.progress');
							$('a.progress').remove();
							$('img.grey').attr('src','/pharmaadmin/assets/images/grey.png');
							$('img.grey').removeClass('grey');
							
						} 
					}
				});
				
				$( "#dialog").parent().addClass("dialog");
				
				// Dialog Link
				$('.dialog_link').click(function(){
					$('#dialog').dialog('open');
					$(this).addClass('progress');
					$(this).find('img.status').attr('src','/pharmaadmin/assets/images/yellow.png');
					$(this).parent().find('> img:first').addClass('grey').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				// Dialog Link 2		
				$('#dialog_link2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					width: 600,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$('a.progress img.status').attr('src','/pharmaadmin/assets/images/grey.png');
							$('a.progress').parent().find('> img:first').attr('src','/pharmaadmin/assets/images/red.png');
							$('a.progress').removeClass('progress');
							
							$('img.grey').removeClass('grey');
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('a.progress  img.status').attr('src','/pharmaadmin/assets/images/yellow.png');
							$('a.progress img.status').insertAfter('a.progress');
							$('a.progress').remove();
							$('img.grey').attr('src','/pharmaadmin/assets/images/grey.png');
							$('img.grey').removeClass('grey');
							
						} 
					}
				});
				
				$( "#dialog_link2").parent().addClass("dialog_link2");
				
				// Dialog Link
				$('.dialog_links2').click(function(){
					$('#dialog_link2').dialog('open');
					$(this).addClass('progress');
					$(this).find('img.status').attr('src','/pharmaadmin/assets/images/yellow.png');
					$(this).parent().find('> img:first').addClass('grey').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				
//------------------------------Details--------------------------//
				$('#dialog_details').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_details").parent().parent().removeClass("deleted");
						}, 
						"update": function() { 
							$(this).dialog("close");
							//$('#dialog_disp_sent').dialog('open');
							
						} 
					}
				});
				
				$('.dialog_details').click(function(){
					$('#dialog_details').dialog('open');
					$(this).parent().parent().addClass("deleted");
					return false;
				});
				
				$( "#dialog_details").parent().addClass("dialog_details");


//------------------------------Details 2--------------------------//

				$('#dialog_details2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_details2").parent().parent().removeClass("deleted");
						}, 
						"update": function() { 
							$(this).dialog("close");
							//$('#dialog_disp_sent').dialog('open');
							
						} 
					}
				});
				
				$('.dialog_details2').click(function(){
					$('#dialog_details2').dialog('open');
					$(this).parent().parent().addClass("deleted");
					return false;
				});
				
				$( "#dialog_details2").parent().addClass("dialog_details2");

			
//------------------------------ end Details--------------------------//

//------------------------------Details 3--------------------------//

				$('#dialog_details3').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_details3").parent().parent().removeClass("deleted");
						}, 
						"update": function() { 
							$(this).dialog("close");
							//$('#dialog_disp_sent').dialog('open');
							
						} 
					}
				});
				
				$('.dialog_details3').click(function(){
					$('#dialog_details3').dialog('open');
					$(this).parent().parent().addClass("deleted");
					return false;
				});
				
				$( "#dialog_details3").parent().addClass("dialog_details3");
			
//------------------------------ end Details--------------------------//

//------------------------------Details 4--------------------------//

				$('#dialog_details4').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_details4").parent().parent().removeClass("deleted");
						}, 
						"update": function() { 
							$(this).dialog("close");
							//$('#dialog_disp_sent').dialog('open');
							
						} 
					}
				});
				
				$('.dialog_details4').click(function(){
					$('#dialog_details4').dialog('open');
					$(this).parent().parent().addClass("deleted");
					return false;
				});
				
				$( "#dialog_details4").parent().addClass("dialog_details4");
			
//------------------------------ end Details--------------------------//




		// accept			

				// dispute			
				$('#dialog_disp').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_disp").parent().parent().removeClass("deleted");
							//$('img.prev').index();
							//console.log($('img.prev').index());
							
							if($('img.prev').index() == 0){
								   $('img.prev').attr('src','/pharmaadmin/assets/images/red.png');
								}
							else {
								   $('img.prev').attr('src','/pharmaadmin/assets/images/yellow.png');
								}
								
								$('img.prev').removeClass('prev');
								$('img.current').attr('src','/pharmaadmin/assets/images/grey.png').removeClass('current');
							
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('#dialog_disp_sent').dialog('open');
							
							
						} 
					}
				});
				
				$('.dialog_disp').click(function(){
					$('#dialog_disp').dialog('open');
					$(this).parent().parent().addClass("deleted");
					
					$(this).parent().find('img[src*="red"]').addClass('prev');
					$(this).parent().find('img[src*="yellow"]').addClass('prev');
					$(this).find('img').attr('src','/pharmaadmin/assets/images/green.png').addClass('current');
					$('img.prev').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				$( "#dialog_disp").parent().addClass("dialog_disp");
				// disp sent			
				$('#dialog_disp_sent').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
						} 
					}
				});
								
				$( "#dialog_disp_sent").parent().addClass("dialog_disp_sent");
/////--------------------Row 2--------------------------------------/////
// accept			

				// dispute			
				$('#dialog_dispr2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_dispr2").parent().parent().removeClass("deleted");
							//$('img.prev').index();
							//console.log($('img.prev').index());
							
							if($('img.prev').index() == 0){
								   $('img.prev').attr('src','/pharmaadmin/assets/images/red.png');
								}
							else {
								   $('img.prev').attr('src','/pharmaadmin/assets/images/yellow.png');
								}
								
								$('img.prev').removeClass('prev');
								$('img.current').attr('src','/pharmaadmin/assets/images/grey.png').removeClass('current');
							
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('#dialog_disp_sentr2').dialog('open');
							
							
						} 
					}
				});
				
				$('.dialog_dispr2').click(function(){
					$('#dialog_dispr2').dialog('open');
					$(this).parent().parent().addClass("deleted");
					
					$(this).parent().find('img[src*="red"]').addClass('prev');
					$(this).parent().find('img[src*="yellow"]').addClass('prev');
					$(this).find('img').attr('src','/pharmaadmin/assets/images/green.png').addClass('current');
					$('img.prev').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				$( "#dialog_dispr2").parent().addClass("dialog_dispr2");
				// disp sent			
				$('#dialog_disp_sentr2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
						} 
					}
				});
								
				$( "#dialog_disp_sentr2").parent().addClass("dialog_disp_sentr2");
				


/////-------------------- Row 2 end --------------------------------------/////

// accept In progress			

				// dialog_In progress			
				//$('#dialog_inprogress').dialog({
//					autoOpen: false,
//					buttons: {
//						"cancel": function() { 
//							$(this).dialog("close"); 
//							$(".dialog_inprogress").parent().parent().removeClass("deleted");
//						}, 
//						"update": function() { 
//							$(this).dialog("close");
//							$('#dialog_inprogress_sent').dialog('open');
//							
//						} 
//					}
//				});
//				
//				$('.dialog_inprogress').click(function(){
//					$('#dialog_inprogress').dialog('open');
//					$(this).parent().parent().addClass("deleted");
//					return false;
//				});
//				
//				$( "#dialog_inprogress").parent().addClass("dialog_inprogress");
//				// disp sent			
//				$('#dialog_inprogress_sent').dialog({
//					autoOpen: false,
//					buttons: {
//						"ok": function() { 
//							$(this).dialog("close");
//							//$("tr.deleted").hide("slow");
//						} 
//					}
//				});
//								
//				$( "#dialog_inprogress_sent").parent().addClass("dialog_inprogress_sent");

////////////////----------------- in progress 1----------------------------- ////////////////////////	
				$('#dialog_inprogress').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_inprogress").parent().parent().removeClass("deleted");
							//$('img.prev').index();
							//console.log($('img.prev').index());
							
							if($('img.prev').index() == 0){
								   $('img.prev').attr('src','/pharmaadmin/assets/images/red.png');
								}
							else {
								   $('img.prev').attr('src','/pharmaadmin/assets/images/green.png');
								}
								
								$('img.prev').removeClass('prev');
								$('img.current').attr('src','/pharmaadmin/assets/images/grey.png').removeClass('current');
							
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('#dialog_inprogress_sent').dialog('open');
							
							
						} 
					}
				});
				
				$('.dialog_inprogress').click(function(){
					$('#dialog_inprogress').dialog('open');
					$(this).parent().parent().addClass("deleted");
					
					$(this).parent().find('img[src*="green"]').addClass('prev');
					$(this).parent().find('img[src*="yellow"]').addClass('prev');
					$(this).find('img').attr('src','/pharmaadmin/assets/images/yellow.png').addClass('current');
					$('img.prev').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				$( "#dialog_inprogress").parent().addClass("dialog_disp");
				// disp sent			
				$('#dialog_inprogress_sent').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
						} 
					}
				});
								
				$( "#dialog_inprogress_sent").parent().addClass("dialog_inprogress_sent");
////////////////----------------- End  in progress 1----------------------------- ////////////////////////				

////////////////----------------- in progress 2----------------------------- ////////////////////////	
				$('#dialog_inprogressr2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".dialog_inprogressr2").parent().parent().removeClass("deleted");
							//$('img.prev').index();
							//console.log($('img.prev').index());
							
							if($('img.prev').index() == 0){
								   $('img.prev').attr('src','/pharmaadmin/assets/images/red.png');
								}
							else {
								   $('img.prev').attr('src','/pharmaadmin/assets/images/green.png');
								}
								
								$('img.prev').removeClass('prev');
								$('img.current').attr('src','/pharmaadmin/assets/images/grey.png').removeClass('current');
							
						}, 
						"update": function() { 
							$(this).dialog("close");
							$('#dialog_inprogress_sentr2').dialog('open');
							
							
						} 
					}
				});
				
				$('.dialog_inprogressr2').click(function(){
					$('#dialog_inprogressr2').dialog('open');
					$(this).parent().parent().addClass("deleted");
					
					$(this).parent().find('img[src*="green"]').addClass('prev');
					$(this).parent().find('img[src*="yellow"]').addClass('prev');
					$(this).find('img').attr('src','/pharmaadmin/assets/images/yellow.png').addClass('current');
					$('img.prev').attr('src','/pharmaadmin/assets/images/grey.png');
					return false;
				});
				
				$( "#dialog_inprogressr2").parent().addClass("dialog_disp");
				// disp sent			
				$('#dialog_inprogress_sentr2').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"ok": function() { 
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
						} 
					}
				});
								
				$( "#dialog_inprogress_sentr2").parent().addClass("dialog_inprogress_sentr2");
////////////////----------------- End  in progress 2----------------------------- ////////////////////////	


////////////////----------------- Publish ----------------------------- ////////////////////////	

// dispute		
				var recordId = '';
				var trClass = '';
					
				$('#publish').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"cancel": function() { 
							$(this).dialog("close"); 
							$(".publish").parent().parent().removeClass("deleted");
							//$('img.prev').index();
							//console.log($('img.prev').index());
						}, 
						"update": function() { 
							$(this).dialog("close");
							//$('#publish_sent').dialog('open');							
							
						} 
					}
				});
				
				$('.publish').click(function(){
					$('#pending_container').show();
					$('#publish_sent').dialog('open');
					$(this).parent().parent().addClass("deleted");
					recordId = $(this).attr('id');
					return false;
				});
				
				$( "#publish").parent().addClass("publish");
				// disp sent	
				trClass = $("#pendinggrid tr:last").attr('class');
						
				$('#publish_sent').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"No": function() { 
							$(this).dialog("close"); 
							$(".publish").parent().parent().removeClass("deleted");
			
						}, 
						"Yes": function() { 
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
							$.ajax({
							  url: "<?php echo site_url('pharmaAction/publishsifiles')?>"+"/"+recordId,
							  type: "POST",
							  data: 'trClass'+trClass,
							  cache: false,
							  success: function(data) {
									
									$("#pendinggrid").append(data);
									
									
							  }
							});				
							
							
							
							
						} 
					}
				});
								
				$( "#publish_sent").parent().addClass("publish_sent");
				
////////////////----------------- Publish End ----------------------------- ////////////////////////

////////////////----------------- Delete ----------------------------- ////////////////////////	
				
				$('.deletepopup').click(function(){
					$('#deletepopup_sent').dialog('open');
					$(this).parent().parent().addClass("deleted");
					recordId = $(this).attr('id');
					return false;
				});
				
				$( "#deletepopup").parent().addClass("deletepopup");
				// disp sent			
				
				
				$('#deletepopup_sent').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"No": function() { 
							$(this).dialog("close"); 
							$(".deletepopup").parent().parent().removeClass("deleted");
			
						}, 
						"Yes": function() { 
							// ajax delete call anil						
						 $.ajax({
							  url: "<?php echo site_url('pharmaAction/deletesifiles')?>"+"/"+recordId,
							  type: "POST",
							  cache: false,
							  success: function(data) {
									
							  }
							});				
				
						
						
						
							$(this).dialog("close");
							$("tr.deleted").hide("slow");
						} 
					}
				});
								
				$( "#deletepopup_sent").parent().addClass("deletepopup_sent");
				
////////////////----------------- Delete End ----------------------------- ////////////////////////


////////////////----------------- Delete ----------------------------- ////////////////////////	
				
				$('.reportdetails').click(function(){
					$('#reportbtn_popup').dialog('open');
					//$(this).parent().parent().addClass("deleted");
					recordId = $(this).attr('id');
					
					
					 $.ajax({
							  url: "<?php echo site_url('pharmaAction/getInstanceReport')?>"+"/"+recordId,
							  type: "POST",
							  cache: false,
							  success: function(data) {
									$("#reportbtn_popup").empty().append(data);
							  }
							});	
					
					return false;
					
					
				});
				
				//$( "#deletepopup").parent().addClass("deletepopup");
				// disp sent			
				
					
				
				$('#reportbtn_popup').dialog({
					autoOpen: false,
					resizable: false,
					modal: true,
					buttons: {
						"ok": function() { 
							$(this).dialog("close"); 
							$(".reportdetails").parent().parent().removeClass("deleted");
			
						}
					}
				});
								
				$( "#reportbtn_popup").parent().addClass("deletepopup_sent");
				
//////////////////////// Report Detail End










				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});
				
				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});
				
				// Progressbar
				$("#progressbar").progressbar({
					value: 20 
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					//function() { $(this).addClass('ui-state-hover'); }, 
					//function() { $(this).removeClass('ui-state-hover'); }
				);


				//anil
				
			/*	$("#dashboard_tab").click(function(){
					$("#minval").val("");
					$("#maxval").val("");
					$("#begindate").val("");
					$("#enddate").val("");
					$("input[name='currentDispute']:last").attr('checked','checked');
					$("#physician").attr("selected","selected");
					alert("asdf");
				});*/
				
		
		
				$("#upload").click(function(){
					$("#loading").show();
					$.ajax({
					  url: "<?php echo site_url('pharmaAction/addlastuploadedrecord/')?>",
					  type: "POST",
					  cache: false,
					  success: function(data) {
							$("#currentuploads").append(data);
					  }
					});
				});
		
		
				var checked = '';
				$('input[name="status"]').click(function(){
					 checked = ($("input[name=status]:checked").map(
						     	function () {return this.value;}).get().join(","));
				});
				

				var dispchecked = '';
				$('input[name="currentDispute"]').click(function(){
					 dispchecked = ($("input[name=currentDispute]:checked").map(
						     	function () {return this.value;}).get().join(","));
				});
				
                
				$(".archive").click(function () {
				$(".archive-result").show('blind');
				
				  $.ajax({
					  url: "<?php echo site_url('pharmaAction/getReport')?>",
					  type: "POST",
					  cache: false,
					 data: "status="+checked+"&dispchecked="+dispchecked+"&physician="+$("#physician").val()+"&minval="+ $("#minval").val() +"&maxval="+ $("#maxval").val() +"&begindate="+ $("#begindate").val()+"&enddate="+ $("#enddate").val() +"&speciality="+$("#speciality").val()+"&form="+ $("#form").val()+"&drugname="+$("#drugname").val()+"&nature="+$("#nature").val(),
					  success: function(data) {
							$("#reportgrid").empty().append(data);
					  }
					});
				});
				
				$('.datepicker').datepicker({
					showOn: "button",
					buttonImage: '<?php echo base_url() . "/assets/images/calendar.gif"; ?>',
					buttonImageOnly: true
				});
				
				
			});

			
			function submit_form() {
	
	if(validate_userdata())
	{

		document.forms["pharmaform"].submit();
		
	}
	 
}

function submit_password_form() {

	if(validate_password_fields())
	{

		document.forms["passwordform"].submit();
		
	}
		
}

function submit_forget_form() {

	if(validate_forget_fields())
	{

		document.forms["passwordform"].submit();
		
	}
		
}







function RestrictTyping(maxL,fld,counterID)
{


if(fld.value.length>maxL)
{

fld.value=fld.value.substring(0,maxL);

}
else
{
if (document.getElementById(counterID))
{

document.getElementById(counterID).innerHTML=maxL-fld.value.length;
}
}

}


function validate_forget_fields() {

	var pharmaemail =  $("input[name='pharmaemail']").val();
	var newpassword = $("input[name='newpwd']").val();
	var confirmpassword = $("input[name='confirmpwd']").val();
		
		if(pharmaemail == '')
							{
								$('#erradminemail').removeClass("hide");
								
							}
							else 
							{
								$('#erradminemail').addClass("hide");
								
							}
							
							regx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
							var validemail = 0;
							if(!regx.test(pharmaemail) && pharmaemail != '')
							{
								$('#usrerrmsg').html("Invalid Email Address syntax...");
								return false;
								
							}
							else 
							{
								$('#usrerrmsg').html("");
								validemail  = 1;
								
							}

	if(newpassword == '')
	{
		$('#errnew').removeClass("hide");
		
	}
	else 
	{
		$('#errnew').addClass("hide");

	}

	
	if(confirmpassword == '')
	{
		$('#errconfirm').removeClass("hide");
		
	}
	else 
	{
		$('#errconfirm').addClass("hide");

	}

	

	if( confirmpassword != '' && (confirmpassword == newpassword) && pharmaemail !='' &&  validemail)
	{		
		return true;
	}
	if(pharmaemail != '' && newpassword != '' && confirmpassword != '' && confirmpassword != newpassword)
	{
		$('#passmsg').html("Confirm password did not match.");
		return false;
	}
	else
	{
		$('#passmsg').html("Please fill (*) required fields properly..");
		return false;	
	}

	
}















function validate_password_fields() {

	var oldpassword =  $("input[name='currentpwd']").val();
	var newpassword = $("input[name='newpwd']").val();
	var confirmpassword = $("input[name='confirmpwd']").val();
		
	if(oldpassword == '')
	{
		$('#errold').removeClass("hide");
		
	}
	else 
	{
		$('#errold').addClass("hide");

	}


	if(newpassword == '')
	{
		$('#errnew').removeClass("hide");
		
	}
	else 
	{
		$('#errnew').addClass("hide");

	}

	
	if(confirmpassword == '')
	{
		$('#errconfirm').removeClass("hide");
		
	}
	else 
	{
		$('#errconfirm').addClass("hide");

	}

	

	if(oldpassword != ''  && newpassword != '' && confirmpassword != '' && (confirmpassword == newpassword) )
	{		
		return true;
	}
	if(oldpassword != '' && newpassword != '' && confirmpassword != '' && confirmpassword != newpassword)
	{
		$('#passmsg').html("Confirm password did not match.");
		return false;
	}
	else
	{
		$('#passmsg').html("Please fill (*) required fields properly..");
		return false;	
	}

	
}


function validate_userdata(){
	
	var name =  $("input[name='name']").val();
	var adminName = $("input[name='adminname']").val();
	var adminTitle = $("input[name='admintitle']").val();
	var adminEmail = $("input[name='adminemail']").val();
	var description = $("textarea[name='description']").val();
	var address = $("textarea[name='address']").val();
	var phoneNum = $("input[name='phonenum']").val();
	var faxNum = $("input[name='fax']").val();
	var website = $("input[name='website']").val();
	
							
							if(name == '')
							{
								$('#errname').removeClass("hide");
								
							}
							else 
							{
								$('#errname').addClass("hide");
						
							}
							
							
							if(adminName == '')
							{
								$('#erradminname').removeClass("hide");
								
							}
							else 
							{
								$('#erradminname').addClass("hide");
								
							}
							
							
							if(adminTitle == '')
							{
								$('#erradmintitle').removeClass("hide");
								
							}
							else 
							{
								$('#erradmintitle').addClass("hide");
								
							}

							
							if(description.length == 0)
							{
								$('#errdescription').removeClass("hide");
								
							}
							else
							{
								$('#errdescription').addClass("hide");
								
							}

							if(address.length == 0)
							{
								$('#erraddress').removeClass("hide");
								
							}
							else
							{
								$('#erraddress').addClass("hide");
								
							}



							if(phoneNum == '')
							{
								$('#errphone').removeClass("hide");
								
							}
							else
							{
								$('#errphone').addClass("hide");
								
							}

							if(faxNum == '')
							{
								$('#errfax').removeClass("hide");
								
							}
							else
							{
								$('#errfax').addClass("hide");
								
							}

							if(website == '')
							{
								$('#errweb').removeClass("hide");
								
							}
							else
							{
								$('#errweb').addClass("hide");
								
							}

							var webcheck = true;
							if(website != '')
							{
								var regexp = /[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/;
							 	if(!regexp.test(website)){	
									$('#errweb').addClass("hide");
									webcheck = false;
							 	}
							 	else
							 	{
							 		webcheck = true;
								 	}
							}
							
							

							
	if(name != ''  && adminName != '' && adminTitle != '' && description.length != 0 && phoneNum != '' && address.length != 0 && website != '' && faxNum != '' && webcheck == true )
	{		
		return true;
	}
	else if(!webcheck)
	{
		$('#usrerrmsg').html("Invalid url provided.");
		$('#errweb').removeClass("hide");
	}
	else
	{
		$('#usrerrmsg').html("Please fill (*) required fields properly..");
		return false;	
	}

	
}

jQuery(document).ready(function($){


	// Validation of textboxes
	$('.alphabets').bind('keyup blur',function(){ 
	    $(this).val( $(this).val().replace(/[^a-zA-Z0-9]*/g,'') ); }
	);

	// Phone Num
	$('.phonenum').bind('keyup blur',function(){ 
		$(this).val( $(this).val().replace(/[^\(\+0-9\-\) ]/g,'') ); }
	);	
	
	$(".numeric").numeric();
	
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
			
});
