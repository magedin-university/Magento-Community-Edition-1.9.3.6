<?php
/**
 * @method int   getAffiliateId()
 * @method int   getOrderId()
 * @method float getBaseSubtotal()
 * @method float getBaseDiscountAmount()
 * @method float getBaseGrandTotal()
 * @method float getBaseCommissionAmount()
 * @method float getSubtotal()
 * @method float getDiscountAmount()
 * @method float getGrandTotal()
 * @method float getOrderCommissionType()
 * @method float getOrderCommissionDelta()
 * @method float getCommissionAmount()
 * @method float getIsLoaded()
 *
 * @method $this setAffiliateId(int $affiliateId)
 * @method $this setOrderId(int $orderId)
 * @method $this setBaseSubtotal(float $amount)
 * @method $this setBaseDiscountAmount(float $amount)
 * @method $this setBaseGrandTotal(float $amount)
 * @method $this setBaseCommissionAmount(float $amount)
 * @method $this setSubtotal(float $amount)
 * @method $this setDiscountAmount(float $amount)
 * @method $this setGrandTotal(float $amount)
 * @method $this setOrderCommissionType(int $type)
 * @method $this setOrderCommissionDelta(float $deltaAmount)
 * @method $this setCommissionAmount(float $amount)
 * @method $this setIsLoaded(bool $flag)
 */
class MagedIn_Affiliates_Model_Resource_Order extends MagedIn_Affiliates_Model_Resource_Abstract
{

    protected function _construct()
    {
        $this->_init('magedin_affiliates/order', 'id');
        parent::_construct();
    }

}
