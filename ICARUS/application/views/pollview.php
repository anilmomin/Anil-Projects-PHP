<html>
<head>
	<title>Poll Page</title>
    
    <script language="javascript">
	function add()
	{
		var el = document.getElementById("id1");
		el.innerHTML = el.innerHTML + "<input type=\"text\" name=\"optionText\[\]\" /><br>";
	}
    </script>    
</head>

<body>
    <?php
        echo form_open('pollManager/initiatePoll');
        echo "Subject of Poll <br> ".form_input($question)."<br>";
        echo "Start Date <br>".form_input('startTime',date("Y-m-d h:m:s"))."<br>";
        echo "ExpireDate <br> ".form_input('endTime',date("Y-m-d h:m:s"))."<br>";
        echo form_hidden($approve);?>

        Click and Add your Options
        <a href="#" onClick="add();">Click Here</a><br>
        <br><span id="id1"></span>

        <br><input type="submit" value="Initiate Poll">
        </form>
</body>
</html>
