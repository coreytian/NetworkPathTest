<?php

namespace App;

/**
 * NetworkPath class that helps to detect the path between two given devices(nodes) that 
 * meets the time constraint.
 *
 * @author Corey Tian <haohetian@gmail.com>
 */
class NetworkPath {
    protected $connectionsData;

    /**
     * Load the csv file data and store the connections data into an array.
     * e.g. $connectionsData["A"]["B"] = 10;
     * The two nodes in the connection array is in the alphabetical order.
     * e.g. can have $connectionsData["A"]["B"], but not $connectionsData["B"]["A"]
     *
     * @param string       $filePath  The csv file path
     */
    public function loadCSV($filePath){
        $file = fopen($filePath, 'r');
        if(!$file){
            throw new Exception('Cannot find the file.');
        }
        while (($line = fgetcsv($file)) !== FALSE) {
            // Sort the order of the two nodes in a connection
            if(strcmp($line[0],$line[1])<0){
                $this->connectionsData[$line[0]][$line[1]] = $line[2];
               }else{
                $this->connectionsData[$line[1]][$line[0]] = $line[2];
            }
        }
        //var_dump($this->csvData);
        fclose($file);
    }

    /**
     * Find the first path between two nodes within the maximum time
     *
     * @param string       $source    The source node name
     * @param string       $target    The target node name
     * @param int          $maxTime   The maximum time allowed to travel the path   
     */
    public function findPath($source, $target, $maxTime){
        // Sort the two nodes of path in alphabetical order
        if(strcmp($source,$target)<0){
            $from = $source;
            $to = $target;
        }else{
            $from = $target;
            $to = $source;
        }

        $output = '';
        if($path = $this->checkNode($from, $to, $maxTime)){
            if($source != $path['nodes'][0]){
                $path['nodes'] = array_reverse($path['nodes']);
            }
            $output = implode(' => ', $path['nodes']);
            $output .= ' => '.$path['time'];
        }else{
            $output = "Path not found";
        }
        return $output;
    }

    /**
     * Check all the direct connections of the $from node and see if it is connecting to target node 
     *
     * @param string       $from     The node to be checked 
     * @param string       $to       The target node name
     * @param int          $restTime The maximum time left for the rest of path
     * 
     * @return array       Return an array that contains path info if a path is found. Otherwise return void.  
     */
    protected function checkNode($from, $to, $restTime){
        // Check all the connected nodes in a recusive way
        foreach($this->connectionsData[$from] as $node => $time){
            // When the connected node is the target node, the path is found
            if($node == $to && $time <= $restTime){
                $path = ['nodes'=>[$from, $to],'time'=>$time];
                return $path;
            }elseif($time < $restTime){ // The connected node is not the target node, keep checking this connected node
                if($path = $this->checkNode($node, $to, $restTime-$time)){
                    array_unshift($path['nodes'], $from);
                    $path['time'] += $time;
                    return $path;
                }
            }else{ // No time left for this path, go check next connected node
                continue;
            }
        }
    }
}