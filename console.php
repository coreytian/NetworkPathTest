<?php
require('NetworkPath.php');

$filePath = $argv[1];
// TODO: Verify the argument

$networkPath =  new NetworkPath();
$networkPath->loadCSV($filePath);

$handle = fopen ("php://stdin","r");

// Continually wait for user input
while($line = trim(fgets($handle))){
    // Enter QUIT/quit to terminate 
    if(strtoupper($line) == 'QUIT'){ 
        exit("Bye!\n");
    }

    // TODO: Verify the input format and value
    $lineVars = explode(' ', $line);
    //var_dump($lineVars);
    $networkPath->findPath($lineVars[0], $lineVars[1], $lineVars[2]); 
    echo "\n";
}

