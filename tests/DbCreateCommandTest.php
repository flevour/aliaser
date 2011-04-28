<?php

require_once(dirname(__FILE__) . "/../lib/config.php");
class DbCreateCommandTest extends PHPUnit_Framework_TestCase
{
  public function testCreateCommand()
  {
    $args = $this->getMock('DbCommandArgs', array('getHost', '__toString'), array(), '', FALSE);

    $args->expects($this->once())
      ->method('getHost')
      ->will($this->returnValue($host = 'host'));
    $args->expects($this->once())
      ->method('__toString')
      ->will($this->returnValue($string = 'argsString'));

    $command = new DbCreateCommand($args);
    $this->assertEquals("mysqladmin $string create $host", (string) $command);
  }
}

