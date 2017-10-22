<?php

class MagedIn_Observers_Model_Observer
{

    /**
     * @param Varien_Event_Observer $observer
     *
     * @return void
     */
    public function changeProductAndCustomerModels(Varien_Event_Observer $observer)
    {
        if (!$observer->getEvent()->getName()) {
            return;
        }

        if ($observer->getEvent()->getName() != 'magedin_observers_instantiate_new_product') {
            return;
        }

        /** @var Mage_Catalog_Model_Product $product */
        $product = $observer->getData('product');
        $product->setDescription('This is the description of my product.');

        /** @var Mage_Customer_Model_Customer $customer */
        $customer = $observer->getData('customer');
        $customer->setMiddlename('Oliveira');
    }

}
