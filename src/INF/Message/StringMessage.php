<?php

namespace PEIP\INF\Message;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Message\StringMessage.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Message\Message, \PEIP\INF\Base\Container
 */
interface StringMessage extends \PEIP\INF\Message\Message
{
    public function __toString();
}
