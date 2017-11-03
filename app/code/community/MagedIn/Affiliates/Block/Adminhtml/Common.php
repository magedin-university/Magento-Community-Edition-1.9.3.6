<?php

trait MagedIn_Affiliates_Block_Adminhtml_Common
{

    /**
     * @return MagedIn_Affiliates_Model_Affiliate
     */
    public function getCurrentAffiliate()
    {
        return Mage::registry(MagedIn_Affiliates_Controller_Adminhtml_Action::AFFILIATE_MODEL_KEY);
    }


    /**
     * @return bool|int
     */
    public function getCurrentAffiliateId()
    {
        if ($this->getCurrentAffiliate() && $this->getCurrentAffiliate()->getId()) {
            return (int) $this->getCurrentAffiliate()->getId();
        }

        return false;
    }

}
