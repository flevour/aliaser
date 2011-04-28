<?php

class StdoutDumper extends Dumper
{
  public function dump(array $content)
  {
    echo implode($content, PHP_EOL);
  }
}

