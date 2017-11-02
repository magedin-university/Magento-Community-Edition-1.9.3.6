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

}
