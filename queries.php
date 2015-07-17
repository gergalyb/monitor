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
    $test->publicName = "Teszt lekérdezés";
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
    $test2->publicName = "Teszt lekérdezés2";
    $test2->sql =
        "select COUNT(cTriggerName) as Darab, cState as Status, right(cTriggerName,2) as DepotCode
        from BNDOCEX2TLOG
        where
        StartTime > '2015-04-20' and
        StartTime < dateadd(d,1,'2015-04-20')
        group by right(cTriggerName,2) , cState";
    $test2->category = "quick";


$test3 = new query();
    $test3->id = 2;
    $test3->name = "testQuery3";
    $test3->publicName = "Teszt lekérdezés3";
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
    $test4->publicName = "Teszt lekérdezés4";
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

$complex = new query();
    $complex->name = "complexQuery";
    $complex->publicName = "Komplex lekérdezés";
    $complex->sql = "";
    $complex->category = "complex";
    $complex->params = array(
        "cMsgID"=>"text",
        "cDocType"=>"text",
        "cOriginalFilename"=>"textarea",
        "cSubAddress1"=>"text",
        "cRecipientID"=>"dropdown",
        "cSenderID"=>"dropdown",
        "cStatus"=>"dropdown",
        "cStatusDateTimeFROM"=>"datetime",
        "cStatusDateTimeTO"=>"datetime"
    );

$queries = array($test,$test2,$test3,$test4,$complex);

$categoryPublicName = array(
    "normal" => "Normális lekérdezések",
    "quick" => "Gyors lekérdezések",
    "complex" => "Komplex lekérdezések"
);

$paramsPublicName = array(
    "dateFrom" => "Kezdő dátum",
    "dateTo" => "Bezáró dátum",
    "cMsgID" => "Üzenet ID",
    "cDocType"=>"Dokumentum típus",
    "cOriginalFilename"=>"Eredeti fájlnév"
);
?>
