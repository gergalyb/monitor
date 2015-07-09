<?php
require './queries.php';

function makeAccordionElement($title, $id, $content){
    echo "<div class='panel panel-default'>
    <div class='panel-heading' role='tab' id='$id'>
      <h4 class='panel-title'>
        <a role='button' data-toggle='collapse' data-parent='#accordion' href='#$id' aria-expanded='true' aria-controls='$id'>
          $title
        </a>
      </h4>
    </div>
    <div id='$id' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='$id'>
      <div class='panel-body'>
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>";
}


echo "<div id='sidebar'>";
    echo "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>";

foreach ($queries as $objQuery) {
    $paramsKeys = array_keys($objQuery->params);

    echo "<form class='form-horizontal jumbotron' method='POST' action=" . $_SERVER['PHP_SELF'] . ">";
    foreach ($paramsKeys as $key) {
        if ($objQuery->params[$key] == "date"){
            echo "<div class='date-input'>";
                echo "<label for=" . $key . ">" . $key . "</label>";
                echo "<input type='text' type='text' class='form-control' id='date-input' name=" . $key . " id=" . $key . ">";
            echo "</div>";
        }
        else {
            echo "error";
        }
    }
    echo "<input type='submit' class='btn btn-flat btn-default' name=" . $objQuery->name . ">";
    echo "</form>";
}
    echo "</div>";
echo "</div>";
?>
