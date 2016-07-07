<?php

namespace PEIP\ABS\Request;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP\ABS\Request\Connection.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Request\Connection
 */
abstract class Connection implements \PEIP\INF\Request\Connection
{
    /**
     * @param $request
     *
     * @return
     */
    public function sendRequest(\PEIP\ABS\Request\Request $request)
    {
        return $this->doSendRequest($request);
    }

    /**
     * @param $request
     *
     * @return
     */
    abstract protected function doSendRequest(\PEIP\ABS\Request\Request $request);
}
