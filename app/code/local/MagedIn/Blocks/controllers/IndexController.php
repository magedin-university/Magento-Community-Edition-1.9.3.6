<?php

class MagedIn_Blocks_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        /**
         * One way to obtain an instance of the layout object.
         * This is used when you're inside a controller or block context.
         *
         * @var Mage_Core_Model_Layout $layout
         */
        $layout = $this->getLayout();

        /**
         * Another way to obtain an instance of the layout object.
         * It's a global way and you can call it from anywhere.
         *
         * @var Mage_Core_Model_Layout $layout
         */
        // $layout = Mage::app()->getLayout();

        /**
         * Another way to obtain an instance of the layout object.
         * It's a global way and you can call it from anywhere.
         *
         * @var Mage_Core_Model_Layout $layout
         */
        // $layout = Mage::getSingleton('core/layout');

        /** @var MagedIn_Blocks_Block_Example $block */
        $block  = $layout->createBlock('magedin_blocks/example', 'magedin.blocks.example', [
            'first_name'  => 'Tiago',
            'last_name'   => 'Sampaio',
            'course_name' => 'Magento Professional Development',
            'module_name' => 'MagedIn_Blocks',
            'template'    => 'magedin/blocks/example.phtml'
        ]);

        $body = $block->toHtml();

        $this->getResponse()->setBody($body);
    }

}
