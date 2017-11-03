<?php
/**
 * Class MagedIn_Affiliates_Model_Affiliate
 *
 * @method string getName()
 * @method string getDescription()
 * @method string getComment()
 * @method int    getSalesCommissionType()
 * @method int    getSalesCommissionPercent()
 * @method int    getSalesCommissionFixed()
 *
 * @method $this setName(string $name)
 * @method $this setDescription(string $description)
 * @method $this setSalesCommissionType(int $type)
 * @method $this setSalesCommissionPercent(float $value)
 * @method $this setSalesCommissionFixed(float $value)
 */
class MagedIn_Affiliates_Model_Affiliate extends MagedIn_Affiliates_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('magedin_affiliates/affiliate');
        parent::_construct();
    }


    /**
     * @param null|int $typeId
     *
     * @return string
     */
    public function getSalesCommissionTypeLabel($typeId = null)
    {
        if (is_null($typeId)) {
            $typeId = (int) $this->getSalesCommissionType();
        }

        switch ($typeId) {
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Type::PERCENT:
                return $this->__('Percent Commission');
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Type::FIXED:
                return $this->__('Fixed Commission');
            default:
                return $this->__('Not Defined');
        }
    }


    /**
     * @return MagedIn_Affiliates_Model_Balance
     */
    public function getBalance()
    {
        if (!$this->hasData('balance_model')) {
            /** @var MagedIn_Affiliates_Model_Balance $balance */
            $balance = Mage::getModel('magedin_affiliates/balance')->loadByAffiliateId($this->getId());

            if ($balance->isObjectNew() && $this->getId()) {
                $balance->setAffiliate($this)->save();
            }

            $this->setData('balance_model', $balance);
        }

        return $this->getData('balance_model');
    }


    /**
     * @param Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    public function registerNewOrder(Mage_Sales_Model_Order $order)
    {
        /** @var MagedIn_Affiliates_Model_Order $affiliateOrder */
        $affiliateOrder = Mage::getModel('magedin_affiliates/order');
        $affiliateOrder->createNew($order, $this);
        $affiliateOrder->save();

        $this->getBalance()
            ->importAffiliateOrder($affiliateOrder)
            ->save();

        $this->registerHistoryEvent(
            MagedIn_Affiliates_Model_System_Config_Source_Balance_History_Action_Type::ORDER_INVOICED,
            $affiliateOrder->getCommissionAmount(),
            $this->__('Process New Order')
        );

        return $this;
    }


    /**
     * @param Mage_Sales_Model_Order $order
     * @param string                 $status
     *
     * @return $this
     */
    public function processOrderCancellation(Mage_Sales_Model_Order $order, $status = null)
    {
        if ($this->getId() != $order->getData('affiliate_id')) {
            return $this;
        }

        /** @var MagedIn_Affiliates_Model_Order $affiliateOrder */
        $affiliateOrder = Mage::getModel('magedin_affiliates/order');
        $affiliateOrder->loadByReference($order, $this);

        if (!$affiliateOrder->getId()) {
            return $this;
        }

        $this->getBalance()
            ->decreaseAmount($affiliateOrder->getCommissionAmount())
            ->save();

        if (empty($status)) {
            $status = MagedIn_Affiliates_Model_Order::STATUS_CANCELLED;
        }

        $affiliateOrder->setStatus($status)
            ->save();

        $this->registerHistoryEvent(
            MagedIn_Affiliates_Model_System_Config_Source_Balance_History_Action_Type::ORDER_CANCELLED,
            $affiliateOrder->getCommissionAmount(),
            $this->__('Process Order Cancellation Status: %s', $status)
        );

        return $this;
    }


    /**
     * @param int      $action
     * @param float    $balanceAmount
     * @param null|int $adminUserId
     * @param null|int $comment
     *
     * @return MagedIn_Affiliates_Model_History
     */
    public function registerHistoryEvent($action, $balanceAmount, $comment = null, $adminUserId = null)
    {
        /** @var MagedIn_Affiliates_Model_History $history */
        $history = Mage::getModel('magedin_affiliates/history');

        if (empty($adminUserId) && Mage::app()->getStore()->isAdmin()) {
            /** @var Mage_Admin_Model_User $user */
            $user = Mage::getSingleton('admin/session')->getUser();

            if ($user && $user->getId()) {
                $adminUserId = $user->getId();
            }
        }

        $history->setAffiliate($this)
            ->setAction($action)
            ->setBalanceAmount((float) $balanceAmount)
            ->setAdminUserId((int) $adminUserId)
            ->setComment($comment)
            ->save();

        return $history;
    }

}
