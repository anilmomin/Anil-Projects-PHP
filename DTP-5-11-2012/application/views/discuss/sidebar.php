
<div class="sideBar">
	<?php
	if(!isset($wineurl[2]))
		if(!empty($lastwines))
		{
			foreach ($lastwines as $wine)
			{
				?>
	<div class="sideProduct">
		<img src="<?=UPLOAD_FOLDER . $wine->wineSmallImage; ?>" width="45"
			height="96">
		<div class="wineDetail">
			<strong><?=$wine->wineName;?> </strong>
			<p>
				<span class="green1">Vintage:</span>
				<?=$wine->wineVintage;?>
				<br> <span class="green1">Style:</span>
				<?=$wine->wineStyle;?>
				<br> <span class="green1">Region:</span>
				<?=$wine->regionName;?>
			</p>
			<p>
				<a href="<?=site_url('discussions'). "/index/" . $wine->wineId; ?>"><img
					src="<?=IMG_FOLDER;?>DP-Discussion~01-2_17.png" border="0"> </a>
			</p>
		</div>
		<div class="cb"></div>
	</div>
	<?php
			}
		}
		else { ?>
	<div class="sideProduct">
		<p>No wines right now for preview</p>
	</div>


	<?php 		
		}
		else
		{
			if(!empty($lastwines))
			{
				?>
				
		<div class="sideProduct">
		<img src="<?=UPLOAD_FOLDER . $wineofday->wineSmallImage; ?>" width="45"
			height="96">
		<div class="wineDetail">
			<strong>Wine of the Day</strong>
			<p>
				<span class="green1">Vintage:</span>
				<?=$wineofday->wineVintage;?>
				<br> <span class="green1">Style:</span>
				<?=$wineofday->wineStyle;?>
				<br> <span class="green1">Region:</span>
				<?=$wineofday->regionName;?>
			</p>
			<p>
				<a href="<?=site_url('discussions'). "/index/"; ?>"><img
					src="<?=IMG_FOLDER;?>DP-Discussion~01-2_17.png" border="0"> </a>
			</p>
		</div>
		<div class="cb"></div>
	</div>		
	
	
<?php 				
				foreach ($lastwines as $wine)
				{
					if($wine->wineId == $wineurl[2])
						continue;
					
					?>
	<div class="sideProduct">
		<img src="<?=UPLOAD_FOLDER . $wine->wineSmallImage; ?>" width="45"
			height="96">
		<div class="wineDetail">
			<strong><?=$wine->wineName;?> </strong>
			<p>
				<span class="green1">Vintage:</span>
				<?=$wine->wineVintage;?>
				<br> <span class="green1">Style:</span>
				<?=$wine->wineStyle;?>
				<br> <span class="green1">Region:</span>
				<?=$wine->regionName;?>
			</p>
			<p>
				<a href="<?=site_url('discussions'). "/index/" . $wine->wineId; ?>"><img
					src="<?=IMG_FOLDER;?>DP-Discussion~01-2_17.png" border="0"> </a>
			</p>
		</div>
		<div class="cb"></div>
	</div>
	<?php
				}
			}
			else { ?>
	<div class="sideProduct">
		<p>No wines right now for preview</p>
	</div>


	<?php 		
			}

		}
		?>
</div>
