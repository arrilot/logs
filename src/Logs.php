<?php

namespace Arrilot\Logs;

use InvalidArgumentException;
use Monolog\Registry;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

trait Logs
{
    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * Getter for logger.
     * If logger is not set, an null (empty) logger is set. It does not log anywhere.
     *
     * @return LoggerInterface
     */
    public function logger()
    {
        if (is_null($this->logger)) {
            $this->logger = new NullLogger();
        }
        
        return $this->logger;
    }

    /**
     * Setter for logger.
     *
     * @param LoggerInterface|string $logger
     * @return $this
     */
    public function setLogger($logger)
    {
        if (is_object($logger) && $logger instanceof LoggerInterface) {
            $this->logger = $logger;
        } elseif (is_string($logger) && class_exists('\\Monolog\\Registry') && Registry::hasLogger($logger)) {
            $this->logger = Registry::getInstance($logger);
        } else {
            throw new InvalidArgumentException('Only "Psr\Log\LoggerInterface" or a name for logger in a "Monolog\Registry" are allowed to be passed as $logger');
        }

        return $this;
    }
    
    /**
     * Sets a logger that simply echoes everything.
     *
     * @return $this
     */
    public function setEchoLogger()
    {
        $this->logger = new EchoLogger();

        return $this;
    }

    /**
     * Remove a logger.
     *
     * @return $this
     */
    public function removeLogger()
    {
        $this->logger = null;

        return $this;
    }
}
