<?php
/**
 * @method string getName()
 * @method string getDescription()
 * @method string getComment()
 * @method string getMoipMpa()
 * @method int    getSalesCommissionType()
 * @method float  getSalesCommissionPercent()
 * @method float  getSalesCommissionFixed()
 *
 * @method $this setName(string $name)
 * @method $this setDescription(string $description)
 * @method $this setComment(string $comment)
 * @method $this setMoipMpa(string $code)
 * @method $this setSalesCommissionType(int $type)
 * @method $this setSalesCommissionPercent(float $percent)
 * @method $this setSalesCommissionFixed(float $value)
 */
class MagedIn_Affiliates_Model_Resource_Affiliate extends MagedIn_Affiliates_Model_Resource_Abstract
{

    protected function _construct()
    {
        $this->_init('magedin_affiliates/entity', 'id');
        parent::_construct();
    }

}
