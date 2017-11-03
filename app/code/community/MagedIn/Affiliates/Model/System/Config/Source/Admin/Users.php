<?php

class MagedIn_Affiliates_Model_System_Config_Source_Admin_Users
{

    use MagedIn_Affiliates_Trait_Data,
        MagedIn_Affiliates_Model_System_Config_Source_Common;


    /**
     * @return array
     */
    public function toArray()
    {
        $result = [
            0 => $this->__('- No user associated -')
        ];

        /** @var Mage_Admin_Model_Resource_User_Collection $users */
        $users = Mage::getResourceModel('admin/user_collection');

        /** @var Mage_Admin_Model_User $user */
        foreach ($users as $user) {
            $result[$user->getId()] = $user->getName();
        }

        return $result;
    }

}
