<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/lib/exel.php';
$Exel = new Exel;
if (isset($_POST['btn_read-exel'])){
    $inputFileName = './hello.xlsx';
     $Exel->Read($inputFileName);

}
