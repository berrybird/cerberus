<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Compares two credentials
 *
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    BSD-3-Clause
 */
interface CredentialMatcher
{
    /**
     * Determines if provided credentials are equal
     *
     * @param   mixed  $credential1  The first credential
     * @param   mixed  $credential2  The second credential
     * @return  bool
     */
    public function equals($credential1, $credential2);
}
