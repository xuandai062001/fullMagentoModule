<?php
namespace Mageplaza\CustomCheckoutFields\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Add the new column
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $this->addOrderByColumn($setup);

        $installer->endSetup();
    }

    /**
     * Add the column named delivery_date
     *
     * @param SchemaSetupInterface $setup
     *
     * @return void
     */
    private function addOrderByColumn(SchemaSetupInterface $setup)
    {
        $orderBy = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            'default' => NULL,
            'nullable' => true,
            'comment' => 'Order by'
        ];

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'Order by',
            $orderBy
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('quote_address'),
            'Order by',
            $orderBy
        );
    }
}
