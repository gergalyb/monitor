<?php
if ($printEnable == 1){
echo "<div class='view'>";

echo "<form method='post' action=" . $_SERVER['PHP_SELF'] . ">
        <input type='text' name='date' placeholder='yyyy-mm-dd'>
        <input type='submit' name='submit' value='a'>
    </form>";
}
if (!empty($_POST['submit'])) {
    $date = $_POST['date'];
    $sql = "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
    from BNDOCEX2TLOG
    where
    StartTime > ? and
    StartTime < dateadd(d,1,?)
    group by right(cTriggerName,2) , cState";
    $params = array($date, $date);
    $sqlID = "test.php";
    $sql1 = $sql;
}
if ($printEnable == 1){
echo "</div>";
}
?>
