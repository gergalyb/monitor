<?php
require './queries.php';

function makeAccordionElement($id, $title, $content){
    echo "<div class='panel panel-default'>
    <div class='panel-heading' role='tab' id='$id'>
      <h4 class='panel-title'>
        <a role='button' data-toggle='collapse' data-parent='#accordion' href='#A$id' aria-expanded='true' aria-controls='A$id'>
          $title
          <b class='caret'></b>
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
        $contentNormal = $contentNormal . "<legend>" . $objQuery->publicName . "</legend>";
        foreach ($paramsKeys as $key) {
            if ($objQuery->params[$key] == "date"){
                $contentNormal = $contentNormal . "<div class='date-input form-group'>";
                    $contentNormal = $contentNormal . "<input type='text' type='text' class='form-control floating-label' placeholder='$paramsPublicName[$key]' id='date-input' name='$key' id='$key'>";
                $contentNormal = $contentNormal . "</div>";
            }
        }
        $contentNormal = $contentNormal . "<input type='submit' value='Lekérdezés indítása' class='btn btn-flat btn-default' name='$objQuery->name'>";
        $contentNormal = $contentNormal . "</form>";
    }

    if ($objQuery->category == "quick"){
        $contentQuick = $contentQuick . "<form class='form-horizontal jumbotron' method='POST' action=" . $_SERVER['PHP_SELF'] . ">";
        $contentQuick = $contentQuick . "<legend>$objQuery->publicName</legend>";
        foreach ($paramsKeys as $key) {
            if ($objQuery->params[$key] == "date"){
                $contentQuick = $contentQuick . "<div class='date-input form-group'>";
                    $contentQuick = $contentQuick . "<input type='text' type='text' class='form-control floating-label' placeholder='$paramsPublicName[$key]' id='date-input' name='$key' id='$key'>";
                $contentQuick = $contentQuick . "</div>";
            }
        }
        $contentQuick = $contentQuick . "<input type='submit' value='Lekérdezés indítása' class='btn btn-flat btn-default' name='$objQuery->name'>";
        $contentQuick = $contentQuick . "</form>";
    }
}
makeAccordionElement("quick", "Gyors lekérdezések", $contentQuick);
makeAccordionElement("normal", "Normális lekérdezések", $contentNormal);
    echo "</div>";
echo "</div>";
?>
