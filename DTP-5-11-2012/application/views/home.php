<?php
include 'designconstants.php';
$captcha = array(
		'name'	=> 'captcha',
		'id'	=> 'captcha',
		'maxlength'	=> 8,
);
?>

<div id="featured">
	<div id="latestWines">
		
		<?php if(!empty($wineofday)) { ?>
		<form method="post" action="<?php echo site_url('shoppingcart/addtomulti'); ?>">		
		<div id="largeBottle">
			<img src="<?php echo UPLOAD_FOLDER . $wineofday[0]->wineImage; ?>"
				width="214" height="432" />
		</div>
		<div id="bottleArea">
			<span class="heading2"><?=$wineofday[0]->wineryName?></span>
			<h1>
				<?php echo $wineofday[0]->wineName; ?>
			</h1>
			<span class="heading2"><?=$wineofday[0]->regionName?></span>
			<span class="heading2"><?=$wineofday[0]->wineVintage . " " . $wineofday[0]->wineStyle; ?></span>
			<!--<?php echo ($feedback[0]->estimateValue) ?  "<p>Ditch the Pitch Average Price: <b> $ ".round($feedback[0]->estimateValue, 2)."</b> </p>": '';?>
            <span class="specialprice">Without the Pitch: <?php if($wineofday[0]->wineDdPValue){echo '$'.number_format($wineofday[0]->wineDdPValue,2);}else{echo '$ XXX.XX';}?> per six pack </span>-->
			<p class="specialprice">Winery Direct Special Offer<span style="color:#EE3531; margin-top:10px;font-size:18px;"> $<?php //echo " Price to be revealed on November 1,2012";
			echo $wineofday[0]->winePrice; ?> <b>per six pack</b></span></p>
			<p>Postage inclusive within Australia</p>
			Quantity: <input type="text"  name="quantity[<?=$wineofday[0]->wineId;?>]" class="input_reg2 input" maxlength="8" size="3" style="margin-bottom:10px;" />
			<div style="padding-top:20px;">
			<p style="float:left; width:150px;">
				<!--<img src="<?=IMG_FOLDER . 'buy1.png'?>">-->
				<input type="image" src="<?=IMG_FOLDER . 'buy1.png'?>" alt="buynow" name="submit" />
			</p>
     		<p style="float:left; width:150px;"><a href="<?php echo site_url('winedetails/index/' . $wineofday[0]->wineId); ?>"><img src="<?=IMG_FOLDER;?>more1.png"	width="122" height="38" border="0" /> </a></p> <div style="clear:both;">&nbsp;&nbsp; <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fditchthepitch.com.au%2F&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:47px; height:33px;" allowTransparency="true"></iframe></div>
			
			</div>
            
            
		</div>
		<input type="hidden" name="wineId[<?=$wineofday[0]->wineId;?>]" value="<?php echo $wineofday[0]->wineId; ?>" />
		<input type="hidden" name="link[<?=$wineofday[0]->wineId;?>]" value="<?php echo current_url(); ?>" />
		</form>
		<?php 
}
else
{
	echo "<p class='topup'> $datedealstarts </p>";
}

?>
	</div>
	<div id="recentWines">
		<ul>

			<?php

			if(!empty($lastwines))
			{
				foreach($lastwines as $wine) { ?>


			<li>
				<div class="img">
					<img src="<?php echo  UPLOAD_FOLDER . $wine->wineImage; ?>"
						width="45" height="96" />
				</div>
				<div class="content">
                					<p>
						<?php echo "The Growers"; //echo substr($wine->wineDescription, 0 , 25); ?>
					</p>
					<h1>
						<?php echo $wine->wineName; ?>
					</h1>
					<p>
						<?php echo $wine->wineStyle; ?>
					</p>
<?php ?>
					<a href="<?php echo site_url('shoppingcart/addtocart/' . $wine->wineId); ?>"><img src="<?=IMG_FOLDER;?>buy1.png"
						width="60" height="21" /> </a>
						<!--<img src="<?=IMG_FOLDER . 'buy1.png'?>" width="60" height="21">-->
					&nbsp;&nbsp;<a href="<?php echo site_url('winedetails/index/' . $wine->wineId); ?>"><img src="<?=IMG_FOLDER;?>more4.png"
						width="60" height="21" /> </a>
					<div align="center">
						<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fditchthepitch.com.au%2F&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=tahoma&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:47px; height:25px;" allowTransparency="true"></iframe>
						</a>
					</div>
				</div>
			</li>
			<?php } 
			}
			else
			{
				echo "<li><p style='margin-top:230px;padding: 0 0 190px 15px;'>No previous deals available now.</p></li>";
			}

			?>
		</ul>
	</div>
	<div class="cb"></div>
</div>
<div id="contentArc"></div>

<div id="outerContent">
	<div id="content">
		<div class="banner">
			<p>
				<br /> At Ditch the Pitch, <b>wine lovers have</b> their say and the<b>
					winemakers</b> listen. The result? A genuine ‘direct from the
				winery’ wine purchasing opportunity of true value! At Ditch the
				Pitch, there is only one wine value that counts … yours!
			</p>
		</div>
		<ul class="registrationArea">
			<li class="col col1">
				<h3>Awards</h3>
				<!-- <iframe width="220" height="251" src="http://www.youtube.com/embed/dJfyGU6ZR4k" frameborder="0" allowfullscreen></iframe>-->
					<ul class="homweawards" >
                    	<li><b>Consumer Awards</b> THE FIRST CONSUMER AWARDS WILL BE POSTED ON 1 NOVEMBER 2012</li>
                        <li><b>Winery Awards</b> THE FIRST WINERY AWARDS WILL BE POSTED ON 1 FEBRUARY 2013</li>
                    </ul>
					<a style=" text-align:left; width:175px; margin-left:0px;" href="<?=site_url('home/awards');?>"><img style="margin-left:0px; margin-top:30px;" src="<?=IMG_FOLDER?>btnwholelist.png" class="previous" /></a>
			</li>
					<li class="col col2">
				<h3>News</h3>
				<?php if($newsdata) : ?>
				<img src="<?=IMG_FOLDER?>news-arrow-previous.png" class="previous" />
				<div id="news" class="ticker">
				<ul>
				<?php
				 
				foreach($newsdata as $news) { ?>
				<li>
					<p><a href="<?=site_url('newspage');?>"><?php echo substr($news->news, 0 , 80) . "..."; ?></a></p>
					<span><?php echo date('d M Y', strtotime($news->created_date)); ?></span>
				</li>
				<?php } ?>
				</ul>
				
				</div>
				<img src="<?=IMG_FOLDER?>news-arrow.png" class="nextbtn" />
				<?php endif; ?>
			</li>
			<li class="col col3">
				<div class="reg_content" style="border: 0px">
					<div>
						<h3>Register for Sample</h3>
						<br />
                        <p>Click 'Go' to register as a potential wine sample recipient.</p>
					<p style="text-align:center">
						<a href="<?=site_url('sampleregistration/registrationform/1');?>" class="go-btn"><img
							src="<?=IMG_FOLDER;?>go_red.png" border="0" /> </a>
					</p>
						
					</div>
				</div>
			</li>
			<li class="col col4" style="border: 0px; background: none 0px">
				<h3>Valuation Feedback</h3>
				<div class="reg_content" style="border: 0px;">

					<br /><p>Click 'Go' to be taken to the wine evaluation feedback form.</p>
					<p style="text-align:center">
						<a href="<?=site_url('feedback');?>" class="go-btn"><img
							src="<?=IMG_FOLDER;?>go_red.png" border="0" /> </a>
					</p>
				</div>
			</li>
		</ul>
		<div class="cb"></div>
	</div>
</div>