<?php include 'designconstants.php' ?>
<div id="standardArc"></div>

<div id="outerContent">
	<div class="content">
		<div class="banner">
			<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
			<p style="font-size: 40px">User Registration</p>
		</div>
		<div id="reg" style="width:32%">
			<?php 
				
			$post = site_url('sampleregistration/');
			$attr = array('id' => 'claimform', 'name' => 'claimform');
			echo form_open($post, $attr);
			?>

			<p>

				<label for="firstname">First Name:</label><br/> <input name="firstname"
					id="firstname" type="text"
					value="<?=set_value('firstname');?>"
					class="input_reg1" />
				<?php echo form_error('firstname'); ?>
			</p>

			<p>
				<label for="lastname">Last Name:</label><br/> <input name="lastname"
					id="lastname" type="text"
					value="<?=set_value('lastname');?>"
					class="input_reg1" />
				<?php echo form_error('lastname'); ?>
			</p>

			<p>
				<label for="address">Address(Line 1):</label><br/> <input name="address"
					id="address" type="text"
					value="<?=set_value('address');?>"
					class="input_reg1" />
				<?php echo form_error('address'); ?>

			</p>

			<p >
				<label for="address">Address(Line 2):</label><br/>
				<input type="text" class="input_reg1" name="address1" id="address1" />
			</p>


			<p >
				<label for="suburb">Suburb:</label><br/> <input type="text"
					class="input_reg1" name="suburb" value="<?=set_value('suburb');?>" />
					<?php echo form_error('suburb'); ?>
			</p>

			<span>
				<label for="state">State:</label>
				
					<select name="state" id="state" class="input_reg1 dropDown required" >
						<option value="" <?php echo set_select('state', '----', TRUE); ?>>----</option>
						<option value="New South Wales" <?php echo set_select('state', 'New South Wales'); ?>>New South Wales</option>
						<option value="Queensland" <?php echo set_select('state', 'Queensland'); ?>>Queensland</option>
						<option value="South Australia" <?php echo set_select('state', 'South Australia'); ?> >South Australia</option>
						<option value="Tasmania" <?php echo set_select('state', 'Tasmania'); ?>>Tasmania</option>
						<option value="Victoria" <?php echo set_select('state', 'Victoria'); ?>>Victoria</option>
						<option value="Western Australia" <?php echo set_select('state', 'Western Australia'); ?>>Western Australia</option>
						<option value="Other">Other</option>
					</select>
				
				<span id="errorstate" ><?php echo form_error('state'); ?></span>
				<br/>
				<br/>
			</span>

			
			<p >
				<label for="postcode">Post Code:</label> <br/> <input type="text"
					class="input_reg2" name="postcode" id="postcode" maxlength="8" style="width:90%" value="<?=set_value('postcode');?>" />
					<br/>
					<span id="errorcode"><?php echo form_error('postcode'); ?></span>
			</p>

			<p >
				<label for="encycode">Encryption Code:</label> <br/> <input type="text"
					class="input_reg1" name="encycode" value="<?=set_value('encycode');?>" />
					<?php echo form_error('encycode'); ?>
			</p>


			<p >
				<input name="certify" type="checkbox" value="1"  <?php echo set_checkbox('certify', '1'); ?>> I agree to recive
				the sample and to the terms and conditions of participation.
			</p>
					<?php echo form_error('certify'); ?>
			<p></p>
			<input type="hidden" name="claim" value="1" /> 
			<input type="image" name="submit" id="submit" src="<?=IMG_FOLDER;?>submit_reg.png"
				alt="submit button" />
			<p>&nbsp;</p>
		</div>
	</div>
</div>

