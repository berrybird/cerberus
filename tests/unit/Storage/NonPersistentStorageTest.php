<?php

namespace Berrybird\Cerberus\Storage;

/**
 * NonPersistentStorage test
 *
 * @group  Cerberus
 * @group  Cerberus.Storage
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Storage\NonPersistentStorage
 *
 * @package    Berrybird\Cerberus\Storage
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class NonPersistentStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @coversNothing
     */
    public function itShouldBeTypeOfStorage()
    {
        $this->assertInstanceOf('Berrybird\Cerberus\Storage\Storage', new NonPersistentStorage);
    }

    /**
     * @test
     * @covers  ::isEmpty
     */
    public function itShouldBeEmptyInitialy()
    {
        $storage = new NonPersistentStorage;

        $this->assertTrue($storage->isEmpty());
    }

    public function providerItShouldStoreIdentity()
    {
        return array(
            array(null, true),
            array('', true),
            array(false, true),
            array(true, true),
            array('asdf', false),
            array(1, false),
            array(new \stdClass(), false),
        );
    }

    /**
     * @test
     * @covers  ::write
     * @covers  ::isEmpty
     * @dataProvider  providerItShouldStoreIdentity
     */
    public function itShouldStoreIdentity($identity, $isEmpty)
    {
        $storage = new NonPersistentStorage;

        $storage->write($identity);

        $this->assertSame($isEmpty, $storage->isEmpty());
    }

    /**
     * @test
     * @covers  ::write
     * @covers  ::read
     */
    public function itShouldOverwriteExistingIdentity()
    {
        $storage = new NonPersistentStorage;

        $storage->write('a');

        $this->assertSame('a', $storage->read());

        $storage->write('b');

        $this->assertSame('b', $storage->read());
    }

    /**
     * @test
     * @covers  ::clear
     */
    public function itShouldEmptyStorage()
    {
        $storage = new NonPersistentStorage;

        $storage->write('junk');

        $this->assertFalse($storage->isEmpty());

        $storage->clear();

        $this->assertTrue($storage->isEmpty());
    }
}
