<?php

spl_autoload_register('autoload_class');

function autoload_class($class_name)
{
  $dirname = dirname(__FILE__);
  $dirs = array("$dirname", "$dirname/vendor/yaml/lib/");
  foreach ($dirs as $dir)
  {
    if (file_exists("$dir/$class_name.php"))
    {
      require_once "$dir/$class_name.php";
    }
  }
}
