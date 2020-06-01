<!-- @author Dušan Cvjetičanin 170169 -->
<?php $session = session() ?>
<div class="container-fluid fill bg-success">
        <div class="row bg-success" id="content">
            <div class="offset-1 col-sm-12 col-md-5">
                <h1 style="margin-top: 30px;">Dobrodošli, <?php echo $session->get('user')->KorisnickoIme?></h1>
            <?php
                use App\Models\RequestModel;
                
                $session=session();
                $user = $session->get('user');
                echo form_open($session->get('type')."/sendPremiumRequest","method=post");
                $reqModel = new RequestModel();    
                $req = $reqModel->findRequestByKorIme($user->KorisnickoIme);
                if($req == null){
                    echo '<h2 style="margin-top: 30px;">Dragi ';
                    echo $user->KorisnickoIme; 
                    echo', imamo sjajan predlog za Vas!</h2>
                    <ul type="disc">
                        <li><h2 style="margin-top: 20px;">Postanite PREMIUM korisnik i pratite Vaš napredak!</h2>
                        <li><h2 style="margin-top: 20px;">Saznajte tačnu statistiku važih treninga!</h2>
                        <li><h2 style="margin-top: 20px;">Dobijate i savete sistema kako da unapredite Vaš trening!</h2>
                    </ul>
                    <h2 style="margin-top: 20px; color: white;">Sta čekate? Postanite PREMIUM već <u>danas</u> !</h2>';
                    echo '<input class="btn btn-light" type="submit" name="posaljizahtev" value="Pošalji zahtev"/>';
                }
               if($req != null){
                    echo "<h1>Uspešno ste poslali PREMIUM zahtev!<br/> Vaš zahtev je u obradi!</h1>";
                }
                echo form_close();
            ?>
            </div>
            <div class="offset-1 col-sm-4 col-md-4">
              <img src="<?php echo base_url()?>/../images/pie.png" width="100%" style="margin-top: 20px;">
            </div>
          </div>
    </div>