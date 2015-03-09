<?php include 'designconstants.php'; ?>
<style>
	error, label.error { display:none; }
	
</style>

<div id="standardArc">

    </div>

    <div id="outerContent">

        <div class="content">

            <div class="banner">

                <img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216" />

                <p style="font-size:40px">Valuation Feedback</p>

            </div>
<div id="para">
    <p>

        <span class="redhdng"><strong>Wine Value Feedback Form</strong></span><br />

        <br />

        <p>

            Please complete the following feedback form as accurately as you can.</p>

        <p>

          Your comments will be included in the report provided to the winemaker yet your identity will not be included anywhere in the report. The more feedback you provide, the more beneficial the report will be.
          </p>

        <p>

           Please consider the value question as carefully as you can. Not only does it influence the livelihood of a wine producer, it could determine if you become eligible for the `Ditch the Pitch Wine Taster of the Year`! To be eligible for this prestigious title, you need to nominate the wine value that is closest to the average response from all of those who value this wine.
        </p>
        <p>&nbsp;</p>

</div>
            
            
<div class="reg" id="divfeedback" >
            <?php 
	            $post = site_url('feedback');
	            $attr = array('id' => 'feedbackform', 'name' => 'feedbackform');
				echo form_open($post, $attr);
			?>

       <p class="feedbackitem">
			<label for="winebrand">First Name</label><br>
            <input name="winebrand" type="text" class="input_reg1" value="<?=set_value('firstname');?>"  /><br>
            <?php echo form_error('firstname'); ?>
       </p>
           
			
        <p class="feedbackitem">
			<label for="vintage">Last Name</label><br>
            <input name="vintage" type="text" class="input_reg1" value="<?=set_value('lastname');?>"  /><br />
			<?php echo form_error('lastname'); ?>
		</p>	
        <p class="feedbackitem">
			<label for="variety">Email</label><br>
            <input name="variety" type="text" class="input_reg1" value="<?=set_value('email');?>" /><br />
			<?php echo form_error('email'); ?>
        </p>
		
		<p class="feedbackitem">
			<label for="variety">Product Code</label><br>
            <input name="variety" type="text" class="input_reg1" value="<?=set_value('productcode');?>" /><br />
			<?php echo form_error('productcode'); ?>
        </p>

        <p>

          How much money would you be prepared to pay per bottle of the wine <br> that you have evaluated if you were to purchase 1 dozen bottles and have them  <br> delivered to you via Australia Post? (Price per dozen, including postage, divided by 12)

        </p>
        <p >

            $<input name="estvalue" type="text" size="6" maxlength="8" class="input_reg2 feedbackinput" value="<?=set_value('estvalue');?>" />
         <?php echo form_error('estvalue'); ?>
       </p>
		<p>&nbsp;</p>
        <strong class="red1">With 1 being a poor score and 10 being the best score:</strong>
		
        <p>
<br />
            <strong>What is your quality score on the wine?</strong>
</p>
      
        	<ul >
        	<?php 
        		for ($i = 1; $i <= 10; $i++)
        			echo "<li>$i</li>";
        	?>        	
        	</ul>
        	
        	<?php 
        		for ($i = 1; $i <= 10; $i++)
        		{
        			if($i == 1)
        				echo '<input type="radio" name="quality" validate="required:true" class="spacer" value="'.$i.'"'. set_radio('quality', '1'). ' />&nbsp;';
        			else
        				echo '<input type="radio" name="quality" class="spacer" value="'.$i.'"'. set_radio('quality', $i). ' />&nbsp;';
        		}
        	?><br><?php echo form_error('quality'); ?>
        	<label for="quality" class="error"  >Please select an option</label>
       <p>
<br />
            <strong>Does the wine meet your style expectations?	</strong>
       </p>

        
			<ul >
        	<?php 
        		for ($i = 1; $i <= 10; $i++)
        			echo "<li>$i</li>";
        	?>        	
        	</ul>
            <?php 
        		for ($i = 1; $i <= 10; $i++)
        		{
        			if($i == 1)
        				echo '<input type="radio" name="style" validate="required:true" class="spacer" value="'.$i.'"'. set_radio('style', '1'). ' />&nbsp;';
        			else
        				echo '<input type="radio" name="style" class="spacer" value="'.$i.'"'. set_radio('style', $i). ' />&nbsp;';
        		}
        	?><br><?php echo form_error('style'); ?>
        	<label for="style" class="error"  >Please select an option</label>
        <p>
<br />
            <strong>Do you like the look of the label?</strong>
            </p>

       <ul >
        	<?php 
        		for ($i = 1; $i <= 10; $i++)
        			echo "<li>$i</li>";
        	?>        	
        	</ul>
            <?php 
        		for ($i = 1; $i <= 10; $i++)
        		{
        			if($i == 1)
        				echo '<input type="radio" name="label" validate="required:true" class="spacer" value="'.$i.'"'. set_radio('label', '1'). ' />&nbsp;';
        			else
        				echo '<input type="radio" name="label" class="spacer" value="'.$i.'"'. set_radio('label', $i). ' />&nbsp;';
        		}
        	?><br><?php echo form_error('label'); ?>
        	<label for="label" class="error"  >Please select an option</label>
         <p>
<br />
            <strong>Does the label deliver the information that you seek?</strong>
            </p>

        <ul >
        	<?php 
        		for ($i = 1; $i <= 10; $i++)
        			echo "<li>$i</li>";
        	?>        	
        	</ul>
            <?php 
        		for ($i = 1; $i <= 10; $i++)
        		{
        			if($i == 1)
        				echo '<input type="radio" name="labelInfo" validate="required:true" class="spacer" value="'.$i.'"'. set_radio('labelInfo', '1'). ' />&nbsp;';
        			else
        				echo '<input type="radio" name="labelInfo" class="spacer" value="'.$i.'"'. set_radio('labelInfo', $i). '/>&nbsp;';
        		}
        	?><br><?php echo form_error('labelInfo'); ?>
        	<label for="labelInfo" class="error"  >Please select an option</label>
         <p>
<br />	
            <strong>Do you have any comments that you wish to make relating to the wine generally, the wine quality, the style, or even the label? </strong></p>

        <p >

            <textarea name="comments" cols="" rows="" class="txt_area_reg1"><?=set_value('comments');?></textarea></p>

        <p>

            And now two questions from Ditch the Pitch.</p>

        <p>

            How did you Hear about us?</p>

        <p >

            <select name="hearaboutus" class="input_reg1 dropDown required">

                <option  <?php echo set_select('hearaboutus', '', TRUE); ?> value="">Please Select</option>
                <option  <?php echo set_select('hearaboutus', 'radio'); ?> value="radio">Radio</option>
                <option <?php echo set_select('hearaboutus', 'tv'); ?> value="tv">TV</option>
                <option <?php echo set_select('hearaboutus', 'newspaper'); ?> value="newspaper">Newspaper</option>
                <option <?php echo set_select('hearaboutus', 'internet'); ?> value="internet">Internet</option>
           </select>
           <br>
		<?php echo form_error('hearaboutus'); ?>
		<label for="hearaboutus" class="error">Please select an option</label>
        </p>

        <p>

            In your opinion, how can we do things right?</p>

        <p class="feedbackitem">

            <textarea name="opinion" cols="" rows="" class="txt_area_reg1" ><?=set_value('opinion');?></textarea></p>
            
            
       <p class="feedbackitem">
<label for="encycode" >Access Code</label><br>
            <input name="encycode" type="text" class="input_reg1" value="<?=set_value('encycode');?>" />
            
            </p>
			<?php echo form_error('encycode'); ?>
        <p>
            

        <br />

        <br />

        <p align="left">
<input type="image" src="<?=IMG_FOLDER;?>btn_submit2.png"  name="submit" /></p>
<input type="hidden" value="1" name="post">
    	<p>&nbsp;</p>
<?php echo form_close(); ?>
</div>

            <div class="cb">

            </div>

        </div>

    </div>
