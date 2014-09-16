<?php

namespace WBB\CoreBundle\RedirectUrl;

use WBB\CoreBundle\Entity\RedirectUrl;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\HttpKernel\KernelInterface;

class UrlChecker
{

    /**
     * @var KernelInterface
     */
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function exists(RedirectUrl $url)
    {
        $destinationC = $url->getDestinationCanonical();

        $client = new Client($this->kernel);
        $client->request('GET', $destinationC);

        $statusCode = $client->getResponse()->getStatusCode();
        $client->restart();

        if ($statusCode == 404) {
            return false;
        }

        return true;
    }

}
