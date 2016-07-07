<?php

require_once dirname(__FILE__).'/ServiceContainerTest.php';
require_once dirname(__FILE__).'/ServiceActivatorTest.php';
require_once dirname(__FILE__).'/ServiceProviderTest.php';
 class service_AllTests extends PHPUnit_Framework_TestSuite
 {
     public static function suite()
     {
         $suite = new PHPUnit_Framework_TestSuite('service');
         $suite->addTestSuite('ServiceContainerTest');
         $suite->addTestSuite('ServiceActivatorTest');
         $suite->addTestSuite('ServiceProviderTest');

         return $suite;
     }
 }
