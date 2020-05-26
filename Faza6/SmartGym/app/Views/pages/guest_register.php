<!-- @author Dušan Cvjetičanin 170169 -->
<div class="container-fluid fill">
        <form class="form offset-md-4" name="ajax_form" id="ajax_form" method="post">
          <div class="col-sm-6 mb-3">
              <input type="text" class="form-control" name="KorisnickoIme" placeholder="Korisničko ime" required>
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
              <input type="text" class="form-control" name="ImePrezime" placeholder="Ime i prezime" required>
               <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="mail" class="form-control" name="Mejl" placeholder="Email" required>
               <div class="col-sm-12 errorForm" >

              </div>
          </div>
          <div class="col-sm-6 mb-3">
              <input type="date" class="form-control" name="DatumRodjenja" placeholder="Datum" required>
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
              <div class="col-sm-12" id='msg'>
              </div>
          </div>
          <button name="regBtn" style="margin-bottom: 40px; margin-left: 40%" class="btn btn-success" type="submit">Registruj se</button>
        </form>
    </div>


 <script>     
   if ($("#ajax_form").length > 0) {
      $("#ajax_form").validate({
        submitHandler: function(form) {
      //$('#send_form').html('Sending..');
      $.ajax({
        url: "<?php echo base_url()?>/Guest/addUser",
        type: "POST",
        data: $('#ajax_form').serialize(),
        dataType: "json",
        success: function( response ) { 
           if( response['msg']) {
               let col = 'red'
               if(response['msg'] == 'Zahtev za registraciju je uspešno poslat.'){
                   col = 'green';   
                   document.getElementById("ajax_form").reset();
               }
               $("#msg").html('<font style="color: '+col+'">'+response['msg']+'</font>');
           }
        }
       
      });
    }
  });
  };
</script>
