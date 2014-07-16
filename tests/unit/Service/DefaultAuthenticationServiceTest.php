<?php

namespace Berrybird\Cerberus\Service;

use Berrybird\Cerberus\Adapter\AuthenticationAdapter;
use Berrybird\Cerberus\Adapter\SuccessAdapterStub;
use Berrybird\Cerberus\Adapter\FailureAdapterStub;
use Berrybird\Cerberus\Storage\Storage;
use Berrybird\Cerberus\Storage\StorageDummy;
use Berrybird\Cerberus\Storage\StorageMock;
use Berrybird\Cerberus\Storage\EmptyStorageStub;
use Berrybird\Cerberus\Storage\NonEmptyStorageStub;
use Berrybird\Cerberus\Result;

/**
 * DefaultAuthenticationService test
 *
 * @group  Cerberus
 * @group  Cerberus.Service
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Service\DefaultAuthenticationService
 *
 * @package    Berrybird\Cerberus\Service
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class DefaultAuthenticationServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @coversNothing
     */
    public function itShouldBeTypeOfAuthenticationService()
    {
        $this->assertInstanceOf(
            'Berrybird\Cerberus\Service\AuthenticationService',
            new DefaultAuthenticationService(new StorageDummy)
        );
    }

    public function providerItShouldPassOnSuccessfulAuthenticatation()
    {
        return array(
            array(new SuccessAdapterStub, 1, array('foo')),
            array(new FailureAdapterStub, 0, null),
        );
    }

    /**
     * @test
     * @covers  ::__construct
     * @covers  ::authenticate
     * @dataProvider  providerItShouldPassOnSuccessfulAuthenticatation
     */
    public function itShouldPassOnSuccessfulAuthenticatation(
        AuthenticationAdapter $adapter,
        $writeInvocationCount,
        $writeParams
    )
    {
        $storage = new StorageMock;
        $service = new DefaultAuthenticationService($storage);

        $service->authenticate($adapter);

        $this->assertSame($writeInvocationCount, $storage->writeInvocationCount);
        $this->assertSame($writeParams, $storage->writeParams);
    }

    /**
     * @test
     * @covers  ::authenticate
     */
    public function itShouldFailOnUnsuccessfulAuthenticationEvenIfPreviousWasSuccessful()
    {
        $storage = new StorageMock;
        $service = new DefaultAuthenticationService($storage);

        $service->authenticate(new SuccessAdapterStub);

        $this->assertSame(1, $storage->clearInvocationCount);
        $this->assertSame(1, $storage->writeInvocationCount);

        $service->authenticate(new FailureAdapterStub);

        $this->assertSame(2, $storage->clearInvocationCount);
        $this->assertSame(1, $storage->writeInvocationCount);
    }

    public function providerItShouldStateIfAuthenicationIsValid()
    {
        return array(
            array(new EmptyStorageStub, false),
            array(new NonEmptyStorageStub, true),
        );
    }

    /**
     * @test
     * @covers  ::isAuthenticated
     * @dataProvider  providerItShouldStateIfAuthenicationIsValid
     */
    public function itShouldStateIfAuthenicationIsValid(Storage $storage, $isAuthenticated)
    {
        $service = new DefaultAuthenticationService($storage);

        $this->assertSame($isAuthenticated, $service->isAuthenticated());
    }

    public function providerItShouldProvideAuthenticationIdentity()
    {
        return array(
            array(new EmptyStorageStub, null),
            array(new NonEmptyStorageStub, 'foo'),
        );
    }

    /**
     * @test
     * @covers  ::getIdentity
     * @dataProvider  providerItShouldProvideAuthenticationIdentity
     */
    public function itShouldProvideAuthenticationIdentity(Storage $storage, $identity)
    {
        $service = new DefaultAuthenticationService($storage);

        $this->assertSame($identity, $service->getIdentity());
    }

    /**
     * @test
     * @covers  ::revoke
     */
    public function itShouldRevokeAuthentication()
    {
        $storage = new StorageMock;
        $service = new DefaultAuthenticationService($storage);

        $service->revoke();

        $this->assertSame(1, $storage->clearInvocationCount);
    }
}
