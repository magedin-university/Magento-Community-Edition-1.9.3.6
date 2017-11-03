<?php

class MagedIn_Affiliates_Model_Resource_History_Collection
    extends MagedIn_Affiliates_Model_Resource_Collection_Abstract
{

    use MagedIn_Affiliates_Model_Resource_Trait_Collection;


    protected function _construct()
    {
        $this->_init('magedin_affiliates/history');
    }

}
