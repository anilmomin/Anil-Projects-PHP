<html>
<head>
    <title>Poll Display</title>
</head>

<body>
<?php
        echo anchor('pollManager/show','Create Poll')."<br><br>";

        if ($resultquery != null)
        {
            foreach ($resultquery as $col)
            {
                if ($col->userId == $id)
                {
                    $current = true;            
                }
                else
                {
                    $current = false;
                }
            }
        }
        else
	{
            $current = false;
        }
	
        if ($pollquery != null)
        {
        	foreach ($pollquery as $row)
            {
                if ($row->approvalStatus == true)
                {
                    if ($current == false) 
		    {
			echo "Topic : ".$row->question."<br>
                        Give Rate ".anchor('pollManager/showPoll/'.$row->pollID,'Click here')."<br>
                        Status : Active<br><br><br>";
		    }
		    else 
		    {
			echo "Topic : ".$row->question."<br>
                        Show Rating : ".anchor('pollManager/showRate/'.$row->pollID,'Click here')."<br>
                        Status : Active<br><br><br>";
		    }
                }
                else if ($canApprove == true)
                {
                    echo "Topic : ".$row->question."<br>
					Approval : ".anchor('pollManager/approve/'.$row->pollID,'Approve ')." / "
					.anchor('pollManager/disApprove/'.$row->pollID,'Disapprove')."<br>
					Status : Pending for approval<br><br><br>";
                }
                else
                {
                    echo "Topic : ".$row->question."<br>
					Status : Pending for Approval<br><br>";
                }
            }
	}
        else
        {
            echo "Start the Application by Creating the New Poll";
        }
?>

</body>
</html>
