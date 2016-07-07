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
 * PEIP\ABS\Base\Container
 * Basic abstract container class.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Base\Container
 */
abstract class Container implements \PEIP\INF\Base\Container
{
    protected $content;

    /**
     * Returns the content of the container.
     *
     * @implements \PEIP\INF\Base\Container
     *
     * @return
     */
    public function getContent()
    {
        return $this->content;
    }
}
