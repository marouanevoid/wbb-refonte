<?php

namespace WBB\CloudSearchBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $repos = array('bar.repository', 'bestof.repository');

        foreach ($repos as $repo) {
            $entities = $this->getContainer()->get($repo)->findAll();

            foreach ($entities as $entity) {
                $indexer->index($entity);
            }
        }
    }

}
