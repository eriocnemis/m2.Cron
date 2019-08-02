<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Setup;

use \Magento\Framework\Setup\UninstallInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Uninstall
 */
class Uninstall implements UninstallInterface
{
    /**
     * Uninstall DB schema
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $version = $context->getVersion();
        $setup->startSetup();

        $this->removeTables($setup);

        $setup->endSetup();
    }

    /**
     * Remove Tables
     *
     * @param SchemaSetupInterface $setup
     * @return void
     */
    protected function removeTables(SchemaSetupInterface $setup)
    {
        $tableNames = [
            'eriocnemis_cron_job'
        ];
        foreach ($tableNames as $tableName) {
            if ($setup->tableExists($tableName)) {
                $setup->getConnection()->dropTable(
                    $setup->getTable($tableName)
                );
            }
        }
    }
}
