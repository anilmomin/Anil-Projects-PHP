<?php include 'designconstants.php'; ?>
    <script type="text/javascript">
        Cufon.replace('#header .navigation li a, #footer .heading', { fontFamily: 'Myriad Pro Condensed', hover: true });
        Cufon.replace('.content .banner p, #content ul.registrationArea h3', { fontFamily: 'Myriad Pro Semibold', hover: true });
        Cufon.replace('#footer .col h3', { fontFamily: 'Myriad Pro Regular', hover: true });
        Cufon.replace('#bottleArea h1,.discusArea h3', { fontFamily: 'Myriad Pro Condensed', hover: true, textShadow: '1px 1px #666' });
        Cufon.replace('.dayContent strong', { fontFamily: 'Myriad Pro Regular', hover: true, textShadow: '1px 1px #4e0503',});
    </script>

 <div id="standardArc">

    </div>

    <div id="outerContent">

        <div class="content discussion">

            <div class="banner">

               <p>Cart Details</p>

            </div>
    
<?php echo form_open('shoppingcart/updatecart');?>
            
            
            <div class="cart">

                <h2>Your Shopping Cart</h2>

                <ul class="table">

                    <li class="lightGreen" style="background:none; border:none;">

                        <ul>

                            <li class="qty"><img src="<?=IMG_FOLDER;?>icnQty.png" /></li>

                            <li class="descript"><img src="<?=IMG_FOLDER;?>icnDescript.png" /></li>
                            
                            <li class="price"><img src="<?=IMG_FOLDER;?>icnprice.png" /></li>

                            <li class="total"><img src="<?=IMG_FOLDER;?>icnTotal.png" /></li>

                            

                            <li class="remove">&nbsp;</li>

                        </ul>

                    </li>
<?php $i = 1; ?>


<?php foreach ($this->cart->contents() as $items): ?>
		<?php $greenclass = $i % 2 == 1 ? "darkGreen" : "lightGreen"; ?> 
	<?php echo form_hidden('rowid[]', $items['rowid']); ?>
	
                    <li class="<?=$greenclass;?>">

                        <ul>

                            <li class="qty"><?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '1')); ?></li>

                            <li class="descript"><?php echo $items['name']; ?></li>
							<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
							<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
							<?php echo $option_name; ?>:<?php echo $option_value; ?>
							<?php endforeach; ?>
							<?php endif; ?>
							
							<li class="price">$<?php echo $this->cart->format_number($items['price']); ?></li>
							
                            <li class="total">$<?php echo $this->cart->format_number($items['subtotal']); ?></li>

                            

                            <li class="remove"><a href="<?php echo site_url('shoppingcart/deletecartitem/'.$items['rowid'])?>"><img src="<?=IMG_FOLDER;?>remove.png" class="_hv"/></a></li>

                        </ul>

                    </li>
<?php $i++; ?>

<?php endforeach; ?>
                    
                </ul>

                <div class="update">
                
<input type="image" src="<?=IMG_FOLDER;?>continucart.png" name="updatecart" />
                    <input type="image" src="<?=IMG_FOLDER;?>btnUpdateCart.png" name="updatecart" />
<a href="javascript:submit_form();"> <img src="<?=IMG_FOLDER;?>btncheckoutnow.png" > </a>
<!--<a href="#"> <img src="<?=IMG_FOLDER;?>btncheckoutnow.png" > </a>-->
					
                </div>
            <?php if($this->cart->total_items() > 0)?>    
				<p> <h2>Total Amount : $<?php echo $this->cart->format_number($this->cart->total()); ?> </h2></p>
				
            </div>
            <?php echo form_close(); ?>
            
              <?php
	//if($this->cart->total_items() >= CHECKOUT_LIMIT)
 		echo $paypalform; 
 ?>   
            <div class="cb"></div>

        </div>

    </div>
<script>
function submit_form(){
$('#paypal_form').submit();
}
</script>	