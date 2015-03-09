<div class="wrap">
		<div id="main-content">
		<!--tabs-->
		  <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		    	<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		    	
		    	 <!--
				  <li class="ui-state-default ui-corner-top "><a href="#tabs-2">Current Disputes</a></li>
				  <li class="ui-state-default ui-corner-top"><a href="#tabs-3">Resolved Disputes</a></li>
				  -->
				  
				<?php if(strstr(uri_string(), "profile")) {
						if($this->uri->segment(2) != 'forgetpassword'){
					?>
				  <li class="ui-state-default ui-corner-top"><a href="#tabs-3">Profile</a></li>
				<?php 
						}
						} else {?>
				 <li id="dashboard_tab" class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a  href="#tabs-1">Dashboard</a></li>
				 <li class="ui-state-default ui-corner-top"><a href="#tabs-4">Report</a></li>
				 <?php } ?>
				</ul>
		
				 <?php 
				 	print_r($mb_data);
				 ?>
				  	
			</div>
		</div>
</div>		
		
	
