<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    use MagedIn_Affiliates_Block_Adminhtml_Common,
        MagedIn_Affiliates_Trait_Data;


    /**
     * @return $this
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('affiliate_');

        /** @var Varien_Data_Form_Element_Fieldset $fieldset */
        $fieldset = $form->addFieldset('general_fieldset', [
            'legend' => $this->__('General Information')
        ]);

        if ($this->getCurrentAffiliateId()) {
            $fieldset->addField('id', 'hidden', [
                'name'  => 'affiliate[id]',
                'value' => $this->getCurrentAffiliateId(),
            ]);
        }

        $fieldset->addField('name', 'text', [
            'label'    => $this->__('Name'),
            'name'     => 'affiliate[name]',
            'required' => true,
            'value'    => $this->getCurrentAffiliate()->getName(),
        ]);

        $fieldset->addField('description', 'textarea', [
            'label'    => $this->__('Description'),
            'name'     => 'affiliate[description]',
            'required' => false,
            'value'    => $this->getCurrentAffiliate()->getDescription(),
        ]);

        $fieldset->addField('comment', 'textarea', [
            'label'    => $this->__('Comment'),
            'name'     => 'affiliate[comment]',
            'required' => false,
            'value'    => $this->getCurrentAffiliate()->getComment(),
        ]);

        /** @var MagedIn_Affiliates_Model_System_Config_Source_Commission_Type $types */
        $types = Mage::getModel('magedin_affiliates/system_config_source_commission_type');
        $fieldset->addField('sales_commission_type', 'select', [
            'label'    => $this->__('Commission Type'),
            'name'     => 'affiliate[sales_commission_type]',
            'required' => true,
            'value'    => $this->getCurrentAffiliate()->getSalesCommissionType(),
            'options'  => $types->toArray(),
        ]);

        $fieldset->addField('sales_commission_percent', 'text', [
            'label'    => $this->__('Commission Percent'),
            'name'     => 'affiliate[sales_commission_percent]',
            'required' => false,
            'value'    => $this->getCurrentAffiliate()->getSalesCommissionPercent(),
        ]);

        $fieldset->addField('sales_commission_fixed', 'text', [
            'label'    => $this->__('Commission Fixed'),
            'name'     => 'affiliate[sales_commission_fixed]',
            'required' => false,
            'value'    => $this->getCurrentAffiliate()->getSalesCommissionFixed(),
        ]);

        if ($this->getCurrentAffiliateId()) {
            /** @var Varien_Data_Form_Element_Fieldset $sharingFieldset */
            $sharingFieldset = $form->addFieldset('sharing_fieldset', [
                'legend' => $this->__('Sharing Information'),
                'class'  => 'fieldset-wide'
            ]);

            $sharingFieldset->addField('share_link', 'link', [
                'label' => $this->__('Shareable Link'),
                'note'  => $this->__(
                    'This is the URL you will need to share with your affiliates. ' .
                    "Note that the most important part in this link is the parameter '%s' and not the URL itself.",
                    MagedIn_Affiliates_Model_Affiliate_Query_Param::PARAM_CODE
                ),
                'value' => $this->_getAffiliateQueryParam()->getAffiliateUrl($this->getCurrentAffiliateId()),
            ]);
        }

        $this->setForm($form);

        parent::_prepareForm();

        return $this;
    }


    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Affiliate Information');
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
