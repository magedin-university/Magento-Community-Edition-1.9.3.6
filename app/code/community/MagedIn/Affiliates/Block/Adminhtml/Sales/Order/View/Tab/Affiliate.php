<?php

class MagedIn_Affiliates_Block_Adminhtml_Sales_Order_View_Tab_Affiliate
    extends Mage_Adminhtml_Block_Template
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    use MagedIn_Affiliates_Trait_Currency;


    protected function _construct()
    {
        $this->setTemplate('magedin/affiliates/sales/order/view/tab/affiliates.phtml');
        parent::_construct();
    }


    /**
     * @return bool|MagedIn_Affiliates_Model_Affiliate
     */
    public function getOrderAffiliate()
    {
        if ($this->hasData('order_affiliate')) {
            return $this->getData('order_affiliate');
        }

        /** @var Mage_Sales_Model_Order $order */
        $order = $this->_getOrder();

        if (!$order) {
            return false;
        }

        $affiliateId = (int) $order->getData('affiliate_id');

        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliate = Mage::getModel('magedin_affiliates/affiliate');
        $affiliate->load($affiliateId);

        if (!$affiliate->getId()) {
            return false;
        }

        $this->setData('order_affiliate', $affiliate);

        return $affiliate;
    }


    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Related Affiliate');
    }


    /**
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }


    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }


    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }


    /**
     * @return bool|Mage_Sales_Model_Order
     */
    protected function _getOrder()
    {
        /** @var Mage_Adminhtml_Block_Sales_Order_View_Tab_Info $block */
        $block = $this->_getOrderTabInfo();

        if (!$block) {
            return false;
        }

        /** @var Mage_Sales_Model_Order $order */
        $order = $block->getOrder();

        if (!$order || !$order->getId()) {
            return false;
        }

        return $order;
    }


    /**
     * @return Mage_Adminhtml_Block_Sales_Order_View_Tab_Info
     */
    protected function _getOrderTabInfo()
    {
        /** @var Mage_Adminhtml_Block_Sales_Order_View_Tab_Info $block */
        $block = $this->getLayout()->getBlock('order_tab_info');
        return $block;
    }

}
