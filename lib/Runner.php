<?php

class Runner
{
  protected $confPath = NULL,
    $dumper = NULL,
    $defaults = array(),
    $configs = array();

  public function __construct($confPath, Dumper $dumper)
  {
    $this->confPath = realpath($confPath) . "/";
    $this->dumper = $dumper;
    $this->loadConfig();
  }

  public function run()
  {
    $results = array();
    foreach ($this->configs as $config)
    {
      $results = array_merge($results, $config->getAliases());
    }
    $this->dumper->dump($results);
  }

  public function loadConfig()
  {
    $defaultsFile = $this->confPath . "default.yml";
    if (file_exists($defaultsFile))
    {
      $this->setDefaults(sfYaml::load($defaultsFile));
    }
    foreach ($this->getConfFiles() as $file)
    {
      $this->configs[] = new SiteConfig($file, $this->defaults);
    }
  }

  public function setDefaults($defaults)
  {
    $this->defaults = $defaults;
  }

  public function getConfigs()
  {
    return $this->configs;
  }

  public function getConfFiles($onlyFilenames = FALSE)
  {
    $files = glob(sprintf("%s*.yml", $this->confPath));
    if ($onlyFilenames)
    {
      $files = array_map(array($this, "stripConfPath"), $files);
    }
    $files = array_filter($files, array($this, "excludeDefaultFile"));
    return array_values($files); // array_values resets key values
  }

  private function stripConfPath($string)
  {
    return str_replace($this->confPath, "", $string);
  }

  private function excludeDefaultFile($string)
  {
    return $this->stripConfPath($string) != 'default.yml';
  }

}
