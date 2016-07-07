<?php

namespace PEIP\INF\Transformer;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface Transformer
{
    public function transform(\PEIP\INF\Message\Message $message);
}
