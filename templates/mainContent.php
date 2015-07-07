<?php
echo "<div id='mainContent'>";
echo "info: mainContent <br />";

if (!empty($_POST['submit'])) { //not working correctly
    echo "<a href='./templates/xlsExport.php?sqlID=" . $sqlID . "&params=".base64_encode(json_encode($params))."'>Letöltés</a><br />";

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
    }

    /*require './classes/PHPExcel.php';
    $xls = new PHPExcel();
    $xls->setActiveSheetIndex(0)
        ->setCellValue('A1','test a1')
        ->setCellValue('A2','test a2')
        ->setCellValue('B1','test b1')
        ->setCellValue('B2','test b2');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="01simple.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
    $objWriter->save('php://output');*/


    echo "<table id='table'>";
        echo "<tr>";
            echo "<th>" . "Darab" . "</th>";
            echo "<th>" . "Status" . "</th>";
            echo "<th>" . "DepotCode" . "</th>";
        echo "</tr>";

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
                echo "<td>".$row['Darab']."</td><td>".$row['Status']."</td><td>".$row['DepotCode']."</td>";
            echo "</tr>";
        }
        echo "</table>";
}   elseif (isset($_SESSION['result']) && $_SESSION['result'] == 0) {
        echo "<b>Nincs találat!</b>";
}   else {
        echo "<b>Az eredmények itt fognak megjelleni</b>";
}
echo "</div>";
?>
