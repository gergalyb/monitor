<?php
require './libraries/php-excel.class.php';

echo "<div id='mainContent'>";
echo "info: mainContent <br />";

if (!empty($_SESSION['result'])) { //not working correctly
    $exportRaw = $_SESSION['result'];
    echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . ">";
        echo "<input type='button' value='Letöltés' name='export'>";
    echo "</form>";
    echo "<table id='table'>";
        echo "<tr>";
            echo "<th>" . "Darab" . "</th>";
            echo "<th>" . "Status" . "</th>";
            echo "<th>" . "DepotCode" . "</th>";
        echo "</tr>";
        while ($row = sqlsrv_fetch_array($_SESSION['result'], SQLSRV_FETCH_ASSOC)){
            echo "<tr>";
                echo "<td>".$row['Darab']."</td><td>".$row['Status']."</td><td>".$row['DepotCode']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        if (!empty($_POST['export'])) {
            //fill export array
        }
}   elseif ($_SESSION['result'] == 0) {
        echo "<b>Nincs találat!</b>";
}   else {
        echo "<b>Az eredmények itt fognak megjelleni</b>";
}
echo "</div>";
