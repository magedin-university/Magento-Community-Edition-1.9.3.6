<?php

class MagedIn_CustomHelpers_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        /** @var MagedIn_CustomHelpers_Helper_Data $helperData */
        $helperData = Mage::helper('magedin_customhelpers');

        /** @var MagedIn_CustomHelpers_Helper_Custom $helperCustom */
        $helperCustom = Mage::helper('magedin_customhelpers/custom');
    }


    public function generalAction()
    {
        $randomString = $this->helper()->getRandomString(50);

        $name = 'João Maranhão Gonçalves';
        $name = $this->helper()->removeAccents($name);
    }


    /**
     * @return MagedIn_CustomHelpers_Helper_Data
     */
    protected function helper()
    {
        $helper = Mage::helper('magedin_customhelpers');
        return $helper;
    }

}
