<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-md-1 col-sm-12 col-md-10">

<?php



echo form_open("Admin/registrationResponse","method=post");

if ($requests != null) {

    echo "<table class='table table-responsive-sm table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th scope='col'>R.Br.</th>
                <th scope='col'>Korisničko Ime </th>
                <th scope='col'>Ime i prezime</th>
                <th scope='col'>Mejl</th>
                <th scope='col'>Datum rodjenja</th>  
                <th scope='col'>Tip</th> 
                <th scope='col'>#</th> 
              </tr>
            </thead>
            <tbody>
        ";

    $cnt = 1;
    foreach($requests as $req) {
        $type = "";
        switch($req->Tip) {
            case 'O': $type = "Obican Korisnik"; break;
            case 'P': $type = "Premium korisnik"; break;
            case 'M': $type = "Moderator"; break;
            case 'A': $type = "Admin"; break;
        }
        echo "<tr>";
        echo "<td>$cnt </td><td>$req->KorisnickoIme</td><td>$req->ImePrezime</td><td>$req->Mejl</td><td>$req->DatumRodjenja</td><td>$type</td>";
       // echo " &nbsp&nbsp ";
        echo "<td>";
        echo '<input class="btn btn-success" type="submit" name="prihvati'.$req->KorisnickoIme.'" value="Prihvati"/>';
        echo '<input class="btn btn-danger" type="submit" name="odbij'.$req->KorisnickoIme.'" value="Odbij"/>';
        echo "</td>";
        $cnt++;
        echo "</tr>";
    }
    echo "</tbody></table>";
}
else {
    echo "Nema novih zahteva za registracijom<br/><br/>";
}


echo form_submit("nazad", "Nazad");
echo form_close();

?>
        </div>
    </div>
</div>