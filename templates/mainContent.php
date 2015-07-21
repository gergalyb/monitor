<?php
echo "<div id='mainContent'>";

$i = 0;
$submitted = false;
foreach ($queries as $objQuery) {
    if (!empty($_GET[$objQuery->name])){
        $submitted = true;
        $sqlID = $i;
    }
    $i++;
}


if ($submitted == true) {
    if ($sqlID == count($queries)-1){
        $params = array();
        $sql = "select
                cMsgID, cDocType, cOriginalFilename, cSubAddress1, cRecipientID, cSenderID , cStatus, cStatusDateTime
                from tMessages
                where";
            if ($_GET["cMsgID"] != "") {
                $sql .= " cMsgID=? AND";
                $params[] = $_GET["cMsgID"];
            }
            if ($_GET["cDocType"] != "") {
                $sql .= " cDocType =? AND";
                $params[] = $_GET["cDocType"];
            }
            if ($_GET["cOriginalFilename"] != "") {
                var_dump($_GET["cOriginalFilename"]);
                $data = explode("\r\n", $_GET["cOriginalFilename"]);
                var_dump($data);
                    if (count($data) == 1) {
                        $sql .= " (cOriginalFilename LIKE '%'+?+'%') AND";
                        $params[] = $data[0];
                    } else {
                        $sql .= " (";
                        foreach ($data as $dataElement) {
                            $sql .= "cOriginalFilename LIKE '%'+?+'%' OR ";
                            $params[] = $dataElement;
                        }
                        $sql .= "0=1) AND";
                    }
            }
            if ($_GET["cSubAddress1"] != "") {
                $sql .= " cSubAddress1=? AND";
                $params[] = $_GET["cSubAddress1"];
            }
            if ($_GET["cRecipientID"] != "") {
                $sql .= " cRecipientID=? AND";
                $params[] = $_GET["cRecipientID"];
            }
            if ($_GET["cSenderID"] != "") {
                $sql .= " cSenderID=? AND";
                $params[] = $_GET["cSenderID"];
            }
            if ($_GET["cStatus"] != "") {
                $sql .= " cStatus=? AND";
                $params[] = $_GET["cStatus"];
            }
            if ($_GET["cStatusDateTimeFROM"] != "") {
                $sql .= " cStatusDateTime > ? AND";
                $params[] = $_GET["cStatusDateTimeFROM"];
            }
            if ($_GET["cStatusDateTimeTO"] != "") {
                $sql .= " cStatusDateTime < ? AND";
                $params[] = $_GET["cStatusDateTimeTO"];
            }
            $sql .= " 1=1";
    }else {
        $sql = $queries[$sqlID]->sql;
        $i = 0;
        $params = array();
        foreach (array_keys($queries[$sqlID]->params) as $param) {
            $params[$i] = $_GET[$param];
            $i++;
        }
    }

    var_dump($sql);
    var_dump($_GET);
    var_dump($params);


    $options = array("Scrollable"=>SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($conn, $sql, $params, $options);
    if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
    }
    $metadata = sqlsrv_field_metadata($stmt);
    $rowCount = sqlsrv_num_rows($stmt);

    $rowsPerPage = 200;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 0;
    }

    sqlsrv_fetch($stmt,SQLSRV_SCROLL_ABSOLUTE,$page*$rowsPerPage-1);


    echo "<h4 class='queryName'>" . $queries[$sqlID]->publicName . "</h4>";
    if ($rowCount == 0) {
        echo "<div class='alert alert-danger'>
            No results found!
            </div>";
    } elseif ($rowCount < 65535) {
        echo "<div class='alert alert-success'>
            Query successful!<br>Number of rows: $rowCount
            </div>";
        echo "<a class='btn btn-raised btn-default' type='button'
                href='./templates/xlsExport.php?sqlID=" . $sqlID . "&params=" . base64_encode(json_encode($params)) . "&sql=" . base64_encode(json_encode($sql)) . "&filename=BNDocExchange_" . $queries[$sqlID]->publicName . "_" . time() . "'>
                <img src='./excel_logo.gif' alt='Excel letöltés' height='30px'>
            </a>
            <br>";
    } elseif ($rowCount >= 65535) {
        echo "<div class='alert alert-warning'>
            Query successful!<br>Number of rows: $rowCount
            <br>Excel supports a maximum of 65535 rows. Excel export unavailable.
            </div>";
    }

    foreach ($_GET as $key => $value) {
        if ($key != "page") {
            $GETParams[$key] = $value;
        }
    }
    echo "<ul class='pagination pagination-sm'>";
    for ($i=0; $i <= $rowCount/$rowsPerPage; $i++) {
        echo "<li><a href=./index.php?";
        foreach ($GETParams as $key => $value) {
            echo "$key=$value&";
        }
        echo "page=$i";
        echo "'>" . strval(intval($i)+1) . "</a></li>";
    }
    echo "</ul>";

    echo "<table id='table' class='table table-striped text-center'>";
        echo "<thead class>";
            echo "<tr>";
                foreach ($metadata as $columnMeta) {
                    echo "<th class='text-center'>" . $columnMeta['Name'] . "</th>";
                }
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            $i=0;
            while (($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))  && $i < $rowsPerPage){
                if (array_search("SUCCESS", $row) != false) {
                    echo "<tr class='success'>";
                }
                elseif (array_search("ERROR", $row) != false) {
                    echo "<tr class='danger'>";
                }
                else {
                    echo "<tr>";
                }
                    foreach ($row as $rowData) {
                        if ($rowData == "SUCCESS") {
                            echo "<td><span class='mdi-navigation-check'></span></td>";
                        }
                        elseif ($rowData == "ERROR") {
                            echo "<td><span class='mdi-navigation-close'></span></td>";
                        }
                        else {
                            if (gettype($rowData) == "object") {
                                echo "<td>" . $rowData->format('Y-m-d H:i:s') . "</td>";
                            } else {
                                echo "<td>" . $rowData . "</td>";
                            }
                        }
                    }
                    if (isset($row["cMsgID"])) {
                        echo "<td><a href='#' onclick='window.open(\"/monitor/templates/history.php?cMsgID=" . $row["cMsgID"] . "\", \"history\", \"status=1, toolbar=1 width=800px, height=400px\")'>History</a></td>";
                    }
                echo "</tr>";
                $i++;
            }
        echo "</tbody>";
    echo "</table>";
} else {
    echo "<div class='well'>Az eredmények itt fognak megjelenni.</div>";
}
echo "</div>";
?>
