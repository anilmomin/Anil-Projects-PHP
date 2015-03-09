<?php

require_once 'ditchthepitchmodel.php';

class WineStyles extends DitchThePitchModel
{
    public function __construct()
    {
        parent::__construct();
        
        $this->tableName = TABLE_WINESTYLE;
        
        $this->addPrimaryKey('winestyleId');
    }


}