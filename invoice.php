<?php
 //------------------------- Database Connection--------------------//
include "connect.php";

 //------------------------- include FPDF files --------------------//

require('fpdf182/fpdf.php');

 //------------------------- Getting ID in the condotion START --------------------//

if(isset($_GET['invoice'])&& intval($_GET['invoice']))
{
  $ids = (int) $_GET['invoice'];

 //------------------------- SQL for getting invoices data --------------------//
$sql = "SELECT `p_id`, `m_id`, `del_id`, `del_man`, `chrg`, `due_chrg`, `user_bal`, `payment`, `stamp_created`, `modified_at`, `recv_name`, `recv_address`,recv_number,`del_id`, `del_area`, `col_amount`, `name`, `mobile`, `email`,`pickup_add` FROM `parcel` NATURAL JOIN delivery_info NATURAL JOIN marchant WHERE parcel.m_id=delivery_info.m_id AND parcel.p_id='$ids'";

$result = $conn->query($sql);


$pdf = new FPDF('p', 'mm', 'A4');

$pdf->AddPage();

 //------------------------- Start While loop for fetch data Start-------------------//
while($row = $result->fetch_assoc()){

$due= $row['due_chrg'];
$chrg= $row['chrg'];

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,6,'Fast Delivery',0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Plot # 77-78, Road # 9',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Rupnagar R/A Mirpur-2 Dhaka-1216',0,0);
$pdf->Cell(25 ,5,'Date ',0,0);
$pdf->Cell(34 ,5,$row['stamp_created'],0,1);//end of line

$pdf->Cell(130 ,5,'Phone +880167-3303919',0,0);
$pdf->Cell(25 ,5,'Invoice # ',0,0);
$pdf->Cell(34 ,5,$row['del_id'],0,1);//end of line

$pdf->Cell(130 ,5,'Fax [+12345678]',0,0);
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,$row['m_id'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'From',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(40 ,5,"Name",0,0);
$pdf->Cell(90 ,5,": ".$row['name'],0,1);

$pdf->Cell(40 ,5,"Pickup Address",0,0);
$pdf->Cell(90 ,5,": ".$row['pickup_add'],0,1);

$pdf->Cell(40 ,5,"Mobile Number",0,0);
$pdf->Cell(90 ,5,": ".$row['mobile'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line
//billing address
$pdf->Cell(100 ,5,'To',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(40 ,5,"Name",0,0);
$pdf->Cell(90 ,5,": ".$row['recv_name'],0,1);

$pdf->Cell(40 ,5,"Deliver Address",0,0);
$pdf->Cell(90 ,5,": ".$row['recv_address'],0,1);

$pdf->Cell(40 ,5,"Mobile Number",0,0);
$pdf->Cell(90 ,5,": ".$row['recv_number'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

$pdf->SetFont('Arial','B',12);

//Due Charge = Service charge due
if ($due == "0") {
$pdf->Cell(30 ,5,'Track ID',1,0, "C");
$pdf->Cell(40 ,5,'Delivey Zone',1,0, "C");
$pdf->Cell(45 ,5,'Collectable Amount',1,0, "C");
$pdf->Cell(70,5,'Delivery Charge',1,1, "C");

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(30 ,5,$row['p_id'],1,0, "C");
$pdf->Cell(40 ,5,$row['del_area'],1,0, "C");
$pdf->Cell(45 ,5,$row['col_amount'],1,0, "C");
$pdf->Cell(70,5,$row['chrg'],1,1, "C");


}
else
{
	$pdf->Cell(30 ,5,'Track ID',1,0, "C");
$pdf->Cell(40 ,5,'Delivey Zone',1,0, "C");
$pdf->Cell(45 ,5,'Collectable Amount',1,0, "C");
$pdf->Cell(70,5,'Delivery Charge',1,1, "C");

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(30 ,5,$row['p_id'],1,0, "C");
$pdf->Cell(40 ,5,$row['del_area'],1,0, "C");
$pdf->Cell(45 ,5,$row['col_amount'],1,0, "C");
$pdf->Cell(70,5,$row['due_chrg'],1,1, "C");


} //------------------------- if conditon END-------------------//

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line
$pdf->Cell(180,10,"-------------",0,0, "R");
$pdf->Ln(5);
$pdf->Cell(180,10,"Signature",0,0, "R");

$pdf->Output();//END PDF

} //------------------------- Start While loop for fetch data END-------------------//




}  //------------------------- Getting ID in the condotion END --------------------//

?>