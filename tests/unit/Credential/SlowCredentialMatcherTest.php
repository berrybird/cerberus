<?php

namespace Berrybird\Cerberus\Credential;

/**
 * SlowCredentialMatcher test
 *
 * @group  Cerberus
 * @group  Cerberus.Credential
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Credential\SlowCredentialMatcher
 *
 * @package    Berrybird\Cerberus\Credential
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class SlowCredentialMatcherTest extends CredentialMatcherTest
{
    /**
     * @test
     * @coversNothing
     */
    public function itShouldBeTypeOfCredentialMatcher()
    {
        $this->assertInstanceOf(
            'Berrybird\Cerberus\Credential\CredentialMatcher',
            new SlowCredentialMatcher
        );
    }

    /**
     * @test
     * @covers  ::equals
     * @dataProvider  providerItShouldStateEquality
     */
    public function itShouldStateEquality($credential1, $credential2, $equals)
    {
        $matcher = new SlowCredentialMatcher;

        $this->assertSame($equals, $matcher->equals($credential1, $credential2));
    }
}
