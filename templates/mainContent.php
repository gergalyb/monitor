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
    
    echo "<a href='./templates/xlsExport.php?sqlID=" . $sqlID . "&params=".base64_encode(json_encode($params))."'>Letöltés</a><br />";

    echo "<table id='table'>";
        echo "<tr>";
            foreach ($metadata as $columnMeta) {
                echo "<th>" . $columnMeta['Name'] . "</th>";
            }
        echo "</tr>";

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
                echo "<td>".$row['Darab']."</td><td>".$row['Status']."</td><td>".$row['DepotCode']."</td>";
            echo "</tr>";
        }
        echo "</table>";
} else {
    echo "<b>Az eredmények itt fognak megjelleni.</b>";
}
echo "</div>";
?>
