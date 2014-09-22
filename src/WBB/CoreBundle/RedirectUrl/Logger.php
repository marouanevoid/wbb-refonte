<?php

namespace WBB\CoreBundle\RedirectUrl;

use Psr\Log\LoggerInterface;

class Logger
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function error($message)
    {
        $this->logger->error('[RedirectUrl] ' . $message);
    }

    public function info($message)
    {
        $this->logger->info('[RedirectUrl] ' . $message);
    }

}
