<?php
$page_uri = explode('/', uri_string());

if($page_uri[1] == 'wineusers'): ?><h1 class="formHead">Wine sample requests</h1> <?php endif;?>
<ul class="sideNav">
<?php


if ($page_uri[1] == 'wines'): ?>
<li><a href="<?php echo site_url(); ?>/admin/wines/addwines" class="sidelink">Add Wines</a><br />
<p class="other"><a href="<?php echo site_url(); ?>/admin/wines/editwines">Edit</a>/<a href="<?php echo site_url(); ?>/admin/wines/viewwines">View</a>/<a href="<?php echo site_url('admin/wines/delpage');?>">Delete</a> &nbsp  <i>Wines</i></p></li>
<?php
elseif ($page_uri[1] == 'wineusers'):?>
<li><a class="sidelink" href="<?=site_url('admin/wineusers/showincreq/1'); ?>">Current Wine Sample Requests</a></li>
			<li><a class="sidelink" href="<?=site_url('admin/wineusers/showincreq/2'); ?>">Pending Invitation Confirmation</a></li>
			<li><a class="sidelink" href="<?=site_url('admin/wineusers/showincreq/3'); ?>">Accepted Requests</a></li>
			<li><a class="sidelink" href="<?=site_url('admin/wineusers/showincreq/4'); ?>">Completed Requests</a></li>
<?php 
elseif ($page_uri[1] == 'newsmanager'):?>
 <li><a href="<?php echo site_url('admin/newsmanager/addnews');?>" class="sidelink">Add news</a><br /><p class="other"><a href="<?php echo site_url('admin/newsmanager/shownews');?>">Edit</a>/<a href="<?php echo site_url('admin/newsmanager/shownews');?>">View</a>/<a href="<?php echo site_url('admin/newsmanager/shownews');?>">Delete</a> &nbsp &nbsp<i>News</i></p></li>
<?php 
elseif($page_uri[1] == 'newsletters'):?> 
<li><a href="<?php echo site_url('admin/newsletters/addnewsletter');?>" class="sidelink">Add newsletter</a><br /><p class="other"><a href="<?php echo site_url('admin/newsletters/shownewsletter');?>">Edit</a>/<a href="<?php echo site_url('admin/newsletters/shownewsletter');?>">View</a>/<a href="<?php echo site_url('admin/newsletters/shownewsletter');?>">Delete</a> &nbsp &nbsp<i>Newsletter</i></p></li>
<?php elseif($page_uri[1] == 'auth' || $page_uri[1] == 'usermanagement'):?><li>
<a href="<?php echo site_url('admin/auth/registerbyadmin'); ?>" class="sidelink">Add new users</a><br /><p class="other"><a href="<?php echo site_url('admin/usermanagement/showusers'); ?>">Edit</a>/<a href="<?php echo site_url('admin/usermanagement/showusers'); ?>">View</a>/<a href="<?php echo site_url('admin/usermanagement/showusers'); ?>">Delete</a> &nbsp &nbsp<i>Users</i></p>
<?php else:?>
 <span></span>
<?php 
endif;?>

</ul>