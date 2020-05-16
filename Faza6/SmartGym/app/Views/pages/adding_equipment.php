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


//echo "<b>Tip sprave &nbsp&nbsp / &nbsp&nbsp Količina</b><br><br><br>";
$session=session();
echo form_open($session->get('type')."/addEquipment","method=post");
$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$types = $eetm->findAll();

foreach($types as $type) {
    echo "<tr>";
    echo "<td>";
    echo anchor($session->get('type')."/showEquipment/{$type->IdTip}","$type->Naziv");
    echo "</td>";
    echo "<td>";
    echo $eem->cnt($type->IdTip);
    echo "</td>";
    echo "<td>";
    echo '<input class="btn btn-primary" type="submit" name="dodajspr'.$type->IdTip.'" value="Dodaj"/>';
    echo "</td>";
    echo "</tr>";
}
    echo "</tbody></table>";

echo '<br><input type="submit" name="dodajtip" value="Novi Tip"/>';
echo form_submit("nazad", "Nazad");
echo form_close();

?>

        </div>
    </div>
</div>

