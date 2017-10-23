<?php

class MagedIn_Affiliates_Model_Resource_Setup extends Mage_Core_Model_Resource_Setup
{

    use MagedIn_Affiliates_Trait_Data,
        MagedIn_Affiliates_Trait_Resource_Setup;


    const INDEX_TYPE_FULLTEXT   = Varien_Db_Adapter_Interface::INDEX_TYPE_FULLTEXT;
    const INDEX_TYPE_INDEX      = Varien_Db_Adapter_Interface::INDEX_TYPE_INDEX;
    const INDEX_TYPE_PRIMARY    = Varien_Db_Adapter_Interface::INDEX_TYPE_PRIMARY;
    const INDEX_TYPE_UNIQUE     = Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE;

    const FK_ACTION_CASCADE     = Varien_Db_Adapter_Interface::FK_ACTION_CASCADE;
    const FK_ACTION_NO_ACTION   = Varien_Db_Adapter_Interface::FK_ACTION_NO_ACTION;
    const FK_ACTION_RESTRICT    = Varien_Db_Adapter_Interface::FK_ACTION_RESTRICT;
    const FK_ACTION_SET_DEFAULT = Varien_Db_Adapter_Interface::FK_ACTION_SET_DEFAULT;
    const FK_ACTION_SET_NULL    = Varien_Db_Adapter_Interface::FK_ACTION_SET_NULL;

}
