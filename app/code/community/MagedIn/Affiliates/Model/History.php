<?php

/**
 * Class MagedIn_Affiliates_Model_History
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setBalanceId(int $balanceId)
 * @method $this setAction(int $value)
 * @method $this setAdminUserId(int $value)
 * @method $this setComment(string $comment)
 * @method $this setBalanceAmount(float $amount)
 * @method $this setCreatedAt(string $dateTime)
 * @method $this setUpdatedAt(string $dateTime)
 *
 * @method int    getAffiliateId()
 * @method int    getBalanceId()
 * @method int    getAction()
 * @method int    getAdminUserId()
 * @method int    getComment()
 * @method float  getBalanceAmount()
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 */
class MagedIn_Affiliates_Model_History extends MagedIn_Affiliates_Model_Abstract
{

    /** @var MagedIn_Affiliates_Model_Affiliate */
    protected $_affiliate = null;


    protected function _construct()
    {
        $this->_init('magedin_affiliates/history');
        parent::_construct();
    }


    /**
     * @param MagedIn_Affiliates_Model_Affiliate $affiliate
     *
     * @return $this
     */
    public function setAffiliate(MagedIn_Affiliates_Model_Affiliate $affiliate)
    {
        $this->_affiliate = $affiliate;

        $this->setAffiliateId($affiliate->getId());
        $this->setBalanceId($affiliate->getBalance()->getId());

        return $this;
    }

}
