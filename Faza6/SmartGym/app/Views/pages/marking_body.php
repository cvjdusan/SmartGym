    <div class="container-fluid fill"> 
        <div class="row" id="content" style="margin-top: -600px;">
            <div class=" col-sm-12 col-md-12">

<?php

use App\Models\ExerciseEquipmentTypeModel;
use App\Models\ExerciseEquipmentModel;
use App\Models\ReservationModel;

echo form_open("Admin/markResponse","method=post");

if ($terms != null || $text != "") {
    
    echo "Korisničko ime:&nbsp;";
    echo '<input type="text" name="user" value="'."$text".'">';
    echo " &nbsp ";
    echo '<input type="submit" name="search" value="Traži">';
    echo "<br><br>";
    
    if ($terms != null) {
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th scope='col'>R.Br.</th>
                <th scope='col'>Korisničko Ime </th>
                <th scope='col'>Sprave</th>
                <th scope='col'>Datum</th>
                <th scope='col'>Vreme</th>  
                <th scope='col'>#</th> 
              </tr>
            </thead>
            <tbody>
        ";

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

            echo "<tr>";
            echo "<td>$cnt</td><td>$term->KorisnickoIme</td><td>[";
            $num = count($equipmentType);
            foreach($equipmentType as $key => $eqt) {
                echo $eqt->Naziv;
                if (--$num != 0) {
                    echo ", &nbsp";
                }
            }
            echo "]</td><td>$term->Datum</td><td>$term->Vreme</td>";
            echo "<td>";
            echo '<input class="btn btn-success" type="submit" name="dosao'.$term->IdTer.'" value="Došao"/>';
            echo " &nbsp";
            echo '<input class="btn btn-danger" type="submit" name="ndosao'.$term->IdTer.'" value="Nije došao"/>';
            echo "</td>";
            echo "</tr>";
            $cnt++;
        }
        
        echo "</tbody></table>";
    }
    else {
        echo "Nema takvih korisnika sa zakazanim terminima za ovaj datum";
    }

}
else {
    echo "Nema zakazanih termina za ovaj datum";
}

echo form_close();
?>
</div>
</div>
</div>