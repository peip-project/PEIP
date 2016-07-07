<?php

namespace PEIP\Dispatcher;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Description of ClassEventDispatcher
 *
 * @author timo
 */
use PEIP\Event\EventBuilder;
use PEIP\Util\Reflection;

class ClassEventDispatcher extends \PEIP\Dispatcher\ObjectEventDispatcher
{
    /**
     * connects a Handler to an event on an object.
     *
     * @param string                            $name     the event-name
     * @param object                            $object   arbitrary object to connect to
     * @param callable|PEIP\INF\Handler\Handler $listener event-handler
     *
     * @return bool
     */
    public function connect($name, $object, $listener)
    {
        $class = is_object($object) ? get_class($object) : (string) $object;
        foreach (Reflection::getImplementedClassesAndInterfaces($object) as $cls) {
            $reflection = Reflection_Pool::getInstance($class);
            parent::connect($name, $reflection, $listener);
        }

        return true;
    }

    public function disconnect($name, $object, $listener)
    {
        $class = is_object($object) ? get_class($object) : (string) $object;
        $res = true;
        foreach (Reflection::getImplementedClassesAndInterfaces($object) as $cls) {
            $reflection = Reflection_Pool::getInstance($class);
            $r = parent::disconnect($name, $reflection, $listener);
            if (!$r) {
                $res = false;
            }
        }

        return $res;
    }

    /**
     * Notifies all listeners of a given event-object.
     *
     * @param string                $name   name of the event
     * @param \PEIP\INF\Event\Event $object an event object
     *
     * @return bool
     */
    public function notify($name, $object)
    {
        if ($object instanceof \PEIP\INF\Event\Event) {
            if (is_object($object->getContent())) {
                return self::doNotify(
                    $this->getListeners(
                        $name,
                        Reflection_Pool::getInstance(
                            $object->getContent()
                        )
                     ),
                     $object
                 );
            } else {
                throw new \InvalidArgumentException('instance of \PEIP\INF\Event\Event must contain subject');
            }
        } else {
            throw new \InvalidArgumentException('object must be instance of \PEIP\INF\Event\Event');
        }
    }

       //put your code here

    /**
     * Creates an event-object with given object as content/subject and notifies
     * all registers listeners of the event.
     *
     * @param string $name       name of the event
     * @param object $object     the subject of the event
     * @param array  $headers    headers of the event-object as key/value pairs
     * @param string $eventClass event-class to create instances from
     *
     * @return
     *
     * @see EventBuilder
     */
    public function buildAndNotify($name, $object, array $headers = [], $eventClass = false, $type = false)
    {
        if (!$this->hasListeners($name, ($object))) {
            return false;
        }

        return $this->notify(
                $name,
                EventBuilder::getInstance($eventClass)->build(
                    $object,
                    $name,
                    $headers,
                    (string) $type
                )
        );
    }

    /**
     * Checks wether an object has a listener for an event.
     *
     * @param string $name   the event-name
     * @param object $object object to check for listeners
     *
     * @return bool
     */
    public function hasListeners($name, $object)
    {
        return parent::hasListeners(
            $name,
            Reflection_Pool::getInstance($object)
        );
    }
}
