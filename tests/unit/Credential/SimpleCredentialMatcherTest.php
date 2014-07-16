<?php

namespace Berrybird\Cerberus\Credential;

/**
 * SimpleCredentialMatcher test
 *
 * @group  Cerberus
 * @group  Cerberus.Credential
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Credential\SimpleCredentialMatcher
 *
 * @package    Berrybird\Cerberus\Credential
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class SimpleCredentialMatcherTest extends CredentialMatcherTest
{
    /**
     * @test
     * @coversNothing
     */
    public function itShouldBeTypeOfCredentialMatcher()
    {
        $this->assertInstanceOf(
            'Berrybird\Cerberus\Credential\CredentialMatcher',
            new SimpleCredentialMatcher
        );
    }

    /**
     * @test
     * @covers  ::equals
     * @dataProvider  providerItShouldStateEquality
     */
    public function itShouldStateEquality($credential1, $credential2, $equals)
    {
        $matcher = new SimpleCredentialMatcher;

        $this->assertSame($equals, $matcher->equals($credential1, $credential2));
    }
}
