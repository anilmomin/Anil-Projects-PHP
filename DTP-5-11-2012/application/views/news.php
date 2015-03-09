<?php 
include 'designconstants.php' 
?>


<div id="standardArc">
    </div>
<div id="outerContent">
        <div class="content howitworks">
            <div class="banner">
                <img src="<?=IMG_FOLDER;?>Howitwork.png">
                 <p class="bannerheading"><b>Ditch the Pitch </b>promotes the responsible service of alcohol. To participate in the wine evaluations promoted within this site, you will have to be aged 18 years or older and be based in Australia. </b>
            <div class="cb">
            </div>
        </div>
        <div class="textColumns">
            <?php
				foreach ($newsdata as $news)
				{
					echo "<p> $news->news </p>";
					echo "<p> $news->created_date </p>";
				}
            ?>
        </div>
       <div class="cb"></div>
    </div>