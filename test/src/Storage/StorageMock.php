<?php

namespace Berrybird\Cerberus\Storage;

class StorageMock extends StorageDummy
{
    public $writeParams = null;
    public $writeInvocationCount = 0;

    public function write($identity)
    {
        $this->writeParams = array($identity);
        $this->writeInvocationCount++;
    }

    public $clearInvocationCount = 0;

    public function clear()
    {
        $this->clearInvocationCount++;
    }
}
