<?php

class MagedIn_Rewrites_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Overriding a model class.
     */
    public function modelRewriteAction()
    {
        /** @var Mage_Customer_Model_Customer $customer */
        $customer = Mage::getModel('customer/customer');
    }


    /**
     * Overriding a helper class.
     */
    public function helperRewriteAction()
    {
        /** @var Mage_Customer_Helper_Data $helper */
        $helper = Mage::helper('customer');
    }


    /**
     * Overriding a block class.
     */
    public function blockRewriteAction()
    {
        $this->loadLayout();

        /** @var Mage_Page_Block_Html_Header $block */
        $block = $this->getLayout()->getBlock('header');
    }

}
