<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>

<style>
table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #ddd;
  padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>

</head>
<body>
<table>
<tr>
<th>Name</th>
<th>Class</th>
<th>TimeStamp</th>
<th>FingerPrint_ID</th>
<th>RFID</th>
</tr>
<?php
$conn = mysqli_connect("localhost", "admin", "123321", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if($_GET['category']=='student' && $_GET['class']!='All'){
$sql = "SELECT * FROM member_attendance where category =  'student' and Class = ".$_GET['class']." AND DATE(timestamp) BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."' ORDER BY fingerprintid" ;                 
}
else{
if($_GET['category']=='student'){
$sql = "SELECT * FROM member_attendance where category = 'student' and DATE(timestamp) BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."' ORDER BY fingerprintid" ;                 
}
else{
$sql = "SELECT * FROM member_attendance where category = '".$_GET['category']."' and DATE(timestamp) BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."' ORDER BY fingerprintid" ;                 
}

}


$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {


echo "<tr><td>" . $row["name"]. "</td><td>" . $row["class"] . "</td><td>"
. $row["timestamp"]."</td><td>" . $row["fingerprintid"] ."</td><td>" . $row["rfid"] . "</td></tr>";



}
echo "</table>";
} else { echo "<strong>0 results</strong>"; }
$conn->close();
?>
</table>
</body>
</html>
