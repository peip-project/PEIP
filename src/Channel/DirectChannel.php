<?php

namespace PEIP\Channel;

namespace PEIP\Channel;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * DirectChannel
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP
 * @subpackage channel
 * @extends \PEIP\ABS\Channel\SubscribableChannel
 * @implements \PEIP\INF\Channel\SubscribableChannel, \PEIP\INF\Channel\Channel, \PEIP\INF\Event\Connectable
 */



use PEIP\Dispatcher\IteratingDispatcher;

class DirectChannel extends \PEIP\ABS\Channel\SubscribableChannel
{
    /**
     * @param $message
     * @param $timeout
     *
     * @return
     */
    public function send(\PEIP\INF\Message\Message $message, $timeout = -1)
    {
        $sent = $this->doSend($message);
    }


    /**
     * @param $message
     *
     * @return
     */
    protected function doSend(\PEIP\INF\Message\Message $message)
    {
        $this->getMessageDispatcher()->notify($message);

        return true;
    }

    /**
     * @return
     */
    public function getMessageDispatcher()
    {
        return isset($this->dispatcher) ? $this->dispatcher : $this->dispatcher = new IteratingDispatcher();
    }
}
