<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

//$sheet = $spreadsheet->getActiveSheet();
//$sheet->setCellValue('A1', 'Hello World !');

// Set cell A1 with a string value
$spreadsheet->getActiveSheet()->setCellValue('A1', 'PhpSpreadsheet');

// Set cell A2 with a numeric value
$spreadsheet->getActiveSheet()->setCellValue('A2', 12345.6789);

// Set cell A3 with a boolean value
$spreadsheet->getActiveSheet()->setCellValue('A3', TRUE);

// Set cell A4 with a formula
$spreadsheet->getActiveSheet()->setCellValue(
    'A4',
    '=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))'
);

$spreadsheet->getActiveSheet()
    ->getCell('B8')
    ->setValue('Some value');




//luu file
$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
