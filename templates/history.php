<!DOCTYPE html>
<head>
    <meta charset="utf-8">

    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/material/css/material-fullpalette.css">
    <link rel="stylesheet" href="../bootstrap/material/css/ripples.css">
    <link rel="stylesheet" href="../bootstrap/material/css/roboto.css">
    <link rel="stylesheet" href="../bootstrap/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../bootstrap/datetimepicker/css/bootstrap-datetimepicker.css">

    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../bootstrap/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="../bootstrap/material/js/material.min.js"></script>
    <script type="text/javascript" src="../bootstrap/material/js/ripples.min.js"></script>
    <script type="text/javascript" src="../bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../bootstrap/datepicker/locales/bootstrap-datepicker.hu.min.js"></script>
    <script type="text/javascript" src="../bootstrap/datetimepicker/js/moment.js"></script>
    <script type="text/javascript" src="../bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <title>Dreher üzenetforgalom monitoring</title>
</head>
<body>

<?php
require "../config/conn.php";


$sql = "select * from vAllLog where cMsgId=?";
$params[] = $_GET["cMsgID"];

$options = array("Scrollable"=>SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($conn, $sql, $params, $options);
if ($stmt === false) {
die(print_r(sqlsrv_errors(), true));
}
$metadata = sqlsrv_field_metadata($stmt);
$rowCount = sqlsrv_num_rows($stmt);

//echo "<h4 class='queryName'>" . $queries[$sqlID]->publicName . "</h4>";
if ($rowCount == 0) {
    echo "<div class='alert alert-danger'>
        No results found!
        </div>";
} elseif ($rowCount < 65535) {
    echo "<div class='alert alert-success'>
        Query successful!<br>Number of rows: $rowCount
        </div>";
    echo "<a class='btn btn-raised btn-default' type='button'
            href='./xlsExport.php?params=" . base64_encode(json_encode($params)) . "&sql=" . base64_encode(json_encode($sql)) . "&filename=History_of_cMsgId_" . $_GET["cMsgID"] . "_" . time() . ".xls" . "'>
            <img src='../excel_logo.gif' alt='Excel letöltés' height='30px'>
        </a>
        <br>";
} elseif ($rowCount >= 65535) {
    echo "<div class='alert alert-warning'>
        Query successful!<br>Number of rows: $rowCount
        <br>Excel supports a maximum of 65535 rows. Excel export unavailable.
        </div>";
}


echo "<table id='table' class='table table-striped text-center'>";
    echo "<thead class>";
        echo "<tr>";
            foreach ($metadata as $columnMeta) {
                echo "<th class='text-center'>" . $columnMeta['Name'] . "</th>";
            }
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            if (array_search("SUCCESS", $row) != false) {
                echo "<tr class='success'>";
            }
            elseif (array_search("ERROR", $row) != false) {
                echo "<tr class='danger'>";
            }
            else {
                echo "<tr>";
            }
                foreach ($row as $rowData) {
                    if ($rowData == "SUCCESS") {
                        echo "<td><span class='mdi-navigation-check'></span></td>";
                    }
                    elseif ($rowData == "ERROR") {
                        echo "<td><span class='mdi-navigation-close'></span></td>";
                    }
                    else {
                        if (gettype($rowData) == "object") {
                            echo "<td>" . $rowData->format('Y-m-d H:i:s') . "</td>";
                        } else {
                            echo "<td>" . $rowData . "</td>";
                        }
                    }
                }
            echo "</tr>";
        }
    echo "</tbody>";
echo "</table>";
?>

</body>
</html>
