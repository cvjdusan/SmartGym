<!-- @author Dušan Cvjetičanin 170169 -->

<div class="container-fluid fill">
        <form class="form offset-md-4" name="ajax_form" id="ajax_form" name="passForm" action="<?= site_url("/Guest/newPassword") ?>" method="post">
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
              <div class="col-sm-12 errorForm" id='msg'>

              </div>
          </div>
          <button style="margin-left: 40%"class="btn btn-success" type="submit">Promeni</button>
        </form>
    </div>

 <script>     
   if ($("#ajax_form").length > 0) {
      $("#ajax_form").validate({
        submitHandler: function(form) {
      //$('#send_form').html('Sending..');
      $.ajax({
        url: "<?php echo base_url()?>/Guest/newPassword",
        type: "POST",
        data: $('#ajax_form').serialize(),
        dataType: "json",
        success: function( response ) { 
           if( response['msg']) {
               let col = 'red'
               if(response['msg'] == 'Šifra je uspešno promenjena.'){
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
