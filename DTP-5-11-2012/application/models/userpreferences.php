<?php

require_once 'ditchthepitchmodel.php';

class UserPreferences extends DitchThePitchModel
{
    public function __construct()
    {
        parent::__construct();
        
        $this->tableName = TABLE_USERPREFERENCES;
        
        $this->addPrimaryKey('user_preferencesId');
    }


}

?>