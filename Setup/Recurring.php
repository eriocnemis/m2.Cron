<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Setup;

use \Magento\Framework\App\Utility\Classes;
use \Magento\Framework\ObjectManager\ConfigInterface;
use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Cron\Model\Config\Data as ConfigData;
use \Eriocnemis\Cron\Model\JobFactory;

/**
 * Recurring schema
 */
class Recurring implements InstallSchemaInterface
{
    /**
     * Job factory
     *
     * @var JobFactory
     */
    protected $jobFactory;

    /**
     * Cron config data
     *
     * @var ConfigData
     */
    protected $configData;

    /**
     * Object manager config
     *
     * @var ConfigInterface
     */
    protected $configObject;

    /**
     * Initialize schema
     *
     * @param JobFactory $jobFactory
     * @param ConfigData $configData
     * @param ConfigInterface $configObject
     */
    public function __construct(
        JobFactory $jobFactory,
        ConfigData $configData,
        ConfigInterface $configObject
    ) {
        $this->jobFactory = $jobFactory;
        $this->configData = $configData;
        $this->configObject = $configObject;
    }

    /**
     * Installs DB schema
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        foreach ($this->configData->getJobs() as $group => $jobs) {
            foreach ($jobs as $data) {
                $data['group'] = $group;
                $data['module'] = $this->getModuleName($data);
                /** @var \Eriocnemis\Cron\Model\Job $job */
                $job = $this->jobFactory->create();
                $job->setData($data);
                $job->save();
            }
        }
    }

    /**
     * Retrieve module name
     *
     * @param array $data
     * @return string|null
     */
    protected function getModuleName($data)
    {
        $instance = $data['instance'] ?? null;
        if ($instance) {
            $instance = $this->configObject->getInstanceType($instance);
            if (false !== strpos($instance, '\\')) {
                return Classes::getClassModuleName($instance);
            }
        }
        return null;
    }
}
