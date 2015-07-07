<?php

//sidebar: list of possible queries
echo "<div id='sidebar'>";
echo "info: sidebar <br />";

require './queries.php';

foreach ($queries as $objQuery) {
    echo count($objQuery->params);
    echo ",";
}

echo "</div>";
?>
