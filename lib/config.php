<?php

spl_autoload_register('autoload_class');

function autoload_class($class_name)
{
  require_once dirname(__FILE__) . "/$class_name.php";
}
