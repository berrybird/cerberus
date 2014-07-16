<?php

namespace Berrybird\Cerberus\Service;

use Berrybird\Cerberus\Result;
use Berrybird\Cerberus\Adapter\AuthenticationAdapter;
use Berrybird\Cerberus\Storage\Storage;

/**
 * Default authentication service provided by this package
 *
 * @package    Berrybird\Cerberus\Service
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class DefaultAuthenticationService implements AuthenticationService
{
    /**
     * @var  Storage  Storage
     */
    protected $storage;

    /**
     * Creates a new default authentication service
     *
     * @param   Storage  $storage  Storage for persisting authentication
     * @return  void
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function isAuthenticated()
    {
        return ! $this->storage->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(AuthenticationAdapter $adapter)
    {
        $this->storage->clear();

        $result = $adapter->authenticate();

        if ($result->isValid()) {
            $this->storage->write($result->getIdentity());
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function revoke()
    {
        $this->storage->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentity()
    {
        return ($this->storage->isEmpty())
            ? null
            : $this->storage->read();
    }
}
