<?php

session_start();

require_once 'src/lib/Dispatcher.php';
require_once 'src/lib/View.php';
require_once 'src/lib/Model.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();

?>