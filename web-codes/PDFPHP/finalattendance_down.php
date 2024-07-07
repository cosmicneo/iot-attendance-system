<?php
//include connection file 
include_once("connection.php");
include_once("libs/fpdf.php");
include("db.php");
$flag =0;
$dis=0;
class PDF extends FPDF
{
// Page header
function Header()
{
   
    // Move to the right
    $this->Cell(80);
    // Title
	
    //$this->Cell(80,10,'Students List',1,0,'C');
    // Line break
    $this->Ln(20);
	$this->Cell(20);
	 $this->SetFont('Arial','B',8);
	if($_GET['category']=='student'){
	
	$this->Cell(00,00,'Final Students Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}
	
	elseif($_GET['category']=='teacher'){
	$this->Cell(00,00,'Final Teacher Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}
	
	elseif($_GET['category']=='staff'){
	$this->Cell(00,00,'Final Staff Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}

	elseif($_GET['category']=='admin'){
	$this->Cell(00,00,'Final Administrator Attendance List From: '.$_GET['date_from'].' To: '.$_GET['date_to']);}

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



$display_heading = array('name'=>'Name','fingerprintid'=>'FingerPrint_ID', 'class'=> 'Class','attendance'=> 'Attendance');
$result = mysqli_query($connString, "SELECT * FROM temp_att_cal") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM temp_att_cal");

ob_start();   // ***** this line is necessary otherwise error : FPDF error: Some data has already been output, can't send PDF file in 
$pdf = new PDF();


$pdf->setMargins(40,8,40);

//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
foreach($header as $heading) {

if($display_heading[$heading['Field']] == "Name" ){
$pdf->Cell(40,8,"   ".$display_heading[$heading['Field']],1);
}
else{
$pdf->Cell(28,8,"   ".$display_heading[$heading['Field']],1);
}}
$pdf->SetFont('Arial','',7.1);
foreach($result as $row) {
$pdf->Ln();
$i=0;
foreach($row as $column){
if($i==1){
$pdf->Cell(40,8,"   ".$column,1);
}
else{
$pdf->Cell(28,8,"   ".$column,1);}
$i++;
}

}
$pdf->Output();
$fin = mysqli_query($connString, "DELETE FROM temp_att_cal");
?>
