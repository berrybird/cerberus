<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Compares two credentials in a length-constant time.
 *
 * @link  https://crackstation.net/hashing-security.htm?=rd#slowequals
 *
 * @package    Berrybird\Cerberus\Credential
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class SlowCredentialMatcher implements CredentialMatcher
{
    /**
     * {@inheritdoc}
     */
    public function equals($credential1, $credential2)
    {
        $diff = strlen($credential1) ^ strlen($credential2);

        for ($i = 0; $i < strlen($credential1) && $i < strlen($credential2); $i++) {
            $diff |= ord($credential1[$i]) ^ ord($credential2[$i]);
        }

        return $diff === 0;
    }
}
