<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Compares two credentials
 *
 * @package    Berrybird\Cerberus\Credential
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
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
