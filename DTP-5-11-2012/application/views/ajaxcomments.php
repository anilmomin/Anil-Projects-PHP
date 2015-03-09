<div id="data">
  <?php
    if(!empty($threads))
    {
    	foreach ($threads as $thread) 
    	{
    	?>
     <div class="commentWrap">
     	 <img src="<?=IMG_FOLDER;?>prf1.jpg">
         <p><?=$thread->comment?></p>
         <p><span class="red2">by <?php echo $thread->name; ?> </span>&nbsp;&nbsp; | &nbsp;&nbsp;  <span class="green1"><?php echo $msg = $thread->day_ago == 0 ? "Today at " . date('h:i A', strtotime($thread->created_date)) : $thread->day_ago . " day(s) ago";   ?></span></p>
         <div class="cb"></div>
     </div>
     <?php
    	}
    } 
?>
</div>

<div id="ajax_paging">
  <?php echo $pagination; ?>
</div>