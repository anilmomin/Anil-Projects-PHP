<?php

/**
 * @author TEAM ViRiLiTY
 * @copyright 2009
 */

class Domicile extends IgnitedRecord
{	
    function fetch()
	{
        return $this->find_all();
    }
}

?>