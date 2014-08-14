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
        $output->writeln('Deleting CloudSearch documents...');

        $indexer = $this->getContainer()->get('cloudsearch.indexer');
        $searcher = $this->getContainer()->get('cloudsearch.searcher');

        $results = $searcher->findAll();
        foreach ($results['hits']['hit'] as $result) {
            $indexer->deleteById($result['id']);
        }

        $output->writeln('Done.');
    }

}
