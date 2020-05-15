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
            <div class="navbar-nav ml-auto">
                
                <div class="dropdown">
                    <button class="dropbtn"><a class="nav-item nav-link <?php if($page == 'moderator_menu') echo "active";?>" href="<?php echo base_url()?>/Moderator/index">Početna</a></button>
                 <div class="dropdown-content">
                   <a href="<?php echo base_url()?>/Moderator/adding">Dodavanje sprave</a>
                    <a href="<?php echo base_url()?>/Moderator/removing">Uklanjanje sprave</a>
                    <a href="<?php echo base_url()?>/Moderator/statistics">Statistika</a>
                 </div>
               </div> 
                <a class="nav-item nav-link <?php if($page == 'user_reservation') echo "active";?>" href="<?php echo base_url()?>/Moderator/reservation">Rezervacija</a>
                <a class="nav-item nav-link <?php if($page == 'user_term') echo "active";?>" href="<?php echo base_url()?>/Moderator/term" id="aNavRight">Pregled termina</a>
                <a class="nav-item nav-link" href="<?php echo base_url()?>/Moderator/logout" id="aNavRight">Izloguj se</a>
            </div>
        </div>
        
  </nav>