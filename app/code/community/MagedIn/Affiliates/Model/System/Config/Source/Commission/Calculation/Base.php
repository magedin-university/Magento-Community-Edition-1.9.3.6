<?php

class MagedIn_Affiliates_Model_System_Config_Source_Commission_Calculation_Base
{

    const SUBTOTAL                = '1';
    const SUBTOTAL_WITH_DISCOUNTS = '2';
    const GRAND_TOTAL             = '3';


    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        foreach ($this->toArray() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $options;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            self::SUBTOTAL                => $this->helper()->__('Order Subtotal'),
            self::SUBTOTAL_WITH_DISCOUNTS => $this->helper()->__('Order Subtotal With Discounts'),
            self::GRAND_TOTAL             => $this->helper()->__('Order Grand Total'),
        ];
    }


    /**
     * @return MagedIn_Affiliates_Helper_Data
     */
    protected function helper()
    {
        return Mage::helper('magedin_affiliates');
    }

}
