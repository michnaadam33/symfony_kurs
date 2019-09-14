<?php


namespace App\Service;


use Psr\Log\LoggerInterface;

class LuckyNumber
{
    private $max;
    private $logger;

    public function __construct(int $max, LoggerInterface $logger)
    {
        $this->max = $max;
        $this->logger = $logger;
    }

    public function getNumber():int
    {
        $number = rand(1, $this->max);
        $this->logger->debug("New number: ".$number);
        return $number;
    }

}