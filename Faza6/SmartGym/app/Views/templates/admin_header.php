<!-- @author Dušan Cvjetičanin 170169 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        <?php include '../css/style.css'; ?>
    </style>
        <script src= 'js/script.js'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>SmartGym</title>
    
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
      
      <!-- Logo -->
      <h1><font color="grey">Smart</font><font color="#94C600">Gym</font></h1>
      
        <!-- Button for small devices -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav  ml-auto">
                
                <div class="dropdown">
                    <button class="dropbtn"><a class="nav-item nav-link <?php if($page == 'admin_menu') echo "active";?>" href="<?php echo base_url()?>/Admin/index">Početna</a></button>
                 <div class="dropdown-content">
                    <div id="link1" class="dItem" href="#">Sprave
                        <div class="dropdown-two">
                            <a href="<?php echo base_url()?>/Admin/adding">Dodavanje sprave</a>
                            <a href="<?php echo base_url()?>/Admin/removing">Uklanjanje sprave</a>
                            <a href="<?php echo base_url()?>/Admin/statistics">Statistika teretane</a>
                        </div>
                   </div>
                    <div id="link2" class="dItem" href="#">Korisnici
                        <div class="dropdown-two">
                            <a href="<?php echo base_url()?>/Admin/viewRequestRegistration">Zahtevi korisnika</a>
                            <a href="<?php echo base_url()?>/Admin/viewRequestPremium">Premium zahtevi</a>
                            <a href="<?php echo base_url()?>/Admin/blocking">Blokiranje</a>
                            <a href="<?php echo base_url()?>/Admin/marking">Potvrda termina</a>
                        </div>
                   </div>
                 </div>
               </div> 
                <a class="nav-item nav-link <?php if($page == 'user_reservation') echo "active";?>" href="<?php echo base_url()?>/Admin/reservation">Rezervacija</a>
                <a class="nav-item nav-link <?php if($page == 'user_term') echo "active";?>" href="<?php echo base_url()?>/Admin/term" id="aNavRight">Pregled termina</a>
                <a class="nav-item nav-link <?php if($page == 'premium_statistics') echo "active";?>" href="<?php echo base_url()?>/Admin/getStatistics">Statistika</a> 
                <a class="nav-item nav-link" href="<?php echo base_url()?>/Admin/logout" id="aNavRight">Izloguj se</a>
            </div>
        </div>
        
  </nav>