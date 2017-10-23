<?php

class MagedIn_Rewrites_IndexController extends Mage_Core_Controller_Front_Action
{

    public function modelRewriteAction()
    {
        /** @var Mage_Customer_Model_Customer $customer */
        $customer = Mage::getModel('customer/customer');
    }


    public function helperRewriteAction()
    {
        /** @var Mage_Customer_Helper_Data $helper */
        $helper = Mage::helper('customer');
    }

}
