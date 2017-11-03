<?php

class MagedIn_Affiliates_Model_System_Config_Source_Balance_History_Action_Type
{

    use MagedIn_Affiliates_Trait_Data,
        MagedIn_Affiliates_Model_System_Config_Source_Common;


    /** int */
    const ORDER_INVOICED    = 1;

    /** int */
    const ORDER_CANCELLED   = 2;

    /** int */
    const MANUAL_ADJUSTMENT = 3;


    public function toArray()
    {
        return array(
            self::ORDER_INVOICED    => $this->__('Order Invoiced'),
            self::ORDER_CANCELLED   => $this->__('Order Cancelled'),
            self::MANUAL_ADJUSTMENT => $this->__('Manual Adjustments'),
        );
    }

}
