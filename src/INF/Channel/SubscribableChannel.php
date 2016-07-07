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
 * \PEIP\INF\Channel\SubscribableChannel.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface SubscribableChannel
{
    public function subscribe($handler);

    public function unsubscribe($handler);
}
