<html>
<head>
	<title>Give Rate</title>
</head>
<body>

    <?php
    echo form_open('pollManager/saveChoice');
    foreach ($query as $row)
    {
        echo form_radio('option', $row->optionID)." ".$row->optionText."<br>";
    }
    echo form_hidden('pollID',$this->uri->segment(3));
    ?>
        <input type="submit" value="Save your Choice">
        </form>
</body>
</html>

