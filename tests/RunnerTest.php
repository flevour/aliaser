<?php

require_once(dirname(__FILE__) . "/../lib/config.php");
class RunnerTest extends PHPUnit_Framework_TestCase
{
  public function testLoadFiles()
  {
    $path = realpath(dirname(__FILE__) . "/fixtures");
    $dumper = $this->getMock('Dumper');
    $runner = new Runner($path, $dumper);
    $files = array($path . "/site1.yml", $path . "/site2.yml");
    $this->assertEquals($files, $runner->getConfFiles());
    $files = array("site1.yml", "site2.yml");
    $this->assertEquals($files, $runner->getConfFiles(TRUE));

    $this->assertEquals(2, count($runner->getConfigs()));
  }

}
