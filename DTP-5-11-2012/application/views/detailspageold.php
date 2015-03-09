 <?php 
 	include 'designconstants.php';
 	$pageData = $pageData[0];
 ?> 
  <div id="featured">
  
        <div class="detailPage">
		<form method="post" action="<?php echo site_url('shoppingcart/addtomulti'); ?>">	
            <div id="largeBottle">
                <img src="<?php echo UPLOAD_FOLDER . $pageData->wineImage; ?>" width="214" height="432"></div>
            <div id="bottleArea">
				<span class="heading2"><?=$pageData->wineryName?></span>
                <h1><?php echo $pageData->wineName; ?></h1>
                <span>&nbsp;</span>
                
            <span class="heading2"><?=$pageData->regionName?></span>
			<span class="heading2"><?=$pageData->wineVintage . " " . $pageData->wineStyle; ?></span>
			<?php echo ($feedback[0]->estimateValue) ?  "<p>Ditch the Pitch Average Price: <b> $ ".round($feedback[0]->estimateValue, 2)."</b> </p>": '';?>
            <span class="specialprice">Without the Pitch: <?php if($feedback[0]->estimateValue){echo '$'.number_format($feedback[0]->estimateValue);}else{echo '$ XXX.XX';}?> per dozen </span>
			<p class="specialprice">Winery Direct Special Offer<span style="color:#EE3531; margin-top:10px;font-size:18px;"> $<?php echo " Price to be revealed on November 1,2012";//echo $wineofday[0]->winePrice; ?> <!--<b>per dozen</b>--></span></p>
			<p>Postage inclusive within Australia</p>
			Quantity: <input type="text"  name="quantity[<?=$pageData->wineId;?>]" class="input_reg2 input" maxlength="8" size="3" style="margin-bottom:10px;" />
			<div style="padding-top:20px;">
			<p style="float:left; width:150px;">
				<img src="<?=IMG_FOLDER . 'buy1.png'?>">
				<!--<input type="image" src="<?=IMG_FOLDER . 'buy1.png'?>" alt="buynow" name="submit" />-->
			</p>
     		 <div style="clear:both;">&nbsp;&nbsp; <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fditchthepitch.com.au%2F&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:47px; height:33px;" allowTransparency="true"></iframe></div>
			
			</div>
                <div class="cb" style="clear:both;"></div>
         
            </div>
        <div class="cb">
        </div>
		<input type="hidden" name="wineId[<?=$pageData->wineId;?>]" value="<?php echo $pageData->wineId; ?>" />
		<input type="hidden" name="link[<?=$pageData->wineId;?>]" value="<?php echo current_url(); ?>" />
		</form>
        </div>

        
        
    </div>
    <div id="contentArc" style="clear:both;">
    </div>
    <div id="outerContent">
        <div id="content">
                
                <div class="detail_box">
    <div class="detail_box_inn">
    	<h1>Consumers Views</h1>
        <p class="para">Without the Pitch</p>
        <span>
        <strong>Average Value</strong>
        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos enaeos. Vivamus sed arcu sem, imperdiet tempor justo. Maecenas ligula libero, sodales sed consectetur non, lacinia eu enim. </p>
        </span>

        <span>
        <strong>Sed semper magna quis</strong>
        <p>Morbi tempor aliquet sapien, ac sollicitudin nisi vulputate at. Vestibulum vitae eros at est porttitor sodales. Donec vel dolor in elit rutrum elementum. Proin dignissim mollis nisl, ut placerat neque condimentum ornare. Donec velit tellus, volutpat nec faucibus et, tristique quis nunc. Quisque fringilla venenatis risus eget dapibus.</p>
        </span>

        <span style="border:none 0px;">
        <strong>Class aptent taciti sociosqu ad </strong>

        <p>Sed blandit nibh sed tortor viverra et auctor arcu rhoncus. Sed rutrum nibh vel purus posuere non pulvinar metus consectetur. Proin suscipit hendrerit ante in vehicula. Aenean porta tortor nec sapien condimentum non porttitor sem iaculis. Sed id facilisis massa. Nulla faucibus erat quis odio interdum id fringilla lorem rutrum.</p>
        </span>
    </div> 
</div>
                <div class="detail_box" style="border-right:none">
    <div class="detail_box_inn">
    	<h1>Winemakers Views</h1>
        <p class="para">The Pitch</p>
        <span>
        <strong>Average Value</strong>
        <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos enaeos. Vivamus sed arcu sem, imperdiet tempor justo. Maecenas ligula libero, sodales sed consectetur non, lacinia eu enim. </p>
        </span>

        <span>
        <strong>Sed semper magna quis</strong>
        <p> Morbi tempor aliquet sapien, ac sollicitudin nisi vulputate at. Vestibulum vitae eros at est porttitor sodales. Donec vel dolor in elit rutrum elementum. Proin dignissim mollis nisl, ut placerat neque condimentum ornare. Donec velit tellus, volutpat nec faucibus et, tristique quis nunc. Quisque fringilla venenatis risus eget dapibus.</p>
        </span>

        <span style="border:none 0px;">
        <strong>Class aptent taciti sociosqu ad </strong>

        <p>Sed blandit nibh sed tortor viverra et auctor arcu rhoncus. Sed rutrum nibh vel purus posuere non pulvinar metus consectetur. Proin suscipit hendrerit ante in vehicula. Aenean porta tortor nec sapien condimentum non porttitor sem iaculis. Sed id facilisis massa. Nulla faucibus erat quis odio interdum id fringilla lorem rutrum.</p>
        </span>
    </div> 
</div>                
            <div class="cb"></div>
        </div>
    </div>
