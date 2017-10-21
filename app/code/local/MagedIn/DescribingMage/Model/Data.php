<?php

class MagedIn_DescribingMage_Model_Data extends Varien_Object
{

    protected $_value = null;


    protected function _construct()
    {
        $this->_value = rand(10000, 99999);
        parent::_construct();
    }

}
