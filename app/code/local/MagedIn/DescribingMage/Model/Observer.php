<?php

class MagedIn_DescribingMage_Model_Observer
{

    /**
     * @param Varien_Event_Observer $observer
     */
    public function getRandValue(Varien_Event_Observer $observer)
    {
        /**
         * Retrieve something from Magento registry
         */
        $rand = (int) Mage::registry('magedin_describingmage_rand_value');

        /**
         * Unregister any value in Magento registry.
         */
        Mage::unregister('magedin_describingmage_rand_value');
    }

}
