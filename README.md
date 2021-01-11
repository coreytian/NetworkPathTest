# NetworkPathTest

A PHP command line tool that helps to detect the path between two devices(nodes) with a time contraint in a given network.

The tool will only return first path that meets the time constraint.

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
Please make sure the CSV file format is valid as currently this tool is not validating it.

## Run

Run the following command in project root.

```
php console.php your_csv_file_path
```
Then you can then enter the path you wanted to check in this format: Node Node Time 

```
A B 100
```

Enter QUIT/quit to terminate the tool.

## Sample Input / Output (based on above CSV data):

```
Input: A F 1000
Output: Path not found

Input: A F 1200 
Output: A => B => D => E => F => 1120

Input: A D 100 
Output: A => C => D => 50

Input: E A 400 
Output: E => D => B => A => 120

Input: E A 80 
Output: E => D => C => A => 60
```
