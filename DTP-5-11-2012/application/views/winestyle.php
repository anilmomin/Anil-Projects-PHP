<?php include 'designconstants.php' ?>
<div id="standardArc">
    </div>

<div id="outerContent">
        <div class="content">
<div class="banner">

<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
 <p style="font-size:40px"><cufon class="cufon cufon-canvas" alt="User " style="width: 88px; height: 40px; "><canvas width="117" height="44" style="width: 117px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>User </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Registration " style="width: 222px; height: 40px; "><canvas width="252" height="44" style="width: 252px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>Registration </cufontext></cufon><cufon class="cufon cufon-canvas" alt="System" style="width: 127px; height: 40px; "><canvas width="130" height="44" style="width: 130px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>System</cufontext></cufon></p>
</div>


<div id="content_pane">
<div id="reg" style="width:92%">
<p>
Thank you for confirming your eligibility and wine preferences.</p>
<p> Your details will now be added to our list of potential wine evaluators. 

</p>

<p class="border4"></p>
 
 <?php
 $post = site_url('sampleregistration/registrationform/3');
 echo form_open($post); 
 ?>
<a href="<?=site_url('sampleregistration/registrationform/2') ?>" onClick="history.back();return false;" ><img src="<?=IMG_FOLDER;?>back.png" alt="cancel button" /></a>&nbsp;&nbsp;&nbsp; 
<input type="hidden" name="step3" value="1" />
<input  type="image" name="submit" src="<?=IMG_FOLDER;?>btn_submit2.png" alt="submit button"  />
<p>&nbsp;</p>
</div>
</div>
</div>

</div>