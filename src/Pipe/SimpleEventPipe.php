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
 * SimpleEventPipe.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @extends \PEIP\Pipe\EventPipe
 * @implements \PEIP\INF\Event\Listener, \PEIP\INF\Event\Connectable, \PEIP\INF\Channel\SubscribableChannel, \PEIP\INF\Channel\Channel, \PEIP\INF\Handler\Handler, \PEIP\INF\Message\MessageBuilder
 */
class SimpleEventPipe extends \PEIP\Pipe\EventPipe
{
    /**
     * @param $eventName
     * @param $inputChannel
     * @param $outputChannel
     *
     * @return
     */
    public function __construct($eventName, \PEIP\INF\Channel\Channel $inputChannel, \PEIP\INF\Channel\Channel $outputChannel)
    {
        $this->setEventName($eventName);
        $this->setInputChannel($inputChannel);
        $this->setOutputChannel($outputChannel);
    }
}
