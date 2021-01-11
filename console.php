<?php
require('NetworkPath.php');

$filePath = $argv[1];
if(empty($filePath)){
    exit("Please enter the CSV file path as an argument.\n");
}

$networkPath =  new NetworkPath();
try{
    $networkPath->loadCSV($filePath);
}catch(Exception $e){
    exit("Load CSV file failed: ".$e->getMessage()."\n");
}
echo "Please enter the path you want to check (e.g. A B 100): \n";

$handle = fopen ("php://stdin","r");
// Continually wait for user input
while($line = trim(fgets($handle))){
    
    // Enter QUIT/quit to terminate 
    if(strtoupper($line) == 'QUIT'){ 
        exit("Bye!\n");
    }

    $lineVars = explode(' ', $line);
    if(empty($lineVars[0])||empty($lineVars[1])||!is_numeric($lineVars[2])){
        echo "Please enter a valid path. E.g. A B 100 \n";
        continue;
    }
    
    $output = $networkPath->findPath($lineVars[0], $lineVars[1], $lineVars[2]); 
    echo $output."\n";
}

