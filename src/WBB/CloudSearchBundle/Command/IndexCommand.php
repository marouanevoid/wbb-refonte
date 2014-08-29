<?php

namespace WBB\CloudSearchBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use WBB\BarBundle\Entity\Bar;
use WBB\CoreBundle\Entity\City;

class IndexCommand extends ContainerAwareCommand
{

    public function configure()
    {
        $this->setName('cloudsearch:index:all');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating the AWS CloudSearch index...');

        $indexer = $this->getContainer()->get('cloudsearch.indexer');
        $repos = array('bar.repository', 'bestof.repository', 'news.repository', 'city.repository');

        foreach ($repos as $repo) {
            $entities = $this->getContainer()->get($repo)->findAll();

            foreach ($entities as $entity) {
                if ($entity instanceof Bar) {
                    if ($entity->getStatus() == Bar::BAR_STATUS_ENABLED_VALUE) {
                        $indexer->index($entity);
                    } else {
                        $indexer->delete($entity);
                    }
                } elseif ($entity instanceof City) {
                    if (!$entity->getOnTopCity() && $entity->getBars()->count() == 0) {
                        $this->indexer->delete($entity);
                    }
                } else {
                    $indexer->index($entity);
                }
            }
        }
    }

}
