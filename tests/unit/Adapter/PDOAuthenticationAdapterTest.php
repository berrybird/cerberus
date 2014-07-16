<?php

namespace Berrybird\Cerberus\Adapter;

use Berrybird\Cerberus\Credential\CredentialMatcherDummy;
use Berrybird\Cerberus\Credential\SimpleCredentialMatcher;
use Berrybird\Cerberus\PHP\PDOMock;
use Berrybird\Cerberus\Result;

/**
 * PDOAuthenticationAdapter test
 *
 * @group  Cerberus
 * @group  Cerberus.Adapter
 *
 * @coversDefaultClass  \Berrybird\Cerberus\Adapter\PDOAuthenticationAdapter
 *
 * @package    Berrybird\Cerberus\Adapter
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    New BSD
 */
class PDOAuthenticationAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var  \PDO
     */
    private static $pdo;

    /**
     * @beforeClass
     */
    public static function setUpDatabase()
    {
        if ( ! extension_loaded('pdo_sqlite')) {
            return;
        }

        $createStatement = 'CREATE TABLE auth (id INTEGER PRIMARY KEY, username TEXT, pass TEXT)';
        $insertStatement = 'INSERT INTO auth (username, pass) VALUES '
                         . '("foo", "hash1"), '
                         . '("bar", "hash2"), '
                         . '("jsmith", "valid-hash")';

        self::$pdo = new \PDO('sqlite::memory:');

        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$pdo->exec($createStatement);
        self::$pdo->exec($insertStatement);
    }

    /**
     * @afterClass
     */
    public static function tearDownDatabase()
    {
        if ( ! extension_loaded('pdo_sqlite')) {
            return;
        }

        self::$pdo->exec('DROP TABLE auth');

        self::$pdo = null;
    }

    /**
     * @test
     * @coversNothing
     */
    public function itShouldBeTypeOfAuthenticationAdapter()
    {
        $this->assertInstanceOf(
            'Berrybird\Cerberus\Adapter\AuthenticationAdapter',
            new PDOAuthenticationAdapter(new PDOMock, new CredentialMatcherDummy)
        );
    }

    public function providerItShouldAuthenticateWithProvidedCredentials()
    {
        return array(
            array('jsmith', 'valid-hash', Result::SUCCESS),
            array('jsmith', 'invalid-hash', Result::FAILURE_CREDENTIAL_INVALID),
            array('unknown', 'valid-hash', Result::FAILURE_IDENTITY_NOT_FOUND),
            array('unknown', 'invalid-hash', Result::FAILURE_IDENTITY_NOT_FOUND),
        );
    }

    /**
     * @test
     * @covers  ::__construct
     * @covers  ::credentials
     * @covers  ::authenticate
     * @covers  ::query
     * @requires  extension pdo_sqlite
     * @dataProvider  providerItShouldAuthenticateWithProvidedCredentials
     */
    public function itShouldAuthenticateWithProvidedCredentials($identity, $credential, $resultCode)
    {
        $config = array(
            'table'    => 'auth',
            'password' => 'pass',
        );

        $adapter = new PDOAuthenticationAdapter(self::$pdo, new SimpleCredentialMatcher, $config);

        $adapter->credentials($identity, $credential);

        $result = $adapter->authenticate();

        $this->assertSame($resultCode, $result->getCode());
    }

    /**
     * @test
     * @covers  ::authenticate
     * @covers  ::query
     * @expectedException  Berrybird\Cerberus\Adapter\AdapterException
     */
    public function itShouldThrowExceptionInCaseOfDatabaseError()
    {
        $adapter = new PDOAuthenticationAdapter(new \PDO('sqlite::memory:'), new CredentialMatcherDummy);

        $adapter->authenticate();
    }
}
