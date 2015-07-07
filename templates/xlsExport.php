<?php
require './libraries/php-excel.class.php';
$exportRaw = $_SESSION['exportRaw'];
$export = array(0 => array('Darab','Status','DepotCode'));
$i = 1;
var_dump($_SESSION['result']);
var_dump($exportRaw);
while ($row = sqlsrv_fetch_array($exportRaw, SQLSRV_FETCH_ASSOC)) {
    $export[$i] = array($row['Darab'],$row['Status'],$row['DepotCode']);
    $i++;
}
$xls = new Excel_XML('UTF-8', false, 'test');
$xls->addArray($export);
$xls->generateXML('testxls');
?>
