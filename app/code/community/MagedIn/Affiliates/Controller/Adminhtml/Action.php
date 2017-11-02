<?php

abstract class MagedIn_Affiliates_Controller_Adminhtml_Action extends Mage_Adminhtml_Controller_Action
{

    const KEY_AFFILIATE_NEW = 'affiliate_new';


    /**
     * @param null|bool $flag
     *
     * @return $this|bool
     */
    protected function _isAffiliateNew($flag = null)
    {
        if (is_null($flag) || !is_bool($flag)) {
            return (bool) Mage::registry(self::KEY_AFFILIATE_NEW);
        }

        Mage::register(self::KEY_AFFILIATE_NEW, (bool) $flag, true);

        return $this;
    }


    /**
     * @param null|string|array $ids
     * @param bool              $generateBlocks
     * @param bool              $generateXml
     *
     * @return $this
     */
    protected function _initLayout($ids = null, $generateBlocks = true, $generateXml = true)
    {
        $this->loadLayout($ids, $generateBlocks, $generateXml);
        $this->_title($this->__('MagedIn'))
             ->_title('Affiliates');

        return $this;
    }

}
