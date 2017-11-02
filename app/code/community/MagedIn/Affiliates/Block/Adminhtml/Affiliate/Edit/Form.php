<?php

class MagedIn_Affiliates_Block_Adminhtml_Affiliate_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    const FORM_ID = 'edit_form';


    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        /** @var Varien_Data_Form $form */
        $form = new Varien_Data_Form(array(
            'id'      => self::FORM_ID,
            'action'  => $this->getData('action'),
            'method'  => 'POST',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
