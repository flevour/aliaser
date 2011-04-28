<?php

require_once(dirname(__FILE__) . "/../lib/config.php");
class DbCommandArgsTest extends PHPUnit_Framework_TestCase
{
  public function testCommandArgs()
  {
    $db = new DbCommandArgs($user = "user", $pass = "pass", $name = "name", $host = "host");
    $this->assertEquals($user, $db->getUser());
    $this->assertEquals($pass, $db->getPass());
    $this->assertEquals($name, $db->getName());
    $this->assertEquals($host, $db->getHost());

    $this->assertEquals("-u$user -p$pass -h$host", (string) $db);
  }
}
