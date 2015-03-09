<?php
	include 'designconstants.php';
?>

<div>
      <h1 class="formHead">Delete Wines</h1>
</div>
		<?php include 'sidenav.php'; ?>
 <div class="form">
	<p style="color:#000; font-size:14px;" >Are you sure you want to delete all the wines for the current week?</p>	
	<br/>
	<br/>
	<b><a style="color:#000; font-size:14px;" href="<?php echo site_url('admin/wines/deletewines'); ?>" >Yes</a></b>&nbsp;&nbsp;&nbsp;&nbsp;
	<b><a style="color:#000; font-size:14px;" href="<?php echo site_url('admin/wines/'); ?>" >No</a></b>
</div>
<div class="cb"></div>