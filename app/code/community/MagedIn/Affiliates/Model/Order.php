<?php

/**
 * Class MagedIn_Affiliates_Model_Order
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setOrderId(int $orderId)
 * @method $this setBaseSubtotal(float $value)
 * @method $this setSubtotal(float $value)
 * @method $this setBaseDiscountAmount(float $value)
 * @method $this setDiscountAmount(float $value)
 * @method $this setBaseGrandTotal(float $value)
 * @method $this setGrandTotal(float $value)
 * @method $this setOrderCommissionType(int $typeId)
 * @method $this setOrderCommissionDelta(float $value)
 * @method $this setBaseCommissionAmount(float $value)
 * @method $this setCommissionAmount(float $value)
 * @method $this setCreatedAt(string $dateTime)
 * @method $this setUpdatedAt(string $dateTime)
 * @method $this setIsLoaded(bool $flag)
 * @method $this setCommissionStatus(string $status)
 *
 * @method int    getAffiliateId()
 * @method int    getOrderId()
 * @method float  getBaseSubtotal()
 * @method float  getSubtotal()
 * @method float  getBaseDiscountAmount()
 * @method float  getDiscountAmount()
 * @method float  getBaseGrandTotal()
 * @method float  getGrandTotal()
 * @method int    getOrderCommissionType()
 * @method float  getOrderCommissionDelta()
 * @method float  getBaseCommissionAmount()
 * @method float  getCommissionAmount()
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 * @method bool   getIsLoaded()
 * @method string getCommissionStatus()
 */
class MagedIn_Affiliates_Model_Order extends MagedIn_Affiliates_Model_Abstract
{

    use MagedIn_Affiliates_Trait_Config,
        MagedIn_Affiliates_Trait_Convertor;


    const STATUS_CREATED   = 'created';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED  = 'refunded';


    /** @var MagedIn_Affiliates_Model_Affiliate */
    protected $_affiliate;

    /** @var  Mage_Sales_Model_Order */
    protected $_order;


    protected function _construct()
    {
        $this->_init('magedin_affiliates/order');
        parent::_construct();
    }


    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->setCommissionStatus($status);
        return $this;
    }


    /**
     * @param Mage_Sales_Model_Order             $order
     * @param MagedIn_Affiliates_Model_Affiliate $affiliate
     *
     * @return $this
     */
    public function createNew(Mage_Sales_Model_Order $order, MagedIn_Affiliates_Model_Affiliate $affiliate)
    {
        if ($id = $this->getResource()->getAffiliateOrderId($order, $affiliate)) {
            $this->load($id);
            $this->setIsLoaded(true);
        }

        $this->setAffiliate($affiliate);
        $this->setOrder($order);
        $this->setStatus(self::STATUS_CREATED);

        $affiliate->setOrder($order);

        return $this;
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

        return $this;
    }


    /**
     * @return MagedIn_Affiliates_Model_Affiliate
     */
    public function getOrderAffiliate()
    {
        if (!$this->_affiliate) {
            $this->_affiliate = $this->getAffiliate($this->getAffiliateId());
        }

        return $this->_affiliate;
    }


    /**
     * @param Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    public function setOrder(Mage_Sales_Model_Order $order)
    {
        $this->_order = $order;
        $this->setOrderId($order->getId());

        $this->setBaseSubtotal($order->getBaseSubtotal());
        $this->setSubtotal($order->getSubtotal());

        $this->setBaseDiscountAmount($order->getBaseDiscountAmount());
        $this->setDiscountAmount($order->getDiscountAmount());

        $this->setBaseGrandTotal($order->getBaseGrandTotal());
        $this->setGrandTotal($order->getGrandTotal());

        $this->calculateCommissionAmount();

        return $this;
    }


    /**
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if (!$this->_order) {
            $this->_order = Mage::getModel('sales/order')->load($this->getOrderId());
        }

        return $this->_order;
    }


    /**
     * @return $this
     */
    protected function calculateCommissionAmount()
    {
        if (!$this->getOrderAffiliate() || !$this->getOrderAffiliate()->getId()) {
            Mage::throwException($this->__('Affiliate model does not contain a valid affiliate ID.'));
        }

        if (!$this->getOrder() || !$this->getOrder()->getId()) {
            Mage::throwException($this->__('The order does not exist.'));
        }

        $this->setCommissionAmount(0);
        $this->setBaseCommissionAmount(0);

        /**
         * Commission Amounts.
         */
        $commissionAmount     = 0;
        $commissionBaseAmount = 0;

        /**
         * Used as a base to the calculation.
         */
        $calcAmount           = 0;
        $calcBaseAmount       = 0;

        /**
         * Order commission delta.
         * Kept the history for future debugging purpose.
         */
        $orderCommissionDelta = 0;

        /**
         * Calculate the value base to proceed to the next calculation.
         */
        switch ($this->getCommissionCalculationBase()) {
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Calculation_Base::SUBTOTAL:
                $calcAmount     = $this->getOrder()->getSubtotal();
                $calcBaseAmount = $this->getOrder()->getBaseSubtotal();
                break;
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Calculation_Base::SUBTOTAL_WITH_DISCOUNTS:
                $calcAmount     = $this->getOrder()->getSubtotal() - $this->getOrder()->getDiscountAmount();
                $calcBaseAmount = $this->getOrder()->getBaseSubtotal() - $this->getOrder()->getBaseDiscountAmount();
                break;
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Calculation_Base::GRAND_TOTAL:
                $calcAmount     = $this->getOrder()->getGrandTotal();
                $calcBaseAmount = $this->getOrder()->getBaseGrandTotal();
                break;
        }

        /**
         * Get the commission type for further calculation.
         */
        $commissionType = (int) $this->getOrderAffiliate()->getSalesCommissionType();

        switch ($commissionType) {
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Type::PERCENT:
                $percentage           = (float) $this->getOrderAffiliate()->getSalesCommissionPercent();
                $percentage           = $percentage/100;

                $commissionAmount     = ($calcAmount * $percentage);
                $commissionBaseAmount = ($calcBaseAmount * $percentage);

                $orderCommissionDelta = $percentage;

                break;
            case MagedIn_Affiliates_Model_System_Config_Source_Commission_Type::FIXED:
                $fixed                = (float) $this->getOrderAffiliate()->getSalesCommissionFixed();
                $fixed                = min($fixed, $calcAmount);

                $commissionAmount     = ($calcAmount - $fixed);
                $commissionBaseAmount = ($calcBaseAmount - $this->_convertToBasePrice($fixed));

                $orderCommissionDelta = $fixed;

                break;
        }

        $this->setOrderCommissionType($commissionType);
        $this->setOrderCommissionDelta($orderCommissionDelta);
        $this->setCommissionAmount($commissionAmount);
        $this->setBaseCommissionAmount($commissionBaseAmount);

        return $this;
    }


    /**
     * @param Mage_Sales_Model_Order             $order
     * @param MagedIn_Affiliates_Model_Affiliate $affiliate
     *
     * @return $this
     */
    public function loadByReference(Mage_Sales_Model_Order $order, MagedIn_Affiliates_Model_Affiliate $affiliate)
    {
        $id = $this->getResource()->getAffiliateOrderId($order, $affiliate);

        if ($id) {
            $this->load($id);

            $this->setOrder($order);
            $this->setAffiliate($affiliate);
        }

        return $this;
    }

}
