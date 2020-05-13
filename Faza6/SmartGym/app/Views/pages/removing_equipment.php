<?php
 
use App\Models\ExerciseEquipmentModel;
use App\Models\ExerciseEquipmentTypeModel;

echo "<b>Tip sprave &nbsp&nbsp / &nbsp&nbsp Količina</b><br><br><br>";
echo form_open("Moderator/removeEquipment","method=post");
$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$types = $eetm->findAll();

foreach($types as $type) {
    echo anchor("Moderator/showEquipment/{$type->IdTip}","$type->Naziv");
    echo " &nbsp / &nbsp ";
    $count = $eem->cnt($type->IdTip);
    echo $count;
    echo " &nbsp&nbsp&nbsp ";
    if ($count > 0) {
    echo '<input type="submit" name="uklonispr'.$type->IdTip.'" value="Ukloni"/>';
    }
    else {
        echo '<input type="submit" name="uklonispr'.$type->IdTip.'" value="Ukloni" disabled/>';
    }
    echo "<br>";
}

echo "<br><br>";
echo form_submit("nazad", "Nazad");
echo form_close();

