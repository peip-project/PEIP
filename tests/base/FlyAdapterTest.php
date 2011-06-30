<?php



require_once dirname(__FILE__).'/../../misc/bootstrap.php';

PHPUnit_Util_Fileloader::checkAndLoad(dirname(__FILE__).'/../_files/HelloService.php');

/**
 * Test class for FlyAdapter.
 * Generated by PHPUnit on 2011-07-01 at 01:02:31.
 */
class FlyAdapterTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var FlyAdapter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $map = array(
            'foo' => 'greet',
            'bar' => 'getName'
        );
        $this->object = new HelloService;
        $this->adapter = new \PEIP\Base\FlyAdapter($map);
    }

 
    public function testCall() {
        $this->assertEquals(
            $this->object->greet(),
            $this->adapter->setSubject($this->object)->foo()
        );
        $this->assertEquals(
            $this->object->getName(),
            $this->adapter->setSubject($this->object)->bar()
        );
        $this->assertFalse(
            $this->adapter->setSubject($this->object)->foobar()
        );
    }

}


