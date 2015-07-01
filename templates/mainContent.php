<?php
//table generation

//if global result array/object has data, generate table

echo "mainContent <br />";

if (!empty($_SESSION['result'])) {
  while ($row = sqlsrv_fetch_array($_SESSION['result'], SQLSRV_FETCH_ASSOC)){
    echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
  }
}
