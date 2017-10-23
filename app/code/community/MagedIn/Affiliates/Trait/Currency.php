<?php

trait MagedIn_Affiliates_Trait_Currency
{
    
    /**
     * @param float $price
     * @param array $options
     * @param bool  $includeContainer
     *
     * @return mixed
     */
    protected function currency($price, $options = [], $includeContainer = true)
    {
        return Mage::app()->getStore()->getCurrentCurrency()->format($price, $options, $includeContainer);
    }
    
    
    /**
     * @param float $price
     * @param array  $options
     * @param bool  $includeContainer
     *
     * @return string
     */
    protected function baseCurrency($price, $options = [], $includeContainer = true)
    {
        return Mage::app()->getStore()->getBaseCurrency()->format($price, $options, $includeContainer);
    }
    
}
