<?php
/**
 * @method int getAffiliateId()
 * @method int getBalanceId()
 * @method int getAction()
 * @method int getAdminUserId()
 * @method int getComment()
 * @method int getBalanceAmount()
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setBalanceId(int $balanceId)
 * @method $this setAction(int $action)
 * @method $this setAdminUserId(int $adminUserId)
 * @method $this setComment(string $comment)
 * @method $this setBalanceAmount(float $balanceAmount)
 */
class MagedIn_Affiliates_Model_Resource_History extends MagedIn_Affiliates_Model_Resource_Abstract
{

    protected function _construct()
    {
        $this->_init('magedin_affiliates/history', 'id');
    }

}
