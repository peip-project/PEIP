<?php

namespace PEIP\INF\Dispatcher;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Dispatcher\BreakableDispatcher.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface BreakableDispatcher
{
    public function notifyUntill($subject);
}
