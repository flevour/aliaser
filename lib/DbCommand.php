<?php

class DbCommand
{
  protected $args = NULL;

  public function __construct(DbCommandArgs $args)
  {
    $this->args = $args;
  }

  public function getArgs()
  {
    return $this->args;
  }
}

