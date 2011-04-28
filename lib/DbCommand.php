<?php

class DbCommand extends Command
{
  protected $args = NULL;

  public function __construct(DbCommandArgs $args, $remote = FALSE)
  {
    $this->args = $args;
    $this->remote = $remote;
  }

  public function getArgs()
  {
    return $this->args;
  }
}

