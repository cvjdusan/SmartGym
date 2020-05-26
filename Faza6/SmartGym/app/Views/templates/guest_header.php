<!-- @author Dušan Cvjetičanin 170169 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        <?php include '../css/style.css'; ?>
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src= '../js/script.js'></script>
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
                <a class="nav-item nav-link <?php if($page == 'guest_home') echo "active";?>" href="<?php echo base_url()?>/Guest/index">Početna <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link <?php if($page == 'guest_register') echo "active";?>" href="<?php echo base_url()?>/Guest/register">Postani član</a>
                <a class="nav-item nav-link <?php if($page == 'guest_login') echo "active";?>" href="<?php echo base_url()?>/Guest/login" id="aNavRight">Uloguj se</a>
            </div>
        </div>
        
  </nav>