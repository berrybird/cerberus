<?php

namespace Berrybird\Cerberus\Storage;

/**
 * Non-persistent storage
 *
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class NonPersistentStorage implements Storage
{
    /**
     * @var  mixed  Data
     */
    protected $identity = null;

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->identity) || $this->identity === true;
    }

    /**
     * {@inheritdoc}
     */
    public function read()
    {
        return $this->identity;
    }

    /**
     * {@inheritdoc}
     */
    public function write($identity)
    {
        $this->identity = $identity;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->identity = null;
    }
}
