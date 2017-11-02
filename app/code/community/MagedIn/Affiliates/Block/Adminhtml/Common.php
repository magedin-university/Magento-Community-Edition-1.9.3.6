<?php

trait MagedIn_Affiliates_Block_Adminhtml_Common
{

    /**
     * @return MagedIn_Affiliates_Model_Affiliate
     */
    public function getAffiliate()
    {
        return Mage::registry(MagedIn_Affiliates_Controller_Adminhtml_Action::AFFILIATE_MODEL_KEY);
    }


    /**
     * @return bool|int
     */
    public function getAffiliateId()
    {
        if ($this->getAffiliate() && $this->getAffiliate()->getId()) {
            return (int) $this->getAffiliate()->getId();
        }

        return false;
    }

}
