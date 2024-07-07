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
<th>FingerPrint_ID</th>
<th>Name</th>
<th>Class</th>
<th>Attendance</th>
</tr>
<?php


$conn = mysqli_connect("localhost", "admin", "123321", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if($_GET['category']=='student'){
$sql = "select * from registered_members where class = ".$_GET['class'];}

else{


$sql1= "select * from member_attendance where fingerprintid = '".$row["fingerprintid"]."' and date BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."'";       
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$compansate = mysqli_num_rows ( $result ) % 3;

$sql1= "select * from member_attendance where category='".$_GET['category']."'and fingerprintid = '".$row["fingerprintid"]."' and DATE(timestamp) BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."'";       
$result1 = $conn->query($sql1);
$diff = date_diff(date_create($_GET['date_from']),date_create($_GET['date_to']));


$totalworkingdays =number_format($diff->format("%a"))-number_format($_GET['noworkday'])+1;
$totalcommings = mysqli_num_rows ( $result1 )-$compansate;




echo "<tr><td>". $row["fingerprintid"]."</td><td>".$row["name"]."</td><td>".$row["class"]."</td><td>".$totalcommings."/".$totalworkingdays."</td><tr>";



}
echo "</table>";
} else { echo "<strong>0 results</strong>"; }
$conn->close();
?>
</table>
</body>
</html>
