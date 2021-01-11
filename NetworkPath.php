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

    /**
     * Find the first path between two nodes within the maximum time
     *
     * @param string       $from    The source node name
     * @param string       $to      The target node name
     * @param int          $maxTime The maximum time allowed to travel the path   
     */
    public function findPath($from, $to, $maxTime){
        
        $output = '';
        $totalTime= 0;
        if($path = $this->checkNextNode($from, $to, $maxTime,  0)){
           
            var_dump($path);
        }else{
            echo "\nPath not found";
        }
    }

    /**
     * Traverse all the nodes in the connections data until the target node is 
     * detected. 
     *
     * @param string       $from     The source node name
     * @param string       $to       The target node name
     * @param int          $restTime The maximum time left for the rest of path
     * 
     * @return array|void  Return an array that contains path info if a path is found. Otherwise return void.  
     */
    protected function checkNextNode($from, $to, $restTime){
        // Check all the connected nodes in a recusive way
        foreach($this->connectionsData[$from] as $node => $time){
            // A path is found when it reaches the target node within the max time left
            if($node == $to && $time <= $restTime){
                $path = ['nodes'=>[$from, $to],'time'=>$time];
                return $path;
            }elseif($time < $restTime){ // The connected node is not the target, run the same function on the connected node 
                if($path = $this->checkNextNode($node, $to, $restTime-$time)){
                    array_unshift($path['nodes'], $from);
                    $path['time'] += $time;
                    return $path;
                }
            }else{ 
                continue;
            }
        }
    }
}