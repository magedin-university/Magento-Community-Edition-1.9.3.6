<?php

class MagedIn_Rewrites_Model_Customer_Customer extends Mage_Customer_Model_Customer
{

    /**
     * @return string
     */
    public function getNickname()
    {
        $nickname = $this->getData('nickname');

        if (!$nickname) {
            $nickname = $this->getData('firstname');
        }

        return (string) $nickname;
    }


    /**
     * @param string $nickname
     *
     * @return $this
     */
    public function setNickname($nickname)
    {
        $this->setData('nickname', (string) $nickname);

        return $this;
    }

}
