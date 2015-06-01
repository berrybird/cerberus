<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Base CredentialMatcher test case
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
abstract class CredentialMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function providerItShouldStateEquality()
    {
        return array(
            array(false, false, true),
            array(1, 1, true),
            array('a', 'a', true),
            array('a', 'b', false),
            array('1', 1, false),
            array('1', true, false),
            array('0', null, false),
            array(0, null, false),
        );
    }

    abstract public function itShouldBeTypeOfCredentialMatcher();

    abstract public function itShouldStateEquality($credential1, $credential2, $equals);
}
