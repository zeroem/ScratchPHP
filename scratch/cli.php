<?php

require_once("./bootstrap.php");
require_once("Console/CommandLine.php");

$parser = new Console_CommandLine(array(
    "description"=>"ScratchPHP Commandline Utility",
    "version"=>"0.0.1"
));

$parser->addArgument(
   "controller",
   array(
	 "optional"=>false,
	 "multiple"=>true,
	 "description"=>"Class Path of the Controller to Call"
));


try {
  $results = $parser->parse();

} catch( \Exception $e ) {
  $parser->displayError($e->getMessage());
}