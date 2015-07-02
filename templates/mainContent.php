<?php
//table generation

//if global result array/object has data, generate table
echo "<div id='mainContent'>";
echo "info: mainContent <br />";

if (!empty($_SESSION['result'])) { //not working correctly
  while ($row = sqlsrv_fetch_array($_SESSION['result'], SQLSRV_FETCH_ASSOC)){
    echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
  }
} elseif ($_SESSION['result'] == 0) {
  echo "<b>Nincs találat!</b>";
} else {
  echo "<b>Az eredmények itt fognak megjelleni</b>";
}
echo "</div>";
