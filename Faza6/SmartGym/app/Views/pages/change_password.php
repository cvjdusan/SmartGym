    <div class="container-fluid fill">
        <form class="form offset-md-4" name="passForm" action="<?= site_url("/Guest/newPassword") ?>" method="post">
          <div class="col-sm-6 mb-3">
              <input type="text" class="form-control" name="KorisnickoIme" placeholder="Korisničko ime" required>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="Sifra"  placeholder="Šifra" required>

          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="NovaSifra"  placeholder="Nova šifra" required>
               <small id="passHelp" class="form-text text-muted">Šifra mora biti najmanje dužine 6 karaktera i mora sadržati makar 1 cifru. </small>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="Potvrda"  placeholder="Potvrda" required>
              <div class="col-sm-12 errorForm">
                 <?php if(isset($errorMsg)) 
                    echo "<font color='red'>$errorMsg</font><br>"; 
                ?>
              </div>
          </div>
          <button style="margin-left: 40%"class="btn btn-success" type="submit">Promeni</button>
        </form>
    </div>
