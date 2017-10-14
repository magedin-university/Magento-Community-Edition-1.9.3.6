<?php

class MagedIn_Blocks_Block_Example extends Mage_Core_Block_Template
{

    protected function _construct()
    {
        $this->setData('cache_lifetime', 120);
        $this->setData('cache_key', 'magedin_blocks_example');

        /** It's important! Never forget it. */
        parent::_construct();
    }


    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _beforeToHtml()
    {
        /** It's important! Never forget it. */
        return parent::_beforeToHtml();
    }


    /**
     * @return string
     */
    protected function _afterToHtml($html)
    {
        /** It's important! Never forget it. */
        return parent::_afterToHtml($html);
    }

}
