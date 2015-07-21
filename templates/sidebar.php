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

function makeQueryElement ($category){
    global $output;
    global $objQuery;
    global $paramsKeys;
    global $paramsPublicName;
    global $dropdownData;
    if (!isset($output[$category])){
        $output[$category] = "";
    }
    $output[$category] .= "<form class='form-horizontal jumbotron' method='GET' action=" . $_SERVER['PHP_SELF'] . ">";
    $output[$category] .= "<h4>" . $objQuery->publicName . "</h4>";
    foreach ($paramsKeys as $key) {
        if ($objQuery->params[$key] == "date"){
            $output[$category] .= "<div class='date-input form-group'>";
                $output[$category] .= "<input type='text' class='form-control floating-label' placeholder='$paramsPublicName[$key]' id='date-input' name='$key'>";
            $output[$category] .= "</div>";
        }
        elseif ($objQuery->params[$key] == "datetime") {
            $output[$category] .= "<div class='form-group'>";
                $output[$category] .= "<input type='text' id='datetimepicker' class='form-control floating-label' placeholder='$paramsPublicName[$key]' name='$key'>";
            $output[$category] .= "</div>";
        }
        elseif ($objQuery->params[$key] == "text") {
            $output[$category] .= "<div class='form-group'>";
                $output[$category] .= "<input type='text' class='form-control floating-label' placeholder='$paramsPublicName[$key]' name='$key'>";
            $output[$category] .= "</div>";
        }
        elseif ($objQuery->params[$key] == "textarea") {
            $output[$category] .= "<div class='form-group'>";
                $output[$category] .= "<textarea rows='4' class='form-control floating-label' placeholder='$paramsPublicName[$key]' name='$key'></textarea>";
            $output[$category] .= "</div>";
        }
        elseif ($objQuery->params[$key] == "dropdown") {
            $output[$category] .= "<div class='form-group'>";
                $output[$category] .= "<select class='form-control floating-label' placeholder='$paramsPublicName[$key]' name='$key'>";
                $output[$category] .= "<option value=''></option>";
                foreach ($dropdownData[$key] as $dropdownValue => $dropdownName) {
                    $output[$category] .= "<option value='$dropdownValue'>$dropdownName</option>";
                }
                $output[$category] .= "</select>";
            $output[$category] .= "</div>";
        }
    }
    $output[$category] .= "<input type='submit' value='Lekérdezés indítása' class='btn btn-flat btn-default' name='$objQuery->name'>";
    $output[$category] .= "</form>";
}

echo "<div id='sidebar'>";
    echo "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";

$output = array();

foreach ($queries as $objQuery) {
    $paramsKeys = array_keys($objQuery->params);
    makeQueryElement($objQuery->category);
}
foreach ($output as $outputKey => $outputValue) {
    makeAccordionElement($outputKey, $categoryPublicName[$outputKey], $outputValue);
}

    echo "</div>";
echo "</div>";
?>
