<?php

namespace PEIP\INF\Base;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Event\Connectable.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface Plugable
{
    public function connect($listener);

    public function disconnect($listener);

    public function disconnectAll();

    public function hasListeners();

    public function getListeners();
}
