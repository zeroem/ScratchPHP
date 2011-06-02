<?php

if(!defined("SCRATCH_INSTALL_PATH")) {
	define("SCRATCH_INSTALL_PATH",realpath(__DIR__."/.."));
}

/* 
   Force the working directory to be the ScratchPHP directory.
   Not sure if this is a good idea, may interfere with Unit Testing.
*/
chdir(SCRATCH_INSTALL_PATH);


/**
 * Convert a Fully Qualified Class Name into a 
 * case sensitive file path relative to the
 * ScratchPHP Install directory.
 * 
 * @param string $class Fully Qualified Class Name
 */
function scratchphp_autoload($class) {
  $parts = explode("\\",$class);
  array_splice($parts,1,0,array("source"));
  $path = "./" . implode("/",$parts) . ".php";

  if(is_readable($path)) {
    include_once($path);
  }
}

spl_autoload_register("scratchphp_autoload",false);

