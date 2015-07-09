<?php
class query{
    public $id;
    public $name;
    public $sql;
    public $category;
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
    $test->category = "quick";
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
    $test2->category = "quick";
    $test2->params = array(
        "dateFrom"=>"date",
        "dateTo"=>"date"
    );

$test3 = new query();
    $test3->id = 2;
    $test3->name = "testQuery3";
    $test3->sql =
        "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
        from BNDOCEX2TLOG
        where
        StartTime > ? and
        StartTime < dateadd(d,1,?)
        group by right(cTriggerName,2) , cState";
    $test3->category = "normal";
    $test3->params = array(
        "dateFrom"=>"date",
        "dateTo"=>"date"
    );

$test4 = new query();
    $test4->id = 3;
    $test4->name = "testQuery4";
    $test4->sql =
        "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
        from BNDOCEX2TLOG
        where
        StartTime > ? and
        StartTime < dateadd(d,1,?)
        group by right(cTriggerName,2) , cState";
    $test4->category = "normal";
    $test4->params = array(
        "dateFrom"=>"date",
        "dateTo"=>"date"
    );

$queries = array($test,$test2,$test3,$test4);
?>
