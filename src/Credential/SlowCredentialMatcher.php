<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Compares two credentials in a length-constant time.
 *
 * @see  https://crackstation.net/hashing-security.htm?=rd#slowequals
 *
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    BSD-3-Clause
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
