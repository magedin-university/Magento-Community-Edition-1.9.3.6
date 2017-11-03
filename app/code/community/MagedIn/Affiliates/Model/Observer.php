<?php

class MagedIn_Affiliates_Model_Observer
{

    use MagedIn_Affiliates_Trait_Data;


    /**
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

}
