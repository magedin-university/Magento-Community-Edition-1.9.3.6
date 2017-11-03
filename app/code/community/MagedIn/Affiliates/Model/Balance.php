<?php

/**
 * Class MagedIn_Affiliates_Model_Balance
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setBalanceAmount(float $amount)
 * @method $this setBaseBalanceAmount(float $amount)
 *
 * @method int   getAffiliateId()
 * @method float getBalanceAmount()
 * @method float getBaseBalanceAmount()
 */
class MagedIn_Affiliates_Model_Balance extends MagedIn_Affiliates_Model_Abstract
{

    use MagedIn_Affiliates_Trait_Convertor;


    protected function _construct()
    {
        $this->_init('magedin_affiliates/balance');
        parent::_construct();
    }


    /**
     * @param MagedIn_Affiliates_Model_Affiliate $affiliate
     *
     * @return $this
     */
    public function setAffiliate(MagedIn_Affiliates_Model_Affiliate $affiliate)
    {
        $this->setAffiliateId($affiliate->getId());
        $this->setData('affiliate', $affiliate);

        return $this;
    }


    /**
     * @param int $affiliateId
     *
     * @return $this
     */
    public function loadByAffiliateId($affiliateId)
    {
        $this->load($affiliateId, 'affiliate_id');
        return $this;
    }


    /**
     * @param float $amount
     *
     * @return $this
     */
    public function increaseAmount($amount = 0.0000)
    {
        $amount        = max(0, $amount);
        $balanceAmount = (float) $this->getBalanceAmount() + $amount;

        $this->setBalanceAmount($balanceAmount);
        $this->setBaseBalanceAmount((float) $this->_convertToBasePrice($balanceAmount));

        return $this;
    }


    /**
     * @param float $amount
     *
     * @return $this
     */
    public function decreaseAmount($amount = 0.0000)
    {
        $amount        = abs($amount);
        $balanceAmount = (float) max($this->getBalanceAmount() - $amount, 0);

        $this->setBalanceAmount($balanceAmount);
        $this->setBaseBalanceAmount($this->_convertToBasePrice($balanceAmount));

        return $this;
    }


    /**
     * @param MagedIn_Affiliates_Model_Order $order
     *
     * @return $this
     */
    public function importAffiliateOrder(MagedIn_Affiliates_Model_Order $order)
    {
        if (!$order->getId()) {
            return $this;
        }

        /**
         * If the affiliate order has the is_loaded flat it means that it probably was imported already when it was
         * created. So we can't import it again.
         */
        if (true === $order->getIsLoaded()) {
            return $this;
        }

        $this->increaseAmount((float) $order->getCommissionAmount());

        return $this;
    }

}
