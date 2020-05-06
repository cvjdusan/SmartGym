    <div class="container-fluid fill">
        <form class="form offset-md-4" name="loginform" action="<?= site_url("/Guest/loginSubmit") ?>" method="post">
          <div class="col-sm-6 mb-3">
              <input type="text" class="form-control" name="KorisnickoIme" placeholder="Korisničko ime" required>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="password" class="form-control" name="Sifra"  placeholder="Šifra" required>
              <div class="col-sm-12 errorForm">
                 <?php if(isset($errorMsg)) 
                    echo "<font color='red'>$errorMsg</font><br>"; 
                ?>
              </div>
          </div>
          <button style="margin-left: 40%"class="btn btn-success" type="submit">Log in</button>
        </form>
    </div>
