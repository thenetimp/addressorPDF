<?php
    
require_once('vendor/autoload.php');

$addresses = getAddressFromCSV($argv[1]);




$pdf = new FPDF('L', 'mm', array(148,100));

foreach($addresses as $address)
{
    $pdf->AddPage();

    $pdf->SetFont('Arial', "", 8);
    $pdf->setXY(30, 3);
    $pdf->Cell(40, 10, "The Andrews Family");
    $pdf->setXY(30, 6);
    $pdf->Cell(40, 10, "Sakaine 5-7-29");
    $pdf->setXY(30, 9);
    $pdf->Cell(40,10, "Kashiwa-shi Chiba-ken Japan");
    $pdf->setXY(30, 12);
    $pdf->Cell(40, 10, "277-0053");


    $pdf->SetFont('Arial', "", 12);
    $pdf->setXY(30,50);
    $pdf->Cell(40, 10, $address[0]);
    $pdf->SetFont('Arial', "", 10);
    $pdf->setXY(30, 55);
    $pdf->Cell(40, 10, $address[1]);
    $pdf->setXY(30, 60);
    $pdf->Cell(40,10, $address[2].', '. $address[3] . ' ' . $address[4]);
    $pdf->setXY(30, 65);
    $pdf->Cell(40, 10, $address[5]);
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