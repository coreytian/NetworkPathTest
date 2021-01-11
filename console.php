<?php
require('NetworkPath.php');

$filePath = $argv[1];
//TODO: Verify the argument

$networkPath =  new NetworkPath();
$networkPath->loadCSV($filePath);
$networkPath->findPath();




