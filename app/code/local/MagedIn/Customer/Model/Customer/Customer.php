<?php

class MagedIn_Customer_Model_Customer_Customer extends MagedIn_Rewrites_Model_Customer_Customer
{

    /**
     * @return mixed
     */
    public function retrieveAge()
    {
        return (int) $this->getData('age');
    }


    /**
     * @param int $age
     *
     * @return $this
     */
    public function defineAge($age)
    {
        $this->setData('age', (int) $age);

        return $this;
    }

}
