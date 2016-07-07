<?php

namespace PEIP\ABS\Base;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP\ABS\Base\Connectable.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
abstract class Connectable implements \PEIP\INF\Event\Connectable
{
    const
        DEFAULT_CLASS_MESSAGE_DISPATCHER = '\PEIP\Dispatcher\Dispatcher',
        DEFAULT_CLASS_EVENT_DISPATCHER = '\PEIP\Dispatcher\ObjectEventDispatcher',
        DEFAULT_EVENT_CLASS = '\PEIP\Event\Event',
        EVENT_CONNECT = 'connect',
        EVENT_DISCONNECT = 'disconnect',
        EVENT_SET_EVENT_DISPATCHER = 'setEventDispatcher',
        HEADER_DISPATCHER = 'DISPATCHER',
        HEADER_LISTENER = 'LISTENER',
        HEADER_EVENT = 'EVENT';

    protected static $sharedEventDispatcher;

    protected $eventDispatcher;

    /**
     * @param $name
     * @param callable|PEIP\INF\Handler\Handler $listener
     *
     * @return
     */
    public function connect($name, $listener)
    {
        \PEIP\Util\Test::ensureHandler($listener);
        $this->getEventDispatcher()->connect($name, $this, $listener);
        $this->doFireEvent(
            self::EVENT_CONNECT,
            [
                self::HEADER_EVENT    => $name,
                self::HEADER_LISTENER => $listener,
            ]
        );
    }

    /**
     * @param $name
     * @param callable|PEIP\INF\Handler\Handler $listener
     *
     * @return
     */
    public function disconnect($name, $listener)
    {
        \PEIP\Util\Test::ensureHandler($listener);
        $this->getEventDispatcher()->disconnect($name, $this, $listener);
        $this->doFireEvent(
            self::EVENT_DISCONNECT,
            [
                self::HEADER_EVENT    => $name,
                self::HEADER_LISTENER => $listener,
            ],
            false,
            ''

        );
    }

    /**
     * @param $name
     *
     * @return
     */
    public function hasListeners($name)
    {
        return $this->getEventDispatcher()->hasListeners($name, $this);
    }

    /**
     * @param $name
     *
     * @return
     */
    public function getListeners($name)
    {
        return $this->getEventDispatcher()->getListeners($name, $this);
    }

    /**
     * @param $eventName
     * @param $callable
     *
     * @return
     */
    public function disconnectAll($name)
    {
        $this->getEventDispatcher()->disconnectAll($name, $this);
    }

    /**
     * @param $dispatcher
     * @param $transferListners
     *
     * @return
     */
    public function setEventDispatcher(\PEIP\Dispatcher\ObjectEventDispatcher $dispatcher, $transferListners = true)
    {
        if ($transferListners) {
            foreach ($this->getEventDispatcher()->getEventNames($this) as $name) {
                if ($this->getEventDispatcher()->hasListeners($name, $this)) {
                    foreach ($this->getEventDispatcher()->getListeners($name, $this) as $listener) {
                        $dispatcher->connect($name, $this, $listener);
                    }
                }
            }
        }
        $this->eventDispatcher = $dispatcher;
        $this->doFireEvent(self::EVENT_SET_EVENT_DISPATCHER, [self::HEADER_DISPATCHER => $dispatcher]);
    }

    /**
     * @return
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher ? $this->eventDispatcher : $this->eventDispatcher = self::getSharedEventDispatcher();
    }

    protected static function getSharedEventDispatcher()
    {
        $defaultDispatcher = self::DEFAULT_CLASS_EVENT_DISPATCHER;

        return self::$sharedEventDispatcher ? self::$sharedEventDispatcher : self::$sharedEventDispatcher = new $defaultDispatcher();
    }

    /**
     * @param $name
     * @param $headers
     * @param $eventClass
     *
     * @return
     */
    protected function doFireEvent($name, array $headers = [], $eventClass = '', $type = false)
    {
        $eventClass = trim($eventClass) == '' ? static::DEFAULT_EVENT_CLASS : $eventClass;

        return $this->getEventDispatcher()->buildAndNotify($name, $this, $headers, $eventClass, $type);
    }

    protected static function getDefaultEventClass()
    {
        return self::DEFAULT_EVENT_CLASS;
    }
}
