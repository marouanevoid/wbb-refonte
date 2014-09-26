<?php

namespace WBB\BarBundle\Logger;

use Psr\Log\LoggerInterface;

class LegalAgeLogger
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
        $this->logger->error('[LegalAge] ' . $message);
    }

    public function info($message)
    {
        $this->logger->info('[LegalAge] ' . $message);
    }

}
