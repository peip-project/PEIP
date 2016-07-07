<?php

namespace PEIP\INF\Aggregator;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Aggregator\CorrelationStrategy.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface CorrelationStrategy
{
    public function getCorrelationKey(\PEIP\INF\Message\Message $message);
}
