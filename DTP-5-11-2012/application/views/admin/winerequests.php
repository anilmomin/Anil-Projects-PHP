<?php 

include 'designconstants.php';
$requestForm = array('name' => 'requestForm', 'id' => 'requestForm');

?>
<?php include 'sidenav.php'; ?>
<div class="form">
<?php echo form_open($this->uri->uri_string(), $requestForm); ?>
				
				<h1>Assign Wine samples</h1>
<div class="winecontainer" style="float:left">
<h2>Wines</h2>
<select id="selectwine" name="selectwine">
<?php foreach($wineData as $wine) :?>
<option value="<?=$wine->wineId?>" data-imagesrc="<?=UPLOAD_FOLDER . 'wines/'. $wine->wineImage; ?>" data-description="<?=$wine->wineDescription?><br><?=$wine->wineStyle?>"><?=$wine->wineName?></option>
<?php endforeach;?>
</select>
</div>
<div class="usercontainer" style="float:right;">
<h2>Users</h2>
<select id="selectuser" name="selectuser">
<?php foreach($userData as $user) :?>
<option value="<?=$user['id']?>" data-description="<?=$user['preference']?>"><?=$user['first_name'] . ' ' . $user['last_name']; ?></option>
<?php endforeach;?>
</select>
</div>
<input type="hidden" name="post" value="1" />
<input type="submit" name="saveallocation" value="Save" />
<?php echo form_close() ?>
            </div>
<div class="cb"></div>

?>