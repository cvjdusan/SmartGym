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
                  <?php echo $errorMsg; ?>
              </div>
          </div>
          <button name="regBtn" style="margin-bottom: 40px; margin-left: 40%" class="btn btn-success" type="submit">Register</button>
        </form>
    </div>




      <!--  <div class="row">
            <div class="col-sm-12 offset-md-3 col-md-6">
                <table id="inputTable">
                    <tr>
                        <td> <h4>Popunite sva polja: </h4></td>
                    </tr>
                    <tr>
                        <td>Korisničko ime</td>
                        <td><input type="text" style="width: 100%;"></td>
                    </tr>
                    <tr>
                        <td>Ime:</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Prezime:</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Lozinka:</td>
                        <td><input type="password"></td>
                    </tr>
                    <tr>
                        <td>Potvrdita lozinke:</td>
                        <td><input type="password"></td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <td>Datum rodjenja</td>
                        <td><input type="date"></td>
                    </tr>
                    <tr>
                        <td>Tip korisnika:</td>
                        <td>
                            <select>
                                <option>Običan korisnik</option>
                                <option>Premium korisnik</option>
                                <option>Moderator</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Registruj se"></td>
                    </tr>
                </table>
            </div>
        </div>
      -->