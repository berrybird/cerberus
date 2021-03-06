<?php

namespace Berrybird\Cerberus\Service;

use Berrybird\Cerberus\Adapter\AuthenticationAdapter;
use Berrybird\Cerberus\Result;

/**
 * Authentication service
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
interface AuthenticationService
{
    /**
     * Checks if a subject is authenticated
     *
     * @return  bool
     */
    public function isAuthenticated();

    /**
     * Function description
     *
     * @param   AuthenticationAdapter
     * @return  Result
     */
    public function authenticate(AuthenticationAdapter $adapter);

    /**
     * Revoke the current authentication
     *
     * @return  void
     */
    public function revoke();

    /**
     * Returns authentication identity
     *
     * @return  mixed
     */
    public function getIdentity();
}
