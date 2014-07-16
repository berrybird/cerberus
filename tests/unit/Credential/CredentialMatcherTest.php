<?php

namespace Berrybird\Cerberus\Credential;

/**
 * Base CredentialMatcher test case
 *
 * @package    Berrybird\Cerberus\Credential
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
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
