<?php
$conn = mysqli_connect("localhost", "admin", "123321", "Attendance");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if($_GET['category']=='student'){
$sql = "select * from registered_members where category='student' and class = ".$_GET['class'];}

else{
$sql = "select * from registered_members where category= '".$_GET['category']."'";}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$compansate = 0;

if($_GET['category']=='admin')
{
$sql1= "select * from member_attendance where category='admin' and fingerprintid = '".$row["FingerPrint_ID"]."' and DATE(Time_Stamp) BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."'";       
$result1 = $conn->query($sql1);
$diff = date_diff(date_create($_GET['date_from']),date_create($_GET['date_to']));


$totalworkingdays =number_format($diff->format("%a"))-number_format($_GET['noworkday'])+1;
$totalcommings = mysqli_num_rows ( $result1 );
$sqlfin = "insert into temp_att_cal values (".$row['fingerprintid'].",'".$row['name']."','".$totalcommings."/".$totalworkingdays."')";
$resultfin = $conn->query($sqlfin);

}

else{

$sql1= "select * from member_attendance where fingerprintid = '".$row["fingerprintid"]."' and shift = -1 and date BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."'";       
$sql2= "select * from member_attendance where fingerprintid = '".$row["fingerprintid"]."' and shift = 2 and date BETWEEN '".$_GET['date_from']."'"." AND '".$_GET['date_to']."'";       
}
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);




$diff = date_diff(date_create($_GET['date_from']),date_create($_GET['date_to']));


$totalworkingdays =number_format($diff->format("%a"))-number_format($_GET['noworkday'])+1;
$totalcommings = mysqli_num_rows ( $result2 );


if($_GET['category']=='student'){
$sqlfin = "insert into temp_att_cal values (".$row['fingerprintid'].",'".$row['name']."','".$row['class']."','".$totalcommings."/".$totalworkingdays."')";
}

else{
$sqlfin = "insert into temp_att_cal (fingerprintid,name,attendance) values (".$row['fingerprintid'].",'".$row['name']."','".$totalcommings."/".$totalworkingdays."')";
}

$resultfin = $conn->query($sqlfin);

}

echo "</table>";
} else { echo "<strong>0 results</strong>"; }
$conn->close();
?>

