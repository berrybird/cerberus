<?php

namespace Berrybird\Cerberus;

/**
 * Result test
 *
 * @group  Cerberus
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Result
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
class ResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers  ::__construct
     * @covers  ::getIdentity
     * @covers  ::getCode
     * @covers  ::getMessages
     */
    public function itShouldProvideAuthenticationResultValues()
    {
        $result = new Result('foo', Result::SUCCESS, array('bar'));

        $this->assertSame('foo', $result->getIdentity());
        $this->assertSame(1, $result->getCode());
        $this->assertSame(array('bar'), $result->getMessages());
    }

    public function providerItShouldStateIfResultIsValid()
    {
        return array(
            array(Result::SUCCESS, true),
            array(Result::FAILURE_GENERAL, false),
            array(Result::FAILURE_CREDENTIAL_INVALID, false),
            array(Result::FAILURE_IDENTITY_NOT_FOUND, false),
        );
    }

    /**
     * @test
     * @covers  ::__construct
     * @covers  ::isValid
     * @dataProvider  providerItShouldStateIfResultIsValid
     */
    public function itShouldStateIfResultIsValid($code, $isValid)
    {
        $result = new Result('foo', $code);

        $this->assertSame($isValid, $result->isValid());
    }
}
