<?php

class CdCommand extends Command
{
  public function __construct($path, $remote = FALSE)
  {
    $this->path = $path;
    $this->remote = $remote;
  }

  public function __toString()
  {
    $cd = "cd {$this->path}";
    $cd .= ($this->isRemote()) ? "; bash" : "";
    return $cd;
  }
}
