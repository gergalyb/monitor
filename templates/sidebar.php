<?php
require './queries.php';

function makeAccordionElement($title, $id, $content){
    echo "<div class='panel panel-default'>
    <div class='panel-heading' role='tab' id='$id'>
      <h4 class='panel-title'>
        <a role='button' data-toggle='collapse' data-parent='#accordion' href='#A$id' aria-expanded='true' aria-controls='A$id'>
          $title
        </a>
      </h4>
    </div>
    <div id='A$id' class='panel-collapse collapse' role='tabpanel' aria-labelledby='$id'>
      <div class='panel-body'>
        $content
      </div>
    </div>
  </div>";
}


echo "<div id='sidebar'>";
    echo "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";
$contentQuick = "";
$contentNormal = "";
foreach ($queries as $objQuery) {
    $paramsKeys = array_keys($objQuery->params);
    if ($objQuery->category == "normal"){
        $contentNormal = $contentNormal . "<form class='form-horizontal jumbotron' method='POST' action=" . $_SERVER['PHP_SELF'] . ">";
        foreach ($paramsKeys as $key) {
            if ($objQuery->params[$key] == "date"){
                $contentNormal = $contentNormal . "<div class='date-input'>";
                    $contentNormal = $contentNormal . "<input type='text' type='text' class='form-control floating-label' placeholder='$key' id='date-input' name=" . $key . " id=" . $key . ">";
                $contentNormal = $contentNormal . "</div>";
            }
            else {
                echo "error";
            }
        }
        $contentNormal = $contentNormal . "<input type='submit' class='btn btn-flat btn-default' name=" . $objQuery->name . ">";
        $contentNormal = $contentNormal . "</form>";
    }

    if ($objQuery->category == "quick"){
        $contentQuick = $contentQuick . "<form class='form-horizontal jumbotron' method='POST' action=" . $_SERVER['PHP_SELF'] . ">";
        foreach ($paramsKeys as $key) {
            if ($objQuery->params[$key] == "date"){
                $contentQuick = $contentQuick . "<div class='date-input'>";
                    $contentQuick = $contentQuick . "<input type='text' type='text' class='form-control floating-label' placeholder='$key' id='date-input' name=" . $key . " id=" . $key . ">";
                $contentQuick = $contentQuick . "</div>";
            }
            else {
                echo "error";
            }
        }
        $contentQuick = $contentQuick . "<input type='submit' class='btn btn-flat btn-default' name=" . $objQuery->name . ">";
        $contentQuick = $contentQuick . "</form>";
    }
}
makeAccordionElement("quick", "quick", $contentQuick);
makeAccordionElement("normal", "normal", $contentNormal);
    echo "</div>";
echo "</div>";
?>
