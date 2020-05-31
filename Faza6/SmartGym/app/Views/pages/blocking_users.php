<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-md-1 col-sm-12 col-md-10">

<?php


echo form_open("Admin/block","method=post");

    echo "<table class='table table-responsive-sm table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
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


foreach($users as $user) {
    $type = "";
    if ($user->Tip == 'O') $type = "Obican Korisnik";
    else if ($user->Tip == 'P') $type = "Premium Korisnik";
    else $type = "Moderator";
    echo "<tr>";
    echo "<td>$user->KorisnickoIme</td><td>$user->ImePrezime</td><td>$user->Mejl</td><td>$user->DatumRodjenja</td><td>$type</td>";
    echo "<td>";
    echo '<input class="btn btn-danger" type="submit" name="blokiraj'.$user->KorisnickoIme.'" value="Blokiraj"/>';
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