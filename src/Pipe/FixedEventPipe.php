<?php

namespace PEIP\Pipe;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * FixedEventPipe.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @extends \PEIP\Pipe\EventPipe
 * @implements \PEIP\INF\Event\Listener, \PEIP\INF\Event\Connectable, \PEIP\INF\Channel\SubscribableChannel, \PEIP\INF\Channel\Channel, \PEIP\INF\Handler\Handler, \PEIP\INF\Message\MessageBuilder
 */
class FixedEventPipe extends \PEIP\Pipe\EventPipe
{
    /**
     * @param $inputChannel
     *
     * @return
     */
    public function setInputChannel(\PEIP\INF\Channel\Channel $inputChannel)
    {
        if (isset($this->eventName)) {
            $this->connectChannel($inputChannel);
        } else {
            $this->inputChannel = $inputChannel;
        }
    }

    /**
     * @param $eventName
     *
     * @return
     */
    public function setEventName($eventName)
    {
        if (!isset($this->eventName)) {
            $this->eventName = $eventName;
            if ($this->inputChannel) {
                $this->inputChannel->connect($this->eventName, $this);
            }
        }
    }
}
