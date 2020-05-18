<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      
      var json =<?php echo json_encode($stats);?>;

      function drawChart() {
          
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'word');
        data.addColumn('number', 'count');
        
        for(key in json){
            data.addRow([json[key].muscle, json[key].percent]);
         }

        var options = {
          backgroundColor: 'transparent',
          title: '',
          pieHole: 0.4,
          sliceVisibilityThreshold :0
        };
        


        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

        
        chart.draw(data, options);
      }
    </script>


<div class="container-fluid fill">
    <div class="row" id="content" style="margin-top: 50px;">

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div class="col-sm-6">
<?php

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\TargetedMuscleGroupModel;
use App\Models\ExerciseEquipmentModel;

$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$tmgm = new TargetedMuscleGroupModel();

    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th scope='col'>Grupa mišića  </th>
                <th scope='col'>Broj korišćenih sprava  </th>
                <th scope='col'>Broj bodova</th>
              </tr>
            </thead>
            <tbody>
        ";


foreach($stats as $stat) {
            echo "<tr>";
            echo "<td>";
            echo $stat['muscle'];
            echo "</td>";
            echo "<td>";
            echo $stat['cnt'];
            echo "</td>";
            echo "<td>";
            echo $stat['jacina'];
            echo "</td>";
            echo "</tr>";
}
    echo "</tbody></table>";
        
?>
         </div>
        <div class="col-sm-6">
            <div id="donutchart" style="height: 100%; width: 100%;"></div>
        </div>

        <div class="col-sm-4" style="background-color: #FF4136; color:white; margin-top: 30px; padding: 10px;">
<?php

echo "<h3>Zapostavili ste sledeće grupe mišića:</h3>";

$stats = array_reverse($stats);
foreach($stats as $stat) {
    if ($stat['jacina'] >= $limit) { break; }
    echo "<b>-";
    echo $stat['muscle'];
    echo"</b><br>";
    echo " &nbsp&nbsp Mi predlažemo da više radite:<br>";
    $groups = $tmgm->findForGroup($stat['IdMuscle']);
    foreach($groups as $group) {
        $equipment = $eetm->find($group->IdTip);
        if ($eem->cnt($equipment->IdTip) > 0) {
            echo " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp *";
            echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
            echo "<br>";
        }
    }
}

?>
    </div>
        <div class="col-sm-4" style="background-color: #001f3f; color:white; margin-top: 30px; padding: 10px;">
<?php
$num = count($myEq);
if ($num > 0) {
    echo "<br/><br/><h3>Vaše omiljene sprave:</h3>";
    if ($num > 3) { $num = 3; }
    $i = 1;
    foreach($myEq as $me) {
        echo "$i. &nbsp";
        $equipment = $me['type'];
        echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
        echo "<br>";
        if (++$i > $num) { break; }
    }
    

}
?>
    </div>
        <div class="col-sm-4" style="background-color: #FF851B  ; color:white; margin-top: 30px; padding: 10px;">   
<?php
$num2 = count($allEq);
if ($num2 > 0) {
    echo "<br/><br/><h3>Najpopularnije sprave:</h3>";
    if ($num2 > 3) { $num2 = 3; }
    $i = 1;
    foreach($allEq as $ae) {
        echo "$i. &nbsp";
        $equipment = $ae['type'];
        echo anchor("$path/showEquipment/{$equipment->IdTip}","$equipment->Naziv");
        echo "<br>";
        if (++$i > $num2) { break; }
    }
}

?>
    </div>
        </div>
    </div>
</div>

