<?php

require_once(dirname(__FILE__) . "/../lib/config.php");
class DbConnectCommandTest extends PHPUnit_Framework_TestCase
{
  public function testConnectCommand()
  {
    $args = $this->getMock('DbCommandArgs', array('getName', '__toString'), array(), '', FALSE);

    $args->expects($this->once())
      ->method('getName')
      ->will($this->returnValue($name = 'name'));
    $args->expects($this->once())
      ->method('__toString')
      ->will($this->returnValue($string = 'argsString'));

    $command = new DbConnectCommand($args);
    $this->assertEquals("mysql $string $name", (string) $command);
  }
}

