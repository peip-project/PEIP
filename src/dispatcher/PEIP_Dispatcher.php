<?php

/*
 * This file is part of the PEIP package.
 * (c) 2010 Timo Michna <timomichna/yahoo.de>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP_Dispatcher 
 * Basic dispatcher implementation 
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP 
 * @subpackage dispatcher 
 * @extends PEIP_ABS_Dispatcher
 * @implements PEIP_INF_Dispatcher
 */

class PEIP_Dispatcher 
    extends PEIP_ABS_Dispatcher 
    implements PEIP_INF_Dispatcher {

    protected $listeners = array();
     
    /**
     * Connects a listener.
     * 
     * @access public
     * @param Callable|PEIP_INF_Handler  $listener
     * @return void
     */
    public function connect($listener){
        PEIP_Test::ensureHandler($listener);
    	$this->listeners[] = $listener;
  	}
 
    /**
     * Disconnects a listener.
     * 
     * @access public
     * @param Callable|PEIP_INF_Handler $listener
     * @return void
     */
    public function disconnect($listener){
        PEIP_Test::ensureHandler($listener);
    	foreach ($this->listeners as $i => $callable){
      		if ($listener === $callable){
        		unset($this->listeners[$i]);
      		}
    	}
  	}
  
    /**
     * returns wether any listeners are registered
     * 
     * @access public
     * @return boolean wether any listeners are registered
     */
    public function hasListeners(){
    	return (boolean) count($this->listeners);
  	}
    
    /**
     * notifies all listeners on a subject
     * 
     * @access public
     * @param mixed $subject the subject
     * @return void
     */
    public function notify($subject){
        $res = NULL;
        if($this->hasListeners()){
            $res = self::doNotify($this->getListeners(), $subject); 
        }   
        return $res;      
    }
    
    /**
     * notifies all listeners on a subject until one returns a boolean true value
     * 
     * @access public
     * @param mixed $subject the subject 
     * @return PEIP_INF_Handler the listener which returned a boolean true value
     */
    public function notifyUntil($subject){
        if($this->hasListeners()){
            $res = self::doNotifyUntil($this->getListeners(), $subject);    
        }
        return $res;
  	}
  
    /**
     * returns all listeners
     * 
     * @access public
     * @return array the listeners
     */
    public function getListeners(){
    	return $this->listeners;
  	}

}
