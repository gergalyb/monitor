<?php
require '../queries.php';
require '../config/conn.php';
$sql = $queries[$_GET['sqlID']]->sql;
$params = json_decode(base64_decode($_GET['params']));

//var_dump($sql);
//var_dump($params);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
die(print_r(sqlsrv_errors(), true));
}
$metadata = sqlsrv_field_metadata($stmt);

require '../classes/PHPExcel.php';
$xls = new PHPExcel();

$col = 0;
foreach ($metadata as $columnMeta) {
    $xls->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, 1, $columnMeta['Name']);
    $col++;
}
$row = 2;
while ($rowData = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $col = 0;
    foreach ($rowData as $data) {
        $xls->setActiveSheetIndex(0)->setCellValueByColumnAndRow($col, $row, $data);
        $col++;
    }
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
$objWriter->save('php://output');

?>
