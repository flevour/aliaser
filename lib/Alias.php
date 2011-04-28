<?php

class Alias
{
  protected $alias = NULL, $command = NULL;
  public function __construct($alias, $command)
  {
    $this->alias = $alias;
    $this->command = $command;
  }

  public function __toString()
  {
    return sprintf('alias %s="%s"', $this->alias, $this->command);
  }
}
