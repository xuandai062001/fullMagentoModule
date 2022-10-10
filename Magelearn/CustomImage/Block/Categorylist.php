<?php
 
namespace Magelearn\CustomImage\Block;
 
use Magento\Catalog\Model\Product;
 
class Categorylist extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Product
     */
    protected $_category = null;

    protected $_categoryHelper;

    protected $_categoryFactory;
 
    protected $_storeManager;
 
    protected $_categoryNameFactory;
 
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\CategoryFactory $categoryNameFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collecionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Magelearn\CustomImage\Helper\Category $categoryHelper,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        $this->_categoryNameFactory = $categoryNameFactory;
        $this->_categoryFactory = $collecionFactory;
        $this->_storeManager = $storeManager;
        $this->_categoryHelper = $categoryHelper;
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

    public function getImageUrl($image){
        return $this->_categoryHelper->getImageUrl($image);
    }

    public function getEnableCategory()
    {
 
        $category = $this->_categoryFactory->create()->setStore($this->_storeManager->getStore());
        return $category;
    }
 
    public function getCategoryName($categoryId)
    {
        $category = $this->_categoryNameFactory->create()->load($categoryId)->setStore($this->_storeManager->getStore());
        return $category;
    }
}