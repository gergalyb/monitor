<?php
echo "<div id='sidebar'>";

require './queries.php';

foreach ($queries as $objQuery) {
    $paramsKeys = array_keys($objQuery->params);
    echo "<form method='POST' action=" . $_SERVER['PHP_SELF'] . ">";
    foreach ($paramsKeys as $key) {
        if ($objQuery->params[$key] == "date"){
            echo "<input type='text' placeholder='yyyy-mm-dd' name=" . $key . "> <br>";
        }
        else {
            echo "error";
        }
    }
    echo "<input type='submit' name=" . $objQuery->name . ">";
    echo "</form><br><br>";
}

echo "</div>";
?>
