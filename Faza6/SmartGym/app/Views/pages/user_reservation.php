<!-- @author Dušan Cvjetičanin 170169 -->

<?php
$Date = null;
$Hour = null;
$Min = null;
$session = session();

if($session->has('Datum')) {
   $Date = $session->get('Datum');
   $Hour = $session->get('Hour');
   $Min = $session->get('Min');
}
?>   

    <div class="container-fluid fill">                                                 <!-- mozda contoller ili nesto drugo -->
        <form class="form form-row text-center" name="reservationForm0" action="<?= site_url($controller."/reservationSubmit") ?>" method="post">
          <div class="offset-md-3 col-sm-2 mb-3">
              <input type="date" value="<?php echo $Date;?>" class="form-control" name="Datum" placeholder="Datum" required>
          </div>
          <div class="col-sm-1 mb-3">
                <select name='hour' id="hour" class="form-control">
                    <?php 
                        $string1 = "";
                        
                        for($i = 7; $i < 24; $i++){
                            $id = $i < 10 ? "0".$i : $i;
                            if($Hour != null && $Hour == $id){
                                $string1 .= "<option selected='selected' name='hour' value='" . $id . "'>" .  $id . "</option>"; 
                            }else{
                                $string1 .= "<option name='hour' value='" . $id . "'>" .  $id . "</option>"; 
                        
                            }
                         }
                    
                        echo $string1;
                    ?>
                </select>

          </div>
          <div class="col-sm-1 mb-3">
                <select name='min' id="minute" class="form-control">
                    <?php 
                        $string2 = "";
                        
                        for($i = 0; $i <= 50; $i+=10){
                            $id = $i < 10 ? "0".$i : $i;
                            if($Min != null && $Min == $id){
                                $string2 .= "<option selected='selected' name='hour' value='" . $id . "'>" .  $id . "</option>"; 
                            }else{
                                $string2 .= "<option name='hour' value='" . $id . "'>" .  $id . "</option>"; 
                            }
                        }
                        
                        echo $string2;
                    ?>
                </select>
         </div>
         <div class="col-sm-2">
            <button name="resBtn" class="btn btn-success" type="submit">Potvrdi</button>
         </div>
          <div class="col-sm-2 errorForm">
            <?php if(isset($errorMsg)) 
             echo "<font color='red'>$errorMsg</font><br>"; 
             ?>
         </div>
        </form>
      <form class="form" name="reservationForm1" action="<?= site_url($controller."/reservationAdd") ?>" method="post">
 <!--     <div class="row">
            <div class="col-sm-12 offset-md-1 col-md-10 offset-md-1" id="registationDiv">
                    <table class="table table-dark table-striped" style="margin-top: 50px;">
                        <thead>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>Naziv sprave</td>
                                <td>Grupa misica</td>
                                <td>Opis</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div> -->
                        
        <?php
            if(isset($eq)) {            
                $string = "";
                $row = '<div class="row reservationRow">';
                $div = '<div class="col-3 col-sm-2 col-md-2 reservationDiv">';
                $divF = '<div class="col-3 col-sm-2 offset-md-1 col-md-2 reservationDiv">';
                $end = '</div>';
                sort($eq);
                for($i = 0; $i < count($eq); $i++) {
                    if(!in_array($eq[$i]['IdSpr'], $reserved)){
                        $string .= $row;
                        $string .= $divF;
                        $string .= '<img width="100%" height="100%" src="data:image/png;base64,'.base64_encode($eq[$i]['Slika']).'"/>';
                        $string .= $end;
                        $string .= $div;
                        $string .= $eq[$i]['Naziv']." ".$eq[$i]['IdSpr'];
                        $string .= $end;
                        $string .= $div;
                        $string .= $eq[$i]['GrupaMisica'];
                        $string .= $end;
                        $string .= $div;
                        $string .= $eq[$i]['Opis'];
                        $string .= $end;
                        $string .= $div;
                        $string .= '<button class="btn btn-success" value="'.$eq[$i]['IdSpr'].'"type="submit" name="addRes">Dodaj</button>';
                        $string .= $end;
                        $string .= $end; 
                    }
                }   

                echo $string;
            }
        ?>
      </form>
    </div>