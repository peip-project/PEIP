<?php

namespace PEIP\INF\Channel;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Channel\PollableChannel.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Channel\Channel
 */
interface PollableChannel extends \PEIP\INF\Channel\Channel
{
    public function receive($timeout = null);

    public function clear();

    public function purge(\PEIP\INF\Selector\MessageSelector $selector);
}
