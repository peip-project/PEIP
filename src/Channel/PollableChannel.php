<?php

namespace PEIP\Channel;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PollableChannel
 * Basic concete implementation of a pollable channel.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @extends \PEIP\ABS\Channel\Channel
 * @implements \PEIP\INF\Event\Connectable, \PEIP\INF\Channel\Channel, \PEIP\INF\Channel\PollableChannel
 */
class PollableChannel extends \PEIP\ABS\Channel\Channel implements \PEIP\INF\Channel\PollableChannel
{
    const
        EVENT_PRE_RECEIVE = 'pre_receive',
        EVENT_POST_RECEIVE = 'post_receive',
        HEADER_MESSAGE = 'MESSAGE';

    protected $messages = [];

    /**
     * Sends a message on the channel.
     *
     * @param \PEIP\INF\Message\Message $message the message to send
     *
     * @return
     */
    protected function doSend(\PEIP\INF\Message\Message $message)
    {
        $this->messages[] = $message;

        return true;
    }

    /**
     * Receives a message from the channel.
     *
     * @event preReceive
     * @event postReceive
     *
     * @param int $timeout timout for receiving a message
     *
     * @return
     */
    public function receive($timeout = 0)
    {
        $this->doFireEvent(self::EVENT_PRE_RECEIVE);
        $message = null;
        if ($timeout == 0) {
            $message = $this->getMessage();
        } elseif ($timeout < 0) {
            while (!$message = $this->getMessage()) {
            }
        } else {
            $time = time() + $timeout;
            while (($time > time()) && !$message = $this->getMessage()) {
            }
        }
        $this->doFireEvent(
            self::EVENT_PRE_RECEIVE, [
                self::HEADER_MESSAGE => $message,
            ]
        );

        return $message;
    }

    /**
     * Returns a message from top of the message stack.
     *
     * @return \PEIP\INF\Message\Message message from top of the message stack
     */
    protected function getMessage()
    {
        return array_shift($this->messages);
    }

    /**
     * Deletes all messages on the message stack.
     *
     * @return
     */
    public function clear()
    {
        $this->messages = [];
    }

    /**
     * Removes all messages not accepted by a given message-selector from the message-stack.
     *
     * @param \PEIP\INF\Message\Message_Selector $selector the selector to accept messages
     *
     * @return array accepted messages
     */
    public function purge(\PEIP\INF\Selector\MessageSelector $selector)
    {
        foreach ($this->messages as $key => $message) {
            if (!$selector->acceptMessage($message)) {
                unset($this->messages[$key]);
            }
        }

        return $this->messages;
    }
}
