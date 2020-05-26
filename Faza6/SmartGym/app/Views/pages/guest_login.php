<!-- @author Dušan Cvjetičanin 170169 -->

<div class="container-fluid fill">
        <br>
        <?= \Config\Services::validation()->listErrors(); ?>
            <form class="form offset-md-4" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8">
              <div class="col-sm-6 mb-3">
                  <input type="text" class="form-control" name="KorisnickoIme" placeholder="Korisničko ime" required>
              </div>
              <div class="col-sm-6 mb-3">
                  <input type="password" class="form-control" name="Sifra"  placeholder="Šifra" required>
                  <a style="float: right; margin-bottom: 5px; margin-top: 5px;" href="<?php echo base_url()?>/Guest/changePassword">Promena šifre</a>
                  <div class="col-sm-12 errorForm" id="errorMsg">
                  </div>
              </div>

              <button style="margin-left: 40%"class="btn btn-success" type="submit">Log in</button>
            </form> 
    </div>

 <script>     
   if ($("#ajax_form").length > 0) {
      $("#ajax_form").validate({
        submitHandler: function(form) {
      //$('#send_form').html('Sending..');
      $.ajax({
        url: "<?php echo base_url()?>/Guest/loginSubmit",
        type: "POST",
        data: $('#ajax_form').serialize(),
        dataType: "json",
        success: function( response ) { 
           if( response['redirect'] ) window.location.replace(response['redirect']);
           else if( response['errorMsg']) {
               $("#errorMsg").html('<font style="color: red">'+response['errorMsg']+'</font>');
           }
        }
       
      });
    }
  });
  };
</script>
