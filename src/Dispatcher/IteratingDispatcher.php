<?php

namespace PEIP\Dispatcher;

namespace PEIP\Dispatcher;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * IteratingDispatcher
 * Dispatcher implementation which notifies only one listener at a time
 * by iterating over registered listeners.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP
 * @subpackage dispatcher
 * @implements \PEIP\INF\Dispatcher\Dispatcher
 */

use PEIP\Util\Test;

class IteratingDispatcher extends \PEIP\ABS\Dispatcher\Dispatcher implements
        \PEIP\INF\Dispatcher\Dispatcher,
        \PEIP\INF\Base\Plugable
{
    protected $listeners;

    /**
     * constructor.
     *
     * @param mixed array|ArrayAccess array with values to iterate over
     *
     * @return
     */
    public function __construct($array = [])
    {
        $this->init($array);
    }

    protected function init($array = [])
    {
        $array = Test::assertArrayAccess($array)
            ? $array
            : [];
        $this->listeners = new \ArrayIterator($array);
    }

    /**
     * Registers a listener.
     *
     * @param mixed $listener the listener to register
     *
     * @return
     */
    public function connect($listener)
    {
        $this->listeners[] = $listener;
    }

    /**
     * Unregisters a listener.
     *
     * @param mixed $listener the listener to unregister
     *
     * @return
     */
    public function disconnect($listener)
    {
        foreach ($this->listeners as $i => $callable) {
            if ($listener === $callable) {
                unset($this->listeners[$i]);
            }
        }
    }

    /**
     * Unregisters all listeners.
     *
     * @return
     */
    public function disconnectAll()
    {
        $this->init();
    }

    /**
     * Check wether any listener is registered.
     *
     * @return bool wether any listener is registered
     */
    public function hasListeners()
    {
        return (bool) $this->listeners->count();
    }

    /**
     * Notifies one listener about a subject.
     * Iterates to the next registered listener any time method
     * is called - Rewinds if end is reached.
     *
     * @param mixed $subject the subject to notify about
     *
     * @return
     */
    public function notify($subject)
    {
        $res = null;
        if ($this->hasListeners()) {
            if (!$this->listeners->valid()) {
                $this->listeners->rewind();
            }
            $res = self::doNotifyOne($this->listeners->current(), $subject);
            $this->listeners->next();
        }

        return $res;
    }

    /**
     * Returns all registered listeners of the dispatcher.
     *
     * @return array registered listeners
     */
    public function getListeners()
    {
        return $this->listeners->getArrayCopy();
    }
}
