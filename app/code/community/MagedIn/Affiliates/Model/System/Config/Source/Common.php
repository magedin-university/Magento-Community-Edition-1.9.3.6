<?php

trait MagedIn_Affiliates_Model_System_Config_Source_Common
{
    
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        
        foreach ($this->toArray() as $key => $value) {
            $options[] = [
                'value' => $key,
                'label' => $value
            ];
        }
        
        return $options;
    }
    
    
    /**
     * @param $key
     *
     * @return bool|string
     */
    public function getLabel($key)
    {
        $options = $this->toArray();
        
        if (!isset($options[$key])) {
            return false;
        }
        
        return $options[$key];
    }

}
