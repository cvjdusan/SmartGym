<?php

echo form_open("Admin/registrationResponse","method=post");

if ($requests != null) {

    echo "R.Br. &nbsp| &nbspKorinsičko Ime &nbsp| &nbspIme i prezime &nbsp| &nbspMejl &nbsp| &nbspDatum rodjenja &nbsp| &nbspTip<br/><br/>";

    $cnt = 1;
    foreach($requests as $req) {
        $type = "";
        switch($req->Tip) {
            case 'O': $type = "Obican Korisnik"; break;
            case 'P': $type = "Premium korisnik"; break;
            case 'M': $type = "Moderator"; break;
            case 'A': $type = "Admin"; break;
        }
        echo "$cnt. &nbsp| &nbsp$req->KorisnickoIme &nbsp| &nbsp$req->ImePrezime &nbsp| &nbsp$req->Mejl &nbsp| &nbsp$req->DatumRodjenja &nbsp| &nbsp$type";
        echo " &nbsp&nbsp ";
        echo '<input type="submit" name="prihvati'.$req->KorisnickoIme.'" value="Prihvati"/>';
        echo " &nbsp";
        echo '<input type="submit" name="odbij'.$req->KorisnickoIme.'" value="Odbij"/>';
        echo "<br>";
        $cnt++;
    }

}
else {
    echo "Nema novih zahteva za registracijom";
}

echo "<br><br>";
echo form_submit("nazad", "Nazad");
echo form_close();
