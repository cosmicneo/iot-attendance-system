<?php
//include connection file 
include_once("connection.php");
include_once("libs/fpdf.php");

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
	$this->Cell(68);
	 $this->SetFont('Arial','B',10);
	
	if($_GET['category']=='student'){
	$this->Cell(00,00,'Registered Students List :');}
	
	elseif($_GET['category']=='teacher'){
	$this->Cell(00,00,'Registered Teachers List :');}
	
	elseif($_GET['category']=='staff'){
	$this->Cell(00,00,'Registered Staff List :');}

	
	elseif($_GET['category']=='admin'){
	$this->Cell(00,00,'Registered Administrators List :');}
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

$display_heading = array('name'=>'Name', 'category'=> 'Category','class'=> 'Class', 'rfid'=> 'RFID', 'fingerprintid'=> 'FingerPrint_ID','zone'=>'Zone');
$result = mysqli_query($connString, "SELECT name,fingerprintid,rfid,class,zone from registered_members where category='".$_GET['category']."'") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM registered_members");


$pdf = new PDF();

$pdf->setMargins(18,8,20);

//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',9);
$i=0;
foreach($header as $heading) {
if($i==5)
break;
if($display_heading[$heading['Field']]=="Class" || $display_heading[$heading['Field']]=="Zone"){
$pdf->Cell(20,6,"   ".$display_heading[$heading['Field']],1);}
elseif($display_heading[$heading['Field']]=="Category"){
continue;
}
else{
$pdf->Cell(45,6,"   ".$display_heading[$heading['Field']],1);}
$i++;
}
$i=0;
$pdf->SetFont('Arial','',9);
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column){
if($i==3 ||$i==4 )
$pdf->Cell(20,8,"   ".$column,1);
else
$pdf->Cell(45,8,"   ".$column,1);
$i++;
}
}
$pdf->Output();
?>
