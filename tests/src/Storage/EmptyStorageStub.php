<?php

namespace Berrybird\Cerberus\Storage;

class EmptyStorageStub extends StorageDummy
{
    public function isEmpty()
    {
        return true;
    }
}
