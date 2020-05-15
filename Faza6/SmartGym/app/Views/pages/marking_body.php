<?php

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\ReservationModel;

echo form_open("Admin/markResponse","method=post");

if ($terms != null) {

    echo "R.Br. &nbsp| &nbspKorinsičko Ime &nbsp| &nbspSprave &nbsp| &nbspDatum &nbsp| &nbspVreme<br/><br/>";

    $cnt = 1;
    $eetm = new ExerciseEquipmentTypeModel();
    $eem = new ExerciseEquipmentModel();
    $rm = new ReservationModel();
    echo '<input type="hidden" name="date" value="'.$date.'">';
    
    foreach($terms as $term) {
        
        $reservations = $rm->findForTerm($term->IdTer);
        $equipment = [];
        foreach($reservations as $reservation) {
            array_push($equipment, $eem->find($reservation->IdSpr));
        }
        $equipmentType = [];
        foreach($equipment as $eq) {
            array_push($equipmentType, $eetm->find($eq->IdTip));
        }
        
        echo "$cnt. &nbsp| &nbsp$term->KorisnickoIme &nbsp| &nbsp[";
        $num = count($equipmentType);
        foreach($equipmentType as $key => $eqt) {
            echo $eqt->Naziv;
            if (--$num != 0) {
                echo ", &nbsp";
            }
        }
        echo "] &nbsp| &nbsp$term->Datum &nbsp| &nbsp$term->Vreme";
        echo " &nbsp&nbsp ";
        echo '<input type="submit" name="dosao'.$term->IdTer.'" value="Došao"/>';
        echo " &nbsp";
        echo '<input type="submit" name="ndosao'.$term->IdTer.'" value="Nije došao"/>';
        echo "<br>";
        $cnt++;
    }

}
else {
    echo "Nema zakazanih termina za ovaj datum";
}

echo form_close();

