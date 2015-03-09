<?php include 'designconstants.php' ?>
<div id="standardArc">
    </div>

<div id="outerContent">
        <div class="content">
<div class="banner">

<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
 <p style="font-size:40px"><cufon class="cufon cufon-canvas" alt="User " style="width: 88px; height: 40px; "><canvas width="117" height="44" style="width: 117px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>User </cufontext></cufon><cufon class="cufon cufon-canvas" alt="Registration " style="width: 222px; height: 40px; "><canvas width="252" height="44" style="width: 252px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>Registration </cufontext></cufon><cufon class="cufon cufon-canvas" alt="System" style="width: 127px; height: 40px; "><canvas width="130" height="44" style="width: 130px; height: 44px; top: -4px; left: -2px; "></canvas><cufontext>System</cufontext></cufon></p>
</div>


<div id="content_pane2" style="">
<div id="reg" style="width:32%">
<strong class="redhdng">2. Wine Preference</strong>
<br>
<br>

<p>Please Tick Your Wine preference From the options below; you can tick as many boxes as you wish. Following the generic wine style reference below, you will be asked to narrow your preference to one favourite wine style:</p>
<?php
$post = site_url('sampleregistration/registrationform/2');
echo form_open($post); 
$counter = 0;
?>
<p class="border4"></p>

<?php
/**
 * Listing for Color
 */
   foreach($winesStyles as $style) 
{
?>

    <p><input name="winepref[]" type="checkbox" value="<?=$style->winestyleName;?>"> <?=$style->winestyleName;?></p>
 <?php
  if($counter == 2 || $counter == 5 || $counter == 7 || $counter == 10) echo "<br><br>"; 
  $counter++;
  
} ?> 


 <p>&nbsp;</p>

<input type="hidden" value="1" name="step2">
<a id="wineprefback" href="#" ><img src="<?=IMG_FOLDER;?>back.png" alt="cancel button" /></a>&nbsp;&nbsp;&nbsp;  

<input  type="image" name="submit" src="<?=IMG_FOLDER;?>next.png" alt="submit button"  />
<?php echo form_close() ?>

<p>&nbsp;</p>
</div>
</div>



</div>

</div>