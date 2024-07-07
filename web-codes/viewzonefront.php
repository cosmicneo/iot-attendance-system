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
<th>Zone</th>
<th>In Time:</th>
<th>Out Time:</th>
<th>Late Time:</th>

</tr>
<?php
$conn = mysqli_connect("localhost", "pi", "pi", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM punch_time" ; 
                
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {

echo "<tr><td>" . $row["zone"]. "</td><td>" . $row["in_from"] ." -to- "
. $row["in_to"]. "</td><td>".$row["out_from"]." -to- ".$row["out_to"]."</td><td>".$row["late_from"]." -to- ".$row["late_to"]."</td></tr>";


}
echo "</table>";
} else { echo "<strong>0 results</strong>"; }
$conn->close();
?>
</table>
</body>
</html>