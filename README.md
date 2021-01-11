# NetworkPathTest

A PHP command line tool that helps to detect the path between two devices(nodes) in a given network.

## Requirements

* PHP >= 5.3

## CSV file

A CSV file that describes the network connections needs to be provided.
Format: Device From, Device To, Latency (milliseconds)
```
A,B,10
A,C,20
B,D,100
C,D,30
D,E,10
E,F,1000
```
