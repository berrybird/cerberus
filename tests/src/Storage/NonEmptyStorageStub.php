<?php

namespace Berrybird\Cerberus\Storage;

class NonEmptyStorageStub extends StorageDummy
{
    public function isEmpty()
    {
        return false;
    }

    public function read()
    {
        return 'foo';
    }
}
