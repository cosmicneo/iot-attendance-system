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
<th>FingerPrint_ID</th>
<th>RFID</th>
<th>Class</th>

</tr>
<?php
$conn = mysqli_connect("localhost", "admin", "123321", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM registered_members where category='".$_GET['category']."' ORDER BY fingerprintid" ; 
                
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {

echo "<tr><td>" . $row["name"]. "</td><td>" . $row["fingerprintid"] . "</td><td>"
. $row["rfid"]. "</td><td>".$row["class"]."</td></tr>";


}
echo "</table>";
} else { echo "<strong>0 results</strong>"; }
$conn->close();
?>
</table>
</body>
</html>
