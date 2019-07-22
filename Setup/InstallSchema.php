<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Install schema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'eriocnemis_cron_job'
         */
        $jobTable = $installer->getTable('eriocnemis_cron_job');
        if (!$installer->tableExists($jobTable)) {
            $table = $installer->getConnection()->newTable(
                $jobTable
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'primary' => true],
                'Name'
            )
            ->addColumn(
                'group',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Group'
            )
            ->addColumn(
                'schedule',
                Table::TYPE_TEXT,
                255,
                [],
                'Schedule'
            )
            ->addColumn(
                'module',
                Table::TYPE_TEXT,
                255,
                [],
                'Module'
            )
            ->addColumn(
                'instance',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Instance'
            )
            ->addColumn(
                'method',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Method'
            )
            ->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => 1],
                'Status'
            )
            ->addIndex(
                $installer->getIdxName($jobTable, ['name']),
                ['name']
            )
            ->addIndex(
                $installer->getIdxName($jobTable, ['group']),
                ['group']
            )
            ->addIndex(
                $installer->getIdxName($jobTable, ['module']),
                ['module']
            )
            ->addIndex(
                $installer->getIdxName($jobTable, ['status']),
                ['status']
            )
            ->setComment(
                'Cron Job Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
