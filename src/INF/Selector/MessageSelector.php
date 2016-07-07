<?php

namespace PEIP\INF\Selector;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Selector\MessageSelector.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface MessageSelector
{
    public function acceptMessage(\PEIP\INF\Message\Message $message);
}
