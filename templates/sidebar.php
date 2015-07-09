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
                    $contentNormal = $contentNormal . "<label for=" . $key . ">" . $key . "</label>";
                    $contentNormal = $contentNormal . "<input type='text' type='text' class='form-control' id='date-input' name=" . $key . " id=" . $key . ">";
                $contentNormal = $contentNormal . "</div>";
            }
            else {
                echo "error";
            }
        }
        $contentNormal = $contentNormal . "<input type='submit' class='btn btn-flat btn-default' name=" . $objQuery->name . ">";
        $contentNormal = $contentNormal . "</form>";
        //var_dump($contentNormal);

    }
}
makeAccordionElement("normal", "normal", $contentNormal);
    echo "</div>";
    ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>


    <?php
echo "</div>";
?>
