<?php
require './config/conn.php';

echo "<div class='view'>";

echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . ">
    <input type='text' name='date' placeholder='yyyy-mm-dd'>
    <input type='submit' name='submit' value='a'>
  </form>";
if (!empty($_POST['submit'])) {
  $date = (string)$_POST['date'];
  $sql = "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
  from BNDOCEX2TLOG
  where
  StartTime > ? and
  StartTime < dateadd(d,1,?)
  group by right(cTriggerName,2) , cState";
  //print_r($_GET['date']);
  $stmt = sqlsrv_query($conn, $sql, array($date, $date));
  if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
  }
  //print_r($stmt)
}

echo "</div>";

/*while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  echo $row['Darab'] . ", " . $row['Status'] . ", " . $row['DepotCode'] . "<br />";
}*/
?>
