<?php

namespace Berrybird\Cerberus;

/**
 * Authentication result
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
class Result
{
    // Result codes
    const SUCCESS                    =  1;
    const FAILURE_GENERAL            =  0;
    const FAILURE_IDENTITY_NOT_FOUND = -1;
    const FAILURE_CREDENTIAL_INVALID = -2;

    /**
     * @var  int  Authentication result code
     */
    protected $code;

    /**
     * @var  mixed  The identity for storing
     */
    protected $identity;

    /**
     * @var  array  Authentication messages
     */
    protected $messages = array();

    /**
     * Creates a new authentication result
     *
     * @param   mixed  $identity  The identity for storing
     * @param   int    $code      Authentication result code
     * @param   array  $messages  Authentication messages
     * @return  void
     */
    public function __construct($identity, $code, array $messages = array())
    {
        $this->identity = $identity;
        $this->code     = $code;
        $this->messages = $messages;
    }

    /**
     * Returns whether the result represents a successful authentication
     * attempt
     *
     * @return  bool
     */
    public function isValid()
    {
        return $this->code > 0;
    }

    /**
     * Returns the identity for storing
     *
     * @return  mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Returns the result code for this authentication attempt
     *
     * @return  int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns messages provided by authentication adapter
     *
     * @return  array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
