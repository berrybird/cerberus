<?php

namespace Berrybird\Cerberus\Storage;

class StorageDummy implements Storage
{
    public function isEmpty()
    {
        return null;
    }

    public function read()
    {
        return null;
    }

    public function write($identity)
    {
        return null;
    }

    public function clear()
    {
        return null;
    }
}
