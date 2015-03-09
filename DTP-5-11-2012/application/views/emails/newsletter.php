<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body style="width: 960px; color: #666; font-family: sans-serif; font-size:14px; line-height:19px;">
    <div >
        <div style="background: url(<?php echo $image_url;?>bgTitle.png); height:118px; position:relative; z-index:100; background-position:center; padding-top:40px;">
            <table>
                <tr>
                    <td style="text-align:right;" width="300"><a href="<?=$base_url?>contactus">Contact</a></td>
                    <td style="text-align:center;" width="350"><a href="<?=$base_url?>"><img src="<?php echo $image_url;?>mainlogo.png" /></a></td>
                    <td style="text-align:left;"width="300"></td>
                </tr>
            </table>
        </div>
        <div style="background: url(<?php echo $image_url;?>bg.jpg); margin-top:-66px; padding:30px;" >
            <div style="background:#fff; padding:40px;">
                <div style="">
                    <p>Hi <?=$username?></p>
                    <p>Welcome to our wine deals newsletter!</p>
                    <p>It is with much pleasure that we advertise the first deals based on prices influenced by you, the consumer.
 
						Click on one of the links below to read about what you and the winemaker had to say about the same wine!</p>
                    <p>Cheers,</p>
                    <p><b>Ditch the Pitch Team</b></p>
                </div>

                <table cellpadding="0" cellspacing="0" style="margin-top:30px; border-top:solid 1px #d74140;">
				<?php if($wines){
				$facebook = 'http://www.facebook.com/DitchThePitch';
				$wines_count = count($wines);
				
				for($i=0;$i<$wines_count;$i+=2){
				$output ='';
				$wine1 = (isset($wines[$i]))?$wine1=$wines[$i]:array();
				$wine2 = (isset($wines[($i+1)]))?$wine2=$wines[$i+1]:array();
				if($wine1 || $wine2){
				$output = '<tr>';
				if($wine1){
					$output .= '<td width="344" style="padding-left:30px; padding-right:20px; padding-top:20px;">
                            <div style="margin:0px;"><img src="'.$image_url.'bgnewRibbontop.jpg" /></div>
                            <div style=" background:#f5f5f5; padding-left:18px; padding-bottom:30px;">
							
                                <div style="background: url('.$image_url.'newribbon.jpg); background-repeat:no-repeat; margin:0px; margin-bottom:10px; padding-left:60px; height:50px; padding-top:20px;"><div style="font-weight:bold;">'.$wine1->wineryName.'</div><div style="font-size:18px; color:#d74140; font-weight:bold;"> '.$wine1->wineName.'</div> </div>
                                <table>
									<tr>
									<td><span style="display:inline-block;"><img width="101" height="177" src="'.$base_url.'uploads/wines/'.$wine1->wineImage.'" /></span></td>
									<td style="vertical-align:top;padding-top:10px;">
									<div style="font-weight:bold">'.$wine1->regionName.'</div>
									<div style="font-weight:bold">'.$wine1->wineVintage.' '.$wine1->wineStyle.'</div>
									<div >Without the Pitch: <span style="font-weight:bold">$'.$wine1->wineDdPValue.' per six pack</span> </div>
									<div>Winery Direct Special Offer</div>
									<div style="font-weight:bold;text-decoration:underline">$'.$wine1->winePrice.' per six pack</div>
									</td>
									</tr>
								</table>
								
                                
								
                                <span><a href="'.$facebook.'" target="_blank"><img src="'.$image_url.'fb.jpg" /></a> <a><img src="'.$image_url.'btnBuyNow.jpg" /></a> <a target="_blank" href="'.$base_url.'winedetails/index/'.$wine1->wineId.'"> <img src="'.$image_url.'btnMore.jpg" /></a></span>
                            </div>
                        </td>';
				}else{
					$output .='<td></td>';
				}
				
				if($wine2){
					$output .= '<td width="344" style="padding-left:30px; padding-right:20px;  padding-top:20px;">
                            <div style="margin:0px;"><img src="'.$image_url.'bgnewRibbontop.jpg" /></div>
                            <div style=" background:#f5f5f5; padding-left:18px; padding-bottom:30px;">
                                 <div style="background: url('.$image_url.'newribbon.jpg); background-repeat:no-repeat; margin:0px; margin-bottom:10px; padding-left:60px; height:50px; padding-top:20px;"><div style="font-weight:bold;">'.$wine2->wineryName.'</div><div style="font-size:18px; color:#d74140; font-weight:bold;"> '.$wine2->wineName.'</div> </div>
                                <table>
									<tr>
									<td><span style="display:inline-block;"><img width="101" height="177" src="'.$base_url.'uploads/wines/'.$wine2->wineImage.'" /></span></td>
									<td style="vertical-align:top;padding-top:10px;">
									<div style="font-weight:bold">'.$wine2->regionName.'</div>
									<div style="font-weight:bold">'.$wine2->wineVintage.' '.$wine2->wineStyle.'</div>
									<div >Without the Pitch: <span style="font-weight:bold">$'.$wine2->wineDdPValue.' per six pack</span> </div>
									<div>Winery Direct Special Offer</div>
									<div style="font-weight:bold;text-decoration:underline">$'.$wine2->winePrice.'  per six pack</div>
									</td>
									</tr>
								</table>
                                <span><a href="'.$facebook.'" target="_blank"><img src="'.$image_url.'fb.jpg" /></a> <a><img src="'.$image_url.'btnBuyNow.jpg" /></a> <a target="_blank" href="'.$base_url.'winedetails/index/'.$wine2->wineId.'"> <img src="'.$image_url.'btnMore.jpg" /></a></span>
                            </div>
                        </td>';
				}else{
					$output .='<td></td>';
				}
				
				$output .= ' </tr>';
				echo $output;
				}//either of wine1 or wine2 is true.
				}//for
				}//if?>
                </table>

            </div>
            <div style="background: url(<?php echo $image_url;?>bottombar.png); height:90px; background-position:center; margin-top:30px; padding-top:60px">
                <table>
                    <tr>
                        <td width="440" style="text-align:center; color:#fff;"><img src="<?php echo $image_url;?>icnTw.png" align="center" /> <a href="https://twitter.com/Winepricing" target="_blank" style="color:#fff;">Follow Us On Twitter</a></td>
                        <td width="400" style="text-align:center; color:#fff;"><img src="<?php echo $image_url;?>icnFB.png" align="center" />  <a href="<?=$facebook?>" target="_blank" style="color:#fff;">Check our Facebook Page </a></td>
                    </tr>
                </table>
            
            </div>
            <div style="padding:20px 80px; text-align:center;"><p>Warning: Under the Liquor Control Act 1988, it is an offence: to sell or supply liquor to a person under the age of 18 years on licensed or regulated premised; or for a person under the age of 18 years to purchase, or attempt to purchase, liquor on licensed or regulated premises.</p>
                <p>
                Goto Top</p>
            </div>
        </div>
    
    </div>

</body>
</html>
