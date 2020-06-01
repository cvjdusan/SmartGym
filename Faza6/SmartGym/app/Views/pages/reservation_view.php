<!-- @author Miljana Džunić 0177/2017 -->
<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-1 col-sm-12 col-md-10">

<?php
    use App\Models\ReservationModel;
    use App\Models\TermModel;
    
    $session=session();
    echo form_open($session->get('type')."/reservationView","method=post");
    $user=$session->get('user');
    $tm = new TermModel();
    $terms = $tm->getTermsByKorIme($user->KorisnickoIme);
    if($terms != null){
        echo "<table class='table table-striped'>";
        echo "<thead class='thead-dark'>
                <tr>
                    <th scope='col'>Datum</th>
                    <th scope='col'>Vreme</th>
                    <th scope='col'>Sprava</th>
                    <th scope='col'>Tip sprave</th>
                    <th scope='col'>&nbsp;</th>
                    <th scope='col'>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
            ";
        $user = $session->get('user');
        $resModel = new ReservationModel();
        $ress = $resModel->getResForKorIme($user->KorisnickoIme);
        foreach($ress->getResult() as $res) {
            echo "<tr>";
            echo "<td>$res->Datum</td>";
            echo "<td>$res->Vreme</td>";
            echo "<td>$res->IdSpr</td>";
            echo "<td>";
            echo anchor($session->get('type')."/showEquipment/{$res->IdTip}","$res->Naziv");
            echo "</td>";
            echo "<td>";
            if($res->Status == 'R')
                echo '<input class="btn btn-primary" type="submit" name="otkazirez'.$res->IdRez.'" value="Otkaži"/>';
            echo "</td>";
            echo "</tr>";
        }
            echo "</tbody></table>";

        echo '<br>';
    }else {
        echo "<h3><font color='red'>Niste rezervisali nijedan termin!</font><br/></h3>";
    }
    
    echo form_submit("nazad", "Nazad");
    echo form_close();

?>

        </div>
    </div>
</div>

