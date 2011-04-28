<?php

require_once(dirname(__FILE__) . "/../lib/config.php");
class SiteConfigTest extends PHPUnit_Framework_TestCase
{
  public function testGetShortName()
  {
    $path = realpath(dirname(__FILE__) . "/fixtures");
    $config = new SiteConfig("$path/site1.yml", array('data' => array('short_name' => 'foo1')));
    $this->assertEquals($config->getShortName(), 'project');
    $config = new SiteConfig("$path/site2.yml", array());
    $this->assertEquals($config->getShortName(), 'site2');
  }
}
