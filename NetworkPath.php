<?php

class NetworkPath {
    protected $connectionsData;

    /**
     * Load the csv file data and store the connections data into an array
     * e.g. $this->connectionsData["A"]["B"] = 10;
     *
     * @param string       $filePath  The csv file path
     */
    public function loadCSV($filePath){
        $file = fopen($filePath, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            $this->connectionsData[$line[0]][$line[1]] = $line[2];
        }
        //var_dump($this->csvData);
        fclose($file);
    }

    public function findPath(){

    }
}