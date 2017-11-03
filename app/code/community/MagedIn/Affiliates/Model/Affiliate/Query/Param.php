<?php

class MagedIn_Affiliates_Model_Affiliate_Query_Param
{

    /** string */
    const PARAM_CODE  = 'affiliate_id';

    /** string */
    const COOKIE_CODE = 'affiliate_hash';


    /**
     * @param int $affiliateId
     *
     * @return string
     */
    public function getAffiliateUrl($affiliateId)
    {
        $affiliateUrl = Mage::getUrl('', array(
            '_query' => array(
                self::PARAM_CODE => $this->getAffiliateHash($affiliateId)
            )
        ));

        return $affiliateUrl;
    }


    /**
     * @param int $affiliateId
     *
     * @return string
     */
    public function getAffiliateHash($affiliateId)
    {
        $hash = $this->_encode((int) $affiliateId);
        return (string) $hash;
    }


    /**
     * @param string $hash
     *
     * @return int
     */
    public function getAffiliateId($hash)
    {
        $affiliateId = $this->_decode((string) $hash);
        return (int) $affiliateId;
    }


    /**
     * @param int $affiliateId
     *
     * @return string
     */
    protected function _encode($affiliateId)
    {
        $encoded = $this->_helper()->encrypt((int) $affiliateId);
        $encoded = $this->_helper()->urlEncode($encoded);

        return (string) $encoded;
    }


    /**
     * @param string $hash
     *
     * @return int
     */
    protected function _decode($hash)
    {
        $hash        = $this->_helper()->urlDecode($hash);
        $affiliateId = $this->_helper()->decrypt($hash);

        return (int) $affiliateId;
    }


    /**
     * @return MagedIn_Affiliates_Helper_Data
     */
    protected function _helper()
    {
        return Mage::helper('magedin_affiliates');
    }

}
