<?php 
if(!isset($wineurl[2]))
	{
	
?>

<div class="wineOfTheDay">
    <?php if ($wineofday) : ?>
        <img src="<?=UPLOAD_FOLDER . $wineofday->wineImage;  ?>" width="145" class="bottle">
         <div class="dayContent">
             <strong>Wine of the Day</strong><br>
             <span><?=$wineofday->wineTagLine; ?></span>
             <p><b class="red2">Brand:</b><?=$wineofday->wineName;?></p>
             <p> <b class="red2"> Vintage: </b><?=$wineofday->wineVintage;?></p>
             <p><b class="red2">Wine Style:</b><?=$wineofday->wineStyle;?></p>
             <p><b class="red2">Region:</b><?=$wineofday->regionName;?></p>
         </div> 
    <?php else: ?>
    <p><?=$datedealstarts; ?></p>
    <?php endif; ?>     
    </div>
<?php 
	}
	else
	{
	?>
	
	
	<div class="wineOfTheDay">
    <?php if ($lastwines) : 
    	$getIndex = 0;
    
    //gets the index of the selected wine by its id 
    foreach($lastwines as $id => $wines)
    	if ($wines->wineId == $wineid)
	    { 
	    		$getIndex = $id;
	    		break;
	    }
    
    ?>
        <img src="<?=UPLOAD_FOLDER . $lastwines[$getIndex]->wineImage;  ?>" width="145" class="bottle">
         <div class="dayContent">
             <strong><?=$lastwines[$getIndex]->wineName;?></strong><br> 
             <span><?=$lastwines[$getIndex]->wineTagLine; ?></span>
             <p> <b class="red2"> Vintage: </b><?=$lastwines[$getIndex]->wineVintage;?></p>
             <p><b class="red2">Wine Style:</b><?=$lastwines[$getIndex]->wineStyle;?></p>
             <p><b class="red2">Region:</b><?=$lastwines[$getIndex]->regionName;?></p>
         </div> 
    <?php else: ?>
    <p><?=$datedealstarts; ?></p>
    <?php endif; ?>     
    </div>
	
<?php 		
	}
 ?>