<?php
$conn = mysqli_connect("localhost", "pi", "pi", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "insert into punch_time values ('".$_GET['zonename']."','".$_GET['intimefrom']."','".$_GET['intimeto']."','".$_GET['outtimefrom']."','".$_GET['outtimeto']."','".$_GET['latetimefrom']."','".$_GET['latetimeto']."')"; 
$conn->query($sql);
header("Location: insertzone");
exit;


 ?>