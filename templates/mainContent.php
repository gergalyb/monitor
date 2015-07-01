<?php
//table generation

//if global result array/object has data, generate table

echo "mainContent <br />";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
}
