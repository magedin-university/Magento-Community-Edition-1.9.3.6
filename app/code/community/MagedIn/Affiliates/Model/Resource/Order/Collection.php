<?php

class MagedIn_Affiliates_Model_Resource_Order_Collection
    extends MagedIn_Affiliates_Model_Resource_Collection_Abstract
{

    use MagedIn_Affiliates_Model_Resource_Trait_Collection;


    protected function _construct()
    {
        $this->_init('magedin_affiliates/order');
    }


    /**
     * @return $this
     */
    public function joinSalesOrder()
    {
        $this->join('sales/order', 'main_table.order_id = entity_id');
        return $this;
    }

}
