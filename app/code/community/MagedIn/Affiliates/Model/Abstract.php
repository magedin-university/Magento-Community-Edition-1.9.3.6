<?php

abstract class MagedIn_Affiliates_Model_Abstract extends Mage_Core_Model_Abstract
{

    use MagedIn_Affiliates_Trait_Data {
        getAffiliate as protected getAffiliateModel;
    }


    /**
     * If model has created_at and updated_at then this fields are automatically filled when model is saved.
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _beforeSave()
    {
        if (!$this->getId()) {
            $this->isObjectNew(true);
        }

        $dataKey = ($this->isObjectNew() && !$this->hasData('created_at')) ? 'created_at' : 'updated_at';
        $this->setData($dataKey, now());

        return parent::_beforeSave();
    }

}
