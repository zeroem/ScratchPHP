<?php

require_once("./bootstrap.php");

$d = new \scratch\server\DefaultDispatcher();
$d->dispatch($argv[1]);