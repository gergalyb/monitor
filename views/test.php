<?php

//different script for each view
//datepicker, dropdowns, submit button in each different view script
//only run when submit is pressed

require './config/conn.php';

echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . ">
    <input type='text' name='date'>
    <input type='submit' name='submit'>
  </form>";

$sql = "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
  from BNDOCEX2TLOG
  where
  StartTime > '2015-04-20' and
  StartTime < dateadd(d,1,'2015-04-20')
  group by right(cTriggerName,2) , cState";

if (!empty($_POST['submit'])) {
  $stmt = sqlsrv_query($conn, $sql);
  if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
  }
  $_SESSION['result'] = $stmt;
}

/*while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
}*/
