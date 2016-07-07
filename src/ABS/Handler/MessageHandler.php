<?php

namespace PEIP\ABS\Handler;

namespace PEIP\ABS\Handler;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * PEIP\ABS\Handler\MessageHandler
 * Base class for all message handling classes.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP
 * @subpackage handler
 * @implements \PEIP\INF\Handler\Handler
 */

use PEIP\Pipe\Pipe;

abstract class MessageHandler extends \PEIP\ABS\Base\Connectable implements \PEIP\INF\Handler\Handler
{
    protected $inputChannel,
        $unwrapEvents = false;

    /**
     * Handles a message. Delegates the handling of the message to
     * abstract 'doHandle' method which must be implemented by extending classes.
     *
     * @see PEIP\ABS\Handler\MessageHandler::doHandle
     * @implements \PEIP\INF\Handler\Handler
     *
     * @param object $message the message to handle
     *
     * @return
     */
    public function handle($message)
    {
        $this->doHandle($this->getMessageFromObject($message));
    }

    /**
     * Sets the input channel for the message handler.
     * Delegates connecting of input-channel to protected method 'doSetInputChannel',
     * which can be overwritten by extending classes.
     *
     * @see PEIP\ABS\Handler\MessageHandler::doSetInputChannel
     *
     * @param \PEIP\INF\Channel\Channel $inputChannel the input-channel
     *
     * @return PEIP\ABS\Handler\MessageHandler $this;
     */
    public function setInputChannel(\PEIP\INF\Channel\Channel $inputChannel)
    {
        $this->doSetInputChannel($inputChannel);

        return $this;
    }

    /**
     * Connects the handler to the input channel.
     * When input-channel is instance of \PEIP\INF\Channel\SubscribableChannel,
     * the handler subscribes to the channel.
     * When input-channel is instance of \PEIP\INF\Channel\PollableChannel, the
     * handler listens to the 'preSend' event of the channel and receives
     * a message, when the event occures.
     *
     * @param \PEIP\INF\Channel\Channel $inputChannel the input-channel to connect the handler to
     *
     * @return
     */
    protected function doSetInputChannel(\PEIP\INF\Channel\Channel $inputChannel)
    {
        $this->inputChannel = $inputChannel;
        if ($this->inputChannel instanceof \PEIP\INF\Channel\SubscribableChannel) {
            $this->inputChannel->subscribe($this);
        } else {
            $this->unwrapEvents = true;
            $this->inputChannel->connect('postSend', $this);
        }
    }

    protected function getMessageFromObject($object)
    {
        $content = $object->getContent();
        if ($this->unwrapEvents
            && $object instanceof \PEIP\INF\Event\Event
            && $object->getName() == 'postSend'
            && $object->hasHeader(Pipe::HEADER_MESSAGE)
            && $content instanceof \PEIP\INF\Channel\PollableChannel
         ) {
            $object = $content->receive();
        }
        if (!($object instanceof \PEIP\INF\Message\Message)) {
            throw new \Exception('Could not retrieve Message from Message-Argument'.print_r($object, 1));
        }

        return $object;
    }

    /**
     * Returns the input-channel for this handler.
     *
     * @return \PEIP\INF\Channel\Channel input-channel for this handler
     */
    public function getInputChannel()
    {
        return $this->inputChannel;
    }

    /**
     * Does the message handling logic for the handler.
     * Must be implemented by extending classes.
     *
     * @abstract
     *
     * @param \PEIP\INF\Message\Message $message the message to handle
     */
    abstract protected function doHandle(\PEIP\INF\Message\Message $message);
}
