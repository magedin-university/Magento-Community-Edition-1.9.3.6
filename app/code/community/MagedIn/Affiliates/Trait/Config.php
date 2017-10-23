<?php

trait MagedIn_Affiliates_Trait_Config
{

    /**
     * @param string $field
     * @param string $group
     * @param string $section
     * @param Mage_Core_Model_Store $store
     *
     * @return mixed
     */
    protected function getModuleConfig(
        $field, $group, $section = 'magedin_affiliate', Mage_Core_Model_Store $store = null
    )
    {
        return $this->getStoreConfig($field, $group, $section, $store);
    }
    
    
    /**
     * @param string $field
     *
     * @return mixed
     */
    protected function getCalculationConfig($field)
    {
        return $this->getModuleConfig($field, 'calculation');
    }
    
    
    /**
     * @return int
     */
    protected function getCommissionCalculationBase()
    {
        return (int) $this->getCalculationConfig('commission_calculation_base');
    }


    /**
     * @param string                     $field
     * @param string                     $group
     * @param string                     $section
     * @param Mage_Core_Model_Store|null $store
     *
     * @return mixed
     */
    protected function getStoreConfig($field, $group, $section, Mage_Core_Model_Store $store = null)
    {
        $path = implode('/', [$section, $group, $field]);
        return Mage::getStoreConfig($path, $store);
    }
    
}
