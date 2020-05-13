<?php

use App\Models\ExerciseEquipmentModel;
use App\Models\ExerciseEquipmentTypeModel;

echo "<b>Tip sprave &nbsp&nbsp / &nbsp&nbsp Količina</b><br><br><br>";
echo form_open("Moderator/addEquipment","method=post");
$eetm = new ExerciseEquipmentTypeModel();
$eem = new ExerciseEquipmentModel();
$types = $eetm->findAll();

foreach($types as $type) {
    echo anchor("Moderator/showEquipment/{$type->IdTip}","$type->Naziv");
    echo " &nbsp / &nbsp ";
    echo $eem->cnt($type->IdTip);
    echo " &nbsp&nbsp&nbsp ";
    echo '<input type="submit" name="dodajspr'.$type->IdTip.'" value="Dodaj"/>';
    echo "<br>";
}

echo '<br><input type="submit" name="dodajtip" value="DodajNoviTip"/>';
echo " &nbsp;&nbsp; ";
echo form_submit("nazad", "Nazad");
echo form_close();