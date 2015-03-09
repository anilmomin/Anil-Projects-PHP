<div id="outerFooter">
            <div id="footer">
                <div class="heading">
                    <p style="font-size:24px;" >
                        Ditch the Pitch; values influenced by wine lovers, without the Pitch, without the marketing noise !
                    </p>
                </div>
                <div class="col col1" style="width: 205px">
                    <h3>
                        Register as a Winery</h3>
                    <?php
                    	$form = site_url('contactus/registerwinery'); 
                    	echo form_open($form); 
                    ?>    
                    <input type="text" name="name" class="input" value="Name" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="text" name="email" class="input" value="Email" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="text" name="winery" class="input" value="Winery Name" onfocus="clearText(this)" onblur="clearText(this)" />
                    <input type="text" name="subject" class="input" value="Subject" onfocus="clearText(this)" onblur="clearText(this)" />
                    <textarea name="msg" cols="" rows="20" class="input" style="height: 95px;" onfocus="clearText(this)" onblur="clearText(this)" >Message</textarea>
                    <br />
                    <input type="hidden" name="post" value="1" />
                    <p><input type="image" src="<?=IMG_FOLDER;?>btn_submit.png" alt="submit" /></p>
                </div>
                <div class="col col2">
                    <h3>
                        How it Works</h3>
                    <div id="add_user_bg"><iframe width="221px" height="205px" src="http://www.youtube.com/embed/yAqgAF0K2z4" frameborder="0" allowfullscreen></iframe>
                        <!-- <img src="<?=IMG_FOLDER;?>addUser_img.jpg" width="219" height="126" style="margin-top: 36px;" />--></div>
                </div>
                <?php echo form_close(); ?>
                <div class="col col3">
                    <h3>
                        Ditch the Pitch</h3>
                    <p class="txt_gray">
                       Values influenced by wine lovers, without the pitch, without the marketing noise!
                    </p>
                    <p class="social">
                        <a href="http://www.facebook.com/DitchThePitch" target="_blank">
                            <img src="<?=IMG_FOLDER;?>fb1.png" border="0" /></a> 
							<a href="https://twitter.com/Winepricing" target="_blank">
                                <img src="<?=IMG_FOLDER;?>twtr2.png" border="0" /></a> 
								<a href="http://www.linkedin.com/profile/edit?trk=hb_tab_pro_top" target="_blank">
                                    <img src="<?=IMG_FOLDER;?>link2.png" border="0" /></a> 
									<a href="http://feedity.com/perthwebsitebuilders-com-au/UFtRUltV.rss" target="_blank">
                                        <img src="<?=IMG_FOLDER;?>rss2.png" border="0" /></a> 
										<a href="http://www.youtube.com/watch?feature=player_embedded&v=yAqgAF0K2z4" target="_blank">
                                            <img src="<?=IMG_FOLDER;?>3rss.png" border="0" /></a></p>
                </div>
                <div class="col col4" style="width: 243px">
               <script src="http://widgets.twimg.com/j/2/widget.js"></script>
				<script>
				new TWTR.Widget({
				  version: 2,
				  type: 'profile',
				  rpp: 3,
				  interval: 30000,
				  width: 250,
				  height: 300,
				  theme: {
				    shell: {
				      background: '#0f020f',
				      color: '#ffffff'
				    },
				    tweets: {
				      background: '#000000',
				      color: '#ffffff',
				      links: '#e80000'
				    }
				  },
				  features: {
				    scrollbar: false,
				    loop: true,
				    live: false,
				    behavior: 'default'
				  }
				}).render().setUser('Winepricing').start();
				</script>
                </div>
                <div class="cb"></div>
                <div id="footer_btm">
                    <div class="copyright">
                        Copyright 2011 - <strong>Ditch the Pitch</strong><br />
                    </div>
                    <div class="footerNav">
                        <ul>
                            
							
                            <li><a href="<?=site_url('home/history')?>">History</a></li>
							<li><a href="<?=site_url('home/howitworks');?>">How it works</a></li>
							<li><a href="<?=site_url('home/aboutus');?>">About</a></li>
                          <li>
                            <a href=""
                              <?=site_url('home/privacy')?>" <?php echo $uppercurrent[1]; ?>>Privacy
                            </a>
                          </li>
                          <li>
                            <a href=""
                              <?=site_url('home/terms')?>" <?php echo $uppercurrent[2]; ?>>Terms and Conditions
                            </a>
                          </li>
                        </ul>
                    </div>

                          <div style="clear:both;"></div>           
                        <div style="width:500px; margin-top:20px; margin-left:20px; float:left;">
                            Warning Under the Liquor Control Act 1988, it is an offence: to sell or supply liquor
                            to a person under the age of 18 years on licensed or regulated premises; or for
                            a person under the age of 18 years to purchase, or attempt to purchase, liquor on
                            licensed or regulated premises.<br />
                            
                            </div>
                  
                    <p style="float:right; width:255px; margin-top:18px; ">
                      Site Design and Developed by <a href="http://perthwebsitebuilders.com.au/">
                        <img src="<?=IMG_FOLDER;?>icnPWB.png" border="0" />
                      </a>
                    </p>
                  
                  <div style="clear:all;"></div>
                </div>
            </div>
        </div>

</body>
</html>