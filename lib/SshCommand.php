<?php

class SshCommand
{
  public function __construct($user, $host, $command)
  {
    $this->user = $user;
    $this->host = $host;
    $this->command = $command;
  }

  public function __toString()
  {
    return sprintf("ssh -t %s@%s '%s'", $this->user, $this->host, $this->command);
  }
}
