<?php 

class NetworkPathTest extends \PHPUnit\Framework\TestCase
{
    public function testNetworkPath(){
        $networkPath = new App\NetworkPath();

        $networkPath->loadCSV('test.csv');

        $output = $networkPath->findPath("A", "F", "1000"); 
        $this->assertEquals("Path not found",$output);

        $output = $networkPath->findPath("A", "F", "1200"); 
        $this->assertEquals("A => B => D => E => F => 1120",$output);
        
        $output = $networkPath->findPath("A", "D", "100"); 
        $this->assertEquals("A => C => D => 50",$output);

        $output = $networkPath->findPath("E", "A", "400"); 
        $this->assertEquals("E => D => B => A => 120",$output);

        $output = $networkPath->findPath("E", "A", "80"); 
        $this->assertEquals("E => D => C => A => 60",$output);
    }
}