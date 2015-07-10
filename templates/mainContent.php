<?php
echo "<div id='mainContent'>";

$i = 0;
$submitted = false;
foreach ($queries as $objQuery) {
    if (!empty($_POST[$objQuery->name])){
        $submitted = true;
        $sqlID = $i;
    }
    $i++;
}

if ($submitted == true) {
    $sql = $queries[$sqlID]->sql;
    $i = 0;
    $params = array();
    foreach (array_keys($queries[$sqlID]->params) as $param) {
        $params[$i] = $_POST[$param];
        $i++;
    }
    //var_dump($sql);
    //var_dump($_POST);
    //var_dump($params);

    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
    }
    $metadata = sqlsrv_field_metadata($stmt);

    echo "<h4 class='queryName'>" . $queries[$sqlID]->publicName . "</h4>";
    echo "<a class='btn btn-raised btn-default' data-toggle='tooltip' data-placement='right' type='button' title='' data-original-title='Letöltés Excel formátumban' href='./templates/xlsExport.php?sqlID=" . $sqlID . "&params=" . base64_encode(json_encode($params)) . "'>
            <img src='./excel_logo.gif' alt='Excel letöltés' height='30px'>
        </a>
        <br />";

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
                            echo "<td>" . $rowData . "</td>";
                        }
                    }
                echo "</tr>";
            }
        echo "</tbody>";
    echo "</table>";
} else {
    echo "<div class='well'>Az eredmények itt fognak megjelenni.</div>";
}
echo "</div>";
?>
