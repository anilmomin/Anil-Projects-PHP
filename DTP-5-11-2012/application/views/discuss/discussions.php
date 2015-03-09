<?php 
	$path = getcwd(). '/application/views';

	include_once $path . '/designconstants.php';
	
	if(isset($wineofday[0]))
		$wineofday = $wineofday[0];
	else
		$wineofday = null;
	
	$urlstring = uri_string();
	$wineurl = explode('/', $urlstring);
	$daywine = "";
	if(isset($wineurl[2]))
		$wineid = $wineurl[2];
	else 
	{
		$wineid = $wineofday->wineId;
		$daywine =  '<input type="hidden" name="daywine" value="1" />'; 
	}
	
?>
<div id="standardArc">
    </div>

<div id="outerContent">
<div class="content discussion">
            <div class="banner">
                <img src="<?=IMG_FOLDER;?>Discussionz.png" width="960" height="216">
                <p><cufon class="cufon cufon-canvas" alt="nteger" style="width: 80px; height: 25px; "><canvas width="98" height="28" style="width: 98px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>nteger </cufontext></cufon><cufon class="cufon cufon-canvas" alt="metus " style="width: 75px; height: 25px; "><canvas width="94" height="28" style="width: 94px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>metus </cufontext></cufon><cufon class="cufon cufon-canvas" alt="mauris, " style="width: 88px; height: 25px; "><canvas width="106" height="28" style="width: 106px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>mauris, </cufontext></cufon><cufon class="cufon cufon-canvas" alt="fermentum " style="width: 131px; height: 25px; "><canvas width="150" height="28" style="width: 150px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>fermentum </cufontext></cufon><cufon class="cufon cufon-canvas" alt="quis " style="width: 53px; height: 25px; "><canvas width="71" height="28" style="width: 71px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>quis </cufontext></cufon><cufon class="cufon cufon-canvas" alt="lobortis " style="width: 93px; height: 25px; "><canvas width="111" height="28" style="width: 111px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>lobortis </cufontext></cufon><cufon class="cufon cufon-canvas" alt="iaculis, " style="width: 81px; height: 25px; "><canvas width="100" height="28" style="width: 100px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>iaculis, </cufontext></cufon><cufon class="cufon cufon-canvas" alt="tincidunt " style="width: 108px; height: 25px; "><canvas width="126" height="28" style="width: 126px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>tincidunt </cufontext></cufon><cufon class="cufon cufon-canvas" alt="eget " style="width: 56px; height: 25px; "><canvas width="75" height="28" style="width: 75px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>eget </cufontext></cufon><cufon class="cufon cufon-canvas" alt="mi. " style="width: 40px; height: 25px; "><canvas width="59" height="28" style="width: 59px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>mi. </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Vestibulum " style="width: 133px; height: 25px; "><canvas width="151" height="28" style="width: 151px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>Vestibulum </cufontext></cufon><cufon class="cufon cufon-canvas" alt="pellentesque " style="width: 151px; height: 25px; "><canvas width="169" height="28" style="width: 169px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>pellentesque </cufontext></cufon><cufon class="cufon cufon-canvas" alt="dignissim " style="width: 113px; height: 25px; "><canvas width="132" height="28" style="width: 132px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>dignissim </cufontext></cufon><cufon class="cufon cufon-canvas" alt="neque, " style="width: 82px; height: 25px; "><canvas width="101" height="28" style="width: 101px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>neque, </cufontext></cufon><b><cufon class="cufon cufon-canvas" alt="ut " style="width: 30px; height: 25px; "><canvas width="48" height="28" style="width: 48px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>ut </cufontext></cufon><cufon class="cufon cufon-canvas" alt="iaculis " style="width: 76px; height: 25px; "><canvas width="94" height="28" style="width: 94px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>iaculis </cufontext></cufon><cufon class="cufon cufon-canvas" alt="eros " style="width: 53px; height: 25px; "><canvas width="72" height="28" style="width: 72px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>eros </cufontext></cufon><cufon class="cufon cufon-canvas" alt="tempus " style="width: 90px; height: 25px; "><canvas width="109" height="28" style="width: 109px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>tempus </cufontext></cufon><cufon class="cufon cufon-canvas" alt="ut" style="width: 24px; height: 25px; "><canvas width="39" height="28" style="width: 39px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>ut</cufontext></cufon></b><cufon class="cufon cufon-canvas" alt=". " style="width: 12px; height: 25px; "><canvas width="30" height="28" style="width: 30px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>. </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Vestibulum " style="width: 133px; height: 25px; "><canvas width="151" height="28" style="width: 151px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>Vestibulum </cufontext></cufon><cufon class="cufon cufon-canvas" alt="id " style="width: 27px; height: 25px; "><canvas width="46" height="28" style="width: 46px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>id </cufontext></cufon><cufon class="cufon cufon-canvas" alt="rhoncus " style="width: 96px; height: 25px; "><canvas width="114" height="28" style="width: 114px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>rhoncus </cufontext></cufon><cufon class="cufon cufon-canvas" alt="elit. " style="width: 47px; height: 25px; "><canvas width="66" height="28" style="width: 66px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>elit. </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Aenean " style="width: 91px; height: 25px; "><canvas width="109" height="28" style="width: 109px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>Aenean </cufontext></cufon><cufon class="cufon cufon-canvas" alt="neque " style="width: 77px; height: 25px; "><canvas width="95" height="28" style="width: 95px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>neque </cufontext></cufon><cufon class="cufon cufon-canvas" alt="nibh, " style="width: 63px; height: 25px; "><canvas width="81" height="28" style="width: 81px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>nibh, </cufontext></cufon><cufon class="cufon cufon-canvas" alt="ultrices " style="width: 87px; height: 25px; "><canvas width="106" height="28" style="width: 106px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>ultrices </cufontext></cufon><cufon class="cufon cufon-canvas" alt="sit " style="width: 32px; height: 25px; "><canvas width="51" height="28" style="width: 51px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>sit </cufontext></cufon><cufon class="cufon cufon-canvas" alt="amet " style="width: 63px; height: 25px; "><canvas width="81" height="28" style="width: 81px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>amet </cufontext></cufon><cufon class="cufon cufon-canvas" alt="lobortis " style="width: 93px; height: 25px; "><canvas width="111" height="28" style="width: 111px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>lobortis </cufontext></cufon><cufon class="cufon cufon-canvas" alt="id, " style="width: 33px; height: 25px; "><canvas width="52" height="28" style="width: 52px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>id, </cufontext></cufon><cufon class="cufon cufon-canvas" alt="venenatis " style="width: 114px; height: 25px; "><canvas width="132" height="28" style="width: 132px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>venenatis </cufontext></cufon><cufon class="cufon cufon-canvas" alt="vel " style="width: 38px; height: 25px; "><canvas width="57" height="28" style="width: 57px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>vel </cufontext></cufon><cufon class="cufon cufon-canvas" alt="lacus." style="width: 63px; height: 25px; "><canvas width="81" height="28" style="width: 81px; height: 28px; top: -2px; left: -1px; "></canvas><cufontext>lacus.</cufontext></cufon></p>
            </div>
            <div class="discussions">
 <div class="discussions_left">
 <!--  Wine Panel based on condition -->
    <?php include 'winepanel.php'; ?>
 <div class="cb"></div>
 
 <div class="discusArea">
    <h3><cufon class="cufon cufon-canvas" alt="Latest " style="width: 72px; height: 35px; "><canvas width="92" height="39" style="width: 92px; height: 39px; top: -2px; left: -1px; "></canvas><cufontext>Latest </cufontext></cufon><cufon class="cufon cufon-canvas" alt="wine " style="width: 60px; height: 35px; "><canvas width="80" height="39" style="width: 80px; height: 39px; top: -2px; left: -1px; "></canvas><cufontext>wine </cufontext></cufon><cufon class="cufon cufon-canvas" alt="discussion" style="width: 112px; height: 35px; "><canvas width="123" height="39" style="width: 123px; height: 39px; top: -2px; left: -1px; "></canvas><cufontext>discussion</cufontext></cufon></h3>
    <p>Vivamus ultrices magna eget neque placerat pharetra. Donec at sem ut velit hendrerit hendrerit. Curabitur sit amet sem ac erat dignissim suscipit. Curabitur vel elementum dui. Vestibulum malesuada ante venenatis nisl eleifend malesuada. Etiam dictum sodales sapien, in varius nisi congue non. </p>
    <br>
    <div class="discussionBox">
    <?php 
	 	$post = site_url('discussions/savepost/');
    	$attr = array('name'=>'discussform', 'id' => 'discussform');
		echo form_open($post, $attr);
	?>
	<textarea name="commentbox" rows="7" cols="88"></textarea><br>
    <input type="hidden" name="wineid" value="<?php echo $wineid; ?>" />
    <input type="hidden" name="post" value="1" />
    <?php echo $daywine; ?>
    <br/>
    <input type="image" name="submit" src="<?=IMG_FOLDER."post.png"?>" alt="post" />
    <p>&nbsp;</p>
    <?php echo form_close(); ?>
    <div id="content">
  		<div id="data">
   <?php include_once 'commentpane.php'; ?>
   		</div>
   		
   	  </div>
   		
    </div>
 </div>
 
 <p class="slider">
 
 </p>
 </div>
 
 <!-- Load sidebar based on condition -->
	<?php include 'sidebar.php'; ?> 

 </div>
            <div class="cb">
            </div>
        </div>

</div>