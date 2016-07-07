<?php


require_once dirname(__FILE__).'/../../misc/bootstrap.php';

PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/ServiceContainerTest.php');
PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/HelloService.php');
PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/HelloServiceHandler.php');
PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/NoReplyChannel.php');

class ServiceProviderTest extends ServiceContainerTest
{
    public function testConstruct()
    {
        $provider = new PEIP\Service\ServiceProvider();

        $this->assertEquals(get_class($provider), 'PEIP\Service\ServiceProvider');
    }

    public function testConstructEmptyConfigArray()
    {
        $provider = new PEIP\Service\ServiceProvider([]);

        $this->assertEquals(get_class($provider), 'PEIP\Service\ServiceProvider');
    }

    public function testConstructEmptyConfigArrayOfArray()
    {
        $provider = new PEIP\Service\ServiceProvider([[], []]);

        $this->assertEquals(get_class($provider), 'PEIP\Service\ServiceProvider');
    }

    public function testGetServices()
    {
        $services = [
            's1' => new HelloService(),
            's2' => new HelloService(),
            's3' => new HelloService(),
        ];
        $provider = new \PEIP\Service\ServiceProvider([]);
        foreach ($services as $key => $service) {
            $provider->setService($key, $service);
        }

        $this->assertEquals($services, $provider->getServices());
    }

    public function testAddConfig()
    {
        $provider = new PEIP\Service\ServiceProvider();

        $provider->addConfig(['id' => '123']);
        $this->assertEquals(get_class($provider), 'PEIP\Service\ServiceProvider');
    }

    public function testgetServiceConfig()
    {
        $provider = new \PEIP\Service\ServiceProvider();
        $id = 'id123';
        $config = ['id' => $id];
        $provider->addConfig($config);
        $this->assertEquals($config, $provider->getServiceConfig($id));
    }

    public function testgetServiceConfigDifferentIdAttribute()
    {
        $provider = new \PEIP\Service\ServiceProvider([], 'name');
        $id = 'id123';
        $name = 'name123';
        $config = ['id' => $id, 'name' => $name];
        $provider->addConfig($config);
        $this->assertNotEquals($config, $provider->getServiceConfig($id));
        $this->assertEquals($config, $provider->getServiceConfig($name));
    }

    public function testProvideService()
    {
        $provider = new \PEIP\Service\ServiceProvider();
        $provider->setService('bar', new HelloService());
        $service = $provider->provideService('bar');
        $this->assertTrue(is_object($service));
        $this->assertTrue(($service instanceof  HelloService));
        $this->assertEquals($service, $provider->provideService('bar'));
    }

    public function testBuildService()
    {
        $config = [
            'type' => 'foo',
            'id'   => 'bar',
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $test = $this;
        $provider->registerNodeBuilder('foo', function ($conf) use ($test,$config) {
            $test->assertSame($conf, $config);

            return new HelloService();
        });
        $provider->addConfig($config);
        $service = $provider->provideService('bar');
        $this->assertTrue(is_object($service));
        $this->assertTrue(($service instanceof  HelloService));
        $this->assertEquals($service, $provider->provideService('bar'));
    }

    // EVENT TESTS

    public function testEventBeforeAddConfig()
    {
        $config = ['id' => 'foo'];
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BEFORE_ADD_CONFIG;
        $provider = new \PEIP\Service\ServiceProvider();
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG => $config,
        ]);

        $provider->addConfig($config);
        $this->assertEventThrown();
    }

    public function testEventAfterAddConfig()
    {
        $config = ['id' => 'foo'];
        $eventName = \PEIP\Service\ServiceProvider::EVENT_AFTER_ADD_CONFIG;
        $provider = new \PEIP\Service\ServiceProvider();
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG => $config,
        ]);

        $provider->addConfig($config);
        $this->assertEventThrown();
    }

    public function testEventBeforeProvideService()
    {
        $key = 'bar';
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BEFORE_PROVIDE_SERVICE;
        $provider = new \PEIP\Service\ServiceProvider();
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY => $key,
        ]);

        $provider->setService('bar', new HelloService());
        $service = $provider->provideService('bar');

        $this->assertEventThrown();
    }

    public function testEventAfterProvideService()
    {
        $key = 'bar';
        $service = new HelloService();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_AFTER_PROVIDE_SERVICE;
        $provider = new \PEIP\Service\ServiceProvider();
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY     => $key,
            \PEIP\Service\ServiceProvider::HEADER_SERVICE => $service,
        ]);
        $provider->setService($key, $service);
        $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventBeforeCreateService()
    {
        $key = 'bar';
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BEFORE_CREATE_SERVICE;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY => $key,
        ]);

        $service = $provider->provideService('bar');

        $this->assertEventThrown();
    }

    public function testEventCreateServiceSuccess()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => $nodeName,
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_CREATE_SERVICE_SUCCESS;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY     => $key,
            \PEIP\Service\ServiceProvider::HEADER_SERVICE => self::buildHelloService(),
        ]);
        $provider->registerNodeBuilder($nodeName, ['ServiceProviderTest', 'buildHelloService']);
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventCreateServiceErrorMissingConfig()
    {
        $key = 'bar';
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_CREATE_SERVICE_ERROR;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY => $key,
        ]);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventCreateServiceErrorMissingBuilder()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => 'foo',
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_CREATE_SERVICE_ERROR;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_KEY => $key,
        ]);
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $provider->registerNodeBuilder($nodeName, ['ServiceProviderTest', 'buildHelloService']);

        $this->assertEventThrown();
    }

    public function testEventBeforeBuildNode()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => $nodeName,
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BEFORE_BUILD_NODE;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG => $config,
            \PEIP\Service\ServiceProvider::HEADER_NODE_NAME   => $nodeName,
        ]);
        $provider->registerNodeBuilder($nodeName, ['ServiceProviderTest', 'buildHelloService']);
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventBuildNodeSuccess()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => $nodeName,
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BUILD_NODE_SUCCESS;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG   => $config,
            \PEIP\Service\ServiceProvider::HEADER_NODE_NAME     => $nodeName,
            \PEIP\Service\ServiceProvider::HEADER_NODE          => self::buildHelloService(),
        ]);
        $provider->registerNodeBuilder($nodeName, ['ServiceProviderTest', 'buildHelloService']);
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventBuildNodeErrorNoBuilder()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => $nodeName,
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BUILD_NODE_ERROR;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG   => $config,
            \PEIP\Service\ServiceProvider::HEADER_NODE_NAME     => $nodeName,
        ]);
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public function testEventBuildNodeErrorNoObject()
    {
        $key = 'bar';
        $nodeName = 'foo';
        $config = [
            'type' => $nodeName,
            'id'   => $key,
        ];
        $provider = new \PEIP\Service\ServiceProvider();
        $eventName = \PEIP\Service\ServiceProvider::EVENT_BUILD_NODE_ERROR;
        $this->setupEventTest($provider, $eventName, [
            \PEIP\Service\ServiceProvider::HEADER_NODE_CONFIG   => $config,
            \PEIP\Service\ServiceProvider::HEADER_NODE_NAME     => $nodeName,
        ]);
        $provider->registerNodeBuilder($nodeName, function () {
            return false;
        });
        $provider->addConfig($config);
        $service = $provider->provideService($key);

        $this->assertEventThrown();
    }

    public static function buildHelloService()
    {
        return new HelloService();
    }
}
