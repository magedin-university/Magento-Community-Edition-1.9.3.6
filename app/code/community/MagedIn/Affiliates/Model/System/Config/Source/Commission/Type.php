<?php

class MagedIn_Affiliates_Model_System_Config_Source_Commission_Type
{

    use MagedIn_Affiliates_Trait_Data,
        MagedIn_Affiliates_Model_System_Config_Source_Common;


    /** string */
    const PERCENT = '1';

    /** string */
    const FIXED   = '2';


    public function toArray()
    {
        return array(
            self::PERCENT => $this->__('Percent Value'),
            self::FIXED   => $this->__('Fixed Value'),
        );
    }

}
