<?php

require_once dirname(__FILE__).'/base/AllTests.php';
require_once dirname(__FILE__).'/channel/AllTests.php';
require_once dirname(__FILE__).'/command/AllTests.php';
require_once dirname(__FILE__).'/data/AllTests.php';
require_once dirname(__FILE__).'/dispatcher/AllTests.php';
require_once dirname(__FILE__).'/event/AllTests.php';
require_once dirname(__FILE__).'/handler/AllTests.php';
require_once dirname(__FILE__).'/message/AllTests.php';
require_once dirname(__FILE__).'/service/AllTests.php';
require_once dirname(__FILE__).'/pipe/AllTests.php';
require_once dirname(__FILE__).'/util/AllTests.php';
require_once dirname(__FILE__).'/translator/AllTests.php';

 class AllTests extends PHPUnit_Framework_TestSuite
 {
     public static function suite()
     {
         $suite = new PHPUnit_Framework_TestSuite('');
         $suite->addTestSuite('Base_AllTests');
         $suite->addTestSuite('Channel_AllTests');
         $suite->addTestSuite('Command_AllTests');
         $suite->addTestSuite('Data_AllTests');
         $suite->addTestSuite('Dispatcher_AllTests');
         $suite->addTestSuite('Event_AllTests');
         $suite->addTestSuite('Handler_AllTests');
         $suite->addTestSuite('Message_AllTests');
         $suite->addTestSuite('Service_AllTests');
         $suite->addTestSuite('Pipe_AllTests');
         $suite->addTestSuite('Util_AllTests');
         $suite->addTestSuite('Translator_AllTests');

         return $suite;
     }
 }
