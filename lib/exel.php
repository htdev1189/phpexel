<?php

ob_start();
require_once __DIR__ . '/DB.php';

require_once __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Exel extends DB
{
    protected $spreadsheet;

    function __construct()
    {
        //phai khoi tao cai nay
        parent::__construct();
        $this->spreadsheet = new Spreadsheet();
    }


    function Export($query)
    {
        // style tieude
        $styleTieuDe1 = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];

        $styleTieuDe = [
            'fill' => [
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF0000')
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];

        $result = $this->getData($query);
        //lay tong so field
//        echo $result->field_count;

        //lay ten field
        $i = 1;
        while ($field_name = $result->fetch_field()) {
            //in ra dong dau tien la ten cua ca truong du lieu
            $this->spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($i, 1, $field_name->name);
            $i++;
        }

        // lay toan bo thong tin ra
        $row_start = 2;
        while ($data = $result->fetch_array()) {
            for ($j = 0; $j < $result->field_count; $j++) {
                $this->spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($j + 1, $row_start, $data[$j]);
            }
            $row_start++;
        }

        // lam style cho tieude
        $this->spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleTieuDe);


        //kiem tra file ton tai chua
        if (!file_exists(__DIR__ . '/../hello.xlsx')) {
            //luu file
            $writer = new Xlsx($this->spreadsheet);
            $writer->save('hello.xlsx');
        }

        header('location:index.php');
    }

    function Read($filename)
    {
        /** Create a new Xls Reader  **/
//        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $objPHPExcel = $reader->load($filename);

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,null,true,false);
            //  Insert row data array into your database of choice here
            var_dump($rowData);
        }
    }
}