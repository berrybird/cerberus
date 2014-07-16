<?php

namespace Berrybird\Cerberus\Credential;

class CredentialMatcherDummy implements CredentialMatcher
{
    public function equals($credential1, $credential2)
    {
        return null;
    }
}