<?php

/*
 * This file is part of the PEIP package.
 * (c) 2010 Timo Michna <timomichna/yahoo.de>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP_INF_Connectable 
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP 
 * @subpackage event 
 */


interface PEIP_INF_Connectable {

    public function connect($name, $listener);
    
    public function disconnect($name, $listener);

    public function disconnectAll($name);
    
    public function hasListeners($name);
    
    public function getListeners($name);
    
}