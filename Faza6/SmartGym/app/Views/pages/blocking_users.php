<?php


echo form_open("Admin/block","method=post");

foreach($users as $user) {
    $type = "";
    if ($user->Tip == 'O') $type = "Obican Korisnik";
    else if ($user->Tip == 'P') $type = "Premium Korisnik";
    else $type = "Moderator";
    echo "$user->KorisnickoIme | $user->ImePrezime | $user->Mejl | $user->DatumRodjenja | $type &nbsp";
    echo '<input type="submit" name="blokiraj'.$user->KorisnickoIme.'" value="Blokiraj"/>';
    echo "<br>"; 
}

echo "<br><br>";
echo form_submit("nazad", "Nazad");
echo form_close();

