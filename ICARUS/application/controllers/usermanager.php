<?php

/**
 * @author TEAM ViRiLiTY
 * @copyright 2009
 */

require_once('icaruscontroller.php');
require_once('moduleConstants.inc');

class UserManager extends IcarusController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->helper('design');
	}
	
	public function index()
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		
		if (!$this->Authorize->isAllowed($roleId, PERMISSION_CAN_VIEW, MODULE_MEMBERS))
		{
			$this->addMainBodyData(mainBodyTitle('Permission Not Granted', COLOUR_RED, COLOUR_RED));
			$this->displayView();
		}
		else
		{
			$this->displayView();
		}
	}
	
	public function testFunction()
	{
		$subMenu = array(
					array('title' => 'SubItem1', 'link' => '#'),
					array('title' => 'SubItem2', 'link' => '#'),
					array('title' => 'SubItem3', 'link' => '#')
				);
				
		$sideMenu = array(
				array('title' => 'First Title', 'link' => '#', 'hasSubItems' => true, 'subMenus' => $subMenu),
				array('title' => 'Second Title', 'link' => '#', 'hasSubItems' => true, 'subMenus' => $subMenu),
				);
				
		$this->addLeftSideBarData(sideBarMenuWithSubMenus("Main Menu", $sideMenu));
		$this->addLeftSideBarData(sideBarMenuWithSubMenus("Second Main Menu", $sideMenu));
		
		$this->addRightSideBarData(sideBarBox('Box Title', 'Some Box Text' . br()));
		$this->addRightSideBarData(sideBarBox('Second Box Title', 'Some Box Text' . br()));
		
		$this->addRightSideBarData(sideBarMenuWithTextLines('A Sample Menu', array('line1<br>Papaan', 'line2', 'line3')));
		
		$this->addMainBodyData(mainBodySingleColumnBox('A Single Column Box', 'A sub title', 'some faltu text in that box', true, COLOUR_BLUE, COLOUR_WHITE, COLOUR_RED, COLOUR_WHITE));
		
		$this->addMainBodyData(contentBox('A Sample Content Box .....', 'This is a sample test :)', COLOUR_RED));
		
		$this->addMainBodyData(messageBox('A Sample Message Box ....', 'And some faltu text ...'));
		
		$this->addMainBodyData(titleBox('A Sample Title Box'));
		
		$col1 = prepareColumnData("Column1", "Column1 SubTitle", "Column1 Text", COLOUR_GREEN, COLOUR_WHITE, COLOUR_BLUE, COLOUR_WHITE);
		
		$col2 = prepareColumnData("Column2", "Column2 SubTitle", "Column2 Text", COLOUR_BLUE, COLOUR_BLACK, COLOUR_BLUE, COLOUR_WHITE);
		
		$col3 = prepareColumnData("Column3", "Column3 SubTitle", "Column3 Text", COLOUR_RED, COLOUR_GREY, COLOUR_BLUE, COLOUR_WHITE);
		
		$twoColsSpace = mainBodyDoubleColumnBox($col1, $col2);
		$threeColsSpace = mainBodyTrippleColumnBox($col1, $col2, $col3);
		$this->addMainBodyData($threeColsSpace);
		$this->addMainBodyData($twoColsSpace);
		$this->displayView();
	}
}

?>