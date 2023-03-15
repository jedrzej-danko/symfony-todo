<?php

namespace App\Shared;

use Psr\Log\LoggerInterface;

trait LoggerAwareTrait
{
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     * @required
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }


}