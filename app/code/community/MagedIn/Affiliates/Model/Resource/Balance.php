<?php
/**
 * @method int    getAffiliateId()
 * @method float  getBaseBalanceAmount()
 * @method float  getBalanceAmount()
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setBaseBalanceAmount(float $baseBalanceAmount)
 * @method $this setBalanceAmount(float $balanceAmount)
 * @method $this setCreatedAt(string $dateTime)
 * @method $this setUpdatedAt(string $dateTime)
 */
class MagedIn_Affiliates_Model_Resource_Balance extends MagedIn_Affiliates_Model_Resource_Abstract
{

    protected function _construct()
    {
        $this->_init('magedin_affiliates/balance', 'id');
        parent::_construct();
    }

}
