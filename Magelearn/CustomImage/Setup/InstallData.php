<?php
// namespace Magelearn\CustomImage\Setup;
 
// use Magento\Eav\Setup\EavSetup;
// use Magento\Eav\Setup\EavSetupFactory;
// use Magento\Framework\Setup\InstallDataInterface;
// use Magento\Framework\Setup\ModuleContextInterface;
// use Magento\Framework\Setup\ModuleDataSetupInterface;
// use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
 
// /**
//  * @codeCoverageIgnore
//  */
// class InstallData implements InstallDataInterface
// {
//     /**
//      * EAV setup factory.
//      *
//      * @var EavSetupFactory
//      */
//     private $_eavSetupFactory;
//     protected $categorySetupFactory;
 
//     /**
//      * Init.
//      *
//      * @param EavSetupFactory $eavSetupFactory
//      */
//     public function __construct(EavSetupFactory $eavSetupFactory, \Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory)
//     {
//         $this->_eavSetupFactory = $eavSetupFactory;
//         $this->categorySetupFactory = $categorySetupFactory;
//     }
 
//     /**
//      * {@inheritdoc}
//      *
//      * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
//      */
//     public function install(
//         ModuleDataSetupInterface $setup,
//         ModuleContextInterface $context
//     ) {
//         /** @var EavSetup $eavSetup */
//         $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);
//         $setup = $this->categorySetupFactory->create(['setup' => $setup]);         
//         $setup->addAttribute(
//             \Magento\Catalog\Model\Category::ENTITY, 'custom_image', [
//                 'type' => 'varchar',
//                 'label' => 'Custom Image',
//                 'input' => 'image',
//                 'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
//                 'visible' =>  true,
//                 'required' => false,
//                 'sort_order' => 9,
//                 'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
//                 'group' => 'General Information'
//             ]
//         );
//     }
// }


// ==========================================================================================

namespace Magelearn\CustomImage\Setup;

use Magento\Framework\Setup\{
ModuleContextInterface,
ModuleDataSetupInterface,
InstallDataInterface
};

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory) {
    $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(\Magento\Catalog\Model\Category::ENTITY, 'is_landing', [
        'type' => 'int',
        'label' => 'Is Landing',
        'input' => 'boolean',
        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
        'visible' => true,
        'default' => '0',
        'required' => false,
        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
        'group' => 'General Information'
    ]);
    }
}