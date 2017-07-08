<?php

namespace Arrilot\Logs;

use InvalidArgumentException;
use Monolog\Handler\NullHandler;
use Monolog\Logger;
use Monolog\Registry;
use Psr\Log\LoggerInterface;

trait Logs
{
    /**
     * @var LoggerInterface|null
     */
    private $logger;
    
    /**
     * Getter for logger.
     * If logger is not set, an null (empty) logger is set. It does not log anywhere.
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        if (is_null($this->logger)) {
            $this->logger = (new Logger('null'))->pushHandler(new NullHandler());
        }
        
        return $this->logger;
    }
    
    /**
     * Setter for logger.
     *
     * @param string|LoggerInterface $logger
     * @return $this
     */
    public function setLogger($logger)
    {
        if (is_object($logger) && $logger instanceof LoggerInterface) {
            $this->logger = $logger;
        } elseif (is_string($logger) && Registry::hasLogger($logger)) {
            $this->logger = Registry::getInstance($logger);
        } else {
            throw new InvalidArgumentException('Only "Psr\Log\LoggerInterface" or a name for logger in a "Monolog\Registry" are allowed');
        }
        
        return $this;
    }
}
