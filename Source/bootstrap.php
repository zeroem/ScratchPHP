<?php

/* 
   Force the working directory to be the ScratchPHP/Source directory.
   Not sure if this is a good idea, may interfere with Unit Testing.
*/
chdir(basename(__FILE__));

require_once("./defines.php");

/**
 * Convert a Fully Qualified Class Name into a 
 * case sensitive file path relative to the
 * Source directory.
 * 
 * @param string $class Fully Qualified Class Name
 */
function scratchphp_autoload($class) {
  $path = ".".str_replace("\\",DS,$class) . ".php";

  if(is_readable($path)) {
    include_once($path);
  }
}

spl_autoload_register(scratchphp_autoload,false);
