<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
 
/**
 * Product description block
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Xuandai\CustomImage\Block;
 
use Magento\Catalog\Model\Product;
 
class Image extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Product
     */
    protected $_category = null;
 
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
 
    /**
     * @var \SR\CategoryImage\Helper\Category
     */
    protected $_categoryHelper;
 
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        //Magento 2 Registry is a class that is used to share the data between objects in Magento. e.g. save the object to the Registry in the controller class and get in the block class
        \Magento\Framework\Registry $registry,
        \Xuandai\CustomImage\Helper\Category $categoryHelper,
        array $data = [],
        \Magento\Catalog\Model\CategoryFactory $categoryFactory
    )
    {
        $this->_coreRegistry = $registry;
        $this->_categoryHelper = $categoryHelper;
        $this->categoryFactory = $categoryFactory;
        parent::__construct($context, $data);
    }
 
 
    /**
     * Retrieve current category model object
     *
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentCategory()
    {
        if (!$this->_category) {
            $this->_category = $this->_coreRegistry->registry('current_category');
 
            if (!$this->_category) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Category object could not be found in core registry'));
            }
        }
        return $this->_category;
    }
 
 
    public function getImageUrl()
    {
        //check argument catalog_category_view.xml
        $imageCode = $this->hasImageCode() ? $this->getImageCode() : 'image';

        //get data by code
        $image = $this->getCurrentCategory()->getData($imageCode);

        //call funtion in my helper
        return $this->_categoryHelper->getImageUrl($image);
    }

}