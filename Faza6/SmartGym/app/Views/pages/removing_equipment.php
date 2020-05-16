<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-1 col-sm-12 col-md-10">

<?php
 
use App\Models\ExerciseEquipmentModel;
use App\Models\ExerciseEquipmentTypeModel;


echo "<table class='table table-striped'>";
echo "<thead class='thead-dark'>
        <tr>
            <th scope='col'>Tip sprave</th>
            <th scope='col'>Količina</th>
            <th scope='col'>#</th>
          </tr>
        </thead>
        <tbody>
    ";


$session = session();
echo form_open($session->get('type')."/removeEquipment","method=post");
$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$types = $eetm->findAll();

foreach($types as $type) {
    echo "<tr>";
    echo "<td>";
    echo anchor($session->get('type')."/showEquipment/{$type->IdTip}","$type->Naziv");
    echo "</td>";
    echo "<td>";
    $count = $eem->cnt($type->IdTip);
    echo $count;
    echo "</td>";
    echo "<td>";
    if ($count > 0) {
    echo '<input class="btn btn-danger" type="submit" name="uklonispr'.$type->IdTip.'" value="Ukloni"/>';
    }
    else {
        echo '<input class="btn btn-secondary" type="submit" name="uklonispr'.$type->IdTip.'" value="Ukloni" disabled/>';
    }
    echo "</td>";
    echo "</tr>";
}

    echo "</tbody></table>";

echo form_submit("nazad", "Nazad");
echo form_close();
?>

                                            </div>
    </div>
</div>

