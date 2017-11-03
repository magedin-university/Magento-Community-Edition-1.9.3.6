<?php

trait MagedIn_Affiliates_Model_Resource_Trait_Collection
{

    /**
     * @param MagedIn_Affiliates_Model_Affiliate $affiliate
     *
     * @return $this
     */
    public function applyAffiliateFilter(MagedIn_Affiliates_Model_Affiliate $affiliate)
    {
        if (!$affiliate->getId()) {
            return $this;
        }

        $this->addFieldToFilter('main_table.affiliate_id', $affiliate->getId());

        return $this;
    }

}
