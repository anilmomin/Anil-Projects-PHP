<?php 
include 'designconstants.php';
?>
<div id="standardArc"></div>

<div id="outerContent">

	<div class="content latestOffer">

		<div class="banner">

			<img src="<?=IMG_FOLDER;?>LatestOffer.png" width="959" height="216" alt="" />

			<p>
				SAMPLES DISTRIBUTED FOR EVALUATION. ADVERTISED OFFER TO BE POSTED ON NOVEMBER 22, 2012
			</p>

		</div>
		
		<div id="colproducts" class="productColumns">
		
		<?php 
		$count=1;
		if(!empty($wines))
			foreach ($wines as $id => $wine)
			{
			
		?>
			<div class="productWrap wine1">

				<div class="productBox">

					<div class="productPic">

						<img src="<?=UPLOAD_FOLDER . $wine->wineImage; ?>" alt="wine Image" height="180" />

					</div>

					<div class="productDetail">

						<p><?php echo $wine->wineName; ?></p>
						<p>
						<?php echo $wine->wineStyle; ?></p> 
						<p ><?php echo  $regions[($wine->regionId)-1]->regionName; ?></p>
						
						<!--<p><?php echo (isset($wine->avgfeedbackprice)) ? "<p>Without the pitch: $" . round($wine->avgfeedbackprice, 2)." per dozen</p>" : '<p>Without the pitch: $ XXX.XX per dozen</p>';?></p>
						<p>Winery Special: <strong style="font-size:15px;">$<?php echo "XXX.XX";//$wine->winePrice; ?></strong> per dozen</p>-->
						
						<form method="post" action="<?php echo site_url('shoppingcart/addtomulti'); ?>">				
						<p>
							Quantity: <input type="text"  name="quantity[<?=$id;?>]" class="input_reg2 input" maxlength="8" size="3" />
							<input type="hidden" name="wineId[<?=$id;?>]" value="<?php echo $wine->wineId; ?>" />
							<input type="hidden" name="link[<?=$id;?>]" value="<?php echo current_url(); ?>" />
						</p> 
										
						<p>
							<img src="<?=IMG_FOLDER . 'addtocart.png'?>">
							<!--<input type="image" src="<?=IMG_FOLDER . 'addtocart.png'?>" alt="addtocart" name="submit" />-->
						</p>
						</form>
					</div>

				</div>

			</div>
		<?php
   if($count==3){
   echo '<div style="clear:both;"></div>';
   $count=1;
   }else{
   $count++;
   }		
			} 
		?>
		
				   <div class="productWrap wine2" style="background:none">
                    <div class="next">
                    <?php if($nextpagination): 
                    			echo $nextpagination;
                    		endif; ?>
                        <ul>
	                     <?php if($pagination): 
	                     			echo $pagination; 
	                     	   endif;
	                     ?>
                        </ul>
                    </div>
                    </div>
		</div>
		
		<div class="cb"></div>

	</div>

</div>
