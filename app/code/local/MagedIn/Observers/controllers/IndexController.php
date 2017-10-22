<?php

class MagedIn_Observers_IndexController extends Mage_Core_Controller_Front_Action
{

    public function customEventAction()
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = Mage::getModel('catalog/product');
        $product->setName('Product Created From MagedIn Observer Module');

        /** @var Mage_Customer_Model_Customer $customer */
        $customer = Mage::getModel('customer/customer');
        $customer->setFirstname('John');
        $customer->setLastname('Americo');

        Mage::dispatchEvent('magedin_observers_instantiate_new_product', [
            'product'  => $product,
            'customer' => $customer
        ]);

        $customerName = $customer->getName();
        $productName  = $product->getName();
    }

}
