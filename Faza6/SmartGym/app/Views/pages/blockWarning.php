<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="offset-1 col-sm-12 col-md-10">

<?php

echo form_open("Admin/finalBlock","method=post");
echo "Korisnik $user->KorisnickoIme će biti trajno blokiran. Da li želite da nastavite?<br/><br/>";
echo '<input type="hidden" name="user" value="'.$user->KorisnickoIme.'">';
echo '<input type="submit" name="'.$user->KorisnickoIme.'" value="Blokiraj"/>';
echo " &nbsp&nbsp ";
echo form_submit("nazad", "Nazad");
?>
            
    </div>
    </div>
</div>
