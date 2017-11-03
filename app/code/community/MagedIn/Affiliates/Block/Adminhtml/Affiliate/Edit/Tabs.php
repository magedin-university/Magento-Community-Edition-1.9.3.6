<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();

        $this->setId('affiliate_tabs');
        $this->setDestElementId(MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Form::FORM_ID);
        $this->setTitle($this->__('Affiliate Information'));
    }


    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        /** @var MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tab_Main $main */
        $main = $this->getLayout()->createBlock('magedin_affiliates/adminhtml_affiliate_edit_tab_main');
        $this->addTab('main_section', [
            'label'   => $this->__('Affiliate Information'),
            'content' => $main->toHtml(),
        ]);

        $this->addTab('balance_amount', [
            'label' => $this->__('Balance Amount'),
            'class' => 'ajax',
            'url'   => $this->getUrl('*/affiliate/balance', ['_current' => true])
        ]);

        $this->addTab('orders', [
            'label' => $this->__('Orders'),
            'class' => 'ajax',
            'url'   => $this->getUrl('*/affiliate/orders', ['_current' => true])
        ]);

        $this->addTab('history', [
            'label' => $this->__('History'),
            'class' => 'ajax',
            'url'   => $this->getUrl('*/affiliate/history', ['_current' => true])
        ]);

        parent::_prepareLayout();

        return $this;
    }

}
