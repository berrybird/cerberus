<?php

namespace Berrybird\Cerberus\Adapter;

use Berrybird\Cerberus\Result;

class SuccessAdapterStub implements AuthenticationAdapter
{
    public function authenticate()
    {
        return new Result('foo', Result::SUCCESS);
    }
}
