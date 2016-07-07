<?php



use \PEIP\Data\ParameterHolder as PEIP_Parameter_Holder;

require_once dirname(__FILE__).'/../../misc/bootstrap.php';

class ParameterHolderTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        //test provider
        $this->holder = $this->provider();
    }

    public function provider()
    {
        return new PEIP_Parameter_Holder();
    }


    public function testAccessors()
    {
        $holder = $this->holder;
        $holder->setParameter('foo', 'bar');
        $this->assertEquals('bar', $holder->getParameter('foo'));
        $parameters = [
            'foo'  => 'boo',
            'test' => 'text',
        ];
        $holder->setParameters($parameters);
        $this->assertEquals($parameters, $holder->getParameters());
    }


    public function testHas($holder = null)
    {
        $holder = $this->holder;
        $holder->setParameter('foo', 'bar');
        $this->assertTrue($holder->hasParameter('foo'));
    }


    public function testDelete($holder = null)
    {
        $holder = $this->holder;
        $holder->setParameter('foo', 'bar');
        $this->assertTrue($holder->hasParameter('foo'));
        $holder->deleteParameter('foo');
        $this->assertNotEquals('bar', $holder->getParameter('foo'));
        $this->assertFalse($holder->hasParameter('foo'));
    }


    public function testAdd($holder = null)
    {
        $holder = $this->holder;
        $parameters = [
            'foo'  => 'bar',
            'test' => 'text',
        ];
        $parameters2 = [
            'foo'  => 'boo',
            'text' => 'test',
        ];
        $merge = [
            'foo'  => 'boo',
            'test' => 'text',
            'text' => 'test',
        ];
        $merge2 = [
            'foo'  => 'bar',
            'test' => 'text',
            'text' => 'test',
        ];
        $holder = self::provider();
        $holder->addParameters($parameters);
        $this->assertEquals($parameters, $holder->getParameters());

        $holder = self::provider();
        $holder->setParameters($parameters);
        $this->assertEquals($parameters, $holder->getParameters());
        $holder->addParameters($parameters2);
        $this->assertEquals($merge, $holder->getParameters());

        $holder = self::provider();
        $holder->setParameters($parameters);
        $this->assertEquals($parameters, $holder->getParameters());
        $holder->addParametersIfNot($parameters2);
        $this->assertEquals($merge2, $holder->getParameters());
    }
}
