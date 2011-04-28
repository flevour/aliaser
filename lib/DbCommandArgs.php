<?php

class DbCommandArgs
{
  protected $user = NULL,
    $pass = NULL,
    $name = NULL,
    $host = NULL;

  public function __construct($user, $pass, $name, $host = "localhost")
  {
    $this->user = $user;
    $this->pass = $pass;
    $this->name = $name;
    $this->host = $host;
  }

  public function getUser()
  {
    return $this->user;
  }

  public function getPass()
  {
    return $this->pass;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getHost()
  {
    return $this->host;
  }

  public function __toString()
  {
    return sprintf('-u%s -p%s -h%s',  $this->user, escapeshellcmd($this->pass), $this->host);
  }
}
