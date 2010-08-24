<?php

/*
 * This file is part of the PEIP package.
 * (c) 2010 Timo Michna <timomichna/yahoo.de>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP_ABS_Content_Transformer
 * Abstract base class for content-transformers. 
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP 
 * @subpackage transformer 
 * @extends PEIP_Pipe
 * @implements PEIP_INF_Transformer, PEIP_INF_Connectable, PEIP_INF_Subscribable_Channel, PEIP_INF_Channel, PEIP_INF_Handler, PEIP_INF_Message_Builder
 */


abstract class PEIP_ABS_Content_Transformer 
    extends PEIP_ABS_Transformer {
  
    /**
     * Transforms a message 
     * 
     * @abstract
     * @access protected
     * @param PEIP_INF_Message $message 
     * @return mixed result of transforming the message payload/content 
     */
    protected function doTransform(PEIP_INF_Message $message){
    	return $this->transformContent($message->getContent());    
    }

    /**
     * Transforms message-content 
     * 
     * @abstract
     * @access protected
     * @param mixed $content content/payload of message 
     * @return mixed result of transforming the message payload/content 
     */
    abstract protected function transformContent($content); 

}
