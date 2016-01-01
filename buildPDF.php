<?php
    
require_once('vendor/autoload.php');

$addresses = getAddressFromCSV($argv[1]);




$pdf = new FPDF('L', 'mm', array(148,100));

foreach($addresses as $address)
{
    $pdf->AddPage();

    $pdf->SetFont('Arial', "", 8);
    $pdf->setXY(30, 3);
    $pdf->Cell(45, 10, "The Andrews Family");
    $pdf->setXY(30, 6);
    $pdf->Cell(45, 10, "Sakaine 5-7-29");
    $pdf->setXY(30, 9);
    $pdf->Cell(45,10, "Kashiwa-shi Chiba-ken Japan");
    $pdf->setXY(30, 12);
    $pdf->Cell(45, 10, "277-0053");


    $startPosition = 45;
    $pdf->SetFont('Arial', "", 12);
    $pdf->setXY(30,$startPosition);
    $pdf->Cell(45, 10, trim($address[0]));
    $pdf->SetFont('Arial', "", 10);
    if(isset($address[6]) && $address[6] != "")
    {
        $pdf->setXY(30, $startPosition+=5);
        $pdf->Cell(45, 10, trim($address[6]));
    }
    $pdf->setXY(30, $startPosition+=5);
    $pdf->Cell(45, 10, trim($address[1]));
    $pdf->setXY(30, $startPosition+=5);
    $pdf->Cell(45,10, trim($address[2]) . ', '. trim($address[3]) . ' ' . trim($address[4]));
    $pdf->setXY(30, $startPosition+=5);
    $pdf->Cell(45, 10, trim($address[5]));
}

$pdf->Output();


function getAddressFromCSV($fileName)
{
    $addresses = array();
    
    if (($handle = fopen($fileName, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $addresses[] = $data;
        }
        fclose($handle);
    }    
    return $addresses;
}
