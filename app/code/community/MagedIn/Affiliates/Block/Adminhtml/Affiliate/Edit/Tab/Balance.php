<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tab_Balance
    extends Mage_Adminhtml_Block_Widget_Form
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    use MagedIn_Affiliates_Block_Adminhtml_Common;


    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('affiliate_');

        /** @var Varien_Data_Form_Element_Fieldset $fieldset */
        $fieldset = $form->addFieldset('balance_fieldset', [
            'legend' => $this->__('Balance Information')
        ]);

        $amount = $this->getCurrentAffiliate()->getBalance()->getBalanceAmount();
        $fieldset->addField('balance_amount', 'text', [
            'label'    => $this->__('Balance Amount'),
            'name'     => 'balance[balance_amount]',
            'class'    => 'validate-number',
            'required' => false,
            'value'    => $amount ? $amount : 0.0000,
        ]);

        $this->setForm($form);

        parent::_prepareForm();

        return $this;
    }


    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Balance Information');
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
