<?php
//include connection file 
include_once("connection.php");
include_once("libs/fpdf.php");

class PDF extends FPDF
{
// Page header
function Header()
{
   
    $this->Cell(80);
    
	
    
    $this->Ln(20);
	$this->Cell(37);
	 $this->SetFont('Arial','B',8);
	if($_GET['category']=='student'){
	$this->Cell(00,00,'Students Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}
	
	elseif($_GET['category']=='teacher'){
	$this->Cell(00,00,'Teacher Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}
	
	elseif($_GET['category']=='staff'){
	$this->Cell(00,00,'Staff Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}

	elseif($_GET['category']=='admin'){
	$this->Cell(00,00,'Administrator Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}

	$this->Ln(10);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
	// Position at 2.0 cm from bottom
    $this->SetY(-20);
    // Arial italic 8
    $this->SetFont('Arial','B','I',8);
    // Page number
    $this->Cell(0,10);
}
}

$db = new dbObj();
$connString =  $db->getConnstring();


if($_GET['category']=='student'){
$display_heading = array('name'=>'Name','fingerprintid'=>'FingerPrint_ID','rfid'=>'RFID', 'class'=> 'Class', 'timestamp'=> 'Time Stamp','date'=> 'Date','category'=> 'Category');
if($_GET['class']=='All'){
$result = mysqli_query($connString, "SELECT name,fingerprintid,rfid,class,timestamp,date FROM member_attendance where category='student' and date between '".$_GET['date_from']."' and '".$_GET['date_to']."'") or die("database error:". mysqli_error($connString));
}
else{
$result = mysqli_query($connString, "SELECT name,fingerprintid,rfid,class,timestamp,date FROM member_attendance where category = 'student' and class =".$_GET['class']." and date between '".$_GET['date_from']."' and '".$_GET['date_to']."'") or die("database error:". mysqli_error($connString));
}

}
else{
$display_heading = array('name'=>'Name','fingerprintid'=>'Finger_ID','rfid'=>'RFID', 'class'=> 'Class', 'timestamp'=> 'Time Stamp','date'=> 'Date');
$result = mysqli_query($connString, "SELECT name,fingerprintid,rfid,class,timestamp,date FROM member_attendance where category='".$_GET['category']."' and date between '".$_GET['date_from']."' and '".$_GET['date_to']."'") or die("database error:". mysqli_error($connString));

}
$header = mysqli_query($connString, "SHOW columns FROM member_attendance");

$pdf = new PDF();

$pdf->setMargins(24,8,10);

//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
$i=0;
foreach($header as $heading) {
if ($i==6) {
break;
}
if( $display_heading[$heading['Field']] == "Class"){
$pdf->Cell(15,8,"   ".$display_heading[$heading['Field']],1);
}
else if($display_heading[$heading['Field']] == "Name"){
$pdf->Cell(40,8,"    ".$display_heading[$heading['Field']],1);
}

else if($display_heading[$heading['Field']] == "Date"){
$pdf->Cell(20,8,"    ".$display_heading[$heading['Field']],1);
}

else{
$pdf->Cell(28,8,"   ".$display_heading[$heading['Field']],1);
}
$i++;
}
$pdf->SetFont('Arial','',7.1);

foreach($result as $row) {
$pdf->Ln();
$i=0;
foreach($row as $column){

if ($i == 0 ){
$pdf->Cell(40,8,"   ".$column,1);
}
else if ($i == 3 ){
$pdf->Cell(15,8,"   ".$column,1);
}
else if ($i == 5){
$pdf->Cell(20,8,"   ".$column,1);
}
else{
$pdf->Cell(28,8,"   ".$column,1);
}
$i++;
}


}
$pdf->Output();
?>
