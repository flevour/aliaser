<?php

class Command
{
  protected $local = NULL;

  public function isLocal()
  {
    return !$this->isRemote();
  }

  public function isRemote()
  {
    return (boolean) $this->remote;
  }
}
