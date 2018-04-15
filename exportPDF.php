<?php
require('./fpdf181/fpdf.php');
session_start();
$con=mysqli_connect("localhost","root","k136616","Healthcare");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$name = $_SESSION['name'];
	$query = mysqli_query($con, "select L_ID from PatientLogin where P_name = '$name'");
	$rows = mysqli_fetch_assoc($query);
	$lid = $rows['L_ID'];
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times','B',10);
$pdf->Cell(25,7, "Hello  ".$_SESSION["name"]. "!!\n\t Your patient ID is ".$lid);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
$pdf -> SetX(85);
$pdf->Cell(25,7,"HISTORY", 1, 1, 'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,7,"Prescription Date");
$pdf->Cell(25,7,"Disease");
$pdf->Cell(25,7,"Medicine");
$pdf->Cell(40,7,"Dose Per Day");
$pdf->Cell(25,7,"Quantity");
$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
	
        
	
 $sql = "SELECT * from Prescription where P_ID in (select P_ID from PatientLoginPID where L_ID = (select L_ID from PatientLogin where P_name = '$name'))";
        $result = mysqli_query($con,$sql);
	while($rows = mysqli_fetch_array($result))
        {
            $PrescriptionDate = $rows['PrescriptionDate'];
            $Disease = $rows['Disease'];
            $Medicine = $rows['Medicine'];
            $DosePerDay = $rows['DosePerDay'];
            $Quantity = $rows['Quantity'];
            $pdf->Cell(40,7,$PrescriptionDate);
            $pdf->Cell(27,7,$Disease);
            $pdf->Cell(27,7,$Medicine);
            $pdf->Cell(40,7,$DosePerDay);
            $pdf->Cell(30,7,$Quantity);
            $pdf->Ln(); 
        }
$pdf->Output("Record.pdf",'D');
?>
