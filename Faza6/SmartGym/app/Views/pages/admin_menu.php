<div class="container-fluid fill">
    <div class="row" id="content">
        <div class="col-sm-12 text-center">
            <h2>Dobrodošli <?php echo $userHeader->KorisnickoIme ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="offset-1 col-sm-4 col-md-4" style="background-color: white;">
            <h2> Upravljanje spravama </h2>
            <br>
            <?= anchor("Admin/adding", "Dodaj spravu") ?>
                <br>
            <?= anchor("Admin/removing", "Ukloni spravu") ?> 
                <br>
            <?= anchor("Admin/showStatistics", "Statistika") ?> 
                <br>
        </div>
        <div class="offset-1 col-sm-4 col-md-4" style="background-color: white">
            <h2> Upravljanje korisnicima </h2>
            <br>
            <?= anchor("Admin/viewRequestRegistration", "Pregled zahteva za registracijom") ?>
                <br>
            <?= anchor("Admin/viewRequestPremium", "Pregled zahteva za Premium") ?>
                <br>
            <?= anchor("Admin/blocking", "Blokiranje korisnika") ?>
                <br>
            <?= anchor("Admin/marking", "Potvrda dolaska na termin") ?>
            <br>
        </div>
   </div>
</div>

