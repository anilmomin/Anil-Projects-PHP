<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	include 'designconstants.php' 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo SITE_HEADER_TITLE; ?></title>

<link rel="stylesheet" href="<?php echo CSS_FOLDER .'style.css'; ?>" type="text/css" media="screen"/>

	<!-- Add Dynamic CSS Sources and CSS Scripts -->
	<?php if (isset($CSSSrc)) : ?>
		<?php foreach ($CSSSrc as $src) : ?>
			<link rel="stylesheet" type="text/css" href="<?php echo CSS_FOLDER . $src; ?>" />
	<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($CSSText)) : ?>
		<style type="text/css">
			<?php echo $CSSText; ?>
		</style>
	<?php endif; ?>

<script type="text/javascript" src="<?php echo JS_FOLDER . 'cufon.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JS_FOLDER . 'myriad-pro.cufonfonts.js'; ?>"></script>
<script src="<?=JS_FOLDER?>jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="<?=JS_FOLDER?>facebox/facebox.js" type="text/javascript"></script>
<script src="<?=JS_FOLDER?>popup.js" type="text/javascript"></script>
<?php

$current = array();
$page_uri = explode('/', uri_string());
$uppercurrent = array();
if ($page_uri[0] == "")
	$uppercurrent[0] = "class='active'";
elseif($page_uri[1] == "privacy")
$uppercurrent[1] = "class='active'";
elseif($page_uri[1] == "terms")
$uppercurrent[2] = "class='active'";
else
	$uppercurrent[0] = "class='active'";

?>
<!-- Adds the dynamic javascript files -->
<?php if (isset($javaScriptSrc)) : ?>
		<?php foreach ($javaScriptSrc as $src) : ?>
			<script type="text/javascript" src="<?php echo JS_FOLDER . $src; ?>"></script>
		<?php endforeach; ?>
<?php endif; ?>
	
<script type="text/javascript">

Cufon.replace('#header .navigation li a, #footer .heading', { fontFamily: 'Myriad Pro Condensed', hover: true });
Cufon.replace('#content .banner p, #content ul.registrationArea h3', { fontFamily: 'Myriad Pro Semibold', hover: true });
Cufon.replace('#footer .col h3', { fontFamily: 'Myriad Pro Regular', hover: true });
Cufon.replace('#bottleArea h1', { fontFamily: 'Myriad Pro Condensed', hover: true, textShadow: '1px 1px #666' });
Cufon.replace('#footer .col h3,.banner strong', { fontFamily: 'Myriad Pro Regular', hover: true });
Cufon.replace('#bottleArea h1', { fontFamily: 'Myriad Pro Condensed', hover: true, textShadow: '1px 1px #666' });
Cufon.replace('.banner strong', { fontFamily: 'Myriad Pro Regular', hover: true, textShadow: '1px 1px #4e0503', hover: true });
Cufon.replace('.content .banner p, #content ul.registrationArea h3', { fontFamily: 'Myriad Pro Semibold', hover: true });
Cufon.replace('.dayContent strong', { fontFamily: 'Myriad Pro Regular', hover: true, textShadow: '1px 1px #4e0503',});

function clearText(field) 
{

    if (field.defaultValue == field.value) field.value = '';

    else if (field.value == '') field.value = field.defaultValue;

}
<!-- Add the javascript script text  --> 
<?php if (isset($javaScriptText)) : 
    echo $javaScriptText; 
endif; ?> 

jQuery(document).ready(function($){
	$('a[rel*=facebox]').facebox({
	        loadingImage : '<?php echo JS_FOLDER; ?>facebox/loading.gif',
	        closeImage   : '<?php echo JS_FOLDER; ?>facebox/closelabel.png'
	      });
	$("#winepref1").click(function(){
		$("#content_pane1").hide();
		$("#content_pane2").show();
		
	});	
	
    $("#wineprefback").click(function(){
		    $("#content_pane2").hide();
		    $("#content_pane1").show();
		
	    });	
    
    $("#loginsubmit").click(function(){
        	
			
			var statuschk = true;
			
    		if($("#loginemail").val() == "")
    		{
				statuschk = false;
				$("#err1").show();
				
            }
    		else
    		{
    			statuschk = true;
    			$("#err1").hide();
        	}

			if($("#loginpassword").val() == "")
			{
				statuschk = false;
				$("#err2").show();
			}
			else
			{
				statuschk = true;
				$("#err2").hide();
			}	

			if(statuschk == false)
			{
				$("#mainerror").show();
			}
			else
			{
				$("#mainerror").hide();
				$("#formlogin").submit();
			}
        	
        });

   <?php
	if (isset($JqueryText)) : 
			echo $JqueryText;
		endif; 
	?>
});

jQuery(window).load(function(){
	$("#statusmsg").delay(2800).fadeOut(900);
	
});

</script>

</head>

<body> 

<div id="header">
        <div class="logo">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo IMG_FOLDER . 'logo.png'; ?>" border="0" /></a>
        </div>
        <div class="topNav">
        		
               
 <ul class="topNavigation">
	            <li>
	            
	            <a href="<?php echo site_url('shoppingcart/displaycart')?>"><b style="font-size:15px"><img src="<?=IMG_FOLDER;?>cart.png"/></b><?php //echo $this->cart->total_items();?></a>
	            <p style="margin-left: 23px;"><?php echo ($this->cart->total_items()) ? $this->cart->total_items() . " item(s)" : ''; ?></p>
	            </li>
                <li><a href="#"  id="loginlink"><img src="<?=IMG_FOLDER;?>suscribe.png"/></a></li>
			<li id="topsocial">
				<a href="http://www.facebook.com/DitchThePitch" target="_blank" ><img src="<?=IMG_FOLDER . 'fb.png'?>" alt="socialmedia_facebook" height="26" width="26" /></a>
            </li>
            <li>
            <a href="https://twitter.com/Winepricing" target="_blank"><img src="<?=IMG_FOLDER . 'tw.png'?>" alt="socialmedia_twitter" height="26" width="26" /></a> 
            </li>
            
            <li>
				<a href="http://www.linkedin.com/profile/edit?trk=hb_tab_pro_top" target="_blank"><img src="<?php echo IMG_FOLDER . 'lin.png'; ?>" height="26" width="26" border="0" /></a>  </li>
			<li>
				<a href="http://feedity.com/perthwebsitebuilders-com-au/UFtRUltV.rss"><img src="<?php echo IMG_FOLDER . 'rss.png'; ?>" height="26" width="26" border="0" /></a>
			</li>	
            </ul>
        </div>
        <div class="cb">
        </div>
        <div class="brd">
        </div>
        <?php
          
         if ($page_uri[0] == "" )
         	$current[0] = "class='current'";
         elseif($page_uri[1] == "howitwork")
         	$current[1] = "class='current'";
         elseif($page_uri[0] == "awards")
         	$current[2] = "class='current'";
         elseif($page_uri[0] == "discussions")
         	$current[3] = "class='current'";
         elseif($page_uri[1] == "history")
         	$current[4] = "class='current'";
         elseif ($page_uri[1] == "faqs")
         	$current[5] = "class='current'";
         elseif ($page_uri[0] == "contactus")
         	$current[6] = "class='current'";
        
        ?>
        <ul class="navigation">
            <li><a <?=$current[0];?> href="<?php echo site_url(); ?>">
                <?php if(!$current[0]):?>
                <img src="<?=IMG_FOLDER;?>Hom_icn.jpg" align="absmiddle" />
                <?php else: ?>
                <img src="<?=IMG_FOLDER;?>Hom_icn_red.jpg" align="absmiddle" />
                <?php endif;?>
                Home</a></li>
            <li><a <?=$current[2];?> href="<?=site_url('latestoffers');?>">Recent offers</a></li>
            <li><a <?=$current[3];?> href="<?=site_url('home/awards');?>">Awards</a></li>
   
            <li><a <?=$current[5];?> href="<?=site_url('home/faqs');?>">FAQ's</a></li>
            <li><a <?=$current[6];?> href="<?=site_url('contactus');?>">Contact us</a></li>
            <li><a <?=$current[7];?> href="<?=site_url('sampleregistration/registrationform/1');?>"><img src="<?=IMG_FOLDER;?>btnSample_reg.png"/></li></a> 
		    <li><a <?=$current[8];?> href="<?=site_url('feedback');?>"><img src="<?=IMG_FOLDER;?>btnvaluationfeedback.png"/></li></a> 
        </ul>
<div  > </div>
<?php

$display = ($this->session->flashdata('message') || $this->session->flashdata('errormsg') ) ? 'display:block;' : 'display:none;';
$class  = ($this->session->flashdata('message')) ? 'messege blue' : '';
$class  = ($this->session->flashdata('errormsg')) ? 'messege red' : 'messege blue';
?>
<div id="statusmsg" class="<?php echo $class; ?>" style="<?php echo $display; ?>">
                    <p>
                       <?php  
                       echo $this->session->flashdata('message');
                       echo $this->session->flashdata('errormsg');
                        ?>
                    </p>
	</div>
</div>
 <?php
 $remember = array(
 		'name'	=> 'remember',
 		'id'	=> 'remember',
 		'value'	=> 1,
 		'checked'	=> set_value('remember'),
 		'style' => 'margin:0;padding:0',
 );
 $captcha = array(
 		'name'	=> 'captcha',
 		'id'	=> 'captcha',
 		'maxlength'	=> 8,
 );
 
 ?>   
<div id="loginpopup">
       <div class="popup">
                <div style="background-image:url('<?php echo IMG_FOLDER;?>bgContentArea.jpg');" class="content">

<!-- LOGIN FORM -->	    
<div id="loginform" >

<a href="#" id="popupContactClose" class="close"><img src="<?=JS_FOLDER;?>facebox/closelabel.png" title="close" class="close_image" /></a>
<?php 
$post = site_url('auth/subscribe/');
$attr = array('name'=>'formlogin', 'id'=>'formlogin');
echo form_open($post, $attr); 

?>

<table class="block">
	<tr>
		<td><label for="login">First Name:</label></td>
		<td>
		<input type="text" class="input_reg" id="firstname" name="firstname" /><span id="err2" class="hide error"> *</span>
		</td>
	</tr>
	<tr>
		<td><label for="login">Last Name:</label></td>
		<td><input type="text" class="input_reg" id="lastname" name="lastname" /><span id="err2" class="hide error"> *</span></td>
	</tr>
	<tr>
        <td style="width:75px" ><label for="login">Email:</label></td>
		<td>
		<input type="text" id="subsemail" class="input_reg" name="subsemail" /><span id="err1" class="hide error"> *</span></td>
		<input type="hidden" name="post" value="1" />
	</tr>
	<tr>
	<td>&nbsp;
	</td>
	</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td></td>
<td>
<a href="javascript:void(0);" name="loginsubmit" id="loginsubmit" ><img src="<?=IMG_FOLDER.'suscribe.png';?>" alt="Subscribe" /></a>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td><span id="mainerror" class="error hide">* All fields are required</span></td>
</tr>
</table>
<?php echo form_close(); ?>
</div>
</div>
</div>
</div>
<div class="loginpopup_hide loginpopup_overlayBG" style="display:none;" id="loginpopup_overlay"></div>