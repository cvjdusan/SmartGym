<!-- @author Miljana Džunić 0177/2017 -->
<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-1 col-sm-12 col-md-10">
            
<?php
    use App\Models\ExerciseEquipmentTypeModel;
    use App\Models\ExerciseEquipmentModel;
    use App\Models\ReservationModel;
    
    $session=session();
    echo form_open($session->get('type')."/showStatistics","method=post");
    echo '<table class="table">
                <tr>
                    <td>
                        <h3>Sortiraj :</h3>
                    </td>';
    echo '<td><input class="btn btn-primary" type="submit" name="opadajuce" value="opadajuće"/>';
    echo '&nbsp<input class="btn btn-primary" type="submit" name="rastuce" value="rastuće"/></td>';
    echo '</tr>';    
    echo ' </table>';
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th scope='col'>Sprava</th>
                <th scope='col'>Tip sprave</th>
                <th scope='col'>Br. rezervacija</th>
              </tr>
            </thead>
            <tbody>
        ";
    
    if(!isset($buttonPushed)){
        $eem = new ExerciseEquipmentModel();
        $eetm = new ExerciseEquipmentTypeModel();
        $rm = new ReservationModel();
        $arr = [];
        $eqs = $eem->findAll();
        foreach($eqs as $eq){
            $cntEq = 0;
            echo "<tr>";
            echo "<td>$eq->IdSpr</td>";
            $type = $eetm->findByIdTip($eq->IdTip);
            echo "<td>";
            if(isset($type))
                echo anchor($session->get('type')."/showEquipment/{$type->IdTip}","$type->Naziv");
            echo "</td>";
            $ress = $rm->findByIdSpr($eq->IdSpr);

            foreach($ress as $res){
                $cntEq ++;
            }
            echo "<td>";
            array_push($arr, $cntEq);
            echo "$cntEq";
            echo "</td>";
        }
    } 
    if($buttonPushed == 'PritisnutoRastuce'){
        $eem = new ExerciseEquipmentModel();
        $rows = $eem->sortedASCEq();
        foreach($rows->getResult() as $row){
            echo "<tr>";
            echo "<td>$row->IdSpr</td>";
            echo "<td>";
            echo anchor($session->get('type')."/showEquipment/{$row->IdTip}","$row->Naziv");
            echo "</td>";
            echo "<td>$row->KP</td>";
            echo "</tr>";
        }
    }
    if($buttonPushed == 'PritisnutoOpadajuce'){     
        $eem = new ExerciseEquipmentModel();
        $rows = $eem->sortedDESCEq();
        foreach($rows->getResult() as $row){
            echo "<tr>";
            echo "<td>$row->IdSpr</td>";
            echo "<td>";
            echo anchor($session->get('type')."/showEquipment/{$row->IdTip}","$row->Naziv");
            echo "</td>";
            echo "<td>$row->KP</td>";
            echo "</tr>";
        }
    }
    echo "</tbody></table>";

    echo '<br>';
    
    
    echo form_submit("nazad", "Nazad");
    echo form_close();

?>

        </div>
    </div>
</div>


