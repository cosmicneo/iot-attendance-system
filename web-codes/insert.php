
<?php
$conn = mysqli_connect("localhost", "admin", "123321", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "select * from registered_members where fingerprintid = '".$_GET['FingerPrint_ID']."'";


$result = $conn->query($sql);
if ($result->num_rows > 0) { 
$row = $result->fetch_assoc();



$sql = "insert into member_attendance (fingerprintid,rfid,name,class,date,category) values('".$_GET['FingerPrint_ID']."','".$row["rfid"]."','".$row["name"]."','".$row["class"]."','".$_GET['Date']."','".$_GET['category']."')";
$resultfin = $conn->query($sql);


echo $resultfin;
}
else {
header('Location: errorinsert.html');
exit;
}
if ($resultfin == 1){
header('Location: confirminsert.html');
exit;
}
else {
header('Location: errorinsert.html');
exit;
}
$conn->close();
?>
