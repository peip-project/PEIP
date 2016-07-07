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
 * FlyAdapter.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
class FlyAdapter
{
    /**
     * @param $methodMap
     *
     * @return
     */
    public function __construct(ArrayAccess $methodMap)
    {
        $this->methodMap = $methodMap;
    }

    /**
     * @param $subject
     *
     * @return
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param $method
     * @param $arguments
     *
     * @return
     */
    public function __call($method, $arguments)
    {
        if (array_key_exists($method, $this->methodMap)) {
            return call_user_func_array([$this->subject, $this->methodMap[$method]], $arguments);
        }
    }
}
