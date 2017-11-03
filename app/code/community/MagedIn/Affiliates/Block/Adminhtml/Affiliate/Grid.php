<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->setId('affiliateGrid');
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
        return $this->getUrl('*/*/edit', array('id' => $row->getId(), '_current' => true));
    }


    /**
     * Generate the URL to grid used in ajax request.
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }


    /**
     * Prepare the grid of affiliates.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        /** @var MagedIn_Affiliates_Model_Resource_Affiliate_Collection $collection */
        $collection = Mage::getResourceModel('magedin_affiliates/affiliate_collection');
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }


    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'     => $this->__('ID'),
            'index'      => 'id',
            'width'      => '50px',
            'type'       => 'text',
            'align'      => 'center',
            'filterable' => true,
            'sortable'   => true,
        ));

        $this->addColumn('name', array(
            'header'     => $this->__('Name'),
            'index'      => 'name',
            'type'       => 'text',
            'filterable' => true,
            'sortable'   => true,
        ));

        /** @var MagedIn_Affiliates_Model_System_Config_Source_Commission_Type $types */
        $types = Mage::getModel('magedin_affiliates/system_config_source_commission_type');
        $this->addColumn('sales_commission_type', array(
            'header'     => $this->__('Commission Type'),
            'index'      => 'sales_commission_type',
            'type'       => 'options',
            'options'    => $types->toArray(),
            'width'      => '100px',
            'filterable' => true,
            'sortable'   => true,
        ));

        $this->addColumn('sales_commission_percent', array(
            'header'     => $this->__('Commission Percent'),
            'index'      => 'sales_commission_percent',
            'type'       => 'number',
            'width'      => '100px',
            'filterable' => true,
            'sortable'   => true,
        ));

        $this->addColumn('sales_commission_fixed', array(
            'header'     => $this->__('Commission Fixed'),
            'index'      => 'sales_commission_fixed',
            'type'       => 'currency',
            'width'      => '100px',
            'filterable' => true,
            'sortable'   => true,
        ));

        $this->addColumn('created_at', array(
            'header'     => $this->__('Created At'),
            'index'      => 'created_at',
            'type'       => 'datetime',
            'width'      => '100px',
            'filterable' => true,
            'sortable'   => true,
        ));

        $this->addColumn('updated_at', array(
            'header'     => $this->__('Updated At'),
            'index'      => 'updated_at',
            'type'       => 'datetime',
            'width'      => '100px',
            'filterable' => true,
            'sortable'   => true,
        ));

        parent::_prepareColumns();

        return $this;
    }

}
