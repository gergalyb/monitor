<?php
class query{
    public $id;
    public $name;
    public $sql;
    public $params = array();
}

$test = new query();
    $test->id = 0;
    $test->name = "testQuery";
    $test->sql =
        "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
        from BNDOCEX2TLOG
        where
        StartTime > ? and
        StartTime < dateadd(d,1,?)
        group by right(cTriggerName,2) , cState";
    $test->params = array(
        "dateFrom"=>"date",
        "dateTo"=>"date"
    );

$test2 = new query();
    $test2->id = 1;
    $test2->name = "testQuery2";
    $test2->sql =
        "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
        from BNDOCEX2TLOG
        where
        StartTime > ? and
        StartTime < dateadd(d,1,?)
        group by right(cTriggerName,2) , cState";
    $test2->params = array(
        "dateFrom"=>"date",
        "dateTo"=>"date"
    );

$queries = array($test,$test2);
?>
