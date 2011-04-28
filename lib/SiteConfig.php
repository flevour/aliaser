<?php

class SiteConfig
{
  protected $config = array(), $defaults = array(), $file = NULL;

  public function __construct($file, $defaults = array())
  {
    $this->file = $file;
    $this->defaults = $defaults;
    $this->load();
  }


  public function load()
  {
    $yml = sfYaml::load($this->file);
    $this->config = $this->array_merge_recursive_distinct($this->defaults, $yml);
    if (!isset($this->config['data']['short_name']))
    {
      $this->config['data']['short_name'] = basename($this->file, ".yml");
    }
  }

  public function getCommands()
  {

  }

  public function getAliases()
  {
    $aliases = array();
    $config = $this->config;
    unset($config['data']);
    $_commands = array();
    foreach ($config as $identifier => $block)
    {
      $remote = $identifier != 'local';
      $_commands[$this->generateAliasName($identifier)] = new CdCommand($block['path'], $remote);
      if (isset($block['db']))
      {
        $db = $block['db'];
        $args = new DbCommandArgs($db['user'], $db['pass'], $db['name'], @$db['host']);
        $_commands[$this->generateAliasName("db_$identifier")] = new DbConnectCommand($args, $remote);
      }
    }
    foreach ($_commands as $_alias => $_command)
    {
      if ($_command->isRemote())
      {
        $_command = new SshCommand($block['user'], $block['host'], $_command);
      }
      $aliases[] = (string) new Alias($_alias, $_command);
    }
    return $aliases;
  }

  public function getConfig()
  {
    return $this->config;
  }

  public function getShortName()
  {
    return $this->config['data']['short_name'];
  }

  public function generateAliasName($identifier)
  {
    return sprintf("%s_%s", $this->getShortName(), $identifier);
  }
  
  // Taken from http://www.php.net/manual/en/function.array-merge-recursive.php#96201
  /**
   * Merges any number of arrays / parameters recursively, replacing 
   * entries with string keys with values from latter arrays. 
   * If the entry or the next value to be assigned is an array, then it 
   * automagically treats both arguments as an array.
   * Numeric entries are appended, not replaced, but only if they are 
   * unique
   *
   * calling: result = array_merge_recursive_distinct(a1, a2, ... aN)
   **/

  private function array_merge_recursive_distinct () {
    $arrays = func_get_args();
    $base = array_shift($arrays);
    if(!is_array($base)) $base = empty($base) ? array() : array($base);
    foreach($arrays as $append) {
      if(!is_array($append)) $append = array($append);
      foreach($append as $key => $value) {
        if(!array_key_exists($key, $base) and !is_numeric($key)) {
          $base[$key] = $append[$key];
          continue;
        }
        if(is_array($value) or is_array($base[$key])) {
          $base[$key] = $this->array_merge_recursive_distinct($base[$key], $append[$key]);
        } else if(is_numeric($key)) {
          if(!in_array($value, $base)) $base[] = $value;
        } else {
          $base[$key] = $value;
        }
      }
    }
    return $base;
  }
}
