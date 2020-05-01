<?php


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


/**
 * @var $spreadsheet Spreadsheet
 * @var $provider yii\data\ActiveDataProvider
 */
$spreadsheet = new Spreadsheet();

//Свойства документа

$spreadsheet->getProperties()
    ->setCreated('RPcommunity.ru')
    ->setLastModifiedBy('RPcommunity.ru')
    ->setTitle('Показания воды')
    ->setSubject('Показания воды')
    ->setDescription('Показания воды')
    ->setKeywords('Показания воды')
    ->setCategory('Показания воды');


//Создание таблицы и стилей
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(5);

$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(10);

$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(10);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(10);

$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(20);
$spreadsheet->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(20);

$spreadsheet->setActiveSheetIndex(0)->setCellValue('B1', 'ХВС1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('C1', 'Показания');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D1', 'ХВС2');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('E1', 'Показания');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('F1', 'ХВС3');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('G1', 'Показания');

$spreadsheet->setActiveSheetIndex(0)->setCellValue('H1', 'ГВС1');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('I1', 'Показания');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('J1', 'ГВС2');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('K1', 'Показания');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('L1', 'ГВС3');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('M1', 'Показания');


$spreadsheet->setActiveSheetIndex(0)->setCellValue('N1', 'Дата показаний');
$spreadsheet->setActiveSheetIndex(0)->setCellValue('O1', 'Дата изменения');

//Стили
$spreadsheet->getActiveSheet()->getStyle('B1:O1')->getFont()->setSize(10);
$spreadsheet->getActiveSheet()->getStyle('B1:O1')->getAlignment()->setWrapText(true)->setVertical('center');
$spreadsheet->getActiveSheet()->getStyle('B1:O1')->getAlignment()->setWrapText(true)->setHorizontal('center');

//Высота строк
foreach ($spreadsheet->getActiveSheet()->getRowDimensions() as $rowID) {

    $rowID->setRowHeight(-1);
}


$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(30);

//Данные

$rows = $provider->getModels();
$i = 2;

foreach ($rows as $row) {

    $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $i, $row->watermeter_id);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $i, $row->cold1);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $i, $row->wmcold2);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $i, $row->cold2);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $i, $row->wmcold3);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $i, $row->cold3);

    $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $i, $row->wmhot1);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . $i, $row->hot1);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $i, $row->wmhot2);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('K' . $i, $row->hot2);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('L' . $i, $row->wmhot3);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('M' . $i, $row->hot3);


    $spreadsheet->setActiveSheetIndex(0)->setCellValue('N' . $i, $row->date);
    $spreadsheet->setActiveSheetIndex(0)->setCellValue('O' . $i, Date('Y-m-d h:i:s', $row->updated_at));

    $i++;
}


// Redirect output to a client’s web browser (Xls)
header('Content-Type: application/vnd.ms-excel, charset=utf-8');
header('Content-Disposition: attachment;filename="Показания расхода воды.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
exit;
