<?php

require_once(dirname(__FILE__) . "/../lib/config.php");

class DbConnectCommand extends DbCommand
{
  public function __toString()
  {
    return sprintf('mysql %s %s',  $this->args, $this->args->getName());
  }
}

