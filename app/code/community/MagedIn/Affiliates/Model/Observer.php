<?php

class MagedIn_Affiliates_Model_Observer
{

    use MagedIn_Affiliates_Trait_Data;


    /**
     * This method is responsible for assigning and affiliate ID to browser cookies.
     *
     * @param Varien_Event_Observer $observer
     */
    public function assignAffiliateQueryParam(Varien_Event_Observer $observer)
    {
        $hash        = $this->getRequest()->getParam(MagedIn_Affiliates_Model_Affiliate_Query_Param::PARAM_CODE);
        $affiliateId = $this->_getAffiliateQueryParam()->getAffiliateId((string) $hash);

        /**
         * If we don't have the affiliate ID then we'll skip the process.
         */
        if (empty($affiliateId)) {
            return;
        }

        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliate = $this->getAffiliate($affiliateId);

        /**
         * If the affiliate ID is invalid then we'll skip the process.
         */
        if (!$affiliate->getId()) {
            return;
        }

        Mage::dispatchEvent('magedin_affiliates_cookie_register_before', array(
            'affiliate' => $affiliate,
        ));

        $this->getCookie()->set(MagedIn_Affiliates_Model_Affiliate_Query_Param::COOKIE_CODE, $hash);
    }


    /**
     * This method is responsible for assigning and affiliate ID to Quote.
     *
     * @param Varien_Event_Observer $observer
     */
    public function assignAffiliateToQuote(Varien_Event_Observer $observer)
    {
        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliate = $this->getAffiliate();

        if (!$affiliate || !$affiliate->getId()) {
            return;
        }

        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        if (!$quote || !($quote instanceof Mage_Sales_Model_Quote)) {
            return;
        }

        /**
         * Dispatch event for further use.
         */
        Mage::dispatchEvent('magedin_affiliates_assign_affiliate_to_quote', array(
            'quote'     => $quote,
            'affiliate' => $affiliate
        ));

        $quote->addData(array(
            'affiliate_id' => $affiliate->getId(),
            'affiliate'    => $affiliate,
        ));
    }


    /**
     * Deletes the cookie after the order is placed.
     *
     * @param Varien_Event_Observer $observer
     */
    public function removeAffiliateCookie(Varien_Event_Observer $observer)
    {
        /**
         * @var Mage_Sales_Model_Order $order
         * @var Mage_Sales_Model_Quote $quote
         */
        $order = $observer->getEvent()->getData('order');
        $quote = $observer->getEvent()->getData('quote');

        if (!$order || !$quote || !$order->getId() || !$quote->getId()) {
            return;
        }

        $this->getCookie()->delete(MagedIn_Affiliates_Model_Affiliate_Query_Param::COOKIE_CODE);
    }


    /**
     * Process the order commission calculation for the affiliate.
     *
     * @param Varien_Event_Observer $observer
     */
    public function orderInvoiceRegister(Varien_Event_Observer $observer)
    {
        /**
         * @var Mage_Sales_Model_Order_Invoice $invoice
         * @var Mage_Sales_Model_Order         $order
         */
        $invoice = $observer->getEvent()->getData('invoice');
        $order   = $invoice->getOrder();

        /**
         * Validate the order object.
         */
        if (!$order || !$order->getId()) {
            return;
        }

        /** @var MagedIn_Affiliates_Model_Affiliate $affiliate */
        $affiliateId = (int) $order->getData('affiliate_id');
        $affiliate   = $this->getAffiliate($affiliateId);

        /**
         * Validate the affiliate model.
         */
        if (!$affiliate || !$affiliate->getId()) {
            return;
        }

        $affiliate->registerNewOrder($order);
    }

}
