<div class="container-fluid fill">
    
    
    
    <form class="needs-validation" novalidate>
        
        <div class="form">
          <div class="col-md-4 mb-3">
            <input type="text" placeholder="Korisničko ime" required>
            <div class="invalid-feedback">
               Polje ne sme ostati prazno.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <input type="password" placeholder="Šifra" required>
            <div class="invalid-feedback">
               Polje ne sme ostati prazno.
            </div>
          </div>
        </div>

    <button class="btn btn-success" type="submit">Potvrdi</button>
  </form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>