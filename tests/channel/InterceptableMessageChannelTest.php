<?php
require_once dirname(__FILE__).'/../../misc/bootstrap.php';

PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/InterceptableMessageChannel.php');
PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/MessageChannelInterceptor.php');

class InterceptableMessageChannelTest extends PHPUnit_Framework_TestCase {

	
	public function setUp(){
		$this->channel = new InterceptableMessageChannel('TestChannel');
                $dispatcher = new PEIP_Object_Event_Dispatcher;
		$this->channel->setEventDispatcher($dispatcher, false);
       }
	
	public function testMessageChannelInterceptor(){
		$interceptor = new MessageChannelInterceptor(1);
		$message = new PEIP_Generic_Message(321);
		$interceptor->postSend($message, $this->channel, true);
		$this->assertEquals($message, $interceptor->message);
	}
	
	public function testGetName(){
		$this->assertEquals('TestChannel', $this->channel->getName());
	}	
	
	public function testSetInterceptorDispatcher(){
		$dispatcher = new PEIP_Interceptor_Dispatcher();
		$this->channel->setInterceptorDispatcher($dispatcher);
		$this->assertEquals($dispatcher, $this->channel->getInterceptorDispatcher());
	}

	public function testAddInterceptor(){
		$channel = $this->channel;
		$iterceptor = new MessageChannelInterceptor;
		$channel->addInterceptor($iterceptor);
		$this->assertEquals(array($iterceptor), $channel->getInterceptors());
		$channel->addInterceptor($iterceptor);
		$this->assertEquals(array($iterceptor), $channel->getInterceptors());
		$iterceptor2 = new MessageChannelInterceptor;
		$channel->addInterceptor($iterceptor2);
		$this->assertEquals(array($iterceptor, $iterceptor2), $channel->getInterceptors());		
	}
	
	public function testSetInterceptors(){
		$channel = $this->channel;
		$iterceptor1 = new MessageChannelInterceptor(1);
		$iterceptor2 = new MessageChannelInterceptor(2);
		$channel->setInterceptors(array($iterceptor1, $iterceptor2));
		$this->assertEquals(array($iterceptor1, $iterceptor2), $channel->getInterceptors());		
		$iterceptor3 = new MessageChannelInterceptor(3);
		$iterceptor4 = new MessageChannelInterceptor(4);
		$channel->setInterceptors(array($iterceptor3, $iterceptor4));
		$this->assertEquals(array($iterceptor3, $iterceptor4), $channel->getInterceptors());
		$this->assertNotEquals(array($iterceptor1, $iterceptor2), $channel->getInterceptors());
	}	
	
	public function testDeleteInterceptors(){
		$channel = $this->channel;
		$iterceptor1 = new MessageChannelInterceptor(1);
		$iterceptor2 = new MessageChannelInterceptor(2);
		$channel->setInterceptors(array($iterceptor1, $iterceptor2));
		$this->assertEquals(array($iterceptor1, $iterceptor2), $channel->getInterceptors());
		$channel->clearInterceptors();		
		$iterceptor3 = new MessageChannelInterceptor(3);
		$this->assertEquals(array(), $channel->getInterceptors());
	}	
	
	public function testSend(){
		$iterceptor1 = new MessageChannelInterceptor(1);
		$this->channel->addInterceptor($iterceptor1);
		$message = new PEIP_Generic_Message(321);	
		$this->channel->send($message);
                $this->assertEquals($message, $iterceptor1->message);
	}

	public function testConnect(){
		$this->assertFalse($this->channel->hasListeners('preSend'));
		$handler = new PEIP_Callable_Handler(array('TestClass','TestMethod'));
		$this->channel->connect('preSend', $handler);
		$this->assertTrue($this->channel->hasListeners('preSend'));
                $this->channel->disconnect('preSend', $handler);
	}

	public function testDisconnect(){
		$handler = new PEIP_Callable_Handler(array('TestClass','TestMethod'));
		$this->channel->connect('preSend', $handler);
		$this->assertTrue($this->channel->hasListeners('preSend'));	
		$this->channel->disconnect('preSend', $handler);
		$this->assertFalse($this->channel->hasListeners('preSend'));	
	}	

	public function testFireEvent(){
		$interceptor = new MessageChannelInterceptor(1);
		$message = new PEIP_Generic_Message(321);
                $handler = new PEIP_Callable_Handler(array($interceptor,'eventCallback'));
                $dispatcher = new PEIP_Object_Event_Dispatcher;
		$this->channel->setEventDispatcher($dispatcher, false);
                $this->channel->connect('preSend', $handler);
                $this->channel->send($message);
		$this->assertEquals($message, $interceptor->message->getHeader('MESSAGE'));
                $this->channel->disconnect('preSend', $handler);
	}

	public function testGetListeners(){
		$handler1 = new PEIP_Callable_Handler(array('TestClass','TestMethod1'));
                $handler2 = new PEIP_Callable_Handler(array('TestClass','TestMethod2'));
		$this->channel->connect('postSend', $handler1);
                $this->channel->connect('postSend', $handler2);
		$this->assertEquals(array($handler1, $handler2), $this->channel->getListeners('postSend'));
	}

	public function testSetEventDispatcher(){
		$dispatcher = new PEIP_Object_Event_Dispatcher;
		$this->channel->setEventDispatcher($dispatcher);
		$this->assertEquals($dispatcher, $this->channel->getEventDispatcher());
	}


	public function testSetEventDispatcherTransferListners(){
                $handler1 = new PEIP_Callable_Handler(array('TestClass','TestMethod1'));
                $handler2 = new PEIP_Callable_Handler(array('TestClass','TestMethod2'));
                $this->channel->connect('test', $handler1);
                $this->channel->connect('test', $handler2);
		$dispatcher = new PEIP_Object_Event_Dispatcher;
		$this->channel->setEventDispatcher($dispatcher, true);
                $this->assertEquals(array($handler1, $handler2), $this->channel->getListeners('test'));
	}


}