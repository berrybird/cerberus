<?php

namespace Berrybird\Cerberus\Storage;

/**
 * Authentication storage
 *
 * Manages authentication identity
 *
 * @package    Berrybird\Cerberus\Storage
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
interface Storage
{
    /**
     * Determines if storage is empty
     *
     * @return  bool
     */
    public function isEmpty();

    /**
     * Returns the storage content
     *
     * @return  mixed
     */
    public function read();

    /**
     * Persists content
     *
     * @param   string  $identity  Content to persist
     * @return  void
     */
    public function write($identity);

    /**
     * Clears the storage
     *
     * @return  void
     */
    public function clear();
}
