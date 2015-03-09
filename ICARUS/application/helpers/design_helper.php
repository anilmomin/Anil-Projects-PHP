<?php



/**

 * @author TEAM ViRiLiTY

 * @copyright 2009

 */

 

define('COLOUR_WHITE', 'white');

define('COLOUR_BLACK', 'black');

define('COLOUR_GREY', 'grey');

define('COLOUR_YELLOW', 'yellow');

define('COLOUR_BLUE', 'blue');

define('COLOUR_GREEN', 'green');

define('COLOUR_RED', 'red');

define('COLOUR_ORANGE', 'orange');

define('COLOUR_NICE_BLUE', 'niceblue');



define('SIZE_SMALLEST', 'size1');

define('SIZE_SMALL', 'size2');

define('SIZE_MEDIUM', 'size3');

define('SIZE_LARGE', 'size4');

define('SIZE_LARGEST', 'size5');



function dateTimePickerBox($tagId)

{

	return '<a href="#" onClick="javascript:NewCal(\'' . $tagId . '\',\'yyyymmdd\',true,24);"><img src="' . base_url() . 'system/application/views/img/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>';

}



function contentBox($title, $text, $colour, $marker = '*', $titleSize = SIZE_SMALLEST, $textList = null)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container">' .

					'<div class="content1-container-1col">' .

					'<p class="content-title-shade-' . $titleSize . ' bg-' . $colour . '10 txt-white box-on">' . $marker . "&nbsp;</p>" .

					'<p class="content-title-shade-' . $titleSize . ' bg-' . $colour . '05 txt-white">' . $title . '</p>' .

					'<div class="content-txtbox-shade bg-' . $colour . '03">' .

					'<p>' . $text . '</p>';

					

					if (!empty($textList) && count($textList) > 0)

					{

						$returnText .= '<ul class="indent">';

						foreach ($textList as $text)

						{

							$returnText .= '<li>' . $text . '</li>';

						}

						$returnText .= '</ul>';

					}

					

	$returnText .= '</div>' .

					'</div>' .

					'</div>';

					

	return $returnText;

}



function titleBox($text, $titleSize = SIZE_SMALLEST)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container">' .

					'<div class="content1-container-1col">' .

					'<p class="content-title-shade-' . $titleSize . '">' . $text . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p></p>' .

					'</div>' .

					'</div>' .

					'</div>';

	

	return $returnText;

}





function messageBox($title, $text, $titleBackGroundColour = COLOUR_WHITE, $textBackGroundColour = COLOUR_WHITE, $titleForeGroundColour = COLOUR_BLUE, $textForeGroundColour = COLOUR_BLUE, $titleSize = SIZE_MEDIUM, $textSize = SIZE_SMALLEST)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container">' .

					'<div class="content1-container-1col">' .

					'<p class="content-title-noshade-' . $titleSize . ' txt-' . $titleForeGroundColour . ((!checkBlackAndWhite($titleForeGroundColour)) ? '10' : '') . ' bg-' . $titleBackGroundColour . ((!checkBlackAndWhite($titleBackGroundColour)) ? '06' : '') . '">' . $title . '</p>' .

					'<p class="content-subtitle-shade-' . $textSize . ' txt-' . $textForeGroundColour . ((!checkBlackAndWhite($textForeGroundColour)) ? '07' : '') . ' bg-' . $textBackGroundColour . ((!checkBlackAndWhite($textBackGroundColour)) ? '03' : '') . '">' . $text . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p></p>' .

					'</div>' .

					'</div>' .

					'</div>';

					

	return $returnText;

}





function sideBarMenuWithSubMenus($menuName, $subMenuItems)

{

	$returnText = '<ul>' .

					'<li class="title">' . $menuName . '</li>';

					

	foreach ($subMenuItems as $item)

	{

		if (!isset($item['link']))

		{

			$returnText .= '<li class="group"><a>' . $item['title'] . '</a></li>';

		}

		else

		{

			$returnText .= '<li class="group"><a href="' .

					$item['link'] .

					'">' . $item['title'] . '</a></li>';

		}

						

		if ($item['hasSubItems'])

		{

			foreach ($item['subMenus'] as $subMenus)

			{

				if (!isset($subMenus['link']))

				{

					$returnText .= '<li>' . $subMenus['title'] . '</li>';

				}

				else

				{

					$returnText .= '<li><a href="' .

							$subMenus['link'] .

							'">' . $subMenus['title'] . '</a></li>';

				}

			}

		}

	}

	

	$returnText .= '</ul>';

	

	return $returnText;

}





function sideBarMenuWithTextLines($menuName, $lines = null)

{

	$returnText = '<p class="sidebar-maintitle">' . $menuName . '</p>' .

					'<!-- Textbox -->' .

					'<div class="sidebar-txtbox-noshade">';

					

	foreach ($lines as $line)

	{

		$returnText .= '<p>' . $line . '</p>';

	}

	

	$returnText .= '</div>';

	

	return $returnText;

}





function sideBarBox($title, $text)

{

	$returnText = '<!-- Textbox -->' .

					'<p class="sidebar-title-noshade">' . $title . '</p>' .

					'<div class="sidebar-txtbox-noshade"><p>' . $text . '</p>' .

					'</div>';

					

	return $returnText;

}





function mainBodyTitle($title, $frontColour = COLOUR_BLACK, $backColour = COLOUR_WHITE)

{

	$returnText = '<div class="content1-pagetitle txt-' . $frontColour . ((!checkBlackAndWhite($frontColour)) ? '10' : '') . ' bg-' . $backColour . ((!checkBlackAndWhite($backColour)) ? '06' : '') . '">' . $title . '</div>';

	

	return $returnText;

}





function readMoreBar($text)

{

	$returnText = '<p class="readmore">' . $text . '</p>';

	return $returnText;

}





function mainBodySingleColumnBox($title, $subTitle, $text, $line = true, $titleFrontColour = COLOUR_BLUE, $titleBackColour = COLOUR_WHITE, $subTitleFrontColour = COLOUR_BLUE, $subTitleBackColour = COLOUR_WHITE)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container' . (($line) ? ' line-box' : '') . '">' .

					'<div class="content1-container-1col">' .

					'<p class="content-title-noshade-size3 txt-' . $titleFrontColour . ((!checkBlackAndWhite($titleFrontColour)) ? '10' : '') . ' bg-' . $titleBackColour . ((!checkBlackAndWhite($titleBackColour)) ? '06' : '') . '">' . $title . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $subTitleFrontColour . ((!checkBlackAndWhite($subTitleFrontColour)) ? '10' : '') . ' bg-' . $subTitleBackColour . ((!checkBlackAndWhite($subTitleBackColour)) ? '06' : '') . '">' . $subTitle . '</p>' .

        			'<div class="content-txtbox-noshade">' .

        			'<p>' . $text . '</p>' .

					'</div>' .

					'</div>' .

					'</div>';

					

	return $returnText;

}





function mainBodyDoubleColumnBox($columnLeft, $columnRight, $line = true)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container' . (($line) ? ' line-box' : '') . '">' .

					'<div class="content1-container-2col-left">' .

					'<p class="content-title-noshade-size3 txt-' . $columnLeft['titleFrontColour'] . ((!checkBlackAndWhite($columnLeft['titleFrontColour'])) ? '10' : '') . ' bg-' . $columnLeft['titleBackColour'] . ((!checkBlackAndWhite($columnLeft['titleBackColour'])) ? '06' : '') . '">' . $columnLeft['title'] . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $columnLeft['subTitleFrontColour'] . ((!checkBlackAndWhite($columnLeft['subTitleFrontColour'])) ? '10' : '') . ' bg-' . $columnLeft['subTitleBackColour'] . ((!checkBlackAndWhite($columnLeft['subTitleBackColour'])) ? '06' : '') . '">' . $columnLeft['subTitle'] . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p>' . $columnLeft['text'] . '</p>' .

					'</div>' .

					'</div>' .

					'<div class="content1-container-2col-right">' .

					'<p class="content-title-noshade-size3 txt-' . $columnRight['titleFrontColour'] . ((!checkBlackAndWhite($columnRight['titleFrontColour'])) ? '10' : '') . ' bg-' . $columnRight['titleBackColour'] . ((!checkBlackAndWhite($columnRight['titleBackColour'])) ? '06' : '') . '">' . $columnRight['title'] . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $columnRight['subTitleFrontColour'] . ((!checkBlackAndWhite($columnRight['subTitleFrontColour'])) ? '10' : '') . ' bg-' . $columnRight['subTitleBackColour'] . ((!checkBlackAndWhite($columnRight['subTitleBackColour'])) ? '06' : '') . '">' . $columnRight['subTitle'] . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p>' . $columnRight['text'] . '</p>' .

					'</div>' .

					'</div>' .

					'</div>';

					

	return $returnText;

}





function mainBodyTrippleColumnBox($columnLeft, $columnMiddle, $columnRight, $line = true)

{

	$returnText = '<!-- Text container -->' .

					'<div class="content1-container' . (($line) ? ' line-box' : '') . '">' .

					'<div class="content1-container-3col-left">' .

					'<p class="content-title-noshade-size3 txt-' . $columnLeft['titleFrontColour'] . ((!checkBlackAndWhite($columnLeft['titleFrontColour'])) ? '10' : '') . ' bg-' . $columnLeft['titleBackColour'] . ((!checkBlackAndWhite($columnLeft['titleBackColour'])) ? '06' : '') . '">' . $columnLeft['title'] . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $columnLeft['subTitleFrontColour'] . ((!checkBlackAndWhite($columnLeft['subTitleFrontColour'])) ? '10' : '') . ' bg-' . $columnLeft['subTitleBackColour'] . ((!checkBlackAndWhite($columnLeft['subTitleBackColour'])) ? '06' : '') . '">' . $columnLeft['subTitle'] . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p>' . $columnLeft['text'] . '</p>' .

					'</div>' .

					'</div>' .

					'<div class="content1-container-3col-middle">' .

					'<p class="content-title-noshade-size3 txt-' . $columnMiddle['titleFrontColour'] . ((!checkBlackAndWhite($columnMiddle['titleFrontColour'])) ? '10' : '') . ' bg-' . $columnMiddle['titleBackColour'] . ((!checkBlackAndWhite($columnMiddle['titleBackColour'])) ? '06' : '') . '">' . $columnMiddle['title'] . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $columnMiddle['subTitleFrontColour'] . ((!checkBlackAndWhite($columnMiddle['subTitleFrontColour'])) ? '10' : '') . ' bg-' . $columnMiddle['subTitleBackColour'] . ((!checkBlackAndWhite($columnRight['subTitleBackColour'])) ? '06' : '') . '">' . $columnMiddle['subTitle'] . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p>' . $columnMiddle['text'] . '</p>' .

					'</div>' .

					'</div>' .

					'<div class="content1-container-3col-right">' .

					'<p class="content-title-noshade-size3 txt-' . $columnRight['titleFrontColour'] . ((!checkBlackAndWhite($columnRight['titleFrontColour'])) ? '10' : '') . ' bg-' . $columnRight['titleBackColour'] . ((!checkBlackAndWhite($columnRight['titleBackColour'])) ? '06' : '') . '">' . $columnRight['title'] . '</p>' .

					'<p class="content-subtitle-noshade-size1 txt-' . $columnRight['subTitleFrontColour'] . ((!checkBlackAndWhite($columnRight['subTitleFrontColour'])) ? '10' : '') . ' bg-' . $columnRight['subTitleBackColour'] . ((!checkBlackAndWhite($columnRight['subTitleBackColour'])) ? '06' : '') . '">' . $columnRight['subTitle'] . '</p>' .

					'<div class="content-txtbox-noshade">' .

					'<p>' . $columnRight['text'] . '</p>' .

					'</div>' .

					'</div>' .

					'</div>';

					

	return $returnText;

}





function prepareColumnData($title, $subTitle, $text, $titleFrontColour = COLOUR_BLUE, $titleBackColour = COLOUR_WHITE, $subTitleFrontColour = COLOUR_BLUE, $subTitleBackColour = COLOUR_WHITE)

{

	return array(

		'title' => $title,

		'subTitle' => $subTitle,

		'text' => $text,

		'titleFrontColour' => $titleFrontColour,

		'titleBackColour' => $titleBackColour,

		'subTitleFrontColour' => $subTitleFrontColour,

		'subTitleBackColour' => $subTitleBackColour

		);

}





function checkBlackAndWhite($colourName)

{

	if (stripos($colourName, COLOUR_WHITE) !== false || stripos($colourName, COLOUR_BLACK) !== false)

	{

		return true;

	}

	else

	{

		return false;

	}

}

function form_multipleSelect($properties, $optionsArray)
{
	$finalStr = '<select';
	
	foreach ($properties as $index => $property)
	{
		$finalStr .= ' ' . $index . '="' . $property . '"';
	}
	
	$finalStr .= ' multiple="multiple">';
	
	foreach ($optionsArray as $optionVal => $optionText)
	{
		$finalStr .= '<option value="' . $optionVal . '">' . $optionText . '</option>';
	}
	
	$finalStr .= '</select>';
	
	return $finalStr;
}



?>