<?php

namespace WBB\CloudSearchBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends ContainerAwareCommand
{

    public function configure()
    {
        $this->setName('cloudsearch:delete:all');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $indexer = $this->getContainer()->get('cloudsearch.indexer');
        $repos = array('bar.repository', 'bestof.repository');

        foreach ($repos as $repo) {
            $entities = $this->getContainer()->get($repo)->findAll();

            foreach ($entities as $entity) {
                $indexer->deleteById($entity);
            }
        }
    }

}
