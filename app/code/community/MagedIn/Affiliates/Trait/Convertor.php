<?php

trait MagedIn_Affiliates_Trait_Convertor
{
    
    /**
     * @param float $price
     *
     * @return float
     */
    protected function _convertToCurrentPrice($price)
    {
        return $this->_getBaseCurrency()->convert($price, $this->_getCurrentCurrency());
    }
    
    
    /**
     * @param float $price
     *
     * @return float
     */
    protected function _convertToBasePrice($price)
    {
        return $this->_getCurrentCurrency()->convert($price, $this->_getBaseCurrency());
    }
    
    
    /**
     * @return Mage_Directory_Model_Currency
     */
    protected function _getCurrentCurrency()
    {
        return Mage::app()->getStore()->getCurrentCurrency();
    }
    
    
    /**
     * @return Mage_Directory_Model_Currency
     */
    protected function _getBaseCurrency()
    {
        return Mage::app()->getStore()->getBaseCurrency();
    }
    
}
