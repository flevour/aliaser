<?php

require_once(dirname(__FILE__) . "/../lib/config.php");

class DbCreateCommand extends DbCommand
{
  public function __toString()
  {
    return sprintf('mysqladmin %s create %s',  $this->args, $this->args->getHost());
  }
}

