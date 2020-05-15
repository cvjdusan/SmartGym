<?php

echo form_open("Admin/premiumResponse","method=post");

if ($requests != null) {

    echo "R.Br. &nbsp| &nbspKorinsičko Ime &nbsp| &nbspIme i prezime &nbsp| &nbspMejl &nbsp| &nbspDatum rodjenja<br/><br/>";

    $cnt = 1;
    foreach($requests as $req) {
        echo "$cnt. &nbsp| &nbsp$req->KorisnickoIme &nbsp| &nbsp$req->ImePrezime &nbsp| &nbsp$req->Mejl &nbsp| &nbsp$req->DatumRodjenja";
        echo " &nbsp&nbsp ";
        echo '<input type="submit" name="prihvati'.$req->KorisnickoIme.'" value="Prihvati"/>';
        echo " &nbsp";
        echo '<input type="submit" name="odbij'.$req->KorisnickoIme.'" value="Odbij"/>';
        echo "<br>";
        $cnt++;
    }

}
else {
    echo "Nema novih zahteva za premium";
}

echo "<br><br>";
echo form_submit("nazad", "Nazad");
echo form_close();


