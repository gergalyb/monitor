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

$complex = new query();
    $complex->name = "complexQuery";
    $complex->publicName = "Komplex lekérdezés";
    $complex->sql = "";
    $complex->category = "complex";
    $complex->params = array(
        "cMsgID"=>"text",
        "cDocType"=>"dropdown",
        "cOriginalFilename"=>"textarea",
        "cSubAddress1"=>"text",
        "cRecipientID"=>"dropdown",
        "cSenderID"=>"dropdown",
        "cStatus"=>"dropdown",
        "cStatusDateTimeFROM"=>"datetime",
        "cStatusDateTimeTO"=>"datetime"
    );


$queries = array($test,$test2,$complex);

$categoryPublicName = array(
    "quick" => "Gyors lekérdezések",
    "complex" => "Komplex lekérdezések"
);

$paramsPublicName = array(
    "dateFrom" => "Kezdő dátum",
    "dateTo" => "Bezáró dátum",
    "cMsgID" => "Üzenet ID",
    "cDocType"=>"Dokumentum típus",
    "cOriginalFilename"=>"Eredeti fájlnév",
    "cSubAddress1"=>"cím1",
    "cRecipientID"=>"Fogadó ID",
    "cSenderID"=>"Küldő ID",
    "cStatus"=>"Státusz",
    "cStatusDateTimeFROM"=>"status datetime from",
    "cStatusDateTimeTO"=>"status datetime to"
);

$dropdownData["cDocType"] = array(
    "ORDERS"=>"Order",
    "ORDPDF"=>"Warehouse movement",
    "ORDRSP"=>"Order response",
    "INVOIC"=>"Invoic",
    "INVCRE"=>"Credit memo",
    "INVDEB"=>"Debit memo",
    "CUSMAS"=>"Customer master",
    "MATMAS"=>"Material master",
    "MATSET"=>"Material set",
    "EXCAUT"=>"Excise authorization",
    "KOROSI"=>"Stock aging"
);
$dropdownData["cStatus"] = array(
    "0"=>"Pending",
    "1"=>"Imported",
    "2"=>"Downloaded",
    "3"=>"Deleted",
    "4"=>"Uploaded",
    "5"=>"Exported",
    "6"=>"Checked"
);
$stmt = sqlsrv_query($conn, "select cPartnerID, cPartnerName from tPartnerMaster order by cPartnerName");
if ($stmt === false) {
die(print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $rowValues = array_values($row);
    $dropdownData["cRecipientID"][$rowValues[0]] = $rowValues[1];
    $dropdownData["cSenderID"][$rowValues[0]] = $rowValues[1];
}

?>
