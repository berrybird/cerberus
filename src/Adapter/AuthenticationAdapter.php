<?php

namespace Berrybird\Cerberus\Adapter;

use Berrybird\Cerberus\Result;

/**
 * Class description
 *
 * @copyright  Copyright (C) 2011-2014 Miodrag Tokić
 * @license    BSD-3-Clause
 */
interface AuthenticationAdapter
{
    /**
     * Performs authentication
     *
     * @return  Result
     * @throws  AdapterException
     */
    public function authenticate();
}
