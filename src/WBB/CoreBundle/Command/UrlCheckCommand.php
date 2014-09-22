<?php

namespace WBB\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UrlCheckCommand extends ContainerAwareCommand
{

    public function configure()
    {
        $this->setName('redirect-urls:check');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $checker = $this->getContainer()->get('wbb.url.checker');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $urls = $em->getRepository('WBBCoreBundle:RedirectUrl')->findBy(array(), array('sourceCanonical' => 'ASC'));

        foreach ($urls as $url) {
            if (!$checker->exists($url)) {
                $output->writeln($url->getDestinationCanonical());
            }
        }
    }

}
