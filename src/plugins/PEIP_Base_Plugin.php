<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PEIP_Base_Plugin
 *
 * @author timo
 */
class PEIP_Base_Plugin extends PEIP_ABS_Context_Plugin {

    


    protected $builders = array(
        'include' => 'createContext',
        'plugin' => 'createPlugin',
        'channel' => 'createChannel',
        'publish_subscribe_channel' => 'createSubscribableChannel',
        'service_activator' => 'createServiceActivator',
        'gateway' => 'createGateway',
        'splitter' => 'createSplitter',
        'transformer' => 'createTransformer',
        'router' => 'createRouter',
        'aggregator' => 'createAggregator',
        'wiretap' => 'createWiretap'
    );


    /**
     * Creates a pollable channel from a configuration object.
     *
     * @see PEIP_XML_Context::doCreateChannel
     * @access public
     * @param object $config configuration object for the pollable channel.
     * @return PEIP_INF_Channel the created pollable channel instance
     */
    public function createChannel($config){
        return $this->doCreateChannel($config, 'PEIP_Pollable_Channel');
    }

    /**
     * Creates a subscribable channel from a configuration object.
     *
     * @see PEIP_XML_Context::doCreateChannel
     * @access public
     * @param object $config configuration object for the subscribable channel.
     * @return PEIP_INF_Channel the created subscribable channel instance
     */
    public function createSubscribableChannel($config){
        return $this->doCreateChannel($config, 'PEIP_Publish_Subscribe_Channel');
    }

    /**
     * Creates and registers arbitrary channel from a configuration object and additional information.
     *
     * @access public
     * @param object $config configuration object for the channel.
     * @param string $defaultChannelClass the channel class to use if none is set in config
     * @param $additionalArguments additional arguments for the channel constructor (without first arg = id)
     * @return PEIP_INF_Channel the created channel instance
     */
    public function doCreateChannel($config, $defaultChannelClass, array $additionalArguments = array()){
        $id = (string)$config['id'];
        if($id != ''){
            array_unshift($additionalArguments, $id);
            $channel = $this->buildAndModify($config, $additionalArguments, $defaultChannelClass);
            //$this->channelRegistry->register($channel);
           
            return $channel;
        }
    }

    /**
     * Creates and registers gateway from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @access public
     * @param object $config configuration object for the gateway.
     * @param string $defaultClass the class to use if none is set in config.
     * @return object the gateway instance
     */
    public function createGateway($config, $defaultClass = false){
        $args = array(
            $this->getRequestChannel($config),
            $this->getReplyChannel($config)
        );
        $defaultClass = $defaultClass ? $defaultClass : 'PEIP_Simple_Messaging_Gateway';
        $gateway = $this->buildAndModify($config, $args, $defaultClass);
        $id = (string)$config["id"];
        $this->gateways[$id] = $gateway;
        return $gateway;
    }

    /**
     * Creates and registers router from a configuration object.
     * Adds this context instance as channel-resolver to the router if
     * none is set in config.
     *
     * @see PEIP_XML_Context::resolveChannelName
     * @see PEIP_XML_Context::initNodeBuilders
     * @access public
     * @param object $config configuration object for the gateway.
     * @param string $defaultClass the class to use if none is set in config.
     * @return object the router instance
     */
    public function createRouter($config, $defaultClass = false){
        $resolver = $config['channel_resolver'] ? (string)$config['channel_resolver'] : $this->channelRegistry;
        return $this->buildAndModify($config, array(
            $resolver,
            $this->doGetChannel('input', $config)
        ), $defaultClass);
    }

    /**
     * Creates and registers splitter from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @see PEIP_XML_Context::createReplyMessageHandler
     * @access public
     * @param object $config configuration object for the splitter.
     * @return object the splitter instance
     */
    public function createSplitter($config){
        return $this->createReplyMessageHandler($config);
    }

    /**
     * Creates and registers transformer from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @see PEIP_XML_Context::createReplyMessageHandler
     * @access public
     * @param object $config configuration object for the transformer.
     * @return object the transformer instance
     */
    public function createTransformer($config){
        return $this->createReplyMessageHandler($config);
    }

    /**
     * Creates aggregator from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @see PEIP_XML_Context::createReplyMessageHandler
     * @access public
     * @param object $config configuration object for the aggregator.
     * @return object the aggregator instance
     */
    public function createAggregator($config){
        return $this->createReplyMessageHandler($config);
    }

    /**
     * Creates wiretap from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @see PEIP_XML_Context::createReplyMessageHandler
     * @access public
     * @param object $config configuration object for the wiretap.
     * @return object the wiretap instance
     */
    public function createWiretap($config){
        return $this->createReplyMessageHandler($config, 'PEIP_Wiretap');
    }

    /**
     * Creates a reply-message-handler from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @access public
     * @param object $config configuration object for the reply-message-handler.
     * @param string $defaultClass the class to use if none is set in config.
     * @return object the reply-message-handler instance
     */
    public function createReplyMessageHandler($config, $defaultClass = false){
        return $this->buildAndModify($config, $this->getReplyHandlerArguments($config), $defaultClass);
    }

    /**
     * Creates and registers service-activator from a configuration object.
     *
     * @see PEIP_XML_Context::initNodeBuilders
     * @access public
     * @param object $config configuration object for the service-activator.
     * @param string $defaultClass the class to use if none is set in config.
     * @return object the service-activator instance
     */
    public function createServiceActivator($config, $defaultClass = false){
        $method = (string)$config['method'];
        $service = $this->context->getServiceProvider()->provideService((string)$config['ref']);
        if($method && $service){
            $args = $this->getReplyHandlerArguments($config);
            array_unshift($args,array(
                $service,
                $method
            ));
            $defaultClass = $defaultClass ? $defaultClass : 'PEIP_Service_Activator';
            return $this->buildAndModify($config, $args, $defaultClass);
        }
    }


    /**
     * Utility method to create arguments for a reply-handler constructor from a config-obect.
     *
     * @access protected
     * @param object $config configuration object to create arguments from.
     * @return mixed build arguments
     */
    protected function getReplyHandlerArguments($config){
        $args = array(
            $this->doGetChannel('input', $config),
            $this->doGetChannel('output', $config)
        );
        if($args[0] == NULL){
            throw new RuntimeException('Could not receive input channel.');
        }
        return $args;
    }


    /**
     * Utility method to return a request-channel from a config-obect.
     *
     * @see PEIP_XML_Context::doGetChannel
     * @access protected
     * @param object $config configuration object to return request-channel from.
     * @return PEIP_INF_Channel request-channel
     */
    protected function getRequestChannel($config){
        return $this->doGetChannel('request', $config);
    }


    /**
     * Utility method to return a reply-channel from a config-obect.
     *
     * @see PEIP_XML_Context::doGetChannel
     * @access protected
     * @param object $config configuration object to return reply-channel from.
     * @return PEIP_INF_Channel reply-channel
     */
    protected function getReplyChannel($config){
        return $this->doGetChannel('reply', $config);
    }


    /**
     * Utility method to return a certainn channel from a config-obect.
     *
     * @access protected
     * @param string the configuration type ofthe channel (e.g.: 'reply', 'request')
     * @param object $config configuration object to return channel from.
     * @return PEIP_INF_Channel reply-channel
     */
    public function doGetChannel($type, $config){
        $channelName = $config[$type."_channel"]
            ? $config[$type."_channel"]
            : $config["default_".$type."_channel"];
        return $this->context->getServiceProvider()->provideService(trim((string)$channelName));
        $channel =  $this->services[trim((string)$channelName)];
        if($channel instanceof PEIP_INF_Channel){
            return $channel;
        }else{
            return NULL;
        }
    }

    
}

