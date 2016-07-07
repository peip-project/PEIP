<?php

namespace PEIP\Event;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Observable.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Event\Observable
 */
class Observable implements \PEIP\INF\Event\Observable
{
    protected $observedObject;

    protected $observers = [];

    protected $hasChanged = false;


    /**
     * @param $observedObject
     *
     * @return
     */
    public function __construct(object $observedObject)
    {
        $this->observedObject = $observedObject;
    }

    /**
     * @param $observer
     *
     * @return
     */
    public function addObserver(\PEIP\INF\Event\Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param $observer
     *
     * @return
     */
    public function deleteObserver(\PEIP\INF\Event\Observer $observer)
    {
        foreach ($this->observers as $key => $obs) {
            if ($obs == $observer) {
                unset($this->observers[$key]);

                return true;
            }
        }
    }

    /**
     * @param $arguments
     *
     * @return
     */
    public function notifyObservers(array $arguments = [])
    {
        if ($this->hasChanged()) {
            foreach ($this->observers as $observer) {
                $observer->update($this->observedObject);
            }
        }
    }

    /**
     * @return
     */
    public function countObservers()
    {
        return count($this->obeservers);
    }

    /**
     * @return
     */
    public function hasChanged()
    {
        return $this->hasChanged();
    }

    /**
     * @return
     */
    public function setChanged()
    {
        $this->hasChanged = true;
    }

    /**
     * @return
     */
    public function clearChanged()
    {
        $this->hasChanged = true;
    }
}
