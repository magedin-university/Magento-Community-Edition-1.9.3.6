<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tab_History
    extends Mage_Adminhtml_Block_Widget_Grid
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    use MagedIn_Affiliates_Block_Adminhtml_Common;


    public function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $this->setId('affiliateHistoryGrid');
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
        return $this->getUrl('*/*/history', array('_current' => true));
    }


    /**
     * Prepare the grid of affiliates.
     *
     * @return $this
     */
    protected function _prepareCollection()
    {
        /** @var MagedIn_Affiliates_Model_Resource_History_Collection $collection */
        $collection = Mage::getResourceModel('magedin_affiliates/history_collection');

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
        /** @var MagedIn_Affiliates_Model_System_Config_Source_Balance_History_Action_Type $types */
        $types = Mage::getModel('magedin_affiliates/system_config_source_balance_history_action_type');
        $this->addColumn('action', [
            'header'     => $this->__('Action'),
            'index'      => 'action',
            'type'       => 'options',
            'options'    => $types->toArray(),
            'width'      => '120px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        /** @var MagedIn_Affiliates_Model_System_Config_Source_Admin_Users $source */
        $source = Mage::getModel('magedin_affiliates/system_config_source_admin_users');
        $this->addColumn('admin_user_id', [
            'header'     => $this->__('Admin User ID'),
            'index'      => 'admin_user_id',
            'type'       => 'options',
            'options'    => $source->toArray(),
            'width'      => '50px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('balance_amount', [
            'header'     => $this->__('Balance Amount'),
            'index'      => 'balance_amount',
            'type'       => 'currency',
            'currency'   => Mage::app()->getStore()->getCurrentCurrency()->getCode(),
            'width'      => '50px',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('comment', [
            'header'     => $this->__('Comment'),
            'index'      => 'comment',
            'type'       => 'text',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn('created_at', [
            'header'     => $this->__('Created At'),
            'index'      => 'created_at',
            'type'       => 'datetime',
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
        return $this->__('History');
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
