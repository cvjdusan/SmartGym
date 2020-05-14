<?php
$KorisnickoIme="";
$Sifra="";
$Potvrda="";
$ImePrezime="";
$Mejl="";
$DatumRodjenja="";

if(isset($_POST['regBtn'])) {
   $ImePrezime = $_POST['ImePrezime'];
   $KorisnickoIme = $_POST['KorisnickoIme'];
   $Mejl= $_POST['Mejl'];
   $DatumRodjenja= $_POST['DatumRodjenja'];
}
?> 
    
    <div class="container-fluid fill">
        <form class="form offset-md-4" name="registerForm" action="<?= site_url("/Guest/addUser") ?>" method="post">
          <div class="col-sm-6 mb-3">
              <input type="text" class="form-control" value="<?php echo $KorisnickoIme;?>" name="KorisnickoIme" placeholder="Korisničko ime" required>
              <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="Sifra"  placeholder="Šifra" required>
              <small id="passHelp" class="form-text text-muted">Šifra mora biti najmanje dužine 6 karaktera i mora sadržati makar 1 cifru. </small>
              <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="Potvrda"  placeholder="Potvrda šifre" required>
              <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="text" class="form-control" value="<?php echo $ImePrezime;?>" name="ImePrezime" placeholder="Ime i prezime" required>
               <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="mail" class="form-control" value="<?php echo $Mejl;?>" name="Mejl" placeholder="Email" required>
               <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="date" class="form-control" value="<?php echo $DatumRodjenja;?>" name="DatumRodjenja" placeholder="Datum" required>
               <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
             <select name="Tip">
              <option value="O">Običan korisnik</option>
              <option value="P">Premium korisnik</option>
              <option value="M">Moderator</option>
              <option value="A">Administrator</option>
             </select>
          </div>
          <div class="col-sm-6 mb-3">
              <div class="col-sm-12">
                  
                  <?php 
                        echo "<font style='color:red'>".$errorMsg."</font>";
                    ?>
              </div>
          </div>
          <button name="regBtn" style="margin-bottom: 40px; margin-left: 40%" class="btn btn-success" type="submit">Registruj se</button>
        </form>
    </div>
