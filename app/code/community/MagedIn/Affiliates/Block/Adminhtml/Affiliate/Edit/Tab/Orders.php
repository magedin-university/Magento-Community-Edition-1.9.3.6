<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tab_Orders
    extends Mage_Adminhtml_Block_Widget_Grid
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    use MagedIn_Affiliates_Block_Adminhtml_Common;


    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->setId('affiliateOrdersGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setSaveParametersInSession(true);
    }


    /**
     * @param Varien_Object $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return false;
    }


    /**
     * Generate the URL to grid used in ajax request.
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/orders', array('_current' => true));
    }


    /**
     * Prepare the grid of affiliates.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        /** @var MagedIn_Affiliates_Model_Resource_Order_Collection $collection */
        $collection = Mage::getResourceModel('magedin_affiliates/order_collection');
        $collection->joinSalesOrder();

        $collection->applyAffiliateFilter($this->getCurrentAffiliate());

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }


    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('order_id', [
            'header'     => $this->__('Order ID'),
            'index'      => 'increment_id',
            'width'      => '75px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('status', array(
            'header' => $this->__('Status'),
            'index' => 'status',
            'filter_index' => 'status',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));

        $this->addColumn('customer_email', [
            'header'     => $this->__('Customer E-mail'),
            'index'      => 'customer_email',
            'type'       => 'text',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('subtotal', [
            'header'       => $this->__('Order Subtotal'),
            'index'        => 'subtotal',
            'filter_index' => 'main_table.subtotal',
            'type'         => 'currency',
            'width'        => '100px',
            'filterable'   => true,
            'sortable'     => true,
        ]);

        $this->addColumn('discount_amount', [
            'header'       => $this->__('Order Discount Amount'),
            'index'        => 'discount_amount',
            'filter_index' => 'main_table.discount_amount',
            'type'         => 'currency',
            'width'        => '100px',
            'filterable'   => true,
            'sortable'     => true,
        ]);

        $this->addColumn('grand_total', [
            'header'       => $this->__('Order Grand Total'),
            'index'        => 'grand_total',
            'filter_index' => 'main_table.grand_total',
            'type'         => 'currency',
            'width'        => '100px',
            'filterable'   => true,
            'sortable'     => true,
        ]);

        /** @var MagedIn_Affiliates_Model_System_Config_Source_Commission_Type $types */
        $types = Mage::getModel('magedin_affiliates/system_config_source_commission_type');
        $this->addColumn('order_commission_type', [
            'header'     => $this->__('Commission Type'),
            'index'      => 'order_commission_type',
            'type'       => 'options',
            'options'    => $types->toArray(),
            'width'      => '50px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('order_commission_delta', [
            'header'     => $this->__('Commission Delta'),
            'index'      => 'order_commission_delta',
            'type'       => 'currency',
            'width'      => '50px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('commission_amount', [
            'header'     => $this->__('Commission Amount'),
            'index'      => 'commission_amount',
            'type'       => 'currency',
            'width'      => '50px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        parent::_prepareColumns();

        return $this;
    }


    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Orders');
    }


    /**
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }


    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }


    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

}
