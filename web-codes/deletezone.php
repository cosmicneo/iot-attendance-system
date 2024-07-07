<?php
$conn = mysqli_connect("localhost", "pi", "pi", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "delete  from punch_time where zone='".$_GET['zonename']."'";
$conn->query($sql);
header("Location: deletezonefront.php");
exit;


 ?>