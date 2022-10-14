<?php
namespace Mageplaza\CustomCheckoutFields\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

/**
 * Install Data
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->addDeliveryDateAttribute($setup);
    }

    /**
     * Add the address delivery_date attribute
     *
     * @return void
     */
    protected function addDeliveryDateAttribute(ModuleDataSetupInterface $setup)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        if (!$customerSetup->getAttributeId('customer_address', 'order_by')) {
            $customerSetup->addAttribute('customer_address', 'order_by', [
                'type' => 'varchar',
                'label' => 'Order By',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'system' => 0,
                'visible_on_front' => false,
                'sort_order' => 102,
                'position' => 999
            ]);
        }
    }
}
