<?php

class FileDumper extends Dumper
{
  protected $file = NULL;
  public function __construct($file)
  {
    $this->file = $file;
  }

  public function dump(array $content)
  {
    file_put_contents($this->file, implode($content, PHP_EOL) . PHP_EOL);
  }
}
