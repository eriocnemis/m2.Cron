<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\Cron\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Eriocnemis\Cron\Model\ResourceModel\Job\CollectionFactory as JobCollectionFactory;

/**
 * Command cron job info
 */
class CronJobInfoCommand extends Command
{
    /**
     * Job collection factory
     *
     * @var JobCollectionFactory
     */
    protected $collectionFactory;

    /**
     * Initialize command
     *
     * @param JobCollectionFactory $collectionFactory
     * @return void
     */
    public function __construct(
        JobCollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;

        parent::__construct();
    }

    /**
     * Configures the current command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('cron:job:info')->setDescription('Shows allowed Jobs');
    }

    /**
     * Executes the current command
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $jobs = $this->collectionFactory->create()->getItems();
        /** @var \Eriocnemis\Cron\Model\Job $job */
        foreach ($jobs as $job) {
            $output->writeln(
                sprintf('%-60s %s', $job->getId(), $job->getStatus() ? 'enabled' : 'disabled')
            );
        }
        return null;
    }
}
