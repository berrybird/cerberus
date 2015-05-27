<?php

namespace Berrybird\Cerberus\Adapter;

use Berrybird\Cerberus\Credential\CredentialMatcher;
use Berrybird\Cerberus\Result;

/**
 * PDO authentication adapter
 *
 * @copyright  Copyright (C) 2011-2015 Miodrag Tokić
 * @license    BSD-3-Clause
 */
class PDOAuthenticationAdapter implements AuthenticationAdapter
{
    /**
     * @var  array  Table columns
     */
    protected $config = array(
        'table'    => 'users',
        'identity' => 'username',
        'password' => 'password',
    );

    /**
     * @var  string  Identity
     */
    protected $identity;

    /**
     * @var  string  Password credential
     */
    protected $password;

    /**
     * @var  CredentialMatcher
     */
    protected $matcher;

    /**
     * @var  \PDO
     */
    protected $pdo;

    /**
     * Queries database
     *
     * @return  string
     */
    protected function query()
    {
        $sql = sprintf(
            'SELECT %s FROM %s WHERE %s = %s LIMIT 1',
            $this->config['password'],
            $this->config['table'],
            $this->config['identity'],
            $this->pdo->quote($this->identity)
        );

        $statement = $this->pdo->query($sql);

        if ($statement === false) {
            throw new AdapterException(sprintf(
                'PDOAuthenticationAdapter: Failed to query database using "%s" statement.',
                $sql
            ));
        }

        return $statement->fetchColumn();
    }

    /**
     * Creates a new PDO authentication adapter
     *
     * @param   \PDO               $pdo
     * @param   CredentialMatcher  $matcher
     * @param   array              $config  Table config
     * @return  void
     */
    public function __construct(\PDO $pdo, CredentialMatcher $matcher, array $config = null)
    {
        $this->pdo     = $pdo;
        $this->matcher = $matcher;

        if ($config !== null) {
            $this->config = array_merge($this->config, $config);
        }
    }

    /**
     * Closes PDO connection
     *
     * @return  void
     */
    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * Sets credentials for authentication
     *
     * @param   string  $identity  Identity
     * @param   string  $password  Password
     * @return  PDOAuthenticationAdapter
     */
    public function credentials($identity, $password)
    {
        $this->identity = $identity;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate()
    {
        $password = $this->query();

        if ($password === false) {
            return new Result($this->identity, Result::FAILURE_IDENTITY_NOT_FOUND);
        }

        $isValid = $this->matcher->equals($password, $this->password);

        if ( ! $isValid) {
            return new Result($this->identity, Result::FAILURE_CREDENTIAL_INVALID);
        } elseif ($isValid) {
            return new Result($this->identity, Result::SUCCESS);
        }

        return new Result($this->identity, Result::FAILURE_GENERAL);
    }
}
