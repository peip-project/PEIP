<?php

namespace PEIP\INF\Base;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * \PEIP\INF\Base\Visitor.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
interface Visitor
{
    public function visit(\PEIP\INF\Base\Visitable $visitable);
}
