<?php

namespace Berrybird\Cerberus\Adapter;

use Berrybird\Cerberus\Result;

class FailureAdapterStub implements AuthenticationAdapter
{
    public function authenticate()
    {
        $messages = array(
            'Credential doesn\'t match'
        );

        return new Result('foo', Result::FAILURE_GENERAL, $messages);
    }
}
