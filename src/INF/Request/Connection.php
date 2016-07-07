<?php

namespace PEIP\INF\Request;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Request\Connection.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface Connection
{
    public function sendRequest(\PEIP\ABS\Request\Request $request);
}
