<?php
$dirname = dirname(__FILE__);

spl_autoload_register('autoload_class');

function autoload_class($class_name)
{
  $dirname = dirname(__FILE__);
  $dirs = array("$dirname", "$dirname/vendor/yaml/lib/", "$dirname/vendor/dependency-injection/lib");
  foreach ($dirs as $dir)
  {
    if (file_exists("$dir/$class_name.php"))
    {
      require_once "$dir/$class_name.php";
    }
  }
}

$sc = new sfServiceContainerBuilder();
$loader = new sfServiceContainerLoaderFileYaml($sc);

if (file_exists("$dirname/../config.yml"))
{
  $loader->load("$dirname/../config.yml");
}
$loader->load("$dirname/services.yml");
DI::setInstance($sc);

