<?php

namespace PEIP\Base;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Sealer
 * Class to act as a implementation of the Selaer/Usealer pattern.
 * Used to give a reference to an arbitrary value without referencing the value itself.
 * By sealing an value the sealer will return a 'box'-object, which can later be used
 * to receive the sealed value. By passing an arbitrary object as second argument to the
 * 'seal' method, any object can act as the 'box' for the sealed value.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Base\Sealer, \PEIP\INF\Base\Unsealer
 */

// PHP5.3


class Sealer implements \PEIP\INF\Base\Sealer, \PEIP\INF\Base\Unsealer
{
    protected $store;

    /**
     * constructor.
     *
     * @param ObjectStorage $store an instane of ObjectStorage to act as the internal object-store
     *
     * @return
     */
    public function __construct(\SplObjectStorage $store = null)
    {
        $this->store = (bool) $store ? $store : new ObjectStorage();
    }

    /**
     * Seals a given value and returns a 'box' object as reference.
     * If method is called with an object instance as second argument,
     * the given object is used as the box. Otherwise a simple stdClass object
     * will be created as the 'box'.
     *
     * @param mixed  $value the value to seal.
     * @param object $box   an object to act as the 'box'
     *
     * @return object the 'box' for the sealed value
     */
    public function seal($value, $box = false)
    {
        $box = (bool) $box ? $box : new \stdClass();
        $this->store[$box] = $value;

        return $box;
    }

    /**
     * Unseals and returns a value refernced by the given box-object.
     *
     * @param object $box the box-object to return the value for.
     *
     * @return
     */
    public function unseal($box)
    {
        return $this->store[$box];
    }
}
