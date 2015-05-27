<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Compares two credentials
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
class SimpleCredentialMatcher implements CredentialMatcher
{
    /**
     * {@inheritdoc}
     */
    public function equals($credential1, $credential2)
    {
        return $credential1 === $credential2;
    }
}
