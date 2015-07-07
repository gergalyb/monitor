<?php

//different script for each view
//datepicker, dropdowns, submit button in each different view script
//only run when submit is pressed

require './config/conn.php';

echo "<div class='view'>";

echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . ">
    <input type='text' name='date' placeholder='yyyy-mm-dd'>
    <input type='submit' name='submit'>
  </form>";

if (!empty($_POST['submit'])) {
  $date = $_POST['date']; //to be sanitized!
  $sql = "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
  from BNDOCEX2TLOG
  where
  StartTime > '$date' and
  StartTime < dateadd(d,1,'$date')
  group by right(cTriggerName,2) , cState";

  $stmt = sqlsrv_query($conn, $sql);
  if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
  }
  $_SESSION['result'] = $stmt;
}

echo "</div>";

/*while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
}*/
