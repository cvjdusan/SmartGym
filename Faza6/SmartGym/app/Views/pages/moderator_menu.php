    <div class="container-fluid fill"> 
        <div class="row" id="content">
            <div class=" col-sm-12 col-md-12">
                <h2 class="text-center"> Dobrodošli <?php echo $userHeader->KorisnickoIme ?></h2>
                <br/>
                    <br/>
                    <br/>
                <ul class="list-unstyled list-inline text-center">
                    <li>
                <figure>
                    <a class="modLink" href="<?php echo base_url()?>/Moderator/adding"><img class="modImg" src="/images/plus.png"> </a> 
                    <figcaption><h5>&nbsp;&nbsp; Dodavanje sprave </h5></figcaption>
                    </li>
                </figure>
                    <li>
                <figure>
                    <a class="modLink" href="<?php echo base_url()?>/Moderator/removing"><img class="modImg" src="/images/minus.png"> </a> 
                    <figcaption><h5>&nbsp;&nbsp; Uklanjanje sprave </h5></figcaption>
                </figure>
                    </li>
                    <li>
                 <figure>
                    <a class="modLink" href="<?php echo base_url()?>/Moderator/showStatistics"><img class="modImg" src="/images/stats.png"> </a> 
                    <figcaption><h5>&nbsp;&nbsp; Statistika sprava</h5></figcaption>
                </figure>
                    </li>
                </ul>
            </div>
        </div>
    </div>
