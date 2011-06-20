<?php

/*
 * This file is part of the PEIP package.
 * (c) 2010 Timo Michna <timomichna/yahoo.de>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * PEIP_Autoload_Paths
 * Wrapper class to hold information of class-paths.
 * Value of PEIP_Autoload_Paths::$paths is created by call
 * of PEIP_Autoload::make().
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @package PEIP 
 * @subpackage autoload 
 */

class PEIP_Autoload_Paths {

	// please, dont�t edit these lines manually
	// use PEIP_Autoload::make() instead
	public static $paths = array (
  'PEIP_ABS_Message_Barrier_Handler' => '/ABS/aggregator/PEIP_ABS_Message_Barrier_Handler.php',
  'PEIP_ABS_Connectable' => '/ABS/base/PEIP_ABS_Connectable.php',
  'PEIP_ABS_Container' => '/ABS/base/PEIP_ABS_Container.php',
  'PEIP_ABS_Mutable_Container' => '/ABS/base/PEIP_ABS_Mutable_Container.php',
  'PEIP_ABS_Connectable_Channel' => '/ABS/channel/PEIP_ABS_Connectable_Channel.php',
  'PEIP_ABS_Channel' => '/ABS/channel/PEIP_ABS_Channel.php',
  'PEIP_ABS_Pollable_Channel' => '/ABS/channel/PEIP_ABS_Pollable_Channel.php',
  'PEIP_ABS_Subscribable_Channel' => '/ABS/channel/PEIP_ABS_Subscribable_Channel.php',
  'PEIP_ABS_Command' => '/ABS/command/PEIP_ABS_Command.php',
  'PEIP_ABS_Context_Plugin' => '/ABS/context/PEIP_ABS_Context_Plugin.php',
  'PEIP_ABS_Dispatcher' => '/ABS/dispatcher/PEIP_ABS_Dispatcher.php',
  'PEIP_ABS_Map_Dispatcher' => '/ABS/dispatcher/PEIP_ABS_Map_Dispatcher.php',
  'PEIP_ABS_Discarding_Message_Handler' => '/ABS/handler/PEIP_ABS_Discarding_Message_Handler.php',
  'PEIP_ABS_Message_Handler' => '/ABS/handler/PEIP_ABS_Message_Handler.php',
  'PEIP_ABS_Reply_Producing_Message_Handler' => '/ABS/handler/PEIP_ABS_Reply_Producing_Message_Handler.php',
  'PEIP_ABS_Event_Pipe' => '/ABS/pipe/PEIP_ABS_Event_Pipe.php',
  'PEIP_ABS_Connection' => '/ABS/request/PEIP_ABS_Connection.php',
  'PEIP_ABS_Request' => '/ABS/request/PEIP_ABS_Request.php',
  'PEIP_ABS_Router' => '/ABS/router/PEIP_ABS_Router.php',
  'PEIP_ABS_Service_Activator' => '/ABS/service/PEIP_ABS_Service_Activator.php',
  'PEIP_ABS_Message_Splitter' => '/ABS/splitter/PEIP_ABS_Message_Splitter.php',
  'PEIP_ABS_Content_Transformer' => '/ABS/transformer/PEIP_ABS_Content_Transformer.php',
  'PEIP_ABS_Transformer' => '/ABS/transformer/PEIP_ABS_Transformer.php',
  'PEIP_Autoload' => '/autoload/PEIP_Autoload.php',
  'PEIP_Autoload_Paths' => '/autoload/PEIP_Autoload_Paths.php',
  'PEIP_Simple_Autoload' => '/autoload/PEIP_Simple_Autoload.php',
  'PEIP_Dynamic_Adapter' => '/base/PEIP_Dynamic_Adapter.php',
  'PEIP_Fly_Adapter' => '/base/PEIP_Fly_Adapter.php',
  'PEIP_Generic_Builder' => '/base/PEIP_Generic_Builder.php',
  'PEIP_Object_Storage' => '/base/PEIP_Object_Storage.php',
  'PEIP_Reflection_Class_Builder' => '/base/PEIP_Reflection_Class_Builder.php',
  'PEIP_Sealer' => '/base/PEIP_Sealer.php',
  'PEIP_Visitable_Array' => '/base/PEIP_Visitable_Array.php',
  'PEIP_Channel_Adapter' => '/channel/PEIP_Channel_Adapter.php',
  'PEIP_Channel_Registry' => '/channel/PEIP_Channel_Registry.php',
  'PEIP_Direct_Channel' => '/channel/PEIP_Direct_Channel.php',
  'PEIP_Message_Channel' => '/channel/PEIP_Message_Channel.php',
  'PEIP_Pollable_Channel' => '/channel/PEIP_Pollable_Channel.php',
  'PEIP_Priority_Channel' => '/channel/PEIP_Priority_Channel.php',
  'PEIP_Publish_Subscribe_Channel' => '/channel/PEIP_Publish_Subscribe_Channel.php',
  'PEIP_Queue_Channel' => '/channel/PEIP_Queue_Channel.php',
  'PEIP_Command' => '/command/PEIP_Command.php',
  'PEIP_XML_Context' => '/context/PEIP_XML_Context.php',
  'PEIP_XML_Context_Reader' => '/context/PEIP_XML_Context_Reader.php',
  'PEIP_Array_Access' => '/data/PEIP_Array_Access.php',
  'PEIP_Internal_Store_Abstract' => '/data/PEIP_Internal_Store_Abstract.php',
  'PEIP_Parameter_Collection' => '/data/PEIP_Parameter_Collection.php',
  'PEIP_Parameter_Holder' => '/data/PEIP_Parameter_Holder.php',
  'PEIP_Parameter_Holder_Collection' => '/data/PEIP_Parameter_Holder_Collection.php',
  'PEIP_Store' => '/data/PEIP_Store.php',
  'PEIP_Store_Collection' => '/data/PEIP_Store_Collection.php',
  'PEIP_Class_Dispatcher' => '/dispatcher/PEIP_Class_Dispatcher.php',
  'PEIP_Class_Event_Dispatcher' => '/dispatcher/PEIP_Class_Event_Dispatcher.php',
  'PEIP_Dispatcher' => '/dispatcher/PEIP_Dispatcher.php',
  'PEIP_Iterating_Dispatcher' => '/dispatcher/PEIP_Iterating_Dispatcher.php',
  'PEIP_Map_Dispatcher' => '/dispatcher/PEIP_Map_Dispatcher.php',
  'PEIP_Object_Event_Dispatcher' => '/dispatcher/PEIP_Object_Event_Dispatcher.php',
  'PEIP_Object_Map_Dispatcher' => '/dispatcher/PEIP_Object_Map_Dispatcher.php',
  'PEIP_Event' => '/event/PEIP_Event.php',
  'PEIP_Event_Builder' => '/event/PEIP_Event_Builder.php',
  'PEIP_Observable' => '/event/PEIP_Observable.php',
  'PEIP_Dedicated_Factory' => '/factory/PEIP_Dedicated_Factory.php',
  'PEIP_Service_Factory' => '/factory/PEIP_Service_Factory.php',
  'PEIP_Simple_Messaging_Gateway' => '/gateway/PEIP_Simple_Messaging_Gateway.php',
  'PEIP_Callable_Handler' => '/handler/PEIP_Callable_Handler.php',
  'PEIP_INF_Completion_Strategy' => '/INF/aggregator/PEIP_INF_Completion_Strategy.php',
  'PEIP_INF_Correlation_Strategy' => '/INF/aggregator/PEIP_INF_Correlation_Strategy.php',
  'PEIP_INF_Buildable' => '/INF/base/PEIP_INF_Buildable.php',
  'PEIP_INF_Container' => '/INF/base/PEIP_INF_Container.php',
  'PEIP_INF_Document' => '/INF/base/PEIP_INF_Document.php',
  'PEIP_INF_Filter' => '/INF/base/PEIP_INF_Filter.php',
  'PEIP_INF_Identifier' => '/INF/base/PEIP_INF_Identifier.php',
  'PEIP_INF_Lifecycle' => '/INF/base/PEIP_INF_Lifecycle.php',
  'PEIP_INF_Mutable_Container' => '/INF/base/PEIP_INF_Mutable_Container.php',
  'PEIP_INF_Sealer' => '/INF/base/PEIP_INF_Sealer.php',
  'PEIP_INF_Singleton' => '/INF/base/PEIP_INF_Singleton.php',
  'PEIP_INF_Singleton_Args' => '/INF/base/PEIP_INF_Singleton_Args.php',
  'PEIP_INF_Singleton_Map' => '/INF/base/PEIP_INF_Singleton_Map.php',
  'PEIP_INF_Singleton_Map_Array' => '/INF/base/PEIP_INF_Singleton_Map_Array.php',
  'PEIP_INF_Unsealer' => '/INF/base/PEIP_INF_Unsealer.php',
  'PEIP_INF_Visitable' => '/INF/base/PEIP_INF_Visitable.php',
  'PEIP_INF_Visitor' => '/INF/base/PEIP_INF_Visitor.php',
  'PEIP_INF_Channel' => '/INF/channel/PEIP_INF_Channel.php',
  'PEIP_INF_Channel_Resolver' => '/INF/channel/PEIP_INF_Channel_Resolver.php',
  'PEIP_INF_Pollable_Channel' => '/INF/channel/PEIP_INF_Pollable_Channel.php',
  'PEIP_INF_Subscribable_Channel' => '/INF/channel/PEIP_INF_Subscribable_Channel.php',
  'PEIP_INF_Command' => '/INF/command/PEIP_INF_Command.php',
  'PEIP_INF_Parametric_Command' => '/INF/command/PEIP_INF_Parametric_Command.php',
  'PEIP_INF_Context' => '/INF/context/PEIP_INF_Context.php',
  'PEIP_INF_Context_Plugin' => '/INF/context/PEIP_INF_Context_Plugin.php',
  'PEIP_INF_Parameter_Holder' => '/INF/data/PEIP_INF_Parameter_Holder.php',
  'PEIP_INF_Parameter_Holder_Collection' => '/INF/data/PEIP_INF_Parameter_Holder_Collection.php',
  'PEIP_INF_Store' => '/INF/data/PEIP_INF_Store.php',
  'PEIP_INF_Store_Collection' => '/INF/data/PEIP_INF_Store_Collection.php',
  'PEIP_INF_Breakable_Dispatcher' => '/INF/dispatcher/PEIP_INF_Breakable_Dispatcher.php',
  'PEIP_INF_Dispatcher' => '/INF/dispatcher/PEIP_INF_Dispatcher.php',
  'PEIP_INF_List_Dispatcher' => '/INF/dispatcher/PEIP_INF_List_Dispatcher.php',
  'PEIP_INF_Map_Dispatcher' => '/INF/dispatcher/PEIP_INF_Map_Dispatcher.php',
  'PEIP_INF_Object_Map_Dispatcher' => '/INF/dispatcher/PEIP_INF_Object_Map_Dispatcher.php',
  'PEIP_INF_Connectable' => '/INF/event/PEIP_INF_Connectable.php',
  'PEIP_INF_Event' => '/INF/event/PEIP_INF_Event.php',
  'PEIP_INF_Event_Dispatcher' => '/INF/event/PEIP_INF_Event_Dispatcher.php',
  'PEIP_INF_Event_Handler' => '/INF/event/PEIP_INF_Event_Handler.php',
  'PEIP_INF_Event_Publisher' => '/INF/event/PEIP_INF_Event_Publisher.php',
  'PEIP_INF_Listener' => '/INF/event/PEIP_INF_Listener.php',
  'PEIP_INF_Observable' => '/INF/event/PEIP_INF_Observable.php',
  'PEIP_INF_Observer' => '/INF/event/PEIP_INF_Observer.php',
  'PEIP_INF_Dedicated_Factory' => '/INF/factory/PEIP_INF_Dedicated_Factory.php',
  'PEIP_INF_Messaging_Gateway' => '/INF/gateway/PEIP_INF_Messaging_Gateway.php',
  'PEIP_INF_Handler' => '/INF/handler/PEIP_INF_Handler.php',
  'PEIP_INF_Message_Handler' => '/INF/message/PEIP_INF_Message_Handler.php',
  'PEIP_INF_Envelope_Message' => '/INF/message/PEIP_INF_Envelope_Message.php',
  'PEIP_INF_Header_Enricher' => '/INF/message/PEIP_INF_Header_Enricher.php',
  'PEIP_INF_Intercabtable_Message_Channel' => '/INF/message/PEIP_INF_Intercabtable_Message_Channel.php',
  'PEIP_INF_Message' => '/INF/message/PEIP_INF_Message.php',
  'PEIP_INF_Message_Builder' => '/INF/message/PEIP_INF_Message_Builder.php',
  'PEIP_INF_Message_Channel' => '/INF/message/PEIP_INF_Message_Channel.php',
  'PEIP_INF_Message_Dispatcher' => '/INF/message/PEIP_INF_Message_Dispatcher.php',
  'PEIP_INF_Message_Receiver' => '/INF/message/PEIP_INF_Message_Receiver.php',
  'PEIP_INF_Message_Selector' => '/INF/selector/PEIP_INF_Message_Selector.php',
  'PEIP_INF_Message_Sender' => '/INF/message/PEIP_INF_Message_Sender.php',
  'PEIP_INF_Message_Source' => '/INF/message/PEIP_INF_Message_Source.php',
  'PEIP_INF_Pollable_Message_Channel' => '/INF/message/PEIP_INF_Pollable_Message_Channel.php',
  'PEIP_INF_String_Message' => '/INF/message/PEIP_INF_String_Message.php',
  'PEIP_INF_Connection' => '/INF/request/PEIP_INF_Connection.php',
  'PEIP_INF_Request' => '/INF/request/PEIP_INF_Request.php',
  'PEIP_INF_Service_Activator' => '/INF/service/PEIP_INF_Service_Activator.php',
  'PEIP_INF_Service_Container' => '/INF/service/PEIP_INF_Service_Container.php',
  'PEIP_INF_Transformer' => '/INF/transformer/PEIP_INF_Transformer.php',
  'PEIP_Wiretap' => '/listener/PEIP_Wiretap.php',
  'PEIP_Callable_Message_Handler' => '/message/PEIP_Callable_Message_Handler.php',
  'PEIP_Command_Message' => '/message/PEIP_Command_Message.php',
  'PEIP_Error_Message' => '/message/PEIP_Error_Message.php',
  'PEIP_Generic_Message' => '/message/PEIP_Generic_Message.php',
  'PEIP_Message_Builder' => '/message/PEIP_Message_Builder.php',
  'PEIP_String_Message' => '/message/PEIP_String_Message.php',
  'PEIP_Text_Message' => '/message/PEIP_Text_Message.php',
  'PEIP' => '/PEIP.php',
  'PEIP_Command_Pipe' => '/pipe/PEIP_Command_Pipe.php',
  'PEIP_Event_Pipe' => '/pipe/PEIP_Event_Pipe.php',
  'PEIP_Fixed_Event_Pipe' => '/pipe/PEIP_Fixed_Event_Pipe.php',
  'PEIP_Pipe' => '/pipe/PEIP_Pipe.php',
  'PEIP_Simple_Event_Pipe' => '/pipe/PEIP_Simple_Event_Pipe.php',
  'PEIP_Simple_Fixed_Event_Pipe' => '/pipe/PEIP_Simple_Fixed_Event_Pipe.php',
  'PEIP_Base_Plugin' => '/plugins/PEIP_Base_Plugin.php',
  'PEIP_Content_Class_Selector' => '/selector/PEIP_Content_Class_Selector.php',
  'PEIP_Content_Type_Selector' => '/selector/PEIP_Content_Type_Selector.php',
  'PEIP_Header_Service_Activator' => '/service/PEIP_Header_Service_Activator.php',
  'PEIP_Service_Activator' => '/service/PEIP_Service_Activator.php',
  'PEIP_Service_Container' => '/service/PEIP_Service_Container.php',
  'PEIP_Service_Container_Builder' => '/service/PEIP_Service_Container_Builder.php',
  'PEIP_Service_Provider' => '/service/PEIP_Service_Provider.php',
  'PEIP_Splitting_Service_Activator' => '/service/PEIP_Splitting_Service_Activator.php',
  'PEIP_String_Service_Activator' => '/service/PEIP_String_Service_Activator.php',
  'PEIP_Reflection' => '/util/PEIP_Reflection.php',
  'PEIP_Reflection_Pool' => '/util/PEIP_Reflection_Pool.php',
  'PEIP_Test' => '/util/PEIP_Test.php',
);
	
}
